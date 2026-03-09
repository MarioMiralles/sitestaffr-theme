<?php
/*
Template Name: Landing Page
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$landing_title = 'SiteStaffr | AI Voice Agent for WordPress';
$landing_description = 'An AI voice agent that works 24/7 on your WordPress site. Visitors talk, it listens, and you get every detail. Supports 57+ languages.';
$landing_keywords = 'AI voice agent, WordPress voice assistant, lead capture, phone answering service, website assistant';
$landing_url = get_permalink();
$landing_url = $landing_url ? $landing_url : home_url( '/' );
$landing_image_url = get_stylesheet_directory_uri() . '/assets/images/hero.png';
$site_name = get_bloginfo( 'name' );
$show_testimonials = false;
$beta_signup_url = 'https://forms.gle/AemK46VeXUXqerqU6';
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
    <meta property="og:image:alt" content="SiteStaffr AI voice agent preview">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr( $landing_title ); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr( $landing_description ); ?>">
    <meta name="twitter:image" content="<?php echo esc_url( $landing_image_url ); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class( 'sitestaffr-landing-page' ); ?>>
<?php wp_body_open(); ?>
<!-- ========== NAVIGATION ========== -->
<nav class="nav" id="nav">
  <div class="container">
    <div class="nav__inner">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav__logo" aria-label="SiteStaffr home">
        <img
          class="nav__logo-image"
          src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/logo.png' ) ); ?>"
          alt="SiteStaffr"
        >
      </a>
      <ul class="nav__menu" id="navPrimaryMenu" aria-label="Primary">
        <li><a class="nav__link" href="#hero-audio-demo">Demo</a></li>
        <li><a class="nav__link" href="#pricing-label">Pricing</a></li>
        <li><a class="nav__link" href="#faq-label">FAQ</a></li>
      </ul>
      <div class="nav__cta">
        <a href="<?php echo esc_url( $beta_signup_url ); ?>" class="btn btn--primary" target="_blank" rel="noopener noreferrer">Get Early Access</a>
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

<!-- ========== SECTION 1: HERO ========== -->
<section class="hero">
  <div class="container">
    <div class="hero__grid">
      <div class="hero__content reveal">
        <span class="hero__tagline">AI Voice Agent for WordPress</span>
        <h1 class="hero__headline">
          <span class="hero__headline-prefix">Your Website Visitors Have Questions.</span>
          <span class="hero__headline-focus">SiteStaffr Answers Them.</span>
        </h1>
        <p class="hero__subtitle">
          An AI voice agent that works 24/7 on your WordPress site. Visitors talk, it listens, and you get every detail. Supports 57+ languages.
        </p>
        <span class="hero__no-cc">Free for 30 days &bull; Install in minutes &bull; No code required</span>
        <div class="hero__actions">
          <a href="<?php echo esc_url( $beta_signup_url ); ?>" class="btn btn--primary btn--large" target="_blank" rel="noopener noreferrer">
            Get Early Access
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
          <a href="<?php echo esc_url( $beta_signup_url ); ?>" class="btn btn--primary btn--large" target="_blank" rel="noopener noreferrer">
            Get Early Access
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

<!-- ========== LANGUAGE SECTION: 57+ LANGUAGES ========== -->
<section class="language-section">
  <div class="language-section__floaters">
    <span class="language-float">Hola</span>
    <span class="language-float">Bonjour</span>
    <span class="language-float">&#20320;&#22909;</span>
    <span class="language-float">&#1605;&#1585;&#1581;&#1576;&#1575;</span>
    <span class="language-float">Ol&aacute;</span>
    <span class="language-float">&#12371;&#12435;&#12395;&#12385;&#12399;</span>
    <span class="language-float">&#1055;&#1088;&#1080;&#1074;&#1077;&#1090;</span>
    <span class="language-float">&#50504;&#45397;&#54616;&#49464;&#50836;</span>
    <span class="language-float">Xin ch&agrave;o</span>
    <span class="language-float">Ciao</span>
    <span class="language-float">Hallo</span>
    <span class="language-float">Namaste</span>
    <span class="language-float">Merhaba</span>
    <span class="language-float">Salut</span>
    <span class="language-float">Sawubona</span>
    <span class="language-float">&#3626;&#3623;&#3633;&#3626;&#3604;&#3637;</span>
  </div>
  <div class="container">
    <div class="language-section__inner reveal">
      <span class="section-label">57+ languages, one inbox</span>
      <h2>SiteStaffr speaks <span class="language-heading__phrase"><em>their</em> language</span></h2>
      <p class="language-section__desc">
        A customer visits your site and starts speaking Spanish. Or Mandarin. Or Portuguese. SiteStaffr understands them, responds naturally in their language, and delivers the full conversation summary to you &mdash; translated to English.
      </p>
      <div class="language-section__cards">
        <div class="language-card reveal reveal-delay-1">
          <span class="language-card__icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
          </span>
          <div class="language-card__title">Converses naturally</div>
          <p class="language-card__text">Your AI voice agent detects the visitor's language and responds fluently &mdash; no awkward translations or language menus.</p>
        </div>
        <div class="language-card reveal reveal-delay-2">
          <span class="language-card__icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M7 12h2l2-4 2 8 2-4h2"/></svg>
          </span>
          <div class="language-card__title">English summary for you</div>
          <p class="language-card__text">No matter what language the conversation happens in, your recap email arrives in English with every detail captured.</p>
        </div>
      </div>
      <div class="language-section__stat reveal reveal-delay-3">
        <span class="language-section__stat-globe">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
        </span>
        <span>Including Spanish, French, Mandarin, Portuguese, Arabic, Hindi, and <strong>50+ more</strong></span>
      </div>
    </div>
  </div>
</section>

<!-- ========== FEATURES SECTION ========== -->
<section class="features-section">
  <div class="container">
    <div class="features-section__header reveal">
      <span class="section-label">Features</span>
      <h2>Everything You Need to Manage Your Conversations</h2>
      <p class="features-section__subtitle">
        SiteStaffr isn&rsquo;t just a voice widget &mdash; it&rsquo;s a complete conversation management system inside WordPress.
      </p>
    </div>
    <div class="features-grid">
      <div class="feature-card feature-card--half reveal" data-feature-lightbox="dashboard">
        <div class="feature-card__screenshot">
          <picture>
            <source media="(max-width: 767px)" srcset="<?php echo esc_url( $feature_screenshot_url( 'dashboard', 'mobile' ) ); ?>">
            <img
              src="<?php echo esc_url( $feature_screenshot_url( 'dashboard', 'desktop' ) ); ?>"
              alt="Conversation Dashboard screenshot"
              loading="lazy"
              decoding="async"
            >
          </picture>
        </div>
        <h3 class="feature-card__title">Conversation Dashboard</h3>
        <p class="feature-card__desc">Every conversation at a glance. See who talked, what they need, and what to do next &mdash; without leaving WordPress.</p>
      </div>
      <div class="feature-card feature-card--half reveal reveal-delay-1" data-feature-lightbox="email-recaps">
        <div class="feature-card__screenshot">
          <picture>
            <source media="(max-width: 767px)" srcset="<?php echo esc_url( $feature_screenshot_url( 'email-recaps', 'mobile' ) ); ?>">
            <img
              src="<?php echo esc_url( $feature_screenshot_url( 'email-recaps', 'desktop' ) ); ?>"
              alt="Email Recaps screenshot"
              loading="lazy"
              decoding="async"
            >
          </picture>
        </div>
        <h3 class="feature-card__title">Email Recaps</h3>
        <p class="feature-card__desc">Get a summary after every conversation &mdash; visitor name, contact info, what they need, and a suggested next step.</p>
      </div>

      <!-- Voice Agent Showcase -->
      <div class="voice-showcase voice-showcase--full reveal" id="voiceShowcase">
        <div class="voice-showcase__header">
          <h3 class="voice-showcase__title">Meet Your AI Voice Agent</h3>
          <p class="voice-showcase__subtitle">
            <span>Choose from 10 unique AI voices, each with their own personality.</span>
            <span>Preview them right here.</span>
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

      <div class="feature-card feature-card--third reveal" data-feature-lightbox="analytics">
        <div class="feature-card__screenshot">
          <picture>
            <source media="(max-width: 767px)" srcset="<?php echo esc_url( $feature_screenshot_url( 'analytics', 'mobile' ) ); ?>">
            <img
              src="<?php echo esc_url( $feature_screenshot_url( 'analytics', 'desktop' ) ); ?>"
              alt="Smart Analytics screenshot"
              loading="lazy"
              decoding="async"
            >
          </picture>
        </div>
        <h3 class="feature-card__title">Smart Analytics</h3>
        <p class="feature-card__desc">Track your answer rate, after-hours conversations, minutes used, and spam filtered. Know exactly how your AI is performing.</p>
      </div>
      <div class="feature-card feature-card--third reveal reveal-delay-1" data-feature-lightbox="ai-generator">
        <div class="feature-card__screenshot">
          <picture>
            <source media="(max-width: 767px)" srcset="<?php echo esc_url( $feature_screenshot_url( 'ai-generator', 'mobile' ) ); ?>">
            <img
              src="<?php echo esc_url( $feature_screenshot_url( 'ai-generator', 'desktop' ) ); ?>"
              alt="AI Description Generator screenshot"
              loading="lazy"
              decoding="async"
            >
          </picture>
        </div>
        <h3 class="feature-card__title">AI Description Generator</h3>
        <p class="feature-card__desc">Not sure what to tell the AI about your business? It scans your website and writes the description for you.</p>
      </div>
      <div class="feature-card feature-card--third reveal reveal-delay-2" data-feature-lightbox="protection">
        <div class="feature-card__screenshot">
          <picture>
            <source media="(max-width: 767px)" srcset="<?php echo esc_url( $feature_screenshot_url( 'protection', 'mobile' ) ); ?>">
            <img
              src="<?php echo esc_url( $feature_screenshot_url( 'protection', 'desktop' ) ); ?>"
              alt="Built-in Protection screenshot"
              loading="lazy"
              decoding="async"
            >
          </picture>
        </div>
        <h3 class="feature-card__title">Built-in Protection</h3>
        <p class="feature-card__desc">Block abusive visitors by IP, filter spam automatically, and report AI issues with one click.</p>
      </div>
    </div>
  </div>
</section>

<!-- ========== WIDGET & BUTTON CUSTOMIZATION ========== -->
<section class="customize-section" id="customize">
  <div class="container">
    <div class="customize-section__header reveal">
      <span class="section-label">Widget and Button Customization</span>
      <h2>Customize Your Widget and Button</h2>
      <p class="customize-section__subtitle">
        Match SiteStaffr to your brand with live controls for icon styles, colors, typography, borders, spacing, and hover effects.
      </p>
    </div>

    <div class="customize-grid">
      <article class="customize-panel reveal" id="customizeWidgetPanel">
        <div class="customize-panel__header">
          <h3>Floating Widget Preview</h3>
        </div>

        <div class="customize-preview customize-preview--widget">
          <div class="customize-browser">
            <div class="customize-browser__chrome">
              <span></span><span></span><span></span>
            </div>
            <div class="customize-browser__body customize-browser__body--widget">
              <div class="customize-mock-site customize-mock-site--widget" aria-hidden="true">
                <div class="customize-mock-chip-row">
                  <span class="customize-mock-chip"></span>
                  <span class="customize-mock-chip"></span>
                </div>
                <div class="customize-mock-hero">
                  <span class="customize-mock-line customize-mock-line--lg"></span>
                  <span class="customize-mock-line customize-mock-line--md"></span>
                  <span class="customize-mock-line customize-mock-line--sm"></span>
                </div>
                <div class="customize-mock-columns">
                  <div class="customize-mock-card">
                    <span class="customize-mock-line customize-mock-line--md"></span>
                    <span class="customize-mock-line customize-mock-line--sm"></span>
                  </div>
                  <div class="customize-mock-card">
                    <span class="customize-mock-line customize-mock-line--sm"></span>
                    <span class="customize-mock-line customize-mock-line--xs"></span>
                  </div>
                </div>
              </div>
              <div class="customize-widget-off" id="lpWidgetOffNotice" hidden>Widget hidden (auto-display off)</div>
              <button type="button" class="customize-widget-btn" id="lpWidgetPreviewButton" aria-label="Talk to our AI voice agent"></button>
            </div>
          </div>
        </div>

        <details class="customize-controls-toggle">
          <summary>Customize widget settings</summary>
          <div class="customize-controls">
            <div class="customize-control customize-control--switch">
              <label for="lpWidgetAutoDisplay">Show on all pages</label>
              <input id="lpWidgetAutoDisplay" type="checkbox" checked data-widget-control>
            </div>

            <div class="customize-control">
              <label for="lpWidgetIcon">Icon type</label>
              <select id="lpWidgetIcon" data-widget-control>
                <option value="sitestaffr">SiteStaffr</option>
                <option value="phone">Phone</option>
                <option value="microphone">Microphone</option>
                <option value="chat">Chat</option>
                <option value="headset">Headset</option>
              </select>
            </div>

            <div class="customize-control">
              <label for="lpWidgetSize">Widget size <span id="lpWidgetSizeValue" class="customize-control__value">60px</span></label>
              <input id="lpWidgetSize" type="range" min="46" max="80" value="60" data-widget-control>
            </div>

            <div class="customize-control">
              <label for="lpWidgetIconSize">Icon size <span id="lpWidgetIconSizeValue" class="customize-control__value">40px</span></label>
              <input id="lpWidgetIconSize" type="range" min="14" max="64" value="40" data-widget-control>
            </div>

            <div class="customize-control customize-control--full customize-radius-group">
              <div class="customize-radius-group__header">
                <p class="customize-radius-group__title">Border Radius</p>
                <label class="customize-radius-group__lock" for="lpWidgetRadiusLock">
                  <span>Lock all corners</span>
                  <input id="lpWidgetRadiusLock" type="checkbox" data-widget-control>
                </label>
              </div>
              <div class="customize-radius-group__grid">
                <div class="customize-control customize-control--radius">
                  <label for="lpWidgetRadiusTop">Top <span id="lpWidgetRadiusTopValue" class="customize-control__value">20px</span></label>
                  <input id="lpWidgetRadiusTop" type="range" min="0" max="80" value="20" data-widget-control>
                </div>
                <div class="customize-control customize-control--radius">
                  <label for="lpWidgetRadiusRight">Right <span id="lpWidgetRadiusRightValue" class="customize-control__value">20px</span></label>
                  <input id="lpWidgetRadiusRight" type="range" min="0" max="80" value="20" data-widget-control>
                </div>
                <div class="customize-control customize-control--radius">
                  <label for="lpWidgetRadiusBottom">Bottom <span id="lpWidgetRadiusBottomValue" class="customize-control__value">20px</span></label>
                  <input id="lpWidgetRadiusBottom" type="range" min="0" max="80" value="20" data-widget-control>
                </div>
                <div class="customize-control customize-control--radius">
                  <label for="lpWidgetRadiusLeft">Left <span id="lpWidgetRadiusLeftValue" class="customize-control__value">0px</span></label>
                  <input id="lpWidgetRadiusLeft" type="range" min="0" max="80" value="0" data-widget-control>
                </div>
              </div>
            </div>

            <div class="customize-control">
              <label for="lpWidgetBg">Background</label>
              <input id="lpWidgetBg" type="color" value="#10b981" data-widget-control>
            </div>

            <div class="customize-control">
              <label for="lpWidgetHoverBg">Hover color</label>
              <input id="lpWidgetHoverBg" type="color" value="#0ea572" data-widget-control>
            </div>

            <div class="customize-control">
              <label for="lpWidgetIconColor">Icon color</label>
              <input id="lpWidgetIconColor" type="color" value="#ffffff" data-widget-control>
            </div>
          </div>
        </details>
      </article>

      <article class="customize-panel customize-panel--button reveal reveal-delay-1" id="customizeButtonPanel">
        <div class="customize-panel__sticky">
          <div class="customize-panel__header">
            <h3>Inline Button Preview</h3>
          </div>

          <div class="customize-preview customize-preview--button">
            <div class="customize-browser">
              <div class="customize-browser__chrome">
                <span></span><span></span><span></span>
              </div>
              <div class="customize-browser__body customize-browser__body--button">
                <div class="customize-mock-site customize-mock-site--button" aria-hidden="true">
                  <div class="customize-mock-line customize-mock-line--lg"></div>
                  <div class="customize-mock-line customize-mock-line--md"></div>
                  <div class="customize-mock-line customize-mock-line--sm"></div>
                </div>
                <section class="customize-cta-block" aria-label="Example call to action placement">
                  <h4 class="customize-cta-block__title">Need Assistance?</h4>
                  <div class="customize-button-wrap customize-button-wrap--cta" id="lpButtonPreviewWrap">
                    <button type="button" class="customize-button-preview" id="lpButtonPreviewButton" aria-label="Contact us button preview"></button>
                  </div>
                </section>
              </div>
            </div>
          </div>
        </div>

        <details class="customize-controls-toggle" id="customizeButtonControls">
          <summary>Customize button settings</summary>
          <div class="customize-controls">
            <div class="customize-control customize-control--full">
              <label for="lpButtonText">Button text</label>
              <input id="lpButtonText" type="text" value="Contact Us" data-button-control>
            </div>

            <div class="customize-control">
              <label for="lpButtonIcon">Icon type</label>
              <select id="lpButtonIcon" data-button-control>
                <option value="sitestaffr">SiteStaffr</option>
                <option value="microphone">Microphone</option>
                <option value="phone">Phone</option>
                <option value="chat">Chat</option>
                <option value="headset">Headset</option>
                <option value="none">None</option>
              </select>
            </div>

            <div class="customize-control">
              <label for="lpButtonIconPosition">Icon position</label>
              <select id="lpButtonIconPosition" data-button-control>
                <option value="left">Left</option>
                <option value="right">Right</option>
              </select>
            </div>

            <div class="customize-control">
              <label for="lpButtonIconSize">Icon size <span id="lpButtonIconSizeValue" class="customize-control__value">32px</span></label>
              <input id="lpButtonIconSize" type="range" min="12" max="48" value="32" data-button-control>
            </div>

            <div class="customize-control">
              <label for="lpButtonFontSize">Font size <span id="lpButtonFontSizeValue" class="customize-control__value">16px</span></label>
              <input id="lpButtonFontSize" type="range" min="13" max="22" value="16" data-button-control>
            </div>

            <div class="customize-control">
              <label for="lpButtonFontWeight">Font weight</label>
              <select id="lpButtonFontWeight" data-button-control>
                <option value="400">Normal</option>
                <option value="600" selected>Semi-Bold</option>
                <option value="700">Bold</option>
              </select>
            </div>

            <div class="customize-control">
              <label for="lpButtonTextTransform">Text transform</label>
              <select id="lpButtonTextTransform" data-button-control>
                <option value="none" selected>None</option>
                <option value="uppercase">UPPERCASE</option>
                <option value="capitalize">Capitalize</option>
              </select>
            </div>

            <div class="customize-control">
              <label for="lpButtonTextColor">Text color</label>
              <input id="lpButtonTextColor" type="color" value="#ffffff" data-button-control>
            </div>

            <div class="customize-control">
              <label for="lpButtonIconColor">Icon color</label>
              <input id="lpButtonIconColor" type="color" value="#ffffff" data-button-control>
            </div>

            <div class="customize-control">
              <label for="lpButtonBg">Background</label>
              <input id="lpButtonBg" type="color" value="#1fb6cc" data-button-control>
            </div>

            <div class="customize-control">
              <label for="lpButtonHoverBg">Hover color</label>
              <input id="lpButtonHoverBg" type="color" value="#17a2b8" data-button-control>
            </div>
          </div>

          <div class="customize-controls__divider">Advanced controls</div>

          <div class="customize-controls customize-controls--advanced">
            <div class="customize-control customize-control--switch">
              <label for="lpButtonGradient">Enable gradient</label>
              <input id="lpButtonGradient" type="checkbox" checked data-button-control>
            </div>

            <div class="customize-control">
              <label for="lpButtonGradientEnd">Gradient end color</label>
              <input id="lpButtonGradientEnd" type="color" value="#10b981" data-button-control>
            </div>

            <div class="customize-control customize-control--full customize-radius-group">
              <div class="customize-radius-group__header">
                <p class="customize-radius-group__title">Border Radius</p>
                <label class="customize-radius-group__lock" for="lpButtonRadiusLock">
                  <span>Lock all corners</span>
                  <input id="lpButtonRadiusLock" type="checkbox" data-button-control>
                </label>
              </div>
              <div class="customize-radius-group__grid">
                <div class="customize-control customize-control--radius">
                  <label for="lpButtonRadiusTop">Top <span id="lpButtonRadiusTopValue" class="customize-control__value">80px</span></label>
                  <input id="lpButtonRadiusTop" type="range" min="0" max="120" value="80" data-button-control>
                </div>
                <div class="customize-control customize-control--radius">
                  <label for="lpButtonRadiusRight">Right <span id="lpButtonRadiusRightValue" class="customize-control__value">80px</span></label>
                  <input id="lpButtonRadiusRight" type="range" min="0" max="120" value="80" data-button-control>
                </div>
                <div class="customize-control customize-control--radius">
                  <label for="lpButtonRadiusBottom">Bottom <span id="lpButtonRadiusBottomValue" class="customize-control__value">80px</span></label>
                  <input id="lpButtonRadiusBottom" type="range" min="0" max="120" value="80" data-button-control>
                </div>
                <div class="customize-control customize-control--radius">
                  <label for="lpButtonRadiusLeft">Left <span id="lpButtonRadiusLeftValue" class="customize-control__value">80px</span></label>
                  <input id="lpButtonRadiusLeft" type="range" min="0" max="120" value="80" data-button-control>
                </div>
              </div>
            </div>

            <div class="customize-control">
              <label for="lpButtonBorderWidth">Border width <span id="lpButtonBorderWidthValue" class="customize-control__value">0px</span></label>
              <input id="lpButtonBorderWidth" type="range" min="0" max="8" value="0" data-button-control>
            </div>

            <div class="customize-control">
              <label for="lpButtonBorderColor">Border color</label>
              <input id="lpButtonBorderColor" type="color" value="#1fb6cc" data-button-control>
            </div>

            <div class="customize-control customize-control--switch">
              <label for="lpButtonShadow">Enable shadow</label>
              <input id="lpButtonShadow" type="checkbox" checked data-button-control>
            </div>

            <div class="customize-control">
              <label for="lpButtonShadowBlur">Shadow blur <span id="lpButtonShadowBlurValue" class="customize-control__value">10px</span></label>
              <input id="lpButtonShadowBlur" type="range" min="0" max="28" value="10" data-button-control>
            </div>

            <div class="customize-control">
              <label for="lpButtonShadowOffset">Shadow offset <span id="lpButtonShadowOffsetValue" class="customize-control__value">4px</span></label>
              <input id="lpButtonShadowOffset" type="range" min="0" max="18" value="4" data-button-control>
            </div>

            <div class="customize-control">
              <label for="lpButtonPaddingX">Horizontal padding <span id="lpButtonPaddingXValue" class="customize-control__value">24px</span></label>
              <input id="lpButtonPaddingX" type="range" min="12" max="48" value="24" data-button-control>
            </div>

            <div class="customize-control">
              <label for="lpButtonPaddingY">Vertical padding <span id="lpButtonPaddingYValue" class="customize-control__value">12px</span></label>
              <input id="lpButtonPaddingY" type="range" min="8" max="24" value="12" data-button-control>
            </div>

            <div class="customize-control customize-control--switch">
              <label for="lpButtonFullWidth">Full width button</label>
              <input id="lpButtonFullWidth" type="checkbox" data-button-control>
            </div>

            <div class="customize-control">
              <label for="lpButtonHoverAnimation">Hover animation</label>
              <select id="lpButtonHoverAnimation" data-button-control>
                <option value="none" selected>None</option>
                <option value="scale">Scale</option>
                <option value="glow">Glow</option>
                <option value="pulse">Pulse</option>
              </select>
            </div>
          </div>
        </details>
      </article>
    </div>

    <p class="customize-section__note reveal">Preview only. Your live settings are saved and managed inside the SiteStaffr plugin dashboard.</p>
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

<!-- ========== SECTION 6: HOW IT WORKS ========== -->
<section class="how-section">
  <div class="container">
    <div class="container--narrow reveal">
      <span class="section-label">Setup in minutes, not days</span>
      <h2 class="how-section__title">Three steps to start capturing website leads</h2>
      <p class="how-section__subtitle">No developers needed. No API keys. No configuration headaches.</p>
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
        <p class="step__desc">Your widget is active by default after setup. Keep it as-is, toggle it off, or customize the widget and button anytime.</p>
        <span class="step__time">You're done</span>
      </div>
    </div>
  </div>
</section>

<!-- ========== SECTION 7: PRICING ========== -->
<section class="pricing-section" id="pricing">
  <div class="container">
    <div class="pricing-section__header reveal">
      <span class="section-label" id="pricing-label">Simple, transparent pricing</span>
      <h2>Start free. Upgrade when you're ready.</h2>
      <p class="pricing-section__subtitle">No contracts. No hidden fees. No surprise charges.</p>
    </div>
    <div class="pricing-includes reveal">
      <p class="pricing-includes__title">All plans include:</p>
      <ul class="pricing-includes__list">
        <li>57+ languages with English translation</li>
        <li>Conversation dashboard with full transcripts</li>
        <li>Email recap after every conversation</li>
        <li>Widget and button customization</li>
        <li>Built-in spam and abuse protection</li>
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
          <li>AI description generations</li>
          <li>No credit card required</li>
        </ul>
        <p class="pricing-card__best-for">Try SiteStaffr free for 30 days</p>
        <a href="<?php echo esc_url( $beta_signup_url ); ?>" class="btn btn--outline" target="_blank" rel="noopener noreferrer">Start Free Trial</a>
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
        <a href="<?php echo esc_url( $beta_signup_url ); ?>" class="btn btn--outline" target="_blank" rel="noopener noreferrer">Get Early Access</a>
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
        <p class="pricing-card__best-for">Best for growing local businesses</p>
        <a href="<?php echo esc_url( $beta_signup_url ); ?>" class="btn btn--primary" target="_blank" rel="noopener noreferrer">Get Early Access</a>
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
          <li>20 AI description generations per billing cycle</li>
          <li>Priority access to new features</li>
        </ul>
        <p class="pricing-card__best-for">Best for multi-location or high-traffic sites</p>
        <a href="<?php echo esc_url( $beta_signup_url ); ?>" class="btn btn--outline" target="_blank" rel="noopener noreferrer">Get Early Access</a>
      </div>
    </div>
    <div class="pricing-addon reveal">
      <h3 class="pricing-addon__title">Run out of minutes? You stay in control.</h3>
      <p class="pricing-addon__text">Buy add-on packs anytime: <strong>$10 for 50 extra minutes</strong>. They never expire, and there are no automatic overage charges.</p>
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
            It handles it gracefully &mdash; just like a good receptionist would. It honestly says something like "I'm not sure about that, but let me take your details and have someone get back to you." No making things up, no awkward silences. It takes a message and you follow up on your terms.
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
            Absolutely. You control your business name, services, hours, FAQs, and any specific details you want the AI to know. It uses this information to answer questions accurately and represent your business the way you want.
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
            Yes. SiteStaffr runs in the visitor&rsquo;s browser, so the voice experience works across desktop, tablet, and modern mobile devices. As long as their browser supports microphone access, they can talk to your AI voice agent from any device.
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
    <h2>Your next customer is calling.<br>SiteStaffr answers while you're busy.</h2>
    <p class="final-cta__subtitle">
      Free for 30 days. No credit card required.<br>
      <span class="final-cta__setup">Set up in under 10 minutes.</span>
    </p>
    <a href="<?php echo esc_url( $beta_signup_url ); ?>" class="btn btn--white btn--large" target="_blank" rel="noopener noreferrer">
      Get Early Access
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
    </a>
  </div>
</section>

<!-- ========== FOOTER ========== -->
<footer class="footer">
  <div class="container">
    <div class="footer__links">
      <a href="<?php echo esc_url( home_url( '/privacy' ) ); ?>">Privacy Policy</a>
      <a href="<?php echo esc_url( home_url( '/terms' ) ); ?>">Terms of Service</a>
      <a href="mailto:support@sitestaffr.com">Support</a>
    </div>
    <p>&copy; 2026 SiteStaffr. All rights reserved.</p>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
