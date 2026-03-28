<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$page_title       = 'SiteStaffr Features | Voice, Text Chat, AI Knowledge, and More';
$page_description = 'Explore SiteStaffr features including voice and text conversations, AI Knowledge, recaps, transcripts, guided setup, and self-service account tools.';
$page_url         = home_url( '/features/' );
$site_name        = get_bloginfo( 'name' );
$get_started_url  = home_url( '/get-started/' );
$manage_url       = home_url( '/manage/' );
$body_classes     = array(
	'wp-theme-sitestaffr-website',
	'sitestaffr-page--default',
	'sitestaffr-features-page',
);

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
    <style>
.features-page-main.page-content {
    padding-bottom: 0;
    background:
        radial-gradient(circle at 10% 0%, rgba(31,182,204,0.08) 0%, rgba(31,182,204,0) 24%),
        radial-gradient(circle at 100% 18%, rgba(16,185,129,0.08) 0%, rgba(16,185,129,0) 26%),
        linear-gradient(180deg, #fefdfb 0%, #f8f5ee 100%);
}
.features-page-hero {
    padding: 0 0 56px;
}
.features-page-hero__header {
    max-width: 760px;
    margin: 0 auto;
    text-align: center;
}
.features-page-hero__header h1 {
    margin-bottom: 18px;
}
.features-page-hero__subtitle {
    font-size: 1.08rem;
    line-height: 1.75;
    color: var(--text-secondary);
    max-width: 680px;
    margin: 0 auto 22px;
}
.features-page-hero__tags {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
}
.features-page-hero__tag {
    padding: 8px 14px;
    border-radius: 999px;
    background: white;
    border: 1px solid rgba(0,131,143,0.12);
    color: var(--text-secondary);
    font-size: 0.85rem;
    font-weight: 600;
}
.features-page-section {
    padding: 0 0 72px;
}
.features-page-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 22px;
}
.features-page-card {
    background: white;
    border: 1.5px solid var(--border-light);
    border-radius: var(--radius-lg);
    padding: 24px;
    box-shadow: var(--shadow-sm);
}
.features-page-card__icon {
    width: 46px;
    height: 46px;
    border-radius: 14px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
    color: var(--teal-deep);
    background: linear-gradient(135deg, rgba(31,182,204,0.16), rgba(16,185,129,0.14));
}
.features-page-card h3 {
    font-size: 1.08rem;
    margin: 0 0 10px;
}
.features-page-card p {
    margin: 0;
    color: var(--text-secondary);
    line-height: 1.7;
    font-size: 0.94rem;
}
.features-page-chat {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(0, 1.05fr);
    gap: 28px;
    align-items: stretch;
}
.features-page-chat__content,
.features-page-chat__mockup {
    background: white;
    border: 1.5px solid var(--border-light);
    border-radius: var(--radius-lg);
    padding: 30px;
    box-shadow: var(--shadow-sm);
}
.features-page-chat__content {
    background: linear-gradient(180deg, #ffffff 0%, #f7fbfc 100%);
}
.features-page-chat__content h2 {
    margin-bottom: 14px;
}
.features-page-chat__content p {
    color: var(--text-secondary);
    line-height: 1.75;
    margin-bottom: 18px;
}
.features-page-chat__mockup {
    background: linear-gradient(180deg, #f5fbfb 0%, #eef8f5 100%);
}
.features-page-chat__window {
    height: 100%;
    min-height: 100%;
    background: white;
    border: 1px solid rgba(0,131,143,0.1);
    border-radius: 24px;
    overflow: hidden;
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.8);
}
.features-page-chat__window-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 14px 18px;
    background: rgba(248,251,252,0.92);
    border-bottom: 1px solid rgba(0,131,143,0.1);
    font-size: 0.85rem;
    color: var(--text-secondary);
    font-weight: 600;
}
.features-page-chat__window-title {
    color: var(--text-primary);
}
.features-page-chat__status {
    display: inline-flex;
    align-items: center;
    gap: 8px;
}
.features-page-chat__status-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--emerald);
    box-shadow: 0 0 0 6px rgba(16,185,129,0.14);
}
.features-page-chat__messages {
    display: grid;
    gap: 12px;
    padding: 18px;
    background: linear-gradient(180deg, #ffffff 0%, #f8fcfc 100%);
}
.features-page-chat__message {
    max-width: 85%;
    padding: 12px 14px;
    border-radius: 18px;
    font-size: 0.92rem;
    line-height: 1.65;
}
.features-page-chat__message--assistant {
    color: var(--text-primary);
    background: white;
    border: 1px solid rgba(0,131,143,0.1);
    border-top-left-radius: 6px;
}
.features-page-chat__message--user {
    margin-left: auto;
    color: white;
    background: linear-gradient(135deg, var(--teal-deep), #0d8f9c);
    border-top-right-radius: 6px;
}
.features-page-chat__chips {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    padding: 0 18px 18px;
}
.features-page-chat__chip {
    padding: 8px 12px;
    border-radius: 999px;
    background: rgba(0,131,143,0.08);
    color: var(--teal-deep);
    font-size: 0.82rem;
    font-weight: 600;
}
.features-page-bullets {
    list-style: none;
    display: grid;
    gap: 12px;
    padding: 0;
    margin: 0;
}
.features-page-bullets li {
    position: relative;
    padding-left: 24px;
    color: var(--text-secondary);
    line-height: 1.65;
}
.features-page-bullets li::before {
    content: '';
    position: absolute;
    left: 0;
    top: 11px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--teal-deep), var(--emerald));
}
.features-page-media-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 22px;
}
.features-page-media-card {
    background: white;
    border: 1.5px solid var(--border-light);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}
.features-page-media-card img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    object-position: top left;
    border-bottom: 1px solid var(--border-light);
}
.features-page-media-card__body {
    padding: 20px 22px 22px;
}
.features-page-media-card__body h3 {
    margin: 0 0 10px;
    font-size: 1.03rem;
}
.features-page-media-card__body p {
    margin: 0;
    color: var(--text-secondary);
    line-height: 1.65;
    font-size: 0.92rem;
}
.features-page-cta {
    padding: 0 0 var(--section-padding);
}
.features-page-cta__panel {
    text-align: center;
    background: linear-gradient(135deg, #ffffff 0%, #f3fbfc 100%);
    border: 1.5px solid rgba(0,131,143,0.12);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
    padding: 36px 28px;
}
.features-page-cta__panel h2 {
    margin-bottom: 12px;
}
.features-page-cta__panel p {
    max-width: 660px;
    margin: 0 auto 22px;
    color: var(--text-secondary);
    line-height: 1.75;
}
.features-page-cta__actions {
    display: flex;
    flex-wrap: wrap;
    gap: 14px;
    justify-content: center;
}
@media (max-width: 1024px) {
    .features-page-grid,
    .features-page-media-grid {
        grid-template-columns: 1fr 1fr;
    }
    .features-page-chat {
        grid-template-columns: 1fr;
    }
}
@media (max-width: 768px) {
    .features-page-grid,
    .features-page-media-grid {
        grid-template-columns: 1fr;
    }
    .features-page-chat__content,
    .features-page-chat__mockup,
    .features-page-card {
        padding: 22px 20px;
    }
    .features-page-media-card img {
        height: 200px;
    }
    .features-page-chat__window-header {
        flex-direction: column;
        align-items: flex-start;
    }
    .features-page-chat__message {
        max-width: 92%;
    }
}
    </style>
</head>
<body class="<?php echo esc_attr( implode( ' ', $body_classes ) ); ?>">
<?php wp_body_open(); ?>

<?php
get_template_part( 'template-parts/site-nav', null, array(
	'menu_items' => array(
		array( 'label' => 'Home', 'href' => home_url( '/' ) ),
		array( 'label' => 'Get Started', 'href' => $get_started_url ),
		array( 'label' => 'My Account', 'href' => $manage_url ),
	),
	'cta' => array(
		'label' => 'Get Started',
		'href'  => $get_started_url,
	),
) );
?>

<main class="features-page-main page-content">
  <section class="features-page-hero">
    <div class="container">
      <div class="features-page-hero__header">
        <span class="section-label">Product overview</span>
        <h1>Everything SiteStaffr can handle on your website</h1>
        <p class="features-page-hero__subtitle">Voice is still the wow moment, but it is not the whole product. SiteStaffr can help visitors by voice or text, use your business information to answer more confidently, send clear follow-up after conversations, and make setup and account access easier.</p>
        <div class="features-page-hero__tags">
          <span class="features-page-hero__tag">Voice + text</span>
          <span class="features-page-hero__tag">AI Knowledge</span>
          <span class="features-page-hero__tag">Recaps + transcripts</span>
          <span class="features-page-hero__tag">Guided setup</span>
          <span class="features-page-hero__tag">Billing Hub</span>
        </div>
      </div>
    </div>
  </section>

  <section class="features-page-section">
    <div class="container">
      <div class="features-page-chat">
        <div class="features-page-chat__content">
          <span class="section-label">Text chat</span>
          <h2>A real chatbot option for visitors who would rather type</h2>
          <p>Text chat deserves its own spotlight because a lot of visitors are browsing at work, in public, or in moments where talking out loud is not ideal. SiteStaffr gives them a clean typing experience in the same assistant your voice experience uses.</p>
          <ul class="features-page-bullets">
            <li>Lives in the same widget as voice, so visitors can choose what feels natural</li>
            <li>Uses the same AI Knowledge and business details that power voice answers</li>
            <li>Helps people get answers quietly on mobile, at work, or anywhere they would rather type</li>
            <li>Keeps the conversation and your follow-up context together instead of splitting it across tools</li>
          </ul>
        </div>
        <div class="features-page-chat__mockup" aria-hidden="true">
          <div class="features-page-chat__window">
            <div class="features-page-chat__window-header">
              <span class="features-page-chat__window-title">SiteStaffr chat</span>
              <span class="features-page-chat__status"><span class="features-page-chat__status-dot"></span>Ready to help</span>
            </div>
            <div class="features-page-chat__messages">
              <div class="features-page-chat__message features-page-chat__message--assistant">Hi there. I can help with hours, pricing, services, or pass along a message if you need a follow-up.</div>
              <div class="features-page-chat__message features-page-chat__message--user">Do you handle Saturday appointments?</div>
              <div class="features-page-chat__message features-page-chat__message--assistant">Yes. Saturday appointments are available from 9:00 AM to 1:00 PM. If you want, I can also collect your name and best callback number for the team.</div>
              <div class="features-page-chat__message features-page-chat__message--user">Can someone call me about pricing?</div>
              <div class="features-page-chat__message features-page-chat__message--assistant">Absolutely. Send your name and number, and I&apos;ll include it in the follow-up recap so nothing gets missed.</div>
            </div>
            <div class="features-page-chat__chips">
              <span class="features-page-chat__chip">Hours</span>
              <span class="features-page-chat__chip">Pricing</span>
              <span class="features-page-chat__chip">Services</span>
              <span class="features-page-chat__chip">Request follow-up</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="features-page-section">
    <div class="container">
      <div class="features-page-grid">
        <article class="features-page-card">
          <span class="features-page-card__icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>
          </span>
          <h3>Natural voice conversations</h3>
          <p>Visitors can talk to your website and hear SiteStaffr respond out loud, which is still the strongest first impression for the product.</p>
        </article>
        <article class="features-page-card">
          <span class="features-page-card__icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M12 4h9"/><path d="M4 9h16"/><path d="M4 15h16"/><path d="M8 4v16"/></svg>
          </span>
          <h3>AI Knowledge from your website</h3>
          <p>SiteStaffr can use your website content and synced business information so answers feel grounded in your real hours, services, FAQs, and details.</p>
        </article>
        <article class="features-page-card">
          <span class="features-page-card__icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16v16H4z"/><path d="M8 8h8"/><path d="M8 12h8"/><path d="M8 16h5"/></svg>
          </span>
          <h3>Email recaps and transcripts</h3>
          <p>After each conversation, you get a recap, the saved transcript, and clearer follow-up context so nothing important gets lost.</p>
        </article>
        <article class="features-page-card">
          <span class="features-page-card__icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12h18"/><path d="M12 3v18"/><circle cx="12" cy="12" r="9"/></svg>
          </span>
          <h3>Guided onboarding and setup help</h3>
          <p>SiteStaffr includes persona-driven onboarding flows and AI-assisted business setup so getting live feels guided instead of technical.</p>
        </article>
        <article class="features-page-card">
          <span class="features-page-card__icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/><path d="M6 15h2"/></svg>
          </span>
          <h3>Billing Hub and self-service access</h3>
          <p>Customers can manage plans, add-on minutes, and team billing access from a secure email link without logging into WordPress.</p>
        </article>
        <article class="features-page-card">
          <span class="features-page-card__icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7h18"/><path d="M7 3v8"/><path d="M17 13v8"/><path d="M3 17h18"/><circle cx="7" cy="17" r="2"/><circle cx="17" cy="7" r="2"/></svg>
          </span>
          <h3>Follow-up clarity after every conversation</h3>
          <p>See who reached out, what they asked, and which conversations deserve your attention once you are ready to step in.</p>
        </article>
      </div>
    </div>
  </section>

  <section class="features-page-section">
    <div class="container">
      <div class="features-page-media-grid">
        <article class="features-page-media-card">
          <img src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/after-conversation-email-recap.png' ) ); ?>" alt="SiteStaffr email recap preview" loading="lazy" decoding="async">
          <div class="features-page-media-card__body">
            <h3>Email recap</h3>
            <p>A quick summary hits your inbox when the conversation ends so you know what happened without replaying everything from scratch.</p>
          </div>
        </article>
        <article class="features-page-media-card">
          <img src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/after-conversation-transcript.png' ) ); ?>" alt="SiteStaffr transcript preview" loading="lazy" decoding="async">
          <div class="features-page-media-card__body">
            <h3>Saved transcript</h3>
            <p>Review the full conversation when you need the details, especially for follow-up, quotes, scheduling, or training.</p>
          </div>
        </article>
        <article class="features-page-media-card">
          <img src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/features-dashboard.png' ) ); ?>" alt="SiteStaffr dashboard preview" loading="lazy" decoding="async">
          <div class="features-page-media-card__body">
            <h3>Dashboard and follow-up context</h3>
            <p>See who reached out, what they needed, and which conversations deserve your attention once you have time to step in.</p>
          </div>
        </article>
      </div>
    </div>
  </section>

  <section class="features-page-cta">
    <div class="container">
      <div class="features-page-cta__panel">
        <span class="section-label">Next step</span>
        <h2>Ready to see which setup fits your business?</h2>
        <p>Start with the guided onboarding flow if you want help getting SiteStaffr ready to go live, or open the Billing Hub if you already use SiteStaffr and need account access.</p>
        <div class="features-page-cta__actions">
          <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--primary">Get Started</a>
          <a href="<?php echo esc_url( $manage_url ); ?>" class="btn btn--outline">Open Billing Hub</a>
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_template_part( 'template-parts/site-footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
