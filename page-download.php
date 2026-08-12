<?php
/*
Template Name: Download
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$plugin       = sitestaffr_plugin_info();
$zip_url      = $plugin['download_url'];
$zip_size     = $plugin['size_mb'];
$version      = $plugin['version'];
$listing_url  = $plugin['listing_url'];
$download_url = home_url( '/download/' );
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'sitestaffr-download-page' ); ?>>
<?php wp_body_open(); ?>

<?php get_template_part( 'template-parts/site-nav' ); ?>

<main class="download-page">

	<section class="dl-hero">
		<div class="dl-hero__glow dl-hero__glow--1" aria-hidden="true"></div>
		<div class="dl-hero__glow dl-hero__glow--2" aria-hidden="true"></div>
		<div class="dl-hero__grid-bg" aria-hidden="true"></div>
		<div class="container container--narrow">
			<div class="reveal">
				<span class="dl-hero__label">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="8 12 12 16 16 12"/><line x1="12" y1="8" x2="12" y2="16"/></svg>
					WordPress Plugin
				</span>
				<h1>Install SiteStaffr on Your WordPress&nbsp;Site</h1>
				<p class="dl-hero__subtitle">The fastest way in is from your own WordPress dashboard &mdash; nothing to download, and the setup wizard starts your free trial when it&nbsp;finishes.</p>

				<!-- The primary action is deliberately NOT a link. Installing happens inside the
				     visitor's own wp-admin, so the honest hero leads with the path rather than a
				     button that navigates away. The zip is the slowest route (extra steps, some
				     hosts disable plugin upload, impossible on mobile) and is demoted to a text
				     link. This inverts the previous hierarchy, which gave the big button to the zip
				     while burying the easy route in step 1's body copy. -->
				<div class="dl-route">
					<p class="dl-route__lead">In your WordPress dashboard</p>
					<!-- Four steps, not five: at five the last pill orphaned onto its own row with a
					     dangling arrow. Merging the final two is also more accurate — WordPress
					     turns the "Install Now" button into "Activate" in place, same screen. -->
					<ol class="dl-route__path">
						<li><span>Plugins</span></li>
						<li><span>Add New</span></li>
						<li><span>Search <strong>SiteStaffr</strong></span></li>
						<li><span>Install &amp; Activate</span></li>
					</ol>
					<p class="dl-route__note">That&rsquo;s it &mdash; the setup wizard opens on its own. Free for 30 days, no credit card.</p>
				</div>

				<div class="dl-hero__actions">
					<a href="<?php echo esc_url( $listing_url ); ?>" class="btn btn--outline btn--large dl-hero__wporg" target="_blank" rel="noopener">
						View on WordPress.org
					</a>
					<a href="<?php echo esc_url( $zip_url ); ?>" class="dl-hero__zip-link" download>
						<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
						Download the .zip instead
					</a>
				</div>
				<div class="dl-hero__meta">
					<span class="dl-hero__meta-item">
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
						v<?php echo esc_html( $version ); ?>
					</span>
					<span class="dl-hero__meta-sep" aria-hidden="true"></span>
					<span class="dl-hero__meta-item">
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><polyline points="13 2 13 9 20 9"/></svg>
						<?php echo esc_html( $zip_size ); ?>&nbsp;MB
					</span>
					<span class="dl-hero__meta-sep" aria-hidden="true"></span>
					<span class="dl-hero__meta-item">
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
						WordPress <?php echo esc_html( $plugin['requires'] ); ?>+
					</span>
					<span class="dl-hero__meta-sep" aria-hidden="true"></span>
					<span class="dl-hero__meta-item">
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
						PHP <?php echo esc_html( $plugin['requires_php'] ); ?>+
					</span>
				</div>
			</div>
		</div>
	</section>

	<section class="dl-steps">
		<div class="dl-steps__accent" aria-hidden="true"></div>
		<div class="container">
			<div class="dl-steps__header reveal">
				<span class="section-label">Three Simple Steps</span>
				<h2 class="dl-steps__heading">From Download to Live in&nbsp;Minutes</h2>
			</div>
			<div class="dl-steps__grid">

				<div class="dl-steps__card reveal">
					<div class="dl-steps__card-glow" aria-hidden="true"></div>
					<div class="dl-steps__icon-wrap">
						<svg class="dl-steps__icon" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
							<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
							<polyline points="7 10 12 15 17 10"/>
							<line x1="12" y1="15" x2="12" y2="3"/>
						</svg>
						<span class="dl-steps__number">1</span>
					</div>
					<h3>Install the Plugin</h3>
					<p>Search for <strong>SiteStaffr</strong> under <strong>Plugins &rarr; Add New</strong> in your WordPress dashboard, then click <strong>Install Now</strong> and <strong>Activate</strong>. Installing manually instead? Upload the zip via <strong>Plugins &rarr; Add New &rarr; Upload Plugin</strong>.</p>
					<div class="dl-steps__card-accent" aria-hidden="true"></div>
				</div>

				<div class="dl-steps__connector" aria-hidden="true">
					<svg width="40" height="24" viewBox="0 0 40 24" fill="none">
						<path d="M0 12h28m0 0l-6-6m6 6l-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</div>

				<div class="dl-steps__card reveal">
					<div class="dl-steps__card-glow" aria-hidden="true"></div>
					<div class="dl-steps__icon-wrap">
						<svg class="dl-steps__icon" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
							<path d="M12 20h9"/>
							<path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
						</svg>
						<span class="dl-steps__number">2</span>
					</div>
					<h3>Run the Setup Wizard</h3>
					<p>After activating, you&rsquo;ll be guided through a 3-step wizard: enter your business info, choose a plan (free 30-day trial available, no credit card required), set your hours, and generate your AI knowledge base.</p>
					<div class="dl-steps__card-accent" aria-hidden="true"></div>
				</div>

				<div class="dl-steps__connector" aria-hidden="true">
					<svg width="40" height="24" viewBox="0 0 40 24" fill="none">
						<path d="M0 12h28m0 0l-6-6m6 6l-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</div>

				<div class="dl-steps__card reveal">
					<div class="dl-steps__card-glow" aria-hidden="true"></div>
					<div class="dl-steps__icon-wrap">
						<svg class="dl-steps__icon" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
							<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
							<polyline points="22 4 12 14.01 9 11.01"/>
						</svg>
						<span class="dl-steps__number">3</span>
					</div>
					<h3>You&rsquo;re Live</h3>
					<p>The voice and text agent widget appears on your site automatically. Visitors can start a conversation, and you&rsquo;ll get email recaps and full transcripts in your WordPress dashboard.</p>
					<div class="dl-steps__card-accent" aria-hidden="true"></div>
				</div>

			</div>
		</div>
	</section>

	<section class="dl-faq">
		<div class="container container--narrow">
			<div class="dl-faq__header reveal">
				<span class="section-label">Common Questions</span>
				<h2 class="dl-faq__heading">Frequently Asked Questions</h2>
			</div>
			<div class="dl-faq__list">

				<div class="dl-faq__item reveal">
					<button class="dl-faq__question" type="button" aria-expanded="false">
						<span>What Does SiteStaffr Do?</span>
						<span class="dl-faq__icon" aria-hidden="true"></span>
					</button>
					<div class="dl-faq__answer">
						<div class="dl-faq__answer-inner">
							SiteStaffr is an AI voice and text agent that greets your website visitors, answers their questions using your own content, captures their contact info, and emails you a full recap after every conversation &mdash; 24/7, in over 57 languages.
						</div>
					</div>
				</div>

				<div class="dl-faq__item reveal">
					<button class="dl-faq__question" type="button" aria-expanded="false">
						<span>Do I Need to Create an Account Separately?</span>
						<span class="dl-faq__icon" aria-hidden="true"></span>
					</button>
					<div class="dl-faq__answer">
						<div class="dl-faq__answer-inner">
							No. The setup wizard handles everything &mdash; your business info, plan selection, and configuration all happen right inside your WordPress admin. There&rsquo;s nothing to sign up for externally.
						</div>
					</div>
				</div>

				<div class="dl-faq__item reveal">
					<button class="dl-faq__question" type="button" aria-expanded="false">
						<span>Is There a Free Trial?</span>
						<span class="dl-faq__icon" aria-hidden="true"></span>
					</button>
					<div class="dl-faq__answer">
						<div class="dl-faq__answer-inner">
							Yes. You get 30 days with 30 minutes of call time, no credit card required. Just activate the plugin, run the wizard, and choose the free trial option.
						</div>
					</div>
				</div>

				<div class="dl-faq__item reveal">
					<button class="dl-faq__question" type="button" aria-expanded="false">
						<span>How Do I Update the Plugin?</span>
						<span class="dl-faq__icon" aria-hidden="true"></span>
					</button>
					<div class="dl-faq__answer">
						<div class="dl-faq__answer-inner">
							If you installed from the WordPress.org directory, updates appear automatically in your dashboard under <strong>Plugins</strong> &mdash; just click <strong>Update Now</strong>. If you installed manually, download the latest version from this page and re-upload it the same way. Either way, your settings and data are preserved between updates.
						</div>
					</div>
				</div>

				<div class="dl-faq__item reveal">
					<button class="dl-faq__question" type="button" aria-expanded="false">
						<span>What Can I Do After Setup?</span>
						<span class="dl-faq__icon" aria-hidden="true"></span>
					</button>
					<div class="dl-faq__answer">
						<div class="dl-faq__answer-inner">
							Manage your AI agent&rsquo;s knowledge base, review call transcripts, adjust business hours, and handle billing &mdash; all from your WordPress dashboard. You can also manage your subscription anytime at <a href="<?php echo esc_url( home_url( '/manage/' ) ); ?>">sitestaffr.com/manage</a>.
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

	<section class="dl-cta">
		<div class="dl-cta__pattern" aria-hidden="true"></div>
		<div class="dl-cta__glow" aria-hidden="true"></div>
		<div class="container container--narrow">
			<div class="dl-cta__content cta-spotlight reveal">
				<h2>Ready to Get Started?</h2>
				<p>Try SiteStaffr free for 30 days. No credit card, no commitment &mdash; just a better experience for your visitors and more leads in your inbox.</p>
				<div class="dl-cta__actions">
					<a href="<?php echo esc_url( $listing_url ); ?>" class="btn dl-cta__btn" target="_blank" rel="noopener">Install from WordPress.org</a>
					<a href="<?php echo esc_url( home_url( '/#get-started' ) ); ?>" class="btn btn--outline dl-cta__btn-outline">Prefer we set it up for you?</a>
				</div>
			</div>
		</div>
	</section>

</main>

<?php get_template_part( 'template-parts/site-footer' ); ?>

<script>
(function() {
  document.querySelectorAll('.dl-faq__question').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var item = btn.closest('.dl-faq__item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.dl-faq__item.open').forEach(function(el) {
        el.classList.remove('open');
        el.querySelector('.dl-faq__question').setAttribute('aria-expanded', 'false');
      });
      if (!isOpen) {
        item.classList.add('open');
        btn.setAttribute('aria-expanded', 'true');
      }
    });
  });
})();
</script>

<?php wp_footer(); ?>

<script type="application/ld+json">
<?php echo wp_json_encode( array(
	'@context'            => 'https://schema.org',
	'@type'               => 'SoftwareApplication',
	'@id'                 => home_url( '/' ) . '#software',
	'name'                => 'SiteStaffr',
	'description'         => 'AI voice and text agent plugin for WordPress. Greets visitors, answers questions, captures leads, and sends email recaps — 24/7.',
	'applicationCategory' => 'BusinessApplication',
	'operatingSystem'     => 'WordPress ' . $plugin['requires'] . '+',
	'softwareVersion'     => $version,
	'downloadUrl'         => $zip_url,
	'installUrl'          => $listing_url,
	'sameAs'              => $listing_url,
	'fileSize'            => $zip_size . ' MB',
	'offers'              => array(
		'@type'         => 'Offer',
		'price'         => '0',
		'priceCurrency' => 'USD',
		'description'   => '30-day free trial, no credit card required',
	),
	'publisher'           => array(
		'@id' => home_url( '/' ) . '#organization',
	),
), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
</script>

<script type="application/ld+json">
<?php
$faq_items = array(
	array(
		'question' => 'What does SiteStaffr do?',
		'answer'   => 'SiteStaffr is an AI voice and text agent that greets your website visitors, answers their questions using your own content, captures their contact info, and emails you a full recap after every conversation — 24/7, in over 57 languages.',
	),
	array(
		'question' => 'Do I need to create an account separately?',
		'answer'   => 'No. The setup wizard handles everything — your business info, plan selection, and configuration all happen right inside your WordPress admin. There\'s nothing to sign up for externally.',
	),
	array(
		'question' => 'Is there a free trial?',
		'answer'   => 'Yes. You get 30 days with 30 minutes of call time, no credit card required. Just activate the plugin, run the wizard, and choose the free trial option.',
	),
	array(
		'question' => 'How do I update the plugin?',
		'answer'   => 'If you installed from the WordPress.org directory, updates appear automatically in your dashboard under Plugins — just click Update Now. If you installed manually, download the latest version from this page and re-upload it the same way. Either way, your settings and data are preserved between updates.',
	),
	array(
		'question' => 'What can I do after setup?',
		'answer'   => 'Manage your AI agent\'s knowledge base, review call transcripts, adjust business hours, and handle billing — all from your WordPress dashboard. You can also manage your subscription anytime at sitestaffr.com/manage.',
	),
);

$faq_schema = array(
	'@context'   => 'https://schema.org',
	'@type'      => 'FAQPage',
	'mainEntity' => array(),
);

foreach ( $faq_items as $faq ) {
	$faq_schema['mainEntity'][] = array(
		'@type'          => 'Question',
		'name'           => $faq['question'],
		'acceptedAnswer' => array(
			'@type' => 'Answer',
			'text'  => $faq['answer'],
		),
	);
}

echo wp_json_encode( $faq_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
?>
</script>
</body>
</html>
