<?php
$page_title = 'Contact Us | Trucking24Fit';
$page_description = 'Contact Trucking24Fit at 24820 NE 135th Lane, Fort McCoy, FL 32134 or email contact@trucking24fit.org for freight quotes and shipment support.';
$current_page = 'contact';
require __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
  <div class="hero-media">
    <img src="/assets/images/shipping.jpg" alt="Freight shipping and customer coordination" width="1200" height="800" fetchpriority="high">
  </div>
  <div class="hero-overlay" aria-hidden="true"></div>
  <div class="page-hero-content">
    <p class="eyebrow" style="color:var(--orange-400);">Contact</p>
    <h1>Contact Trucking24Fit</h1>
    <p>Reach our Fort McCoy, Florida team for quotes, shipment questions, or partnership inquiries.</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="contact-layout">
      <aside class="contact-card reveal">
        <h2>Company Contact</h2>
        <p>We respond to commercial inquiries during business hours and follow up on website form submissions as quickly as possible.</p>
        <ul class="contact-list">
          <li>
            <strong>Email</strong>
            <a href="<?= htmlspecialchars($site['email_href'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($site['email'], ENT_QUOTES, 'UTF-8') ?></a>
          </li>
          <li>
            <strong>Address</strong>
            <?= htmlspecialchars($site['address_line1'], ENT_QUOTES, 'UTF-8') ?><br>
            <?= htmlspecialchars($site['address_line2'], ENT_QUOTES, 'UTF-8') ?>
          </li>
          <li>
            <strong>Business Hours</strong>
            <?= htmlspecialchars($site['hours'], ENT_QUOTES, 'UTF-8') ?>
          </li>
        </ul>
        <div class="map-placeholder" aria-label="Trucking24Fit location map">
          <iframe
            title="Trucking24Fit location — 24820 NE 135th Lane, Fort McCoy, FL 32134"
            src="<?= htmlspecialchars($site['map_embed'], ENT_QUOTES, 'UTF-8') ?>"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            allowfullscreen></iframe>
        </div>
        <p style="margin-top:1.5rem;"><a class="btn btn-accent btn-sm" href="/quote">Request a Quote</a></p>
      </aside>

      <div class="form-panel reveal">
        <h2 style="margin-bottom:0.35rem;">Send a Message</h2>
        <p class="form-hint" style="margin-bottom:1.5rem;">Use this form for general inquiries. For shipment quotes, the <a href="/quote">Request a Quote</a> form collects freight details.</p>

        <form id="contact-form" action="/api/contact" method="post" data-ajax="true" novalidate>
          <div class="form-grid">
            <div class="form-group">
              <label for="full_name">Full Name <span class="req">*</span></label>
              <input type="text" id="full_name" name="full_name" autocomplete="name" required maxlength="120">
              <div class="error-text" aria-live="polite"></div>
            </div>
            <div class="form-group">
              <label for="company_name">Company Name</label>
              <input type="text" id="company_name" name="company_name" autocomplete="organization" maxlength="160">
              <div class="error-text" aria-live="polite"></div>
            </div>
            <div class="form-group">
              <label for="email">Email <span class="req">*</span></label>
              <input type="email" id="email" name="email" autocomplete="email" required maxlength="160">
              <div class="error-text" aria-live="polite"></div>
            </div>
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="tel" id="phone" name="phone" autocomplete="tel" maxlength="40">
              <div class="error-text" aria-live="polite"></div>
            </div>
            <div class="form-group full">
              <label for="subject">Subject <span class="req">*</span></label>
              <input type="text" id="subject" name="subject" required maxlength="160" placeholder="How can we help?">
              <div class="error-text" aria-live="polite"></div>
            </div>
            <div class="form-group full">
              <label for="message">Message <span class="req">*</span></label>
              <textarea id="message" name="message" required maxlength="3000"></textarea>
              <div class="error-text" aria-live="polite"></div>
            </div>
            <div class="hp-field" aria-hidden="true">
              <label for="website_url">Website</label>
              <input type="text" id="website_url" name="website_url" tabindex="-1" autocomplete="off">
            </div>
            <div class="form-actions">
              <button class="btn btn-accent" type="submit">Send Message</button>
              <p class="form-hint">Messages are delivered to contact@trucking24fit.org during business hours.</p>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
