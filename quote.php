<?php
$page_title = 'Request a Quote | Trucking24Fit';
$page_description = 'Request a freight transportation quote from Trucking24Fit. Provide shipment details for professional follow-up from our team.';
$current_page = 'quote';
$prefill_service = isset($_GET['service']) ? trim(strip_tags((string) $_GET['service'])) : '';
$prefill_industry = isset($_GET['industry']) ? trim(strip_tags((string) $_GET['industry'])) : '';
$default_details = '';
if ($prefill_service !== '') {
  $default_details = 'Service interest: ' . $prefill_service;
}
if ($prefill_industry !== '') {
  $default_details = trim($default_details . ($default_details ? "\n" : '') . 'Industry: ' . $prefill_industry);
}
require __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
  <div class="hero-media">
    <img src="/assets/images/truck-highway.jpg" alt="Semi-truck on an American freight corridor" width="1200" height="800" fetchpriority="high">
  </div>
  <div class="hero-overlay" aria-hidden="true"></div>
  <div class="page-hero-content">
    <p class="eyebrow" style="color:var(--orange-400);">Get Started</p>
    <h1>Request a Freight Quote</h1>
    <p>Share your shipment details below. Trucking24Fit will review your request and follow up with next steps. Required fields are marked.</p>
  </div>
</section>

<section class="section section-muted">
  <div class="container" style="max-width:920px;">
    <div class="form-panel reveal">
      <h2 style="margin-bottom:0.35rem;">Freight Quotation Form</h2>
      <p class="form-hint" style="margin-bottom:1.5rem;">Accurate pickup, delivery, and freight details help us respond faster. Submissions are processed securely through our website form handler.</p>

      <form id="quote-form" action="/api/quote" method="post" data-ajax="true" novalidate>
        <div class="form-grid">
          <div class="form-group">
            <label for="full_name">Full Name <span class="req">*</span></label>
            <input type="text" id="full_name" name="full_name" autocomplete="name" required maxlength="120">
            <div class="error-text" aria-live="polite"></div>
          </div>
          <div class="form-group">
            <label for="company_name">Company Name <span class="req">*</span></label>
            <input type="text" id="company_name" name="company_name" autocomplete="organization" required maxlength="160">
            <div class="error-text" aria-live="polite"></div>
          </div>
          <div class="form-group">
            <label for="business_email">Business Email <span class="req">*</span></label>
            <input type="email" id="business_email" name="business_email" autocomplete="email" required maxlength="160">
            <div class="error-text" aria-live="polite"></div>
          </div>
          <div class="form-group">
            <label for="phone">Phone Number <span class="req">*</span></label>
            <input type="tel" id="phone" name="phone" autocomplete="tel" required maxlength="40">
            <div class="error-text" aria-live="polite"></div>
          </div>
          <div class="form-group">
            <label for="pickup_location">Pickup Location <span class="req">*</span></label>
            <input type="text" id="pickup_location" name="pickup_location" placeholder="City, ST or ZIP" required maxlength="200">
            <div class="error-text" aria-live="polite"></div>
          </div>
          <div class="form-group">
            <label for="delivery_location">Delivery Location <span class="req">*</span></label>
            <input type="text" id="delivery_location" name="delivery_location" placeholder="City, ST or ZIP" required maxlength="200">
            <div class="error-text" aria-live="polite"></div>
          </div>
          <div class="form-group">
            <label for="freight_type">Freight Type <span class="req">*</span></label>
            <select id="freight_type" name="freight_type" required>
              <option value="">Select freight type</option>
              <option>General Freight</option>
              <option>Palletized Goods</option>
              <option>Building Materials</option>
              <option>Industrial Equipment</option>
              <option>Retail Merchandise</option>
              <option>Temperature-Sensitive</option>
              <option>Other / Mixed</option>
            </select>
            <div class="error-text" aria-live="polite"></div>
          </div>
          <div class="form-group">
            <label for="equipment_required">Equipment Required <span class="req">*</span></label>
            <select id="equipment_required" name="equipment_required" required>
              <option value="">Select equipment</option>
              <option>Dry Van</option>
              <option>Flatbed</option>
              <option>Refrigerated</option>
              <option>Box Truck</option>
              <option>Not Sure / Need Recommendation</option>
            </select>
            <div class="error-text" aria-live="polite"></div>
          </div>
          <div class="form-group">
            <label for="estimated_weight">Estimated Weight</label>
            <input type="text" id="estimated_weight" name="estimated_weight" placeholder="e.g., 12,000 lbs" maxlength="80">
            <div class="error-text" aria-live="polite"></div>
          </div>
          <div class="form-group">
            <label for="number_of_pallets">Number of Pallets</label>
            <input type="text" id="number_of_pallets" name="number_of_pallets" placeholder="e.g., 8" maxlength="40">
            <div class="error-text" aria-live="polite"></div>
          </div>
          <div class="form-group">
            <label for="pickup_date">Pickup Date</label>
            <input type="date" id="pickup_date" name="pickup_date">
            <div class="error-text" aria-live="polite"></div>
          </div>
          <div class="form-group">
            <label for="delivery_date">Delivery Date</label>
            <input type="date" id="delivery_date" name="delivery_date">
            <div class="error-text" aria-live="polite"></div>
          </div>
          <div class="form-group full">
            <label for="additional_details">Additional Shipment Details</label>
            <textarea id="additional_details" name="additional_details" maxlength="2000" placeholder="Dimensions, appointment requirements, hazmat status (if any), special handling, etc."><?= htmlspecialchars($default_details, ENT_QUOTES, 'UTF-8') ?></textarea>
            <div class="error-text" aria-live="polite"></div>
          </div>

          <!-- Honeypot -->
          <div class="hp-field" aria-hidden="true">
            <label for="website_url">Website</label>
            <input type="text" id="website_url" name="website_url" tabindex="-1" autocomplete="off">
          </div>

          <div class="form-actions">
            <button class="btn btn-accent" type="submit">Submit Request</button>
            <p class="form-hint">By submitting, you agree to be contacted about this shipment request. We do not sell your information.</p>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<section class="section-sm">
  <div class="container" style="text-align:center;">
    <p>Prefer to email our team directly? Reach us at <a href="<?= htmlspecialchars($site['email_href'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($site['email'], ENT_QUOTES, 'UTF-8') ?></a> · <?= htmlspecialchars($site['address'], ENT_QUOTES, 'UTF-8') ?></p>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
