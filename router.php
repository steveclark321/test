<?php
/**
 * Front controller for PHP built-in server: php -S 127.0.0.1:8080 router.php
 * Serves clean URLs without exposing .php in the browser address bar.
 */
$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$uri = rawurldecode($uri ?: '/');
$path = rtrim($uri, '/') ?: '/';

$routes = [
    '/' => 'index.php',
    '/about' => 'about.php',
    '/services' => 'services.php',
    '/equipment' => 'equipment.php',
    '/industries' => 'industries.php',
    '/quote' => 'quote.php',
    '/contact' => 'contact.php',
    '/api/quote' => 'api/quote.php',
    '/api/contact' => 'api/contact.php',
];

// Redirect visible .php page URLs to clean paths
if (preg_match('#^/(index|about|services|equipment|industries|quote|contact)\.php$#', $path, $m)) {
    $target = $m[1] === 'index' ? '/' : '/' . $m[1];
    $qs = $_SERVER['QUERY_STRING'] ?? '';
    header('Location: ' . $target . ($qs !== '' ? '?' . $qs : ''), true, 301);
    return true;
}

if (isset($routes[$path])) {
    require __DIR__ . '/' . $routes[$path];
    return true;
}

$file = __DIR__ . $uri;
if ($uri !== '/' && is_file($file)) {
    return false; // let the server return the static file
}

http_response_code(404);
header('Content-Type: text/html; charset=UTF-8');
echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>Page Not Found | Trucking24Fit</title>';
echo '<link rel="stylesheet" href="/css/styles.css"></head><body>';
echo '<main class="section container"><h1>Page Not Found</h1>';
echo '<p>The page you requested is not available.</p>';
echo '<p><a class="btn btn-accent" href="/">Return Home</a></p></main></body></html>';
return true;
