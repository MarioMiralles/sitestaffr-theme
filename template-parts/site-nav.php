<?php
/**
 * Shared site navigation.
 *
 * Accepts $args:
 *   'secondary' => array of [ 'label' => string, 'href' => string ] — page-specific links (e.g. anchor links on homepage)
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$primary_menu = array(
    array(
        'label'    => 'Industries',
        'href'     => '#',
        'children' => array(
            array( 'label' => 'Dental Practices', 'href' => home_url( '/for/dental-practices/' ) ),
            array( 'label' => 'Law Firms',         'href' => home_url( '/for/law-firms/' ) ),
            array( 'label' => 'Home Services',     'href' => home_url( '/for/home-services/' ) ),
        ),
    ),
    array( 'label' => 'Blog',  'href' => home_url( '/blog/' ) ),
    array( 'label' => 'About', 'href' => home_url( '/about/' ) ),
);

$secondary_menu = isset( $args['secondary'] ) ? $args['secondary'] : array();

$cta = array(
    'label' => 'Get Started',
    'href'  => home_url( '/#get-started' ),
);
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
          fetchpriority="high"
        >
      </a>
      <ul class="nav__menu" id="navPrimaryMenu" aria-label="Primary">
        <?php if ( $secondary_menu ) : ?>
          <?php foreach ( $secondary_menu as $item ) : ?>
        <li class="nav__secondary-item"><a class="nav__link" href="<?php echo esc_url( $item['href'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a></li>
          <?php endforeach; ?>
        <li class="nav__divider" aria-hidden="true"></li>
        <?php endif; ?>
        <?php foreach ( $primary_menu as $item ) : ?>
          <?php if ( ! empty( $item['children'] ) ) : ?>
        <li class="nav__dropdown">
          <button class="nav__link nav__dropdown-toggle" type="button" aria-expanded="false">
            <?php echo esc_html( $item['label'] ); ?>
            <svg class="nav__dropdown-arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <ul class="nav__dropdown-menu">
            <?php foreach ( $item['children'] as $child ) : ?>
            <li><a class="nav__dropdown-link" href="<?php echo esc_url( $child['href'] ); ?>"><?php echo esc_html( $child['label'] ); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>
          <?php else : ?>
        <li><a class="nav__link" href="<?php echo esc_url( $item['href'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a></li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
      <div class="nav__cta">
        <a href="<?php echo esc_url( $cta['href'] ); ?>" class="btn btn--primary"><?php echo esc_html( $cta['label'] ); ?></a>
      </div>
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

  function setMobileMenuState(isOpen) {
    if (!menu || !toggle) return;
    var shouldOpen = Boolean(isOpen) && mobileNavQuery.matches;
    nav.classList.toggle('menu-open', shouldOpen);
    menu.classList.toggle('is-open', shouldOpen);
    toggle.classList.toggle('is-open', shouldOpen);
    toggle.setAttribute('aria-expanded', shouldOpen ? 'true' : 'false');
  }

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

    document.addEventListener('click', function(e) {
      if (!mobileNavQuery.matches) return;
      if (!nav.contains(e.target)) {
        setMobileMenuState(false);
      }
    });

    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        setMobileMenuState(false);
      }
    });

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

  /* Dropdown toggles */
  nav.querySelectorAll('.nav__dropdown-toggle').forEach(function(btn) {
    var parent = btn.closest('.nav__dropdown');
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      var open = btn.getAttribute('aria-expanded') === 'true';
      nav.querySelectorAll('.nav__dropdown').forEach(function(d) {
        d.classList.remove('is-open');
        d.querySelector('.nav__dropdown-toggle').setAttribute('aria-expanded', 'false');
      });
      if (!open) {
        parent.classList.add('is-open');
        btn.setAttribute('aria-expanded', 'true');
      }
    });
  });

  document.addEventListener('click', function(e) {
    if (!e.target.closest('.nav__dropdown')) {
      nav.querySelectorAll('.nav__dropdown').forEach(function(d) {
        d.classList.remove('is-open');
        d.querySelector('.nav__dropdown-toggle').setAttribute('aria-expanded', 'false');
      });
    }
  });
})();
</script>
