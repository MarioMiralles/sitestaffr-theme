# Implementation notes

Why the PHP and JavaScript in this theme is the way it is.

These notes used to live as long comments inside the source files. They were moved here so the
code reads as code; each site keeps a short summary and a link to the full note. Headings are
grouped by file, and named for the function, hook or element the note belongs to.

Most of these are constraints rather than history: they explain what breaks if something moves.

---

# `assets/js/demo-timings.js`

## `SECTION 3 DEMO — SINGLE SOURCE OF TRUTH FOR TIMING AND SCRIP`
<a id="section-3-demo-single-source-of-truth-for-timi"></a>

SECTION 3 DEMO — SINGLE SOURCE OF TRUTH FOR TIMING AND SCRIPT.

─────────────────────────────────────────────────────────────────────────────
WHEN THE AUTO-REPAIR RECORDING ARRIVES, THIS IS THE ONLY FILE THAT CHANGES.
─────────────────────────────────────────────────────────────────────────────

is recording it LAST, after the rest of the redesign is built.
It needs a sandbox tenant first, and the sandbox needs config export/restore before
"shelve the beauty clinic and build auto repair" is a real workflow rather than a
delete-and-rebuild. That is the longest pole on the page and it is not website work.

So nothing in site.js hardcodes a timestamp, a speaker or a line of script. To land
the recording: drop the file in, re-time `voice.turns[].t` against it, set
`voice.src` and `voice.duration`, flip `voice.enabled` to true, and change
DEFAULT_MODE to 'voice'. No markup or CSS changes, no mechanism changes.

WHY TEXT SHIPS FIRST. The spec says voice leads, and it should: section 3's currency
is credibility, a chat transcript is trivially fakeable, and almost nobody has heard a
website answer out loud. But the text thread drives the IDENTICAL live-fill mechanism,
so shipping it first means the section argues completely on day one instead of sitting
behind a blocker. `voice` below is scaffolding, deliberately marked disabled.

⚠️ THERE IS NO FIXED RECAP SCHEMA. Each turn's optional `fill` carries a label AND a
value, and they materialise together as a pair. The product builds each recap
intelligently — sometimes a name only, sometimes a name and an email, sometimes a name
and a phone. A pre-drawn skeleton of grayed labels would be a picture of a form the
product does not have. Note the two threads below capture DIFFERENT fields, and that
difference is load-bearing, not incidental.

⚠️ BOTH THREADS END WITH DETAILS CAPTURED AND A HUMAN FOLLOWING UP — no appointment is
confirmed. SiteStaffr gathers leads; it does not hold a calendar. A demo that books
something is a demo of a product we do not sell.

---

# `assets/js/manage.js`

## `setView()`
<a id="setView"></a>

SiteStaffr Billing Hub — /manage page logic.

State machine:
loading → check URL params / sessionStorage
→ has token param?    → verify magic link → authenticated
→ has session in storage? → fetch account state → authenticated
→ neither?            → unauthenticated

Views (toggled via data-view on #hub):
loading | site-picker | unauthenticated | authenticated | error

---

## `verifyMagicLink()`
<a id="verifyMagicLink"></a>

⚠️ 'cancelled', DOUBLE-L, AND IT IS NOT A SPELLING MISTAKE. This compares against
 a query parameter the MIDDLEWARE builds: routes/hub.js sets
 `${manageBaseUrl}?checkout=cancelled` on the Stripe cancel_url. It is a wire value
 in another repo, not prose — Americanising it here silently kills the cancel
 banner, because the redirect still arrives spelled the other way. The visible
 TEXT below is American; the value it matches on cannot be.

---

# `assets/js/site.js`

## `FAQ ACCORDION ========== ONE OPEN AT A TIME, AND ALL OF THEM`
<a id="faq-accordion-one-open-at-a-time-and-all-of-th"></a>

========== FAQ ACCORDION ==========
ONE OPEN AT A TIME, AND ALL OF THEM CAN BE CLOSED. The logic here
was already correct; what was broken was the CLASS NAME. This toggled a bare `open`
while the PHP rendered `faq-item--open` on the first question and the stylesheet
carried rules for BOTH — so the first answer was pinned open by a class this code
never looked at, and clicking another question left two open at once.

Everything now agrees on `faq-item--open`. Nothing ships open; `aria-expanded` moves
with the class so the state is announced, not just drawn.

---

## `SECTION 3 — "See it answer": the live-fill demo.`
<a id="section-3-see-it-answer-the-live-fill-demo"></a>

===================================================================
SECTION 3 — "See it answer": the live-fill demo.

THE ONE RULE THIS FILE MUST NOT BREAK: the panels are rendered FULLY
POPULATED by PHP. This script only empties them when it is certain it is
going to refill them. If the script never runs, throws, or the visitor
prefers reduced motion, the section stays complete and readable.

---

## `chime()`
<a id="chime"></a>

THE OPEN CHIME. assets/audio/open.mp3 is the widget's own open sound, so pressing
the stage button sounds like the widget opening on a real site — which is exactly
what the panels then show. It is the ONE audio cue here: text mode has `src: null`
because a typed thread drives itself off a clock, so without this the section is
silent.

⚠️ IT IS PLAYED ONLY FROM A CLICK, and that is not a style choice. Browsers block
audio that is not user-initiated; firing this anywhere else produces a rejected
promise and, in some browsers, a console error on a page that looks fine. The
.catch is not optional either — a blocked or missing file must not take the
animation down with it, because the sound is the garnish and the demo is the point.

---

## `SECTION 4 — the overnight inbox opens its recap documents.`
<a id="section-4-the-overnight-inbox-opens-its-recap"></a>

===================================================================
SECTION 4 — the overnight inbox opens its recap documents.

⚠️ `.is-interactive` IS ADDED LAST, AFTER EVERYTHING IS WIRED, and the CSS
hangs the entire affordance off it — pointer cursor, hover, the "View recap"
hint. If <dialog> is unsupported or anything here throws, the class is never
added and the rows read as the plain inbox they were before. A button that
looks clickable and does nothing is worse than one that never offered.

showModal, never show: the focus trap, Esc-to-close, the ::backdrop and
the top layer are all things the modal mode provides and the non-modal mode
does not.
===================================================================

---

## `SECTION 5 — the language orbit has NO SCRIPT, deliberately.`
<a id="section-5-the-language-orbit-has-no-script-del"></a>

===================================================================
SECTION 5 — the language orbit has NO SCRIPT, deliberately.

The `lang` and `dir` attributes that handler had to maintain by hand are now
rendered once per greeting straight from $lang_greetings. That was the
fiddliest part of the removed code and the part most likely to go wrong; it
is now impossible to get out of sync, because nothing mutates it.

Do not re-add a script to animate the chips. The float is a CSS keyframe
with a per-item delay and it already respects prefers-reduced-motion.
===================================================================

---

## `openFirstOnMobile()`
<a id="openFirstOnMobile"></a>

⚠️ ONE ROW STARTS OPEN ON A PHONE, AND IT IS THE FIRST ONE, NOT THE FEATURED ONE.
Closed, this section is sixteen bare names: the picture and the one-line answer that
are its entire payload sit behind a tap nobody has a reason to make. Desktop
preselects an industry for exactly that reason, and this is the same decision.

$ind_first's random pick (see page-landing.php) stays the desktop behavior and is
deliberate. Honoring it here would open a row twelve deep and leave the top of the
section bare, which is the problem this is solving. On a phone every name is on
screen as text anyway, so the section never reads as being "about" whichever
industry happens to be open.

---

# `functions.php`

## `add_action( 'send_headers' )`
<a id="hook-send-headers"></a>

Purge cached HTML once per theme version.

The site sits behind LiteSpeed. An FTP deploy changes templates but nothing
WordPress calls "content", so no invalidation fires and visitors keep the old
markup. Assets escape this via the filemtime query string; markup does not.
Bumping style.css "Version:" is therefore what publishes a template change.

Uses the X-LiteSpeed-Purge response header, which the web server acts on
directly; the plugin action alone does not clear the cache from here and is
fired only as a second path. The version is recorded after the header goes
out, so a failed purge retries on the next request.

---

## `sitestaffr_heal_post_title()`
<a id="sitestaffr-heal-post-title"></a>

Two separate problems, one call.
1. Provisioners set post_title only inside wp_insert_post, so a page created before the
registry existed keeps its original title forever while every other managed field is
rewritten on each version bump.
2. Yoast does not read post meta at render time. It caches a derived row per post in its
own indexable table — breadcrumb title, SEO title, social titles — and only rebuilds
it when the post is saved. So writing `_yoast_wpseo_*` meta or deleting an override
updates the source of truth while the served output keeps coming from the stale row.
That second point is why this call is deliberately unconditional. An earlier version
skipped the update when post_title already matched, which looked like a sensible
optimization and was in fact the bug: on three pages post_title was already correct, the
update was skipped, save_post never fired, and the BreadcrumbList kept serving
"AI Voice Agent for Dental Practices" through two further fixes that each looked like
they had failed. Nothing here runs per-request — the caller is version-gated and returns
early unless the provision version changed — so this is a handful of saves once per bump.
Only post_title is passed, so post_name (and the live URL) is untouched.

---

## `sitestaffr_clear_yoast_title_overrides()`
<a id="sitestaffr-clear-yoast-title-overrides"></a>

Yoast keeps Open Graph, Twitter and breadcrumb titles in meta keys separate
from `_yoast_wpseo_title`. Writing the SEO title alone leaves those overrides
serving old copy, so the tab and Google update while a social share does not.
Deleting rather than rewriting keeps one source of truth. Safe on every page:
only overrides that exist are touched.

---

## `sitestaffr_plugin_info()`
<a id="sitestaffr-plugin-info"></a>

The zip served here is the direct-download build, which self-updates from
sitestaffr.com; the WordPress.org build cannot, since directory guideline 8
forbids it. Reading our own manifest rather than api.wordpress.org keeps the
download page working even if the .org listing goes away.

---

## `$is_about`
<a id="is-about"></a>

site.css is the theme's stylesheet, so every front-end view gets it.

Deliberately ungated. An earlier allowlist of conditionals meant any view it
did not anticipate rendered with no CSS at all, which fails silently: the page
returns 200 and simply looks broken. wp_enqueue_scripts only fires on the front
end, so the guard protected nothing.

The per-template flags below are a genuine allowlist; they add assets to
specific pages rather than subtracting the baseline.

---

## `Section 3's demo script and timings.`
<a id="section-3-s-demo-script-and-timings"></a>

Section 3's demo script and timings. Landing page only — no other template has
the panels, and loading the timings elsewhere would be dead weight.

Kept separate from site.js on purpose: the demo timings change whenever a new
recording lands, and that change should never touch the file driving the nav,
the FAQ and the accordion.

---

## `add_action( 'init' )`
<a id="hook-init"></a>

Provision the homepage's search title and description.

Kept in code rather than wp-admin so the homepage's search listing is reviewable
in git like every other page. Title tags carry search vocabulary rather than brand
vocabulary, which is why they use words the hero deliberately avoids.

Bump $provision_version to re-apply after an edit.

---

## `add_action( 'init' )`
<a id="hook-init-2"></a>

Provision the /blog-agent marketing page and its SEO metadata.

Guarded by a versioned option so it runs once per bump; bumping the version
re-runs it to heal an existing page. The page never has to be created by hand.

---

## `add_action( 'init' )`
<a id="hook-init-3"></a>

Provision /for/agencies/ — the second-audience page.

Same versioned-option pattern as the Salesforce and industry pages; a bump re-heals
the page if someone edits it by hand.

Must stay a CHILD of the "for" parent so the URL is /for/agencies/, which is what the
nav item and the section 10 CTA link to. A top-level /agencies/ page renders fine at
the wrong URL and leaves both of those links 404.

Agencies are deliberately NOT in sitestaffr_industry_registry: they are an audience,
not an industry, and adding them there would file them in the homepage industry list
and the Industries dropdown.

---

## `sitestaffr_industry_registry()`
<a id="sitestaffr-industry-registry"></a>

To add an industry: add an entry here, add its content to the $industries array
in page-industry.php under the same slug, and bump $provision_version. Its
category hub picks it up automatically.
To add a category: add a group here and bump $provision_version. The hub page,
footer link and /for/ index section all come from that one entry.
Industry fields: slug, title, label (defaults to title), icon, blurb, llms,
seo_title, metadesc.
Group fields: heading, slug, icon, seo_title, metadesc, intro.
Category and industry slugs share the /for/ namespace and must not collide.

---

## `Filed under Health & Medical even though it is B2B: the five`
<a id="filed-under-health-medical-even-though-it-is-b"></a>

Filed under Health & Medical even though it is B2B: the five groups are
 a browse aid rather than a taxonomy, so it belongs under the word people
 would look for.

 Note the homepage's industry count is derived from this registry, so
 adding an entry moves that number on its own. The plugin's "Great For"
 list lives in a separate repo and is not updated from here.

---

## `sitestaffr_industry_category()`
<a id="sitestaffr-industry-category"></a>

Flat industry list for the consumers that don't care about grouping
(footer, llms.txt, page provisioning). Each entry gains a resolved 'label'.

@return array<int,array<string,mixed>>

---

## `sitestaffr_industry_category()`
<a id="sitestaffr-industry-category-2"></a>

Used by the category hub template to work out which group it is rendering
from the page it was assigned to, so one template serves all categories.

---

## `sitestaffr_industry_categories()`
<a id="sitestaffr-industry-categories"></a>

For the footer and any other nav that wants the five categories rather than
all fifteen industries.

---

## `sitestaffr_industry_art_thumb_url()`
<a id="sitestaffr-industry-art-thumb-url"></a>

The full 1024px hero art in assets/images/industries/ is what page-industry.php
puts at the top of each landing page; thumbs/ holds the trimmed-and-shrunk
version the card grids use, so the /for/ index isn't fifteen full heroes.
Optional by design: an industry added to the registry before its art is drawn
falls back to its emoji rather than rendering a broken image.

---

## `sitestaffr_industry_art_url()`
<a id="sitestaffr-industry-art-url"></a>

The 1024x1024 originals rather than the thumbs: section 6 renders them at ~440px on
desktop and ~200px inside the mobile accordion, and the thumb set is sized for the
small card grids on /for/.
Returns '' when the file is absent, exactly like the thumb helper, and callers are
expected to branch on that. An industry can be added to the registry before its art
exists, so empty is a real state: degrade to something deliberate, never to a
broken-image box.

---

## `add_action( 'init' )`
<a id="hook-init-4"></a>

Provision the /for/<slug> industry landing pages and their SEO metadata from
the registry above.

Same versioned-option pattern as the Blog Agent and Salesforce pages: ensures
the parent "For" index page exists, then creates or heals each child. Bump
$provision_version to re-run against existing pages.

---

## `$provision_version`
<a id="provision-version"></a>

⚠️ BUMPED 11 -> 12 TO CREATE /for/medical-staffing/, WHICH 404ed ON PRODUCTION.
Medical Staffing was added to the registry above without bumping this, so the
guard below returned early on every request and the page was never inserted. The
industry still appeared everywhere the registry drives — the Industries dropdown,
the homepage picker, the /for/ hub, its own Yoast title and description — all
pointing at a URL that did not exist.

⚠️ THIS IS THE SECOND HALF OF THE FIX AND NEITHER HALF WORKS ALONE. The other is
the missing content array in page-industry.php: with the array and no page you get
a 404 from WordPress, and with the page and no array you get one from the template
guard. Adding an industry is therefore always three edits — registry, array,
version — and only the first two are anywhere near each other in the code.

⚠️ ADDING AN INDUSTRY IS NOT THE ONLY THING THIS GATE CATCHES. It also gates the
SEO healing for all sixteen pages, so any registry edit to a seo_title or metadesc
is equally inert until this number moves.

---

## `sitestaffr_read_time()`
<a id="sitestaffr-read-time"></a>

Shown in the blog hero and on every index card. 225 wpm is the usual figure
for online prose.

---

## `sitestaffr_blog_toc()`
<a id="sitestaffr-blog-toc"></a>

Returns array( 'content' => string, 'items' => array of id/text ).
Headings that already carry an id keep it — post HTML is hand-pasted from
docs/blog-posts/ and some of it is already anchored.

---

## `add_action( 'after_setup_theme' )`
<a id="hook-after-setup-theme"></a>

16:9 crops of the blog featured images.

Every featured image published here is 1024x1024 and the blog templates are 16:9
throughout, so the existing images are cropped rather than regenerated; the ratio
is fixed upstream in the Blog Agent's image settings for everything after that.

A centre crop was checked against the whole set first: none loses its subject, and
several improve, because what it removes is garbled generated text along the top.

`true` = hard crop, centred.

⚠️ THE DIMENSIONS MUST FIT INSIDE THE SOURCE OR THE RATIO IS SILENTLY WRONG.
WordPress does NOT return a smaller correct crop when the target is bigger than
the source — it clamps the width and KEEPS the requested height. Probed against
`image_resize_dimensions` with a 1024x1024 source:

target 1600x900 -> 1024x900  (ratio 1.138)  <-- not 16:9 at all
target 1200x675 -> 1024x675  (ratio 1.517)  <-- not 16:9
target 1024x576 -> 1024x576  (ratio 1.778)  correct
target  800x450 ->  800x450  (ratio 1.778)  correct

1600x900 was the obvious first choice and it shipped a 1.14 crop that the CSS
then cropped AGAIN, losing twice as much of the picture. Both values below fit
inside 1024x1024, which is why they are the sizes they are.

👉 When the Blog Agent starts emitting 1920x1080, raise the hero to 1600x900 —
it becomes valid at that point and the hero renders at 1100 CSS px, so 1024 is
currently just under 1x.

⚠️ These sizes only exist for images uploaded AFTER this ships. Existing posts
need `wp media regenerate --only-missing`. Until that runs the templates fall
back to the full square and `.blog-post__figure`'s own `aspect-ratio: 16/9`
still crops it visually — so the page looks correct either way, and
regeneration is a payload/quality win rather than a prerequisite.

---

# `page-agencies.php`

## `/for/agencies/ — the second audience.`
<a id="for-agencies-the-second-audience"></a>

/for/agencies/ — the second audience.

SiteStaffr has two audiences: small businesses and the WordPress agencies that build
their sites. They are deliberately not blended into one page. The homepage stays
written to the business owner, which is what user testing rewarded; agencies get a nav
item, one band on the homepage, and this page, where the whole argument is theirs.

Its own template, not page-industry.php. Agencies are an audience, not an industry, and
must not be added to sitestaffr_industry_registry — that would file them in the
homepage industry list and the Industries dropdown.

Tone differs from the homepage on purpose: shorter sentences, more specifics, numbers
over adjectives, no softening.

⚠️ Every claim here is verified against the code, and the false ones are named as false
rather than omitted. There is no reseller pricing, no white-label, no bulk billing and
no cross-client lead view. This is the audience that checks.

Yoast owns title and meta, as everywhere else on this site. No hardcoded meta here.

---

## `$agency_faq`
<a id="agency-faq"></a>

Its own FAQPage schema, and ⚠️ NOT ONE QUESTION IS SHARED WITH THE HOMEPAGE. Duplicate
Q&A across two URLs makes the two URLs compete with each other, and Google requires
schema to match visible content — which the generate-from-one-array pattern satisfies.

Questions 4, 5 and 6 have "no" answers and they STAY. They are what this audience
searches for. A truthful "not yet, here is what exists, tell us what you need" ranks and
converts better than silence, and it prevents the bounce that follows a page which
dodged the question.

---

## `.block`
<a id="block"></a>

===== 3. WHAT IT TAKES PER SITE ====================================
   Dark panel — the mid-page emphasis. This is the concrete answer to "how much of
   my time does this cost", which is the question that actually decides adoption.

   ⚠️ DO NOT CLAIM ZERO CONFIGURATION. The business profile is real work, and an
   agency that expects five minutes and finds thirty will say so publicly. Five
   minutes is the INSTALL; configuration is the billable part, and section 2 already
   framed it that way. Consistency between those two sections is what makes this
   page trustworthy to a technical reader.

---

## `.block`
<a id="block-2"></a>

===== 4. WHO PAYS, AND HOW BILLING WORKS ===========================
   THIS IS THE AGENCY QUESTION and no page on the site answered it.

   ⚠️ SCOPE EVERY "ONE PLACE" PHRASE TO BILLING. The lead dashboard is per-site,
   inside each client's own wp-admin. If this page implies a cross-client inbox, the
   first agency to sign up finds out in ten minutes.

---

## `.block`
<a id="block-3"></a>

===== 5. WHAT YOU CAN SHOW AT RENEWAL ==============================
   Reuses the homepage's recap surface, framed for a different reader. On the
   homepage it is "what lands in YOUR inbox"; here it is "what you put in front of
   your client".

   ⚠️ A STATIC RECAP IS CORRECT HERE. The homepage's live-fill is not needed and
   would be the wrong argument: there the point is the MECHANISM (you hear him say
   the number and the number appears), here the point is the ARTIFACT.

---

## `.block`
<a id="block-4"></a>

===== 6. PRICING, AND THE PARTNER QUESTION =========================
   The homepage's own table would be reused verbatim here in a later pass; for now
   one line scopes it and links to it, because duplicating a 300-line table across
   two templates is how they drift apart.

   THE PART MOST VENDORS WOULD HIDE IS THE POINT OF THE SECTION. Three reasons, in
   order of value: it IS the demand-validation mechanism, so if this form generates
   volume that is the signal to build reseller pricing; a technical audience looks
   for a partner program within thirty seconds, and finding a page that IMPLIED one
   is disqualifying; and it converts a gap into an invitation.

---

# `page-blog-agent.php`

## `Pipeline: a V3 Cards block, UNBOXED ------------------------`
<a id="pipeline-a-v3-cards-block-unboxed-ba-flow-s-ow"></a>

---- Pipeline: a V3 Cards block, UNBOXED -------------------------------
⚠️ `.ba-flow`'S OWN --warm-white IS GONE. That white was section 1 of the
HOMEPAGE's tone, borrowed here to separate two sections; V3 separates with a dark
block or with whitespace, and one cream run is what the industry page converted to.

Card, border, shadow and hover-lift removed for the same reason as everywhere else
in this conversion: four steps in a sequence are not four offers side by side.
⚠️ `.ba-step__num` IS DELETED, MARKUP AND CSS — a 2.4rem numeral in --teal-pale
pinned to a card's top-right corner is legible only while the corner exists.

---

## `Autopilot: the page's one dark run -------------------------`
<a id="autopilot-the-page-s-one-dark-run-the-dark-rou"></a>

---- Autopilot: the page's one dark run --------------------------------
⚠️ THE DARK ROUNDED PANEL BECOMES THE BLOCK ITSELF. It was a card floating on
warm-white, painted in a THREE-STOP GRADIENT (#074651 -> #0a5a66 -> #064450) that
matched nothing else on the site — a fourth and fifth dark tone next to
--block-dark and --footer-dark. Full-bleed, bracketed by the curtain pair, it says
"this part matters" in the vocabulary the rest of the site already uses, and the
two retired tones go with it.

The panel keeps only its GRID. Background, radius, padding, shadow and the
text colour are `.block--dark`'s job now.

---

## `Plans row: unboxed figures ---------------------------------`
<a id="plans-row-unboxed-figures-this-is-not-the-pric"></a>

---- Plans row: unboxed figures --------------------------------------
⚠️ THIS IS NOT THE PRICING TABLE AND MUST NOT BECOME ONE. It is four figures
answering "how many posts", not four offers to compare — the plan comparison lives
on the homepage. Boxing them is exactly what the pricing pass removed: "the moment
a border or a panel appears they become three offers standing side by side".

`.ba-plan--pilot`'s tinted border goes with the box. The `+ Autopilot` pill already
says which plans have it, and says it in words.

---

## `Final CTA: a dark block into the footer --------------------`
<a id="final-cta-a-dark-block-into-the-footer-was-a-b"></a>

---- Final CTA: a dark block into the footer ---------------------------
Was a bordered warm-white card with its own radial teal wash, floating on cream —
the "bordered CTA card" the subpage audit lists as a system break, and the third
copy of it after page-industry.php and page-salesforce.php. The page now ends on
the dark the footer sits under. `.block--dark` + `.block-statement` do the
background, the white type and the centring.

---

## `⚠️ THE STACKED HERO CENTRES, AND THIS PAGE WAS THE ODD ONE O`
<a id="the-stacked-hero-centres-and-this-page-was-th"></a>

⚠️ THE STACKED HERO CENTRES, AND THIS PAGE WAS THE ODD ONE OUT. Checked at 390
across the whole converted set: the homepage and all six ind-* pages centre their
hero copy once the two columns become one; `/salesforce/` and `/blog-agent/` were
the only two still `start`, because the centring lives in `.ind-hero__content`'s
own 768 media query and these pages never had one. 768 to match that breakpoint.
⚠️ `.ba-hero__sub` needs `margin-inline: auto` as well as centred text — it is
capped at 38ch, so centring the text alone leaves the BOX hard against the left
gutter and the block reads as centred-inside-a-left-column.

---

# `page-for.php`

## `$industry_groups`
<a id="industry-groups"></a>

Template Name: Industries Index

The /for/ page. WordPress picks this up automatically for the page with slug
"for" (page-{slug} hierarchy), so no template assignment is needed.

Fifteen industry pages are otherwise reachable only from a dropdown and the
footer; this is their hub — one indexed page that links every one of them.

Industries come from sitestaffr_industry_registry() in functions.php — the one
source of truth shared with the nav, footer, llms.txt and page provisioning.

@package SiteStaffr

---

## `.block`
<a id="block"></a>

---- HERO: a V3 block, not a Split ---------------------------------
    `page-industry.php` uses `.block-split` because it has one isometric to
    put beside the copy. This hub has no art, so it is a plain block with a
    left-aligned copy column — the grid would have been an empty second
    column.

    ⚠️ `.block.ind-hero` gives this the SAME clamp(120px, 15vw, 140px) top as
    the converted industry page. The 88px it had before came from
    `.ind-page > section:not(.block)`, and next to a 140px sibling it read as
    the hub crowding the nav.

---

## `.ind-hero__subtitle`
<a id="ind-hero-subtitle"></a>

⚠️ THIS H1 WAS THE HOMEPAGE'S SECTION 6 H2, WORD FOR WORD.
       "Built for Businesses Where a Missed Message Is a Lost Customer"
       is still that section's heading, and having our own two pages
       compete for one phrase helps neither. It also never named the
       product: before this edit the /for/ hub did not contain
       "receptionist", "agent" or "assistant" anywhere in its body copy,
       so the page listing all sixteen industries never said what the
       thing being offered actually is.

       "Line of work" is picked up directly from the subtitle below it,
       which already ends "here's what that looks like in your line of
       work" — the hub's job is to route you to your own trade, and the
       H1 now says so.

---

## `.block`
<a id="block-2"></a>

---- DIRECTORY: ONE section holding five groups, not five sections ----
    ⚠️ THIS FIXES A LIVE REGRESSION, and it is the reason this page looked
    broken rather than merely unconverted. `.ind-problems__grid` was DELETED
    from site.css when `page-industry.php` moved its pain points onto
    `.block-cards__grid` — but this page and the five category hubs still
    carried the class, so twenty-one directory tiles were rendering as a
    full-width stack with no grid at all. A class that survives its rule
    fails silently: the markup still validates and the page still links
    everywhere it should.

    ⚠️ FIVE `<section>`s BECAME ONE. Each group used to be its own section,
    which on the V3 cream scale is 96px + 96px = 192px of empty cream
    between "Health & Medical" and "Beauty & Wellness". That padding exists
    to separate two different IDEAS on one cream run; five industry groups
    are one idea — a directory — and the page's whole job is to get a
    visitor to their own trade quickly. The group gap is its own smaller
    step now.

    The `<h2>` per group is kept, not demoted to `<h3>`: these five headings
    are the page's real structure and each one links to its category hub.

---

# `page-industry-category.php`

## `$sitestaffr_category`
<a id="sitestaffr-category"></a>

Template Name: Industry Category Hub

One template for every category hub at /for/<category-slug>/. The group is
resolved from the page's own slug, so adding a category is a registry entry
plus a provision bump — no new template, no new file.

These sit between the /for/ index and the fifteen industry pages: a shorter
list for a visitor who knows roughly what they do, and a stable home for
industries added later.

@package SiteStaffr

---

## `.block`
<a id="block"></a>

---- HERO: a V3 block, not a Split -----------------------------------
    Same reasoning as `/for/`: no isometric on a hub, so no second column.
    ⚠️ `.block.ind-hero` — TWO CLASSES. The padding is owned by
    `.block:not(.block--dark)` at (0,2,0) and a bare `.ind-hero` at (0,1,0)
    loses to it whatever the source order; `:not()` contributes its
    argument's specificity. Written as one class this changes nothing and
    looks correct in the diff.

---

## `.ind-hero__subtitle`
<a id="ind-hero-subtitle"></a>

⚠️ THE H1 IS REGISTRY COPY NOW, NOT A TEMPLATE PATTERN.

 It read "AI Voice and Text Agents for <heading>" on all five hubs. Two
 problems. The term is the one the V3 positioning superseded — the
 homepage H1 is "Put an AI Receptionist on Your Website" and these five
 pages were still naming the product the old way. And a pattern
 concatenated onto the group heading cannot read well for five different
 headings: "for Health & Medical" and "for Property & Auto" are category
 labels from a browse menu, not the words anyone would call their own
 business.

 Per-group copy fixes both — "Healthcare Practices", "Home Service
 Businesses", "Real Estate and Auto Businesses". The fallback keeps the
 old behaviour if a sixth group is ever added without an 'h1', so a
 missing field degrades to a heading rather than to a blank H1.

 ⚠️ 'h1' RENDERS FROM THE REGISTRY AT REQUEST TIME, so unlike seo_title
 and metadesc it is NOT behind $provision_version and needs no bump.
 Those two still are — see the note on that gate.

---

## `.block`
<a id="block-2"></a>

---- THE CATEGORY'S INDUSTRIES: a V3 Cards block --------------------
    ⚠️ `.ind-problems__grid` HAD NO RULE LEFT. It was deleted from site.css
    when the industry page's pain points moved onto `.block-cards__grid`,
    and these tiles kept the dead class — so the grid on all five hubs had
    silently collapsed to a full-width stack.

    ⚠️ THE TILES KEEP THEIR BOX. `.ind-problem-card` is two components: the
    three unboxed statements on `page-industry.php` (now `.ind-problem`) and
    these, which are LINKS. The box is the affordance; unboxing the shared
    class would have stripped it from twenty-one tiles across six pages.

---

# `page-industry.php`

## `$page_slug`
<a id="page-slug"></a>

⚠️ THE PHONE RULE, AND IT APPLIES TO EVERY INDUSTRY BLOCK IN THIS FILE.
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
yes, rewrite it. If the human is, leave it. Swept; before that this
file's dental H1 read "Your Front Desk Can't Answer Every Call. Your AI Agent
Can." on sixteen pages.

---

## `⚠️ WAS "Your Front Desk Can't Answer Every Call.`
<a id="was-your-front-desk-can-t-answer-every-call"></a>

⚠️ WAS "Your Front Desk Can't Answer Every Call. Your AI Agent Can." Two problems
and the first is the serious one: it claims the product answers CALLS. SiteStaffr
has no phone line - the readme leads with "No phone lines" - so this promised the
one thing it does not do, in an H1, on sixteen pages. It also used "every" as an
absolute. Both are standing rules.

It was additionally the only headline of the fifteen that was a product CLAIM
rather than a situational scene, so replacing it also puts dental back in the
house pattern. The front-desk contrast is what made the original work, so it is
kept - it just no longer implies a switchboard.

---

## `⚠️ BOTH OF THESE ASKED ABOUT "CALLS", which on a page sellin`
<a id="both-of-these-asked-about-calls-which-on-a-pa"></a>

⚠️ BOTH OF THESE ASKED ABOUT "CALLS", which on a page selling an AI reads as
"does it answer my phone" - the exact misunderstanding the positioning has to
avoid, and worse in an FAQ because an answer engine can lift the question on
its own with no page around it to correct the impression.
"makes the call" went too: it is only an idiom, but it is an idiom about
phone calls sitting two lines under a question about phone calls.

---

## `⚠️ THIS ENTRY EXISTED NOWHERE AND /for/medical-staffing/ 404`
<a id="this-entry-existed-nowhere-and-for-medical-st"></a>

⚠️ THIS ENTRY EXISTED NOWHERE AND /for/medical-staffing/ 404ed IN PRODUCTION.
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
ladder is still open with, and writing this one neutrally means it does not
need rewriting whichever way that lands.

---

## `THE ONE SHARED FAQ, APPENDED TO ALL SIXTEEN ----------------`
<a id="the-one-shared-faq-appended-to-all-sixteen-sea"></a>

---- THE ONE SHARED FAQ, APPENDED TO ALL SIXTEEN ---------------------------: Search Console shows more impressions for "virtual assistant"
than for "AI receptionist", and he chose to keep receptionist as the primary term
and carry virtual assistant as a supporting one rather than repositioning on
impression counts alone.

⚠️ IMPRESSIONS ARE NOT THE SAME BID. Production has never said "receptionist" —
the V3 homepage is staging-only — so that comparison scores a bid we never placed.
This entry is the cheap half of the response: it earns the adjacent term without
moving the H1, and it is trivial to re-weight if the click and position data later
says virtual assistant deserves the lead.

⚠️ IT ANSWERS THE QUESTION HONESTLY RATHER THAN CLAIMING THE TERM. "Virtual
assistant" mostly means hiring a PERSON, so a page that simply asserts the phrase
would pull traffic that bounces. Saying plainly which one we are is what makes the
answer useful to the reader who meant the other thing — and a genuinely useful
answer is the only kind worth ranking.

Appended HERE, before both consumers, because the schema block and the visible
accordion each iterate $ind['faqs'] separately. Added in one place it appears in
both; added in the markup it would have shipped without its schema entry.

⚠️ NO PHONE LANGUAGE, same rule as every other string in this file.

---

## `.block`
<a id="block"></a>

---- HERO: now a V3 Split block ------------------------------------------
    First section of the ind-* conversion. Three things changed and none of
    them is the copy:

    1. `.block .block-split` + `.block__inner` + `.block-split__grid` replace
       the bespoke `.ind-hero` padding, `.container` and `.ind-hero__grid`.
       That is the whole point — the page had a THIRD spacing system
       (`.ind-page > section`, `--section-padding`, and this hero's own
       clamp) where V3 has one token per context.

    2. `.ind-hero__accent` and `.ind-hero__glow` are DELETED, not hidden. Two
       absolutely-positioned radial gradients in teal at 5% and 7% alpha,
       which is decoration doing no work — V3 carries emphasis with a dark
       block, not with a wash.

    3. The `::before` gradient that faded the hero's last 120px into the
       cream is gone with them. It was a SEAM, and V3 has exactly one seam on
       the whole site (the homepage hero curtain) because a seam is a colour
       contract between neighbours that fails silently at widths nobody
       sampled. Whitespace has no contract.

    ⚠️ `.ind-hero__grid` STAYS on the element alongside `.block-split__grid`.
    It is not redundant: it overrides the 1fr 1fr to 1.35fr, which was
    measured for headlines of 60-79 characters. Dropping it would give the
    isometric half the page and break the H1 over five lines again.

---

## `.block`
<a id="block-2"></a>

---- PAIN POINTS: a V3 Cards block, UNBOXED --------------------------
    ⚠️ NEW CLASSES (.ind-problem) RATHER THAN RESTYLING .ind-problem-card,
    and that is deliberate. The same class name is used for two different
    components: three STATIC statements here, and the clickable directory
    tiles on /for/ and the five category hubs. Unboxing a link removes its
    affordance, so a shared restyle would have fixed this section and
    quietly broken twenty-one tiles on six other pages. One class name was
    hiding the fact that these were never the same thing.

    The box goes because that is the V3 rule the pricing table already
    proved: "the moment a border or a panel appears they become three
    offers standing side by side". Three problems the reader is supposed to
    recognise are not three offers.

---

## `OPEN: the dark run rises out of the cream.`
<a id="open-the-dark-run-rises-out-of-the-cream"></a>

OPEN: the dark run rises out of the cream. Bottom of section 2, over it,
     because an overlay sits on the LIGHT side of a boundary — the light section
     is its background, so the two cannot disagree on colour.

     ⚠️ DIRECT CHILD OF THE SECTION, not of .block__inner. .block__inner is
     width-capped and gutter-padded; positioned inside it the curtain would be
     1140px wide on a full-bleed boundary, leaving the shape short of both edges
     at every width above the cap.

---

## `.block`
<a id="block-3"></a>

---- SOLUTIONS: the first half of the dark run ----------------------
    Was #0a2e33, a SECOND dark tone three uses deep. V3's dark is V1's deep
    teal --block-dark (#00323A) specifically, because testers rejected the
    night world's near-black and drifting back toward it reintroduces the
    exact tone the redesign exists to drop.

    .ind-solutions__bg is deleted with the same reasoning as the hero's two
    glows: decoration that existed to soften a background V3 states once.

---

## `.block`
<a id="block-4"></a>

---- SCENARIO: the second half of the dark run ---------------------
    Was a pale-blue gradient (#eef8fa -> #e4f3f7), a fourth background with
    no place in a three-tone palette. Its own comment said it was tinted
    "so it reads as a distinct panel between the dark band above and the
    cream FAQ below" — i.e. it existed to solve a problem created by having
    five backgrounds in the first place.

    It becomes the SECOND dark block instead, so this and Solutions read as
    one continuous dark run exactly like homepage sections 2-3. .block--dark
    + .block--dark already handles the join with --block-pad-run; there is
    nothing to align by hand.

    ⚠️ THE CHAT AND RECAP MOCKUPS NOW SIT ON DARK. They are the most
    detailed things on the page and they are real product surfaces, so this
    is the one part of the conversion worth looking at rather than reasoning
    about. If it fails, the fix is this section going cream and Solutions
    standing alone as a single dark block.

---

## `.ind-recap__section`
<a id="ind-recap-section"></a>

⚠️ INDICATES THE TRANSCRIPT, DOES NOT REPRODUCE IT. The real recap email carries the full
        transcript, and the mockup said nothing about it, so the
        email looked shorter than the product's.

        Deliberately NOT the real exchange: the visitor thread is
        already shown in full in the card immediately to the left, and
        repeating it here would double the tallest element on the page
        to say something the reader has just read. A collapsed row is
        the honest shape — it is what the email actually looks like
        before you open it.

        Turn count is COUNTED from the same array that renders the
        thread, so it cannot drift from it. Not interactive: this is a
        picture of an email, and a control that does nothing is worse
        than a label that says what is there.

---

## `$ind_siblings`
<a id="ind-siblings"></a>

---- "EXPLORE MORE" IS GONE, AND THIS IS NOT A PATCH OF IT ---------------: "I don't like the Explore More." It was fifteen industry
names plus a blog post title in one centred flex-wrap with no separators,
which at 390 read as a ragged word cloud — the same failure homepage section
6 was rebuilt to fix.

Re-decided rather than restyled, starting from what a cross-link block at the
bottom of an industry page is FOR. Two jobs, and the old one did neither
well: a reader who has scrolled a dental page either recognises they are in
the wrong trade and wants a near neighbour, or they are done. Fifteen exits
serve the first badly and the second not at all.

So: the SIBLINGS IN THIS CATEGORY ONLY, as rows with their own blurbs, plus
one link to /for/. A dentist sees Medical, Chiropractic, Veterinary and
Medical Staffing — the four pages a mis-landed visitor plausibly wanted —
and everything else stays one click away on the hub that already lists all
sixteen. Nothing loses a crawl path.

⚠️ ROWS, LEFT-ALIGNED, NOT CENTRED. Each carries a name and a blurb, which
is a list, and the design system's rule is that lists keep their left edge.
Centring these is how the word cloud happened in the first place.

Derived from the registry, so a seventeenth industry appears here by itself.
The block renders only when the category actually has siblings.

---

## `.block`
<a id="block-5"></a>

---- CLOSING CTA: a dark block into the footer ---------------------
    Was a bordered card floating on cream, inside a section carrying a teal
    gradient and a dotted SVG pattern the card then covered up. V3 ends on
    a dark block that runs into the footer as one continuous run, which is
    what the homepage and /for/agencies/ both do.

    .ind-cta__pattern and .cta-spotlight are both gone: the pattern was
    painting under an opaque card, and the card is the "bordered CTA card"
    the subpage audit lists as its fifth system break.

---

# `page-landing.php`

## `SECTION 2's FOUR JOB-VALUE FIGURES.`
<a id="section-2-s-four-job-value-figures"></a>

SECTION 2's FOUR JOB-VALUE FIGURES. Ported from the V2 branch with the
 figures, notes and sources byte-identical — these are the sourced numbers user testing
 responded to, and retyping them by hand is how a citation quietly becomes wrong.

 AMBER APPEARS IN EXACTLY ONE PLACE ON THE SITE: the four `amount` values below. Not on
 a button, a card, an icon, a heading or a border. Anywhere else is a bug.overruled the objection to keeping amber here — the original concern was
 that amber was doing semantic work across every section and becoming a second accent
 competing with teal, and one confined use on the element you most want people to stop
 on is a different thing. Confined is the whole reason it is allowed.

---

## `$job_values`
<a id="job-values"></a>

`mark` IS THE WATERMARK, AND IT IS NOT `label`.

 They are separate fields on purpose and must stay separate. `label` is prose and
 is spoken — it builds the source button's aria-label ("Source for the Auto repair
 figure"). `mark` is a four-to-six character stamp sized to a card. Collapsing them
 would either put "Auto repair" in the watermark, which no longer fits or reads as
 a stamp, or put "AUTO" into a screen reader as the name of the industry.

---

## `⚠️ PER YEAR, NOT PER VISIT, AND THAT CHANGE IS THE POINT.`
<a id="per-year-not-per-visit-and-that-change-is-the"></a>

⚠️ PER YEAR, NOT PER VISIT, AND THAT CHANGE IS THE POINT. The defect was real, and the defect was a UNIT MISMATCH rather than
         a wrong number: $391 was one VISIT, sitting beside an HVAC figure that is one
         PROJECT. But a website enquiry to a dentist is not one visit — it is a new
         patient, worth a year of them.

         This also RETIRES THE ONLY DERIVED FIGURE ON THE PAGE. $391 was total dental
         expenditures divided by total visits, because AHRQ publishes no per-visit
         line. $887 is published directly in the same brief, so the new number is both
         the right unit and better sourced than the one it replaces.

         Still total expenditure — out-of-pocket plus insurance — which is what the
         practice actually bills, not what the patient pays at the desk.

---

## `$faq_items`
<a id="faq-items"></a>

SECTION 9 — the FAQ. Seventeen questions in four groups, reordered
 OBJECTION-FIRST. The old ten opened with questions that sections 1, 3, 4, 5 and 8
 had already answered, which wastes the one place on the page a skeptical reader
 goes looking for a reason not to buy.

 WHY THE SCHEMA WORK STILL MATTERS IN 2026. FAQ rich results are effectively gone
 from Google — restricted to authoritative government and health sites since 2023.
 The case for FAQPage markup now is AI ANSWER ENGINES, which is on-brand: SiteStaffr
 sells AI Visibility checks, so the site should practice what the product measures.

 ANSWER-WRITING RULES, driven by extraction rather than ranking:
   - SELF-CONTAINED. An answer engine lifts one Q&A pair with no page context, so
     every answer names SiteStaffr and stands alone.
   - 40-80 WORDS. The old "What is SiteStaffr?" answer ran ~150 and was both too
     long to extract cleanly and a wall inside the accordion.
   - LEAD WITH THE DIRECT ANSWER, then qualify.
   - CONCRETE NOUNS AND NUMBERS over adjectives. "Installs in under five minutes"
     extracts; "easy to install" does not.

 ⚠️ `group` IS PRESENTATIONAL ONLY. The JSON-LD below iterates this same array and
 emits a FLAT mainEntity list, because FAQPage has no grouping concept and inventing
 one would produce invalid markup. Grouping solves the wall-of-questions problem
 inside the single column without breaking the never-two-column rule.

 ⚠️ NEVER REPEAT A QUESTION ACROSS TWO FAQPage BLOCKS. /for/agencies/ carries its own
 ten agency questions and they are deliberately disjoint from these — duplicates make
 the two URLs compete with each other.

---

## `NEW, and it is the FAQ half of the hero's 24/7 edit.`
<a id="new-and-it-is-the-faq-half-of-the-hero-s-24-7"></a>

NEW, and it is the FAQ half of the hero's 24/7 edit. The page
         had seventeen questions and not one of them asked about hours, which is
         the reassurance a service-business owner actually wants and the phrasing
         people search. It is also the only place the claim can be made
         PRECISELY: "24/7" on its own invites "so someone is on call?", and the
         honest answer — nobody is, which is the entire point — is a selling
         point rather than a caveat.

         ⚠️ NO PHONE LANGUAGE. Same rule as the industry templates: "after hours"
         and "overnight" are fine, "answers calls" is not. This one sits directly
         above the no-phone-number question on purpose — hours, then channel.

---

## `THE AudioObject SCHEMA WAS REMOVED HERE.`
<a id="the-audioobject-schema-was-removed-here"></a>

THE AudioObject SCHEMA WAS REMOVED HERE.

       It described a 45-second plumbing demo (demo-conversation.mp3, "kitchen leak
       under the sink") complete with a full transcript, and the page now contains
       ZERO audio elements — the hero audio demo went with the two sections that
       section 3 replaced. Structured data has to describe content that is actually
       on the page; a detailed AudioObject for a file the visitor cannot reach is
       invalid markup and, unlike a broken image, nothing on screen reveals it.

       It was also the wrong business: the spec drops Brightwater Plumbing entirely.
       Voice is auto repair and text is pest control now.

       ⚠️ DO NOT RE-ADD THIS WHEN THE AUTO-REPAIR RECORDING LANDS unless the audio
       is genuinely reachable on the page, and re-derive the name, description,
       duration and transcript from that recording. assets/audio/demo-conversation.mp3
       is still on disk and is now unreferenced.

---

## `.hero__headline`
<a id="hero-headline"></a>

The headline used to state the OUTCOME ("You Get the Lead") and never the
           CATEGORY, which left the five float cards doing all the category work on
           their own. A stranger has to read this once and think "this is a thing I
           put on my site that talks to my visitors".

           Teal falls on "on Your Website" deliberately - , so the accent lands on the phrase that matches
           transactional search intent, not on the product noun.

           No trailing period: single sentence, per the heading rule.

---

## `⚠️ THE "ON A JOB, WITH A CLIENT, OR ASLEEP" ENDING IS GONE, `
<a id="the-on-a-job-with-a-client-or-asleep-ending-i"></a>

⚠️ THE "ON A JOB, WITH A CLIENT, OR ASLEEP" ENDING IS GONE, AND THIS
           REVERSES A RULE THAT USED TO SIT IN THIS EXACT COMMENT.
           The old note read: 'Ends on SITUATION, not category. "while you're on a
           job, with a client, or asleep" is audience signalling a dentist recognizes
           instantly.'

           It is a FALSE CONTRAST and it was named plainly: "it's not like they even have
           an opportunity to answer while they're on a job, asleep, or with a client
           because SiteStaffr is in its own digital world outside of the real world."
           The clause implies the owner would otherwise be answering the website. He
           never was. A visitor at 2pm on a Tuesday got exactly the same nothing as
           one at 2am, so his calendar was never the variable.

           ⚠️ THIS DOES NOT CONDEMN THE OTHER TWO INSTANCES, and they stay. Section
           4's "You Were Asleep. Your Website Wasn't." is about what happened while he
           was not WATCHING, which is true. Section 2's "a shift you are not there
           for" is about the website's hours, not his availability. The test is
           whether the line implies he would have answered.

           WHAT REPLACED IT is the one thing nothing else on the first screen says.
           The five float cards carry what it does; section 2 carries the stake. The
           gap was credibility — where the answers come from — and it is also the top
           install objection, which the FAQ asks outright as "Do I need to train it or
           write scripts?".

           Still no "small and medium-sized businesses": nobody self-identifies that
           way, and it would tell an agency this page is not for them.

---

## `.hero__subtitle`
<a id="hero-subtitle"></a>

⚠️ "24/7" IS LOAD-BEARING AND IT IS NEW: "I'm not
           seeing anything that says 24/7 on the homepage or elsewhere. I know that
           it's implied but people would likely like to see that to be reassured and
           it might also help with SEO."

           He was right and the sweep confirmed it — before this edit the string
           appeared ZERO times in this file. It was only ever in Yoast meta
           descriptions, /about/, /download/ and /for/, i.e. everywhere except the
           page that has to make the promise. Sections 2 and 5 both dramatize
           after-hours ("a shift you are not there for", "You Were Asleep") without
           either of them ever stating the hours.

           It goes FIRST here, ahead of the credibility clause, because it is the
           reassurance; "nothing to write and nothing to train" is the objection
           handler and still follows. Every idea in the previous version survives —
           set up in minutes, answers from your own pages, nothing to write or
           train. Nothing was traded for it.

---

## `.hero__industries`
<a id="hero-industries"></a>

The industry line anchors to #industries (section 6) rather than /for/ — it
     scrolls DOWN THE PAGE instead of leaving it, which is why the arrow is a down
     arrow and not a right one. Fifteen exit doors before proof and pricing is what
     section 6 is being rebuilt to stop.

     The remainder is COUNTED FROM THE REGISTRY, never hardcoded. The spec says
     "+10 more", written when there were fifteen industries; adding Medical Staffing
     makes it eleven, and a hardcoded number would have gone quietly wrong the moment
     the sixteenth landed. The registry is the one place the count lives.

---

## `.hero__float-cards`
<a id="hero-float-cards"></a>

FIVE THINGS IT DOES, IN THE PRESENT TENSE.
           These used to mix two grammars: "Responding by text" is something in
           progress, "Lead captured" is something finished. As notifications
           floating past a robot's head that reads as a live feed; as the in-flow
           2-2-1 grid they become below 1024px it reads as an inconsistent list.
           One subject — SiteStaffr — and every line answers "what does it do?",
           which is the hero's actual job.

           ⚠️ NOT aria-hidden. It was, back when a separate .hero__capabilities
           list carried the same five claims for small screens. That list is gone
           with V3, so hiding these hides the only place the product's capabilities
           are stated on the first screen.

---

## `THE OPENING CURTAIN MOVED OUT OF THE HERO ON and is now the `
<a id="the-opening-curtain-moved-out-of-the-hero-on-a"></a>

THE OPENING CURTAIN MOVED OUT OF THE HERO ON  and is now the first
     child of section 2 below, hanging upward into this section. It is still an
     absolute overlay and the robot still stands behind it — that underlap is the
     whole point and has not changed.

     What changed is which box OWNS it. Inside the hero it was clipped by
     `.hero { overflow: hidden }` (the rule that crops the robot), so its bottom
     edge landed exactly on the hero/section boundary — a boundary at a fractional
     layout position, which at a fractional device pixel ratio rounds apart and
     leaves a pale hairline. Owned by the dark section it can overlap 3px DOWN into
     it, and there is no shared edge left to round. See .seam-curtain--open.

---

## `THE FIVE-CAPABILITY RIBBON WAS DELETED HERE.`
<a id="the-five-capability-ribbon-was-deleted-here"></a>

THE FIVE-CAPABILITY RIBBON WAS DELETED HERE.

It listed Unlimited Text Chat / Voice Answers / Lead Capture / Email Recaps /
Blog Writing — the same five things the hero's float cards already say, in
the same order, immediately below them. It was the redundant copy, and the
float cards are the version testers actually responded to.

It was also load-bearing in the wrong direction: at 1440x900 it occupied 133px
between the hero and section 2, which pushed section 2's dark block to y=929
and off the first screen. Capping the hero height alone could not fix that —
the band had to go for the page to open on its first contrast moment.

Measured after removal: section 2 starts at y=796, on screen.

Nothing replaces it. The capabilities are covered by the float cards above and
by sections 3 and 4 below.

---

## `.block`
<a id="block"></a>

SECTION 2 — the first half of the dark block. Sections 2 and 3 share one dark
   background so there is no seam between them; the only seam on the page is the
   curtain above, where the light hero meets this.

   PORTED from the V2 branch, figures and sources byte-identical, because these are
   what user testing responded to. The four unsourced placeholders that used to live
   here ($500+/$3,000+/$2,000/$800) are gone: they were invented, and this section's
   whole argument is that the numbers are real and cited.

---

## `.cost-section__text`
<a id="cost-section-text"></a>

CUT TO ONE LINE. This paragraph used to resolve the problem the section had
           just posed — "SiteStaffr is an employee for your website. It answers your
           visitors day or night…" — which made section 3 arrive as a repeat of an
           answer already given. Section 3 is where the product shows up; this line
           just hands over to it, and it picks up "a shift you are not there for"
           from the first paragraph.

---

## `.job-value__mark`
<a id="job-value-mark"></a>

THE WATERMARK, and it is wrapped in its own clip layer rather than clipped
         by the card.

         `overflow: hidden` on .job-value itself would have been the obvious way to
         contain oversized type, and it would have silently broken the source
         tooltip: that tooltip is absolutely positioned inside this same card and is
         taller than the space below the info button, so clipping the card clips the
         tooltip's text. The wordmark gets its own `inset: 0; overflow: hidden` box,
         which contains the type and leaves the tooltip's stacking alone.

         aria-hidden because it is decoration that repeats information the card
         already carries — the icon shows the industry, and `label` states it to
         assistive tech through the source button. Read aloud it would announce a
         bare "HVAC" with no context, between an icon and a dollar amount.

---

## `.job-value__icon`
<a id="job-value-icon"></a>

The sprite fallback from the V2 branch was dropped in this port, deliberately.
         There it read `<use href="#i-ind-…">` against template-parts/icon-sprite.php,
         and main has no sprite system at all — so the "fallback" would have rendered
         nothing at all if the image were ever missing, which is worse than no
         fallback because it looks like a working safety net. The four renders are
         committed alongside this file; if one goes missing the alt-empty img is the
         honest failure.

---

## `.job-value__src`
<a id="job-value-src"></a>

SOURCE ON DEMAND, not in the card.

         A real <button>, not a hover-only span, and that is the accessibility
         difference: a hover tooltip is unreachable by keyboard and unreachable on
         touch. As a button it takes focus, opens on :focus-visible as well as :hover,
         and announces through aria-describedby. `title` is deliberately not used — it
         is invisible on touch, unstyleable, and read inconsistently by screen readers.

         The info glyph is inline rather than a sprite reference, for the same reason
         the fallback was dropped: main has no sprite to point at.

---

## `.job-value__amount`
<a id="job-value-amount"></a>

NO VISIBLE INDUSTRY LABEL. The icon carries it, and a wrench captioned "Auto repair" is a
         caption telling you what the picture already said.

         `label` stays in the array and is still USED — it builds the info button's
         aria-label, so a screen-reader user hears "Source for the Auto repair figure"
         rather than "Source". Deleting the field to tidy up would take that with it.

---

## `.job-values__foot`
<a id="job-values-foot"></a>

The price anchor was REMOVED here. It read
           "A single repair order covers a year of SiteStaffr."

           ⚠️ IF IT EVER RETURNS, IT STAYS SPECIFIC TO THE REPAIR ORDER. Starter is
           $29/mo = $348/yr, so it is true of the $494 card and FALSE of the $391 and
           $200 ones. An earlier version said "winning one of them pays for a year",
           which was true of four invented figures and became false the moment real
           ones replaced them — a claim that quantifies over a list breaks silently
           every time the list changes, and nothing in the diff says so. This trap has
           already caught the project once.

---

## `.block`
<a id="block-2"></a>

SECTION 3 — the second half of the dark block. Shares section 2's background, so
   there is deliberately no seam between them.

   REPLACES TWO SECTIONS: "A Missed Call Turned Into a Booked Job" (lead-demo) and
   "Voice & Chat" (voice-text-section). Both demoed the product; together they said
   it twice and neither showed the payoff arriving.

   ⚠️ THE OLD HEADING HAD TO GO AND IT MATTERS MORE NOW. "A Missed Call Turned Into
   a Booked Job" — and its sibling "Hear It Take a Call" — read unmistakably as
   "this answers my phone". The product has no phone line; the readme leads with
   "No phone lines." With "receptionist" in the H1 that misreading is the single
   most likely misunderstanding of the whole positioning, and it also throws away
   the real differentiator: the visitor talks ON YOUR WEBSITE, with no number to
   dial and nothing to install.

   It also books nothing. The conversation ends with details captured and a human
   following up, because that is what the product does. A demo that books something
   is a demo of a product we do not sell.

---

## `.see-it__stage`
<a id="see-it-stage"></a>

THE AT-REST STAGE.

 WHY THE PANELS WERE BLANK IN THE FIRST PLACE, because it is not a bug and the fix
 must not "repair" it: the panels are rendered FULLY POPULATED by PHP, and the script
 empties them on load only once it knows it can drive them. That is deliberate — with
 JS off, or under prefers-reduced-motion, the whole conversation and the whole recap
 are simply there. The blankness only ever existed in the one state where a script is
 standing by to fill them, and this stage now covers exactly that state.

 So there are three states, not two:
   no JS / reduced motion  -> no stage at all, both panels full. Unchanged.
   JS, not yet played      -> this stage. Panels hidden, one enormous target.
   played once             -> stage gone for good, panels take over and animate.

 `hidden` until JS removes it, for the same reason the transport is: with no script
 there is nothing to play, and a dead play button is worse than none.

 THE ROBOT IS THE EXISTING assets/images/robot-voice.webp — the one that came out
 with the voice showcase and has been sitting unreferenced since. It is not a new
 generation: it is already in the hero's render language (the style anchor), it is
 already mid-conversation with speech lines and chat bubbles, which is precisely
 what this section is about, and it costs nothing. Do not re-generate it to "match"
 — matching is what it already does.

 ⚠️ THE ROBOT IS DECORATION AND MUST STAY SECONDARY. The hero has this same
 character two sections up at a much larger size; the reason this reads as a
 different beat rather than a repeat is that here the PLAY BUTTON is the subject and
 the robot is behind it. If the robot ever grows to compete, the section turns into
 the hero again.

---

## `.see-it__stage-hint`
<a id="see-it-stage-hint"></a>

⚠️ THE TRIANGLE'S OWN COORDINATES DO THE CENTERING — there is no margin
           nudge on this icon and there must not be one added back.

           It was `8,5 20,12 8,19`, whose bounding box runs x=8..20 and is therefore
           centered on x=14 inside a 24-wide viewBox: two units right of center before
           any CSS is involved. A `margin-left` was then added on top of that, which
           is why the glyph sat visibly right in the circle. Two offsets stacking is
           also why nudging the CSS never fixed it — the error was in the artwork.

           Now x=7..19: the bounding box is centered on 13, one unit right of the
           viewBox's 12. That single unit is deliberate and is optical, not
           geometric — a right-pointing triangle carries its mass on the flat left
           edge, so a perfectly centered bounding box reads as sitting too far left.
           Verified by measuring the rendered pixels, not by eye.

---

## `.see-it__tabs`
<a id="see-it-tabs"></a>

THE TOGGLE ATTACHES TO THE PANEL IT CONTROLS. On the V2 branch these
             were chips floating over a street render; with the art gone they were
             labels attached to nothing. They only change the conversation, so they
             belong to the conversation.

             Both labels are THE VISITOR'S QUESTION, not one question and one
             description — the tabs are two examples of the same thing, and
             labeling them asymmetrically implied they were different features.

---

## `.see-it__transport`
<a id="see-it-transport"></a>

The play button is the largest interactive element in the section, and
             the scrubber is the hero soundwave motif reused as a progress bar.
             Browsers will not autoplay audio, so nothing animates until this is
             pressed — which is fine, it makes the button the gateway.

             `hidden` until JS removes it: with no script there is nothing to play,
             and a dead play button is worse than none.

---

## `.see-it__field`
<a id="see-it-field"></a>

⚠️ NO FIXED SCHEMA. Label and value materialise together as a PAIR.
               The product builds each recap intelligently — sometimes a name only,
               sometimes a name and an email, sometimes a name and a phone. A
               pre-drawn skeleton of grayed labels would be a picture of a form the
               product does not have. The voice thread captures a PHONE where this
               one captures an EMAIL, and that difference is the point.

---

## `.block`
<a id="block-3"></a>

SECTION 4 — Your morning. Light again; the dark block ended with section 3.

   THE RECAP DOCUMENT THAT USED TO BE HERE IS DELETED, and that is the largest
   length saving on the page — achieved by removing a duplicate rather than by
   cutting content.

   Section 3 now shows a recap ASSEMBLING as the conversation plays. This section
   then showed the same artifact again, static, one screen later. That is a
   downgrade repeat: the second showing can only be less interesting than the first.

     section 3 = ONE conversation, seen happening.
     section 4 = THREE conversations, seen accumulated.

   Singular to plural is an escalation instead of a repeat, and it gives this
   section the one argument section 3 structurally cannot make: you did not get a
   lead, you got three, and you were asleep for all of them.

   The bridge line went with the document ("Here is what the 2:14 AM one looked
   like when you opened it") — it pointed at the thing that no longer exists.

---

## `.block__inner`
<a id="block-inner"></a>

THE CURTAIN CLOSES HERE. Same path as the hero's, mirrored — the dark block that
     opened with a peak drawn up now comes back down with one.

     It belongs to THIS section, not to section 3, for the same reason the opening
     one belongs to the hero: it is an overlay on the LIGHT side of the boundary,
     so the light section is its background and the two can never disagree on
     color. Section 3 needs no cooperation at all.

---

## `THE INBOX IS THE EVIDENCE, AND IT IS WHERE THE CLOCK IDEA LA`
<a id="the-inbox-is-the-evidence-and-it-is-where-the"></a>

THE INBOX IS THE EVIDENCE, AND IT IS WHERE THE CLOCK IDEA LANDS. it was asked
 about a large clock or a 24/7 symbol behind the hero robot. Wrong slot — the
 hero's job is identity — but the right instinct, and the better version is not a
 clock at all: it is A REAL TIMESTAMP ON A REAL THING. "6:03 AM" on a captured
 lead does concretely what a clock face gestures at.

 ⚠️ NEWEST FIRST, WHICH PUTS THE OPEN ONE IN THE MIDDLE. An inbox sorts 6:03 AM /
 2:14 AM / 11:47 PM. Do not reorder to put the highlighted row on top: a list that
 sorts wrongly stops reading as an inbox, and the realism is the entire argument.
 The middle row being the open one is what a real morning looks like.

 ⚠️ ONE BUSINESS, THREE LEADS. An inbox belongs to one owner. Do not turn these
 three rows into three different industries to show range — that turns a believable
 morning into a brochure, and the section stops being evidence.

---

## `$morning_leads`
<a id="morning-leads"></a>

THE THREE LEADS, AND THE DOCUMENT BEHIND EACH ONE.

 ⚠️ ONE ARRAY DRIVES BOTH THE ROW AND THE DOCUMENT. The row's name, time and
 one-liner are read from the same entry the recap and transcript are, so a row can
 never advertise a lead the document contradicts. Splitting these into two literals
 is how "Sarah Mitchell, 25 guests" ends up opening a document about 40 cupcakes.

 ⚠️ EVERY TRANSCRIPT OPENS ON THE SAME LINE, and that is the product's real greeting
 rather than three invented ones (it was asked for explicitly). It is also the
 line V1's document already used. Note the wording is "How can I help you today?" —'s message transposed it to "How I can help you today?", which is not
 grammatical and is not what V1 shipped.

 PRIYA RAMAN IS GONE FROM THIS SECTION and that also removes a duplicate: the same fictional person
 was giving her details to a pest control company in section 3 and to a bakery here.
 Section 3 keeps the name; this one is Camila Reyes.

 These are illustrative examples for a demo, not real customer data. Phone numbers
 are 555-01xx, the block reserved for fiction, and emails are @example.com.

---

## `.morning-inbox__row`
<a id="morning-inbox-row"></a>

⚠️ NO aria-label ON THIS BUTTON, and that is a fix rather than an
             omission. It carried `aria-label="Open the recap for Tom Byrne"`, which
             REPLACES the accessible name — so the name no longer contained the
             button's own visible text, and Lighthouse failed it on
             label-content-name-mismatch. That rule exists for voice control: a user
             who says "click 6:03 AM" has to be able to match what they can see.

             The visible content is the name now, with the purpose appended in a
             screen-reader-only span at the end. Same information, and the name still
             starts with what is on screen.

---

## `.recap-doc`
<a id="recap-doc"></a>

THE DOCUMENTS. Rendered server-side, one <dialog> each, hidden until opened.

 ⚠️ THIS IS AN ENHANCEMENT AND IT IS ALLOWED TO BE ONE. The page's standing rule is
 that content must not default to invisible and depend on JS to restore it — that
 rule exists because PRIMARY content once did. These are worked examples behind a
 row that already states the lead, the time and the outcome in the inbox itself; a
 reader with no script loses the detail view and nothing they were told about.
 Without JS the rows never gain their affordance (see .is-interactive in the CSS),
 so there is no button advertising something that cannot happen.

 <dialog> rather than a hand-built overlay: focus trapping, Esc, inertness of the
 page behind and the top layer are all native. showModal is what activates them —
 a plain .show or a CSS-only reveal gets none of it.

---

## `.recap-doc__msg`
<a id="recap-doc-msg"></a>

⚠️ "SiteStaffr", NOT "AI". The website is
                     deliberately AHEAD of the product here: the plugin UI and the
                     emailed transcript both still print "AI", and renaming them is a
                     separate task on the wiki task board. Until that ships this
                     mockup shows the intended label rather than the shipped one —
                     which is a deliberate call, and is why the two differ if anyone
                     compares them.

---

## `.block-cards__grid`
<a id="block-cards-grid"></a>

THE FOUR CALLOUTS BECOME A CARDS ROW UNDER THE INBOX. They were set as two
       right-aligned on the left of the document and two left-aligned on the right,
       with the right pair floating above a large gap — a layout that only made
       sense as annotations flanking the artifact they pointed at. With the
       document gone they have nothing to flank, so they become what they always
       were: four short claims about how the recap reaches you.

---

## `.what-you-get__callout`
<a id="what-you-get-callout"></a>

⚠️ THIRD WORDING, and the two it replaced both failed in the same place —
         the TITLE, not the description.

         1. "No dashboard to log into." The plugin SHIPS a Dashboard with a
            Follow-ups queue and it is a feature we sell, so the card denied a real
            feature in order to make a convenience point.
         2. "Nothing to Check." Fixed the denial and broke the sense. Check what? It reads as "nothing to verify",
            which is a claim about accuracy, and then the description immediately
            offers a dashboard to check — the title and its own body disagreed.

         "Nothing to Log Into" names the actual friction, and the description gives
         the dashboard back rather than denying it. The claim was always "you don't
         have to", which is both true and the better sell.

---

## `THE SALESFORCE BAND MOVED OUT, to the FAQ in section 9.`
<a id="the-salesforce-band-moved-out-to-the-faq-in-se"></a>

THE SALESFORCE BAND MOVED OUT, to the FAQ in section 9.

       It sat directly under a story about a bakery owner asleep at 2 AM. Maggie's
       Cakes does not have Salesforce, and an enterprise CRM logo in the middle of
       that story is the same register problem testers disliked in the "connect
       your org" line. It also leaked to /salesforce/ in the same tab, which breaks
       the one-exit rule on the section immediately before proof and pricing.

       "Does it fit my stack" is a buying question, so it belongs in the FAQ where
       buying questions are answered — see the CRM entry in $faq_items.

---

## `$lang_greetings`
<a id="lang-greetings"></a>

SECTION 5 — Speaks their language.

THE CROWD RENDER IS DELETED. It was the best-looking image on the site and it still
had to go:

1. In the V3 order it would be a dark full-bleed band between two light sections,
  which is a stripe, and it put the abandoned painterly style directly against the
  glossy cyan robot.
2. It was the maintenance trap this whole review was called to fix — twelve
  hand-measured --x/--y percentages positioned over the artwork, where a code
  comment recorded that swapping the image "silently invalidates all twelve", and
  that they had already been re-measured twice.
3. Most bubbles did not render: twelve specced, four visible at 1440.
4. About 250px of it was wet pavement; people occupied a 200px band in a ~900px
  section.
5. It carried TWO LISTS OF LANGUAGES that did not agree — pills saying Spanish /
  Mandarin / French, bubbles saying Hola / Hallo / Xin chào.

THE REPLACEMENT COSTS NO NEW ART. robot-languages.webp was generated for this exact
slot, committed, and never placed.

WHY THE ROBOT ARGUES BETTER THAN THE CROWD. A crowd claims "your visitors are
diverse" — true, but not the product claim, and a picture of a street cannot prove it.
The robot with a live greeting claims "it speaks them", which is the thing only
SiteStaffr can say, and the greeting is a real product surface rather than a stock
photograph.

⚠️ `lang` ON EVERY GREETING AND `dir="rtl"` ON THE ARABIC. A screen reader switches
voice on `lang`; without it a synthesiser reads "Hola" in English phonetics on the one
section whose entire subject is other languages. This is not decoration.

────────────────────────────────────────────────────────────────────────────
REBUILT AGAIN.

WHAT WENT: the split layout, the single greeting bubble, and the clickable pills that
drove it. The pills were a good idea that solved the wrong problem — they let you see
ONE language at a time, and the argument this section has to make is that it speaks a
LOT of them. Twelve greetings visible at once makes that argument in one glance and
needs no interaction to do it.

⚠️ THIS IS THE THIRD DESIGN IN THIS SLOT AND THE SECOND ONE KILLED BY THE SAME BUG.
The crowd render before it positioned twelve bubbles with hand-measured --x/--y
percentages over the artwork: twelve were specced and FOUR rendered at 1440, and a
comment recorded that swapping the image silently invalidated all twelve.

So the greetings here are NOT positioned against the robot. They sit in the stage's
own coordinate space, in two symmetric side bands that the centered figure never
reaches, and below 900px they stop being positioned at all and become an in-flow
wrap. Swapping robot-languages.webp cannot invalidate a single one of them. If you
ever find yourself measuring a percentage against a pixel in the artwork, that is
this bug coming back.

---

## `.section-label`
<a id="section-label"></a>

⚠️ THE EYEBROW, THE HEADING AND THE SUBTITLE ALL SAID THE SAME SENTENCE. The label read "Speaks Their
         Language" directly above a heading reading "SiteStaffr Speaks Their
         Language", and the subtitle then added "and so does SiteStaffr" — the same
         claim a third time before the reader reached a single greeting.

         The heading is the line worth keeping, so the other two now do different
         jobs: the label names the OBJECTION (a visitor who does not read English),
         and the subtitle supplies the number and the fact that it needs no setup.

---

## `.lang-section__text`
<a id="lang-section-text"></a>

⚠️ THIS LINE TOOK TWO GOES AND BOTH FAILURES WERE THE SAME ONE.

         It read "Your visitors open in 57+ languages" — "open" being our word for
         starting a conversation, internal vocabulary that reads as a typo to
         anyone who has not seen the widget.

         The fix I shipped was "can start in any of 57+ languages and get an answer
         in the same one". Swapping one construction for another slightly-less-odd
         construction was still translating FROM product-speak instead of just
         writing the sentence — and the wording he supplied is shorter than either
         attempt.

         ⚠️ THE SUBJECT IS THE VISITOR AND THAT IS THE POINT. "SiteStaffr supports
         57+ languages" is the same fact as a spec; "your visitors speak 57+
         languages" is the same fact as a situation the reader recognizes.

         Both jobs the line was given still survive: the NUMBER, and no setup.

---

## `THE STAGE.`
<a id="the-stage"></a>

THE STAGE. The robot is in the FLOW and the greetings are absolute around it, which
 is the opposite of how the deleted crowd version worked and is the whole reason
 this one cannot rot the same way. The image sets the stage's height; the greetings
 are placed against the stage, never against the picture.

 ⚠️ THE ROBOT IS aria-hidden AND THE GREETINGS ARE NOT. The greetings are the
 section's evidence, not decoration — "here are twelve languages" is the claim, and
 hiding them would leave a screen-reader user with a heading and nothing under it.

---

## `$lang_haze`
<a id="lang-haze"></a>

THE HAZE — more languages, receding behind the robot.

 ⚠️ DELIBERATELY NOT A LITERAL VORTEX. A swirl would need the words on a rotated
 ellipse with perspective, and every one of them would then be positioned against
 the FIGURE — which is the maintenance trap that killed the crowd render in this
 exact slot (twelve bubbles hand-measured over artwork, four of them rendering).
 This does the same job with depth cues instead of motion: words get smaller,
 fainter and more rotated as they approach the center, so the field reads as
 receding behind him. Nothing here is measured against the robot; the coordinates
 are the stage's, and the robot simply sits on top.

 THESE ARE NOT THE TWELVE. The chips are the section's evidence and are readable;
 this is texture, at 4-7% opacity, and is aria-hidden. Different words on purpose —
 repeating the chips would read as a printing error rather than as "there are more".

 Each entry is: greeting, top %, left %, font-size rem, rotation deg, opacity.

---

## `.lang-orbit__list`
<a id="lang-orbit-list"></a>

⚠️ `lang` ON EVERY GREETING AND `dir="rtl"` ON THE ARABIC — carried over from the
   previous design, where the note read "this is not decoration", and it is even
   more true now that there are twelve of them. A screen reader switches voice on
   `lang`; without it a synthesiser reads 你好 and Привет with English phonetics,
   in the one section whose entire subject is other languages.

   The visible chip is the greeting; the language's NAME rides along in a
   visually-hidden span. Sighted readers get "Bonjour" and infer French from the
   word — a screen-reader user hearing a French synthesiser say "Bonjour" with no
   label has no idea which language just went past.

---

## `$ind_groups`
<a id="ind-groups"></a>

SECTION 6 — Who this is for. The most-reworked section, and the one that
motivated this review. Rebuilt rather than adjusted.

WHAT WAS WRONG WITH THE OLD FLAT BLOCK:
- all fifteen names linked to /for/{slug}/ — fifteen exit doors immediately before
 proof and pricing, and they did not LOOK like links, so a click surprised and a
 wanted click was undiscoverable.
- five lines ended on a dangling separator dot, the mirror of a bug already fixed
 once: a separator in flowing text cannot be suppressed at a line boundary in pure
 CSS.
- it did the recognition job and nothing else.

THE ISOMETRICS FINALLY GET A SIZE YOU CAN SEE. ⚠️ This does NOT contradict the "no
isometric" rule — that rule was about SIZE. The design system deletes them "wherever
they render below ~100px", because you could not see them. They are 1024x1024 and hold
at 440px easily, and they are the right style family: smooth, brand teal, transparent
background, no warm light. The incompatible style was the painterly amber CITY.

CLICK, NOT HOVER, for three reasons: hover does not exist on touch and most SMB
traffic is phones; hover flickers, because crossing the list swaps a 440px image four
times; and the excerpt needs persistence — you cannot move the pointer to a link that
vanishes when you leave the name.

THE BLURBS COME FROM THE REGISTRY. No copywriting, and a new industry stays correct
for free.

---

## `$ind_first`
<a id="ind-first"></a>

WHICH INDUSTRY OPENS THE SECTION IS RANDOM.

It was $ind_flat[0], so Dental Practices — the first entry in the registry — was the
permanent face of a section whose whole argument is breadth. Sixteen industries, and a
visitor only ever saw one of them unless they clicked.

⚠️ IT IS RANDOM PER PAGE RENDER, NOT PER VISITOR, and that distinction is worth
knowing before anyone calls it broken. Full-page caching (LiteSpeed on production)
serves one generated copy to everybody, so the pick changes when the cache is built,
not on every load. That is fine here — the goal is that the section is not permanently
Dental, not that two people see different things — but it does mean you can reload ten
times and see no change, and that is the cache working rather than this failing.

Doing it in JS instead would give per-visitor variety at the cost of rendering one
industry and visibly swapping it a frame later, which is a worse trade for a section
whose panel is a 440px image.

⚠️ EVERY is-active FLAG IN THIS SECTION DERIVES FROM $ind_first — the panel, the
excerpt, and the list button. They must agree, so there is exactly one source for the
choice. Do not re-roll it further down the template.

---

## `.block`
<a id="block-4"></a>

⚠️ NOT A block-split ANY MORE.

   It was image-left / list-right. The list is five groups and sixteen names in ONE
   column, so it ran far taller than the 440px image beside it and the Split was
   permanently lopsided — a two-column layout where one column ends two thirds of
   the way up.

   Now it is two stacked rows: the isometric and its excerpt side by side on top,
   then the full list underneath at full width, where five groups sit as five
   columns instead of one tall stack. The list gets SHORTER by getting WIDER, which
   is the thing the Split could not do.

---

## `$ind_is_open`
<a id="ind-is-open"></a>

⚠️ ACTIVE IS $ind_first, NOT INDEX 0. These three flags -- the panel,
             the excerpt below, and the list button further down -- are what make one
             industry the open one, and they must all name the SAME industry. They
             were each hardcoded to `0 === $i` back when the default was always the
             first entry; with a random default that silently splits the section,
             highlighting one name in the list while showing a different picture.

---

## `.industries__list`
<a id="industries-list"></a>

LIST RIGHT. Group headings RETURN, and that correctly reverses a recorded
         decision. They were killed because "five headings plus fifteen names is a
         rail again" — an objection that does not survive this layout: the list is
         one column of a Split beside a 440px image, not the shape of the section.

         ⚠️ ON MOBILE the category headings stay VISIBLE as static labels and only
         the industries collapse. Closed state is 5 headings + 16 names, about one
         and a bit screens, so someone scanning for their trade sees everything at
         once. Mobile is genuinely better at the recognition job than desktop here.
         A two-level accordion would be three taps deep and every 440px expansion
         would blow the layout apart.

---

## `.block`
<a id="block-5"></a>

SECTION 7 — social proof. THE V2 ARRANGEMENT, IN V3's PALETTE.

⚠️ THE ARRANGEMENT IS THE THING THAT TESTED WELL, so it is what gets ported —
not just the two numbers. What was here before was the V1 design
(a glassmorphic card on a gradient wash, with a noise texture and a rotated
backdrop panel) carrying V2's stats. That is the combination the spec's
opening line rules out: "Testers preferred it over the live site's" is a
statement about the LAYOUT.

The shape, left to right: evidence, then the human voice.

- The header lives INSIDE the evidence column, not above the grid. Two
 reasons and the second is the real one. It reads better - the left column
 becomes the whole argument top to bottom, and the right column is one
 object, the customer's own words. And it is what lets the panel be big:
 with the header outside, the grid row is only as tall as the stats, so the
 quote panel can never be more than ~350px however it is styled. Moving
 ~150px of header into the row is what gives the panel its height.

- The heading names the customer and the month rather than paraphrasing the
 finding. It read "They Closed for the Day. Their Customers Didn't." for one
 round - accurate, and cheesy. A heading that
 paraphrases the finding spoils it: you read the turn of phrase, then the
 number restates it and lands as a repeat instead of as evidence.

⚠️ THE OFFSET GHOST BORDER STAYS. It is the second plane
on the quote panel - a hairline with no fill, rotated the other way, crossing
out of the slab rather than nested inside it. Nested, the two read as one thick
border; crossing, they read as two overlapping objects. It is not a rendering
fault and it is not up for tidying.

⚠️ EVERY NUMBER APPEARS EXACTLY ONCE, and that took rewording. The V2 version
ran "1 in 3" as the second lead stat and repeated 23 in the source line; with
23 promoted to a lead number, the source line would have stated it twice and
the support line would have stated the month three times. 86% and 23 lead, 72
is the denominator underneath them, and the date range lives in the source.

---

## `.proof-section__lead-pair`
<a id="proof-section-lead-pair"></a>

TWO LEAD NUMBERS, NOT ONE. They answer different questions, and together
     they close the page's argument:
       86% -> section 2's thesis is true, these visitors are being missed
       23  -> and it turned into business

     ⚠️ THE SECOND ONE USED TO BE "1 in 3". That is a conversion RATE, and the
     reader has to do arithmetic before knowing whether it is good - one in
     three of what, and is that a lot? 23 is immediately meaningful.

---

## `.proof-section__lead-number`
<a id="proof-section-lead-number"></a>

⚠️ "23 qualified leads / out of 72 conversations" RESOLVES A REAL
               AMBIGUITY, which is why the denominator moved here rather than
               staying a shared footnote.

               The label read "23 — of those became a qualified lead", and "those"
               had two readings: all 72 conversations, or only the 86% that arrived
               after hours. Those are different claims about a named customer (23/72
               vs 23/62). Stating the denominator directly under the number it
               belongs to makes it say one thing.

               72 is still support and still quieter than the number above it — it
               has simply stopped being a floating footnote under both stats. 86%
               carries its own denominator in its own label ("of their
               conversations"), so nothing was taken from it.

---

## `.proof-section__stats-source`
<a id="proof-section-stats-source"></a>

⚠️ NOT A FOOTNOTE TO MINIMIZE. "One customer's results, not an average"
     buys more credibility than the two numbers do - it is the sentence that
     tells a skeptical reader these are real rather than modelled. Do not
     shrink it, move it into a tooltip, or drop it when a second testimonial
     arrives; with two customers it becomes more necessary, not less.

     It sits in the evidence column rather than under the whole grid, where
     it used to be. Full width, it put the source of the numbers further from
     the numbers than the quote was, and a disclaimer that has to be hunted
     for is not doing its job.

     The figures are Synergy Scribes' own, used with permission. CORRECTED
     : the first set - 80%, 110 conversations, 29 leads -
     was inflated by technical faults since found and fixed. Anything still
     quoting 110 or 29 anywhere is stale and wrong.

---

## `.proof-section__quote-inner`
<a id="proof-section-quote-inner"></a>

AN INNER WRAPPER, for exactly one reason: the panel is taller than its
     contents. The column stretches to match the evidence column, so quote and
     attribution sit CENTERED in that height rather than pinned to the top with
     a pool of empty panel underneath.

     It cannot be done by centering the figure's children directly - the quote
     glyph is positioned against its container, so centering the text would
     strand the glyph at the panel's top edge. Anchoring the glyph to this
     wrapper makes mark and words move together.

---

## `.proof-section__cite`
<a id="proof-section-cite"></a>

THE PORTRAIT SITS WITH THE NAME, not beside the quote. Beside a
       five-line quote it floats at mid-height with dead space above and
       below, and the eye has to travel to work out who is speaking. Next to
       the attribution it does the job a face actually does in a testimonial:
       identifying the person at the moment you read their name.

       ⚠️ A SEPARATE HEADSHOT CROP, not object-fit on the full-body original.
       That source is 400x526 of her standing at full length; in a small
       frame her face lands at about 13px, and object-fit cannot zoom past
       the source width - no combination of object-position and transform
       gets a readable face out of it. Both crops ship alongside the
       full-length original she supplied.

---

## `.block`
<a id="block-6"></a>

THE VOICE SHOWCASE WAS DELETED HERE, RESTORING A DECISION THAT
HAD ALREADY BEEN MADE.

⚠️ THIS SECTION SHOULD NEVER HAVE BEEN IN THE V3 BUILD. It was deleted from
the homepage and the wiki recorded it twice - `task-board.md`
closed audit finding 8 with "The whole voice-showcase section was deleted in
the redesign; its content is banked for a future /voice/ page ... Nothing to
decide." The V3 rebuild put it back and wrote "a deliberate call: keep it" into this comment, citing nothing, against a record that
said the question was closed.

The lesson is not about this section. A code comment asserting a decision is
not evidence of one, and it outranks nothing - the wiki is the record. When
the two disagree, check the wiki before acting on the comment, and never write
an attribution without the source that backs it.

The content is not lost: `template-parts/voice-showcase.php` stays on disk,
deliberately, banked for the future /voice/ page the note above describes.
It is now referenced by nothing on the homepage.

The nav's "Voices" item went with it - see the nav array above. That comment
also claimed the item lived in site-nav.php; it is declared inline here.

---

## `.price-includes__label`
<a id="price-includes-label"></a>

Blog Agent is otherwise invisible on the homepage, and a features
       section for it would break the single argument the page was just
       rebuilt around (and reopen audit finding 4). This existing phrase is
       the whole fix - /blog-agent/ already exists and is already in the nav.

       NEW TAB, and this is not a style choice: the
       pricing strip is the moment of purchase intent, so nothing in this
       section may navigate the buyer away from it. Any link added here
       later gets target="_blank" for the same reason.

---

## `.price-includes__item`
<a id="price-includes-item"></a>

SIXTH INCLUSION, AND THE COUNT IS THE POINT. The lead row sits full-width
     above, so the remainder is what fills the three-column grid: five left a
     ragged 3+2 last row, six fills 3+3.

     "AI visibility checks" is the one chosen because it is the term the tier
     columns below use (3 / 10 / 25) and never explain, so a buyer met it for
     the first time as a bare number. True on every paid plan - the allowance
     differs, the inclusion does not.

---

## `.price-includes__footer`
<a id="price-includes-footer"></a>

THE /features/ LINK LIVES HERE NOW, not in a reassurance block at the
     foot of the section. It was bolted onto the "Simple, predictable
     pricing" pair, where it sat beside an add-on billing fact it has
     nothing to do with — one item removes the fear of overage, the other
     removes the fear of not understanding, and an eyebrow over both made
     the pair read as filler.

     This panel is where a first-time visitor MEETS the unexplained terms —
     AI blog posts, AI visibility checks — several hundred pixels before the
     tier columns repeat them as bare numbers. The answer belongs next to
     the question, as one quiet line on the panel's own floor.

     NEW TAB, same rule as every other link in this section: the pricing strip is the moment of purchase intent and
     nothing in it may navigate the buyer away.

---

## `THE TRIAL STRIP THAT SAT HERE IS GONE - the trial is the tab`
<a id="the-trial-strip-that-sat-here-is-gone-the-tria"></a>

THE TRIAL STRIP THAT SAT HERE IS GONE - the trial is the table's first
       column now (see .price-tier--trial above). Keeping both would state the
       same plan twice in two formats, which is the exact problem moving it into
       the table was meant to solve.

       ⚠️ IT ALSO CARRIED "100 text messages/day". That cap was removed from the
       product, the copy and the Terms and is live in production.
       This markup was ported from a branch that PREDATES that change, so the
       port silently reverted it - along with "Every paid plan includes", which
       main had already corrected to "Every plan includes".

       When porting from the V2 branch, re-check anything the unlimited-trial
       rollout touched: that branch is older than main on this subject.

---

## `.price-grid`
<a id="price-grid"></a>

ONE LABEL COLUMN, NOT THREE. He was right and I had talked myself out of it when this table was
 first built: six rows repeated across three columns is eighteen labels for
 six facts, and twelve of them are noise. Repetition at that density stops
 reading as a price table and starts reading as a form.

 So the section is now a real four-column comparison table - a shared label
 rail plus three value columns - and the space that bought is spent on size:
 values went 1.02rem -> 1.35rem, the voice figure 1.65rem -> 2rem, units
 0.72 -> 0.82rem, and the labels dropped uppercase micro-type for sentence
 case at 0.95rem. The uppercase was part of what made them hard to read.

 SUBGRID IS LOAD-BEARING, NOT A FLOURISH. The whole tier column is a click
 target, and that works by stretching the CTA's own ::after across the
 column - which requires .price-tier to remain ONE positioned element
 wrapping all of its rows. So the rows cannot be split into sibling grid
 cells. `grid-template-rows: subgrid` lets each tier keep its single
 element while its rows adopt the parent's tracks, which is what makes them
 line up with the label rail and with each other. See the CSS note.

---

## `.price-grid__labels`
<a id="price-grid-labels"></a>

aria-hidden, and that is deliberate rather than lazy. Each value cell
   still carries its own label as .screen-reader-text, so a screen reader
   hears "Voice minutes, 100 min/mo" inside the column it belongs to
   instead of having to correlate a rail against three columns. Below
   1040px this rail is hidden and those same in-cell labels become
   visible, which is why they are in the markup rather than generated.

---

## `.price-tier`
<a id="price-tier"></a>

THE TRIAL IS A COLUMN NOW, NOT A STRIP.

         It used to present its specs as five bullets - "30 voice minutes, 1 blog
         post, 2 AI voices" - while the paid plans presented the same facts as
         labeled rows. The same information in two incompatible formats, so nobody
         could actually compare the thing they were being asked to start with. As
         the first column every row lines up, and it moves the primary conversion
         path into the most prominent object on the page.

         TREATED AS AN ON-RAMP, NOT A FOURTH PLAN: narrower, muted, "$0 / 30 days",
         and an explicit end state so it never reads as a permanent free tier.

         ⚠️ VALUES VERIFIED AGAINST THE MIDDLEWARE, not inferred from the old card.
         included_seconds: 1800 = 30 min and BLOG_POST_LIMITS.trial = 1 are both in
         config/billing.js. Visibility checks is 3 because routes/visibility.js
         records "an unknown plan falls back to the smallest paid cap", and trial is
         not in its per-plan map - writing an em dash there would have been a false
         claim that the trial gets none.

---

## `THE RAIL'S STUB HEAD, and it earns its place by fixing a rea`
<a id="the-rail-s-stub-head-and-it-earns-its-place-by"></a>

THE RAIL'S STUB HEAD, and it earns its place by fixing a real imbalance
   rather than by labeling something obvious. The label column is ~286px
   wide, so leaving its top cell empty left a dead corner that size and
   pushed the three shopfronts visibly right of the axis the centered
   section header sits on. A stub head is what a comparison table puts
   there anyway.

   LAST IN THE MARKUP, not first, and that is deliberate: the tiers are
   placed by `:nth-child(2|3|4)`, so inserting an element ahead of them
   would silently move every column one to the right. Grid placement is
   explicit, so DOM order costs nothing here.

---

## `.price-footnote`
<a id="price-footnote"></a>

THE ADD-ON FACT, AS A FOOTNOTE TO THE TABLE RATHER THAN A BLOCK UNDER IT.
 It replaces the two-column "Simple, predictable pricing" reassurance row,
 which removed: the two items in it were never a pair,
 so an eyebrow claiming they were made the whole block read as filler.

 This half stays because it answers the one question the Voice row raises,
 and it now sits directly beneath that table as a footnote does — one rule,
 one line, no eyebrow, no icon, no box. The other half moved up to the
 inclusions panel; see the note there.

---

## `$faq_grouped`
<a id="faq-grouped"></a>

SECTION 9 — the FAQ.

⚠️ TWO COLUMNS NOW, WHICH REVERSES A RECORDED DECISION. The note that stood here said "Never two columns of questions", for two
stated reasons. One of them was real and is now designed around; the other does not
apply to this shape:

"the answer they open pushes the other column out of alignment" — TRUE of a
newspaper/masonry flow, where one list wraps across both columns. These are two
INDEPENDENT stacks, each holding whole categories, so opening an answer in the left
column moves only the left column. Nothing it does can disturb the right.

"a reader scanning for their own objection has to track two streams" — this is why
the split is BY CATEGORY and not by item count. A reader is not scanning seventeen
questions; they are looking for the heading that matches their worry and reading
under it. Two categories per column keeps every category whole and in reading order.

The split is 2/2 in DOCUMENT ORDER — Installing it (4) + Can I trust it (4) on the
left, What it does (6) + Cost and commitment (3) on the right. That is 8 and 9, so it
also happens to balance; do not re-sort by count and break reading order to chase a
perfect match.

THE RAIL IS GONE and its CTA moved to the top with the heading. The rail existed to
keep the deflection CTA beside a very long single column; with the list half as tall
there is no long scroll to follow, and a third column beside two would squeeze the
questions into ~390px each. At the top it is seen BEFORE the questions rather than
only by someone who read all seventeen — which was the original complaint about its
old position under the list.

"Ask Our AI" rather than an email address, deliberately: it is the same widget a
visitor would install, so the support path is also a demo.

---

## `.faq-item`
<a id="faq-item"></a>

⚠️ NOTHING SHIPS OPEN. The first question used to,
             on the reasoning that it showed a reader what an answer looks like for
             free. Two things killed that: in two columns one open item makes the
             left column visibly taller than the right for no reason a reader can
             see, and the class it opened with was one the script could not remove,
             so it was permanently expanded rather than merely expanded first.

             SEO is unaffected — every answer is in the DOM either way, which is
             what the FAQPage schema reads. Collapsed is a CSS max-height, not
             absence.

---

## `.btn`
<a id="btn"></a>

⚠️ THERE IS NO SUPPORTING LINE HERE, AND THAT IS THE FOURTH AND FINAL
           ANSWER.

           Three were written and all three failed the same way — they spent their
           length describing the widget instead of saying anything the reader gains:
             1. "Ask ours — it's the same one you'd install, answering from this very site"
             2. "It answers from these pages, day or night — the same assistant you'd install"
             3. "It's already answering on this page. Ask it anything."
           The heading asks the question and the button says what to do. A line
           between them has to earn its place against that, and three attempts could
           not. Do not write a fourth without a reason that is not "it looks empty".

---

## `⚠️ A REAL [sitestaffr_button], REPLACING A BUTTON THAT DID N`
<a id="a-real-sitestaffr-button-replacing-a-button-t"></a>

⚠️ A REAL [sitestaffr_button], REPLACING A BUTTON THAT DID NOTHING. The old
     markup was `<button class="btn btn--outline js-open-chat">` and NOTHING IN THE
     THEME BINDS js-open-chat — grepped: one occurrence, the button itself. So the
     section's only call to action has been inert. A dead control is worse here than
     anywhere else on the page, because the whole claim is that the widget answers
     questions.

     NO persona/button key. The other shortcode on this page passes
     persona="onboarding", which the plugin's configurable-buttons work is currently
     migrating and which nothing seeds yet; this is a support question, so the
     default button is the correct one and also the one guaranteed to exist.

     Two known traps deliberately avoided (both render as an ordinary button, so
     they cannot be spotted by reading the attribute): border_width="1" draws NO
     border, and full_width="on" leaves the container shrink-wrapped.

---

## `.block`
<a id="block-7"></a>

SECTION 10 — the agency door. The one section that did not exist in any form.

   There were ZERO occurrences of "agency" on the homepage or in any template part,
   and lines like "while you're on a job, with a client, or asleep" actively tell an
   agency this product is not for them. (That particular line left the hero on
    for an unrelated reason — see the note there — but the argument holds:
   the page is still written to the plumber throughout.) An agency visitor has just
   read an entire
   page written to a plumber; this is where the page says "and if you're the person
   who BUILDS the plumber's site, here's your version."

   ⚠️ SHAPE, REVISED . THE SECTION IS LIGHT AND THE
   CARD IS THE DARK THING — an inversion of what was here, not a repaint.

   The old note argued two full-bleed dark sections would end the page on an
   undifferentiated slab. That still holds, and this serves it better: a dark card on
   cream is MORE separated from what follows than a dark card on dark ever was.

   The card still says "aside, not your path" — right for ~90% of readers — because
   it is a bounded object rather than a full-bleed band. Full width only stops it
   reading as a narrow interruption.

   NO ROBOT. Three appearances is the ceiling and section 11 owns the third.

   POSITION: BEFORE section 11. An agency who reaches the closing CTA and finds
   nothing for them bounces, and putting the door after the final ask buries it in
   footer territory. The nav item catches the ones who self-classify in the first
   three seconds; this catches the ones who read to the end.

---

## `$agency_props`
<a id="agency-props"></a>

THE PROP FIELD.

TWO DEPTH LAYERS, which is the whole effect: nine props sit BEHIND the card out in
the cream, and three come FORWARD over its edges, so the card is sandwiched rather
than pasted onto a backdrop.

⚠️ TWELVE SEPARATE PNGs, NOT ONE COMPOSITION, and that is deliberate. A single baked
scene is locked to the aspect ratio it was drawn at — which is exactly what killed
the crowd render in the language slot twice. Each prop is positioned against the
SECTION, so re-placing one cannot invalidate the others and none of them are measured
against the card.

⚠️ THE FRONT THREE MUST READ ON #00323A. The sheet contains dark props (the cutting
mat, half the puzzle, the laptop screen) that vanish against the card — those stay in
the back layer on cream. Only light-bodied props come forward.

Shadows are CSS, not baked into the art, so a prop on cream and the same prop on the
dark card can cast appropriately different ones.

Each entry: file, layer, CSS edge pairs, width. Percentages are the SECTION's.

---

## `⚠️ BALANCE IS A COUNT PER SIDE, and the first arrangement fa`
<a id="balance-is-a-count-per-side-and-the-first-arr"></a>

⚠️ BALANCE IS A COUNT PER SIDE, and the first arrangement failed it: six props on
 the right against four on the left and two in the middle, so the right crowded and
 collided while the middle read as a hole. Now 4 left / 3 middle / 3 right / 2 front,
 with the right-hand three spaced top / middle / bottom so none of them touch. If a
 prop is ever moved, re-count — this is the kind of thing that drifts one edit at a
 time.

 ⚠️ ONLY `analytics` SITS ON THE CARD'S FACE. Putting plugin, notes AND coffee up
 there too was tried and reverted — three props crowded onto one
 quadrant read as clutter, and the two small ones lost most of their silhouette
 behind the card's edge. One larger prop overlapping reads as depth; three small
 ones read as a mistake.

 plugin and notes are back in the cream, sat LOW so their full shape is visible
 rather than half-swallowed by the card. The card's bottom-right quadrant is the
 only large bare surface on it — the button is bottom-LEFT and the columns end well
 above the lower edge — so that is where the one overlapping prop goes.

 ⚠️ THE BOTTOM ROW TUCKS UNDER THE CARD'S EDGE, it does not sit down near the
 section's bottom border. Raised : the props were low enough that their
 overlapping bounding boxes stacked across the section's whole bottom band, and with
 any residual haze in the transparent areas that band read as a broken shadow under
 the card. Grouped up against the card the field is tighter AND there is nothing
 spanning that strip to stack in the first place. The empty cream below them is
 deliberate breathing room, not a gap to fill.

 ⚠️ THE FRONT LAYER STRADDLES BOTH SIDES. It was three props, all on the right, because
 the right is the only part of the card with no text ANYWHERE down its height.

 The left works differently: the heading, the three columns and the button occupy
 the middle of the card, but its TOP band (above the eyebrow) and BOTTOM band (below
 the button) are empty across the full width. So the two left-hand front props cross
 the card's top and bottom EDGES rather than its side — wordpress over the top edge,
 swatches over the bottom edge. Verified against real text ink, not block boxes.

 ⚠️ Do not promote `laptop` to the front layer. At 242px it reaches ~150px past the
 card's left edge, which lands squarely on the heading.

 ⚠️ SIZES ARE DELIBERATELY UNEVEN. They previously sat
 between 116 and 182 — a 1.6x spread, which at a glance reads as one size. The range
 is now 74 to 242, a 3.3x spread, with the laptop as the single hero prop and the
 WordPress tile and git node as the smallest. Depth in a scattered field comes from
 scale variance; uniform props read as a pattern rather than as objects.

 ⚠️ NO OUTWARD OFFSET MAY EXCEED -8%, AND THAT IS A HARD CEILING SET BY THE NARROWEST
 WIDTH THE FIELD IS SHOWN AT. The layer is 1140px, so at the 1360px breakpoint there
 is only (1360-1140)/2 = 110px of gutter either side — and 8% of 1140 is 91px. An
 earlier pass used -16% and -17%, which is 182px of bleed into a 110px gutter: at
 1360 and 1440 the laptop, site-stack, swatches and cutting-mat were sliced off by
 the viewport edge and read as cropped images. Measured, not guessed. Raise the
 breakpoint before raising these.

---

## `⚠️ THIS POINT WAS CORRECTED AFTER A CODE CHECK.`
<a id="this-point-was-corrected-after-a-code-check"></a>

⚠️ THIS POINT WAS CORRECTED AFTER A CODE CHECK. It originally read
             "Every client site in one place — switch between the sites you manage
             from a single dashboard." That is TRUE FOR BILLING AND FALSE FOR LEADS:
             /manage/ authenticates on the billing email and its site switcher covers
             plans, minutes and team billing access, but the Follow-ups queue,
             transcripts and Agent Health live in each client's own wp-admin, per
             site. THERE IS NO CROSS-CLIENT LEAD VIEW. Scope every "one place"
             phrase to billing — the first agency to sign up finds out in ten
             minutes, and this is exactly the audience that would say so publicly.

---

## `.block`
<a id="block-8"></a>

⚠️ LIGHT NOW. The page's only remaining dark run is the
   FOOTER.

   That is a real change of intent, not a repaint: the dark used to mark the close,
   and it now marks the chrome. What carries the ending instead is the CARD in
   section 10 above and the curtain at the bottom of this section — the same gesture
   that opened the page under the hero, closing it above the footer.

   Every rgba(240,250,250,...) in this section's CSS was tuned for dark ink and had
   to be re-tuned rather than inherited; see the .final-cta block in site.css.

---

## `.final-cta__robot`
<a id="final-cta-robot"></a>

⚠️ A BACKGROUND FIGURE, NOT A GRID CELL.

     It was the art column of a two-column Split, which caps it at the column's width
     and leaves it floating mid-section. Absolutely positioned against the section
     instead, it can be as large as it likes and sit on the bottom edge.

     ⚠️ THE CURTAIN CROPS HIM, WHICH IS WHY NO MASK IS NEEDED. The artwork ends on a
     hard cut through the thighs. `.final-cta` clips its overflow, so that cut lands
     at the section's bottom edge — and the Book path's baseline is y=120, its full
     depth, at EVERY x. The last row of the section is therefore dark everywhere, and
     the cut sits under it whatever the viewport width. Same mechanism as the hero.
     Pushed past the edge so the cut is comfortably outside the visible area.

     z-index 0, below `.block__inner` and below the curtain, so the copy always wins.

---

## `.section-label`
<a id="section-label-2"></a>

⚠️ REWRITTEN . It read "Be the One That's Still Open / When Everyone Else Has
           Closed" — evocative, and it argued the SAME POINT the page has already made
           twice by this scroll position: section 2 says 86% of conversations arrive
           after business hours, section 4 shows three leads landing overnight. A
           close that re-states the problem asks the reader to be convinced again
           rather than to act.

           So the close now answers the last objection instead: HOW SOON. "Tonight"
           is the promise that matters at this point, and it is true — install is
           minutes and the widget answers immediately.

           An eyebrow was added to match every other section on the page; this was
           the only one opening on a bare heading.

---

## `.final-cta__subtitle`
<a id="final-cta-subtitle"></a>

Third version, a third wording. The two before it both described a
           TIMELINE ("then it works while you don't", "it starts answering the moment
           it goes live") when the heading had already promised tonight. This one
           names the THING the reader is getting instead, and echoes the H1 at the top
           of the page — the reader arrives at the close on the same phrase they
           landed on.

---

## `.final-cta__note`
<a id="final-cta-note"></a>

⚠️ THE ATTRIBUTES WERE WRITTEN FOR A DARK SECTION and stayed behind when this
       one turned cream: background_color="transparent" over a dark panel, plus
       hover_background="#0A424A" — a near-black. On cream that hover flips the button
       to a dark slab under the pointer. Colour is handed to the stylesheet instead
       (see .final-cta__concierge .sitestaffr-button-widget), because this shortcode's
       colour attributes cannot be trusted anyway — border_width="1" is a documented
       no-op. Measure the render; do not read the attribute.

       "Request Assistance", not "Let's Get Started". The old
       label made the same promise as the primary button beside it, so the two read as
       alternative routes to one thing rather than self-serve versus done-for-you.

       ⚠️ persona="onboarding" IS LEFT ALONE deliberately. The plugin's
       configurable-buttons work is migrating personas to button keys and nothing
       seeds this one yet — tracked on the wiki task board as a production blocker.
       Changing it here would be guessing at the far side of a migration in flight.

---

## `.final-cta__privacy`
<a id="final-cta-privacy"></a>

THE TERTIARY LINE IS GONE. It read "Questions? Ask our AI — it's the same
           one you'd install", which is now word-for-word the job of the ask card at
           the end of the FAQ directly above this section — same claim, same widget,
           two screens apart. The FAQ card does it better: it has the robot and a real
           branded button, where this was a grey sentence. Removing it also takes the
           closing stack from nine stacked blocks down to six.

---

# `page-salesforce.php`

## `⚠️ FLAT, WAS A GRADIENT, AND THIS IS A CONTRAST FIX RATHER T`
<a id="flat-was-a-gradient-and-this-is-a-contrast-fi"></a>

⚠️ FLAT, WAS A GRADIENT, AND THIS IS A CONTRAST FIX RATHER THAN A STYLE ONE.
 `linear-gradient(120deg, --teal-deep, --teal-mid)` put white 14.7px and 11.2px
 text on a background that changed underneath it: sampled from the rendered bar,
 #00838F at the dark end is 4.52:1 and #00909F at the light end is 3.83:1. The
 same two labels passed on the left of the bar and failed on the right, which no
 computed-style check can see — `backgroundColor` is `transparent` on an element
 painted by `background-image`, so an auditor walks straight past it to the cream
 and reports 1.02:1 on the wrong background entirely. Only the pixels showed it.
 Flat --teal-deep is 4.52:1 across the whole bar.

---

## `⚠️ A DARK SCRIM, NOT A WHITE ONE, AND ONLY THE FLAT BAR MADE`
<a id="a-dark-scrim-not-a-white-one-and-only-the-fla"></a>

⚠️ A DARK SCRIM, NOT A WHITE ONE, AND ONLY THE FLAT BAR MADE THIS VISIBLE.
 rgba(255,255,255,0.22) over the bar composites to #389EA8, so white text on
 this pill measured 3.16:1 while the same white on the bar beside it measured
 4.52:1 — the pill was lightening its own background out from under its own
 label. No white alpha can fix it: every value lightens, and even 0.14 only
 reaches 3.62. rgba(0,0,0,0.18) gives 6.17:1 and reads as the same quiet badge.

 It only surfaced AFTER the gradient was flattened, because the gradient's own
 failure was larger and masked it. Fixing one layer reveals the next.

---

## `⚠️ NO `padding` HERE ANY MORE.`
<a id="no-padding-here-any-more"></a>

⚠️ NO `padding` HERE ANY MORE. `.block` owns it, and a `padding` SHORTHAND
written on `.sf-section` would beat `.block`'s `padding-block` from anywhere.
This page had a THIRD spacing system (--section-padding) where V3 has one token
per context.
⚠️ `.sf-section--alt` IS GONE WITH ITS MARKUP. It was --cream-dark, a FIFTH
background tone on a site whose whole redesign was five tones down to three. The
section it painted is now the page's one dark run, which is the V3 way of saying
"this part matters" — a slightly different beige is not.

---

## `Steps: a V3 Cards block, UNBOXED ---------------------------`
<a id="steps-a-v3-cards-block-unboxed-same-rule-the-i"></a>

---- Steps: a V3 Cards block, UNBOXED ----------------------------------
Same rule the industry page's pain points moved onto. The white card, the
border, the shadow and the hover lift all go: four steps in a sequence are not
four offers standing side by side, and the box was the only thing saying they
were. The pale icon tile goes with them — an icon on a coloured square is
chrome around chrome once the card is gone.

⚠️ `.sf-step__num` IS DELETED, MARKUP AND CSS. A 2.4rem numeral at 14% alpha
pinned to the top-right corner of a card only reads as a step number while the
corner exists. Unboxed it is a grey smudge floating beside the icon. The order
is carried by the grid and by the heading above it, which is how the industry
page's three problems do it.

---

## `Final CTA: a dark block into the footer --------------------`
<a id="final-cta-a-dark-block-into-the-footer-was-a-b"></a>

---- Final CTA: a dark block into the footer ---------------------------
Was a bordered `.cta-spotlight` card floating on cream — the "bordered CTA card"
the subpage audit lists as a system break, and the same one deleted from
page-industry.php. The page now ends on the dark the footer sits under, so the
CTA and the footer read as one closing run. `.block--dark` + `.block-statement`
supply the background, the white type and the centring; nothing local is left.

---

## `The curtain bracket, on the feature pages ------------------`
<a id="the-curtain-bracket-on-the-feature-pages-scope"></a>

---- The curtain bracket, on the feature pages -------------------------
⚠️ SCOPED TO `.feature-page` RATHER THAN GENERALISED TO `main`. The homepage's
two curtained sections (.block.what-you-get, .block.final-cta) already add the
seam's height in their own rules, so a `main > section:has(...)` selector would
put a second helping on them — and whether it landed would come down to
comparing (0,1,2) against (0,2,0), which is exactly the specificity coin-flip
that has already shipped two silent bugs on this branch.

Same calculation as `.ind-page`'s copy: the peak is 114/120 of the seam's height
clamp, so the section must give it that much room or the shape lands on the last
line of copy.

---

## `⚠️ THE STACKED HERO CENTRES, AND THIS PAGE WAS THE ODD ONE O`
<a id="the-stacked-hero-centres-and-this-page-was-th"></a>

⚠️ THE STACKED HERO CENTRES, AND THIS PAGE WAS THE ODD ONE OUT.
Checked at 390 across the whole converted set: the homepage and all six ind-*
pages centre their hero copy once the two columns become one; `/salesforce/` and
`/blog-agent/` were the only two still `start`, because the centring lives in
`.ind-hero__content`'s own 768 media query and these pages never had one.

768, matching `.ind-hero__content`'s breakpoint rather than the 900 above, so the
two pages change at the same width as the six they now match. Between 769 and 900
the grid is already stacked and stays left — that is deliberate, it is the same
band where the ind-* pages are also still left.

---

## `⚠️ `align-self`, NOT `justify-content`, and `text-align: cen`
<a id="align-self-not-justify-content-and-text-align"></a>

⚠️ `align-self`, NOT `justify-content`, and `text-align: center` does not reach
 it either. Below 560 the actions row becomes `flex-direction: column` with
 `align-items: stretch`; the link is `inline-flex`, so it shrinks to its content
 and parks at the start of a full-width track while the button above it fills
 the track and the copy above that centres. It was the one element left at the
 gutter — visible in the pixels, invisible in the alignment property.

---

# `template-parts/seam-curtain.php`

## `$seam_variant`
<a id="seam-variant"></a>

The curtain seam — the ONLY seam that survives V3.

WHY IT EXISTS AT ALL, when the whole point of the block system is that seams are
expensive: it is tester-sourced. Without it the first screen ends on a hard horizontal
rule where the light hero meets the dark section 2, and testers read that as the page
having stopped. Every other seam on the V2 branch was joining two runs that no longer
exist, so they went; this one is doing a job.

⚠️ IT IS AN ABSOLUTE OVERLAY ON THE HERO, NOT AN IN-FLOW ELEMENT.

It was in-flow for one release, because the V2 seam — a full-width wave — was
absolutely positioned over the hero and sliced a hard horizontal line through the
robot's torso. Moving it into the flow did stop that, at the cost of the thing the
seam is for: an in-flow band cannot be underlapped, so the robot had to be faded out
above it, and's read was that he "is cut off at the waist, which doesn't look
seamless or natural."

BOTH PROBLEMS ARE THE WAVE'S, NOT THE OVERLAY'S. The Book shape below sits LOW at both
edges and peaks at center; the robot stands on the right, where the dark only reaches
the very bottom of the frame. There is nothing on the right for it to slice, so it can
go back over the hero and let the robot stand behind it.

⚠️ THE CURVE'S HEIGHT VARIES ACROSS ITS WIDTH. When checking whether it clips anything,
read the path's y AT THE X YOU CARE ABOUT, not the element's top edge — reading the
element under-reports by the full depth of the curve. This is exactly what the robot's
height is tuned against; see .hero__robot-img in site.css.

preserveAspectRatio="none" lets it stretch to any viewport width, which is why it is
viewport-proportional and why two widths prove nothing about it. Check 390 through 1920.

TWO VARIANTS, ONE SHAPE. Pass `variant => 'close'` for the second one:

'open'  (default) — the dark rises out of the light below. Sits at the BOTTOM of a
                light section, over it. Used at the hero.
'close'           — the dark comes back down into the light. Sits at the TOP of the
                light section that FOLLOWS the dark run, over it.

The close path is the open path mirrored exactly — every y became 120-y — so the dark
run is bracketed by one gesture rather than decorated by two shapes
"the same shape divider but... upside down"; re-asked for the V3 dark block :
"so that the dark sections show a completion with the divider").

⚠️ IF ONE PATH IS EVER EDITED, MIRROR THE OTHER IN THE SAME COMMIT. They are the same
curve and the whole point is that they read as one; a diff that touches only the top
one is invisible until someone scrolls past both.

@package SiteStaffr

---

## `$seam_paths`
<a id="seam-paths"></a>

THE SHAPE IS A "BOOK" / CURTAIN. The dark sits low along both edges and
sweeps up to a sharp point at center, so the page reads as a curtain being drawn up
rather than as a horizon.

THE SHAPE LIVES IN THE CONTROL POINTS, not the endpoints. Both cubics hold their
handles close to the baseline for most of the run (520 and 640 out of 720) and only
then whip up to the apex. That is what produces the long shallow sweep with a sudden
spike; move the handles toward the center and it degrades into a plain hill — which is
the shallow single-arc variant this replaced, and which it was taken off.

---

# `template-parts/site-footer.php`

## `<footer>`
<a id="footer"></a>

THE SHAPE DIVIDER BELONGS TO THE FOOTER.

   It used to be the closing section's: page-landing.php rendered it as the last
   child of .final-cta, and the ind-* conversion had briefly copied that idea onto
   each CTA. That meant every template that wanted the gesture had to remember to
   add it, and three of them did not have it at all. Here it is rendered once and
   appears on every page that uses the footer.

   ⚠️ THE HOMEPAGE COPY WAS DELETED IN THE SAME COMMIT. Two curtains stacked on
   one boundary is not a subtle bug — it is the shape drawn twice.

   Fill is --footer-dark rather than --block-dark, so it matches the footer it
   rises out of. Both sides read the same token and cannot drift.

---

## `.footer-seam`
<a id="footer-seam"></a>

⚠️ THE CURTAIN SITS OUTSIDE <footer>, IN A ZERO-HEIGHT WRAPPER, AND IT HAS TO.
   Rendered as the footer's first child it was completely invisible while being
   perfectly positioned — right size, right fill, offsetParent correct, rect 98px
   above the footer's top edge. `.footer` carries `overflow: hidden`, so an
   absolutely-positioned child hanging ABOVE the box is clipped away entirely.
   Nothing about that shows up in a diff, and elementFromPoint cannot detect it
   either because the seam is pointer-events:none.

   .footer-seam is height:0 and position:relative, so it sits exactly on the
   footer's top edge and the curtain's own `bottom: -1px` hangs it upward over
   the section above. Not clipped, because this wrapper has no overflow of its
   own — and the footer's overflow:hidden is left alone rather than removed,
   since it is load-bearing for the footer's own content.

---

## `.footer__tagline`
<a id="footer-tagline"></a>

Positioning realigned  with the V3 H1. Was "AI voice and text agents
   for service businesses on WordPress" - the superseded framing. This tagline is
   the most-repeated sentence on the site: it renders under EVERY page, so leaving
   it on the old term would have the site contradicting its own headline site-wide.

   "receptionist" never alone - the second clause breaks the ceiling the word sets,
   because the product also writes blogs, sends recaps and speaks.

---

# `template-parts/site-nav.php`

## `$primary_menu`
<a id="primary-menu"></a>

Shared site navigation.

Accepts $args:
'secondary' => array of [ 'label' => string, 'href' => string ] — page-specific links (e.g. anchor links on homepage)

---


# `page-industry.php` (continued)

## `'chat'`
<a id="chat"></a>

The exchange shown in the mockup must not show the agent doing more than
the product does. It answers from site content, captures name, number and
reason, and says a human will follow up. It never books, diagnoses, quotes
an unquoted price, or gives clinical, legal or financial advice.

It also never promises a callback time. There is no scheduling system and
no view of who is on shift, so a time is a commitment the business never
made. The prose beside the mockup may say when the business called back;
the constraint is only on what the agent itself promises.

---

## `$faq_vertical`
<a id="faq-vertical"></a>

Keyphrase-bearing subheading: no H2 carried the page's own target
phrase, so it never appeared in the page's structure.

⚠️ THIS DELIBERATELY NO LONGER MATCHES THE seo_title, AND THAT IS THE
POINT. It used to say "keep this in step with the seo_title pattern in
functions.php"; the Yoast titles moved to "AI
Receptionist for <vertical>" and this H2 stayed on "AI Chat & Voice
Agents for <vertical>".

Retitling 22 indexed pages is the one edit in the positioning sweep
that can LOSE rankings rather than just fail to gain them — these
pages currently earn their traffic on the chat/voice-agent phrasing.
Keeping that phrase in an on-page H2 means the new term takes the
title tag, which is the strongest signal, while the proven one stays
on the page instead of being deleted from the site in a single day.

If the receptionist bet is confirmed by real click and position data,
this H2 is the next thing to move. If it is not, the phrase is still
here to fall back to.

---


# `template-parts/site-nav.php` (continued)

## `'href'`
<a id="href"></a>

⚠️ THE HEADING IS A LINK, AND WITHOUT THIS THE FIVE CATEGORY
HUBS HAD NO PATH FROM THE NAV AT ALL
"I'm unable to access the /for or the /health-medical from
the nav"). They were plain <span>s, so /for/health-medical/
and its four siblings existed, were provisioned, were
indexed and were linked from the footer — and the one menu
that lists every industry could not reach them. The heading
is the only element in the panel that names a category, so
it is the only place the link belongs.

---

## `'label'`
<a id="label"></a>

Agencies is a TOP-LEVEL item, deliberately not inside the Industries
dropdown. Agencies are an audience, not an industry: they are not in
sitestaffr_industry_registry, and putting them there would drop them
into section 6's list of sixteen businesses alongside dental practices
and salons, which is the wrong shelf.

It sits before Blog and About because it is the only nav item addressing
the second audience, and the ones who self-classify do it in the first
few seconds — after that they are reading a page written to a plumber.

---


# `page-landing.php` (continued)

## `'sameAs'`
<a id="sameAs"></a>

Entity disambiguation: sameAs tells Google which third-party profiles are
this entity, which matters because a similarly named company competes for
the same query.

Only list URLs verified BY CONTENT, not by status code. Several of these
hosts return 200 with a generic title for a handle that does not exist, and
some answer differently depending on user-agent. A profile also has to say
something about the entity: an empty one corroborates nothing and spends
crawl trust. A dead or empty sameAs is worse than none.

---


# `404.php` (additional notes)

## `$nf_links`
<a id="nf-links"></a>

Where a lost visitor is most likely to be headed. Ordered by commercial
intent, not by nav order: someone who mistyped a URL is further along than
someone reading About.

---


# `assets/js/demo-timings.js` (additional notes)

## `Pest control on purpose. Section 2's grid has no pest-co`
<a id="pest-control-on-purpose-section-2-s-grid-has-n"></a>

Pest control on purpose. Section 2's grid has no pest-control card, so this is the
better contrasting second example — section 2 says what one job is worth, section 3
lets you watch a different one arrive.

---

## `The summary and the follow-up genuinely ARE generated af`
<a id="the-summary-and-the-follow-up-genuinely-are-ge"></a>

The summary and the follow-up genuinely ARE generated after the conversation ends,
so they arrive last and after a brief shimmer. That is not decoration; it is the
one part of the sequence that mirrors how the product actually works.

---


# `assets/js/manage.js` (additional notes)

## `BOTH SPELLINGS ON PURPOSE. Stripe reports canceled; ot`
<a id="both-spellings-on-purpose-stripe-reports-cance"></a>

⚠️ BOTH SPELLINGS ON PURPOSE. Stripe reports `canceled`; other paths have sent
`cancelled`. This line checked both, and a spelling sweep collapsed it into the
same test twice — which reads as a harmless duplicate and quietly stops matching
half the statuses it was written to catch.

---


# `assets/js/site.js` (additional notes)

## `reveal()`
<a id="reveal"></a>

THE FLASH IS WHAT MAKES THIS AN ARGUMENT RATHER THAN AN ANIMATION. Without
linking the filled field back to the line that produced it, the right panel
just looks like it is moving for decoration.

---

## `revealPanels()`
<a id="revealPanels"></a>

Retire the stage. ONE WAY ONLY — once the panels are up they stay up, including
after the demo finishes. Reverting to the stage on stop would take the assembled
recap away at the exact moment it has finished assembling, which is the payoff the
whole section is built around. Replay is the transport's job, not the stage's.

---

## `The stage button and the transport button both call play`
<a id="the-stage-button-and-the-transport-button-both"></a>

The stage button and the transport button both call play; the stage's press adds
the chime because that press is the one that "opens the widget". Focus moves to the
transport afterwards so a keyboard user is not left on a button that has just
removed itself from the page.

---

## `Everything above is wired. Only NOW is it safe to swap t`
<a id="everything-above-is-wired-only-now-is-it-safe"></a>

Everything above is wired. Only NOW is it safe to swap the fully-rendered
panels for the empty, playable version — so a throw anywhere earlier leaves
the reader with a complete section rather than two empty boxes.

---

## `Feature-detect the METHOD, not the element. A <dialog> t`
<a id="feature-detect-the-method-not-the-element-a-di"></a>

Feature-detect the METHOD, not the element. A <dialog> tag parses everywhere;
older browsers simply render it inert with no showModal, which would throw on
the first click and leave the reader with a dead row.

---

## `Click-outside-to-close. The dialog element fills the top`
<a id="click-outside-to-close-the-dialog-element-fill"></a>

Click-outside-to-close. The dialog element fills the top layer, so a click
landing on the DIALOG itself rather than on the sheet inside it is a click on
the backdrop. Comparing against the sheet is what makes this reliable —
event.target === dlg is true only outside .recap-doc__sheet.

---

## `Focus returns to the row that opened it. Browsers restor`
<a id="focus-returns-to-the-row-that-opened-it-browse"></a>

Focus returns to the row that opened it. Browsers restore focus to the opener
for showModal, but not after a programmatic close in every engine, and
landing back at the top of the document loses a keyboard reader their place.

---


# `functions.php` (additional notes)

## `sitestaffr_asset_url()`
<a id="sitestaffr-asset-url"></a>

Build a theme asset URL with file modification time for cache busting.

---

## `$is_agencies`
<a id="is-agencies"></a>

The agencies page uses the FAQ accordion and the shared nav, both of which are
driven by site.js. Adding the template here rather than relying on the landing
page's enqueue - a template that renders interactive components and is not in
this list ships them dead, which is how the /for/ index once shipped with its
entire directory invisible.

---

## `$provision_version`
<a id="provision-version-2"></a>

Provision the /salesforce marketing page and its SEO metadata.

Same versioned-option pattern as the Blog Agent page above.

---

## `Yoast owns title and meta, as everywhere else. ⚠️ DELIBE`
<a id="yoast-owns-title-and-meta-as-everywhere-else-d"></a>

Yoast owns title and meta, as everywhere else. ⚠️ DELIBERATELY NOT TARGETING
"white label ai chatbot wordpress" — high-intent, and the product cannot satisfy
it today, so ranking for it buys bounces and a reputation for overclaiming.
Revisit only if white-label is ever built.

---

## `"Home Service BUSINESSES", not "Home Services" — this hu`
<a id="home-service-businesses-not-home-services-thi"></a>

⚠️ "Home Service BUSINESSES", not "Home Services" — this hub and the
/for/home-services/ industry page below it are two different URLs, and the
old titles told them apart only by the plural in "Agents"/"Agent". Moving
both to "AI Receptionist for ..." collapsed that distinction into two
identical title tags. Matches this group's h1.

---

## `sitestaffr_read_time()`
<a id="sitestaffr-read-time-2"></a>

Estimated reading time in whole minutes.
See docs/implementation-notes.md#sitestaffr-read-time

---


# `page-agencies.php` (additional notes)

## `.block-split__art`
<a id="block-split-art"></a>

⚠️ NO NEW RENDER AND NO ROBOT. The robot's three appearances belong to
     the homepage. This is a grid of browser-window cards built in HTML,
     reusing the browser-and-speech-bubble motif that already ties the
     sixteen industry isometrics together.

---

## `THIS FORM NEEDS ITS OWN DESTINATION. The homepage concie`
<a id="this-form-needs-its-own-destination-the-homepa"></a>

⚠️ THIS FORM NEEDS ITS OWN DESTINATION. The homepage concierge form
     routes to onboarding with a 3-business-day reply; an agency asking
     about reseller terms landing in that queue gets answered as if they
     were a small business wanting setup help. Logged in the backlog.

---

## `.block`
<a id="block-9"></a>

Closing CTA: dark, echoing the homepage's structure with the agency ask. PRIMARY
  IS THE FREE TRIAL because trying it on their own site first is the natural agency
  motion — it is FAQ #10 and the honest recommendation. Secondary is the partner
  conversation.

---


# `page-blog-agent.php` (additional notes)

## `.ba-hero`
<a id="ba-hero"></a>

⚠️ FLAT CREAM. The radial teal wash and the warm-white-to-cream vertical gradient
are both DELETED, same call as the industry and Salesforce heroes: decoration doing
no work, and a hero that fades into the section below replaces a decision with a
smudge. It also stops this being the only cream on the site that is not flat.

---

## `.block.ba-hero`
<a id="block-ba-hero"></a>

⚠️ TWO CLASSES. `.block:not(.block--dark)` is (0,2,0) and beats a bare `.ba-hero`
whatever the source order. Same first-section-under-the-nav value as the other
converted heroes.

---

## `#0f6848, NOT --emerald. --emerald (#10b981) on --emerald`
<a id="0f6848-not-emerald-emerald-10b981-on-emerald"></a>

⚠️ #0f6848, NOT --emerald. --emerald (#10b981) on --emerald-light measured
2.24:1 at 11.5px bold — the worst contrast anywhere on the converted set. The
colour is not new: it is what .sf-card__foot already uses for exactly this
pairing on the Salesforce mockup, so the two product mockups now agree. 5.9:1.

---

## `.ba-section`
<a id="ba-section"></a>

⚠️ NO `padding` HERE. `.block` owns it, and a `padding` SHORTHAND on `.ba-section`
beats `.block`'s `padding-block` from anywhere in the file. --section-padding was
this page's third spacing system.

---

## `0.55 MEASURED 3.86:1 ON THE CARD, NOT ON THE BLOCK. The `
<a id="0-55-measured-3-86-1-on-the-card-not-on-the-bl"></a>

⚠️ 0.55 MEASURED 3.86:1 ON THE CARD, NOT ON THE BLOCK. The day chip sits on
rgba(255,255,255,0.08) over rgba(255,255,255,0.06) over --block-dark, which
composites to #224E55 — lighter than the section, so reading the section's
colour understates the problem. 0.68 is 4.89:1 and the off days stay clearly
quieter than the two lit ones.

---

## `.ba-hero__seclink`
<a id="ba-hero-seclink"></a>

⚠️ `align-self`, NOT `justify-content` — and `text-align: center` does not reach
it. Below 560 the actions row is `flex-direction: column` + `align-items:
stretch`; the link is `inline-flex`, so it shrinks to its content and parks at
the start of a full-width track while everything around it centres.

---

## `OPEN: the dark run rises out of the cream. Direct child `
<a id="open-the-dark-run-rises-out-of-the-cream-direc"></a>

OPEN: the dark run rises out of the cream. Direct child of the SECTION,
          not of .block__inner — the inner is width-capped, so inside it the
          curtain would stop short of both edges on a full-bleed boundary.

---


# `page-for.php` (additional notes)

## `.block`
<a id="block-10"></a>

Closing CTA is a V3 dark block running into the footer, same as
   page-industry.php. ⚠️ CONVERTED IN THE SAME COMMIT ON PURPOSE:
   .ind-cta is shared across all three ind-* templates, so moving its
   background onto .block--dark would have left whichever template still
   carried the old markup with no background at all.

---


# `page-get-started.php` (additional notes)

## `.form-success__text`
<a id="form-success-text"></a>

Three business days, matching the homepage closing CTA. These two are the
          only places the response-time commitment is stated, and they
          disagreed - this said "one business day" while the current promise is three.
          A commitment stated in two places drifts; if it changes again, grep for
          "business day" and change both.

---


# `page-industry-category.php` (additional notes)

## `.block`
<a id="block-11"></a>

Closing CTA is a V3 dark block running into the footer, same as
   page-industry.php. ⚠️ CONVERTED IN THE SAME COMMIT ON PURPOSE:
   .ind-cta is shared across all three ind-* templates, so moving its
   background onto .block--dark would have left whichever template still
   carried the old markup with no background at all.

---


# `page-industry.php` (additional notes)

## `House pattern: a situational scene, not a product claim,`
<a id="house-pattern-a-situational-scene-not-a-produc"></a>

House pattern: a situational scene, not a product claim, and the second
sentence is the one that stings. No telephony — the recruiters going home is
the problem, not an unanswered switchboard.

---

## `schema.org EmploymentAgency. ⚠️ NOT a Medical* type — th`
<a id="schema-org-employmentagency-not-a-medical-type"></a>

schema.org EmploymentAgency. ⚠️ NOT a Medical* type — the agency places
clinicians, it does not treat anyone, and typing it as a medical business
would misdescribe it. (This field is currently set on all sixteen entries and
read by nothing; kept for consistency, flagged separately.)

---

## `Same rules as every other chat in this file: answers fro`
<a id="same-rules-as-every-other-chat-in-this-file-an"></a>

Same rules as every other chat in this file: answers from site content,
captures name + number + reason, says a human will follow up, and PROMISES NO
TIME. Note what it refuses to do — it confirms the coverage AREA, which the
site publishes, and says nothing about whether anyone is actually free, which
only the bench can answer. That restraint is the FAQ below made visible.

---

## `.block__inner`
<a id="block-inner-2"></a>

CLOSE: the dark run comes back down into the cream. Top of section 5,
    over it. Same curve as the open one, mirrored — the pair brackets the
    dark run as ONE gesture rather than decorating it with two shapes.
    ⚠️ If either path is ever edited, mirror the other in the same commit.

---


# `page-landing.php` (additional notes)

## `Per year, for the same reason as the dental card above. `
<a id="per-year-for-the-same-reason-as-the-dental-car"></a>

Per year, for the same reason as the dental card above. Same AVMA source
        and same edition as before — only the metric moved from "last visit" to the
        annual figure. ⚠️ It is VETERINARY spend specifically, not total pet spend:
        AVMA reports ~$1,700 a year on pets overall, of which veterinary care is
        32.4%. Quoting the $1,700 here would be a different and much weaker claim.

---

## `ABSORBS THE SALESFORCE BAND removed from section 4. "Doe`
<a id="absorbs-the-salesforce-band-removed-from-secti"></a>

ABSORBS THE SALESFORCE BAND removed from section 4. "Does it fit my stack"
        is a buying question and belongs here, not under a story about a bakery
        owner asleep at 2 AM.

---

## `.hero`
<a id="hero-2"></a>

"Voices" -> #voices went with the voice showcase. A nav item is
the one kind of link that cannot survive its target: it is present on every
scroll position, so a dead anchor here scrolls nowhere and looks like a broken
page rather than a missing section. Nothing replaces it - the secondary nav is
short on purpose, and Pricing is the item that serves the conversion path.

---

## `.block__inner`
<a id="block-inner-3"></a>

⚠️ THE HERO'S CURTAIN LIVES HERE, not in the hero — see the note at the end of
    the hero for why. It hangs upward out of this section by its own height minus
    3px, so the shape reads exactly as before and the last 3px of it sit INSIDE
    this section, covering the boundary row at every device pixel ratio.

---

## `.section-label`
<a id="section-label-3"></a>

Eyebrow was "The Hidden Cost of Lost Website Visitors", and on the V2 branch
          "What One Job Is Worth". Both described the RIGHT column while the heading
          described the left — two arguments stacked, and the reader had to work out
          which one the section was about. This one describes the section.

---

## `.cost-section__text`
<a id="cost-section-text-2"></a>

SETS UP THE AUDIT, and does not restate the hero. It also does not attack
          "we'll get back to you" — that would be a self-own,
          since SiteStaffr's own conversations end with details captured and a human
          following up. The difference is WHEN the visitor gets their answer.

---

## `.cost-section__text`
<a id="cost-section-text-3"></a>

The best copy on the site — do not rewrite it. "no missed call" is correct
          here and must survive the "call" sweep: it is describing the ABSENCE of a
          phone signal, which is the point, not claiming the product answers phones.

---

## `.block-split__art`
<a id="block-split-art-2"></a>

2x2, AND THE GRID SHAPE IS PART OF WHY THIS WORKS. A previous pass replaced
        these with a single time-ordered column and it read as overwhelming despite
        running FEWER words — four boxes are four glances, four stacked rows are a
        paragraph with rules between them. Scannability is not word count.

---

## `.see-it__stage-play`
<a id="see-it-stage-play"></a>

A real <button> with a real accessible name. The label says what it plays,
        not "play" — this is the only control in the section at rest, so it is the
        one thing a screen-reader user has to understand from its name alone.

---

## `.see-it__col`
<a id="see-it-col"></a>

LEFT: the conversation. The two column labels do the arguing — "On your
        website" / "In your inbox" states the value exchange in four words and
        kills the phone-line ambiguity for free.

---

## `.see-it__line`
<a id="see-it-line"></a>

RENDERED FULLY POPULATED IN PHP. JS empties it on load only when it
              is actually going to animate it. An empty panel that fills only when
              a script runs re-creates exactly the failure the reveal system caused
              in production. With JS off, or under prefers-reduced-motion, the
              whole conversation and the whole recap are simply here.

---

## `.see-it__col`
<a id="see-it-col-2"></a>

RIGHT: the recap. the strongest idea and the best one in the session — it
        assembles as the conversation plays, which makes the causal link visible:
        you watch the visitor give their email, and the email appears.

---

## `.see-it__gen`
<a id="see-it-gen"></a>

The summary and follow-up genuinely ARE generated after the conversation
            ends, so they arrive last, after a brief shimmer. That is the one part
            of the sequence that mirrors how the product actually works.

---

## `.what-you-get__subtitle`
<a id="what-you-get-subtitle"></a>

THE SUBTITLE IS LOAD-BEARING and was cut once before for looking like
        filler. It actively guards against the reading that leads queue up and
        get handled at opening time — "answered within seconds and sent to you
        the moment it ended" is the whole product claim, and without it an inbox
        labeled "Overnight" implies exactly the opposite.

---

## `.morning-inbox__row`
<a id="morning-inbox-row-3"></a>

A REAL <button>, not a click handler on the <li>. It is the row's whole
            surface, so the row stays one target, but it takes focus, fires on
            Enter and Space for free, and announces as a control. The row was a
            plain <li> before, so nothing about the no-JS rendering regresses if
            the script never runs — see the CSS note on .is-interactive.

---

## `.recap-doc`
<a id="recap-doc-2"></a>

No "View recap →" span here any more. The row's
              affordance is a chevron drawn as `.morning-inbox__row::after`, at
              every width and on every device. Do not add a label back: it only
              ever appeared on hover, which is a state most of this page's traffic
              cannot produce.

---

## `.recap-doc__print`
<a id="recap-doc-print"></a>

V1's teal "Print / Download PDF" pill. It is a <span> there and a <span>
            here: the real button lives in the emailed recap, and a control on this
            page that looked live but printed nothing would be a lie about the
            product. It is part of the picture of the document, not a feature of
            the marketing site.

---

## `.what-you-get__callout`
<a id="what-you-get-callout-2"></a>

KEEP THIS ONE INTACT. Nothing else on the page says that conversations
        which did NOT turn into a lead are still reported, and that is the
        difference between a lead tool and a record of everything that happened.

---

## `.lang-section__english`
<a id="lang-section-english-2"></a>

KEPT, and moved under the stage where it closes the section. It answers the
      owner's immediate objection — "great, but I can't read Mandarin" — and it is
      the one line here that is about THEM rather than about the visitor. Deleting
      it with the old layout would have thrown away the reassurance and kept only
      the spectacle.

---

## `.industries__stage`
<a id="industries-stage-2"></a>

ROW 1 — the isometric and its excerpt, side by side. The excerpt used to sit
      UNDER the image inside the art column; beside it, the pair reads as one card
      and the row stays short.

---

## `$ind_is_open`
<a id="ind-is-open-2"></a>

⚠️ A MISSING RENDER MUST NOT PRODUCE A BROKEN IMAGE. Medical Staffing is
        the sixteenth industry and its isometric is generated but not yet keyed,
        so the file genuinely is absent right now. sitestaffr_industry_art_url
        returns '' when the file does not exist, and the panel falls back to the
        industry's emoji at display size rather than an alt-text box.

---

## `.industries__excerpt`
<a id="industries-excerpt-2"></a>

The excerpt is now a SIBLING of the art, not a child of it — that is what
        puts it beside the isometric instead of under it. It is still rendered
        twice in total (once here for the pointer layout, once inside each mobile
        accordion item below), and both still come from the same registry field.

---

## `.industries__link`
<a id="industries-link-2"></a>

ONE link, at the end, NEW TAB, with per-industry text rather than
                a generic "learn more" — per the happy-path rule, this is a
                deliberate exit and it should say where it goes.

---

## `.industries__mobile-detail`
<a id="industries-mobile-detail"></a>

THE MOBILE EXPANSION. Rendered for every industry and hidden by
                    CSS at desktop widths, so with no JS at all a phone visitor
                    still gets every blurb and every link — the accordion is a
                    progressive enhancement over a plain list, not a requirement
                    for reading it. Image is ~200px here, not 440.

---

## `.proof-section__lead-number`
<a id="proof-section-lead-number-2"></a>

"after business hours", not "after they closed".
              Clearer, and it now matches the language of the quote beside it —
              Nathaly says "after hours is when most new facility inquiries come
              in", so the stat and the customer describe the same thing the same
              way instead of two ways.

---

## `.block-split__art`
<a id="block-split-art-3"></a>

The quote CORROBORATES the number rather than introducing it, so it sits
  beside and reads quieter. Two overlapping planes: the slab, and the ghost
  hairline crossing out of it. The slab is a real element rather than a
  pseudo because this figure's own ::before is already the quote glyph.

---

## `.pricing-section__subtitle`
<a id="pricing-section-subtitle"></a>

⚠️ THE MIDDLE SENTENCE RESTATED THE HEADING. It read "After that a busy
        month costs the same as a quiet one" — which is exactly what "One Flat Price"
        says two lines above, in more words and less plainly. Cut. What is left is
        the two things the heading does NOT cover: the trial terms, and the single
        axis that actually varies between plans.

---

## `The paid ladder is three tiers, so the grid is three col`
<a id="the-paid-ladder-is-three-tiers-so-the-grid-is"></a>

The paid ladder is three tiers, so the grid is three columns and the free
trial is not a fourth card competing with them. Nothing is lost: every
allowance the trial card listed is still here, and so is its link to
/download/, which is the URL that must not change.

---

## `.price-tier__best-for`
<a id="price-tier-best-for"></a>

"Ends after 30 days unless you pick a plan" removed:
        obvious from "$0 / for 30 days" directly above it. The spec asked for an
        explicit end state here so the column could never read as a permanent free
        tier - the identity row already says it, so the sentence was saying it
        twice in the narrowest column on the page.

---

## `.block`
<a id="block-12"></a>

Group the flat list, then deal the groups into two columns. The JSON-LD above stays a
FLAT mainEntity list regardless — FAQPage has no grouping concept, and the schema must
not learn about this presentation.

---

## `.faq-list__set`
<a id="faq-list-set-3"></a>

⚠️ THIS WRAPPER EXISTS ONLY SO THE GROUP CAN BE A CARD BELOW 900px. The items used to be flat siblings of their heading, which
              on a phone made sixteen identical white cards with three small gray
              labels lost among them. It is inert on desktop — see .faq-list__set,
              which does nothing until the columns collapse.

---

## `.faq-section__ask`
<a id="faq-section-ask-2"></a>

AFTER the questions, not before them. It was in the header for one release
      and read as an interruption on the way to the list. See the CSS note for the
      full history of this element's position — it has moved three times.

---

## `.faq-section__ask-robot`
<a id="faq-section-ask-robot-2"></a>

The texting robot, not the language one or the hero one: this card is about
        asking a question in a chat, and robot-text.webp is the render of exactly
        that — typing, with message bubbles. Decorative, so aria-hidden; the card's
        own copy and the button carry the meaning.

---

## `Back layer — out in the cream, several bleeding off the `
<a id="back-layer-out-in-the-cream-several-bleeding-o"></a>

Back layer — out in the cream, several bleeding off the viewport edges.
⚠️ Keep every `top`/`bottom` clear of 0-4%: the section clips its overflow, so a
prop nearer the edge than that gets sliced off flat and reads as a broken image
rather than as a prop peeking in. Bleeding off the LEFT and RIGHT is fine and
intended — that is horizontal, and there is nothing above or below to bleed into.

---

## `.agency-door__props`
<a id="agency-door-props-2"></a>

Front layer — over the card. ALL THREE ARE ON ITS RIGHT-HAND SIDE, because that is
the only part of the card with no text: the heading, the three columns and the
button all sit left of it. All three are also light-bodied, so they read against
#00323A — the dark props stay in the back layer on cream.

---

## `The H1, pluralised. An agency who scrolled past the hero`
<a id="the-h1-pluralised-an-agency-who-scrolled-past"></a>

The H1, pluralised. An agency who scrolled past the hero recognizes the
        offer instantly, and "every client site" is the phrase that makes it
        theirs rather than their client's.

---

## `.agency-door__lead`
<a id="agency-door-lead"></a>

CUT. It ran on into "— and what
        makes renewal conversations easier", which the third point below makes
        properly; a lead that previews the list makes the reader read it twice.

---

## `.agency-door__points`
<a id="agency-door-points"></a>

⚠️ ALL THREE POINTS WERE VERIFIED AGAINST THE CODE, and what
        is NOT claimed matters as much as what is. None of them mention margin,
        reseller pricing, white-label or bulk billing, because none of those exist.
        An agency is a technical, skeptical audience that checks.

---

## `.btn`
<a id="btn-2"></a>

"See SiteStaffr for Agencies", NOT "See agency plans". The second would
        promise a pricing page that would then have to be invented. If the agency
        page's contact form generates real demand, that is the signal to build
        reseller pricing — the page is the demand-validation mechanism.

---

## `.btn`
<a id="btn-3"></a>

PRIMARY. data-cta makes this a swappable trigger rather than a hard-coded
          link: the target funnel is pricing -> checkout modal -> purchase, with
          /download/ becoming post-purchase instructions. When checkout exists this
          is a one-line change at four call sites.

---

## `.final-cta__concierge`
<a id="final-cta-concierge"></a>

SECONDARY. Still the real onboarding widget - the shortcode is the working
          mechanism and is not worth reimplementing - but demoted to an outline
          treatment and stripped of the shimmer.

---


# `page-salesforce.php` (additional notes)

## `.sf-hero`
<a id="sf-hero"></a>

⚠️ THE TWO RADIAL GRADIENTS ARE DELETED, NOT HIDDEN — same call as the industry
hero's __accent and __glow. Teal washes at 14% and 10% are decoration doing no
work; V3 carries emphasis with a dark block. They also made this the only cream
on the site that was not flat, so the boundary into section 2 was a fade rather
than a decision.

---

## `.block.sf-hero`
<a id="block-sf-hero"></a>

⚠️ `.block.sf-hero`, TWO CLASSES. The padding is owned by
`.block:not(.block--dark)` at (0,2,0) and a bare `.sf-hero` at (0,1,0) loses to
it whatever the source order — `:not()` contributes its argument's specificity.
The extra top is the same first-section-under-the-nav exception the industry
hero carries, and the same value, so the two open identically.

---

## `.sf-setup`
<a id="sf-setup"></a>

Unboxed like the steps. ⚠️ THE NUMBERED DISC STAYS: it is a FILL, not a box, and
it is the only thing that makes three parallel instructions read as an ordered
sequence — which is the section's entire claim ("connected in about a minute").

---

## `OPEN: the dark run rises out of the cream. Direct child `
<a id="open-the-dark-run-rises-out-of-the-cream-direc-2"></a>

OPEN: the dark run rises out of the cream. Direct child of the
          SECTION, not of .block__inner — the inner is width-capped and
          gutter-padded, so inside it the curtain would be 1140px wide on a
          full-bleed boundary and stop short of both edges above the cap.

---

## `.block__inner`
<a id="block-inner-4"></a>

CLOSE: the dark run comes back down into the cream. Same curve
          mirrored, so the pair brackets the run as ONE gesture. ⚠️ If either
          path is edited, mirror the other in the same commit.

---

## `.block`
<a id="block-13"></a>

⚠️ `.faq-section__head`, NOT `__header`. The `__header` spelling has no
      rule anywhere in site.css — another class that outlived its rule, so
      this header was rendering unstyled and left-aligned.

---


# `template-parts/site-nav.php` (additional notes)

## `.nav__mega-all`
<a id="nav-mega-all"></a>

The arrow is not decoration: this row sits below sixteen
              industry names and read as a seventeenth one. it was not possible to
              find /for/ from the nav even though this link has always been
              here. An arrow is the one mark that says "this goes somewhere
              else", which is what separates it from the list above it.

---


# `template-parts/voice-showcase.php` (additional notes)

## `NEVER "callers" IN THESE DESCRIPTIONS. SiteStaffr has no`
<a id="never-callers-in-these-descriptions-sitestaffr"></a>

⚠️ NEVER "callers" IN THESE DESCRIPTIONS. SiteStaffr has no phone line - the
  readme leads with "No phone lines" - and with "AI Receptionist" in the homepage
  H1, the word puts the product in the phone-answering category, which is crowded,
  different and more expensive. These are voices a VISITOR hears on a website.
  Swept.

---

