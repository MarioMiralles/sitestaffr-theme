<?php
/**
 * Template Name: Industry Category Hub
 *
 * One template for every category hub at /for/<category-slug>/. The group is
 * resolved from the page's own slug, so adding a category is a registry entry
 * plus a provision bump — no new template, no new file.
 *
 * These sit between the /for/ index and the fifteen industry pages: a shorter
 * list for a visitor who knows roughly what they do, and a stable home for
 * industries added later.
 *
 * @package SiteStaffr
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$sitestaffr_category = sitestaffr_industry_category( get_post_field( 'post_name', get_queried_object_id() ) );

// A hub whose registry entry has been removed should not render an empty shell.
if ( ! $sitestaffr_category ) {
	wp_safe_redirect( home_url( '/for/' ), 302 );
	exit;
}

$sitestaffr_industries = isset( $sitestaffr_category['industries'] ) ? $sitestaffr_category['industries'] : array();
$cta_url               = home_url( '/#get-started' );
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
		<div class="container">
			<div class="ind-hero__content reveal">
				<span class="ind-hero__label"><?php echo esc_html( $sitestaffr_category['heading'] ); ?></span>
				<?php
				/* ⚠️ THE H1 IS REGISTRY COPY NOW, NOT A TEMPLATE PATTERN.

				   It read "AI Voice and Text Agents for <heading>" on all five hubs. Two
				   problems. The term is the one the V3 positioning superseded — the
				   homepage H1 is "Put an AI Receptionist on Your Website" and these five
				   pages were still naming the product the old way. And a pattern
				   concatenated onto the group heading cannot read well for five different
				   headings: "for Health & Medical" and "for Property & Auto" are category
				   labels from a browse menu, not the words anyone would call their own
				   business.

				   Per-group copy fixes both — "Healthcare Practices", "Home Service
				   Businesses", "Real Estate and Auto Businesses". The fallback keeps the
				   old behaviour if a sixth group is ever added without an 'h1', so a
				   missing field degrades to a heading rather than to a blank H1.

				   ⚠️ 'h1' RENDERS FROM THE REGISTRY AT REQUEST TIME, so unlike seo_title
				   and metadesc it is NOT behind $provision_version and needs no bump.
				   Those two still are — see the note on that gate. */
				$sitestaffr_cat_h1 = ! empty( $sitestaffr_category['h1'] )
					? $sitestaffr_category['h1']
					: 'AI Voice and Text Agents for ' . $sitestaffr_category['heading'];
				?>
				<h1><?php echo esc_html( $sitestaffr_cat_h1 ); ?></h1>
				<?php if ( ! empty( $sitestaffr_category['intro'] ) ) : ?>
				<p class="ind-hero__subtitle"><?php echo wp_kses_post( $sitestaffr_category['intro'] ); ?></p>
				<?php endif; ?>
				<div class="ind-hero__actions">
					<a href="<?php echo esc_url( $cta_url ); ?>" class="btn btn--primary btn--large">
						Get Started
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
					</a>
				</div>
				<span class="ind-hero__trust">Free for 30 days &bull; No credit card required</span>
			</div>
		</div>
	</section>

	<!-- Industries in this category -->
	<section class="ind-problems">
		<div class="container">
			<div class="ind-problems__header reveal">
				<h2>Where SiteStaffr Fits</h2>
			</div>
			<div class="ind-problems__grid">
				<?php foreach ( $sitestaffr_industries as $sitestaffr_i => $sitestaffr_item ) : ?>
					<?php $sitestaffr_item_art = sitestaffr_industry_art_thumb_url( $sitestaffr_item['slug'] ); ?>
					<a class="ind-problem-card reveal reveal-delay-<?php echo esc_attr( $sitestaffr_i + 1 ); ?>" href="<?php echo esc_url( home_url( '/for/' . $sitestaffr_item['slug'] . '/' ) ); ?>">
						<?php if ( $sitestaffr_item_art ) : ?>
							<div class="ind-problem-card__icon ind-problem-card__icon--art" aria-hidden="true">
								<img src="<?php echo esc_url( $sitestaffr_item_art ); ?>" alt="" width="224" height="224" loading="lazy" decoding="async">
							</div>
						<?php else : ?>
							<div class="ind-problem-card__icon" aria-hidden="true"><?php echo $sitestaffr_item['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- registry-controlled emoji. ?></div>
						<?php endif; ?>
						<h3 class="ind-problem-card__title"><?php echo esc_html( isset( $sitestaffr_item['label'] ) ? $sitestaffr_item['label'] : $sitestaffr_item['title'] ); ?></h3>
						<p class="ind-problem-card__desc"><?php echo wp_kses_post( $sitestaffr_item['blurb'] ); ?></p>
					</a>
				<?php endforeach; ?>
			</div>
			<p class="ind-problems__footnote reveal">
				Work in <?php echo esc_html( $sitestaffr_category['heading'] ); ?> but not listed above?
				SiteStaffr learns from the content already on your website, so it does not need a template for your trade.
				<a href="<?php echo esc_url( home_url( '/for/' ) ); ?>">See every industry</a>.
			</p>
		</div>
	</section>

	<!-- CTA -->
	<?php /* Closing CTA is a V3 dark block running into the footer, same as
	         page-industry.php. ⚠️ CONVERTED IN THE SAME COMMIT ON PURPOSE:
	         .ind-cta is shared across all three ind-* templates, so moving its
	         background onto .block--dark would have left whichever template still
	         carried the old markup with no background at all. */ ?>
	<section class="block block--dark ind-cta">
		<div class="block__inner block-statement">
			<div class="ind-cta__content reveal">
				<h2>Stop Losing Customers to an Unanswered Message</h2>
				<p>SiteStaffr answers your website visitors by voice and text 24/7, captures who they are and what they need, and emails you a full recap. Try it free for 30 days &mdash; no credit card required.</p>
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
