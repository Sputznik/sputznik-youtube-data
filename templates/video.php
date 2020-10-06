<?php
	$thumbnail = $this->get_thumbnail( $atts['video_id'] );
?>
<div class="sp-ytube-video" data-behaviour='sp-ytube-video' data-video='<?php echo $atts['video_id']; ?>'>
	<div class="sp-ytube-video-image" style="background-image: url(<?php _e( $thumbnail );?>);">
	</div>
</div>
