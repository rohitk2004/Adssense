<?php
include '../includes/config.php';
$pageInfo = [
    'title' => 'Free SEO Tools - ' . SITE_NAME,
    'description' => 'A collection of free SEO and content tools including Paraphraser, Text to HTML Converter, and Content Replacer.'
];
include '../includes/header.php';
?>

<style>
    .tools-hero {
        text-align: center;
        padding: 4rem 0 3rem;
        position: relative;
    }

    .tools-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
        padding-bottom: 4rem;
    }

    .tool-card {
        background: var(--bg-card);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 20px;
        padding: 2.5rem;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .tool-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient-primary);
        transform: scaleX(0);
        transition: transform 0.4s ease;
        transform-origin: left;
    }

    .tool-card:hover::before {
        transform: scaleX(1);
    }

    .tool-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-soft), 0 0 30px rgba(138, 80, 255, 0.2);
        border-color: rgba(138, 80, 255, 0.3);
    }

    .tool-icon {
        font-size: 3rem;
        margin-bottom: 1.5rem;
        background: var(--gradient-cyan);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .tool-card h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: var(--text-primary);
    }

    .tool-card p {
        color: var(--text-secondary);
        margin-bottom: 2rem;
        flex-grow: 1;
    }

    .btn-tool {
        display: inline-block;
        padding: 0.8rem 1.5rem;
        background: rgba(51, 153, 255, 0.1);
        color: var(--cyan);
        text-decoration: none;
        border-radius: 12px;
        font-weight: 600;
        border: 1px solid rgba(51, 153, 255, 0.2);
        transition: all 0.3s ease;
        text-align: center;
    }

    .btn-tool:hover {
        background: var(--gradient-primary);
        color: white;
        border-color: transparent;
        box-shadow: 0 4px 15px rgba(51, 153, 255, 0.4);
    }
</style>

<div class="container">
    <div class="tools-hero">
        <h1>Free Advance SEO & Content Tools</h1>
        <p class="subtitle">Boost your productivity with our suite of free online tools.</p>
    </div>

    <div class="tools-grid">
        <!-- Social Bookmarking Tool -->
        <div class="tool-card">
            <div class="tool-icon">🚀</div>
            <h3>Social Bookmarking</h3>
            <p>Automate your SEO workflow. Submit URLs to top bookmarking sites instantly to boost search rankings.</p>
            <a href="bookmarking-tool.php" class="btn-tool">Launch Tool</a>
        </div>

        <!-- Paraphraser Tool -->
        <div class="tool-card">
            <div class="tool-icon">✍️</div>
            <h3>Paraphraser</h3>
            <p>Rewrite sentences and paragraphs to improve clarity and avoid plagiarism. Perfect for content creators.
            </p>
            <a href="paraphraser.php" class="btn-tool">Launch Tool</a>
        </div>

        <!-- Text to HTML Tool -->
        <div class="tool-card">
            <div class="tool-icon">code</div>
            <h3>Text to HTML Converter</h3>
            <p>Convert plain text into clean, formatted HTML code instantly. Preserves paragraphs and structure.</p>
            <a href="text-to-html.php" class="btn-tool">Launch Tool</a>
        </div>

        <!-- Content Replacer Tool -->
        <div class="tool-card">
            <div class="tool-icon">🔄</div>
            <h3>Content Replacer</h3>
            <p>Find and replace text across large content blocks efficiently. Case-sensitive and global replacement
                options.</p>
            <a href="content-replacer.php" class="btn-tool">Launch Tool</a>
        </div>

        <!-- Sitemap Generator Tool -->
        <div class="tool-card">
            <div class="tool-icon">🗺️</div>
            <h3>Sitemap Generator</h3>
            <p>Crawl your website to create an XML sitemap instantly. Improve your Google indexing speed.</p>
            <a href="sitemap-generator.php" class="btn-tool">Launch Tool</a>
        </div>

        <!-- Word Counter Tool -->
        <div class="tool-card">
            <div class="tool-icon">📝</div>
            <h3>Word Counter</h3>
            <p>Count words, characters, sentences, and paragraphs in real-time. Analyze reading and speaking time.</p>
            <a href="word-counter.php" class="btn-tool">Launch Tool</a>
        </div>

        <!-- Document Converter Tool -->
        <div class="tool-card">
            <div class="tool-icon">📄</div>
            <h3>PDF & Word Converter</h3>
            <p>Convert PDF to Word and Word to PDF instantly in your browser. Secure, fast, and 100% free.</p>
            <a href="pdf-converter.php" class="btn-tool">Launch Tool</a>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>