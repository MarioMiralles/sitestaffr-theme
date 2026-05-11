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
$landing_image_url = get_stylesheet_directory_uri() . '/assets/images/hero.webp';
$site_name = get_bloginfo( 'name' );
$get_started_url = home_url( '/#get-started' );
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
<?php
get_template_part( 'template-parts/site-nav', null, array(
    'menu_items' => array(
        array( 'label' => 'Voices', 'href' => '#voices' ),
        array( 'label' => 'Pricing', 'href' => '#pricing' ),
        array( 'label' => 'My Account', 'href' => home_url( '/manage/' ) ),
    ),
    'cta' => array(
        'label' => 'Get Started',
        'href'  => '#get-started',
    ),
) );
?>

<main>
<!-- ========== SECTION 1: HERO ========== -->
<section class="hero">
  <canvas id="hero-soundwave" class="hero__canvas" aria-hidden="true"></canvas>
  <div class="container">
    <div class="hero__grid">
      <div class="hero__content reveal">
        <span class="hero__tagline">Built for WordPress</span>
        <h1 class="hero__headline">
          <span class="hero__headline-prefix">Your Website Visitors Have Questions.</span>
          <span class="hero__headline-focus">SiteStaffr Answers Them.</span>
        </h1>
        <p class="hero__subtitle">
          An AI voice agent that works 24/7 on your WordPress site. Visitors talk, it listens, and you get every detail. Supports 57+ languages.
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

<!-- ========== SECTION 2: COST OF MISSED VISITORS ========== -->
<section class="cost-section">
  <div class="container">
    <div class="cost-section__grid">
      <div class="reveal">
        <span class="section-label">The Hidden Cost of Lost Website Visitors</span>
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

<!-- ========== SECTION 3: VOICE & CHAT ========== -->
<section class="voice-text-section">
  <div class="container">
    <div class="voice-text-section__header reveal">
      <span class="section-label">Two Ways to Connect</span>
      <h2>Voice &amp; Chat</h2>
      <p class="voice-text-section__desc">Your visitors choose how they want to communicate. Some prefer talking, others prefer typing &mdash; SiteStaffr handles both with the same AI and the same answers.</p>
    </div>

    <div class="voice-text-section__panel reveal">
      <!-- Mode selector cards -->
      <div class="voice-text-section__selector">
        <button class="voice-text-section__card voice-text-section__card--active" data-vt-mode="voice" type="button">
          <span class="voice-text-section__card-badge">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/>
              <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
              <line x1="12" y1="19" x2="12" y2="23"/>
              <line x1="8" y1="23" x2="16" y2="23"/>
            </svg>
          </span>
          <span class="voice-text-section__card-title">Voice</span>
          <span class="voice-text-section__card-desc">Talk with our AI assistant</span>
        </button>
        <button class="voice-text-section__card" data-vt-mode="text" type="button">
          <span class="voice-text-section__card-badge">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>
          </span>
          <span class="voice-text-section__card-title">Text</span>
          <span class="voice-text-section__card-desc">Type your questions</span>
        </button>
      </div>

      <!-- Preview area -->
      <div class="voice-text-section__preview">
        <!-- Voice mode preview -->
        <div class="voice-text-section__mode voice-text-section__mode--voice voice-text-section__mode--active">
          <div class="voice-text-section__voice-stage">
            <div class="voice-text-section__mic-ring">
              <span class="voice-text-section__mic-pulse"></span>
              <span class="voice-text-section__mic-pulse voice-text-section__mic-pulse--delayed"></span>
              <svg class="voice-text-section__mic-svg" width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/>
                <path d="M19 10v2a7 7 0 0 1-14 0v-2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
            </div>
            <div class="voice-text-section__waveform" aria-hidden="true">
              <span></span><span></span><span></span><span></span><span></span><span></span><span></span>
            </div>
            <span class="voice-text-section__listening">Listening&hellip;</span>
          </div>
          <div class="voice-text-section__transcript">
            <div class="voice-text-section__msg voice-text-section__msg--visitor">
              <span class="voice-text-section__msg-dot"></span>
              <div class="voice-text-section__msg-content">
                <span class="voice-text-section__msg-who">Visitor</span>
                Hi, I&rsquo;d like to schedule an appointment for next week.
              </div>
            </div>
            <div class="voice-text-section__msg voice-text-section__msg--ai">
              <span class="voice-text-section__msg-dot"></span>
              <div class="voice-text-section__msg-content">
                <span class="voice-text-section__msg-who">AI Agent</span>
                Of course! I can help with that. What day works best for you?
              </div>
            </div>
          </div>
        </div>

        <!-- Text mode preview -->
        <div class="voice-text-section__mode voice-text-section__mode--text">
          <div class="voice-text-section__chat">
            <div class="voice-text-section__chat-row voice-text-section__chat-row--ai">
              <span class="voice-text-section__chat-avatar">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="10"/></svg>
              </span>
              <div class="voice-text-section__chat-bubble">Hi! How can I help you today?</div>
            </div>
            <div class="voice-text-section__chat-row voice-text-section__chat-row--visitor">
              <div class="voice-text-section__chat-bubble">Do you offer free consultations?</div>
            </div>
            <div class="voice-text-section__chat-row voice-text-section__chat-row--ai">
              <span class="voice-text-section__chat-avatar">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="10"/></svg>
              </span>
              <div class="voice-text-section__chat-bubble">Yes! We offer a complimentary 15-minute consultation. Would you like to schedule one?</div>
            </div>
            <div class="voice-text-section__chat-row voice-text-section__chat-row--ai voice-text-section__chat-typing">
              <span class="voice-text-section__chat-avatar">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="10"/></svg>
              </span>
              <div class="voice-text-section__chat-bubble">
                <span class="voice-text-section__dots"><span></span><span></span><span></span></span>
              </div>
            </div>
          </div>
          <div class="voice-text-section__input-bar">
            <span class="voice-text-section__input-text">Type a message&hellip;</span>
            <svg class="voice-text-section__send-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
          </div>
        </div>
      </div>

      <!-- Tagline -->
      <p class="voice-text-section__tagline">Same AI. Same knowledge. Their choice.</p>
    </div>
  </div>
</section>

<!-- ========== SECTION 4: WHAT YOU GET ========== -->
<section class="what-you-get" id="demo">
  <div class="container">
    <div class="what-you-get__header reveal">
      <span class="section-label" id="demo-label">After Every Conversation</span>
      <h2>A Complete Report, Delivered to Your Inbox</h2>
      <p class="what-you-get__subtitle">
        Automatically capture visitor conversations, summaries, and transcripts &mdash; all in one clean, shareable document.
      </p>
    </div>

    <div class="what-you-get__showcase reveal">
      <div class="what-you-get__layout">
        <!-- Left callouts -->
        <div class="what-you-get__callouts what-you-get__callouts--left">
          <div class="what-you-get__callout what-you-get__callout--recap">
            <div class="what-you-get__callout-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            </div>
            <h3 class="what-you-get__callout-title">Conversation Recap</h3>
            <p class="what-you-get__callout-desc">Instantly summarizes what the visitor needed</p>
          </div>
          <div class="what-you-get__callout what-you-get__callout--followup">
            <div class="what-you-get__callout-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            </div>
            <h3 class="what-you-get__callout-title">Actionable Follow-Up</h3>
            <p class="what-you-get__callout-desc">Know exactly what to do next</p>
          </div>
        </div>

        <!-- The document -->
        <div class="what-you-get__doc-wrapper">
          <div class="what-you-get__doc">

            <!-- Document header -->
            <div class="what-you-get__doc-header">
              <img class="what-you-get__doc-logo-img" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/logo.webp' ); ?>" alt="SiteStaffr" width="625" height="188">
              <span class="what-you-get__doc-print-btn">Print / Download PDF</span>
            </div>

            <!-- Business name heading -->
            <div class="what-you-get__doc-business">Maggie&rsquo;s Cakes</div>

            <!-- Conversation Recap -->
            <div class="what-you-get__doc-section what-you-get__doc-recap">
              <div class="what-you-get__doc-section-header">
                <strong>Conversation Recap</strong>
                <span>March 27, 2026 11:40 AM EDT</span>
              </div>
              <p><strong>Sarah</strong> reached out to inquire about ordering a custom birthday cake for her daughter&rsquo;s 7th birthday party. She&rsquo;s looking for a two-tier unicorn theme cake for 25 guests.</p>
              <ul>
                <li>Name: Sarah Mitchell</li>
                <li>Phone: <a class="what-you-get__doc-link" href="tel:+15551234567">(555) 123-4567</a></li>
                <li>Reason for contact: Custom birthday cake order inquiry</li>
              </ul>
              <p class="what-you-get__doc-followup"><strong>Suggested follow-up:</strong> Call Sarah back to confirm cake design details, discuss pricing for a two-tier unicorn cake, and schedule the pickup date for April 12th.</p>
            </div>

            <!-- Conversation Transcript -->
            <div class="what-you-get__doc-section what-you-get__doc-transcript">
              <div class="what-you-get__doc-section-header">
                <strong>Conversation Transcript</strong>
                <span>2:14</span>
              </div>

              <div class="what-you-get__doc-messages">
                <div class="what-you-get__doc-msg what-you-get__doc-msg--ai">
                  <div class="what-you-get__doc-msg-meta"><strong>AI</strong> 11:40:03 AM</div>
                  <p>Hi! Thanks for reaching out to Maggie&rsquo;s Cakes. How can I help you today?</p>
                </div>
                <div class="what-you-get__doc-msg what-you-get__doc-msg--visitor">
                  <div class="what-you-get__doc-msg-avatar">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v2h20v-2c0-3.3-6.7-5-10-5z"/></svg>
                  </div>
                  <div class="what-you-get__doc-msg-body">
                    <div class="what-you-get__doc-msg-meta"><strong>Visitor</strong> 11:40:10 AM</div>
                    <p>Hi! I need to order a birthday cake for my daughter. She&rsquo;s turning 7 and wants a unicorn theme.</p>
                  </div>
                </div>
                <div class="what-you-get__doc-msg what-you-get__doc-msg--ai">
                  <div class="what-you-get__doc-msg-meta"><strong>AI</strong> 11:40:12 AM</div>
                  <p>That sounds wonderful! We&rsquo;d love to help with a unicorn cake. How many guests are you expecting? And do you have a date in mind?</p>
                </div>
              </div>
            </div>

            <!-- Bottom fade overlay -->
            <div class="what-you-get__doc-fade"></div>
          </div>
        </div>

        <!-- Right callouts -->
        <div class="what-you-get__callouts what-you-get__callouts--right">
          <div class="what-you-get__callout what-you-get__callout--transcript">
            <div class="what-you-get__callout-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><line x1="10" y1="9" x2="8" y2="9"/></svg>
            </div>
            <h3 class="what-you-get__callout-title">Full Transcript</h3>
            <p class="what-you-get__callout-desc">See every message, exactly as it happened</p>
          </div>
          <div class="what-you-get__callout what-you-get__callout--instant">
            <div class="what-you-get__callout-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
            </div>
            <h3 class="what-you-get__callout-title">Delivered Instantly</h3>
            <p class="what-you-get__callout-desc">Generated and ready within seconds</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ========== SECTION 5: 57+ LANGUAGES ========== -->
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
      <span class="section-label">57+ Languages, One Inbox</span>
      <h2>SiteStaffr Speaks <span class="language-heading__phrase"><em>Their</em> Language</span></h2>
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

<!-- ========== SECTION 6: VOICE SHOWCASE ========== -->
<section class="voice-section" id="voices">
  <!-- Background portrait — crossfades on voice switch -->
  <div class="voice-section__bg-portrait" aria-hidden="true">
    <img id="voiceBgCurrent" class="voice-section__bg-img voice-section__bg-img--active" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/agents/portraits/marin.webp' ); ?>" alt="">
    <img id="voiceBgNext" class="voice-section__bg-img" src="" alt="">
  </div>
  <div class="container">
    <div class="voice-section__header reveal">
      <span class="section-label">Hear the Difference</span>
      <h2>Meet Your AI Voice Agent</h2>
      <p class="voice-section__subtitle"><span>Choose from 10 unique AI voices, each with their own personality.</span> <span>Preview them right here.</span></p>
    </div>
    <?php
    get_template_part( 'template-parts/voice-showcase', null, array(
        'id'          => 'voiceShowcase',
        'show_header' => false,
    ) );
    ?>
  </div>
</section>

<!-- ========== SECTION 7: GET STARTED ========== -->
<section class="onboarding-section" id="get-started">
  <div class="container">
    <div class="onboarding-section__inner reveal">
      <span class="section-label">Get Started</span>
      <h2 class="onboarding-section__headline">Let Us Set Up Your AI Voice Agent</h2>
      <div class="onboarding-section__cta">
        <?php echo do_shortcode( '[sitestaffr_button persona="onboarding" text="Tell Us About Your Business" background_color="#1FB6CC" hover_background="#00838F" gradient="off" icon="sitestaffr" box_shadow="off"]' ); ?>
      </div>
      <p class="onboarding-section__privacy">Your information will be used to set up your SiteStaffr assistant. See our <a href="<?php echo esc_url( home_url( '/privacy' ) ); ?>">Privacy Policy</a>.</p>

      <?php /* DIY install section — hidden until WP.org approval
      <div class="onboarding-section__diy reveal reveal-delay-1">
        <p class="onboarding-section__diy-label">Or set it up yourself in minutes</p>
        <div class="onboarding-section__timeline">
          <div class="onboarding-diy-step">
            <div class="onboarding-diy-step__circle">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
            </div>
            <h3 class="onboarding-diy-step__title">Install the Plugin</h3>
            <p class="onboarding-diy-step__desc">~2 minutes</p>
          </div>
          <div class="onboarding-diy-step__connector" aria-hidden="true"></div>
          <div class="onboarding-diy-step">
            <div class="onboarding-diy-step__circle">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
            </div>
            <h3 class="onboarding-diy-step__title">Add Your Business Info</h3>
            <p class="onboarding-diy-step__desc">~5 minutes</p>
          </div>
          <div class="onboarding-diy-step__connector" aria-hidden="true"></div>
          <div class="onboarding-diy-step">
            <div class="onboarding-diy-step__circle">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <h3 class="onboarding-diy-step__title">Go Live Instantly</h3>
            <p class="onboarding-diy-step__desc">You&rsquo;re done!</p>
          </div>
        </div>
        <a href="https://wordpress.org/plugins/sitestaffr/" target="_blank" rel="noopener noreferrer" class="btn btn--white onboarding-section__diy-btn">
          Install from WordPress.org
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
        </a>
      </div>
      */ ?>
    </div>
  </div>
</section>

<!-- ========== SECTION 8: PRICING ========== -->
<section class="pricing-section" id="pricing">
  <div class="container">
    <div class="pricing-section__header reveal">
      <span class="section-label">Plans &amp; Pricing</span>
      <h2>Start Free. Upgrade When You&rsquo;re Ready.</h2>
    </div>
    <div class="price-includes price-includes--homepage reveal">
      <div class="price-includes__grid" data-label="Every plan includes">
        <div class="price-includes__item">
          <span class="price-includes__icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>
          </span>
          <span class="price-includes__label">AI voice + text chat</span>
        </div>
        <div class="price-includes__item">
          <span class="price-includes__icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          </span>
          <span class="price-includes__label">Email recap after every conversation</span>
        </div>
        <div class="price-includes__item">
          <span class="price-includes__icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
          </span>
          <span class="price-includes__label">Full conversation transcript</span>
        </div>
        <div class="price-includes__item">
          <span class="price-includes__icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          </span>
          <span class="price-includes__label">Visitor contact info capture</span>
        </div>
        <div class="price-includes__item">
          <span class="price-includes__icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
          </span>
          <span class="price-includes__label">57+ language support</span>
        </div>
        <div class="price-includes__item">
          <span class="price-includes__icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
          </span>
          <span class="price-includes__label">AI learns your website</span>
        </div>
      </div>
    </div>
    <div class="price-grid price-grid--horizontal">
      <div class="price-tier reveal">
        <div class="price-tier__identity">
          <div class="price-tier__name">Free Trial</div>
          <div class="price-tier__price">$0</div>
          <div class="price-tier__period">for 30 days</div>
        </div>
        <div class="price-tier__details">
          <div class="price-tier__minutes">30 minutes included</div>
          <ul class="price-tier__features">
            <li>2 AI voices</li>
            <li>No credit card required</li>
          </ul>
          <p class="price-tier__best-for">Try SiteStaffr free for 30 days</p>
          <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--outline">Start Free Trial</a>
        </div>
      </div>
      <div class="price-tier reveal reveal-delay-1">
        <div class="price-tier__identity">
          <div class="price-tier__name">Starter</div>
          <div class="price-tier__price">$10</div>
          <div class="price-tier__period">per month</div>
        </div>
        <div class="price-tier__details">
          <div class="price-tier__minutes">60 minutes included</div>
          <ul class="price-tier__features">
            <li>2 AI voices</li>
          </ul>
          <p class="price-tier__best-for">Best for businesses getting started</p>
          <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--outline">Get Started</a>
        </div>
      </div>
      <div class="price-tier price-tier--popular reveal reveal-delay-2">
        <div class="price-tier__identity">
          <span class="price-tier__badge">Most Popular</span>
          <div class="price-tier__name">Business</div>
          <div class="price-tier__price">$50</div>
          <div class="price-tier__period">per month</div>
        </div>
        <div class="price-tier__details">
          <div class="price-tier__minutes">300 minutes included</div>
          <ul class="price-tier__features">
            <li>5 AI voices</li>
          </ul>
          <p class="price-tier__best-for">Best for growing local businesses</p>
          <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--primary">Get Started</a>
        </div>
      </div>
      <div class="price-tier reveal reveal-delay-3">
        <div class="price-tier__identity">
          <div class="price-tier__name">Pro</div>
          <div class="price-tier__price">$100</div>
          <div class="price-tier__period">per month</div>
        </div>
        <div class="price-tier__details">
          <div class="price-tier__minutes">700 minutes included</div>
          <ul class="price-tier__features">
            <li>All 10 AI voices</li>
            <li>Custom greeting + 4 tones</li>
            <li>Priority access to new features</li>
          </ul>
          <p class="price-tier__best-for">Best for multi-location or high-traffic sites</p>
          <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--outline">Get Started</a>
        </div>
      </div>
    </div>
    <div class="pricing-addon reveal">
      <h3 class="pricing-addon__title">Run Out of Minutes? You Stay in Control.</h3>
      <p class="pricing-addon__text">Buy add-on packs anytime: <strong>$10 for 50 extra minutes</strong>. They never expire, and there are no automatic overage charges.</p>
    </div>
  </div>
</section>

<!-- ========== SECTION 9: FINAL CTA ========== -->
<section class="final-cta">
  <div class="final-cta__decoration" aria-hidden="true"></div>
  <div class="container">
    <div class="final-cta__content reveal">
      <h2>Your Next Visitor Has a Question.<br><span class="final-cta__highlight">Will Your Website Have the Answer?</span></h2>
      <p class="final-cta__subtitle">Let SiteStaffr take care of your visitors while you focus on running your business.</p>
      <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--white btn--large">
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
