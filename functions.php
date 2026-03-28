<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'SITESTAFFR_MIDDLEWARE_URL' ) ) {
	define( 'SITESTAFFR_MIDDLEWARE_URL', 'https://phoneease-middleware-pr6tyivo4a-uc.a.run.app' );
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

if ( ! function_exists( 'sitestaffr_request_path' ) ) {
	/**
	 * Get the current request path relative to the site root.
	 *
	 * @return string
	 */
	function sitestaffr_request_path() {
		$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '';
		$path        = is_string( $request_uri ) ? wp_parse_url( $request_uri, PHP_URL_PATH ) : '';
		$path        = is_string( $path ) ? trim( $path, '/' ) : '';
		$home_path   = wp_parse_url( home_url( '/' ), PHP_URL_PATH );
		$home_path   = is_string( $home_path ) ? trim( $home_path, '/' ) : '';

		if ( '' !== $home_path && 0 === strpos( $path, $home_path ) ) {
			$path = trim( substr( $path, strlen( $home_path ) ), '/' );
		}

		return $path;
	}
}

if ( ! function_exists( 'sitestaffr_is_features_request' ) ) {
	/**
	 * Whether the current request should render the custom features page.
	 *
	 * @return bool
	 */
	function sitestaffr_is_features_request() {
		return 'features' === sitestaffr_request_path();
	}
}

add_action( 'wp_enqueue_scripts', function () {
	$is_landing     = is_page_template( 'page-landing.php' );
	$is_maintenance = is_page_template( 'page-maintenance.php' );
	$is_legal       = is_page_template( 'page-privacy-policy.php' ) || is_page_template( 'page-terms-of-service.php' );
	$is_get_started = is_page_template( 'page-get-started.php' );
	$is_manage      = is_page_template( 'page-manage.php' );
	$is_features    = sitestaffr_is_features_request();
	$is_page        = is_page();
	$is_default     = is_home() || is_single() || is_archive() || is_search();

	if ( ! $is_landing && ! $is_maintenance && ! $is_get_started && ! $is_manage && ! $is_features && ! $is_page && ! $is_default ) {
		return;
	}

	wp_enqueue_style(
		'sitestaffr-website-fonts',
		'https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,400;0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,400&family=DM+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'sitestaffr-website-style',
		sitestaffr_asset_url( 'assets/css/site.css' ),
		array( 'sitestaffr-website-fonts' ),
		null
	);

	if ( $is_landing ) {
		wp_enqueue_script(
			'sitestaffr-website-script',
			sitestaffr_asset_url( 'assets/js/site.js' ),
			array(),
			null,
			true
		);
	}

	if ( $is_manage ) {
		wp_enqueue_script(
			'sitestaffr-manage-script',
			sitestaffr_asset_url( 'assets/js/manage.js' ),
			array(),
			null,
			true
		);
		wp_localize_script( 'sitestaffr-manage-script', 'sitestaffrHub', array(
			'apiUrl' => SITESTAFFR_MIDDLEWARE_URL,
		) );
	}

	// Remove WordPress block styles on self-contained templates.
	if ( $is_landing || $is_maintenance || $is_legal || $is_get_started || $is_manage || $is_features ) {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'classic-theme-styles' );
		wp_dequeue_style( 'global-styles' );
	}
} , 100 );

add_action( 'template_redirect', function () {
	if ( ! sitestaffr_is_features_request() || is_admin() ) {
		return;
	}

	global $wp_query;

	if ( isset( $wp_query ) && $wp_query instanceof WP_Query ) {
		$wp_query->is_404      = false;
		$wp_query->is_page     = true;
		$wp_query->is_singular = true;
	}

	status_header( 200 );
	include get_stylesheet_directory() . '/page-features.php';
	exit;
}, 0 );
