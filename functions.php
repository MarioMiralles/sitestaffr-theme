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

/**
 * Purge cached HTML when a new theme build lands.
 *
 * The site sits behind LiteSpeed. Deploying the theme over FTP changes template
 * and copy files but touches nothing WordPress considers "content", so no
 * invalidation hook fires and visitors keep getting the previous HTML — a
 * deploy that succeeds and changes nothing visible. CSS and JS escape this only
 * because sitestaffr_asset_url() appends a filemtime query string; markup has no
 * equivalent.
 *
 * Watch the theme's own version (style.css "Version:") and purge once when it
 * changes. Bumping that header is therefore what publishes a copy or template
 * change — the provisioner purge added alongside this only covers the industry
 * pages, and only when its own version bumps.
 *
 * Purging via the `X-LiteSpeed-Purge` RESPONSE HEADER, which LiteSpeed Web
 * Server itself acts on, rather than the plugin's `litespeed_purge_all` action:
 * the action alone was verified NOT to clear the cache from here (theme 0.2.5
 * shipped a new footer and the homepage kept serving the old markup, while the
 * same URL with a cache-busting query string returned the new one). The action
 * is still fired as a belt-and-braces second path.
 *
 * Runs on send_headers so the header lands on a real front-end response, and
 * only records the version once the header has actually gone out — the previous
 * version marked itself done even when the purge silently failed, so it never
 * retried.
 */
add_action( 'send_headers', function () {
	if ( is_admin() || headers_sent() ) {
		return;
	}

	$theme_version = wp_get_theme()->get( 'Version' );
	if ( ! $theme_version ) {
		return;
	}

	if ( get_option( 'sitestaffr_theme_purged_v' ) === $theme_version ) {
		return;
	}

	header( 'X-LiteSpeed-Purge: *' );
	do_action( 'litespeed_purge_all' );

	update_option( 'sitestaffr_theme_purged_v', $theme_version );
} );

if ( ! function_exists( 'sitestaffr_heal_post_title' ) ) {
	/**
	 * Set a page's post_title from the registry and force Yoast to re-derive its metadata.
	 *
	 * Two separate problems, one call.
	 *
	 * 1. Provisioners set post_title only inside wp_insert_post, so a page created before the
	 *    registry existed keeps its original title forever while every other managed field is
	 *    rewritten on each version bump.
	 *
	 * 2. Yoast does not read post meta at render time. It caches a derived row per post in its
	 *    own indexable table — breadcrumb title, SEO title, social titles — and only rebuilds
	 *    it when the post is saved. So writing `_yoast_wpseo_*` meta or deleting an override
	 *    updates the source of truth while the served output keeps coming from the stale row.
	 *
	 * That second point is why this call is deliberately unconditional. An earlier version
	 * skipped the update when post_title already matched, which looked like a sensible
	 * optimisation and was in fact the bug: on three pages post_title was already correct, the
	 * update was skipped, save_post never fired, and the BreadcrumbList kept serving
	 * "AI Voice Agent for Dental Practices" through two further fixes that each looked like
	 * they had failed. Nothing here runs per-request — the caller is version-gated and returns
	 * early unless the provision version changed — so this is a handful of saves once per bump.
	 *
	 * Only post_title is passed, so post_name (and the live URL) is untouched.
	 *
	 * @param int    $page_id Post ID.
	 * @param string $title   Title the registry says it should have.
	 */
	function sitestaffr_heal_post_title( $page_id, $title ) {
		$page_id = (int) $page_id;
		$title   = (string) $title;
		if ( ! $page_id || '' === $title ) {
			return;
		}

		wp_update_post( array(
			'ID'         => $page_id,
			'post_title' => $title,
		) );
	}
}

if ( ! function_exists( 'sitestaffr_clear_yoast_title_overrides' ) ) {
	/**
	 * Drop a page's stored Yoast title/description overrides so everything falls back to the
	 * SEO title and description the provisioner manages.
	 *
	 * Yoast keeps the Open Graph title, Twitter title, their descriptions, and the breadcrumb
	 * title in meta keys SEPARATE from `_yoast_wpseo_title`. Writing the SEO title alone
	 * leaves any stored override serving the old string, so the browser tab and Google show
	 * new copy while a social share or the breadcrumb shows stale copy.
	 *
	 * This has now bitten three times in the same shape:
	 *   - homepage, theme 0.6.10 — og:title still "AI Voice Assistant for Websites"
	 *   - industry pages, 0.6.23 — og:title still "AI Voice Agent for ..." on three pages,
	 *     plus an og:description on home-services with the old "name, number" copy
	 *   - the same three pages, 0.6.24 — `_yoast_wpseo_bctitle` still put "AI Voice Agent for
	 *     Dental Practices" in the BreadcrumbList JSON-LD while the other twelve pages
	 *     correctly showed their short post title
	 *
	 * Delete rather than duplicate the text, so there is one source of truth. Only overrides
	 * that actually exist are affected, so this is safe to call on every page.
	 *
	 * @param int $page_id Post ID to clear.
	 */
	function sitestaffr_clear_yoast_title_overrides( $page_id ) {
		$page_id = (int) $page_id;
		if ( ! $page_id ) {
			return;
		}

		foreach ( array(
			'_yoast_wpseo_opengraph-title',
			'_yoast_wpseo_opengraph-description',
			'_yoast_wpseo_twitter-title',
			'_yoast_wpseo_twitter-description',
			'_yoast_wpseo_bctitle',
		) as $override_key ) {
			delete_post_meta( $page_id, $override_key );
		}
	}
}

if ( ! function_exists( 'sitestaffr_plugin_info' ) ) {
	/**
	 * Live plugin metadata from our own signed release manifest, cached 12 hours.
	 *
	 * The zip this page serves is the DIRECT-DOWNLOAD build, which updates itself from
	 * sitestaffr.com. The WordPress.org build cannot: guideline 8 forbids a plugin in the
	 * directory from updating itself from anywhere else. So anyone who installs from this
	 * page stays updatable even if the .org listing goes away, and anyone who installs from
	 * the directory depends on the directory continuing to exist.
	 *
	 * This used to read api.wordpress.org and link downloads.wordpress.org. That made the
	 * download page fail in the one scenario it most needs to survive: if the listing is
	 * closed, the API call fails, the page falls back to a hardcoded version that was twenty
	 * releases stale, and the download button 404s. The source of truth is now ours.
	 *
	 * @return array{version:string,download_url:string,requires:string,requires_php:string,size_mb:string,listing_url:string}
	 */
	function sitestaffr_plugin_info() {
		$listing_url = 'https://wordpress.org/plugins/sitestaffr/';

		// Kept current by the release runbook. Only reached if every endpoint is unreachable,
		// so it must point at a real, downloadable build rather than a placeholder.
		$fallback = array(
			'version'      => '1.42.7',
			'download_url' => 'https://storage.googleapis.com/sitestaffr-releases/sitestaffr-v1.42.7-032923ba28ce.zip',
			'requires'     => '6.2',
			'requires_php' => '7.4',
			'size_mb'      => '5.7',
			'listing_url'  => $listing_url,
		);

		$cached = get_transient( 'sitestaffr_plugin_info' );
		if ( is_array( $cached ) ) {
			return $cached;
		}

		// Same two endpoints, in the same order, that the plugin itself checks.
		$endpoints = array(
			'https://updates.sitestaffr.com/api/plugin/update',
			'https://phoneease-middleware-375589245036.us-central1.run.app/api/plugin/update',
		);

		$manifest = null;
		foreach ( $endpoints as $endpoint ) {
			$response = wp_remote_get( $endpoint, array( 'timeout' => 5 ) );

			if ( is_wp_error( $response ) || 200 !== (int) wp_remote_retrieve_response_code( $response ) ) {
				continue;
			}

			$data = json_decode( wp_remote_retrieve_body( $response ), true );

			// The download URL is prefix-checked rather than merely non-empty. This value goes
			// straight into a download link on a public page, so a malformed or unexpected
			// manifest must not be able to point visitors somewhere else.
			if (
				is_array( $data )
				&& ! empty( $data['version'] )
				&& ! empty( $data['download_url'] )
				&& 0 === strpos( $data['download_url'], 'https://storage.googleapis.com/sitestaffr-releases/' )
			) {
				$manifest = $data;
				break;
			}
		}

		if ( null === $manifest ) {
			return $fallback;
		}

		$size_mb = $fallback['size_mb'];
		$head    = wp_remote_head( $manifest['download_url'], array( 'timeout' => 5 ) );
		if ( ! is_wp_error( $head ) ) {
			$length = (int) wp_remote_retrieve_header( $head, 'content-length' );
			if ( $length > 0 ) {
				$size_mb = (string) round( $length / ( 1024 * 1024 ), 1 );
			}
		}

		$info = array(
			'version'      => (string) $manifest['version'],
			'download_url' => (string) $manifest['download_url'],
			'requires'     => ! empty( $manifest['requires'] ) ? (string) $manifest['requires'] : $fallback['requires'],
			'requires_php' => ! empty( $manifest['requires_php'] ) ? (string) $manifest['requires_php'] : $fallback['requires_php'],
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
	// /for/ and the category hubs use the same .reveal markup as the industry
	// pages. Without site.js those elements stay at opacity 0 forever — the
	// /for/ index shipped with its entire directory invisible because this list
	// was never extended. Any template using .reveal has to be here.
	$is_for_index  = is_page_template( 'page-for.php' ) || is_page( 'for' );
	$is_ind_cat    = is_page_template( 'page-industry-category.php' );
	/* The agencies page uses the FAQ accordion and the shared nav, both of which are
	   driven by site.js. Adding the template here rather than relying on the landing
	   page's enqueue - a template that renders interactive components and is not in
	   this list ships them dead, which is how the /for/ index once shipped with its
	   entire directory invisible. */
	$is_agencies   = is_page_template( 'page-agencies.php' );

	if ( $is_landing || $is_about || $is_industry || $is_download || $is_blog_agent || $is_salesforce || $is_for_index || $is_ind_cat || $is_agencies ) {
		/* Section 3's demo script and timings. Landing page only — no other template has
		   the panels, and loading the timings elsewhere would be dead weight.

		   It is a SEPARATE FILE from site.js on purpose: it is the one thing that changes
		   when Mario's auto-repair recording lands, and keeping it separate means that
		   change never touches the file driving the nav, the FAQ and the accordion. */
		if ( $is_landing ) {
			wp_enqueue_script(
				'sitestaffr-demo-timings',
				sitestaffr_asset_url( 'assets/js/demo-timings.js' ),
				array(),
				null,
				true
			);
		}

		wp_enqueue_script(
			'sitestaffr-website-script',
			sitestaffr_asset_url( 'assets/js/site.js' ),
			$is_landing ? array( 'sitestaffr-demo-timings' ) : array(),
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
 * Provision the homepage's search title and description.
 *
 * These were the last SEO fields still set by hand in wp-admin, and they had drifted.
 * The title read "SiteStaffr – AI Voice Assistant for Websites | Capture Leads 24/7":
 * voice-only for a product that now leads with unlimited text chat, using "Assistant"
 * (a term the brand tone guide bans), and — on the page most likely to rank for it —
 * omitting "WordPress" altogether. Putting them in code makes the homepage's search
 * listing reviewable in git like every other page.
 *
 * Title tags carry SEARCH vocabulary rather than brand vocabulary. "Plugin" and "chat"
 * are what buyers actually type, even though the hero deliberately avoids them.
 *
 * Bump $provision_version to re-apply after an edit.
 */
add_action( 'init', function () {
	$provision_version = '2';
	if ( get_option( 'sitestaffr_home_seo_v' ) === $provision_version ) {
		return;
	}

	// Only meaningful with a static front page; otherwise Yoast reads its own
	// Search Appearance settings and post meta would be ignored.
	if ( 'page' !== get_option( 'show_on_front' ) ) {
		return;
	}

	$page_id = (int) get_option( 'page_on_front' );
	if ( ! $page_id ) {
		return;
	}

	update_post_meta( $page_id, '_yoast_wpseo_title', 'AI Chat &amp; Voice Plugin for WordPress | SiteStaffr' );
	update_post_meta( $page_id, '_yoast_wpseo_metadesc', 'Answer every website visitor by chat or voice, capture the lead, and get a full recap by email. Free 30-day trial, no credit card required.' );

	sitestaffr_clear_yoast_title_overrides( $page_id );

	update_option( 'sitestaffr_home_seo_v', $provision_version );
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
 * THE industry registry — one source of truth for which /for/ pages exist and
 * how they present themselves. The nav panel, the footer, the /for/ index, the
 * llms.txt output and the page provisioner all read from here.
 *
 * TO ADD AN INDUSTRY: add an entry here, add its content entry to the
 * $industries array in page-industry.php (same slug), and bump
 * $provision_version below. Two files, one bump — nothing else to wire. Drop it
 * into whichever group it belongs to and its category hub picks it up
 * automatically; no separate wiring per category.
 *
 * TO ADD A CATEGORY: add a group here with heading/slug/icon/seo_title/
 * metadesc/intro and bump $provision_version. The hub page, the footer link and
 * the /for/ index section all come from this one entry.
 *
 * Industry fields: slug · title (WP page title) · label (nav/footer/index,
 * defaults to title) · icon · blurb (one-liner on the /for/ index) · llms
 * (llms.txt description) · seo_title + metadesc (Yoast, written by the
 * provisioner).
 *
 * Group fields: heading · slug (its hub at /for/<slug>/) · icon · seo_title +
 * metadesc (Yoast) · intro (lead paragraph on the hub). Category slugs share
 * the /for/ namespace with industry slugs, so they must not collide — the
 * industries were already indexed under /for/<industry>/ and reparenting them
 * would have changed live URLs.
 *
 * @return array<int,array<string,mixed>> Ordered groups, each with a heading and its industries.
 */
function sitestaffr_industry_registry() {
	return array(
		array(
			'heading'    => 'Health & Medical',
			'slug'       => 'health-medical',
			'icon'       => '🏥',
			'seo_title'  => 'AI Chat & Voice Agents for Healthcare Practices | SiteStaffr',
			'metadesc'   => 'Patient questions answered on your website 24/7, for dental, medical, chiropractic and veterinary practices. Every inquiry captured. Free 30-day trial.',
			'intro'      => 'Patients look for care outside office hours, and the practice that answers first usually gets the appointment. SiteStaffr picks up on your website day, night and weekend, and sends you every detail.',
			'industries' => array(
				array(
					'slug'      => 'dental-practices',
					'title'     => 'Dental Practices',
					'icon'      => '🦷',
					'blurb'     => 'Emergency questions and new-patient inquiries answered while your front desk is with a patient.',
					'llms'      => 'AI chat and voice agent for dental offices',
					'seo_title' => 'AI Chat & Voice Agent for Dental Practices | SiteStaffr',
					'metadesc'  => 'SiteStaffr greets dental patients on your website 24/7, answering questions, capturing new patient inquiries, and sending you a full recap. Free 30-day trial.',
				),
				array(
					'slug'      => 'medical-practices',
					'title'     => 'Medical Practices',
					'icon'      => '🩺',
					'blurb'     => 'Insurance and new-patient questions handled after hours, with the details in your inbox.',
					'llms'      => 'AI chat and voice agent for medical practices',
					'seo_title' => 'AI Chat & Voice Agent for Medical Practices | SiteStaffr',
					'metadesc'  => 'SiteStaffr answers medical practice website visitors 24/7, captures new patient and insurance inquiries, and emails a full recap. Free 30-day trial.',
				),
				array(
					'slug'      => 'chiropractors',
					'title'     => 'Chiropractic & Physical Therapy',
					'label'     => 'Chiropractic & PT',
					'icon'      => '🦴',
					'blurb'     => 'Turn evening pain-relief searches into booked consultations instead of missed forms.',
					'llms'      => 'AI chat and voice agent for chiropractic and physical therapy practices',
					'seo_title' => 'AI Chat & Voice Agent for Chiropractors & PT | SiteStaffr',
					'metadesc'  => 'SiteStaffr answers chiropractic and physical therapy website visitors 24/7, captures new patient inquiries, and emails you a full recap. Free 30-day trial.',
				),
				array(
					'slug'      => 'veterinary-clinics',
					'title'     => 'Veterinary Clinics',
					'icon'      => '🐾',
					'blurb'     => 'Worried pet owners get an answer at midnight and you get their details right away.',
					'llms'      => 'AI chat and voice agent for veterinary clinics',
					'seo_title' => 'AI Chat & Voice Agent for Veterinary Clinics | SiteStaffr',
					'metadesc'  => 'SiteStaffr answers veterinary clinic website visitors 24/7, captures urgent pet owner inquiries, and emails a full recap instantly. Free 30-day trial.',
				),
				/* THE SIXTEENTH INDUSTRY, added 2026-08-26. It exists so section 7's
				   testimonial belongs to a named industry: Synergy Scribes is medical
				   staffing, and until now the proof section named a business in a
				   category the industries section did not list.

				   IT GOES IN HEALTH & MEDICAL EVEN THOUGH IT IS B2B. Someone searching
				   for it thinks healthcare, and the five groups are a browse aid rather
				   than a taxonomy — filing it by business model instead of by the word
				   people would look under would be technically tidier and less useful.

				   ⚠️ The homepage's industry count is COUNTED from this registry
				   (page-landing.php derives "+N more" from sitestaffr_industry_list()),
				   so adding this entry moves that number by itself. The plugin's
				   "Great For" list is a SEPARATE repo and is not updated by this. */
				array(
					'slug'      => 'medical-staffing',
					'title'     => 'Medical Staffing',
					'icon'      => '🩺',
					'blurb'     => 'After-hours facility inquiries answered and captured, with the details ready on Monday.',
					'llms'      => 'AI chat and voice agent for medical staffing agencies',
					'seo_title' => 'AI Chat & Voice Agent for Medical Staffing | SiteStaffr',
					'metadesc'  => 'SiteStaffr answers medical staffing website visitors 24/7, captures facility and scribe inquiries after hours, and emails a full recap. Free 30-day trial.',
				),
			),
		),
		array(
			'heading'    => 'Beauty & Wellness',
			'slug'       => 'beauty-wellness',
			'icon'       => '💆',
			'seo_title'  => 'AI Chat & Voice Agents for Salons & Spas | SiteStaffr',
			'metadesc'   => 'Answer pricing and availability questions on your website 24/7, for med spas, salons, barbershops and fitness studios. Free 30-day trial.',
			'intro'      => 'Most bookings start with a question about price, availability or what a treatment involves. SiteStaffr answers from your own website content and takes the client\'s details before they move on.',
			'industries' => array(
				array(
					'slug'      => 'med-spas',
					'title'     => 'Med Spas & Aesthetics',
					'icon'      => '✨',
					'blurb'     => 'Answer treatment and pricing questions the moment someone is ready to book.',
					'llms'      => 'AI chat and voice agent for med spas and aesthetics practices',
					'seo_title' => 'AI Chat & Voice Agent for Med Spas & Aesthetics | SiteStaffr',
					'metadesc'  => 'SiteStaffr answers med spa website visitors 24/7, capturing Botox and treatment inquiries with instant recaps by email. Free 30-day trial.',
				),
				array(
					'slug'      => 'salons-barbershops',
					'title'     => 'Salons & Barbershops',
					'icon'      => '💈',
					'blurb'     => 'Capture appointment requests that arrive long after the last chair is empty.',
					'llms'      => 'AI chat and voice agent for salons and barbershops',
					'seo_title' => 'AI Chat & Voice Agent for Salons & Barbershops | SiteStaffr',
					'metadesc'  => 'SiteStaffr answers salon and barbershop website visitors 24/7, captures booking inquiries, and emails a full recap instantly. Free 30-day trial.',
				),
				array(
					'slug'      => 'fitness-studios',
					'title'     => 'Fitness Studios',
					'icon'      => '🏋️',
					'blurb'     => 'Class times, trial passes, and membership questions answered around the clock.',
					'llms'      => 'AI chat and voice agent for fitness studios',
					'seo_title' => 'AI Chat & Voice Agent for Fitness Studios | SiteStaffr',
					'metadesc'  => 'SiteStaffr answers fitness studio website visitors 24/7, captures class and trial pass inquiries, and emails a recap instantly. Free 30-day trial.',
				),
			),
		),
		array(
			'heading'    => 'Home & Trades',
			'slug'       => 'home-trades',
			'icon'       => '🔧',
			'seo_title'  => 'AI Chat & Voice Agents for Home Services | SiteStaffr',
			'metadesc'   => 'Capture urgent home service jobs around the clock, for HVAC, plumbing, pest control and general contracting. Every lead in your inbox. Free 30-day trial.',
			'intro'      => 'Home service work is urgent and competitive: whoever answers first usually wins the job. SiteStaffr responds on your website at any hour and gets the name, number and problem to you right away.',
			'industries' => array(
				array(
					'slug'      => 'home-services',
					'title'     => 'Home Services',
					'icon'      => '🏠',
					'blurb'     => 'Quote requests captured while you are on a job instead of going to whoever answers first.',
					'llms'      => 'AI chat and voice agent for contractors',
					'seo_title' => 'AI Chat & Voice Agent for Home Services | SiteStaffr',
					'metadesc'  => 'SiteStaffr answers your website visitors while you&rsquo;re on the job. It captures every lead with name, email, phone, and job details, 24/7. Free 30-day trial.',
				),
				array(
					'slug'      => 'hvac-plumbing',
					'title'     => 'HVAC & Plumbing',
					'icon'      => '🚿',
					'blurb'     => 'No heat at 11 PM, a pipe letting go on a Sunday. These go to whoever answers first.',
					'llms'      => 'AI chat and voice agent for HVAC and plumbing companies',
					'seo_title' => 'AI Chat & Voice Agent for HVAC & Plumbing | SiteStaffr',
					'metadesc'  => 'SiteStaffr answers HVAC and plumbing website visitors 24/7, captures no-heat and leak emergencies, and emails a recap instantly. Free 30-day trial.',
				),
				array(
					'slug'      => 'pest-control',
					'title'     => 'Pest Control',
					'icon'      => '🐜',
					'blurb'     => 'Someone who just saw a roach wants a visit tomorrow, not a callback next week.',
					'llms'      => 'AI chat and voice agent for pest control companies',
					'seo_title' => 'AI Chat & Voice Agent for Pest Control | SiteStaffr',
					'metadesc'  => 'SiteStaffr answers pest control website visitors 24/7, captures urgent pest inquiries with full details, and emails a recap instantly. Free 30-day trial.',
				),
			),
		),
		array(
			'heading'    => 'Professional Services',
			'slug'       => 'professional-services',
			'icon'       => '💼',
			'seo_title'  => 'AI Chat & Voice Agents for Professional Firms | SiteStaffr',
			'metadesc'   => 'Qualify new client inquiries on your website 24/7, for law firms, accounting and tax practices, and insurance agencies. Free 30-day trial.',
			'intro'      => 'New clients research quietly, then reach out once. SiteStaffr answers their first questions on your site, captures what they need, and sends you a full recap before they contact anyone else.',
			'industries' => array(
				array(
					'slug'      => 'law-firms',
					'title'     => 'Law Firms',
					'icon'      => '⚖️',
					'blurb'     => 'Intake questions answered and case details captured before the next firm replies.',
					'llms'      => 'AI chat and voice agent for legal practices',
					'seo_title' => 'AI Chat & Voice Agent for Law Firms | SiteStaffr',
					'metadesc'  => 'SiteStaffr captures client inquiries on your law firm&rsquo;s website around the clock, qualifying leads and sending you a full intake recap. Free 30-day trial.',
				),
				array(
					'slug'      => 'accounting-tax',
					'title'     => 'Accounting & Tax',
					'icon'      => '📊',
					'blurb'     => 'Deadline-week inquiries collected in full so nothing waits on a voicemail.',
					'llms'      => 'AI chat and voice agent for accounting and tax firms',
					'seo_title' => 'AI Chat & Voice Agent for Accounting & Tax | SiteStaffr',
					'metadesc'  => 'SiteStaffr answers accounting and tax website visitors 24/7, captures new client inquiries, and emails a full recap instantly. Free 30-day trial.',
				),
				array(
					'slug'      => 'insurance-agencies',
					'title'     => 'Insurance Agencies',
					'icon'      => '🛡️',
					'blurb'     => 'Quote and coverage questions captured while prospects are still comparing.',
					'llms'      => 'AI chat and voice agent for insurance agencies',
					'seo_title' => 'AI Chat & Voice Agent for Insurance Agencies | SiteStaffr',
					'metadesc'  => 'SiteStaffr answers insurance agency website visitors 24/7, captures quote and coverage requests, and emails a full recap instantly. Free 30-day trial.',
				),
			),
		),
		array(
			'heading'    => 'Property & Auto',
			'slug'       => 'property-auto',
			'icon'       => '🚗',
			'seo_title'  => 'AI Chat & Voice Agents for Real Estate & Auto | SiteStaffr',
			'metadesc'   => 'Answer listing and repair questions the moment they come in, for real estate agents and auto repair shops. Every lead captured. Free 30-day trial.',
			'intro'      => 'Buyers and drivers make decisions fast and rarely wait for a callback. SiteStaffr answers on your website the moment they ask and passes you the details while they are still interested.',
			'industries' => array(
				array(
					'slug'      => 'real-estate',
					'title'     => 'Real Estate',
					'icon'      => '🏡',
					'blurb'     => 'Listing questions answered on a Sunday, with the buyer&rsquo;s details in your inbox.',
					'llms'      => 'AI chat and voice agent for real estate agents',
					'seo_title' => 'AI Chat & Voice Agent for Real Estate Agents | SiteStaffr',
					'metadesc'  => 'SiteStaffr answers real estate website visitors 24/7, captures buyer and seller inquiries about your listings, and emails a full recap. Free 30-day trial.',
				),
				array(
					'slug'      => 'auto-repair',
					'title'     => 'Auto Repair Shops',
					'icon'      => '🔧',
					'blurb'     => 'Vehicle, symptom, and contact details captured before the shop opens.',
					'llms'      => 'AI chat and voice agent for auto repair shops',
					'seo_title' => 'AI Chat & Voice Agent for Auto Repair Shops | SiteStaffr',
					'metadesc'  => 'SiteStaffr answers auto repair shop website visitors 24/7, captures vehicle repair inquiries with a full recap by email. Free 30-day trial, no credit card.',
				),
			),
		),
	);
}

/**
 * Flat industry list for the consumers that don't care about grouping
 * (footer, llms.txt, page provisioning). Each entry gains a resolved 'label'.
 *
 * @return array<int,array<string,mixed>>
 */
/**
 * The registry group whose hub slug matches, or null.
 *
 * Used by the category hub template to work out which group it is rendering
 * from the page it was assigned to, so one template serves all categories.
 *
 * @param string $slug Category slug.
 * @return array<string,mixed>|null
 */
function sitestaffr_industry_category( $slug ) {
	foreach ( sitestaffr_industry_registry() as $group ) {
		if ( isset( $group['slug'] ) && $group['slug'] === $slug ) {
			return $group;
		}
	}
	return null;
}

/**
 * Flat list of the category groups, without their industries.
 *
 * For the footer and any other nav that wants the five categories rather than
 * all fifteen industries.
 *
 * @return array<int,array<string,mixed>>
 */
function sitestaffr_industry_categories() {
	$categories = array();
	foreach ( sitestaffr_industry_registry() as $group ) {
		if ( empty( $group['slug'] ) ) {
			continue;
		}
		$categories[] = array(
			'slug'  => $group['slug'],
			'label' => isset( $group['label'] ) ? $group['label'] : $group['heading'],
			'icon'  => isset( $group['icon'] ) ? $group['icon'] : '',
			'count' => isset( $group['industries'] ) ? count( $group['industries'] ) : 0,
		);
	}
	return $categories;
}

/**
 * Card-sized thumbnail for an industry's isometric art, or '' when there is none.
 *
 * The full 1024px hero art in assets/images/industries/ is what page-industry.php
 * puts at the top of each landing page; thumbs/ holds the trimmed-and-shrunk
 * version the card grids use, so the /for/ index isn't fifteen full heroes.
 * Optional by design: an industry added to the registry before its art is drawn
 * falls back to its emoji rather than rendering a broken image.
 *
 * @param string $slug Industry slug.
 * @return string Cache-busted URL, or '' if no thumbnail exists.
 */
function sitestaffr_industry_art_thumb_url( $slug ) {
	$relative = 'assets/images/industries/thumbs/' . $slug . '.webp';
	if ( ! file_exists( get_stylesheet_directory() . '/' . $relative ) ) {
		return '';
	}
	return sitestaffr_asset_url( $relative );
}

/**
 * Full-size industry isometric, for the homepage's section 6 panel.
 *
 * The 1024x1024 originals rather than the thumbs: section 6 renders them at ~440px on
 * desktop and ~200px inside the mobile accordion, and the thumb set is sized for the
 * small card grids on /for/.
 *
 * ⚠️ RETURNS '' WHEN THE FILE IS ABSENT, exactly like the thumb helper, and callers are
 * expected to branch on that. Medical Staffing was added to the registry on 2026-08-26
 * before its isometric was keyed, so this returning empty is a REAL state today, not a
 * theoretical one. A missing render must degrade to something deliberate rather than to
 * a broken-image box.
 *
 * @param string $slug Industry slug.
 * @return string URL, or '' if there is no render for this industry yet.
 */
function sitestaffr_industry_art_url( $slug ) {
	$relative = 'assets/images/industries/' . $slug . '.webp';
	if ( ! file_exists( get_stylesheet_directory() . '/' . $relative ) ) {
		return '';
	}
	return sitestaffr_asset_url( $relative );
}

function sitestaffr_industry_list() {
	$flat = array();
	foreach ( sitestaffr_industry_registry() as $group ) {
		foreach ( $group['industries'] as $industry ) {
			$industry['label'] = isset( $industry['label'] ) ? $industry['label'] : $industry['title'];
			$flat[]            = $industry;
		}
	}
	return $flat;
}

/**
 * Provision the /for/<slug> industry landing pages and their SEO metadata from
 * the registry above. Same versioned-option pattern as the Blog Agent and
 * Salesforce pages — ensures the parent "For" page exists (it's a real indexed
 * index page now), then heals/creates each child page. Mario never has to touch
 * WP admin to launch a new industry page — bump $provision_version to re-run
 * and heal existing pages.
 */
add_action( 'init', function () {
	$provision_version = '11';
	if ( get_option( 'sitestaffr_industry_pages_v' ) === $provision_version ) {
		return;
	}

	// Pages touched by this run, purged from LiteSpeed at the end. Provisioning
	// writes post meta rather than saving the post, so none of LiteSpeed's own
	// invalidation hooks fire and the stale HTML survives the deploy — that is
	// how the v4 SEO fix looked like a no-op on /for/ until the cache was
	// bypassed with a query string. Every future bump would hit the same wall.
	$provisioned_ids = array();

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

	// The parent is a real index page now, but v3 only wrote SEO fields for the
	// CHILDREN — so /for/ shipped with WordPress's fallback title ("For -
	// SiteStaffr"), no meta description, and the stored Yoast noindex left over
	// from when it was just a URL container. Verified live after the v3 deploy.
	// Heal all three here; the children are already correct.
	if ( $parent_id ) {
		delete_post_meta( $parent_id, '_yoast_wpseo_meta-robots-noindex' );
		delete_post_meta( $parent_id, '_yoast_wpseo_meta-robots-nofollow' );
		update_post_meta( $parent_id, '_yoast_wpseo_title', 'AI Chat & Voice Agent by Industry | SiteStaffr' );
		update_post_meta( $parent_id, '_yoast_wpseo_metadesc', 'See how SiteStaffr\'s AI chat and voice agent works for dental, medical, home services, law, auto and 10 more industries. Free 30-day trial.' );
		sitestaffr_clear_yoast_title_overrides( $parent_id );
		$provisioned_ids[] = $parent_id;
	}

	// Category hubs at /for/<category>/ — siblings of the industry pages, not
	// parents of them. Reparenting the industries would have rewritten fifteen
	// URLs that are already live and indexed.
	foreach ( sitestaffr_industry_registry() as $group ) {
		if ( empty( $group['slug'] ) ) {
			continue;
		}

		$existing_cat = get_page_by_path( 'for/' . $group['slug'] );
		$cat_id       = $existing_cat ? (int) $existing_cat->ID : 0;

		if ( ! $cat_id ) {
			$new_cat_id = wp_insert_post( array(
				'post_title'   => $group['heading'],
				'post_name'    => $group['slug'],
				'post_parent'  => $parent_id,
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => '',
			) );
			if ( $new_cat_id && ! is_wp_error( $new_cat_id ) ) {
				$cat_id = (int) $new_cat_id;
			}
		}

		if ( $cat_id ) {
			update_post_meta( $cat_id, '_wp_page_template', 'page-industry-category.php' );
			if ( ! empty( $group['seo_title'] ) ) {
				update_post_meta( $cat_id, '_yoast_wpseo_title', $group['seo_title'] );
			}
			if ( ! empty( $group['metadesc'] ) ) {
				update_post_meta( $cat_id, '_yoast_wpseo_metadesc', $group['metadesc'] );
			}
			sitestaffr_clear_yoast_title_overrides( $cat_id );
			// Last, same reason as the industry pages below: the save is what rebuilds
			// Yoast's cached row, so it has to follow the meta writes.
			sitestaffr_heal_post_title( $cat_id, $group['heading'] );
			$provisioned_ids[] = $cat_id;
		}
	}

	$industry_pages = sitestaffr_industry_list();

	foreach ( $industry_pages as $data ) {
		$slug     = $data['slug'];
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
			sitestaffr_clear_yoast_title_overrides( $page_id );

			// LAST, and the order matters. This saves the post, which is what makes Yoast
			// rebuild its cached indexable row for the page. Run it before the meta writes
			// above and the rebuild would read the values we are replacing.
			sitestaffr_heal_post_title( $page_id, $data['title'] );

			$provisioned_ids[] = $page_id;
		}
	}

	// Drop the cached HTML for everything just provisioned. No-ops when
	// LiteSpeed is not installed, and runs once per version bump.
	foreach ( array_unique( $provisioned_ids ) as $purge_id ) {
		do_action( 'litespeed_purge_post', $purge_id );
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
		echo "> An AI receptionist for your website, built for service businesses on WordPress. It answers visitors by text or voice, captures leads, and writes your blog.\n\n";
		echo "SiteStaffr is a WordPress plugin that adds an AI-powered voice and text chat agent to your website. ";
		echo "It greets visitors, answers questions using your website content, captures contact information, ";
		echo "and sends you detailed conversation recaps by email — automatically, 24/7, in over 57 languages.\n\n";
		echo "## Key Pages\n\n";
		echo "- [Home](" . home_url( '/' ) . ") — Product overview, pricing, and demo\n";
		echo "- [Download](" . home_url( '/download/' ) . ") — Plugin download and install guide\n";
		echo "- [About](" . home_url( '/about/' ) . ") — Company and founder information\n";
		echo "- [Blog](" . home_url( '/blog/' ) . ") — Guides and comparisons for service businesses\n";
		foreach ( sitestaffr_industry_list() as $sitestaffr_industry ) {
			echo "- [For " . $sitestaffr_industry['title'] . "](" . home_url( '/for/' . $sitestaffr_industry['slug'] . '/' ) . ") — " . $sitestaffr_industry['llms'] . "
";
		}
		echo "- [Privacy Policy](" . home_url( '/privacy/' ) . ") — How we handle data\n";
		echo "- [Terms of Service](" . home_url( '/terms/' ) . ") — Usage terms\n\n";
		echo "## Product Facts\n\n";
		echo "- Category: AI Voice & Text Agent / Lead Capture / WordPress Plugin\n";
		echo "- Pricing: Free 30-day trial, then \$29–\$129/month\n";
		echo "- Languages: 57+ (recaps always in English)\n";
		echo "- AI Voices: 10 unique personalities (Marin, Cedar, Sage, Coral, Ash, Alloy, Echo, Shimmer, Verse, Ballad)\n";
		echo "- Built by: PhoneEase LLC (Florida, USA)\n";
		echo "- Founded by: Mario Miralles — 18+ years in customer-facing roles, Software Engineering diploma from BrainStation\n";
		echo "- Contact: support@sitestaffr.com\n\n";
		echo "## Pricing Details\n\n";
		echo "| Plan | Price | Text chat | Voice minutes | AI Voices |\n";
		echo "|------|-------|-----------|---------------|----------|\n";
		echo "| Free Trial | \$0 for 30 days | Included | 30 minutes (one-time) | 2 voices |\n";
		echo "| Starter | \$29/month | Unlimited | 100 minutes | 2 voices |\n";
		echo "| Business | \$69/month | Unlimited | 300 minutes | 5 voices |\n";
		echo "| Pro | \$129/month | Unlimited | 600 minutes | All 10 voices |\n\n";
		echo "Add-on minutes: \$20 for 60 minutes, never expire. No credit card required for the free trial.\n\n";
		echo "## How It Works\n\n";
		echo "1. Install the SiteStaffr plugin on your WordPress site (takes under 5 minutes).\n";
		echo "2. Run the setup wizard: enter your business info, choose a plan, and generate your AI knowledge base.\n";
		echo "3. The SiteStaffr widget appears on your site automatically.\n";
		echo "4. Visitors ask questions via voice or text. SiteStaffr answers using your website content.\n";
		echo "5. After each conversation, you receive an email recap with the visitor's contact info, a full transcript, and suggested follow-up actions.\n\n";
		echo "## What Customers Say\n\n";
		echo "\"We staff medical scribes across multiple clinics, and after hours is when most new facility inquiries come in. ";
		echo "SiteStaffr captured a full intake request at 9 PM on a Sunday, with the clinic name, number of scribes needed, ";
		echo "and start date. Monday morning it was sitting in our inbox, ready to go.\" ";
		echo "— Nathaly Martinez, CEO & Founder, Synergy Scribes\n\n";
		echo "## Frequently Asked Questions\n\n";
		echo "**What is SiteStaffr?** SiteStaffr is an AI receptionist for your website, built as a WordPress plugin for service businesses. ";
		echo "It installs in under five minutes and appears as a chat widget on your website. When a visitor arrives, SiteStaffr greets them, ";
		echo "answers their questions using your website content, and captures their name, phone number, and what they need — all through natural ";
		echo "conversation in over 57 languages. After every interaction, you receive an email recap with a full transcript, the visitor's contact ";
		echo "information, and a suggested follow-up action. SiteStaffr works 24/7 so you never miss a lead while you're on a job site, in a ";
		echo "consultation, or after hours. Plans start at \$29 per month after a free 30-day trial with no credit card required.\n\n";
		echo "**How much does SiteStaffr cost?** SiteStaffr starts with a free 30-day trial including 30 minutes of voice time and ";
		echo "unlimited AI text chat — no credit card required. Paid plans are \$29/month (Starter, 100 voice minutes), \$69/month (Business, 300 voice minutes), ";
		echo "and \$129/month (Pro, 600 voice minutes). Every plan includes unlimited AI text chat — only voice is metered. ";
		echo "Additional voice minutes cost \$20 for 60 minutes and never expire.

";
		echo "**Does SiteStaffr work with my WordPress site?** Yes. SiteStaffr is built specifically for WordPress. ";
		echo "Install the plugin from your WordPress dashboard, configure your business details, and the AI agent appears on your website — no coding required.\n";
		exit;
	}
}, -10 );

