<?php
/**
 * Shared site navigation.
 *
 * Accepts $args:
 *   'menu_items' => array of [ 'label' => string, 'href' => string ]
 *   'cta'        => [ 'label' => string, 'href' => string, 'target' => string ] or null
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$default_menu = array(
    array( 'label' => 'Voices', 'href' => home_url( '/#voices' ) ),
    array( 'label' => 'Pricing', 'href' => home_url( '/#pricing' ) ),
    array( 'label' => 'My Account', 'href' => home_url( '/manage/' ) ),
);
$default_cta = array(
    'label' => 'Get Started',
    'href'  => home_url( '/#get-started' ),
);
$menu_items = isset( $args['menu_items'] ) ? $args['menu_items'] : $default_menu;
$cta        = isset( $args['cta'] ) ? $args['cta'] : $default_cta;
?>
<nav class="nav" id="nav">
  <div class="container">
    <div class="nav__inner">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav__logo" aria-label="SiteStaffr home">
        <img
          class="nav__logo-image"
          src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/logo.webp' ) ); ?>"
          alt="SiteStaffr"
          width="625"
          height="188"
        >
      </a>
      <?php if ( $menu_items || $cta ) : ?>
      <ul class="nav__menu" id="navPrimaryMenu" aria-label="Primary">
        <?php foreach ( $menu_items as $item ) : ?>
        <li><a class="nav__link" href="<?php echo esc_url( $item['href'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a></li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
      <?php if ( $cta ) : ?>
      <div class="nav__cta">
        <a href="<?php echo esc_url( $cta['href'] ); ?>" class="btn btn--primary"<?php if ( ! empty( $cta['target'] ) ) : ?> target="<?php echo esc_attr( $cta['target'] ); ?>" rel="noopener noreferrer"<?php endif; ?>><?php echo esc_html( $cta['label'] ); ?></a>
      </div>
      <?php endif; ?>
      <?php if ( $menu_items || $cta ) : ?>
      <button
        class="nav__toggle"
        id="navToggle"
        type="button"
        aria-label="Toggle menu"
        aria-expanded="false"
        aria-controls="navPrimaryMenu"
      >
        <span class="nav__toggle-line"></span>
        <span class="nav__toggle-line"></span>
        <span class="nav__toggle-line"></span>
      </button>
      <?php endif; ?>
    </div>
  </div>
</nav>
<script>
(function() {
  var nav = document.getElementById('nav');
  if (!nav) return;

  var menu = document.getElementById('navPrimaryMenu');
  var toggle = document.getElementById('navToggle');
  var mobileNavQuery = window.matchMedia('(max-width: 768px)');

  /* Mobile menu state — mirrors existing site.js behavior exactly */
  function setMobileMenuState(isOpen) {
    if (!menu || !toggle) return;
    var shouldOpen = Boolean(isOpen) && mobileNavQuery.matches;
    nav.classList.toggle('menu-open', shouldOpen);
    menu.classList.toggle('is-open', shouldOpen);
    toggle.classList.toggle('is-open', shouldOpen);
    toggle.setAttribute('aria-expanded', shouldOpen ? 'true' : 'false');
  }

  /* Scroll detection */
  window.addEventListener('scroll', function() {
    if (window.scrollY > 60) {
      nav.classList.add('scrolled');
    } else {
      nav.classList.remove('scrolled');
    }
  }, { passive: true });

  if (menu && toggle) {
    toggle.addEventListener('click', function() {
      var isOpen = toggle.getAttribute('aria-expanded') === 'true';
      setMobileMenuState(!isOpen);
    });

    menu.querySelectorAll('a').forEach(function(link) {
      link.addEventListener('click', function() { setMobileMenuState(false); });
    });

    /* Close on outside click */
    document.addEventListener('click', function(e) {
      if (!mobileNavQuery.matches) return;
      if (!nav.contains(e.target)) {
        setMobileMenuState(false);
      }
    });

    /* Close on Escape */
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        setMobileMenuState(false);
      }
    });

    /* Close menu when viewport resizes past mobile breakpoint */
    var syncMenuForViewport = function() {
      if (!mobileNavQuery.matches) {
        setMobileMenuState(false);
      }
    };
    if (typeof mobileNavQuery.addEventListener === 'function') {
      mobileNavQuery.addEventListener('change', syncMenuForViewport);
    } else {
      mobileNavQuery.addListener(syncMenuForViewport);
    }

    setMobileMenuState(false);
  }
})();
</script>
