<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$site_name = get_bloginfo( 'name' );

if ( is_search() ) {
	$page_title = sprintf( __( 'Search Results for "%s"', 'sitestaffr-website' ), get_search_query() );
} elseif ( is_archive() ) {
	$page_title = get_the_archive_title();
} elseif ( is_singular() ) {
	$page_title = get_the_title();
} else {
	$page_title = 'Blog';
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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'sitestaffr-page sitestaffr-page--default' ); ?>>
<?php wp_body_open(); ?>

<?php get_template_part( 'template-parts/site-nav' ); ?>

<main class="page-content">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article class="page-content__article">
					<h1 class="page-content__title">
						<?php if ( ! is_singular() ) : ?>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						<?php else : ?>
							<?php the_title(); ?>
						<?php endif; ?>
					</h1>
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

<?php get_template_part( 'template-parts/site-footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
