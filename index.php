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
        font-size: 1.3rem;
        max-width: 800px;
        margin: 0 auto 3rem;
        color: var(--text-secondary);
        line-height: 1.8;
        text-shadow: 0 2px 10px rgba(51, 153, 255, 0.3);
    }

    html {
        scroll-behavior: smooth;
    }

    .feature-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2.5rem;
        margin-top: 4rem;
    }

    .feature-card {
        background: linear-gradient(135deg, rgba(20, 20, 30, 0.8) 0%, rgba(30, 30, 45, 0.6) 100%);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 24px;
        padding: 3rem 2rem;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        text-align: left;
        backdrop-filter: blur(10px);
    }

    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, #3399ff, #8a50ff, #00ffa3);
        opacity: 0;
        transition: opacity 0.5s ease;
        z-index: -1;
        filter: blur(20px);
    }

    .feature-card::after {
        content: '';
        position: absolute;
        inset: 0;
        padding: 2px;
        border-radius: 24px;
        background: linear-gradient(135deg, transparent, rgba(51, 153, 255, 0.3), transparent);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .feature-card:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: 0 30px 60px rgba(51, 153, 255, 0.3), 0 0 40px rgba(138, 80, 255, 0.2);
        border-color: rgba(138, 80, 255, 0.5);
    }

    .feature-card:hover::before {
        opacity: 0.1;
    }

    .feature-card:hover::after {
        opacity: 1;
    }

    .feature-icon {
        font-size: 3.5rem;
        margin-bottom: 1.5rem;
        display: inline-block;
        background: linear-gradient(135deg, rgba(51, 153, 255, 0.1), rgba(138, 80, 255, 0.1));
        width: 80px;
        height: 80px;
        line-height: 80px;
        text-align: center;
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(51, 153, 255, 0.2);
        border: 1px solid rgba(51, 153, 255, 0.2);
        transition: all 0.3s ease;
    }

    .feature-card:hover .feature-icon {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 12px 48px rgba(51, 153, 255, 0.4);
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
        padding: 1.2rem 3rem;
        background: linear-gradient(135deg, #3399ff 0%, #8a50ff 100%);
        color: white;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.1rem;
        text-decoration: none;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 10px 40px rgba(51, 153, 255, 0.4);
        position: relative;
        overflow: hidden;
    }

    .btn-cta::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s ease;
    }

    .btn-cta:hover::before {
        left: 100%;
    }


    .btn-cta:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 15px 60px rgba(51, 153, 255, 0.6), 0 0 30px rgba(138, 80, 255, 0.4);
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.7;
        }
    }

    .stat-item {
        position: relative;
    }

    .stat-item::before {
        content: '';
        position: absolute;
        inset: -10px;
        background: radial-gradient(circle, rgba(51, 153, 255, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        animation: pulse 2s ease-in-out infinite;
        z-index: -1;
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
        background: linear-gradient(135deg, rgba(20, 20, 30, 0.8) 0%, rgba(30, 30, 45, 0.6) 100%);
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
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

    /* Custom Cursor Effect */
    * {
        cursor: none !important;
    }

    .custom-cursor {
        position: fixed;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: rgba(51, 153, 255, 0.8);
        pointer-events: none;
        z-index: 9999;
        mix-blend-mode: screen;
        transition: transform 0.2s ease, opacity 0.2s ease;
        box-shadow: 0 0 20px rgba(51, 153, 255, 0.8), 0 0 40px rgba(51, 153, 255, 0.4);
    }

    .custom-cursor-outer {
        position: fixed;
        width: 40px;
        height: 40px;
        border: 2px solid rgba(138, 80, 255, 0.5);
        border-radius: 50%;
        pointer-events: none;
        z-index: 9998;
        transition: transform 0.15s ease;
        animation: cursorPulse 2s ease-in-out infinite;
    }

    @keyframes cursorPulse {

        0%,
        100% {
            transform: scale(1);
            opacity: 1;
        }

        50% {
            transform: scale(1.2);
            opacity: 0.8;
        }
    }

    .custom-cursor.clicked {
        transform: scale(0.8);
    }

    .custom-cursor-outer.hover {
        transform: scale(1.5);
        border-color: rgba(51, 153, 255, 0.8);
    }

    /* Cursor Trail */
    .cursor-trail {
        position: fixed;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(51, 153, 255, 0.6), rgba(138, 80, 255, 0.6));
        pointer-events: none;
        z-index: 9997;
        animation: trailFade 0.8s ease-out forwards;
    }

    @keyframes trailFade {
        to {
            transform: scale(2);
            opacity: 0;
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

        // Custom Cursor Implementation
        const cursor = document.createElement('div');
        cursor.classList.add('custom-cursor');
        document.body.appendChild(cursor);

        const cursorOuter = document.createElement('div');
        cursorOuter.classList.add('custom-cursor-outer');
        document.body.appendChild(cursorOuter);

        let mouseX = 0, mouseY = 0;
        let cursorX = 0, cursorY = 0;
        let outerX = 0, outerY = 0;

        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;

            // Create trailing particles
            if (Math.random() > 0.8) {
                const trail = document.createElement('div');
                trail.classList.add('cursor-trail');
                trail.style.left = e.clientX + 'px';
                trail.style.top = e.clientY + 'px';
                document.body.appendChild(trail);

                setTimeout(() => {
                    trail.remove();
                }, 800);
            }
        });

        // Smooth cursor animation
        function animateCursor() {
            // Inner cursor follows closely
            cursorX += (mouseX - cursorX) * 0.2;
            cursorY += (mouseY - cursorY) * 0.2;
            cursor.style.left = cursorX - 10 + 'px';
            cursor.style.top = cursorY - 10 + 'px';

            // Outer ring follows with delay
            outerX += (mouseX - outerX) * 0.1;
            outerY += (mouseY - outerY) * 0.1;
            cursorOuter.style.left = outerX - 20 + 'px';
            cursorOuter.style.top = outerY - 20 + 'px';

            requestAnimationFrame(animateCursor);
        }
        animateCursor();

        // Click effect
        document.addEventListener('mousedown', () => {
            cursor.classList.add('clicked');
        });

        document.addEventListener('mouseup', () => {
            cursor.classList.remove('clicked');
        });

        // Hover effect on interactive elements
        const interactiveElements = document.querySelectorAll('a, button, .btn-cta, .btn-link, .tool-box');
        interactiveElements.forEach(el => {
            el.addEventListener('mouseenter', () => {
                cursorOuter.classList.add('hover');
                cursor.style.transform = 'scale(1.5)';
            });
            el.addEventListener('mouseleave', () => {
                cursorOuter.classList.remove('hover');
                cursor.style.transform = 'scale(1)';
            });
        });
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

<!-- Featured Tools Section -->
<section
    style="padding: 6rem 0; background: linear-gradient(135deg, rgba(10, 10, 20, 0.9) 0%, rgba(20, 20, 35, 0.8) 100%);">
    <div class="container">
        <div style="text-align: center; margin-bottom: 4rem;">
            <h2
                style="font-size: 3rem; margin-bottom: 1rem; background: var(--gradient-primary); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;">
                Our Tools Arsenal
            </h2>
            <p style="color: var(--text-secondary); font-size: 1.2rem; max-width: 700px; margin: 0 auto;">
                Everything you need to dominate search rankings and streamline content creation
            </p>
        </div>

        <style>
            @keyframes slideInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .tool-showcase-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 2rem;
            }

            .tool-box {
                background: linear-gradient(135deg, rgba(30, 30, 45, 0.6) 0%, rgba(20, 20, 30, 0.8) 100%);
                border: 1px solid rgba(255, 255, 255, 0.05);
                border-radius: 20px;
                padding: 2rem;
                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
                animation: slideInUp 0.6s ease-out backwards;
                cursor: pointer;
            }

            .tool-box:nth-child(1) {
                animation-delay: 0.1s;
            }

            .tool-box:nth-child(2) {
                animation-delay: 0.2s;
            }

            .tool-box:nth-child(3) {
                animation-delay: 0.3s;
            }

            .tool-box:nth-child(4) {
                animation-delay: 0.4s;
            }

            .tool-box:nth-child(5) {
                animation-delay: 0.5s;
            }

            .tool-box:nth-child(6) {
                animation-delay: 0.6s;
            }

            .tool-box:nth-child(7) {
                animation-delay: 0.7s;
            }

            .tool-box:nth-child(8) {
                animation-delay: 0.8s;
            }

            .tool-box::before {
                content: '';
                position: absolute;
                top: 50%;
                left: 50%;
                width: 0;
                height: 0;
                border-radius: 50%;
                background: radial-gradient(circle, rgba(51, 153, 255, 0.2), transparent);
                transition: width 0.6s, height 0.6s, top 0.6s, left 0.6s;
            }

            .tool-box:hover::before {
                width: 300px;
                height: 300px;
                top: calc(50% - 150px);
                left: calc(50% - 150px);
            }

            .tool-box:hover {
                transform: translateY(-10px) scale(1.03);
                border-color: rgba(51, 153, 255, 0.4);
                box-shadow: 0 20px 60px rgba(51, 153, 255, 0.3), 0 0 40px rgba(138, 80, 255, 0.2);
            }

            .tool-box-icon {
                font-size: 3rem;
                margin-bottom: 1rem;
                display: block;
                filter: drop-shadow(0 5px 15px rgba(51, 153, 255, 0.5));
            }

            .tool-box h4 {
                font-size: 1.3rem;
                margin-bottom: 0.8rem;
                color: white;
                position: relative;
                z-index: 1;
            }

            .tool-box p {
                color: var(--text-secondary);
                font-size: 0.95rem;
                line-height: 1.6;
                position: relative;
                z-index: 1;
            }

            .tool-badge {
                display: inline-block;
                padding: 4px 12px;
                background: rgba(0, 255, 163, 0.15);
                color: var(--success);
                border-radius: 20px;
                font-size: 0.75rem;
                font-weight: 600;
                margin-top: 1rem;
                border: 1px solid rgba(0, 255, 163, 0.3);
            }
        </style>

        <div class="tool-showcase-grid">
            <a href="/tools/paraphraser.php" style="text-decoration: none;" class="tool-box">
                <span class="tool-box-icon">✍️</span>
                <h4>AI Paraphraser</h4>
                <p>Rewrite content intelligently with context-aware AI</p>
                <span class="tool-badge">Popular</span>
            </a>

            <a href="/tools/backlink-checker.php" style="text-decoration: none;" class="tool-box">
                <span class="tool-box-icon">🔗</span>
                <h4>Backlink Checker</h4>
                <p>Analyze domain authority and backlink profile</p>
                <span class="tool-badge">SEO Essential</span>
            </a>

            <a href="/tools/sitemap-generator.php" style="text-decoration: none;" class="tool-box">
                <span class="tool-box-icon">🗺️</span>
                <h4>Sitemap Generator</h4>
                <p>Create XML sitemaps for faster indexing</p>
                <span class="tool-badge">Free</span>
            </a>

            <a href="/tools/word-counter.php" style="text-decoration: none;" class="tool-box">
                <span class="tool-box-icon">📝</span>
                <h4>Word Counter</h4>
                <p>Count words, characters with reading time analysis</p>
                <span class="tool-badge">Free</span>
            </a>

            <a href="/tools/pdf-converter.php" style="text-decoration: none;" class="tool-box">
                <span class="tool-box-icon">📄</span>
                <h4>PDF Converter</h4>
                <p>Convert between PDF and Word formats securely</p>
                <span class="tool-badge">Privacy First</span>
            </a>

            <a href="/tools/text-to-html.php" style="text-decoration: none;" class="tool-box">
                <span class="tool-box-icon">🔧</span>
                <h4>Text to HTML</h4>
                <p>Transform plain text into formatted HTML code</p>
                <span class="tool-badge">Free</span>
            </a>

            <a href="/tools/content-replacer.php" style="text-decoration: none;" class="tool-box">
                <span class="tool-box-icon">🔄</span>
                <h4>Content Replacer</h4>
                <p>Find and replace text across large content blocks</p>
                <span class="tool-badge">Free</span>
            </a>

            <a href="/tools/bookmarking-tool.php" style="text-decoration: none;" class="tool-box">
                <span class="tool-box-icon">🚀</span>
                <h4>Social Bookmarking</h4>
                <p>Automate URL submissions for rapid indexing</p>
                <span class="tool-badge">Pro SEO</span>
            </a>
        </div>

        <div style="text-align: center; margin-top: 4rem;">
            <a href="/tools/" class="btn-cta">View All Tools</a>
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
                <h4>8+</h4>
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