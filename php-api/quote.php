<?php
require __DIR__ . '/mailer.php';

t24_require_post();

if (t24_rate_limited('quote')) {
    t24_json_response(false, 'Too many requests. Please try again later.', 429);
}

$data = t24_read_json_body();
t24_check_honeypot($data);

$fields = [
    'full_name' => ['label' => 'Full Name', 'required' => true, 'max' => 120],
    'company_name' => ['label' => 'Company Name', 'required' => true, 'max' => 160],
    'business_email' => ['label' => 'Business Email', 'required' => true, 'max' => 160, 'email' => true],
    'phone' => ['label' => 'Phone Number', 'required' => true, 'max' => 40],
    'pickup_location' => ['label' => 'Pickup Location', 'required' => true, 'max' => 200],
    'delivery_location' => ['label' => 'Delivery Location', 'required' => true, 'max' => 200],
    'freight_type' => ['label' => 'Freight Type', 'required' => true, 'max' => 120],
    'equipment_required' => ['label' => 'Equipment Required', 'required' => true, 'max' => 120],
    'estimated_weight' => ['label' => 'Estimated Weight', 'required' => false, 'max' => 80],
    'number_of_pallets' => ['label' => 'Number of Pallets', 'required' => false, 'max' => 40],
    'pickup_date' => ['label' => 'Pickup Date', 'required' => false, 'max' => 40],
    'delivery_date' => ['label' => 'Delivery Date', 'required' => false, 'max' => 40],
    'additional_details' => ['label' => 'Additional Shipment Details', 'required' => false, 'max' => 2000],
];

$clean = [];
$errors = [];

foreach ($fields as $key => $meta) {
    $value = t24_clean((string) ($data[$key] ?? ''), $meta['max']);
    if ($meta['required'] && $value === '') {
        $errors[] = $meta['label'] . ' is required.';
        continue;
    }
    if (!empty($meta['email']) && $value !== '' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid business email address.';
        continue;
    }
    $clean[$key] = $value;
}

if ($errors) {
    t24_json_response(false, implode(' ', $errors), 422);
}

$id = t24_save_submission('quote', $clean);

$lines = ["New freight quote request from the Trucking24Fit website.", '', 'Reference: ' . ($id ?? 'n/a'), ''];
foreach ($fields as $key => $meta) {
    $lines[] = $meta['label'] . ': ' . ($clean[$key] !== '' ? $clean[$key] : '—');
}
$body = implode("\n", $lines);

$emailSent = t24_send_notification(
    'Freight Quote Request — ' . $clean['company_name'],
    $body,
    ['name' => $clean['full_name'], 'email' => $clean['business_email']]
);

if (!$emailSent && $id === null) {
    t24_json_response(false, 'Unable to process your request right now. Please call us or email directly.', 500);
}

t24_json_response(true, 'Thank you. Your quote request has been submitted. Our team will follow up shortly.', 200, [
    'reference' => $id,
]);
