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
        'label'    => 'Features',
        'href'     => '#',
        'children' => array(
            array( 'label' => 'AI Blog Writer', 'href' => home_url( '/blog-agent/' ) ),
            array( 'label' => 'Salesforce Integration', 'href' => home_url( '/salesforce/' ) ),
        ),
    ),
    array(
        'label'      => 'Industries',
        'href'       => '#',
        'menu_class' => 'nav__dropdown-menu--mega',
        // Grouped panel on desktop, stacked list with the same headings on
        // mobile — same dropdown component, same open/close JS. The industries
        // themselves come from the registry in functions.php (one source of
        // truth for nav, footer, /for/ index, llms.txt and page provisioning).
        'groups'     => array_map(
            function ( $group ) {
                return array(
                    'heading' => $group['heading'],
                    // ⚠️ THE HEADING IS A LINK, AND WITHOUT THIS THE FIVE CATEGORY
                    // HUBS HAD NO PATH FROM THE NAV AT ALL
                    // "I'm unable to access the /for or the /health-medical from
                    // the nav"). They were plain <span>s, so /for/health-medical/
                    // and its four siblings existed, were provisioned, were
                    // indexed and were linked from the footer — and the one menu
                    // that lists every industry could not reach them. The heading
                    // is the only element in the panel that names a category, so
                    // it is the only place the link belongs.
                    'href'    => ! empty( $group['slug'] ) ? home_url( '/for/' . $group['slug'] . '/' ) : '',
                    'items'   => array_map(
                        function ( $industry ) {
                            return array(
                                'label' => isset( $industry['label'] ) ? $industry['label'] : $industry['title'],
                                'href'  => home_url( '/for/' . $industry['slug'] . '/' ),
                            );
                        },
                        $group['industries']
                    ),
                );
            },
            sitestaffr_industry_registry()
        ),
    ),
    // Agencies is a TOP-LEVEL item, deliberately not inside the Industries
    // dropdown. Agencies are an audience, not an industry: they are not in
    // sitestaffr_industry_registry, and putting them there would drop them
    // into section 6's list of sixteen businesses alongside dental practices
    // and salons, which is the wrong shelf.
    //
    // It sits before Blog and About because it is the only nav item addressing
    // the second audience, and the ones who self-classify do it in the first
    // few seconds — after that they are reading a page written to a plumber.
    array( 'label' => 'Agencies', 'href' => home_url( '/for/agencies/' ) ),
    array( 'label' => 'Blog',  'href' => home_url( '/blog/' ) ),
    array( 'label' => 'About', 'href' => home_url( '/about/' ) ),
);

$secondary_menu = isset( $args['secondary'] ) ? $args['secondary'] : array();

// Self-serve is the primary conversion path. The trial starts when the plugin's
// Setup Wizard registers the site, so /download/ is the trial: there is no separate
// signup, and this must not point at the white-glove form.
$cta = array(
    'label' => 'Start Free Trial',
    'href'  => home_url( '/download/' ),
);
?>
<nav class="nav" id="nav">
  <div class="container">
    <div class="nav__inner">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav__logo" aria-label="SiteStaffr home">
        <img
          class="nav__logo-image"
          src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/logo-240.webp' ) ); ?>"
          alt="SiteStaffr"
          width="240"
          height="72"
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
          <?php if ( ! empty( $item['groups'] ) ) : ?>
        <li class="nav__dropdown">
          <button class="nav__link nav__dropdown-toggle" type="button" aria-expanded="false">
            <?php echo esc_html( $item['label'] ); ?>
            <svg class="nav__dropdown-arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <ul class="nav__dropdown-menu<?php echo ! empty( $item['menu_class'] ) ? ' ' . esc_attr( $item['menu_class'] ) : ''; ?>">
            <?php foreach ( $item['groups'] as $group ) : ?>
            <li class="nav__mega-group">
              <?php if ( ! empty( $group['href'] ) ) : ?>
              <a class="nav__mega-heading nav__mega-heading--link" href="<?php echo esc_url( $group['href'] ); ?>"><?php echo esc_html( $group['heading'] ); ?></a>
              <?php else : ?>
              <span class="nav__mega-heading"><?php echo esc_html( $group['heading'] ); ?></span>
              <?php endif; ?>
              <ul class="nav__mega-list">
                <?php foreach ( $group['items'] as $child ) : ?>
                <li><a class="nav__dropdown-link" href="<?php echo esc_url( $child['href'] ); ?>"><?php echo esc_html( $child['label'] ); ?></a></li>
                <?php endforeach; ?>
              </ul>
            </li>
            <?php endforeach; ?>
            <?php /* The arrow is not decoration: this row sits below sixteen
                     industry names and read as a seventeenth one. it was not possible to
                     find /for/ from the nav even though this link has always been
                     here. An arrow is the one mark that says "this goes somewhere
                     else", which is what separates it from the list above it. */ ?>
            <li class="nav__mega-all"><a class="nav__dropdown-link" href="<?php echo esc_url( home_url( '/for/' ) ); ?>">See all industries <span aria-hidden="true">&rarr;</span></a></li>
          </ul>
        </li>
          <?php elseif ( ! empty( $item['children'] ) ) : ?>
        <li class="nav__dropdown">
          <button class="nav__link nav__dropdown-toggle" type="button" aria-expanded="false">
            <?php echo esc_html( $item['label'] ); ?>
            <svg class="nav__dropdown-arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <ul class="nav__dropdown-menu<?php echo ! empty( $item['menu_class'] ) ? ' ' . esc_attr( $item['menu_class'] ) : ''; ?>">
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
