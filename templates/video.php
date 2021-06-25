<?php
	$unique_widget_id = 'sp-ytube-'.sp_ytube_unique_widget_id( $atts );
?>
<div id="<?php echo $unique_widget_id; ?>" class="sp-ytube-video" data-behaviour='sp-ytube-video' data-video='<?php echo $atts['video_id']; ?>'>
	<div class="sp-ytube-video-image" style="background-image: url(<?php _e( $atts['thumbnail'] );?>);">
	</div>
</div>

<?php if( !empty( $atts['play_btn'] ) ): ?>
<style>
	<?php echo '#'.$unique_widget_id; ?>.sp-ytube-video .sp-ytube-video-image::after{
		background-image: url(<?php _e( $atts['play_btn'] );?>);
	}
</style>
<?php endif;?>
