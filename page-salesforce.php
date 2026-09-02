<?php
/*
Template Name: Salesforce
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$get_started_url = home_url( '/#get-started' );

$sf_steps = array(
    array(
        'num'   => '1',
        'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a9 9 0 1 0 9 9"/><path d="M12 7v5l3 2"/></svg>',
        'title' => 'Someone talks to your agent',
        'desc'  => 'A visitor lands on your site and asks about your services by voice or by text. Your AI receptionist answers, then collects their name and how to reach them.',
    ),
    array(
        'num'   => '2',
        'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>',
        'title' => 'SiteStaffr checks it is a real lead',
        'desc'  => 'Only qualified conversations move on. That means a name plus a phone number or a working email address. Browsers and half finished chats never clutter your CRM.',
    ),
    array(
        'num'   => '3',
        'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19V5"/><path d="m5 12 7-7 7 7"/></svg>',
        'title' => 'The Lead is created in Salesforce',
        'desc'  => 'The moment the conversation ends, SiteStaffr creates the Lead record in your Salesforce with the contact details, what they came for, and a recap of the whole conversation.',
    ),
    array(
        'num'   => '4',
        'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="m17 11 2 2 4-4"/></svg>',
        'title' => 'Your team follows up',
        'desc'  => 'It shows up in the same views, queues, and assignment rules your reps already use. Nothing new to learn, nothing to import.',
    ),
);

$sf_fields = array(
    array( 'label' => 'Name',          'value' => 'Split into first and last name on the Lead' ),
    array( 'label' => 'Phone / Email', 'value' => 'Whichever the visitor gave, mapped to the standard fields' ),
    array( 'label' => 'Company',       'value' => 'Your business name, so the Lead is never blank' ),
    array( 'label' => 'Lead Source',   'value' => 'Set to SiteStaffr on every record' ),
    array( 'label' => 'Interested in', 'value' => 'What they actually asked about, in their words' ),
    array( 'label' => 'Conversation',  'value' => 'An AI recap, the time, the channel, and a link to the full transcript' ),
);

$sf_features = array(
    array(
        'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>',
        'title' => 'Connect with your Salesforce login',
        'desc'  => 'Click Connect, sign in to Salesforce, done. There are no API keys to paste, no Connected App to register, and nothing for a developer to configure.',
    ),
    array(
        'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2 3 14h9l-1 8 10-12h-9l1-8Z"/></svg>',
        'title' => 'Leads arrive while they are still warm',
        'desc'  => 'The push happens as the conversation ends, not on an hourly sync. Your reps can call someone back who is still sitting on your website.',
    ),
    array(
        'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>',
        'title' => 'Report on what your website actually brings in',
        'desc'  => 'Every record comes in with Lead Source set to SiteStaffr, so you can filter, forecast, and prove the pipeline your site generates. No manual tagging.',
    ),
    array(
        'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Z"/><path d="M14 2v6h6"/><path d="M9 15h6"/><path d="M9 11h3"/></svg>',
        'title' => 'The whole conversation comes with it',
        'desc'  => 'Your rep opens the Lead and can read exactly what was said before they pick up the phone. No guessing what the visitor wanted.',
    ),
    array(
        'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/></svg>',
        'title' => 'Yours to disconnect, anytime',
        'desc'  => 'One click in your settings revokes the connection and clears it on our side. You are never locked in.',
    ),
    array(
        'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>',
        'title' => 'Never slows your site down',
        'desc'  => 'The push runs in the background after the conversation is already finished, so your visitor never waits on Salesforce.',
    ),
);

$sf_faqs = array(
    array(
        'q' => 'Do I need a developer or API keys to set this up?',
        'a' => 'No. You click Connect in your SiteStaffr settings, sign in with your normal Salesforce login, and approve the connection. SiteStaffr handles the OAuth side, so there is no Connected App to create, no keys to copy, and no callback URLs to configure.',
    ),
    array(
        'q' => 'Does every conversation create a Lead?',
        'a' => 'No, and that is deliberate. A conversation only syncs when it is a real lead, meaning the visitor gave a name plus either a phone number or a valid email address. People who just browse or ask a quick question never end up in your CRM.',
    ),
    array(
        'q' => 'What exactly gets created in Salesforce?',
        'a' => 'A standard Lead record. First and last name, phone, email, and your business name as the Company. Lead Source is set to SiteStaffr. The description holds a recap of the conversation, when it happened, whether it was voice or text, what they were interested in, and a link to the full transcript.',
    ),
    array(
        'q' => 'Can my reps read the full conversation?',
        'a' => 'Yes. Each Lead includes a secure link to the complete transcript, so whoever picks up the follow up can see exactly what was discussed before they reach out. The link stays valid for 90 days.',
    ),
    array(
        'q' => 'Will this work with my Salesforce edition?',
        'a' => 'It works with any Salesforce org that has API access enabled, which covers the standard sales editions most teams run. If you are not sure about your org, connect it and SiteStaffr will tell you right away, or reply to us and we will check with you.',
    ),
    array(
        'q' => 'What if I use a different CRM?',
        'a' => 'Salesforce is the first CRM we built natively, and it will not be the last. Tell us which one your team runs on. What gets built next is driven by what customers actually ask for.',
    ),
    array(
        'q' => 'How do I turn it off?',
        'a' => 'Go to SiteStaffr and then Integrations in your WordPress dashboard and click Disconnect. That revokes the connection with Salesforce and clears it on our side. Leads already in your CRM stay where they are, because they are yours.',
    ),
);
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <style>
/* ===== Salesforce integration landing page (scoped .sf-) ===== */
.sf-page { background: var(--cream); color: var(--text-primary); overflow-x: hidden; }

/* Hero */
.sf-hero { background: var(--cream); }
.block.sf-hero { padding-block-start: clamp(120px, 15vw, 140px); }
.sf-hero__grid {
    grid-template-columns: 1.05fr 0.95fr;
    gap: clamp(32px, 5vw, 64px);
}
.sf-hero__eyebrow {
    display: inline-block;
    font-family: var(--font-body);
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.09em;
    text-transform: uppercase;
    color: var(--teal-text);
    background: var(--teal-pale);
    border-radius: 999px;
    padding: 7px 15px;
    margin-bottom: 20px;
}
.sf-hero__title {
    font-family: var(--font-display);
    font-size: var(--hero-title-size);
    line-height: 1.08;
    letter-spacing: -0.02em;
    margin: 0 0 18px;
}
.sf-hero__title em {
    font-style: italic;
    color: var(--teal-deep);
}
.sf-hero__sub {
    font-size: clamp(1.02rem, 1.6vw, 1.18rem);
    line-height: 1.6;
    color: var(--text-secondary);
    max-width: 34em;
    margin: 0 0 30px;
}
.sf-hero__actions {
    display: flex;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
}
.sf-hero__seclink {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-weight: 600;
    color: var(--teal-text);
    text-decoration: none;
}
.sf-hero__seclink:hover { color: var(--teal-mid); }

/* Hero card — a Lead as it lands in Salesforce */
.sf-card {
    background: var(--warm-white);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
    overflow: hidden;
}
.sf-card__bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 14px 20px;
    background: var(--teal-deep);
    color: #fff;
}
.sf-card__bar strong {
    font-family: var(--font-body);
    font-size: 0.92rem;
    font-weight: 700;
    letter-spacing: 0.01em;
}
.sf-card__tag {
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    background: rgba(0,0,0,0.18);
    border-radius: 999px;
    padding: 5px 11px;
}
.sf-card__rows { padding: 6px 20px 18px; }
.sf-card__row {
    display: grid;
    grid-template-columns: 118px 1fr;
    gap: 14px;
    padding: 13px 0;
    border-bottom: 1px solid var(--border-light);
}
.sf-card__row:last-child { border-bottom: 0; }
.sf-card__label {
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    color: var(--text-muted);
    padding-top: 2px;
}
.sf-card__value {
    font-size: 0.95rem;
    line-height: 1.5;
    color: var(--text-primary);
}
.sf-card__foot {
    display: flex;
    align-items: center;
    gap: 9px;
    padding: 14px 20px;
    background: var(--emerald-light);
    color: #0f6848;
    font-size: 0.88rem;
    font-weight: 600;
}
.sf-card__foot svg { width: 17px; height: 17px; flex: 0 0 auto; }

/* Shared section furniture */
.sf-section { background: var(--cream); }
.sf-section__head { text-align: center; max-width: 720px; margin: 0 auto clamp(38px, 5vw, 58px); }
.sf-section__title {
    font-family: var(--font-display);
    font-size: clamp(1.9rem, 3.4vw, 2.6rem);
    line-height: 1.14;
    letter-spacing: -0.015em;
    margin: 0 0 14px;
}
.sf-section__lead {
    font-size: clamp(1rem, 1.5vw, 1.1rem);
    line-height: 1.62;
    color: var(--text-secondary);
    margin: 0;
}
.block--dark .sf-section__lead { color: rgba(240,250,250,0.8); }
.block--dark .section-label { color: var(--teal-light); }

.sf-steps {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: clamp(18px, 2.4vw, 28px);
}
.sf-step__icon {
    color: var(--teal-text);
    line-height: 0;
    margin-bottom: 14px;
}
.sf-step__icon svg { width: 26px; height: 26px; }
.sf-step__title { font-size: 1.06rem; font-weight: 700; margin: 0 0 9px; }
.sf-step__desc { font-size: 0.95rem; line-height: 1.6; color: var(--text-secondary); margin: 0; }

/* Feature grid — on the dark run */
.sf-features__grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: clamp(22px, 2.8vw, 34px);
}
.sf-feature {
    display: flex;
    gap: 16px;
}
.sf-feature__icon {
    flex: 0 0 auto;
    color: var(--teal-light);
    line-height: 0;
}
.sf-feature__icon svg { width: 24px; height: 24px; }
.sf-feature__title { font-size: 1.02rem; font-weight: 700; margin: 0 0 8px; }
.sf-feature__desc { font-size: 0.94rem; line-height: 1.6; color: rgba(240,250,250,0.8); margin: 0; }

/* Setup strip */
.sf-setup {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
    gap: clamp(20px, 2.6vw, 32px);
    counter-reset: sfsetup;
}
.sf-setup__item::before {
    counter-increment: sfsetup;
    content: counter(sfsetup);
    display: grid;
    place-items: center;
    width: 32px;
    height: 32px;
    border-radius: 999px;
    background: var(--teal-deep);
    color: #fff;
    font-weight: 700;
    font-size: 0.92rem;
    margin-bottom: 15px;
}
.sf-setup__item h3 { font-size: 1rem; font-weight: 700; margin: 0 0 7px; }
.sf-setup__item p { font-size: 0.93rem; line-height: 1.6; color: var(--text-secondary); margin: 0; }
.sf-setup__note {
    text-align: center;
    margin: clamp(28px, 4vw, 40px) auto 0;
    max-width: 620px;
    font-size: 0.95rem;
    line-height: 1.6;
    color: var(--text-secondary);
}

.sf-cta__title { color: #fff; margin: 0 0 14px; font-size: clamp(1.8rem, 4vw, 2.6rem); }
.sf-cta__text { color: rgba(240,250,250,0.8); font-size: 1.08rem; line-height: 1.7; margin: 0 0 32px; }

.feature-page > section:has(> .seam-curtain) { position: relative; }
.feature-page > section:has(> .seam-curtain--open) {
    padding-bottom: calc(var(--block-pad-light) + clamp(53px, 6.65vw, 114px));
}
.feature-page > section:has(> .seam-curtain--close) {
    padding-top: calc(var(--block-pad-light) + clamp(53px, 6.65vw, 114px));
}

@media (max-width: 900px) {
    .sf-hero__grid { grid-template-columns: 1fr; }
    .sf-hero__sub { max-width: none; }
}
@media (max-width: 768px) {
    .sf-hero__content { text-align: center; }
    .sf-hero__actions { justify-content: center; }
    .sf-hero__seclink { align-self: center; }
}
@media (max-width: 560px) {
    .sf-hero__actions { flex-direction: column; align-items: stretch; }
    .sf-hero__actions .btn { justify-content: center; }
    .sf-card__row { grid-template-columns: 1fr; gap: 4px; }
}
    </style>
</head>
<body <?php body_class( 'sf-page sitestaffr-salesforce-page' ); ?>>
<?php wp_body_open(); ?>

<?php get_template_part( 'template-parts/site-nav' ); ?>

<main class="feature-page">

    <section class="block block-split sf-hero">
        <div class="block__inner">
            <div class="block-split__grid sf-hero__grid">
                <div class="sf-hero__content reveal">
                    <span class="sf-hero__eyebrow">Included in every plan</span>
                    <h1 class="sf-hero__title">Your Website Fills Your&nbsp;<em>Salesforce</em></h1>
                    <p class="sf-hero__sub">SiteStaffr answers your visitors by voice and text 24/7, captures the ones who are serious, and creates the Lead in your Salesforce automatically. No exporting, no copy and paste, no lead sitting in an inbox.</p>
                    <div class="sf-hero__actions">
                        <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--primary btn--large">
                            Get Started
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                        <a href="#sf-how" class="sf-hero__seclink">
                            See how it works
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
                        </a>
                    </div>
                </div>

                <div class="sf-hero__visual reveal">
                    <div class="sf-card">
                        <div class="sf-card__bar">
                            <strong>New Lead</strong>
                            <span class="sf-card__tag">Lead Source: SiteStaffr</span>
                        </div>
                        <div class="sf-card__rows">
                            <?php foreach ( $sf_fields as $field ) : ?>
                                <div class="sf-card__row">
                                    <div class="sf-card__label"><?php echo esc_html( $field['label'] ); ?></div>
                                    <div class="sf-card__value"><?php echo esc_html( $field['value'] ); ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="sf-card__foot">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                            Created the moment the conversation ends
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="block block-cards sf-section" id="sf-how">
        <div class="block__inner">
            <div class="sf-section__head reveal">
                <span class="section-label">How It Works</span>
                <h2 class="sf-section__title">From a conversation to a Lead your team can work</h2>
                <p class="sf-section__lead">Your agent does the talking. SiteStaffr decides what counts as a real lead and hands it to Salesforce, already filled in.</p>
            </div>
            <div class="sf-steps">
                <?php foreach ( $sf_steps as $step ) : ?>
                    <div class="sf-step reveal">
                        <div class="sf-step__icon"><?php echo wp_kses( $step['icon'], array( 'svg' => array( 'viewbox' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true, 'stroke-linecap' => true, 'stroke-linejoin' => true ), 'path' => array( 'd' => true ), 'circle' => array( 'cx' => true, 'cy' => true, 'r' => true ), 'rect' => array( 'x' => true, 'y' => true, 'width' => true, 'height' => true, 'rx' => true ) ) ); ?></div>
                        <h3 class="sf-step__title"><?php echo wp_kses_post( $step['title'] ); ?></h3>
                        <p class="sf-step__desc"><?php echo wp_kses_post( $step['desc'] ); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php ?>
        <?php get_template_part( 'template-parts/seam-curtain' ); ?>
    </section>

    <section class="block block--dark sf-features">
        <div class="block__inner">
            <div class="sf-section__head reveal">
                <span class="section-label">Why It Is Different</span>
                <h2 class="sf-section__title">Built into SiteStaffr, not bolted on</h2>
                <p class="sf-section__lead">This is a native integration. There is no Zapier in the middle, no sync tool to babysit, and no per task fee for the privilege of moving your own leads.</p>
            </div>
            <div class="sf-features__grid">
                <?php foreach ( $sf_features as $feature ) : ?>
                    <div class="sf-feature reveal">
                        <div class="sf-feature__icon"><?php echo wp_kses( $feature['icon'], array( 'svg' => array( 'viewbox' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true, 'stroke-linecap' => true, 'stroke-linejoin' => true ), 'path' => array( 'd' => true ), 'circle' => array( 'cx' => true, 'cy' => true, 'r' => true ), 'rect' => array( 'x' => true, 'y' => true, 'width' => true, 'height' => true, 'rx' => true ) ) ); ?></div>
                        <div>
                            <h3 class="sf-feature__title"><?php echo wp_kses_post( $feature['title'] ); ?></h3>
                            <p class="sf-feature__desc"><?php echo wp_kses_post( $feature['desc'] ); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="block block-cards sf-section">
        <?php get_template_part( 'template-parts/seam-curtain', null, array( 'variant' => 'close' ) ); ?>
        <div class="block__inner">
            <div class="sf-section__head reveal">
                <span class="section-label">Setup</span>
                <h2 class="sf-section__title">Connected in about a minute</h2>
                <p class="sf-section__lead">If you can log in to Salesforce, you can turn this on.</p>
            </div>
            <div class="sf-setup">
                <div class="sf-setup__item reveal">
                    <h3>Open your integrations</h3>
                    <p>In your WordPress dashboard, go to SiteStaffr and then Integrations.</p>
                </div>
                <div class="sf-setup__item reveal">
                    <h3>Click Connect</h3>
                    <p>Find Salesforce in the list and click Connect. SiteStaffr sends you to Salesforce to sign in.</p>
                </div>
                <div class="sf-setup__item reveal">
                    <h3>Approve and you are done</h3>
                    <p>Sign in with your normal Salesforce login and approve the connection. New leads start flowing right away.</p>
                </div>
            </div>
            <p class="sf-setup__note reveal">Nothing to install, no API keys, and no Connected App to register. You can disconnect from the same screen whenever you want.</p>
        </div>
    </section>

    <section class="block faq-section" id="faq">
        <div class="block__inner">
            <div class="faq-section__head reveal">
                <span class="section-label">Common Questions</span>
                <h2>Salesforce integration FAQ</h2>
            </div>
            <div class="faq-list reveal">
                <?php foreach ( $sf_faqs as $faq ) : ?>
                    <div class="faq-item">
                        <button class="faq-item__question" type="button" aria-expanded="false">
                            <?php echo wp_kses_post( $faq['q'] ); ?>
                            <span class="faq-item__icon" aria-hidden="true"></span>
                        </button>
                        <div class="faq-item__answer">
                            <div class="faq-item__answer-inner"><?php echo wp_kses_post( $faq['a'] ); ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="block block--dark sf-cta">
        <div class="block__inner block-statement">
            <div class="sf-cta__inner reveal">
                <h2 class="sf-cta__title">Stop retyping your own leads</h2>
                <p class="sf-cta__text">Start free for 30 days. Let your website answer visitors, qualify them, and put them straight into Salesforce.</p>
                <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn sf-cta__btn">
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
