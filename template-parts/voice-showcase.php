<?php /* ⚠️ NEVER "callers" IN THESE DESCRIPTIONS. SiteStaffr has no phone line - the
         readme leads with "No phone lines" - and with "AI Receptionist" in the homepage
         H1, the word puts the product in the phone-answering category, which is crowded,
         different and more expensive. These are voices a VISITOR hears on a website.
         Swept. */ ?>
<?php
/**
 * Voice Showcase Carousel — shared between homepage and features page.
 *
 * Accepts $args:
 *   'id'              => string  HTML id for the container (default: 'voiceShowcase')
 *   'extra_classes'   => string  Additional CSS classes (default: '')
 *   'show_header'     => bool    Whether to show the header (default: true)
 *   'header_title'    => string  Override header title
 *   'header_subtitle' => string  Override header subtitle
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$showcase_id     = isset( $args['id'] ) ? $args['id'] : 'voiceShowcase';
$extra_classes   = isset( $args['extra_classes'] ) ? ' ' . $args['extra_classes'] : '';
$show_header     = isset( $args['show_header'] ) ? (bool) $args['show_header'] : true;
$header_label    = isset( $args['header_label'] ) ? $args['header_label'] : 'Hear the Difference';
$header_title    = isset( $args['header_title'] ) ? $args['header_title'] : 'Meet Your AI Voice Agent';
$header_subtitle = isset( $args['header_subtitle'] ) ? $args['header_subtitle'] : '<span>Choose from 10 unique AI voices, each with their own personality.</span> <span>Preview them right here.</span>';

$showcase_theme_url = get_stylesheet_directory_uri();
$showcase_voices    = array(
	array( 'name' => 'Marin',   'file' => 'marin',   'personality' => 'Warm & Welcoming',    'description' => 'Makes your visitors feel right at home with a friendly, inviting tone that puts people at ease. Perfect for service businesses that prioritize customer comfort.',       'bestFor' => 'Home Services | Hospitality | Customer Support',        'plan' => 'Starter',  'recommended' => true ),
	array( 'name' => 'Cedar',   'file' => 'cedar',   'personality' => 'Smooth & Natural',    'description' => 'Brings a calm, professional presence to every interaction. Ideal for businesses that want to project reliability and trustworthiness.',                                  'bestFor' => 'Professional Services | Local Agencies | Legal Offices', 'plan' => 'Starter',  'recommended' => true ),
	array( 'name' => 'Sage',    'file' => 'sage',    'personality' => 'Wise & Thoughtful',   'description' => 'A measured, trustworthy tone that conveys expertise. Great for financial services and consulting.',                                                                     'bestFor' => 'Financial Advisors | Accounting Firms | Coaching Services', 'plan' => 'Business', 'recommended' => false ),
	array( 'name' => 'Coral',   'file' => 'coral',   'personality' => 'Bright & Cheerful',   'description' => 'Brings energy and positivity to customer interactions. Perfect for retail, hospitality, and customer-focused businesses.',                                              'bestFor' => 'Retail | Salons | Restaurants',                         'plan' => 'Business', 'recommended' => false ),
	array( 'name' => 'Ash',     'file' => 'ash',     'personality' => 'Clear & Confident',   'description' => 'Projects authority and competence. Great for professional services, consulting, and B2B businesses.',                                                                   'bestFor' => 'B2B Services | Consulting Shops | Marketing Agencies',  'plan' => 'Business', 'recommended' => false ),
	array( 'name' => 'Alloy',   'file' => 'alloy',   'personality' => 'Neutral & Professional', 'description' => 'A balanced, versatile voice suitable for any business type. Clear and easy to understand with broad appeal.',                                                        'bestFor' => 'General SMB | Front Desk Coverage | Mixed Inquiries',   'plan' => 'Pro',      'recommended' => false ),
	array( 'name' => 'Echo',    'file' => 'echo',    'personality' => 'Calm & Reassuring',   'description' => 'A gentle, soothing presence that helps visitors feel heard and supported. Ideal for healthcare and support services.',                                                   'bestFor' => 'Clinics | Wellness Practices | Care Teams',             'plan' => 'Pro',      'recommended' => false ),
	array( 'name' => 'Shimmer', 'file' => 'shimmer', 'personality' => 'Light & Elegant',     'description' => 'Refined and sophisticated presence. Perfect for luxury brands, spas, and premium services.',                                                                           'bestFor' => 'Spas | Boutique Brands | Premium Services',             'plan' => 'Pro',      'recommended' => false ),
	array( 'name' => 'Verse',   'file' => 'verse',   'personality' => 'Poetic & Refined',    'description' => 'Cultured and articulate with artistic sensibility. Perfect for galleries, museums, and cultural institutions.',                                                         'bestFor' => 'Art Galleries | Cultural Venues | Education Programs',  'plan' => 'Pro',      'recommended' => false ),
	array( 'name' => 'Ballad',  'file' => 'ballad',  'personality' => 'Expressive & Melodic', 'description' => 'Brings artistry and emotional depth to conversations. Ideal for creative industries and entertainment.',                                                               'bestFor' => 'Creative Studios | Event Services | Entertainment SMBs', 'plan' => 'Pro',     'recommended' => false ),
);

$first_voice = $showcase_voices[0];
?>
<div class="voice-showcase voice-showcase--full<?php echo esc_attr( $extra_classes ); ?>" id="<?php echo esc_attr( $showcase_id ); ?>">
  <?php if ( $show_header ) : ?>
  <div class="voice-showcase__header">
    <span class="section-label"><?php echo esc_html( $header_label ); ?></span>
    <h2 class="voice-showcase__title"><?php echo esc_html( $header_title ); ?></h2>
    <p class="voice-showcase__subtitle"><?php echo wp_kses_post( $header_subtitle ); ?></p>
  </div>
  <?php endif; ?>
  <div class="voice-showcase__display">
    <div class="voice-showcase__portrait-area">
      <button class="voice-showcase__arrow voice-showcase__arrow--prev" type="button" aria-label="Previous voice">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
      </button>
      <div class="voice-showcase__portrait">
        <img src="<?php echo esc_url( $showcase_theme_url . '/assets/images/agents/portraits/' . $first_voice['file'] . '.webp' ); ?>" alt="<?php echo esc_attr( $first_voice['name'] ); ?>" id="showcasePortrait">
      </div>
      <button class="voice-showcase__arrow voice-showcase__arrow--next" type="button" aria-label="Next voice">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      </button>
    </div>
    <div class="voice-showcase__info">
      <div class="voice-showcase__name-row">
        <h3 class="voice-showcase__name" id="showcaseName"><?php echo esc_html( $first_voice['name'] ); ?></h3>
        <span class="voice-showcase__plan-pill" id="showcasePlan" data-plan="<?php echo esc_attr( $first_voice['plan'] ); ?>"><?php echo esc_html( $first_voice['plan'] ); ?></span>
        <span class="voice-showcase__recommended-pill" id="showcaseRecommended"<?php echo $first_voice['recommended'] ? '' : ' hidden'; ?>>
          <span class="voice-showcase__recommended-icon" aria-hidden="true">&#9733;</span>
          Recommended
        </span>
      </div>
      <p class="voice-showcase__personality" id="showcasePersonality"><?php echo esc_html( $first_voice['personality'] ); ?></p>
      <p class="voice-showcase__description" id="showcaseDescription"><?php echo esc_html( $first_voice['description'] ); ?></p>
      <div class="voice-showcase__best-for" id="showcaseBestFor"><?php echo esc_html( $first_voice['bestFor'] ); ?></div>
    </div>
    <div class="voice-showcase__play-area">
      <button class="voice-showcase__play-btn" type="button" id="showcasePlayBtn" aria-label="Preview voice">
        <svg viewBox="0 0 24 24" fill="currentColor" width="28" height="28"><polygon points="6,3 20,12 6,21"/></svg>
      </button>
      <span class="voice-showcase__play-label" id="showcasePlayLabel">Preview Voice</span>
      <audio id="showcaseAudio" preload="none"></audio>
    </div>
  </div>
  <div class="voice-showcase__thumbs" id="showcaseThumbs">
    <?php foreach ( $showcase_voices as $i => $v ) : ?>
    <button type="button" class="voice-showcase__thumb<?php echo 0 === $i ? ' active' : ''; ?>" aria-label="<?php echo esc_attr( $v['name'] ); ?>">
      <div class="voice-showcase__thumb-img">
        <img src="<?php echo esc_url( $showcase_theme_url . '/assets/images/agents/portraits/' . $v['file'] . '-sm.webp' ); ?>" alt="<?php echo esc_attr( $v['name'] ); ?>" loading="lazy">
      </div>
      <span class="voice-showcase__thumb-name"><?php echo esc_html( $v['name'] ); ?></span>
      <span class="voice-showcase__thumb-plan" data-plan="<?php echo esc_attr( $v['plan'] ); ?>"><?php echo esc_html( $v['plan'] ); ?></span>
    </button>
    <?php endforeach; ?>
  </div>
  <!-- Carousel arrows — positioned at card edges -->
  <button class="voice-showcase__card-arrow voice-showcase__card-arrow--prev" type="button" aria-label="Previous voice">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
  </button>
  <button class="voice-showcase__card-arrow voice-showcase__card-arrow--next" type="button" aria-label="Next voice">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
  </button>
</div>
