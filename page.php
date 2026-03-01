<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$page_title       = get_the_title();
$page_description = wp_strip_all_tags( get_the_excerpt() ) ?: $page_title;
$page_url         = get_permalink() ?: home_url( '/' );
$site_name        = get_bloginfo( 'name' );
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php echo esc_html( $page_title . ' | ' . $site_name ); ?></title>
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
</head>
<body <?php body_class( 'sitestaffr-page sitestaffr-page--default' ); ?>>
<?php wp_body_open(); ?>

<nav class="nav" id="nav">
	<div class="container">
		<div class="nav__inner">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav__logo" aria-label="<?php echo esc_attr( $site_name ); ?> home">
				<img
					class="nav__logo-image"
					src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/logo.png' ) ); ?>"
					alt="<?php echo esc_attr( $site_name ); ?>"
				>
			</a>
			<div class="nav__cta">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">Home</a>
			</div>
		</div>
	</div>
</nav>

<main class="page-content">
	<div class="page-content__hero-bg" aria-hidden="true"></div>
	<div class="container">
		<article class="page-content__article">
			<h1 class="page-content__title"><?php echo esc_html( $page_title ); ?></h1>
			<div class="page-content__body">
				<?php
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
				?>
			</div>
		</article>
	</div>
</main>

<footer class="footer">
	<div class="container">
		<div class="footer__links">
			<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a>
			<a href="<?php echo esc_url( home_url( '/terms-of-service/' ) ); ?>">Terms of Service</a>
			<a href="mailto:support@sitestaffr.com">Support</a>
		</div>
		<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( $site_name ); ?>. All rights reserved.</p>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
