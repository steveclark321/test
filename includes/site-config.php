<?php
/**
 * Public site display settings — keep in sync with api/config.php for contact details.
 */
$site = [
    'name' => 'Trucking24Fit',
    'tagline' => 'Moving Freight. Delivering Reliability.',
    'phone' => '(555) 000-0000',
    'phone_href' => 'tel:+15550000000',
    'email' => 'info@example.com',
    'email_href' => 'mailto:info@example.com',
    'address' => '123 Freight Way, Suite 100, City, ST 00000',
    'hours' => 'Monday – Friday, 8:00 AM – 6:00 PM ET',
    'map_embed' => '', // Paste a Google Maps iframe src URL when available
    'base_url' => '', // e.g. https://www.trucking24fit.com — used in sitemap/canonicals when set
];

$nav_items = [
    ['label' => 'Home', 'href' => 'index.php'],
    ['label' => 'About Us', 'href' => 'about.php'],
    ['label' => 'Services', 'href' => 'services.php'],
    ['label' => 'Equipment', 'href' => 'equipment.php'],
    ['label' => 'Industries', 'href' => 'industries.php'],
    ['label' => 'Contact', 'href' => 'contact.php'],
];

$services_nav = [
    ['label' => 'Full Truckload (FTL)', 'href' => 'services.php#ftl'],
    ['label' => 'Less Than Truckload (LTL)', 'href' => 'services.php#ltl'],
    ['label' => 'Dedicated Transportation', 'href' => 'services.php#dedicated'],
    ['label' => 'Regional Freight', 'href' => 'services.php#regional'],
    ['label' => 'Long-Haul Trucking', 'href' => 'services.php#long-haul'],
    ['label' => 'Expedited Freight', 'href' => 'services.php#expedited'],
    ['label' => 'Commercial Freight Delivery', 'href' => 'services.php#commercial'],
    ['label' => 'Logistics Coordination', 'href' => 'services.php#logistics'],
];
