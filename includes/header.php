<?php
require_once __DIR__ . '/site-config.php';
$page_title = $page_title ?? 'Trucking24Fit | Trucking & Freight Transportation';
$page_description = $page_description ?? 'Trucking24Fit provides professional trucking, freight transportation, and logistics services for commercial shippers from Fort McCoy, Florida.';
$current_page = $current_page ?? '';
$body_class = $body_class ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?></title>
  <meta name="description" content="<?= htmlspecialchars($page_description, ENT_QUOTES, 'UTF-8') ?>">
  <meta name="theme-color" content="#0A1628">
  <meta property="og:title" content="<?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?>">
  <meta property="og:description" content="<?= htmlspecialchars($page_description, ENT_QUOTES, 'UTF-8') ?>">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Trucking24Fit">
  <link rel="icon" href="/assets/images/favicon.svg" type="image/svg+xml">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/styles.css">
</head>
<body class="<?= htmlspecialchars($body_class, ENT_QUOTES, 'UTF-8') ?>">
  <a class="skip-link" href="#main">Skip to main content</a>
  <header class="site-header" id="top">
    <div class="header-inner">
      <a class="brand" href="/" aria-label="Trucking24Fit home">
        <img src="/assets/images/logo-white.svg" alt="Trucking24Fit" width="200" height="46" class="brand-logo">
      </a>
      <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav" aria-label="Open menu">
        <span></span><span></span><span></span>
      </button>
      <nav class="primary-nav" id="primary-nav" aria-label="Primary">
        <ul>
          <?php foreach ($nav_items as $item): ?>
            <?php $active = ($current_page === $item['slug']) ? ' aria-current="page"' : ''; ?>
            <li><a href="<?= htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8') ?>"<?= $active ?>><?= htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8') ?></a></li>
          <?php endforeach; ?>
          <li class="nav-cta"><a class="btn btn-accent btn-sm" href="/quote">Request a Quote</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <main id="main">
