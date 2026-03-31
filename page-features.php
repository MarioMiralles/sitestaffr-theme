<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$page_title       = 'SiteStaffr Features | Voice, Text Chat, AI Knowledge & More';
$page_description = 'Explore SiteStaffr features: natural AI voice conversations, text chat, website-powered AI knowledge, email recaps, transcripts, 57+ languages, and self-service billing.';
$page_url         = home_url( '/features/' );
$site_name        = get_bloginfo( 'name' );
$get_started_url  = home_url( '/get-started/' );
$pricing_url      = home_url( '/pricing/' );
$body_classes     = array( 'wp-theme-sitestaffr-website', 'sitestaffr-features-page' );
if ( is_admin_bar_showing() ) {
    $body_classes[] = 'admin-bar';
}

$feature_screenshot_url = static function( $slug, $device = 'desktop' ) {
    $slug   = (string) $slug;
    $device = 'mobile' === $device ? 'mobile' : 'desktop';
    $relative_path = 'assets/images/screenshots/' . $slug . '-' . $device . '.png';
    $absolute_path = trailingslashit( get_stylesheet_directory() ) . $relative_path;

    if ( file_exists( $absolute_path ) ) {
        return trailingslashit( get_stylesheet_directory_uri() ) . $relative_path;
    }

    $fallback_map = array(
        'dashboard'    => 'assets/images/features-dashboard.png',
        'email-recaps' => 'assets/images/placeholder-email-recap.svg',
        'analytics'    => 'assets/images/features-usage.png',
        'ai-generator' => 'assets/images/features-description.png',
        'protection'   => 'assets/images/features-conversation.png',
    );

    $fallback_relative = isset( $fallback_map[ $slug ] ) ? $fallback_map[ $slug ] : 'assets/images/placeholder-transcript.svg';
    return trailingslashit( get_stylesheet_directory_uri() ) . $fallback_relative;
};
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

<main class="features-page">

  <!-- Section 1: Hero -->
  <section class="feat-hero">
    <div class="container">
      <div class="feat-hero__content reveal">
        <h1>Everything your website needs to help visitors and capture leads.</h1>
        <p class="feat-hero__subtitle">Business-owner-friendly tools that work for you while you focus on your work.</p>
      </div>
    </div>
  </section>

  <!-- Section 2: Voice Conversations -->
  <section class="feat-section feat-section--voice">
    <div class="container">
      <div class="feat-section__header reveal">
        <span class="section-label">Voice conversations</span>
        <h2>A natural-sounding AI voice that represents your business</h2>
        <p class="feat-section__subtitle">Visitors click and talk — no phone numbers, no hold times. Works on desktop and mobile browsers.</p>
      </div>
      <div class="reveal reveal-delay-1">
        <!-- Voice Showcase Carousel (reused from old homepage) -->
        <div class="voice-showcase voice-showcase--full" id="voiceShowcase">
          <div class="voice-showcase__header">
            <h3 class="voice-showcase__title">Choose the personality that fits your business</h3>
            <p class="voice-showcase__subtitle">
              <span>Preview how natural it sounds before you go live.</span>
            </p>
          </div>
          <div class="voice-showcase__display">
            <div class="voice-showcase__portrait-area">
              <button class="voice-showcase__arrow voice-showcase__arrow--prev" type="button" aria-label="Previous voice">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
              </button>
              <div class="voice-showcase__portrait">
                <img src="" alt="" id="showcasePortrait">
              </div>
              <button class="voice-showcase__arrow voice-showcase__arrow--next" type="button" aria-label="Next voice">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
              </button>
            </div>
            <div class="voice-showcase__info">
              <div class="voice-showcase__name-row">
                <h4 class="voice-showcase__name" id="showcaseName"></h4>
                <span class="voice-showcase__plan-pill" id="showcasePlan"></span>
                <span class="voice-showcase__recommended-pill" id="showcaseRecommended" hidden>
                  <span class="voice-showcase__recommended-icon" aria-hidden="true">&#x2605;</span>
                  Recommended
                </span>
              </div>
              <p class="voice-showcase__personality" id="showcasePersonality"></p>
              <p class="voice-showcase__description" id="showcaseDescription"></p>
              <div class="voice-showcase__best-for" id="showcaseBestFor"></div>
            </div>
            <div class="voice-showcase__play-area">
              <button class="voice-showcase__play-btn" type="button" id="showcasePlayBtn" aria-label="Preview voice">
                <svg viewBox="0 0 24 24" fill="currentColor" width="28" height="28"><polygon points="6,3 20,12 6,21"/></svg>
              </button>
              <span class="voice-showcase__play-label" id="showcasePlayLabel">Preview Voice</span>
              <audio id="showcaseAudio" preload="none"></audio>
            </div>
          </div>
          <div class="voice-showcase__thumbs" id="showcaseThumbs"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Section 3: Text Chat -->
  <section class="feat-section">
    <div class="container">
      <div class="feat-section__split reveal">
        <div class="feat-section__text">
          <span class="section-label">Text chat</span>
          <h2>For visitors who prefer typing</h2>
          <p>In public, at work, on mobile with no earbuds — some visitors prefer to type. Same AI, same knowledge, same quality. Just a different interface.</p>
          <ul class="feat-check-list">
            <li>Chat panel with greeting, conversation flow, contact capture</li>
            <li>Same assistant powers both voice and text</li>
            <li>Great for visitors who can&rsquo;t talk out loud</li>
          </ul>
        </div>
        <div class="feat-section__media">
          <picture>
            <source media="(max-width: 767px)" srcset="<?php echo esc_url( $feature_screenshot_url( 'protection', 'mobile' ) ); ?>">
            <img src="<?php echo esc_url( $feature_screenshot_url( 'protection', 'desktop' ) ); ?>" alt="Text chat conversation screenshot" loading="lazy" decoding="async">
          </picture>
        </div>
      </div>
    </div>
  </section>

  <!-- Section 4: AI Knowledge -->
  <section class="feat-section feat-section--alt">
    <div class="container">
      <div class="feat-section__split feat-section__split--reverse reveal">
        <div class="feat-section__text">
          <span class="section-label">AI Knowledge</span>
          <h2>Your business info powers every answer</h2>
          <p>No manual training, no spreadsheets, no prompt engineering. SiteStaffr pulls knowledge from your website content and gets smarter as you add more.</p>
          <ul class="feat-check-list">
            <li><strong>Search Mode</strong> &mdash; searches your site for answers</li>
            <li><strong>Page Expert Mode</strong> &mdash; deep knowledge of specific pages</li>
            <li>Gets smarter as you add content to your site</li>
          </ul>
        </div>
        <div class="feat-section__media">
          <picture>
            <source media="(max-width: 767px)" srcset="<?php echo esc_url( $feature_screenshot_url( 'ai-generator', 'mobile' ) ); ?>">
            <img src="<?php echo esc_url( $feature_screenshot_url( 'ai-generator', 'desktop' ) ); ?>" alt="AI Knowledge settings screenshot" loading="lazy" decoding="async">
          </picture>
        </div>
      </div>
    </div>
  </section>

  <!-- Section 5: Recaps, Transcripts & Follow-Up -->
  <section class="feat-section">
    <div class="container">
      <div class="feat-section__header reveal">
        <span class="section-label">Recaps, transcripts &amp; follow-up</span>
        <h2>Never miss a lead, even when you&rsquo;re away</h2>
      </div>
      <div class="feat-cards-row reveal reveal-delay-1">
        <div class="feat-card">
          <div class="feat-card__image">
            <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/after-conversation-email-recap.png' ); ?>" alt="Email recap screenshot" loading="lazy" decoding="async">
          </div>
          <h3>Email recap after every conversation</h3>
          <p>Visitor contact info and action items hit your inbox the moment the conversation ends.</p>
        </div>
        <div class="feat-card">
          <div class="feat-card__image">
            <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/after-conversation-transcript.png' ); ?>" alt="Transcript screenshot" loading="lazy" decoding="async">
          </div>
          <h3>Full transcripts in WordPress</h3>
          <p>Every word, searchable and reviewable right in your dashboard.</p>
        </div>
        <div class="feat-card">
          <div class="feat-card__image">
            <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/after-conversation-followup.png' ); ?>" alt="Follow-up suggestions screenshot" loading="lazy" decoding="async">
          </div>
          <h3>Suggested follow-ups</h3>
          <p>See who reached out, what they needed, and what to do next.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Section 6: Languages -->
  <section class="feat-section feat-section--alt">
    <div class="container">
      <div class="feat-section__centered reveal">
        <span class="section-label">57+ languages</span>
        <h2>Serve every visitor, in their language</h2>
        <p class="feat-section__subtitle">SiteStaffr speaks and chats in 57+ languages automatically. No setup required — it detects the visitor&rsquo;s language and responds naturally. Summaries are always in English for you.</p>
      </div>
    </div>
  </section>

  <!-- Section 7: Billing & Usage -->
  <section class="feat-section">
    <div class="container">
      <div class="feat-section__split reveal">
        <div class="feat-section__text">
          <span class="section-label">Billing &amp; usage</span>
          <h2>Track your usage. Stay in control.</h2>
          <p>Monitor minutes used, manage your plan, add minutes when you need them. Self-service billing portal lets you upgrade, downgrade, or cancel anytime. Transparent usage tracking right in your WordPress dashboard.</p>
        </div>
        <div class="feat-section__media">
          <picture>
            <source media="(max-width: 767px)" srcset="<?php echo esc_url( $feature_screenshot_url( 'analytics', 'mobile' ) ); ?>">
            <img src="<?php echo esc_url( $feature_screenshot_url( 'analytics', 'desktop' ) ); ?>" alt="Usage tracking dashboard screenshot" loading="lazy" decoding="async">
          </picture>
        </div>
      </div>
    </div>
  </section>

  <!-- Section 8: CTA -->
  <section class="feat-cta">
    <div class="container reveal">
      <div class="feat-cta__actions">
        <a href="<?php echo esc_url( $pricing_url ); ?>" class="btn btn--outline btn--large">See Pricing</a>
        <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--primary btn--large">
          Get Started
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
    </div>
  </section>

</main>

<?php get_template_part( 'template-parts/site-footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
