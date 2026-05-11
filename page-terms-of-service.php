<?php
/*
Template Name: Terms of Service
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$page_title       = 'Terms of Service';
$page_description = 'Terms of Service for SiteStaffr, a product of PhoneEase LLC. Review the terms governing your use of our AI voice widget service.';
$page_url         = get_permalink() ?: home_url( '/terms' );
$site_name        = get_bloginfo( 'name' );
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php echo esc_html( $page_title . ' | ' . $site_name ); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo esc_attr( $page_description ); ?>">
	<meta name="robots" content="index, follow">
	<link rel="canonical" href="<?php echo esc_url( $page_url ); ?>">
	<meta property="og:locale" content="en_US">
	<meta property="og:type" content="website">
	<meta property="og:site_name" content="<?php echo esc_attr( $site_name ); ?>">
	<meta property="og:title" content="<?php echo esc_attr( $page_title ); ?>">
	<meta property="og:description" content="<?php echo esc_attr( $page_description ); ?>">
	<meta property="og:url" content="<?php echo esc_url( $page_url ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'sitestaffr-legal-page' ); ?>>
<?php wp_body_open(); ?>

<nav class="nav" id="nav">
	<div class="container">
		<div class="nav__inner">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav__logo" aria-label="<?php echo esc_attr( $site_name ); ?> home">
				<img
					class="nav__logo-image"
					src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/logo.webp' ) ); ?>"
					alt="<?php echo esc_attr( $site_name ); ?>"
					width="625"
					height="188"
				>
			</a>
			<div class="nav__cta">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">Home</a>
			</div>
		</div>
	</div>
</nav>

<main class="legal-page">
	<div class="container">
		<article class="legal-page__article">
			<h1 class="legal-page__title">Terms of Service</h1>
			<p class="legal-page__meta">
				<strong>Effective Date:</strong> February 24, 2026<br>
				<strong>Last Updated:</strong> February 24, 2026
			</p>

			<section class="legal-section">
				<h2>1. Acceptance of Terms</h2>
				<p>By creating an account, accessing, or using the SiteStaffr service (&ldquo;Service&rdquo;), you agree to be bound by these Terms of Service (&ldquo;Terms&rdquo;). If you are using the Service on behalf of a business or organization, you represent that you have authority to bind that entity to these Terms.</p>
				<p>If you do not agree to these Terms, do not use the Service.</p>
				<p>&ldquo;SiteStaffr,&rdquo; &ldquo;we,&rdquo; &ldquo;us,&rdquo; and &ldquo;our&rdquo; refer to PhoneEase LLC, a Florida limited liability company, doing business as SiteStaffr.</p>
			</section>

			<section class="legal-section">
				<h2>2. Service Description</h2>
				<p>SiteStaffr provides an AI-powered voice widget that Businesses embed on their websites. The widget enables real-time voice conversations between Site Visitors and an AI assistant configured by the Business. The Service includes:</p>
				<ul>
					<li>An embeddable voice widget for Business websites</li>
					<li>A WordPress plugin for widget configuration and call management</li>
					<li>Cloud middleware for real-time voice session routing</li>
					<li>AI voice processing powered by third-party AI providers</li>
					<li>A dashboard for call analytics, transcripts, and configuration</li>
					<li>Subscription management and billing</li>
				</ul>
			</section>

			<section class="legal-section">
				<h2>3. Accounts and Eligibility</h2>
				<ul>
					<li>You must be at least 18 years old to create an account.</li>
					<li>You must provide accurate and complete registration information.</li>
					<li>You are responsible for maintaining the confidentiality of your account credentials.</li>
					<li>You are responsible for all activity that occurs under your account.</li>
					<li>You must notify us promptly of any unauthorized use of your account.</li>
					<li>One account corresponds to one Business entity. Sharing accounts across unrelated businesses is not permitted.</li>
				</ul>
			</section>

			<section class="legal-section">
				<h2>4. Free Trial</h2>
				<p>We may offer a free trial period for new accounts. During the trial:</p>
				<ul>
					<li>You receive a limited amount of voice minutes at no charge.</li>
					<li>The trial expires after a fixed number of days or when trial minutes are exhausted, whichever comes first.</li>
					<li>No credit card is required to start a trial.</li>
					<li>At trial expiration, voice widget functionality will be suspended until you subscribe to a paid plan.</li>
					<li>Trial terms (duration, minutes) may change at our discretion for new signups.</li>
				</ul>
			</section>

			<section class="legal-section">
				<h2>5. Subscriptions and Billing</h2>
				<ul>
					<li><strong>Paid plans:</strong> The Service is offered through paid subscription plans at prices published on our website. Plans differ in the number of included voice minutes and available features.</li>
					<li><strong>Billing cycle:</strong> Subscriptions are billed monthly on a recurring basis. Your billing cycle begins on the date of your first subscription payment.</li>
					<li><strong>Payment:</strong> All payments are processed through Stripe. By subscribing, you authorize recurring charges to your payment method.</li>
					<li><strong>Included minutes:</strong> Each plan includes a set number of voice minutes per billing cycle. Unused included minutes do not roll over to subsequent billing periods.</li>
					<li><strong>Price changes:</strong> We may change subscription pricing with at least 30 days&rsquo; notice. Price changes take effect at the start of your next billing cycle following the notice period.</li>
				</ul>
			</section>

			<section class="legal-section">
				<h2>6. Add-On Minutes</h2>
				<ul>
					<li>You may purchase additional voice minute packs (&ldquo;Add-Ons&rdquo;) at any time.</li>
					<li>Add-on minutes are consumed only after your plan&rsquo;s included monthly minutes are exhausted.</li>
					<li><strong>Add-on minutes roll over</strong> indefinitely and do not expire as long as your account remains active.</li>
					<li>Add-on minutes are retained even if you cancel your subscription &mdash; they remain available if you resubscribe.</li>
					<li>There is no metered or automatic overage billing. When all minutes (included + add-on) are exhausted, the voice widget will be suspended until more minutes are available.</li>
				</ul>
			</section>

			<section class="legal-section">
				<h2>7. Cancellation</h2>
				<ul>
					<li>You may cancel your subscription at any time through the billing portal.</li>
					<li>Cancellation takes effect at the end of your current billing cycle. You retain access to paid features until that date.</li>
					<li>No refunds are issued for partial billing periods.</li>
					<li>Upon cancellation, included monthly minutes cease at the end of the billing period. Any remaining add-on minutes are preserved on your account.</li>
					<li>Your account data (configuration, call history) is retained for a reasonable period after cancellation. You may request permanent deletion by contacting support.</li>
				</ul>
			</section>

			<section class="legal-section">
				<h2>8. Acceptable Use</h2>
				<p>You agree <strong>not</strong> to use the Service to:</p>
				<ul>
					<li>Violate any applicable law, regulation, or third-party rights</li>
					<li>Impersonate any person or entity, or misrepresent your affiliation</li>
					<li>Engage in fraud, phishing, or deceptive practices</li>
					<li>Transmit malware, viruses, or harmful code</li>
					<li>Harass, abuse, threaten, or intimidate any person</li>
					<li>Generate or facilitate spam, unsolicited communications, or robocalls</li>
					<li>Configure the AI assistant to provide medical, legal, financial, or emergency advice as a substitute for licensed professionals</li>
					<li>Attempt to reverse-engineer, decompile, or extract source code from the Service</li>
					<li>Interfere with or disrupt the Service or its infrastructure</li>
					<li>Circumvent usage limits, billing, or security mechanisms</li>
					<li>Use the Service in any manner that could damage, disable, or impair SiteStaffr&rsquo;s systems</li>
				</ul>
				<p>We reserve the right to suspend or terminate accounts that violate these terms, with or without notice depending on severity.</p>
			</section>

			<section class="legal-section">
				<h2>9. Business Responsibilities</h2>
				<p>As a Business using SiteStaffr, you acknowledge and agree that:</p>
				<ul>
					<li><strong>You are the data controller</strong> for all personal data collected from your Site Visitors through the voice widget, including voice audio content, conversation transcripts, and any personal information disclosed during calls.</li>
					<li><strong>You are responsible for providing appropriate privacy notices</strong> to your Site Visitors disclosing the use of AI-powered voice technology on your website.</li>
					<li><strong>You are responsible for obtaining any legally required consent</strong> from Visitors before they interact with the voice widget, as applicable under your jurisdiction (e.g., GDPR, CCPA, state wiretapping/recording laws).</li>
					<li><strong>You must comply with all applicable laws</strong> regarding recording, processing, and storing voice conversations and personal data.</li>
					<li><strong>You are responsible for responding to data subject requests</strong> (access, deletion, etc.) from your Visitors regarding data stored in your WordPress database.</li>
					<li><strong>You control your AI assistant&rsquo;s configuration</strong> (greeting, prompt, behavior). You are responsible for ensuring your configuration complies with applicable laws and does not facilitate harmful, misleading, or unlawful interactions.</li>
				</ul>
				<p>SiteStaffr provides the technology platform. We do not control how you configure the AI assistant or what your Visitors say, and we are not liable for the content of conversations.</p>
			</section>

			<section class="legal-section">
				<h2>10. Intellectual Property</h2>
				<ul>
					<li><strong>SiteStaffr&rsquo;s IP:</strong> The Service, including its software, design, branding, and documentation, is owned by PhoneEase LLC and protected by intellectual property laws. These Terms grant you a limited, non-exclusive, non-transferable license to use the Service for its intended purpose during your subscription.</li>
					<li><strong>Your content:</strong> You retain ownership of your business content, configurations, and data. By using the Service, you grant SiteStaffr a limited license to process your content as necessary to provide the Service.</li>
					<li><strong>Feedback:</strong> If you provide suggestions or feedback about the Service, we may use it without obligation to you.</li>
				</ul>
			</section>

			<section class="legal-section">
				<h2>11. Data and Privacy</h2>
				<p>Our collection and use of data is governed by our <a href="<?php echo esc_url( home_url( '/privacy' ) ); ?>">Privacy Policy</a>. By using the Service, you acknowledge that you have read and understood the Privacy Policy.</p>
				<p>Key points:</p>
				<ul>
					<li>SiteStaffr acts as a data processor for Visitor data on behalf of the Business (data controller).</li>
					<li>Visitor personal data (transcripts, names) is stored only in the Business&rsquo;s WordPress database.</li>
					<li>SiteStaffr middleware stores only usage metrics, billing data, and account identifiers &mdash; not Visitor personal information.</li>
					<li>Voice audio is processed in real time by OpenAI under their zero data retention API policy.</li>
				</ul>
			</section>

			<section class="legal-section">
				<h2>12. Service Availability</h2>
				<ul>
					<li>We strive to maintain high availability but <strong>do not guarantee any specific uptime percentage or SLA.</strong></li>
					<li>The Service may be temporarily unavailable due to maintenance, updates, or circumstances beyond our control.</li>
					<li>We will make reasonable efforts to provide advance notice of planned maintenance.</li>
					<li>We are not liable for any loss or damage resulting from service interruptions.</li>
				</ul>
			</section>

			<section class="legal-section">
				<h2>13. Disclaimer of Warranties</h2>
				<p class="legal-caps">THE SERVICE IS PROVIDED &ldquo;AS IS&rdquo; AND &ldquo;AS AVAILABLE&rdquo; WITHOUT WARRANTIES OF ANY KIND, EITHER EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, AND NON-INFRINGEMENT.</p>
				<p class="legal-caps">WE DO NOT WARRANT THAT: THE SERVICE WILL BE UNINTERRUPTED, ERROR-FREE, OR SECURE; THE AI ASSISTANT WILL PROVIDE ACCURATE, COMPLETE, OR APPROPRIATE RESPONSES; THE SERVICE WILL MEET YOUR SPECIFIC REQUIREMENTS; OR ANY DEFECTS WILL BE CORRECTED.</p>
				<p class="legal-caps">THE AI ASSISTANT IS A TECHNOLOGY TOOL AND IS NOT A SUBSTITUTE FOR HUMAN JUDGMENT, PROFESSIONAL ADVICE, OR LICENSED SERVICES.</p>
			</section>

			<section class="legal-section">
				<h2>14. Limitation of Liability</h2>
				<p class="legal-caps">TO THE MAXIMUM EXTENT PERMITTED BY APPLICABLE LAW:</p>
				<ul>
					<li class="legal-caps">IN NO EVENT SHALL SITESTAFFR, ITS OFFICERS, DIRECTORS, EMPLOYEES, OR AGENTS BE LIABLE FOR ANY INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL, OR PUNITIVE DAMAGES, INCLUDING BUT NOT LIMITED TO LOSS OF PROFITS, DATA, BUSINESS, OR GOODWILL, REGARDLESS OF THE CAUSE OF ACTION OR THEORY OF LIABILITY.</li>
					<li class="legal-caps">SITESTAFFR&rsquo;S TOTAL AGGREGATE LIABILITY ARISING OUT OF OR RELATED TO THESE TERMS OR THE SERVICE SHALL NOT EXCEED THE AMOUNT YOU PAID TO SITESTAFFR IN THE TWELVE (12) MONTHS PRECEDING THE CLAIM.</li>
					<li class="legal-caps">THESE LIMITATIONS APPLY EVEN IF SITESTAFFR HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES.</li>
				</ul>
				<p>Some jurisdictions do not allow the exclusion or limitation of certain damages, so some of the above limitations may not apply to you.</p>
			</section>

			<section class="legal-section">
				<h2>15. Indemnification</h2>
				<p>You agree to indemnify, defend, and hold harmless PhoneEase LLC (d/b/a SiteStaffr), its officers, directors, employees, and agents from and against any claims, liabilities, damages, losses, and expenses (including reasonable attorneys&rsquo; fees) arising out of or related to:</p>
				<ul>
					<li>Your use of the Service</li>
					<li>Your violation of these Terms</li>
					<li>Your violation of any applicable law or third-party rights</li>
					<li>Visitor interactions with the voice widget on your website</li>
					<li>Your configuration of the AI assistant</li>
					<li>Any data privacy claims related to your Visitors&rsquo; data</li>
				</ul>
			</section>

			<section class="legal-section">
				<h2>16. Termination</h2>
				<ul>
					<li><strong>By you:</strong> You may terminate your account at any time by canceling your subscription and requesting account deletion.</li>
					<li><strong>By us:</strong> We may suspend or terminate your account immediately if you violate these Terms, engage in fraudulent activity, or use the Service in a manner that threatens the security or integrity of the platform. For non-urgent violations, we will make reasonable efforts to notify you and provide an opportunity to cure before termination.</li>
					<li><strong>Effect of termination:</strong> Upon termination, your right to use the Service ceases immediately. We may delete your account data after a reasonable retention period. Provisions that by their nature should survive termination (including Sections 10, 13, 14, 15, and 17) will survive.</li>
				</ul>
			</section>

			<section class="legal-section">
				<h2>17. Governing Law and Disputes</h2>
				<ul>
					<li>These Terms are governed by the laws of the <strong>State of Florida</strong>, United States, without regard to conflict of law principles.</li>
					<li>Any disputes arising from these Terms or the Service shall be resolved in the state or federal courts located in Florida.</li>
					<li>You agree to submit to the personal jurisdiction of such courts.</li>
				</ul>
			</section>

			<section class="legal-section">
				<h2>18. General Provisions</h2>
				<ul>
					<li><strong>Entire Agreement:</strong> These Terms, together with the Privacy Policy, constitute the entire agreement between you and SiteStaffr regarding the Service.</li>
					<li><strong>Severability:</strong> If any provision of these Terms is held invalid or unenforceable, the remaining provisions continue in full force.</li>
					<li><strong>Waiver:</strong> Our failure to enforce any right or provision does not constitute a waiver of that right or provision.</li>
					<li><strong>Assignment:</strong> You may not assign these Terms without our written consent. We may assign our rights and obligations without restriction.</li>
					<li><strong>Force Majeure:</strong> We are not liable for delays or failures caused by events beyond our reasonable control.</li>
				</ul>
			</section>

			<section class="legal-section">
				<h2>19. Changes to These Terms</h2>
				<p>We may update these Terms from time to time. We will notify you of material changes via email or a prominent notice on our website at least 30 days before the changes take effect. Continued use of the Service after changes become effective constitutes acceptance. If you do not agree with updated Terms, you must stop using the Service and cancel your account.</p>
			</section>

			<section class="legal-section">
				<h2>20. Contact Us</h2>
				<p>For questions about these Terms, contact us at:</p>
				<p>
					<strong>PhoneEase LLC (d/b/a SiteStaffr)</strong><br>
					Email: <a href="mailto:support@sitestaffr.com">support@sitestaffr.com</a><br>
					Website: <a href="https://sitestaffr.com">https://sitestaffr.com</a>
				</p>
			</section>
		</article>
	</div>
</main>

<footer class="footer">
	<div class="container">
		<div class="footer__links">
			<a href="<?php echo esc_url( home_url( '/privacy' ) ); ?>">Privacy Policy</a>
			<a href="<?php echo esc_url( home_url( '/terms' ) ); ?>">Terms of Service</a>
			<a href="mailto:support@sitestaffr.com">Support</a>
		</div>
		<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( $site_name ); ?>. All rights reserved.</p>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
