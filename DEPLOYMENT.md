# Deployment Guide for viralversemedia.in

## 📋 Pre-Deployment Checklist

### ✅ Files Ready

- [x] Configuration file (`includes/config.php`)
- [x] Updated branding to "ViralVerse Media"
- [x] SEO meta tags and Open Graph tags
- [x] Sitemap.xml
- [x] Robots.txt
- [x] .htaccess with security and rewrites
- [x] Responsive design
- [x] Dark theme UI

## 🚀 Deployment Steps

### 1. **Upload Files to Server**

Upload all files from `c:\xampp\htdocs\frontend php\` to your hosting server's public directory (usually `public_html` or `www`).

**Files to upload:**

```
/
├── assets/
│   └── style.css
├── articles/
│   ├── index.php
│   ├── social-bookmarking-2026.php
│   ├── white-hat-vs-black-hat.php
│   ├── seo-evolution.php
│   ├── automated-tools-importance.php
│   └── thin-content-penalty.php
├── includes/
│   ├── config.php
│   ├── header.php
│   └── footer.php
├── legal/
│   ├── contact.php
│   ├── privacy-policy.php
│   └── terms-of-service.php
├── index.php
├── .htaccess
├── robots.txt
└── sitemap.xml
```

### 2. **Verify Configuration**

Open `includes/config.php` and verify all settings:

```php
SITE_URL = 'https://viralversemedia.in'  ✓
SITE_NAME = 'ViralVerse Media'  ✓
CONTACT_EMAIL = 'support@viralversemedia.in'  ✓
```

### 3. **Set File Permissions**

```bash
# Directories: 755
find . -type d -exec chmod 755 {} \;

# PHP Files: 644
find . -type f -name "*.php" -exec chmod 644 {} \;

# Config file (more restrictive): 640
chmod 640 includes/config.php

# .htaccess: 644
chmod 644 .htaccess
```

### 4. **Test .htaccess Rewrite Rules**

Ensure Apache `mod_rewrite` is enabled:

```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

Test these URLs work:

- ✓ `https://viralversemedia.in/` (loads index.php)
- ✓ `https://viralversemedia.in/articles/` (loads articles/index.php)
- ✓ `https://viralversemedia.in/legal/contact.php`

### 5. **SSL Certificate**

Ensure SSL is installed for HTTPS:

- **Let's Encrypt (Free):**
  ```bash
  sudo certbot --apache -d viralversemedia.in -d www.viralversemedia.in
  ```
- Or use your hosting provider's SSL manager

### 6. **Email Configuration**

Update `support@viralversemedia.in` email:

1. Create the email account in your hosting cPanel
2. Test contact form submissions
3. Optional: Configure SMTP for better deliverability

### 7. **DNS Configuration**

Point domain to your server:

```
Type    Name    Value                TTL
A       @       [Your Server IP]     3600
A       www     [Your Server IP]     3600
```

Wait 24-48 hours for DNS propagation.

## 🔧 Post-Deployment Tasks

### 1. **Google Search Console**

1. Go to [Google Search Console](https://search.google.com/search-console)
2. Add property: `https://viralversemedia.in`
3. Verify ownership (HTML file or DNS)
4. Submit sitemap: `https://viralversemedia.in/sitemap.xml`

### 2. **Google Analytics (Optional)**

Add tracking code to `includes/header.php` before `</head>`:

```html
<!-- Google Analytics -->
<script
  async
  src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"
></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag() {
    dataLayer.push(arguments);
  }
  gtag("js", new Date());
  gtag("config", "G-XXXXXXXXXX");
</script>
```

### 3. **Test All Pages**

- [ ] Homepage: `https://viralversemedia.in/`
- [ ] Articles: `https://viralversemedia.in/articles/`
- [ ] Contact: `https://viralversemedia.in/legal/contact.php`
- [ ] Privacy: `https://viralversemedia.in/legal/privacy-policy.php`
- [ ] Terms: `https://viralversemedia.in/legal/terms-of-service.php`

### 4. **Mobile Responsiveness**

Test on:

- Desktop (1920px)
- Tablet (768px)
- Mobile (375px)

### 5. **Performance Testing**

Use these tools:

- [PageSpeed Insights](https://pagespeed.web.dev/)
- [GTmetrix](https://gtmetrix.com/)
- [WebPageTest](https://www.webpagetest.org/)

Target: 90+ score

## 🎨 Branding Overview

**Site Name:** ViralVerse Media  
**Tagline:** Boost Your SEO with Automated Social Bookmarking  
**Color Scheme:** Dark theme with blue-purple gradients  
**Font:** Inter (Google Fonts)

## 🔒 Security Features

✅ HTTPS Force redirect  
✅ X-Frame-Options (clickjacking protection)  
✅ X-Content-Type-Options (MIME sniffing protection)  
✅ XSS Protection headers  
✅ Content Security Policy  
✅ File access restrictions  
✅ Directory browsing disabled

## 📊 SEO Features

✅ Semantic HTML5  
✅ Meta descriptions on all pages  
✅ Open Graph tags  
✅ Twitter Card tags  
✅ Canonical URLs  
✅ XML Sitemap  
✅ Robots.txt  
✅ Keyword-rich content  
✅ Mobile-friendly design  
✅ Fast loading (compression + caching)

## 🐛 Troubleshooting

### Issue: 404 errors on all pages

**Solution:** Check if mod_rewrite is enabled

```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

### Issue: CSS not loading

**Solution:** Check file paths in browser DevTools. Ensure `/assets/style.css` exists and is accessible.

### Issue: Config constants undefined

**Solution:** Ensure `includes/config.php` is uploaded and `require_once` path is correct.

### Issue: Streamlit footer still showing

**Solution:** The embed_options parameter may not be supported. Consider using CSS overlay or hosting Streamlit on subdomain.

## 📞 Support

For deployment issues:

- Email: support@viralversemedia.in
- Check server error logs: `/var/log/apache2/error.log`

## ✅ Deployment Complete!

Once deployed, your site should be live at:
**https://viralversemedia.in**

Enjoy your premium SEO tool site! 🚀
