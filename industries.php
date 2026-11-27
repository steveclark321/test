<?php
$page_title = 'Industries We Serve | Trucking24Fit';
$page_description = 'Trucking24Fit supports construction, manufacturing, retail distribution, industrial supply, wholesale, building materials, and commercial businesses.';
$current_page = 'industries';
require __DIR__ . '/includes/header.php';

$industries = [
  [
    'id' => 'construction',
    'title' => 'Construction',
    'image' => 'assets/images/construction.jpg',
    'alt' => 'Construction materials and jobsite logistics',
    'desc' => 'Construction projects depend on materials arriving when crews and equipment are ready. Trucking24Fit supports freight movement for jobsite deliveries and supply staging with attention to scheduling and load type.',
  ],
  [
    'id' => 'manufacturing',
    'title' => 'Manufacturing',
    'image' => 'assets/images/manufacturing.jpg',
    'alt' => 'Manufacturing plant and outbound freight',
    'desc' => 'Manufacturers need inbound components and outbound finished goods to move on reliable timelines. We help coordinate freight that keeps production and customer fulfillment on track.',
  ],
  [
    'id' => 'retail',
    'title' => 'Retail & Distribution',
    'image' => 'assets/images/retail.jpg',
    'alt' => 'Retail and distribution shipping environment',
    'desc' => 'Retail and distribution networks require consistent replenishment and facility-aware delivery. Trucking24Fit supports commercial freight lanes that keep inventory flowing.',
  ],
  [
    'id' => 'industrial',
    'title' => 'Industrial Supply',
    'image' => 'assets/images/industrial.jpg',
    'alt' => 'Industrial supply and equipment logistics',
    'desc' => 'Industrial suppliers move tools, parts, and equipment that keep plants and field operations running. Our team works with freight profiles common to industrial supply chains.',
  ],
  [
    'id' => 'wholesale',
    'title' => 'Wholesale',
    'image' => 'assets/images/wholesale.jpg',
    'alt' => 'Wholesale warehouse product staging',
    'desc' => 'Wholesale operations often involve recurring palletized freight and multi-location delivery patterns. We provide transportation options that scale with wholesale shipping volume.',
  ],
  [
    'id' => 'building-materials',
    'title' => 'Building Materials',
    'image' => 'assets/images/building-materials.jpg',
    'alt' => 'Building materials ready for transport',
    'desc' => 'Building materials shipping can include lumber, fixtures, packaged goods, and specialty products. Equipment recommendations are matched to product handling requirements.',
  ],
  [
    'id' => 'commercial',
    'title' => 'Commercial Businesses',
    'image' => 'assets/images/commercial.jpg',
    'alt' => 'Commercial business district and logistics needs',
    'desc' => 'From established enterprises to growing commercial operators, Trucking24Fit provides professional freight transportation support tailored to B2B shipping needs.',
  ],
];
?>

<section class="page-hero">
  <div class="hero-media">
    <img src="/assets/images/logistics.jpg" alt="Commercial logistics and freight operations" width="1200" height="800" fetchpriority="high">
  </div>
  <div class="hero-overlay" aria-hidden="true"></div>
  <div class="page-hero-content">
    <p class="eyebrow" style="color:var(--orange-400);">Markets</p>
    <h1>Industries We Serve</h1>
    <p>Trucking24Fit partners with commercial shippers across key American industries that rely on dependable freight transportation.</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">Sector Experience</p>
      <h2>Transportation Support Across Key Industries</h2>
      <p class="lead">Each industry has unique freight characteristics. We listen to your operational requirements and recommend practical trucking solutions.</p>
    </div>

    <?php foreach ($industries as $industry): ?>
      <article class="service-block reveal" id="<?= htmlspecialchars($industry['id'], ENT_QUOTES, 'UTF-8') ?>">
        <div class="service-block-media">
          <img src="<?= htmlspecialchars($industry['image'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($industry['alt'], ENT_QUOTES, 'UTF-8') ?>" width="800" height="500" loading="lazy">
        </div>
        <div>
          <h2><?= htmlspecialchars($industry['title'], ENT_QUOTES, 'UTF-8') ?></h2>
          <p><?= htmlspecialchars($industry['desc'], ENT_QUOTES, 'UTF-8') ?></p>
          <a class="btn btn-accent" href="/quote?industry=<?= urlencode($industry['title']) ?>">Request a Quote</a>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>

<section class="cta-band">
  <div class="container reveal">
    <h2>Shipping in Another Industry?</h2>
    <p>If your market is not listed, contact Trucking24Fit with your freight details. We will review your requirements and advise on next steps.</p>
    <a class="btn btn-accent" href="/contact">Contact Us</a>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
