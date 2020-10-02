<?php
	$admin_settings = $this->get_admin_settings();
	$hide_items = isset( $admin_settings['hide'] ) ? $admin_settings['hide'] : array();
?>
<script>
	var hide = <?php echo json_encode( $hide_items );?>;
</script>
<div class="sp-ytube-playlists-row">
	<?php if( isset( $response->items ) ): ?>
	<div class="sp-ytube-playlists sp-three-grid">
	<?php foreach( $response->items as $item ):if( $this->is_valid_item( $item->id ) ):?>
		<div class="sp-ytube-playlist sp-grid-item" data-url='<?php echo admin_url( 'admin-ajax.php' );?>' data-behaviour='sp-ytube-playlist' data-title="<?php echo $this->video_title( $item );?>" data-channel="<?php echo $item->snippet->channelId;?>" data-playlist="<?php echo $item->id;?>">
			<div class="sp-ytube-video-image">
			<?php
				$image = $this->alternate_image( $item->id );
				if( $image ){ echo $image; }
				else{
					echo $this->video_image( $item );
				}
			?>
			</div>
			<div class="sp-ytube-video-title"><?php echo $this->video_title( $item );?></div>
			<div class="sp-ytube-video-count">(<?php echo $item->contentDetails->itemCount;?>) Videos</div>
		</div>
	<?php endif;endforeach;?>
	</div>
	<?php else:?>
		<pre>
			<?php print_r( $response );?>
		</pre>
	<?php endif;?>
</div>
