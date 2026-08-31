<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php /* THE SHAPE DIVIDER BELONGS TO THE FOOTER (Mario, 2026-08-30: "The Shape
         Divider should be on the Footer not the CTA").

         It used to be the closing section's: page-landing.php rendered it as the last
         child of .final-cta, and the ind-* conversion had briefly copied that idea onto
         each CTA. That meant every template that wanted the gesture had to remember to
         add it, and three of them did not have it at all. Here it is rendered once and
         appears on every page that uses the footer.

         ⚠️ THE HOMEPAGE COPY WAS DELETED IN THE SAME COMMIT. Two curtains stacked on
         one boundary is not a subtle bug — it is the shape drawn twice.

         Fill is --footer-dark rather than --block-dark, so it matches the footer it
         rises out of. Both sides read the same token and cannot drift. */ ?>
<?php /* ⚠️ THE CURTAIN SITS OUTSIDE <footer>, IN A ZERO-HEIGHT WRAPPER, AND IT HAS TO.
         Rendered as the footer's first child it was completely invisible while being
         perfectly positioned — right size, right fill, offsetParent correct, rect 98px
         above the footer's top edge. `.footer` carries `overflow: hidden`, so an
         absolutely-positioned child hanging ABOVE the box is clipped away entirely.
         Nothing about that shows up in a diff, and elementFromPoint cannot detect it
         either because the seam is pointer-events:none.

         .footer-seam is height:0 and position:relative, so it sits exactly on the
         footer's top edge and the curtain's own `bottom: -1px` hangs it upward over
         the section above. Not clipped, because this wrapper has no overflow of its
         own — and the footer's overflow:hidden is left alone rather than removed,
         since it is load-bearing for the footer's own content. */ ?>
<div class="footer-seam" aria-hidden="true">
  <?php get_template_part( 'template-parts/seam-curtain' ); ?>
</div>
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
          <?php /* Positioning realigned 2026-08-26 with the V3 H1. Was "AI voice and text agents
         for service businesses on WordPress" - the superseded framing. This tagline is
         the most-repeated sentence on the site: it renders under EVERY page, so leaving
         it on the old term would have the site contradicting its own headline site-wide.

         "receptionist" never alone - the second clause breaks the ceiling the word sets,
         because the product also writes blogs, sends recaps and speaks. */ ?>
          <p class="footer__tagline">An AI receptionist for your website &mdash; answering visitors, capturing leads and writing your blog.</p>
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
