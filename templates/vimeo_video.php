<?php
	$unique_widget_id = 'sp-vimeo-'.sp_ytube_unique_widget_id( $atts );
?>

<div id="<?php echo $unique_widget_id; ?>" class="sp-vimeo-video" data-behaviour='sp-vimeo-video' data-video='<?php echo $atts['video_id']; ?>'>
	<div class="sp-vimeo-video-image" style="background-image: url(<?php _e( $atts['thumbnail'] );?>);">
	</div>
</div>

<?php if( !empty( $atts['play_btn'] ) ): ?>
<style>
	<?php echo '#'.$unique_widget_id; ?>.sp-vimeo-video .sp-vimeo-video-image::after{
		background-image: url(<?php _e( $atts['play_btn'] );?>);
	}
</style>
<?php endif;?>
