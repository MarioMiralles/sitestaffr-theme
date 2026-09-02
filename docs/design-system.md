# Design system notes

Why the CSS in `assets/css/site.css` is the way it is.

These notes used to live as long comments inside the stylesheet. They were moved here so the
stylesheet reads as tokens and selectors, and so the reasoning can be read on its own. Each
heading is the selector or token the note belongs to, and the stylesheet links back to it.

Most of these are constraints rather than history: they explain what breaks if a value moves.

---

## `--subtext-measure: min(40em, 100%);`
<a id="subtext-measure"></a>

One measure for every marketing subtitle on the site. Before this the same kind of subtext
under an h2 used 480, 520, 540, 560, 580, 600, 620 and 680px with nothing distinguishing
the cases, and several had no cap at all.

- `min(..., 100%)` never exceeds a smaller parent. Subtext dropped into a narrow column,
  a card or a modal shrinks to fit instead of being capped at a number chosen for a
  full-width section.
- `em` resolves against the ELEMENT'S OWN font-size, so every subtitle gets the same
  reading measure rather than the same pixel count. These range from 1rem to 1.15rem, and
  a fixed 680px silently meant ~72 characters on one and ~62 on another - the same number
  describing two different things, which is how the drift started.

---

## `--text-muted: #677488;`
<a id="text-muted"></a>

⚠️ #677488, DARKENED FROM #718096 FOR CONTRAST (accessibility pass).
At the old value it measured 3.88:1 on the cream and 4.02:1 on white, against a 4.5
requirement — it failed everywhere it was used, which is most of the small print on
the page: inbox timestamps, group headings, stat captions, the pricing footnote.
#677488 is the FIRST step dark enough to clear 4.5 on both (4.56 and 4.61); anything
lighter fails the cream, which is the harder of the two backgrounds.

---

## `--teal-text: #00747E;`
<a id="teal-text"></a>

⚠️ TEAL AS TEXT ON A LIGHT BACKGROUND, and it is deliberately NOT --teal-deep.
#00838F is the brand fill and it stays exactly that — buttons, pills, the seam. As
TEXT it measures 4.38:1 on the cream, which fails. Rather than darken the brand
color everywhere a fill uses it, this is a separate token for the text case only.
⚠️ #00747E, NOT #007A85, AND THE REASON IS THE INBOX. #007A85 cleared the cream at
4.93 but landed on 4.49 for `.morning-inbox__count` — one hundredth short, because
that one sits on the inbox card's beige chrome rather than on the section. The token
is set by its WORST background, not its most common one. If teal text turns up
somewhere new and fails an audit, point it here rather than widening --teal-deep's
job — and re-check every existing use, since this value is a floor for all of them.

---

## `--block-pad: 64px;`
<a id="block-pad"></a>

ONE section-padding value, and it is a FIXED 64px.

NOT a clamp. A viewport-proportional value is why the same section looked
correct at 1150 and cavernous at 1920 — the padding grew while the type did not.
64px is 64px everywhere, which is the consistency that was asked for.

THE HERO IS EXEMPT and sets its own padding; it is composition, not rhythm.
Sections carrying a seam overlay add the seam's height ON TOP of this so the
visible gap below the divider is still 64px — see .what-you-get.

---

## `.block:not(.block--dark) { padding-block: var(--block-pad-light); }`
<a id="block-not-block-dark"></a>

⚠️ THE LIGHT RUN GETS MORE AIR THAN THE DARK, AND THAT IS NOT AN INCONSISTENCY.

Sections 4-9 all sit on the same cream. Nothing marks where one ends and the next
begins except the gap itself, so the padding is doing the ENTIRE job of separating
them. The dark sections do not have that problem: 2-3 and 10-11 are bounded by a
color change and a curtain, which separate them for free.

---

## `@media (max-width: 1024px)`
<a id="media-max-width-1024px"></a>

⚠️ THE SCALE STEPS DOWN TWICE BELOW THE DESKTOP LAYOUT.

⚠️ LIGHT MUST STAY CLEARLY LARGER THAN DARK at every step, and the reason is the same
one that created the second token: nothing marks where one cream section ends and the
next begins except the gap. The ratio is held near 1.4 throughout. Shrinking these
toward each other is what makes the cream run read as one long section again.

⚠️ ANY HARDCODED 64 OR 96 IN A SECTION'S OWN PADDING DEFEATS THIS. Two existed and are
now `var` calls — .block.what-you-get and .block.final-cta, both of which add a
seam's height on top of the scale. Grep before adding a third.

---

## `.block--dark + .block--dark { padding-block-start: var(--block-pad-run); }`
<a id="block-dark-block-dark"></a>

Adjacent dark blocks must not draw a line between themselves — they are one
dark run visually, two blocks structurally.

⚠️ ZERO WAS TOO LITTLE. At `0` the whole gap between the two was the FIRST block's 64px bottom
padding, and 64px is what separates a section from a section it has a color change
against. These two share one dark background, so — exactly as with the cream run — the
spacing is doing the entire job of separating them and has to be larger, not smaller.

32px here plus the previous block's 64px gives 96px, which matches the cream run's own
figure. Still asymmetric on purpose: a full 64 would read as two stacked sections
rather than one run with a beat in it.

---

## `/* ⚠️ position: relative IS LOAD-BEARING TWICE. It is the containing block for the`
<a id="position-relative-is-load-bearing-twice-it-i"></a>

⚠️ EVERY DARK BLOCK OVERLAPS WHAT IS ABOVE IT BY 2px, AND THIS IS A RENDERING FIX, NOT
A SPACING ONE.

⚠️ 2px, MEASURED, NOT 1. A single pixel of overlap only moved the seam (243 -> 163 at
1.75). The padding adds the same 2px back so nothing inside the block moves.

⚠️ THE HERO BOUNDARY NEEDED MORE THAN THIS. Overlap plus `position: relative` got it
from 81 points per channel down to 23, which is faint but still a linecould
see. That one is now covered properly by the opening curtain, which was moved into
this section so it can overlap downward — see .seam-curtain--open. The overlap below
stays as the general defense for every dark boundary that has no curtain over it.

---

## `.nav__mega-heading--link`
<a id="nav-mega-heading-link"></a>

---- The category heading is now a LINK to its hub ----------------------
⚠️ IT STAYS LOOKING LIKE A HEADING at rest, and that is the whole design
problem. Making it read as a link would put a sixth entry at the top of every
column and turn a grouped menu into a flat list of twenty-one — the grouping
is what makes sixteen industries scannable. So: same size, same weight, same
muted color, and the affordance arrives on hover.

`text-decoration: none` is written here rather than inherited: the mega
heading is the only <a> in the panel that is not a `.nav__dropdown-link`, so
nothing else was resetting it and it underlined by default.

---

## `body.sitestaffr-landing-page .hero::after { display: none; }`
<a id="body-sitestaffr-landing-page-hero-after-disp"></a>

⚠️ THE FADE IS OFF ON THIS PAGE, AND THAT IS THE POINT
the robot "has a fade and you can tell that it's cut-off at the waist which
doesn't look seamless or natural").

The robot's bottom edge is handled by the curtain cropping it instead; see
.hero__robot-img. Do not reinstate this as a "safety" fade — the two treatments
are alternatives, and running both is what produced the cut-off waist.

---

## `color: var(--block-dark);`
<a id="color-var-block-dark"></a>

⚠️ DARK ON THE EMERALD, NOT WHITE. White measured 2.54:1 on #10b981 and was the
worst remaining failure on the page — and the first audit script MISSED it, reporting
11.05, because it resolved the background by walking `background-color` up the tree
and this badge is painted by a gradient. Sample what is actually there.
The emerald is not negotiable: it is the reserved recommended-tier signal. So the
TEXT flips instead — --block-dark on emerald is 5.46.

---

## `.see-it__header { text-align: center; margin-bottom: 40px; }`
<a id="see-it-header"></a>

---- Section 3: see it answer -----------------------------------------
Second half of the dark block, so no background of its own.

.see-it__panel--recap renders POPULATED and JS empties it only once it has
wired everything successfully. Every "hidden" state below is therefore keyed
off .is-interactive, which the script adds last — with no JS, or under
reduced motion, none of these rules apply and the panels stay readable.

---

## `.see-it.is-interactive:not(.has-played) .see-it__panels { display: none; }`
<a id="see-it-is-interactive-not-has-played-see-it-panels"></a>

---- The at-rest stage ------------------------------------------------: "the two blank panels looks bad so let's hide them and just put a
huge play button". See page-landing.php for why the panels were blank and why that is
only true in one of three states.

⚠️ THE HIDE IS SCOPED TO `.is-interactive`, WHICH IS THE ENTIRE SAFETY PROPERTY.
`.is-interactive` is added by JS only after every handler is wired. Hiding the panels
unconditionally — or off a plain `.see-it` selector — would blank the section for
anyone without JS, under prefers-reduced-motion (which returns early and never adds
the class), or if the script throws on the way up. Those readers get the fully
rendered panels and no stage, which is the behavior this section already had.

---

## `.see-it__stage::before`
<a id="see-it-stage-before"></a>

⚠️ THE GLOW IS WHAT MAKES THE ROBOT VISIBLE, and raising opacity is not a substitute —
that was tried first and barely moved. The artwork is a DARK body with a thin teal rim
and it is sitting on a dark teal section, so the two are close in value before any
opacity is involved; at 0.5 it read as a smudge and at 0.88 it still read as murk.

The hero has exactly this problem solved exactly this way (.hero__robot-glow): put a
soft teal bloom BEHIND the figure so it has something to be seen against. Contrast is
the fix; transparency was the wrong dial.

`closest-side` is load-bearing, for the reason recorded against the hero's wash — an
ellipse without it draws a visible rectangle at the element's edges.

---

## `opacity: 0.88;`
<a id="opacity-0-88"></a>

0.88, not the 0.5 this started at. The instinct to fade it was about keeping it
secondary to the button — but this artwork is a DARK body with a teal rim, sitting on
a dark section, so it is already low-contrast before any opacity is applied. At 0.5
it stopped reading as a robot and read as a smudge. Subordinate is a job for SIZE and
for the button sitting in front of it, both of which are doing it; dimming on top of
that only made the art look broken.

---

## `@media (scripting: none)`
<a id="media-scripting-none"></a>

⚠️ THE CAP EXISTS ONLY BECAUSE PLAYBACK REVEALS LINES ONE AT A TIME. It holds
the panel at a fixed height so pressing play does not make the layout jump. In
both fallback states the whole transcript is in the DOM at once - 645px of it
against a 268px box - so the cap turns the conversation into a scroll box that
opens mid-sentence and reads as a rendering fault. Nothing is animating in
either state, so there is nothing left for the cap to protect.

---

## `.lang-section__header { text-align: center; max-width: 46rem; margin: 0 auto; }`
<a id="lang-section-header"></a>

---- Section 5: the language orbit ------------------------------------: "I'd rather see the robot super big with many different languages
saying hello around the robot."

⚠️ READ page-landing.php BEFORE MOVING ANY OF THESE. This is the third design in this
slot and the second one whose predecessor died of hand-measured coordinates over the
artwork — twelve bubbles specced against the old crowd render, four visible at 1440.
Nothing here is measured against the picture. The robot is IN THE FLOW and sets the
stage's height; the greetings are placed against the STAGE, in two side bands the
centered figure never reaches. Swapping the render cannot invalidate a single one.

---

## `.lang-orbit::before`
<a id="lang-orbit-before"></a>

⚠️ THE SAME BLOOM AS THE VOICE DEMO'S ROBOT. Same
gradient, same `closest-side`, same blur — see `.see-it__stage::before`, which carries
the full reasoning; if that one is ever retuned, retune this with it.

`z-index: 0` puts it under the robot (z-index 1) and under the haze, which is also 0
but earlier in source. Nothing here needs to move for it.

---

## `.lang-orbit__haze`
<a id="lang-orbit-haze"></a>

---- The haze: more languages, receding behind the robot ---------------
Texture, not content — the twelve chips carry the claim and stay readable; this is
4-7% ink that tells you the list keeps going. See page-landing.php for why it is a
depth field rather than the literal vortex that was asked about.

z-index 0 with the robot and chips above it. Both of those are positioned, so they
win paint order on their own, but stating it here means a future `position` on the
haze cannot quietly lift it in front of the figure.

---

## `-webkit-mask-image: linear-gradient(to bottom, #000 0%, #000 66%, transparent 78%);`
<a id="webkit-mask-image-linear-gradient-to-bottom-"></a>

⚠️ THE MASK IS LOAD-BEARING AND PRE-DATES THIS REDESIGN. Carried over verbatim.
The render was made for a DARK section: its alpha bbox is the full frame and the
torso runs opaque and near-black to the bottom edge (sampled: 14 of 41 columns still
very-dark-opaque at y=1382 of 1383). On cream that is a hard black block sitting on
the background. The artwork is not wrong and does not need regenerating — it needs
the fade the dark background used to provide for free. Delete this and the block
comes straight back.

⚠️ THE END STOP IS NOW 78%, NOT 96%. It does the second job as well as the first: the fade no longer
just prevents a black block, it CROPS the figure to roughly waist-up.

Regenerating the render was considered and rejected: this is a crop, the artwork is
the hero's style anchor, and a new generation risks drift for something two numbers
already do. Re-measure these if the render is ever replaced.

---

## `text-align: left;`
<a id="text-align-left"></a>

⚠️ THE TEXT IS LEFT WHILE THE PILL STAYS CENTERED, and the two are not the same
thing. Below ~420px this line wraps, and with the inherited `text-align: center`
the second line ("you.") sat centered under the first while the check mark floated
alone at the vertical middle of the left edge — the same lopsided shape the design
system already rejects for a centered row with a chevron pinned right, only
mirrored. Sampled at 390: confirmed in the pixels, not inferred from the CSS.

Section-by-section review. One element, looked at on its own terms.
This does NOT generalize to the rest of the page — see the last block of this file.

---

## `.industries { background: var(--cream); }`
<a id="industries"></a>

---- Section 6: who this is for --------------------------------------
Split, image LEFT (block-split--reverse) because section 5 puts the robot on
the right and the two alternate.

The isometrics render at ~440px here. The design-system rule that deleted them
was about SIZE — "wherever they render below ~100px" — not about the style.

---

## `.industries__stage`
<a id="industries-stage"></a>

---- Two stacked rows, not a Split ------------------------------------: the Split "looks weird because the industries is too long
vertically". The list is five groups and sixteen names; in one column of a Split it
ran far past the bottom of the 440px image beside it.

ROW 1: isometric | excerpt.   ROW 2: the whole list, full width.

The list gets shorter by getting WIDER — five groups become five columns instead of
one stack — which is the fix the Split structurally could not provide.

---

## `.industries__excerpt`
<a id="industries-excerpt"></a>

LEFT-ALIGNED NOW, not centered. It used to sit under the image as a caption, where
centering was right; beside the image it is a column of prose, and centered prose in a
column reads as a pull-quote rather than as a description.

⚠️ --block-dark-raised (#0A424A), NOT --block-dark and NOT a new tone. It shipped on
--block-dark first; The token already existed for section 10's elevated panel — its whole job
is "a card that is lighter than the section dark" — so this is a reuse rather than a
fourth tone. Inventing a shade here is the exact thing the subpage audit lists as the
site's second-commonest system break.

⚠️ IT IS ALSO THE CEILING FOR --teal-light ON THIS CARD. The link measures 4.56:1
here against 5.69:1 on --block-dark; one more step lighter and the link fails AA and
has to move to --teal-pale. Lightening this card is therefore never just a background
change — re-check the link with it.

⚠️ THE CARD IS ON THE CONTAINER AND THE ITEMS ARE STACKED IN ONE GRID CELL, which is
a change from display:none. Sixteen blurbs are different lengths, so a card sized by
whichever one is showing resized on every click, next to a fixed 440px image — a jump
that loose text on cream hid completely and a painted box cannot. Stacked, the
container is the height of the LONGEST blurb and nothing moves.

`visibility` rather than `display` is what makes the hidden ones still contribute
that height. It still takes them out of the tab order and the accessibility tree, so
the sixteen links do not all become tab stops.

---

## `.industries__list`
<a id="industries-list"></a>

⚠️ THE LIST IS FIVE COLUMNS, ONE PER GROUP — this is what actually fixes the
complaint. Stacked in a single column the five groups were the tallest thing in the
section; side by side the tallest group sets the height and the whole block is a few
names deep.

`auto-fit` rather than a hard `repeat(5, ...)`: the registry drives the group count,
and a hardcoded 5 would silently leave a ragged empty column the day a sixth group is
added. 160px is comfortably wider than the longest industry name at this size.

---

## `.industries__name.is-active`
<a id="industries-name-is-active"></a>

ACTIVE IS A FILLED PILL.

The inset 2px left border is gone. It was doing the same job as the pale fill next to
it, so the active row carried two markers and read as a rail. Solid teal instead:
hover is the pale tint, selected is the full color, which is one escalation of one
idea rather than two competing ones.

---

## `.industries__name { width: 100%; margin-left: 0; padding: 14px; border-radius: 0; }`
<a id="industries-name"></a>

⚠️ THE NEGATIVE MARGIN COMES OFF HERE. On desktop `margin-left: -10px` with 10px of
padding is what lets a pill bleed left of its column while its TEXT stays on the
column's edge — correct for a pill sized to its own text. In one full-width column
it made the fill start 10px left of the row separators and stop 10px short of them
on the right: a highlight visibly out of register with the list it is in.
Everything now sits on one edge — separators, fill, names, group headings, and the
expanded detail all start at the same x.

---

## `.screen-reader-text`
<a id="screen-reader-text"></a>

---- .screen-reader-text ----------------------------------------------
WordPress convention class, used 11 times in the pricing table and NEVER
DEFINED IN THIS THEME. The markup was ported from a branch where a parent
theme or an earlier stylesheet supplied it; here it did nothing, so text
meant only for screen readers rendered on screen — every "not included" cell
read "—Not included" with the em dash and the hidden label jammed together.

The clip-rect technique rather than display:none or visibility:hidden: those
remove the element from the accessibility tree too, which defeats the point.

---

## `.pricing-section { background: var(--cream); }`
<a id="pricing-section"></a>

---- Section 8: the pricing table -------------------------------------
ONE SHARED LABEL RAIL plus four columns. The trial is the first column rather
than a strip above the table: it used to present its specs as bullets while
the paid plans presented the same facts as labeled rows, so the one thing a
visitor is being asked to start with was the one thing they could not compare.

⚠️ THE MOBILE TREATMENT IS LOAD-BEARING, not a nicety. Rail + four columns is
five tracks at 1440 and impossible at 390, and the spec required this settled
BEFORE the trial column landed. Chosen: stacked per-plan cards. Horizontal
scroll keeps the grid intact but hides Pro behind a gesture users may never
discover, and Pro is the tier you most want seen last.

---

## `/* ⚠️ ONE LEFT AXIS. NOTHING IN THIS STRIP IS CENTERED.`
<a id="one-left-axis-nothing-in-this-strip-is-cente"></a>

THE INCLUSIONS STRIP: PLAIN ON THE CREAM, no border and no tab.
It was a solid teal panel with a floating tab label, which out-weighed the
prices it introduces. The argument order is right - establish that the
differences are small, THEN show what varies - but the treatment was arguing
louder than the thing it introduces, and it would fight the table for
attention now the table is the heavy object in this section.
Nothing here draws a box. The only fill in section 8 is the table.

---

## `.price-includes--homepage`
<a id="price-includes-homepage"></a>

⚠️ ONE LEFT AXIS. NOTHING IN THIS STRIP IS CENTERED.

⚠️ THE WIDTH MATCHES THE TABLE'S 1080px, and it is not a free choice. This
strip and the table are the only two objects in the light part of section 8;
set to different measures they present two left edges and two right edges
under one centered heading, and the eye reads that as one of them being
misplaced. Change one, change both.

---

## `.price-includes--homepage .price-includes__grid`
<a id="price-includes-homepage-price-includes-grid"></a>

THE BOX IS BACK, AS A QUIET SURFACE RATHER THAN A FILLED PANEL. He is right about why: six items in a 3x2 grid are a set, and a
set with no boundary makes the reader work out where it starts and stops
before they can scan it. That is the job the teal fill was really doing.

White on the cream, one hairline, no tab. The spec's objection to the old
treatment was WEIGHT - a solid teal panel out-weighed the prices it
introduces - and weight is what a white surface gives up. It still reads as
one object at a glance, and against the dark table below it there is no
contest about which is the heavier of the two.

---

## `.price-includes--homepage .price-includes__grid::before`
<a id="price-includes-homepage-price-includes-grid-before"></a>

The label survives as type. It is the sentence the strip completes - the
items below it are the predicate - so removing the tab must not remove the
words. In flow, not absolutely positioned: the old notch was a positioned
::before whose height the padding could not know about, and it collided with
the first row of inclusions below ~403px. In flow it cannot collide at any
width, which also retires the phone-specific patch that used to chase it.

---

## `.price-includes--homepage .price-includes__label`
<a id="price-includes-homepage-price-includes-label"></a>

⚠️ ALL SIX ITEMS CARRY THE SAME WEIGHT AND THE SAME COLOR, and that is a
correctness rule rather than a preference. Two of them are links. Styled as
teal-and-bold against five gray siblings, a link does not read as "clickable"
— it reads as "this one is selected", and the visitor spends their attention
working out why one inclusion is special. Uniform type, and the link says it
is a link by underlining.

---

## `.pricing-section .price-grid.price-grid--table`
<a id="pricing-section-price-grid-price-grid-table"></a>

⚠️ SELECTOR SPECIFICITY IS DELIBERATE HERE. The V1 card layout still lives in
this file as `.pricing-section .price-grid` (line ~4607) and reuses the SAME
class names for a different structure, forcing repeat(2, 1fr). Two classes
beats one, so a plain `.price-grid--table` lost regardless of source order and
the four-column table silently rendered as 2x2 cards at 1440.

Out-specified rather than deleted: the old block also styles .price-includes
and tier internals that this markup still uses, so removing it wholesale would
fix the grid and break the panel.

---

## `background: var(--block-dark);`
<a id="background-var-block-dark"></a>

⚠️ A DARK PANEL ON A CREAM SECTION - NOT A THIRD DARK SECTION. The page tone
does not change here. Dark blocks are structural and appear exactly twice
(2-3, and 10-11); this is an OBJECT on the light run, and it is dark because
it is the decision moment and should be the heaviest thing in that run.
The section around it, the strip above it and the footnote below it all stay
on the cream. If this ever becomes full-bleed, that is the rule broken.

---

## `overflow: visible;`
<a id="overflow-visible"></a>

⚠️ VISIBLE, NOT HIDDEN, AND THE BADGE DEPENDS ON IT. "Most Popular" sits
astride the panel's top edge as a label on the border, so it has to be able
to hang outside the panel's box. `overflow: hidden` is what sliced it in
half the first time.
The corner rounding that overflow was providing is done per column instead -
see the two rules below. Only the end columns need it; the middle ones are
square regardless, which is why this costs two rules and not four.

---

## `.price-grid--table .price-tier`
<a id="price-grid-table-price-tier"></a>

⚠️ THIS RESET IS LOAD-BEARING, AND ITS ABSENCE IS WHAT MADE THE V1 BLOCK LOOK
NECESSARY. `.price-tier` and friends were first written for FREESTANDING CARDS
(line ~1458): white fill, 36px padding, rounded border, drop shadow, a hover
lift, an absolutely positioned badge at top:-14px, and `transform: scale(1.03)`
on the popular one. Those rules are still live and still needed by the card
layouts elsewhere in the theme.

---

## `.price-grid--table .price-tier { isolation: isolate; }`
<a id="price-grid-table-price-tier-2"></a>

COLUMN HOVER. A comparison table is read by tracking one
column down against a label rail, and a lit column keeps the eye on the right
one. ONE highlight, identical on all four columns.

z-index -1 with `isolation: isolate` on the column: the tier creates its own
stacking context, so the overlay lands above the column's background and below
all of its content. Absolutely positioned, so it is not a grid item and the
subgrid rows do not shift. Radius inherited, or the square overlay would poke
past the rounded ends of the panel.

⚠️ hover: hover, because :hover sticks after a tap on a touch device. The
phone would keep a column lit until something else was tapped, which reads as
a selection the visitor did not make - and there is nothing here to select.
The CTA is still the only click target in the column.

---

## `.price-grid--table .price-tier--trial .price-tier__price { color: rgba(240,250,250,0.82); }`
<a id="price-grid-table-price-tier-trial-price-tier-price"></a>

THE ON-RAMP TREATMENT, NOW CARRIED BY TYPE AND WIDTH RATHER THAN BY FILL.: every column the same color except Business. So the
trial's deeper fill is gone and only Business is tinted - which makes the
emerald read harder, because it is now the single exception in the row rather
than one of two.

⚠️ THE MUTING STILL HAS TO EXIST SOMEWHERE - the spec's requirement is that
this never reads as a fourth plan. Three things still carry it: the column is
narrower than the paid three (0.88fr), the price and name are stepped down
from white, and its CTA is an outline while the recommended tier's is filled.
If those are ever levelled up, the trial becomes a fourth plan and the ladder
reads as four prices rather than three.

---

## `.pricing-section .price-grid.price-grid--table`
<a id="pricing-section-price-grid-price-grid-table-2"></a>

STACKED PER-PLAN CARDS. The rail cannot follow four columns down a phone,
so it goes and each card carries its own labels.

⚠️ THE CARDS STAY DARK. The panel dissolves into separate cards here, and
the obvious move is to let them fall back to white on the cream - which
would mean the pricing table is a dark object on desktop and a light one on
a phone. Most of the traffic this section is written for is the phone. The
panel goes; the treatment does not.

---

## `grid-template-rows: none;`
<a id="grid-template-rows-none"></a>

⚠️ THE EXPLICIT ROWS HAVE TO GO WITH THE COLUMNS, and forgetting them is what
  made the footnote look detached is
  "very spaced out and far apart from the cards for some reason").

  The desktop panel declares `grid-template-rows: auto repeat(6, auto) 1fr` so the
  rail and the four columns can share rows through subgrid. Those eight rows
  survived into the stacked layout, where four cards fill rows 1-4 and rows 5-8 sit
  empty. Empty auto rows cost no height — but the GAPS BETWEEN THEM still do, and
  at 26px that is four phantom gaps, 104px of nothing, measured. The footnote's own
  margin was never the problem: it is 22px and always was.

---

## `.price-tier__row`
<a id="price-tier-row"></a>

⚠️ THE VALUE LEADS, AND THE ROW IS NOT A TABLE ROW ANY MORE.

⚠️ NO FIXED COLUMN FOR THE VALUE, AND NO RULE BETWEEN THE ROWS. Both were tried on
 and both looked worse than what they replaced. A 92px value column is a dead gutter, because most of these values
are one character — "2" sat alone with 70px of nothing before its label, and the
hairlines under each row turned that gutter into an empty third table column. A
pricing card is a spec LIST, not a table fragment: value and label are one phrase,
9px apart, and the only rule left is the one under the price itself.

---

## `.price-tier__row:has(.price-tier__row-value--none) { display: none; }`
<a id="price-tier-row-has-price-tier-row-value-none"></a>

⚠️ A ROW THE PLAN DOES NOT INCLUDE IS NOT A ROW HERE (a deliberate call,
choosing this over keeping the em-dashes: "Value first, hide what's absent").

On desktop the dash is doing real work — it is the empty cell in a comparison, read
across four columns at once. Stacked, nobody is comparing across anything; a dash is
just a line about a thing you are not getting, and there are four of them. Dropping
them makes Free Trial and Starter visibly shorter cards, which is itself information.

`:has` is the only way to hide a row from the state of its child. Browsers without
it fall back to showing the dash, which is exactly the previous behavior.

---

## `/* No seam here any more — it moved down to section 11, so this is a plain cream`
<a id="no-seam-here-any-more-it-moved-down-to-secti"></a>

---- Section 9: the FAQ ------------------------------------------------
⚠️ TWO COLUMNS, WHICH REVERSES THE "never two columns of questions" NOTE THAT USED TO
BE HERE. Read the reasoning in
page-landing.php before undoing it — the old objection was about a masonry flow, where
one list wraps across both columns and an opened answer shunts the other side. These
are two INDEPENDENT stacks of whole categories, so opening an answer moves only its
own column.

The sticky rail is gone with it. It existed to keep the deflection CTA beside a very
long single column; the list is half as tall now, and a third column beside two would
squeeze the questions to ~390px each. The CTA sits in the header instead.

---

## `/* ⚠️ ROBOT ON THE LEFT AT EVERY WIDTH, BUTTON UNDER THE HEADING. Two rules follow from that and neither is optional:`
<a id="robot-on-the-left-at-every-width-button-unde"></a>

⚠️ IT CLOSES THE SECTION NOW, and that is a third position for this element — worth
knowing the history before moving it a fourth time. It sat under the list (seen only
by someone who read all seventeen), then in a sticky rail (which went with the rail
when the list became two columns), then in the header — where's read was that it
"looks weird", because a support CTA above the questions interrupts the reader on the
way TO them.

Under two balanced columns it is a full-width footer to the section: it is passed by
everyone, and it arrives after the questions have had their chance rather than before.
The old "only finishers see it" objection does not apply, because a two-column list is
half as tall and its end is on screen with the columns.

---

## `.faq-section__ask`
<a id="faq-section-ask"></a>

⚠️ ROBOT ON THE LEFT AT EVERY WIDTH, BUTTON UNDER THE HEADING. Two rules follow from that and neither is optional:

`flex-wrap: nowrap` — the robot must never drop to its own line, so the card cannot be
allowed to wrap at all. There is no stacked variant of this card any more; the earlier
560px and 640px breakpoints that made one are gone.

A one-row robot|heading|button version shipped in between and was rejected. Do not
reach for it again — the robot is the left edge of this card.

---

## `.faq-section__ask .sitestaffr-button-container { max-width: 100%; }`
<a id="faq-section-ask-sitestaffr-button-container"></a>

⚠️ THE BUTTON MUST NOT EXCEED ITS COLUMN, and it takes THREE selectors because the
shortcode emits three nested boxes. At 320px it stuck out 41px past the card's right
edge and pushed the whole document into horizontal scroll.

`.sitestaffr-button-text` carries `white-space: nowrap` from the plugin, so even a
clamped container could not reflow the label. All three, or none of them work.

Outside a breakpoint because the failure is "column narrower than label" — a
relationship, not a width. A longer label would reproduce it at 390.

---

## `@media (max-width: 560px)`
<a id="media-max-width-560px"></a>

⚠️ NOTHING STACKS HERE, IT ONLY GETS SMALLER. The robot stays on the left at 320px, so
the phone treatment is a shrink, not a re-layout.

The button is the constraint. It is shortcode-rendered at a fixed 230px, and at 390 the
card has 302px of content box: a 76px robot plus a 14px gap leaves 212. So the button's
own type and padding come down here — it is the only element in the card that can give
width back. Without this the card blows past its max-width and the robot is pushed off
its own left edge, which is the one thing this layout exists to prevent.

---

## `@media (max-width: 900px)`
<a id="media-max-width-900px"></a>

⚠️ ONE OPEN CLASS, AND IT IS `faq-item--open`. There were TWO, and that was the bug:
PHP rendered `faq-item--open` on the first question while the script toggled a bare
`open`, so the first answer was held open by a class nothing could ever remove and a
second answer could sit open beside it. Both names existed in this stylesheet, which
is why neither looked wrong on its own. If a bare `.open` ever reappears here, it is
this defect coming back.

---

## `.faq-list__set`
<a id="faq-list-set"></a>

⚠️ ONE CARD PER GROUP. In one column this is sixteen identical white cards with three small gray
labels lost among them — the same failure the industries list had, and this is the
same fix, deliberately: three bordered sets of three to six questions, heading
outside.'s first idea was a color per group; that would have put a second and
third accent on a page whose whole system is one teal with emerald reserved for
capture states, and he chose this instead. If color-coding is ever revisited, the
rule it breaks is the thing to decide, not this component.

Kept to this breakpoint on purpose. Desktop is two columns of free-standing cards and
is signed off; the wrapper above is inert there.

---

## `.agency-door`
<a id="agency-door"></a>

---- Section 10: the agency door --------------------------------------
A DARK CARD ON A LIGHT SECTION — the inverse of what was here, which was a dark card
inside a dark section. The old note argued that two full-bleed dark sections would end
the page on an undifferentiated slab; that still holds, and this serves it better,
because a dark card on cream is MORE separated from what follows than dark-on-dark
ever was.

⚠️ THE CARD KEEPS ITS DARK SURFACE ON PURPOSE. With sections 10 and 11 both light, it
is the only inverted object left on the page, and that is exactly what makes it read
as an aside rather than as the reader's path. Repainting it light merges it into the
cream run and loses the distinction the section exists to draw.

---

## `.agency-door__props`
<a id="agency-door-props"></a>

⚠️ CENTERED WITH AUTO MARGINS, NOT `left:50% + translateX(-50%)`. A TRANSFORM CREATES A
STACKING CONTEXT, and this element has children that must sit on BOTH sides of the card
— so the moment it was centered with a transform, every prop got trapped inside it and
the three "front" props rendered behind the card no matter what z-index they carried.
The symptom was subtle: the coffee cup simply disappeared except for its saucer.

`left:0; right:0; width:…; margin-inline:auto` centers an absolutely positioned box
with no transform, so the layer stays a plain z-index:auto parent and its children
compete with .block__inner directly, which is what makes the two depths work.

---

## `@media (max-width: 1320px)`
<a id="media-max-width-1320px"></a>

⚠️ THE WHOLE FIELD GOES BELOW 1320px, AND THE NUMBER WAS MEASURED, NOT GUESSED. The
card is full width, so the only place the back layer can live is the cream gutter
outside the 1140px container — and that gutter shrinks as the viewport does until the
props are forced onto the heading and the three columns.

Re-measure this if the card's width, the container, or any prop's size changes.

---

## `.agency-hero .agency-door__eyebrow { color: var(--teal-text); }`
<a id="agency-hero-agency-door-eyebrow"></a>

⚠️ ONE CLASS, TWO SKINS — DO NOT "FIX" THE RULE ABOVE. `.agency-door__eyebrow` sits
inside `.agency-door__panel` on the HOMEPAGE, where the background is --block-dark
and --teal-light is right at 5.68:1. `/for/agencies/` reuses the same class in its
HERO, which is a light block, where the identical declaration measures 2.4:1.
Repointing the shared rule to --teal-text would fix this page and paint the
homepage's eyebrow out at ~2.3:1 on the dark panel — the same shape as the
!important-written-for-one-skin trap already recorded. Scope the light context.

---

## `.seam-curtain`
<a id="seam-curtain"></a>

---- The curtain seam -------------------------------------------------
An absolute overlay pinned to the HERO's bottom edge,
filled with the dark block color, so it reads as the dark rising into the
light rather than as a band of its own.

⚠️ IT HAS NO BACKGROUND OF ITS OWN, and must not get one back. It used to be
an in-flow band between the two sections and therefore needed to paint the
hero's exact bottom color behind the path — a value that was breakpoint-
dependent and cost two rounds of hairline bugs. As an overlay it sits ON the
hero, so the hero IS the background and the two can never disagree.

---

## `.seam-curtain--open { bottom: -1px; }`
<a id="seam-curtain-open"></a>

⚠️ THE OPENING CURTAIN HANGS UPWARD OUT OF THE DARK SECTION. It used
to sit at the bottom of the HERO with `bottom: -1px`, and that 1px was there to kill a
hairline of hero background at the boundary. It could not do the job: the hero has
`overflow: hidden` to crop the robot, so the overhang was clipped straight off and the
curtain's bottom edge landed exactly ON the boundary — which sits at a fractional
layout position (1193.984375) and, at a fractional device pixel ratio, rounds apart and
shows the page background through as a pale line .

⚠️ SCOPED TO THE ONE INSIDE A DARK BLOCK, AND IT HAS TO BE. There are TWO `--open`
curtains on the homepage: this one, and the one at the bottom of the final CTA that
pours into the footer. Restyling the bare class moved both, which put a dark shape
across the TOP of the CTA section. The relocated one
is the only curtain that is a child of a DARK block — every other instance sits on the
light side of its boundary — so that is the selector, and it cannot pick up a third
instance by accident.

---

## `/* ⚠️ THE CLOSING CURTAIN IS THE FOOTER'S NOW, so this is scoped`
<a id="the-closing-curtain-is-the-footer-s-now-so-t"></a>

⚠️ THE CLOSING CURTAIN FILLS WITH THE FOOTER'S COLOR, NOT THE BLOCK COLOR. Every other
seam on this page pours a dark SECTION into a light one, so --block-dark is right. The
last one pours the FOOTER in — and the footer went a step darker than the sections on
, which left the curtain painting #00323A directly above a #00232A footer: a
16-point step across the full viewport width, exactly the hairline these seams exist to
remove.

Scoped by parent rather than a modifier class because the seam has no knowledge of what
sits below it; the SECTION does. Both sides now read the same token, so they cannot
drift apart again.

---

## `/* ⚠️ A ZERO-HEIGHT WRAPPER OUTSIDE <footer>, NOT A CHILD OF IT. As the footer's`
<a id="a-zero-height-wrapper-outside-footer-not-a-c"></a>

⚠️ THE CLOSING CURTAIN IS THE FOOTER'S NOW, so this is scoped
to .footer rather than to one section on one template. It used to live in
.final-cta on the homepage and nowhere else, which is why every other template
ended on a hard horizontal rule.

⚠️ HANGS UPWARD out of the footer, like .block--dark > .seam-curtain--open. The
footer is not a .block, so it needs its own copy of that rule.

---

## `:root { --amber: #F4B860; }`
<a id="root-amber-f4b860"></a>

---- Section 2: the job-value grid ------------------------------------
Padding, background and color come from .block .block--dark. The old
.cost-card rules are gone with the unsourced placeholders they styled.

⚠️ --amber IS DEFINED HERE AND USED IN EXACTLY ONE RULE: .job-value__amount.
Amber on a button, a card, an icon, a heading or a border is a bug. It exists
at all because The objection was overruled to it — and the
reason that was reasonable is that the use is CONFINED. A second amber use
anywhere makes the first one wrong retroactively.

---

## `.job-value:hover,`
<a id="job-value-hover"></a>

---- Card hover -------------------------------------------------------
V1's card gesture: `translateY(-4px)` plus a heavier shadow, over 0.3s ease. The lift and
the timing are ported unchanged, because that is the part that is recognizably V1.

⚠️ THE SHADOW COULD NOT BE PORTED. V1's `--shadow-lg` is rgba(0,0,0,0.10) on white,
where a soft black bloom is most of the effect. These cards sit on #00323A, and black
at 10% over near-black is invisible — the card would have appeared to lift with
nothing under it, which reads as a jump rather than a raise. The shadow here is opaque
black at 0.35 and the *surface itself* brightens a step, so the depth cue on dark comes
from the card catching more light rather than from casting more shadow.

---

## `.job-value__mark`
<a id="job-value-mark"></a>

---- The industry watermark -------------------------------------------
Big, bold, and almost transparent — an obscure signal of the industry rather than a
label. It is deliberately NOT a caption: an earlier pass had a
readable industry name under each icon and removed it, because a wrench captioned
"Auto repair" is a caption telling you what the picture already said. This says the
same thing at 5% opacity, where it registers as texture and not as text.

OVERLAP WITH THE ICON IS SANCTIONED at narrow widths. Do not add a media query that shrinks this
to avoid the collision — the collision is allowed and the size is the point.

---

## `.job-value__mark::after`
<a id="job-value-mark-after"></a>

⚠️ `top: 10px; right: 14px` IS THE POSITION AND IT IS NOT TO BE MOVED (, after two attempts to relocate it: "I think it was perfect where it was on
desktop so move it back. Just place it back exactly where it was").

⚠️ DESKTOP IS UNTOUCHED. The phone values are set in their own block below; this rule
is exactly what it was before, apart from the floor, which no longer bites
anywhere the block below does not already override.

---

## `@media (max-width: 768px)`
<a id="media-max-width-768px"></a>

⚠️ EXACT PHONE VALUES. 2.6rem here is the same 41.6px the desktop clamp caps
at, so the stamp is one size everywhere and only its offset changes.

⚠️ "DENTAL" CLIPS BELOW ABOUT 410px AND THAT IS KNOWN, NOT AN OVERSIGHT. It is the
longest of the four; at 41.6px it is 153px wide, and the cards stay two-across down to
320 — 169px at a 390 viewport, 131px at 320. With the 20px offset that is 4px short at
390 and 42px short at 320, so the D loses a sliver on a phone and more on a small one.was told and chose the size. Do not "fix" this by shrinking the font or moving
the offset; if it is ever revisited it is his call, not a cleanup.

---

## `.proof-section`
<a id="proof-section"></a>

---- Section 7: social proof ------------------------------------------
THE V2 ARRANGEMENT IN V3's PALETTE. What was here was the V1 design: a
glassmorphic card floating on a gradient wash, with an SVG noise texture and a
rotated backdrop panel behind it - about 350 lines to say "testimonial". It
was carrying V2's numbers, which is what made the miss hard to see: the facts
were right and the layout was the thing testers had actually preferred.

⚠️ THE PALETTE DOES NOT PORT, ONLY THE ARRANGEMENT. V2's version of this
section lived on the night theme: a translucent slab over a dark ground, cyan
hairlines at 8-20% white, and a `run--day` override block re-stating half of it
for the light run. On cream, "a slab lighter than its background" has to invert
to "a slab that is white where the section is not", and the hairlines become
teal at low alpha rather than cyan. Copying the values across is what produces
an invisible panel.

---

## `/* ⚠️ INLINE WITH THE LABEL, NOT STACKED UNDER IT. It is a child of`
<a id="inline-with-the-label-not-stacked-under-it-i"></a>

THE DENOMINATOR, NOW ATTACHED TO THE NUMBER IT BELONGS TO. It used to be
.proof-section__support, a sibling of the whole pair, which is what let "of those"
stay ambiguous about which stat it was the denominator FOR. It sits inside the 23
now -- see the note in page-landing.php.

Quieter than the label above it by design: it is support, not a third claim. At the
same weight it competes with the number it exists to prop up.

---

## `.proof-section__quote-plate`
<a id="proof-section-quote-plate"></a>

PLANE ONE, the surface.
⚠️ RIGHT INSET IS 0, and that is a rule rather than a value. It shipped at
-34px on V2, which at a 1440 viewport puts the panel edge past the container
and, with overflow clipped, sliced the corner off. It misbehaves only at
viewports near the container width - which is most real screens. It may grow
up, down and LEFT into the column gap. Not right.

---

## `.proof-section__quote-plate::after`
<a id="proof-section-quote-plate-after"></a>

PLANE TWO — THE OFFSET GHOST BORDER. A hairline with no fill, rotated the other way, CROSSING out of the
slab rather than nested inside it. Nested it would sit concentric and read as
one thick border; crossing, the two read as two overlapping objects.
It costs nothing to the text's margins because it has no fill, so it is not the
edge the eye measures padding against. That is why this one is allowed to reach
left into the column gap and the filled slab above is not.

---

## `.proof-section__quote-inner::before`
<a id="proof-section-quote-inner-before"></a>

Punctuation, not ornament.
⚠️ ANCHORED TO THE INNER WRAPPER, not the figure. On the figure it is
positioned against a box taller than its own contents, so the mark stays at the
panel's top edge while the words it introduces center somewhere below it -
punctuation stranded from its sentence.
⚠️ The glyph is written literally, and it has shipped mangled twice: once as
content: '\201C' where a script ate the backslash as an octal escape, once as a
raw character that lost its encoding in transit. If this changes, verify the
bytes afterwards; do not trust that it round-tripped.

---

## `.proof-section__quote p`
<a id="proof-section-quote-p"></a>

⚠️ THE QUOTE IS SIZED SO THE EVIDENCE COLUMN SETS THE ROW HEIGHT, not the
panel. At 1.35rem/1.6 the quote ran six lines and the panel became the taller
of the two, which inverts the whole arrangement: `stretch` then hands the
evidence column a height it has nothing to fill, and the argument floats in
the middle of a tall empty column. The quote corroborates the numbers; it does
not out-measure them. If this is ever enlarged again, check the row heights,
not just the panel.

---

## `/* ========== WHAT YOU GET SECTION ========== */`
<a id="what-you-get-section"></a>

The old language-section CSS was deleted here (~403 lines): the dark
gradient band, the floating .lang-section__greetings, the badge list, the expand
button and the .language-card/.language-float sets. All of it styled markup this
redesign replaced, and the dark gradient was still WINNING over the new light
Split because it sat later in the file — the section rendered dark-on-dark with an
almost invisible heading. Checked class by class before removal: .lang-section was
the only selector in the block still referenced by page-landing.php.

---

## `/* ⚠️ .block.what-you-get, NOT .what-you-get — THE SELECTOR IS LOAD-BEARING.`
<a id="block-what-you-get-not-what-you-get-the-sele"></a>

⚠️ ONE LIGHT TONE FOR THE ENTIRE LIGHT RUN.

Sections 4 through 9 used to alternate between --cream (253,251,247) and --warm-white
(255,253,249) with no pattern: cream, white, white, white, cream, cream. Two points
apart is the worst possible gap — too small to read as rhythm, too large to be
invisible, so each boundary looked like an unintended seam.

---

## `.block.what-you-get`
<a id="block-what-you-get"></a>

⚠️ `.block.what-you-get`, NOT `.what-you-get` — THE SELECTOR IS LOAD-BEARING.
`.block:not(.block--dark)` sets padding-block for the whole cream run, and :not
CONTRIBUTES ITS ARGUMENT'S SPECIFICITY, making that rule 0,2,0. A bare `.what-you-get`
is 0,1,0 and loses no matter how far down the file it sits — so the seam-clearing
padding below was silently replaced by the flat run value the moment that rule landed,
and the closing curtain's spike started creeping toward the heading at wide viewports.
Nothing about either rule looks wrong in isolation. Matching 0,2,0 and declaring later
is what makes this win.

---

## `.what-you-get.is-interactive .morning-inbox__row::after`
<a id="what-you-get-is-interactive-morning-inbox-row-after"></a>

⚠️ THE CHEVRON IS THE WHOLE AFFORDANCE, AT EVERY WIDTH, ON EVERY DEVICE.

It replaced a "View recap →" label that only appeared on hover. Two problems, and
the first is the one that killed it: hidden-until-hover on a touch screen is hidden
forever, so the row's only signal that it opens a document never fired for most of
the traffic. The second is that it cost ~90px of a phone row to say what a chevron
says in 12px. There is no `(hover: none)` branch here any more and there should not
be one — one row, one affordance, no device-dependent copy.

`/ ''` is the alt-text form of `content`: the glyph is drawn, and a screen reader
that supports it announces nothing rather than "single right-pointing angle
quotation mark". The row's own aria-label already says what it opens. Browsers that
do not support the syntax ignore the whole declaration, so the fallback on the line
below has to stay.

---

## `.recap-doc`
<a id="recap-doc"></a>

---- The recap document ----------------------------------------------
V1's artifact, ported rather than re-imagined. Bordered cards for the recap and the
transcript, gray AI blocks, and the visitor on a teal-edged card behind an avatar.

⚠️ NO INNER SCROLL PANE. The first version capped .recap-doc__sheet and scrolled
.recap-doc__body underneath a pinned logo bar, which read as a cropped window onto a
document rather than as the document. The sheet is now its natural height and the
DIALOG scrolls as one piece if the viewport is short — the whole page of paper moves,
which is what a document does. V1's bottom fade is gone with it: that fade existed to
disguise a crop, and there is no crop here.

---

## `padding-right: 6px;`
<a id="padding-right-6px"></a>

⚠️ THE SCROLLBAR IS PART OF THE DESIGN HERE, because the scroll container is the
DIALOG and the rounded sheet sits inside it — so a default bar runs down the flat
edge of a rounded document and reads as a seam next to the corner radius.

`padding-right` is what fixes that, not the bar's own styling: it opens a gutter so
the bar rides in space beside the sheet instead of against it. The thumb is then
inset inside that gutter with the transparent-border + background-clip trick, which
is the only way to pad a ::-webkit-scrollbar-thumb — it has no margin.

scrollbar-color/scrollbar-width cover Firefox, which supports neither pseudo-element.
Both are declared on purpose; one alone leaves half the browsers on the default.

---

## `.morning-inbox__row`
<a id="morning-inbox-row"></a>

The row's five columns cannot survive a phone. TWO LINES, and two is the number.
It was four lines — time+name, message, pill, and an invisible "View recap" — which
is 132px of row for two facts, and three identical pills stacked down the card.

⚠️ EVERY PLACEMENT BELOW IS EXPLICIT, rows included. Give an item a column and no
row and auto-placement drops it in the first row with a free cell — which for the
chevron is row 1, wedged against the pill instead of centered beside both lines.

⚠️ THE NAME IS THE ONLY ELASTIC TRACK, and it must be allowed to lose. `minmax(0,
1fr)` plus the ellipsis is what stops the pill being pushed off the right edge on a
320px phone; a grid item's automatic minimum size is its CONTENT, so a plain `1fr`
refuses to shrink and overflows the card instead.

---

## `/* ⚠️ CENTERED, WITH THE ICON BESIDE THE HEADING. The icon sat above the title, which put three`
<a id="centered-with-the-icon-beside-the-heading-th"></a>

⚠️ V1's DOCUMENT ICONS, WHICH ARE THE PRICING PANEL'S ICONS.

⚠️ NOT EMOJI. The hero's capability cards use emoji deliberately, and this is the one
place on the page that deviates — these are annotations on a document, and both V1 and
the pricing panel draw them as line art. Keeping both is the decision, not an
inconsistency to tidy up later.

---

## `.what-you-get__callout`
<a id="what-you-get-callout"></a>

⚠️ CENTERED, WITH THE ICON BESIDE THE HEADING. The icon sat above the title, which put three
left-aligned things in a column and read as a list item rather than a card.

Flex-wrap rather than a two-column grid, and the reason is the description. As a grid
it would have to span both tracks, and a spanning item distributes its extra width
across the tracks it spans — so a long description silently widens the ICON's column
and the icon stops being next to the heading. `flex: 1 0 100%` forces it onto its own
line without ever influencing the two above it.

---

## `.what-you-get__header`
<a id="what-you-get-header"></a>

A @media (max-width: 760px) block sat here and was deleted. It set
`grid-template-columns` on `.morning-inbox__item`, which stopped being the grid when
the row became a <button> — the `<li>` only draws a border now, so that declaration
had been doing nothing for some time and read as if the block were dead.

Its other two lines were very much alive, and being later in the file they silently
beat the 620px block above: `.morning-inbox__tag { grid-column: 1 / -1; justify-self:
start }` dragged the pill across the whole row and parked it on top of the time and
the name. The phone layout looked correct in an injected stylesheet and wrong on
staging, which is the tell for a cascade fight rather than a bad rule.

---

## `/* Salesforce hand-off. A slim strip UNDER the document, not a card beside it.`
<a id="salesforce-hand-off-a-slim-strip-under-the-d"></a>

The flanking callout-column rules were deleted with the document they
flanked. They set `display:flex; flex-direction:column; gap:80px` plus left/right
text alignment, and because they sat LATER in this file than the new Cards rules
they silently won: the four callouts rendered as one 80px-gapped column at every
width while .block-cards__grid appeared to do nothing.

Deleted rather than overridden. An override would have left two competing layouts
for one element, which is how the next person ends up debugging this twice.

---

## `.what-you-get__crm`
<a id="what-you-get-crm"></a>

Salesforce hand-off. A slim strip UNDER the document, not a card beside it.
As a bordered card in the right-hand callout column it was the only bordered, full-color
element among borderless teal annotations, it made the right column hang below the left,
and it sat among four items that describe what is IN the report when it describes what
happens next. A single centered row fixes all three, and it stacks predictably on narrow
screens instead of competing inside a wrapped flex row.

---

## `.pricing-includes`
<a id="pricing-includes"></a>

========== SECTION 8: PRICING ==========
The V1 homepage-pricing rules that lived here were DELETED.
Section 8's styling now lives in exactly one place: the block at the top of
this file (search `Section 8: the pricing table`).

- They set the section background to a two-radial gradient, so the spec's
  cream never rendered.
- They made the inclusions strip a solid teal panel with a floating tab.
- `.pricing-section .price-tier__identity` (2 classes) beat the V3 mobile
  rule (1 class) below 768px, so every plan card on a phone carried the V1
  padding and a stray teal border.

---

## `background: var(--cream);`
<a id="background-var-cream"></a>

NO PADDING. `.block` owns it, and this rule used to override it with
`padding: var(--section-padding)` — a SHORTHAND, declared later in the file, which
beats .block's `padding-block` on both specificity-of-order and shorthand-vs-longhand.
Measured before removal: 115px/120px while every other section sat at 64px.

There is an older `.faq-section` rule further up carrying a comment that says exactly
this ("No padding here: .block owns it") — written when the offending declaration was
removed from THAT rule, while this copy further down kept it and kept winning. The
comment was true and the page still rendered wrong. Grep the selector, not one rule.

---

## `.final-cta__grid { align-items: center; }`
<a id="final-cta-grid"></a>

---- Section 11 hierarchy, corrected  -------------------------
The trial is the primary conversion path (site-nav.php:53) and is now styled
as the primary element. What it replaces: the onboarding widget button was
the visual primary WITH a shimmer animation, while the trial was a 0.85rem
link at 45% opacity behind the word "or".

The shimmer is deliberately not reused on the trial button. It was pulling
attention to the wrong action; the fix is to stop animating, not to move the
animation onto the right one.

---

## `.final-cta__concierge .sitestaffr-button-widget`
<a id="final-cta-concierge-sitestaffr-button-widget"></a>

⚠️ THE WIDGET IS THEMED THROUGH ITS OWN CUSTOM PROPERTIES, NOT THROUGH `color`. The
shortcode writes them INLINE on the button — `--btn-icon-color: #ffffff`,
`--btn-text-color: #ffffff`, `--btn-background: #1FB6CC` — and its stylesheet reads
those. So setting `color` here recoloured the label (which happens to inherit) and left
the ICON white, because the icon's SVG is `fill="currentColor"` inside an element whose
color comes from `--btn-icon-color`. On this outline button that is a white mark on a
white surface: invisible.

The custom properties need `!important` because they are set inline; a plain
declaration loses to the style attribute. Nothing here touches the plugin or any other
instance of the widget — every selector is scoped to .final-cta__concierge.

---

## `/* ⚠️ CONFINED TO THE CONTAINER, LIKE THE HERO'S ROBOT. It was pinned to`
<a id="confined-to-the-container-like-the-hero-s-ro"></a>

---- The closing robot -------------------------------------------------
⚠️ A BACKGROUND FIGURE, NOT A COLUMN. It was the art cell of a Split, capped at the
column width and floating mid-section; now it is absolute against `.final-cta` and can
be as large as the section. See page-landing.php for why no bottom mask is needed —
the curtain's baseline is full depth at every x, so the section's clipped bottom edge
hides the artwork's hard leg cut at any viewport width, exactly as in the hero.

`bottom: -24px` pushes that cut clear of the visible area rather than resting it
exactly on the boundary, where a fractional-pixel zoom could expose a row of it.

---

## `.final-cta__robot`
<a id="final-cta-robot"></a>

⚠️ CONFINED TO THE CONTAINER, LIKE THE HERO'S ROBOT. It was pinned to
the VIEWPORT's right edge, so on a wide screen it drifted away from the content and
read as a sticker on the browser rather than part of the layout — the same defect the
agency props had, from the same cause.

Centered to --block-max with auto margins and flushed right inside that, so it sits
against the content column at every width. Auto margins rather than a transform, since
a transform here would create a stacking context and lift the figure over the copy.

---

## `@media (max-width: 900px)`
<a id="media-max-width-900px-2"></a>

--- Footer responsive ---
⚠️ THE `1fr 1fr` STEP AT 900 IS DELETED. With four grid
items it produced a 2x2: brand, Product, then Industries and Company on a second
row — which reads as two unrelated pairs and puts half the nav below a block of
prose. The stacked layout that already existed below 768 is the right answer at
this width too, so it simply starts earlier: brand and tagline centered across
the top, then Product / Industries / Company as three equal columns.

Nothing here is new; the breakpoint moved from 768 to 900 and one rule went.

---

## `.hero__robot-img`
<a id="hero-robot-img"></a>

⚠️ THE HEIGHT IS SET SO THE CURTAIN CROPS HIM, not so he fits: the robot's waist
should read as flush with the section rather than cut off. Reaffirmed against the
faded version.

Re-measure if the seam's height clamp or the Book path's edge value (104 of 120)
changes. Screenshot it; do not re-read the stylesheet.

---

## `@media (max-width: 1024px)`
<a id="media-max-width-1024px-2"></a>

---- THE HERO BELOW 1025px: ONE COLUMN, CARDS FIRST, ROBOT LAST ---------
This replaces a 900px block and a 980px block that between them produced three
different heroes across the tablet range, two of which were broken.

⚠️ 1024, NOT 980 OR 900. 981-1024 kept two columns while the float cards had
already dropped into the flow, so the robot was sized off a very tall text column
and rendered 833px tall with the cards sitting on his face. 1024 is also iPad
landscape, which is the width tablet review happens at.

⚠️ THE CARDS GO ABOVE THE ROBOT, and that is the whole fix. The artwork ends on a hard edge at the waist. On
desktop that edge is invisible because the robot runs past the hero's bottom and
`.hero { overflow: hidden }` clips him against the dark block below — dark meeting
dark. Stacked, the cards were the last thing in the hero, so the robot stopped in
the middle of a light section and the hard edge was simply on show.

---

## `.final-cta__highlight`
<a id="final-cta-highlight"></a>

Was #b9e991, a lime green. V3 runs one accent - teal - with emerald reserved
strictly for capture/success states and the recommended pricing tier. A
heading highlight is neither, so a green one reads as a second accent and
spends the signal that makes "Lead captured" mean something.
⚠️ --teal-DEEP, NOT --teal-light. This note used to end "--teal-light holds its own
against #00323A at display size" — true, and it stopped being the relevant test the
moment section 11 turned cream. #1FB6CC on #FDFBF7 is a pale wash at
display size: the same word that carried the heading on dark nearly disappears on
light. The teal decision is unchanged, only the step within it.

---

## `/* ⚠️ CREAM, NOT --warm-white. The white hero is section 1 of the HOMEPAGE specifically — the`
<a id="cream-not-warm-white-the-white-hero-is-secti"></a>

---- HERO: a V3 Split block -------------------------
⚠️ NO `padding` HERE ANY MORE, AND THAT IS THE POINT. It carried
`clamp(120px,15vw,180px) 0 clamp(70px,10vw,120px)` — a third spacing system
alongside `--section-padding` and `.ind-page > section`. `.block` owns the
padding now. A `padding` shorthand written here would silently beat
`.block`'s `padding-block` and put it straight back, which is the trap the V3
build already hit on three homepage sections that passed a class-list audit.

DELETED, not overridden, and each for its own reason:
- `::before`, a 120px gradient fading the hero into the cream below. It was a
SEAM. V3 has one seam on the entire site because a seam is a color contract
between two neighbors that fails silently at widths nobody sampled.
- `.ind-hero__accent` and `.ind-hero__glow`, two absolutely-positioned teal
radial gradients at 7% and 5% alpha. Decoration doing no work; V3 carries
emphasis with a dark block, not a wash. Their markup is deleted too — a
hidden div is a thing the next person has to re-decide.
- `position: relative` and `overflow: hidden`, which existed ONLY to contain
those three. Removing shared chrome is property-by-property: these two look
like generic hygiene and were load-bearing for the layers above, so they go
WITH them rather than being left behind as inert insurance.

---

## `.ind-hero { background: var(--cream); }`
<a id="ind-hero"></a>

⚠️ CREAM, NOT --warm-white. The white hero is section 1 of the HOMEPAGE specifically — the
brightest thing on the site and its clarity moment. An industry page is not that
page, and copying its tone spent the contrast without the reason.

It also removes a boundary that could only ever look like a bug: #FFFDF9 above
#FDFBF7 is a two-point step across the full viewport — too small to read as a
decision, too large to be nothing. Hero, Problems, FAQ and the siblings block are
one cream run now, and the dark blocks do all the dividing.

---

## `.block.ind-hero`
<a id="block-ind-hero"></a>

⚠️ `.block.ind-hero`, NOT `.ind-hero` — TWO CLASSES, AND THAT IS THE WHOLE RULE.
The padding is owned by `.block:not(.block--dark)`, which is (0,2,0); a bare
`.ind-hero` is (0,1,0) and loses to it regardless of source order. Written as one
class this shipped and changed nothing, and looked correct in the diff — the same
`:not` trap already recorded for two per-section paddings on the homepage.
`:not` contributes its argument's specificity.

⚠️ padding-block-START only, never the `padding` shorthand: a shorthand here
would clobber the bottom too and put this section back on its own scale, which is
exactly what the conversion removed.

---

## `.ind-hero__grid`
<a id="ind-hero-grid"></a>

⚠️ KEPT, AND NOT REDUNDANT NEXT TO .block-split__grid. It overrides that rule's
1fr 1fr. Was 1fr 1fr here too, which gave a 51px display headline only ~498px —
about sixteen characters a line, so a 79-character headline broke over five
lines. The visual is one isometric and never needed half the page.
minmax(0, 1fr) matters: a plain 1fr floors at the image's intrinsic width,
which was 522px and was what actually squeezed the text column.

---

## `.ind-hero__image`
<a id="ind-hero-image"></a>

Per-industry isometric art. Capped below the grid column width so the square
render sits in roughly the footprint the emoji held and the hero height
doesn't jump between pages that have art and pages that don't yet.
No border-radius or box-shadow: the art is a transparent cut-out, not a
tile, so a radius clips nothing and a shadow would draw a rectangle around
the invisible bounding box. The scene carries its own contact shadow, and
staying background-independent is what lets one file serve a light and a
dark page without a second set of renders.

---

## `.ind-section__head`
<a id="ind-section-head"></a>

---- The shared section header for every converted ind-* section --------
⚠️ THE H2 IS NEAR-BLACK, NOT --teal-deep. Teal is a FILL on this system —
buttons, pills, the seam — and teal display type was the single most visible
thing marking these pages as pre-V3. It also sat right on the contrast problem
--teal-text was created for: --teal-deep as TEXT measures 4.38 on cream.

Centered, and that IS the rule rather than an exception: a section header
centers when the section is full-width and stays left when it is the top of a
copy column. Every converted section here is full-width.

---

## `.ind-problem__icon`
<a id="ind-problem-icon"></a>

---- .ind-problem: the UNBOXED V3 statement card ------------------------
Three static statements on the industry page. No background, no border, no
hover lift — same treatment as .agency-card, which is V3's card and carries no
chrome at all.

⚠️ .ind-problem-card BELOW IS STILL LIVE and is a DIFFERENT COMPONENT: the
clickable directory tiles on /for/ and the five category hubs. A box on a link
is an affordance, so those keep theirs. One class name was doing both jobs,
which is why unboxing "the card" would have broken twenty-one tiles on six
pages that nobody was looking at.

---

## `.ind-recap`
<a id="ind-recap"></a>

--- Recap document ---
Deliberately the same artifact as the home page's what-you-get document:
same logo header, same "Conversation Recap" block, same Name / Phone /
Reason list, same suggested-follow-up line. Built on the shared tokens
rather than reusing the home page's classes, which carry that section's
own wrapper layout.

---

## `text-align: left;`
<a id="text-align-left-2"></a>

⚠️ THE PARAGRAPH IS LEFT WHILE ITS BLOCK STAYS CENTERED, and the label above it
stays centered too — header centered, content left, exactly as the homepage's §6
and §9 do it.

Section-by-section review. Left at EVERY width rather than below a
breakpoint: six lines is not better than ten, and this template had never had an
alignment pass at any width, so there is no signed-off desktop rendering to
preserve here.

---

## `@media (max-width: 900px)`
<a id="media-max-width-900px-3"></a>

---- `.ind-page > section:not(.block)` IS DELETED -----------
It was the scaffold that made the ind-* conversion safe one section at a time: a
`padding` SHORTHAND sitting ~10,900 lines after `.block`, where
`.ind-page > section` (0,1,1) out-specifies `.block` (0,1,0) — so without the
`:not` it would have beaten `.block`'s `padding-block` on every converted
section, which would have carried the right class, passed a class-list audit and
still rendered on the old scale. That is exactly how three homepage sections
shipped wrong during the V3 build.

Dead CSS with (0,1,1) and a shorthand is not neutral; it is a rule waiting to win
an argument nobody knows it is in. Its removal is why a future ind-* section can
be added without inheriting a spacing system that no longer exists.

---

## `.ind-siblings { background: var(--cream); }`
<a id="ind-siblings"></a>

--- More in this category ------------------------------------------------
Replaced "Explore More" (.ind-related), whose rules are deleted with it: a
centered flex-wrap of 17 links with no separators. ROWS, LEFT-ALIGNED — each
carries a name and a blurb, which makes it a list, and lists keep their left
edge. The arrow is a right-edge affordance, which is the other half of the
same rule: a centered row with an arrow pinned right is not centered, it is
lopsided.

---

## `.ind-page > section:has(> .seam-curtain) { position: relative; }`
<a id="ind-page-section-has-seam-curtain"></a>

---- Any section that carries a curtain, on every ind-* template ---------
⚠️ SELF-SCOPING BY `:has` RATHER THAN BY A MODIFIER CLASS, deliberately. The
sections that need this are different elements on each of the three templates,
one of them is inside a foreach loop, and which sections carry a curtain will
change again as the conversion continues. Keying off the curtain's own presence
means adding one to a section is a single markup edit that cannot be half-done —
there is no second place to remember.

The peak is 114/120 of the seam's height clamp, so the section has to give it
that much room or the shape lands on the last line of copy. The var is
load-bearing: the padding scale steps down at 1024 and 620. Same calculation
.block.final-cta already uses on the homepage.

---

## `/* ⚠️ THE FEATURE PAGES SHARE THIS RULE RATHER THAN COPYING IT. .sf-cta__btn and`
<a id="the-feature-pages-share-this-rule-rather-tha"></a>

⚠️ `color: white` ON --teal-light IS 1.9:1 AND HAD TO GO. It was designed
against the old teal gradient and was already failing there.

⚠️ THE FIRST FIX FOR IT WAS --text-on-cyan, AND THAT TOKEN DOES NOT EXIST IN
THIS STYLESHEET. It is documented as #06222C and used "in ~30 places" — on the
night-world branch, not this one. An undefined var is invalid at computed
value time, so `color` fell back to the INHERITED value, which inside
.block--dark is --text-on-dark. The button rendered #F0FAFA on #1FB6CC at
2.29:1: a contrast fix that made the contrast worse, silently, with no invalid
property anywhere in devtools.

---

## `.ind-cta__btn,`
<a id="ind-cta-btn"></a>

⚠️ THE FEATURE PAGES SHARE THIS RULE RATHER THAN COPYING IT. `.sf-cta__btn` and
`.ba-cta__btn` are listed here, not redefined in each page's inline <style>, because
two definitions of one treatment is how a "primary button on dark" ends up meaning
three different colors. They arrived carrying plain `.btn--primary`, which is
--teal-deep — #00838F on #00323A is 3.06:1, scraping the UI-component floor and
reading as a hole in the block rather than as the page's one action.

---

## `.ind-cta__actions`
<a id="ind-cta-actions"></a>

⚠️ THE SHIMMER ::before IS DELETED.
It was a white gradient sweeping the button on a 3s infinite loop — not a hover
effect at all, it ran constantly.

Not restored, because V3's primary buttons do not shimmer: the hover is now
exactly .btn--primary's — same lift, same shadow weight.

---

## `margin-bottom: -5%;`
<a id="margin-bottom-5"></a>

The renders are square with the subject floating inside, so each carries
  transparent padding under the art that reads as extra gap. Measured across
  all fifteen: 6.1%-12.8% of height (real-estate lowest, dental highest).
  -5% reclaims only the share every render has, so no image can ever pull
  the copy up into its artwork; the rest is left as the per-image variation
  it is. Percentage margins resolve against the container's WIDTH, which is
  what the square art is sized by, so this tracks the viewport on its own.
  Re-measure before changing this if the art is ever re-rendered.

---

## `.blog-post__header`
<a id="blog-post-header"></a>

--- Header ---
The featured image used to be `position:absolute; inset:0` BEHIND this header
with a 0.95 -> 0.35 gradient painted over it, i.e. a backdrop you were not
meant to see, cropped from a 1024x1024 source into a 480px letterbox. It is
now a framed figure sitting BELOW the title at its own aspect ratio. None of
the five blogs measured for this redesign (Figma, Ahrefs, Intercom, Stripe,
Linear) puts text over its featured image, for exactly this reason: once you
do, the image must be darkened to keep the text legible.

---

## `.blog-post__cta-banner`
<a id="blog-post-cta-banner"></a>

A dark PANEL on the cream, not a full-width dark band.

⚠️ This changed when the curtains went in, and it had to. The page runs
hero(dark) -> body(cream) -> CTA -> related(cream) -> footer(dark). A
full-bleed dark CTA in that middle position makes the page dark-light-dark
-light-dark, so the two curtains would bracket a run that is not actually
continuous, and the CTA would keep two hard horizontal edges of its own —
the exact thing the seams exist to remove.

---

## `/* ⚠️ .ind-cta IS DELIBERATELY OUT OF THIS LIST, AND REMOVING IT IS THE FIX`
<a id="ind-cta-is-deliberately-out-of-this-list-and"></a>

Sections adopting the spotlight: drop the dark gradient + texture.

.final-cta LEFT THIS GROUP. In V3 the homepage's closing CTA is
the second half of the dark tail (section 10's contained panel, then section
11 opening full-width), so it must be dark. It is styled by .block--dark now.

The other three stay: /about/, the industry pages and /download/ still use the
cream spotlight, and this rule is the only thing giving it to them. Deleting
the whole block to fix the homepage would have silently restyled three other
templates.

---

## `.about-cta,`
<a id="about-cta"></a>

⚠️ .ind-cta IS DELIBERATELY OUT OF THIS LIST, AND REMOVING IT IS THE FIX
FOR AN INVISIBLE SECTION. This rule sits ~2,000 lines after `.block--dark`, at
the same specificity, so it won the cascade and repainted the converted CTA
cream — while `.ind-cta h2` kept `color: white`. Measured on staging: 1.03:1.
The heading, the body and the outline button were all there and all unreadable.

⚠️ WHEN /about/ AND /download/ CONVERT, DELETE THIS WHOLE BLOCK. It has no
other purpose, and a two-selector version of it left behind is the next
cascade fight.

---

## `.nf`
<a id="nf"></a>

========== 404 — PAGE NOT FOUND ==========
Paired with 404.php. Before both existed, WordPress fell back to index.php and
rendered an unstyled "Blog / No content found." on every bad URL.

--teal-deep is used ONLY on .nf__code. It measures 4.38:1 on warm-white, which
clears AA for large text (3:1) and fails it for body copy (4.5:1) — so the
number can carry it and nothing else here may. Body copy uses --text-secondary.
The V3 branch introduces a --teal-text token for exactly this; it is deliberately
NOT backported here, because that branch owns it and duplicating it would
collide on merge.

---

## `/* ---- THE PRICE CARD'S SPEC ROWS CENTER. NOTHING ELSE DOES. ---------------`
<a id="the-price-card-s-spec-rows-center-nothing-el"></a>

============================================================================
LAST BLOCK IN THE FILE, ON PURPOSE. It is here because the reverted centering pass
that used to live at this address sat next to the FAQ rules for one deploy and lost
`.final-cta__copy` to a bare `text-align: left` 4,000 lines further down — same
specificity, later in the file, so it won. Anything added below this beats it.
============================================================================

---

## `@media (max-width: 1040px)`
<a id="media-max-width-1040px"></a>

---- THE PRICE CARD'S SPEC ROWS CENTER. NOTHING ELSE DOES. ---------------
A page-wide centering pass shipped and was reverted the same day. It had centered section 2's copy and stat cards, section 4's
callouts, the proof figures, the agency panel and the whole closing CTA, on the
argument that each of those was the copy half of a side-by-side whose partner is gone
below 1024. That argument is not wrong about the layout and it was still the wrong
call: a page of centered blocks loses the single left edge a reader tracks down a
phone screen, and the sections had not been re-decided individually.

⚠️ IF ALIGNMENT IS REVISITED, IT IS A SECTION-BY-SECTION REVIEW, NOT A SELECTOR LIST.'s own read: "we might need to review the site for this." Do not reinstate a
blanket rule here — that is the exact shape of the thing that was reverted.

---

## `@media (max-width: 1024px)`
<a id="media-max-width-1024px-3"></a>

⚠️ AND THE CLOSING CTA, WHICH  ASKED FOR SEPARATELY after the
blanket pass was reverted ("we should probably center the CTA section"). It is here
rather than beside the other .final-cta rules for the reason this whole block is at the
end of the file: `.final-cta__copy { text-align: left }` lives ~4,000 lines up at the
same specificity, and anything earlier loses to it.

THIS IS THE SECTION-BY-SECTION REVIEW STARTING, not the blanket rule coming back. One
section, asked for by name. Add the next one the same way — by name, after it has been
looked at — and never by widening this selector list on a hunch.

---

## `note`
<a id="note"></a>

============================================================================
THE REVIEW RAN, AND IT ADDED NOTHING HERE. That is the result, not a
gap. All eleven sections were screenshotted individually at 390 on staging and
looked at; the page was already correct and one defect was found elsewhere
(§4's assurance pill, fixed at .lang-section__english, not here).

⚠️ §2 COST, §7 PROOF AND §10 AGENCY DOOR KEEP THEIR HEADERS LEFT, AND THAT IS A
DECISION. They are the two Splits and the Panel. Centering their header block
alone, with the content still left, was sketched and rejected: one left edge, top
to bottom, beats a consistent section opening.
That is the reverted pass's reasoning holding a second time. Do not re-open it,
and do not "finish the job" by adding them below. Full audit table is in the wiki
at website/wiki/concepts/homepage-design-system.md.
============================================================================

---


# `assets/css/site.css` (additional notes)

## `.block--dark .section-label`
<a id="block-dark-section-label"></a>

⚠️ ON A DARK BLOCK THE LABEL HAS TO GO LIGHTER, NOT DARKER. --teal-text is tuned
against cream; on #00323A the same color measures 3.06:1, the worst contrast failure
on the page. --teal-light is 5.68 there. One label, two directions, because the
requirement is a relationship with the background and not a property of the label.

---

## `The scroll-reveal system was deleted. It defaulted every`
<a id="the-scroll-reveal-system-was-deleted-it-defaul"></a>

The scroll-reveal system was deleted. It defaulted every element to
opacity:0 and depended on decorative JS to restore it, so a single throw
anywhere earlier in site.js left the whole page below the fold permanently
invisible. That happened in production. Testers complained about the effect
independently. Nothing replaces it — sections are simply visible.

---

## `--block-max`
<a id="block-max"></a>

Matches .container so the restored container is one number site-wide.
V2 broke hero content to 40px from the raw viewport edge; V1 sits at ~150px
at 1440, which is the measure testers read comfortably.

---

## `--footer-dark`
<a id="footer-dark"></a>

The footer, one step darker than any section — see the .footer rule. It is a token
because TWO things have to agree on it: the footer's own background and the fill of
the curtain that meets it.

---

## `.block--tight`
<a id="block-tight"></a>

`.block--tight` NO LONGER CHANGES ANYTHING. The rule is kept, pointing at the same
single value, so the class still resolves everywhere it appears in the markup rather
than sitting there as a dead attribute that looks like it does something. If a second
padding value is ever genuinely needed, this is the hook — but adding one reopens the
inconsistency this collapse was asked for.

---

## `.hero + .block--dark`
<a id="hero-block-dark"></a>

⚠️ `position: relative` IS LOAD-BEARING TWICE. It is the containing block for the
opening curtain, which now lives inside this section — remove it and the curtain
positions itself against the viewport. It also puts this section's background in the
positioned-descendants paint phase, so the 2px overlap lands ON TOP of the hero's
rounded-off bottom edge rather than under it.

---

## `.block-split--reverse .block-split__art`
<a id="block-split-reverse-block-split-art"></a>

The artifact returns to DOM order on one column: a reversed Split stacks
image-then-text on desktop, but on mobile the heading must come first or
the reader meets a picture with no idea what it is.

---

## `WAS 0.45 ALPHA, WHICH IS 2.74:1 ON WHITE. Tolerable-ish `
<a id="was-0-45-alpha-which-is-2-74-1-on-white-tolera"></a>

⚠️ WAS 0.45 ALPHA, WHICH IS 2.74:1 ON WHITE. Tolerable-ish on a label; not
on a control. This is 10.56px, so 4.5:1 is the bar, not the large-text 3:1 —
bold does not make 10px large. 0.62 measures 4.55:1 and is still clearly
subordinate to the near-black industry links under it, which is the whole
job of the heading.

---

## `.nav__mega-all .nav__dropdown-link`
<a id="nav-mega-all-nav-dropdown-link"></a>

--teal-text, not --teal-deep: #00838F on white is 4.03:1 and this is 0.9rem
text, so it failed AA. Part of the same teal-deep-as-text sweep the ind-*
conversion is carrying.

---

## `Bottom padding CLEARS THE CURTAIN, which is absolutely p`
<a id="bottom-padding-clears-the-curtain-which-is-abs"></a>

Bottom padding CLEARS THE CURTAIN, which is absolutely positioned and
therefore costs no height of its own. Decoration goes behind content and
never adds height — the same rule the dark blocks follow. Set below the
curtain's own max height and the copy's last line sits in the dark.

---

## `40px, was 60px. NOTE: this rule is DUPLICATED verbatim f`
<a id="40px-was-60px-note-this-rule-is-duplicated-ver"></a>

40px, was 60px. NOTE: this rule is DUPLICATED verbatim
further down the file and the later copy wins. Both were changed together;
edit one alone and the value you read is not the value that renders.

---

## `NO OPACITY. It was 0.85, which is a contrast reduction d`
<a id="no-opacity-it-was-0-85-which-is-a-contrast-red"></a>

⚠️ NO OPACITY. It was 0.85, which is a contrast reduction dressed as a style: the
color passes at full strength and fails at 85%. Hover raises it back to 1, so the
"quieter than the primary" job was being done by the one property that also degrades
legibility. Weight and size already carry that job.

---

## `Sized against the ROBOT, not the stage. At min(460px,84%`
<a id="sized-against-the-robot-not-the-stage-at-min-4"></a>

Sized against the ROBOT, not the stage. At min(460px,84%) the bloom died out ~200px
from center while the figure is 240px wide and 300px tall, so the silhouette's own
edges — the part that has to read — were sitting back on flat section color. Wider
and a touch stronger puts the whole figure inside the lit area. Sampled at 1440:
section is (0,50,58) and the center of the bloom lifts to about (9,91,115).

---

## `.see-it__stage-robot`
<a id="see-it-stage-robot"></a>

Decoration, and deliberately quiet: the hero has this same character two sections up
at a far larger size, and the only thing stopping this reading as a repeat is that the
button is the subject here. Low opacity + behind the button is that decision in CSS.

---

## `.see-it__stage-play svg`
<a id="see-it-stage-play-svg"></a>

NO margin-left. The centering lives in the polygon's coordinates (see page-landing.php);
a CSS nudge here would stack on top of that offset and is what put the glyph off-center
in the first place. `display: block` so the svg does not sit on a text baseline, which
adds a few px of descender space under it and pushes the glyph optically high.

---

## `The panels arrive when the stage leaves. Two beats, left`
<a id="the-panels-arrive-when-the-stage-leaves-two-be"></a>

The panels arrive when the stage leaves. Two beats, left then right, so the eye reads
"a conversation happened" before "and here is what it produced" — the same causal
order the demo itself plays in. Decoration only: the panels are already in the DOM and
already populated, so a dropped animation costs nothing but the flourish.

---

## `.see-it__transport[hidden]`
<a id="see-it-transport-hidden"></a>

`display:flex` on a class selector BEATS the user-agent's `[hidden]{display:none}`,
so the PHP `hidden` attribute silently did nothing and a dead play button rendered
for anyone without JS. Any element that is both `hidden` in markup and given a
display value in CSS needs this; it is not specific to this component.

---

## `The duplicate .lang-section__text that sat here is DELET`
<a id="the-duplicate-lang-section-text-that-sat-here"></a>

⚠️ The duplicate .lang-section__text that sat here is DELETED, not left. It was
byte-identical to the one below and therefore invisible in a diff, but the later copy
won — so an edit made here would have done nothing at all and looked correct doing it.
That is the "dead CSS later in the file wins" trap the design system already lists
twice; the fix is to remove the loser, never to override it.

---

## `.lang-section__text`
<a id="lang-section-text-2"></a>

`balance` because this is a two-sentence subtitle in a 46rem centered column, which is
exactly the case it exists for: at 1440 the plain-English rewrite landed one word past
the line and left "up." alone on row two. Balancing the wrap rather than trimming the
copy to fit keeps it clean at every width instead of just at the one I screenshotted.
Already used in three other places in this file.

---

## `@media (max-width: 900px)`
<a id="media-max-width-900px-4"></a>

⚠️ THE HAZE IS DESKTOP-ONLY. Below 900px the chips leave their orbit and become an
in-flow wrap under the robot, so the stage stops being a fixed field for anything to
be scattered across — percentage coordinates there would land words on top of the
readable chips.

---

## `A MASK HIDES PIXELS, IT DOES NOT SHRINK THE BOX. The ima`
<a id="a-mask-hides-pixels-it-does-not-shrink-the-box"></a>

⚠️ A MASK HIDES PIXELS, IT DOES NOT SHRINK THE BOX. The image still occupies its
full height after the crop, so the bottom 22% is now blank space the layout still
reserves — which is the gap that opened between the robot and the recap line the
moment the end stop moved to 78%. Pulling the following content up by exactly that
22% closes it. Keep this multiplier and the mask's end stop in step: 100% - 78%.

---

## `.lang-orbit__item--1`
<a id="lang-orbit-item-1"></a>

TWO SIDE BANDS, SIX EACH, and the numbers are the point: every `left` keeps the chip's
own box under 30% of the stage and every `right` does the same from the other edge, so
the middle 40% — where the figure is — stays clear at every width. Stagger the tops,
never the bands.

---

## `@media (max-width: 900px)`
<a id="media-max-width-900px-5"></a>

⚠️ BELOW 900px THE GREETINGS STOP BEING POSITIONED AT ALL. This is the safety net the
crowd version never had: rather than shrinking twelve absolute chips until they
collide or fall off, the whole set drops into an in-flow centered wrap under the robot.
Twelve chips that wrap are always twelve chips; twelve that are positioned are only as
good as the narrowest viewport anybody checked.

---

## `.lang-section__english`
<a id="lang-section-english"></a>

Promoted from body text to its own element: it answers "great, but I can't
read Mandarin", which is the owner's immediate objection to this whole
section, and buried in a paragraph it did none of that work.

---

## `.lang-section__english svg`
<a id="lang-section-english-svg"></a>

Pins the check to the FIRST line instead of the middle of the wrapped block. 3px is
(21.6px line box - 16px icon) / 2 at this font size, so the single-line desktop
rendering is pixel-identical to the `align-items: center` it replaces.

---

## `.industries__link`
<a id="industries-link"></a>

⚠️ --teal-light ON DARK, NOT --teal-text. --teal-text (#00747E) exists to clear the
CREAM and is 1.6:1 here; --teal-light is 5.7:1 on #00323A. Same swap the design
system already mandates for .block--dark .section-label — contrast is a relationship,
so this link goes lighter for exactly the reason it went darker on cream.

---

## `.industries__name.is-active:hover`
<a id="industries-name-is-active-hover"></a>

Hover must not repaint the SELECTED row back to pale — it comes later in the file and
would otherwise win on equal specificity, so pointing at the open industry would make
it look unselected.

---

## `ONE-LEVEL ACCORDION. Category headings stay visible as s`
<a id="one-level-accordion-category-headings-stay-vis"></a>

ONE-LEVEL ACCORDION. Category headings stay visible as static labels and only
the industries expand — closed state is 5 headings + 16 names, about one and a
bit screens, so someone scanning for their trade sees everything at once.
Two stacked columns would mean tapping a name changes an image scrolled off
screen; a two-level accordion would be three taps deep.

---

## `.industries__art`
<a id="industries-art"></a>

⚠️ THE EXCERPT MUST BE HIDDEN EXPLICITLY NOW. It used to be a CHILD of
.industries__art, so this one line hid both; the restructure made it a
sibling so it could sit beside the isometric, and a sibling does not inherit its
old parent's display. Left out, the desktop excerpt renders on phones directly
above the accordion that repeats the same blurb.

---

## `.industries__name.is-active`
<a id="industries-name-is-active-2"></a>

⚠️ ON A PHONE ONLY `is-open` PAINTS, AND `is-active` MUST BE NEUTRALIZED.
`is-active` is the DESKTOP selection — the randomly featured industry, whose panel
and excerpt are both hidden at this width. Left styled it put a solid teal row into
a list where nothing was expanded, and then a SECOND teal row the moment the visitor
opened a different one. Two selected-looking rows, neither of them the open one.

---

## `.industries__mobile-detail img`
<a id="industries-mobile-detail-img"></a>

Centered, not left-aligned. At 200px hard left in a 348px column the isometric read
as a stray thumbnail with a hole beside it; the paragraph under it is full width, so
nothing was holding the right half. The % keeps it in proportion on a wide tablet.

---

## `.industries.is-interactive .industries__mobile-detail`
<a id="industries-is-interactive-industries-mobile-detail"></a>

Collapsed only once JS confirms it can reopen them. Without JS every detail
stays open, so a phone visitor with no script still gets every blurb and
every link rather than a list of dead buttons.

---

## `.price-includes--homepage .price-includes__item--lead`
<a id="price-includes-homepage-price-includes-item-lead"></a>

The flat-rate promise is the reason the pricing works at all, so it stays a
full-width row above the other inclusions rather than one chip of six. It is
the one place in this strip allowed display type.

---

## `.price-includes__footer`
<a id="price-includes-footer-2"></a>

No second rule here. One divider in the strip, under the lead row, because
that is the only real division: a promise, then the list it introduces. The
footer is a footnote to the list and sits on the same axis as it.

---

## `ROWS ARE DEFINED ON THE OUTER GRID AND INHERITED BY EVER`
<a id="rows-are-defined-on-the-outer-grid-and-inherit"></a>

ROWS ARE DEFINED ON THE OUTER GRID AND INHERITED BY EVERY COLUMN VIA SUBGRID.
Without this each tier is an independent nested grid whose rows only line up
by coincidence — and they did not: the rail's labels drifted against the
values they name, which in a comparison table means the reader is looking at
the wrong number. Subgrid makes the alignment structural rather than lucky.

---

## `@media (min-width: 1041px)`
<a id="media-min-width-1041px"></a>

⚠️ MIN-WIDTH, and it has to be. Below 1040px these stop being columns of one
panel and become separate cards that round on all four corners. Left
unscoped, the end-column radii out-specify the card rule and the Pro card
renders with two square corners on a phone.

---

## `.price-grid--table`
<a id="price-grid-table"></a>

⚠️ ONE HAIRLINE VALUE FOR THE WHOLE TABLE. Every internal rule is this
color. The light version had three (--border-light, cream-dark edges, the
popular column's own border) and they read as one line only because they were
all pale. On dark, a rule that is 2% brighter than its neighbor is visible as
a mistake, so there is exactly one.

---

## `.price-tier__identity`
<a id="price-tier-identity"></a>

The identity row is the only cell in the table that is allowed to breathe.
Everything below it is a data row on a 10px rhythm, so the prices need the
contrast of space to read as the header of the column rather than its first
value.

---

## `.price-grid--table .price-tier__row-value--yes`
<a id="price-grid-table-price-tier-row-value-yes"></a>

⚠️ THE CHECKMARK STAYS WHITE. Emerald on this page means two things only:
a capture/success state, and the recommended tier. A green tick in the
Autopilot row would put emerald in six cells across three columns and the
Business signal would stop being a signal.

---

## `.price-grid--table .price-tier .btn--outline`
<a id="price-grid-table-price-tier-btn-outline"></a>

⚠️ BOTH BUTTON VARIANTS ARE INVISIBLE ON THIS PANEL AS SHIPPED. --outline is
teal-deep text on a 2px teal-deep border, which on #00323A is dark-on-dark;
--primary is a teal-deep fill, only marginally lighter than the panel behind
it. Neither is a contrast tweak - the whole point of the panel is that the
CTAs in it are the most clickable things in the section.

---

## `.price-grid--table .price-tier .btn--primary`
<a id="price-grid-table-price-tier-btn-primary"></a>

The recommended tier's CTA is the one action this section is built to get, so
it is the only filled button on the panel. Teal-light rather than teal-deep:
the accent stays teal, and a light fill on a dark panel is the strongest
contrast available without introducing a color. Dark ink on it, not white -
white on #1FB6CC is about 2:1.

---

## `.price-grid--table .price-tier--popular`
<a id="price-grid-table-price-tier-popular"></a>

Business is the recommended tier, and EMERALD IS THE SIGNAL. Cyan is the
ambient color of this whole page, so a cyan price could not distinguish
anything - that is the documented reason this rule exists.

---

## `The emerald tint that made this column the recommended o`
<a id="the-emerald-tint-that-made-this-column-the-rec"></a>

The emerald tint that made this column the recommended one on white was
#F5FBF8 - a 4% wash. The same idea at the same strength is invisible on
dark, so it is carried as a translucent emerald over the panel instead.

---

## `The card rule scales this 1.03. In a subgrid table that `
<a id="the-card-rule-scales-this-1-03-in-a-subgrid-ta"></a>

The card rule scales this 1.03. In a subgrid table that shifts the whole
column off the label rail it is supposed to be read against, which in a
comparison table means the reader lines a value up with the wrong label.

---

## `.price-grid--table .price-tier--popular .price-tier__price`
<a id="price-grid-table-price-tier-popular-price-tier-price"></a>

⚠️ EMERALD IS THE RECOMMENDED-TIER SIGNAL AND IT HAS TO SURVIVE THE INVERSION.
#10b981 was chosen against white; on #00323A it dulls toward the background
and stops reading as "the one to pick". Lightened to the 400 step, which is
the same hue at the contrast the dark panel needs. Still emerald, still only
here and on the badge.

---

## `.price-grid--table .price-tier__badge`
<a id="price-grid-table-price-tier-badge"></a>

A LABEL ON THE BORDER, not a chip inside the box. It
straddles the panel's top edge over the Business column, the way a fieldset
legend sits on its frame.

---

## `THE BADGE'S COLOR IS DECIDED HERE, NOT ON .price-tier_`
<a id="the-badge-s-color-is-decided-here-not-on-pric"></a>

⚠️ THE BADGE'S COLOR IS DECIDED HERE, NOT ON `.price-tier__badge`. That rule sets
white on a teal gradient; this one repaints it emerald and won on source order, so a
fix applied up there did nothing and shipped still failing. Dark text on the emerald
is 5.46:1; white was 2.54. If the two ever disagree again, this is the one that
renders.

---

## `Visible for the same reason the panel is: the badge stra`
<a id="visible-for-the-same-reason-the-panel-is-the-b"></a>

Visible for the same reason the panel is: the badge straddles this card's
top edge here too. Nothing inside needs clipping - the rows carry a
border-top and no background, so there is nothing to spill past the
radius.

---

## `.price-grid--table .price-tier--popular`
<a id="price-grid-table-price-tier-popular-2"></a>

Each card is its own surface now, so the recommended tier has to re-state
its tint over the card rather than over the panel. The trial is the same
color as the other cards here, same as on desktop.

---

## `.price-tier__identity`
<a id="price-tier-identity-2"></a>

The one rule that survives: it separates the price from the spec list. With the
per-row hairlines gone this is the card's only internal division, which is what
stops the numbers reading as a continuation of the price.

---

## `.price-footnote`
<a id="price-footnote-2"></a>

The add-on fact, as a footnote to the table rather than a block under it. It
had no rule of its own at all, so it inherited the 1140px container and sat
flush against the panel - wider than the thing it annotates and touching it.
Same 1080px measure as the table and the strip; all three edges line up.

---

## `.faq-section__columns`
<a id="faq-section-columns"></a>

TWO COLUMNS OF CATEGORIES. `align-items: start` matters: without it the columns
stretch to equal height and the shorter one grows a tail of empty cream that tracks
whichever answers happen to be open.

---

## `.faq-section__ask-robot`
<a id="faq-section-ask-robot"></a>

⚠️ THE SAME BOTTOM-FADE PROBLEM AS THE OTHER TWO ROBOTS. These renders were made for a
dark background and their alpha runs to the frame edge, so on white the torso ends on
a hard cut. Masked here for the same reason and re-measured for this crop: the hands
are on the keyboard low in the frame, so the fade cannot start as high as the language
one's — 82% keeps the hands whole and still lands the figure before the edge.

---

## `16px, INHERITED FROM AN ELEMENT THAT NO LONGER EXISTS. T`
<a id="16px-inherited-from-an-element-that-no-longer"></a>

⚠️ 16px, INHERITED FROM AN ELEMENT THAT NO LONGER EXISTS. This was 6px, which was the
gap to the supporting line under it; the 16px that separated the copy from the BUTTON
lived on `.faq-section__ask-note`. That line was deleted and its spacing
had to come with it, or the button sits 6px under the heading. Removing an element is
property-by-property, never just a deletion.

---

## `.faq-section__ask-copy`
<a id="faq-section-ask-copy"></a>

The copy column: heading, then the button under it. `min-width: 0` so the heading may
wrap on a phone instead of forcing the card past `max-width: 100%` and pushing the
robot off its left edge.

---

## `.faq-section__ask-lead`
<a id="faq-section-ask-lead"></a>

The 14px gap above owns the space to the button now. This margin has been 6px, then
16px, then 0 across three shapes of this card in two days — if the button ever looks
glued to the heading again, it is the gap that moved, not this.

---

## `.faq-list__set .faq-item--open`
<a id="faq-list-set-faq-item-open"></a>

The open item still has to read as selected, but it cannot do it by lifting off the
page any more — it is a row inside a card, not a card. A teal edge and a tinted head
say the same thing without breaking the card's outline. The tint is on the QUESTION
only: the answer runs several lines and body text on --teal-pale is a wash.

---

## `.faq-list__set .faq-item--open .faq-item__question`
<a id="faq-list-set-faq-item-open-faq-item-question"></a>

⚠️ THE TINT COVERS THE ANSWER TOO. Held to the question alone it
drew a pale band across the top of a white block and the two read as separate things,
when the whole point of the highlight is that the question and its answer are ONE
open item. The earlier worry — body text on --teal-pale being a wash — measured fine:
--text-secondary on #E0F7FA is well past 4.5:1.

---

## `ROOMIER THAN THE RUN, ON PURPOSE. This is the one light `
<a id="roomier-than-the-run-on-purpose-this-is-the-on"></a>

⚠️ ROOMIER THAN THE RUN, ON PURPOSE. This is the one light section with decoration
ABOVE and BELOW its content, and at the standard 96px the props had nowhere to live
but on top of the card. `.block.agency-door` because `.block:not(.block--dark)` is
0,2,0 and beats a bare class regardless of order — see .block.what-you-get.

---

## `THE LAYER IS THE CARD'S WIDTH, NOT THE SECTION'S — this `
<a id="the-layer-is-the-card-s-width-not-the-section"></a>

⚠️ THE LAYER IS THE CARD'S WIDTH, NOT THE SECTION'S — this is the whole reason the
props stay glued to the card. It was `inset: 0`, i.e. the full-bleed section, so every
percentage resolved against the VIEWPORT: at 1440 the props hugged the card and by
2000 they had drifted far out into the cream, because the box they were measured
against had grown by 560px while the card had not.

---

## `.agency-door__prop--front`
<a id="agency-door-prop-front"></a>

IN FRONT of the card, which sits at z-index auto inside .block__inner. A deeper, harder
shadow because these are the props actually casting onto a surface rather than lying on
the page behind everything.

---

## `Full width. The 860px cap made it a contained aside INSI`
<a id="full-width-the-860px-cap-made-it-a-contained-a"></a>

Full width. The 860px cap made it a contained aside INSIDE the dark run; on cream
the inversion already does that, and the cap only made it look like a narrow
interruption.

---

## `WHITE, NOT --teal-light. The disc's own translucent teal`
<a id="white-not-teal-light-the-disc-s-own-translucen"></a>

⚠️ WHITE, NOT --teal-light. The disc's own translucent teal fill lightens the dark
panel underneath it, so the numeral measured 4.09:1 against its own background —
the same self-lightening shape as the Salesforce Lead Source pill. White also
matches `.ind-step__number`, which is the other numbered step on the site.

---

## `-1px on BOTH, for the same reason in both directions: su`
<a id="1px-on-both-for-the-same-reason-in-both-direc"></a>

-1px on BOTH, for the same reason in both directions: sub-pixel rounding otherwise
leaves a hairline of the light section's background between the seam and the dark
block it meets — a pale line across the full width, which is the exact edge these
elements exist to remove.

---

## `.footer-seam`
<a id="footer-seam-2"></a>

⚠️ A ZERO-HEIGHT WRAPPER OUTSIDE <footer>, NOT A CHILD OF IT. As the footer's
first child the curtain was invisible while measuring perfectly — correct size,
correct fill, offsetParent correct, rect exactly 98px above the footer's top
edge. `.footer` sets `overflow: hidden`, which clips an absolutely-positioned
child hanging above the box out of existence.

---

## `Room for the peak in whatever section ends the page, on `
<a id="room-for-the-peak-in-whatever-section-ends-the"></a>

Room for the peak in whatever section ends the page, on every template. Two
rules because the dark and light padding scales differ, and the last section is
dark on the industry pages and cream on the homepage.

---

## `.job-value:hover .job-value__mark::after`
<a id="job-value-hover-job-value-mark-after"></a>

The watermark comes up with the card. It stays FAR below legibility — this is 0.055
to 0.09, not a reveal.'s brief was that it is "not meant to be imposing"; a
hover that turns it into a readable word makes it the loudest thing on the card.

---

## `.job-value__icon`
<a id="job-value-icon-2"></a>

EVERY CARD CHILD HAS TO BE RAISED ABOVE THE WATERMARK. The watermark is z-index 0 and
the rest of the card's children are static, so without this they paint in source order
underneath it — the amount would sit *behind* the stamp rather than on it.

---

## `Padding comes from .block. ONE LIGHT TONE FOR THE WHOLE `
<a id="padding-comes-from-block-one-light-tone-for-th"></a>

Padding comes from .block. ONE LIGHT TONE FOR THE WHOLE RUN — see the note on
.what-you-get. This rule used to say --warm-white and reasoned that a "third tone"
would read as a band; the actual problem was that there were TWO.

---

## `.proof-section__grid`
<a id="proof-section-grid"></a>

STRETCH, so the quote panel is as tall as the evidence column beside it. This
is the other half of moving the header into the column: the header supplies the
height and `stretch` hands it to the panel. At `start` the panel is only ever as
tall as its own text, which is what made it read small.

---

## `Roomier. This gap is the only spacing between the header`
<a id="roomier-this-gap-is-the-only-spacing-between-t"></a>

Roomier.
This gap is the only spacing between the header, the stat pair and the source
line -- .proof-section__evidence is a flex column, so one value moves all three.

---

## `.proof-section__lead-sub`
<a id="proof-section-lead-sub"></a>

⚠️ INLINE WITH THE LABEL, NOT STACKED UNDER IT. It is a child of
.proof-section__lead-label now, so it flows as part of the same sentence — "23 qualified
leads out of 72 conversations" — rather than reading as a third line under a two-line
stat. `display: inline` is what keeps that true when the phrase wraps: as a block it
would break onto its own line again at any narrow width and silently undo this.

---

## `.proof-section__quote-block`
<a id="proof-section-quote-block"></a>

Stacked, the quote panel no longer has a column to be as tall as, so the
centering and the stretch both stop applying. The two planes stay - they are
the section's one piece of treatment and they read the same at any width.

---

## `.proof-section__divider`
<a id="proof-section-divider"></a>

⚠️ The role drops to its own line here. Inline after a "|" on a phone it
wrapped mid-attribution and left the divider dangling at a line end - the
same dangling-separator bug section 6 was rebuilt to fix.

---

## `The top/bottom hairlines are gone: this section now foll`
<a id="the-top-bottom-hairlines-are-gone-this-section"></a>

The top/bottom hairlines are gone: this section now follows the dark block, and a
border between a dark section and a cream one is a line drawn on a boundary that is
already unmistakable. The closing curtain does that job properly instead.

---

## `.morning-inbox__row`
<a id="morning-inbox-row-2"></a>

The row is a BUTTON now, so it has to be un-styled back to a row: browsers give
buttons their own font, a centered text-align and a background, none of which a table
row wants. `font: inherit` is the one that matters — without it the whole inbox
silently drops to the UA's 13px system font.

---

## `.what-you-get.is-interactive .morning-inbox__row`
<a id="what-you-get-is-interactive-morning-inbox-row"></a>

⚠️ THE AFFORDANCE ONLY APPEARS ONCE JS CAN HONOR IT. `.is-interactive` is added by
the script after the dialogs are wired, so with no JS these read as plain rows — no
pointer cursor, no chevron. A button that looks clickable and does nothing is worse
than a row that never claimed to be one.

---

## `margin: auto IS RESTORED DELIBERATELY. A modal <dialog`
<a id="margin-auto-is-restored-deliberately-a-modal"></a>

⚠️ `margin: auto` IS RESTORED DELIBERATELY. A modal <dialog> is centered by the UA
stylesheet's own `margin: auto`, and line 38 of this file resets margin to 0 on
`*` — which beats it and pins the sheet to the top-left corner. Nothing about the
dialog looks wrong in the markup; it just sits in the corner.

---

## `.what-you-get__callouts`
<a id="what-you-get-callouts"></a>

⚠️ 820, NARROWED WITH THE 2x2. At 980 across two columns each cell
is ~480px wide holding a centered icon-and-heading cluster of about 240 — the pair
floated in the middle of a lot of nothing, and only the longest description ever
reached the edges. Narrowing the grid is the fix rather than widening the type.

---

## `@media (prefers-reduced-motion: no-preference)`
<a id="media-prefers-reduced-motion-no-preference"></a>

Double-pulse on the recap when the call completes — guides the eye to the payoff.
Must live on the aside, not .conversation-recap: the aside's overflow: hidden
clips any outward shadow painted by its children.

---

## `No padding here: .block owns it. A padding SHORTHAND d`
<a id="no-padding-here-block-owns-it-a-padding-shorth"></a>

No padding here: .block owns it. A `padding` SHORTHAND declared later in this
file beats .block's `padding-block`, so a section can carry the class and still
sit off the scale - which is exactly what these two were doing.

---

## `THE LEGACY FAQ RULES WERE DELETED HERE. .faq-section__gr`
<a id="the-legacy-faq-rules-were-deleted-here-faq-sec"></a>

THE LEGACY FAQ RULES WERE DELETED HERE.
.faq-section__grid / __item / __question / __answer styled an OLDER FAQ markup that no
template renders any more — grepped all PHP before removing. The __grid copy was
actively harmful: declared later than the real layout rules above, it won on equal
specificity, so the section's true column definition was the dead one.

---

## `auto-fit + centered so the row stays balanced whatever t`
<a id="auto-fit-centered-so-the-row-stays-balanced-wh"></a>

auto-fit + centered so the row stays balanced whatever the item count. Was a
hard 1fr 1fr, which stranded the survivor in the left column when the
flat-rate text-chat item was removed.

---

## `.faq-list__set`
<a id="faq-list-set-2"></a>

⚠️ THIS CARRIES THE 12px THAT .faq-list USED TO GIVE THE ITEMS DIRECTLY. The items are
inside a per-group wrapper now, so .faq-list's gap separates HEADINGS from SETS and no
longer reaches the questions. Same value, so desktop renders exactly as before — the
wrapper exists for the phone treatment below and must be invisible above it.

---

## `.faq-item--open .faq-item__answer`
<a id="faq-item-open-faq-item-answer"></a>

⚠️ 300px HAD TO GO UP. The longest answer here runs past it, and a max-height that
clips mid-sentence looks like a rendering fault rather than a truncation. It is a
transition ceiling, not a layout constraint — overshooting only makes the open
animation slightly faster over the unused portion.

---

## `.faq-item--open`
<a id="faq-item-open"></a>

THE OPEN ONE IS HIGHLIGHTED. With everything collapsed by default, the open card is the only thing on
screen with any state, and it needs to read as selected rather than as merely taller.
Teal border + tinted head, matching the industry list's selected pill — same idea,
same palette, so the page has one language for "this is the one you chose".

---

## `The light scale plus the closing curtain's peak height, `
<a id="the-light-scale-plus-the-closing-curtain-s-pea"></a>

The light scale plus the closing curtain's peak height, so the gap below the last
line matches every other section. 0.95 is 114/120 of the seam's own height clamp.
The var is load-bearing: the scale steps down at 1024 and 620.

---

## `The shortcode renders its own widget button and its attr`
<a id="the-shortcode-renders-its-own-widget-button-an"></a>

The shortcode renders its own widget button and its attributes are not
trustworthy - border_width="1" is a documented no-op, so the border is set
here rather than passed in. Measure the render; do not read the attribute.

---

## `--btn-text-color`
<a id="btn-text-color"></a>

--teal-text, not --teal-deep: this button is outlined on the cream, so its label is
teal TEXT on a light background and lands in the same 4.38:1 failure as every other
teal text on the page. The icon follows it so the two do not drift apart.

---

## `.final-cta__robot img`
<a id="final-cta-robot-img"></a>

Full section height rather than a fixed clamp. Driving it off the wrapper's
top/bottom means the figure scales with whatever the copy makes the section, instead of
a number that has to be re-tuned every time a line of copy is added or removed.

---

## `.final-cta__copy`
<a id="final-cta-copy"></a>

⚠️ NARROWED WHEN THE ROBOT GREW. At 34rem the copy box and the full-height figure
overlapped at every width — measured 8px at 1440 and worse below. The figure is now
~604px wide, so the container has to hold copy + gap + figure: 1140 - 480 - 40 = 620,
which clears it. Re-check this if either the robot's height or --block-max changes.

---

## `.final-cta__robot`
<a id="final-cta-robot-2"></a>

Below this the copy column and the figure compete for the same space and the figure
gives way. 1240 rather than 1100: the robot is full-section-height now and therefore
much wider than the fixed-clamp version this breakpoint was set for.

---

## `.footer`
<a id="footer-2"></a>

⚠️ DARKER THAN --block-dark, DELIBERATELY. #00232A against the page's #00323A.

The old #0a2e33 was a slightly blue-green off-tone that matched nothing in the palette.

---

## `.footer__main::before`
<a id="footer-main-before"></a>

⚠️ THE EMERALD WASH IS GONE. This carried two radial gradients, one teal and one
rgba(16,185,129) — emerald. Emerald is reserved on this site for capture/success states
and the recommended pricing tier; a decorative wash in it spends the signal that makes
"Lead captured" mean something. The teal one goes too: the point of the new footer
color is a flat, settled floor, and a gradient works against that.

---

## `Body sets line-height 1.65, which made every row ~32px t`
<a id="body-sets-line-height-1-65-which-made-every-ro"></a>

Body sets line-height 1.65, which made every row ~32px tall and left the
lists sprawling. Set it here rather than on the anchor: the <a> is inline,
so its line-height never governed the row.

---

## `.footer__col a`
<a id="footer-col-a"></a>

⚠️ THE PADDING IS THE TAP TARGET (Lighthouse best-practices: "Touch
targets do not have sufficient size or spacing", flagging the Support mailto). An
inline <a> is only as tall as its text — about 19px here — and the requirement is 24.
Inline-block plus vertical padding gets there without moving anything visually, because
the row spacing below absorbs it.

---

## `.footer__all-industries`
<a id="footer-all-industries"></a>

The footer lists the five industry CATEGORIES, not all fifteen industries.
Fifteen links made the footer read as a wall of text whichever way they were
arranged; the categories are the durable navigation and each one is a hub
page that absorbs new industries without the footer changing at all.

---

## `@media (max-width: 480px)`
<a id="media-max-width-480px"></a>

The two phone blocks that used to sit here moved up into the section 8 block
with the rest of the strip's rules. They existed to chase a positioned notch
label that no longer exists.

---

## `40px, was 60px. NOTE: this rule is DUPLICATED verbatim f`
<a id="40px-was-60px-note-this-rule-is-duplicated-ver-2"></a>

40px, was 60px. NOTE: this rule is DUPLICATED verbatim
further down the file and the later copy wins. Both were changed together;
edit one alone and the value you read is not the value that renders.

---

## `.hero`
<a id="hero"></a>

Capped at ~720px so section 2's dark block is on screen at 1440x900 without
scrolling. The old 800px ceiling pushed it below the fold on a laptop, which
cost the page its first contrast moment.

---

## `0 so the robot's own bottom edge IS the hero's bottom ed`
<a id="0-so-the-robot-s-own-bottom-edge-is-the-hero-s"></a>

0 so the robot's own bottom edge IS the hero's bottom edge. The old value here
was clamp(76px, 10vw, 104px), sized to keep the cards clear of the seam apex
back when the cards were last; nothing is last but the robot now, and he is
meant to be cropped.

---

## `.hero__canvas`
<a id="hero-canvas"></a>

The soundwave is masked to fade in from 30% to 65% of the width — a device for a
two-column composition, where it sits behind the robot on the right. Centered and
stacked it reads as a stray band of texture off to one side. Already hidden below
768px for the same reason; this only moves that decision up to where the layout
actually changes.

---

## `Deliberately smaller than the global --hero-title-size. `
<a id="deliberately-smaller-than-the-global-hero-titl"></a>

Deliberately smaller than the global --hero-title-size. These headlines are
full narrative sentences of 60-79 characters, not the short phrases the
global size was set for, so 51px broke them over five lines. Scoped to this
page type and applied to all fifteen.

---

## `.ind-problems`
<a id="ind-problems"></a>

⚠️ NO `padding` HERE. `.block` owns it — a shorthand written here beats
`.block`'s `padding-block` from anywhere later in the file. Same for every
converted ind-* section below.

---

## `.ind-problem-card__icon--art`
<a id="ind-problem-card-icon-art"></a>

Industries with isometric art use it in place of the emoji tile. The art is
transparent and already carries the brand teal, so it drops the pale square
and takes the room it needs to stay legible.

---

## `.ind-directory__group h2 a`
<a id="ind-directory-group-h2-a"></a>

Group headings link through to their category hub. `--teal-text`, not
`--teal-deep`: the hover state is display type on cream, where --teal-deep
measures 4.38:1. Part of the same teal-deep-as-text sweep the conversion
carries.

---

## `The page's one dark band. Seven sections alternated betw`
<a id="the-page-s-one-dark-band-seven-sections-altern"></a>

The page's one dark band. Seven sections alternated between #FFFDF9 and
#FDFBF7 — a two-point difference nobody can see — so 5,000px of page read as
one uninterrupted cream scroll with no signal that a new idea had started.
Reuses the footer's surface rather than introducing another color.

---

## `.ind-solutions`
<a id="ind-solutions"></a>

⚠️ WAS #0a2e33 — A SECOND DARK TONE. V3's dark is V1's deep teal --block-dark
(#00323A) specifically: testers rejected the night world's near-black, and
drifting back toward it quietly reintroduces the tone the redesign exists to
drop. `.block--dark` supplies both the background and the text color now, so
this rule only survives to hold what is genuinely local.

---

## `.ind-solutions__steps`
<a id="ind-solutions-steps"></a>

DELETED with their markup: .ind-solutions__bg (two 3-4% radial gradients over
a flat dark background) and .ind-solutions__header (superseded by the shared
.ind-section__head). Removed rather than left, so the next person does not have
to work out which of two header rules is the live one.

---

## `.ind-scenario`
<a id="ind-scenario"></a>

⚠️ THE PALE-BLUE GRADIENT IS GONE. Its own comment said it was tinted "so it
reads as a distinct panel between the dark band above and the cream FAQ below"
— a fourth background solving a problem that only existed because the page had
five. It is the second half of the dark run now; `.block--dark` paints it.

---

## `--teal-light, and NO opacity. --teal-deep measured 3.06:`
<a id="teal-light-and-no-opacity-teal-deep-measured"></a>

⚠️ --teal-light, and NO opacity. --teal-deep measured 3.06:1 on the dark
block; opacity: 0.75 then reduced whatever it was by another quarter, which
is a contrast cut dressed as a style — the caption is already quieter than
its neighbors by size, weight and letter-spacing. 5.7:1 now.

---

## `.ind-recap__section-head span`
<a id="ind-recap-section-head-span"></a>

⚠️ --teal-text, not --teal-deep: 4.06:1 on the pale-teal pill, so it failed AA
at 0.64rem. PRE-EXISTING and nothing to do with the dark conversion — it is on
a white card either way — but it surfaced in the contrast pass over these
sections and it is one word of the same ~144-declaration teal-deep-as-text
sweep this conversion is carrying. 5.0:1 now.

---

## `.ind-recap__transcript`
<a id="ind-recap-transcript"></a>

The transcript stub. Quieter than the recap section above it: no badge color,
a muted count, one line of explanatory text. It is a signpost, not a second
block of content competing with the summary.

---

## `.ind-recap__section-head .ind-recap__count`
<a id="ind-recap-section-head-ind-recap-count"></a>

⚠️ TWO CLASSES, because `.ind-recap__section-head span` (0,1,1) out-specifies a
bare `.ind-recap__count` (0,1,0) regardless of source order, and would have
rendered the message count as the teal "New lead" pill.

---

## `.ind-scenario__story > p`
<a id="ind-scenario-story-p"></a>

⚠️ INHERIT, NOT --text-secondary. That token (#4A5568) is a light-background
color and measured 1.84:1 once this section became dark. Inheriting picks up
`.block--dark`'s --text-on-dark, so the paragraph follows the section it is in
instead of naming a color that is only right on one of them.

---

## `.ind-faq`
<a id="ind-faq"></a>

Cream, not --warm-white: the FAQ and the siblings block are one light run
between two dark ones, and two near-identical off-whites two units apart read
as a rendering artefact rather than as a decision.

---

## `EVERYTHING THIS RULE USED TO DO IS NOW .block--dark's JO`
<a id="everything-this-rule-used-to-do-is-now-block-d"></a>

⚠️ EVERYTHING THIS RULE USED TO DO IS NOW .block--dark's JOB. It carried its
own padding clamp (a third spacing system), a two-stop teal gradient (a fifth
background), and `text-align: center` (now .block-statement). The section ends
on the same dark the footer sits under, so the CTA and the footer read as one
closing run rather than a card floating above a boundary.

---

## `@media (max-width: 768px)`
<a id="media-max-width-768px-2"></a>

The `.ind-problems__grid` collapse that lived here is gone with the class.
`.block-cards__grid` carries the whole responsive story now: 3 -> 2 at 900,
2 -> 1 at 560.

---

## `Stacked, the desktop gap becomes the space between the`
<a id="stacked-the-desktop-gap-becomes-the-space-betw"></a>

Stacked, the desktop `gap` becomes the space between the art and the copy
beneath it, and clamp(40px, 6vw, 80px) is far too generous for that job —
it was sized to separate two side-by-side columns. Measured on a 390px
phone before this: 88px of visible space under the dental artwork.

---

## `NOTE: currently inert. .ind-hero__visual img (0,1,1) o`
<a id="note-currently-inert-ind-hero-visual-img-0-1-1"></a>

NOTE: currently inert. `.ind-hero__visual img` (0,1,1) outranks
`.ind-hero__image` (0,1,0), so max-width: 100% wins and the art renders at
full column width. Left in place deliberately — making it bite would
shrink the approved artwork. Raise specificity here to revive it.

---

## `The hero runs the FULL container; the body runs a readin`
<a id="the-hero-runs-the-full-container-the-body-runs"></a>

The hero runs the FULL container; the body runs a reading measure under it.

Revision history matters here, because two earlier shapes were rejected and
the reasons are not obvious from the result:

---

## `.blog-post__label`
<a id="blog-post-label"></a>

The article body runs the FULL container, same as every other section of the
site — a deliberate call. It was briefly 860px for an ~85-character
measure; at 1140 the lines run ~118 characters. Type is bumped a step to take
some of that back.

---

## `72px at 1440. Do NOT chase Figma's 90px: their face is a`
<a id="72px-at-1440-do-not-chase-figma-s-90px-their-f"></a>

72px at 1440. Do NOT chase Figma's 90px: their face is a 400-weight sans
and Fraunces at 700 is far heavier per pixel — past ~72px it reads as a
brick rather than a headline.

---

## `72px. The hero is the full 1140px container again, so th`
<a id="72px-the-hero-is-the-full-1140px-container-aga"></a>

72px. The hero is the full 1140px container again, so the headline has the
room for it. Still do NOT chase Figma's 90px — Fraunces at 700 is far
heavier per pixel and reads as a brick.

---

## `Stated on the FRAME, not left to the file, so the hero's`
<a id="stated-on-the-frame-not-left-to-the-file-so-th"></a>

Stated on the FRAME, not left to the file, so the hero's height is the same
on every post and does not jump while the backfill to 16:9 is in progress.
⚠️ Legacy 1024x1024 posts are center-cropped by this until they are
regenerated — that is the transitional cost, and it is smaller than a
1140px-tall square.

---

## `The curtain is an ABSOLUTE OVERLAY (see template-parts/s`
<a id="the-curtain-is-an-absolute-overlay-see-templat"></a>

The curtain is an ABSOLUTE OVERLAY (see template-parts/seam-curtain.php), so
its host needs position and must not clip it. The seam's own height is added
ON TOP of the 96px block padding, exactly as the homepage does it, so the
visible gap below the divider is still 96px rather than 96 minus the curve.

---

## `.blog-post__layout`
<a id="blog-post-layout"></a>

One column. The sticky Contents rail that used to sit at 210px on the left was
removed on a deliberate call — a element that moves in the margin competes with
the sentence you are reading. Heading ids are still injected by
sitestaffr_blog_toc so in-page anchors and search-result jump links keep
working; only the rail is gone.

---

## `Matches .blog-post__body p. It was 1.02rem against a 1.1`
<a id="matches-blog-post-body-p-it-was-1-02rem-agains"></a>

Matches .blog-post__body p. It was 1.02rem against a 1.1875rem paragraph,
which only became obvious once the paragraph went to 1.25rem for the full
-width measure — a list is body copy and should not read as a footnote.

---

## `Industry (/for/) links inside post paragraphs render as `
<a id="industry-for-links-inside-post-paragraphs-rend"></a>

Industry (/for/) links inside post paragraphs render as normal inline
links. The arrow CTA treatment lives only in .industry-card, where links
are genuinely standalone — applying it to every in-paragraph /for/ link
bolted arrows onto links the Blog Agent weaves into sentences.

---

## `The nav is FIXED, so it does not consume flow and the he`
<a id="the-nav-is-fixed-so-it-does-not-consume-flow-a"></a>

The nav is FIXED, so it does not consume flow and the hero's top padding
is the only thing holding the eyebrow off it. 56px put the eyebrow within
a few pixels of the nav's bottom edge at 768 and 390 — visible in a
screenshot, invisible in the CSS, because at 1440 the 96px desktop value
hid it.

---

## `This is a padding SHORTHAND and it sits later in the f`
<a id="this-is-a-padding-shorthand-and-it-sits-later"></a>

⚠️ This is a `padding` SHORTHAND and it sits later in the file, so it beats
the desktop rule outright — including the seam allowance baked into it.
Written as 56px flat, the curtain overlaid the first heading's air and the
article opened tight under the spike. The seam height has to be re-added
at every breakpoint that restates this padding.

---

## `.blog-index__hero`
<a id="blog-index-hero"></a>

Deliberately short. It was 449px tall with its right half empty, which reads
as unfinished rather than as restraint. The answer was height, not
decoration — the lead card immediately below is the visual event, and the
curtain now gives the bottom edge its gesture. 140px of top padding was also
clearing a 72px fixed nav twice over.

---

## `.blog-card__image`
<a id="blog-card-image"></a>

16 / 9, matching the hero and the featured-image backfill. This was 1/1 for
one build, when every published image was 1024x1024 and cropping a square to
a wide box threw away the subjects at its edges. Regenerating the artwork at
16/9 is the upstream fix, so the card follows the artwork rather than the
other way round.

---

## `.blog-card__image--placeholder`
<a id="blog-card-image-placeholder"></a>

Fallback only — every published post currently has a featured image. A flat
colored box with an emoji in it reads as a broken image, so when one really
is missing the card falls back to type rather than to a void.

---

## `.blog-card__readtime::before`
<a id="blog-card-readtime-before"></a>

Read time replaced the category badge. Every published post is filed under
the same single category, so the badge rendered the identical label on all
twelve cards — twelve repetitions of nothing. Reinstate it only once a
second category has real posts in it.

---

## `.blog-post__related`
<a id="blog-post-related"></a>

--cream, matching the body, NOT --cream-dark. The point of the two curtains is
that everything between them is ONE light run; a second cream tone here put a
hard horizontal edge in the middle of it, which is the kind of seam the
curtains were added to replace. The dark CTA panel already separates Keep
Reading from the article.

---

## `.blog-post__related .seam-curtain path`
<a id="blog-post-related-seam-curtain-path"></a>

⚠️ This curtain pours the FOOTER in, not a section, so it fills --footer-dark.
Filling it with --block-dark would paint #00323A directly above a #00232A
footer: a 16-point step across the full viewport width, which is the exact
hairline the seam exists to remove. Same reasoning as .final-cta on the
homepage; scoped by parent because the seam cannot know what sits below it.

---

## `Dark on purpose: /download/ is an almost entirely white `
<a id="dark-on-purpose-download-is-an-almost-entirely"></a>

Dark on purpose: /download/ is an almost entirely white page, so the one thing
we want read first has to carry weight.
This used to say "same gradient as .proof-section__backdrop-panel, keeps it
in-system" — that element was deleted with the V1 proof design,
so the gradient is now local to this page and nothing else shares it.

---

## `.cta-spotlight .btn--primary`
<a id="cta-spotlight-btn-primary"></a>

Solid primary buttons keep white text on the card. `.cta-spotlight a` is more
specific than `.btn--primary`, so without this the label goes teal-on-teal and
disappears against the button's own background. Same for the hover state.

---

## `.cta-spotlight .ind-cta__btn`
<a id="cta-spotlight-ind-cta-btn"></a>

Industry pages' primary CTA — same trap as .btn--primary above. `.ind-cta__btn`
is one class, `.cta-spotlight a` is two, so the label was losing to teal-deep
and rendering dark on the button's own teal background.

---

