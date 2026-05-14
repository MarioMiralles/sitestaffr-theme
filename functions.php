<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_head', function () {
	$is_staging = false !== strpos( home_url(), 'staging.sitestaffr.com' );

	if ( $is_staging ) {
		echo '<meta name="robots" content="noindex, nofollow">' . "\n";
		return;
	}
	?>
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-4ESZ2PEYMX"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'G-4ESZ2PEYMX');
	</script>
	<?php
}, 1 );

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

add_action( 'wp_enqueue_scripts', function () {
	$is_landing     = is_page_template( 'page-landing.php' );
	$is_maintenance = is_page_template( 'page-maintenance.php' );
	$is_legal       = is_page_template( 'page-privacy-policy.php' ) || is_page_template( 'page-terms-of-service.php' );
	$is_get_started = is_page_template( 'page-get-started.php' );
	$is_manage      = is_page_template( 'page-manage.php' );
	$is_page        = is_page();
	$is_default     = is_home() || is_single() || is_archive() || is_search();

	if ( ! $is_landing && ! $is_maintenance && ! $is_get_started && ! $is_manage && ! $is_page && ! $is_default ) {
		return;
	}

	wp_enqueue_style(
		'sitestaffr-website-style',
		sitestaffr_asset_url( 'assets/css/site.css' ),
		array(),
		null
	);

	$is_about    = is_page_template( 'page-about.php' );
	$is_industry = is_page_template( 'page-industry.php' );

	if ( $is_landing || $is_about || $is_industry ) {
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

	if ( $is_landing || $is_maintenance || $is_legal || $is_get_started || $is_manage ) {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'classic-theme-styles' );
		wp_dequeue_style( 'global-styles' );
	}
} , 100 );

add_action( 'init', function () {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
} );

add_filter( 'robots_txt', function ( $output, $public ) {
	$output .= "\n# AI Crawlers\n";
	$output .= "User-agent: GPTBot\nAllow: /\n\n";
	$output .= "User-agent: ClaudeBot\nAllow: /\n\n";
	$output .= "User-agent: PerplexityBot\nAllow: /\n\n";
	$output .= "User-agent: Google-Extended\nAllow: /\n\n";
	$output .= "User-agent: OAI-SearchBot\nAllow: /\n\n";
	return $output;
}, 10, 2 );

add_action( 'template_redirect', function () {
	if ( isset( $_SERVER['REQUEST_URI'] ) && '/llms.txt' === wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ), PHP_URL_PATH ) ) {
		status_header( 200 );
		header( 'Content-Type: text/plain; charset=utf-8' );
		header( 'X-Robots-Tag: noindex' );
		echo "# SiteStaffr\n\n";
		echo "> An AI voice and text agent built for service businesses on WordPress.\n\n";
		echo "SiteStaffr is a WordPress plugin that adds an AI-powered voice and text chat agent to your website. ";
		echo "It greets visitors, answers questions using your website content, captures contact information, ";
		echo "and sends you detailed conversation recaps by email — automatically, 24/7, in over 57 languages.\n\n";
		echo "## Key Pages\n\n";
		echo "- [Home](" . home_url( '/' ) . ") — Product overview, pricing, and demo\n";
		echo "- [About](" . home_url( '/about/' ) . ") — Company and founder information\n";
		echo "- [Blog](" . home_url( '/blog/' ) . ") — Guides and comparisons for service businesses\n";
		echo "- [For Dental Practices](" . home_url( '/for/dental-practices/' ) . ") — AI voice agent for dental offices\n";
		echo "- [For Law Firms](" . home_url( '/for/law-firms/' ) . ") — AI voice agent for legal practices\n";
		echo "- [For Home Services](" . home_url( '/for/home-services/' ) . ") — AI voice agent for contractors\n";
		echo "- [Privacy Policy](" . home_url( '/privacy/' ) . ") — How we handle data\n";
		echo "- [Terms of Service](" . home_url( '/terms/' ) . ") — Usage terms\n\n";
		echo "## Product Facts\n\n";
		echo "- Category: AI Voice & Text Agent / Lead Capture / WordPress Plugin\n";
		echo "- Pricing: Free 30-day trial, then \$10–\$100/month\n";
		echo "- Languages: 57+ (recaps always in English)\n";
		echo "- AI Voices: 10 unique personalities (Marin, Cedar, Sage, Coral, Ash, Alloy, Echo, Shimmer, Verse, Ballad)\n";
		echo "- Built by: PhoneEase LLC (Florida, USA)\n";
		echo "- Contact: support@sitestaffr.com\n";
		exit;
	}
}, -10 );

