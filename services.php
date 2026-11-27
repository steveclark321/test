<?php
$page_title = 'Transportation Services | Trucking24Fit';
$page_description = 'Explore Trucking24Fit transportation services including FTL, LTL, dedicated, regional, long-haul, expedited freight, commercial delivery, and logistics coordination.';
$current_page = 'services';
require __DIR__ . '/includes/header.php';

$services = [
  [
    'id' => 'ftl',
    'title' => 'Full Truckload (FTL)',
    'image' => 'assets/images/ftl.jpg',
    'alt' => 'Full truckload trailer prepared for departure',
    'desc' => 'FTL service is designed for larger shipments that benefit from exclusive trailer space. Your freight moves as a dedicated load, helping reduce handling and support more direct transit planning.',
    'benefits' => [
      'Exclusive trailer capacity for eligible shipments',
      'Fewer touchpoints compared with consolidated freight',
      'Suitable for high-volume or time-sensitive commercial loads',
      'Clear origin-to-destination coordination',
    ],
  ],
  [
    'id' => 'ltl',
    'title' => 'Less Than Truckload (LTL)',
    'image' => 'assets/images/ltl.jpg',
    'alt' => 'Palletized freight staged for less-than-truckload shipping',
    'desc' => 'LTL options help shippers move smaller volumes without paying for an entire trailer when full truckload capacity is not required. Ideal for palletized freight and recurring partial shipments.',
    'benefits' => [
      'Cost-conscious option for partial trailer needs',
      'Useful for multi-stop or smaller commercial shipments',
      'Flexible for growing shipping programs',
      'Quoted based on freight profile and lane details',
    ],
  ],
  [
    'id' => 'dedicated',
    'title' => 'Dedicated Transportation',
    'image' => 'assets/images/dedicated.jpg',
    'alt' => 'Dedicated freight operations at a shipping terminal',
    'desc' => 'Dedicated transportation supports businesses that need consistent capacity, predictable scheduling, and a transportation resource aligned with recurring freight patterns.',
    'benefits' => [
      'Capacity planning for recurring lanes',
      'Improved schedule consistency for regular shippers',
      'Stronger operational familiarity with your facilities',
      'Customized communication preferences',
    ],
  ],
  [
    'id' => 'regional',
    'title' => 'Regional Freight Transportation',
    'image' => 'assets/images/truck-highway.jpg',
    'alt' => 'Semi-truck traveling a regional highway corridor',
    'desc' => 'Regional freight transportation focuses on shorter and mid-range lanes where transit reliability and local market knowledge matter. A strong fit for distribution networks and multi-state commercial corridors.',
    'benefits' => [
      'Support for regional distribution patterns',
      'Responsive scheduling for nearer markets',
      'Practical option for replenishment freight',
      'Aligned with warehouse and store delivery cycles',
    ],
  ],
  [
    'id' => 'long-haul',
    'title' => 'Long-Haul Trucking',
    'image' => 'assets/images/semi-trailer.jpg',
    'alt' => 'Long-haul tractor-trailer on an interstate route',
    'desc' => 'Long-haul trucking connects distant origins and destinations for shippers moving freight across broader geographies. Planning emphasizes equipment fit, transit expectations, and shipment visibility.',
    'benefits' => [
      'Coverage for extended shipping lanes',
      'Equipment matched to freight requirements',
      'Transit planning with clear milestones',
      'Support for outbound and inbound supply needs',
    ],
  ],
  [
    'id' => 'expedited',
    'title' => 'Expedited Freight',
    'image' => 'assets/images/expedited.jpg',
    'alt' => 'Expedited freight containers ready for priority movement',
    'desc' => 'Expedited freight service is intended for time-critical shipments where schedule urgency is a primary requirement. Availability depends on equipment, driver hours, and lane conditions at the time of request.',
    'benefits' => [
      'Priority quoting for urgent freight',
      'Focused on meeting critical delivery windows',
      'Direct communication during transit',
      'Useful for production, project, and recovery shipments',
    ],
  ],
  [
    'id' => 'commercial',
    'title' => 'Commercial Freight Delivery',
    'image' => 'assets/images/shipping.jpg',
    'alt' => 'Commercial freight being prepared for delivery',
    'desc' => 'Commercial freight delivery supports business-to-business shipping needs—from facility-to-facility moves to distribution deliveries that require professional dock and appointment awareness.',
    'benefits' => [
      'B2B shipping experience',
      'Attention to appointment and receiving requirements',
      'Suitable for wholesale, retail, and industrial freight',
      'Professional handling expectations',
    ],
  ],
  [
    'id' => 'logistics',
    'title' => 'Logistics Coordination',
    'image' => 'assets/images/logistics.jpg',
    'alt' => 'Logistics coordination in a warehouse environment',
    'desc' => 'Logistics coordination helps shippers organize freight details, equipment needs, and timing so transportation decisions are clearer and execution is more controlled.',
    'benefits' => [
      'Shipment planning support',
      'Equipment and service recommendations',
      'Coordination across pickup and delivery requirements',
      'A single point of contact for quote-to-dispatch questions',
    ],
  ],
];
?>

<section class="page-hero">
  <div class="hero-media">
    <img src="assets/images/warehouse.jpg" alt="Warehouse and freight logistics operations" width="1200" height="800" fetchpriority="high">
  </div>
  <div class="hero-overlay" aria-hidden="true"></div>
  <div class="page-hero-content">
    <p class="eyebrow" style="color:var(--orange-400);">Services</p>
    <h1>Freight Transportation Services</h1>
    <p>Professional trucking and logistics options for commercial shippers. Each service below can be quoted based on your freight details; capabilities are confirmed during the booking process.</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <p class="availability-note reveal">Service descriptions explain the transportation solutions Trucking24Fit can quote. Do not assume every service is available on every lane until confirmed by our team for your shipment.</p>

    <?php foreach ($services as $service): ?>
      <article class="service-block reveal" id="<?= htmlspecialchars($service['id'], ENT_QUOTES, 'UTF-8') ?>">
        <div class="service-block-media">
          <img src="<?= htmlspecialchars($service['image'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($service['alt'], ENT_QUOTES, 'UTF-8') ?>" width="800" height="500" loading="lazy">
        </div>
        <div>
          <h2><?= htmlspecialchars($service['title'], ENT_QUOTES, 'UTF-8') ?></h2>
          <p><?= htmlspecialchars($service['desc'], ENT_QUOTES, 'UTF-8') ?></p>
          <h3 style="font-size:1.2rem;margin-top:1.25rem;">Benefits</h3>
          <ul class="benefit-list">
            <?php foreach ($service['benefits'] as $benefit): ?>
              <li><?= htmlspecialchars($benefit, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
          </ul>
          <a class="btn btn-accent" href="quote.php?service=<?= urlencode($service['title']) ?>">Request a Quote</a>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>

<section class="cta-band">
  <div class="container reveal">
    <h2>Need Help Selecting a Service?</h2>
    <p>Tell us about your freight type, equipment needs, and schedule. We will recommend a practical transportation approach for your shipment.</p>
    <a class="btn btn-accent" href="quote.php">Get a Freight Quote</a>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
