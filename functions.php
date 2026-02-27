<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'sitestaffr_asset_url' ) ) {
	/**
	 * Build a theme asset URL with file modification time for cache busting.
	 */
	function sitestaffr_asset_url( $relative_path ) {
		$relative_path = ltrim( $relative_path, '/' );
		$asset_uri     = get_stylesheet_directory_uri() . '/' . $relative_path;
		$asset_path    = get_stylesheet_directory() . '/' . $relative_path;

		if ( ! file_exists( $asset_path ) ) {
			return $asset_uri;
		}

		return add_query_arg( 'ver', (string) filemtime( $asset_path ), $asset_uri );
	}
}

add_action( 'wp_enqueue_scripts', function () {
	$is_landing     = is_page_template( 'page-landing.php' );
	$is_maintenance = is_page_template( 'page-maintenance.php' );
	$is_legal       = is_page_template( 'page-privacy-policy.php' ) || is_page_template( 'page-terms-of-service.php' );
	$is_page        = is_page();

	if ( ! $is_landing && ! $is_maintenance && ! $is_page ) {
		return;
	}

	$theme   = wp_get_theme();
	$version = $theme ? $theme->get( 'Version' ) : '0.2.0';

	wp_enqueue_style(
		'sitestaffr-website-fonts',
		'https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,400;0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,400&family=DM+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'sitestaffr-website-style',
		get_stylesheet_directory_uri() . '/assets/css/site.css',
		array( 'sitestaffr-website-fonts' ),
		$version
	);

	if ( $is_landing ) {
		wp_enqueue_script(
			'sitestaffr-website-script',
			get_stylesheet_directory_uri() . '/assets/js/site.js',
			array(),
			$version,
			true
		);
	}

	// Remove WordPress block styles on self-contained templates.
	if ( $is_landing || $is_maintenance || $is_legal ) {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'classic-theme-styles' );
		wp_dequeue_style( 'global-styles' );
	}
} , 100 );
