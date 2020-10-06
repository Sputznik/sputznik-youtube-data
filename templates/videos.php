<?php if( isset( $response->items ) ):?>
<div class="sp-ytube-playlist sp-three-grid">
<?php foreach( $response->items as $item ):?>
	<?php if( $this->has_video_image( $item ) ):?>
	<div class="sp-ytube-playlist-item sp-grid-item">
		<?php echo do_shortcode('[sp_ytube_video video_id="'.$this->video_id( $item ).'"]');?>
	</div>
	<?php endif;?>
<?php endforeach;?>
</div>
<?php endif; ?>
