<?php
$pageInfo = [
    'title' => 'SEO Knowledge Hub - ' . SITE_NAME,
    'description' => 'Expert guides and articles on SEO, social bookmarking, and search engine ranking strategies for 2026.'
];
include '../includes/header.php';
?>

<style>
    /* Articles Page Specific Styles */
    .articles-hero {
        text-align: center;
        padding: 4rem 0 3rem;
        position: relative;
    }

    .articles-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(138, 80, 255, 0.2) 0%, transparent 70%);
        pointer-events: none;
        z-index: 0;
    }

    .articles-hero h1 {
        position: relative;
        z-index: 1;
    }

    .articles-hero .subtitle {
        position: relative;
        z-index: 1;
    }

    .article-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
        padding-bottom: 4rem;
    }

    .article-card {
        background: var(--bg-card);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 20px;
        padding: 2rem;
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        display: flex;
        flex-direction: column;
    }

    .article-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient-primary);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .article-card::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at var(--mouse-x, 50%) var(--mouse-y, 50%),
                rgba(138, 80, 255, 0.1) 0%,
                transparent 50%);
        opacity: 0;
        transition: opacity 0.4s ease;
        pointer-events: none;
    }

    .article-card:hover::before {
        transform: scaleX(1);
    }

    .article-card:hover::after {
        opacity: 1;
    }

    .article-card:hover {
        transform: translateY(-8px);
        border-color: rgba(138, 80, 255, 0.3);
        box-shadow:
            0 20px 40px rgba(0, 0, 0, 0.4),
            0 0 40px rgba(138, 80, 255, 0.3);
    }

    .article-category {
        display: inline-block;
        padding: 0.4rem 1rem;
        background: rgba(138, 80, 255, 0.15);
        border: 1px solid rgba(138, 80, 255, 0.3);
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 1.5rem;
        color: var(--accent);
    }

    .article-card h3 {
        font-size: 1.4rem;
        font-weight: 800;
        line-height: 1.3;
        margin-bottom: 1rem;
        color: var(--text-primary);
        transition: all 0.3s ease;
    }

    .article-card h3 a {
        text-decoration: none;
        color: inherit;
        background: linear-gradient(135deg, var(--text-primary) 0%, var(--cyan) 100%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        background-size: 200% 100%;
        background-position: 0% 0%;
        transition: background-position 0.4s ease;
    }

    .article-card:hover h3 a {
        background-position: 100% 0%;
    }

    .article-excerpt {
        color: var(--text-secondary);
        font-size: 1rem;
        line-height: 1.7;
        margin-bottom: 1.5rem;
        flex-grow: 1;
    }

    .article-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .article-meta-item {
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .article-meta-icon {
        font-size: 0.9rem;
    }

    .read-more-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--cyan);
        font-weight: 700;
        font-size: 0.95rem;
        text-decoration: none;
        position: relative;
        transition: all 0.3s ease;
        margin-top: auto;
    }

    .read-more-link::after {
        content: '→';
        transition: transform 0.3s ease;
    }

    .article-card:hover .read-more-link {
        color: var(--primary);
        gap: 0.8rem;
    }

    .article-card:hover .read-more-link::after {
        transform: translateX(5px);
    }

    @media (max-width: 768px) {
        .article-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .articles-hero {
            padding: 2rem 0;
        }

        .article-card {
            padding: 1.5rem;
        }
    }
</style>

<div class="container">
    <div class="articles-hero">
        <h1>SEO Knowledge Hub</h1>
        <p class="subtitle">Master the art of search engine optimization with expert insights and proven strategies.</p>
    </div>

    <div class="article-grid">

        <!-- Article 1 -->
        <div class="article-card">
            <span class="article-category">🚀 Trending</span>
            <h3><a href="social-bookmarking-2026.php">How Social Bookmarking Affects Search Rankings in 2026</a></h3>
            <div class="article-meta">
                <span class="article-meta-item">
                    <span class="article-meta-icon">📅</span>
                    <span>Feb 2026</span>
                </span>
                <span class="article-meta-item">
                    <span class="article-meta-icon">⏱</span>
                    <span>8 min read</span>
                </span>
            </div>
            <p class="article-excerpt">
                Discover the evolving role of social bookmarking in modern SEO. Learn how to leverage these platforms
                effectively to boost your search rankings and drive organic traffic.
            </p>
            <a href="social-bookmarking-2026.php" class="read-more-link">Read Full Article</a>
        </div>

        <!-- Article 2 -->
        <div class="article-card">
            <span class="article-category">⚡ Essential</span>
            <h3><a href="white-hat-vs-black-hat.php">White Hat vs. Black Hat Indexing Strategies</a></h3>
            <div class="article-meta">
                <span class="article-meta-item">
                    <span class="article-meta-icon">📅</span>
                    <span>Feb 2026</span>
                </span>
                <span class="article-meta-item">
                    <span class="article-meta-icon">⏱</span>
                    <span>10 min read</span>
                </span>
            </div>
            <p class="article-excerpt">
                Stay safe from Google penalties by understanding the crucial differences between ethical and risky SEO
                tactics. Make informed decisions for long-term success.
            </p>
            <a href="white-hat-vs-black-hat.php" class="read-more-link">Read Full Article</a>
        </div>

        <!-- Article 3 -->
        <div class="article-card">
            <span class="article-category">📚 Deep Dive</span>
            <h3><a href="seo-evolution.php">The Evolution of SEO: Keywords to User Intent</a></h3>
            <div class="article-meta">
                <span class="article-meta-item">
                    <span class="article-meta-icon">📅</span>
                    <span>Jan 2026</span>
                </span>
                <span class="article-meta-item">
                    <span class="article-meta-icon">⏱</span>
                    <span>12 min read</span>
                </span>
            </div>
            <p class="article-excerpt">
                Trace the fascinating history of SEO and understand why User Intent has become the #1 ranking factor.
                Adapt your strategy for the modern search landscape.
            </p>
            <a href="seo-evolution.php" class="read-more-link">Read Full Article</a>
        </div>

        <!-- Article 4 -->
        <div class="article-card">
            <span class="article-category">🔧 Tools</span>
            <h3><a href="automated-tools-importance.php">Why Automated SEO Tools are Essential</a></h3>
            <div class="article-meta">
                <span class="article-meta-item">
                    <span class="article-meta-icon">📅</span>
                    <span>Jan 2026</span>
                </span>
                <span class="article-meta-item">
                    <span class="article-meta-icon">⏱</span>
                    <span>7 min read</span>
                </span>
            </div>
            <p class="article-excerpt">
                Scale your agency's efforts efficiently with the right automation tools. Learn which tasks to automate
                and which require human oversight for optimal results.
            </p>
            <a href="automated-tools-importance.php" class="read-more-link">Read Full Article</a>
        </div>

        <!-- Article 5 -->
        <div class="article-card">
            <span class="article-category">⚠️ Critical</span>
            <h3><a href="thin-content-penalty.php">Understanding "Thin Content" Penalties</a></h3>
            <div class="article-meta">
                <span class="article-meta-item">
                    <span class="article-meta-icon">📅</span>
                    <span>Dec 2025</span>
                </span>
                <span class="article-meta-item">
                    <span class="article-meta-icon">⏱</span>
                    <span>9 min read</span>
                </span>
            </div>
            <p class="article-excerpt">
                Learn how to wrap your tools in high-value content to avoid AdSense rejection. Discover proven
                strategies to create content that Google rewards, not penalizes.
            </p>
            <a href="thin-content-penalty.php" class="read-more-link">Read Full Article</a>
        </div>

        <!-- Article 6 - Bonus -->
        <div class="article-card">
            <span class="article-category">💡 Pro Tips</span>
            <h3><a href="#">Backlink Building Strategies That Actually Work</a></h3>
            <div class="article-meta">
                <span class="article-meta-item">
                    <span class="article-meta-icon">📅</span>
                    <span>Coming Soon</span>
                </span>
                <span class="article-meta-item">
                    <span class="article-meta-icon">⏱</span>
                    <span>15 min read</span>
                </span>
            </div>
            <p class="article-excerpt">
                Master the art of acquiring high-quality backlinks through white-hat techniques. Learn from real case
                studies and proven strategies that deliver results.
            </p>
            <a href="#" class="read-more-link">Coming Soon</a>
        </div>

    </div>
</div>

<?php include '../includes/footer.php'; ?>