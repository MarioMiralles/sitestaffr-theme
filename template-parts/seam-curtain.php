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
 * ⚠️ IT IS AN IN-FLOW ELEMENT, NOT AN OVERLAY, and that is deliberate. The V2 seam was
 * absolutely positioned over the hero, which is how it ended up cropping the robot
 * mid-hand: the robot is itself absolutely positioned and 150% of the hero's height, so
 * anything laid over the hero's bottom edge cuts through it. Sitting in the flow between
 * the two sections, this cannot touch the robot at any width.
 *
 * ⚠️ THE CURVE'S HEIGHT VARIES ACROSS ITS WIDTH. When checking whether it clips anything,
 * read the path's y AT THE X YOU CARE ABOUT, not the element's top edge — reading the
 * element under-reports by the full depth of the curve.
 *
 * preserveAspectRatio="none" lets it stretch to any viewport width, which is why it is
 * viewport-proportional and why two widths prove nothing about it. Check 390 through 1920.
 *
 * @package SiteStaffr
 */

?>
<div class="seam-curtain" aria-hidden="true">
	<svg viewBox="0 0 1440 120" preserveAspectRatio="none" focusable="false" role="presentation">
		<?php /* One shallow arc, deepest in the middle and meeting the baseline at both
		         edges. Shallow on purpose: the V2 silhouette was described as "lumpy"
		         because it had multiple inflections, and a curve with more than one bend
		         reads as a shape rather than as a transition. */ ?>
		<path d="M0,120 C 420,28 1020,28 1440,120 Z" />
	</svg>
</div>
