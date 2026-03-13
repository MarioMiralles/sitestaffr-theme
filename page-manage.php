<?php
/*
Template Name: Manage Account
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$page_title       = 'Manage Your Account | SiteStaffr';
$page_description = 'Manage your SiteStaffr subscription, billing, and account settings.';
$page_url         = get_permalink() ? get_permalink() : home_url( '/manage' );
$site_name        = get_bloginfo( 'name' );
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php echo esc_html( $page_title ); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo esc_attr( $page_description ); ?>">
    <meta name="robots" content="noindex, nofollow">
    <link rel="canonical" href="<?php echo esc_url( $page_url ); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class( 'sitestaffr-manage-page' ); ?>>
<?php wp_body_open(); ?>

<?php
get_template_part( 'template-parts/site-nav', null, array(
    'menu_items' => array(
        array( 'label' => 'Home', 'href' => home_url( '/' ) ),
    ),
) );
?>

<main class="hub" id="hub" data-view="loading">
  <div class="container">
    <div class="hub__header">
      <h1>Manage Your Account</h1>
      <p id="hubSubtitle">Loading your account...</p>
    </div>

    <!-- Banner (checkout result, session expired) -->
    <div class="hub__banner" id="hubBanner" hidden></div>

    <!-- VIEW: Loading -->
    <div class="hub__view hub__view--loading">
      <div class="hub__loading">
        <div class="hub__spinner"></div>
        <p>Checking your session...</p>
      </div>
    </div>

    <!-- VIEW: Site Picker (multi-site users) -->
    <div class="hub__view hub__view--site-picker">
      <div class="hub__sites-list" id="hubSitesList"></div>
    </div>

    <!-- VIEW: Unauthenticated -->
    <div class="hub__view hub__view--unauthenticated">
      <div class="form-card">
        <p style="color: var(--text-secondary); margin-bottom: 24px; text-align: center;">Enter your email to receive a secure login link.</p>
        <form id="magicLinkForm" novalidate>
          <div class="form-message" id="magicLinkMessage"></div>
          <div class="form-group">
            <label class="form-label" for="magicLinkEmail">Email address</label>
            <input class="form-input" type="email" id="magicLinkEmail" name="email" required autocomplete="email" placeholder="you@example.com">
            <span class="form-error">Please enter a valid email address.</span>
          </div>
          <div class="form-submit">
            <button type="submit" class="btn btn--primary" id="magicLinkSubmit">Send me a link</button>
          </div>
        </form>
        <div class="form-success" id="magicLinkSuccess" hidden>
          <div class="form-success__icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          </div>
          <h2 class="form-success__title">Check your email</h2>
          <p class="form-success__text">If an account exists for that email, you'll receive a secure link to manage your billing. The link expires in 30 minutes.</p>
        </div>
      </div>
    </div>

    <!-- VIEW: Authenticated -->
    <div class="hub__view hub__view--authenticated">
      <!-- Site switcher (multi-site only, populated by JS) -->
      <div class="hub__site-switcher" id="hubSiteSwitcher" hidden>
        <button type="button" class="hub__site-switcher-btn" id="hubSiteSwitcherBtn">
          <span class="hub__site-switcher-url" id="hubSiteSwitcherUrl"></span>
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
        <div class="hub__site-switcher-dropdown" id="hubSiteSwitcherDropdown" hidden></div>
      </div>

      <!-- Status card (populated by JS) -->
      <div class="hub__status-card" id="hubStatusCard"></div>

      <!-- Actions (populated by JS based on subscription state) -->
      <div class="hub__actions" id="hubActions"></div>

      <!-- Plan selection cards (shown for trial / cancelled users) -->
      <div id="hubPlans" hidden>
        <div class="hub__plans-header">
          <h2>Choose a plan</h2>
        </div>
        <div class="pricing-grid pricing-grid--hub">
          <div class="pricing-card">
            <div class="pricing-card__name">Starter</div>
            <div class="pricing-card__price">$10</div>
            <div class="pricing-card__price-sub">per month</div>
            <div class="pricing-card__divider"></div>
            <div class="pricing-card__minutes">60 minutes included</div>
            <ul class="pricing-card__features">
              <li>2 AI voice options</li>
              <li>3 AI description generations per cycle</li>
              <li>Great for steady weekly lead volume</li>
            </ul>
            <button type="button" class="btn btn--outline" data-plan="starter">Choose Starter</button>
          </div>
          <div class="pricing-card pricing-card--popular">
            <div class="pricing-card__badge">Most Popular</div>
            <div class="pricing-card__name">Business</div>
            <div class="pricing-card__price">$50</div>
            <div class="pricing-card__price-sub">per month</div>
            <div class="pricing-card__divider"></div>
            <div class="pricing-card__minutes">300 minutes included</div>
            <ul class="pricing-card__features">
              <li>5 AI voice options</li>
              <li>Custom greeting + 4 tone styles</li>
              <li>5 AI description generations per cycle</li>
            </ul>
            <button type="button" class="btn btn--primary" data-plan="business">Choose Business</button>
          </div>
          <div class="pricing-card">
            <div class="pricing-card__name">Pro</div>
            <div class="pricing-card__price">$100</div>
            <div class="pricing-card__price-sub">per month</div>
            <div class="pricing-card__divider"></div>
            <div class="pricing-card__minutes">700 minutes included</div>
            <ul class="pricing-card__features">
              <li>All 10 AI voices</li>
              <li>Custom greeting + 4 tone styles</li>
              <li>20 AI description generations per cycle</li>
              <li>Priority access to new features</li>
            </ul>
            <button type="button" class="btn btn--outline" data-plan="pro">Choose Pro</button>
          </div>
        </div>
      </div>

      <!-- Email section -->
      <div class="hub__email-section" id="hubEmailSection">
        <div>
          <div class="hub__email-label">Billing email</div>
          <div class="hub__email-value" id="hubEmailValue"></div>
        </div>
        <button type="button" class="hub__email-update" id="hubEmailUpdateBtn">Update</button>
      </div>
    </div>

    <!-- VIEW: Error -->
    <div class="hub__view hub__view--error">
      <div class="form-card" style="text-align: center;">
        <h2 style="color: var(--teal-deep); margin-bottom: 12px;">Something went wrong</h2>
        <p style="color: var(--text-secondary); margin-bottom: 24px;" id="hubErrorText">We couldn't load your account. Please try again.</p>
        <a href="<?php echo esc_url( home_url( '/manage' ) ); ?>" class="btn btn--primary">Try Again</a>
      </div>
    </div>

  </div>
</main>

<!-- Email update modal -->
<div class="hub__modal-backdrop" id="hubEmailModal" hidden>
  <div class="hub__modal">
    <h3>Update billing email</h3>
    <form id="emailUpdateForm" novalidate>
      <div class="form-message" id="emailUpdateMessage"></div>
      <div class="form-group">
        <label class="form-label" for="newEmail">New email address</label>
        <input class="form-input" type="email" id="newEmail" name="new_email" required autocomplete="email" placeholder="newemail@example.com">
        <span class="form-error">Please enter a valid email address.</span>
      </div>
      <div style="display: flex; gap: 12px; margin-top: 8px;">
        <button type="button" class="btn btn--outline" id="emailUpdateCancel" style="flex: 1;">Cancel</button>
        <button type="submit" class="btn btn--primary" id="emailUpdateSubmit" style="flex: 1;">Send verification</button>
      </div>
    </form>
  </div>
</div>

<?php get_template_part( 'template-parts/site-footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
