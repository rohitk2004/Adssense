<?php
include '../includes/config.php';

// Handle API Logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['url'])) {
    header('Content-Type: application/json');

    $startUrl = filter_var($_POST['url'], FILTER_SANITIZE_URL);
    $maxPages = 50; // processes max 50 pages to prevent timeouts

    if (!filter_var($startUrl, FILTER_VALIDATE_URL)) {
        echo json_encode(['error' => 'Invalid URL provided.']);
        exit;
    }

    $host = parse_url($startUrl, PHP_URL_HOST);
    $scheme = parse_url($startUrl, PHP_URL_SCHEME);
    $rootUrl = $scheme . '://' . $host;

    $visited = [];
    $queue = [$startUrl];
    $sitemapUrls = [];

    // Simple Breadth-First Search
    while (!empty($queue) && count($visited) < $maxPages) {
        $currentUrl = array_shift($queue);

        if (in_array($currentUrl, $visited))
            continue;
        $visited[] = $currentUrl;

        // Add to sitemap data
        $sitemapUrls[] = [
            'loc' => $currentUrl,
            'lastmod' => date('Y-m-d'),
            'priority' => ($currentUrl == $startUrl) ? '1.0' : '0.8'
        ];

        // Fetch HTML
        $context = stream_context_create(['http' => ['timeout' => 5, 'ignore_errors' => true]]);
        $html = @file_get_contents($currentUrl, false, $context);

        if ($html) {
            $dom = new DOMDocument();
            @$dom->loadHTML($html);
            $links = $dom->getElementsByTagName('a');

            foreach ($links as $link) {
                if (!($link instanceof DOMElement))
                    continue;
                $href = $link->getAttribute('href');

                // Normalize URL
                if (strpos($href, '#') === 0 || strpos($href, 'mailto:') === 0 || strpos($href, 'javascript:') === 0)
                    continue;

                if (strpos($href, '/') === 0) {
                    $href = $rootUrl . $href;
                }

                // Only follow internal links
                if (strpos($href, $rootUrl) === 0 && !in_array($href, $visited) && !in_array($href, $queue)) {
                    // Check common exclusions
                    if (!preg_match('/\.(jpg|jpeg|png|gif|css|js|pdf|zip)$/i', $href)) {
                        $queue[] = $href;
                    }
                }
            }
        }
    }

    // Generate XML
    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    foreach ($sitemapUrls as $urlData) {
        $xml .= "  <url>\n";
        $xml .= "    <loc>" . htmlspecialchars($urlData['loc']) . "</loc>\n";
        $xml .= "    <lastmod>" . $urlData['lastmod'] . "</lastmod>\n";
        $xml .= "    <changefreq>weekly</changefreq>\n";
        $xml .= "    <priority>" . $urlData['priority'] . "</priority>\n";
        $xml .= "  </url>\n";
    }

    $xml .= '</urlset>';

    echo json_encode([
        'success' => true,
        'count' => count($sitemapUrls),
        'xml' => $xml
    ]);
    exit;
}

// Prepare Page UI
$pageInfo = [
    'title' => 'XML Sitemap Generator - ' . SITE_NAME,
    'description' => 'Generate a free XML sitemap for your website instantly. Crawl your internal links and boost your SEO.'
];
include '../includes/header.php';
?>

<style>
    .sitemap-workspace {
        max-width: 900px;
        margin: 3rem auto;
        background: var(--bg-card);
        padding: 2.5rem;
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: var(--shadow-soft);
    }

    .url-input-group {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .url-input-group input {
        flex-grow: 1;
        padding: 1rem 1.5rem;
        background: var(--bg-elevated);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        color: white;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .url-input-group input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(51, 153, 255, 0.15);
    }

    .btn-generate {
        background: var(--gradient-primary);
        color: white;
        border: none;
        padding: 0 2rem;
        border-radius: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .btn-generate:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-glow);
    }

    .btn-generate:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    .status-bar {
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: rgba(51, 153, 255, 0.1);
        border-radius: 12px;
        color: var(--cyan);
        display: none;
        align-items: center;
        gap: 0.5rem;
    }

    .result-area {
        display: none;
        animation: fadeInUp 0.5s ease;
    }

    .xml-preview {
        width: 100%;
        height: 400px;
        background: #1e1e1e;
        color: #d4d4d4;
        padding: 1.5rem;
        border-radius: 16px;
        font-family: 'Consolas', 'Monaco', monospace;
        font-size: 0.9rem;
        overflow: auto;
        border: 1px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 1.5rem;
        resize: vertical;
    }

    .action-row {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    .btn-secondary {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: var(--text-secondary);
        padding: 0.8rem 1.5rem;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-secondary:hover {
        border-color: var(--text-primary);
        color: var(--text-primary);
    }

    .spinner {
        width: 20px;
        height: 20px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-top: 2px solid var(--primary);
        border-radius: 50%;
        animation: spin 1s linear infinite;
        display: inline-block;
    }
</style>

<div class="container" style="text-align: center; padding-top: 4rem;">
    <h1>XML Sitemap Generator</h1>
    <p class="subtitle">Crawl your website and create a fast, Google-friendly sitemap instantly.</p>
</div>

<div class="container sitemap-workspace">
    <div class="url-input-group">
        <input type="url" id="siteUrl" placeholder="Enter your website URL (e.g., https://example.com)" required>
        <button class="btn-generate" onclick="generateSitemap()">
            <span id="btnText">Generate Sitemap</span>
        </button>
    </div>

    <div class="status-bar" id="statusBar">
        <span class="spinner"></span>
        <span id="statusText">Crawling website... This may take up to 30 seconds.</span>
    </div>

    <div class="result-area" id="resultArea">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <h3 style="margin: 0;">Sitemap Preview</h3>
            <span class="badge"
                style="background: rgba(0, 255, 163, 0.1); color: var(--success); padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.85rem;"
                id="pageCount">0 Pages Found</span>
        </div>

        <textarea class="xml-preview" id="xmlOutput" readonly></textarea>

        <div class="action-row">
            <button class="btn-secondary" onclick="copyToClipboard()">Copy XML</button>
            <button class="btn-generate" onclick="downloadSitemap()">Download sitemap.xml</button>
        </div>
    </div>
</div>

<script>
    async function generateSitemap() {
        const urlInput = document.getElementById('siteUrl');
        const url = urlInput.value.trim();
        const btn = document.querySelector('.btn-generate');
        const btnText = document.getElementById('btnText');
        const statusBar = document.getElementById('statusBar');
        const resultArea = document.getElementById('resultArea');

        if (!url) {
            alert('Please enter a valid URL');
            return;
        }

        // Reset UI
        resultArea.style.display = 'none';
        statusBar.style.display = 'flex';
        btn.disabled = true;
        btnText.textContent = 'Processing...';

        try {
            const formData = new FormData();
            formData.append('url', url);

            const response = await fetch('', { // Post to self
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.error) {
                alert(data.error);
                statusBar.style.display = 'none';
            } else {
                document.getElementById('xmlOutput').value = data.xml;
                document.getElementById('pageCount').textContent = data.count + ' Pages Found';

                statusBar.style.display = 'none';
                resultArea.style.display = 'block';
            }
        } catch (e) {
            console.error(e);
            alert('An error occurred while crawling. The site might be blocking bots or took too long to respond.');
            statusBar.style.display = 'none';
        } finally {
            btn.disabled = false;
            btnText.textContent = 'Generate Sitemap';
        }
    }

    function copyToClipboard() {
        const copyText = document.getElementById("xmlOutput");
        copyText.select();
        document.execCommand("copy");
        alert("XML copied to clipboard!");
    }

    function downloadSitemap() {
        const xmlContent = document.getElementById("xmlOutput").value;
        const blob = new Blob([xmlContent], { type: "text/xml" });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement("a");
        a.href = url;
        a.download = "sitemap.xml";
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        document.body.removeChild(a);
    }
</script>

<?php include '../includes/footer.php'; ?>