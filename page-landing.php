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
    /* SECTION 2's FOUR JOB-VALUE FIGURES. Ported from the V2 branch on 2026-08-26 with the
       figures, notes and sources byte-identical — these are the sourced numbers user testing
       responded to, and retyping them by hand is how a citation quietly becomes wrong.

       AMBER APPEARS IN EXACTLY ONE PLACE ON THE SITE: the four `amount` values below. Not on
       a button, a card, an icon, a heading or a border. Anywhere else is a bug. Mario
       overruled the objection to keeping amber here on 2026-08-26 — the original concern was
       that amber was doing semantic work across every section and becoming a second accent
       competing with teal, and one confined use on the element you most want people to stop
       on is a different thing. Confined is the whole reason it is allowed. */
    $job_values = array(
        array(
            'img'    => 'ind-hvac',
            'label'  => 'HVAC',
            'amount' => '$5,500',
            'note'   => 'Median cost of one HVAC project',
            'source' => 'U.S. Census Bureau, 2023 Home Improvements, from the American Housing Survey (2021-23). Median cost by project type, as published.',
        ),
        array(
            'img'    => 'ind-wrench',
            'label'  => 'Auto repair',
            'amount' => '$494',
            'note'   => 'Average customer-pay repair order',
            'source' => 'NADA, 2025 Annual Financial Profile of America\'s Franchised New-Car Dealerships. Franchised dealer service departments, full-year 2025.',
        ),
        array(
            'img'    => 'ind-tooth',
            'label'  => 'Dental',
            'amount' => '$391',
            'note'   => 'Average spend per dental visit',
            /* ⚠️ THE ONLY DERIVED FIGURE ON THE PAGE, and the tooltip says so. AHRQ publishes
               total dental expenditures and total dental visits in the same brief but no
               per-visit line; this is one divided by the other. Disclosed rather than
               presented as published, because "computed from" and "reported as" are not the
               same claim. Cross-checks at $386 against the brief's own per-person figures. */
            'source' => 'Computed from AHRQ MEPS Statistical Brief #555 (March 2024, 2021 data): total U.S. dental expenditures divided by total dental visits. AHRQ does not publish a per-visit figure for this period.',
        ),
        array(
            'img'    => 'ind-paw',
            'label'  => 'Veterinary',
            'amount' => '$200',
            'note'   => 'What owners report paying at their last visit',
            'source' => 'AVMA, 2025 Pet Ownership and Demographics Sourcebook. Owner self-reported, published October 2025.',
        ),
    );

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
        <?php /* The headline used to state the OUTCOME ("You Get the Lead") and never the
                 CATEGORY, which left the five float cards doing all the category work on
                 their own. A stranger has to read this once and think "this is a thing I
                 put on my site that talks to my visitors".

                 Teal falls on "on Your Website" deliberately - Mario: "people are searching
                 to put this on their site", so the accent lands on the phrase that matches
                 transactional search intent, not on the product noun.

                 No trailing period: single sentence, per the heading rule. */ ?>
        <h1 class="hero__headline">
          <span class="hero__headline-prefix">Put an AI Receptionist</span>
          <span class="hero__headline-focus">on Your Website</span>
        </h1>
        <?php /* Ends on SITUATION, not category. "while you're on a job, with a client, or
                 asleep" is audience signalling a dentist recognises instantly. Never write
                 "small and medium-sized businesses" - nobody self-identifies that way, and
                 it would tell an agency this page is not for them. */ ?>
        <p class="hero__subtitle">
          Visitors type or talk. SiteStaffr answers from your own pages, takes their name and number, and emails you the lead &mdash; while you&rsquo;re on a job, with a client, or asleep.
        </p>
        <span class="hero__no-cc">Free for 30 days &bull; Installs in minutes &bull; No code required</span>
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
        <?php
        /* The industry line anchors to #industries (section 6) rather than /for/ — it
           scrolls DOWN THE PAGE instead of leaving it, which is why the arrow is a down
           arrow and not a right one. Fifteen exit doors before proof and pricing is what
           section 6 is being rebuilt to stop.

           The remainder is COUNTED FROM THE REGISTRY, never hardcoded. The spec says
           "+10 more", written when there were fifteen industries; adding Medical Staffing
           makes it eleven, and a hardcoded number would have gone quietly wrong the moment
           the sixteenth landed. The registry is the one place the count lives. */
        $hero_named_industries = array( 'Dental', 'Law', 'HVAC', 'Veterinary', 'Salons' );
        $hero_more_count       = max( 0, count( sitestaffr_industry_list() ) - count( $hero_named_industries ) );
        ?>
        <p class="hero__industries">
          <a href="#industries">
            <?php echo esc_html( implode( ' · ', $hero_named_industries ) ); ?>
            <?php if ( $hero_more_count > 0 ) : ?>
              &middot; +<?php echo (int) $hero_more_count; ?> more
            <?php endif; ?>
            <span class="hero__industries-arrow" aria-hidden="true">&darr;</span>
          </a>
        </p>
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

<?php /* THE FIVE-CAPABILITY RIBBON WAS DELETED HERE, 2026-08-26.

   It listed Unlimited Text Chat / Voice Answers / Lead Capture / Email Recaps /
   Blog Writing — the same five things the hero's float cards already say, in
   the same order, immediately below them. It was the redundant copy, and the
   float cards are the version testers actually responded to.

   It was also load-bearing in the wrong direction: at 1440x900 it occupied 133px
   between the hero and section 2, which pushed section 2's dark block to y=929
   and off the first screen. Capping the hero height alone could not fix that —
   the band had to go for the page to open on its first contrast moment.

   Measured after removal: section 2 starts at y=796, on screen.

   Nothing replaces it. The capabilities are covered by the float cards above and
   by sections 3 and 4 below. */ ?>

<?php get_template_part( 'template-parts/seam-curtain' ); ?>

<!-- ========== SECTION 2: COST OF MISSED VISITORS ========== -->
<?php /* SECTION 2 — the first half of the dark block. Sections 2 and 3 share one dark
         background so there is no seam between them; the only seam on the page is the
         curtain above, where the light hero meets this.

         PORTED from the V2 branch, figures and sources byte-identical, because these are
         what user testing responded to. The four unsourced placeholders that used to live
         here ($500+/$3,000+/$2,000/$800) are gone: they were invented, and this section's
         whole argument is that the numbers are real and cited. */ ?>
<section class="block block--dark block-split cost-section">
  <div class="block__inner">
    <div class="block-split__grid cost-section__grid">
      <div class="cost-section__copy">
        <?php /* Eyebrow was "The Hidden Cost of Lost Website Visitors", and on the V2 branch
                 "What One Job Is Worth". Both described the RIGHT column while the heading
                 described the left — two arguments stacked, and the reader had to work out
                 which one the section was about. This one describes the section. */ ?>
        <span class="section-label">The Shift Nobody Covers</span>
        <h2>Busy Owners Miss Website Leads and Often Never Know It</h2>

        <?php /* SETS UP THE AUDIT, and does not restate the hero. It also does not attack
                 "we'll get back to you" (Mario, 2026-08-20) — that would be a self-own,
                 since SiteStaffr's own conversations end with details captured and a human
                 following up. The difference is WHEN the visitor gets their answer. */ ?>
        <p class="cost-section__text">
          Your website is where most customers meet your business first, and it is usually working a shift you are not there for.
        </p>

        <?php /* The best copy on the site — do not rewrite it. "no missed call" is correct
                 here and must survive the "call" sweep: it is describing the ABSENCE of a
                 phone signal, which is the point, not claiming the product answers phones. */ ?>
        <p class="cost-section__text">
          When it cannot answer, nobody tells you. There is no missed call, no voicemail, nothing in your inbox. The visitor just goes back to the search results, and the job quietly happens somewhere else.
        </p>

        <?php /* CUT TO ONE LINE. This paragraph used to resolve the problem the section had
                 just posed — "SiteStaffr is an employee for your website. It answers your
                 visitors day or night…" — which made section 3 arrive as a repeat of an
                 answer already given. Section 3 is where the product shows up; this line
                 just hands over to it, and it picks up "a shift you are not there for"
                 from the first paragraph. */ ?>
        <p class="cost-section__text cost-section__handoff">That&rsquo;s the shift SiteStaffr covers.</p>
      </div>

      <?php /* 2x2, AND THE GRID SHAPE IS PART OF WHY THIS WORKS. A previous pass replaced
               these with a single time-ordered column and it read as overwhelming despite
               running FEWER words — four boxes are four glances, four stacked rows are a
               paragraph with rules between them. Scannability is not word count. */ ?>
      <div class="block-split__art job-values">
        <ul class="job-values__grid">
<?php foreach ( $job_values as $jv ) : ?>
          <li class="job-value">
            <?php
            /* The sprite fallback from the V2 branch was dropped in this port, deliberately.
               There it read `<use href="#i-ind-…">` against template-parts/icon-sprite.php,
               and main has no sprite system at all — so the "fallback" would have rendered
               nothing at all if the image were ever missing, which is worse than no
               fallback because it looks like a working safety net. The four renders are
               committed alongside this file; if one goes missing the alt-empty img is the
               honest failure. */
            ?>
            <img class="job-value__icon"
                 src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/icons/' . $jv['img'] . '.webp' ) ); ?>"
                 width="64" height="64" alt="" aria-hidden="true" decoding="async" loading="lazy">

            <?php
            /* SOURCE ON DEMAND, not in the card (Mario: "a little I icon for information up
               at the top right corner… it can have a tool tip for the source").

               A real <button>, not a hover-only span, and that is the accessibility
               difference: a hover tooltip is unreachable by keyboard and unreachable on
               touch. As a button it takes focus, opens on :focus-visible as well as :hover,
               and announces through aria-describedby. `title` is deliberately not used — it
               is invisible on touch, unstyleable, and read inconsistently by screen readers.

               The info glyph is inline rather than a sprite reference, for the same reason
               the fallback was dropped: main has no sprite to point at. */
            $jv_src_id = 'jv-src-' . sanitize_html_class( $jv['img'] );
            ?>
            <button class="job-value__src" type="button"
                    aria-label="<?php echo esc_attr( 'Source for the ' . $jv['label'] . ' figure' ); ?>"
                    aria-describedby="<?php echo esc_attr( $jv_src_id ); ?>">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
            </button>
            <span class="job-value__tip" id="<?php echo esc_attr( $jv_src_id ); ?>" role="tooltip">
              <?php echo esc_html( $jv['source'] ); ?>
            </span>

            <?php
            /* NO VISIBLE INDUSTRY LABEL (Mario, 2026-08-25: "remove the industry name under
               each icon"). The icon carries it, and a wrench captioned "Auto repair" is a
               caption telling you what the picture already said.

               `label` stays in the array and is still USED — it builds the info button's
               aria-label, so a screen-reader user hears "Source for the Auto repair figure"
               rather than "Source". Deleting the field to tidy up would take that with it. */
            ?>
            <span class="job-value__amount"><?php echo esc_html( $jv['amount'] ); ?></span>
            <span class="job-value__note"><?php echo esc_html( $jv['note'] ); ?></span>
          </li>
<?php endforeach; ?>
        </ul>
        <?php /* The price anchor was REMOVED here (Mario, 2026-08-26: not yet). It read
                 "A single repair order covers a year of SiteStaffr."

                 ⚠️ IF IT EVER RETURNS, IT STAYS SPECIFIC TO THE REPAIR ORDER. Starter is
                 $29/mo = $348/yr, so it is true of the $494 card and FALSE of the $391 and
                 $200 ones. An earlier version said "winning one of them pays for a year",
                 which was true of four invented figures and became false the moment real
                 ones replaced them — a claim that quantifies over a list breaks silently
                 every time the list changes, and nothing in the diff says so. This trap has
                 already caught the project once. */ ?>
        <p class="job-values__foot">Real industry averages, each with its source &mdash; not estimates.</p>
      </div>
    </div>
  </div>
</section>




<!-- ========== HEAR IT WORK: AUDIO DEMO (relocated from hero) ========== -->
<?php /* SECTION 3 — the second half of the dark block. Shares section 2's background, so
         there is deliberately no seam between them.

         REPLACES TWO SECTIONS: "A Missed Call Turned Into a Booked Job" (lead-demo) and
         "Voice & Chat" (voice-text-section). Both demoed the product; together they said
         it twice and neither showed the payoff arriving.

         ⚠️ THE OLD HEADING HAD TO GO AND IT MATTERS MORE NOW. "A Missed Call Turned Into
         a Booked Job" — and its sibling "Hear It Take a Call" — read unmistakably as
         "this answers my phone". The product has no phone line; the readme leads with
         "No phone lines." With "receptionist" in the H1 that misreading is the single
         most likely misunderstanding of the whole positioning, and it also throws away
         the real differentiator: the visitor talks ON YOUR WEBSITE, with no number to
         dial and nothing to install.

         It also books nothing. The conversation ends with details captured and a human
         following up, because that is what the product does. A demo that books something
         is a demo of a product we do not sell. */ ?>
<section class="block block--dark block--tight see-it" id="live-demo">
  <div class="block__inner">
    <div class="see-it__header">
      <span class="section-label">See It Answer</span>
      <h2>Hear a Visitor Talk to a Website</h2>
      <p class="see-it__subtitle">One types, one talks. Same AI, same answers.</p>
    </div>

    <div class="see-it__panels">
      <?php /* LEFT: the conversation. The two column labels do the arguing — "On your
               website" / "In your inbox" states the value exchange in four words and
               kills the phone-line ambiguity for free. */ ?>
      <div class="see-it__col">
        <span class="see-it__col-label">On Your Website</span>

        <div class="see-it__panel see-it__panel--convo">
          <?php /* THE TOGGLE ATTACHES TO THE PANEL IT CONTROLS. On the V2 branch these
                   were chips floating over a street render; with the art gone they were
                   labels attached to nothing. They only change the conversation, so they
                   belong to the conversation.

                   Both labels are THE VISITOR'S QUESTION, not one question and one
                   description — the tabs are two examples of the same thing, and
                   labelling them asymmetrically implied they were different features. */ ?>
          <div class="see-it__tabs" role="tablist" aria-label="Choose a conversation">
            <button class="see-it__tab" role="tab" type="button"
                    id="see-it-tab-voice" aria-controls="see-it-convo"
                    data-mode="voice" aria-selected="false" disabled>
              <span class="see-it__tab-mode">Voice</span>
              <span class="see-it__tab-q">&ldquo;My check engine light came on&rdquo;</span>
              <span class="see-it__tab-soon">Recording coming soon</span>
            </button>
            <button class="see-it__tab see-it__tab--active" role="tab" type="button"
                    id="see-it-tab-text" aria-controls="see-it-convo"
                    data-mode="text" aria-selected="true">
              <span class="see-it__tab-mode">Text</span>
              <span class="see-it__tab-q">&ldquo;There are ants all over my kitchen&rdquo;</span>
            </button>
          </div>

          <?php /* Light browser/widget chrome, so "on a website" is SHOWN rather than
                   claimed. Decorative only — hidden from the a11y tree. */ ?>
          <div class="see-it__chrome" aria-hidden="true">
            <span class="see-it__dot"></span><span class="see-it__dot"></span><span class="see-it__dot"></span>
            <span class="see-it__url" data-see-it-business>Copperleaf Pest Control</span>
          </div>

          <div class="see-it__convo" id="see-it-convo" role="tabpanel"
               aria-labelledby="see-it-tab-text" data-see-it-thread>
            <?php /* RENDERED FULLY POPULATED IN PHP. JS empties it on load only when it
                     is actually going to animate it. An empty panel that fills only when
                     a script runs re-creates exactly the failure the reveal system caused
                     in production. With JS off, or under prefers-reduced-motion, the
                     whole conversation and the whole recap are simply here. */ ?>
            <p class="see-it__line see-it__line--ai"><span class="see-it__who">SiteStaffr</span>Copperleaf Pest Control &mdash; what are you seeing?</p>
            <p class="see-it__line see-it__line--visitor"><span class="see-it__who">Visitor</span>Ants all over the kitchen counter, started today.</p>
            <p class="see-it__line see-it__line--ai"><span class="see-it__who">SiteStaffr</span>That usually means a trail in from outside. Is it a house or an apartment?</p>
            <p class="see-it__line see-it__line--visitor"><span class="see-it__who">Visitor</span>A house, single storey.</p>
            <p class="see-it__line see-it__line--ai"><span class="see-it__who">SiteStaffr</span>We can get someone out to look. What name should I put down?</p>
            <p class="see-it__line see-it__line--visitor"><span class="see-it__who">Visitor</span>Priya Raman.</p>
            <p class="see-it__line see-it__line--ai"><span class="see-it__who">SiteStaffr</span>Thanks Priya &mdash; best email or number to reach you?</p>
            <p class="see-it__line see-it__line--visitor"><span class="see-it__who">Visitor</span>priya.raman@example.com</p>
            <p class="see-it__line see-it__line--ai"><span class="see-it__who">SiteStaffr</span>Got it. Someone will follow up to arrange a visit.</p>
          </div>

          <?php /* The play button is the largest interactive element in the section, and
                   the scrubber is the hero soundwave motif reused as a progress bar.
                   Browsers will not autoplay audio, so nothing animates until this is
                   pressed — which is fine, it makes the button the gateway.

                   `hidden` until JS removes it: with no script there is nothing to play,
                   and a dead play button is worse than none. */ ?>
          <div class="see-it__transport" data-see-it-transport hidden>
            <button class="see-it__play" type="button" data-see-it-play
                    aria-label="Play the conversation">
              <svg class="see-it__play-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><polygon points="7,4 20,12 7,20"/></svg>
              <svg class="see-it__pause-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg>
            </button>
            <div class="see-it__scrub" data-see-it-scrub>
              <span class="see-it__scrub-fill" data-see-it-fill></span>
            </div>
            <span class="see-it__time" data-see-it-time>0:00 / 0:54</span>
          </div>
        </div>

        <?php /* Connects the recording to the dogfood. The live widget on this site is
                 better than any recording, because a visitor can verify it themselves. */ ?>
        <p class="see-it__dogfood">This site runs it too. Ask it anything.</p>
      </div>

      <?php /* RIGHT: the recap. Mario's idea and the best one in the session — it
               assembles as the conversation plays, which makes the causal link visible:
               you watch the visitor give their email, and the email appears. */ ?>
      <div class="see-it__col">
        <span class="see-it__col-label">In Your Inbox</span>

        <div class="see-it__panel see-it__panel--recap" data-see-it-recap>
          <div class="see-it__recap-head">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 7 10 6 10-6"/></svg>
            Conversation Recap
          </div>

          <dl class="see-it__fields" data-see-it-fields>
            <?php /* ⚠️ NO FIXED SCHEMA. Label and value materialise together as a PAIR.
                     The product builds each recap intelligently — sometimes a name only,
                     sometimes a name and an email, sometimes a name and a phone. A
                     pre-drawn skeleton of greyed labels would be a picture of a form the
                     product does not have. The voice thread captures a PHONE where this
                     one captures an EMAIL, and that difference is the point. */ ?>
            <div class="see-it__field"><dt>Reason for visit</dt><dd>Ants in the kitchen</dd></div>
            <div class="see-it__field"><dt>Property</dt><dd>Single-storey house</dd></div>
            <div class="see-it__field"><dt>Name</dt><dd>Priya Raman</dd></div>
            <div class="see-it__field"><dt>Email</dt><dd>priya.raman@example.com</dd></div>
          </dl>

          <?php /* The summary and follow-up genuinely ARE generated after the conversation
                   ends, so they arrive last, after a brief shimmer. That is the one part
                   of the sequence that mirrors how the product actually works. */ ?>
          <div class="see-it__gen" data-see-it-summary>
            <span class="see-it__gen-label">Summary</span>
            <p>Ant trail in the kitchen of a single-storey house. Wants someone to come out.</p>
          </div>
          <div class="see-it__gen" data-see-it-followup>
            <span class="see-it__gen-label">Suggested follow-up</span>
            <p>Email Priya to arrange a visit.</p>
          </div>

          <p class="see-it__toast" data-see-it-toast>&#10003; Recap emailed to you</p>
        </div>

        <p class="see-it__caption" data-see-it-caption hidden>Press play &mdash; this fills in as the conversation happens.</p>
      </div>
    </div>
  </div>
</section>

<?php /* SECTION 4 — Your morning. Light again; the dark block ended with section 3.

         THE RECAP DOCUMENT THAT USED TO BE HERE IS DELETED, and that is the largest
         length saving on the page — achieved by removing a duplicate rather than by
         cutting content.

         Section 3 now shows a recap ASSEMBLING as the conversation plays. This section
         then showed the same artifact again, static, one screen later. That is a
         downgrade repeat: the second showing can only be less interesting than the first.

           section 3 = ONE conversation, seen happening.
           section 4 = THREE conversations, seen accumulated.

         Singular to plural is an escalation instead of a repeat, and it gives this
         section the one argument section 3 structurally cannot make: you did not get a
         lead, you got three, and you were asleep for all of them.

         The bridge line went with the document ("Here is what the 2:14 AM one looked
         like when you opened it") — it pointed at the thing that no longer exists. */ ?>
<section class="block what-you-get" id="your-morning">
  <div class="block__inner">
    <div class="what-you-get__header">
      <span class="section-label">Your Morning</span>
      <?php /* The strongest heading on the page. Do not rewrite it. */ ?>
      <h2>You Were Asleep. Your Website Wasn&rsquo;t.</h2>
      <?php /* THE SUBTITLE IS LOAD-BEARING and was cut once before for looking like
               filler. It actively guards against the reading that leads queue up and
               get handled at opening time — "answered within seconds and sent to you
               the moment it ended" is the whole product claim, and without it an inbox
               labelled "Overnight" implies exactly the opposite. */ ?>
      <p class="what-you-get__subtitle">
        Each of these was answered within seconds and sent to you the moment it ended. Nothing waited for opening time.
      </p>
    </div>

    <?php
    /* THE INBOX IS THE EVIDENCE, AND IT IS WHERE THE CLOCK IDEA LANDS. Mario asked
       about a large clock or a 24/7 symbol behind the hero robot. Wrong slot — the
       hero's job is identity — but the right instinct, and the better version is not a
       clock at all: it is A REAL TIMESTAMP ON A REAL THING. "6:03 AM" on a captured
       lead does concretely what a clock face gestures at.

       ⚠️ NEWEST FIRST, WHICH PUTS THE OPEN ONE IN THE MIDDLE. An inbox sorts 6:03 AM /
       2:14 AM / 11:47 PM. Do not reorder to put the highlighted row on top: a list that
       sorts wrongly stops reading as an inbox, and the realism is the entire argument.
       The middle row being the open one is what a real morning looks like.

       ⚠️ ONE BUSINESS, THREE LEADS. An inbox belongs to one owner. Do not turn these
       three rows into three different industries to show range — that turns a believable
       morning into a brochure, and the section stops being evidence. */
    ?>
    <div class="morning-inbox">
      <div class="morning-inbox__chrome">
        <span class="morning-inbox__label">Overnight &mdash; Maggie&rsquo;s Cakes</span>
        <span class="morning-inbox__count">3 new leads</span>
      </div>
      <ul class="morning-inbox__list">
        <li class="morning-inbox__item">
          <span class="morning-inbox__time">6:03 AM</span>
          <span class="morning-inbox__who">Tom Byrne</span>
          <span class="morning-inbox__what">Gluten-free cupcakes, 40 for Friday</span>
          <span class="morning-inbox__tag">Lead captured</span>
        </li>
        <li class="morning-inbox__item morning-inbox__item--open" aria-current="true">
          <span class="morning-inbox__time">2:14 AM</span>
          <span class="morning-inbox__who">Sarah Mitchell</span>
          <span class="morning-inbox__what">Two-tier unicorn cake, 25 guests, April 12</span>
          <span class="morning-inbox__tag">Lead captured</span>
        </li>
        <li class="morning-inbox__item">
          <span class="morning-inbox__time">11:47 PM</span>
          <span class="morning-inbox__who">Priya Raman</span>
          <span class="morning-inbox__what">Wedding tasting &mdash; are you open Sundays?</span>
          <span class="morning-inbox__tag">Lead captured</span>
        </li>
      </ul>
    </div>

    <?php /* THE FOUR CALLOUTS BECOME A CARDS ROW UNDER THE INBOX. They were set as two
             right-aligned on the left of the document and two left-aligned on the right,
             with the right pair floating above a large gap — a layout that only made
             sense as annotations flanking the artifact they pointed at. With the
             document gone they have nothing to flank, so they become what they always
             were: four short claims about how the recap reaches you. */ ?>
    <div class="block-cards__grid what-you-get__callouts" style="--cards: 4;">
      <div class="what-you-get__callout">
        <h3 class="what-you-get__callout-title">Sent in Seconds</h3>
        <p class="what-you-get__callout-desc">It reaches your inbox while the visitor is still on your site.</p>
      </div>
      <?php /* KEEP THIS ONE INTACT. Nothing else on the page says that conversations
               which did NOT turn into a lead are still reported, and that is the
               difference between a lead tool and a record of everything that happened. */ ?>
      <div class="what-you-get__callout">
        <h3 class="what-you-get__callout-title">Every Conversation</h3>
        <p class="what-you-get__callout-desc">Voice and text alike, whether or not it turned into a lead.</p>
      </div>
      <div class="what-you-get__callout">
        <h3 class="what-you-get__callout-title">One Link to Share</h3>
        <p class="what-you-get__callout-desc">Send the whole thing to whoever is doing the job.</p>
      </div>
      <?php /* ⚠️ REWORDED. This read "No dashboard to log into." The plugin SHIPS a
               Dashboard with a Follow-ups queue and it is a feature we sell, so as
               written the card denied the existence of a real feature in order to make
               a convenience point. The claim intended was always "you don't have to",
               which is both true and a better sell. */ ?>
      <div class="what-you-get__callout">
        <h3 class="what-you-get__callout-title">Nothing to Check</h3>
        <p class="what-you-get__callout-desc">The details come to where you already work. There&rsquo;s a dashboard too, if you want it.</p>
      </div>
    </div>

    <?php /* THE SALESFORCE BAND MOVED OUT, to the FAQ in section 9.

             It sat directly under a story about a bakery owner asleep at 2 AM. Maggie's
             Cakes does not have Salesforce, and an enterprise CRM logo in the middle of
             that story is the same register problem testers disliked in the "connect
             your org" line. It also leaked to /salesforce/ in the same tab, which breaks
             the one-exit rule on the section immediately before proof and pricing.

             "Does it fit my stack" is a buying question, so it belongs in the FAQ where
             buying questions are answered — see the CRM entry in $faq_items. */ ?>
  </div>
</section>

<!-- ========== SECTION 5: SPEAKS THEIR LANGUAGE ========== -->
<?php
/* SECTION 5 — Speaks their language.

   THE CROWD RENDER IS DELETED. It was the best-looking image on the site and it still
   had to go:

     1. In the V3 order it would be a dark full-bleed band between two light sections,
        which is a stripe, and it put the abandoned painterly style directly against the
        glossy cyan robot.
     2. It was the maintenance trap this whole review was called to fix — twelve
        hand-measured --x/--y percentages positioned over the artwork, where a code
        comment recorded that swapping the image "silently invalidates all twelve", and
        that they had already been re-measured twice.
     3. Most bubbles did not render: twelve specced, four visible at 1440.
     4. About 250px of it was wet pavement; people occupied a 200px band in a ~900px
        section.
     5. It carried TWO LISTS OF LANGUAGES that did not agree — pills saying Spanish /
        Mandarin / French, bubbles saying Hola / Hallo / Xin chào.

   THE REPLACEMENT COSTS NO NEW ART. robot-languages.webp was generated for this exact
   slot on 2026-08-25, committed, and never placed.

   WHY THE ROBOT ARGUES BETTER THAN THE CROWD. A crowd claims "your visitors are
   diverse" — true, but not the product claim, and a picture of a street cannot prove it.
   The robot with a live greeting claims "it speaks them", which is the thing only
   SiteStaffr can say, and the greeting is a real product surface rather than a stock
   photograph.

   THE PILLS BECOME THE CONTROL. That collapses the two redundant lists into one thing
   and adds the interactivity that tested well: click Mandarin, the greeting becomes 你好.

   ⚠️ `lang` ON EVERY GREETING AND `dir="rtl"` ON THE ARABIC. A screen reader switches
   voice on `lang`; without it a synthesiser reads "Hola" in English phonetics on the one
   section whose entire subject is other languages. This is not decoration.
*/
$lang_greetings = array(
	array( 'code' => 'es', 'name' => 'Spanish',  'text' => '¡Hola! ¿En qué puedo ayudarte?' ),
	array( 'code' => 'zh', 'name' => 'Mandarin', 'text' => '你好！有什么可以帮您的吗？' ),
	array( 'code' => 'fr', 'name' => 'French',   'text' => 'Bonjour ! Comment puis-je vous aider ?' ),
	array( 'code' => 'ar', 'name' => 'Arabic',   'text' => 'مرحبا! كيف يمكنني مساعدتك؟', 'rtl' => true ),
	array( 'code' => 'hi', 'name' => 'Hindi',    'text' => 'नमस्ते! मैं आपकी कैसे मदद कर सकता हूँ?' ),
);
?>
<section class="block block-split lang-section" id="languages">
  <div class="block__inner">
    <div class="block-split__grid">
      <div class="lang-section__copy">
        <span class="section-label">Speaks Their Language</span>
        <h2>SiteStaffr Speaks <em>Their</em> Language</h2>
        <p class="lang-section__text">
          Your visitors speak 57+ languages, and so does SiteStaffr. It answers in whatever language they open with.
        </p>

        <?php /* The greeting bubble. Rendered with the FIRST greeting already in it, so
                 the section is complete before any script runs. */ ?>
        <div class="lang-bubble" data-lang-bubble>
          <p class="lang-bubble__text" lang="es" data-lang-text>¡Hola! ¿En qué puedo ayudarte?</p>
        </div>

        <?php /* PROMOTED FROM BODY TEXT TO ITS OWN ELEMENT. It closes the owner's
                 immediate objection — "great, but I can't read Mandarin" — and as a
                 sentence buried in a paragraph it was doing none of that work. */ ?>
        <p class="lang-section__english">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6 9 17l-5-5"/></svg>
          Every recap arrives in English, ready for you.
        </p>

        <?php /* The pills ARE the control, not a second list. With JS off they still
                 read as the list of supported languages, which is what they were
                 before — so nothing is lost, only gained. */ ?>
        <div class="lang-pills" role="group" aria-label="Preview a greeting in another language">
          <?php foreach ( $lang_greetings as $i => $g ) : ?>
            <button type="button"
                    class="lang-pill<?php echo 0 === $i ? ' lang-pill--active' : ''; ?>"
                    data-lang-code="<?php echo esc_attr( $g['code'] ); ?>"
                    data-lang-greeting="<?php echo esc_attr( $g['text'] ); ?>"
                    <?php echo ! empty( $g['rtl'] ) ? 'data-lang-rtl="1"' : ''; ?>
                    aria-pressed="<?php echo 0 === $i ? 'true' : 'false'; ?>">
              <?php echo esc_html( $g['name'] ); ?>
            </button>
          <?php endforeach; ?>
          <span class="lang-pill lang-pill--more">+52 more</span>
        </div>
      </div>

      <?php /* Robot on the RIGHT. Section 6 puts its artifact on the left so the two
               alternate, and section 1 and section 11 also carry him on the right —
               three appearances on the same side make him a motif rather than floating
               decoration. */ ?>
      <div class="block-split__art lang-section__art">
        <img src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/robot-languages.webp' ) ); ?>"
             alt="" aria-hidden="true"
             width="1122" height="1383" loading="lazy" decoding="async">
      </div>
    </div>
  </div>
</section>

<?php
/* SECTION 6 — Who this is for. The section Mario hated most, and the one that
   motivated this review. Rebuilt rather than adjusted.

   WHAT WAS WRONG WITH THE OLD FLAT BLOCK:
     - all fifteen names linked to /for/{slug}/ — fifteen exit doors immediately before
       proof and pricing, and they did not LOOK like links, so a click surprised and a
       wanted click was undiscoverable.
     - five lines ended on a dangling separator dot, the mirror of a bug already fixed
       once: a separator in flowing text cannot be suppressed at a line boundary in pure
       CSS.
     - it did the recognition job and nothing else.

   THE ISOMETRICS FINALLY GET A SIZE YOU CAN SEE. ⚠️ This does NOT contradict the "no
   isometric" rule — that rule was about SIZE. The design system deletes them "wherever
   they render below ~100px", because you could not see them. They are 1024x1024 and hold
   at 440px easily, and they are the right style family: smooth, brand teal, transparent
   background, no warm light. The incompatible style was the painterly amber CITY.

   CLICK, NOT HOVER, for three reasons: hover does not exist on touch and most SMB
   traffic is phones; hover flickers, because crossing the list swaps a 440px image four
   times; and the excerpt needs persistence — you cannot move the pointer to a link that
   vanishes when you leave the name.

   THE BLURBS COME FROM THE REGISTRY. No copywriting, and a new industry stays correct
   for free. */
$ind_groups = sitestaffr_industry_registry();
$ind_flat   = sitestaffr_industry_list();
$ind_first  = ! empty( $ind_flat ) ? $ind_flat[0] : null;
?>
<section class="block block-split block-split--reverse industries" id="industries">
  <div class="block__inner">
    <div class="industries__header">
      <span class="section-label">Who This Is For</span>
      <h2>Built for Businesses Where a Missed Message Is a Lost Customer</h2>
      <?php /* Counted, never written out. "Sixteen industries" hardcoded here is how the
               subtitle and the registry drift apart the moment a seventeenth is added. */ ?>
      <p class="industries__subtitle">
        <?php echo esc_html( count( $ind_flat ) ); ?> industries, one problem. Find yours.
      </p>
    </div>

    <div class="block-split__grid industries__grid">
      <?php /* IMAGE LEFT. Section 5 puts the robot on the right, so this alternates —
               that is the whole reason block-split--reverse exists. */ ?>
      <div class="block-split__art industries__art">
        <?php foreach ( $ind_flat as $i => $ind ) :
            $art = sitestaffr_industry_art_url( $ind['slug'] );
            /* ⚠️ A MISSING RENDER MUST NOT PRODUCE A BROKEN IMAGE. Medical Staffing is
               the sixteenth industry and its isometric is generated but not yet keyed,
               so the file genuinely is absent right now. sitestaffr_industry_art_url()
               returns '' when the file does not exist, and the panel falls back to the
               industry's emoji at display size rather than an alt-text box. */
            ?>
          <div class="industries__panel<?php echo 0 === $i ? ' is-active' : ''; ?>"
               data-ind-panel="<?php echo esc_attr( $ind['slug'] ); ?>"
               <?php echo 0 === $i ? '' : 'aria-hidden="true"'; ?>>
            <?php if ( $art ) : ?>
              <img src="<?php echo esc_url( $art ); ?>"
                   alt=""
                   width="1024" height="1024"
                   <?php echo 0 === $i ? 'fetchpriority="high"' : 'loading="lazy"'; ?>
                   decoding="async">
            <?php else : ?>
              <span class="industries__panel-fallback" aria-hidden="true"><?php echo esc_html( $ind['icon'] ); ?></span>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>

        <?php /* The excerpt sits under the image on desktop and inside each accordion
                 item on mobile, so it is rendered twice — once here for the pointer
                 layout, once per item below. Both come from the same registry field. */ ?>
        <div class="industries__excerpt" data-ind-excerpt>
          <?php foreach ( $ind_flat as $i => $ind ) : ?>
            <div class="industries__excerpt-item<?php echo 0 === $i ? ' is-active' : ''; ?>"
                 data-ind-excerpt-for="<?php echo esc_attr( $ind['slug'] ); ?>">
              <h3><?php echo esc_html( $ind['title'] ); ?></h3>
              <p><?php echo esc_html( $ind['blurb'] ); ?></p>
              <?php /* ONE link, at the end, NEW TAB, with per-industry text rather than
                       a generic "learn more" — per the happy-path rule, this is a
                       deliberate exit and it should say where it goes. */ ?>
              <a class="industries__link"
                 href="<?php echo esc_url( home_url( '/for/' . $ind['slug'] . '/' ) ); ?>"
                 target="_blank" rel="noopener">
                See what <?php echo esc_html( strtolower( $ind['title'] ) ); ?> get asked
                <span aria-hidden="true">&nearr;</span>
              </a>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <?php /* LIST RIGHT. Group headings RETURN, and that correctly reverses a recorded
               decision. They were killed because "five headings plus fifteen names is a
               rail again" — an objection that does not survive this layout: the list is
               one column of a Split beside a 440px image, not the shape of the section.

               ⚠️ ON MOBILE the category headings stay VISIBLE as static labels and only
               the industries collapse. Closed state is 5 headings + 16 names, about one
               and a bit screens, so someone scanning for their trade sees everything at
               once. Mobile is genuinely better at the recognition job than desktop here.
               A two-level accordion would be three taps deep and every 440px expansion
               would blow the layout apart. */ ?>
      <div class="industries__list">
        <?php foreach ( $ind_groups as $group ) : ?>
          <div class="industries__group">
            <h3 class="industries__group-heading"><?php echo esc_html( $group['heading'] ); ?></h3>
            <ul class="industries__names">
              <?php foreach ( $group['industries'] as $ind ) : ?>
                <li>
                  <button type="button"
                          class="industries__name<?php echo ( $ind_first && $ind['slug'] === $ind_first['slug'] ) ? ' is-active' : ''; ?>"
                          data-ind-name="<?php echo esc_attr( $ind['slug'] ); ?>"
                          aria-pressed="<?php echo ( $ind_first && $ind['slug'] === $ind_first['slug'] ) ? 'true' : 'false'; ?>">
                    <?php echo esc_html( $ind['title'] ); ?>
                  </button>

                  <?php /* THE MOBILE EXPANSION. Rendered for every industry and hidden by
                           CSS at desktop widths, so with no JS at all a phone visitor
                           still gets every blurb and every link — the accordion is a
                           progressive enhancement over a plain list, not a requirement
                           for reading it. Image is ~200px here, not 440. */ ?>
                  <div class="industries__mobile-detail" data-ind-detail="<?php echo esc_attr( $ind['slug'] ); ?>">
                    <?php $m_art = sitestaffr_industry_art_url( $ind['slug'] ); ?>
                    <?php if ( $m_art ) : ?>
                      <img src="<?php echo esc_url( $m_art ); ?>" alt=""
                           width="1024" height="1024" loading="lazy" decoding="async">
                    <?php endif; ?>
                    <p><?php echo esc_html( $ind['blurb'] ); ?></p>
                    <a class="industries__link"
                       href="<?php echo esc_url( home_url( '/for/' . $ind['slug'] . '/' ) ); ?>"
                       target="_blank" rel="noopener">
                      See what <?php echo esc_html( strtolower( $ind['title'] ) ); ?> get asked
                      <span aria-hidden="true">&nearr;</span>
                    </a>
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ========== SECTION 7: SOCIAL PROOF ========== -->
<section class="proof-section">
  <div class="proof-section__backdrop" aria-hidden="true">
    <div class="proof-section__backdrop-panel"></div>
    <div class="proof-section__backdrop-accent"></div>
  </div>
  <div class="container">
    <div class="proof-section__layout">
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
    <?php
    /* TWO REAL CUSTOMER RESULTS, replacing three generic product facts (24/7 lead
       capture, 57+ languages, <30s recap delivery). Those three were true, and every
       one of them is already stated elsewhere on the page — they were the product
       spec sitting in the slot reserved for evidence.

       THE PAIR CLOSES THE PAGE'S ARGUMENT, in this order:
         86% of their conversations arrived after they closed  -> section 2's thesis is true
         23 qualified leads in 30 days                          -> and it turned into business

       ⚠️ THE SECOND ONE USED TO BE "1 in 3". That is a conversion RATE, and the reader
       has to do arithmetic before they know whether it is good — one in three of what,
       and is that a lot? The underlying fact is 23 qualified leads in 30 days, which is
       immediately meaningful and needs no denominator explained.

       ⚠️ THE FOOTNOTE STAYS AND IS NOT A DISCLAIMER TO MINIMISE. "One customer's
       results, not an average" buys more credibility than the two numbers do: it is the
       sentence that tells a skeptical reader these are real rather than modelled. Do
       not shrink it, move it into a tooltip, or drop it when a second testimonial
       arrives — with two customers it becomes more necessary, not less. */
    ?>
    <div class="proof-section__stats">
      <div class="proof-section__stat">
        <span class="proof-section__stat-number">86%</span>
        <span class="proof-section__stat-label">of their conversations arrived after they closed</span>
      </div>
      <div class="proof-section__stat">
        <span class="proof-section__stat-number">23</span>
        <span class="proof-section__stat-label">qualified leads in 30 days</span>
      </div>
    </div>
    <p class="proof-section__footnote">One customer&rsquo;s results, not an average.</p>
  </div>
</section>




<!-- ========== VOICE SHOWCASE — not in the V3 eleven-section map; see note below ========== -->
<?php /* THE VOICE SHOWCASE IS DELIBERATELY OUTSIDE THE ELEVEN-SECTION MAP.

         The V3 spec lists eleven sections and this is not one of them, but it never
         says to cut it either - it simply was not on the V2 branch the spec was
         written against. Mario's call, 2026-08-26: keep it.

         ⚠️ THE NAV DEPENDS ON IT. site-nav.php has a top-level "Voices" item pointing
         at #voices, and nothing else on the homepage lets a visitor HEAR the ten
         voices - the pricing table states how many each plan gets, which is the count,
         not the demo. Deleting this section means repointing that nav item first. */ ?>
<section class="block voice-section" id="voices">
  <!-- Background portrait — crossfades on voice switch -->
  <div class="voice-section__bg-portrait" aria-hidden="true">
    <img id="voiceBgCurrent" class="voice-section__bg-img voice-section__bg-img--active" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/agents/portraits/marin.webp' ); ?>" alt="" loading="lazy">
    <img id="voiceBgNext" class="voice-section__bg-img" src="" alt="">
  </div>
  <div class="container">
    <div class="voice-section__header">
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
<section class="block block-panel pricing-section" id="pricing">
  <div class="container">
    <div class="pricing-section__header">
      <span class="section-label">Plans &amp; Pricing</span>
<?php // "Unlimited Conversations" was not true: voice is metered at 100/300/600 minutes a
        // month. The settled positioning is unlimited TEXT chat, which is what the strip
        // below this already says, so the heading was the one place still overclaiming.
        // This is a correctness fix, not a style one. ?>
      <h2>One Flat Price. Unlimited Text Chat.</h2>
      <p class="pricing-section__subtitle">Start free for 30 days, no credit card. After that a busy month costs the same as a quiet one. Only voice minutes change between plans.</p>
    </div>
    <div class="price-includes price-includes--homepage">
      <div class="price-includes__grid" data-label="Every plan includes">
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
          <?php
          /* Blog Agent is otherwise invisible on the homepage, and a features
             section for it would break the single argument the page was just
             rebuilt around (and reopen audit finding 4). This existing phrase is
             the whole fix - /blog-agent/ already exists and is already in the nav.

             NEW TAB, and this is not a style choice (Mario, 2026-08-21): the
             pricing strip is the moment of purchase intent, so nothing in this
             section may navigate the buyer away from it. Any link added here
             later gets target="_blank" for the same reason. */
          ?>
          <span class="price-includes__label"><a class="price-includes__link" href="<?php echo esc_url( home_url( '/blog-agent/' ) ); ?>" target="_blank" rel="noopener">AI blog posts every month<span class="screen-reader-text"> (opens in a new tab)</span></a></span>
        </div>
        <?php
        /* SIXTH INCLUSION, AND THE COUNT IS THE POINT. The lead row sits full-width
           above, so the remainder is what fills the three-column grid: five left a
           ragged 3+2 last row, six fills 3+3.

           "AI visibility checks" is the one chosen because it is the term the tier
           columns below use (3 / 10 / 25) and never explain, so a buyer met it for
           the first time as a bare number. True on every paid plan - the allowance
           differs, the inclusion does not. */
        ?>
        <div class="price-includes__item">
          <span class="price-includes__icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
          </span>
          <span class="price-includes__label">AI search visibility checks</span>
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
        <?php
        /* THE /features/ LINK LIVES HERE NOW, not in a reassurance block at the
           foot of the section. It was bolted onto the "Simple, predictable
           pricing" pair, where it sat beside an add-on billing fact it has
           nothing to do with — one item removes the fear of overage, the other
           removes the fear of not understanding, and an eyebrow over both made
           the pair read as filler (Mario, 2026-08-24).

           This panel is where a first-time visitor MEETS the unexplained terms —
           AI blog posts, AI visibility checks — several hundred pixels before the
           tier columns repeat them as bare numbers. The answer belongs next to
           the question, as one quiet line on the panel's own floor.

           NEW TAB, same rule as every other link in this section (Mario,
           2026-08-21): the pricing strip is the moment of purchase intent and
           nothing in it may navigate the buyer away. */
        ?>
        <p class="price-includes__footer">
          New to any of this? <a class="price-includes__link" href="<?php echo esc_url( home_url( '/features/' ) ); ?>" target="_blank" rel="noopener">See what every feature actually does<span class="screen-reader-text"> (opens in a new tab)</span></a>, in plain English.
        </p>
      </div>
    </div>
    <?php
    /* The paid ladder is three tiers, so the grid is three columns and the free
       trial is not a fourth card competing with them. Nothing is lost: every
       allowance the trial card listed is still here, and so is its link to
       /download/, which is the URL that must not change. */
    ?>
    <?php /* THE TRIAL STRIP THAT SAT HERE IS GONE - the trial is the table's first
             column now (see .price-tier--trial above). Keeping both would state the
             same plan twice in two formats, which is the exact problem moving it into
             the table was meant to solve.

             ⚠️ IT ALSO CARRIED "100 text messages/day". That cap was removed from the
             product, the copy and the Terms on 2026-08-26 and is live in production.
             This markup was ported from a branch that PREDATES that change, so the
             port silently reverted it - along with "Every paid plan includes", which
             main had already corrected to "Every plan includes".

             When porting from the V2 branch, re-check anything the unlimited-trial
             rollout touched: that branch is older than main on this subject. */ ?>

    <?php
    /* ONE LABEL COLUMN, NOT THREE (Mario, 2026-08-24: "the main issue is that it
       rewrites everything 3 times and some of the data is small or difficult to
       read"). He was right and I had talked myself out of it when this table was
       first built: six rows repeated across three columns is eighteen labels for
       six facts, and twelve of them are noise. Repetition at that density stops
       reading as a price table and starts reading as a form.

       So the section is now a real four-column comparison table - a shared label
       rail plus three value columns - and the space that bought is spent on size:
       values went 1.02rem -> 1.35rem, the voice figure 1.65rem -> 2rem, units
       0.72 -> 0.82rem, and the labels dropped uppercase micro-type for sentence
       case at 0.95rem. The uppercase was part of what made them hard to read.

       SUBGRID IS LOAD-BEARING, NOT A FLOURISH. The whole tier column is a click
       target, and that works by stretching the CTA's own ::after across the
       column - which requires .price-tier to remain ONE positioned element
       wrapping all of its rows. So the rows cannot be split into sibling grid
       cells. `grid-template-rows: subgrid` lets each tier keep its single
       element while its rows adopt the parent's tracks, which is what makes them
       line up with the label rail and with each other. See the CSS note. */
    ?>
    <div class="price-grid price-grid--table">
      <?php
      /* aria-hidden, and that is deliberate rather than lazy. Each value cell
         still carries its own label as .screen-reader-text, so a screen reader
         hears "Voice minutes, 100 min/mo" inside the column it belongs to
         instead of having to correlate a rail against three columns. Below
         1040px this rail is hidden and those same in-cell labels become
         visible, which is why they are in the markup rather than generated. */
      ?>
      <div class="price-grid__labels" aria-hidden="true">
        <p class="price-grid__rail-head">What you get</p>
        <span class="price-grid__label">Voice minutes</span>
        <span class="price-grid__label">Blog posts</span>
        <span class="price-grid__label">AI voices</span>
        <span class="price-grid__label">Visibility checks</span>
        <span class="price-grid__label">Autopilot blog</span>
        <span class="price-grid__label">Custom greeting</span>
      </div>
      <?php /* THE TRIAL IS A COLUMN NOW, NOT A STRIP.

               It used to present its specs as five bullets - "30 voice minutes, 1 blog
               post, 2 AI voices" - while the paid plans presented the same facts as
               labelled rows. The same information in two incompatible formats, so nobody
               could actually compare the thing they were being asked to start with. As
               the first column every row lines up, and it moves the primary conversion
               path into the most prominent object on the page.

               TREATED AS AN ON-RAMP, NOT A FOURTH PLAN: narrower, muted, "$0 / 30 days",
               and an explicit end state so it never reads as a permanent free tier.

               ⚠️ VALUES VERIFIED AGAINST THE MIDDLEWARE, not inferred from the old card.
               included_seconds: 1800 = 30 min and BLOG_POST_LIMITS.trial = 1 are both in
               config/billing.js. Visibility checks is 3 because routes/visibility.js
               records "an unknown plan falls back to the smallest paid cap", and trial is
               not in its per-plan map - writing an em dash there would have been a false
               claim that the trial gets none. */ ?>
      <div class="price-tier price-tier--trial">
        <div class="price-tier__identity">
          <div class="price-tier__name">Free Trial</div>
          <div class="price-tier__price">$0</div>
          <div class="price-tier__period">for 30 days</div>
        </div>
        <div class="price-tier__row price-tier__row--lead">
          <span class="price-tier__row-label">Voice minutes</span>
          <span class="price-tier__row-value">30 <small>min</small></span>
        </div>
        <div class="price-tier__row">
          <span class="price-tier__row-label">Blog posts</span>
          <span class="price-tier__row-value">1</span>
        </div>
        <div class="price-tier__row">
          <span class="price-tier__row-label">AI voices</span>
          <span class="price-tier__row-value">2</span>
        </div>
        <div class="price-tier__row">
          <span class="price-tier__row-label">Visibility checks</span>
          <span class="price-tier__row-value">3</span>
        </div>
        <div class="price-tier__row">
          <span class="price-tier__row-label">Autopilot blog</span>
          <span class="price-tier__row-value price-tier__row-value--none"><span aria-hidden="true">&mdash;</span><span class="screen-reader-text">Not included</span></span>
        </div>
        <div class="price-tier__row">
          <span class="price-tier__row-label">Custom greeting</span>
          <span class="price-tier__row-value price-tier__row-value--none"><span aria-hidden="true">&mdash;</span><span class="screen-reader-text">Not included</span></span>
        </div>
        <div class="price-tier__foot">
          <p class="price-tier__best-for">No credit card. Ends after 30 days unless you pick a plan.</p>
          <a href="<?php echo esc_url( home_url( '/download/' ) ); ?>" class="btn btn--outline js-cta" data-cta="trial">Start Free Trial</a>
        </div>
      </div>
      <div class="price-tier">
        <div class="price-tier__identity">
          <div class="price-tier__name">Starter</div>
          <div class="price-tier__price">$29</div>
          <div class="price-tier__period">per month</div>
        </div>
        <div class="price-tier__row price-tier__row--lead">
          <span class="price-tier__row-label">Voice minutes</span>
          <span class="price-tier__row-value">100 <small>min/mo</small></span>
        </div>
        <div class="price-tier__row">
          <span class="price-tier__row-label">Blog posts</span>
          <span class="price-tier__row-value">2</span>
        </div>
        <div class="price-tier__row">
          <span class="price-tier__row-label">AI voices</span>
          <span class="price-tier__row-value">2</span>
        </div>
        <div class="price-tier__row">
          <span class="price-tier__row-label">Visibility checks</span>
          <span class="price-tier__row-value">3</span>
        </div>
        <div class="price-tier__row">
          <span class="price-tier__row-label">Autopilot blog</span>
          <span class="price-tier__row-value price-tier__row-value--none"><span aria-hidden="true">&mdash;</span><span class="screen-reader-text">Not included</span></span>
        </div>
        <div class="price-tier__row">
          <span class="price-tier__row-label">Custom greeting</span>
          <span class="price-tier__row-value price-tier__row-value--none"><span aria-hidden="true">&mdash;</span><span class="screen-reader-text">Not included</span></span>
        </div>
        <div class="price-tier__foot">
          <p class="price-tier__best-for">Best for businesses getting started</p>
          <a href="<?php echo esc_url( home_url( '/download/' ) ); ?>" class="btn btn--outline js-cta" data-cta="plan">Get Started</a>
        </div>
      </div>
      <div class="price-tier price-tier--popular">
        <div class="price-tier__identity">
          <span class="price-tier__badge">Most Popular</span>
          <div class="price-tier__name">Business</div>
          <div class="price-tier__price">$69</div>
          <div class="price-tier__period">per month</div>
        </div>
        <div class="price-tier__row price-tier__row--lead">
          <span class="price-tier__row-label">Voice minutes</span>
          <span class="price-tier__row-value">300 <small>min/mo</small></span>
        </div>
        <div class="price-tier__row">
          <span class="price-tier__row-label">Blog posts</span>
          <span class="price-tier__row-value">4</span>
        </div>
        <div class="price-tier__row">
          <span class="price-tier__row-label">AI voices</span>
          <span class="price-tier__row-value">5</span>
        </div>
        <div class="price-tier__row">
          <span class="price-tier__row-label">Visibility checks</span>
          <span class="price-tier__row-value">10</span>
        </div>
        <div class="price-tier__row">
          <span class="price-tier__row-label">Autopilot blog</span>
          <span class="price-tier__row-value price-tier__row-value--yes"><span aria-hidden="true">&#10003;</span><span class="screen-reader-text">Included</span></span>
        </div>
        <div class="price-tier__row">
          <span class="price-tier__row-label">Custom greeting</span>
          <span class="price-tier__row-value price-tier__row-value--none"><span aria-hidden="true">&mdash;</span><span class="screen-reader-text">Not included</span></span>
        </div>
        <div class="price-tier__foot">
          <p class="price-tier__best-for">Best for growing local businesses</p>
          <a href="<?php echo esc_url( home_url( '/download/' ) ); ?>" class="btn btn--primary js-cta" data-cta="plan">Get Started</a>
        </div>
      </div>
      <div class="price-tier">
        <div class="price-tier__identity">
          <div class="price-tier__name">Pro</div>
          <div class="price-tier__price">$129</div>
          <div class="price-tier__period">per month</div>
        </div>
        <div class="price-tier__row price-tier__row--lead">
          <span class="price-tier__row-label">Voice minutes</span>
          <span class="price-tier__row-value">600 <small>min/mo</small></span>
        </div>
        <div class="price-tier__row">
          <span class="price-tier__row-label">Blog posts</span>
          <span class="price-tier__row-value">8</span>
        </div>
        <div class="price-tier__row">
          <span class="price-tier__row-label">AI voices</span>
          <span class="price-tier__row-value">All 10</span>
        </div>
        <div class="price-tier__row">
          <span class="price-tier__row-label">Visibility checks</span>
          <span class="price-tier__row-value">25</span>
        </div>
        <div class="price-tier__row">
          <span class="price-tier__row-label">Autopilot blog</span>
          <span class="price-tier__row-value price-tier__row-value--yes"><span aria-hidden="true">&#10003;</span><span class="screen-reader-text">Included</span></span>
        </div>
        <div class="price-tier__row">
          <span class="price-tier__row-label">Custom greeting</span>
          <span class="price-tier__row-value price-tier__row-value--yes"><span aria-hidden="true">&#10003;</span><span class="screen-reader-text">Included</span></span>
        </div>
        <div class="price-tier__foot">
          <p class="price-tier__best-for">Best for multi-location or high-traffic sites</p>
          <a href="<?php echo esc_url( home_url( '/download/' ) ); ?>" class="btn btn--outline js-cta" data-cta="plan">Get Started</a>
        </div>
      </div>
      <?php
      /* THE RAIL'S STUB HEAD, and it earns its place by fixing a real imbalance
         rather than by labelling something obvious. The label column is ~286px
         wide, so leaving its top cell empty left a dead corner that size and
         pushed the three shopfronts visibly right of the axis the centred
         section header sits on. A stub head is what a comparison table puts
         there anyway.

         LAST IN THE MARKUP, not first, and that is deliberate: the tiers are
         placed by `:nth-child(2|3|4)`, so inserting an element ahead of them
         would silently move every column one to the right. Grid placement is
         explicit, so DOM order costs nothing here. */
      ?>
    </div>
    <?php
    /* THE ADD-ON FACT, AS A FOOTNOTE TO THE TABLE RATHER THAN A BLOCK UNDER IT.
       It replaces the two-column "Simple, predictable pricing" reassurance row,
       which Mario removed on 2026-08-24: the two items in it were never a pair,
       so an eyebrow claiming they were made the whole block read as filler.

       This half stays because it answers the one question the Voice row raises,
       and it now sits directly beneath that table as a footnote does — one rule,
       one line, no eyebrow, no icon, no box. The other half moved up to the
       inclusions panel; see the note there. */
    ?>
    <p class="price-footnote">
      Run out of voice minutes? Add <strong>60 minutes for $20</strong> anytime. They roll over, never expire, and there are no automatic overage charges.
    </p>
  </div>
</section>

<!-- ========== SECTION 9: FAQ ========== -->
<section class="faq-section" id="faq">
  <div class="container">
    <div class="faq-section__header">
      <span class="section-label">Common Questions</span>
      <h2>Frequently Asked Questions</h2>
    </div>
    <div class="faq-list">
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

<!-- ========== SECTION 11: CLOSING CTA ==========================================
     THE HIERARCHY HERE WAS INVERTED, and site-nav.php:53 records why that was
     wrong: "Self-serve is the primary conversion path (Mario, 2026-08-11)."

     What it used to be, measured rather than guessed:
       - the onboarding WIDGET button was the visual primary, and carried a
         shimmer animation actively pulling the eye to it
       - the actual trial - the primary conversion path - was a text link at
         0.85rem and 45% opacity, prefixed with the word "or"

     So on the page that closes the sale, the one action the business wants was
     the faintest thing in the section. This is copy and hierarchy only; no new
     functionality. Order is now trial > concierge > chat. -->
<section class="block block--dark block-split final-cta" id="get-started">
  <div class="block__inner">
    <div class="block-split__grid final-cta__grid">
      <div class="final-cta__copy">
        <h2>Be the One That&rsquo;s Still Open<br><span class="final-cta__highlight">When Everyone Else Has Closed</span></h2>

        <?php /* "answers every call, chat and question" became "answers your visitors".
                 "call" invites the phone-line misreading, which is worse now the H1 says
                 receptionist and the product has no phone line. "every" is the word commit
                 f73108a recorded as untrue - it had come back. */ ?>
        <p class="final-cta__subtitle">SiteStaffr answers your visitors around the clock &mdash; nights, weekends, holidays.</p>

        <?php /* PRIMARY. data-cta makes this a swappable trigger rather than a hard-coded
                 link: the target funnel is pricing -> checkout modal -> purchase, with
                 /download/ becoming post-purchase instructions. When checkout exists this
                 is a one-line change at four call sites. */ ?>
        <a href="<?php echo esc_url( home_url( '/download/' ) ); ?>"
           class="btn btn--primary final-cta__primary js-cta"
           data-cta="trial">
          Start Free Trial
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
        <p class="final-cta__reassure">Free for 30 days &middot; No credit card required</p>

        <p class="final-cta__or"><span>or</span></p>

        <?php /* SECONDARY. Still the real onboarding widget - the shortcode is the working
                 mechanism and is not worth reimplementing - but demoted to an outline
                 treatment and stripped of the shimmer. */ ?>
        <div class="final-cta__concierge">
          <span class="final-cta__concierge-label">Rather have us set it up?</span>
          <?php echo do_shortcode( '[sitestaffr_button persona="onboarding" text="Let\'s Get Started" background_color="transparent" hover_background="#0A424A" gradient="off" icon="sitestaffr" box_shadow="off"]' ); ?>
        </div>
        <p class="final-cta__note">We reply within 3 business days.</p>

        <?php /* TERTIARY. Kept because it converts the support widget from a help link into
                 proof: it is the same AI the visitor would install. */ ?>
        <p class="final-cta__tertiary">Questions? Ask our AI &mdash; it&rsquo;s the same one you&rsquo;d install.</p>

        <p class="final-cta__privacy">Your information will be used to set up your SiteStaffr assistant. See our <a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">Privacy Policy</a>.</p>
      </div>

      <?php /* Robot on the right, matching section 1 and section 5 - three appearances on
               the same side make him a motif rather than floating decoration.
               robot-cta.webp is pending: Mario is re-running the prompt, attempt 1 failed
               the pose check. The cell is reserved at the final ratio so dropping the file
               in needs no layout change, and it collapses on mobile either way. */ ?>
      <div class="block-split__art final-cta__art" aria-hidden="true"></div>
    </div>
  </div>
</section>

</main>
<?php get_template_part( 'template-parts/site-footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
