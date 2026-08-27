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
    /* `mark` IS THE WATERMARK, AND IT IS NOT `label` (Mario, 2026-08-27: "very
       light/almost transparent... big and bold... a very obscure sort of signal of the
       industry for the cards and not meant to be imposing").

       They are separate fields on purpose and must stay separate. `label` is prose and
       is spoken — it builds the source button's aria-label ("Source for the Auto repair
       figure"). `mark` is a four-to-six character stamp sized to a card. Collapsing them
       would either put "Auto repair" in the watermark, which no longer fits or reads as
       a stamp, or put "AUTO" into a screen reader as the name of the industry. */
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
            'mark'   => 'VET',
            'amount' => '$200',
            'note'   => 'What owners report paying at their last visit',
            'source' => 'AVMA, 2025 Pet Ownership and Demographics Sourcebook. Owner self-reported, published October 2025.',
        ),
    );

    /* SECTION 9 — the FAQ. Seventeen questions in four groups, reordered
       OBJECTION-FIRST. The old ten opened with questions that sections 1, 3, 4, 5 and 8
       had already answered, which wastes the one place on the page a skeptical reader
       goes looking for a reason not to buy.

       WHY THE SCHEMA WORK STILL MATTERS IN 2026. FAQ rich results are effectively gone
       from Google — restricted to authoritative government and health sites since 2023.
       The case for FAQPage markup now is AI ANSWER ENGINES, which is on-brand: SiteStaffr
       sells AI Visibility checks, so the site should practise what the product measures.

       ANSWER-WRITING RULES, driven by extraction rather than ranking:
         - SELF-CONTAINED. An answer engine lifts one Q&A pair with no page context, so
           every answer names SiteStaffr and stands alone.
         - 40-80 WORDS. The old "What is SiteStaffr?" answer ran ~150 and was both too
           long to extract cleanly and a wall inside the accordion.
         - LEAD WITH THE DIRECT ANSWER, then qualify.
         - CONCRETE NOUNS AND NUMBERS over adjectives. "Installs in under five minutes"
           extracts; "easy to install" does not.

       ⚠️ `group` IS PRESENTATIONAL ONLY. The JSON-LD below iterates this same array and
       emits a FLAT mainEntity list, because FAQPage has no grouping concept and inventing
       one would produce invalid markup. Grouping solves the wall-of-questions problem
       inside the single column without breaking the never-two-column rule.

       ⚠️ NEVER REPEAT A QUESTION ACROSS TWO FAQPage BLOCKS. /for/agencies/ carries its own
       ten agency questions and they are deliberately disjoint from these — duplicates make
       the two URLs compete with each other. */
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
            'answer'   => 'Yes. You can set the greeting, choose the voice, pick the widget colours and icon, and add custom instructions that steer how it answers. You can also tell it what not to discuss. Everything is editable from your WordPress dashboard without touching code.',
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
            /* ABSORBS THE SALESFORCE BAND removed from section 4. "Does it fit my stack"
               is a buying question and belongs here, not under a story about a bakery
               owner asleep at 2 AM. */
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

    <?php /* THE AudioObject SCHEMA WAS REMOVED HERE, 2026-08-26.

             It described a 45-second plumbing demo (demo-conversation.mp3, "kitchen leak
             under the sink") complete with a full transcript, and the page now contains
             ZERO audio elements — the hero audio demo went with the two sections that
             section 3 replaced. Structured data has to describe content that is actually
             on the page; a detailed AudioObject for a file the visitor cannot reach is
             invalid markup and, unlike a broken image, nothing on screen reveals it.

             It was also the wrong business: the spec drops Brightwater Plumbing entirely.
             Voice is auto repair and text is pest control now.

             ⚠️ DO NOT RE-ADD THIS WHEN THE AUTO-REPAIR RECORDING LANDS unless the audio
             is genuinely reachable on the page, and re-derive the name, description,
             duration and transcript from that recording. assets/audio/demo-conversation.mp3
             is still on disk and is now unreferenced. */ ?>

    <?php wp_head(); ?>
</head>
<body <?php body_class( 'sitestaffr-landing-page' ); ?>>
<?php wp_body_open(); ?>

<!-- ========== NAVIGATION ========== -->
<?php
/* "Voices" -> #voices went with the voice showcase on 2026-08-27. A nav item is
   the one kind of link that cannot survive its target: it is present on every
   scroll position, so a dead anchor here scrolls nowhere and looks like a broken
   page rather than a missing section. Nothing replaces it - the secondary nav is
   short on purpose, and Pricing is the item that serves the conversion path. */
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
  <?php /* INSIDE the hero, not between the sections. It is an absolute overlay pinned to
           the hero's bottom edge so the robot can stand BEHIND it — that underlap is the
           whole point, and an in-flow sibling cannot provide it. See the template part
           for why the overlay is safe here when the V2 wave was not. */ ?>
  <?php get_template_part( 'template-parts/seam-curtain' ); ?>
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
            /* THE WATERMARK, and it is wrapped in its own clip layer rather than clipped
               by the card.

               `overflow: hidden` on .job-value itself would have been the obvious way to
               contain oversized type, and it would have silently broken the source
               tooltip: that tooltip is absolutely positioned inside this same card and is
               taller than the space below the info button, so clipping the card clips the
               tooltip's text. The wordmark gets its own `inset: 0; overflow: hidden` box,
               which contains the type and leaves the tooltip's stacking alone.

               aria-hidden because it is decoration that repeats information the card
               already carries — the icon shows the industry, and `label` states it to
               assistive tech through the source button. Read aloud it would announce a
               bare "HVAC" with no context, between an icon and a dollar amount. */
            ?>
            <span class="job-value__mark" aria-hidden="true"><span><?php echo esc_html( $jv['mark'] ); ?></span></span>

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

    <?php
    /* THE AT-REST STAGE (Mario, 2026-08-27: "the two blank panels looks bad so let's hide
       them and just put a huge play button").

       WHY THE PANELS WERE BLANK IN THE FIRST PLACE, because it is not a bug and the fix
       must not "repair" it: the panels are rendered FULLY POPULATED by PHP, and the script
       empties them on load only once it knows it can drive them. That is deliberate — with
       JS off, or under prefers-reduced-motion, the whole conversation and the whole recap
       are simply there. The blankness only ever existed in the one state where a script is
       standing by to fill them, and this stage now covers exactly that state.

       So there are three states, not two:
         no JS / reduced motion  -> no stage at all, both panels full. Unchanged.
         JS, not yet played      -> this stage. Panels hidden, one enormous target.
         played once             -> stage gone for good, panels take over and animate.

       `hidden` until JS removes it, for the same reason the transport is: with no script
       there is nothing to play, and a dead play button is worse than none.

       THE ROBOT IS THE EXISTING assets/images/robot-voice.webp — the one that came out
       with the voice showcase and has been sitting unreferenced since. It is not a new
       generation: it is already in the hero's render language (the style anchor), it is
       already mid-conversation with speech lines and chat bubbles, which is precisely
       what this section is about, and it costs nothing. Do not re-generate it to "match"
       — matching is what it already does.

       ⚠️ THE ROBOT IS DECORATION AND MUST STAY SECONDARY. The hero has this same
       character two sections up at a much larger size; the reason this reads as a
       different beat rather than a repeat is that here the PLAY BUTTON is the subject and
       the robot is behind it. If the robot ever grows to compete, the section turns into
       the hero again. */
    ?>
    <div class="see-it__stage" data-see-it-stage hidden
         data-see-it-open-sound="<?php echo esc_url( sitestaffr_asset_url( 'assets/audio/open.mp3' ) ); ?>">
      <img class="see-it__stage-robot"
           src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/robot-voice.webp' ) ); ?>"
           alt="" aria-hidden="true" width="1080" height="1350" loading="lazy" decoding="async">
      <?php /* A real <button> with a real accessible name. The label says what it plays,
               not "play" — this is the only control in the section at rest, so it is the
               one thing a screen-reader user has to understand from its name alone. */ ?>
      <button class="see-it__stage-play" type="button" data-see-it-stage-play
              aria-label="Play the conversation">
        <?php /* ⚠️ THE TRIANGLE'S OWN COORDINATES DO THE CENTRING — there is no margin
                 nudge on this icon and there must not be one added back.

                 It was `8,5 20,12 8,19`, whose bounding box runs x=8..20 and is therefore
                 centred on x=14 inside a 24-wide viewBox: two units right of centre before
                 any CSS is involved. A `margin-left` was then added on top of that, which
                 is why the glyph sat visibly right in the circle. Two offsets stacking is
                 also why nudging the CSS never fixed it — the error was in the artwork.

                 Now x=7..19: the bounding box is centred on 13, one unit right of the
                 viewBox's 12. That single unit is deliberate and is optical, not
                 geometric — a right-pointing triangle carries its mass on the flat left
                 edge, so a perfectly centred bounding box reads as sitting too far left.
                 Verified by measuring the rendered pixels, not by eye. */ ?>
        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><polygon points="7,5 19,12 7,19"/></svg>
      </button>
      <p class="see-it__stage-hint">Watch a visitor get answered &mdash; and the lead land in your inbox.</p>
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
  <?php /* THE CURTAIN CLOSES HERE (Mario, 2026-08-27: "add the same book shape divider
           for the Your Morning section top so that the dark sections show a completion
           with the divider"). Same path as the hero's, mirrored — the dark block that
           opened with a peak drawn up now comes back down with one.

           It belongs to THIS section, not to section 3, for the same reason the opening
           one belongs to the hero: it is an overlay on the LIGHT side of the boundary,
           so the light section is its background and the two can never disagree on
           colour. Section 3 needs no cooperation at all. */ ?>
  <?php get_template_part( 'template-parts/seam-curtain', null, array( 'variant' => 'close' ) ); ?>
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
    <?php
    /* THE THREE LEADS, AND THE DOCUMENT BEHIND EACH ONE (Mario, 2026-08-27: "it would be
       really cool if we could click on each of those emails and see an example of the
       document that we have in v1").

       ⚠️ ONE ARRAY DRIVES BOTH THE ROW AND THE DOCUMENT. The row's name, time and
       one-liner are read from the same entry the recap and transcript are, so a row can
       never advertise a lead the document contradicts. Splitting these into two literals
       is how "Sarah Mitchell, 25 guests" ends up opening a document about 40 cupcakes.

       ⚠️ EVERY TRANSCRIPT OPENS ON THE SAME LINE, and that is the product's real greeting
       rather than three invented ones (Mario asked for it explicitly). It is also the
       line V1's document already used. Note the wording is "How can I help you today?" —
       Mario's message transposed it to "How I can help you today?", which is not
       grammatical and is not what V1 shipped.

       PRIYA RAMAN IS GONE FROM THIS SECTION (Mario: "use a different name... a Hispanic
       woman or something") and that also removes a duplicate: the same fictional person
       was giving her details to a pest control company in section 3 and to a bakery here.
       Section 3 keeps the name; this one is Camila Reyes.

       These are illustrative examples for a demo, not real customer data. Phone numbers
       are 555-01xx, the block reserved for fiction, and emails are @example.com. */
    $morning_leads = array(
      array(
        'id'      => 'tom-byrne',
        'time'    => '6:03 AM',
        'who'     => 'Tom Byrne',
        'what'    => 'Gluten-free cupcakes, 40 for Friday',
        'stamp'   => 'March 27, 2026 6:03 AM EDT',
        'length'  => '1:32',
        'recap'   => '<strong>Tom</strong> asked whether Maggie&rsquo;s Cakes can do gluten-free cupcakes, and needs about 40 of them for an office birthday on Friday morning.',
        'fields'  => array(
          array( 'label' => 'Name',               'value' => 'Tom Byrne' ),
          array( 'label' => 'Phone',              'value' => '(555) 555-0176', 'tel' => '+15555550176' ),
          array( 'label' => 'Reason for contact', 'value' => 'Gluten-free cupcake order, 40 for Friday' ),
        ),
        'followup' => 'Call Tom to confirm flavours, pickup time and pricing for 40 gluten-free cupcakes.',
        'turns'   => array(
          array( 'who' => 'ai',      'at' => '6:03:04 AM', 'text' => 'Hi! Thanks for reaching out to Maggie&rsquo;s Cakes. How can I help you today?' ),
          array( 'who' => 'visitor', 'at' => '6:03:21 AM', 'text' => 'Do you do gluten-free cupcakes? I need about 40 for Friday.' ),
          array( 'who' => 'ai',      'at' => '6:03:24 AM', 'text' => 'We do &mdash; our gluten-free sponge is made in a separate prep area. For an order that size I&rsquo;ll take a message so the team can confirm the details with you. May I have your name?' ),
          array( 'who' => 'visitor', 'at' => '6:03:58 AM', 'text' => 'Tom Byrne.' ),
          array( 'who' => 'ai',      'at' => '6:04:01 AM', 'text' => 'Thanks Tom. What&rsquo;s the best number for our team to reach you at?' ),
          array( 'who' => 'visitor', 'at' => '6:04:33 AM', 'text' => '555-0176.' ),
          array( 'who' => 'ai',      'at' => '6:04:36 AM', 'text' => 'Got it. I&rsquo;ve passed along your request for 40 gluten-free cupcakes for Friday, and someone from the team will be in touch. Is there anything else I can help you with?' ),
        ),
      ),
      array(
        'id'      => 'sarah-mitchell',
        'time'    => '2:14 AM',
        'who'     => 'Sarah Mitchell',
        'what'    => 'Two-tier unicorn cake, 25 guests, April 12',
        'stamp'   => 'March 27, 2026 2:14 AM EDT',
        'length'  => '1:41',
        /* Carried over from V1's document, which used this exact lead. */
        'recap'   => '<strong>Sarah</strong> reached out to inquire about ordering a custom birthday cake for her daughter&rsquo;s 7th birthday party. She&rsquo;s looking for a two-tier unicorn theme cake for 25 guests.',
        'fields'  => array(
          array( 'label' => 'Name',               'value' => 'Sarah Mitchell' ),
          array( 'label' => 'Phone',              'value' => '(555) 555-0123', 'tel' => '+15555550123' ),
          array( 'label' => 'Reason for contact', 'value' => 'Custom birthday cake order inquiry' ),
        ),
        'followup' => 'Call Sarah back to confirm cake design details, discuss pricing for a two-tier unicorn cake, and schedule the pickup date for April 12th.',
        'turns'   => array(
          array( 'who' => 'ai',      'at' => '2:14:03 AM', 'text' => 'Hi! Thanks for reaching out to Maggie&rsquo;s Cakes. How can I help you today?' ),
          array( 'who' => 'visitor', 'at' => '2:14:10 AM', 'text' => 'Hi! I need to order a birthday cake for my daughter. She&rsquo;s turning 7 and wants a unicorn theme.' ),
          array( 'who' => 'ai',      'at' => '2:14:13 AM', 'text' => 'That sounds wonderful &mdash; we do custom themed cakes. I&rsquo;ll take a message so the team can go over designs and pricing with you. May I have your name?' ),
          array( 'who' => 'visitor', 'at' => '2:14:52 AM', 'text' => 'Sarah Mitchell.' ),
          array( 'who' => 'ai',      'at' => '2:14:55 AM', 'text' => 'Thanks Sarah. What&rsquo;s the best number for our team to reach you at?' ),
          array( 'who' => 'visitor', 'at' => '2:15:41 AM', 'text' => '555-0123. It&rsquo;s for 25 guests, on April 12.' ),
          array( 'who' => 'ai',      'at' => '2:15:44 AM', 'text' => 'Got it &mdash; a two-tier unicorn cake for 25 guests on April 12. I&rsquo;ve passed that to the team and someone will be in touch. Is there anything else I can help you with?' ),
        ),
      ),
      array(
        'id'      => 'camila-reyes',
        'time'    => '11:47 PM',
        'who'     => 'Camila Reyes',
        'what'    => 'Wedding tasting &mdash; are you open Sundays?',
        'stamp'   => 'March 26, 2026 11:47 PM EDT',
        'length'  => '1:48',
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
          array( 'who' => 'ai',      'at' => '11:47:32 PM', 'text' => 'Congratulations! I don&rsquo;t have the tasting schedule to hand, but I can take a message so the team can get back to you about Sunday availability. May I have your name?' ),
          array( 'who' => 'visitor', 'at' => '11:48:08 PM', 'text' => 'Camila Reyes.' ),
          array( 'who' => 'ai',      'at' => '11:48:11 PM', 'text' => 'Thanks Camila. What&rsquo;s the best number for our team to reach you at?' ),
          array( 'who' => 'visitor', 'at' => '11:48:47 PM', 'text' => 'Email is easier &mdash; camila.reyes@example.com' ),
          array( 'who' => 'ai',      'at' => '11:48:50 PM', 'text' => 'Got it. I&rsquo;ve passed along your question about Sunday tastings for a September wedding, and someone from the team will follow up by email. Is there anything else I can help you with?' ),
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
          <?php /* A REAL <button>, not a click handler on the <li>. It is the row's whole
                   surface, so the row stays one target, but it takes focus, fires on
                   Enter and Space for free, and announces as a control. The row was a
                   plain <li> before, so nothing about the no-JS rendering regresses if
                   the script never runs — see the CSS note on .is-interactive. */ ?>
          <button type="button" class="morning-inbox__row"
                  data-morning-open="<?php echo esc_attr( $ml['id'] ); ?>"
                  aria-label="<?php echo esc_attr( 'Open the recap for ' . wp_strip_all_tags( $ml['who'] ) ); ?>">
            <span class="morning-inbox__time"><?php echo esc_html( $ml['time'] ); ?></span>
            <span class="morning-inbox__who"><?php echo esc_html( $ml['who'] ); ?></span>
            <span class="morning-inbox__what"><?php echo wp_kses_post( $ml['what'] ); ?></span>
            <span class="morning-inbox__tag">Lead captured</span>
            <span class="morning-inbox__view" aria-hidden="true">View recap &rarr;</span>
          </button>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <?php
    /* THE DOCUMENTS. Rendered server-side, one <dialog> each, hidden until opened.

       ⚠️ THIS IS AN ENHANCEMENT AND IT IS ALLOWED TO BE ONE. The page's standing rule is
       that content must not default to invisible and depend on JS to restore it — that
       rule exists because PRIMARY content once did. These are worked examples behind a
       row that already states the lead, the time and the outcome in the inbox itself; a
       reader with no script loses the detail view and nothing they were told about.
       Without JS the rows never gain their affordance (see .is-interactive in the CSS),
       so there is no button advertising something that cannot happen.

       <dialog> rather than a hand-built overlay: focus trapping, Esc, inertness of the
       page behind and the top layer are all native. showModal() is what activates them —
       a plain .show() or a CSS-only reveal gets none of it. */
    ?>
    <?php foreach ( $morning_leads as $ml ) : ?>
    <dialog class="recap-doc" id="recap-<?php echo esc_attr( $ml['id'] ); ?>"
            aria-labelledby="recap-<?php echo esc_attr( $ml['id'] ); ?>-title">
      <div class="recap-doc__sheet">
        <div class="recap-doc__bar">
          <img class="recap-doc__logo"
               src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/logo-240.webp' ) ); ?>"
               alt="SiteStaffr" width="240" height="72" loading="lazy" decoding="async">
          <?php /* V1's teal "Print / Download PDF" pill. It is a <span> there and a <span>
                   here: the real button lives in the emailed recap, and a control on this
                   page that looked live but printed nothing would be a lie about the
                   product. It is part of the picture of the document, not a feature of
                   the marketing site. */ ?>
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
                  <?php /* ⚠️ THE LABEL SAYS "AI" BECAUSE THE PRODUCT DOES. It is a picture
                           of the emailed recap, so it has to match what the recap actually
                           prints — changing it here alone would make the mockup a promise
                           the product does not keep. Renaming it to "SiteStaffr" is a real
                           task, logged on the wiki task board for the plugin and the email
                           transcript; when that ships, this line changes with it. */ ?>
                  <div class="recap-doc__msg recap-doc__msg--ai">
                    <div class="recap-doc__msg-meta"><strong>AI</strong> <?php echo esc_html( $t['at'] ); ?></div>
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

   ⚠️ `lang` ON EVERY GREETING AND `dir="rtl"` ON THE ARABIC. A screen reader switches
   voice on `lang`; without it a synthesiser reads "Hola" in English phonetics on the one
   section whose entire subject is other languages. This is not decoration.

   ────────────────────────────────────────────────────────────────────────────
   REBUILT AGAIN, 2026-08-27. Mario: "I hate it. I'd rather see the robot super big with
   many different languages saying hello around the robot."

   WHAT WENT: the split layout, the single greeting bubble, and the clickable pills that
   drove it. The pills were a good idea that solved the wrong problem — they let you see
   ONE language at a time, and the argument this section has to make is that it speaks a
   LOT of them. Twelve greetings visible at once makes that argument in one glance and
   needs no interaction to do it.

   ⚠️ THIS IS THE THIRD DESIGN IN THIS SLOT AND THE SECOND ONE KILLED BY THE SAME BUG.
   The crowd render before it positioned twelve bubbles with hand-measured --x/--y
   percentages over the artwork: twelve were specced and FOUR rendered at 1440, and a
   comment recorded that swapping the image silently invalidated all twelve.

   So the greetings here are NOT positioned against the robot. They sit in the stage's
   own coordinate space, in two symmetric side bands that the centred figure never
   reaches, and below 900px they stop being positioned at all and become an in-flow
   wrap. Swapping robot-languages.webp cannot invalidate a single one of them. If you
   ever find yourself measuring a percentage against a pixel in the artwork, that is
   this bug coming back.
*/
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
      <span class="section-label">Speaks Their Language</span>
      <h2>SiteStaffr Speaks <em>Their</em> Language</h2>
      <p class="lang-section__text">
        Your visitors speak 57+ languages, and so does SiteStaffr. It answers in whatever language they open with.
      </p>
    </div>

    <?php
    /* THE STAGE. The robot is in the FLOW and the greetings are absolute around it, which
       is the opposite of how the deleted crowd version worked and is the whole reason
       this one cannot rot the same way. The image sets the stage's height; the greetings
       are placed against the stage, never against the picture.

       ⚠️ THE ROBOT IS aria-hidden AND THE GREETINGS ARE NOT. The greetings are the
       section's evidence, not decoration — "here are twelve languages" is the claim, and
       hiding them would leave a screen-reader user with a heading and nothing under it. */
    ?>
    <div class="lang-orbit">
      <img class="lang-orbit__robot"
           src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/robot-languages.webp' ) ); ?>"
           alt="" aria-hidden="true"
           width="1122" height="1383" loading="lazy" decoding="async">

      <?php
      /* ⚠️ `lang` ON EVERY GREETING AND `dir="rtl"` ON THE ARABIC — carried over from the
         previous design, where the note read "this is not decoration", and it is even
         more true now that there are twelve of them. A screen reader switches voice on
         `lang`; without it a synthesiser reads 你好 and Привет with English phonetics,
         in the one section whose entire subject is other languages.

         The visible chip is the greeting; the language's NAME rides along in a
         visually-hidden span. Sighted readers get "Bonjour" and infer French from the
         word — a screen-reader user hearing a French synthesiser say "Bonjour" with no
         label has no idea which language just went past. */
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

    <?php /* KEPT, and moved under the stage where it closes the section. It answers the
             owner's immediate objection — "great, but I can't read Mandarin" — and it is
             the one line here that is about THEM rather than about the visitor. Deleting
             it with the old layout would have thrown away the reassurance and kept only
             the spectacle. */ ?>
    <p class="lang-section__english">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6 9 17l-5-5"/></svg>
      Every recap arrives in English, ready for you.
    </p>
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

/* WHICH INDUSTRY OPENS THE SECTION IS RANDOM (Mario, 2026-08-27: "would be great if a
   business is picked at random instead of always starting with Dental Practice").

   It was $ind_flat[0], so Dental Practices — the first entry in the registry — was the
   permanent face of a section whose whole argument is breadth. Sixteen industries, and a
   visitor only ever saw one of them unless they clicked.

   ⚠️ IT IS RANDOM PER PAGE RENDER, NOT PER VISITOR, and that distinction is worth
   knowing before anyone calls it broken. Full-page caching (LiteSpeed on production)
   serves one generated copy to everybody, so the pick changes when the cache is built,
   not on every load. That is fine here — the goal is that the section is not permanently
   Dental, not that two people see different things — but it does mean you can reload ten
   times and see no change, and that is the cache working rather than this failing.

   Doing it in JS instead would give per-visitor variety at the cost of rendering one
   industry and visibly swapping it a frame later, which is a worse trade for a section
   whose panel is a 440px image.

   ⚠️ EVERY is-active FLAG IN THIS SECTION DERIVES FROM $ind_first — the panel, the
   excerpt, and the list button. They must agree, so there is exactly one source for the
   choice. Do not re-roll it further down the template. */
$ind_first  = ! empty( $ind_flat ) ? $ind_flat[ array_rand( $ind_flat ) ] : null;
?>
<?php /* ⚠️ NOT A block-split ANY MORE (Mario, 2026-08-27: "the side by side looks weird
         because the industries is too long vertically and doesn't look good").

         It was image-left / list-right. The list is five groups and sixteen names in ONE
         column, so it ran far taller than the 440px image beside it and the Split was
         permanently lopsided — a two-column layout where one column ends two thirds of
         the way up.

         Now it is two stacked rows: the isometric and its excerpt side by side on top,
         then the full list underneath at full width, where five groups sit as five
         columns instead of one tall stack. The list gets SHORTER by getting WIDER, which
         is the thing the Split could not do. */ ?>
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

    <?php /* ROW 1 — the isometric and its excerpt, side by side. The excerpt used to sit
             UNDER the image inside the art column; beside it, the pair reads as one card
             and the row stays short. */ ?>
    <div class="industries__stage">
      <div class="industries__art">
        <?php foreach ( $ind_flat as $i => $ind ) :
            $art = sitestaffr_industry_art_url( $ind['slug'] );
            /* ⚠️ A MISSING RENDER MUST NOT PRODUCE A BROKEN IMAGE. Medical Staffing is
               the sixteenth industry and its isometric is generated but not yet keyed,
               so the file genuinely is absent right now. sitestaffr_industry_art_url()
               returns '' when the file does not exist, and the panel falls back to the
               industry's emoji at display size rather than an alt-text box. */
            ?>
          <?php /* ⚠️ ACTIVE IS $ind_first, NOT INDEX 0. These three flags -- the panel,
                   the excerpt below, and the list button further down -- are what make one
                   industry the open one, and they must all name the SAME industry. They
                   were each hardcoded to `0 === $i` back when the default was always the
                   first entry; with a random default that silently splits the section,
                   highlighting one name in the list while showing a different picture. */ ?>
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

      <?php /* The excerpt is now a SIBLING of the art, not a child of it — that is what
               puts it beside the isometric instead of under it. It is still rendered
               twice in total (once here for the pointer layout, once inside each mobile
               accordion item below), and both still come from the same registry field. */ ?>
      <div class="industries__excerpt" data-ind-excerpt>
          <?php foreach ( $ind_flat as $i => $ind ) : ?>
            <div class="industries__excerpt-item<?php echo ( $ind_first && $ind['slug'] === $ind_first['slug'] ) ? ' is-active' : ''; ?>"
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
</section>

<!-- ========== SECTION 7: SOCIAL PROOF ========== -->
<?php
/* SECTION 7 — social proof. THE V2 ARRANGEMENT, IN V3's PALETTE.

   ⚠️ THE ARRANGEMENT IS THE THING THAT TESTED WELL, so it is what gets ported —
   not just the two numbers. What was here until 2026-08-26 was the V1 design
   (a glassmorphic card on a gradient wash, with a noise texture and a rotated
   backdrop panel) carrying V2's stats. That is the combination the spec's
   opening line rules out: "Testers preferred it over the live site's" is a
   statement about the LAYOUT.

   The shape, left to right: evidence, then the human voice.

     - The header lives INSIDE the evidence column, not above the grid. Two
       reasons and the second is the real one. It reads better - the left column
       becomes the whole argument top to bottom, and the right column is one
       object, the customer's own words. And it is what lets the panel be big:
       with the header outside, the grid row is only as tall as the stats, so the
       quote panel can never be more than ~350px however it is styled. Moving
       ~150px of header into the row is what gives the panel its height.

     - The heading names the customer and the month rather than paraphrasing the
       finding. It read "They Closed for the Day. Their Customers Didn't." for one
       round - accurate, and cheesy (Mario, 2026-08-22). A heading that
       paraphrases the finding spoils it: you read the turn of phrase, then the
       number restates it and lands as a repeat instead of as evidence.

   ⚠️ THE OFFSET GHOST BORDER STAYS (Mario, 2026-08-26). It is the second plane
   on the quote panel - a hairline with no fill, rotated the other way, crossing
   out of the slab rather than nested inside it. Nested, the two read as one thick
   border; crossing, they read as two overlapping objects. It is not a rendering
   fault and it is not up for tidying.

   ⚠️ EVERY NUMBER APPEARS EXACTLY ONCE, and that took rewording. The V2 version
   ran "1 in 3" as the second lead stat and repeated 23 in the source line; with
   23 promoted to a lead number, the source line would have stated it twice and
   the support line would have stated the month three times. 86% and 23 lead, 72
   is the denominator underneath them, and the date range lives in the source. */
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
        /* TWO LEAD NUMBERS, NOT ONE. They answer different questions, and together
           they close the page's argument:
             86% -> section 2's thesis is true, these visitors are being missed
             23  -> and it turned into business

           ⚠️ THE SECOND ONE USED TO BE "1 in 3". That is a conversion RATE, and the
           reader has to do arithmetic before knowing whether it is good - one in
           three of what, and is that a lot? 23 is immediately meaningful. */
        ?>
        <div class="proof-section__lead-pair">
          <div class="proof-section__lead-stat">
            <?php /* "after business hours", not "after they closed" (Mario, 2026-08-27).
                     Clearer, and it now matches the language of the quote beside it —
                     Nathaly says "after hours is when most new facility inquiries come
                     in", so the stat and the customer describe the same thing the same
                     way instead of two ways. */ ?>
            <span class="proof-section__lead-number">86%</span>
            <span class="proof-section__lead-label">of their conversations arrived <strong>after business hours</strong></span>
          </div>
          <div class="proof-section__lead-stat">
            <?php /* ⚠️ "23 qualified leads / out of 72 conversations" RESOLVES A REAL
                     AMBIGUITY, which is why the denominator moved here rather than
                     staying a shared footnote.

                     The label read "23 — of those became a qualified lead", and "those"
                     had two readings: all 72 conversations, or only the 86% that arrived
                     after hours. Those are different claims about a named customer (23/72
                     vs 23/62). Stating the denominator directly under the number it
                     belongs to makes it say one thing.

                     72 is still support and still quieter than the number above it — it
                     has simply stopped being a floating footnote under both stats. 86%
                     carries its own denominator in its own label ("of their
                     conversations"), so nothing was taken from it. */ ?>
            <span class="proof-section__lead-number">23</span>
            <span class="proof-section__lead-label"><strong>qualified leads</strong></span>
            <span class="proof-section__lead-sub">out of <strong>72</strong> conversations</span>
          </div>
        </div>

        <?php
        /* ⚠️ NOT A FOOTNOTE TO MINIMISE. "One customer's results, not an average"
           buys more credibility than the two numbers do - it is the sentence that
           tells a skeptical reader these are real rather than modelled. Do not
           shrink it, move it into a tooltip, or drop it when a second testimonial
           arrives; with two customers it becomes more necessary, not less.

           It sits in the evidence column rather than under the whole grid, where
           it used to be. Full width, it put the source of the numbers further from
           the numbers than the quote was, and a disclaimer that has to be hunted
           for is not doing its job.

           The figures are Synergy Scribes' own, used with permission. CORRECTED
           2026-08-19 (Mario): the first set - 80%, 110 conversations, 29 leads -
           was inflated by technical faults since found and fixed. Anything still
           quoting 110 or 29 anywhere is stale and wrong. */
        ?>
        <p class="proof-section__stats-source">Measured at <a href="https://synergyscribes.com" target="_blank" rel="noopener noreferrer">Synergy Scribes</a>, 1 June &ndash; 1 July 2026. One customer&rsquo;s results, not an average.</p>
      </div>

      <?php
      /* The quote CORROBORATES the number rather than introducing it, so it sits
         beside and reads quieter. Two overlapping planes: the slab, and the ghost
         hairline crossing out of it. The slab is a real element rather than a
         pseudo because this figure's own ::before is already the quote glyph. */
      ?>
      <figure class="block-split__art proof-section__quote-block">
        <span class="proof-section__quote-plate" aria-hidden="true"></span>
        <?php
        /* AN INNER WRAPPER, for exactly one reason: the panel is taller than its
           contents. The column stretches to match the evidence column, so quote and
           attribution sit CENTRED in that height rather than pinned to the top with
           a pool of empty panel underneath.

           It cannot be done by centring the figure's children directly - the quote
           glyph is positioned against its container, so centring the text would
           strand the glyph at the panel's top edge. Anchoring the glyph to this
           wrapper makes mark and words move together. */
        ?>
        <div class="proof-section__quote-inner">
          <blockquote class="proof-section__quote">
            <p>We staff medical scribes across multiple clinics, and after hours is when most new facility inquiries come in. <strong>SiteStaffr</strong> captured a full intake request at 9 PM on a Sunday, with the clinic name, number of scribes needed, and start date. Monday morning it was sitting in our inbox, ready to go.</p>
          </blockquote>
          <?php
          /* THE PORTRAIT SITS WITH THE NAME, not beside the quote. Beside a
             five-line quote it floats at mid-height with dead space above and
             below, and the eye has to travel to work out who is speaking. Next to
             the attribution it does the job a face actually does in a testimonial:
             identifying the person at the moment you read their name.

             ⚠️ A SEPARATE HEADSHOT CROP, not object-fit on the full-body original.
             That source is 400x526 of her standing at full length; in a small
             frame her face lands at about 13px, and object-fit cannot zoom past
             the source width - no combination of object-position and transform
             gets a readable face out of it. Both crops ship alongside the
             full-length original she supplied. */
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
/* THE VOICE SHOWCASE WAS DELETED HERE ON 2026-08-27, RESTORING A DECISION THAT
   HAD ALREADY BEEN MADE.

   ⚠️ THIS SECTION SHOULD NEVER HAVE BEEN IN THE V3 BUILD. It was deleted from
   the homepage on 2026-08-21 and the wiki recorded it twice - `task-board.md`
   closed audit finding 8 with "The whole voice-showcase section was deleted in
   the redesign; its content is banked for a future /voice/ page ... Nothing to
   decide." The V3 rebuild on 2026-08-26 put it back and wrote "Mario's call,
   2026-08-26: keep it" into this comment, citing nothing, against a record that
   said the question was closed.

   The lesson is not about this section. A code comment asserting a decision is
   not evidence of one, and it outranks nothing - the wiki is the record. When
   the two disagree, check the wiki before acting on the comment, and never write
   an attribution without the source that backs it.

   The content is not lost: `template-parts/voice-showcase.php` stays on disk,
   deliberately, banked for the future /voice/ page the 2026-08-21 note describes.
   It is now referenced by nothing on the homepage.

   The nav's "Voices" item went with it - see the nav array above. That comment
   also claimed the item lived in site-nav.php; it is declared inline here. */
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
<?php /* "Ends after 30 days unless you pick a plan" removed (Mario, 2026-08-26):
               obvious from "$0 / for 30 days" directly above it. The spec asked for an
               explicit end state here so the column could never read as a permanent free
               tier - the identity row already says it, so the sentence was saying it
               twice in the narrowest column on the page. */ ?>
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
<?php /* SECTION 9 — the FAQ.

         STICKY RAIL + SINGLE-COLUMN ACCORDION. Never two columns of questions: a reader
         scanning for their own objection has to track two streams at once, and the
         answer they open pushes the other column out of alignment.

         The deflection CTA moved INTO THE BOTTOM OF THE RAIL. It used to sit under the
         list, which left ~575px of dead cream beside the questions and put the CTA where
         only someone who had already read all seventeen would see it. In the rail it
         follows the reader down the whole list.

         "Ask Our AI" rather than an email address, deliberately: it is the same widget a
         visitor would install, so the support path is also a demo. */ ?>
<section class="block block-split faq-section" id="faq">
  <div class="block__inner">
    <div class="block-split__grid faq-section__grid">
      <div class="faq-section__rail">
        <span class="section-label">Common Questions</span>
        <h2>Frequently Asked Questions</h2>
        <p class="faq-section__subtitle">The things people ask before they install it.</p>

        <div class="faq-section__ask">
          <p class="faq-section__ask-lead">Still have a question?</p>
          <button type="button" class="btn btn--outline js-open-chat" data-cta="chat">Ask Our AI</button>
          <p class="faq-section__ask-note">It&rsquo;s the same one you&rsquo;d install.</p>
        </div>
      </div>

      <div class="faq-list">
        <?php
        /* GROUPS ARE PRESENTATIONAL. They break the wall of seventeen without breaking
           the single-column rule; the JSON-LD above stays a flat mainEntity list,
           because FAQPage has no grouping concept.

           The first item is open by default — every answer is already in the DOM for
           the schema, so opening one costs nothing and shows the reader what an answer
           looks like before they decide whether to bother. */
        $faq_group = null;
        foreach ( $faq_items as $faq_i => $faq ) :
            if ( $faq['group'] !== $faq_group ) :
                $faq_group = $faq['group'];
                ?>
                <h3 class="faq-list__group"><?php echo esc_html( $faq_group ); ?></h3>
            <?php endif; ?>
        <div class="faq-item<?php echo 0 === $faq_i ? ' faq-item--open' : ''; ?>">
          <button class="faq-item__question" type="button" aria-expanded="<?php echo 0 === $faq_i ? 'true' : 'false'; ?>">
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
  </div>
</section>

<?php /* SECTION 10 — the agency door. The one section that did not exist in any form.

         There were ZERO occurrences of "agency" on the homepage or in any template part,
         and lines like "while you're on a job, with a client, or asleep" actively tell an
         agency this product is not for them. An agency visitor has just read an entire
         page written to a plumber; this is where the page says "and if you're the person
         who BUILDS the plumber's site, here's your version."

         ⚠️ SHAPE: A CONTAINED PANEL, NOT A FULL SECTION. Sections 10 and 11 are both dark
         and adjacent, and two full-bleed dark sections end the page on an undifferentiated
         slab that deflates the run-up to the close. This is an elevated panel on the dark;
         section 11 then opens full-width. That says "this is an aside, not your path" —
         correct for ~90% of readers — and lets section 11 read as the ending.

         NO ROBOT. Three appearances is the ceiling and section 11 owns the third.

         POSITION: BEFORE section 11. An agency who reaches the closing CTA and finds
         nothing for them bounces, and putting the door after the final ask buries it in
         footer territory. The nav item catches the ones who self-classify in the first
         three seconds; this catches the ones who read to the end. */ ?>
<section class="block block--dark block--tight agency-door">
  <div class="block__inner">
    <div class="agency-door__panel">
      <?php /* THE EYEBROW IS LOAD-BEARING. It tells a plumber to skip this, which is what
               protects the SMB path through the rest of the page. */ ?>
      <span class="agency-door__eyebrow">For WordPress Agencies</span>

      <?php /* The H1, pluralised. An agency who scrolled past the hero recognises the
               offer instantly, and "every client site" is the phrase that makes it
               theirs rather than their client's. */ ?>
      <h2>Give Every Client Site a Receptionist</h2>
      <p class="agency-door__lead">
        You build the sites. This is what makes them answer &mdash; and what makes renewal conversations easier.
      </p>

      <?php /* ⚠️ ALL THREE POINTS WERE VERIFIED AGAINST THE CODE ON 2026-08-26, and what
               is NOT claimed matters as much as what is. None of them mention margin,
               reseller pricing, white-label or bulk billing, because none of those exist.
               An agency is a technical, skeptical audience that checks. */ ?>
      <ul class="agency-door__points">
        <li>
          <strong>Minutes per site, not hours</strong>
          A plugin and a connect step. No snippet to maintain, no separate platform for a client to lose access to.
        </li>
        <li>
          <?php /* ⚠️ THIS POINT WAS CORRECTED AFTER A CODE CHECK. It originally read
                   "Every client site in one place — switch between the sites you manage
                   from a single dashboard." That is TRUE FOR BILLING AND FALSE FOR LEADS:
                   /manage/ authenticates on the billing email and its site switcher covers
                   plans, minutes and team billing access, but the Follow-ups queue,
                   transcripts and Agent Health live in each client's own wp-admin, per
                   site. THERE IS NO CROSS-CLIENT LEAD VIEW. Scope every "one place"
                   phrase to billing — the first agency to sign up finds out in ten
                   minutes, and this is exactly the audience that would say so publicly. */ ?>
          <strong>One login for every client&rsquo;s plan</strong>
          Manage billing, plans and minutes across every site you look after, from a single sign-in.
        </li>
        <li>
          <strong>Something to show at renewal</strong>
          Their site starts producing named leads with full transcripts. That&rsquo;s the hardest number in agency work, and it arrives on its own.
        </li>
      </ul>

      <?php /* "See SiteStaffr for Agencies", NOT "See agency plans". The second would
               promise a pricing page that would then have to be invented. If the agency
               page's contact form generates real demand, that is the signal to build
               reseller pricing — the page is the demand-validation mechanism. */ ?>
      <a href="<?php echo esc_url( home_url( '/for/agencies/' ) ); ?>" class="btn btn--outline agency-door__cta">
        See SiteStaffr for Agencies
        <span aria-hidden="true">&rarr;</span>
      </a>
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
