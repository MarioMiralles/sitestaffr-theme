<?php
/*
Template Name: Get Started
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$page_title       = 'Get Started with SiteStaffr | White-Glove AI Voice Agent Setup';
$page_description = 'Let us set up your AI voice agent. Fill out the form and we\'ll reach out to get you started.';
$page_url         = get_permalink() ? get_permalink() : home_url( '/get-started' );
$site_name        = get_bloginfo( 'name' );
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
/* Voice agent section */
.voice-section {
    text-align: center;
    margin-bottom: 32px;
}
.voice-section__cta {
    margin-bottom: 24px;
}

/* Privacy notice */
.privacy-notice {
    font-size: 13px;
    color: #666;
    margin-top: 16px;
}
.privacy-notice a {
    color: #1FB6CC;
}

/* Section divider */
.section-divider {
    text-align: center;
    margin: 32px 0;
    position: relative;
    cursor: pointer;
    user-select: none;
}
.section-divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: #e0e0e0;
}
.section-divider__text {
    position: relative;
    background: var(--cream, #FEFDFB);
    padding: 0 16px;
    color: #999;
    font-size: 14px;
}
.section-divider__chevron {
    display: inline-block;
    font-size: 10px;
    transition: transform 0.3s ease;
    margin-left: 4px;
}
.section-divider.is-open .section-divider__chevron {
    transform: rotate(180deg);
}

/* Collapsible form wrapper */
.form-collapse-wrapper {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.4s ease;
}

/* Hide global floating widget on get-started page */
#sitestaffr-widget { display: none !important; }
    </style>
</head>
<body <?php body_class( 'sitestaffr-get-started-page' ); ?>>
<?php wp_body_open(); ?>

<?php
get_template_part( 'template-parts/site-nav', null, array(
    'menu_items' => array(
        array( 'label' => 'Home', 'href' => home_url( '/' ) ),
    ),
) );
?>

<main class="intake">
  <div class="container">
    <div class="intake__header">
      <span class="section-label">White-glove setup</span>
      <h1>Let us set up your AI voice agent</h1>
      <p class="intake__subtitle">Talk to our AI voice agent to get started, or fill out the form below.</p>
    </div>

    <div class="voice-section">
        <div class="voice-section__cta">
            <?php echo do_shortcode( '[sitestaffr_button persona="onboarding" variant="hero" text="Tell Us About Your Business" background_color="#1FB6CC" hover_background="#00838F" gradient="off" icon="sitestaffr"]' ); ?>
        </div>

        <p class="privacy-notice">Your information will be used to set up your SiteStaffr voice agent. See our <a href="/privacy-policy/">Privacy Policy</a>.</p>
    </div>

    <div class="section-divider" id="formToggle">
        <span class="section-divider__text">
            Prefer to type? <span class="section-divider__chevron">&#9660;</span>
        </span>
    </div>

    <div class="form-collapse-wrapper" id="formCollapseWrapper">
    <div class="form-card" id="intakeFormCard">
      <form id="intakeForm" novalidate>
        <div class="form-message" id="intakeMessage"></div>

        <div class="form-group">
          <label class="form-label" for="intakeBusiness">Business name</label>
          <input class="form-input" type="text" id="intakeBusiness" name="business_name" required autocomplete="organization" placeholder="Acme Plumbing">
          <span class="form-error">Please enter your business name.</span>
        </div>

        <div class="form-group">
          <label class="form-label" for="intakeWebsite">Website URL</label>
          <input class="form-input" type="url" id="intakeWebsite" name="website_url" required autocomplete="url" placeholder="https://example.com">
          <span class="form-error">Please enter a valid website URL.</span>
        </div>

        <div class="form-group">
          <label class="form-label" for="intakeEmail">Email</label>
          <input class="form-input" type="email" id="intakeEmail" name="email" required autocomplete="email" placeholder="you@example.com">
          <span class="form-error">Please enter a valid email address.</span>
        </div>

        <div class="form-group">
          <label class="form-label" for="intakePhone">Phone number</label>
          <input class="form-input" type="tel" id="intakePhone" name="phone" required autocomplete="tel" placeholder="(555) 123-4567">
          <span class="form-error">Please enter your phone number.</span>
        </div>

        <div class="form-submit">
          <button type="submit" class="btn btn--primary" id="intakeSubmit">Send Request</button>
        </div>
      </form>

      <div class="form-success" id="intakeSuccess" hidden>
        <div class="form-success__icon">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
        <h2 class="form-success__title">We'll be in touch!</h2>
        <p class="form-success__text">Thanks for your interest in SiteStaffr. We'll reach out within one business day to get your AI voice agent set up.</p>
      </div>
    </div>
    </div>
  </div>
</main>

<?php get_template_part( 'template-parts/site-footer' ); ?>

<script>
(function() {
  /* Form collapse toggle */
  var toggle = document.getElementById('formToggle');
  var wrapper = document.getElementById('formCollapseWrapper');
  if (toggle && wrapper) {
    toggle.addEventListener('click', function() {
      var isOpen = toggle.classList.toggle('is-open');
      if (isOpen) {
        wrapper.style.maxHeight = wrapper.scrollHeight + 'px';
      } else {
        wrapper.style.maxHeight = '0';
      }
    });
  }

  /* Typed form submission */
  var form = document.getElementById('intakeForm');
  var submitBtn = document.getElementById('intakeSubmit');
  var successEl = document.getElementById('intakeSuccess');
  var messageEl = document.getElementById('intakeMessage');
  var apiUrl = '<?php echo esc_js( SITESTAFFR_MIDDLEWARE_URL ); ?>';

  form.addEventListener('submit', function(e) {
    e.preventDefault();

    /* Clear previous errors */
    form.querySelectorAll('.form-group--error').forEach(function(g) {
      g.classList.remove('form-group--error');
    });
    messageEl.className = 'form-message';
    messageEl.textContent = '';

    /* Normalize website URL — prepend https:// if missing */
    var urlInput = document.getElementById('intakeWebsite');
    var urlVal = urlInput.value.trim();
    if (urlVal && !/^https?:\/\//i.test(urlVal)) {
      urlInput.value = 'https://' + urlVal;
    }

    /* Validate */
    var valid = true;
    form.querySelectorAll('[required]').forEach(function(input) {
      if (!input.value.trim() || !input.checkValidity()) {
        input.closest('.form-group').classList.add('form-group--error');
        valid = false;
      }
    });
    if (!valid) return;

    /* Submit */
    submitBtn.disabled = true;
    submitBtn.textContent = 'Sending\u2026';

    fetch(apiUrl + '/api/onboarding/intake', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        business_name: form.business_name.value.trim(),
        website_url: form.website_url.value.trim(),
        email: form.email.value.trim(),
        phone: form.phone.value.trim()
      })
    })
    .then(function(res) {
      if (!res.ok) throw new Error('Request failed');
      form.hidden = true;
      successEl.hidden = false;
    })
    .catch(function() {
      messageEl.className = 'form-message form-message--error';
      messageEl.textContent = 'Something went wrong. Please try again or email support@sitestaffr.com.';
      submitBtn.disabled = false;
      submitBtn.textContent = 'Send Request';
    });
  });
})();
</script>

<?php wp_footer(); ?>
</body>
</html>
