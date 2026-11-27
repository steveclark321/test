# Trucking24Fit Website

Professional trucking & freight transportation website for **Trucking24Fit**.

## Stack

- HTML / CSS / JavaScript (front end)
- PHP 8+ (form handling, shared includes)
- No build step required — deploy to standard Apache/Nginx + PHP hosting

## Pages

| Page | File |
|------|------|
| Home | `index.php` |
| About Us | `about.php` |
| Services | `services.php` |
| Equipment & Fleet | `equipment.php` |
| Industries | `industries.php` |
| Request a Quote | `quote.php` |
| Contact Us | `contact.php` |

## Before going live

1. Edit contact details in `includes/site-config.php` (phone, email, address, hours, optional Google Maps embed URL).
2. Edit form delivery settings in `api/config.php`:
   - `notification_email` — where quote/contact submissions are sent
   - `from_email` / `from_name` — must be allowed by your mail host
   - `send_email` — set `true` when PHP `mail()` or your host mail relay works
   - `webhook_url` — optional Zapier/Make/custom webhook
   - `save_submissions` — keeps JSON backups under `/submissions` (web-blocked)
3. Replace placeholder statistics on the homepage with verified metrics.
4. Replace sample testimonials with genuine customer quotes.
5. Update editable equipment specifications on `equipment.php`.
6. Set absolute URLs in `sitemap.xml` and the `Sitemap:` line in `robots.txt` to your live domain.
7. Confirm which services are actively offered and adjust copy if needed.

## Local development

```bash
php -S 127.0.0.1:8080 -t .
```

Open `http://127.0.0.1:8080/`. Forms POST to `/api/quote.php` and `/api/contact.php` and save to `/submissions` even if mail is not configured.

## Security notes

- `/submissions` and `/includes` are blocked via `.htaccess`
- Forms include honeypot + basic IP rate limiting
- Input is sanitized server-side; JSON API responses only

## License / assets

Photography is sourced from Unsplash for demonstration. Confirm licensing and replace with company-owned imagery for production branding if required.
