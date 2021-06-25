<?php
	$unique_widget_id = 'sp-wp-'.sp_ytube_unique_widget_id( $atts );
?>
<div id="<?php echo $unique_widget_id; ?>" class="sp-wp-video" data-behaviour='sp-wp-video' data-video='<?php echo $atts['video_url']; ?>'>
	<video poster='<?php echo $atts['thumbnail'];?>'>
		<source src='<?php echo $atts['video_url'];?>' type='video/mp4'>
	</video>
</div>

<?php if( !empty( $atts['play_btn'] ) ): ?>
<style>
	<?php echo '#'.$unique_widget_id; ?>.sp-wp-video::after{
		background-image: url(<?php _e( $atts['play_btn'] );?>);
	}
</style>
<?php endif;?>
