<?php
/* Template Name: Industries Index The /for/ page. → docs/implementation-notes.md#industry-groups */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$industry_groups = sitestaffr_industry_registry();

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

	<?php ?>
	<section class="block ind-hero">
		<div class="block__inner">
			<div class="ind-hero__content reveal">
				<span class="ind-hero__label">Industries</span>
				<h1>An AI Receptionist for Your Line of&nbsp;Work</h1>
				<p class="ind-hero__subtitle">SiteStaffr answers your website visitors by voice and text 24/7, captures who they are and what they need, and emails you a full recap. Here&rsquo;s what that looks like in your line of work.</p>
			</div>
		</div>
	</section>

	<section class="block block-cards ind-problems ind-directory">
		<div class="block__inner">
			<?php foreach ( $industry_groups as $group ) : ?>
			<div class="ind-directory__group">
				<div class="ind-section__head reveal">
					<h2>
						<?php if ( ! empty( $group['slug'] ) ) : ?>
							<a href="<?php echo esc_url( home_url( '/for/' . $group['slug'] . '/' ) ); ?>"><?php echo esc_html( $group['heading'] ); ?></a>
						<?php else : ?>
							<?php echo esc_html( $group['heading'] ); ?>
						<?php endif; ?>
					</h2>
				</div>
				<div class="block-cards__grid" style="--cards: 3;">
					<?php foreach ( $group['industries'] as $i => $item ) : ?>
						<?php $item_art = sitestaffr_industry_art_thumb_url( $item['slug'] ); ?>
						<a class="ind-problem-card reveal reveal-delay-<?php echo esc_attr( $i + 1 ); ?>" href="<?php echo esc_url( home_url( '/for/' . $item['slug'] . '/' ) ); ?>">
							<?php if ( $item_art ) : ?>
								<div class="ind-problem-card__icon ind-problem-card__icon--art" aria-hidden="true">
									<img src="<?php echo esc_url( $item_art ); ?>" alt="" width="224" height="224" loading="lazy" decoding="async">
								</div>
							<?php else : ?>
								<div class="ind-problem-card__icon" aria-hidden="true"><?php echo $item['icon']; ?></div>
							<?php endif; ?>
							<h3 class="ind-problem-card__title"><?php echo esc_html( isset( $item['label'] ) ? $item['label'] : $item['title'] ); ?></h3>
							<p class="ind-problem-card__desc"><?php echo wp_kses_post( $item['blurb'] ); ?></p>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="block block--dark ind-cta">
		<div class="block__inner block-statement">
			<div class="ind-cta__content reveal">
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
