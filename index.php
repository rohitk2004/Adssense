<?php
include 'includes/config.php';
$pageInfo = [
    'title' => SITE_NAME . ' - Advanced SEO & Content Tools',
    'description' => 'Master the digital landscape with advanced SEO strategies, automated bookmarking, and AI-powered content creation tools.'
];
include 'includes/header.php';
?>

<style>
    /* Homepage Specific Styles */
    /* 3D Floating Animation */
    @keyframes float {
        0% {
            transform: translateY(0px) rotate(0deg);
        }

        50% {
            transform: translateY(-20px) rotate(2deg);
        }

        100% {
            transform: translateY(0px) rotate(0deg);
        }
    }

    .floating-element {
        animation: float 6s ease-in-out infinite;
        position: absolute;
        z-index: 1;
        opacity: 0.6;
        pointer-events: none;
    }

    .hero-section {
        padding: 10rem 0 8rem;
        text-align: center;
        position: relative;
        overflow: hidden;
        perspective: 1000px;
    }

    .hero-content {
        position: relative;
        z-index: 10;
        transform-style: preserve-3d;
        transition: transform 0.5s;
    }

    .hero-section h1 {
        font-size: clamp(3.5rem, 8vw, 6rem);
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 1.5rem;
        line-height: 1.1;
        text-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }

    .hero-section .subtitle {
        font-size: 1.25rem;
        max-width: 800px;
        margin: 0 auto 3rem;
        color: var(--text-secondary);
    }

    .feature-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2.5rem;
        margin-top: 4rem;
    }

    .feature-card {
        background: var(--bg-card);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 24px;
        padding: 3rem 2rem;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        text-align: left;
    }

    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--gradient-primary);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-glow);
        border-color: rgba(138, 80, 255, 0.3);
    }

    .feature-card:hover::before {
        opacity: 1;
    }

    .feature-icon {
        font-size: 3.5rem;
        margin-bottom: 1.5rem;
        display: inline-block;
        background: var(--bg-elevated);
        width: 80px;
        height: 80px;
        line-height: 80px;
        text-align: center;
        border-radius: 20px;
        box-shadow: var(--shadow-soft);
    }

    .feature-card h3 {
        font-size: 1.8rem;
        margin-bottom: 1rem;
        color: var(--text-primary);
    }

    .feature-card p {
        color: var(--text-secondary);
        font-size: 1.05rem;
        line-height: 1.7;
        margin-bottom: 2rem;
    }

    .btn-cta {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 1rem 2.5rem;
        background: var(--gradient-primary);
        color: white;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1.1rem;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-glow);
    }

    .btn-cta:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-glow-strong);
    }

    .btn-link {
        color: var(--cyan);
        text-decoration: none;
        font-weight: 700;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: gap 0.3s ease;
    }

    .btn-link:hover {
        gap: 10px;
        color: var(--primary);
    }

    .stats-section {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        margin: 6rem 0;
        padding: 3rem;
        background: var(--bg-elevated);
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.05);
        text-align: center;
    }

    .stat-item h4 {
        font-size: 3rem;
        font-weight: 900;
        background: var(--gradient-cyan);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 0.5rem;
    }

    .stat-item p {
        color: var(--text-muted);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .stats-section {
            grid-template-columns: 1fr;
            gap: 3rem;
        }

        .hero-section {
            padding: 4rem 0;
        }
    }
</style>

<section class="hero-section" id="vanta-hero">
    <div class="container" style="position: relative; z-index: 10;">
        <h1>Rank Higher with <br>Advanced Automation</h1>
        <p class="subtitle">The complete toolkit for modern SEO professionals. Automate bookmarking, generate unique
            content, and index pages faster than ever before.</p>

        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="/tools/" class="btn-cta">Start Using Tools</a>
            <a href="#features" class="btn-cta"
                style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); box-shadow: none;">Learn
                More</a>
        </div>
    </div>
</section>

<!-- Load Three.js and Vanta.js from CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.globe.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        VANTA.GLOBE({
            el: "#vanta-hero",
            mouseControls: true,
            touchControls: true,
            gyroControls: false,
            minHeight: 200.00,
            minWidth: 200.00,
            scale: 1.00,
            scaleMobile: 1.00,
            color: 0x3399ff,
            color2: 0x8a50ff,
            backgroundColor: 0x0b0f19,
            size: 1.2
        })
    });
</script>

<section id="features" style="padding: 4rem 0;">
    <div class="container">
        <div class="feature-grid">

            <!-- Bookmarking & Indexing Feature -->
            <div class="feature-card">
                <div class="feature-icon">🚀</div>
                <h3>Bookmarking & Indexing</h3>
                <p>Social signals are crucial for rapid indexing. Our automated bookmarking engine submits your URLs to
                    high-authority platforms, signaling Google to crawl your new content immediately. Don't wait weeks
                    for indexing—get it done in hours.</p>
                <ul style="list-style: none; margin-bottom: 2rem; color: var(--text-muted);">
                    <li>✅ Instant Crawl Signals</li>
                    <li>✅ High DA/PA Backlinks</li>
                    <li>✅ Automated Submission Workflow</li>
                </ul>
                <a href="/tools/bookmarking-tool.php" class="btn-link">Try Bookmarking Tool →</a>
            </div>

            <!-- Content Creation Feature -->
            <div class="feature-card">
                <div class="feature-icon">✍️</div>
                <h3>Advanced Content Creation</h3>
                <p>Google rewards unique, valuable content. Our AI-driven paraphrasing and content tools help you
                    rewrite and optimize text to pass plagiarism checks while maintaining readability and SEO value.
                    Perfect for scaling your content strategy efficiently.</p>
                <ul style="list-style: none; margin-bottom: 2rem; color: var(--text-muted);">
                    <li>✅ Context-Aware Paraphrasing</li>
                    <li>✅ Plagiarism-Free Output</li>
                    <li>✅ Maintain Original Meaning</li>
                </ul>
                <a href="/tools/paraphraser.php" class="btn-link">Try Content Tools →</a>
            </div>

            <!-- Advanced SEO Feature -->
            <div class="feature-card">
                <div class="feature-icon">🎯</div>
                <h3>Technical SEO Mastery</h3>
                <p>Beyond content and links, structure matters. Use our text-to-HTML and content replacer utilities to
                    clean up your code, format text properly for rich snippets, and manage large-scale site updates
                    without breaking a sweat.</p>
                <ul style="list-style: none; margin-bottom: 2rem; color: var(--text-muted);">
                    <li>✅ Clean HTML Generation</li>
                    <li>✅ Bulk Content Management</li>
                    <li>✅ Optimized for Snippets</li>
                </ul>
                <a href="/tools/text-to-html.php" class="btn-link">Explore Utilities →</a>
            </div>

        </div>

    </div>
</section>

<section style="padding-bottom: 6rem;">
    <div class="container">
        <div class="stats-section">
            <div class="stat-item">
                <h4>100%</h4>
                <p>Free to Use</p>
            </div>
            <div class="stat-item">
                <h4>24/7</h4>
                <p>Automated Uptime</p>
            </div>
            <div class="stat-item">
                <h4>3+</h4>
                <p>Advanced Tools</p>
            </div>
        </div>

        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <h2 style="font-size: 2.5rem; margin-bottom: 1.5rem;">Ready to Dominate the SERPs?</h2>
            <p style="color: var(--text-secondary); margin-bottom: 2rem; font-size: 1.2rem;">
                Join thousands of SEOs who use our platform to streamline their daily workflows.
                No credit card required—just powerful tools at your fingertips.
            </p>
            <a href="/tools/" class="btn-cta">Access All Tools Now</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>