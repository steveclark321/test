# Trucking24Fit Website

Professional trucking & freight transportation website for **Trucking24Fit**  
**24820 NE 135th Lane, Fort McCoy, FL 32134** · **contact@trucking24fit.org**

## Stack

- HTML / CSS / JavaScript
- PHP 8+ (shared includes + form handling)
- Clean URLs (no `.php` in public links)

## Pages

| Page | URL |
|------|-----|
| Home | `/` |
| About Us | `/about` |
| Services | `/services` |
| Equipment & Fleet | `/equipment` |
| Industries | `/industries` |
| Request a Quote | `/quote` |
| Contact Us | `/contact` |

## Configuration

- Public contact details: `includes/site-config.php`
- Form delivery (email / webhook / JSON backup): `api/config.php`

Submissions are emailed to `contact@trucking24fit.org` and saved under `/submissions` (web-blocked).

## Local development

```bash
php -S 127.0.0.1:8080 router.php
```

Open `http://127.0.0.1:8080/`. On Apache hosting, `.htaccess` rewrites clean URLs and redirects old `.php` paths.

## Deploy

Upload the project to any standard PHP web host with Apache `mod_rewrite` (or equivalent Nginx rewrite rules). No build step required.
