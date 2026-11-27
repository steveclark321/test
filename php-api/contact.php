<?php
require __DIR__ . '/mailer.php';

t24_require_post();

if (t24_rate_limited('contact')) {
    t24_json_response(false, 'Too many requests. Please try again later.', 429);
}

$data = t24_read_json_body();
t24_check_honeypot($data);

$fields = [
    'full_name' => ['label' => 'Full Name', 'required' => true, 'max' => 120],
    'company_name' => ['label' => 'Company Name', 'required' => false, 'max' => 160],
    'email' => ['label' => 'Email', 'required' => true, 'max' => 160, 'email' => true],
    'phone' => ['label' => 'Phone', 'required' => false, 'max' => 40],
    'subject' => ['label' => 'Subject', 'required' => true, 'max' => 160],
    'message' => ['label' => 'Message', 'required' => true, 'max' => 3000],
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
        $errors[] = 'Please enter a valid email address.';
        continue;
    }
    $clean[$key] = $value;
}

if ($errors) {
    t24_json_response(false, implode(' ', $errors), 422);
}

$id = t24_save_submission('contact', $clean);

$lines = ["New contact message from the Trucking24Fit website.", '', 'Reference: ' . ($id ?? 'n/a'), ''];
foreach ($fields as $key => $meta) {
    $lines[] = $meta['label'] . ': ' . ($clean[$key] !== '' ? $clean[$key] : '—');
}
$body = implode("\n", $lines);

$emailSent = t24_send_notification(
    'Contact Form — ' . $clean['subject'],
    $body,
    ['name' => $clean['full_name'], 'email' => $clean['email']]
);

if (!$emailSent && $id === null) {
    t24_json_response(false, 'Unable to process your message right now. Please call us or email directly.', 500);
}

t24_json_response(true, 'Thank you. Your message has been sent. We will get back to you soon.', 200, [
    'reference' => $id,
]);
