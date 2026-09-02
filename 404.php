<?php
/**
 * 404 — page not found.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$site_name = get_bloginfo( 'name' );

$nf_links = array(
	array(
		'label' => 'Pricing',
		'url'   => home_url( '/#pricing' ),
		'desc'  => 'Three plans, unlimited text chat',
	),
	array(
		'label' => 'Browse by Industry',
		'url'   => home_url( '/for/' ),
		'desc'  => 'How it works for your trade',
	),
	array(
		'label' => 'Download the Plugin',
		'url'   => home_url( '/download/' ),
		'desc'  => 'Install it on your WordPress site',
	),
	array(
		'label' => 'Blog',
		'url'   => home_url( '/blog/' ),
		'desc'  => 'Guides for service businesses',
	),
);
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'sitestaffr-page sitestaffr-page--404' ); ?>>
<?php wp_body_open(); ?>

<?php get_template_part( 'template-parts/site-nav' ); ?>

<main class="nf" id="main">
	<div class="container container--narrow">
		<p class="nf__code">404</p>
		<h1 class="nf__title">We Can&rsquo;t Find That Page</h1>
		<p class="nf__text">
			The link may be out of date, or the page may have moved. Everything below is still where it should be.
		</p>

		<div class="nf__actions">
			<a class="btn btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">Go to Homepage</a>
			<a class="btn btn--outline" href="<?php echo esc_url( home_url( '/#get-started' ) ); ?>">Get Started</a>
		</div>

		<ul class="nf__links">
			<?php foreach ( $nf_links as $nf_link ) : ?>
				<li class="nf__link-item">
					<a class="nf__link" href="<?php echo esc_url( $nf_link['url'] ); ?>">
						<span class="nf__link-label"><?php echo esc_html( $nf_link['label'] ); ?></span>
						<span class="nf__link-desc"><?php echo esc_html( $nf_link['desc'] ); ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</main>

<?php get_template_part( 'template-parts/site-footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
