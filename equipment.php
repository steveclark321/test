<?php
$page_title = 'Equipment & Fleet | Trucking24Fit';
$page_description = 'Trucking24Fit fleet equipment: 53-foot dry vans, flatbeds, refrigerated trailers, box trucks, day cab and sleeper cab tractors with full length and payload specs.';
$current_page = 'equipment';
require __DIR__ . '/includes/header.php';

$equipment = [
  [
    'title' => 'Dry Van Trailers',
    'image' => '/assets/images/dry-van.jpg',
    'alt' => '53-foot dry van trailer for enclosed freight',
    'desc' => 'Enclosed 53-foot dry vans for general freight, palletized goods, packaged products, and standard commercial shipments that need full weather protection from origin to destination.',
    'specs' => [
      'Trailer length' => '53 ft',
      'Interior width' => '102 in',
      'Interior height' => '110 in',
      'Door opening' => '110 in H × 99 in W',
      'Cubic capacity' => 'Approx. 3,800–4,000 cu ft',
      'Max payload' => 'Up to 45,000 lbs',
      'Loading' => 'Rear dock / warehouse',
      'Best for' => 'General & palletized freight',
    ],
  ],
  [
    'title' => 'Flatbed Trailers',
    'image' => '/assets/images/flatbed-equip.jpg',
    'alt' => '48-foot flatbed trailer for open-deck freight',
    'desc' => 'Open-deck flatbeds for freight that requires side, top, or crane loading—including construction materials, steel, machinery, crated equipment, and oversized pieces within legal limits.',
    'specs' => [
      'Deck length' => '48 ft (53 ft available on request)',
      'Deck width' => '8 ft 6 in',
      'Deck height' => 'Approx. 60 in',
      'Max payload' => 'Up to 48,000 lbs',
      'Securement' => 'Straps, chains & tarps as required',
      'Loading' => 'Side / top / crane',
      'Best for' => 'Construction & industrial freight',
    ],
  ],
  [
    'title' => 'Refrigerated Trailers',
    'image' => '/assets/images/reefer.jpg',
    'alt' => '53-foot refrigerated trailer for temperature-controlled freight',
    'desc' => 'Temperature-controlled 53-foot reefers for freight that must stay within a defined climate range. Setpoints and unit readiness are confirmed before dispatch for every temperature-sensitive load.',
    'specs' => [
      'Trailer length' => '53 ft',
      'Interior width' => '98–100 in',
      'Interior height' => '105–107 in',
      'Temp range' => '−20°F to 80°F',
      'Cubic capacity' => 'Approx. 3,500–3,700 cu ft',
      'Max payload' => 'Up to 43,000 lbs',
      'Monitoring' => 'Reefer unit setpoint & run verification',
      'Best for' => 'Temp-sensitive commercial freight',
    ],
  ],
  [
    'title' => 'Box Trucks',
    'image' => '/assets/images/box-truck.jpg',
    'alt' => '26-foot box truck for local and regional deliveries',
    'desc' => 'Straight box trucks for local and regional commercial deliveries, smaller freight profiles, and facilities where a full tractor-trailer is not practical. Liftgate service available when requested.',
    'specs' => [
      'Box length' => '26 ft',
      'Box width' => '96–102 in',
      'Box height' => '96–102 in',
      'Cubic capacity' => 'Approx. 1,600–1,800 cu ft',
      'Max payload' => 'Up to 10,000–12,000 lbs',
      'GVWR class' => 'Up to 26,000 lbs',
      'Access' => 'Urban & facility-friendly',
      'Options' => 'Liftgate available on request',
    ],
  ],
  [
    'title' => 'Day Cab Tractors',
    'image' => '/assets/images/day-cab.jpg',
    'alt' => 'Day cab Class 8 tractor for regional trucking',
    'desc' => 'Day cab tractors for regional and short-haul operations where overnight sleeper accommodations are not required. Powered for standard fifth-wheel trailer combinations on Florida and Southeast lanes.',
    'specs' => [
      'Configuration' => 'Day cab',
      'Vehicle class' => 'Class 8',
      'Coupling' => 'Standard fifth-wheel',
      'Typical GCWR' => 'Up to 80,000 lbs',
      'Engine class' => 'Heavy-duty diesel',
      'Primary use' => 'Regional & local hauls',
      'Trailer match' => 'Dry van, flatbed, reefer',
    ],
  ],
  [
    'title' => 'Sleeper Cab Tractors',
    'image' => '/assets/images/sleeper-cab.jpg',
    'alt' => 'Sleeper cab Class 8 tractor for long-haul freight',
    'desc' => 'Sleeper cab tractors for long-haul lanes where driver rest accommodations support safe, compliant over-the-road operations across multi-state freight corridors.',
    'specs' => [
      'Configuration' => 'Sleeper cab',
      'Vehicle class' => 'Class 8',
      'Coupling' => 'Standard fifth-wheel',
      'Typical GCWR' => 'Up to 80,000 lbs',
      'Engine class' => 'Heavy-duty diesel',
      'Primary use' => 'Long-haul & OTR lanes',
      'Trailer match' => 'Dry van, flatbed, reefer',
    ],
  ],
];
?>

<section class="page-hero">
  <div class="hero-media">
    <img src="/assets/images/containers.jpg" alt="Trucking24Fit transportation equipment" width="1200" height="800" fetchpriority="high">
  </div>
  <div class="hero-overlay" aria-hidden="true"></div>
  <div class="page-hero-content">
    <p class="eyebrow" style="color:var(--orange-400);">Fleet</p>
    <h1>Equipment &amp; Fleet</h1>
    <p>Standard commercial lengths, payloads, and configurations we quote for dry van, flatbed, refrigerated, box truck, and tractor equipment.</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">Transportation Assets</p>
      <h2>Equipment Built for Commercial Freight</h2>
      <p class="lead">Selecting the right equipment protects product integrity and improves loading efficiency. Share dimensions, weight, and handling needs when you request a quote.</p>
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
        <p>Not every shipment needs the same trailer or truck. Our team identifies practical equipment based on commodity type, dimensions, weight, loading method, and destination access.</p>
        <ul class="check-list">
          <li>Provide estimated weight and pallet count</li>
          <li>Note temperature or tarping requirements</li>
          <li>Share appointment or facility access limits</li>
          <li>Flag oversized or high-value freight early</li>
        </ul>
        <p style="margin-top:1.5rem;"><a class="btn btn-accent" href="/quote">Request Equipment Quote</a></p>
      </div>
      <div class="split-media reveal">
        <img src="/assets/images/loading-dock.jpg" alt="Freight loading operations at a commercial dock" width="1200" height="800" loading="lazy">
      </div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
