<?php
/*
Template Name: Manage Account
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class( 'sitestaffr-manage-page' ); ?>>
<?php wp_body_open(); ?>

<?php get_template_part( 'template-parts/site-nav' ); ?>

<main class="hub" id="hub" data-view="loading">
  <div class="container">
    <div class="hub__header">
      <h1>Manage Your Account</h1>
      <p id="hubSubtitle">No WordPress login required. Loading your billing access...</p>
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
        <form id="magicLinkForm" novalidate>
          <p style="color: var(--text-secondary); margin-bottom: 24px; text-align: center;">Enter the email you use for billing access. We&rsquo;ll send a code so you can manage your plan, add-on minutes, and team billing access.</p>
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
        <div class="pin-entry" id="pinEntry" hidden>
          <div class="form-success__icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          </div>
          <h2 class="form-success__title">Check your email</h2>
          <p class="pin-entry__subtitle">We sent a 6-digit code to <strong id="pinEntryEmail"></strong></p>
          <div class="form-message" id="pinMessage"></div>
          <div class="pin-entry__field">
            <input class="form-input pin-entry__input" type="text" id="pinCode" inputmode="numeric" autocomplete="one-time-code" maxlength="7" placeholder="000 000">
          </div>
          <div class="form-submit">
            <button type="button" class="btn btn--primary" id="pinVerifyBtn">Verify</button>
          </div>
          <div class="pin-entry__links">
            <button type="button" class="pin-entry__link" id="pinResend">Didn&rsquo;t receive it? Resend code</button>
            <button type="button" class="pin-entry__link" id="pinDifferentEmail">Use a different email</button>
          </div>
        </div>
      </div>
    </div>

    <!-- VIEW: Authenticated -->
    <div class="hub__view hub__view--authenticated">
      <div class="hub__sign-out-row">
        <button type="button" class="hub__sign-out-btn" id="hubSignOut">Sign out</button>
      </div>
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
            <div class="pricing-card__price">$29</div>
            <div class="pricing-card__price-sub">per month</div>
            <div class="pricing-card__divider"></div>
            <div class="pricing-card__minutes">100 voice minutes included</div>
            <ul class="pricing-card__features">
              <li>Unlimited AI text chat</li>
              <li>2 AI voice options</li>
              <li>3 AI description generations per cycle</li>
              <li>Great for steady weekly lead volume</li>
            </ul>
            <button type="button" class="btn btn--outline" data-plan="starter">Choose Starter</button>
          </div>
          <div class="pricing-card pricing-card--popular">
            <div class="pricing-card__badge">Most Popular</div>
            <div class="pricing-card__name">Business</div>
            <div class="pricing-card__price">$69</div>
            <div class="pricing-card__price-sub">per month</div>
            <div class="pricing-card__divider"></div>
            <div class="pricing-card__minutes">300 voice minutes included</div>
            <ul class="pricing-card__features">
              <li>Unlimited AI text chat</li>
              <li>5 AI voice options</li>
              <li>Custom greeting + 4 tone styles</li>
              <li>5 AI description generations per cycle</li>
            </ul>
            <button type="button" class="btn btn--primary" data-plan="business">Choose Business</button>
          </div>
          <div class="pricing-card">
            <div class="pricing-card__name">Pro</div>
            <div class="pricing-card__price">$129</div>
            <div class="pricing-card__price-sub">per month</div>
            <div class="pricing-card__divider"></div>
            <div class="pricing-card__minutes">600 voice minutes included</div>
            <ul class="pricing-card__features">
              <li>Unlimited AI text chat</li>
              <li>All 10 AI voices</li>
              <li>Custom greeting + 4 tone styles</li>
              <li>20 AI description generations per cycle</li>
              <li>Priority access to new features</li>
            </ul>
            <button type="button" class="btn btn--outline" data-plan="pro">Choose Pro</button>
          </div>
        </div>
      </div>

      <!-- Authorized emails section (rendered by JS) -->
      <div class="hub__auth-emails" id="hub-auth-emails"></div>
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

<!-- Buy More Minutes modal -->
<div class="hub__modal-backdrop" id="hubBuyModal" hidden>
  <div class="hub__modal hub__buy-modal">
    <div class="hub__buy-header">
      <h3>Buy More Minutes</h3>
      <button type="button" class="hub__buy-close" id="hubBuyClose" aria-label="Close">&times;</button>
    </div>
    <div class="hub__buy-body">
      <div class="hub__buy-product">
        <div class="hub__buy-product-name">Add-on Minutes Pack</div>
        <div class="hub__buy-product-detail">60 minutes per pack &middot; Add-on minutes never expire</div>
      </div>
      <div class="hub__buy-stepper-row">
        <span class="hub__buy-stepper-label">Quantity</span>
        <div class="hub__buy-stepper">
          <button type="button" class="hub__buy-stepper-btn" id="hubBuyMinus" disabled aria-label="Decrease quantity">&minus;</button>
          <span class="hub__buy-stepper-value" id="hubBuyQty">1</span>
          <button type="button" class="hub__buy-stepper-btn" id="hubBuyPlus" aria-label="Increase quantity">+</button>
        </div>
      </div>
      <div class="hub__buy-summary">
        <span class="hub__buy-summary-minutes" id="hubBuyMinutesDisplay">60 minutes</span>
        <span class="hub__buy-summary-price" id="hubBuyPriceDisplay">$10</span>
      </div>
    </div>
    <div class="hub__buy-footer">
      <button type="button" class="btn btn--outline" id="hubBuyCancel">Cancel</button>
      <button type="button" class="btn btn--primary" id="hubBuyConfirm">Confirm Purchase</button>
    </div>
  </div>
</div>

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
      <div class="hub__email-modal-actions">
        <button type="button" class="btn btn--outline" id="emailUpdateCancel">Cancel</button>
        <button type="submit" class="btn btn--primary" id="emailUpdateSubmit">Send verification</button>
      </div>
    </form>
  </div>
</div>

<?php get_template_part( 'template-parts/site-footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
