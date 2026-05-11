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
        <img src="" alt="" id="showcasePortrait">
      </div>
      <button class="voice-showcase__arrow voice-showcase__arrow--next" type="button" aria-label="Next voice">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      </button>
    </div>
    <div class="voice-showcase__info">
      <div class="voice-showcase__name-row">
        <h3 class="voice-showcase__name" id="showcaseName"></h3>
        <span class="voice-showcase__plan-pill" id="showcasePlan"></span>
        <span class="voice-showcase__recommended-pill" id="showcaseRecommended" hidden>
          <span class="voice-showcase__recommended-icon" aria-hidden="true">&#9733;</span>
          Recommended
        </span>
      </div>
      <p class="voice-showcase__personality" id="showcasePersonality"></p>
      <p class="voice-showcase__description" id="showcaseDescription"></p>
      <div class="voice-showcase__best-for" id="showcaseBestFor"></div>
    </div>
    <div class="voice-showcase__play-area">
      <button class="voice-showcase__play-btn" type="button" id="showcasePlayBtn" aria-label="Preview voice">
        <svg viewBox="0 0 24 24" fill="currentColor" width="28" height="28"><polygon points="6,3 20,12 6,21"/></svg>
      </button>
      <span class="voice-showcase__play-label" id="showcasePlayLabel">Preview Voice</span>
      <audio id="showcaseAudio" preload="none"></audio>
    </div>
  </div>
  <div class="voice-showcase__thumbs" id="showcaseThumbs"></div>
  <!-- Carousel arrows — positioned at card edges -->
  <button class="voice-showcase__card-arrow voice-showcase__card-arrow--prev" type="button" aria-label="Previous voice">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
  </button>
  <button class="voice-showcase__card-arrow voice-showcase__card-arrow--next" type="button" aria-label="Next voice">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
  </button>
</div>
