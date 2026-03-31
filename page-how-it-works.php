<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$page_title       = 'How SiteStaffr Works | Two Ways to Get Started';
$page_description = 'Set up SiteStaffr yourself in minutes or let us do it for you. Two simple paths to a live AI voice and text assistant on your website.';
$page_url         = home_url( '/how-it-works/' );
$site_name        = get_bloginfo( 'name' );
$get_started_url  = home_url( '/get-started/' );
$body_classes     = array( 'wp-theme-sitestaffr-website', 'sitestaffr-page--how-it-works' );
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

<?php get_template_part( 'template-parts/site-nav' ); ?>

<main class="hiw-page">

  <!-- Section 1: Hero -->
  <section class="hiw-hero">
    <div class="container">
      <div class="hiw-hero__content reveal">
        <h1>Two ways to get started. Both take minutes.</h1>
        <p class="hiw-hero__subtitle">No technical skills required. No developers needed. Pick the path that feels right for you.</p>
      </div>
    </div>
  </section>

  <!-- Section 2: Two Paths -->
  <section class="hiw-paths">
    <div class="container">
      <div class="hiw-paths__grid">
        <div class="hiw-path reveal">
          <div class="hiw-path__header">
            <span class="hiw-path__badge">Path A</span>
            <h2 class="hiw-path__title">Set it up yourself</h2>
          </div>
          <ol class="hiw-path__steps">
            <li>
              <strong>Install the WordPress plugin</strong>
              <span>Upload and activate, just like any other plugin.</span>
              <span class="hiw-path__time">~2 minutes</span>
            </li>
            <li>
              <strong>Run through the Setup Wizard</strong>
              <span>Add your business info, choose your plan, set your hours.</span>
              <span class="hiw-path__time">~5&ndash;8 minutes</span>
            </li>
            <li>
              <strong>Your AI assistant goes live immediately</strong>
              <span>Visitors can start talking to your website right away.</span>
            </li>
          </ol>
          <p class="hiw-path__note">The wizard handles everything, including payment if you choose a paid plan.</p>
        </div>

        <div class="hiw-path reveal reveal-delay-1">
          <div class="hiw-path__header">
            <span class="hiw-path__badge">Path B</span>
            <h2 class="hiw-path__title">We&rsquo;ll do it for you</h2>
          </div>
          <ol class="hiw-path__steps">
            <li>
              <strong>Talk to our onboarding assistant or fill out a short form</strong>
              <span>Tell us about your business in a quick conversation.</span>
            </li>
            <li>
              <strong>We&rsquo;ll reach out to gather what we need</strong>
              <span>A quick call or email to fill in any details.</span>
            </li>
            <li>
              <strong>We install and configure everything on your site</strong>
              <span>You don't touch a thing.</span>
            </li>
            <li>
              <strong>Your AI assistant goes live with a free trial</strong>
              <span>Start seeing conversations right away.</span>
            </li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Section 3: What Happens After -->
  <section class="hiw-after">
    <div class="container">
      <div class="hiw-after__content reveal">
        <h2>What happens after you&rsquo;re live</h2>
        <ul class="hiw-after__list">
          <li>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--teal-light)" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
            <span>You get an email recap after every visitor conversation</span>
          </li>
          <li>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--teal-light)" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
            <span>Full transcripts saved in your WordPress dashboard</span>
          </li>
          <li>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--teal-light)" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
            <span>Manage everything from your admin panel &mdash; no code, no external tools</span>
          </li>
          <li>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--teal-light)" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
            <span>Upgrade, add minutes, or adjust settings anytime</span>
          </li>
        </ul>
      </div>
    </div>
  </section>

  <!-- Section 4: CTA -->
  <section class="hiw-cta">
    <div class="container reveal">
      <h2>Ready?</h2>
      <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--primary btn--large">
        Get Started
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
    </div>
  </section>

</main>

<?php get_template_part( 'template-parts/site-footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
