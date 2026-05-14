<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$page_title       = 'Features | SiteStaffr — AI Voice & Text Chat for WordPress';
$page_description = 'Explore SiteStaffr\'s features: AI voice agent, text chat widget, email recaps, full transcripts, 57+ languages, and more.';
$page_url         = home_url( '/features/' );
$site_name        = get_bloginfo( 'name' );
$get_started_url  = home_url( '/#get-started' );
$pricing_url      = home_url( '/pricing/' );
$body_classes     = array( 'wp-theme-sitestaffr-website', 'sitestaffr-features-page' );
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
get_template_part( 'template-parts/site-nav' );
?>

<main class="features-page">

  <!-- Section 1: Features Hero -->
  <section class="feat-hero">
    <div class="feat-hero__pattern" aria-hidden="true"></div>
    <div class="container">
      <div class="feat-hero__content reveal">
        <h1>Everything Your Website Needs to Help Visitors and Capture Leads.</h1>
        <p class="feat-hero__subtitle">Voice conversations, text chat, email recaps, full transcripts, and 57+ languages &mdash; all inside WordPress.</p>
      </div>
    </div>
  </section>

  <!-- Section 2: Voice Conversations -->
  <section class="feat-section feat-section--voice">
    <div class="container">
      <div class="feat-section__header reveal">
        <span class="section-label">Voice conversations</span>
        <h2>A Natural-Sounding AI Voice That Represents Your Business</h2>
      </div>
      <?php
      get_template_part( 'template-parts/voice-showcase', null, array(
          'id'          => 'voiceShowcase',
          'show_header' => false,
      ) );
      ?>
    </div>
  </section>

  <!-- Section 3: Text Chat -->
  <section class="feat-section">
    <div class="container">
      <div class="feat-section__split reveal">
        <div class="feat-section__text">
          <span class="section-label">Text chat</span>
          <h2>For Visitors Who Prefer Typing</h2>
          <ul class="feat-check-list">
            <li>Real-time AI responses</li>
            <li>Same AI knowledge as voice</li>
            <li>Widget customization (colors, position)</li>
            <li>Mobile-friendly</li>
          </ul>
        </div>
        <div class="feat-section__media">
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/features-conversation.webp' ); ?>" alt="Text chat conversation showing real-time AI responses" loading="lazy" decoding="async">
        </div>
      </div>
    </div>
  </section>

  <!-- Section 4: AI Knowledge -->
  <section class="feat-section feat-section--alt">
    <div class="container">
      <div class="feat-section__split feat-section__split--reverse reveal">
        <div class="feat-section__text">
          <span class="section-label">AI knowledge</span>
          <h2>Your Business Info Powers Every Answer</h2>
          <div class="feat-subfeatures">
            <div class="feat-subfeature">
              <h3 class="feat-subfeature__title">Search Mode</h3>
              <p class="feat-subfeature__desc">Your AI searches your website in real-time to find answers for visitors.</p>
            </div>
            <div class="feat-subfeature">
              <h3 class="feat-subfeature__title">Page Expert Mode</h3>
              <p class="feat-subfeature__desc">Train your AI on specific pages for deep, detailed responses about your products or services.</p>
            </div>
          </div>
        </div>
        <div class="feat-section__media">
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/features-description.webp' ); ?>" alt="AI knowledge settings showing Search Mode and Page Expert Mode" loading="lazy" decoding="async">
        </div>
      </div>
    </div>
  </section>

  <!-- Section 5: Recaps, Transcripts & Follow-Up -->
  <section class="feat-section">
    <div class="container">
      <div class="feat-section__header reveal">
        <span class="section-label">Recaps, transcripts &amp; follow-up</span>
        <h2>Never Miss a Lead, Even When You&rsquo;re Away</h2>
      </div>
      <div class="feat-cards-row reveal reveal-delay-1">
        <div class="feat-card">
          <div class="feat-card__image">
            <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/after-conversation-email-recap.webp' ); ?>" alt="Email recap showing visitor details and action items" loading="lazy" decoding="async">
          </div>
          <h3>Email Recap</h3>
          <p>A summary hits your inbox the moment the conversation ends &mdash; who they are, what they need, and what to do next.</p>
        </div>
        <div class="feat-card">
          <div class="feat-card__image">
            <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/after-conversation-transcript.webp' ); ?>" alt="Full conversation transcript with turn-by-turn detail" loading="lazy" decoding="async">
          </div>
          <h3>Full Transcript</h3>
          <p>Every word, turn by turn. Review exactly what was said so nothing gets lost.</p>
        </div>
        <div class="feat-card">
          <div class="feat-card__image">
            <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/after-conversation-followup.webp' ); ?>" alt="Suggested follow-up actions based on the conversation" loading="lazy" decoding="async">
          </div>
          <h3>Suggested Follow-Up</h3>
          <p>SiteStaffr recommends your next step based on what the visitor asked for.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Section 6: 57+ Languages -->
  <section class="feat-section feat-section--languages">
    <div class="feat-languages__accent" aria-hidden="true"></div>
    <div class="container">
      <div class="feat-section__centered reveal">
        <span class="section-label">57+ languages</span>
        <h2>Serve Every Visitor, in Their Language</h2>
        <p class="feat-section__subtitle">SiteStaffr detects your visitor&rsquo;s language automatically and responds naturally &mdash; no menus, no awkward translations. Your recap arrives in English with every detail captured.</p>
      </div>
    </div>
  </section>

  <!-- Section 7: Billing & Usage -->
  <section class="feat-section">
    <div class="container">
      <div class="feat-section__split reveal">
        <div class="feat-section__text">
          <span class="section-label">Billing &amp; usage</span>
          <h2>Track Your Usage. Stay in Control.</h2>
          <ul class="feat-check-list">
            <li>See your minutes used and remaining at a glance</li>
            <li>Review every conversation from your WordPress dashboard</li>
            <li>Buy add-on minutes anytime &mdash; they never expire</li>
          </ul>
        </div>
        <div class="feat-section__media">
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/features-dashboard.webp' ); ?>" alt="WordPress dashboard showing usage tracking and billing" loading="lazy" decoding="async">
        </div>
      </div>
    </div>
  </section>

  <!-- Section 8: FAQ -->
  <section class="feat-faq">
    <div class="container">
      <div class="feat-faq__header reveal">
        <h2>Frequently Asked Questions</h2>
      </div>
      <div class="faq-list">
        <div class="faq-item reveal">
          <button class="faq-item__question">
            <?php echo esc_html( 'How does the AI know about my business?' ); ?>
            <span class="faq-item__icon">+</span>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-inner">
              <?php echo esc_html( 'You provide your business name, services, hours, and a description during setup. SiteStaffr can also scan your website to generate this for you. The AI uses this information to answer questions accurately.' ); ?>
            </div>
          </div>
        </div>
        <div class="faq-item reveal reveal-delay-1">
          <button class="faq-item__question">
            <?php echo esc_html( 'Can I customize the widget appearance?' ); ?>
            <span class="faq-item__icon">+</span>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-inner">
              <?php echo esc_html( 'Yes. You control colors, icon style, size, position, and border radius for both the floating widget and inline button from your WordPress dashboard.' ); ?>
            </div>
          </div>
        </div>
        <div class="faq-item reveal reveal-delay-1">
          <button class="faq-item__question">
            <?php echo esc_html( 'Does it work on mobile?' ); ?>
            <span class="faq-item__icon">+</span>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-inner">
              <?php echo esc_html( 'Yes. SiteStaffr runs in the visitor\'s browser, so it works on desktop, tablet, and mobile. The text chat widget works everywhere; voice requires microphone access.' ); ?>
            </div>
          </div>
        </div>
        <div class="faq-item reveal reveal-delay-2">
          <button class="faq-item__question">
            <?php echo esc_html( 'What happens if the AI can\'t answer a question?' ); ?>
            <span class="faq-item__icon">+</span>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-inner">
              <?php echo esc_html( 'It handles it gracefully — like a good receptionist. It says something like "I\'m not sure about that, but let me take your details and have someone get back to you." No making things up.' ); ?>
            </div>
          </div>
        </div>
        <div class="faq-item reveal reveal-delay-2">
          <button class="faq-item__question">
            <?php echo esc_html( 'Can I use both voice and text chat?' ); ?>
            <span class="faq-item__icon">+</span>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-inner">
              <?php echo esc_html( 'Yes. Both are included in every plan. Visitors choose how they want to communicate — some prefer talking, others prefer typing.' ); ?>
            </div>
          </div>
        </div>
        <div class="faq-item reveal reveal-delay-3">
          <button class="faq-item__question">
            <?php echo esc_html( 'How do I update my business information?' ); ?>
            <span class="faq-item__icon">+</span>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-inner">
              <?php echo esc_html( 'From the SiteStaffr settings page in your WordPress dashboard. Changes take effect on the next conversation — no restart needed.' ); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Section 9: Final CTA -->
  <section class="feat-cta">
    <div class="feat-cta__pattern" aria-hidden="true"></div>
    <div class="container">
      <div class="feat-cta__content reveal">
        <h2>Ready to See It in Action?</h2>
        <div class="feat-cta__buttons">
          <a href="<?php echo esc_url( home_url( '/pricing/' ) ); ?>" class="btn btn--outline btn--large">See Pricing</a>
          <a href="<?php echo esc_url( home_url( '/#get-started' ) ); ?>" class="btn btn--primary btn--large">Get Started</a>
        </div>
      </div>
    </div>
  </section>

</main>

<?php get_template_part( 'template-parts/site-footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
