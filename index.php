<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$site_name = get_bloginfo( 'name' );

if ( is_search() ) {
	$page_title = sprintf(
		/* translators: %s is the search query. */
		__( 'Search Results for "%s"', 'sitestaffr-website' ),
		get_search_query()
	);
} elseif ( is_archive() ) {
	$page_title = get_the_archive_title();
} elseif ( is_singular() ) {
	$page_title = get_the_title();
} else {
	$page_title = $site_name;
}

$page_title  = $page_title ? $page_title : $site_name;
$description = is_singular()
	? ( wp_strip_all_tags( get_the_excerpt() ) ?: $page_title )
	: wp_strip_all_tags( get_bloginfo( 'description' ) );
$page_url    = is_singular() ? ( get_permalink() ?: home_url( '/' ) ) : home_url( '/' );
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php echo esc_html( $page_title . ' | ' . $site_name ); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo esc_attr( $description ); ?>">
	<meta name="robots" content="index, follow">
	<link rel="canonical" href="<?php echo esc_url( $page_url ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'sitestaffr-page' ); ?>>
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
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article class="page-content__article">
					<h1 class="page-content__title"><?php the_title(); ?></h1>
					<div class="page-content__body">
						<?php the_content(); ?>
					</div>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
			<article class="page-content__article">
				<h1 class="page-content__title"><?php echo esc_html( $page_title ); ?></h1>
				<div class="page-content__body">
					<p><?php esc_html_e( 'No content found.', 'sitestaffr-website' ); ?></p>
				</div>
			</article>
		<?php endif; ?>
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
