<?php
/*
Template Name: Download
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$zip_path     = get_stylesheet_directory() . '/assets/downloads/sitestaffr.zip';
$zip_url      = sitestaffr_asset_url( 'assets/downloads/sitestaffr.zip' );
$zip_size     = file_exists( $zip_path ) ? round( filesize( $zip_path ) / ( 1024 * 1024 ), 1 ) : '—';
$version      = '1.19.33';
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
				<p class="dl-hero__subtitle">Add an AI voice and text agent to your website in minutes. Download the plugin, run the setup wizard, and start converting visitors into&nbsp;leads.</p>
				<div class="dl-hero__actions">
					<a href="<?php echo esc_url( $zip_url ); ?>" class="btn btn--primary btn--large dl-hero__download" download>
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
						Download Plugin
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
						WordPress 6.2+
					</span>
					<span class="dl-hero__meta-sep" aria-hidden="true"></span>
					<span class="dl-hero__meta-item">
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
						PHP 7.4+
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
					<h3>Download &amp; Install</h3>
					<p>Download the zip file above. In your WordPress admin, go to <strong>Plugins &rarr; Add New &rarr; Upload Plugin</strong>, choose the zip, and click <strong>Install Now</strong>.</p>
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
							Download the latest version from this page and re-upload it through your WordPress admin the same way you installed it. Your settings and data are preserved between updates.
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
			<div class="dl-cta__content reveal">
				<h2>Ready to Get Started?</h2>
				<p>Try SiteStaffr free for 30 days. No credit card, no commitment &mdash; just a better experience for your visitors and more leads in your inbox.</p>
				<div class="dl-cta__actions">
					<a href="<?php echo esc_url( home_url( '/#get-started' ) ); ?>" class="btn dl-cta__btn">Get Started</a>
					<a href="<?php echo esc_url( $zip_url ); ?>" class="btn btn--outline dl-cta__btn-outline" download>Download Plugin</a>
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
	'operatingSystem'     => 'WordPress 6.2+',
	'softwareVersion'     => $version,
	'downloadUrl'         => $zip_url,
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
		'answer'   => 'Download the latest version from this page and re-upload it through your WordPress admin the same way you installed it. Your settings and data are preserved between updates.',
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
