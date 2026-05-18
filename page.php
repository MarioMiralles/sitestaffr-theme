<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$site_name = get_bloginfo( 'name' );
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
					src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/logo-240.webp' ) ); ?>"
					alt="<?php echo esc_attr( $site_name ); ?>"
					width="240"
					height="72"
				>
			</a>
			<div class="nav__cta">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">Home</a>
			</div>
		</div>
	</div>
</nav>

<main class="page-content">
	<div class="container">
		<article class="page-content__article">
			<h1 class="page-content__title"><?php echo esc_html( get_the_title() ); ?></h1>
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

<?php get_template_part( 'template-parts/site-footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
