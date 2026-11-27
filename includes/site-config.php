<?php
/**
 * Public site display settings — keep in sync with api/config.php for contact details.
 */
$site = [
    'name' => 'Trucking24Fit',
    'tagline' => 'Moving Freight. Delivering Reliability.',
    'phone' => '',
    'phone_href' => '',
    'email' => 'contact@trucking24fit.org',
    'email_href' => 'mailto:contact@trucking24fit.org',
    'address' => '24820 NE 135th Lane, Fort McCoy, FL 32134',
    'address_line1' => '24820 NE 135th Lane',
    'address_line2' => 'Fort McCoy, FL 32134',
    'hours' => 'Monday – Friday, 8:00 AM – 6:00 PM ET',
    'map_embed' => 'https://maps.google.com/maps?q=24820+NE+135th+Lane,+Fort+McCoy,+FL+32134&z=14&output=embed',
    'base_url' => 'https://trucking24fit.org',
];

$nav_items = [
    ['label' => 'Home', 'href' => '/', 'slug' => 'home'],
    ['label' => 'About Us', 'href' => '/about', 'slug' => 'about'],
    ['label' => 'Services', 'href' => '/services', 'slug' => 'services'],
    ['label' => 'Equipment', 'href' => '/equipment', 'slug' => 'equipment'],
    ['label' => 'Industries', 'href' => '/industries', 'slug' => 'industries'],
    ['label' => 'Contact', 'href' => '/contact', 'slug' => 'contact'],
];

$services_nav = [
    ['label' => 'Full Truckload (FTL)', 'href' => '/services#ftl'],
    ['label' => 'Less Than Truckload (LTL)', 'href' => '/services#ltl'],
    ['label' => 'Dedicated Transportation', 'href' => '/services#dedicated'],
    ['label' => 'Regional Freight', 'href' => '/services#regional'],
    ['label' => 'Long-Haul Trucking', 'href' => '/services#long-haul'],
    ['label' => 'Expedited Freight', 'href' => '/services#expedited'],
    ['label' => 'Commercial Freight Delivery', 'href' => '/services#commercial'],
    ['label' => 'Logistics Coordination', 'href' => '/services#logistics'],
];
