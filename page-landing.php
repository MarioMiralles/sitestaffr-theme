<?php
/*
Template Name: Landing Page
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$get_started_url = home_url( '/#get-started' );
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preload" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/fonts/fraunces-variable.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/fonts/dm-sans-variable.woff2" as="font" type="font/woff2" crossorigin>

    <?php
    $schema_org_url  = home_url( '/' );
    $schema_logo_url = get_stylesheet_directory_uri() . '/assets/images/logo.webp';
    ?>
    <script type="application/ld+json">
    <?php echo wp_json_encode( array(
        '@context'        => 'https://schema.org',
        '@type'           => 'Organization',
        '@id'             => $schema_org_url . '#organization',
        'name'            => 'SiteStaffr',
        'legalName'       => 'PhoneEase LLC',
        'url'             => $schema_org_url,
        // Says what this entity IS, in the entity graph rather than only in prose.
        // Without it the only structured signal distinguishing us from the live-chat
        // staffing firm below is the name itself, which is the thing being confused.
        'description'     => 'SiteStaffr makes an AI chat and voice agent for service businesses on WordPress. It answers website visitors, captures their contact details, and emails the business a recap of every conversation.',
        'logo'            => array(
            '@type' => 'ImageObject',
            'url'   => $schema_logo_url,
        ),
        'email'           => 'support@sitestaffr.com',
        'contactPoint'    => array(
            '@type'       => 'ContactPoint',
            'email'       => 'support@sitestaffr.com',
            'contactType' => 'customer support',
        ),
        'founder'          => array(
            '@type'    => 'Person',
            'name'     => 'Mario Miralles',
            'url'      => home_url( '/about/' ),
        ),
        // Entity disambiguation. Searching "SiteStaffr" currently returns this site 9th of 10 —
        // the rest belong to "SiteStaff"/"SiteStaff Chat" (ssc.ai, sitestaff.net), an unrelated
        // live-chat staffing firm. sameAs is how Google is told which third-party profiles are
        // THIS entity. Only add URLs verified to resolve; a dead sameAs is worse than none.
        //
        // "Verified" means verified BY CONTENT, not by status code — Facebook returns 200 with a
        // generic "Facebook" title for a handle that does not exist. But resolving is only half
        // the bar: the profile also has to SAY something about the entity. An empty profile
        // corroborates nothing and just spends crawl trust on a dead end.
        //
        // Removed 2026-08-12 after checking what each page actually contains:
        //   github.com/sitestaffr   — resolves, but "This organization has no public
        //                             repositories". An empty shell; the org is private.
        //   youtube.com/@sitestaffr — no channel content.
        //
        // Facebook is KEPT despite having almost no posts. Post count is irrelevant here: it is
        // an indexed business page carrying a name and a location (Miami FL), which is exactly
        // the corroborating name/place data this list exists to provide. Engagement is a
        // marketing question, not an entity-graph one.
        //
        // G2, Capterra and TikTok were supplied by Mario from his own browser, 2026-08-12. That
        // is the only workable verification for these three: G2 and Capterra return 403 to every
        // request whether the URL exists or not, and TikTok returns 200 with the same generic
        // "TikTok - Make Your Day" title for a real handle and a bogus one alike. In all three
        // cases the status code carries no information, so a human look is the bar.
        //
        // Facebook answers DIFFERENTLY DEPENDING ON USER-AGENT — a full Chrome UA gets 400
        // "Error" for the same URL that returns 200 "SiteStaffr | Miami FL" under a plain
        // "Mozilla/5.0". Do not conclude this one is dead without retrying with a simpler agent.
        //
        // x.com / twitter.com: no account exists yet (Mario, 2026-08-12). Do not add a URL here
        // until one does — a dead sameAs is worse than none.
        'sameAs'           => array(
            // Software directories first: Google treats these as authoritative for software
            // entities, which is exactly the signal the SiteStaff name collision needs.
            'https://www.g2.com/products/sitestaffr/reviews',
            'https://www.capterra.com/p/10046030/SiteStaffr/',
            'https://wordpress.org/plugins/sitestaffr/',
            'https://profiles.wordpress.org/sitestaffr/',
            // Social.
            'https://linkedin.com/company/sitestaffr',
            'https://www.facebook.com/sitestaffr',
            'https://www.tiktok.com/@sitestaffr',
        ),
        'foundingLocation' => array(
            '@type'   => 'Place',
            'address' => array(
                '@type'          => 'PostalAddress',
                'addressRegion'  => 'FL',
                'addressCountry' => 'US',
            ),
        ),
    ), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
    </script>

    <script type="application/ld+json">
    <?php echo wp_json_encode( array(
        '@context'            => 'https://schema.org',
        '@type'               => 'SoftwareApplication',
        '@id'                 => $schema_org_url . '#software',
        'name'                => 'SiteStaffr',
        'description'         => 'An AI chat and voice agent built for service businesses on WordPress. Visitors type or talk, it listens, and you get every detail in 57+ languages. It also writes and publishes SEO blog posts for your site every month.',
        'applicationCategory' => 'BusinessApplication',
        'operatingSystem'     => 'WordPress',
        'url'                 => $schema_org_url,
        'publisher'           => array( '@id' => $schema_org_url . '#organization' ),
        'aggregateRating'     => array(
            '@type'       => 'AggregateRating',
            'ratingValue' => '5',
            'reviewCount' => '1',
            'bestRating'  => '5',
            'worstRating' => '1',
        ),
        'offers'              => array(
            array(
                '@type'         => 'Offer',
                'name'          => 'Free Trial',
                'price'         => '0',
                'priceCurrency' => 'USD',
                'description'   => '30-day free trial with 30 voice minutes included, 2 AI voices, 1 AI blog post, no credit card required',
            ),
            array(
                '@type'         => 'Offer',
                'name'          => 'Starter',
                'price'         => '29.00',
                'priceCurrency' => 'USD',
                'description'   => 'Unlimited AI text chat, 100 voice minutes per month, 2 AI voices, 2 AI blog posts per month',
            ),
            array(
                '@type'         => 'Offer',
                'name'          => 'Business',
                'price'         => '69.00',
                'priceCurrency' => 'USD',
                'description'   => 'Unlimited AI text chat, 300 voice minutes per month, 5 AI voices, 4 AI blog posts per month with Autopilot publishing',
            ),
            array(
                '@type'         => 'Offer',
                'name'          => 'Pro',
                'price'         => '129.00',
                'priceCurrency' => 'USD',
                'description'   => 'Unlimited AI text chat, 600 voice minutes per month, all 10 AI voices, 8 AI blog posts per month with Autopilot publishing, custom greeting and 4 tones',
            ),
        ),
    ), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
    </script>

    <script type="application/ld+json">
    <?php echo wp_json_encode( array(
        '@context'     => 'https://schema.org',
        '@type'        => 'Review',
        'itemReviewed' => array( '@id' => $schema_org_url . '#software' ),
        'reviewRating' => array(
            '@type'       => 'Rating',
            'ratingValue' => '5',
            'bestRating'  => '5',
        ),
        'author'       => array(
            '@type'    => 'Person',
            'name'     => 'Nathaly Martinez',
            'jobTitle' => 'CEO & Founder',
        ),
        'publisher'    => array(
            '@type' => 'Organization',
            'name'  => 'Synergy Scribes',
            'url'   => 'https://synergyscribes.com',
        ),
        'reviewBody'   => 'We staff medical scribes across multiple clinics, and after hours is when most new facility inquiries come in. SiteStaffr captured a full intake request at 9 PM on a Sunday, with the clinic name, number of scribes needed, and start date. Monday morning it was sitting in our inbox, ready to go.',
    ), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
    </script>

    <?php
    $faq_items = array(
        array(
            'question' => 'What is SiteStaffr?',
            'answer'   => 'SiteStaffr is an AI voice and text agent built as a WordPress plugin for service businesses. It installs in under five minutes and appears as a chat widget on your website. When a visitor arrives, SiteStaffr greets them, answers their questions using your website content, and captures their name, their email or phone, and what they need, all through natural conversation in over 57 languages. It also writes SEO blog posts for your site every month, grounded in your business and services. After every interaction, you receive an email recap with a full transcript, the visitor\'s contact information, and a suggested follow-up action. SiteStaffr works 24/7 so you never miss a lead while you\'re on a job site, in a consultation, or after hours. Plans start at $29 per month after a free 30-day trial with no credit card required.',
        ),
        array(
            'question' => 'How does SiteStaffr capture leads from my website?',
            'answer'   => 'When a visitor starts a conversation through voice or text chat, SiteStaffr naturally collects their name, their email or phone, and reason for reaching out. After the conversation ends, you receive an email with a complete recap, the visitor\'s contact details, a full transcript, and suggested follow-up actions.',
        ),
        array(
            'question' => 'What languages does SiteStaffr support?',
            'answer'   => 'SiteStaffr supports over 57 languages, including Spanish, Mandarin, French, Portuguese, Arabic, Hindi, Japanese, and Korean. Visitors can converse in their preferred language, and every recap is delivered to you in English regardless of the conversation language.',
        ),
        array(
            'question' => 'How much does SiteStaffr cost?',
            'answer'   => 'SiteStaffr starts with a free 30-day trial including 30 minutes of voice time and unlimited AI text chat, with no credit card required. Paid plans are $29/month (Starter: 100 voice minutes), $69/month (Business: 300 voice minutes), and $129/month (Pro: 600 voice minutes). Every plan includes unlimited AI text chat with no per-conversation fees, so only voice is metered. Every plan also includes AI-written blog posts each month, from 1 post on the trial up to 8 per month on Pro. You can buy additional voice minutes anytime at $20 for 60 minutes, and they never expire.',
        ),
        array(
            'question' => 'Does SiteStaffr work with my WordPress site?',
            'answer'   => 'Yes. SiteStaffr is built specifically for WordPress. Install the plugin from your WordPress dashboard, configure your business details, and the AI agent appears on your website. No coding required, and setup takes less than five minutes.',
        ),
        array(
            'question' => 'What happens after a visitor conversation?',
            'answer'   => 'Within seconds of the conversation ending, SiteStaffr emails you a detailed recap including a summary of what the visitor needed, their contact information, the full conversation transcript, and a suggested follow-up action, so you can respond quickly and close more leads.',
        ),
        array(
            'question' => 'Does SiteStaffr write blog posts for my website?',
            'answer'   => 'Yes. Every plan includes the Blog Agent, which suggests topics, writes SEO-optimized posts grounded in your business and services, generates a featured image, and saves each post as a draft in WordPress for your review. Plans include 1 to 8 posts per month depending on your tier, and on Business and Pro plans, Autopilot can write and publish posts automatically on a schedule you control.',
        ),
        array(
            'question' => 'Does SiteStaffr connect to my CRM?',
            'answer'   => 'Yes. SiteStaffr has a native Salesforce integration on every plan. When a conversation turns into a real lead, meaning the visitor gave a name plus a phone number or email, SiteStaffr creates the Lead in your Salesforce automatically with their contact details, what they were interested in, a recap of the conversation, and a link to the full transcript. You connect with your normal Salesforce login in about a minute, with no API keys and no developer setup. Using a different CRM? Tell us which one, because what gets built next is driven by what customers ask for.',
        ),
        array(
            'question' => 'Is there a free trial?',
            'answer'   => 'Yes. SiteStaffr offers a free 30-day trial with 30 minutes of conversation time included. No credit card is required to start, and you can upgrade to a paid plan anytime.',
        ),
        array(
            'question' => 'Do I need a developer to install SiteStaffr?',
            'answer'   => 'No. SiteStaffr installs like any WordPress plugin. Search for it in your dashboard, click install, activate, and enter your business details. The entire setup takes less than five minutes and requires no technical knowledge.',
        ),
    );

    $faq_schema_entries = array();
    foreach ( $faq_items as $faq ) {
        $faq_schema_entries[] = array(
            '@type'          => 'Question',
            'name'           => $faq['question'],
            'acceptedAnswer' => array(
                '@type' => 'Answer',
                'text'  => $faq['answer'],
            ),
        );
    }
    ?>
    <script type="application/ld+json">
    <?php echo wp_json_encode( array(
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => $faq_schema_entries,
    ), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
    </script>

    <script type="application/ld+json">
    <?php echo wp_json_encode( array(
        '@context'      => 'https://schema.org',
        '@type'         => 'AudioObject',
        'name'          => 'SiteStaffr Demo Conversation for a Plumbing Business',
        'description'   => 'A 45-second sample conversation between a website visitor reporting a kitchen leak and SiteStaffr\'s AI voice agent for a plumbing business.',
        'contentUrl'    => get_stylesheet_directory_uri() . '/assets/audio/demo-conversation.mp3',
        'encodingFormat' => 'audio/mpeg',
        'duration'      => 'PT70S',
        'inLanguage'    => 'en',
        'transcript'    => 'Visitor: Hi, I have a kitchen leak under the sink. It started about an hour ago and I put a bucket under it but it\'s still dripping pretty fast. Agent: I\'m sorry to hear about the leak. Let me help you get that taken care of. Can I get your name and a good phone number to reach you? Visitor: Sure, it\'s Mike Reynolds, 555-0147. Agent: Thanks Mike. And what\'s the address where the leak is? Visitor: 742 Oak Street. Agent: Got it. I\'ll make sure the team knows about the urgency. Someone will follow up with you shortly to schedule a visit. Is there anything else I can help with? Visitor: No, that\'s it. Thank you. Agent: You\'re welcome, Mike. Hang tight and we\'ll get this resolved for you.',
        'isPartOf'      => array( '@id' => $schema_org_url . '#software' ),
    ), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
    </script>

    <?php wp_head(); ?>
</head>
<body <?php body_class( 'sitestaffr-landing-page' ); ?>>
<?php wp_body_open(); ?>

<!-- ========== NAVIGATION ========== -->
<?php
get_template_part( 'template-parts/site-nav', null, array(
    'secondary' => array(
        array( 'label' => 'Voices', 'href' => '#voices' ),
        array( 'label' => 'Pricing', 'href' => '#pricing' ),
    ),
) );
?>

<main>
<!-- ========== SECTION 1: HERO ========== -->
<section class="hero">
  <canvas id="hero-soundwave" class="hero__canvas" aria-hidden="true"></canvas>
  <div class="container">
    <div class="hero__grid">
      <div class="hero__content">
        <span class="hero__tagline">Built for WordPress</span>
        <h1 class="hero__headline">
          <span class="hero__headline-prefix">Your Website Talks to Every Visitor.</span>
          <span class="hero__headline-focus">You Get the Lead.</span>
        </h1>
        <p class="hero__subtitle">
          Visitors can type or speak to your website, day or night. SiteStaffr answers their questions, then emails you their name, their email or phone, and what they need.
        </p>
        <span class="hero__no-cc">Free for 30 days &bull; Install in minutes &bull; No code required</span>
        <!-- Primary = self-serve trial, secondary = white-glove (Mario, 2026-08-11).
             These two were previously reversed: the big button went to the onboarding
             form and the actual trial was a small text link. Same two elements, same
             layout, swapped roles. NOTE: .hero__download-link is now a style hook only
             — it no longer points at /download/. Rename when the CSS is next touched. -->
        <div class="hero__actions">
          <a href="<?php echo esc_url( home_url( '/download/' ) ); ?>" class="btn btn--primary btn--large">
            Start Free Trial
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
          <a href="<?php echo esc_url( $get_started_url ); ?>" class="hero__download-link">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            Prefer we set it up for you?
          </a>
        </div>
      </div>
      <div class="hero__robot-stage">
        <div class="hero__robot-glow" aria-hidden="true"></div>
        <img class="hero__robot-img"
             src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/hero-robot-v2.webp' ) ); ?>"
             alt="SiteStaffr, the AI assistant for WordPress websites"
             width="1080" height="1350" fetchpriority="high" decoding="async">
        <div class="hero__float-cards" aria-hidden="true">
          <span class="hero__float-card hero__float-card--chat"><span class="hero__float-emoji">💬</span> Responding by text</span>
          <span class="hero__float-card hero__float-card--voice"><span class="hero__float-emoji">🎙️</span> Answering by voice</span>
          <span class="hero__float-card hero__float-card--lead"><span class="hero__float-emoji">✅</span> Lead captured</span>
          <span class="hero__float-card hero__float-card--recap"><span class="hero__float-emoji">✉️</span> Recap sent</span>
          <span class="hero__float-card hero__float-card--blog"><span class="hero__float-emoji">✍️</span> Blog post published</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ========== FEATURE RIBBON ========== -->
<section class="ribbon">
  <div class="container">
    <ul class="ribbon__list">
      <li class="ribbon__item">
        <span class="ribbon__title">Unlimited Text Chat</span>
        <span class="ribbon__desc">Answer every visitor, on every page</span>
      </li>
      <li class="ribbon__item">
        <span class="ribbon__title">Voice Answers</span>
        <span class="ribbon__desc">Speaks to visitors naturally, 24/7</span>
      </li>
      <li class="ribbon__item">
        <span class="ribbon__title">Lead Capture</span>
        <span class="ribbon__desc">Collects name, email, phone &amp; intent</span>
      </li>
      <li class="ribbon__item">
        <span class="ribbon__title">Email Recaps</span>
        <span class="ribbon__desc">Sends you the details to follow up</span>
      </li>
      <li class="ribbon__item">
        <span class="ribbon__title">Blog Writing</span>
        <span class="ribbon__desc">Writes SEO posts for your site</span>
      </li>
    </ul>
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
          <div class="cost-card__icon">🚨</div>
          <div class="cost-card__title">After-hours emergency</div>
          <div class="cost-card__amount">$500+</div>
          <div class="cost-card__detail">Urgent job, gone to a faster competitor</div>
        </div>
        <div class="cost-card">
          <div class="cost-card__icon">📋</div>
          <div class="cost-card__title">New client inquiry</div>
          <div class="cost-card__amount">$3,000+</div>
          <div class="cost-card__detail">Lifetime value of one new customer</div>
        </div>
        <div class="cost-card">
          <div class="cost-card__icon">📞</div>
          <div class="cost-card__title">Missed quote request</div>
          <div class="cost-card__amount">$2,000</div>
          <div class="cost-card__detail">Prospect who needed a fast answer</div>
        </div>
        <div class="cost-card">
          <div class="cost-card__icon">📅</div>
          <div class="cost-card__title">Booking that never happened</div>
          <div class="cost-card__amount">$800</div>
          <div class="cost-card__detail">Appointment lost to a silent website</div>
        </div>
      </div>
    </div>
  </div>
</section>



<!-- ========== SECTION 6: SOCIAL PROOF ========== -->
<section class="proof-section">
  <div class="proof-section__backdrop" aria-hidden="true">
    <div class="proof-section__backdrop-panel"></div>
    <div class="proof-section__backdrop-accent"></div>
  </div>
  <div class="container">
    <div class="proof-section__layout reveal">
      <div class="proof-section__quote-mark" aria-hidden="true">&#10077;</div>
      <div class="proof-section__portrait-wrap">
        <div class="proof-section__portrait-frame">
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/synergy-scribes__ceo.webp' ); ?>" alt="Nathaly Martinez, CEO of Synergy Scribes" width="400" height="526" loading="lazy">
        </div>
        <div class="proof-section__portrait-shadow" aria-hidden="true"></div>
      </div>
      <div class="proof-section__content">
        <span class="proof-section__label">Trusted in Healthcare</span>
        <blockquote class="proof-section__quote">
          <p>We staff medical scribes across multiple clinics, and after hours is when most new facility inquiries come in. <strong>SiteStaffr</strong> captured a full intake request at 9 PM on a Sunday, with the clinic name, number of scribes needed, and start date. Monday morning it was sitting in our inbox, ready to go.</p>
        </blockquote>
        <cite class="proof-section__cite">
          <span class="proof-section__author">Nathaly Martinez <span class="proof-section__divider">|</span> <span class="proof-section__role">CEO &amp; Founder</span></span>
          <a class="proof-section__company" href="https://synergyscribes.com" target="_blank" rel="noopener noreferrer">Synergy Scribes</a>
        </cite>
      </div>
    </div>
    <div class="proof-section__stats reveal reveal-delay-1">
      <div class="proof-section__stat">
        <span class="proof-section__stat-number">24/7</span>
        <span class="proof-section__stat-label">Lead capture</span>
      </div>
      <div class="proof-section__stat">
        <span class="proof-section__stat-number">57+</span>
        <span class="proof-section__stat-label">Languages</span>
      </div>
      <div class="proof-section__stat">
        <span class="proof-section__stat-number">&lt;30s</span>
        <span class="proof-section__stat-label">Recap delivery</span>
      </div>
    </div>
  </div>
</section>

<!-- ========== HEAR IT WORK: AUDIO DEMO (relocated from hero) ========== -->
<section class="lead-demo" id="live-demo">
  <div class="lead-demo__bg" aria-hidden="true"></div>
  <div class="container">
    <div class="lead-demo__header reveal">
      <span class="section-label">Your AI Hire in Action</span>
      <h2>A Missed Call Turned Into a Booked Job</h2>
      <p class="lead-demo__subtitle">It&rsquo;s 9 PM. A homeowner has a leaking kitchen pipe. Your AI hire picks up, gets the details, and delivers a full recap to your inbox before you even check your phone.</p>
    </div>
    <div class="lead-demo__card reveal">
      <?php
      get_template_part(
          'template-parts/hero-audio-demo',
          null,
          array(
              'layout'        => 'stacked',
              'recap_variant' => 'card',
              'recap_pinned'  => true,
              'audio_label'   => 'After-hours call from a homeowner reporting a kitchen leak',
              'extra_classes' => 'hero-audio-demo hero-audio-demo--preview',
          )
      );
      ?>
    </div>
    <div class="lead-demo__steps reveal">

      <div class="lead-demo__step-card">
        <div class="lead-demo__card-glow" aria-hidden="true"></div>
        <div class="lead-demo__icon-wrap">
          <svg class="lead-demo__step-icon" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
          </svg>
          <span class="lead-demo__step-number">1</span>
        </div>
        <h3>Picks Up Instantly</h3>
        <p>Greets the caller by voice and gathers what they need, 24/7 with no hold music</p>
        <div class="lead-demo__card-accent" aria-hidden="true"></div>
      </div>

      <div class="lead-demo__connector" aria-hidden="true">
        <svg width="40" height="24" viewBox="0 0 40 24" fill="none">
          <path d="M0 12h28m0 0l-6-6m6 6l-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>

      <div class="lead-demo__step-card">
        <div class="lead-demo__card-glow" aria-hidden="true"></div>
        <div class="lead-demo__icon-wrap">
          <svg class="lead-demo__step-icon" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
            <circle cx="8.5" cy="7" r="4"/>
            <line x1="20" y1="8" x2="20" y2="14"/>
            <line x1="23" y1="11" x2="17" y2="11"/>
          </svg>
          <span class="lead-demo__step-number">2</span>
        </div>
        <h3>Captures Every Detail</h3>
        <p>Name, email, phone, urgency, and exactly what they need. Nothing slips through.</p>
        <div class="lead-demo__card-accent" aria-hidden="true"></div>
      </div>

      <div class="lead-demo__connector" aria-hidden="true">
        <svg width="40" height="24" viewBox="0 0 40 24" fill="none">
          <path d="M0 12h28m0 0l-6-6m6 6l-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>

      <div class="lead-demo__step-card">
        <div class="lead-demo__card-glow" aria-hidden="true"></div>
        <div class="lead-demo__icon-wrap">
          <svg class="lead-demo__step-icon" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
            <polyline points="22,6 12,13 2,6"/>
          </svg>
          <span class="lead-demo__step-number">3</span>
        </div>
        <h3>Delivers Your Recap</h3>
        <p>A complete lead summary hits your inbox so you can follow up first thing</p>
        <div class="lead-demo__card-accent" aria-hidden="true"></div>
      </div>

    </div>
  </div>
</section>

<!-- ========== SECTION 3: VOICE & CHAT ========== -->
<section class="voice-text-section">
  <img class="voice-text-section__robot voice-text-section__robot--voice voice-text-section__robot--active"
       src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/robot-voice.webp' ) ); ?>"
       alt="" width="1080" height="1350" aria-hidden="true" loading="lazy" decoding="async">
  <img class="voice-text-section__robot voice-text-section__robot--text"
       src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/robot-text.webp' ) ); ?>"
       alt="" width="1080" height="1350" aria-hidden="true" loading="lazy" decoding="async">
  <div class="voice-text-section__header reveal">
    <span class="section-label">Two Ways to Connect</span>
    <h2>Voice &amp; Chat</h2>
    <p class="voice-text-section__desc">Your visitors choose how they want to communicate. Some prefer typing, others prefer talking, and SiteStaffr handles both with the same AI and the same answers.</p>
  </div>
  <div class="container">
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

<!-- ========== SECTION 4: 57+ LANGUAGES ========== -->
<section class="lang-section">
  <div class="lang-section__greetings" aria-hidden="true">
    <span>Hola</span><span>Bonjour</span><span>&#20320;&#22909;</span><span>Ol&aacute;</span><span>Ciao</span><span>&#50504;&#45397;</span><span>Namaste</span><span>Merhaba</span><span>&#1605;&#1585;&#1581;&#1576;&#1575;</span><span>Xin ch&agrave;o</span>
  </div>
  <div class="container">
    <div class="lang-section__inner reveal">
      <div class="lang-section__lead">
        <div class="lang-section__icon">
          <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
        </div>
        <div class="lang-section__headline">
          <h2>SiteStaffr Speaks <em>Their</em> Language.</h2>
          <p>Your visitors speak 57+ languages, and so does SiteStaffr. Every recap arrives in English, ready for you.</p>
        </div>
      </div>
      <div class="lang-section__badges">
        <span class="lang-section__badge">Spanish</span>
        <span class="lang-section__badge">Mandarin</span>
        <span class="lang-section__badge">French</span>
        <span class="lang-section__badge">Portuguese</span>
        <span class="lang-section__badge">Arabic</span>
        <span class="lang-section__badge">Hindi</span>
        <span class="lang-section__badge">Japanese</span>
        <span class="lang-section__badge">Korean</span>
        <span class="lang-section__badge lang-section__badge--more">+50 more</span>
      </div>
      <div class="lang-section__expand">
        <button class="lang-section__expand-btn" type="button" aria-expanded="false">
          <span class="lang-section__expand-label">How it works</span>
          <svg class="lang-section__expand-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
        <div class="lang-section__detail" aria-hidden="true">
          <p>SiteStaffr reads and speaks your visitor&rsquo;s preferred language fluently. Whether a caller speaks Spanish, Mandarin, Arabic, or any of 50+ other languages, the AI agent responds naturally in their language. After each conversation, SiteStaffr translates and summarizes everything into a clear English recap delivered to your inbox, so you never miss a lead, regardless of the language barrier.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ========== SECTION 5: WHAT YOU GET ========== -->
<section class="what-you-get" id="demo">
  <div class="container">
    <div class="what-you-get__header reveal">
      <span class="section-label" id="demo-label">After Every Conversation</span>
      <h2>A Complete Report, Delivered to Your Inbox</h2>
      <p class="what-you-get__subtitle">
        Automatically capture visitor conversations, summaries, and transcripts, all in one clean, shareable document.
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
              <img class="what-you-get__doc-logo-img" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/logo-240.webp' ); ?>" alt="SiteStaffr" width="240" height="72">
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

      <?php // BELOW the document, not beside it. The four callouts describe what is IN the
      // report; this is what happens NEXT. As a fifth item in a callout column it read as a
      // peer of things it is not, left the right column hanging well below the left, and was
      // the only bordered, full-colour element on a page of borderless teal annotations. ?>
      <a class="what-you-get__crm" href="<?php echo esc_url( home_url( '/salesforce/' ) ); ?>">
        <img class="what-you-get__crm-logo"
             src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/logos/logo-salesforce.png' ); ?>"
             alt="Salesforce" width="84" height="59" loading="lazy" decoding="async">
        <span class="what-you-get__crm-text">
          <?php // Addressed to people who ALREADY have Salesforce. Opening with a question only a
          // Salesforce owner answers yes to does the segmenting on its own: everyone else reads
          // one line and moves on, without the copy having to reassure them, which is what made
          // the previous version ("Optional... Not a Salesforce user?") read as defensive.
          // Both claims already appear in this page's FAQ and on /salesforce/. ?>
          <span class="what-you-get__crm-title">Already using Salesforce?</span>
          <span class="what-you-get__crm-line">Connect your org in about a minute and qualified leads land there automatically. Included on every plan.</span>
        </span>
      </a>
    </div>
  </div>
</section>



<!-- ========== SECTION 7: VOICE SHOWCASE ========== -->
<section class="voice-section" id="voices">
  <!-- Background portrait — crossfades on voice switch -->
  <div class="voice-section__bg-portrait" aria-hidden="true">
    <img id="voiceBgCurrent" class="voice-section__bg-img voice-section__bg-img--active" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/agents/portraits/marin.webp' ); ?>" alt="" loading="lazy">
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

<!-- ========== SECTION 8: PRICING ========== -->
<section class="pricing-section" id="pricing">
  <div class="container">
    <div class="pricing-section__header reveal">
      <span class="section-label">Plans &amp; Pricing</span>
      <h2>One Flat Price. Unlimited Conversations.</h2>
      <p class="pricing-section__subtitle">Start free for 30 days, no credit card. After that a busy month costs the same as a quiet one. Only voice minutes change between plans.</p>
    </div>
    <div class="price-includes price-includes--homepage reveal">
      <div class="price-includes__grid" data-label="Every paid plan includes">
        <div class="price-includes__item price-includes__item--lead">
          <span class="price-includes__icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
          </span>
          <span class="price-includes__label">
            <strong>Unlimited</strong> AI text chat
            <span class="price-includes__note">No per-message or per-conversation fees. Only voice minutes count against your plan.</span>
          </span>
        </div>
        <div class="price-includes__item">
          <span class="price-includes__icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          </span>
          <span class="price-includes__label">Email recap + full transcript</span>
        </div>
        <div class="price-includes__item">
          <span class="price-includes__icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
          </span>
          <span class="price-includes__label">AI blog posts every month</span>
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
          <div class="price-tier__allowances">
            <div class="price-tier__stat">
              <span class="price-tier__stat-label">Voice</span>
              <span class="price-tier__stat-value">30 <small>min</small></span>
            </div>
            <div class="price-tier__stat">
              <span class="price-tier__stat-label">Blog posts</span>
              <span class="price-tier__stat-value">1 <small>post</small></span>
            </div>
          </div>
          <ul class="price-tier__features">
            <li>2 AI voices</li>
            <li>Unlimited text chat</li>
            <li>No credit card required</li>
          </ul>
          <p class="price-tier__best-for">Try SiteStaffr free for 30 days</p>
          <a href="<?php echo esc_url( home_url( '/download/' ) ); ?>" class="btn btn--outline">Start Free Trial</a>
        </div>
      </div>
      <div class="price-tier reveal reveal-delay-1">
        <div class="price-tier__identity">
          <div class="price-tier__name">Starter</div>
          <div class="price-tier__price">$29</div>
          <div class="price-tier__period">per month</div>
        </div>
        <div class="price-tier__details">
          <div class="price-tier__allowances">
            <div class="price-tier__stat">
              <span class="price-tier__stat-label">Voice</span>
              <span class="price-tier__stat-value">100 <small>min/mo</small></span>
            </div>
            <div class="price-tier__stat">
              <span class="price-tier__stat-label">Blog posts</span>
              <span class="price-tier__stat-value">2 <small>per mo</small></span>
            </div>
          </div>
          <ul class="price-tier__features">
            <li>2 AI voices</li>
            <li>3 AI visibility checks</li>
          </ul>
          <p class="price-tier__best-for">Best for businesses getting started</p>
          <a href="<?php echo esc_url( home_url( '/download/' ) ); ?>" class="btn btn--outline">Get Started</a>
        </div>
      </div>
      <div class="price-tier price-tier--popular reveal reveal-delay-2">
        <div class="price-tier__identity">
          <span class="price-tier__badge">Most Popular</span>
          <div class="price-tier__name">Business</div>
          <div class="price-tier__price">$69</div>
          <div class="price-tier__period">per month</div>
        </div>
        <div class="price-tier__details">
          <div class="price-tier__allowances">
            <div class="price-tier__stat">
              <span class="price-tier__stat-label">Voice</span>
              <span class="price-tier__stat-value">300 <small>min/mo</small></span>
            </div>
            <div class="price-tier__stat">
              <span class="price-tier__stat-label">Blog posts</span>
              <span class="price-tier__stat-value">4 <small>per mo</small></span>
            </div>
          </div>
          <ul class="price-tier__features">
            <li>5 AI voices</li>
            <li>Autopilot blog publishing</li>
            <li>10 AI visibility checks</li>
          </ul>
          <p class="price-tier__best-for">Best for growing local businesses</p>
          <a href="<?php echo esc_url( home_url( '/download/' ) ); ?>" class="btn btn--primary">Get Started</a>
        </div>
      </div>
      <div class="price-tier reveal reveal-delay-3">
        <div class="price-tier__identity">
          <div class="price-tier__name">Pro</div>
          <div class="price-tier__price">$129</div>
          <div class="price-tier__period">per month</div>
        </div>
        <div class="price-tier__details">
          <div class="price-tier__allowances">
            <div class="price-tier__stat">
              <span class="price-tier__stat-label">Voice</span>
              <span class="price-tier__stat-value">600 <small>min/mo</small></span>
            </div>
            <div class="price-tier__stat">
              <span class="price-tier__stat-label">Blog posts</span>
              <span class="price-tier__stat-value">8 <small>per mo</small></span>
            </div>
          </div>
          <ul class="price-tier__features">
            <li>All 10 AI voices</li>
            <li>Autopilot blog publishing</li>
            <li>Custom greeting + 4 tones</li>
            <li>25 AI visibility checks</li>
          </ul>
          <p class="price-tier__best-for">Best for multi-location or high-traffic sites</p>
          <a href="<?php echo esc_url( home_url( '/download/' ) ); ?>" class="btn btn--outline">Get Started</a>
        </div>
      </div>
    </div>
    <div class="pricing-assurance reveal">
      <p class="pricing-assurance__eyebrow">Simple, predictable pricing</p>
      <div class="pricing-assurance__grid">
        <div class="pricing-assurance__item">
          <span class="pricing-assurance__icon" aria-hidden="true">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
          </span>
          <div class="pricing-assurance__body">
            <h3 class="pricing-assurance__label">Voice minutes, your way</h3>
            <p>Need more? Add <strong>60 minutes for $20</strong> anytime. They never expire, and there are no automatic overage charges.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ========== SECTION 9: FAQ ========== -->
<section class="faq-section" id="faq">
  <div class="container">
    <div class="faq-section__header reveal">
      <span class="section-label">Common Questions</span>
      <h2>Frequently Asked Questions</h2>
    </div>
    <div class="faq-list reveal">
      <?php foreach ( $faq_items as $faq ) : ?>
      <div class="faq-item">
        <button class="faq-item__question" type="button" aria-expanded="false">
          <?php echo esc_html( $faq['question'] ); ?>
          <span class="faq-item__icon" aria-hidden="true"></span>
        </button>
        <div class="faq-item__answer">
          <div class="faq-item__answer-inner"><?php echo esc_html( $faq['answer'] ); ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ========== SECTION 10: FINAL CTA + GET STARTED ========== -->
<section class="final-cta" id="get-started">
  <div class="final-cta__decoration" aria-hidden="true"></div>
  <div class="container">
    <div class="final-cta__content cta-spotlight reveal">
      <h2>Your Next Visitor Has a Question.<br><span class="final-cta__highlight">Will Your Website Have the Answer?</span></h2>
      <p class="final-cta__subtitle">Rather not set it up yourself? Tell us about your business and we&rsquo;ll get your agent live for you.</p>
      <div class="final-cta__onboarding">
        <?php echo do_shortcode( '[sitestaffr_button persona="onboarding" text="Tell Us About Your Business" background_color="#1FB6CC" hover_background="#15a3b8" gradient="off" icon="sitestaffr" box_shadow="off"]' ); ?>
      </div>
      <p class="final-cta__secondary">or <a href="<?php echo esc_url( home_url( '/download/' ) ); ?>" class="final-cta__download-link">download the plugin</a> and install it yourself</p>
      <p class="final-cta__privacy">Your information will be used to set up your SiteStaffr assistant. See our <a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">Privacy Policy</a>.</p>
    </div>
  </div>
</section>

</main>
<?php get_template_part( 'template-parts/site-footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
