<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>
<main id="primary" class="sitestaffr-main">
	<section class="sitestaffr-shell">
		<h1><?php echo esc_html( get_the_title() ?: 'SiteStaffr' ); ?></h1>
		<p>Replace this default index template with WordPress page templates.</p>
	</section>
</main>
<?php
get_footer();
