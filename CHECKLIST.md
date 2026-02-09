# 📋 PRE-DEPLOYMENT CHECKLIST

## Before uploading to viralversemedia.in

### ✅ Configuration

- [x] `includes/config.php` created with all constants
- [x] SITE_URL set to 'https://viralversemedia.in'
- [x] SITE_NAME set to 'ViralVerse Media'
- [x] CONTACT_EMAIL set to 'support@viralversemedia.in'
- [x] All page titles updated to use config
- [x] All branding references updated

### ✅ Files & Structure

- [x] `.htaccess` created for Apache
- [x] `robots.txt` created
- [x] `sitemap.xml` created
- [x] All PHP files use config constants
- [x] File structure is clean and organized
- [x] No local/development files included

### ✅ SEO

- [x] Meta titles on all pages
- [x] Meta descriptions on all pages
- [x] Meta keywords configured
- [x] Open Graph tags implemented
- [x] Twitter Card tags implemented
- [x] Canonical URLs on all pages
- [x] Sitemap includes all pages
- [x] Robots.txt properly configured

### ✅ Security

- [x] HTTPS force redirect in .htaccess
- [x] Security headers configured
- [x] File protection for sensitive files
- [x] Directory browsing disabled
- [x] Config file protected

### ✅ Performance

- [x] Gzip compression enabled
- [x] Browser caching configured
- [x] CSS optimized with variables
- [x] Images will use compression (add when uploading)

### ✅ UI/Design

- [x] Dark theme implemented
- [x] Fully responsive design
- [x] Premium animations and effects
- [x] Custom scrollbar styling
- [x] Glassmorphism effects
- [x] Hover states on all interactive elements

### ✅ Pages

- [x] Homepage (index.php) - Ready
- [x] Articles hub (articles/index.php) - Ready
- [x] Contact form (legal/contact.php) - Ready
- [x] Privacy policy (legal/privacy-policy.php) - Ready
- [x] Terms of service (legal/terms-of-service.php) - Ready
- [x] All article pages - Ready

### ✅ Documentation

- [x] README.md created
- [x] DEPLOYMENT.md created
- [x] DEPLOY-READY.md created
- [x] This checklist created

---

## 🚀 DEPLOYMENT ACTIONS

### After Upload:

1. **Set File Permissions**

   ```bash
   find . -type d -exec chmod 755 {} \;
   find . -type f -exec chmod 644 {} \;
   chmod 640 includes/config.php
   ```

2. **Install SSL Certificate**

   ```bash
   sudo certbot --apache -d viralversemedia.in -d www.viralversemedia.in
   ```

3. **Test URLs**
   - [ ] https://viralversemedia.in/
   - [ ] https://viralversemedia.in/articles/
   - [ ] https://viralversemedia.in/legal/contact.php
   - [ ] https://viralversemedia.in/legal/privacy-policy.php
   - [ ] https://viralversemedia.in/legal/terms-of-service.php

4. **Submit to Google**
   - [ ] Add to Google Search Console
   - [ ] Verify ownership
   - [ ] Submit sitemap.xml

5. **Optional Enhancements**
   - [ ] Add Google Analytics
   - [ ] Add favicon.ico
   - [ ] Configure contact form email sending
   - [ ] Add more article content

---

## 📞 Support

If anything doesn't work after deployment:

1. Check Apache error logs
2. Verify mod_rewrite is enabled
3. Check file permissions
4. Test HTTPS redirect

---

**Status:** ✅ FULLY READY FOR DEPLOYMENT  
**Domain:** viralversemedia.in  
**Date Prepared:** 2026-02-09
