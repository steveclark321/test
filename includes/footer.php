<?php require_once __DIR__ . '/site-config.php'; ?>
  </main>
  <footer class="site-footer">
    <div class="footer-top">
      <div class="container footer-grid">
        <div class="footer-brand">
          <img src="assets/images/logo-white.svg" alt="Trucking24Fit" width="200" height="46">
          <p>Professional trucking, freight transportation, and logistics support for commercial shippers who need dependable service and clear communication.</p>
          <a class="btn btn-accent btn-sm" href="quote.php">Request a Quote</a>
        </div>
        <div>
          <h3>Company</h3>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="equipment.php">Equipment &amp; Fleet</a></li>
            <li><a href="industries.php">Industries</a></li>
            <li><a href="contact.php">Contact</a></li>
          </ul>
        </div>
        <div>
          <h3>Services</h3>
          <ul>
            <?php foreach (array_slice($services_nav, 0, 6) as $svc): ?>
              <li><a href="<?= htmlspecialchars($svc['href'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($svc['label'], ENT_QUOTES, 'UTF-8') ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div>
          <h3>Contact</h3>
          <ul class="footer-contact">
            <li><a href="<?= htmlspecialchars($site['phone_href'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($site['phone'], ENT_QUOTES, 'UTF-8') ?></a></li>
            <li><a href="<?= htmlspecialchars($site['email_href'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($site['email'], ENT_QUOTES, 'UTF-8') ?></a></li>
            <li><?= htmlspecialchars($site['address'], ENT_QUOTES, 'UTF-8') ?></li>
            <li><?= htmlspecialchars($site['hours'], ENT_QUOTES, 'UTF-8') ?></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container footer-bottom-inner">
        <p>&copy; <?= date('Y') ?> Trucking24Fit. All rights reserved.</p>
        <p class="footer-note">Contact details and service availability are placeholders pending company confirmation.</p>
      </div>
    </div>
  </footer>
  <div id="toast" class="toast" role="status" aria-live="polite" hidden></div>
  <script src="js/main.js" defer></script>
</body>
</html>
