<?php
/*
Template Name: Landing Page
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$landing_title = 'SiteStaffr | AI Voice Receptionist for WordPress';
$landing_description = 'Turn your WordPress site into a 24/7 AI receptionist that answers visitor questions, captures lead details, and sends conversation summaries to your team.';
$landing_keywords = 'AI receptionist, WordPress chatbot, voice assistant, lead capture, phone answering service, website assistant';
$landing_url = get_permalink();
$landing_url = $landing_url ? $landing_url : home_url( '/' );
$landing_image_url = get_stylesheet_directory_uri() . '/assets/images/hero.png';
$site_name = get_bloginfo( 'name' );
$show_testimonials = false;
$beta_signup_url = 'https://forms.gle/AemK46VeXUXqerqU6';
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
    <meta property="og:image:alt" content="SiteStaffr AI receptionist preview">
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
      <ul class="nav__menu" aria-label="Primary">
        <li><a class="nav__link" href="#demo-label">Demo</a></li>
        <li><a class="nav__link" href="#pricing-label">Pricing</a></li>
        <li><a class="nav__link" href="#faq-label">FAQ</a></li>
      </ul>
      <div class="nav__cta">
        <a href="<?php echo esc_url( $beta_signup_url ); ?>" class="btn btn--primary" target="_blank" rel="noopener noreferrer">Join Beta</a>
      </div>
    </div>
  </div>
</nav>

<!-- ========== SECTION 1: HERO ========== -->
<section class="hero">
  <div class="container">
    <div class="hero__grid">
      <div class="hero__content reveal">
        <span class="hero__tagline">AI Voice Receptionist for WordPress</span>
        <h1 class="hero__headline">
          <span class="hero__headline-prefix">Capture More Website Leads</span>
          <span class="hero__headline-focus">With an AI Voice Receptionist</span>
        </h1>
        <p class="hero__subtitle">
          SiteStaffr answers visitor questions instantly, helps capture qualified leads automatically, and works 24/7 on your WordPress site.
        </p>
        <span class="hero__no-cc">Join the beta &bull; Install in minutes &bull; No code required</span>
        <div class="hero__actions">
          <a href="<?php echo esc_url( $beta_signup_url ); ?>" class="btn btn--primary btn--large" target="_blank" rel="noopener noreferrer">
            Join the Beta
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
        </div>
      </div>
      <div class="hero__visual reveal reveal-delay-2">
        <?php
        get_template_part(
            'template-parts/hero-audio-demo',
            null,
            array(
                'layout'       => 'stacked',
                'recap_variant' => 'card',
                'demo_kicker'  => 'Hear the Demo',
                'extra_classes' => 'hero-audio-demo hero-audio-demo--preview',
            )
        );
        ?>
      </div>
    </div>
  </div>
</section>

<!-- ========== SECTION 2: TRUST BAR ========== -->
<section class="trust-bar">
  <div class="container">
    <div class="trust-bar__inner">
      <div class="trust-bar__item">
        <div class="trust-bar__icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <div><span class="trust-bar__stat">Go live in minutes</span></div>
      </div>
      <span class="trust-bar__divider"></span>
      <div class="trust-bar__item">
        <div class="trust-bar__icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
        <div><span class="trust-bar__stat">Natural voice</span> experience for website visitors</div>
      </div>
      <span class="trust-bar__divider"></span>
      <div class="trust-bar__item">
        <div class="trust-bar__icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
        </div>
        <div><span class="trust-bar__stat">57+ languages &bull; English recap for you</span></div>
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
            Join the Beta
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

<!-- ========== SECTION 5: HEAR YOUR AI RECEPTIONIST ========== -->
<section class="demo-section" id="demo">
  <div class="container">
    <span class="section-label reveal" id="demo-label">Hear it for yourself</span>
    <h2 class="reveal">This is what your callers will experience</h2>
    <p class="demo-section__subtitle reveal reveal-delay-1">
      Press play. In 30 seconds, you'll hear how SiteStaffr handles real-world calls.
    </p>
    <?php
    get_template_part(
        'template-parts/hero-audio-demo',
        null,
        array(
            'layout'       => 'split',
            'recap_variant' => 'image',
            'extra_classes' => 'reveal reveal-delay-2',
        )
    );
    ?>
  </div>
</section>

<!-- ========== SECTION 6: WHAT HAPPENS AFTER EVERY CALL ========== -->
<section class="after-section">
  <div class="container">
    <div class="after-section__header reveal">
      <span class="section-label">After every conversation</span>
      <h2>Every call, fully captured</h2>
      <p class="after-section__subtitle">
        Check your phone after a job and know exactly who reached out, what they needed, and what to do next.
      </p>
    </div>
    <div class="dashboard-showcase">
      <div class="dashboard-card reveal">
        <div class="dashboard-card__header">
          <span class="dashboard-card__header-icon">📧</span>
          <span class="dashboard-card__header-title">Email Summary</span>
        </div>
        <div class="email-preview">
          <div class="email-preview__from">
            <div class="email-preview__avatar">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3"/></svg>
            </div>
            <div class="email-preview__meta">
              <div class="email-preview__sender">SiteStaffr Assistant</div>
              <div class="email-preview__subject">New conversation &mdash; Kitchen leak, needs estimate</div>
            </div>
          </div>
          <div class="email-preview__body">
            <p><strong>Sarah Mitchell</strong> called about a kitchen sink leak that's getting worse. She's available tomorrow morning for an estimate.</p>
            <ul>
              <li>Phone: (555) 234-5678</li>
              <li>Issue: Leaking pipe under kitchen sink</li>
              <li>Urgency: Getting worse, not yet an emergency</li>
              <li>Availability: Tomorrow before noon</li>
            </ul>
            <p><strong>Suggested follow-up:</strong> Call back today to schedule a morning visit.</p>
          </div>
        </div>
      </div>
      <div class="dashboard-card reveal reveal-delay-1">
        <div class="dashboard-card__media">
          <img
            src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/business3.jpg' ); ?>"
            alt="SiteStaffr business dashboard preview"
            loading="lazy"
            decoding="async"
          >
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
  <div class="language-section__side-images" aria-hidden="true">
    <img class="language-section__side-image language-section__side-image--left reveal reveal-delay-1" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/language1.png' ); ?>" alt="" loading="lazy" decoding="async">
    <img class="language-section__side-image language-section__side-image--right reveal reveal-delay-2" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/language2.png' ); ?>" alt="" loading="lazy" decoding="async">
  </div>
  <div class="container">
    <div class="language-section__inner reveal">
      <span class="section-label">Every language, one inbox</span>
      <h2>Your receptionist speaks <span class="language-heading__phrase"><em>their</em> language</span></h2>
      <p class="language-section__desc">
        A customer visits your site and starts speaking Spanish. Or Mandarin. Or Portuguese. SiteStaffr understands them, responds naturally in their language, and delivers the full conversation summary to you &mdash; translated to English.
      </p>
      <div class="language-section__cards">
        <div class="language-card reveal reveal-delay-1">
          <span class="language-card__icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
          </span>
          <div class="language-card__title">Converses naturally</div>
          <p class="language-card__text">Your AI receptionist detects the visitor's language and responds fluently &mdash; no awkward translations or language menus.</p>
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

<!-- ========== SECTION 6: HOW IT WORKS ========== -->
<section class="how-section">
  <div class="container">
    <div class="container--narrow reveal">
      <span class="section-label">Setup in minutes, not days</span>
      <h2>Three steps to stop missing calls</h2>
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
        <h3>Tell it about your business</h3>
        <p class="step__desc">Enter your business name, services, hours, and common questions. The AI learns what your customers need to know.</p>
        <span class="step__time">~ 5 minutes</span>
      </div>
      <div class="step reveal reveal-delay-2">
        <div class="step__badge">3</div>
        <div class="step__number">
          <span class="step__number-icon">✨</span>
        </div>
        <h3>Go live</h3>
        <p class="step__desc">Place the voice button or widget on any page. Visitors click, talk, and you get a detailed summary of every conversation.</p>
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
    <p class="pricing-section__compare reveal">Traditional answering services can cost <strong>hundreds per month</strong>. SiteStaffr starts at <strong>$10</strong>.</p>
    <div class="pricing-grid">
      <div class="pricing-card reveal">
        <div class="pricing-card__name">Free Trial</div>
        <div class="pricing-card__price">$0</div>
        <div class="pricing-card__price-sub">for 30 days</div>
        <div class="pricing-card__divider"></div>
        <ul class="pricing-card__features">
          <li>30 minutes included</li>
          <li>2 AI voice options</li>
          <li>57+ languages</li>
          <li>Email summaries after every call</li>
        </ul>
        <a href="<?php echo esc_url( $beta_signup_url ); ?>" class="btn btn--outline" target="_blank" rel="noopener noreferrer">Join Beta</a>
      </div>
      <div class="pricing-card reveal reveal-delay-1">
        <div class="pricing-card__name">Starter</div>
        <div class="pricing-card__price">$10</div>
        <div class="pricing-card__price-sub">per month</div>
        <div class="pricing-card__divider"></div>
        <ul class="pricing-card__features">
          <li>60 minutes included</li>
          <li>2 AI voice options</li>
          <li>57+ languages</li>
          <li>Email summaries after every call</li>
        </ul>
        <a href="<?php echo esc_url( $beta_signup_url ); ?>" class="btn btn--outline" target="_blank" rel="noopener noreferrer">Join Beta</a>
      </div>
      <div class="pricing-card pricing-card--popular reveal reveal-delay-2">
        <div class="pricing-card__badge">Most Popular</div>
        <div class="pricing-card__name">Business</div>
        <div class="pricing-card__price">$50</div>
        <div class="pricing-card__price-sub">per month</div>
        <div class="pricing-card__divider"></div>
        <ul class="pricing-card__features">
          <li>300 minutes included</li>
          <li>5 AI voice options</li>
          <li>Custom greeting message</li>
          <li>57+ languages</li>
        </ul>
        <a href="<?php echo esc_url( $beta_signup_url ); ?>" class="btn btn--primary" target="_blank" rel="noopener noreferrer">Join Beta</a>
      </div>
      <div class="pricing-card reveal reveal-delay-3">
        <div class="pricing-card__name">Pro</div>
        <div class="pricing-card__price">$100</div>
        <div class="pricing-card__price-sub">per month</div>
        <div class="pricing-card__divider"></div>
        <ul class="pricing-card__features">
          <li>700 minutes included</li>
          <li>All 10 AI voices</li>
          <li>Custom greeting message</li>
          <li>57+ languages</li>
        </ul>
        <a href="<?php echo esc_url( $beta_signup_url ); ?>" class="btn btn--outline" target="_blank" rel="noopener noreferrer">Join Beta</a>
      </div>
    </div>
    <p class="pricing-addon reveal">
      Need more minutes? <strong>$10 for 50 extra minutes</strong> &mdash; buy anytime, they never expire.
    </p>
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
            Yes. SiteStaffr uses advanced AI voice technology designed to produce natural, conversational speech. The best way to evaluate it is to <a href="#demo-label" style="color: var(--teal-deep); text-decoration: underline;">listen to a sample conversation</a> above.
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
            Yes, the voice widget works on desktop, tablet, and modern mobile devices. Your website visitors can talk to your AI receptionist from wherever they are.
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
      Stay focused on the work in front of you while SiteStaffr handles your website conversations 24/7.
    </p>
    <a href="<?php echo esc_url( $beta_signup_url ); ?>" class="btn btn--white btn--large" target="_blank" rel="noopener noreferrer">
      Sign Up for Beta
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
    </a>
    <p class="final-cta__note">Pre-launch beta &middot; Early access onboarding</p>
  </div>
</section>

<!-- ========== FOOTER ========== -->
<footer class="footer">
  <div class="container">
    <div class="footer__links">
      <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a>
      <a href="<?php echo esc_url( home_url( '/terms-of-service/' ) ); ?>">Terms of Service</a>
      <a href="mailto:support@sitestaffr.com">Support</a>
    </div>
    <p>&copy; 2026 SiteStaffr. All rights reserved.</p>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
