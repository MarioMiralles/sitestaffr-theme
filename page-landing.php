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
$get_started_url = home_url( '/get-started/' );
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
        array( 'label' => 'Features', 'href' => home_url( '/features/' ) ),
        array( 'label' => 'Pricing', 'href' => home_url( '/pricing/' ) ),
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

<!-- ========== SECTION 3: VOICE & TEXT, TWO WAYS TO CONNECT ========== -->
<section class="voice-text-section">
  <div class="container">
    <div class="voice-text-section__header reveal">
      <span class="section-label">Two ways to connect</span>
      <h2>Your visitors choose how they talk to you</h2>
    </div>
    <div class="voice-text-section__grid">
      <div class="voice-text-section__item reveal">
        <div class="voice-text-section__screenshot">
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/hero.png' ); ?>" alt="<?php echo esc_attr( 'SiteStaffr voice widget on a website' ); ?>" loading="lazy" decoding="async">
        </div>
        <p class="voice-text-section__caption">Talk naturally with an AI voice agent</p>
      </div>
      <div class="voice-text-section__divider reveal reveal-delay-1" aria-hidden="true">
        <span class="voice-text-section__or">or</span>
      </div>
      <div class="voice-text-section__item reveal reveal-delay-2">
        <div class="voice-text-section__screenshot">
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/features-conversation.png' ); ?>" alt="<?php echo esc_attr( 'SiteStaffr text chat widget on a website' ); ?>" loading="lazy" decoding="async">
        </div>
        <p class="voice-text-section__caption">Or type &mdash; same AI, same answers</p>
      </div>
    </div>
  </div>
</section>

<!-- ========== SECTION 4: WHAT YOU GET ========== -->
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
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/after-conversation-email-recap.png' ); ?>" alt="Screenshot of an email recap from SiteStaffr" loading="lazy" decoding="async">
        </div>
        <div class="what-you-get__card-body">
          <h3>Email Recap</h3>
          <p>A summary hits your inbox the moment the conversation ends &mdash; who they are, what they need, and what to do next.</p>
        </div>
      </div>
      <div class="what-you-get__card what-you-get__card--transcript reveal reveal-delay-1">
        <div class="what-you-get__card-image">
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/after-conversation-transcript.png' ); ?>" alt="Screenshot of a full conversation transcript" loading="lazy" decoding="async">
        </div>
        <div class="what-you-get__card-body">
          <h3>Full Transcript</h3>
          <p>Every word, turn by turn. Review exactly what was said so nothing gets lost.</p>
        </div>
      </div>
      <div class="what-you-get__card what-you-get__card--followup reveal reveal-delay-2">
        <div class="what-you-get__card-image">
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/after-conversation-followup.png' ); ?>" alt="Screenshot of suggested follow-up actions" loading="lazy" decoding="async">
        </div>
        <div class="what-you-get__card-body">
          <h3>Suggested Follow-Up</h3>
          <p>SiteStaffr recommends your next step based on what the visitor asked for.</p>
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

<!-- ========== SECTION 6: VOICE SHOWCASE ========== -->
<section class="voice-section">
  <div class="container">
    <div class="voice-section__header reveal">
      <span class="section-label">AI voices</span>
      <h2>Choose the voice that represents your business</h2>
    </div>
    <?php
    get_template_part( 'template-parts/voice-showcase', null, array(
        'id'          => 'voiceShowcase',
        'show_header' => false,
    ) );
    ?>
  </div>
</section>

<!-- ========== SECTION 7: GET STARTED, TWO PATHS ========== -->
<section class="getstarted-section">
  <div class="container">
    <div class="getstarted-section__header reveal">
      <span class="section-label">Get started</span>
      <h2>Get started your way</h2>
    </div>
    <div class="getstarted-section__grid">
      <div class="getstarted-card getstarted-card--diy reveal">
        <h3 class="getstarted-card__title">Set it up yourself</h3>
        <p class="getstarted-card__subtitle">Less than 10 minutes</p>
        <ol class="getstarted-card__steps">
          <li>Install the plugin</li>
          <li>Add your business info</li>
          <li>Go live</li>
        </ol>
        <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--outline">Install Plugin</a>
      </div>
      <div class="getstarted-card getstarted-card--onboarding reveal reveal-delay-1">
        <div class="getstarted-card__badge">Recommended</div>
        <h3 class="getstarted-card__title">Let us help you get started</h3>
        <p class="getstarted-card__subtitle">Talk to our onboarding agent</p>
        <p class="getstarted-card__desc">
          Click the chat button in the corner to talk to our onboarding agent. It&rsquo;ll walk you through everything.
        </p>
        <p class="getstarted-card__fallback">
          Or <a href="<?php echo esc_url( $get_started_url ); ?>">fill out a quick form</a> and we&rsquo;ll set it up for you.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- ========== SECTION 8: PRICING TEASER ========== -->
<section class="pricing-teaser">
  <div class="container">
    <div class="pricing-teaser__header reveal">
      <span class="section-label">Pricing</span>
      <h2>Simple, transparent pricing</h2>
    </div>
    <div class="pricing-teaser__grid reveal reveal-delay-1">
      <div class="pricing-teaser__card">
        <div class="pricing-teaser__plan">Free Trial</div>
        <div class="pricing-teaser__price">$0</div>
        <div class="pricing-teaser__term">for 30 days</div>
        <div class="pricing-teaser__minutes">30 min</div>
        <div class="pricing-teaser__best-for">Try it free</div>
      </div>
      <div class="pricing-teaser__card">
        <div class="pricing-teaser__plan">Starter</div>
        <div class="pricing-teaser__price">$10</div>
        <div class="pricing-teaser__term">/mo</div>
        <div class="pricing-teaser__minutes">60 min</div>
        <div class="pricing-teaser__best-for">Getting started</div>
      </div>
      <div class="pricing-teaser__card pricing-teaser__card--popular">
        <div class="pricing-teaser__popular-tag">Most popular</div>
        <div class="pricing-teaser__plan">Business</div>
        <div class="pricing-teaser__price">$50</div>
        <div class="pricing-teaser__term">/mo</div>
        <div class="pricing-teaser__minutes">300 min</div>
        <div class="pricing-teaser__best-for">Growing businesses</div>
      </div>
      <div class="pricing-teaser__card">
        <div class="pricing-teaser__plan">Pro</div>
        <div class="pricing-teaser__price">$100</div>
        <div class="pricing-teaser__term">/mo</div>
        <div class="pricing-teaser__minutes">700 min</div>
        <div class="pricing-teaser__best-for">High-traffic sites</div>
      </div>
    </div>
    <div class="pricing-teaser__footer reveal reveal-delay-2">
      <a href="<?php echo esc_url( home_url( '/pricing/' ) ); ?>" class="pricing-teaser__link">
        See all plans
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
    </div>
  </div>
</section>

<!-- ========== SECTION 9: FINAL CTA ========== -->
<section class="final-cta">
  <div class="final-cta__decoration" aria-hidden="true"></div>
  <div class="container">
    <div class="final-cta__content reveal">
      <h2>Your next visitor has a question. Will your website have an answer?</h2>
      <p class="final-cta__subtitle">Let SiteStaffr take care of your visitors while you focus on running your business.</p>
      <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--white btn--large">
        Get Started
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
    </div>
  </div>
</section>

<?php get_template_part( 'template-parts/site-footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
