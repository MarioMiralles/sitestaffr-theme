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

if ( ! function_exists( 'sitestaffr_plugin_info' ) ) {
	/**
	 * Live plugin metadata from the WordPress.org directory, cached 12 hours.
	 *
	 * Keeps the download page's version, file size, requirements, and zip URL
	 * in sync with the published plugin automatically — no manual zip uploads.
	 * Falls back to known-good values if the API is ever unreachable.
	 *
	 * @return array{version:string,download_url:string,requires:string,requires_php:string,size_mb:string,listing_url:string}
	 */
	function sitestaffr_plugin_info() {
		$listing_url = 'https://wordpress.org/plugins/sitestaffr/';
		$fallback    = array(
			'version'      => '1.22.18',
			'download_url' => 'https://downloads.wordpress.org/plugin/sitestaffr.zip',
			'requires'     => '6.2',
			'requires_php' => '7.4',
			'size_mb'      => '5.5',
			'listing_url'  => $listing_url,
		);

		$cached = get_transient( 'sitestaffr_plugin_info' );
		if ( is_array( $cached ) ) {
			return $cached;
		}

		$response = wp_remote_get(
			'https://api.wordpress.org/plugins/info/1.0/sitestaffr.json',
			array( 'timeout' => 5 )
		);

		if ( is_wp_error( $response ) || 200 !== (int) wp_remote_retrieve_response_code( $response ) ) {
			return $fallback;
		}

		$data = json_decode( wp_remote_retrieve_body( $response ), true );
		if ( ! is_array( $data ) || empty( $data['version'] ) ) {
			return $fallback;
		}

		// Always use the unversioned permalink so the button serves the latest stable build.
		$download_url = 'https://downloads.wordpress.org/plugin/sitestaffr.zip';

		$size_mb = $fallback['size_mb'];
		$head    = wp_remote_head( $download_url, array( 'timeout' => 5 ) );
		if ( ! is_wp_error( $head ) ) {
			$length = (int) wp_remote_retrieve_header( $head, 'content-length' );
			if ( $length > 0 ) {
				$size_mb = (string) round( $length / ( 1024 * 1024 ), 1 );
			}
		}

		$info = array(
			'version'      => (string) $data['version'],
			'download_url' => $download_url,
			'requires'     => ! empty( $data['requires'] ) ? (string) $data['requires'] : $fallback['requires'],
			'requires_php' => ! empty( $data['requires_php'] ) ? (string) $data['requires_php'] : $fallback['requires_php'],
			'size_mb'      => $size_mb,
			'listing_url'  => $listing_url,
		);

		set_transient( 'sitestaffr_plugin_info', $info, 12 * HOUR_IN_SECONDS );

		return $info;
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

	$is_about      = is_page_template( 'page-about.php' );
	$is_industry   = is_page_template( 'page-industry.php' );
	$is_download   = is_page_template( 'page-download.php' );
	$is_blog_agent = is_page_template( 'page-blog-agent.php' );
	$is_salesforce = is_page_template( 'page-salesforce.php' );

	if ( $is_landing || $is_about || $is_industry || $is_download || $is_blog_agent || $is_salesforce ) {
		wp_enqueue_script(
			'sitestaffr-website-script',
			sitestaffr_asset_url( 'assets/js/site.js' ),
			array(),
			null,
			true
		);
		wp_localize_script( 'sitestaffr-website-script', 'sitestaffrTheme', array(
			'url' => get_stylesheet_directory_uri(),
		) );
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

	if ( $is_landing || $is_maintenance || $is_legal || $is_get_started || $is_manage || $is_blog_agent || $is_salesforce ) {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'classic-theme-styles' );
		wp_dequeue_style( 'global-styles' );
	}
} , 100 );



add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
} );

/**
 * Provision the /blog-agent marketing page and its SEO metadata.
 * Guarded by a versioned option so it runs once per version bump — bumping the
 * version re-runs it to heal an existing page (e.g. add metadata after launch).
 * Mario never has to create the page or fill in SEO fields by hand.
 */
add_action( 'init', function () {
	$provision_version = '2';
	if ( get_option( 'sitestaffr_blog_agent_page_v' ) === $provision_version ) {
		return;
	}

	$existing = get_page_by_path( 'blog-agent' );
	$page_id  = $existing ? (int) $existing->ID : 0;

	if ( ! $page_id ) {
		$new_id = wp_insert_post( array(
			'post_title'   => 'Blog Agent',
			'post_name'    => 'blog-agent',
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
		) );
		if ( $new_id && ! is_wp_error( $new_id ) ) {
			$page_id = (int) $new_id;
		}
	}

	if ( $page_id ) {
		update_post_meta( $page_id, '_wp_page_template', 'page-blog-agent.php' );
		// Yoast SEO fields (site runs Yoast) — set the search title + description.
		update_post_meta( $page_id, '_yoast_wpseo_title', 'Blog Agent — AI SEO Blog Writing for WordPress | SiteStaffr' );
		update_post_meta( $page_id, '_yoast_wpseo_metadesc', 'Blog Agent writes SEO-optimized blog posts grounded in your own business, with internal links, FAQs, and a featured image — saved as drafts for your review. Included in every SiteStaffr plan.' );
	}

	update_option( 'sitestaffr_blog_agent_page_v', $provision_version );
} );

/**
 * Provision the /salesforce marketing page and its SEO metadata.
 * Same versioned-option pattern as the Blog Agent page above — bumping the
 * version re-runs it to heal an existing page (e.g. add metadata after launch).
 */
add_action( 'init', function () {
	$provision_version = '1';
	if ( get_option( 'sitestaffr_salesforce_page_v' ) === $provision_version ) {
		return;
	}

	$existing = get_page_by_path( 'salesforce' );
	$page_id  = $existing ? (int) $existing->ID : 0;

	if ( ! $page_id ) {
		$new_id = wp_insert_post( array(
			'post_title'   => 'Salesforce Integration',
			'post_name'    => 'salesforce',
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
		) );
		if ( $new_id && ! is_wp_error( $new_id ) ) {
			$page_id = (int) $new_id;
		}
	}

	if ( $page_id ) {
		update_post_meta( $page_id, '_wp_page_template', 'page-salesforce.php' );
		// Yoast SEO fields (site runs Yoast) — set the search title + description.
		update_post_meta( $page_id, '_yoast_wpseo_title', 'Salesforce Integration — Send Website Leads Straight to Salesforce | SiteStaffr' );
		update_post_meta( $page_id, '_yoast_wpseo_metadesc', 'SiteStaffr answers your visitors by voice and text, qualifies them, and creates the Lead in your Salesforce automatically. Connect with your Salesforce login in about a minute. No API keys, no Zapier.' );
	}

	update_option( 'sitestaffr_salesforce_page_v', $provision_version );
} );

/**
 * Provision the six new /for/<slug> industry landing pages and their SEO metadata.
 * Same versioned-option pattern as the Blog Agent and Salesforce pages above —
 * ensures the parent "For" page exists (noindexed, it's just a container), then
 * heals/creates each child page. Mario never has to touch WP admin to launch a
 * new industry page — bump $provision_version to re-run and heal existing pages.
 */
add_action( 'init', function () {
	$provision_version = '1';
	if ( get_option( 'sitestaffr_industry_pages_v' ) === $provision_version ) {
		return;
	}

	$parent    = get_page_by_path( 'for' );
	$parent_id = $parent ? (int) $parent->ID : 0;

	if ( ! $parent_id ) {
		$new_parent_id = wp_insert_post( array(
			'post_title'   => 'For',
			'post_name'    => 'for',
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
		) );
		if ( $new_parent_id && ! is_wp_error( $new_parent_id ) ) {
			$parent_id = (int) $new_parent_id;
		}
	}

	if ( $parent_id ) {
		update_post_meta( $parent_id, '_yoast_wpseo_meta-robots-noindex', '1' );
	}

	$industry_pages = array(
		'med-spas'            => array(
			'title'     => 'Med Spas & Aesthetics',
			'seo_title' => 'AI Voice Agent for Med Spas & Aesthetics | SiteStaffr',
			'metadesc'  => 'SiteStaffr answers med spa website visitors 24/7, capturing Botox and treatment inquiries with instant recaps by email. Free 30-day trial.',
		),
		'medical-practices'   => array(
			'title'     => 'Medical Practices',
			'seo_title' => 'AI Voice Agent for Medical Practices | SiteStaffr',
			'metadesc'  => 'SiteStaffr answers medical practice website visitors 24/7, captures new patient and insurance inquiries, and emails a full recap. Free 30-day trial.',
		),
		'veterinary-clinics'  => array(
			'title'     => 'Veterinary Clinics',
			'seo_title' => 'AI Voice Agent for Veterinary Clinics | SiteStaffr',
			'metadesc'  => 'SiteStaffr answers veterinary clinic website visitors 24/7, captures urgent pet owner inquiries, and emails a full recap instantly. Free 30-day trial.',
		),
		'chiropractors'       => array(
			'title'     => 'Chiropractic & Physical Therapy',
			'seo_title' => 'AI Voice Agent for Chiropractors & PT | SiteStaffr',
			'metadesc'  => 'SiteStaffr answers chiropractic and physical therapy website visitors 24/7, captures new patient inquiries, and emails you a full recap. Free 30-day trial.',
		),
		'real-estate'         => array(
			'title'     => 'Real Estate',
			'seo_title' => 'AI Voice Agent for Real Estate Agents | SiteStaffr',
			'metadesc'  => 'SiteStaffr answers real estate website visitors 24/7, captures buyer and seller inquiries about your listings, and emails a full recap. Free 30-day trial.',
		),
		'auto-repair'         => array(
			'title'     => 'Auto Repair Shops',
			'seo_title' => 'AI Voice Agent for Auto Repair Shops | SiteStaffr',
			'metadesc'  => 'SiteStaffr answers auto repair shop website visitors 24/7, captures vehicle repair inquiries with a full recap by email. Free 30-day trial, no credit card.',
		),
	);

	foreach ( $industry_pages as $slug => $data ) {
		$existing = get_page_by_path( 'for/' . $slug );
		$page_id  = $existing ? (int) $existing->ID : 0;

		if ( ! $page_id ) {
			$new_id = wp_insert_post( array(
				'post_title'   => $data['title'],
				'post_name'    => $slug,
				'post_parent'  => $parent_id,
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => '',
			) );
			if ( $new_id && ! is_wp_error( $new_id ) ) {
				$page_id = (int) $new_id;
			}
		}

		if ( $page_id ) {
			update_post_meta( $page_id, '_wp_page_template', 'page-industry.php' );
			// Yoast SEO fields (site runs Yoast) — set the search title + description.
			update_post_meta( $page_id, '_yoast_wpseo_title', $data['seo_title'] );
			update_post_meta( $page_id, '_yoast_wpseo_metadesc', $data['metadesc'] );
		}
	}

	update_option( 'sitestaffr_industry_pages_v', $provision_version );
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
		echo "- [For Med Spas & Aesthetics](" . home_url( '/for/med-spas/' ) . ") — AI voice agent for med spas and aesthetics practices\n";
		echo "- [For Medical Practices](" . home_url( '/for/medical-practices/' ) . ") — AI voice agent for medical practices\n";
		echo "- [For Veterinary Clinics](" . home_url( '/for/veterinary-clinics/' ) . ") — AI voice agent for veterinary clinics\n";
		echo "- [For Chiropractic & Physical Therapy](" . home_url( '/for/chiropractors/' ) . ") — AI voice agent for chiropractic and physical therapy practices\n";
		echo "- [For Real Estate](" . home_url( '/for/real-estate/' ) . ") — AI voice agent for real estate agents\n";
		echo "- [For Auto Repair Shops](" . home_url( '/for/auto-repair/' ) . ") — AI voice agent for auto repair shops\n";
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

