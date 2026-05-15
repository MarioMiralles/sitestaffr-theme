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
		<div class="container container--narrow">
			<div class="reveal">
				<span class="dl-hero__label">WordPress Plugin</span>
				<h1>Install SiteStaffr on Your WordPress&nbsp;Site</h1>
				<p>Add an AI voice and text agent to your website in minutes. Download the plugin, run the setup wizard, and start converting visitors into&nbsp;leads.</p>
				<div class="dl-hero__actions">
					<a href="<?php echo esc_url( $zip_url ); ?>" class="btn btn--primary btn--large dl-hero__download" download>
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
						Download Plugin
					</a>
				</div>
				<p class="dl-hero__meta">v<?php echo esc_html( $version ); ?> &middot; <?php echo esc_html( $zip_size ); ?>&nbsp;MB &middot; WordPress 6.2+ &middot; PHP 7.4+</p>
			</div>
		</div>
	</section>

	<section class="dl-steps">
		<div class="container">
			<h2 class="dl-steps__heading reveal">How It Works</h2>
			<div class="dl-steps__grid">
				<div class="dl-steps__card reveal">
					<span class="dl-steps__number">1</span>
					<h3>Download &amp; Install</h3>
					<p>Download the zip file above. In your WordPress admin, go to <strong>Plugins &rarr; Add New &rarr; Upload Plugin</strong>, choose the zip, and click <strong>Install Now</strong>.</p>
				</div>
				<div class="dl-steps__card reveal">
					<span class="dl-steps__number">2</span>
					<h3>Run the Setup Wizard</h3>
					<p>After activating, you&rsquo;ll be guided through a 3-step wizard: enter your business info, choose a plan (free 30-day trial available, no credit card required), set your hours, and generate your AI knowledge base.</p>
				</div>
				<div class="dl-steps__card reveal">
					<span class="dl-steps__number">3</span>
					<h3>You&rsquo;re Live</h3>
					<p>The voice and text agent widget appears on your site automatically. Visitors can start a conversation, and you&rsquo;ll get email recaps and full transcripts in your WordPress dashboard.</p>
				</div>
			</div>
		</div>
	</section>

	<section class="dl-faq">
		<div class="container container--narrow">
			<h2 class="dl-faq__heading reveal">Frequently Asked Questions</h2>

			<div class="dl-faq__item reveal">
				<h3>What Does SiteStaffr Do?</h3>
				<p>SiteStaffr is an AI voice and text agent that greets your website visitors, answers their questions using your own content, captures their contact info, and emails you a full recap after every conversation &mdash; 24/7, in over 57 languages.</p>
			</div>

			<div class="dl-faq__item reveal">
				<h3>Do I Need to Create an Account Separately?</h3>
				<p>No. The setup wizard handles everything &mdash; your business info, plan selection, and configuration all happen right inside your WordPress admin. There&rsquo;s nothing to sign up for externally.</p>
			</div>

			<div class="dl-faq__item reveal">
				<h3>Is There a Free Trial?</h3>
				<p>Yes. You get 30 days with 30 minutes of call time, no credit card required. Just activate the plugin, run the wizard, and choose the free trial option.</p>
			</div>

			<div class="dl-faq__item reveal">
				<h3>How Do I Update the Plugin?</h3>
				<p>Download the latest version from this page and re-upload it through your WordPress admin the same way you installed it. Your settings and data are preserved between updates.</p>
			</div>

			<div class="dl-faq__item reveal">
				<h3>What Can I Do After Setup?</h3>
				<p>Manage your AI agent&rsquo;s knowledge base, review call transcripts, adjust business hours, and handle billing &mdash; all from your WordPress dashboard. You can also manage your subscription anytime at <a href="<?php echo esc_url( home_url( '/manage/' ) ); ?>">sitestaffr.com/manage</a>.</p>
			</div>
		</div>
	</section>

	<section class="dl-cta">
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

<script type="application/ld+json">
<?php echo wp_json_encode( array(
	'@context'            => 'https://schema.org',
	'@type'               => 'SoftwareApplication',
	'name'                => 'SiteStaffr',
	'description'         => 'AI voice and text agent plugin for WordPress. Greets visitors, answers questions, captures leads, and sends email recaps — 24/7.',
	'applicationCategory' => 'BusinessApplication',
	'operatingSystem'     => 'WordPress 6.2+',
	'softwareVersion'     => $version,
	'downloadUrl'         => $zip_url,
	'fileSize'            => $zip_size . ' MB',
	'offers'              => array(
		'@type'       => 'Offer',
		'price'       => '0',
		'priceCurrency' => 'USD',
		'description' => '30-day free trial, no credit card required',
	),
	'publisher'           => array(
		'@type' => 'Organization',
		'name'  => 'SiteStaffr',
		'url'   => home_url( '/' ),
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

<?php wp_footer(); ?>
</body>
</html>
