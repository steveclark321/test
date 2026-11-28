<?php require_once __DIR__ . '/site-config.php'; ?>
  </main>
  <footer class="site-footer">
    <div class="footer-top">
      <div class="container footer-grid">
        <div class="footer-brand">
          <img src="/assets/images/logo-white.svg" alt="Trucking24Fit" width="220" height="40">
          <p>Trucking24Fit provides professional trucking, freight transportation, and logistics support for commercial shippers across Florida and nationwide lanes.</p>
          <a class="btn btn-accent btn-sm" href="/quote">Request a Quote</a>
        </div>
        <div>
          <h3>Company</h3>
          <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/about">About Us</a></li>
            <li><a href="/about#insurance">Insurance</a></li>
            <li><a href="/services">Services</a></li>
            <li><a href="/equipment">Equipment &amp; Fleet</a></li>
            <li><a href="/industries">Industries</a></li>
            <li><a href="/contact">Contact</a></li>
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
            <li><a href="<?= htmlspecialchars($site['email_href'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($site['email'], ENT_QUOTES, 'UTF-8') ?></a></li>
            <li><?= htmlspecialchars($site['address_line1'], ENT_QUOTES, 'UTF-8') ?></li>
            <li><?= htmlspecialchars($site['address_line2'], ENT_QUOTES, 'UTF-8') ?></li>
            <li><?= htmlspecialchars($site['hours'], ENT_QUOTES, 'UTF-8') ?></li>
          </ul>
          <h3 style="margin-top:1.5rem;">Legal</h3>
          <ul>
            <li><a href="/privacy">Privacy Policy</a></li>
            <li><a href="/terms">Terms of Use</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container footer-bottom-inner">
        <p>&copy; <?= date('Y') ?> Trucking24Fit. All rights reserved.</p>
        <p class="footer-note"><a href="/privacy">Privacy</a> · <a href="/terms">Terms</a> · Fort McCoy, Florida</p>
      </div>
    </div>
  </footer>
  <div id="toast" class="toast" role="status" aria-live="polite" hidden></div>
  <script src="/js/main.js" defer></script>
</body>
</html>
