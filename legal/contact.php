<?php
$message_sent = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message_sent = true;
}
$pageInfo = [
    'title' => 'Contact Us - ' . SITE_NAME,
    'description' => 'Get in touch with the ' . SITE_NAME . ' team.'
];
include '../includes/header.php';
?>

<style>
    /* Contact Page Specific Styles */
    .contact-hero {
        text-align: center;
        padding: 4rem 0 3rem;
        position: relative;
    }

    .contact-hero::before {
        content: '';
        position: absolute;
        top: -100px;
        left: 50%;
        transform: translateX(-50%);
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(51, 153, 255, 0.2) 0%, transparent 70%);
        pointer-events: none;
        z-index: 0;
    }

    .contact-hero h1 {
        position: relative;
        z-index: 1;
    }

    .contact-hero p {
        position: relative;
        z-index: 1;
        color: var(--text-secondary);
        font-size: 1.2rem;
        margin-bottom: 0;
    }

    .success-message {
        background: linear-gradient(135deg, rgba(0, 255, 163, 0.1) 0%, rgba(0, 204, 255, 0.1) 100%);
        border: 1px solid rgba(0, 255, 163, 0.3);
        color: var(--success);
        padding: 1.5rem;
        border-radius: 16px;
        margin-bottom: 2rem;
        text-align: center;
        font-weight: 600;
        font-size: 1.05rem;
        animation: slideInDown 0.5s ease;
        box-shadow: 0 8px 20px rgba(0, 255, 163, 0.15);
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .contact-form-container {
        max-width: 650px;
        margin: 0 auto;
        padding-bottom: 4rem;
    }

    .contact-form {
        background: var(--bg-card);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        padding: 3rem;
        position: relative;
        overflow: hidden;
        box-shadow:
            0 20px 40px rgba(0, 0, 0, 0.3),
            0 0 40px rgba(138, 80, 255, 0.2);
    }

    .contact-form::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient-primary);
    }

    .contact-form::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 50% 0%,
                rgba(138, 80, 255, 0.05) 0%,
                transparent 60%);
        pointer-events: none;
    }

    .form-group {
        margin-bottom: 2rem;
        position: relative;
        z-index: 1;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.75rem;
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--text-primary);
        letter-spacing: 0.02em;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 1rem 1.25rem;
        background: var(--bg-elevated);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        color: var(--text-primary);
        font-size: 1rem;
        font-family: inherit;
        transition: all 0.3s ease;
        outline: none;
    }

    .form-group input::placeholder,
    .form-group textarea::placeholder {
        color: var(--text-muted);
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: var(--primary);
        background: var(--bg-card);
        box-shadow:
            0 0 0 4px rgba(51, 153, 255, 0.1),
            0 8px 16px rgba(0, 0, 0, 0.2);
        transform: translateY(-2px);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 140px;
    }

    .btn-submit {
        width: 100%;
        padding: 1.25rem 2rem;
        background: var(--gradient-primary);
        color: white;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        font-weight: 800;
        font-size: 1.05rem;
        letter-spacing: 0.02em;
        text-transform: uppercase;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .btn-submit::before {
        content: '';
        position: absolute;
        inset: 0;
        background: var(--gradient-accent);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: -1;
    }

    .btn-submit:hover::before {
        opacity: 1;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow:
            0 12px 24px rgba(0, 0, 0, 0.3),
            0 0 40px rgba(138, 80, 255, 0.5);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    .contact-info {
        margin-top: 3rem;
        text-align: center;
        padding: 2rem;
        background: var(--bg-elevated);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .contact-info h3 {
        color: var(--text-primary);
        margin-bottom: 1rem;
        font-size: 1.3rem;
    }

    .contact-info p {
        color: var(--text-secondary);
        font-size: 1rem;
        line-height: 1.7;
    }

    .contact-info a {
        color: var(--cyan);
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .contact-info a:hover {
        color: var(--primary);
    }

    @media (max-width: 768px) {
        .contact-hero {
            padding: 2rem 0;
        }

        .contact-form {
            padding: 2rem 1.5rem;
            border-radius: 16px;
        }

        .btn-submit {
            padding: 1rem 1.5rem;
        }
    }
</style>

<div class="container">
    <div class="contact-hero">
        <h1>Contact Us</h1>
        <p>Have questions or feedback? We'd love to hear from you.</p>
    </div>

    <div class="contact-form-container">

        <?php if ($message_sent): ?>
            <div class="success-message">
                ✨ Thank you for contacting us! We'll get back to you shortly.
            </div>
        <?php endif; ?>

        <form class="contact-form" method="POST" action="">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="your@email.com" required>
            </div>

            <div class="form-group">
                <label for="message">Your Message</label>
                <textarea id="message" name="message" placeholder="Tell us what's on your mind..." required></textarea>
            </div>

            <button type="submit" class="btn-submit">Send Message</button>
        </form>

        <div class="contact-info">
            <h3>Alternative Ways to Reach Us</h3>
            <p>
                For urgent inquiries, email us at <a
                    href="mailto:<?php echo CONTACT_EMAIL; ?>"><?php echo CONTACT_EMAIL; ?></a>
                <br>
                We typically respond within 24 hours.
            </p>
        </div>

    </div>
</div>

<?php include '../includes/footer.php'; ?>