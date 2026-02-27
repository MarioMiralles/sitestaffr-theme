<?php
/*
Template Name: Privacy Policy
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$page_title       = 'Privacy Policy';
$page_description = 'Privacy Policy for SiteStaffr, a product of PhoneEase LLC. Learn how we collect, use, and protect your data.';
$page_url         = get_permalink() ?: home_url( '/privacy-policy/' );
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
					src="<?php echo esc_url( sitestaffr_asset_url( 'assets/images/logo.png' ) ); ?>"
					alt="<?php echo esc_attr( $site_name ); ?>"
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
			<h1 class="legal-page__title">Privacy Policy</h1>
			<p class="legal-page__meta">
				<strong>Effective Date:</strong> February 24, 2026<br>
				<strong>Last Updated:</strong> February 24, 2026
			</p>

			<section class="legal-section">
				<h2>1. Who We Are</h2>
				<p>SiteStaffr is a product of <strong>PhoneEase LLC</strong>, a Florida limited liability company. SiteStaffr provides an AI-powered voice widget that website owners embed on their sites to assist visitors via real-time voice conversation.</p>
				<p><strong>Contact:</strong></p>
				<ul>
					<li>Email: <a href="mailto:support@sitestaffr.com">support@sitestaffr.com</a></li>
					<li>Website: <a href="https://sitestaffr.com">https://sitestaffr.com</a></li>
				</ul>
				<p>Throughout this Privacy Policy, &ldquo;SiteStaffr,&rdquo; &ldquo;we,&rdquo; &ldquo;us,&rdquo; and &ldquo;our&rdquo; refer to PhoneEase LLC doing business as SiteStaffr.</p>
			</section>

			<section class="legal-section">
				<h2>2. This Policy Covers Two Groups</h2>
				<p>We interact with two distinct groups of people, and we handle their data differently:</p>
				<ul>
					<li><strong>Business Owners (&ldquo;Businesses&rdquo;):</strong> People and organizations who create a SiteStaffr account, subscribe to our service, and embed the voice widget on their websites.</li>
					<li><strong>Site Visitors (&ldquo;Visitors&rdquo;):</strong> People who interact with the SiteStaffr voice widget on a Business&rsquo;s website.</li>
				</ul>
			</section>

			<section class="legal-section">
				<h2>3. What We Collect from Businesses</h2>
				<p>When you create an account or use our service, we may collect:</p>
				<table>
					<thead>
						<tr>
							<th>Data</th>
							<th>Purpose</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Email address</td>
							<td>Account creation, billing, support communications</td>
						</tr>
						<tr>
							<td>Business name and website URL</td>
							<td>Service configuration and identification</td>
						</tr>
						<tr>
							<td>Payment information (via Stripe)</td>
							<td>Subscription billing &mdash; we never store full card numbers</td>
						</tr>
						<tr>
							<td>Account ID and Installation ID</td>
							<td>Unique identifiers for your account and each widget installation</td>
						</tr>
						<tr>
							<td>Usage metrics (call duration, call counts)</td>
							<td>Billing, analytics, and service improvement</td>
						</tr>
						<tr>
							<td>IP address and browser information</td>
							<td>Security, fraud prevention, and troubleshooting</td>
						</tr>
					</tbody>
				</table>
			</section>

			<section class="legal-section">
				<h2>4. What We Collect from Site Visitors</h2>
				<p><strong>SiteStaffr acts as a data processor on behalf of the Business (the data controller) when Visitors use the voice widget.</strong></p>
				<ul>
					<li><strong>Voice audio:</strong> Visitor voice audio is streamed in real time to OpenAI for processing. Audio is not stored by SiteStaffr&rsquo;s middleware servers. OpenAI processes this data under their Zero Data Retention API policy and does not use it for training.</li>
					<li><strong>Conversation transcripts, caller names, and any personal information disclosed during a call</strong> are stored exclusively in the Business&rsquo;s own WordPress database &mdash; not on SiteStaffr&rsquo;s infrastructure.</li>
					<li><strong>SiteStaffr&rsquo;s middleware processes but does not store</strong> Visitor personal data. Our servers handle real-time session routing and log only non-identifying usage metrics (call duration, timestamps, account identifiers).</li>
				</ul>
			</section>

			<section class="legal-section">
				<h2>5. How We Use Information</h2>
				<p>We use collected information to:</p>
				<ul>
					<li>Provide, operate, and maintain the SiteStaffr service</li>
					<li>Process subscriptions and billing</li>
					<li>Track usage for billing and plan enforcement</li>
					<li>Send transactional emails (account confirmations, billing receipts, service alerts)</li>
					<li>Provide customer support</li>
					<li>Monitor and improve service performance and security</li>
					<li>Comply with legal obligations</li>
				</ul>
				<p>We do <strong>not</strong> sell personal information to third parties. We do <strong>not</strong> use Visitor voice data or conversation content for advertising or marketing purposes.</p>
			</section>

			<section class="legal-section">
				<h2>6. Data Processor and Data Controller Roles</h2>
				<ul>
					<li><strong>SiteStaffr is the data controller</strong> for Business account data (email, billing, usage metrics).</li>
					<li><strong>The Business is the data controller</strong> for all Visitor data collected through the voice widget (transcripts, caller information, voice content).</li>
					<li><strong>SiteStaffr is a data processor</strong> acting on behalf of the Business when facilitating voice widget sessions. We process Visitor data only as necessary to deliver the service and according to the Business&rsquo;s instructions.</li>
				</ul>
				<p>Businesses are responsible for providing appropriate privacy disclosures to their Visitors and obtaining any required consent for the use of the AI voice widget on their sites.</p>
			</section>

			<section class="legal-section">
				<h2>7. Third-Party Service Providers</h2>
				<p>We use the following third-party services to operate SiteStaffr:</p>
				<table>
					<thead>
						<tr>
							<th>Provider</th>
							<th>Purpose</th>
							<th>Data Shared</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><strong>OpenAI</strong></td>
							<td>Real-time AI voice processing</td>
							<td>Voice audio streams (zero data retention API &mdash; not used for model training)</td>
						</tr>
						<tr>
							<td><strong>Stripe</strong></td>
							<td>Payment processing</td>
							<td>Business payment and billing information</td>
						</tr>
						<tr>
							<td><strong>Google Cloud</strong></td>
							<td>Infrastructure hosting</td>
							<td>Service data transits and is processed on Google Cloud servers</td>
						</tr>
						<tr>
							<td><strong>Firestore (Google)</strong></td>
							<td>Entitlement and usage storage</td>
							<td>Account IDs, usage metrics, billing state &mdash; no Visitor PII</td>
						</tr>
					</tbody>
				</table>
				<p>Each provider operates under their own privacy policies and data processing agreements. We select providers that maintain appropriate security and privacy standards.</p>
			</section>

			<section class="legal-section">
				<h2>8. Data Storage and Security</h2>
				<ul>
					<li>Business account and billing data is stored in Google Cloud Firestore (US regions).</li>
					<li>Visitor conversation data (transcripts, names) is stored <strong>only</strong> in the Business&rsquo;s WordPress database on their own hosting infrastructure.</li>
					<li>SiteStaffr middleware servers do not persistently store Visitor personal data.</li>
					<li>We use industry-standard security measures including HTTPS encryption in transit, per-site HMAC authentication, and access controls.</li>
				</ul>
				<p>No method of transmission or storage is 100% secure. While we strive to protect your data, we cannot guarantee absolute security.</p>
			</section>

			<section class="legal-section">
				<h2>9. Data Retention and Deletion</h2>
				<ul>
					<li><strong>Business account data:</strong> Retained while your account is active and for a reasonable period afterward for legal and billing purposes. You may request deletion of your account and associated data at any time.</li>
					<li><strong>Usage metrics:</strong> Retained for billing reconciliation and may be retained in aggregate, anonymized form indefinitely.</li>
					<li><strong>Visitor data:</strong> Stored in the Business&rsquo;s WordPress database. Businesses control the retention and deletion of Visitor data. SiteStaffr does not retain Visitor personal data on its own servers.</li>
				</ul>
				<p>To request deletion of your Business account data, contact <a href="mailto:support@sitestaffr.com">support@sitestaffr.com</a>.</p>
			</section>

			<section class="legal-section">
				<h2>10. Children&rsquo;s Privacy</h2>
				<p>SiteStaffr is not directed at children under 13 (or under 16 in the EEA). We do not knowingly collect personal information from children. Businesses must not knowingly deploy the voice widget in contexts directed at children without appropriate legal basis and parental consent. If we learn that we have collected information from a child, we will take steps to delete it promptly.</p>
			</section>

			<section class="legal-section">
				<h2>11. Your Rights</h2>
				<p>Depending on your jurisdiction, you may have the following rights regarding your personal data:</p>

				<h3>For all users</h3>
				<ul>
					<li>Access the personal data we hold about you</li>
					<li>Request correction of inaccurate data</li>
					<li>Request deletion of your data</li>
					<li>Withdraw consent (where processing is based on consent)</li>
				</ul>

				<h3>For California residents (CCPA/CPRA)</h3>
				<ul>
					<li>Right to know what personal information is collected, used, and disclosed</li>
					<li>Right to delete personal information</li>
					<li>Right to opt out of the sale of personal information (we do not sell personal information)</li>
					<li>Right to non-discrimination for exercising your privacy rights</li>
				</ul>

				<h3>For EEA/UK residents (GDPR)</h3>
				<ul>
					<li>Right of access, rectification, erasure, and data portability</li>
					<li>Right to restrict or object to processing</li>
					<li>Right to lodge a complaint with a supervisory authority</li>
				</ul>

				<p><strong>For Visitors:</strong> Because Visitor data is controlled by the Business, Visitors should direct data access, correction, and deletion requests to the Business whose website they interacted with. We will cooperate with Businesses to fulfill such requests.</p>
				<p>To exercise your rights as a Business user, contact <a href="mailto:support@sitestaffr.com">support@sitestaffr.com</a>.</p>
			</section>

			<section class="legal-section">
				<h2>12. Changes to This Privacy Policy</h2>
				<p>We may update this Privacy Policy from time to time. We will notify Business account holders of material changes via email or a prominent notice on our website. The &ldquo;Last Updated&rdquo; date at the top reflects the most recent revision. Continued use of the service after changes constitutes acceptance of the updated policy.</p>
			</section>

			<section class="legal-section">
				<h2>13. Contact Us</h2>
				<p>If you have questions or concerns about this Privacy Policy, contact us at:</p>
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
			<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a>
			<a href="<?php echo esc_url( home_url( '/terms-of-service/' ) ); ?>">Terms of Service</a>
			<a href="mailto:support@sitestaffr.com">Support</a>
		</div>
		<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( $site_name ); ?>. All rights reserved.</p>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
