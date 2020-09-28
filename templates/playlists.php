<div class="sp-ytube-playlists sp-three-grid">
<?php foreach( $response->items as $item ):if( $this->is_valid_item( $item->id ) ):?>
	<div class="sp-ytube-playlist sp-grid-item" data-behaviour='sp-ytube-playlist' data-title="<?php echo $this->video_title( $item );?>" data-channel="<?php echo $item->snippet->channelId;?>" data-playlist="<?php echo $item->id;?>">
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
