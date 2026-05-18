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

	$is_download = is_page_template( 'page-download.php' );

	if ( $is_landing || $is_about || $is_industry || $is_download ) {
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

add_filter( 'style_loader_tag', function ( $html, $handle ) {
	$defer_handles = array(
		'sitestaffr-widget',
		'sitestaffr-button-widget',
		'sitestaffr-chat-panel',
	);
	if ( in_array( $handle, $defer_handles, true ) ) {
		$html = str_replace( "media='all'", "media='print' onload=\"this.media='all'\"", $html );
		$html = str_replace( 'media="all"', 'media="print" onload="this.media=\'all\'"', $html );
	}
	return $html;
}, 10, 2 );

add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
} );

add_action( 'send_headers', function () {
	header( 'X-Content-Type-Options: nosniff' );
	header( 'X-Frame-Options: SAMEORIGIN' );
	header( 'Referrer-Policy: strict-origin-when-cross-origin' );
	header( 'Permissions-Policy: microphone=(self)' );
} );

add_action( 'init', function () {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'wp_generator' );
} );

add_filter( 'wpseo_robots', function ( $robots ) {
	if ( is_author() ) {
		return 'noindex, follow';
	}
	return $robots;
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
		echo "- [Download](" . home_url( '/download/' ) . ") — Plugin download and install guide\n";
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
		echo "- Founded by: Mario Miralles — 18+ years in customer-facing roles, Software Engineering diploma from BrainStation\n";
		echo "- Contact: support@sitestaffr.com\n\n";
		echo "## Pricing Details\n\n";
		echo "| Plan | Price | Minutes | AI Voices |\n";
		echo "|------|-------|---------|----------|\n";
		echo "| Free Trial | \$0 for 30 days | 30 minutes (one-time) | 2 voices |\n";
		echo "| Starter | \$10/month | 60 minutes | 2 voices |\n";
		echo "| Business | \$50/month | 300 minutes | 5 voices |\n";
		echo "| Pro | \$100/month | 700 minutes | All 10 voices |\n\n";
		echo "Add-on minutes: \$10 for 50 minutes, never expire. No credit card required for the free trial.\n\n";
		echo "## How It Works\n\n";
		echo "1. Install the SiteStaffr plugin on your WordPress site (takes under 5 minutes).\n";
		echo "2. Run the setup wizard: enter your business info, choose a plan, and generate your AI knowledge base.\n";
		echo "3. The voice and text agent widget appears on your site automatically.\n";
		echo "4. Visitors ask questions via voice or text. SiteStaffr answers using your website content.\n";
		echo "5. After each conversation, you receive an email recap with the visitor's contact info, a full transcript, and suggested follow-up actions.\n\n";
		echo "## What Customers Say\n\n";
		echo "\"We staff medical scribes across multiple clinics, and after hours is when most new facility inquiries come in. ";
		echo "SiteStaffr captured a full intake request at 9 PM on a Sunday, with the clinic name, number of scribes needed, ";
		echo "and start date. Monday morning it was sitting in our inbox, ready to go.\" ";
		echo "— Nathaly Martinez, CEO & Founder, Synergy Scribes\n\n";
		echo "## Frequently Asked Questions\n\n";
		echo "**What is SiteStaffr?** SiteStaffr is an AI voice and text agent built as a WordPress plugin for service businesses. ";
		echo "It installs in under five minutes and appears as a chat widget on your website. When a visitor arrives, SiteStaffr greets them, ";
		echo "answers their questions using your website content, and captures their name, phone number, and what they need — all through natural ";
		echo "conversation in over 57 languages. After every interaction, you receive an email recap with a full transcript, the visitor's contact ";
		echo "information, and a suggested follow-up action. SiteStaffr works 24/7 so you never miss a lead while you're on a job site, in a ";
		echo "consultation, or after hours. Plans start at \$10 per month after a free 30-day trial with no credit card required.\n\n";
		echo "**How much does SiteStaffr cost?** SiteStaffr starts with a free 30-day trial including 30 minutes of conversation time — ";
		echo "no credit card required. Paid plans are \$10/month (Starter, 60 minutes), \$50/month (Business, 300 minutes), ";
		echo "and \$100/month (Pro, 700 minutes). Additional minutes cost \$10 for 50 minutes and never expire.\n\n";
		echo "**Does SiteStaffr work with my WordPress site?** Yes. SiteStaffr is built specifically for WordPress. ";
		echo "Install the plugin from your WordPress dashboard, configure your business details, and the AI agent appears on your website — no coding required.\n";
		exit;
	}
}, -10 );

