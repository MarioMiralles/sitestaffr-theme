<?php
/*
Template Name: Landing Page
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$page_title       = 'SiteStaffr | Premium AI Voice & Text Chat for Your Website';
$page_description = 'Give your website visitors instant answers by voice or text. Premium AI assistant experience at small business prices. Free for 30 days.';
$page_keywords    = 'AI website assistant, AI voice agent, WordPress assistant, website lead capture, AI customer assistant';
$page_url         = get_permalink();
$page_url         = $page_url ? $page_url : home_url( '/' );
$page_image_url   = get_stylesheet_directory_uri() . '/assets/images/hero.png';
$site_name        = get_bloginfo( 'name' );
$get_started_url  = home_url( '/get-started/' );
$pricing_url      = home_url( '/pricing/' );
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php echo esc_html( $page_title ); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo esc_attr( $page_description ); ?>">
    <meta name="keywords" content="<?php echo esc_attr( $page_keywords ); ?>">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="canonical" href="<?php echo esc_url( $page_url ); ?>">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?php echo esc_attr( $site_name ); ?>">
    <meta property="og:title" content="<?php echo esc_attr( $page_title ); ?>">
    <meta property="og:description" content="<?php echo esc_attr( $page_description ); ?>">
    <meta property="og:url" content="<?php echo esc_url( $page_url ); ?>">
    <meta property="og:image" content="<?php echo esc_url( $page_image_url ); ?>">
    <meta property="og:image:alt" content="SiteStaffr AI website assistant preview">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr( $page_title ); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr( $page_description ); ?>">
    <meta name="twitter:image" content="<?php echo esc_url( $page_image_url ); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class( 'sitestaffr-landing-page' ); ?>>
<?php wp_body_open(); ?>

<?php get_template_part( 'template-parts/site-nav' ); ?>

<!-- ========== SECTION 1: HERO ========== -->
<section class="hero">
  <div class="container">
    <div class="hero__content reveal">
      <h1 class="hero__headline">
        The AI experience your website visitors deserve — at a price that makes sense.
      </h1>
      <p class="hero__subtitle">
        Premium AI voice and text chat for your WordPress website. The kind of experience you thought was only for enterprises with massive budgets.
      </p>
      <p class="hero__price-teaser">Starting at $10/mo. Free for 30 days.</p>
      <div class="hero__actions">
        <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--primary btn--large">
          Get Started
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
        <a href="#demo" class="hero__scroll-link">Hear it in action &darr;</a>
      </div>
    </div>
  </div>
</section>

<!-- ========== SECTION 2: LIVE DEMO ========== -->
<section class="demo-section" id="demo">
  <div class="container">
    <div class="demo-section__header reveal">
      <h2>Hear it for yourself.</h2>
    </div>
    <div class="reveal reveal-delay-1">
      <?php
      get_template_part(
          'template-parts/hero-audio-demo',
          null,
          array(
              'layout'        => 'stacked',
              'recap_variant' => 'card',
              'demo_kicker'   => 'Listen to a live conversation',
              'audio_label'   => 'A plumber&rsquo;s website visitor reports a kitchen leak. Here&rsquo;s how SiteStaffr handles it.',
          )
      );
      ?>
    </div>
  </div>
</section>

<!-- ========== SECTION 3: PROBLEM / PAIN ========== -->
<section class="pain-section">
  <div class="container">
    <div class="pain-section__content reveal">
      <h2>Your website visitors have questions right now. What happens when nobody answers?</h2>
      <div class="pain-section__cards">
        <div class="pain-card">
          <span class="pain-card__icon">&#x1f527;</span>
          <span class="pain-card__label">Emergency service inquiry</span>
          <span class="pain-card__amount">$500</span>
          <span class="pain-card__detail">One urgent job, gone to a competitor</span>
        </div>
        <div class="pain-card">
          <span class="pain-card__icon">&#x1f9b7;</span>
          <span class="pain-card__label">New patient inquiry</span>
          <span class="pain-card__amount">$3,000+</span>
          <span class="pain-card__detail">Lifetime value of a patient</span>
        </div>
        <div class="pain-card">
          <span class="pain-card__icon">&#x2696;&#xfe0f;</span>
          <span class="pain-card__label">Legal consultation request</span>
          <span class="pain-card__amount">$2,000</span>
          <span class="pain-card__detail">Average case value, lost to a faster firm</span>
        </div>
        <div class="pain-card">
          <span class="pain-card__icon">&#x1f3e0;</span>
          <span class="pain-card__label">Home buyer inquiry</span>
          <span class="pain-card__amount">$8,000</span>
          <span class="pain-card__detail">Commission on a single sale</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ========== SECTION 4: WHAT YOU GET (OUTCOMES) ========== -->
<section class="outcomes-section">
  <div class="container">
    <div class="outcomes-section__header reveal">
      <span class="section-label">What you get</span>
      <h2>Everything your visitors need. Everything you need to follow up.</h2>
    </div>
    <div class="outcomes-grid">
      <div class="outcome-card reveal">
        <div class="outcome-card__icon">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--teal-deep)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/>
            <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
            <line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/>
          </svg>
        </div>
        <h3>Voice and text</h3>
        <p>Visitors choose how they talk to your business.</p>
      </div>
      <div class="outcome-card reveal reveal-delay-1">
        <div class="outcome-card__icon">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--teal-deep)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
            <polyline points="22,6 12,13 2,6"/>
          </svg>
        </div>
        <h3>Every conversation in your inbox</h3>
        <p>Get a recap with contact info and action items after every conversation.</p>
      </div>
      <div class="outcome-card reveal reveal-delay-2">
        <div class="outcome-card__icon">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--teal-deep)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/>
          </svg>
        </div>
        <h3>Learns from your website</h3>
        <p>Your business information powers every answer. No training required.</p>
      </div>
      <div class="outcome-card reveal reveal-delay-3">
        <div class="outcome-card__icon">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--teal-deep)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/>
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
          </svg>
        </div>
        <h3>Speaks 57+ languages</h3>
        <p>Your website can help anyone who visits, in their language.</p>
      </div>
    </div>
  </div>
</section>

<!-- ========== SECTION 5: PRICE TEASER + CTA ========== -->
<section class="price-cta-section">
  <div class="container reveal">
    <div class="price-cta-section__content">
      <p class="price-cta-section__price">Starting at $10/mo. Free for 30 days. No credit card required.</p>
      <div class="price-cta-section__actions">
        <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--primary btn--large">
          Get Started
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
      <a href="<?php echo esc_url( $pricing_url ); ?>" class="price-cta-section__plans-link">See all plans &rarr;</a>
    </div>
  </div>
</section>

<!-- ========== SECTION 6: FOOTER CTA ========== -->
<section class="final-cta">
  <div class="container reveal">
    <h2>Your website can start helping visitors today.</h2>
    <p class="final-cta__subtitle">
      Free for 30 days. No credit card required.
    </p>
    <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--white btn--large">
      Get Started
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
    </a>
  </div>
</section>

<?php get_template_part( 'template-parts/site-footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
