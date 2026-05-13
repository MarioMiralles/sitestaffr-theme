<?php
/*
Template Name: Industry
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$page_slug = get_post_field( 'post_name', get_post() );

$industries = array(

	'dental-practices' => array(
		'hero_icon' => '🦷',
		'label'    => 'For Dental Practices',
		'headline' => 'Your Front Desk Can&rsquo;t Answer Every Call. Your AI&nbsp;Agent&nbsp;Can.',
		'subtitle' => 'SiteStaffr greets patients on your website 24/7 &mdash; answering questions about services, insurance, and availability, capturing new patient inquiries, and sending you a full recap before they even leave the page.',
		'specialty' => 'Dentistry',
		'problems_headline' => 'Dental Practices Lose Patients Before They Ever Sit in the Chair',
		'problems'  => array(
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
				'title' => 'After-hours inquiries vanish',
				'desc'  => 'A potential patient visits your site at 8 PM looking for an emergency appointment or a second opinion. No one answers. They call the next practice on Google.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
				'title' => 'Your front desk is stretched thin',
				'desc'  => 'Between check-ins, insurance questions, and appointment confirmations, your team can&rsquo;t give website visitors the attention they deserve.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M16 16s-1.5-2-4-2-4 2-4 2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>',
				'title' => 'New patients expect instant answers',
				'desc'  => 'Today&rsquo;s patients compare practices online. If your website can&rsquo;t answer basic questions about cleanings, cosmetic options, or insurance acceptance, they move on.',
			),
		),
		'solutions_headline' => 'SiteStaffr Turns Your Website Into Your Best Patient Coordinator',
		'solutions' => array(
			array(
				'title' => 'A visitor asks about your services',
				'desc'  => 'Whether it&rsquo;s teeth whitening, emergency care, or pediatric dentistry, SiteStaffr answers using the information on your website &mdash; accurately and naturally, in 57+ languages.',
			),
			array(
				'title' => 'The AI captures their details',
				'desc'  => 'Name, phone number, reason for calling, insurance questions &mdash; SiteStaffr collects everything a new patient coordinator would, without putting anyone on hold.',
			),
			array(
				'title' => 'You get a complete recap by email',
				'desc'  => 'Within seconds of the conversation ending, a full summary with contact details, what they need, and a suggested follow-up lands in your inbox &mdash; ready to act on Monday morning or right away.',
			),
		),
		'scenario_label' => 'See it in action',
		'scenario_title' => 'Tuesday, 9:14 PM',
		'scenario'       => 'A first-time visitor lands on your website after searching &ldquo;emergency dentist near me.&rdquo; SiteStaffr greets them instantly. They explain they chipped a tooth at dinner and need to be seen tomorrow. The AI confirms your practice handles dental emergencies, asks for their name and phone number, and lets them know someone will follow up first thing in the morning. By 9:16 PM, you have an email with every detail &mdash; name, number, what happened, and urgency level. Your front desk calls them at 8 AM and books the appointment before the patient even considers another practice.',
		'faqs' => array(
			array(
				'q' => 'Does SiteStaffr store patient health information?',
				'a' => 'No. SiteStaffr captures contact details and the reason for the visit &mdash; the same information a front desk would collect on an initial call. It does not collect, store, or transmit protected health information (PHI). All conversation data is stored in your own WordPress database, not on external servers.',
			),
			array(
				'q' => 'Can SiteStaffr answer questions about specific dental procedures?',
				'a' => 'Yes. SiteStaffr learns from the content on your website. If your site describes services like implants, Invisalign, or pediatric dentistry, the AI can speak to those topics naturally. You control what information it has access to.',
			),
			array(
				'q' => 'What if a patient speaks Spanish or another language?',
				'a' => 'SiteStaffr supports 57+ languages automatically. If a visitor speaks Spanish, Mandarin, or Arabic, the AI responds in their language. Your recap always arrives in English with every detail captured.',
			),
			array(
				'q' => 'How long does setup take?',
				'a' => 'Most dental practices are up and running in under five minutes. Install the WordPress plugin, enter your practice details, and the AI agent goes live on your website immediately.',
			),
		),
		'cta_headline' => 'Stop losing patients to silence.',
		'cta_text'     => 'SiteStaffr answers your website visitors 24/7 so your front desk can focus on the patients already in the chair. Try it free for 30 days &mdash; no credit card required.',
	),

	'law-firms' => array(
		'hero_icon' => '⚖️',
		'label'    => 'For Law Firms',
		'headline' => 'Every Missed Inquiry Is a Case That Goes to Another&nbsp;Firm.',
		'subtitle' => 'SiteStaffr captures potential client inquiries on your website around the clock &mdash; qualifying leads, collecting case details, and delivering a full intake recap to your inbox before the prospect moves on.',
		'specialty' => 'LegalService',
		'problems_headline' => 'Law Firms Lose Clients in the First 60 Seconds',
		'problems'  => array(
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>',
				'title' => 'Intake bottlenecks cost you cases',
				'desc'  => 'Potential clients visit your website ready to talk. If they have to fill out a long form or wait until business hours, they contact the next firm instead.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
				'title' => 'After-hours leads disappear',
				'desc'  => 'People search for legal help at night, on weekends, and during emergencies. Your website is open, but nobody&rsquo;s there to respond.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>',
				'title' => 'Speed wins in legal intake',
				'desc'  => 'Studies show the first firm to respond gets the client. If your competitors answer faster &mdash; even with a simple conversation &mdash; they win the case before you know it existed.',
			),
		),
		'solutions_headline' => 'SiteStaffr Works Like a 24/7 Intake Coordinator for Your Firm',
		'solutions' => array(
			array(
				'title' => 'A prospect describes their situation',
				'desc'  => 'Whether it&rsquo;s a personal injury case, family law matter, or business dispute, SiteStaffr engages them naturally and asks the right follow-up questions using your website content.',
			),
			array(
				'title' => 'The AI qualifies and captures details',
				'desc'  => 'Name, contact information, type of legal matter, and urgency &mdash; collected conversationally, the way a skilled intake specialist would handle it.',
			),
			array(
				'title' => 'You receive an intake-ready recap',
				'desc'  => 'A structured email with the prospect&rsquo;s details, case type, a full transcript, and a suggested next step. Your team can follow up within minutes instead of days.',
			),
		),
		'scenario_label' => 'See it in action',
		'scenario_title' => 'Saturday, 11:42 PM',
		'scenario'       => 'A woman involved in a car accident earlier that evening visits your firm&rsquo;s website from her phone. SiteStaffr greets her and asks how it can help. She explains the accident, mentions she has photos of the damage, and asks if your firm handles auto injury cases. The AI confirms your practice areas, collects her name, phone number, and a brief description of what happened. By 11:45 PM, your managing partner has an email with every detail. Monday morning, your intake team calls her &mdash; first. She signs the retainer before noon.',
		'faqs' => array(
			array(
				'q' => 'Does SiteStaffr provide legal advice to visitors?',
				'a' => 'No. SiteStaffr is an intake and information tool, not a legal advisor. It answers questions based on the content published on your website (practice areas, office hours, consultation process) and captures visitor details for your team to follow up on.',
			),
			array(
				'q' => 'Is conversation data confidential?',
				'a' => 'All conversation transcripts and visitor details are stored exclusively in your WordPress database &mdash; on your own hosting infrastructure. SiteStaffr&rsquo;s middleware processes conversations in real time but does not store visitor personal data on external servers.',
			),
			array(
				'q' => 'Can SiteStaffr handle multiple practice areas?',
				'a' => 'Yes. SiteStaffr learns from your entire website. If your firm covers personal injury, family law, criminal defense, and estate planning, the AI can discuss all of them based on what you&rsquo;ve published.',
			),
			array(
				'q' => 'What languages does it support?',
				'a' => 'SiteStaffr supports 57+ languages. If a Spanish-speaking prospect describes their situation in Spanish, the AI responds fluently. Your recap arrives in English with all the details intact.',
			),
		),
		'cta_headline' => 'The next case is visiting your website right now.',
		'cta_text'     => 'SiteStaffr makes sure you never miss another inquiry. Capture leads 24/7, qualify prospects automatically, and respond first. Try it free for 30 days &mdash; no credit card required.',
	),

	'home-services' => array(
		'hero_icon' => '🏠',
		'label'    => 'For Home Services',
		'headline' => 'You&rsquo;re on the Job. Your Website Should Be&nbsp;Too.',
		'subtitle' => 'SiteStaffr answers your website visitors while you&rsquo;re on a roof, under a sink, or in an attic &mdash; capturing every lead with name, number, and job details, 24/7.',
		'specialty' => 'HomeAndConstructionBusiness',
		'problems_headline' => 'Home Service Businesses Lose Leads They Never Even Know About',
		'problems'  => array(
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/><line x1="1" y1="1" x2="23" y2="23"/></svg>',
				'title' => 'Missed calls from the field',
				'desc'  => 'You&rsquo;re knee-deep in a repair when a homeowner visits your website needing emergency service. Your phone is in the truck. By the time you see the missed call, they&rsquo;ve already booked with someone else.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>',
				'title' => 'Seasonal surges overwhelm you',
				'desc'  => 'When the first freeze hits or summer peaks, your phone rings off the hook. You can&rsquo;t answer every website visitor while managing a full schedule of appointments.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>',
				'title' => 'Competitors respond faster',
				'desc'  => 'Homeowners in a bind call the first business that picks up. If your competitor&rsquo;s website answers instantly and yours doesn&rsquo;t, you lose &mdash; even if you&rsquo;re better at the job.',
			),
		),
		'solutions_headline' => 'SiteStaffr Answers While You Work',
		'solutions' => array(
			array(
				'title' => 'A homeowner describes their problem',
				'desc'  => 'Burst pipe, broken AC, roof leak &mdash; visitors tell SiteStaffr what&rsquo;s going on. The AI responds naturally using your website content, confirming your service area and what you offer.',
			),
			array(
				'title' => 'The AI captures every detail',
				'desc'  => 'Name, phone number, address, type of issue, and urgency level &mdash; everything you need to prioritize the job and call them back.',
			),
			array(
				'title' => 'You get the lead instantly by email',
				'desc'  => 'A full recap hits your inbox within seconds: who they are, what&rsquo;s broken, how urgent it is, and a suggested follow-up. Check it between jobs and call them back before anyone else can.',
			),
		),
		'scenario_label' => 'See it in action',
		'scenario_title' => 'Wednesday, 6:48 PM',
		'scenario'       => 'You&rsquo;re finishing a water heater install when a homeowner three miles away discovers their AC stopped working in the middle of July. They find your website and SiteStaffr greets them immediately. They explain the problem &mdash; no cold air, unit is making a clicking sound &mdash; and share their address and phone number. By 6:50 PM, the details are in your inbox. You call them on the drive home, schedule the visit for tomorrow morning, and close a $400 repair before your competitor even checks their voicemail.',
		'faqs' => array(
			array(
				'q' => 'Does SiteStaffr work for multiple service types?',
				'a' => 'Yes. Whether you offer plumbing, HVAC, electrical, roofing, landscaping, or general contracting, SiteStaffr adapts to your website content. If your site describes the services you offer, the AI can discuss them with visitors.',
			),
			array(
				'q' => 'Can it handle after-hours emergencies?',
				'a' => 'Absolutely. SiteStaffr runs 24/7. When a homeowner visits your website at 10 PM with a burst pipe, the AI captures their details and emails you immediately. You decide whether to respond tonight or first thing tomorrow.',
			),
			array(
				'q' => 'Do I need to be tech-savvy to set it up?',
				'a' => 'Not at all. SiteStaffr installs like any WordPress plugin. Search for it in your dashboard, click install, enter your business details, and it&rsquo;s live. The whole process takes less than five minutes.',
			),
			array(
				'q' => 'What if a visitor speaks a different language?',
				'a' => 'SiteStaffr supports 57+ languages. If a homeowner speaks Spanish, the AI responds in Spanish. Your recap always arrives in English.',
			),
		),
		'cta_headline' => 'Every minute your website stays silent, a lead walks away.',
		'cta_text'     => 'SiteStaffr captures leads while you&rsquo;re on the job &mdash; 24/7, in 57+ languages, with full recaps delivered to your inbox. Try it free for 30 days &mdash; no credit card required.',
	),
);

if ( ! isset( $industries[ $page_slug ] ) ) {
	include get_404_template();
	return;
}

$ind       = $industries[ $page_slug ];
$site_name = get_bloginfo( 'name' );
$cta_url   = home_url( '/#get-started' );
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<script type="application/ld+json">
	<?php echo wp_json_encode( array(
		'@context'   => 'https://schema.org',
		'@type'      => 'WebPage',
		'name'       => wp_get_document_title(),
		'url'        => get_permalink(),
		'specialty'  => $ind['specialty'],
		'publisher'  => array(
			'@type' => 'Organization',
			'name'  => 'SiteStaffr',
			'url'   => home_url( '/' ),
		),
		'inLanguage' => 'en-US',
	), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
	</script>

	<?php wp_head(); ?>
</head>
<body <?php body_class( 'sitestaffr-industry-page' ); ?>>
<?php wp_body_open(); ?>

<?php
get_template_part( 'template-parts/site-nav', null, array(
	'menu_items' => array(),
	'cta' => array(
		'label' => 'Get Started',
		'href'  => $cta_url,
	),
) );
?>

<main class="ind-page">

	<!-- Hero -->
	<section class="ind-hero">
		<div class="ind-hero__accent" aria-hidden="true"></div>
		<div class="ind-hero__glow" aria-hidden="true"></div>
		<div class="container">
			<div class="ind-hero__grid">
				<div class="ind-hero__content reveal">
					<span class="ind-hero__label"><?php echo esc_html( $ind['label'] ); ?></span>
					<h1><?php echo wp_kses_post( $ind['headline'] ); ?></h1>
					<p class="ind-hero__subtitle"><?php echo wp_kses_post( $ind['subtitle'] ); ?></p>
					<div class="ind-hero__actions">
						<a href="<?php echo esc_url( $cta_url ); ?>" class="btn btn--primary btn--large">
							Get Started
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
						</a>
					</div>
					<span class="ind-hero__trust">Free for 30 days &bull; No credit card required</span>
				</div>
				<div class="ind-hero__visual reveal reveal-delay-2" aria-hidden="true">
					<div class="ind-hero__icon-wrap">
						<div class="ind-hero__icon-ring"></div>
						<span class="ind-hero__icon"><?php echo $ind['hero_icon']; ?></span>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Pain Points -->
	<section class="ind-problems">
		<div class="container">
			<div class="ind-problems__header reveal">
				<span class="section-label">The problem</span>
				<h2><?php echo wp_kses_post( $ind['problems_headline'] ); ?></h2>
			</div>
			<div class="ind-problems__grid">
				<?php foreach ( $ind['problems'] as $i => $problem ) : ?>
					<div class="ind-problem-card reveal reveal-delay-<?php echo esc_attr( $i + 1 ); ?>">
						<div class="ind-problem-card__icon"><?php echo $problem['icon']; ?></div>
						<h3 class="ind-problem-card__title"><?php echo wp_kses_post( $problem['title'] ); ?></h3>
						<p class="ind-problem-card__desc"><?php echo wp_kses_post( $problem['desc'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- Solutions -->
	<section class="ind-solutions">
		<div class="ind-solutions__bg" aria-hidden="true"></div>
		<div class="container">
			<div class="ind-solutions__header reveal">
				<span class="section-label">How SiteStaffr helps</span>
				<h2><?php echo wp_kses_post( $ind['solutions_headline'] ); ?></h2>
			</div>
			<div class="ind-solutions__steps">
				<?php foreach ( $ind['solutions'] as $i => $step ) : ?>
					<div class="ind-step reveal reveal-delay-<?php echo esc_attr( $i + 1 ); ?>">
						<div class="ind-step__number"><?php echo esc_html( $i + 1 ); ?></div>
						<div class="ind-step__content">
							<h3><?php echo wp_kses_post( $step['title'] ); ?></h3>
							<p><?php echo wp_kses_post( $step['desc'] ); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- Scenario -->
	<section class="ind-scenario">
		<div class="container container--narrow">
			<div class="reveal">
				<span class="section-label"><?php echo esc_html( $ind['scenario_label'] ); ?></span>
				<div class="ind-scenario__card">
					<div class="ind-scenario__time">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
						<span><?php echo esc_html( $ind['scenario_title'] ); ?></span>
					</div>
					<p><?php echo wp_kses_post( $ind['scenario'] ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<!-- FAQ -->
	<section class="ind-faq">
		<div class="container container--narrow">
			<div class="ind-faq__header reveal">
				<h2>Frequently asked questions</h2>
			</div>
			<div class="faq-list">
				<?php foreach ( $ind['faqs'] as $i => $faq ) : ?>
					<div class="faq-item reveal<?php echo $i > 0 ? ' reveal-delay-' . $i : ''; ?>">
						<button class="faq-item__question">
							<?php echo esc_html( $faq['q'] ); ?>
							<span class="faq-item__icon">+</span>
						</button>
						<div class="faq-item__answer">
							<div class="faq-item__answer-inner">
								<?php echo esc_html( $faq['a'] ); ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- CTA -->
	<section class="ind-cta">
		<div class="ind-cta__pattern" aria-hidden="true"></div>
		<div class="container container--narrow">
			<div class="ind-cta__content reveal">
				<h2><?php echo wp_kses_post( $ind['cta_headline'] ); ?></h2>
				<p><?php echo wp_kses_post( $ind['cta_text'] ); ?></p>
				<a href="<?php echo esc_url( $cta_url ); ?>" class="btn ind-cta__btn">
					Get Started
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
				</a>
			</div>
		</div>
	</section>

</main>

<?php get_template_part( 'template-parts/site-footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
