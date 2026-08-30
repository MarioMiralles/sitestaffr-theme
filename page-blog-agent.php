<?php
/*
Template Name: Blog Agent
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$get_started_url = home_url( '/#get-started' );

// Page data — kept in arrays so the markup stays readable.
$ba_pipeline = array(
    array(
        'num'   => '1',
        'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>',
        'title' => 'Reads your website',
        'desc'  => 'Blog Agent studies your pages and services first, so every post is grounded in your real business &mdash; never generic filler.',
    ),
    array(
        'num'   => '2',
        'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>',
        'title' => 'Writes the post',
        'desc'  => 'A complete, SEO-structured article in the tone, length, and language you choose &mdash; English, Spanish, French, or Portuguese.',
    ),
    array(
        'num'   => '3',
        'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.5.5l3-3a5 5 0 0 0-7-7l-1.7 1.6"/><path d="M14 11a5 5 0 0 0-7.5-.5l-3 3a5 5 0 0 0 7 7l1.7-1.6"/></svg>',
        'title' => 'Optimizes for search',
        'desc'  => 'Real internal links to your own pages, your existing categories and tags, an FAQ section, and schema markup &mdash; all added automatically.',
    ),
    array(
        'num'   => '4',
        'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.1-3.1a2 2 0 0 0-2.8 0L6 21"/></svg>',
        'title' => 'Adds a featured image &amp; saves a draft',
        'desc'  => 'A brand-colored featured image, then the whole post lands as a draft in WordPress &mdash; ready for your review.',
    ),
);

$ba_features = array(
    array(
        'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-4"/></svg>',
        'title' => 'Grounded in your business',
        'desc'  => 'Posts are built from your own website content and services. Blog Agent links only to pages that actually exist and never names a competitor.',
    ),
    array(
        'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>',
        'title' => 'You approve every post',
        'desc'  => 'Each article is saved as a WordPress draft. Nothing publishes without your review &mdash; publish when it&rsquo;s ready, or edit first.',
    ),
    array(
        'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>',
        'title' => 'Built to rank',
        'desc'  => 'Meta titles and descriptions, FAQ sections, schema markup, and internal linking come standard &mdash; the on-page SEO work, done for you.',
    ),
    array(
        'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a6 6 0 0 0-6 6c0 4 6 12 6 12s6-8 6-12a6 6 0 0 0-6-6Z"/><circle cx="12" cy="9" r="2"/></svg>',
        'title' => 'Your voice, your brand',
        'desc'  => 'Choose the tone, target word count, and language per post. Featured images use your brand color so every article looks like yours.',
    ),
);

$ba_plans = array(
    array( 'name' => 'Free Trial', 'count' => '1', 'unit' => 'post' ),
    array( 'name' => 'Starter',    'count' => '2', 'unit' => 'posts/mo' ),
    array( 'name' => 'Business',   'count' => '4', 'unit' => 'posts/mo', 'pilot' => true ),
    array( 'name' => 'Pro',        'count' => '8', 'unit' => 'posts/mo', 'pilot' => true ),
);

$ba_faqs = array(
    array(
        'q' => 'Where does Blog Agent get the content for my posts?',
        'a' => 'From your own website. Before writing, it studies your pages and services so each post reflects your real business. It links only to pages that actually exist on your site, reuses your existing categories and tags, and never mentions competitors.',
    ),
    array(
        'q' => 'Do posts publish automatically?',
        'a' => 'Only if you want them to. By default every post is saved as a draft for your review. On Business and Pro plans, Autopilot can publish on a schedule you set &mdash; or keep saving drafts for you to approve. You stay in control either way.',
    ),
    array(
        'q' => 'How many posts do I get?',
        'a' => 'It depends on your plan: 1 post on the free trial, 2 a month on Starter, 4 on Business, and 8 on Pro. Blog Agent also keeps a queue of suggested topics ready for you to choose from.',
    ),
    array(
        'q' => 'Can I control the tone and length?',
        'a' => 'Yes. For each post you pick the tone (professional, friendly, or authoritative), a target word count, and the language &mdash; English, Spanish, French, or Portuguese. You can set defaults once and override them anytime.',
    ),
    array(
        'q' => 'Who owns the featured image &mdash; is it copyright-safe?',
        'a' => 'Every featured image is generated fresh for your post and tinted in your brand color &mdash; never pulled from a stock library or scraped from the web. That means no licensing fees, no attribution requirements, and no risk of a copyright claim. The image is yours to use, and you can always swap in your own before publishing.',
    ),
    array(
        'q' => 'Is my content stored on SiteStaffr&rsquo;s servers?',
        'a' => 'No. Your generated posts live in your own WordPress site, like any other post. SiteStaffr does not store your business content.',
    ),
);
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <style>
/* ===== Blog Agent landing page (scoped .ba-) ===== */
.ba-page { background: var(--cream); color: var(--text-primary); overflow-x: hidden; }

/* Hero */
/* ⚠️ FLAT CREAM. The radial teal wash and the warm-white-to-cream vertical gradient
   are both DELETED, same call as the industry and Salesforce heroes: decoration doing
   no work, and a hero that fades into the section below replaces a decision with a
   smudge. It also stops this being the only cream on the site that is not flat. */
.ba-hero { background: var(--cream); }
/* ⚠️ TWO CLASSES. `.block:not(.block--dark)` is (0,2,0) and beats a bare `.ba-hero`
   whatever the source order. Same first-section-under-the-nav value as the other
   converted heroes. */
.block.ba-hero { padding-block-start: clamp(120px, 15vw, 140px); }
/* Kept next to .block-split__grid, whose 1fr 1fr this overrides. */
.ba-hero__grid {
    grid-template-columns: minmax(0, 1.02fr) minmax(0, 0.98fr);
    gap: clamp(32px, 5vw, 72px);
}
.ba-hero__eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 6px 14px; border-radius: 999px;
    /* --teal-text: 4.06:1 on the pale-teal pill at 0.78rem failed AA. */
    background: var(--teal-pale); color: var(--teal-text);
    font-family: var(--font-body); font-weight: 700;
    font-size: 0.78rem; letter-spacing: 0.04em; text-transform: uppercase;
    border: 1px solid rgba(0,131,143,0.16);
}
.ba-hero__title {
    font-family: var(--font-display);
    font-size: var(--hero-title-size); line-height: 1.04;
    letter-spacing: -0.02em; margin: 20px 0 0; color: var(--text-primary);
}
.ba-hero__title em { font-style: italic; color: var(--teal-deep); }
.ba-hero__sub {
    font-family: var(--font-body); font-size: clamp(1.06rem, 1.5vw, 1.22rem);
    line-height: 1.6; color: var(--text-secondary); max-width: 38ch; margin: 22px 0 0;
}
.ba-hero__actions { display: flex; flex-wrap: wrap; gap: 14px 18px; align-items: center; margin-top: 32px; }
.ba-hero__seclink {
    /* --teal-text: #00838F on cream is 4.03:1 at body size. */
    font-family: var(--font-body); font-weight: 600; color: var(--teal-text);
    text-decoration: none; display: inline-flex; align-items: center; gap: 7px;
}
.ba-hero__seclink:hover { color: var(--teal-mid); }
.ba-hero__note { margin-top: 18px; font-family: var(--font-body); font-size: 0.86rem; color: var(--text-muted); }

/* Hero mockup: a WordPress draft */
.ba-hero__visual { position: relative; }
.ba-draft {
    position: relative; z-index: 2;
    background: #fff; border-radius: var(--radius-lg);
    border: 1px solid var(--border-light);
    box-shadow: var(--shadow-xl); overflow: hidden;
}
.ba-draft__bar {
    display: flex; align-items: center; gap: 7px;
    padding: 13px 16px; background: #faf8f4; border-bottom: 1px solid #f0ebe0;
}
.ba-draft__dot { width: 10px; height: 10px; border-radius: 50%; background: #d8cfc0; }
.ba-draft__dot:nth-child(1) { background: #f4b8b0; }
.ba-draft__dot:nth-child(2) { background: #f5d99a; }
.ba-draft__dot:nth-child(3) { background: #bfe3b6; }
.ba-draft__chip-status {
    margin-left: auto; font-family: var(--font-body); font-size: 0.72rem; font-weight: 700;
    letter-spacing: 0.03em; text-transform: uppercase;
    color: var(--emerald); background: var(--emerald-light);
    padding: 4px 10px; border-radius: 999px;
}
.ba-draft__hero {
    height: 122px;
    background:
        radial-gradient(120px 80px at 78% 30%, rgba(255,255,255,0.28), transparent 70%),
        linear-gradient(135deg, var(--teal-light) 0%, var(--teal-deep) 100%);
    display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.92);
}
.ba-draft__hero svg { width: 34px; height: 34px; }
.ba-draft__body { padding: 20px 22px 24px; }
.ba-draft__pills { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 13px; }
.ba-draft__pill {
    font-family: var(--font-body); font-size: 0.7rem; font-weight: 700;
    letter-spacing: 0.03em; text-transform: uppercase;
    color: var(--teal-deep); background: var(--teal-pale);
    padding: 4px 10px; border-radius: 999px;
}
.ba-draft__title {
    font-family: var(--font-display); font-size: 1.32rem; line-height: 1.25;
    color: var(--text-primary); margin: 0 0 10px;
}
.ba-draft__lines { display: grid; gap: 9px; }
.ba-draft__line { height: 9px; border-radius: 5px; background: #ece6db; }
.ba-draft__line--full { width: 100%; }
.ba-draft__line--long { width: 92%; }
.ba-draft__line--mid  { width: 74%; }
.ba-draft__meta {
    display: flex; flex-wrap: wrap; gap: 7px; margin-top: 18px;
    padding-top: 16px; border-top: 1px solid #f2ede3;
}
.ba-draft__tag {
    font-family: var(--font-body); font-size: 0.74rem; font-weight: 600;
    color: var(--teal-deep); background: #f3faf9;
    border: 1px solid rgba(0,131,143,0.14);
    padding: 5px 11px; border-radius: 8px;
    display: inline-flex; align-items: center; gap: 6px;
}
.ba-draft__tag svg { width: 13px; height: 13px; }
/* Floating accents */
.ba-float {
    position: absolute; z-index: 3;
    display: inline-flex; align-items: center; gap: 8px;
    padding: 9px 14px; background: #fff; border: 1px solid var(--border-light);
    border-radius: var(--radius-md); box-shadow: var(--shadow-md);
    font-family: var(--font-body); font-weight: 600; font-size: 0.82rem; color: var(--text-primary);
    white-space: nowrap; animation: baFloat 5.5s ease-in-out infinite;
}
.ba-float svg { width: 16px; height: 16px; color: var(--teal-light); }
.ba-float--a { top: -22px; left: -18px; }
.ba-float--b { top: 30%; left: -40px; animation-delay: 1.4s; }
.ba-float--c { bottom: -20px; right: -10px; animation-delay: 2.4s; }
@keyframes baFloat { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-9px); } }
@media (prefers-reduced-motion: reduce) { .ba-float { animation: none; } }

/* Section shell */
/* ⚠️ NO `padding` HERE. `.block` owns it, and a `padding` SHORTHAND on `.ba-section`
   beats `.block`'s `padding-block` from anywhere in the file. --section-padding was
   this page's third spacing system. */
.ba-section { background: var(--cream); }
.ba-section__head { text-align: center; max-width: 720px; margin: 0 auto clamp(40px, 5vw, 64px); }
/* The dark run: `.block--dark h2` already whitens the title; the deck and eyebrow
   have to be told. */
.block--dark .ba-section__lead { color: rgba(240,250,250,0.8); }
.ba-section__title {
    font-family: var(--font-display); font-size: clamp(2rem, 3.6vw, 2.9rem);
    line-height: 1.1; letter-spacing: -0.015em; margin: 12px 0 0; color: var(--text-primary);
}
.ba-section__lead {
    font-family: var(--font-body); font-size: clamp(1.02rem, 1.4vw, 1.16rem);
    line-height: 1.6; color: var(--text-secondary); margin: 16px auto 0; max-width: 60ch;
}

/* ---- Pipeline: a V3 Cards block, UNBOXED -------------------------------
   ⚠️ `.ba-flow`'S OWN --warm-white IS GONE. That white was section 1 of the
   HOMEPAGE's tone, borrowed here to separate two sections; V3 separates with a dark
   block or with whitespace, and one cream run is what the industry page converted to.

   Card, border, shadow and hover-lift removed for the same reason as everywhere else
   in this conversion: four steps in a sequence are not four offers side by side.
   ⚠️ `.ba-step__num` IS DELETED, MARKUP AND CSS — a 2.4rem numeral in --teal-pale
   pinned to a card's top-right corner is legible only while the corner exists. */
.ba-flow__grid {
    display: grid; grid-template-columns: repeat(4, 1fr); gap: clamp(18px, 2.4vw, 28px);
}
.ba-step__icon {
    color: var(--teal-text); line-height: 0; margin-bottom: 14px;
}
.ba-step__icon svg { width: 28px; height: 28px; }
.ba-step__title {
    font-family: var(--font-display); font-size: 1.18rem; line-height: 1.25;
    color: var(--text-primary); margin: 0 0 8px;
}
.ba-step__desc { font-family: var(--font-body); font-size: 0.95rem; line-height: 1.55; color: var(--text-secondary); margin: 0; }

/* Feature grid — unboxed, same rule as the steps above. */
.ba-features__grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: clamp(24px, 3vw, 40px); }
.ba-card { display: flex; gap: 18px; }
.ba-card__icon {
    flex: none; color: var(--teal-text); line-height: 0;
}
.ba-card__icon svg { width: 26px; height: 26px; }
.ba-card__title { font-family: var(--font-display); font-size: 1.24rem; color: var(--text-primary); margin: 2px 0 8px; }
.ba-card__desc { font-family: var(--font-body); font-size: 0.97rem; line-height: 1.55; color: var(--text-secondary); margin: 0; }

/* ---- Autopilot: the page's one dark run --------------------------------
   ⚠️ THE DARK ROUNDED PANEL BECOMES THE BLOCK ITSELF. It was a card floating on
   warm-white, painted in a THREE-STOP GRADIENT (#074651 -> #0a5a66 -> #064450) that
   matched nothing else on the site — a fourth and fifth dark tone next to
   --block-dark and --footer-dark. Full-bleed, bracketed by the curtain pair, it says
   "this part matters" in the vocabulary the rest of the site already uses, and the
   two retired tones go with it.

   The panel keeps only its GRID. Background, radius, padding, shadow and the
   text colour are `.block--dark`'s job now. */
.ba-pilot__panel {
    display: grid; grid-template-columns: minmax(0, 1.05fr) minmax(0, 0.95fr);
    gap: clamp(32px, 5vw, 64px); align-items: center;
}
.ba-pilot__eyebrow {
    display: inline-block; font-family: var(--font-body); font-weight: 700;
    font-size: 0.76rem; letter-spacing: 0.05em; text-transform: uppercase;
    /* --teal-light, the token every other eyebrow on a dark block uses (5.68:1).
       #8fe8f2 was a one-off tuned to the retired panel gradient. */
    color: var(--teal-light); margin-bottom: 14px;
}
.ba-pilot__title {
    font-family: var(--font-display); font-size: clamp(1.8rem, 3vw, 2.5rem); line-height: 1.12;
    margin: 0 0 16px; color: #fff;
}
.ba-pilot__text { font-family: var(--font-body); font-size: 1.04rem; line-height: 1.6; color: rgba(240,250,250,0.86); margin: 0 0 22px; }
.ba-pilot__list { list-style: none; margin: 0; padding: 0; display: grid; gap: 12px; }
.ba-pilot__list li {
    font-family: var(--font-body); font-size: 0.98rem; color: rgba(240,250,250,0.92);
    display: flex; align-items: flex-start; gap: 11px;
}
.ba-pilot__check {
    flex: none; width: 22px; height: 22px; border-radius: 50%;
    background: rgba(143,232,242,0.18); color: #8fe8f2;
    display: flex; align-items: center; justify-content: center; margin-top: 1px;
}
.ba-pilot__check svg { width: 13px; height: 13px; }
/* Schedule mock */
.ba-sched { background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.14); border-radius: var(--radius-lg); padding: 24px; backdrop-filter: blur(6px); }
.ba-sched__row { display: flex; align-items: center; justify-content: space-between; padding: 13px 0; border-bottom: 1px solid rgba(255,255,255,0.1); }
.ba-sched__row:last-child { border-bottom: 0; }
.ba-sched__label { font-family: var(--font-body); font-size: 0.86rem; color: rgba(240,250,250,0.7); }
.ba-sched__value { font-family: var(--font-body); font-size: 0.92rem; font-weight: 600; color: #fff; }
.ba-sched__days { display: flex; gap: 6px; }
.ba-sched__day {
    width: 30px; height: 30px; border-radius: 8px; display: flex; align-items: center; justify-content: center;
    font-family: var(--font-body); font-size: 0.74rem; font-weight: 700;
    background: rgba(255,255,255,0.08); color: rgba(240,250,250,0.55);
}
.ba-sched__day.is-on { background: #8fe8f2; color: var(--block-dark); }
.ba-sched__toggle { width: 42px; height: 24px; border-radius: 999px; background: #8fe8f2; position: relative; }
.ba-sched__toggle::after { content: ''; position: absolute; top: 3px; right: 3px; width: 18px; height: 18px; border-radius: 50%; background: var(--block-dark); }

/* ---- Plans row: unboxed figures --------------------------------------
   ⚠️ THIS IS NOT THE PRICING TABLE AND MUST NOT BECOME ONE. It is four figures
   answering "how many posts", not four offers to compare — the plan comparison lives
   on the homepage. Boxing them is exactly what the pricing pass removed: "the moment
   a border or a panel appears they become three offers standing side by side".

   `.ba-plan--pilot`'s tinted border goes with the box. The `+ Autopilot` pill already
   says which plans have it, and says it in words. */
.ba-plans__grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: clamp(20px, 2.6vw, 32px); }
.ba-plan { text-align: center; }
.ba-plan__name { font-family: var(--font-body); font-weight: 700; font-size: 0.92rem; letter-spacing: 0.02em; text-transform: uppercase; color: var(--text-muted); }
.ba-plan__count { font-family: var(--font-display); font-size: 3rem; line-height: 1; color: var(--teal-deep); margin: 12px 0 4px; }
.ba-plan__unit { font-family: var(--font-body); font-size: 0.9rem; color: var(--text-secondary); }
.ba-plan__pilot {
    display: inline-block; margin-top: 14px; font-family: var(--font-body); font-size: 0.72rem; font-weight: 700;
    /* --teal-text: 4.06:1 on the pale-teal pill at 0.72rem failed AA. */
    letter-spacing: 0.03em; text-transform: uppercase; color: var(--teal-text);
    background: var(--teal-pale); padding: 4px 10px; border-radius: 999px;
}
.ba-plans__foot { text-align: center; margin-top: 26px; font-family: var(--font-body); font-size: 0.95rem; color: var(--text-muted); }

/* ---- Final CTA: a dark block into the footer ---------------------------
   Was a bordered warm-white card with its own radial teal wash, floating on cream —
   the "bordered CTA card" the subpage audit lists as a system break, and the third
   copy of it after page-industry.php and page-salesforce.php. The page now ends on
   the dark the footer sits under. `.block--dark` + `.block-statement` do the
   background, the white type and the centring. */
.ba-cta__title { font-family: var(--font-display); font-size: clamp(2rem, 3.6vw, 2.9rem); line-height: 1.1; margin: 0 0 14px; color: #fff; }
.ba-cta__text { font-family: var(--font-body); font-size: 1.1rem; color: rgba(240,250,250,0.8); margin: 0 auto 30px; max-width: 52ch; }

/* ---- The curtain bracket. Scoped `.feature-page`, NOT generalised to `main`:
   the homepage's two curtained sections add the seam's height in their own rules,
   so a general selector would double it, decided by (0,1,2) vs (0,2,0). */
.feature-page > section:has(> .seam-curtain) { position: relative; }
.feature-page > section:has(> .seam-curtain--open) {
    padding-bottom: calc(var(--block-pad-light) + clamp(53px, 6.65vw, 114px));
}
.feature-page > section:has(> .seam-curtain--close) {
    padding-top: calc(var(--block-pad-light) + clamp(53px, 6.65vw, 114px));
}

/* Responsive */
@media (max-width: 980px) {
    .ba-hero__grid { grid-template-columns: 1fr; }
    .ba-hero__visual { max-width: 460px; margin: 8px auto 0; }
    .ba-flow__grid { grid-template-columns: repeat(2, 1fr); }
    .ba-features__grid { grid-template-columns: 1fr; }
    .ba-pilot__panel { grid-template-columns: 1fr; }
    .ba-plans__grid { grid-template-columns: repeat(2, 1fr); }
    /* Autopilot schedule card: give the days room once the panel stacks. */
    .ba-sched { width: 100%; }
    .ba-sched__row { flex-wrap: wrap; gap: 4px 12px; }
    .ba-sched__row--days { flex-direction: column; align-items: stretch; gap: 12px; }
    .ba-sched__days { width: 100%; justify-content: space-between; }
    .ba-sched__day { flex: 1 1 0; max-width: 40px; }
}
@media (max-width: 560px) {
    .ba-flow__grid { grid-template-columns: 1fr; }
    .ba-float { display: none; }
    .ba-hero__actions { flex-direction: column; align-items: stretch; }
    .ba-hero__actions .btn { justify-content: center; }
    .ba-sched { padding: 20px; }
}
    </style>
</head>
<body <?php body_class( 'ba-page sitestaffr-blog-agent-page' ); ?>>
<?php wp_body_open(); ?>

<?php get_template_part( 'template-parts/site-nav' ); ?>

<main class="feature-page">

    <!-- Hero -->
    <section class="block block-split ba-hero">
        <div class="block__inner">
            <div class="block-split__grid ba-hero__grid">
                <div class="ba-hero__content reveal">
                    <span class="ba-hero__eyebrow">Included in every plan</span>
                    <h1 class="ba-hero__title">Your Website Writes Its&nbsp;<em>Own Blog</em></h1>
                    <p class="ba-hero__sub">Blog Agent is an AI content writer built into SiteStaffr. It researches your site, writes SEO-optimized posts grounded in your business, and saves each one as a draft for your review.</p>
                    <div class="ba-hero__actions">
                        <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn btn--primary btn--large">
                            Get Started
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                        <a href="#ba-how" class="ba-hero__seclink">
                            See how it works
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
                        </a>
                    </div>
                    <p class="ba-hero__note">Free for 30 days &bull; No credit card required</p>
                </div>

                <div class="ba-hero__visual reveal">
                    <span class="ba-float ba-float--a" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
                        Reading your pages
                    </span>
                    <span class="ba-float ba-float--b" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>
                        SEO optimized
                    </span>
                    <span class="ba-float ba-float--c" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                        Draft ready
                    </span>

                    <div class="ba-draft">
                        <div class="ba-draft__bar">
                            <span class="ba-draft__dot"></span><span class="ba-draft__dot"></span><span class="ba-draft__dot"></span>
                            <span class="ba-draft__chip-status">Draft &middot; ready for review</span>
                        </div>
                        <div class="ba-draft__hero">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.1-3.1a2 2 0 0 0-2.8 0L6 21"/></svg>
                        </div>
                        <div class="ba-draft__body">
                            <div class="ba-draft__pills">
                                <span class="ba-draft__pill">Your Category</span>
                            </div>
                            <h2 class="ba-draft__title">5 Questions to Ask Before Your First Visit</h2>
                            <div class="ba-draft__lines">
                                <span class="ba-draft__line ba-draft__line--full"></span>
                                <span class="ba-draft__line ba-draft__line--long"></span>
                                <span class="ba-draft__line ba-draft__line--mid"></span>
                            </div>
                            <div class="ba-draft__meta">
                                <span class="ba-draft__tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.5.5l3-3a5 5 0 0 0-7-7l-1.7 1.6"/><path d="M14 11a5 5 0 0 0-7.5-.5l-3 3a5 5 0 0 0 7 7l1.7-1.6"/></svg> Internal links</span>
                                <span class="ba-draft__tag">FAQ</span>
                                <span class="ba-draft__tag">Schema</span>
                                <span class="ba-draft__tag">Featured image</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How it works -->
    <section class="block block-cards ba-section ba-flow" id="ba-how">
        <div class="block__inner">
            <div class="ba-section__head reveal">
                <span class="section-label">How it works</span>
                <h2 class="ba-section__title">From a topic to a polished draft</h2>
                <p class="ba-section__lead">Give Blog Agent a topic &mdash; or let it suggest one &mdash; and it handles the rest in four steps, then hands you a finished draft.</p>
            </div>
            <div class="ba-flow__grid reveal">
                <?php foreach ( $ba_pipeline as $step ) : ?>
                    <div class="ba-step">
                        <div class="ba-step__icon" aria-hidden="true"><?php echo $step['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static inline SVG ?></div>
                        <h3 class="ba-step__title"><?php echo wp_kses_post( $step['title'] ); ?></h3>
                        <p class="ba-step__desc"><?php echo wp_kses_post( $step['desc'] ); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Why it's different -->
    <section class="block block-cards ba-section ba-features">
        <div class="block__inner">
            <div class="ba-section__head reveal">
                <span class="section-label">Why it&rsquo;s different</span>
                <h2 class="ba-section__title">Not just another AI writer</h2>
                <p class="ba-section__lead">Most AI tools produce generic content you have to fact-check and reformat. Blog Agent writes from your actual business and hands you publish-ready drafts.</p>
            </div>
            <div class="ba-features__grid reveal">
                <?php foreach ( $ba_features as $feature ) : ?>
                    <div class="ba-card">
                        <div class="ba-card__icon" aria-hidden="true"><?php echo $feature['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static inline SVG ?></div>
                        <div>
                            <h3 class="ba-card__title"><?php echo wp_kses_post( $feature['title'] ); ?></h3>
                            <p class="ba-card__desc"><?php echo wp_kses_post( $feature['desc'] ); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php /* OPEN: the dark run rises out of the cream. Direct child of the SECTION,
                 not of .block__inner — the inner is width-capped, so inside it the
                 curtain would stop short of both edges on a full-bleed boundary. */ ?>
        <?php get_template_part( 'template-parts/seam-curtain' ); ?>
    </section>

    <?php /* ---- AUTOPILOT: the page's one dark run ------------------------
             Was a dark rounded card floating on warm-white, in a three-stop gradient
             matching nothing else on the site. Full-bleed now, bracketed by the
             curtain pair. */ ?>
    <!-- Autopilot -->
    <section class="block block--dark block-split ba-pilot">
        <div class="block__inner">
            <div class="ba-pilot__panel reveal">
                <div class="ba-pilot__copy">
                    <span class="ba-pilot__eyebrow">Autopilot &mdash; Business &amp; Pro</span>
                    <h2 class="ba-pilot__title">Set it once. Publish on schedule.</h2>
                    <p class="ba-pilot__text">Turn on Autopilot and Blog Agent works through a queue of topics on the days and time you choose &mdash; publishing automatically, or saving drafts for you to approve.</p>
                    <ul class="ba-pilot__list">
                        <li><span class="ba-pilot__check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></span> Pick your publish days and time</li>
                        <li><span class="ba-pilot__check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></span> Auto-publish, or keep everything as drafts</li>
                        <li><span class="ba-pilot__check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></span> Always within your monthly post allowance</li>
                    </ul>
                </div>
                <div class="ba-sched" aria-hidden="true">
                    <div class="ba-sched__row">
                        <span class="ba-sched__label">Publish days</span>
                        <span class="ba-sched__days">
                            <span class="ba-sched__day">S</span>
                            <span class="ba-sched__day">M</span>
                            <span class="ba-sched__day is-on">T</span>
                            <span class="ba-sched__day">W</span>
                            <span class="ba-sched__day is-on">T</span>
                            <span class="ba-sched__day">F</span>
                            <span class="ba-sched__day">S</span>
                        </span>
                    </div>
                    <div class="ba-sched__row">
                        <span class="ba-sched__label">Time (ET)</span>
                        <span class="ba-sched__value">9:00 AM</span>
                    </div>
                    <div class="ba-sched__row">
                        <span class="ba-sched__label">Auto-publish</span>
                        <span class="ba-sched__toggle"></span>
                    </div>
                    <div class="ba-sched__row">
                        <span class="ba-sched__label">This month</span>
                        <span class="ba-sched__value">2 of 4 posts</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Plans -->
    <section class="block block-cards ba-section ba-plans">
        <?php /* CLOSE: the same curve mirrored, so the pair brackets the dark run as
                 ONE gesture. ⚠️ If either path is edited, mirror the other. */ ?>
        <?php get_template_part( 'template-parts/seam-curtain', null, array( 'variant' => 'close' ) ); ?>
        <div class="block__inner">
            <div class="ba-section__head reveal">
                <span class="section-label">Posts per plan</span>
                <h2 class="ba-section__title">Content that scales with you</h2>
                <p class="ba-section__lead">Every plan includes Blog Agent. Your monthly post count grows as you do &mdash; with suggested topics always ready to go.</p>
            </div>
            <div class="ba-plans__grid reveal">
                <?php foreach ( $ba_plans as $plan ) : ?>
                    <div class="ba-plan<?php echo ! empty( $plan['pilot'] ) ? ' ba-plan--pilot' : ''; ?>">
                        <div class="ba-plan__name"><?php echo esc_html( $plan['name'] ); ?></div>
                        <div class="ba-plan__count"><?php echo esc_html( $plan['count'] ); ?></div>
                        <div class="ba-plan__unit"><?php echo esc_html( $plan['unit'] ); ?></div>
                        <?php if ( ! empty( $plan['pilot'] ) ) : ?>
                            <span class="ba-plan__pilot">+ Autopilot</span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <p class="ba-plans__foot">Need more? Higher plans unlock more posts and hands-off Autopilot publishing.</p>
        </div>
    </section>

    <!-- FAQ -->
    <?php /* ⚠️ `.faq-section__head`, NOT `__header` — the `__header` spelling has no
             rule anywhere in site.css, so this header was rendering unstyled. */ ?>
    <section class="block faq-section" id="faq">
        <div class="block__inner">
            <div class="faq-section__head reveal">
                <span class="section-label">Common Questions</span>
                <h2>Blog Agent FAQ</h2>
            </div>
            <div class="faq-list reveal">
                <?php foreach ( $ba_faqs as $faq ) : ?>
                    <div class="faq-item">
                        <button class="faq-item__question" type="button" aria-expanded="false">
                            <?php echo wp_kses_post( $faq['q'] ); ?>
                            <span class="faq-item__icon" aria-hidden="true"></span>
                        </button>
                        <div class="faq-item__answer">
                            <div class="faq-item__answer-inner"><?php echo wp_kses_post( $faq['a'] ); ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="block block--dark ba-cta">
        <div class="block__inner block-statement">
            <div class="ba-cta__inner reveal">
                <h2 class="ba-cta__title">Give your website a content engine</h2>
                <p class="ba-cta__text">Start free for 30 days and let Blog Agent write your first post &mdash; grounded in your business, ready for your review.</p>
                <a href="<?php echo esc_url( $get_started_url ); ?>" class="btn ba-cta__btn">
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
