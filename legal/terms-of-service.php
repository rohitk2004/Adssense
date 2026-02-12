<?php
include '../includes/config.php';
$pageInfo = [
    'title' => 'Terms of Service - ' . SITE_NAME,
    'description' => 'Terms of Service for using ' . SITE_NAME . '.'
];
include '../includes/header.php';
?>

<div class="container" style="padding-top: 2rem;">
    <h1>Terms of Service</h1>
    <p>Last updated: <?php echo date("F j, Y"); ?></p>

    <h2>1. Acceptance of Terms</h2>
    <p>By accessing and using <?php echo SITE_NAME; ?>, you accept and agree to be bound by the terms and provision of
        this agreement.</p>

    <h2>2. Use of License</h2>
    <p>Permission is granted to temporarily download one copy of the materials on <?php echo SITE_NAME; ?>'s website for
        personal, non-commercial transitory viewing only.</p>

    <h2>3. Disclaimer</h2>
    <p>The materials on <?php echo SITE_NAME; ?>'s website are provided on an 'as is' basis. <?php echo SITE_NAME; ?>
        makes no warranties, expressed or implied.</p>

    <h2>4. Limitations</h2>
    <p>In no event shall <?php echo SITE_NAME; ?> or its suppliers be liable for any damages arising out of the use or
        inability to use the materials on <?php echo SITE_NAME; ?>'s website.</p>
</div>

<?php include '../includes/footer.php'; ?>