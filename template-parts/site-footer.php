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
              src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/logo-240.webp' ) ); ?>"
              alt="SiteStaffr"
              width="240"
              height="72"
              class="footer__logo-image"
            >
          </a>
          <p class="footer__tagline">AI voice and text agents for service businesses on WordPress.</p>
        </div>

        <nav class="footer__nav" aria-label="Footer navigation">
          <div class="footer__col">
            <h3 class="footer__heading">Product</h3>
            <ul>
              <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
              <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a></li>
              <li><a href="<?php echo esc_url( home_url( '/salesforce/' ) ); ?>">Salesforce Integration</a></li>
              <li><a href="<?php echo esc_url( home_url( '/#get-started' ) ); ?>">Get Started</a></li>
              <li><a href="<?php echo esc_url( home_url( '/download/' ) ); ?>">Download Plugin</a></li>
              <li><a href="https://wordpress.org/plugins/sitestaffr/" target="_blank" rel="noopener">WordPress.org</a></li>
            </ul>
          </div>
          <?php $sitestaffr_categories = sitestaffr_industry_categories(); ?>
          <?php if ( ! empty( $sitestaffr_categories ) ) : ?>
          <div class="footer__col">
            <h3 class="footer__heading">Industries</h3>
            <ul>
              <?php foreach ( $sitestaffr_categories as $sitestaffr_category ) : ?>
              <li><a href="<?php echo esc_url( home_url( '/for/' . $sitestaffr_category['slug'] . '/' ) ); ?>"><?php echo esc_html( $sitestaffr_category['label'] ); ?></a></li>
              <?php endforeach; ?>
              <li><a href="<?php echo esc_url( home_url( '/for/' ) ); ?>" class="footer__all-industries">All industries &rarr;</a></li>
            </ul>
          </div>
          <?php endif; ?>
          <div class="footer__col">
            <h3 class="footer__heading">Company</h3>
            <ul>
              <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About</a></li>
              <li><a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">Privacy Policy</a></li>
              <li><a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>">Terms of Service</a></li>
              <li><a href="mailto:support@sitestaffr.com">Support</a></li>
              <li class="footer__account-mobile"><a href="<?php echo esc_url( home_url( '/manage/' ) ); ?>" class="footer__login">My Account &rarr;</a></li>
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
