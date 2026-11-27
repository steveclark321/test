<?php
/**
 * Shared helpers for form submissions.
 */

function t24_config(): array
{
    static $config = null;
    if ($config === null) {
        $config = require __DIR__ . '/config.php';
    }
    return $config;
}

function t24_json_response(bool $ok, string $message, int $status = 200, array $extra = []): void
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    header('X-Content-Type-Options: nosniff');
    echo json_encode(array_merge(['success' => $ok, 'message' => $message], $extra));
    exit;
}

function t24_read_json_body(): array
{
    $raw = file_get_contents('php://input');
    if ($raw === false || $raw === '') {
        return $_POST ?: [];
    }
    $decoded = json_decode($raw, true);
    return is_array($decoded) ? $decoded : ($_POST ?: []);
}

function t24_clean(string $value, int $max = 500): string
{
    $value = trim(strip_tags($value));
    if (mb_strlen($value) > $max) {
        $value = mb_substr($value, 0, $max);
    }
    return $value;
}

function t24_client_ip(): string
{
    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}

function t24_rate_limited(string $bucket): bool
{
    $config = t24_config();
    $limit = (int) ($config['rate_limit_per_hour'] ?? 10);
    if ($limit <= 0) {
        return false;
    }

    $dir = dirname(__DIR__) . '/submissions/.rate';
    if (!is_dir($dir)) {
        @mkdir($dir, 0750, true);
    }

    $ip = preg_replace('/[^a-zA-Z0-9\.\-_:]/', '_', t24_client_ip());
    $file = $dir . '/' . $bucket . '_' . $ip . '.json';
    $now = time();
    $window = 3600;
    $entries = [];

    if (is_file($file)) {
        $data = json_decode((string) file_get_contents($file), true);
        if (is_array($data)) {
            $entries = array_values(array_filter($data, static fn($t) => is_int($t) && ($now - $t) < $window));
        }
    }

    if (count($entries) >= $limit) {
        return true;
    }

    $entries[] = $now;
    file_put_contents($file, json_encode($entries), LOCK_EX);
    return false;
}

function t24_save_submission(string $type, array $payload): ?string
{
    $config = t24_config();
    if (empty($config['save_submissions'])) {
        return null;
    }

    $dir = dirname(__DIR__) . '/submissions';
    if (!is_dir($dir)) {
        @mkdir($dir, 0750, true);
    }

    $id = date('Ymd-His') . '-' . bin2hex(random_bytes(4));
    $record = [
        'id' => $id,
        'type' => $type,
        'received_at' => date('c'),
        'ip' => t24_client_ip(),
        'user_agent' => substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 300),
        'payload' => $payload,
    ];

    $path = $dir . '/' . $type . '-' . $id . '.json';
    file_put_contents($path, json_encode($record, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), LOCK_EX);
    return $id;
}

function t24_send_notification(string $subject, string $bodyText, array $replyTo = []): bool
{
    $config = t24_config();
    $sent = false;

    if (!empty($config['send_email']) && !empty($config['notification_email'])) {
        $to = $config['notification_email'];
        $fromEmail = $config['from_email'] ?? 'noreply@localhost';
        $fromName = $config['from_name'] ?? 'Trucking24Fit Website';
        $headers = [
            'MIME-Version: 1.0',
            'Content-Type: text/plain; charset=UTF-8',
            'From: ' . sprintf('"%s" <%s>', addslashes($fromName), $fromEmail),
            'X-Mailer: Trucking24Fit-Forms/1.0',
        ];
        if (!empty($replyTo['email'])) {
            $name = $replyTo['name'] ?? $replyTo['email'];
            $headers[] = 'Reply-To: ' . sprintf('"%s" <%s>', addslashes($name), $replyTo['email']);
        }
        $sent = @mail($to, '=?UTF-8?B?' . base64_encode($subject) . '?=', $bodyText, implode("\r\n", $headers));
    }

    if (!empty($config['webhook_url'])) {
        $ch = curl_init($config['webhook_url']);
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            CURLOPT_POSTFIELDS => json_encode([
                'subject' => $subject,
                'body' => $bodyText,
                'reply_to' => $replyTo,
            ]),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 8,
        ]);
        $response = curl_exec($ch);
        $code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($code >= 200 && $code < 300) {
            $sent = true;
        }
        unset($response);
    }

    return $sent;
}

function t24_require_post(): void
{
    if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
        t24_json_response(false, 'Method not allowed.', 405);
    }
}

function t24_check_honeypot(array $data): void
{
    $field = t24_config()['honeypot_field'] ?? 'website_url';
    if (!empty($data[$field])) {
        // Silent success for bots
        t24_json_response(true, 'Thank you. Your request has been received.');
    }
}
