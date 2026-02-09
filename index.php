<?php
$pageInfo = [
    'title' => SITE_NAME . ' - ' . SITE_TAGLINE,
    'description' => SITE_DESCRIPTION
];
include 'includes/header.php';
?>

<section class="tool-section">
    <div class="container">
        <h1>Automated Social Bookmarking Tool</h1>
        <p class="subtitle">Streamline your SEO workflow with our intelligent submission engine.</p>

        <div class="iframe-container">
            <div class="loading-spinner" id="spinner">
                <div class="spinner-icon"></div>
                <p>Connecting to Secure Server...</p>
            </div>
            <!-- Embedded Streamlit App with branding hidden -->
            <iframe
                src="https://bookmarking-automation-snz4o5v6yykdgsclt5fxcw.streamlit.app/?embed=true&embed_options=show_toolbar:false,show_colored_line:false,show_footer:false"
                frameborder="0" onload="document.getElementById('spinner').style.display='none';"
                allow="clipboard-read; clipboard-write" style="border: none; overflow: hidden;"></iframe>
        </div>
    </div>
</section>

<!-- The "Matter" - High Value Content Section -->
<section class="content-matter" id="about">
    <div class="container">
        <h2>Why Use Automated Bookmarking in 2026?</h2>
        <p>Social bookmarking remains a vital strategy for improving search engine visibility. By creating backlinks
            from reputable bookmarking sites, you signal to search engines that your content is valuable and worth
            indexing.</p>

        <div style="display: flex; gap: 2rem; margin-top: 2rem;">
            <div style="flex: 1;">
                <h3>Key Benefits</h3>
                <ul>
                    <li><strong>Faster Indexing:</strong> Get your new pages discovered by Google bots quicker.</li>
                    <li><strong>Authority Building:</strong> Increase your domain authority with diverse link sources.
                    </li>
                    <li><strong>Traffic Generation:</strong> Drive direct traffic from bookmarking communities.</li>
                </ul>
            </div>
            <div style="flex: 1;">
                <h3>Latest Insights</h3>
                <ul style="margin-bottom: 1rem;">
                    <li><a href="/articles/social-bookmarking-2026.php">How Social Bookmarking Affects Search
                            Rankings</a></li>
                    <li><a href="/articles/white-hat-vs-black-hat.php">White Hat vs. Black Hat Strategies</a></li>
                    <li><a href="/articles/seo-evolution.php">The Evolution of SEO</a></li>
                    <li><a href="/articles/automated-tools-importance.php">Why Automation is Essential</a></li>
                </ul>
                <a href="/articles/index.php"
                    style="color: var(--primary-color); font-weight: 600; text-decoration: none;">View All Articles
                    &rarr;</a>
            </div>
        </div>

        <h3>How This Tool Works</h3>
        <p>Our tool automates the tedious process of submitting your URLs to top social bookmarking platforms. It
            handles the form filling, category selection, and submission process, saving you hours of manual work.</p>
    </div>
</section>

<script>
    // Additional script to hide Streamlit footer
    window.addEventListener('load', function () {
        const iframe = document.querySelector('iframe[src*="streamlit"]');
        if (iframe) {
            // Wait for iframe to fully load
            iframe.onload = function () {
                try {
                    // Hide the spinner
                    const spinner = document.getElementById('spinner');
                    if (spinner) spinner.style.display = 'none';

                    // Attempt to inject CSS to hide Streamlit footer
                    // Note: This may not work due to CORS restrictions
                    const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
                    const style = iframeDoc.createElement('style');
                    style.textContent = `
                    footer {
                        display: none !important;
                    }
                    .css-1v0mbdj, .css-vurnku {
                        display: none !important;
                    }
                    [data-testid="stDecoration"] {
                        display: none !important;
                    }
                `;
                    iframeDoc.head.appendChild(style);
                } catch (e) {
                    // CORS restriction - iframe from different origin
                    console.log('Cannot access iframe due to CORS policy');
                }
            };
        }
    });
</script>

<?php include 'includes/footer.php'; ?>