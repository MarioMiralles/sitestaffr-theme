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
        // Entity disambiguation: sameAs tells Google which third-party profiles are this entity, which… → docs/implementation-notes.md#sameAs
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
    /* SECTION 2's FOUR JOB-VALUE FIGURES. → docs/implementation-notes.md#section-2-s-four-job-value-figures */
    /* `mark` IS THE WATERMARK, AND IT IS NOT `label`. → docs/implementation-notes.md#job-values */
    $job_values = array(
        array(
            'img'    => 'ind-hvac',
            'label'  => 'HVAC',
            'mark'   => 'HVAC',
            'amount' => '$5,500',
            'note'   => 'Median cost of one HVAC project',
            'source' => 'U.S. Census Bureau, 2023 Home Improvements, from the American Housing Survey (2021-23). Median cost by project type, as published.',
        ),
        array(
            'img'    => 'ind-wrench',
            'label'  => 'Auto repair',
            'mark'   => 'AUTO',
            'amount' => '$494',
            'note'   => 'Average customer-pay repair order',
            'source' => 'NADA, 2025 Annual Financial Profile of America\'s Franchised New-Car Dealerships. Franchised dealer service departments, full-year 2025.',
        ),
        array(
            'img'    => 'ind-tooth',
            'label'  => 'Dental',
            'mark'   => 'DENTAL',
            'amount' => '$887',
            'note'   => 'Average yearly spend per dental patient',
            /* ⚠️ PER YEAR, NOT PER VISIT, AND THAT CHANGE IS THE POINT. → docs/implementation-notes.md#per-year-not-per-visit-and-that-change-is-the */
            'source' => 'AHRQ MEPS Statistical Brief #555, dental utilization and expenditures 2019-2021. Average annual dental expenditure per person with any dental visit, 2021, out-of-pocket and insurance combined.',
        ),
        array(
            'img'    => 'ind-paw',
            'label'  => 'Veterinary',
            'mark'   => 'VET',
            'amount' => '$598',
            'note'   => 'Average yearly vet spend per dog owner',
            /* Per year, for the same reason as the dental card above. → docs/implementation-notes.md#per-year-for-the-same-reason-as-the-dental-car */
            'source' => 'AVMA, 2025 Pet Ownership and Demographics Sourcebook. Mean annual veterinary expenditure per dog-owning household; excludes food, grooming and other non-veterinary pet spending.',
        ),
    );

    /* SECTION 9 — the FAQ. Seventeen questions in four groups, reordered OBJECTION-FIRST. → docs/implementation-notes.md#faq-items */
    $faq_items = array(

        /* ---- Installing it ---- */
        array(
            'group'    => 'Installing it',
            'question' => 'Does SiteStaffr work with my WordPress site?',
            'answer'   => 'Yes. SiteStaffr is a WordPress plugin built for self-hosted WordPress sites. You install it from your dashboard the same way you install any other plugin, connect it in one step, and the chat widget appears on your site. It works with any theme and does not require you to change your existing pages.',
        ),
        array(
            'group'    => 'Installing it',
            'question' => 'Do I need a developer to install SiteStaffr?',
            'answer'   => 'No. SiteStaffr installs in under five minutes without any code. Search for it in your WordPress dashboard, click install, activate it, and enter your business details in the setup wizard. If you would rather not do it yourself, SiteStaffr can set it up for you.',
        ),
        array(
            'group'    => 'Installing it',
            /* NEW. The reflex objection of every WordPress owner to every plugin, and
               nothing on the site addressed it. */
            'question' => 'Will SiteStaffr slow down my website?',
            'answer'   => 'No. The SiteStaffr widget loads after your page content and runs from SiteStaffr servers rather than yours, so your pages render at the same speed. The AI work happens off your site entirely, which means no extra load on your hosting no matter how many visitors are chatting at once.',
        ),
        array(
            'group'    => 'Installing it',
            /* NEW. Buyers assume an AI product needs training data or scripting. */
            'question' => 'Do I need to train it or write scripts?',
            'answer'   => 'No. SiteStaffr reads your published pages automatically and answers from what is already there, then re-reads new and changed pages daily. The setup wizard asks for your business details once. You can add custom instructions if you want to steer its tone or answers, but nothing needs writing before it works.',
        ),

        /* ---- Can I trust it ---- */
        array(
            'group'    => 'Can I trust it',
            /* NEW, and the most important one on the page. THE objection to any AI
               product, and the answer is a differentiator that was sitting on the floor. */
            'question' => 'Will it make things up?',
            'answer'   => 'SiteStaffr answers from your own indexed pages rather than from general knowledge, so it tells visitors what your site actually says. When a question falls outside what it has read, it says it does not know and offers to take the visitor\'s details instead of guessing. You can read every conversation in the recap it emails you.',
        ),
        array(
            'group'    => 'Can I trust it',
            'question' => 'What happens if it cannot answer a question?',
            'answer'   => 'It says so plainly and captures the visitor\'s name and contact details so you can follow up. That is the intended outcome rather than a failure: SiteStaffr gathers leads, and a question it cannot answer is usually the most valuable one to know about. The recap tells you what was asked.',
        ),
        array(
            'group'    => 'Can I trust it',
            /* NEW. Five of the sixteen industries are medical, dental, chiropractic,
               veterinary and medical staffing. */
            'question' => 'What happens to my visitors\' data?',
            'answer'   => 'Conversation details are used to answer the visitor and to build the recap emailed to you. SiteStaffr does not sell visitor data or use it to advertise to them. Contact details captured in a conversation belong to you. Full detail is in the SiteStaffr privacy policy.',
        ),
        array(
            'group'    => 'Can I trust it',
            'question' => 'Can I control what it says and how it looks?',
            'answer'   => 'Yes. You can set the greeting, choose the voice, pick the widget colors and icon, and add custom instructions that steer how it answers. You can also tell it what not to discuss. Everything is editable from your WordPress dashboard without touching code.',
        ),

        /* ---- What it does ---- */
        array(
            'group'    => 'What it does',
            /* Cut from ~150 words to ~65. Too long to extract cleanly, and a wall
               inside the accordion. */
            'question' => 'What is SiteStaffr?',
            'answer'   => 'SiteStaffr is an AI receptionist for your website, built as a WordPress plugin. Visitors type or talk to it, and it answers their questions from your own pages, captures their name and contact details, and emails you a recap of every conversation. It also writes SEO blog posts for your site each month.',
        ),
        array(
            'group'    => 'What it does',
            /* NEW, and it is the FAQ half of the hero's 24/7 edit. → docs/implementation-notes.md#new-and-it-is-the-faq-half-of-the-hero-s-24-7 */
            'question' => 'Does SiteStaffr answer visitors 24/7?',
            'answer'   => 'Yes. SiteStaffr answers every visitor the moment they arrive, at 2 AM on a Sunday exactly as it does at 2 PM on a Tuesday. There is no schedule to set, no after-hours mode to switch on, and nobody waiting on call — it is the same AI answering from the same pages at every hour. You get the recap by email either way, so an overnight conversation is waiting for you in the morning rather than lost.',
        ),
        array(
            'group'    => 'What it does',
            /* NEW. Protects the positioning: with "receptionist" in the H1, people will
               assume phone answering, which is a different and more expensive category. */
            'question' => 'Can visitors really talk to my website without calling a phone number?',
            'answer'   => 'Yes. Visitors click the widget on your site and speak to it in the browser. There is no phone number to dial, nothing to install on their end, and no phone line involved on yours. They can also type instead, and both get the same AI and the same answers from your pages.',
        ),
        array(
            'group'    => 'What it does',
            'question' => 'What happens after a visitor conversation?',
            'answer'   => 'SiteStaffr emails you a recap within seconds of the conversation ending. It contains the visitor\'s name and contact details, what they were asking about, a short summary, a suggested follow-up, and the full transcript. You get one for every conversation, whether or not it turned into a lead.',
        ),
        array(
            'group'    => 'What it does',
            'question' => 'What languages does SiteStaffr support?',
            'answer'   => 'Over 57 languages, including Spanish, Mandarin, French, Portuguese, Arabic, Hindi, Japanese and Korean. Visitors are answered in whatever language they open with, and no setup is needed to enable them. Every recap arrives in English regardless of the language the conversation was in.',
        ),
        array(
            'group'    => 'What it does',
            'question' => 'Does SiteStaffr write blog posts for my website?',
            'answer'   => 'Yes. SiteStaffr writes SEO blog posts grounded in your own business and services, from one post a month on the free trial up to eight on Pro. Each arrives ready to publish, with the SEO details handled and an optional featured image. Turn on Autopilot and it publishes on a schedule.',
        ),
        array(
            'group'    => 'What it does',
            /* ABSORBS THE SALESFORCE BAND removed from section 4. → docs/implementation-notes.md#absorbs-the-salesforce-band-removed-from-secti */
            'question' => 'Does SiteStaffr connect to my CRM?',
            'answer'   => 'SiteStaffr connects to Salesforce, so captured leads can flow straight into your existing pipeline. Every plan also emails you a full recap of each conversation, which is enough for most businesses without a CRM. If you use a different system, tell SiteStaffr which one and it will help you work out the options.',
        ),

        /* ---- Cost and commitment ---- */
        array(
            'group'    => 'Cost and commitment',
            'question' => 'Is there a free trial?',
            'answer'   => 'Yes. SiteStaffr is free for 30 days with no credit card required. The trial includes 30 minutes of voice time, unlimited AI text chat and one AI blog post. It ends after 30 days unless you choose a plan, and nothing is charged automatically.',
        ),
        array(
            'group'    => 'Cost and commitment',
            'question' => 'How much does SiteStaffr cost?',
            'answer'   => 'Plans are $29 a month for Starter, $69 for Business and $129 for Pro, after a free 30-day trial. Every plan includes unlimited AI text chat with no per-conversation fees, so only voice minutes change between them. Extra voice minutes are $20 for 60 and never expire.',
        ),
        array(
            'group'    => 'Cost and commitment',
            /* NEW. The cheapest trust available. */
            'question' => 'Can I cancel anytime?',
            'answer'   => 'Yes. SiteStaffr is month to month with no contract and no cancellation fee. You can cancel from your account at any time and keep access until the end of the period you have already paid for. Any add-on voice minutes you bought stay available and never expire.',
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

    <?php /* THE AudioObject SCHEMA WAS REMOVED HERE. → docs/implementation-notes.md#the-audioobject-schema-was-removed-here */ ?>

    <?php wp_head(); ?>
</head>
<body <?php body_class( 'sitestaffr-landing-page' ); ?>>
<?php wp_body_open(); ?>

<!-- ========== NAVIGATION ========== -->
<?php
/* "Voices" -> #voices went with the voice showcase. → docs/implementation-notes.md#hero-2 */
get_template_part( 'template-parts/site-nav', null, array(
    'secondary' => array(
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
        <?php /* The headline used to state the OUTCOME ("You Get the Lead") and never the CATEGORY, which left the… → docs/implementation-notes.md#hero-headline */ ?>
        <h1 class="hero__headline">
          <span class="hero__headline-prefix">Put an AI Receptionist</span>
          <span class="hero__headline-focus">on Your Website</span>
        </h1>
        <?php /* ⚠️ THE "ON A JOB, WITH A CLIENT, OR ASLEEP" ENDING IS GONE, AND THIS REVERSES A RULE THAT USED TO SIT… → docs/implementation-notes.md#the-on-a-job-with-a-client-or-asleep-ending-i */ ?>
        <?php /* ⚠️ "24/7" IS LOAD-BEARING AND IT IS NEW: "I'm not seeing anything that says 24/7 on the homepage or… → docs/implementation-notes.md#hero-subtitle */ ?>
        <p class="hero__subtitle">
          SiteStaffr answers your visitors 24/7 from your own pages. Set up in minutes, with nothing to write and nothing to train.
        </p>
        <span class="hero__no-cc">Free for 30 days &bull; No code required</span>
        <!-- Primary action is the self-serve trial, secondary is the white-glove form.
             .hero__download-link is a style hook only and no longer points at /download/;
             rename it when the CSS is next touched. -->
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
        /* The industry line anchors to #industries (section 6) rather than /for/ — it scrolls DOWN THE PAGE… → docs/implementation-notes.md#hero-industries */
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
        <?php /* FIVE THINGS IT DOES, IN THE PRESENT TENSE. → docs/implementation-notes.md#hero-float-cards */ ?>
        <div class="hero__float-cards">
          <span class="hero__float-card hero__float-card--chat"><span class="hero__float-emoji" aria-hidden="true">💬</span> Responds by text</span>
          <span class="hero__float-card hero__float-card--voice"><span class="hero__float-emoji" aria-hidden="true">🎙️</span> Answers by voice</span>
          <span class="hero__float-card hero__float-card--lead"><span class="hero__float-emoji" aria-hidden="true">✅</span> Captures the lead</span>
          <span class="hero__float-card hero__float-card--recap"><span class="hero__float-emoji" aria-hidden="true">✉️</span> Sends you the recap</span>
          <span class="hero__float-card hero__float-card--blog"><span class="hero__float-emoji" aria-hidden="true">✍️</span> Publishes blog posts</span>
        </div>
      </div>
    </div>
  </div>
  <?php /* THE OPENING CURTAIN MOVED OUT OF THE HERO ON and is now the first child of section 2 below, hanging… → docs/implementation-notes.md#the-opening-curtain-moved-out-of-the-hero-on-a */ ?>
</section>

<?php /* THE FIVE-CAPABILITY RIBBON WAS DELETED HERE. → docs/implementation-notes.md#the-five-capability-ribbon-was-deleted-here */ ?>

<!-- ========== SECTION 2: COST OF MISSED VISITORS ========== -->
<?php /* SECTION 2 — the first half of the dark block. → docs/implementation-notes.md#block */ ?>
<section class="block block--dark block-split cost-section">
  <?php /* ⚠️ THE HERO'S CURTAIN LIVES HERE, not in the hero — see the note at the end of the hero for why. → docs/implementation-notes.md#block-inner-3 */ ?>
  <?php get_template_part( 'template-parts/seam-curtain' ); ?>
  <div class="block__inner">
    <div class="block-split__grid cost-section__grid">
      <div class="cost-section__copy">
        <?php /* Eyebrow was "The Hidden Cost of Lost Website Visitors", and on the V2 branch "What One Job Is… → docs/implementation-notes.md#section-label-3 */ ?>
        <span class="section-label">The Shift Nobody Covers</span>
        <h2>Busy Owners Miss Website Leads and Often Never Know It</h2>

        <?php /* SETS UP THE AUDIT, and does not restate the hero. → docs/implementation-notes.md#cost-section-text-2 */ ?>
        <p class="cost-section__text">
          Your website is where most customers meet your business first, and it is usually working a shift you are not there for.
        </p>

        <?php /* The best copy on the site — do not rewrite it. → docs/implementation-notes.md#cost-section-text-3 */ ?>
        <p class="cost-section__text">
          When it cannot answer, nobody tells you. There is no missed call, no voicemail, nothing in your inbox. The visitor just goes back to the search results, and the job quietly happens somewhere else.
        </p>

        <?php /* CUT TO ONE LINE. This paragraph used to resolve the problem the section had just posed — "SiteStaffr is an… → docs/implementation-notes.md#cost-section-text */ ?>
        <p class="cost-section__text cost-section__handoff">That&rsquo;s the shift SiteStaffr covers.</p>
      </div>

      <?php /* 2x2, AND THE GRID SHAPE IS PART OF WHY THIS WORKS. → docs/implementation-notes.md#block-split-art-2 */ ?>
      <div class="block-split__art job-values">
        <ul class="job-values__grid">
<?php foreach ( $job_values as $jv ) : ?>
          <li class="job-value">
            <?php
            /* THE WATERMARK, and it is wrapped in its own clip layer rather than clipped by the card. → docs/implementation-notes.md#job-value-mark */
            ?>
            <span class="job-value__mark" aria-hidden="true" data-mark="<?php echo esc_attr( $jv['mark'] ); ?>"></span>

            <?php
            /* The sprite fallback from the V2 branch was dropped in this port, deliberately. → docs/implementation-notes.md#job-value-icon */
            ?>
            <img class="job-value__icon"
                 src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/icons/' . $jv['img'] . '.webp' ) ); ?>"
                 width="64" height="64" alt="" aria-hidden="true" decoding="async" loading="lazy">

            <?php
            /* SOURCE ON DEMAND, not in the card. → docs/implementation-notes.md#job-value-src */
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
            /* NO VISIBLE INDUSTRY LABEL. The icon carries it, and a wrench captioned "Auto repair" is a caption telling… → docs/implementation-notes.md#job-value-amount */
            ?>
            <span class="job-value__amount"><?php echo esc_html( $jv['amount'] ); ?></span>
            <span class="job-value__note"><?php echo esc_html( $jv['note'] ); ?></span>
          </li>
<?php endforeach; ?>
        </ul>
        <?php /* The price anchor was REMOVED here. → docs/implementation-notes.md#job-values-foot */ ?>
        <p class="job-values__foot">Real industry averages, each with its source &mdash; not estimates.</p>
      </div>
    </div>
  </div>
</section>


<!-- ========== HEAR IT WORK: AUDIO DEMO (relocated from hero) ========== -->
<?php /* SECTION 3 — the second half of the dark block. → docs/implementation-notes.md#block-2 */ ?>
<section class="block block--dark block--tight see-it" id="live-demo">
  <div class="block__inner">
    <div class="see-it__header">
      <span class="section-label">See It Answer</span>
      <h2>Hear a Visitor Talk to a Website</h2>
      <p class="see-it__subtitle">One types, one talks. Same AI, same answers.</p>
    </div>

    <?php
    /* THE AT-REST STAGE. WHY THE PANELS WERE BLANK IN THE FIRST PLACE, because it is not a bug and the fix must… → docs/implementation-notes.md#see-it-stage */
    ?>
    <div class="see-it__stage" data-see-it-stage hidden
         data-see-it-open-sound="<?php echo esc_url( sitestaffr_asset_url( 'assets/audio/open.mp3' ) ); ?>">
      <img class="see-it__stage-robot"
           src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/robot-voice.webp' ) ); ?>"
           alt="" aria-hidden="true" width="1080" height="1350" loading="lazy" decoding="async">
      <?php /* A real <button> with a real accessible name. → docs/implementation-notes.md#see-it-stage-play */ ?>
      <button class="see-it__stage-play" type="button" data-see-it-stage-play
              aria-label="Play the conversation">
        <?php /* ⚠️ THE TRIANGLE'S OWN COORDINATES DO THE CENTERING — there is no margin nudge on this icon and there… → docs/implementation-notes.md#see-it-stage-hint */ ?>
        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><polygon points="7,5 19,12 7,19"/></svg>
      </button>
      <p class="see-it__stage-hint">Watch a visitor get answered &mdash; and the lead land in your inbox.</p>
    </div>

    <div class="see-it__panels">
      <?php /* LEFT: the conversation. The two column labels do the arguing — "On your website" / "In your inbox" states… → docs/implementation-notes.md#see-it-col */ ?>
      <div class="see-it__col">
        <span class="see-it__col-label">On Your Website</span>

        <div class="see-it__panel see-it__panel--convo">
          <?php /* THE TOGGLE ATTACHES TO THE PANEL IT CONTROLS. → docs/implementation-notes.md#see-it-tabs */ ?>
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
            <?php /* RENDERED FULLY POPULATED IN PHP. → docs/implementation-notes.md#see-it-line */ ?>
            <p class="see-it__line see-it__line--ai"><span class="see-it__who">SiteStaffr</span>Copperleaf Pest Control &mdash; what are you seeing?</p>
            <p class="see-it__line see-it__line--visitor"><span class="see-it__who">Visitor</span>Ants all over the kitchen counter, started today.</p>
            <p class="see-it__line see-it__line--ai"><span class="see-it__who">SiteStaffr</span>That usually means a trail in from outside. Is it a house or an apartment?</p>
            <p class="see-it__line see-it__line--visitor"><span class="see-it__who">Visitor</span>A house, single story.</p>
            <p class="see-it__line see-it__line--ai"><span class="see-it__who">SiteStaffr</span>We can get someone out to look. What name should I put down?</p>
            <p class="see-it__line see-it__line--visitor"><span class="see-it__who">Visitor</span>Priya Raman.</p>
            <p class="see-it__line see-it__line--ai"><span class="see-it__who">SiteStaffr</span>Thanks Priya &mdash; best email or number to reach you?</p>
            <p class="see-it__line see-it__line--visitor"><span class="see-it__who">Visitor</span>priya.raman@example.com</p>
            <p class="see-it__line see-it__line--ai"><span class="see-it__who">SiteStaffr</span>Got it. Someone will follow up to arrange a visit.</p>
          </div>

          <?php /* The play button is the largest interactive element in the section, and the scrubber is the hero… → docs/implementation-notes.md#see-it-transport */ ?>
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

      <?php /* RIGHT: the recap. → docs/implementation-notes.md#see-it-col-2 */ ?>
      <div class="see-it__col">
        <span class="see-it__col-label">In Your Inbox</span>

        <div class="see-it__panel see-it__panel--recap" data-see-it-recap>
          <div class="see-it__recap-head">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 7 10 6 10-6"/></svg>
            Conversation Recap
          </div>

          <dl class="see-it__fields" data-see-it-fields>
            <?php /* ⚠️ NO FIXED SCHEMA. Label and value materialise together as a PAIR. → docs/implementation-notes.md#see-it-field */ ?>
            <div class="see-it__field"><dt>Reason for visit</dt><dd>Ants in the kitchen</dd></div>
            <div class="see-it__field"><dt>Property</dt><dd>Single-story house</dd></div>
            <div class="see-it__field"><dt>Name</dt><dd>Priya Raman</dd></div>
            <div class="see-it__field"><dt>Email</dt><dd>priya.raman@example.com</dd></div>
          </dl>

          <?php /* The summary and follow-up genuinely ARE generated after the conversation ends, so they arrive… → docs/implementation-notes.md#see-it-gen */ ?>
          <div class="see-it__gen" data-see-it-summary>
            <span class="see-it__gen-label">Summary</span>
            <p>Ant trail in the kitchen of a single-story house. Wants someone to come out.</p>
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

<?php /* SECTION 4 — Your morning. Light again; → docs/implementation-notes.md#block-3 */ ?>
<section class="block what-you-get" id="your-morning">
  <?php /* THE CURTAIN CLOSES HERE. Same path as the hero's, mirrored — the dark block that opened with a peak drawn up… → docs/implementation-notes.md#block-inner */ ?>
  <?php get_template_part( 'template-parts/seam-curtain', null, array( 'variant' => 'close' ) ); ?>
  <div class="block__inner">
    <div class="what-you-get__header">
      <span class="section-label">Your Morning</span>
      <?php /* The strongest heading on the page. Do not rewrite it. */ ?>
      <h2>You Were Asleep. Your Website Wasn&rsquo;t.</h2>
      <?php /* THE SUBTITLE IS LOAD-BEARING and was cut once before for looking like filler. → docs/implementation-notes.md#what-you-get-subtitle */ ?>
      <p class="what-you-get__subtitle">
        Each of these was answered within seconds and sent to you the moment it ended. Nothing waited for opening time.
      </p>
    </div>

    <?php
    /* THE INBOX IS THE EVIDENCE, AND IT IS WHERE THE CLOCK IDEA LANDS. → docs/implementation-notes.md#the-inbox-is-the-evidence-and-it-is-where-the */
    ?>
    <?php
    /* THE THREE LEADS, AND THE DOCUMENT BEHIND EACH ONE. → docs/implementation-notes.md#morning-leads */
    $morning_leads = array(
      array(
        'id'      => 'tom-byrne',
        'time'    => '6:03 AM',
        'who'     => 'Tom Byrne',
        'what'    => 'Gluten-free cupcakes, 40 for Friday',
        'stamp'   => 'March 27, 2026 6:03 AM EDT',
        'length'  => '1:55',
        'recap'   => '<strong>Tom</strong> asked whether Maggie&rsquo;s Cakes do gluten-free cupcakes, was given the range and the separate-prep-area detail, and then placed an order enquiry for about 40 of them for Friday.',
        'fields'  => array(
          array( 'label' => 'Name',               'value' => 'Tom Byrne' ),
          array( 'label' => 'Phone',              'value' => '(216) 555-0176', 'tel' => '+12165550176' ),
          array( 'label' => 'Reason for contact', 'value' => 'Gluten-free cupcake order, 40 for Friday' ),
        ),
        'followup' => 'Call Tom to confirm the flavors, pickup time and pricing for 40 gluten-free cupcakes.',
        'turns'   => array(
          array( 'who' => 'ai',      'at' => '6:03:04 AM', 'text' => 'Hi! Thanks for reaching out to Maggie&rsquo;s Cakes. How can I help you today?' ),
          array( 'who' => 'visitor', 'at' => '6:03:21 AM', 'text' => 'Do you do gluten-free cupcakes?' ),
          array( 'who' => 'ai',      'at' => '6:03:24 AM', 'text' => 'We do. Our gluten-free range is baked with a rice and almond flour blend in a separate prep area to avoid cross-contact, and it comes in vanilla bean, double chocolate and lemon poppy seed. They&rsquo;re sold by the dozen. Would you like more detail, or are you looking to place an order?' ),
          array( 'who' => 'visitor', 'at' => '6:03:52 AM', 'text' => 'I&rsquo;d like to order &mdash; about 40 for Friday.' ),
          array( 'who' => 'ai',      'at' => '6:03:55 AM', 'text' => 'Happy to pass that on. Forty needs a couple of days&rsquo; notice, so Friday works. May I have your name?' ),
          array( 'who' => 'visitor', 'at' => '6:04:24 AM', 'text' => 'Tom Byrne.' ),
          array( 'who' => 'ai',      'at' => '6:04:27 AM', 'text' => 'Thanks Tom. What&rsquo;s the best number for our team to reach you at?' ),
          array( 'who' => 'visitor', 'at' => '6:04:56 AM', 'text' => '(216) 555-0176.' ),
          array( 'who' => 'ai',      'at' => '6:04:59 AM', 'text' => 'Got it. I&rsquo;ve passed along your request for 40 gluten-free cupcakes for Friday, and someone from the team will be in touch to confirm the flavors and pickup time. Is there anything else I can assist you with?' ),
        ),
      ),
      array(
        'id'      => 'sarah-mitchell',
        'time'    => '2:14 AM',
        'who'     => 'Sarah Mitchell',
        'what'    => 'Two-tier unicorn cake, 25 guests, April 12',
        'stamp'   => 'March 27, 2026 2:14 AM EDT',
        'length'  => '2:09',
        /* Carried over from V1's document, which used this exact lead. */
        'recap'   => '<strong>Sarah</strong> reached out to inquire about ordering a custom birthday cake for her daughter&rsquo;s 7th birthday party. She&rsquo;s looking for a two-tier unicorn theme cake for 25 guests.',
        'fields'  => array(
          array( 'label' => 'Name',               'value' => 'Sarah Mitchell' ),
          array( 'label' => 'Phone',              'value' => '(216) 555-0123', 'tel' => '+12165550123' ),
          array( 'label' => 'Reason for contact', 'value' => 'Custom birthday cake order inquiry' ),
        ),
        'followup' => 'Call Sarah back to confirm cake design details, discuss pricing for a two-tier unicorn cake, and schedule the pickup date for April 12th.',
        'turns'   => array(
          array( 'who' => 'ai',      'at' => '2:14:03 AM', 'text' => 'Hi! Thanks for reaching out to Maggie&rsquo;s Cakes. How can I help you today?' ),
          array( 'who' => 'visitor', 'at' => '2:14:10 AM', 'text' => 'Hi! I need to order a birthday cake for my daughter. She&rsquo;s turning 7 and wants a unicorn theme.' ),
          array( 'who' => 'ai',      'at' => '2:14:13 AM', 'text' => 'That sounds wonderful. Themed cakes are one of our specialties, and unicorn is among the designs we&rsquo;re asked for most &mdash; hand-piped mane, fondant horn and ears. Two tiers is the usual choice once you&rsquo;re over about 20 guests. Would you like to hear more about sizes and flavors, or shall I take your details so the team can quote it?' ),
          array( 'who' => 'visitor', 'at' => '2:14:52 AM', 'text' => 'Take my details please. It&rsquo;s for 25 guests, on April 12.' ),
          array( 'who' => 'ai',      'at' => '2:14:55 AM', 'text' => 'Perfect. May I have your name?' ),
          array( 'who' => 'visitor', 'at' => '2:15:19 AM', 'text' => 'Sarah Mitchell.' ),
          array( 'who' => 'ai',      'at' => '2:15:22 AM', 'text' => 'Thanks Sarah. What&rsquo;s the best number for our team to reach you at?' ),
          array( 'who' => 'visitor', 'at' => '2:15:48 AM', 'text' => '555-0123.' ),
          array( 'who' => 'ai',      'at' => '2:15:51 AM', 'text' => 'That&rsquo;s seven digits &mdash; could I get the area code as well?' ),
          array( 'who' => 'visitor', 'at' => '2:16:09 AM', 'text' => 'Sorry, 216.' ),
          array( 'who' => 'ai',      'at' => '2:16:12 AM', 'text' => 'Got it &mdash; a two-tier unicorn cake for 25 guests on April 12. I&rsquo;ve passed that to the team and someone will be in touch with designs and pricing. Is there anything else I can assist you with?' ),
        ),
      ),
      array(
        'id'      => 'camila-reyes',
        'time'    => '11:47 PM',
        'who'     => 'Camila Reyes',
        'what'    => 'Wedding tasting &mdash; are you open Sundays?',
        'stamp'   => 'March 26, 2026 11:47 PM EDT',
        'length'  => '1:50',
        'recap'   => '<strong>Camila</strong> is getting married in September and asked about booking a wedding cake tasting, specifically whether Sundays are possible. Availability was not answered on the chat &mdash; the question was passed to the team.',
        'fields'  => array(
          array( 'label' => 'Name',               'value' => 'Camila Reyes' ),
          array( 'label' => 'Email',              'value' => 'camila.reyes@example.com', 'mail' => 'camila.reyes@example.com' ),
          array( 'label' => 'Reason for contact', 'value' => 'Wedding cake tasting, September wedding' ),
        ),
        'followup' => 'Email Camila about Sunday tasting availability for a late-September wedding.',
        'turns'   => array(
          array( 'who' => 'ai',      'at' => '11:47:02 PM', 'text' => 'Hi! Thanks for reaching out to Maggie&rsquo;s Cakes. How can I help you today?' ),
          array( 'who' => 'visitor', 'at' => '11:47:29 PM', 'text' => 'We&rsquo;re getting married in September and wanted to book a tasting. Are you open Sundays?' ),
          array( 'who' => 'ai',      'at' => '11:47:32 PM', 'text' => 'Congratulations! We do run wedding tastings &mdash; they take about an hour and cover three cake tiers plus fillings, and they&rsquo;re free when you go on to book. I don&rsquo;t have the tasting calendar to hand, so I can&rsquo;t say about Sundays, but I can take a message so the team can come back to you on availability. May I have your name?' ),
          array( 'who' => 'visitor', 'at' => '11:48:14 PM', 'text' => 'Camila Reyes.' ),
          array( 'who' => 'ai',      'at' => '11:48:17 PM', 'text' => 'Thanks Camila. What&rsquo;s the best number for our team to reach you at?' ),
          array( 'who' => 'visitor', 'at' => '11:48:49 PM', 'text' => 'Email is easier &mdash; camila.reyes@example.com' ),
          array( 'who' => 'ai',      'at' => '11:48:52 PM', 'text' => 'Got it. I&rsquo;ve passed along your question about Sunday tastings for a September wedding, and someone from the team will follow up by email. Is there anything else I can assist you with?' ),
        ),
      ),
    );
    ?>
    <div class="morning-inbox">
      <div class="morning-inbox__chrome">
        <span class="morning-inbox__label">Overnight &mdash; Maggie&rsquo;s Cakes</span>
        <span class="morning-inbox__count"><?php echo count( $morning_leads ); ?> new leads</span>
      </div>
      <ul class="morning-inbox__list">
        <?php foreach ( $morning_leads as $ml ) : ?>
        <li class="morning-inbox__item">
          <?php /* A REAL <button>, not a click handler on the <li>. → docs/implementation-notes.md#morning-inbox-row-3 */ ?>
          <?php /* ⚠️ NO aria-label ON THIS BUTTON, and that is a fix rather than an omission. → docs/implementation-notes.md#morning-inbox-row */ ?>
          <button type="button" class="morning-inbox__row"
                  data-morning-open="<?php echo esc_attr( $ml['id'] ); ?>">
            <span class="morning-inbox__time"><?php echo esc_html( $ml['time'] ); ?></span>
            <span class="morning-inbox__who"><?php echo esc_html( $ml['who'] ); ?></span>
            <span class="morning-inbox__what"><?php echo wp_kses_post( $ml['what'] ); ?></span>
            <span class="morning-inbox__tag">Lead captured</span>
            <span class="screen-reader-text">&mdash; open the recap</span>
            <?php /* No "View recap →" span here any more. → docs/implementation-notes.md#recap-doc-2 */ ?>
          </button>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <?php
    /* THE DOCUMENTS. Rendered server-side, one <dialog> each, hidden until opened. → docs/implementation-notes.md#recap-doc */
    ?>
    <?php foreach ( $morning_leads as $ml ) : ?>
    <dialog class="recap-doc" id="recap-<?php echo esc_attr( $ml['id'] ); ?>"
            aria-labelledby="recap-<?php echo esc_attr( $ml['id'] ); ?>-title">
      <div class="recap-doc__sheet">
        <div class="recap-doc__bar">
          <img class="recap-doc__logo"
               src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/logo-240.webp' ) ); ?>"
               alt="SiteStaffr" width="240" height="72" loading="lazy" decoding="async">
          <?php /* V1's teal "Print / Download PDF" pill. → docs/implementation-notes.md#recap-doc-print */ ?>
          <span class="recap-doc__print" aria-hidden="true">Print / Download PDF</span>
          <button type="button" class="recap-doc__close" data-morning-close aria-label="Close recap">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M18 6 6 18M6 6l12 12"/></svg>
          </button>
        </div>

        <div class="recap-doc__body">
          <p class="recap-doc__business" id="recap-<?php echo esc_attr( $ml['id'] ); ?>-title">Maggie&rsquo;s Cakes</p>

          <section class="recap-doc__section">
            <div class="recap-doc__section-head">
              <strong>Conversation Recap</strong>
              <span><?php echo esc_html( $ml['stamp'] ); ?></span>
            </div>
            <p><?php echo wp_kses_post( $ml['recap'] ); ?></p>
            <ul class="recap-doc__fields">
              <?php foreach ( $ml['fields'] as $f ) : ?>
                <li>
                  <span class="recap-doc__field-label"><?php echo esc_html( $f['label'] ); ?>:</span>
                  <?php if ( ! empty( $f['tel'] ) ) : ?>
                    <a href="tel:<?php echo esc_attr( $f['tel'] ); ?>"><?php echo esc_html( $f['value'] ); ?></a>
                  <?php elseif ( ! empty( $f['mail'] ) ) : ?>
                    <a href="mailto:<?php echo esc_attr( $f['mail'] ); ?>"><?php echo esc_html( $f['value'] ); ?></a>
                  <?php else : ?>
                    <?php echo esc_html( $f['value'] ); ?>
                  <?php endif; ?>
                </li>
              <?php endforeach; ?>
            </ul>
            <p class="recap-doc__followup"><strong>Suggested follow-up:</strong> <?php echo esc_html( $ml['followup'] ); ?></p>
          </section>

          <section class="recap-doc__section">
            <div class="recap-doc__section-head">
              <strong>Conversation Transcript</strong>
              <span><?php echo esc_html( $ml['length'] ); ?></span>
            </div>
            <div class="recap-doc__messages">
              <?php foreach ( $ml['turns'] as $t ) : ?>
                <?php if ( 'ai' === $t['who'] ) : ?>
                  <?php /* ⚠️ "SiteStaffr", NOT "AI". The website is deliberately AHEAD of the product here: the plugin UI and the emailed… → docs/implementation-notes.md#recap-doc-msg */ ?>
                  <div class="recap-doc__msg recap-doc__msg--ai">
                    <div class="recap-doc__msg-meta"><strong>SiteStaffr</strong> <?php echo esc_html( $t['at'] ); ?></div>
                    <p><?php echo wp_kses_post( $t['text'] ); ?></p>
                  </div>
                <?php else : ?>
                  <div class="recap-doc__msg recap-doc__msg--visitor">
                    <span class="recap-doc__avatar" aria-hidden="true">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v2h20v-2c0-3.3-6.7-5-10-5z"/></svg>
                    </span>
                    <div class="recap-doc__msg-body">
                      <div class="recap-doc__msg-meta"><strong>Visitor</strong> <?php echo esc_html( $t['at'] ); ?></div>
                      <p><?php echo wp_kses_post( $t['text'] ); ?></p>
                    </div>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>
          </section>
        </div>
      </div>
    </dialog>
    <?php endforeach; ?>

    <?php /* THE FOUR CALLOUTS BECOME A CARDS ROW UNDER THE INBOX. → docs/implementation-notes.md#block-cards-grid */ ?>
    <div class="block-cards__grid what-you-get__callouts" style="--cards: 2;">
      <div class="what-you-get__callout">
        <div class="what-you-get__callout-icon" aria-hidden="true">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
        </div>
        <h3 class="what-you-get__callout-title">Sent in Seconds</h3>
        <p class="what-you-get__callout-desc">It reaches your inbox while the visitor is still on your site.</p>
      </div>
      <?php /* KEEP THIS ONE INTACT. Nothing else on the page says that conversations which did NOT turn into a lead are… → docs/implementation-notes.md#what-you-get-callout-2 */ ?>
      <div class="what-you-get__callout">
        <div class="what-you-get__callout-icon" aria-hidden="true">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        </div>
        <h3 class="what-you-get__callout-title">Every Conversation</h3>
        <p class="what-you-get__callout-desc">Voice and text alike, whether or not it turned into a lead.</p>
      </div>
      <div class="what-you-get__callout">
        <div class="what-you-get__callout-icon" aria-hidden="true">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 7h3a5 5 0 0 1 5 5 5 5 0 0 1-5 5h-3m-6 0H6a5 5 0 0 1-5-5 5 5 0 0 1 5-5h3"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
        </div>
        <h3 class="what-you-get__callout-title">One Link to Share</h3>
        <p class="what-you-get__callout-desc">Send the whole thing to whoever is doing the job.</p>
      </div>
      <?php /* ⚠️ THIRD WORDING, and the two it replaced both failed in the same place — the TITLE, not the description. → docs/implementation-notes.md#what-you-get-callout */ ?>
      <div class="what-you-get__callout">
        <div class="what-you-get__callout-icon" aria-hidden="true">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></svg>
        </div>
        <h3 class="what-you-get__callout-title">Nothing to Log Into</h3>
        <p class="what-you-get__callout-desc">It arrives in the inbox you already use. The dashboard is there when you want it.</p>
      </div>
    </div>

    <?php /* THE SALESFORCE BAND MOVED OUT, to the FAQ in section 9. → docs/implementation-notes.md#the-salesforce-band-moved-out-to-the-faq-in-se */ ?>
  </div>
</section>

<!-- ========== SECTION 5: SPEAKS THEIR LANGUAGE ========== -->
<?php
/* SECTION 5 — Speaks their language. → docs/implementation-notes.md#lang-greetings */
$lang_greetings = array(
	array( 'code' => 'es',    'name' => 'Spanish',    'hello' => '¡Hola!' ),
	array( 'code' => 'zh',    'name' => 'Mandarin',   'hello' => '你好' ),
	array( 'code' => 'fr',    'name' => 'French',     'hello' => 'Bonjour' ),
	array( 'code' => 'ar',    'name' => 'Arabic',     'hello' => 'مرحبا', 'rtl' => true ),
	array( 'code' => 'hi',    'name' => 'Hindi',      'hello' => 'नमस्ते' ),
	array( 'code' => 'pt',    'name' => 'Portuguese', 'hello' => 'Olá' ),
	array( 'code' => 'de',    'name' => 'German',     'hello' => 'Hallo' ),
	array( 'code' => 'ja',    'name' => 'Japanese',   'hello' => 'こんにちは' ),
	array( 'code' => 'ko',    'name' => 'Korean',     'hello' => '안녕하세요' ),
	array( 'code' => 'ru',    'name' => 'Russian',    'hello' => 'Привет' ),
	array( 'code' => 'vi',    'name' => 'Vietnamese', 'hello' => 'Xin chào' ),
	array( 'code' => 'it',    'name' => 'Italian',    'hello' => 'Ciao' ),
);
?>
<section class="block lang-section" id="languages">
  <div class="block__inner">
    <div class="lang-section__header">
      <?php /* ⚠️ THE EYEBROW, THE HEADING AND THE SUBTITLE ALL SAID THE SAME SENTENCE. → docs/implementation-notes.md#section-label */ ?>
      <span class="section-label">No Language Barrier</span>
      <h2>SiteStaffr Speaks <em>Their</em> Language</h2>
      <?php /* ⚠️ THIS LINE TOOK TWO GOES AND BOTH FAILURES WERE THE SAME ONE. → docs/implementation-notes.md#lang-section-text */ ?>
      <p class="lang-section__text">
        Your visitors speak 57+ languages. SiteStaffr answers in all of them, with nothing for you to set up.
      </p>
    </div>

    <?php
    /* THE STAGE. The robot is in the FLOW and the greetings are absolute around it, which is the opposite of how… → docs/implementation-notes.md#the-stage */
    ?>
    <?php
    /* THE HAZE — more languages, receding behind the robot. → docs/implementation-notes.md#lang-haze */
    $lang_haze = array(
      array( 'Hej',      12,  22, 2.6, -14, 0.055 ),
      array( 'Merhaba',  30,  14, 2.1, -8,  0.05  ),
      array( 'Cześć',    52,  20, 1.7, -5,  0.042 ),
      array( 'Shalom',   72,  16, 2.3, 10,  0.05  ),
      array( 'Habari',   86,  30, 1.9, 6,   0.045 ),
      array( 'Γεια',     20,  40, 1.5, -4,  0.04  ),
      array( 'Ahoj',     64,  44, 1.4, 5,   0.038 ),
      array( 'Tere',     40,  55, 1.4, -3,  0.038 ),
      array( 'Halo',     10,  62, 2.0, 9,   0.048 ),
      array( 'Kamusta',  34,  74, 2.2, 7,   0.05  ),
      array( 'Sveiki',   56,  80, 1.8, -6,  0.044 ),
      array( 'Bok',      76,  70, 2.5, -11, 0.055 ),
      array( 'Salam',    88,  58, 2.0, 4,   0.045 ),
      array( 'Dobrý den', 4,  36, 1.6, -6,  0.04  ),
    );
    ?>
    <div class="lang-orbit">
      <div class="lang-orbit__haze" aria-hidden="true">
        <?php foreach ( $lang_haze as $h ) : ?>
          <span style="top:<?php echo (float) $h[1]; ?>%;left:<?php echo (float) $h[2]; ?>%;font-size:<?php echo (float) $h[3]; ?>rem;--rot:<?php echo (float) $h[4]; ?>deg;opacity:<?php echo (float) $h[5]; ?>;"><?php echo esc_html( $h[0] ); ?></span>
        <?php endforeach; ?>
      </div>
      <img class="lang-orbit__robot"
           src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/robot-languages.webp' ) ); ?>"
           alt="" aria-hidden="true"
           width="1122" height="1383" loading="lazy" decoding="async">

      <?php
      /* ⚠️ `lang` ON EVERY GREETING AND `dir="rtl"` ON THE ARABIC — carried over from the previous design,… → docs/implementation-notes.md#lang-orbit-list */
      ?>
      <ul class="lang-orbit__list">
        <?php foreach ( $lang_greetings as $i => $g ) : ?>
          <li class="lang-orbit__item lang-orbit__item--<?php echo (int) ( $i + 1 ); ?>">
            <span class="lang-orbit__hello"
                  lang="<?php echo esc_attr( $g['code'] ); ?>"
                  <?php echo ! empty( $g['rtl'] ) ? 'dir="rtl"' : ''; ?>><?php echo esc_html( $g['hello'] ); ?></span>
            <span class="screen-reader-text"><?php echo esc_html( $g['name'] ); ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <?php /* KEPT, and moved under the stage where it closes the section. → docs/implementation-notes.md#lang-section-english-2 */ ?>
    <p class="lang-section__english">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6 9 17l-5-5"/></svg>
      Every recap arrives in English, ready for you.
    </p>
  </div>
</section>

<?php
/* SECTION 6 — Who this is for. The most-reworked section, and the one that motivated this review. → docs/implementation-notes.md#ind-groups */
$ind_groups = sitestaffr_industry_registry();
$ind_flat   = sitestaffr_industry_list();

/* WHICH INDUSTRY OPENS THE SECTION IS RANDOM. → docs/implementation-notes.md#ind-first */
$ind_first  = ! empty( $ind_flat ) ? $ind_flat[ array_rand( $ind_flat ) ] : null;
?>
<?php /* ⚠️ NOT A block-split ANY MORE. It was image-left / list-right. → docs/implementation-notes.md#block-4 */ ?>
<section class="block industries" id="industries">
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

    <?php /* ROW 1 — the isometric and its excerpt, side by side. → docs/implementation-notes.md#industries-stage-2 */ ?>
    <div class="industries__stage">
      <div class="industries__art">
        <?php foreach ( $ind_flat as $i => $ind ) :
            $art = sitestaffr_industry_art_url( $ind['slug'] );
            /* ⚠️ A MISSING RENDER MUST NOT PRODUCE A BROKEN IMAGE. → docs/implementation-notes.md#ind-is-open-2 */
            ?>
          <?php /* ⚠️ ACTIVE IS $ind_first, NOT INDEX 0. → docs/implementation-notes.md#ind-is-open */ ?>
          <?php $ind_is_open = ( $ind_first && $ind['slug'] === $ind_first['slug'] ); ?>
          <div class="industries__panel<?php echo $ind_is_open ? ' is-active' : ''; ?>"
               data-ind-panel="<?php echo esc_attr( $ind['slug'] ); ?>"
               <?php echo $ind_is_open ? '' : 'aria-hidden="true"'; ?>>
            <?php if ( $art ) : ?>
              <img src="<?php echo esc_url( $art ); ?>"
                   alt=""
                   width="1024" height="1024"
                   <?php /* The eagerly-fetched one is whichever is actually visible. */ ?>
                   <?php echo $ind_is_open ? 'fetchpriority="high"' : 'loading="lazy"'; ?>
                   decoding="async">
            <?php else : ?>
              <span class="industries__panel-fallback" aria-hidden="true"><?php echo esc_html( $ind['icon'] ); ?></span>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>

      </div>

      <?php /* The excerpt is now a SIBLING of the art, not a child of it — that is what puts it beside the… → docs/implementation-notes.md#industries-excerpt-2 */ ?>
      <div class="industries__excerpt" data-ind-excerpt>
          <?php foreach ( $ind_flat as $i => $ind ) : ?>
            <div class="industries__excerpt-item<?php echo ( $ind_first && $ind['slug'] === $ind_first['slug'] ) ? ' is-active' : ''; ?>"
                 data-ind-excerpt-for="<?php echo esc_attr( $ind['slug'] ); ?>">
              <h3><?php echo esc_html( $ind['title'] ); ?></h3>
              <p><?php echo esc_html( $ind['blurb'] ); ?></p>
              <?php /* ONE link, at the end, NEW TAB, with per-industry text rather than a generic "learn more" — per… → docs/implementation-notes.md#industries-link-2 */ ?>
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

      <?php /* LIST RIGHT. Group headings RETURN, and that correctly reverses a recorded decision. → docs/implementation-notes.md#industries-list */ ?>
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

                  <?php /* THE MOBILE EXPANSION. Rendered for every industry and hidden by CSS at desktop widths, so with no JS at all… → docs/implementation-notes.md#industries-mobile-detail */ ?>
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
</section>

<!-- ========== SECTION 7: SOCIAL PROOF ========== -->
<?php
/* SECTION 7 — social proof. THE V2 ARRANGEMENT, IN V3's PALETTE. → docs/implementation-notes.md#block-5 */
?>
<section class="block block-split proof-section" id="proof">
  <div class="block__inner">
    <div class="block-split__grid proof-section__grid">

      <div class="proof-section__evidence">
        <div class="proof-section__header">
          <span class="section-label">Customer Results</span>
          <h2>What One Month Looked Like at <em>Synergy Scribes</em></h2>
        </div>

        <?php
        /* TWO LEAD NUMBERS, NOT ONE. They answer different questions, and together they close the page's argument: 86%… → docs/implementation-notes.md#proof-section-lead-pair */
        ?>
        <div class="proof-section__lead-pair">
          <div class="proof-section__lead-stat">
            <?php /* "after business hours", not "after they closed". → docs/implementation-notes.md#proof-section-lead-number-2 */ ?>
            <span class="proof-section__lead-number">86%</span>
            <span class="proof-section__lead-label">of their conversations arrived <strong>after business hours</strong></span>
          </div>
          <div class="proof-section__lead-stat">
            <?php /* ⚠️ "23 qualified leads / out of 72 conversations" RESOLVES A REAL AMBIGUITY, which is why the… → docs/implementation-notes.md#proof-section-lead-number */ ?>
            <span class="proof-section__lead-number">23</span>
            <span class="proof-section__lead-label"><strong>qualified leads</strong> <span class="proof-section__lead-sub">out of <strong>72</strong> conversations</span></span>
          </div>
        </div>

        <?php
        /* ⚠️ NOT A FOOTNOTE TO MINIMIZE. "One customer's results, not an average" buys more credibility than the two… → docs/implementation-notes.md#proof-section-stats-source */
        ?>
        <p class="proof-section__stats-source">Measured at <a href="https://synergyscribes.com" target="_blank" rel="noopener noreferrer">Synergy Scribes</a>, 1 June &ndash; 1 July 2026. One customer&rsquo;s results, not an average.</p>
      </div>

      <?php
      /* The quote CORROBORATES the number rather than introducing it, so it sits beside and reads quieter. → docs/implementation-notes.md#block-split-art-3 */
      ?>
      <figure class="block-split__art proof-section__quote-block">
        <span class="proof-section__quote-plate" aria-hidden="true"></span>
        <?php
        /* AN INNER WRAPPER, for exactly one reason: the panel is taller than its contents. → docs/implementation-notes.md#proof-section-quote-inner */
        ?>
        <div class="proof-section__quote-inner">
          <blockquote class="proof-section__quote">
            <p>We staff medical scribes across multiple clinics, and after hours is when most new facility inquiries come in. <strong>SiteStaffr</strong> captured a full intake request at 9 PM on a Sunday, with the clinic name, number of scribes needed, and start date. Monday morning it was sitting in our inbox, ready to go.</p>
          </blockquote>
          <?php
          /* THE PORTRAIT SITS WITH THE NAME, not beside the quote. → docs/implementation-notes.md#proof-section-cite */
          ?>
          <figcaption class="proof-section__cite">
            <span class="proof-section__portrait">
              <img src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/synergy-scribes__ceo-portrait.webp' ) ); ?>" alt="Nathaly Martinez, CEO of Synergy Scribes" width="320" height="400" loading="lazy" decoding="async">
            </span>
            <span class="proof-section__cite-text">
              <span class="proof-section__author">Nathaly Martinez <span class="proof-section__divider">|</span> <span class="proof-section__role">CEO &amp; Founder</span></span>
              <a class="proof-section__company" href="https://synergyscribes.com" target="_blank" rel="noopener noreferrer">Synergy Scribes</a>
            </span>
          </figcaption>
        </div>
      </figure>

    </div>
  </div>
</section>


<?php
/* THE VOICE SHOWCASE WAS DELETED HERE, RESTORING A DECISION THAT HAD ALREADY BEEN MADE. → docs/implementation-notes.md#block-6 */
?>

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
      <?php /* ⚠️ THE MIDDLE SENTENCE RESTATED THE HEADING. → docs/implementation-notes.md#pricing-section-subtitle */ ?>
      <p class="pricing-section__subtitle">Start free for 30 days, no credit card. Only voice minutes change between plans.</p>
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
          /* Blog Agent is otherwise invisible on the homepage, and a features section for it would break the… → docs/implementation-notes.md#price-includes-label */
          ?>
          <span class="price-includes__label"><a class="price-includes__link" href="<?php echo esc_url( home_url( '/blog-agent/' ) ); ?>" target="_blank" rel="noopener">AI blog posts every month<span class="screen-reader-text"> (opens in a new tab)</span></a></span>
        </div>
        <?php
        /* SIXTH INCLUSION, AND THE COUNT IS THE POINT. → docs/implementation-notes.md#price-includes-item */
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
        /* THE /features/ LINK LIVES HERE NOW, not in a reassurance block at the foot of the section. → docs/implementation-notes.md#price-includes-footer */
        ?>
        <p class="price-includes__footer">
          New to any of this? <a class="price-includes__link" href="<?php echo esc_url( home_url( '/features/' ) ); ?>" target="_blank" rel="noopener">See what every feature actually does<span class="screen-reader-text"> (opens in a new tab)</span></a>, in plain English.
        </p>
      </div>
    </div>
    <?php
    /* The paid ladder is three tiers, so the grid is three columns and the free trial is not a fourth… → docs/implementation-notes.md#the-paid-ladder-is-three-tiers-so-the-grid-is */
    ?>
    <?php /* THE TRIAL STRIP THAT SAT HERE IS GONE - the trial is the table's first column now (see… → docs/implementation-notes.md#the-trial-strip-that-sat-here-is-gone-the-tria */ ?>

    <?php
    /* ONE LABEL COLUMN, NOT THREE. He was right and I had talked myself out of it when this table was first built:… → docs/implementation-notes.md#price-grid */
    ?>
    <div class="price-grid price-grid--table">
      <?php
      /* aria-hidden, and that is deliberate rather than lazy. → docs/implementation-notes.md#price-grid-labels */
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
      <?php /* THE TRIAL IS A COLUMN NOW, NOT A STRIP. → docs/implementation-notes.md#price-tier */ ?>
      <div class="price-tier price-tier--trial">
        <div class="price-tier__identity">
          <div class="price-tier__name">Free Trial</div>
          <div class="price-tier__price">$0</div>
          <div class="price-tier__period">for 30 days</div>
        </div>
        <div class="price-tier__row price-tier__row--lead">
          <span class="price-tier__row-label">Voice minutes</span>
          <span class="price-tier__row-value">30</span>
        </div>
        <div class="price-tier__row">
          <span class="price-tier__row-label">Blog post</span>
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
<?php /* "Ends after 30 days unless you pick a plan" removed: obvious from "$0 / for 30 days" directly… → docs/implementation-notes.md#price-tier-best-for */ ?>
          <p class="price-tier__best-for">No credit card required</p>
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
          <span class="price-tier__row-value">100</span>
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
          <span class="price-tier__row-value">300</span>
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
          <span class="price-tier__row-value">600</span>
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
      /* THE RAIL'S STUB HEAD, and it earns its place by fixing a real imbalance rather than by labeling… → docs/implementation-notes.md#the-rail-s-stub-head-and-it-earns-its-place-by */
      ?>
    </div>
    <?php
    /* THE ADD-ON FACT, AS A FOOTNOTE TO THE TABLE RATHER THAN A BLOCK UNDER IT. → docs/implementation-notes.md#price-footnote */
    ?>
    <p class="price-footnote">
      Run out of voice minutes? Add <strong>60 minutes for $20</strong> anytime. They roll over, never expire, and there are no automatic overage charges.
    </p>
  </div>
</section>

<!-- ========== SECTION 9: FAQ ========== -->
<?php
/* SECTION 9 — the FAQ. ⚠️ TWO COLUMNS NOW, WHICH REVERSES A RECORDED DECISION. → docs/implementation-notes.md#faq-grouped */

/* Group the flat list, then deal the groups into two columns. → docs/implementation-notes.md#block-12 */
$faq_grouped = array();
foreach ( $faq_items as $faq_i => $faq ) {
	$faq_grouped[ $faq['group'] ][] = array( 'i' => $faq_i, 'item' => $faq );
}
$faq_group_names = array_keys( $faq_grouped );
$faq_columns     = array_chunk( $faq_group_names, 2 );
?>
<section class="block faq-section" id="faq">
  <div class="block__inner">
    <div class="faq-section__head">
      <span class="section-label">Common Questions</span>
      <h2>Frequently Asked Questions</h2>
      <p class="faq-section__subtitle">The things people ask before they install it.</p>
    </div>

    <div class="faq-section__columns">
      <?php foreach ( $faq_columns as $faq_col ) : ?>
        <div class="faq-list">
          <?php foreach ( $faq_col as $faq_group ) : ?>
            <h3 class="faq-list__group"><?php echo esc_html( $faq_group ); ?></h3>
            <?php /* ⚠️ THIS WRAPPER EXISTS ONLY SO THE GROUP CAN BE A CARD BELOW 900px. → docs/implementation-notes.md#faq-list-set-3 */ ?>
            <div class="faq-list__set">
            <?php foreach ( $faq_grouped[ $faq_group ] as $entry ) :
                $faq = $entry['item'];
                /* ⚠️ NOTHING SHIPS OPEN. The first question used to, on the reasoning that it showed a reader what an answer… → docs/implementation-notes.md#faq-item */
                ?>
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
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    </div>

    <?php /* AFTER the questions, not before them. → docs/implementation-notes.md#faq-section-ask-2 */ ?>
    <div class="faq-section__ask">
      <?php /* The texting robot, not the language one or the hero one: this card is about asking a question in… → docs/implementation-notes.md#faq-section-ask-robot-2 */ ?>
      <img class="faq-section__ask-robot"
           src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/robot-text.webp' ) ); ?>"
           alt="" aria-hidden="true" width="1080" height="1350" loading="lazy" decoding="async">
      <div class="faq-section__ask-copy">
        <p class="faq-section__ask-lead">Still have a question?</p>
        <?php /* ⚠️ THERE IS NO SUPPORTING LINE HERE, AND THAT IS THE FOURTH AND FINAL ANSWER. → docs/implementation-notes.md#btn */ ?>
        <?php
        /* ⚠️ A REAL [sitestaffr_button], REPLACING A BUTTON THAT DID NOTHING. → docs/implementation-notes.md#a-real-sitestaffr-button-replacing-a-button-t */
        echo do_shortcode( '[sitestaffr_button text="Ask Our AI Assistant" icon="sitestaffr"]' );
        ?>
      </div>
    </div>
  </div>

</section>

<?php /* SECTION 10 — the agency door. The one section that did not exist in any form. → docs/implementation-notes.md#block-7 */ ?>
<section class="block agency-door">
  <?php
  /* THE PROP FIELD. TWO DEPTH LAYERS, which is the whole effect: nine props sit BEHIND the card out in the… → docs/implementation-notes.md#agency-props */
  $agency_props = array(
    /* Back layer — out in the cream, several bleeding off the viewport edges. → docs/implementation-notes.md#back-layer-out-in-the-cream-several-bleeding-o */
    /* ⚠️ BALANCE IS A COUNT PER SIDE, and the first arrangement failed it: six props on the right against… → docs/implementation-notes.md#balance-is-a-count-per-side-and-the-first-arr */
    array( 'laptop',      'back',  'top:4%;left:-8%;',      242 , 0, -3 ),   /* left  */
    array( 'swatches',    'front', 'bottom:11%;left:-8%;',  172 , 0, -5 ),
    array( 'site-stack',  'back',  'top:46%;left:-8%;',     148 , 1, 4 ),
    array( 'wordpress',   'front', 'top:15%;left:11%;',      78 , 0, 6 ),
    array( 'browser',     'back',  'top:3%;left:24%;',      118 , 1, 5 ),   /* middle */
    array( 'analytics',   'front', 'bottom:13%;left:38%;',  190 , 0, -4 ),
    array( 'notes',       'back',  'bottom:6%;left:60%;',   116 , 1, 9 ),
    array( 'wireframe',   'back',  'top:2%;right:4%;',      178 , 1, -4 ),   /* right */
    array( 'plugin',      'back',  'bottom:7%;left:15%;',   104 , 0, 7 ),
    array( 'cutting-mat', 'back',  'bottom:8%;right:2%;',   196 , 1, -6 ),
    /* Front layer — over the card. → docs/implementation-notes.md#agency-door-props-2 */
    array( 'git',         'front', 'top:23%;right:-3%;',     82 , 0, 11 ),
    array( 'coffee',      'front', 'bottom:19%;right:-5%;', 134 , 1, -5 ),
  );
  ?>
  <div class="agency-door__props" aria-hidden="true">
    <?php foreach ( $agency_props as $ap ) : ?>
      <img class="agency-door__prop agency-door__prop--<?php echo esc_attr( $ap[1] ); ?>"
           src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/agency/' . $ap[0] . '.webp' ) ); ?>"
           alt="" loading="lazy" decoding="async"
           style="<?php echo esc_attr( $ap[2] ); ?>width:<?php echo (int) $ap[3]; ?>px;transform:<?php echo $ap[4] ? 'scaleX(-1) ' : ''; ?>rotate(<?php echo (int) $ap[5]; ?>deg);">
    <?php endforeach; ?>
  </div>

  <div class="block__inner">
    <div class="agency-door__panel">
      <?php /* THE EYEBROW IS LOAD-BEARING. It tells a plumber to skip this, which is what
               protects the SMB path through the rest of the page. */ ?>
      <span class="agency-door__eyebrow">For WordPress Agencies</span>

      <?php /* The H1, pluralised. → docs/implementation-notes.md#the-h1-pluralised-an-agency-who-scrolled-past */ ?>
      <h2>Give Every Client Site a Receptionist</h2>
      <?php /* CUT. It ran on into "— and what makes renewal conversations easier", which the third point below makes properly; → docs/implementation-notes.md#agency-door-lead */ ?>
      <p class="agency-door__lead">
        You build the sites. This is what makes them answer.
      </p>

      <?php /* ⚠️ ALL THREE POINTS WERE VERIFIED AGAINST THE CODE, and what is NOT claimed matters as much as what is. → docs/implementation-notes.md#agency-door-points */ ?>
      <ul class="agency-door__points">
        <li>
          <strong>Minutes per site, not hours</strong>
          A plugin and a connect step. No snippet to maintain.
        </li>
        <li>
          <?php /* ⚠️ THIS POINT WAS CORRECTED AFTER A CODE CHECK. → docs/implementation-notes.md#this-point-was-corrected-after-a-code-check */ ?>
          <strong>One login for every client&rsquo;s plan</strong>
          Billing, plans and minutes across every site you manage, from one sign-in.
        </li>
        <li>
          <strong>Something to show at renewal</strong>
          Named leads with full transcripts, arriving on their own.
        </li>
      </ul>

      <?php /* "See SiteStaffr for Agencies", NOT "See agency plans". → docs/implementation-notes.md#btn-2 */ ?>
      <a href="<?php echo esc_url( home_url( '/for/agencies/' ) ); ?>" class="btn btn--outline agency-door__cta">
        See SiteStaffr for Agencies
        <span aria-hidden="true">&rarr;</span>
      </a>
    </div>
  </div>
</section>

<!-- ========== SECTION 11: CLOSING CTA ==========================================
     THE HIERARCHY HERE WAS INVERTED, and the note in site-nav.php records why:
     self-serve is the primary conversion path.

     What it used to be, measured rather than guessed:
       - the onboarding WIDGET button was the visual primary, and carried a
         shimmer animation actively pulling the eye to it
       - the actual trial - the primary conversion path - was a text link at
         0.85rem and 45% opacity, prefixed with the word "or"

     So on the page that closes the sale, the one action the business wants was
     the faintest thing in the section. This is copy and hierarchy only; no new
     functionality. Order is now trial > concierge > chat. -->
<?php /* ⚠️ LIGHT NOW. The page's only remaining dark run is the FOOTER. → docs/implementation-notes.md#block-8 */ ?>
<section class="block final-cta" id="get-started">
  <?php /* ⚠️ A BACKGROUND FIGURE, NOT A GRID CELL. → docs/implementation-notes.md#final-cta-robot */ ?>
  <div class="final-cta__robot" aria-hidden="true">
    <img src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/robot-cta.webp' ) ); ?>"
         alt="" width="975" height="1380" loading="lazy" decoding="async">
  </div>

  <div class="block__inner">
    <div class="final-cta__copy">
        <?php /* ⚠️ REWRITTEN . It read "Be the One That's Still Open / When Everyone Else Has Closed" — evocative, and it… → docs/implementation-notes.md#section-label-2 */ ?>
        <span class="section-label">Get Started</span>
        <h2>Your Website Starts <span class="final-cta__highlight">Answering Tonight</span></h2>

        <?php /* Third version, a third wording. The two before it both described a TIMELINE ("then it works while you… → docs/implementation-notes.md#final-cta-subtitle */ ?>
        <p class="final-cta__subtitle">Set up your website&rsquo;s new AI Receptionist in minutes.</p>

        <?php /* PRIMARY. data-cta makes this a swappable trigger rather than a hard-coded link: the target funnel is pricing… → docs/implementation-notes.md#btn-3 */ ?>
        <a href="<?php echo esc_url( home_url( '/download/' ) ); ?>"
           class="btn btn--primary final-cta__primary js-cta"
           data-cta="trial">
          Start Free Trial
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
        <p class="final-cta__reassure">Free for 30 days &middot; No credit card required</p>

        <p class="final-cta__or"><span>or</span></p>

        <?php /* SECONDARY. Still the real onboarding widget - the shortcode is the working mechanism and is not worth… → docs/implementation-notes.md#final-cta-concierge */ ?>
        <div class="final-cta__concierge">
          <span class="final-cta__concierge-label">Rather have us set it up?</span>
          <?php
          /* ⚠️ THE ATTRIBUTES WERE WRITTEN FOR A DARK SECTION and stayed behind when this one turned cream:… → docs/implementation-notes.md#final-cta-note */
          echo do_shortcode( '[sitestaffr_button persona="onboarding" text="Request Assistance" gradient="off" icon="sitestaffr" box_shadow="off"]' );
          ?>
        </div>
        <p class="final-cta__note">We reply within 3 business days.</p>

        <?php /* THE TERTIARY LINE IS GONE. It read "Questions? Ask our AI — it's the same one you'd install", which is now… → docs/implementation-notes.md#final-cta-privacy */ ?>
        <p class="final-cta__privacy">Details you share go to setting up your assistant. See our <a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">Privacy Policy</a>.</p>
      </div>

    </div>
  </div>

</section>

</main>
<?php get_template_part( 'template-parts/site-footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
