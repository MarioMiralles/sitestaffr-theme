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
 * Industries come from sitestaffr_industry_registry() in functions.php — the one
 * source of truth shared with the nav, footer, llms.txt and page provisioning.
 *
 * @package SiteStaffr
 */

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

	<?php /* ---- HERO: a V3 block, not a Split ---------------------------------
	         `page-industry.php` uses `.block-split` because it has one isometric to
	         put beside the copy. This hub has no art, so it is a plain block with a
	         left-aligned copy column — the grid would have been an empty second
	         column.

	         ⚠️ `.block.ind-hero` gives this the SAME clamp(120px, 15vw, 140px) top as
	         the converted industry page. The 88px it had before came from
	         `.ind-page > section:not(.block)`, and next to a 140px sibling it read as
	         the hub crowding the nav. */ ?>
	<!-- Hero -->
	<section class="block ind-hero">
		<div class="block__inner">
			<div class="ind-hero__content reveal">
				<span class="ind-hero__label">Industries</span>
				<?php /* ⚠️ THIS H1 WAS THE HOMEPAGE'S SECTION 6 H2, WORD FOR WORD.
				         "Built for Businesses Where a Missed Message Is a Lost Customer"
				         is still that section's heading, and having our own two pages
				         compete for one phrase helps neither. It also never named the
				         product: before this edit the /for/ hub did not contain
				         "receptionist", "agent" or "assistant" anywhere in its body copy,
				         so the page listing all sixteen industries never said what the
				         thing being offered actually is.

				         "Line of work" is picked up directly from the subtitle below it,
				         which already ends "here's what that looks like in your line of
				         work" — the hub's job is to route you to your own trade, and the
				         H1 now says so. */ ?>
				<h1>An AI Receptionist for Your Line of&nbsp;Work</h1>
				<p class="ind-hero__subtitle">SiteStaffr answers your website visitors by voice and text 24/7, captures who they are and what they need, and emails you a full recap. Here&rsquo;s what that looks like in your line of work.</p>
			</div>
		</div>
	</section>

	<?php /* ---- DIRECTORY: ONE section holding five groups, not five sections ----
	         ⚠️ THIS FIXES A LIVE REGRESSION, and it is the reason this page looked
	         broken rather than merely unconverted. `.ind-problems__grid` was DELETED
	         from site.css when `page-industry.php` moved its pain points onto
	         `.block-cards__grid` — but this page and the five category hubs still
	         carried the class, so twenty-one directory tiles were rendering as a
	         full-width stack with no grid at all. A class that survives its rule
	         fails silently: the markup still validates and the page still links
	         everywhere it should.

	         ⚠️ FIVE `<section>`s BECAME ONE. Each group used to be its own section,
	         which on the V3 cream scale is 96px + 96px = 192px of empty cream
	         between "Health & Medical" and "Beauty & Wellness". That padding exists
	         to separate two different IDEAS on one cream run; five industry groups
	         are one idea — a directory — and the page's whole job is to get a
	         visitor to their own trade quickly. The group gap is its own smaller
	         step now.

	         The `<h2>` per group is kept, not demoted to `<h3>`: these five headings
	         are the page's real structure and each one links to its category hub. */ ?>
	<!-- Industry directory -->
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

	<!-- CTA -->
	<?php /* Closing CTA is a V3 dark block running into the footer, same as
	         page-industry.php. ⚠️ CONVERTED IN THE SAME COMMIT ON PURPOSE:
	         .ind-cta is shared across all three ind-* templates, so moving its
	         background onto .block--dark would have left whichever template still
	         carried the old markup with no background at all. */ ?>
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
