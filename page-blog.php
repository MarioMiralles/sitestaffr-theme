<?php
/**
 * Template Name: Blog
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

$blog_query = new WP_Query( array(
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => 12,
	'paged'          => $paged,
) );

$is_first_page = ( $paged <= 1 );
$post_index    = 0;
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'sitestaffr-blog-index' ); ?>>
<?php wp_body_open(); ?>

<?php get_template_part( 'template-parts/site-nav' ); ?>

<main class="blog-index">
	<header class="blog-index__hero">
		<div class="container">
			<span class="blog-index__label">SiteStaffr Blog</span>
			<h1 class="blog-index__title">Insights for Service Businesses</h1>
			<p class="blog-index__subtitle">Guides, comparisons, and strategies to help you capture more leads and grow with AI.</p>
		</div>
	</header>

	<section class="blog-index__posts">
		<?php get_template_part( 'template-parts/seam-curtain', null, array( 'variant' => 'close' ) ); ?>
		<?php get_template_part( 'template-parts/seam-curtain' ); ?>
		<div class="container">
			<?php if ( $blog_query->have_posts() ) : ?>

				<div class="blog-grid">
					<?php while ( $blog_query->have_posts() ) : $blog_query->the_post();
						$post_index++;
						$is_lead  = ( $is_first_page && 1 === $post_index );
						$eager    = ( $is_first_page && $post_index <= 3 ) ? array( 'loading' => 'eager' ) : array();
						$read     = sitestaffr_read_time( get_the_content() );
					?>
					<a href="<?php the_permalink(); ?>" class="blog-card<?php echo $is_lead ? ' blog-card--lead' : ''; ?>">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="blog-card__image">
								<?php the_post_thumbnail( $is_lead ? 'sitestaffr-hero-wide' : 'sitestaffr-card-wide', $eager ); ?>
							</div>
						<?php else : ?>
							<div class="blog-card__image blog-card__image--placeholder">
								<span><?php the_title(); ?></span>
							</div>
						<?php endif; ?>
						<div class="blog-card__content">
							<h3 class="blog-card__title"><?php the_title(); ?></h3>
							<?php if ( has_excerpt() ) : ?>
								<p class="blog-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), $is_lead ? 34 : 20 ) ); ?></p>
							<?php endif; ?>
							<div class="blog-card__meta">
								<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></time>
								<span class="blog-card__readtime"><?php echo esc_html( $read ); ?> min read</span>
							</div>
						</div>
					</a>
					<?php endwhile; ?>
				</div>

				<?php
				$total_pages = $blog_query->max_num_pages;
				if ( $total_pages > 1 ) : ?>
				<nav class="blog-pagination" aria-label="Blog navigation">
					<?php if ( $paged > 1 ) : ?>
						<a href="<?php echo esc_url( get_pagenum_link( $paged - 1 ) ); ?>" class="blog-pagination__link">&larr; Newer Posts</a>
					<?php endif; ?>
					<span class="blog-pagination__current">Page <?php echo $paged; ?> of <?php echo $total_pages; ?></span>
					<?php if ( $paged < $total_pages ) : ?>
						<a href="<?php echo esc_url( get_pagenum_link( $paged + 1 ) ); ?>" class="blog-pagination__link">Older Posts &rarr;</a>
					<?php endif; ?>
				</nav>
				<?php endif; ?>

			<?php else : ?>
				<div class="blog-index__empty">
					<p>No posts yet — check back soon.</p>
				</div>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</section>
</main>

<?php get_template_part( 'template-parts/site-footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
