<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'sitestaffr-blog-post' ); ?>>
<?php wp_body_open(); ?>

<?php get_template_part( 'template-parts/site-nav' ); ?>

<main class="blog-post">
	<?php
	while ( have_posts() ) :
		the_post();

		$categories = get_the_category();
		$cat_name   = ! empty( $categories ) ? esc_html( $categories[0]->name ) : 'Blog';
	?>
	<article class="blog-post__article">
		<header class="blog-post__header">
			<div class="container container--narrow">
				<span class="blog-post__label"><?php echo $cat_name; ?></span>
				<h1 class="blog-post__title"><?php the_title(); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<p class="blog-post__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
				<?php endif; ?>
				<div class="blog-post__meta">
					<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'F j, Y' ) ); ?></time>
					<?php if ( get_the_modified_date() !== get_the_date() ) : ?>
						<span class="blog-post__updated">Updated <?php echo esc_html( get_the_modified_date( 'F j, Y' ) ); ?></span>
					<?php endif; ?>
				</div>
			</div>
		</header>

		<div class="blog-post__body">
			<div class="container container--narrow">
				<?php the_content(); ?>
			</div>
		</div>
	</article>
	<?php endwhile; ?>
</main>

<?php get_template_part( 'template-parts/site-footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
