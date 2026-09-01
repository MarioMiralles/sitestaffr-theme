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
colour everywhere a fill uses it, this is a separate token for the text case only.
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
padding, and 64px is what separates a section from a section it has a colour change
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
muted colour, and the affordance arrives on hover.

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
This does NOT generalise to the rest of the page — see the last block of this file.

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
outside.'s first idea was a colour per group; that would have put a second and
third accent on a page whose whole system is one teal with emerald reserved for
capture states, and he chose this instead. If colour-coding is ever revisited, the
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
colour comes from `--btn-icon-color`. On this outline button that is a white mark on a
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

Centred to --block-max with auto margins and flushed right inside that, so it sits
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
SEAM. V3 has one seam on the entire site because a seam is a colour contract
between two neighbours that fails silently at widths nobody sampled.
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

Centred, and that IS the rule rather than an exception: a section header
centres when the section is full-width and stays left when it is the top of a
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
centred flex-wrap of 17 links with no separators. ROWS, LEFT-ALIGNED — each
carries a name and a blurb, which makes it a list, and lists keep their left
edge. The arrow is a right-edge affordance, which is the other half of the
same rule: a centred row with an arrow pinned right is not centred, it is
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
three different colours. They arrived carrying plain `.btn--primary`, which is
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

