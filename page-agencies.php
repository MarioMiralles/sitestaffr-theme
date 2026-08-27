<?php
/*
Template Name: Agencies
*/

/**
 * /for/agencies/ — the second audience.
 *
 * SiteStaffr has two audiences: small businesses and the WordPress agencies that build
 * their sites. Until 2026-08-26 the site addressed one — there were zero occurrences of
 * "agency" anywhere in the theme.
 *
 * The decision (Mario, 2026-08-26) was deliberately NOT to blend both audiences into one
 * page. The homepage stays written to the business owner, which is what user testing
 * rewarded; agencies get a nav item, one band at homepage section 10, and this page,
 * where the whole argument is theirs.
 *
 * ⚠️ ITS OWN TEMPLATE, NOT page-industry.php. Agencies are an AUDIENCE, not an industry.
 * They are not in sitestaffr_industry_registry() and must not be added to it — that would
 * place them in homepage section 6's list of sixteen businesses, alongside dental
 * practices and salons, which is the wrong shelf. They are also not in the Industries
 * dropdown; "Agencies" is a top-level nav item.
 *
 * TONE DIFFERS FROM THE HOMEPAGE ON PURPOSE. Agencies are technical and allergic to
 * marketing language: shorter sentences, more specifics, numbers over adjectives, no
 * softening. Where the homepage says "while you're on a job", this page says "one plugin,
 * one connect step, about five minutes."
 *
 * ⚠️ EVERY CLAIM ON THIS PAGE WAS VERIFIED AGAINST THE CODE ON 2026-08-26, and the FALSE
 * ones are named as false rather than omitted. See section 6 and the FAQ: there is no
 * reseller pricing, no white-label, no bulk billing, and no cross-client lead view. This
 * is the audience that checks, and a page that implied any of them would be disqualifying.
 *
 * Yoast owns title and meta, as everywhere else on this site. No hardcoded meta here.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Its own FAQPage schema, and ⚠️ NOT ONE QUESTION IS SHARED WITH THE HOMEPAGE. Duplicate
   Q&A across two URLs makes the two URLs compete with each other, and Google requires
   schema to match visible content — which the generate-from-one-array pattern satisfies.

   Questions 4, 5 and 6 have "no" answers and they STAY. They are what this audience
   searches for. A truthful "not yet, here is what exists, tell us what you need" ranks and
   converts better than silence, and it prevents the bounce that follows a page which
   dodged the question. */
$agency_faq = array(
	array(
		'question' => 'Can I install SiteStaffr on client sites I manage?',
		'answer'   => 'Yes. SiteStaffr installs on any self-hosted WordPress site you have admin access to, and there is no limit on how many sites you set it up on. Each site runs its own plan and its own agent, configured from that site\'s WordPress dashboard.',
	),
	array(
		'question' => 'Who owns the subscription, me or my client?',
		'answer'   => 'Either. You can put the subscription on your own card and bill it through as part of a retainer, or hand billing access to the client so it sits on theirs. SiteStaffr does not require the site owner and the bill payer to be the same person.',
	),
	array(
		'question' => 'Can I transfer billing to a client later?',
		'answer'   => 'Yes. Team billing access means billing can move to the client without moving the site or reinstalling anything. The agent, its configuration and its history stay exactly where they are.',
	),
	array(
		'question' => 'Do you have agency or reseller pricing?',
		'answer'   => 'Not yet. Every site is on the same $29, $69 or $129 plans as everyone else, with no reseller tier and no volume discount. If agency pricing would change your decision, tell us what you would need — we are deciding what to build, and this is how that gets decided.',
	),
	array(
		'question' => 'Is there a white-label option?',
		'answer'   => 'No. The widget carries SiteStaffr branding and there is currently no way to remove or replace it. If white-label matters to you, tell us — it is on the list of things we are weighing, and demand from agencies is what moves it.',
	),
	array(
		'question' => 'Can I see leads across all my client sites in one place?',
		'answer'   => 'Not today. Billing is centralised — one login at /manage/ covers plans, minutes and team access across every site you have billing access to — but leads are not. The Follow-ups queue, transcripts and Agent Health live in each client\'s own WordPress. Recaps are emailed per conversation, so you can forward or filter them.',
	),
	array(
		'question' => 'How long does it take to set up on a new site?',
		'answer'   => 'The install is about five minutes: add the plugin, connect the site, add the widget shortcode to a page. Filling in the business profile properly takes longer and is the part worth charging for — SiteStaffr indexes the client\'s published pages automatically, but what it should say about them is a decision, not a default.',
	),
	array(
		'question' => 'Does it slow down a client\'s site?',
		'answer'   => 'No. The widget loads after page content and runs from SiteStaffr servers rather than the client\'s hosting, so pages render at the same speed. The AI work happens off-site entirely, which means no extra load no matter how many visitors are chatting.',
	),
	array(
		'question' => 'What happens to my client\'s visitor data?',
		'answer'   => 'Conversation details are used to answer the visitor and build the recap emailed to the site owner. SiteStaffr does not sell visitor data or use it to advertise. Captured contact details belong to the site owner, which is your client, not us and not you.',
	),
	array(
		'question' => 'Can I try it on my own site first?',
		'answer'   => 'Yes, and it is the sensible order. The free 30-day trial takes no credit card, so you can run it on your own agency site, see what the recaps look like, and decide whether it belongs in your stack before you put it in front of a client.',
	),
);

$agency_faq_schema = array();
foreach ( $agency_faq as $q ) {
	$agency_faq_schema[] = array(
		'@type'          => 'Question',
		'name'           => $q['question'],
		'acceptedAnswer' => array(
			'@type' => 'Answer',
			'text'  => $q['answer'],
		),
	);
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="preload" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/fonts/fraunces-variable.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/fonts/dm-sans-variable.woff2" as="font" type="font/woff2" crossorigin>

	<script type="application/ld+json">
	<?php echo wp_json_encode( array(
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => $agency_faq_schema,
	), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
	</script>

	<?php wp_head(); ?>
</head>
<body <?php body_class( 'sitestaffr-agencies-page' ); ?>>
<?php wp_body_open(); ?>

<?php get_template_part( 'template-parts/site-nav' ); ?>

<main>

<?php /* ===== 1. HERO =====================================================
         SAME H1 AS THE HOMEPAGE BAND, ON PURPOSE. Landing on a page whose headline
         matches the link you just clicked is what confirms you are in the right place;
         novelty here would read as a different offer. The subhead carries the new
         information. */ ?>
<section class="block block-split agency-hero">
	<div class="block__inner">
		<div class="block-split__grid">
			<div>
				<span class="agency-door__eyebrow">For WordPress Agencies</span>
				<h1>Give Every Client Site a Receptionist</h1>
				<p class="agency-hero__lead">
					One plugin makes a client&rsquo;s site answer its visitors by text or voice, capture their name and number, and email the lead straight to them. About five minutes per site, no code, and nothing for you to host or maintain.
				</p>
				<div class="agency-hero__actions">
					<a href="<?php echo esc_url( home_url( '/download/' ) ); ?>" class="btn btn--primary js-cta" data-cta="trial">
						Start Free Trial <span aria-hidden="true">&rarr;</span>
					</a>
					<a href="#partner" class="agency-hero__secondary">Talk to us about agencies</a>
				</div>
				<p class="agency-hero__note">Free for 30 days on any site &middot; No credit card required</p>
			</div>

			<?php /* ⚠️ NO NEW RENDER AND NO ROBOT. The robot's three appearances belong to
			         the homepage. This is a grid of browser-window cards built in HTML,
			         reusing the browser-and-speech-bubble motif that already ties the
			         sixteen industry isometrics together. */ ?>
			<div class="block-split__art agency-hero__art" aria-hidden="true">
				<div class="agency-sites">
					<?php foreach ( array( 'northgate-dental.com', 'ridgelineauto.com', 'copperleafpest.com', 'maggiescakes.com' ) as $site ) : ?>
						<div class="agency-site">
							<div class="agency-site__chrome"><span></span><span></span><span></span></div>
							<div class="agency-site__url"><?php echo esc_html( $site ); ?></div>
							<div class="agency-site__bubble">Hi! How can I help?</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php /* ===== 2. WHY IT IS WORTH ADDING ====================================
         The agency's real question is "what does this do for ME", not "what does it do". */ ?>
<section class="block block--tight block-cards agency-why">
	<div class="block__inner">
		<div class="agency-section__head">
			<h2>Why It&rsquo;s Worth Adding to a Client Site</h2>
		</div>
		<div class="block-cards__grid" style="--cards: 3;">
			<div class="agency-card">
				<h3>Their site starts producing leads it was losing</h3>
				<p>Most visitors who leave without filling in a form leave no trace at all. This is the difference between a site that looks good and a site that produces.</p>
			</div>
			<div class="agency-card">
				<h3>It&rsquo;s a service you can charge for</h3>
				<p>Setup, configuration and the business profile are billable work. The subscription is the client&rsquo;s, or yours to mark up as part of a retainer.</p>
			</div>
			<div class="agency-card">
				<h3>Renewal conversations get easier</h3>
				<p>Named leads with full transcripts, arriving in the client&rsquo;s inbox with your fingerprints on the site that produced them. That&rsquo;s the hardest number in agency work and it arrives on its own.</p>
			</div>
		</div>
	</div>
</section>

<?php /* ===== 3. WHAT IT TAKES PER SITE ====================================
         Dark panel — the mid-page emphasis. This is the concrete answer to "how much of
         my time does this cost", which is the question that actually decides adoption.

         ⚠️ DO NOT CLAIM ZERO CONFIGURATION. The business profile is real work, and an
         agency that expects five minutes and finds thirty will say so publicly. Five
         minutes is the INSTALL; configuration is the billable part, and section 2 already
         framed it that way. Consistency between those two sections is what makes this
         page trustworthy to a technical reader. */ ?>
<section class="block block--dark block--tight agency-steps">
	<div class="block__inner">
		<div class="agency-section__head">
			<h2>What It Takes Per Site</h2>
			<p class="agency-steps__lead">One plugin, one connect step, about five minutes. Then the part worth charging for.</p>
		</div>
		<ol class="agency-steps__list">
			<li>
				<span class="agency-steps__n">1</span>
				<strong>Install the plugin</strong>
				From WordPress.org, like any other plugin.
			</li>
			<li>
				<span class="agency-steps__n">2</span>
				<strong>Connect the site</strong>
				One step in wp-admin. No keys to manage, nothing to host.
			</li>
			<li>
				<span class="agency-steps__n">3</span>
				<strong>Point it at the business</strong>
				It indexes the client&rsquo;s published pages automatically and re-reads new and changed pages daily. The setup wizard covers the rest.
			</li>
		</ol>
		<p class="agency-steps__then">Then: add the widget shortcode to a page and test a conversation.</p>
	</div>
</section>

<?php /* ===== 4. WHO PAYS, AND HOW BILLING WORKS ===========================
         THIS IS THE AGENCY QUESTION and no page on the site answered it.

         ⚠️ SCOPE EVERY "ONE PLACE" PHRASE TO BILLING. The lead dashboard is per-site,
         inside each client's own wp-admin. If this page implies a cross-client inbox, the
         first agency to sign up finds out in ten minutes. */ ?>
<section class="block block--tight block-cards agency-billing">
	<div class="block__inner">
		<div class="agency-section__head">
			<h2>Who Pays, and How Billing Works</h2>
		</div>
		<div class="block-cards__grid" style="--cards: 3;">
			<div class="agency-card">
				<h3>Each site has its own plan</h3>
				<p>$29, $69 or $129 a month per site, on the same tiers as everyone else. Unlimited AI text chat on every plan; only voice minutes differ.</p>
			</div>
			<div class="agency-card">
				<h3>One login, every client&rsquo;s billing</h3>
				<p>Sign in once at <a href="<?php echo esc_url( home_url( '/manage/' ) ); ?>">/manage/</a> and switch between every site you have billing access to &mdash; plan status, add-on minutes and team billing access, per site.</p>
			</div>
			<div class="agency-card">
				<h3>Either of you can hold it</h3>
				<p>Put the subscription on your card and bill it through, or hand billing access to the client. Team billing access means it can move later without moving the site.</p>
			</div>
		</div>
	</div>
</section>

<?php /* ===== 5. WHAT YOU CAN SHOW AT RENEWAL ==============================
         Reuses the homepage's recap surface, framed for a different reader. On the
         homepage it is "what lands in YOUR inbox"; here it is "what you put in front of
         your client".

         ⚠️ A STATIC RECAP IS CORRECT HERE. The homepage's live-fill is not needed and
         would be the wrong argument: there the point is the MECHANISM (you hear him say
         the number and the number appears), here the point is the ARTIFACT. */ ?>
<section class="block block--tight agency-renewal">
	<div class="block__inner">
		<div class="agency-section__head">
			<h2>What You Can Show at Renewal</h2>
			<p class="agency-renewal__lead">This is what your client sees, on a site you built.</p>
		</div>
		<div class="see-it__panel see-it__panel--recap agency-renewal__recap">
			<div class="see-it__recap-head">
				<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 7 10 6 10-6"/></svg>
				Conversation Recap
			</div>
			<dl class="see-it__fields">
				<div class="see-it__field"><dt>Reason for visit</dt><dd>Two-tier birthday cake, 25 guests</dd></div>
				<div class="see-it__field"><dt>Name</dt><dd>Sarah Mitchell</dd></div>
				<div class="see-it__field"><dt>Phone</dt><dd>555-0168</dd></div>
			</dl>
			<div class="see-it__gen">
				<span class="see-it__gen-label">Summary</span>
				<p>Wants a two-tier cake for 25 on April 12. Asked about gluten-free options.</p>
			</div>
			<div class="see-it__gen">
				<span class="see-it__gen-label">Suggested follow-up</span>
				<p>Call Sarah to confirm the date and quote.</p>
			</div>
			<p class="see-it__toast">&#10003; Recap emailed to you</p>
		</div>
	</div>
</section>

<?php /* ===== 6. PRICING, AND THE PARTNER QUESTION =========================
         The homepage's own table would be reused verbatim here in a later pass; for now
         one line scopes it and links to it, because duplicating a 300-line table across
         two templates is how they drift apart.

         THE PART MOST VENDORS WOULD HIDE IS THE POINT OF THE SECTION. Three reasons, in
         order of value: it IS the demand-validation mechanism, so if this form generates
         volume that is the signal to build reseller pricing; a technical audience looks
         for a partner program within thirty seconds, and finding a page that IMPLIED one
         is disqualifying; and it converts a gap into an invitation. */ ?>
<section class="block block--tight agency-pricing" id="partner">
	<div class="block__inner">
		<div class="agency-section__head">
			<h2>Pricing, and the Partner Question</h2>
			<p class="agency-pricing__lead">
				Per site, on any of these plans &mdash; <a href="<?php echo esc_url( home_url( '/#pricing' ) ); ?>">$29, $69 or $129 a month</a>. Unlimited AI text chat on all of them; only voice minutes change.
			</p>
		</div>
		<div class="agency-partner">
			<h3>We don&rsquo;t have agency pricing yet.</h3>
			<p>No reseller tier, no white-label, no bulk billing. If you manage sites for clients and any of that would change your decision, tell us what you&rsquo;d need &mdash; we&rsquo;re deciding what to build.</p>
			<?php /* ⚠️ THIS FORM NEEDS ITS OWN DESTINATION. The homepage concierge form
			         routes to onboarding with a 3-business-day reply; an agency asking
			         about reseller terms landing in that queue gets answered as if they
			         were a small business wanting setup help. Logged in the backlog. */ ?>
			<?php echo do_shortcode( '[sitestaffr_button persona="onboarding" text="Talk to Us About Agencies" background_color="transparent" gradient="off" icon="sitestaffr" box_shadow="off"]' ); ?>
		</div>
	</div>
</section>

<?php /* ===== 7. FAQ + CTA ================================================= */ ?>
<section class="block block--tight agency-faq" id="faq">
	<div class="block__inner">
		<div class="agency-section__head">
			<h2>Agency Questions</h2>
		</div>
		<div class="faq-list agency-faq__list">
			<?php foreach ( $agency_faq as $i => $q ) : ?>
				<div class="faq-item<?php echo 0 === $i ? ' faq-item--open' : ''; ?>">
					<button class="faq-item__question" type="button" aria-expanded="<?php echo 0 === $i ? 'true' : 'false'; ?>">
						<?php echo esc_html( $q['question'] ); ?>
						<span class="faq-item__icon" aria-hidden="true"></span>
					</button>
					<div class="faq-item__answer">
						<div class="faq-item__answer-inner"><?php echo esc_html( $q['answer'] ); ?></div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php /* Closing CTA: dark, echoing the homepage's structure with the agency ask. PRIMARY
         IS THE FREE TRIAL because trying it on their own site first is the natural agency
         motion — it is FAQ #10 and the honest recommendation. Secondary is the partner
         conversation. */ ?>
<section class="block block--dark agency-cta">
	<div class="block__inner block-statement">
		<h2>Try It on Your Own Site First</h2>
		<p class="agency-cta__lead">
			Free for 30 days, no credit card. See what the recaps look like before you put it in front of a client.
		</p>
		<a href="<?php echo esc_url( home_url( '/download/' ) ); ?>" class="btn btn--primary js-cta" data-cta="trial">
			Start Free Trial <span aria-hidden="true">&rarr;</span>
		</a>
		<p class="agency-cta__note">
			Managing sites for clients? <a href="#partner">Tell us what you&rsquo;d need</a>.
		</p>
	</div>
</section>

</main>
<?php get_template_part( 'template-parts/site-footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
