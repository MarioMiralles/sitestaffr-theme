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
	$post_id     = get_the_ID();
	$post_obj    = get_post( $post_id );
	$author_id   = $post_obj ? (int) $post_obj->post_author : 0;
	$author_name = $author_id ? get_the_author_meta( 'display_name', $author_id ) : '';
	$author_url  = $author_id ? get_author_posts_url( $author_id ) : '';
	$thumb_url   = get_the_post_thumbnail_url( $post_id, 'full' );
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
			'name'  => $author_name,
			'url'   => $author_url,
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
						<?php
						$display_author_name = get_the_author_meta( 'display_name' );
						$display_author_url  = get_author_posts_url( get_the_author_meta( 'ID' ) );
						?>
						<span class="blog-post__author">By <a href="<?php echo esc_url( $display_author_url ); ?>"><?php echo esc_html( $display_author_name ); ?></a></span>
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

		<section class="blog-post__cta-banner" aria-label="Try SiteStaffr">
			<div class="container">
				<div class="blog-post__cta-inner">
					<h2><?php esc_html_e( 'Put an AI voice agent on your website', 'sitestaffr' ); ?></h2>
					<p><?php esc_html_e( 'SiteStaffr answers visitor questions, captures contact details, and speaks 57+ languages — trained on your own website. Set up in minutes, free trial included.', 'sitestaffr' ); ?></p>
					<a class="blog-post__cta-button" href="<?php echo esc_url( home_url( '/get-started/' ) ); ?>"><?php esc_html_e( 'Get Started Free', 'sitestaffr' ); ?></a>
				</div>
			</div>
		</section>
	</article>

	<?php
	// Keep Reading: same-category posts first, padded with recent posts.
	$current_id   = get_the_ID();
	$primary_cats = wp_get_post_categories( $current_id );
	$related_ids  = array();

	if ( ! empty( $primary_cats ) ) {
		$related_ids = get_posts( array(
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => 3,
			'post__not_in'   => array( $current_id ),
			'category__in'   => $primary_cats,
			'fields'         => 'ids',
		) );
	}

	if ( count( $related_ids ) < 3 ) {
		$fill_ids = get_posts( array(
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => 3 + count( $related_ids ),
			'post__not_in'   => array_merge( array( $current_id ), $related_ids ),
			'fields'         => 'ids',
		) );
		$related_ids = array_slice( array_merge( $related_ids, $fill_ids ), 0, 3 );
	}

	$prev_post = get_previous_post();
	$next_post = get_next_post();
	?>
	<?php if ( ! empty( $related_ids ) || $prev_post || $next_post ) : ?>
	<section class="blog-post__related" aria-label="More from the blog">
		<div class="container">
			<h2 class="blog-post__related-title"><?php esc_html_e( 'Keep Reading', 'sitestaffr' ); ?></h2>

			<?php if ( ! empty( $related_ids ) ) : ?>
			<div class="blog-grid">
				<?php foreach ( $related_ids as $related_id ) :
					$rel_cats     = get_the_category( $related_id );
					$rel_cat_name = ! empty( $rel_cats ) ? esc_html( $rel_cats[0]->name ) : '';
				?>
				<a href="<?php echo esc_url( get_permalink( $related_id ) ); ?>" class="blog-card">
					<?php if ( has_post_thumbnail( $related_id ) ) : ?>
						<div class="blog-card__image">
							<?php echo get_the_post_thumbnail( $related_id, 'medium_large' ); ?>
						</div>
					<?php else : ?>
						<div class="blog-card__image blog-card__image--placeholder">
							<span>📝</span>
						</div>
					<?php endif; ?>
					<div class="blog-card__content">
						<?php if ( $rel_cat_name ) : ?>
							<span class="blog-card__category"><?php echo $rel_cat_name; ?></span>
						<?php endif; ?>
						<h3 class="blog-card__title"><?php echo esc_html( get_the_title( $related_id ) ); ?></h3>
						<div class="blog-card__meta">
							<time datetime="<?php echo esc_attr( get_the_date( 'c', $related_id ) ); ?>"><?php echo esc_html( get_the_date( 'M j, Y', $related_id ) ); ?></time>
							<span class="blog-card__read-more">Read &rarr;</span>
						</div>
					</div>
				</a>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

			<?php if ( $prev_post || $next_post ) : ?>
			<nav class="blog-post__pager" aria-label="Post navigation">
				<?php if ( $prev_post ) : ?>
					<a class="blog-post__pager-link blog-post__pager-link--prev" href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>">
						<span class="blog-post__pager-label"><?php esc_html_e( 'Previous post', 'sitestaffr' ); ?></span>
						<span class="blog-post__pager-title"><?php echo esc_html( get_the_title( $prev_post ) ); ?></span>
					</a>
				<?php endif; ?>
				<?php if ( $next_post ) : ?>
					<a class="blog-post__pager-link blog-post__pager-link--next" href="<?php echo esc_url( get_permalink( $next_post ) ); ?>">
						<span class="blog-post__pager-label"><?php esc_html_e( 'Next post', 'sitestaffr' ); ?></span>
						<span class="blog-post__pager-title"><?php echo esc_html( get_the_title( $next_post ) ); ?></span>
					</a>
				<?php endif; ?>
			</nav>
			<?php endif; ?>
		</div>
	</section>
	<?php endif; ?>
	<?php endwhile; ?>
</main>

<?php get_template_part( 'template-parts/site-footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
