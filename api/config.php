<?php
/**
 * Trucking24Fit — Form & site configuration
 * Update these values before going live.
 */
return [
    // Destination inbox for quote & contact submissions
    'notification_email' => 'quotes@example.com',

    // From address used in outbound notification emails (must be allowed by your host)
    'from_email' => 'noreply@example.com',
    'from_name'  => 'Trucking24Fit Website',

    // Company display placeholders (edit for production)
    'company_name'    => 'Trucking24Fit',
    'company_phone'   => '(555) 000-0000',
    'company_email'   => 'info@example.com',
    'company_address' => '123 Freight Way, Suite 100, City, ST 00000',
    'business_hours'  => 'Monday – Friday, 8:00 AM – 6:00 PM ET',

    // Persist submissions as JSON under /submissions (recommended as a backup)
    'save_submissions' => true,

    // Attempt PHP mail() delivery (requires a working mail transport on the host)
    'send_email' => true,

    // Optional webhook URL (e.g. Zapier / Make / custom endpoint). Leave empty to disable.
    'webhook_url' => '',

    // Honeypot field name — leave empty in real browser forms; bots often fill it
    'honeypot_field' => 'website_url',

    // Simple rate limit: max submissions per IP per hour
    'rate_limit_per_hour' => 10,
];
