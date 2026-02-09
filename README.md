# ViralVerse Media - Automated SEO Bookmarking Tool

![Version](https://img.shields.io/badge/version-1.0.0-blue)
![PHP](https://img.shields.io/badge/PHP-7.4+-purple)
![License](https://img.shields.io/badge/license-MIT-green)

Professional automated social bookmarking tool with a premium dark theme UI.

## 🌟 Features

- ✨ **Premium Dark UI** - Modern design with glassmorphism and smooth animations
- 🚀 **SEO Optimized** - Comprehensive meta tags, sitemap, and structured data
- 📱 **Fully Responsive** - Perfect on desktop, tablet, and mobile
- 🔒 **Secure** - Security headers, HTTPS redirect, and file protection
- ⚡ **Fast Performance** - Compression, caching, and optimized assets
- 📚 **Knowledge Hub** - SEO articles and guides
- 📧 **Contact Form** - Clean, modern contact interface

## 🎨 Design Highlights

- Vibrant blue-purple gradient color scheme
- Smooth micro-animations and hover effects
- Inter font family for modern typography
- Glassmorphic header with backdrop blur
- Custom gradient scrollbar
- Card-based layouts with glow effects

## 📁 Project Structure

```
frontend php/
├── assets/
│   └── style.css          # Main stylesheet with dark theme
├── articles/
│   ├── index.php          # Articles listing page
│   └── *.php              # Individual article pages
├── includes/
│   ├── config.php         # Site configuration constants
│   ├── header.php         # Global header with SEO tags
│   └── footer.php         # Global footer
├── legal/
│   ├── contact.php        # Contact form
│   ├── privacy-policy.php # Privacy policy
│   └── terms-of-service.php # Terms of service
├── index.php              # Homepage with embedded tool
├── .htaccess              # Apache configuration
├── robots.txt             # SEO robots file
├── sitemap.xml            # XML sitemap
└── DEPLOYMENT.md          # Deployment guide
```

## ⚙️ Configuration

All site settings are in `includes/config.php`:

```php
SITE_URL = 'https://viralversemedia.in'
SITE_NAME = 'ViralVerse Media'
CONTACT_EMAIL = 'support@viralversemedia.in'
```

## 🚀 Quick Start

### Local Development

1. Copy files to your web server (XAMPP, WAMP, etc.)
2. Access via `http://localhost/frontend php/`
3. Edit `includes/config.php` for your settings

### Production Deployment

See [DEPLOYMENT.md](DEPLOYMENT.md) for complete deployment instructions.

**Quick deploy:**

1. Upload all files to `public_html`
2. Set file permissions (755 for directories, 644 for files)
3. Enable SSL certificate
4. Submit sitemap to Google Search Console

## 🔧 Requirements

- **PHP:** 7.4 or higher
- **Apache:** 2.4+ with mod_rewrite enabled
- **SSL Certificate:** For HTTPS
- **MySQL:** Not required (static site)

## 📊 SEO Features

- ✅ Meta descriptions and keywords
- ✅ Open Graph tags for social sharing
- ✅ Twitter Card integration
- ✅ Canonical URLs on all pages
- ✅ XML sitemap for search engines
- ✅ Robots.txt configuration
- ✅ Semantic HTML5 structure
- ✅ Mobile-first responsive design

## 🎯 Pages

- **Homepage** (`/`) - Main landing page with embedded Streamlit tool
- **Articles Hub** (`/articles/`) - SEO knowledge base with 5+ articles
- **Contact** (`/legal/contact.php`) - Modern contact form
- **Privacy Policy** (`/legal/privacy-policy.php`)
- **Terms of Service** (`/legal/terms-of-service.php`)

## 🎨 Customization

### Change Colors

Edit CSS variables in `assets/style.css`:

```css
:root {
  --primary: hsl(220, 100%, 60%); /* Blue */
  --accent: hsl(280, 100%, 65%); /* Purple */
  --cyan: hsl(190, 100%, 60%); /* Cyan */
}
```

### Update Branding

Edit `includes/config.php`:

```php
define('SITE_NAME', 'Your Site Name');
define('SITE_TAGLINE', 'Your Tagline');
```

## 📈 Performance

- **PageSpeed Score:** 90+
- **Mobile Friendly:** Yes
- **HTTPS:** Required
- **Compression:** Enabled (gzip)
- **Browser Caching:** 1 year for assets

## 🔒 Security

- HTTPS force redirect
- Security headers (XSS, Clickjacking protection)
- File access restrictions
- Directory browsing disabled
- Content Security Policy

## 📞 Support

**Website:** https://viralversemedia.in  
**Email:** support@viralversemedia.in

## 📄 License

MIT License - feel free to use for personal or commercial projects.

---

Built with ❤️ for SEO professionals and digital marketers.
