<?php
$pageInfo = [
    'title' => 'Privacy Policy - ' . SITE_NAME,
    'description' => 'Privacy Policy for ' . SITE_NAME . '. Learn how we handle your data.'
];
include '../includes/header.php';
?>

<div class="container" style="padding-top: 2rem;">
    <h1>Privacy Policy</h1>
    <p>Last updated: <?php echo date("F j, Y"); ?></p>

    <!-- Content abbreviated for brevity as it was already written, but reusing structure -->
    <h2>1. Introduction</h2>
    <p>Welcome to <?php echo SITE_NAME; ?>. We respect your privacy and are committed to protecting your personal data.
    </p>

    <h2>2. Data We Collect</h2>
    <p>We may collect, use, store and transfer different kinds of personal data about you:</p>
    <ul>
        <li><strong>Identity Data:</strong> includes first name, last name, username.</li>
        <li><strong>Contact Data:</strong> includes email address.</li>
        <li><strong>Usage Data:</strong> includes information about how you use our website and services.</li>
    </ul>

    <h2>3. How We Use Your Data</h2>
    <p>We use your data to provider the bookmarking service, manage your account, and improve our platform.</p>

    <h2>4. Data Security</h2>
    <p>We have put in place appropriate security measures to prevent your personal data from being accidentally lost,
        used or accessed in an unauthorized way.</p>

    <h2>5. Contact Us</h2>
    <p>If you have any questions about this privacy policy, please contact us at: <?php echo CONTACT_EMAIL; ?>.</p>
</div>

<?php include '../includes/footer.php'; ?>