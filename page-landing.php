<?php
/*
Template Name: Landing Page
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$landing_title = 'SiteStaffr | AI Website Assistant for WordPress';
$landing_description = 'An AI website assistant for WordPress that helps everyday businesses answer repeat questions, respond by voice or text, and follow up clearly without being glued to the front desk.';
$landing_keywords = 'AI website assistant, AI voice agent, WordPress assistant, website lead capture, AI customer assistant';
$landing_url = get_permalink();
$landing_url = $landing_url ? $landing_url : home_url( '/' );
$landing_image_url = get_stylesheet_directory_uri() . '/assets/images/hero.png';
$site_name = get_bloginfo( 'name' );
$show_testimonials = false;
$get_started_url = home_url( '/get-started/' );
$features_url = home_url( '/features/' );
$feature_screenshot_url = static function( $slug, $device = 'desktop' ) {
    $slug = (string) $slug;
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
    <title><?php echo esc_html( $landing_title ); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo esc_attr( $landing_description ); ?>">
    <meta name="keywords" content="<?php echo esc_attr( $landing_keywords ); ?>">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="canonical" href="<?php echo esc_url( $landing_url ); ?>">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?php echo esc_attr( $site_name ); ?>">
    <meta property="og:title" content="<?php echo esc_attr( $landing_title ); ?>">
    <meta property="og:description" content="<?php echo esc_attr( $landing_description ); ?>">
    <meta property="og:url" content="<?php echo esc_url( $landing_url ); ?>">
    <meta property="og:image" content="<?php echo esc_url( $landing_image_url ); ?>">
    <meta property="og:image:alt" content="SiteStaffr AI website assistant preview">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr( $landing_title ); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr( $landing_description ); ?>">
    <meta name="twitter:image" content="<?php echo esc_url( $landing_image_url ); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class( 'sitestaffr-landing-page' ); ?>>
<?php wp_body_open(); ?>
<!-- ========== NAVIGATION ========== -->
<?php
get_template_part( 'template-parts/site-nav', null, array(
    'menu_items' => array(
        array( 'label' => 'Features', 'href' => $features_url ),
        array( 'label' => 'Demo', 'href' => '#hero-audio-demo' ),
        array( 'label' => 'Pricing', 'href' => '#pricing-label' ),
        array( 'label' => 'FAQ', 'href' => '#faq-label' ),
        array( 'label' => 'My Account', 'href' => home_url( '/manage/' ) ),
    ),
    'cta' => array(
        'label' => 'Get Started',
        'href'  => $get_started_url,
    ),
) );
?>

<!-- ========== SECTION 1: HERO ========== -->
<section class="hero">
  <div class="container">
    <div class="hero__grid">
      <div class="hero__content reveal">
        <span class="hero__tagline">AI Website Assistant for WordPress</span>
        <h1 class="hero__headline">
          <span class="hero__headline-prefix">Your Website Visitors Have Questions.</span>
          <span class="hero__headline-focus">SiteStaffr Answers Them.</span>
        </h1>
        <p class="hero__subtitle">
          An AI website assistant for WordPress that lets visitors speak or type to get answers right away, then sends you a clear recap after every conversation.
        </p>
        <span class="hero__no-cc">Free for 30 days &bull; Install in minutes &bull; No code required</span>
        <div class="hero__actions">
          <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--primary btn--large">
            Get Started
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
        </div>
      </div>
      <div class="hero__visual reveal reveal-delay-2" id="hero-audio-demo">
        <?php
        get_template_part(
            'template-parts/hero-audio-demo',
            null,
            array(
                'layout'       => 'stacked',
                'recap_variant' => 'card',
                'demo_kicker'  => 'Listen to a Live Conversation',
                'audio_label'  => 'A plumber&rsquo;s website visitor reports a kitchen leak. Here&rsquo;s how SiteStaffr handles it.',
                'extra_classes' => 'hero-audio-demo hero-audio-demo--preview',
            )
        );
        ?>
      </div>
    </div>
  </div>
</section>

<!-- ========== SECTION 3: COST OF MISSED CALLS ========== -->
<section class="cost-section">
  <div class="container">
    <div class="cost-section__grid">
      <div class="reveal">
        <span class="section-label">The hidden cost of lost website visitors</span>
        <h2>Busy Owners Miss Website Leads and Often Never Know It</h2>
        <p class="cost-section__text">
          You&rsquo;re on a job site. In a consultation. In the middle of a procedure. A visitor lands on your website ready to ask a question, request a quote, or book an appointment, and they want help now.
        </p>
        <p class="cost-section__text">
          Most visitors won&rsquo;t dig through pages or fill out a contact form. If they can&rsquo;t get instant help, they leave your site and choose the next business on Google. That&rsquo;s real revenue walking out the door, and you may never know it happened.
        </p>
        <p class="cost-section__text">SiteStaffr turns those missed moments into conversations, and conversations into leads.</p>
      </div>
      <div class="cost-cards reveal reveal-delay-1">
        <div class="cost-card">
          <div class="cost-card__icon">🔧</div>
          <div class="cost-card__title">Emergency service inquiry</div>
          <div class="cost-card__amount">$500</div>
          <div class="cost-card__detail">One urgent job, gone to a competitor</div>
        </div>
        <div class="cost-card">
          <div class="cost-card__icon">🦷</div>
          <div class="cost-card__title">New patient inquiry</div>
          <div class="cost-card__amount">$3,000+</div>
          <div class="cost-card__detail">Lifetime value of a patient</div>
        </div>
        <div class="cost-card">
          <div class="cost-card__icon">⚖️</div>
          <div class="cost-card__title">Legal consultation request</div>
          <div class="cost-card__amount">$2,000</div>
          <div class="cost-card__detail">Average case value, lost to a faster firm</div>
        </div>
        <div class="cost-card">
          <div class="cost-card__icon">🏠</div>
          <div class="cost-card__title">Home buyer inquiry</div>
          <div class="cost-card__amount">$8,000</div>
          <div class="cost-card__detail">Commission on a single sale</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ========== SECTION 4: SOLUTION OVERVIEW ========== -->
<?php if ( false ) : // Temporarily hidden per request. ?>
  <section class="solution-section">
    <div class="container">
      <div class="solution-overview reveal">
        <div class="solution-overview__content">
          <h2>Turn Website Visitors Into Qualified Leads Automatically</h2>
          <p class="solution-section__text">
            SiteStaffr adds an AI voice receptionist to your WordPress website. Visitors ask questions by voice, get instant answers, and you get lead details and a conversation recap for follow-up.
          </p>
          <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--primary btn--large">
            Get Started
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
        </div>
        <ul class="solution-overview__list" aria-label="Solution highlights">
          <li class="solution-overview__item">Instant answers for visitors</li>
          <li class="solution-overview__item">Lead capture during the conversation</li>
          <li class="solution-overview__item">Automatic recap after every chat</li>
        </ul>
      </div>
    </div>
  </section>
<?php endif; ?>

<!-- ========== WHAT YOU GET AFTER EVERY CONVERSATION ========== -->
<section class="what-you-get" id="demo">
  <div class="container">
    <div class="what-you-get__header reveal">
      <span class="section-label" id="demo-label">After every conversation</span>
      <h2>What You Get After Every Conversation</h2>
      <p class="what-you-get__subtitle">
        SiteStaffr doesn&rsquo;t just talk to your visitors &mdash; it tells you everything you need to follow up.
      </p>
    </div>
    <div class="what-you-get__grid">
      <div class="what-you-get__card what-you-get__card--email reveal">
        <div class="what-you-get__card-image">
          <img
            src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/after-conversation-email-recap.png' ); ?>"
            alt="Screenshot of an email recap from SiteStaffr"
            loading="lazy"
            decoding="async"
          >
        </div>
        <div class="what-you-get__card-body">
          <h3>Email Recap</h3>
          <p>A summary hits your inbox the moment the conversation ends &mdash; who they are, what they need, and what to do next.</p>
        </div>
      </div>
      <div class="what-you-get__card what-you-get__card--transcript reveal reveal-delay-1">
        <div class="what-you-get__card-image">
          <img
            src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/after-conversation-transcript.png' ); ?>"
            alt="Screenshot of a full conversation transcript"
            loading="lazy"
            decoding="async"
          >
        </div>
        <div class="what-you-get__card-body">
          <h3>Full Transcript</h3>
          <p>Every word, turn by turn. Review exactly what was said so nothing gets lost.</p>
        </div>
      </div>
      <div class="what-you-get__card what-you-get__card--followup reveal reveal-delay-2">
        <div class="what-you-get__card-image">
          <img
            src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/after-conversation-followup.png' ); ?>"
            alt="Screenshot of suggested follow-up actions"
            loading="lazy"
            decoding="async"
          >
        </div>
        <div class="what-you-get__card-body">
          <h3>Suggested Follow-Up</h3>
          <p>SiteStaffr recommends your next step based on what the visitor asked for.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ========== FEATURES SECTION ========== -->
<section class="features-section">
  <div class="container">
    <div class="features-section__header reveal">
      <span class="section-label">Always-on help</span>
      <h2>Your website can answer visitors while you&apos;re busy</h2>
      <p class="features-section__subtitle">
        SiteStaffr can talk or chat with visitors, use your business information for better answers, and give you the follow-up context without pulling you away from work.
      </p>
    </div>
    <div class="features-grid">
      <!-- Voice Agent Showcase -->
      <div class="voice-showcase voice-showcase--full reveal" id="voiceShowcase">
        <div class="voice-showcase__header">
          <h3 class="voice-showcase__title">Hear how SiteStaffr sounds</h3>
          <p class="voice-showcase__subtitle">
            <span>Choose the personality that fits your business.</span>
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
                <span class="voice-showcase__recommended-icon" aria-hidden="true">★</span>
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

      <article class="feature-spotlight reveal reveal-delay-1" data-feature-lightbox="protection">
        <div class="feature-spotlight__content">
          <span class="section-label">Text chat</span>
          <h3 class="feature-spotlight__title">Prefer to type instead? SiteStaffr can do that too.</h3>
          <p class="feature-spotlight__desc">
            Visitors can chat with your website when talking isn&apos;t ideal. The same assistant can help by voice or text, so people can get answers in the way that feels easiest.
          </p>
          <div class="feature-spotlight__points" aria-label="Text chat highlights">
            <span class="feature-spotlight__point">Helpful for visitors at work</span>
            <span class="feature-spotlight__point">Easy in public or quiet spaces</span>
            <span class="feature-spotlight__point">Same assistant, same business info</span>
          </div>
        </div>
        <div class="feature-card__screenshot feature-spotlight__media">
          <picture>
            <source media="(max-width: 767px)" srcset="<?php echo esc_url( $feature_screenshot_url( 'protection', 'mobile' ) ); ?>">
            <img
              src="<?php echo esc_url( $feature_screenshot_url( 'protection', 'desktop' ) ); ?>"
              alt="Voice and text conversation screenshot"
              loading="lazy"
              decoding="async"
            >
          </picture>
        </div>
      </article>

      <div class="feature-card feature-card--half reveal" data-feature-lightbox="ai-generator">
        <div class="feature-card__screenshot">
          <picture>
            <source media="(max-width: 767px)" srcset="<?php echo esc_url( $feature_screenshot_url( 'ai-generator', 'mobile' ) ); ?>">
            <img
              src="<?php echo esc_url( $feature_screenshot_url( 'ai-generator', 'desktop' ) ); ?>"
              alt="AI Knowledge sync screenshot"
              loading="lazy"
              decoding="async"
            >
          </picture>
        </div>
        <h3 class="feature-card__title">Uses your business info</h3>
        <p class="feature-card__desc">SiteStaffr can learn from your website content so it answers with the details your visitors actually need.</p>
      </div>
      <div class="feature-card feature-card--half reveal reveal-delay-1" data-feature-lightbox="email-recaps">
        <div class="feature-card__screenshot">
          <picture>
            <source media="(max-width: 767px)" srcset="<?php echo esc_url( $feature_screenshot_url( 'email-recaps', 'mobile' ) ); ?>">
            <img
              src="<?php echo esc_url( $feature_screenshot_url( 'email-recaps', 'desktop' ) ); ?>"
              alt="Email recap and transcript review screenshot"
              loading="lazy"
              decoding="async"
            >
          </picture>
        </div>
        <h3 class="feature-card__title">Get a quick recap</h3>
        <p class="feature-card__desc">After each conversation, SiteStaffr sends a simple summary and a review link so you can catch up fast.</p>
      </div>
      <div class="feature-card feature-card--half reveal" data-feature-lightbox="dashboard">
        <div class="feature-card__screenshot">
          <picture>
            <source media="(max-width: 767px)" srcset="<?php echo esc_url( $feature_screenshot_url( 'dashboard', 'mobile' ) ); ?>">
            <img
              src="<?php echo esc_url( $feature_screenshot_url( 'dashboard', 'desktop' ) ); ?>"
              alt="Conversation follow-up dashboard screenshot"
              loading="lazy"
              decoding="async"
            >
          </picture>
        </div>
        <h3 class="feature-card__title">See who reached out</h3>
        <p class="feature-card__desc">Open the dashboard to see who contacted you, what they needed, and whether you should follow up.</p>
      </div>
      <div class="feature-card feature-card--half reveal reveal-delay-1" data-feature-lightbox="analytics">
        <div class="feature-card__screenshot">
          <picture>
            <source media="(max-width: 767px)" srcset="<?php echo esc_url( $feature_screenshot_url( 'analytics', 'mobile' ) ); ?>">
            <img
              src="<?php echo esc_url( $feature_screenshot_url( 'analytics', 'desktop' ) ); ?>"
              alt="Conversation activity analytics screenshot"
              loading="lazy"
              decoding="async"
            >
          </picture>
        </div>
        <h3 class="feature-card__title">See how much it handled</h3>
        <p class="feature-card__desc">Track conversations and minutes so you can see how much visitor help SiteStaffr handled for you.</p>
      </div>
    </div>
    <div class="features-section__footer reveal">
      <p>Want the full product story, including text chat, AI Knowledge, guided setup, and account tools?</p>
      <a href="<?php echo esc_url( $features_url ); ?>" class="btn btn--outline">See All Features</a>
    </div>
  </div>
</section>

<!-- Feature Lightbox Modal -->
<div class="feature-lightbox" id="featureLightbox" aria-hidden="true" role="dialog" aria-modal="true">
  <div class="feature-lightbox__backdrop"></div>
  <div class="feature-lightbox__content">
    <button class="feature-lightbox__close" type="button" aria-label="Close lightbox">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
    <img class="feature-lightbox__image" src="" alt="" loading="lazy">
    <p class="feature-lightbox__caption"></p>
  </div>
</div>

<!-- ========== SECTION 6: PRICING ========== -->
<section class="pricing-section" id="pricing">
  <div class="container">
    <div class="pricing-section__header reveal">
      <span class="section-label" id="pricing-label">Simple, transparent pricing</span>
      <h2>Start free. Upgrade when you're ready.</h2>
      <p class="pricing-section__subtitle">Practical pricing for everyday businesses. No contracts. No hidden fees. No surprise charges.</p>
    </div>
    <div class="pricing-includes reveal">
      <p class="pricing-includes__title">All plans include:</p>
      <ul class="pricing-includes__list">
        <li>Visitors can talk or type to get help right away</li>
        <li>Learns your business from your website content</li>
        <li>Conversation dashboard with transcript review</li>
        <li>Email recap after every conversation</li>
        <li>57+ languages with English summaries</li>
        <li>Add-on minutes available anytime</li>
      </ul>
    </div>
    <div class="pricing-grid">
      <div class="pricing-card reveal">
        <div class="pricing-card__name">Free Trial</div>
        <div class="pricing-card__price">$0</div>
        <div class="pricing-card__price-sub">for 30 days</div>
        <div class="pricing-card__divider"></div>
        <div class="pricing-card__minutes">30 minutes included</div>
        <ul class="pricing-card__features">
          <li>2 AI voices</li>
          <li>AI description generator included</li>
          <li>No credit card required</li>
        </ul>
        <p class="pricing-card__best-for">Try SiteStaffr free for 30 days</p>
        <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--outline">Start Free Trial</a>
      </div>
      <div class="pricing-card reveal reveal-delay-1">
        <div class="pricing-card__name">Starter</div>
        <div class="pricing-card__price">$10</div>
        <div class="pricing-card__price-sub">per month</div>
        <div class="pricing-card__divider"></div>
        <div class="pricing-card__minutes">60 minutes included</div>
        <ul class="pricing-card__features">
          <li>2 AI voice options</li>
          <li>3 AI description generations per billing cycle</li>
          <li>Great for steady weekly lead volume</li>
        </ul>
        <p class="pricing-card__best-for">Best for businesses getting started</p>
        <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--outline">Get Started</a>
      </div>
      <div class="pricing-card pricing-card--popular reveal reveal-delay-2">
        <div class="pricing-card__badge">Most Popular</div>
        <div class="pricing-card__name">Business</div>
        <div class="pricing-card__price">$50</div>
        <div class="pricing-card__price-sub">per month</div>
        <div class="pricing-card__divider"></div>
        <div class="pricing-card__minutes">300 minutes included</div>
        <ul class="pricing-card__features">
          <li>5 AI voice options</li>
          <li>Custom greeting + 4 tone styles</li>
          <li>5 AI description generations per billing cycle</li>
        </ul>
        <p class="pricing-card__best-for">Best for busy local businesses</p>
        <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--primary">Get Started</a>
      </div>
      <div class="pricing-card reveal reveal-delay-3">
        <div class="pricing-card__name">Pro</div>
        <div class="pricing-card__price">$100</div>
        <div class="pricing-card__price-sub">per month</div>
        <div class="pricing-card__divider"></div>
        <div class="pricing-card__minutes">700 minutes included</div>
        <ul class="pricing-card__features">
          <li>All 10 AI voices</li>
          <li>Custom greeting + 4 tone styles</li>
          <li>10 AI description generations per billing cycle</li>
          <li>Priority access to new features</li>
        </ul>
        <p class="pricing-card__best-for">Best for high-volume or multi-location businesses</p>
        <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--outline">Get Started</a>
      </div>
    </div>
    <div class="pricing-addon reveal">
      <h3 class="pricing-addon__title">Run out of minutes? You stay in control.</h3>
      <p class="pricing-addon__text">Buy add-on packs anytime: <strong>$10 for 50 extra minutes</strong>. They never expire, and there are no automatic overage charges.</p>
    </div>
  </div>
</section>

<!-- ========== SECTION 7: HOW IT WORKS ========== -->
<section class="how-section">
  <div class="container">
    <div class="container--narrow reveal">
      <span class="section-label">Get live quickly</span>
      <h2 class="how-section__title">Three steps to get SiteStaffr live on your website</h2>
      <p class="how-section__subtitle">No developers needed. No API keys. No complicated setup.</p>
    </div>
    <div class="steps">
      <div class="step reveal">
        <div class="step__badge">1</div>
        <div class="step__number">
          <span class="step__number-icon">📦</span>
        </div>
        <h3>Install the plugin</h3>
        <p class="step__desc">Upload SiteStaffr to your WordPress site just like any other plugin. Activate it with one click.</p>
        <span class="step__time">~ 2 minutes</span>
      </div>
      <div class="step reveal reveal-delay-1">
        <div class="step__badge">2</div>
        <div class="step__number">
          <span class="step__number-icon">💬</span>
        </div>
        <h3>Add your business info</h3>
        <p class="step__desc">Enter your business info during setup. After payment, select your business hours and either generate or write your business description.</p>
        <span class="step__time">~ 5 minutes</span>
      </div>
      <div class="step reveal reveal-delay-2">
        <div class="step__badge">3</div>
        <div class="step__number">
          <span class="step__number-icon">✨</span>
        </div>
        <h3>Go live instantly</h3>
        <p class="step__desc">Your website assistant is active by default after setup. We can fine-tune the details later, but the goal is to get you live fast.</p>
        <span class="step__time">You're done</span>
      </div>
    </div>
  </div>
</section>

<?php if ( $show_testimonials ) : ?>
<!-- ========== SECTION 8: TESTIMONIALS ========== -->
<section class="testimonials-section">
  <div class="container">
    <div class="testimonials-section__header reveal">
      <span class="section-label">Trusted by businesses like yours</span>
      <h2>What business owners are saying</h2>
      <p class="testimonials-section__subtitle">Illustrative examples inspired by service businesses (not customer endorsements).</p>
    </div>
    <div class="testimonials-grid">
      <div class="testimonial reveal">
        <div class="testimonial__stars">★★★★★</div>
        <p class="testimonial__quote">
          "I was skeptical an AI could talk to my customers without sounding like a robot. I played the demo and my jaw dropped. My clients have no idea &mdash; they just think I hired a receptionist."
        </p>
        <div class="testimonial__author">
          <div class="testimonial__avatar testimonial__avatar--blue">MR</div>
          <div>
            <div class="testimonial__name">Mike Rodriguez</div>
            <div class="testimonial__role">Rodriguez Plumbing &amp; HVAC, Austin TX</div>
          </div>
        </div>
      </div>
      <div class="testimonial reveal reveal-delay-1">
        <div class="testimonial__stars">★★★★★</div>
        <p class="testimonial__quote">
          "Setup took less than 10 minutes. I'm not a tech person at all &mdash; my nephew built our website. But this was just fill in a few fields and it worked. I wish everything was this easy."
        </p>
        <div class="testimonial__author">
          <div class="testimonial__avatar testimonial__avatar--rose">DP</div>
          <div>
            <div class="testimonial__name">Nina Park</div>
            <div class="testimonial__role">Twin Pines Auto Repair, Hill Valley CA</div>
          </div>
        </div>
      </div>
      <div class="testimonial reveal reveal-delay-2">
        <div class="testimonial__stars">★★★★★</div>
        <p class="testimonial__quote">
          "Last month SiteStaffr captured a lead while I was in court that turned into a $12,000 case. That one conversation paid for years of the service. It's a no-brainer."
        </p>
        <div class="testimonial__author">
          <div class="testimonial__avatar testimonial__avatar--amber">JT</div>
          <div>
            <div class="testimonial__name">James Thornton</div>
            <div class="testimonial__role">Thornton Law Group, Nashville TN</div>
          </div>
        </div>
      </div>
      <div class="testimonial reveal reveal-delay-3">
        <div class="testimonial__stars">★★★★★</div>
        <p class="testimonial__quote">
          "I was paying $280/month for an answering service that kept getting my listings wrong. SiteStaffr is $50/month and actually knows my current inventory. Switching was the best decision I made this year."
        </p>
        <div class="testimonial__author">
          <div class="testimonial__avatar testimonial__avatar--violet">LK</div>
          <div>
            <div class="testimonial__name">Lisa Kimura</div>
            <div class="testimonial__role">Kimura Real Estate, Portland OR</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ========== SECTION 9: FAQ ========== -->
<section class="faq-section" id="faq">
  <div class="container">
    <div class="faq-section__header reveal">
      <span class="section-label" id="faq-label">Common questions</span>
      <h2>Everything you need to know</h2>
      <p class="faq-section__subtitle">Still have questions? We're here to help.</p>
    </div>
    <div class="faq-list">
      <div class="faq-item reveal">
        <button class="faq-item__question">
          Does it actually sound natural?
          <span class="faq-item__icon">+</span>
        </button>
        <div class="faq-item__answer">
          <div class="faq-item__answer-inner">
            Yes. SiteStaffr uses advanced AI voice technology designed to produce natural, conversational speech. The best way to evaluate it is to <a href="#hero-audio-demo" style="color: var(--teal-deep); text-decoration: underline;">listen to a sample conversation</a> in the hero section.
          </div>
        </div>
      </div>
      <div class="faq-item reveal reveal-delay-1">
        <button class="faq-item__question">
          What if the AI doesn't know the answer to a question?
          <span class="faq-item__icon">+</span>
        </button>
        <div class="faq-item__answer">
          <div class="faq-item__answer-inner">
            SiteStaffr uses your website content and business knowledge first, then falls back gracefully when it needs help. If something still needs a human answer, it captures the visitor&rsquo;s details and gives you the context to follow up without guessing.
          </div>
        </div>
      </div>
      <div class="faq-item reveal">
        <button class="faq-item__question">
          Can I customize what it says about my business?
          <span class="faq-item__icon">+</span>
        </button>
        <div class="faq-item__answer">
          <div class="faq-item__answer-inner">
            Absolutely. You can shape SiteStaffr with your website content, business details, services, FAQs, hours, and other important context so it reflects your business more accurately from the start.
          </div>
        </div>
      </div>
      <div class="faq-item reveal reveal-delay-1">
        <button class="faq-item__question">
          Does it work on mobile devices?
          <span class="faq-item__icon">+</span>
        </button>
        <div class="faq-item__answer">
          <div class="faq-item__answer-inner">
            Yes. SiteStaffr runs in the visitor&rsquo;s browser, so the website assistant experience works across desktop, tablet, and modern mobile devices. Visitors can talk when voice is available, and they can still engage from modern devices without feeling boxed into one interaction style.
          </div>
        </div>
      </div>
      <div class="faq-item reveal">
        <button class="faq-item__question">
          Does it work in other languages?
          <span class="faq-item__icon">+</span>
        </button>
        <div class="faq-item__answer">
          <div class="faq-item__answer-inner">
            Yes &mdash; SiteStaffr supports 57+ languages including Spanish, French, Mandarin, Portuguese, Arabic, and many more. It can converse naturally with your visitors in their language, then translates the entire conversation to English for your summary. Helpful for businesses in multilingual communities.
          </div>
        </div>
      </div>
      <div class="faq-item reveal">
        <button class="faq-item__question">
          What happens when I run out of minutes?
          <span class="faq-item__icon">+</span>
        </button>
        <div class="faq-item__answer">
          <div class="faq-item__answer-inner">
            You'll get notified when you're running low. There are no surprise charges or automatic overages. When your minutes are used up, you can buy an add-on pack ($10 for 50 minutes, and they never expire) or upgrade your plan. You're always in control.
          </div>
        </div>
      </div>
      <div class="faq-item reveal reveal-delay-1">
        <button class="faq-item__question">
          Can I cancel anytime?
          <span class="faq-item__icon">+</span>
        </button>
        <div class="faq-item__answer">
          <div class="faq-item__answer-inner">
            Yes. No contracts, no cancellation fees, no hoops to jump through. You can cancel your subscription anytime from your account dashboard. We'd hate to see you go, but cancellation is straightforward.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ========== SECTION 10: FINAL CTA ========== -->
<section class="final-cta">
  <div class="container reveal">
    <h2>Your website can keep helping people while you&apos;re busy.<br>Visitors get answers. You get the recap.</h2>
    <p class="final-cta__subtitle">
      Free for 30 days. No credit card required.<br>
      <span class="final-cta__setup">Set up in under 10 minutes.</span>
    </p>
    <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--white btn--large">
      Get Started
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
    </a>
  </div>
</section>

<!-- ========== FOOTER ========== -->
<?php get_template_part( 'template-parts/site-footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
