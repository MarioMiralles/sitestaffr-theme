<?php
/*
Template Name: Maintenance Page
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex, nofollow">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'sitestaffr-maintenance-page' ); ?>>
<?php wp_body_open(); ?>

<main class="maintenance">
	<div class="container">
		<div class="maintenance__card">
			<img
				class="maintenance__logo"
				src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/logo.webp' ) ); ?>"
				alt="SiteStaffr"
				width="625"
				height="188"
			>
			<span class="maintenance__badge">Temporary Maintenance</span>
			<h1>We are making a few updates</h1>
			<p>
				SiteStaffr is temporarily offline while we improve the experience.
				We will be back shortly.
			</p>
			<p class="maintenance__subtext">
				Thank you for your patience.
			</p>
		</div>
	</div>
</main>

<?php wp_footer(); ?>
</body>
</html>
