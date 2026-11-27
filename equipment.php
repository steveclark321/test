<?php
$page_title = 'Equipment & Fleet | Trucking24Fit';
$page_description = 'View Trucking24Fit equipment categories including dry van, flatbed, refrigerated trucks, box trucks, day cab and sleeper cab tractors.';
$current_page = 'equipment';
require __DIR__ . '/includes/header.php';

$equipment = [
  [
    'title' => 'Dry Van Trailers',
    'image' => 'assets/images/dry-van.jpg',
    'alt' => 'Dry van trailer used for enclosed freight',
    'desc' => 'Enclosed trailers for general freight, palletized goods, packaged products, and many standard commercial shipments that need weather protection.',
    'specs' => [
      'Common use' => 'General / palletized freight',
      'Loading' => 'Rear dock / warehouse',
      'Protection' => 'Enclosed weather cover',
      'Capacity note' => '[Edit: length / payload]',
    ],
  ],
  [
    'title' => 'Flatbed Trailers',
    'image' => 'assets/images/flatbed-equip.jpg',
    'alt' => 'Flatbed trailer for open-deck freight',
    'desc' => 'Open-deck equipment for freight that requires side, top, or crane loading—including construction materials, machinery, and oversized pieces within legal limits.',
    'specs' => [
      'Common use' => 'Construction / industrial',
      'Loading' => 'Side / top / crane',
      'Protection' => 'Tarping as required',
      'Capacity note' => '[Edit: deck length / rating]',
    ],
  ],
  [
    'title' => 'Refrigerated Trucks',
    'image' => 'assets/images/reefer.jpg',
    'alt' => 'Refrigerated truck for temperature-controlled freight',
    'desc' => 'Temperature-controlled units for freight that must remain within a defined climate range during transit. Availability and temperature setpoints are confirmed per shipment.',
    'specs' => [
      'Common use' => 'Temp-sensitive freight',
      'Control' => 'Refrigerated / climate',
      'Monitoring' => '[Edit: tracking options]',
      'Capacity note' => '[Edit: unit sizes]',
    ],
  ],
  [
    'title' => 'Box Trucks',
    'image' => 'assets/images/box-truck.jpg',
    'alt' => 'Box truck for local and regional commercial deliveries',
    'desc' => 'Box trucks support local and regional commercial deliveries, smaller freight profiles, and locations where a full tractor-trailer may not be practical.',
    'specs' => [
      'Common use' => 'Local / regional delivery',
      'Access' => 'Urban & facility friendly',
      'Loading' => 'Liftgate options vary',
      'Capacity note' => '[Edit: box length / GVWR]',
    ],
  ],
  [
    'title' => 'Day Cab Tractors',
    'image' => 'assets/images/day-cab.jpg',
    'alt' => 'Day cab tractor for regional trucking',
    'desc' => 'Day cab tractors are well suited for regional routes and operations where overnight sleeper accommodations are not required for the assigned run.',
    'specs' => [
      'Common use' => 'Regional / local hauls',
      'Configuration' => 'Day cab',
      'Coupling' => 'Standard fifth-wheel',
      'Notes' => '[Edit: powertrain details]',
    ],
  ],
  [
    'title' => 'Sleeper Cab Tractors',
    'image' => 'assets/images/sleeper-cab.jpg',
    'alt' => 'Sleeper cab tractor for long-haul operations',
    'desc' => 'Sleeper cab tractors support longer lanes where driver rest accommodations are part of safe, compliant long-haul operations.',
    'specs' => [
      'Common use' => 'Long-haul lanes',
      'Configuration' => 'Sleeper cab',
      'Coupling' => 'Standard fifth-wheel',
      'Notes' => '[Edit: fleet details]',
    ],
  ],
];
?>

<section class="page-hero">
  <div class="hero-media">
    <img src="assets/images/containers.jpg" alt="Transportation equipment and freight containers" width="1200" height="800" fetchpriority="high">
  </div>
  <div class="hero-overlay" aria-hidden="true"></div>
  <div class="page-hero-content">
    <p class="eyebrow" style="color:var(--orange-400);">Fleet</p>
    <h1>Equipment &amp; Fleet</h1>
    <p>Explore the equipment categories Trucking24Fit can quote for commercial freight. Specifications marked as editable should be updated with your verified fleet data.</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">Transportation Assets</p>
      <h2>Equipment Built for Commercial Freight</h2>
      <p class="lead">Selecting the right equipment protects product integrity and improves loading efficiency. Share your freight dimensions, weight, and handling needs when requesting a quote.</p>
    </div>

    <div class="fleet-grid">
      <?php foreach ($equipment as $item): ?>
        <article class="fleet-card reveal">
          <div class="fleet-card-media">
            <img src="<?= htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($item['alt'], ENT_QUOTES, 'UTF-8') ?>" width="800" height="600" loading="lazy">
          </div>
          <div class="fleet-card-body">
            <h3><?= htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') ?></h3>
            <p><?= htmlspecialchars($item['desc'], ENT_QUOTES, 'UTF-8') ?></p>
            <ul class="spec-list">
              <?php foreach ($item['specs'] as $label => $value): ?>
                <li>
                  <span><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?></span>
                  <span><?= htmlspecialchars($value, ENT_QUOTES, 'UTF-8') ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section section-muted">
  <div class="container">
    <div class="split">
      <div class="split-copy reveal">
        <p class="eyebrow">Planning</p>
        <h2>Match Equipment to Freight Requirements</h2>
        <p>Not every shipment needs the same trailer or truck. Our team helps identify practical equipment options based on commodity type, dimensions, weight, loading method, and destination constraints.</p>
        <ul class="check-list">
          <li>Provide estimated weight and pallet count</li>
          <li>Note any temperature or tarping needs</li>
          <li>Share appointment or access restrictions</li>
          <li>Flag oversized or high-value freight early</li>
        </ul>
        <p style="margin-top:1.5rem;"><a class="btn btn-accent" href="quote.php">Request Equipment Quote</a></p>
      </div>
      <div class="split-media reveal">
        <img src="assets/images/loading-dock.jpg" alt="Freight loading operations at a commercial dock" width="1200" height="800" loading="lazy">
      </div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
