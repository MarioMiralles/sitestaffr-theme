<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php
	$post_id    = get_the_ID();
	$post_obj   = get_post( $post_id );
	$thumb_url  = get_the_post_thumbnail_url( $post_id, 'full' );
	$article_schema = array(
		'@context'      => 'https://schema.org',
		'@type'         => 'BlogPosting',
		'@id'           => get_the_permalink( $post_id ) . '#article',
		'headline'      => get_the_title( $post_id ),
		'description'   => wp_strip_all_tags( get_the_excerpt( $post_id ) ),
		'url'           => get_the_permalink( $post_id ),
		'datePublished' => get_the_date( 'c', $post_id ),
		'dateModified'  => get_the_modified_date( 'c', $post_id ),
		'author'        => array(
			'@type' => 'Person',
			'name'  => 'Mario Miralles',
			'url'   => home_url( '/about/' ),
		),
		'publisher'     => array(
			'@id' => home_url( '/' ) . '#organization',
		),
		'isPartOf'      => array(
			'@id' => home_url( '/' ) . '#website',
		),
		'inLanguage'    => 'en-US',
	);
	if ( $thumb_url ) {
		$article_schema['image'] = array(
			'@type' => 'ImageObject',
			'url'   => $thumb_url,
		);
	}
	?>
	<script type="application/ld+json">
	<?php echo wp_json_encode( $article_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
	</script>

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
		$has_thumb  = has_post_thumbnail();
	?>
	<article class="blog-post__article">
		<header class="blog-post__header<?php echo $has_thumb ? ' blog-post__header--has-image' : ''; ?>">
			<div class="container">
				<div class="blog-post__header-content">
					<span class="blog-post__label"><?php echo $cat_name; ?></span>
					<h1 class="blog-post__title"><?php the_title(); ?></h1>
					<?php if ( has_excerpt() ) : ?>
						<p class="blog-post__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
					<?php endif; ?>
					<div class="blog-post__meta">
						<span class="blog-post__author">By <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">Mario Miralles</a></span>
						<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'F j, Y' ) ); ?></time>
						<?php if ( get_the_modified_date() !== get_the_date() ) : ?>
							<span class="blog-post__updated">Updated <?php echo esc_html( get_the_modified_date( 'F j, Y' ) ); ?></span>
						<?php endif; ?>
					</div>
				</div>
				<?php if ( $has_thumb ) : ?>
					<div class="blog-post__hero-image">
						<?php the_post_thumbnail( 'full', array( 'loading' => 'eager' ) ); ?>
					</div>
				<?php endif; ?>
			</div>
		</header>

		<div class="blog-post__body">
			<div class="container">
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
