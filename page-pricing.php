<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$page_title       = 'Pricing | SiteStaffr — Simple, Transparent Plans';
$page_description = 'SiteStaffr pricing: Free trial, Starter ($10/mo), Business ($50/mo), and Pro ($100/mo). All plans include text chat, email recaps, transcripts, and 57+ languages.';
$page_url         = home_url( '/pricing/' );
$site_name        = get_bloginfo( 'name' );
$get_started_url  = home_url( '/get-started/' );
$body_classes     = array( 'wp-theme-sitestaffr-website', 'sitestaffr-pricing-page' );
if ( is_admin_bar_showing() ) {
    $body_classes[] = 'admin-bar';
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php echo esc_html( $page_title ); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo esc_attr( $page_description ); ?>">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo esc_url( $page_url ); ?>">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?php echo esc_attr( $site_name ); ?>">
    <meta property="og:title" content="<?php echo esc_attr( $page_title ); ?>">
    <meta property="og:description" content="<?php echo esc_attr( $page_description ); ?>">
    <meta property="og:url" content="<?php echo esc_url( $page_url ); ?>">
    <?php wp_head(); ?>
</head>
<body class="<?php echo esc_attr( implode( ' ', $body_classes ) ); ?>">
<?php wp_body_open(); ?>

<?php
get_template_part( 'template-parts/site-nav', null, array(
    'menu_items' => array(
        array( 'label' => 'Features', 'href' => home_url( '/features/' ) ),
        array( 'label' => 'Pricing', 'href' => home_url( '/pricing/' ) ),
    ),
    'cta' => array(
        'label' => 'Get Started',
        'href'  => home_url( '/get-started/' ),
    ),
) );
?>

<main class="pricing-page">

  <!-- Section 1: Pricing Hero -->
  <section class="price-hero">
    <div class="container">
      <div class="price-hero__content reveal">
        <h1>Simple, transparent pricing</h1>
        <p class="price-hero__subtitle">Start free. Upgrade when you're ready.</p>
      </div>
    </div>
  </section>

  <!-- Section 2: Every Plan Includes -->
  <section class="price-includes">
    <div class="container">
      <div class="price-includes__header reveal">
        <span class="section-label">Every plan includes</span>
        <h2>All the essentials, on every tier</h2>
      </div>
      <div class="price-includes__grid reveal reveal-delay-1">
        <div class="price-includes__item">
          <span class="price-includes__icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
          </span>
          <span class="price-includes__label">Text chat widget</span>
        </div>
        <div class="price-includes__item">
          <span class="price-includes__icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          </span>
          <span class="price-includes__label">Email recaps after every conversation</span>
        </div>
        <div class="price-includes__item">
          <span class="price-includes__icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
          </span>
          <span class="price-includes__label">Full transcripts in WordPress</span>
        </div>
        <div class="price-includes__item">
          <span class="price-includes__icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
          </span>
          <span class="price-includes__label">57+ language support</span>
        </div>
        <div class="price-includes__item">
          <span class="price-includes__icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
          </span>
          <span class="price-includes__label">AI knowledge modes (Search + Page Expert)</span>
        </div>
        <div class="price-includes__item">
          <span class="price-includes__icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
          </span>
          <span class="price-includes__label">Contact form fallback</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Section 3: Pricing Tiers -->
  <section class="price-tiers">
    <div class="container">
      <div class="price-grid">

        <div class="price-tier reveal">
          <div class="price-tier__name">Free Trial</div>
          <div class="price-tier__price">$0</div>
          <div class="price-tier__period">for 30 days</div>
          <div class="price-tier__divider"></div>
          <div class="price-tier__minutes">30 minutes included</div>
          <ul class="price-tier__features">
            <li>2 AI voices</li>
            <li>Default greeting</li>
            <li>AI description generations included</li>
          </ul>
          <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--outline">Start Free Trial</a>
        </div>

        <div class="price-tier reveal reveal-delay-1">
          <div class="price-tier__name">Starter</div>
          <div class="price-tier__price">$10</div>
          <div class="price-tier__period">per month</div>
          <div class="price-tier__divider"></div>
          <div class="price-tier__minutes">60 minutes included</div>
          <ul class="price-tier__features">
            <li>2 AI voices</li>
            <li>Default greeting</li>
            <li>3 description generations / cycle</li>
          </ul>
          <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--outline">Get Started</a>
        </div>

        <div class="price-tier price-tier--popular reveal reveal-delay-2">
          <div class="price-tier__badge">Most Popular</div>
          <div class="price-tier__name">Business</div>
          <div class="price-tier__price">$50</div>
          <div class="price-tier__period">per month</div>
          <div class="price-tier__divider"></div>
          <div class="price-tier__minutes">300 minutes included</div>
          <ul class="price-tier__features">
            <li>5 AI voices</li>
            <li>Custom greeting + 4 tones</li>
            <li>5 description generations / cycle</li>
          </ul>
          <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--primary">Get Started</a>
        </div>

        <div class="price-tier reveal reveal-delay-3">
          <div class="price-tier__name">Pro</div>
          <div class="price-tier__price">$100</div>
          <div class="price-tier__period">per month</div>
          <div class="price-tier__divider"></div>
          <div class="price-tier__minutes">700 minutes included</div>
          <ul class="price-tier__features">
            <li>All 10 AI voices</li>
            <li>Custom greeting + 4 tones</li>
            <li>10 description generations / cycle</li>
            <li>Priority access to new features</li>
          </ul>
          <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--outline">Get Started</a>
        </div>

      </div>
    </div>
  </section>

  <!-- Section 4: Add-On Minutes -->
  <section class="price-addon-section">
    <div class="container">
      <div class="price-addon-card reveal">
        <h3>Run out of minutes?</h3>
        <p>Buy add-on packs anytime: <strong>$10 for 50 extra minutes</strong>. They never expire, and there are no automatic overage charges &mdash; your widget gracefully falls back to a contact form when minutes run out.</p>
      </div>
    </div>
  </section>

  <!-- Section 5: Billing FAQ -->
  <section class="price-faq">
    <div class="container">
      <div class="price-faq__header reveal">
        <h2>Frequently asked questions</h2>
      </div>
      <div class="faq-list">
        <div class="faq-item reveal">
          <button class="faq-item__question" type="button">
            What happens when my minutes run out?
            <span class="faq-item__icon">+</span>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-inner">
              You'll get notified when you're running low. There are no surprise charges or automatic overages. When your minutes are used up, your widget falls back to a contact form so you never lose a lead. You can buy an add-on pack or upgrade your plan anytime.
            </div>
          </div>
        </div>
        <div class="faq-item reveal reveal-delay-1">
          <button class="faq-item__question" type="button">
            Can I cancel anytime?
            <span class="faq-item__icon">+</span>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-inner">
              Yes. No contracts, no cancellation fees. Cancel from your billing dashboard and your plan stays active until the end of your current billing period.
            </div>
          </div>
        </div>
        <div class="faq-item reveal">
          <button class="faq-item__question" type="button">
            How does the free trial work?
            <span class="faq-item__icon">+</span>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-inner">
              You get full access to SiteStaffr for 30 days with 30 minutes of conversation time. No credit card required to start. At the end of your trial, choose a paid plan to continue.
            </div>
          </div>
        </div>
        <div class="faq-item reveal reveal-delay-1">
          <button class="faq-item__question" type="button">
            Do I need a credit card to start?
            <span class="faq-item__icon">+</span>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-inner">
              No. The free trial starts immediately with no payment information required.
            </div>
          </div>
        </div>
        <div class="faq-item reveal">
          <button class="faq-item__question" type="button">
            What payment methods do you accept?
            <span class="faq-item__icon">+</span>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-inner">
              We accept all major credit and debit cards through Stripe, our payment processor.
            </div>
          </div>
        </div>
        <div class="faq-item reveal reveal-delay-1">
          <button class="faq-item__question" type="button">
            Does it actually sound natural?
            <span class="faq-item__icon">+</span>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-inner">
              Yes. SiteStaffr uses advanced AI voice technology designed for natural, conversational speech. Listen to the demo on our <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color: var(--teal-deep); text-decoration: underline;">homepage</a> to hear it for yourself.
            </div>
          </div>
        </div>
        <div class="faq-item reveal">
          <button class="faq-item__question" type="button">
            Does it work in other languages?
            <span class="faq-item__icon">+</span>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-inner">
              Yes &mdash; SiteStaffr supports 57+ languages including Spanish, French, Mandarin, Portuguese, Arabic, and many more. It detects the visitor&rsquo;s language automatically and responds naturally.
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Section 6: Final CTA -->
  <section class="price-final-cta">
    <div class="container">
      <div class="price-final-cta__content reveal">
        <h2>Start your free trial</h2>
        <p class="price-final-cta__subtitle">30 days. Full access. No credit card.</p>
        <a href="<?php echo esc_url( home_url( '/get-started/' ) ); ?>" class="btn btn--primary btn--large">Get Started</a>
      </div>
    </div>
  </section>

</main>

<?php get_template_part( 'template-parts/site-footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
