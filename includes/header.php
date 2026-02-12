<?php require_once __DIR__ . '/config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo isset($pageInfo['title']) ? $pageInfo['title'] : SITE_NAME . ' - ' . SITE_TAGLINE; ?>
    </title>
    <meta name="description"
        content="<?php echo isset($pageInfo['description']) ? $pageInfo['description'] : SITE_DESCRIPTION; ?>">
    <meta name="keywords" content="<?php echo SITE_KEYWORDS; ?>">
    <meta name="author" content="<?php echo SITE_NAME; ?>">

    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo SITE_URL . $_SERVER['REQUEST_URI']; ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo SITE_URL . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:title" content="<?php echo isset($pageInfo['title']) ? $pageInfo['title'] : SITE_NAME; ?>">
    <meta property="og:description"
        content="<?php echo isset($pageInfo['description']) ? $pageInfo['description'] : SITE_DESCRIPTION; ?>">
    <meta property="og:site_name" content="<?php echo SITE_NAME; ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo SITE_URL . $_SERVER['REQUEST_URI']; ?>">
    <meta property="twitter:title" content="<?php echo isset($pageInfo['title']) ? $pageInfo['title'] : SITE_NAME; ?>">
    <meta property="twitter:description"
        content="<?php echo isset($pageInfo['description']) ? $pageInfo['description'] : SITE_DESCRIPTION; ?>">

    <!-- Favicon (add your favicon files) -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="/assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>

    <header class="site-header">
        <div class="container">
            <div class="logo">
                <a href="/"><?php echo SITE_NAME; ?></a>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/#about">About</a></li>
                    <li><a href="/articles/">Articles</a></li>
                    <li><a href="/tools/">Tools</a></li>
                    <li><a href="/legal/contact.php">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="main-content">