<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$component_args = isset( $args ) && is_array( $args ) ? $args : array();

$layout        = isset( $component_args['layout'] ) && 'stacked' === $component_args['layout'] ? 'stacked' : 'split';
$recap_variant = isset( $component_args['recap_variant'] ) && 'card' === $component_args['recap_variant'] ? 'card' : 'image';
$extra_classes = isset( $component_args['extra_classes'] ) ? (string) $component_args['extra_classes'] : '';
$audio_label   = isset( $component_args['audio_label'] ) ? (string) $component_args['audio_label'] : 'Sample conversation &mdash; Plumbing business';
$demo_kicker   = isset( $component_args['demo_kicker'] ) ? (string) $component_args['demo_kicker'] : '';
$audio_src     = isset( $component_args['audio_src'] ) ? (string) $component_args['audio_src'] : sitestaffr_asset_url( 'assets/audio/demo-conversation.mp3' );
$open_audio_src = isset( $component_args['open_audio_src'] ) ? (string) $component_args['open_audio_src'] : sitestaffr_asset_url( 'assets/audio/open.mp3' );
$close_audio_src = isset( $component_args['close_audio_src'] ) ? (string) $component_args['close_audio_src'] : sitestaffr_asset_url( 'assets/audio/close.mp3' );
$total_time    = isset( $component_args['total_time'] ) ? (string) $component_args['total_time'] : '0:45';

$recap_image_src = isset( $component_args['recap_image_src'] ) ? (string) $component_args['recap_image_src'] : sitestaffr_asset_url( 'assets/images/conversation-recap.webp' );
$recap_image_alt = isset( $component_args['recap_image_alt'] ) ? (string) $component_args['recap_image_alt'] : 'Sample conversation recap with caller details and suggested follow-up';

$wrapper_classes = array( 'demo-layout', 'js-audio-demo' );

if ( 'stacked' === $layout ) {
	$wrapper_classes[] = 'demo-layout--stacked';
}

if ( '' !== trim( $extra_classes ) ) {
	$wrapper_classes = array_merge( $wrapper_classes, preg_split( '/\s+/', trim( $extra_classes ) ) );
}

$wrapper_classes = array_values( array_unique( array_filter( $wrapper_classes ) ) );

$transcript_entries = array(
	array(
		'speaker' => 'ai',
		'start'   => '0.0',
		'end'     => '4.0',
		'text'    => 'Hi, thanks for reaching out to Brightwater Plumbing. How can I help you today?',
	),
	array(
		'speaker' => 'caller',
		'start'   => '4.0',
		'end'     => '12.0',
		'text'    => "Yeah, I've got a leak under my kitchen sink. It's getting worse and I want to see about getting someone out here as soon as possible.",
	),
	array(
		'speaker' => 'ai',
		'start'   => '12.0',
		'end'     => '17.0',
		'text'    => "I'm sorry to hear that. Let's get this sorted out. Could you share the address where the service is needed?",
	),
	array(
		'speaker' => 'caller',
		'start'   => '17.0',
		'end'     => '24.0',
		'text'    => "Yeah, it's 1-0-0-0 West Palm Avenue in Miami, Florida.",
	),
	array(
		'speaker' => 'ai',
		'start'   => '24.0',
		'end'     => '31.0',
		'text'    => 'Thanks for that. Just to confirm, the address is 1000 West Palm Avenue, Miami, Florida. Could I get your name please?',
	),
	array(
		'speaker' => 'caller',
		'start'   => '31.0',
		'end'     => '33.0',
		'text'    => 'My name is Bob.',
	),
	array(
		'speaker' => 'ai',
		'start'   => '33.0',
		'end'     => '36.0',
		'text'    => "Thanks, Bob. What's the best number to reach you?",
	),
	array(
		'speaker' => 'caller',
		'start'   => '36.0',
		'end'     => '42.0',
		'text'    => 'You can call me at 305-555-1234.',
	),
	array(
		'speaker' => 'ai',
		'start'   => '42.0',
		'end'     => '48.0',
		'text'    => 'Let me confirm that. 305-555-1234. Is that correct?',
	),
	array(
		'speaker' => 'caller',
		'start'   => '48.0',
		'end'     => '50.0',
		'text'    => 'Yes.',
	),
	array(
		'speaker' => 'ai',
		'start'   => '50.0',
		'end'     => '59.0',
		'text'    => "Great. Just to confirm, you're reaching out about a leak under your kitchen sink and we'll contact you at 305-555-1234. Is there anything else I can help you with?",
	),
	array(
		'speaker' => 'caller',
		'start'   => '59.0',
		'end'     => '64.0',
		'text'    => "No, just please hurry because it looks like it's getting really bad.",
	),
	array(
		'speaker' => 'ai',
		'start'   => '64.0',
		'end'     => '70.0',
		'text'    => "I understand. And I'll make sure the team gets this information. Someone will follow up as soon as possible. Take care.",
	),
);
?>
<div class="<?php echo esc_attr( implode( ' ', $wrapper_classes ) ); ?>" data-component="HeroAudioDemo" data-audio-demo data-audio-layout="<?php echo esc_attr( $layout ); ?>" data-audio-open-src="<?php echo esc_url( $open_audio_src ); ?>" data-audio-close-src="<?php echo esc_url( $close_audio_src ); ?>">
	<div class="demo-layout__left">
		<div class="audio-player">
			<?php if ( '' !== trim( $demo_kicker ) ) : ?>
				<span class="audio-player__demo-kicker"><?php echo esc_html( $demo_kicker ); ?></span>
			<?php endif; ?>
			<div class="audio-player__label">
				<?php echo wp_kses_post( $audio_label ); ?>
			</div>
			<div class="audio-player__controls">
				<button class="audio-player__play-btn" type="button" data-audio-demo-play-btn aria-label="Play audio demo">
					<svg viewBox="0 0 24 24" fill="currentColor"><polygon points="6,3 20,12 6,21"/></svg>
				</button>
				<div class="audio-player__track">
					<div class="audio-player__progress-bar" data-audio-demo-progress-bar>
						<div class="audio-player__progress-fill" data-audio-demo-progress-fill></div>
					</div>
					<div class="audio-player__time">
						<span data-audio-demo-current-time>0:00</span>
						<span data-audio-demo-total-time><?php echo esc_html( $total_time ); ?></span>
					</div>
				</div>
			</div>
			<audio preload="metadata" data-audio-demo-audio>
				<source src="<?php echo esc_url( $audio_src ); ?>" type="audio/mpeg">
			</audio>
			<div class="audio-player__transcript-hint" data-audio-demo-transcript-panel role="region" aria-label="Live transcript">
				<div class="audio-player__transcript-window" data-audio-demo-transcript-window aria-live="polite" aria-atomic="false"></div>
				<div class="audio-player__transcript-source" data-audio-demo-transcript-source aria-hidden="true">
					<?php foreach ( $transcript_entries as $entry ) : ?>
						<div class="transcript-line-source" data-speaker="<?php echo esc_attr( $entry['speaker'] ); ?>" data-start="<?php echo esc_attr( $entry['start'] ); ?>" data-end="<?php echo esc_attr( $entry['end'] ); ?>"><?php echo esc_html( $entry['text'] ); ?></div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
	<aside class="demo-layout__right<?php echo 'card' === $recap_variant ? ' demo-layout__right--card' : ''; ?>" data-audio-demo-recap aria-hidden="true">
		<?php if ( 'card' === $recap_variant ) : ?>
			<div class="conversation-recap">
				<div class="conversation-recap__header">
					<div class="conversation-recap__header-main">
						<span class="conversation-recap__header-icon" aria-hidden="true">
							<svg viewBox="0 0 24 24" fill="none">
								<path d="M4 5h16v14H4z" stroke="currentColor" stroke-width="1.8"/>
								<path d="M7 9h10M7 13h10M7 17h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
							</svg>
						</span>
						<h3 class="conversation-recap__title">Conversation Recap</h3>
					</div>
					<div class="conversation-recap__date">
						<svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
							<rect x="3.5" y="5.5" width="17" height="15" rx="2" stroke="currentColor" stroke-width="1.6"/>
							<path d="M3.5 9h17M8 3.8v3.1M16 3.8v3.1" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
						</svg>
						<span>February 18, 2026 1:13 pm</span>
					</div>
				</div>
				<div class="conversation-recap__body">
					<p class="conversation-recap__lead">
						Bob called about a leak under his kitchen sink that's getting worse. He requested urgent service due to the deteriorating situation.
					</p>
					<ul class="conversation-recap__list">
						<li>Phone: <a href="tel:3055551234" aria-label="Phone number for Bob" tabindex="-1">305-555-1234</a></li>
						<li>Reason for call: Leak under kitchen sink</li>
						<li>Urgency: Getting worse, needs immediate attention</li>
						<li>Location/Address: <a href="https://maps.google.com/?q=1000+West+Palm+Avenue+Miami+Florida" target="_blank" rel="noopener noreferrer" aria-label="Service address" tabindex="-1">1000 West Palm Avenue, Miami, Florida</a></li>
					</ul>
					<p class="conversation-recap__followup"><strong>Suggested follow-up:</strong> Schedule a technician to address the leak as soon as possible and confirm the appointment with Bob.</p>
				</div>
			</div>
		<?php else : ?>
			<img
				src="<?php echo esc_url( $recap_image_src ); ?>"
				alt="<?php echo esc_attr( $recap_image_alt ); ?>"
				loading="lazy"
				decoding="async"
			>
		<?php endif; ?>
	</aside>
</div>
