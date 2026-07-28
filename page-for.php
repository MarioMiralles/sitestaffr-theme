<?php
/**
 * Template Name: Industries Index
 *
 * The /for/ page. WordPress picks this up automatically for the page with slug
 * "for" (page-{slug} hierarchy), so no template assignment is needed.
 *
 * Fifteen industry pages are otherwise reachable only from a dropdown and the
 * footer; this is their hub — one indexed page that links every one of them.
 *
 * The list below intentionally mirrors the grouping in template-parts/site-nav.php.
 * TODO: when a fourth place needs this list, promote it to one registry function
 * instead of adding another copy.
 *
 * @package SiteStaffr
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$industry_groups = array(
	array(
		'heading' => 'Health &amp; Medical',
		'items'   => array(
			array( 'slug' => 'dental-practices',   'icon' => '🦷', 'label' => 'Dental Practices',      'blurb' => 'Emergency questions and new-patient inquiries answered while your front desk is with a patient.' ),
			array( 'slug' => 'medical-practices',  'icon' => '🩺', 'label' => 'Medical Practices',     'blurb' => 'Insurance and new-patient questions handled after hours, with the details in your inbox.' ),
			array( 'slug' => 'chiropractors',      'icon' => '🦴', 'label' => 'Chiropractic &amp; PT', 'blurb' => 'Turn evening pain-relief searches into booked consultations instead of missed forms.' ),
			array( 'slug' => 'veterinary-clinics', 'icon' => '🐾', 'label' => 'Veterinary Clinics',    'blurb' => 'Worried pet owners get an answer at midnight and you get their details right away.' ),
		),
	),
	array(
		'heading' => 'Beauty &amp; Wellness',
		'items'   => array(
			array( 'slug' => 'med-spas',           'icon' => '✨', 'label' => 'Med Spas &amp; Aesthetics',   'blurb' => 'Answer treatment and pricing questions the moment someone is ready to book.' ),
			array( 'slug' => 'salons-barbershops', 'icon' => '💈', 'label' => 'Salons &amp; Barbershops',    'blurb' => 'Capture appointment requests that arrive long after the last chair is empty.' ),
			array( 'slug' => 'fitness-studios',    'icon' => '🏋️', 'label' => 'Fitness Studios',             'blurb' => 'Class times, trial passes, and membership questions answered around the clock.' ),
		),
	),
	array(
		'heading' => 'Home &amp; Trades',
		'items'   => array(
			array( 'slug' => 'home-services',  'icon' => '🏠', 'label' => 'Home Services',        'blurb' => 'Quote requests captured while you are on a job instead of going to whoever answers first.' ),
			array( 'slug' => 'hvac-plumbing',  'icon' => '🚿', 'label' => 'HVAC &amp; Plumbing',  'blurb' => 'No heat at 11 PM, a pipe letting go on a Sunday — the calls that go to whoever picks up.' ),
			array( 'slug' => 'pest-control',   'icon' => '🐜', 'label' => 'Pest Control',         'blurb' => 'Someone who just saw a roach wants a visit tomorrow, not a callback next week.' ),
		),
	),
	array(
		'heading' => 'Professional Services',
		'items'   => array(
			array( 'slug' => 'law-firms',          'icon' => '⚖️', 'label' => 'Law Firms',            'blurb' => 'Intake questions answered and case details captured before the next firm replies.' ),
			array( 'slug' => 'accounting-tax',     'icon' => '📊', 'label' => 'Accounting &amp; Tax', 'blurb' => 'Deadline-week inquiries collected in full so nothing waits on a voicemail.' ),
			array( 'slug' => 'insurance-agencies', 'icon' => '🛡️', 'label' => 'Insurance Agencies',   'blurb' => 'Quote and coverage questions captured while prospects are still comparing.' ),
		),
	),
	array(
		'heading' => 'Property &amp; Auto',
		'items'   => array(
			array( 'slug' => 'real-estate', 'icon' => '🏡', 'label' => 'Real Estate',       'blurb' => 'Listing questions answered on a Sunday, with the buyer&rsquo;s details in your inbox.' ),
			array( 'slug' => 'auto-repair', 'icon' => '🔧', 'label' => 'Auto Repair Shops', 'blurb' => 'Vehicle, symptom, and contact details captured before the shop opens.' ),
		),
	),
);

$cta_url = home_url( '/#get-started' );
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'sitestaffr-industry-page' ); ?>>
<?php wp_body_open(); ?>

<?php get_template_part( 'template-parts/site-nav' ); ?>

<main class="ind-page">

	<!-- Hero -->
	<section class="ind-hero">
		<div class="ind-hero__accent" aria-hidden="true"></div>
		<div class="ind-hero__glow" aria-hidden="true"></div>
		<div class="container">
			<div class="ind-hero__content reveal">
				<span class="ind-hero__label">Industries</span>
				<h1>Built for Businesses Where a Missed Message Is a Lost&nbsp;Customer</h1>
				<p class="ind-hero__subtitle">SiteStaffr answers your website visitors by voice and text 24/7, captures who they are and what they need, and emails you a full recap. Here&rsquo;s what that looks like in your line of work.</p>
			</div>
		</div>
	</section>

	<!-- Industry directory -->
	<?php foreach ( $industry_groups as $group ) : ?>
	<section class="ind-problems">
		<div class="container">
			<div class="ind-problems__header reveal">
				<h2><?php echo wp_kses_post( $group['heading'] ); ?></h2>
			</div>
			<div class="ind-problems__grid">
				<?php foreach ( $group['items'] as $i => $item ) : ?>
					<a class="ind-problem-card reveal reveal-delay-<?php echo esc_attr( $i + 1 ); ?>" href="<?php echo esc_url( home_url( '/for/' . $item['slug'] . '/' ) ); ?>">
						<div class="ind-problem-card__icon" aria-hidden="true"><?php echo $item['icon']; ?></div>
						<h3 class="ind-problem-card__title"><?php echo wp_kses_post( $item['label'] ); ?></h3>
						<p class="ind-problem-card__desc"><?php echo wp_kses_post( $item['blurb'] ); ?></p>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endforeach; ?>

	<!-- CTA -->
	<section class="ind-cta">
		<div class="ind-cta__pattern" aria-hidden="true"></div>
		<div class="container container--narrow">
			<div class="ind-cta__content cta-spotlight reveal">
				<h2>Don&rsquo;t See Your Industry?</h2>
				<p>SiteStaffr learns from the content already on your website, so it works for any service business that loses customers to an unanswered message. Try it free for 30 days &mdash; no credit card required.</p>
				<div class="ind-cta__actions">
					<a href="<?php echo esc_url( $cta_url ); ?>" class="btn ind-cta__btn">
						Get Started
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
					</a>
					<a href="<?php echo esc_url( home_url( '/download/' ) ); ?>" class="btn btn--outline ind-cta__btn-outline">Download Plugin</a>
				</div>
			</div>
		</div>
	</section>

</main>

<?php get_template_part( 'template-parts/site-footer' ); ?>

<?php wp_footer(); ?>
</body>
</html>
