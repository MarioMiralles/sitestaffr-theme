<?php
/**
 * The curtain seam — the ONLY seam that survives V3.
 *
 * WHY IT EXISTS AT ALL, when the whole point of the block system is that seams are
 * expensive: it is tester-sourced. Without it the first screen ends on a hard horizontal
 * rule where the light hero meets the dark section 2, and testers read that as the page
 * having stopped. Every other seam on the V2 branch was joining two runs that no longer
 * exist, so they went; this one is doing a job.
 *
 * ⚠️ IT IS AN ABSOLUTE OVERLAY ON THE HERO, NOT AN IN-FLOW ELEMENT (restored 2026-08-27).
 *
 * It was in-flow for one release, because the V2 seam — a full-width wave — was
 * absolutely positioned over the hero and sliced a hard horizontal line through the
 * robot's torso. Moving it into the flow did stop that, at the cost of the thing the
 * seam is for: an in-flow band cannot be underlapped, so the robot had to be faded out
 * above it, and Mario's read was that he "is cut off at the waist, which doesn't look
 * seamless or natural."
 *
 * BOTH PROBLEMS ARE THE WAVE'S, NOT THE OVERLAY'S. The Book shape below sits LOW at both
 * edges and peaks at centre; the robot stands on the right, where the dark only reaches
 * the very bottom of the frame. There is nothing on the right for it to slice, so it can
 * go back over the hero and let the robot stand behind it.
 *
 * ⚠️ THE CURVE'S HEIGHT VARIES ACROSS ITS WIDTH. When checking whether it clips anything,
 * read the path's y AT THE X YOU CARE ABOUT, not the element's top edge — reading the
 * element under-reports by the full depth of the curve. This is exactly what the robot's
 * height is tuned against; see .hero__robot-img in site.css.
 *
 * preserveAspectRatio="none" lets it stretch to any viewport width, which is why it is
 * viewport-proportional and why two widths prove nothing about it. Check 390 through 1920.
 *
 * TWO VARIANTS, ONE SHAPE. Pass `variant => 'close'` for the second one:
 *
 *   'open'  (default) — the dark rises out of the light below. Sits at the BOTTOM of a
 *                       light section, over it. Used at the hero.
 *   'close'           — the dark comes back down into the light. Sits at the TOP of the
 *                       light section that FOLLOWS the dark run, over it.
 *
 * The close path is the open path mirrored exactly — every y became 120-y — so the dark
 * run is bracketed by one gesture rather than decorated by two shapes (Mario, 2026-08-25:
 * "the same shape divider but... upside down"; re-asked for the V3 dark block 2026-08-27:
 * "so that the dark sections show a completion with the divider").
 *
 * ⚠️ IF ONE PATH IS EVER EDITED, MIRROR THE OTHER IN THE SAME COMMIT. They are the same
 * curve and the whole point is that they read as one; a diff that touches only the top
 * one is invisible until someone scrolls past both.
 *
 * @package SiteStaffr
 */

$seam_variant = isset( $args['variant'] ) && 'close' === $args['variant'] ? 'close' : 'open';

/* THE SHAPE IS A "BOOK" / CURTAIN (Mario, 2026-08-25: "I want like a curtain opening...
   so that the peak is the night mode blue"). The dark sits low along both edges and
   sweeps up to a sharp point at centre, so the page reads as a curtain being drawn up
   rather than as a horizon.

   THE SHAPE LIVES IN THE CONTROL POINTS, not the endpoints. Both cubics hold their
   handles close to the baseline for most of the run (520 and 640 out of 720) and only
   then whip up to the apex. That is what produces the long shallow sweep with a sudden
   spike; move the handles toward the centre and it degrades into a plain hill — which is
   the shallow single-arc variant this replaced, and which Mario asked to be taken off. */
$seam_paths = array(
	'open'  => 'M0,120 L0,104 C520,102 640,98 720,6 C800,98 920,102 1440,104 L1440,120 Z',
	'close' => 'M0,0 L0,16 C520,18 640,22 720,114 C800,22 920,18 1440,16 L1440,0 Z',
);
?>
<div class="seam-curtain seam-curtain--<?php echo esc_attr( $seam_variant ); ?>" aria-hidden="true">
	<svg viewBox="0 0 1440 120" preserveAspectRatio="none" focusable="false" role="presentation">
		<path d="<?php echo esc_attr( $seam_paths[ $seam_variant ] ); ?>" />
	</svg>
</div>
