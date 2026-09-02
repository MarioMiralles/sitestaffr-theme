<?php

$seam_variant = isset( $args['variant'] ) && 'close' === $args['variant'] ? 'close' : 'open';

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
