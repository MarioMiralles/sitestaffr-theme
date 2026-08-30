<?php
/*
Template Name: Industry
*/

/* ⚠️ THE PHONE RULE, AND IT APPLIES TO EVERY INDUSTRY BLOCK IN THIS FILE.
   SiteStaffr HAS NO PHONE LINE. The readme leads with "No phone lines"; a visitor
   talks or types on the website and there is no number to dial. With
   "receptionist" now in the homepage H1, any phrasing that sounds like telephony
   reads as "this answers my phone" - a crowded, more expensive, different
   category that we do not sell.

   NEVER, in copy: "answers calls", "handles calls", "the caller", "on hold",
   "switchboard", "answering service", "voicemail" as something WE provide.

   ALWAYS FINE, and load-bearing - this is the argument of the whole page:
   the CUSTOMER calling ("they call the next practice on Google", "drivers call
   whoever answers first"), the OWNER calling back ("you call them on the drive
   home"), and the MISSED call as the problem ("Missed calls from the field").
   Do not sweep those; a blanket find-and-replace on "call" would delete the
   product's reason to exist.

   The test is simple: is SiteStaffr the thing doing the calling or answering? If
   yes, rewrite it. If the human is, leave it. Swept 2026-08-27; before that this
   file's dental H1 read "Your Front Desk Can't Answer Every Call. Your AI Agent
   Can." on sixteen pages. */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$page_slug = get_post_field( 'post_name', get_post() );

$industries = array(

	'dental-practices' => array(
		'hero_icon' => '🦷',
		'hero_alt'  => 'Isometric illustration of a dental practice reception desk and treatment chair, with a floating browser window and speech bubble showing the AI agent answering a visitor on the practice website',
		'label'    => 'For Dental Practices',
		/* ⚠️ WAS "Your Front Desk Can't Answer Every Call. Your AI Agent Can." Two problems
		   and the first is the serious one: it claims the product answers CALLS. SiteStaffr
		   has no phone line - the readme leads with "No phone lines" - so this promised the
		   one thing it does not do, in an H1, on sixteen pages. It also used "every" as an
		   absolute. Both are standing rules.

		   It was additionally the only headline of the fifteen that was a product CLAIM
		   rather than a situational scene, so replacing it also puts dental back in the
		   house pattern. The front-desk contrast is what made the original work, so it is
		   kept - it just no longer implies a switchboard. */
		'headline' => 'A Cracked Tooth at 8&nbsp;PM. Your Front Desk Went Home at&nbsp;Five.',
		'subtitle' => 'SiteStaffr greets patients on your website 24/7, answering questions about services, insurance, and availability, capturing new patient inquiries, and sending you a full recap before they even leave the page.',
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
		'solutions_headline' => 'What an AI Agent Does for a Dental Practice',
		'solutions' => array(
			array(
				'title' => 'A visitor asks about your services',
				'desc'  => 'Whether it&rsquo;s teeth whitening, emergency care, or pediatric dentistry, SiteStaffr answers using the information on your website &mdash; accurately and naturally, in 57+ languages.',
			),
			array(
				'title' => 'The AI captures their details',
				'desc'  => 'Name, phone number, reason for calling, insurance questions &mdash; SiteStaffr collects everything a new patient coordinator would, without making anyone wait.',
			),
			array(
				'title' => 'You get a complete recap by email',
				'desc'  => 'Within seconds of the conversation ending, a full summary with contact details, what they need, and a suggested follow-up lands in your inbox &mdash; ready to act on Monday morning or right away.',
			),
		),
		'scenario_label' => 'See it in action',
		'scenario_title' => 'Tuesday, 9:14 PM',
		// The exchange shown in the mockup. RULES for every industry: the agent
		// answers from site content, captures name + number + reason, and says a
		// human will follow up. It NEVER books, diagnoses, quotes a price it was
		// not given, or gives clinical, legal or financial advice.
		//
		// AND IT NEVER PROMISES WHEN. No "first thing Monday", no "within
		// minutes", no "tomorrow morning". SiteStaffr has no scheduling system
		// and no view of who is on shift, so a callback time is a commitment the
		// business never agreed to. The shipped agent says "our team will reach
		// out soon" (services/prompt-sections/collection-slim.js) — the mockups
		// must not show it doing more than the product actually does. The only
		// exception would be a business whose own site states a response time;
		// then the agent is repeating site content, like any other fact.
		//
		// The narrative prose beside the mockup CAN say the business called at
		// 8 AM. That is what the business did, and it is the actual selling
		// point — the constraint is only on what the agent itself promises.
		'chat' => array(
			array( 'from' => 'ai',      'text' => 'Hi! I can answer questions about the practice or pass a message to the team. What do you need?' ),
			array( 'from' => 'visitor', 'text' => 'I chipped a tooth at dinner. Can someone see me tomorrow?' ),
			array( 'from' => 'ai',      'text' => 'That sounds painful &mdash; sorry. The practice does handle dental emergencies. What&rsquo;s your name and the best number to reach you?' ),
			array( 'from' => 'visitor', 'text' => 'Dana Whitfield, 555-0134.' ),
			array( 'from' => 'ai',      'text' => 'Thanks, Dana. I&rsquo;ve passed this to the front desk and marked it urgent &mdash; they&rsquo;ll be in touch as soon as they can.' ),
		),
		'recap' => array(
			'name'     => 'Dana Whitfield',
			'phone'    => '555-0134',
			'reason'   => 'Chipped tooth, asking to be seen tomorrow',
			'summary'  => '<strong>Dana</strong> chipped a tooth at dinner and is asking whether she can be seen tomorrow.',
			'followup' => 'Call Dana to confirm emergency availability and let her know when you can fit her in.',
		),
		'scenario'       => 'A first-time visitor lands on your website after searching &ldquo;emergency dentist near me.&rdquo; SiteStaffr greets them instantly. They explain they chipped a tooth at dinner and need to be seen tomorrow. The AI confirms your practice handles dental emergencies, asks for their name and phone number, and lets them know the team will follow up. By 9:16 PM, you have an email with every detail &mdash; name, email, phone, what happened, and urgency level. Your front desk calls them at 8 AM and books the appointment before the patient even considers another practice.',
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
		'cta_headline' => 'Stop Losing Patients to Silence',
		'cta_text'     => 'SiteStaffr answers your website visitors 24/7 so your front desk can focus on the patients already in the chair. Try it free for 30 days &mdash; no credit card required.',
	),

	'law-firms' => array(
		'hero_icon' => '⚖️',
		'hero_alt'  => 'Isometric illustration of a law office desk stacked with case files and a set of scales, with a floating browser window and speech bubble showing the AI agent taking a new inquiry on the firm website',
		'label'    => 'For Law Firms',
		'headline' => 'Every Missed Inquiry Is a Case That Goes to Another&nbsp;Firm',
		'subtitle' => 'SiteStaffr captures potential client inquiries on your website around the clock, qualifying leads, collecting case details, and delivering a full intake recap to your inbox before the prospect moves on.',
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
				'desc'  => 'In legal intake, the first firm to respond usually gets the client. If your competitors answer faster &mdash; even with a simple conversation &mdash; they win the case before you know it existed.',
			),
		),
		'solutions_headline' => 'How an AI Agent Handles Legal Intake',
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
		'chat' => array(
			array( 'from' => 'ai',      'text' => 'Hi, I can answer questions about the firm or take down your information for our team. What&rsquo;s going on?' ),
			array( 'from' => 'visitor', 'text' => 'I was in a car accident tonight and I&rsquo;m not sure what to do. I have photos of the damage.' ),
			array( 'from' => 'ai',      'text' => 'I&rsquo;m sorry to hear that. The firm does handle auto injury cases &mdash; can I get your name and the best number to reach you?' ),
			array( 'from' => 'visitor', 'text' => 'Renee Castillo, 555-0148.' ),
			array( 'from' => 'ai',      'text' => 'Thanks, Renee. I&rsquo;ve passed this to our intake team &mdash; they&rsquo;ll reach out to you soon.' ),
		),
		'recap' => array(
			'name'     => 'Renee Castillo',
			'phone'    => '555-0148',
			'reason'   => 'Car accident this evening, has photos of the damage',
			'summary'  => '<strong>Renee</strong> was in a car accident tonight and is asking whether the firm handles auto injury cases.',
			'followup' => 'Have intake call Renee to take the details and explain what the firm can do for her.',
		),
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
		'cta_headline' => 'The Next Case Is Visiting Your Website Right Now',
		'cta_text'     => 'SiteStaffr makes sure you never miss another inquiry. Capture leads 24/7, qualify prospects automatically, and respond first. Try it free for 30 days &mdash; no credit card required.',
	),

	'home-services' => array(
		'hero_icon' => '🏠',
		'hero_alt'  => 'Isometric illustration of a home with a service van parked out front and a technician loading tools, with a floating browser window and speech bubble showing the AI agent capturing a job inquiry on the company website',
		'label'    => 'For Home Services',
		'headline' => 'You&rsquo;re on the Job. Your Website Should Be&nbsp;Too.',
		'subtitle' => 'SiteStaffr answers your website visitors while you&rsquo;re on a roof, under a sink, or in an attic. It captures every lead with name, email, phone, and job details, 24/7.',
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
		'solutions_headline' => 'An AI Agent That Answers While You Work',
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
		'chat' => array(
			array( 'from' => 'ai',      'text' => 'Hi! I can answer questions about our services or pass along a message. What&rsquo;s going on?' ),
			array( 'from' => 'visitor', 'text' => 'My AC just stopped working &mdash; no cold air, and it&rsquo;s making a clicking sound.' ),
			array( 'from' => 'ai',      'text' => 'That&rsquo;s rough in this heat. We do handle AC repairs &mdash; what&rsquo;s your name and the best number to reach you?' ),
			array( 'from' => 'visitor', 'text' => 'Marcus Bell, 555-0119.' ),
			array( 'from' => 'ai',      'text' => 'Thanks, Marcus. I&rsquo;ve passed this to the team and marked it urgent &mdash; they&rsquo;ll reach out to sort out a time.' ),
		),
		'recap' => array(
			'name'     => 'Marcus Bell',
			'phone'    => '555-0119',
			'reason'   => 'AC not cooling, clicking sound',
			'summary'  => '<strong>Marcus</strong> has an AC unit that stopped cooling and is making a clicking sound.',
			'followup' => 'Call Marcus to confirm the address and get a technician scheduled.',
		),
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
		'cta_headline' => 'Every Minute Your Website Stays Silent, a Lead Walks Away',
		'cta_text'     => 'SiteStaffr captures leads while you&rsquo;re on the job &mdash; 24/7, in 57+ languages, with full recaps delivered to your inbox. Try it free for 30 days &mdash; no credit card required.',
	),

	'med-spas' => array(
		'hero_icon' => '✨',
		'hero_alt'  => 'Isometric illustration of a med spa treatment room with a facial bed and product shelf, with a floating browser window and speech bubble showing the AI agent answering a consultation inquiry on the spa website',
		'label'    => 'For Med Spas &amp; Aesthetics',
		'headline' => 'Your Website Visitor Wants to Know What Botox Costs. Right&nbsp;Now.',
		'subtitle' => 'SiteStaffr greets visitors on your website 24/7, answering questions about treatments, pricing, and availability, capturing new client inquiries, and sending you a full recap before they even leave the page.',
		'specialty' => 'DaySpa',
		'problems_headline' => 'Med Spas Lose Clients Before They Ever Book a Consultation',
		'problems'  => array(
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
				'title' => 'After-hours inquiries vanish',
				'desc'  => 'A visitor lands on your site at 9 PM after searching &ldquo;Botox near me&rdquo; and wants to know pricing before she commits. No one answers. She books a consultation with the spa down the street instead.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
				'title' => 'Your front desk is stretched thin',
				'desc'  => 'Between treatments, check-ins, and product sales, your team can&rsquo;t give every website visitor the attention a new client inquiry deserves.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M16 16s-1.5-2-4-2-4 2-4 2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>',
				'title' => 'New clients expect instant answers',
				'desc'  => 'Today&rsquo;s clients compare med spas online before they ever call. If your website can&rsquo;t answer basic questions about laser hair removal, fillers, or membership pricing, they move on.',
			),
		),
		'solutions_headline' => 'What an AI Agent Does for a Med Spa',
		'solutions' => array(
			array(
				'title' => 'A visitor asks about a treatment',
				'desc'  => 'Whether it&rsquo;s Botox, dermal fillers, laser hair removal, or a chemical peel, SiteStaffr answers using the information on your website &mdash; accurately and naturally, in 57+ languages.',
			),
			array(
				'title' => 'The AI captures their details',
				'desc'  => 'Name, phone number, the treatment they&rsquo;re interested in, and their preferred day &mdash; SiteStaffr collects everything your front desk would ask, without making anyone wait.',
			),
			array(
				'title' => 'You get a complete recap by email',
				'desc'  => 'Within seconds of the conversation ending, a full summary with contact details, treatment interest, and a suggested follow-up lands in your inbox &mdash; ready to book before they consider anyone else.',
			),
		),
		'scenario_label' => 'See it in action',
		'scenario_title' => 'Thursday, 9:07 PM',
		'chat' => array(
			array( 'from' => 'ai',      'text' => 'Hi! I can answer questions about our treatments or pass along a message to the team. What can I help with?' ),
			array( 'from' => 'visitor', 'text' => 'I&rsquo;m curious about Botox for forehead lines &mdash; how much does it cost, and does it hurt?' ),
			array( 'from' => 'ai',      'text' => 'Great question &mdash; pricing and what to expect are best confirmed with our team directly. Can I get your name and best number so someone can reach out?' ),
			array( 'from' => 'visitor', 'text' => 'Sydney Park, 555-0176.' ),
			array( 'from' => 'ai',      'text' => 'Thanks, Sydney. I&rsquo;ve noted your interest in Botox and passed it to our team &mdash; they&rsquo;ll reach out to answer your questions.' ),
		),
		'recap' => array(
			'name'     => 'Sydney Park',
			'phone'    => '555-0176',
			'reason'   => 'Botox for forehead lines, asked about pricing',
			'summary'  => '<strong>Sydney</strong> is interested in Botox for forehead lines and asked about pricing and comfort.',
			'followup' => 'Call Sydney to go over pricing and offer a consultation slot.',
		),
		'scenario'       => 'A visitor finds your website after searching &ldquo;Botox for forehead lines near me.&rdquo; SiteStaffr greets her and asks how it can help. She wants to know pricing and whether it hurts. The AI answers using the treatment information on your site, asks about her goals, and offers to schedule a consultation. She shares her name and phone number. By 9:09 PM, you have an email with every detail &mdash; what she&rsquo;s interested in, her contact information, and a suggested time to call. Your front desk reaches her at 9 AM and books the consultation before she ever calls another spa.',
		'faqs' => array(
			array(
				'q' => 'Does SiteStaffr store client health information?',
				'a' => 'No. SiteStaffr captures contact details and the treatment a visitor is asking about &mdash; the same information your front desk would collect on an initial call. It does not collect, store, or transmit protected health information. All conversation data is stored in your own WordPress database, not on external servers.',
			),
			array(
				'q' => 'Can SiteStaffr answer questions about specific treatments and pricing?',
				'a' => 'Yes. SiteStaffr learns from the content on your website. If your site lists services like Botox, fillers, laser hair removal, or membership pricing, the AI can speak to those topics naturally. You control what information it has access to.',
			),
			array(
				'q' => 'What if a visitor speaks Spanish or another language?',
				'a' => 'SiteStaffr supports 57+ languages automatically. If a visitor speaks Spanish, Mandarin, or Arabic, the AI responds in their language. Your recap always arrives in English with every detail captured.',
			),
			array(
				'q' => 'How long does setup take?',
				'a' => 'Most med spas are up and running in under five minutes. Install the WordPress plugin, enter your practice details, and the AI agent goes live on your website immediately.',
			),
		),
		'cta_headline' => 'Stop Losing Consultations to Silence',
		'cta_text'     => 'SiteStaffr answers your website visitors 24/7 so your front desk can focus on the clients already in the chair. Try it free for 30 days &mdash; no credit card required.',
	),

	'medical-practices' => array(
		'hero_icon' => '🩺',
		'hero_alt'  => 'Isometric illustration of a medical exam room with an examination table, blood pressure monitor and weighing scale, with a floating browser window and speech bubble showing the AI agent answering a patient inquiry on the practice website',
		'label'    => 'For Medical Practices',
		'headline' => 'A New Patient Is Checking If You Take Their Insurance. At&nbsp;10&nbsp;PM.',
		'subtitle' => 'SiteStaffr greets patients on your website 24/7, answering questions about services, insurance, and appointment availability, capturing new patient inquiries, and sending you a full recap before they even leave the page.',
		'specialty' => 'MedicalClinic',
		'problems_headline' => 'Medical Practices Lose New Patients Before They Ever Call',
		'problems'  => array(
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
				'title' => 'After-hours inquiries vanish',
				'desc'  => 'A visitor arrives at your site at 10 PM wondering if you&rsquo;re accepting new patients or take their insurance. No one answers. They search for the next practice on Google.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
				'title' => 'Your front desk is stretched thin',
				'desc'  => 'Between check-ins, prior authorizations, and phone calls from current patients, your staff can&rsquo;t give website visitors the attention a new patient inquiry deserves.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M16 16s-1.5-2-4-2-4 2-4 2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>',
				'title' => 'Patients research before they book',
				'desc'  => 'Today&rsquo;s patients compare practices online before calling. If your website can&rsquo;t answer basic questions about services, insurance, or wait times, they move on to a practice that can.',
			),
		),
		'solutions_headline' => 'How an AI Agent Supports a Medical Front Desk',
		'solutions' => array(
			array(
				'title' => 'A visitor asks about your practice',
				'desc'  => 'Whether it&rsquo;s accepted insurance, a specific service, or same-week availability, SiteStaffr answers using the information on your website &mdash; accurately and naturally, in 57+ languages.',
			),
			array(
				'title' => 'The AI captures their details',
				'desc'  => 'Name, phone number, reason for the visit, and insurance questions &mdash; SiteStaffr collects everything a new patient coordinator would, without making anyone wait.',
			),
			array(
				'title' => 'You get a complete recap by email',
				'desc'  => 'Within seconds of the conversation ending, a full summary with contact details, what they need, and a suggested follow-up lands in your inbox &mdash; ready to act first thing in the morning.',
			),
		),
		'scenario_label' => 'See it in action',
		'scenario_title' => 'Sunday, 7:15 PM',
		'chat' => array(
			array( 'from' => 'ai',      'text' => 'Hi, I can answer questions about the practice or take a message for our staff. What can I help with?' ),
			array( 'from' => 'visitor', 'text' => 'I&rsquo;ve had a cough that won&rsquo;t clear up. Are you accepting new patients, and do you take my insurance?' ),
			array( 'from' => 'ai',      'text' => 'We are accepting new patients, and our team can confirm insurance details with you directly. What&rsquo;s your name and the best number to reach you?' ),
			array( 'from' => 'visitor', 'text' => 'Owen Bradley, 555-0163.' ),
			array( 'from' => 'ai',      'text' => 'Thanks, Owen. I&rsquo;ve passed this to our office &mdash; they&rsquo;ll reach out to you soon.' ),
		),
		'recap' => array(
			'name'     => 'Owen Bradley',
			'phone'    => '555-0163',
			'reason'   => 'New patient, insurance question',
			'summary'  => '<strong>Owen</strong> is looking for a new provider and asked whether the practice takes his insurance.',
			'followup' => 'Call Owen to confirm his insurance and get him on the schedule.',
		),
		'scenario'       => 'A visitor finds your practice online after a weekend of a persistent cough that won&rsquo;t clear up. SiteStaffr greets them and asks how it can help. They want to know if you&rsquo;re accepting new patients and whether you take their insurance. The AI confirms what your website says about both, then asks for their name and phone number so your staff can follow up. By 7:17 PM, you have an email with every detail &mdash; symptoms mentioned, insurance question, and contact information. Your office calls first thing Monday morning and books the appointment before the patient tries anywhere else.',
		'faqs' => array(
			array(
				'q' => 'Does SiteStaffr store patient health information?',
				'a' => 'No. SiteStaffr captures contact details and the reason for the visit &mdash; the same information a front desk would collect on an initial call. It does not collect, store, or transmit protected health information (PHI). All conversation data is stored in your own WordPress database, not on external servers.',
			),
			array(
				'q' => 'Can SiteStaffr answer insurance and services questions?',
				'a' => 'Yes. SiteStaffr learns from the content on your website. If your site lists accepted insurance plans, services, or provider bios, the AI can speak to those topics naturally. You control what information it has access to.',
			),
			array(
				'q' => 'What if a patient speaks Spanish or another language?',
				'a' => 'SiteStaffr supports 57+ languages automatically. If a visitor speaks Spanish, Mandarin, or Arabic, the AI responds in their language. Your recap always arrives in English with every detail captured.',
			),
			array(
				'q' => 'How long does setup take?',
				'a' => 'Most medical practices are up and running in under five minutes. Install the WordPress plugin, enter your practice details, and the AI agent goes live on your website immediately.',
			),
		),
		'cta_headline' => 'Stop Losing New Patients to Silence',
		'cta_text'     => 'SiteStaffr answers your website visitors 24/7 so your front desk can focus on the patients already in the office. Try it free for 30 days &mdash; no credit card required.',
	),

	'veterinary-clinics' => array(
		'hero_icon' => '🐾',
		'hero_alt'  => 'Isometric illustration of a veterinary exam room with a dog on the table and a check-in desk, with a floating browser window and speech bubble showing the AI agent answering a pet owner on the clinic website',
		'label'    => 'For Veterinary Clinics',
		'headline' => 'It&rsquo;s Midnight and Their Dog Ate Something It&nbsp;Shouldn&rsquo;t&nbsp;Have.',
		'subtitle' => 'SiteStaffr greets worried pet owners on your website 24/7, answering questions about services and availability, capturing urgent inquiries, and sending you a full recap before they even leave the page.',
		'specialty' => 'VeterinaryCare',
		'problems_headline' => 'Veterinary Clinics Lose Clients in Their Most Anxious Moment',
		'problems'  => array(
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/><line x1="1" y1="1" x2="23" y2="23"/></svg>',
				'title' => 'After-hours emergencies go unanswered',
				'desc'  => 'A pet owner visits your site at midnight because their dog got into the trash and won&rsquo;t stop vomiting. No one answers. They search for the next clinic or an emergency hospital instead.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
				'title' => 'Your front desk is stretched thin',
				'desc'  => 'Between exams, boarding drop-offs, and phone calls from current clients, your team can&rsquo;t give every website visitor the attention a scared pet owner needs.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M16 16s-1.5-2-4-2-4 2-4 2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>',
				'title' => 'Pet owners expect instant reassurance',
				'desc'  => 'A worried owner won&rsquo;t wait until morning to find help. If your website can&rsquo;t tell them whether you&rsquo;re taking new patients or handling urgent cases, they call somewhere else.',
			),
		),
		'solutions_headline' => 'An AI Agent for Vet Clinics, Answering When You Can&rsquo;t',
		'solutions' => array(
			array(
				'title' => 'A pet owner describes what happened',
				'desc'  => 'Whether it&rsquo;s a dog that ate something toxic, a limping cat, or a routine vaccination question, SiteStaffr responds using the information on your website &mdash; naturally, in 57+ languages.',
			),
			array(
				'title' => 'The AI captures the important details',
				'desc'  => 'Name, phone number, pet&rsquo;s symptoms, and how urgent it sounds &mdash; SiteStaffr collects everything your front desk needs to prioritize the call back.',
			),
			array(
				'title' => 'You get a complete recap by email',
				'desc'  => 'Within seconds of the conversation ending, a full summary with contact details, what&rsquo;s wrong, and a suggested follow-up lands in your inbox &mdash; ready to act the moment you&rsquo;re free.',
			),
		),
		'scenario_label' => 'See it in action',
		'scenario_title' => 'Friday, 12:20 AM',
		'chat' => array(
			array( 'from' => 'ai',      'text' => 'Hi, I can answer questions or get your information to our on-call team. What&rsquo;s happening?' ),
			array( 'from' => 'visitor', 'text' => 'My dog got into a bag of chocolate about an hour ago. I don&rsquo;t know what to do.' ),
			array( 'from' => 'ai',      'text' => 'That sounds scary. The clinic does handle urgent cases like this &mdash; can I get your name and the best number to reach you?' ),
			array( 'from' => 'visitor', 'text' => 'Priya Nair, 555-0192.' ),
			array( 'from' => 'ai',      'text' => 'Thanks, Priya. I&rsquo;ve marked this urgent and sent it to our on-call team &mdash; they&rsquo;ll be in touch as quickly as they can.' ),
		),
		'recap' => array(
			'name'     => 'Priya Nair',
			'phone'    => '555-0192',
			'reason'   => 'Dog ingested chocolate about an hour ago',
			'summary'  => '<strong>Priya</strong>&rsquo;s dog got into a bag of chocolate roughly an hour ago.',
			'followup' => 'Have the on-call tech call Priya as your first callback and advise on next steps.',
		),
		'scenario'       => 'A visitor lands on your website after their dog got into a bag of chocolate an hour ago. SiteStaffr greets them and asks what&rsquo;s going on. They describe the amount and the dog&rsquo;s size and weight. The AI confirms your clinic handles urgent cases, asks for their name and phone number so someone can call them back right away, and flags the timing in your recap. By 12:22 AM, the details are in your inbox &mdash; symptoms, timing, and contact information. Your on-call tech reaches them within minutes instead of them searching for an emergency hospital.',
		'faqs' => array(
			array(
				'q' => 'Does SiteStaffr store my patients&rsquo; medical records?',
				'a' => 'No. SiteStaffr captures the pet owner&rsquo;s contact details and the reason for their visit &mdash; the same information your front desk would collect on an initial call. It does not access or store medical charts or treatment history. All conversation data is stored in your own WordPress database, not on external servers.',
			),
			array(
				'q' => 'Can SiteStaffr give medical advice about a sick pet?',
				'a' => 'No. SiteStaffr is not a diagnostic tool. It answers questions based on the content published on your website &mdash; services, hours, and whether you handle urgent cases &mdash; and captures the owner&rsquo;s details so your team can call them back directly.',
			),
			array(
				'q' => 'Can it handle after-hours emergencies?',
				'a' => 'Yes. SiteStaffr runs 24/7. When a worried pet owner visits your website at midnight, the AI captures their details and emails you immediately. You decide whether to call back tonight or first thing in the morning.',
			),
			array(
				'q' => 'What languages does it support?',
				'a' => 'SiteStaffr supports 57+ languages. If a Spanish-speaking pet owner describes their emergency in Spanish, the AI responds fluently. Your recap always arrives in English with every detail intact.',
			),
		),
		'cta_headline' => 'Every Missed Call Is a Worried Pet Owner Searching Elsewhere',
		'cta_text'     => 'SiteStaffr captures urgent inquiries 24/7 so your front desk can focus on the patients already in the exam room. Try it free for 30 days &mdash; no credit card required.',
	),

	'chiropractors' => array(
		'hero_icon' => '🦴',
		'hero_alt'  => 'Isometric illustration of a chiropractic clinic with an adjustment table and spine model, with a floating browser window and speech bubble showing the AI agent capturing a new patient inquiry on the clinic website',
		'label'    => 'For Chiropractic &amp; Physical Therapy',
		'headline' => 'They Threw Out Their Back Moving a Couch. They&rsquo;re Looking for Relief&nbsp;Now.',
		'subtitle' => 'SiteStaffr greets visitors on your website 24/7, answering questions about treatments, insurance, and availability, capturing new patient inquiries, and sending you a full recap before they even leave the page.',
		'specialty' => 'Chiropractic',
		'problems_headline' => 'Chiropractic and PT Practices Lose Patients Before the First Adjustment',
		'problems'  => array(
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
				'title' => 'After-hours pain doesn&rsquo;t wait for office hours',
				'desc'  => 'A visitor throws out their back on a Saturday and searches your site for a walk-in appointment. No one answers. They book with the practice that responds first.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
				'title' => 'Your front desk is stretched thin',
				'desc'  => 'Between adjustments, insurance verification, and rebooking existing patients, your staff can&rsquo;t give every website visitor the attention a new patient inquiry deserves.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M16 16s-1.5-2-4-2-4 2-4 2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>',
				'title' => 'New patients research pain relief online',
				'desc'  => 'Someone in pain compares practices before calling. If your website can&rsquo;t answer basic questions about treatment approach, insurance, or same-day availability, they move on.',
			),
		),
		'solutions_headline' => 'How an AI Agent Works for Chiropractic and PT Practices',
		'solutions' => array(
			array(
				'title' => 'A visitor describes their pain',
				'desc'  => 'Whether it&rsquo;s a sports injury, chronic back pain, or a car accident referral, SiteStaffr responds using the information on your website &mdash; naturally, in 57+ languages.',
			),
			array(
				'title' => 'The AI captures their details',
				'desc'  => 'Name, phone number, what&rsquo;s bothering them, and insurance questions &mdash; SiteStaffr collects everything a new patient coordinator would, without making anyone wait.',
			),
			array(
				'title' => 'You get a complete recap by email',
				'desc'  => 'Within seconds of the conversation ending, a full summary with contact details, the reason for the visit, and a suggested follow-up lands in your inbox &mdash; ready to act right away.',
			),
		),
		'scenario_label' => 'See it in action',
		'scenario_title' => 'Saturday, 5:52 PM',
		'chat' => array(
			array( 'from' => 'ai',      'text' => 'Hi, I can answer questions or pass a message to the office. What&rsquo;s going on?' ),
			array( 'from' => 'visitor', 'text' => 'I threw out my lower back moving a couch this afternoon. Do you have anything open tomorrow?' ),
			array( 'from' => 'ai',      'text' => 'Ouch, sorry to hear that. We do treat this kind of injury &mdash; what&rsquo;s your name and best number to reach you?' ),
			array( 'from' => 'visitor', 'text' => 'Trevor Nash, 555-0157.' ),
			array( 'from' => 'ai',      'text' => 'Thanks, Trevor. I&rsquo;ve passed this to the office &mdash; they&rsquo;ll reach out to you soon.' ),
		),
		'recap' => array(
			'name'     => 'Trevor Nash',
			'phone'    => '555-0157',
			'reason'   => 'Lower back injury moving furniture',
			'summary'  => '<strong>Trevor</strong> injured his lower back moving a couch this afternoon and is asking about availability.',
			'followup' => 'Call Trevor with your next opening and confirm what a first visit involves.',
		),
		'scenario'       => 'A visitor lands on your website after throwing out his lower back moving a couch that afternoon. SiteStaffr greets him and asks what happened. He describes the pain and asks if you have any availability tomorrow. The AI confirms your practice handles this kind of injury, asks whether he&rsquo;s a new or returning patient, and collects his name and phone number. By 5:54 PM, you have an email with every detail &mdash; what happened, urgency, and contact information. Your office calls him first thing Sunday and gets him on the schedule before he tries anywhere else.',
		'faqs' => array(
			array(
				'q' => 'Does SiteStaffr store patient health information?',
				'a' => 'No. SiteStaffr captures contact details and the reason for the visit &mdash; the same information a front desk would collect on an initial call. It does not collect, store, or transmit protected health information (PHI). All conversation data is stored in your own WordPress database, not on external servers.',
			),
			array(
				'q' => 'Can SiteStaffr answer questions about specific treatments?',
				'a' => 'Yes. SiteStaffr learns from the content on your website. If your site describes services like spinal adjustments, sports rehab, or physical therapy programs, the AI can speak to those topics naturally. You control what information it has access to.',
			),
			array(
				'q' => 'Can it handle same-day pain inquiries?',
				'a' => 'Yes. SiteStaffr runs 24/7. When someone visits your website in pain on a weekend or evening, the AI captures their details and emails you immediately so your team can follow up as soon as you&rsquo;re open.',
			),
			array(
				'q' => 'How long does setup take?',
				'a' => 'Most chiropractic and physical therapy practices are up and running in under five minutes. Install the WordPress plugin, enter your practice details, and the AI agent goes live on your website immediately.',
			),
		),
		'cta_headline' => 'Every Unanswered Question Is a Patient Who Called Someone Else',
		'cta_text'     => 'SiteStaffr answers your website visitors 24/7 so your front desk can focus on the patients already on the table. Try it free for 30 days &mdash; no credit card required.',
	),

	'real-estate' => array(
		'hero_icon' => '🏡',
		'hero_alt'  => 'Isometric illustration of a listed home with a yard sign and floating listing cards, with a floating browser window and speech bubble showing the AI agent qualifying a buyer on the agency website',
		'label'    => 'For Real Estate',
		'headline' => 'A Buyer Is Looking at Your Listing Right Now. It&rsquo;s Sunday at&nbsp;3&nbsp;PM.',
		'subtitle' => 'SiteStaffr greets visitors browsing your listings 24/7, answering questions about price, square footage, and showings, capturing buyer and seller inquiries, and sending you a full recap before they leave the page.',
		'specialty' => 'RealEstateAgent',
		'problems_headline' => 'Real Estate Agents Lose Buyers While They&rsquo;re at a Showing',
		'problems'  => array(
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
				'title' => 'Weekend inquiries go unanswered',
				'desc'  => 'A buyer finds a listing on your site Sunday afternoon and wants to know if it&rsquo;s still available and when they can see it. You&rsquo;re at another showing. They call the next agent on the search results.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/><line x1="1" y1="1" x2="23" y2="23"/></svg>',
				'title' => 'You can&rsquo;t answer your phone mid-showing',
				'desc'  => 'Between showings, closings, and client calls, you can&rsquo;t give every website visitor the attention a serious buyer or seller deserves.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M16 16s-1.5-2-4-2-4 2-4 2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>',
				'title' => 'Buyers expect instant answers',
				'desc'  => 'Today&rsquo;s buyers browse listings at all hours and compare agents online. If your website can&rsquo;t answer basic questions about price, condition, or availability, they move on to the next listing.',
			),
		),
		'solutions_headline' => 'What an AI Agent Does for a Real Estate Agent',
		'solutions' => array(
			array(
				'title' => 'A visitor asks about a listing',
				'desc'  => 'Whether it&rsquo;s price, square footage, school district, or availability for a showing, SiteStaffr answers using the information on your website &mdash; accurately and naturally, in 57+ languages.',
			),
			array(
				'title' => 'The AI captures their details',
				'desc'  => 'Name, phone number, the listing they&rsquo;re interested in, and their timeline &mdash; SiteStaffr collects everything you&rsquo;d ask a lead, without you missing the showing you&rsquo;re at.',
			),
			array(
				'title' => 'You get a complete recap by email',
				'desc'  => 'Within seconds of the conversation ending, a full summary with contact details, the property they asked about, and a suggested follow-up lands in your inbox &mdash; ready to act the moment you&rsquo;re free.',
			),
		),
		'scenario_label' => 'See it in action',
		'scenario_title' => 'Sunday, 3:04 PM',
		'chat' => array(
			array( 'from' => 'ai',      'text' => 'Hi! I can answer questions about this listing or take a message for the agent. What would you like to know?' ),
			array( 'from' => 'visitor', 'text' => 'What&rsquo;s the asking price, and is it still available? I&rsquo;d love to see it this week.' ),
			array( 'from' => 'ai',      'text' => 'It&rsquo;s still on the market &mdash; I can pull up the price and details from the listing. What&rsquo;s your name and best number so the agent can follow up?' ),
			array( 'from' => 'visitor', 'text' => 'Alicia Moreno, 555-0184.' ),
			array( 'from' => 'ai',      'text' => 'Thanks, Alicia. I&rsquo;ve passed your interest to the agent &mdash; they&rsquo;ll be in touch soon.' ),
		),
		'recap' => array(
			'name'     => 'Alicia Moreno',
			'phone'    => '555-0184',
			'reason'   => 'Interested in a listing, wants to view this week',
			'summary'  => '<strong>Alicia</strong> is looking at one of your listings and wants to see it this week.',
			'followup' => 'Call Alicia to arrange a showing and confirm the listing is still available.',
		),
		'scenario'       => 'A buyer finds one of your listings while scrolling from an open house down the street. SiteStaffr greets them and asks how it can help. They want to know the asking price, whether it&rsquo;s still available, and if they can see it this week. The AI confirms the details from your listing page, then collects their name and phone number. By 3:06 PM, you have an email with every detail &mdash; which property, their timeline, and contact information. You call them between showings and set up a tour before another agent even returns their message.',
		'faqs' => array(
			array(
				'q' => 'Can SiteStaffr answer questions about specific listings?',
				'a' => 'Yes. SiteStaffr learns from the content on your website, including listing pages. If your site includes price, square footage, and features for a property, the AI can answer questions about it accurately. You control what information it has access to.',
			),
			array(
				'q' => 'What happens to buyer and seller contact information?',
				'a' => 'All conversation data is stored in your own WordPress database, not on external servers or shared with other agents. SiteStaffr&rsquo;s middleware processes the conversation in real time but does not retain visitor personal data.',
			),
			array(
				'q' => 'Can it handle both buyer and seller inquiries?',
				'a' => 'Yes. Whether a visitor wants to tour a listing or find out what their home is worth, SiteStaffr engages them naturally and captures the details you need to follow up.',
			),
			array(
				'q' => 'What if a visitor speaks a different language?',
				'a' => 'SiteStaffr supports 57+ languages. If a buyer or seller reaches out in Spanish, the AI responds in Spanish. Your recap always arrives in English.',
			),
		),
		'cta_headline' => 'The Next Buyer Is Browsing Your Listings Right Now',
		'cta_text'     => 'SiteStaffr makes sure you never miss another inquiry while you&rsquo;re at a showing. Capture leads 24/7 and respond first. Try it free for 30 days &mdash; no credit card required.',
	),

	'auto-repair' => array(
		'hero_icon' => '🔧',
		'hero_alt'  => 'Isometric illustration of an auto repair bay with a car on a lift and a rolling toolbox, with a floating browser window and speech bubble showing the AI agent capturing a service inquiry on the shop website',
		'label'    => 'For Auto Repair Shops',
		'headline' => 'The Check Engine Light Just Came On. They&rsquo;re Picking a Shop Before&nbsp;Morning.',
		'subtitle' => 'SiteStaffr answers your website visitors while you&rsquo;re under a hood or on the lift. It captures every lead with name, email, phone, and vehicle details, 24/7.',
		'specialty' => 'AutoRepair',
		'problems_headline' => 'Auto Repair Shops Lose Work to Whoever Picks Up First',
		'problems'  => array(
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/><line x1="1" y1="1" x2="23" y2="23"/></svg>',
				'title' => 'Missed calls from the bay',
				'desc'  => 'You&rsquo;re elbow-deep in a transmission when a driver visits your website with a check engine light and a road trip tomorrow. Your phone is across the shop. By the time you see it, they&rsquo;ve booked with the next shop on Google.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
				'title' => 'Morning rush overwhelms the front counter',
				'desc'  => 'Between drop-offs, pickups, and parts calls, your team can&rsquo;t give every website visitor the attention a new customer deserves.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>',
				'title' => 'Drivers call whoever answers first',
				'desc'  => 'A driver with a dead battery or a grinding brake calls the first shop that responds. If your competitor&rsquo;s website answers instantly and yours doesn&rsquo;t, you lose the job &mdash; even if you&rsquo;re the better mechanic.',
			),
		),
		'solutions_headline' => 'How an AI Agent Answers for Your Auto Shop',
		'solutions' => array(
			array(
				'title' => 'A driver describes the problem',
				'desc'  => 'Check engine light, grinding brakes, a car that won&rsquo;t start &mdash; visitors tell SiteStaffr what&rsquo;s going on. The AI responds naturally using your website content, confirming what you service and your hours.',
			),
			array(
				'title' => 'The AI captures every detail',
				'desc'  => 'Name, phone number, vehicle make and model, and the issue &mdash; everything you need to quote the job and call them back.',
			),
			array(
				'title' => 'You get the lead instantly by email',
				'desc'  => 'A full recap hits your inbox within seconds: who they are, what&rsquo;s wrong with the car, and a suggested follow-up. Check it between jobs and call them back before anyone else can.',
			),
		),
		'scenario_label' => 'See it in action',
		'scenario_title' => 'Monday, 7:38 PM',
		'chat' => array(
			array( 'from' => 'ai',      'text' => 'Hi, I can answer questions or take a message for the shop. What&rsquo;s going on?' ),
			array( 'from' => 'visitor', 'text' => 'My check engine light just started flashing, and I feel a shudder at highway speed.' ),
			array( 'from' => 'ai',      'text' => 'That&rsquo;s worth getting checked out. We do handle this kind of issue &mdash; what&rsquo;s your name, phone number, and the vehicle&rsquo;s year and model?' ),
			array( 'from' => 'visitor', 'text' => 'Jordan Vance, 2019 Honda Accord, 555-0138.' ),
			array( 'from' => 'ai',      'text' => 'Thanks, Jordan. I&rsquo;ve passed this to the shop with your vehicle details &mdash; they&rsquo;ll reach out to you soon.' ),
		),
		'recap' => array(
			'name'     => 'Jordan Vance',
			'phone'    => '555-0138',
			'reason'   => 'Flashing check engine light, shudder at highway speed',
			'summary'  => '<strong>Jordan</strong>&rsquo;s check engine light is flashing and the car shudders at speed. 2019 Honda Accord.',
			'followup' => 'Call Jordan to get the car booked in and advise whether it is safe to drive.',
		),
		'scenario'       => 'You&rsquo;re closing up when a driver two miles away notices her check engine light flashing on the drive home. She finds your website and SiteStaffr greets her right away. She describes the light and mentions a slight shudder at highway speed. The AI asks for her name, phone number, and the vehicle&rsquo;s year and model, then lets her know the shop will follow up. By 7:40 PM, the details are in your inbox. You call her when you open at 8 AM and get the car on the lift before her commute home.',
		'faqs' => array(
			array(
				'q' => 'Does SiteStaffr work for all types of repair shops?',
				'a' => 'Yes. Whether you specialize in general repair, transmissions, tires, or a specific make, SiteStaffr adapts to your website content. If your site describes the services you offer, the AI can discuss them with visitors.',
			),
			array(
				'q' => 'Can it handle after-hours breakdowns?',
				'a' => 'Yes. SiteStaffr runs 24/7. When a driver visits your website at 9 PM with a dead battery or a warning light, the AI captures their details and emails you immediately. You decide whether to respond tonight or first thing tomorrow.',
			),
			array(
				'q' => 'Do I need to be tech-savvy to set it up?',
				'a' => 'Not at all. SiteStaffr installs like any WordPress plugin. Search for it in your dashboard, click install, enter your shop details, and it&rsquo;s live. The whole process takes less than five minutes.',
			),
			array(
				'q' => 'What if a visitor speaks a different language?',
				'a' => 'SiteStaffr supports 57+ languages. If a driver describes their car trouble in Spanish, the AI responds in Spanish. Your recap always arrives in English.',
			),
		),
		'cta_headline' => 'Every Minute Your Website Stays Silent, a Job Goes Elsewhere',
		'cta_text'     => 'SiteStaffr captures leads while you&rsquo;re on the lift &mdash; 24/7, in 57+ languages, with full recaps delivered to your inbox. Try it free for 30 days &mdash; no credit card required.',
	),

	'salons-barbershops' => array(
		'hero_icon' => '💈',
		'hero_alt'  => 'Isometric illustration of a salon floor with styling chairs, mirrors and a barber pole, with a floating browser window and speech bubble showing the AI agent answering a visitor on the salon website',
		'label'    => 'For Salons &amp; Barbershops',
		'headline' => 'Saturday&rsquo;s Last Color Slot Is Open. They&rsquo;re Deciding at&nbsp;9&nbsp;PM.',
		'subtitle' => 'SiteStaffr greets visitors on your website 24/7, answering questions about services, pricing, and availability, capturing new client inquiries, and sending you a full recap before they even leave the page.',
		'specialty' => 'BeautySalon',
		'problems_headline' => 'Salons and Barbershops Lose Bookings Before the Chair Opens Up',
		'problems'  => array(
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
				'title' => 'After-hours booking requests vanish',
				'desc'  => 'A visitor searches your site at 9 PM hoping to grab Saturday&rsquo;s last color appointment before someone else does. No one answers. She books with the salon down the block instead.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
				'title' => 'Your front desk is stretched thin',
				'desc'  => 'Between blowouts, color services, and walk-ins, no one has a free minute to answer every website visitor asking about openings.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M16 16s-1.5-2-4-2-4 2-4 2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>',
				'title' => 'Clients expect instant answers',
				'desc'  => 'Today&rsquo;s clients check pricing and availability online before they call. If your website can&rsquo;t tell them when a chair opens up, they book somewhere that can.',
			),
		),
		'solutions_headline' => 'What an AI Agent Does for a Salon or Barbershop',
		'solutions' => array(
			array(
				'title' => 'A visitor asks about a service',
				'desc'  => 'Whether it&rsquo;s a balayage touch-up, a fade, or a first-time color consultation, SiteStaffr answers using the information on your website &mdash; accurately and naturally, in 57+ languages.',
			),
			array(
				'title' => 'The AI captures their details',
				'desc'  => 'Name, phone number, the service they want, and their preferred day &mdash; SiteStaffr collects everything your front desk would ask, without making anyone wait.',
			),
			array(
				'title' => 'You get a complete recap by email',
				'desc'  => 'Within seconds of the conversation ending, a full summary with contact details, the service requested, and a suggested follow-up lands in your inbox &mdash; ready to book before they try another salon.',
			),
		),
		'scenario_label' => 'See it in action',
		'scenario_title' => 'Thursday, 9:12 PM',
		'chat' => array(
			array( 'from' => 'ai',      'text' => 'Hi! I can answer questions about our services or take a message for the team. What can I help with?' ),
			array( 'from' => 'visitor', 'text' => 'I need a color appointment before my sister&rsquo;s wedding Saturday. Is anything open before then?' ),
			array( 'from' => 'ai',      'text' => 'Let&rsquo;s see what we can do &mdash; what&rsquo;s your name and best number so our team can check availability?' ),
			array( 'from' => 'visitor', 'text' => 'Whitney Ortiz, 555-0125.' ),
			array( 'from' => 'ai',      'text' => 'Thanks, Whitney. I&rsquo;ve marked this as time-sensitive for the team &mdash; they&rsquo;ll reach out to you soon.' ),
		),
		'recap' => array(
			'name'     => 'Whitney Ortiz',
			'phone'    => '555-0125',
			'reason'   => 'Color appointment needed before Saturday',
			'summary'  => '<strong>Whitney</strong> needs a color appointment before her sister&rsquo;s wedding on Saturday.',
			'followup' => 'Call Whitney with the openings you have before the weekend.',
		),
		'scenario'       => 'A visitor finds your website while planning for a wedding this Saturday and needs a color appointment before then. SiteStaffr greets her and asks how it can help. She explains what she wants done and asks if anything is open before the weekend. The AI checks what your site says about availability, then collects her name and phone number so your team can confirm a slot. By 9:14 PM, you have an email with every detail &mdash; the service, her timeline, and contact information. You text her first thing Friday morning and fit her in before she books with the salon down the street.',
		'faqs' => array(
			array(
				'q' => 'Can SiteStaffr answer questions about pricing and specific services?',
				'a' => 'Yes. SiteStaffr learns from the content on your website. If your site lists services like color, cuts, or waxing along with pricing, the AI can speak to those topics naturally. You control what information it has access to.',
			),
			array(
				'q' => 'Can it tell a client which stylist is available?',
				'a' => 'SiteStaffr answers from what your website publishes about stylists, services, and hours. It does not check your live booking calendar, so it captures the client&rsquo;s preferred day and stylist and passes the request to your team to confirm.',
			),
			array(
				'q' => 'What if a client speaks Spanish or another language?',
				'a' => 'SiteStaffr supports 57+ languages automatically. If a visitor speaks Spanish, Mandarin, or Arabic, the AI responds in their language. Your recap always arrives in English with every detail captured.',
			),
			array(
				'q' => 'How long does setup take?',
				'a' => 'Most salons and barbershops are up and running in under five minutes. Install the WordPress plugin, enter your business details, and the AI agent goes live on your website immediately.',
			),
		),
		'cta_headline' => 'Stop Losing Bookings to Silence',
		'cta_text'     => 'SiteStaffr answers your website visitors 24/7 so your team can focus on the clients already in the chair. Try it free for 30 days &mdash; no credit card required.',
	),

	'hvac-plumbing' => array(
		'hero_icon' => '🚿',
		'hero_alt'  => 'Isometric illustration of a utility room with an HVAC unit, pipework and a technician, with a floating browser window and speech bubble showing the AI agent capturing a service inquiry on the company website',
		'label'    => 'For HVAC &amp; Plumbing',
		'headline' => 'No Heat at 11&nbsp;PM in January. Whoever Answers First Gets the&nbsp;Call.',
		'subtitle' => 'SiteStaffr answers your website visitors the instant the heat goes out or a pipe bursts. It captures name, email, phone, and the problem, 24/7, so you&rsquo;re the first call back, not the third.',
		'specialty' => 'HVACBusiness',
		'problems_headline' => 'HVAC and Plumbing Companies Lose the Emergency Call to Whoever Answers First',
		'problems'  => array(
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
				'title' => 'Emergencies don&rsquo;t wait for morning',
				'desc'  => 'A furnace dies at 11 PM in January or a pipe bursts under the sink at 2 AM. The homeowner searches your website in a panic. No one answers, so they call the next number on the page.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/><line x1="1" y1="1" x2="23" y2="23"/></svg>',
				'title' => 'You&rsquo;re on a job, not by the phone',
				'desc'  => 'You&rsquo;re elbow-deep in a water heater install when someone three streets over needs help right now. By the time you see the missed call, they&rsquo;ve already booked the competitor who picked up.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>',
				'title' => 'Whoever answers first gets the job',
				'desc'  => 'A homeowner with no heat or a flooding basement calls down the list until someone picks up. If your website goes quiet at night, you lose the job before you even know it existed &mdash; even if you&rsquo;re the better crew.',
			),
		),
		'solutions_headline' => 'How an AI Agent Handles HVAC and Plumbing Emergencies',
		'solutions' => array(
			array(
				'title' => 'A homeowner describes the emergency',
				'desc'  => 'No heat, no hot water, a pipe that won&rsquo;t stop leaking &mdash; visitors tell SiteStaffr what&rsquo;s wrong. The AI responds using your website content, confirming your service area and that you handle emergency calls.',
			),
			array(
				'title' => 'The AI captures every detail',
				'desc'  => 'Name, phone number, address, and exactly what&rsquo;s happening &mdash; no heat since this morning, water pooling under the sink &mdash; everything you need to triage the job and call back.',
			),
			array(
				'title' => 'You get the lead instantly by email',
				'desc'  => 'A full recap hits your inbox within seconds: who they are, what&rsquo;s failing, and how urgent it is. Check it between jobs and call back before the next company on the search results does.',
			),
		),
		'scenario_label' => 'See it in action',
		'scenario_title' => 'Tuesday, 11:20 PM',
		'chat' => array(
			array( 'from' => 'ai',      'text' => 'Hi, I can answer questions or get your information to our on-call team. What&rsquo;s happening?' ),
			array( 'from' => 'visitor', 'text' => 'Our furnace stopped working and the house is dropping fast &mdash; we have kids here.' ),
			array( 'from' => 'ai',      'text' => 'I&rsquo;m sorry, that sounds stressful. We do handle emergency heating calls &mdash; what&rsquo;s your name and the best number to reach you?' ),
			array( 'from' => 'visitor', 'text' => 'Renata Kowalski, 555-0171.' ),
			array( 'from' => 'ai',      'text' => 'Thanks, Renata. I&rsquo;ve marked this urgent and sent it to our on-call team &mdash; they&rsquo;ll be in touch as quickly as they can.' ),
		),
		'recap' => array(
			'name'     => 'Renata Kowalski',
			'phone'    => '555-0171',
			'reason'   => 'Furnace out, house cooling fast, children at home',
			'summary'  => '<strong>Renata</strong>&rsquo;s furnace has stopped working and the house is cooling quickly.',
			'followup' => 'Have the on-call tech call Renata and dispatch tonight if you can cover it.',
		),
		'scenario'       => 'A family&rsquo;s furnace stops working in the middle of a January cold snap, and the kids are already wrapped in blankets on the couch. They find your website and SiteStaffr greets them right away. They explain the furnace won&rsquo;t kick on and the house is dropping fast. The AI confirms your company handles emergency heating calls, collects their name, phone number, and address, and lets them know the on-call team will follow up. By 11:22 PM, the details are in your inbox. You call them back in five minutes and have a tech on the way before the house drops another degree.',
		'faqs' => array(
			array(
				'q' => 'Does SiteStaffr dispatch a technician or diagnose the problem?',
				'a' => 'No. SiteStaffr doesn&rsquo;t diagnose HVAC or plumbing issues or estimate repair costs &mdash; that stays with your technicians. It answers from what your website publishes, collects the details of the emergency, and gets them to you so your team can call back and dispatch.',
			),
			array(
			/* ⚠️ BOTH OF THESE ASKED ABOUT "CALLS", which on a page selling an AI reads as
			   "does it answer my phone" - the exact misunderstanding the positioning has to
			   avoid, and worse in an FAQ because an answer engine can lift the question on
			   its own with no page around it to correct the impression.
			   "makes the call" went too: it is only an idiom, but it is an idiom about
			   phone calls sitting two lines under a question about phone calls. */
				'q' => 'Can it tell how urgent a request is?',
				'a' => 'SiteStaffr captures exactly what the visitor describes &mdash; no heat, a leaking pipe, a flooded basement &mdash; and flags it in your recap the way they described it. Your team decides how urgently to respond.',
			),
			array(
				'q' => 'Can it handle emergencies in the middle of the night?',
				'a' => 'Yes. SiteStaffr runs 24/7. When a homeowner&rsquo;s pipe bursts at 2 AM, the AI captures their details and emails you immediately, so you can call back the moment you&rsquo;re awake or dispatch an on-call tech right then.',
			),
			array(
				'q' => 'What if the visitor speaks a different language?',
				'a' => 'SiteStaffr supports 57+ languages. If a homeowner describes a leak or a dead furnace in Spanish, the AI responds in Spanish. Your recap always arrives in English with every detail intact.',
			),
		),
		'cta_headline' => 'The Next No-Heat Call Is One Missed Website Visit Away',
		'cta_text'     => 'SiteStaffr captures the emergency the moment it happens &mdash; 24/7, in 57+ languages, with a full recap delivered before you&rsquo;re even off the last job. Try it free for 30 days &mdash; no credit card required.',
	),

	'accounting-tax' => array(
		'hero_icon' => '📊',
		'hero_alt'  => 'Isometric illustration of an accountant desk with ledgers, a calculator and floating charts, with a floating browser window and speech bubble showing the AI agent screening a client inquiry on the firm website',
		'label'    => 'For Accounting &amp; Tax',
		'headline' => 'Two Weeks to the Filing Deadline. A New Client Needs Catch-Up&nbsp;Bookkeeping.',
		'subtitle' => 'SiteStaffr greets visitors on your website 24/7, answering questions about services and new client availability, capturing inquiries, and sending you a full recap before they even leave the page.',
		'specialty' => 'AccountingService',
		'problems_headline' => 'Accounting and Tax Firms Lose Clients Before Filing Season Even Starts',
		'problems'  => array(
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
				'title' => 'After-hours inquiries vanish',
				'desc'  => 'A small business owner realizes at 10 PM that they&rsquo;re behind on bookkeeping with a filing deadline two weeks out. They search your website. No one answers. They book a consultation with the firm that does.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
				'title' => 'Your team is buried during busy season',
				'desc'  => 'Between returns, client calls, and deadlines, no one has time to answer every website visitor asking whether you&rsquo;re taking new clients.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M16 16s-1.5-2-4-2-4 2-4 2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>',
				'title' => 'Prospects compare firms online before they call',
				'desc'  => 'Business owners research accountants the same way they research everything else. If your website can&rsquo;t answer basic questions about services or new client availability, they move to the next firm on the list.',
			),
		),
		'solutions_headline' => 'What an AI Agent Does for an Accounting or Tax Firm',
		'solutions' => array(
			array(
				'title' => 'A visitor asks about your services',
				'desc'  => 'Whether it&rsquo;s catch-up bookkeeping, quarterly taxes, or payroll, SiteStaffr answers using the information on your website &mdash; accurately and naturally, in 57+ languages.',
			),
			array(
				'title' => 'The AI captures their details',
				'desc'  => 'Name, phone number, what kind of help they need, and their timeline &mdash; SiteStaffr collects everything a new client coordinator would, without making anyone wait.',
			),
			array(
				'title' => 'You get a complete recap by email',
				'desc'  => 'Within seconds of the conversation ending, a full summary with contact details, what they need, and a suggested follow-up lands in your inbox &mdash; ready to act first thing in the morning.',
			),
		),
		'scenario_label' => 'See it in action',
		'scenario_title' => 'Sunday, 8:36 PM',
		'chat' => array(
			array( 'from' => 'ai',      'text' => 'Hi, I can answer questions about our services or pass a message to the team. What can I help with?' ),
			array( 'from' => 'visitor', 'text' => 'My bookkeeping is a year behind and my extension deadline is three weeks out. Can you help?' ),
			array( 'from' => 'ai',      'text' => 'We do handle catch-up bookkeeping &mdash; let me get your name and best number so our team can follow up.' ),
			array( 'from' => 'visitor', 'text' => 'Desmond Farrow, 555-0166.' ),
			array( 'from' => 'ai',      'text' => 'Thanks, Desmond. I&rsquo;ve marked this as time-sensitive for the team &mdash; they&rsquo;ll reach out to you soon.' ),
		),
		'recap' => array(
			'name'     => 'Desmond Farrow',
			'phone'    => '555-0166',
			'reason'   => 'A year behind on bookkeeping, extension deadline in three weeks',
			'summary'  => '<strong>Desmond</strong> is about a year behind on bookkeeping with an extension deadline three weeks out.',
			'followup' => 'Call Desmond to scope the catch-up work and confirm you can meet the deadline.',
		),
		'scenario'       => 'A business owner realizes their bookkeeping has fallen a full year behind, with the extension deadline three weeks out. They find your website while searching for help. SiteStaffr greets them and asks how it can help. They explain the situation and ask if you&rsquo;re taking new clients before the deadline. The AI confirms what your site says about new client intake, then collects their name, phone number, and a brief description of what they need. By 8:38 PM, you have an email with every detail. Monday morning, you call first &mdash; and sign the engagement before they try another firm.',
		'faqs' => array(
			array(
				'q' => 'Does SiteStaffr give tax or accounting advice to visitors?',
				'a' => 'No. SiteStaffr is an intake tool, not a tax advisor. It answers questions based on the content published on your website &mdash; services offered, new client process, deadlines you mention &mdash; and captures visitor details for your team to follow up on directly.',
			),
			array(
				'q' => 'Can it answer questions about specific services like payroll or audits?',
				'a' => 'Yes. SiteStaffr learns from the content on your website. If your site describes services like bookkeeping, payroll, quarterly filings, or audit support, the AI can speak to those topics naturally. You control what information it has access to.',
			),
			array(
				'q' => 'Is client information kept confidential?',
				'a' => 'All conversation data is stored in your own WordPress database, not on external servers. SiteStaffr&rsquo;s middleware processes conversations in real time but does not retain visitor personal data outside your site.',
			),
			array(
				'q' => 'What if a prospective client speaks a different language?',
				'a' => 'SiteStaffr supports 57+ languages. If a visitor describes their situation in Spanish, the AI responds in Spanish. Your recap always arrives in English with every detail captured.',
			),
		),
		'cta_headline' => 'The Next New Client Is Checking Your Website Tonight',
		'cta_text'     => 'SiteStaffr makes sure you never miss another inquiry during your busiest season. Capture leads 24/7 and respond first. Try it free for 30 days &mdash; no credit card required.',
	),

	'insurance-agencies' => array(
		'hero_icon' => '🛡️',
		'hero_alt'  => 'Isometric illustration of an insurance agency desk with policy folders and a shield emblem, with a floating browser window and speech bubble showing the AI agent capturing a quote request on the agency website',
		'label'    => 'For Insurance Agencies',
		'headline' => 'A Homeowner Just Opened Their Renewal Notice. The Rate Went&nbsp;Up.',
		'subtitle' => 'SiteStaffr greets visitors on your website 24/7, answering questions about coverage types and availability, capturing new policy inquiries, and sending you a full recap before they even leave the page.',
		'specialty' => 'InsuranceAgency',
		'problems_headline' => 'Insurance Agencies Lose Shoppers the Moment They Close the Tab',
		'problems'  => array(
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
				'title' => 'After-hours quote requests vanish',
				'desc'  => 'A homeowner opens their renewal notice at 9 PM, sees the increase, and starts comparing quotes online. Your website is the third tab open. No one answers, so they request a quote from the second tab instead.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
				'title' => 'Your office can&rsquo;t field every comparison shopper',
				'desc'  => 'Between renewals, claims calls, and walk-ins, your team can&rsquo;t give every website visitor comparing rates the attention a new policy deserves.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M16 16s-1.5-2-4-2-4 2-4 2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>',
				'title' => 'Shoppers expect instant answers',
				'desc'  => 'Today&rsquo;s shoppers compare coverage and carriers online before they ever call an agent. If your website can&rsquo;t answer basic questions about what you offer, they request a quote somewhere that can.',
			),
		),
		'solutions_headline' => 'How an AI Agent Works for an Insurance Agency',
		'solutions' => array(
			array(
				'title' => 'A visitor asks about coverage',
				'desc'  => 'Whether it&rsquo;s auto, home, or umbrella coverage, SiteStaffr answers using the information on your website &mdash; accurately and naturally, in 57+ languages.',
			),
			array(
				'title' => 'The AI captures their details',
				'desc'  => 'Name, phone number, the type of coverage they&rsquo;re shopping for, and what prompted the search &mdash; a rate increase, a new home, a new car &mdash; SiteStaffr collects everything an agent would ask, without making anyone wait.',
			),
			array(
				'title' => 'You get a complete recap by email',
				'desc'  => 'Within seconds of the conversation ending, a full summary with contact details, what they&rsquo;re shopping for, and a suggested follow-up lands in your inbox &mdash; ready to quote before they compare anyone else.',
			),
		),
		'scenario_label' => 'See it in action',
		'scenario_title' => 'Wednesday, 8:51 PM',
		'chat' => array(
			array( 'from' => 'ai',      'text' => 'Hi! I can answer questions about our coverage options or pass along a message. What can I help with?' ),
			array( 'from' => 'visitor', 'text' => 'My renewal notice just went up again. What do you offer for home and auto bundles?' ),
			array( 'from' => 'ai',      'text' => 'We do offer home and auto bundles &mdash; an agent can put together the specifics for you. What&rsquo;s your name and best number to reach you?' ),
			array( 'from' => 'visitor', 'text' => 'Camille Reyes, 555-0142.' ),
			array( 'from' => 'ai',      'text' => 'Thanks, Camille. I&rsquo;ve passed this to our agents &mdash; they&rsquo;ll reach out to go over your options.' ),
		),
		'recap' => array(
			'name'     => 'Camille Reyes',
			'phone'    => '555-0142',
			'reason'   => 'Renewal increase, asking about home and auto bundles',
			'summary'  => '<strong>Camille</strong>&rsquo;s renewal went up again and she is asking about home and auto bundles.',
			'followup' => 'Call Camille to pull quotes and compare them against her current renewal.',
		),
		'scenario'       => 'A homeowner opens her renewal notice and sees the premium jumped again. She starts comparing agencies online and lands on your website. SiteStaffr greets her and asks how it can help. She explains the increase and asks what you offer for home and auto bundles. The AI answers using the coverage information on your site, then collects her name and phone number so an agent can follow up with a quote. By 8:53 PM, you have an email with every detail &mdash; what she&rsquo;s shopping for and why. You call her first thing tomorrow, before she compares anyone else.',
		'faqs' => array(
			array(
				'q' => 'Does SiteStaffr quote policies or give coverage advice?',
				'a' => 'No. SiteStaffr doesn&rsquo;t quote premiums or advise on coverage &mdash; that requires a licensed agent. It answers from what your website publishes about the coverage types and carriers you offer, then captures the visitor&rsquo;s details so an agent can follow up with an actual quote.',
			),
			array(
				'q' => 'Can it answer questions about specific coverage types?',
				'a' => 'Yes. SiteStaffr learns from the content on your website. If your site describes auto, home, life, or commercial coverage, the AI can speak to those topics naturally. You control what information it has access to.',
			),
			array(
				'q' => 'What happens to a shopper&rsquo;s contact information?',
				'a' => 'All conversation data is stored in your own WordPress database, not on external servers or shared with other agencies. SiteStaffr&rsquo;s middleware processes the conversation in real time but does not retain visitor personal data.',
			),
			array(
				'q' => 'What if a shopper speaks a different language?',
				'a' => 'SiteStaffr supports 57+ languages. If a visitor requests a quote in Spanish, the AI responds in Spanish. Your recap always arrives in English with every detail captured.',
			),
		),
		'cta_headline' => 'The Next Rate Shopper Is Comparing Agencies Right Now',
		'cta_text'     => 'SiteStaffr makes sure you never miss another quote request. Capture leads 24/7 and respond first. Try it free for 30 days &mdash; no credit card required.',
	),

	'fitness-studios' => array(
		'hero_icon' => '🏋️',
		'hero_alt'  => 'Isometric illustration of a fitness studio floor with dumbbell racks and a class schedule board, with a floating browser window and speech bubble showing the AI agent answering a prospective member on the studio website',
		'label'    => 'For Fitness Studios',
		'headline' => 'Does Tomorrow&rsquo;s 6 AM Class Have Room? They&rsquo;re Asking at&nbsp;10&nbsp;PM.',
		'subtitle' => 'SiteStaffr greets visitors on your website 24/7, answering questions about class times, trial passes, and membership, capturing new member inquiries, and sending you a full recap before they even leave the page.',
		'specialty' => 'ExerciseGym',
		'problems_headline' => 'Fitness Studios Lose New Members Before They Ever Walk In',
		'problems'  => array(
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
				'title' => 'After-hours inquiries vanish',
				'desc'  => 'A visitor scrolls your class schedule at 9 PM, deciding whether to try tomorrow&rsquo;s 6 AM class. No one answers her questions about the trial pass. She signs up with the studio down the street instead.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
				'title' => 'Your front desk is teaching, not answering the site',
				'desc'  => 'Between teaching, checking members in, and answering the phone during peak hours, no one has time to walk every website visitor through class times and pricing.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M16 16s-1.5-2-4-2-4 2-4 2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>',
				'title' => 'Prospects expect instant answers',
				'desc'  => 'Today&rsquo;s prospects compare studios online before they ever show up. If your website can&rsquo;t answer basic questions about class types, trial passes, or drop-in rates, they move on.',
			),
		),
		'solutions_headline' => 'What an AI Agent Does for a Fitness Studio',
		'solutions' => array(
			array(
				'title' => 'A visitor asks about classes or membership',
				'desc'  => 'Whether it&rsquo;s a trial pass, drop-in rate, or what a beginner class involves, SiteStaffr answers using the information on your website &mdash; accurately and naturally, in 57+ languages.',
			),
			array(
				'title' => 'The AI captures their details',
				'desc'  => 'Name, phone number, which class or membership they&rsquo;re interested in, and when they want to start &mdash; SiteStaffr collects everything your front desk would ask, without making anyone wait.',
			),
			array(
				'title' => 'You get a complete recap by email',
				'desc'  => 'Within seconds of the conversation ending, a full summary with contact details, what they&rsquo;re interested in, and a suggested follow-up lands in your inbox &mdash; ready to welcome them before they try another studio.',
			),
		),
		'scenario_label' => 'See it in action',
		'scenario_title' => 'Sunday, 7:40 PM',
		'chat' => array(
			array( 'from' => 'ai',      'text' => 'Hi! I can answer questions about classes or membership, or take a message for the team. What can I help with?' ),
			array( 'from' => 'visitor', 'text' => 'What&rsquo;s the 6 AM class like, and is there a free trial?' ),
			array( 'from' => 'ai',      'text' => 'We do offer a trial pass &mdash; our team can get you set up. What&rsquo;s your name and best number to reach you?' ),
			array( 'from' => 'visitor', 'text' => 'Talia Brennan, 555-0159.' ),
			array( 'from' => 'ai',      'text' => 'Thanks, Talia. I&rsquo;ve passed your interest to the team &mdash; they&rsquo;ll reach out to get you set up.' ),
		),
		'recap' => array(
			'name'     => 'Talia Brennan',
			'phone'    => '555-0159',
			'reason'   => 'Asked about the 6 AM class and a trial',
			'summary'  => '<strong>Talia</strong> asked what the 6 AM class is like and whether there is a trial.',
			'followup' => 'Text Talia the trial details and the 6 AM class schedule.',
		),
		'scenario'       => 'A visitor is deciding whether to finally try the 6 AM class she&rsquo;s been eyeing and lands on your website looking for a trial pass. SiteStaffr greets her and asks how it can help. She asks what the first class is like and whether there&rsquo;s a free trial. The AI answers using your website&rsquo;s class and pricing information, then collects her name and phone number so your team can follow up. By 7:42 PM, you have an email with every detail &mdash; the class she wants, her contact information, and a suggested time to reach out. Your studio texts her Monday morning, and she&rsquo;s on the mat by Wednesday.',
		'faqs' => array(
			array(
				'q' => 'Can SiteStaffr check real-time class availability?',
				'a' => 'SiteStaffr answers from what your website publishes about the schedule, class types, and trial offers. It does not check your live booking system for open spots, so it captures the prospect&rsquo;s preferred class and passes the request to your team to confirm.',
			),
			array(
				'q' => 'Can it answer questions about membership pricing?',
				'a' => 'Yes. SiteStaffr learns from the content on your website. If your site lists membership tiers, drop-in rates, or trial pass details, the AI can speak to those topics naturally. You control what information it has access to.',
			),
			array(
				'q' => 'What if a prospect speaks a different language?',
				'a' => 'SiteStaffr supports 57+ languages. If a visitor asks about classes in Spanish, the AI responds in Spanish. Your recap always arrives in English with every detail captured.',
			),
			array(
				'q' => 'How long does setup take?',
				'a' => 'Most fitness studios are up and running in under five minutes. Install the WordPress plugin, enter your studio details, and the AI agent goes live on your website immediately.',
			),
		),
		'cta_headline' => 'Stop Losing New Members to Silence',
		'cta_text'     => 'SiteStaffr answers your website visitors 24/7 so your front desk can focus on the members already on the floor. Try it free for 30 days &mdash; no credit card required.',
	),

	'pest-control' => array(
		'hero_icon' => '🐜',
		'hero_alt'  => 'Isometric illustration of a pest control van with a large molded ant mounted on its roof rack, a sprayer and bait stations laid out beside it, with a floating browser window and speech bubble showing the AI agent capturing an inspection inquiry on the company website',
		'label'    => 'For Pest Control',
		'headline' => 'Someone Just Saw a Wasp Nest by the Front Door. They Want Someone Out&nbsp;Tomorrow.',
		'subtitle' => 'SiteStaffr answers your website visitors the moment they spot roaches, a wasp nest, or something worse. It captures name, email, phone, and the problem, 24/7, so you&rsquo;re the first call back.',
		'specialty' => 'PestControlService',
		'problems_headline' => 'Pest Control Companies Lose Jobs They Never Even Know About',
		'problems'  => array(
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/><line x1="1" y1="1" x2="23" y2="23"/></svg>',
				'title' => 'Missed calls from the truck',
				'desc'  => 'You&rsquo;re mid-treatment at one house when someone across town spots roaches in the kitchen and needs someone out fast. Your phone is in the truck. By the time you see it, they&rsquo;ve booked the next company on Google.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>',
				'title' => 'Seasonal surges overwhelm you',
				'desc'  => 'When wasp season hits or the weather turns, your phone rings nonstop. You can&rsquo;t answer every website visitor while you&rsquo;re already booked solid.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>',
				'title' => 'Whoever calls back first gets the job',
				'desc'  => 'Someone who just saw a roach or found a wasp nest by the door wants it handled fast. If your competitor&rsquo;s website answers instantly and yours doesn&rsquo;t, they book the next name on the list &mdash; even if you&rsquo;re better at the job.',
			),
		),
		'solutions_headline' => 'How an AI Agent Answers for a Pest Control Company',
		'solutions' => array(
			array(
				'title' => 'A visitor describes what they found',
				'desc'  => 'Roaches in the kitchen, a wasp nest by the door, signs of termites in the garage &mdash; visitors tell SiteStaffr what&rsquo;s going on. The AI responds naturally using your website content, confirming your service area and what you treat.',
			),
			array(
				'title' => 'The AI captures every detail',
				'desc'  => 'Name, phone number, address, what they found, and how urgent it feels &mdash; everything you need to prioritize the job and call them back.',
			),
			array(
				'title' => 'You get the lead instantly by email',
				'desc'  => 'A full recap hits your inbox within seconds: who they are, what they saw, and a suggested follow-up. Check it between stops and call them back before anyone else can.',
			),
		),
		'scenario_label' => 'See it in action',
		'scenario_title' => 'Friday, 6:15 PM',
		'chat' => array(
			array( 'from' => 'ai',      'text' => 'Hi, I can answer questions or take a message for the team. What&rsquo;s going on?' ),
			array( 'from' => 'visitor', 'text' => 'There&rsquo;s a wasp nest under the eaves right where our kids play. How soon can someone come out?' ),
			array( 'from' => 'ai',      'text' => 'That sounds concerning. We do handle wasp removal &mdash; what&rsquo;s your name and the best number to reach you?' ),
			array( 'from' => 'visitor', 'text' => 'Holly Ferris, 555-0113.' ),
			array( 'from' => 'ai',      'text' => 'Thanks, Holly. I&rsquo;ve passed this to the team &mdash; they&rsquo;ll reach out to you soon.' ),
		),
		'recap' => array(
			'name'     => 'Holly Ferris',
			'phone'    => '555-0113',
			'reason'   => 'Wasp nest under the eaves near the front door',
			'summary'  => '<strong>Holly</strong> found a wasp nest under the eaves where her kids play.',
			'followup' => 'Call Holly to confirm the address and get a tech out.',
		),
		'scenario'       => 'A homeowner walks out the front door and finds a wasp nest tucked under the eaves, right where the kids play. She finds your website and SiteStaffr greets her right away. She describes the nest and its location and asks how soon someone can come out. The AI confirms your company handles wasp removal, collects her name, phone number, and address, and lets her know someone will follow up. By 6:17 PM, the details are in your inbox. You call her on the way home and have a tech scheduled for tomorrow morning before she calls anyone else.',
		'faqs' => array(
			array(
				'q' => 'Does SiteStaffr diagnose the pest problem or quote a price?',
				'a' => 'No. SiteStaffr doesn&rsquo;t identify pests or estimate treatment costs &mdash; that stays with your technicians. It answers from what your website publishes, captures what the visitor found and where, and gets the details to you so your team can follow up with an inspection and quote.',
			),
			array(
				'q' => 'Can it handle same-day or urgent requests?',
				'a' => 'Yes. SiteStaffr runs 24/7. When someone finds roaches or a wasp nest and wants it handled fast, the AI captures their details and emails you immediately so your team can prioritize the callback.',
			),
			array(
				'q' => 'Does it work for both residential and commercial customers?',
				'a' => 'Yes. Whether your site covers home pest control, termite inspections, or commercial accounts, SiteStaffr adapts to your website content and can discuss whatever services you&rsquo;ve published.',
			),
			array(
				'q' => 'What if a visitor speaks a different language?',
				'a' => 'SiteStaffr supports 57+ languages. If a homeowner describes their pest problem in Spanish, the AI responds in Spanish. Your recap always arrives in English with every detail intact.',
			),
		),
		'cta_headline' => 'The Job Goes to Whoever Answers. Make That You.',
		'cta_text'     => 'SiteStaffr captures leads while you&rsquo;re on the job &mdash; 24/7, in 57+ languages, with full recaps delivered to your inbox. Try it free for 30 days &mdash; no credit card required.',
	),

	/* ⚠️ THIS ENTRY EXISTED NOWHERE AND /for/medical-staffing/ 404ed IN PRODUCTION.
	   Medical Staffing was added to the registry in functions.php — so it has a Yoast
	   title and description, it is in the Industries dropdown, it is in the homepage
	   picker, and it is on the /for/ hub — but nothing was ever written here, and the
	   guard below sends an unknown slug to the 404 template. Four links to nowhere.

	   Verified against production, not inferred: /for/medical-staffing/ returns 404 on
	   sitestaffr.com AND on staging, and `git log ..origin/main` is empty, so this is not
	   something another session had already fixed.

	   ⚠️ IT IS THE ONLY B2B PAGE IN THE FILE, and that changes the shape of the copy
	   rather than just its nouns. The other fifteen have ONE visitor — a patient, an
	   owner, a client. A staffing agency's site is read by two people with opposite
	   needs: a facility that has a hole in tomorrow's schedule, and a clinician looking
	   for placement. The page has to be legible to both without picking one, which is
	   why the chat, the recap and the FAQs all name both sides explicitly.

	   ⚠️ IT IS ALSO THE INDUSTRY OUR ONE REAL TESTIMONIAL COMES FROM. Synergy Scribes is
	   medical staffing and it is quoted on the homepage, so this page 404ing meant the
	   only named customer on the site pointed at a category with no page.

	   The category noun here is deliberately SiteStaffr rather than "AI agent": the term
	   ladder is still open with Mario, and writing this one neutrally means it does not
	   need rewriting whichever way that lands. */
	'medical-staffing' => array(
		'hero_icon' => '🩺',
		'hero_alt'  => 'Isometric illustration of a medical staffing agency desk with a shift schedule board and clinician profiles, with a floating browser window and speech bubble showing the AI agent answering a facility scheduler on the agency website',
		'label'    => 'For Medical Staffing Agencies',
		/* House pattern: a situational scene, not a product claim, and the second
		   sentence is the one that stings. No telephony — the recruiters going home is
		   the problem, not an unanswered switchboard. */
		'headline' => 'A Unit Is Short Two Nurses for Tuesday. Your Recruiters Left at&nbsp;Six.',
		'subtitle' => 'SiteStaffr greets facilities and candidates on your website 24/7, answering questions about your specialties, coverage areas, and credentialing, capturing the inquiry, and sending you a full recap before they leave the page.',
		/* schema.org EmploymentAgency. ⚠️ NOT a Medical* type — the agency places
		   clinicians, it does not treat anyone, and typing it as a medical business
		   would misdescribe it. (This field is currently set on all sixteen entries and
		   read by nothing; kept for consistency, flagged separately.) */
		'specialty' => 'EmploymentAgency',
		'problems_headline' => 'Staffing Agencies Lose Placements to Whoever Replies First',
		'problems'  => array(
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
				'title' => 'Coverage requests go cold overnight',
				'desc'  => 'A scheduler has a call-out at 9 PM for a shift starting at seven the next morning. Your desk is empty. By the time anyone reads it, they have already placed the request with the agency that replied.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
				'title' => 'Candidates compare agencies at midnight',
				'desc'  => 'A travel nurse or a scribe weighing three agencies has a question about pay packages, license reciprocity, or how long credentialing takes. If your site cannot answer it, they fill in the next agency&rsquo;s form instead.',
			),
			array(
				'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>',
				'title' => 'Your recruiters are already at capacity',
				'desc'  => 'Between credentialing packets, compliance paperwork, and the placements already in flight, your team cannot give every website inquiry the fast reply that is the whole reason it wins.',
			),
		),
		'solutions_headline' => 'What SiteStaffr Does for a Medical Staffing Agency',
		'solutions' => array(
			array(
				'title' => 'A facility or a candidate asks what you cover',
				'desc'  => 'Specialties, regions, shift types, credentialing requirements &mdash; SiteStaffr answers from what is already published on your site, accurately and naturally, in 57+ languages.',
			),
			array(
				'title' => 'The AI captures who they are and which side they are on',
				'desc'  => 'Facility name, contact number, and the roles and shifts to fill &mdash; or a candidate&rsquo;s discipline, license state, and availability. SiteStaffr collects what a recruiter would ask before the first call back, without anyone waiting.',
			),
			array(
				'title' => 'You get a complete recap by email',
				'desc'  => 'Within seconds of the conversation ending, a full summary with contact details, what they need, and a suggested follow-up lands in your inbox &mdash; ready for whoever is at a desk first.',
			),
		),
		'scenario_label' => 'See it in action',
		'scenario_title' => 'Sunday, 9:40 PM',
		/* Same rules as every other chat in this file: answers from site content,
		   captures name + number + reason, says a human will follow up, and PROMISES NO
		   TIME. Note what it refuses to do — it confirms the coverage AREA, which the
		   site publishes, and says nothing about whether anyone is actually free, which
		   only the bench can answer. That restraint is the FAQ below made visible. */
		'chat' => array(
			array( 'from' => 'ai',      'text' => 'Hi! I can answer questions about the agency or pass a message to the staffing team. What do you need?' ),
			array( 'from' => 'visitor', 'text' => 'We&rsquo;re short two night-shift RNs for Tuesday. Do you cover Sacramento?' ),
			array( 'from' => 'ai',      'text' => 'Yes, the agency staffs the Sacramento area. What&rsquo;s your name and the best number to reach you?' ),
			array( 'from' => 'visitor', 'text' => 'Renee Alvarado, 555-0178, Mercy General.' ),
			array( 'from' => 'ai',      'text' => 'Thanks, Renee. I&rsquo;ve passed this to the staffing team with the shift details and marked it time-sensitive &mdash; they&rsquo;ll be in touch as soon as they can.' ),
		),
		'recap' => array(
			'name'     => 'Renee Alvarado',
			'phone'    => '555-0178',
			'reason'   => 'Two night-shift RNs needed for Tuesday, Sacramento',
			'summary'  => '<strong>Renee</strong> at Mercy General is short two night-shift RNs for Tuesday and is asking whether you cover Sacramento.',
			'followup' => 'Call Renee to confirm which RNs you can place and how quickly you can have them credentialed.',
		),
		'scenario'       => 'A scheduler at a hospital loses two night-shift nurses for Tuesday and starts working through agency websites on a Sunday evening. SiteStaffr greets them straight away. They explain the gap and ask whether you staff their region. The AI confirms your coverage area from your own site, takes their name, number, and the shifts they need, and tells them the staffing team will follow up. By 9:42 PM you have an email with every detail &mdash; facility, contact, roles, dates, and how urgent it is. Your first recruiter in on Monday calls a scheduler who has not yet committed to anyone else.',
		'faqs' => array(
			array(
				'q' => 'Does SiteStaffr store clinician or patient information?',
				'a' => 'No. SiteStaffr captures contact details and the reason for the inquiry &mdash; the same information a recruiter would take on a first call. It does not collect credentialing files, license documents, or any protected health information. All conversation data is stored in your own WordPress database, not on external servers.',
			),
			array(
				'q' => 'Can it tell a facility whether we have someone available?',
				'a' => 'No, and it does not try. SiteStaffr has no view of your bench or your schedule, so it answers from what your website publishes &mdash; specialties, regions, shift types, credentialing timelines &mdash; and captures the request so a recruiter can answer the availability question directly. It never commits you to a placement or a callback time.',
			),
			array(
				'q' => 'Can it handle inquiries from both facilities and candidates?',
				'a' => 'Yes, and it records which one it is talking to. A facility gets asked about roles, shifts, and location; a clinician gets asked about discipline, license state, and availability. Your recap says which side of the placement the inquiry came from before you open it, so it goes to the right person on your team.',
			),
			array(
				'q' => 'What languages does it support?',
				'a' => 'SiteStaffr supports 57+ languages. If a candidate writes in Spanish or Tagalog, the AI responds fluently in the same language. Your recap always arrives in English with every detail intact.',
			),
		),
		'cta_headline' => 'The Shift Goes to the Agency That Replies First',
		'cta_text'     => 'SiteStaffr captures facility requests and candidate inquiries 24/7, so nothing sits in an empty inbox until Monday. Try it free for 30 days &mdash; no credit card required.',
	),
);

if ( ! isset( $industries[ $page_slug ] ) ) {
	include get_404_template();
	return;
}

$ind       = $industries[ $page_slug ];
$site_name = get_bloginfo( 'name' );
$cta_url   = home_url( '/#get-started' );

// Per-industry hero art lives at assets/images/industries/<slug>.webp. The file
// is optional: until one is dropped in, the hero falls back to the emoji it has
// always used, so a page never renders a broken image while art is in progress.
$hero_image_path = get_template_directory() . '/assets/images/industries/' . $page_slug . '.webp';
$hero_image_url  = '';
if ( file_exists( $hero_image_path ) ) {
	// Same filemtime cache-busting the theme uses for CSS/JS — LiteSpeed and the
	// CDN both hold onto these aggressively otherwise.
	$hero_image_url = get_template_directory_uri() . '/assets/images/industries/' . $page_slug . '.webp?v=' . filemtime( $hero_image_path );
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php
	// Yoast handles WebPage, BreadcrumbList, and WebSite schema — only add Service (unique to industry pages)
	$service_schema = array(
		'@type'       => 'Service',
		'name'        => 'AI Chat & Voice Agent ' . $ind['label'],
		'description' => html_entity_decode( wp_strip_all_tags( $ind['subtitle'] ), ENT_QUOTES, 'UTF-8' ),
		'provider'    => array(
			'@id' => home_url( '/' ) . '#organization',
		),
		'serviceType' => 'AI Chat & Voice Agent',
		'areaServed'  => array(
			'@type' => 'Country',
			'name'  => 'United States',
		),
		'offers'      => array(
			'@type'         => 'Offer',
			'price'         => '0',
			'priceCurrency' => 'USD',
			'description'   => 'Free 30-day trial, no credit card required',
		),
	);
	?>
	<script type="application/ld+json">
	<?php echo wp_json_encode( array_merge(
		array( '@context' => 'https://schema.org' ),
		$service_schema
	), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
	</script>

	<?php
	$faq_schema = array(
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => array(),
	);
	foreach ( $ind['faqs'] as $faq ) {
		$faq_schema['mainEntity'][] = array(
			'@type'          => 'Question',
			'name'           => $faq['q'],
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => $faq['a'],
			),
		);
	}
	?>
	<script type="application/ld+json">
	<?php echo wp_json_encode( $faq_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
	</script>

	<?php wp_head(); ?>
</head>
<body <?php body_class( 'sitestaffr-industry-page' ); ?>>
<?php wp_body_open(); ?>

<?php
get_template_part( 'template-parts/site-nav' );
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
				<div class="ind-hero__visual reveal reveal-delay-2"<?php echo $hero_image_url ? '' : ' aria-hidden="true"'; ?>>
					<?php if ( $hero_image_url ) : ?>
						<img
							class="ind-hero__image"
							src="<?php echo esc_url( $hero_image_url ); ?>"
							alt="<?php echo esc_attr( $ind['hero_alt'] ); ?>"
							width="1024"
							height="1024"
							fetchpriority="high"
							decoding="async">
					<?php else : ?>
						<div class="ind-hero__icon-wrap">
							<div class="ind-hero__icon-ring"></div>
							<span class="ind-hero__icon"><?php echo $ind['hero_icon']; ?></span>
						</div>
					<?php endif; ?>
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
						<div class="ind-problem-card__icon" aria-hidden="true"><?php echo $problem['icon']; ?></div>
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
	<?php
	// The recap lands a couple of minutes after the conversation starts, so it is
	// derived from scenario_title rather than stored twice and left to drift.
	$ind_recap_stamp = $ind['scenario_title'];
	if ( preg_match( '/^(.*?)(\d{1,2}):(\d{2})\s*(AM|PM)$/i', html_entity_decode( $ind['scenario_title'] ), $ind_tm ) ) {
		$ind_ts          = strtotime( $ind_tm[2] . ':' . $ind_tm[3] . ' ' . strtoupper( $ind_tm[4] ) . ' +2 minutes' );
		$ind_recap_stamp = $ind_tm[1] . gmdate( 'g:i A', $ind_ts );
	}
	?>
	<section class="ind-scenario">
		<div class="container">
			<div class="ind-scenario__story reveal">
				<span class="section-label"><?php echo esc_html( $ind['scenario_label'] ); ?></span>
				<p><?php echo wp_kses_post( $ind['scenario'] ); ?></p>
			</div>
			<div class="ind-scenario__grid reveal">
				<?php if ( ! empty( $ind['chat'] ) ) : ?>
				<!-- The conversation itself. This section used to describe a chat in a
				     paragraph; showing the exchange is the whole point of the page. -->
				<figure class="ind-scenario__item">
				<div class="ind-chat" role="img" aria-label="Example conversation between a website visitor and the SiteStaffr agent">
					<div class="ind-chat__bar">
						<span class="ind-chat__dot" aria-hidden="true"></span>
						<span class="ind-chat__dot" aria-hidden="true"></span>
						<span class="ind-chat__dot" aria-hidden="true"></span>
						<span class="ind-chat__time"><?php echo esc_html( $ind['scenario_title'] ); ?></span>
					</div>
					<div class="ind-chat__thread">
						<?php foreach ( $ind['chat'] as $ind_turn ) : ?>
						<div class="ind-chat__row is-<?php echo esc_attr( 'visitor' === $ind_turn['from'] ? 'visitor' : 'ai' ); ?>">
							<p class="ind-chat__bubble"><?php echo wp_kses_post( $ind_turn['text'] ); ?></p>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
				<figcaption class="ind-scenario__caption">What your visitor sees</figcaption>
				</figure>
				<?php endif; ?>

				<?php if ( ! empty( $ind['recap'] ) ) : ?>
				<!-- The other half of the story: what lands in the owner's inbox.
				     Mirrors the recap document on the home page so the same artifact
				     looks the same everywhere it appears. -->
				<figure class="ind-scenario__item">
				<div class="ind-recap">
					<div class="ind-recap__head">
						<img class="ind-recap__logo" src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/logo-240.webp' ) ); ?>" alt="SiteStaffr" width="240" height="72">
						<span class="ind-recap__stamp"><?php echo esc_html( $ind_recap_stamp ); ?></span>
					</div>
					<div class="ind-recap__section">
						<div class="ind-recap__section-head">
							<strong>Conversation Recap</strong>
							<span>New lead</span>
						</div>
						<p><?php echo wp_kses_post( $ind['recap']['summary'] ); ?></p>
						<ul>
							<li>Name: <?php echo esc_html( $ind['recap']['name'] ); ?></li>
							<li>Phone: <span class="ind-recap__link"><?php echo esc_html( $ind['recap']['phone'] ); ?></span></li>
							<li>Reason for contact: <?php echo esc_html( $ind['recap']['reason'] ); ?></li>
						</ul>
						<p class="ind-recap__followup"><strong>Suggested follow-up:</strong> <?php echo esc_html( $ind['recap']['followup'] ); ?></p>
					</div>
				</div>
				<figcaption class="ind-scenario__caption">What lands in your inbox</figcaption>
				</figure>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- FAQ -->
	<section class="ind-faq">
		<div class="container container--narrow">
			<div class="ind-faq__header reveal">
				<span class="section-label">FAQ</span>
				<?php
				// Keyphrase-bearing subheading: the Yoast title carries
				// "AI Chat & Voice Agent for <vertical>" but no H2 did, so the
				// page's own target phrase never appeared in its structure.
				// Keep this in step with the seo_title pattern in functions.php.
				$faq_vertical = preg_replace( '/^For\s+/', '', html_entity_decode( $ind['label'], ENT_QUOTES, 'UTF-8' ) );
				?>
				<h2><?php echo esc_html( sprintf( 'AI Chat & Voice Agents for %s: Common Questions', $faq_vertical ) ); ?></h2>
			</div>
			<div class="faq-list">
				<?php foreach ( $ind['faqs'] as $i => $faq ) : ?>
					<div class="faq-item reveal<?php echo $i > 0 ? ' reveal-delay-' . $i : ''; ?>">
						<button class="faq-item__question" type="button">
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

	<!-- Related Resources -->
	<section class="ind-related">
		<div class="container container--narrow">
			<div class="ind-related__content reveal">
				<h2>Explore More</h2>
				<ul class="ind-related__links">
					<?php
					foreach ( $industries as $slug => $industry ) {
						if ( $slug === $page_slug ) {
							continue;
						}
						echo '<li><a href="' . esc_url( home_url( '/for/' . $slug . '/' ) ) . '">' . esc_html( str_replace( '&rsquo;', "'", $industry['label'] ) ) . '</a></li>';
					}
					?>
					<li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">AI Voice Agents for WordPress: A Buyer's Guide</a></li>
				</ul>
			</div>
		</div>
	</section>

	<!-- CTA -->
	<section class="ind-cta">
		<div class="ind-cta__pattern" aria-hidden="true"></div>
		<div class="container container--narrow">
			<div class="ind-cta__content cta-spotlight reveal">
				<h2><?php echo wp_kses_post( $ind['cta_headline'] ); ?></h2>
				<p><?php echo wp_kses_post( $ind['cta_text'] ); ?></p>
				<div class="ind-cta__actions">
					<a href="<?php echo esc_url( $cta_url ); ?>" class="btn ind-cta__btn">
						Get Started
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
					</a>
					<a href="<?php echo esc_url( home_url( '/download/' ) ); ?>" class="btn btn--outline ind-cta__btn-outline">Download Plugin</a>
				</div>
			</div>
		</div>
	</section>

</main>

<?php get_template_part( 'template-parts/site-footer' ); ?>

<?php wp_footer(); ?>
</body>
</html>
