<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<footer class="footer">
  <div class="footer__main">
    <div class="container">
      <div class="footer__grid">
        <div class="footer__brand">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer__logo" aria-label="SiteStaffr home">
            <img
              src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/logo.webp' ) ); ?>"
              alt="SiteStaffr"
              width="625"
              height="188"
              class="footer__logo-image"
            >
          </a>
          <p class="footer__tagline">AI voice and text agents for service businesses on WordPress.</p>
        </div>

        <nav class="footer__nav" aria-label="Footer navigation">
          <div class="footer__col">
            <h4 class="footer__heading">Product</h4>
            <ul>
              <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
              <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a></li>
              <li><a href="<?php echo esc_url( home_url( '/#get-started' ) ); ?>">Get Started</a></li>
            </ul>
          </div>
          <div class="footer__col">
            <h4 class="footer__heading">Industries</h4>
            <ul>
              <li><a href="<?php echo esc_url( home_url( '/for/dental-practices/' ) ); ?>">Dental Practices</a></li>
              <li><a href="<?php echo esc_url( home_url( '/for/law-firms/' ) ); ?>">Law Firms</a></li>
              <li><a href="<?php echo esc_url( home_url( '/for/home-services/' ) ); ?>">Home Services</a></li>
            </ul>
          </div>
          <div class="footer__col">
            <h4 class="footer__heading">Company</h4>
            <ul>
              <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About</a></li>
              <li><a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">Privacy Policy</a></li>
              <li><a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>">Terms of Service</a></li>
              <li><a href="mailto:support@sitestaffr.com">Support</a></li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
  </div>

  <div class="footer__bottom">
    <div class="container">
      <div class="footer__bottom-inner">
        <p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> SiteStaffr. All rights reserved.</p>
        <a href="<?php echo esc_url( home_url( '/manage/' ) ); ?>" class="footer__login">My Account &rarr;</a>
      </div>
    </div>
  </div>
</footer>
