<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$page_title       = 'SiteStaffr Pricing | Simple Plans for Every Business';
$page_description = 'Simple, transparent pricing for SiteStaffr. Free trial with no credit card. Plans from $10/mo. No contracts, no hidden fees.';
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

<?php get_template_part( 'template-parts/site-nav' ); ?>

<main class="pricing-page">

  <!-- Section 1: Hero -->
  <section class="price-hero">
    <div class="container">
      <div class="price-hero__content reveal">
        <h1>Simple pricing. No surprises.</h1>
        <p class="price-hero__subtitle">Free for 30 days. No credit card required.</p>
      </div>
    </div>
  </section>

  <!-- Section 2: Pricing Table -->
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
            <li>Full access to all features</li>
            <li>2 AI voice options</li>
            <li>No credit card required</li>
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
            <li>Voice and text chat</li>
            <li>2 AI voice options</li>
            <li>Email recaps &amp; transcripts</li>
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
            <li>Voice and text chat</li>
            <li>5 AI voice options</li>
            <li>Custom greeting + 4 tone styles</li>
            <li>5 description generations / cycle</li>
            <li>Email recaps &amp; transcripts</li>
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
            <li>Voice and text chat</li>
            <li>All 10 AI voices</li>
            <li>Custom greeting + 4 tone styles</li>
            <li>10 description generations / cycle</li>
            <li>Email recaps &amp; transcripts</li>
            <li>Priority access to new features</li>
          </ul>
          <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--outline">Get Started</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Section 3: Add-On Minutes -->
  <section class="price-addon-section">
    <div class="container">
      <div class="price-addon-card reveal">
        <h3>Need more minutes?</h3>
        <p><strong>$10 for 50 minutes.</strong> Buy anytime. They never expire. No automatic overage charges — you stay in control.</p>
      </div>
    </div>
  </section>

  <!-- Section 4: Billing FAQ -->
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
              Your widget doesn&rsquo;t go dead. Voice conversations pause, but text chat stays available so visitors can still reach you. You can buy an add-on pack anytime or upgrade your plan. There are no automatic overage charges.
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
              Yes. No contracts, no cancellation fees, no hoops to jump through. Cancel from your account dashboard anytime.
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
              You get 30 days of full access with 30 included minutes. No credit card required to start. When the trial ends, choose a paid plan to keep going or let it expire — no surprise charges.
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
              No. The free trial starts without any payment information. You only enter payment details when you choose a paid plan.
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
              We accept all major credit and debit cards through Stripe. Billing is handled securely — we never see or store your card details.
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
              Yes. SiteStaffr uses advanced AI voice technology designed to produce natural, conversational speech. The best way to judge is to <a href="<?php echo esc_url( home_url( '/' ) ); ?>#demo" style="color: var(--teal-deep); text-decoration: underline;">listen to a sample conversation</a> on the homepage.
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
              Yes &mdash; SiteStaffr supports 57+ languages including Spanish, French, Mandarin, Portuguese, Arabic, and many more. It detects the visitor&rsquo;s language automatically and translates the summary to English for you.
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Section 5: CTA -->
  <section class="price-final-cta">
    <div class="container reveal">
      <h2>Start your free trial</h2>
      <p>30 days. Full access. No credit card.</p>
      <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--primary btn--large">
        Get Started
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
    </div>
  </section>

</main>

<?php get_template_part( 'template-parts/site-footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
