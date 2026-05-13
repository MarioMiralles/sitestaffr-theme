<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<footer class="footer">
  <div class="container">
    <div class="footer__links">
      <a href="<?php echo esc_url( home_url( '/privacy' ) ); ?>">Privacy Policy</a>
      <a href="<?php echo esc_url( home_url( '/terms' ) ); ?>">Terms of Service</a>
      <a href="mailto:support@sitestaffr.com">Support</a>
      <a href="<?php echo esc_url( home_url( '/manage/' ) ); ?>">My Account</a>
    </div>
    <p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> SiteStaffr. All rights reserved.</p>
  </div>
</footer>
