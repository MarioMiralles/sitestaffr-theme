<?php
/*
Template Name: About
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$site_name = get_bloginfo( 'name' );
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'sitestaffr-about-page' ); ?>>
<?php wp_body_open(); ?>

<?php
get_template_part( 'template-parts/site-nav' );
?>

<main class="about-page">

	<section class="about-hero">
		<div class="container container--narrow">
			<div class="reveal">
				<span class="about-hero__label">About SiteStaffr</span>
				<h1>Every Visitor Deserves a Real Conversation. Every Business Deserves to Be There for It.</h1>
				<p>SiteStaffr is an AI voice and text agent that bridges the gap between businesses and the people they serve &mdash; answering questions, capturing leads, and making sure no visitor leaves empty-handed, 24/7, in over 57 languages.</p>
			</div>
		</div>
	</section>

	<div class="about-tilt about-tilt--1" aria-hidden="true"></div>

	<section class="about-founder">
		<div class="container">
			<div class="about-founder__card reveal">
				<div class="about-founder__portrait-wrap">
					<blockquote class="about-founder__quote">
						<p>&ldquo;The way you make someone feel matters just as much as the information you give them.&rdquo;</p>
						<cite class="about-founder__cite">
							<span class="about-founder__cite-name">Mario Miralles</span>
							<span class="about-founder__cite-title">Founder, SiteStaffr</span>
						</cite>
					</blockquote>
					<div class="about-founder__portrait-frame">
						<img
							src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/mario-headshot.webp' ) ); ?>"
							alt="Mario Miralles, founder of SiteStaffr"
							width="300"
							height="300"
							loading="lazy"
						>
					</div>
					<div class="about-founder__portrait-shadow" aria-hidden="true"></div>
				</div>
				<div class="about-founder__text">
					<h2>Built by Someone Who&rsquo;s Been on Both Sides of the Conversation</h2>
					<p>SiteStaffr was founded in 2025 by Mario Miralles, a South Florida-based engineer with over 18 years of experience in customer-facing roles across retail, transportation, fintech, mortgage lending, and more. That time on the front lines taught him something that most technology overlooks: the way you make someone feel matters just as much as the information you give them.</p>
					<p>After earning a Software Engineering diploma from BrainStation, Mario pivoted into full-stack development &mdash; building over 100 websites across 34 industries. The pattern he kept seeing was the same one he&rsquo;d lived: businesses pouring effort into their websites, but still losing visitors who couldn&rsquo;t find what they needed fast enough. SiteStaffr is his answer to that problem &mdash; an AI agent with the warmth and attentiveness of a great front-desk hire, available around the clock.</p>
				</div>
				<div class="about-founder__logos">
					<span class="about-founder__logos-label">Where I&rsquo;ve worked</span>
					<div class="about-founder__logos-strip">
						<img src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/logos/logo-target.webp' ) ); ?>" alt="Target" loading="lazy">
						<img src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/logos/logo-coinbase.webp' ) ); ?>" alt="Coinbase" loading="lazy">
						<img src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/logos/logo-penske.webp' ) ); ?>" alt="Penske" loading="lazy">
						<img src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/logos/logo-rocketmortgage.webp' ) ); ?>" alt="Rocket Mortgage" loading="lazy">
						<img src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/logos/logo-brainstation.webp' ) ); ?>" alt="BrainStation" loading="lazy">
						<img src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/logos/logo-circuitcity.webp' ) ); ?>" alt="Circuit City" loading="lazy">
						<img src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/logos/logo-flooranddecor.webp' ) ); ?>" alt="Floor &amp; Decor" loading="lazy">
						<img src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/logos/logo-omgnational.webp' ) ); ?>" alt="OMG National" loading="lazy">
						<img src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/logos/logo-roadie.webp' ) ); ?>" alt="Roadie" loading="lazy">
						<img src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/logos/logo-sportsauthority.webp' ) ); ?>" alt="Sports Authority" loading="lazy">
						<img src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/logos/logo-ymca.webp' ) ); ?>" alt="YMCA" loading="lazy">
					</div>
				</div>
			</div>
		</div>
	</section>

	<div class="about-tilt about-tilt--2" aria-hidden="true"></div>

	<section class="about-gap">
		<div class="container container--narrow">
			<div class="reveal">
				<span class="section-label">Why SiteStaffr Exists</span>
				<h2>The Gap SiteStaffr Fills</h2>
				<p>Running a business is already stressful enough. Between staffing, scheduling, and keeping operations moving, the last thing an owner needs is another thing to worry about &mdash; like whether their website is actually working for them or against them.</p>
				<p>On the other side, visitors are navigating cluttered layouts, buried contact pages, and FAQ sections that never answer the right question. Their time matters too. When someone lands on your site ready to do business and can&rsquo;t get a straight answer, everyone loses.</p>
				<p>SiteStaffr sits in that gap. It greets visitors the moment they arrive, answers their questions using your own content, captures their information, and sends you a full recap &mdash; automatically.</p>
			</div>
		</div>
	</section>

	<section class="about-cta">
		<div class="container container--narrow">
			<div class="about-cta__content reveal">
				<h2>See What SiteStaffr Can Do for Your Business</h2>
				<p>SiteStaffr is built for service businesses that can&rsquo;t afford to miss a lead &mdash; or make a visitor wait. Try it free for 30 days, no credit card required.</p>
				<div class="about-cta__actions">
					<a href="<?php echo esc_url( home_url( '/#get-started' ) ); ?>" class="btn about-cta__btn">Get Started</a>
					<a href="<?php echo esc_url( home_url( '/download/' ) ); ?>" class="btn btn--outline about-cta__btn-outline">Download Plugin</a>
				</div>
			</div>
		</div>
	</section>

</main>

<?php get_template_part( 'template-parts/site-footer' ); ?>

<script type="application/ld+json">
<?php echo wp_json_encode( array(
	'@context'   => 'https://schema.org',
	'@type'      => 'Person',
	'name'       => 'Mario Miralles',
	'jobTitle'   => 'Founder',
	'url'        => home_url( '/about/' ),
	'worksFor'   => array(
		'@id' => home_url( '/' ) . '#organization',
	),
	'knowsAbout' => array( 'WordPress', 'AI Voice Agents', 'Web Development', 'Customer Service' ),
	'alumniOf'   => array(
		'@type' => 'EducationalOrganization',
		'name'  => 'BrainStation',
	),
), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
</script>

<?php wp_footer(); ?>
</body>
</html>
