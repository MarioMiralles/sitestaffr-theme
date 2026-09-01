<?php
/**
 * The curtain seam — the only seam in the block system.
 *
 * Without it the first screen ends on a hard horizontal rule where the light hero
 * meets the dark section below, which testers read as the page having stopped.
 *
 * It is an absolute overlay on the hero, not an in-flow element. In-flow it cannot be
 * underlapped, so the robot standing in the hero has to be faded out above it and reads
 * as cut off. The shape sits low at both edges and peaks at centre, so there is nothing
 * on the right for it to slice and the robot can simply stand behind it.
 *
 * ⚠️ The curve's height varies across its width. To check whether it clips something,
 * read the path's y AT THE X YOU CARE ABOUT — the element's top edge under-reports by
 * the full depth of the curve. The robot's height in site.css is tuned against this.
 *
 * preserveAspectRatio="none" lets it stretch to any viewport width, so it is
 * viewport-proportional and two widths prove nothing. Check 390 through 1920.
 *
 * Two variants, one shape:
 *
 * 'open' (default) — the dark rises out of the light. Sits at the BOTTOM of a light
 * section, over it. Used at the hero.
 * 'close' — the dark comes back down into the light. Sits at the TOP of the
 * light section following the dark run, over it.
 *
 * The close path is the open path mirrored exactly (every y became 120-y), so the dark
 * run is bracketed by one gesture rather than decorated by two shapes.
 *
 * ⚠️ If one path is edited, mirror the other in the same commit. They are the same curve
 * and the point is that they read as one; a diff touching only one is invisible until
 * someone scrolls past both.
 *
 * @package SiteStaffr
 */

$seam_variant = isset( $args['variant'] ) && 'close' === $args['variant'] ? 'close' : 'open';

/* The shape is a curtain: the dark sits low along both edges and sweeps up to a sharp
   point at centre, so the page reads as a curtain being drawn up rather than a horizon.

   The shape lives in the CONTROL POINTS, not the endpoints. Both cubics hold their
   handles close to the baseline for most of the run (520 and 640 out of 720) and only
   then whip up to the apex. That is what produces the long shallow sweep with a sudden
   spike; move the handles toward the centre and it degrades into a plain hill. */
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
