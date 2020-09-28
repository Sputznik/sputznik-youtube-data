<div class="sp-playlist-title"><?php echo $playlistResponse->items[0]->snippet->title;?></div>
<div class="sp-ytube-playlist sp-three-grid">
<?php foreach( $response->items as $item ):?>
	<?php if( $this->has_video_image( $item ) ):?>
	<div class="sp-ytube-playlist-item sp-grid-item" data-behaviour='sp-ytube-video' data-video='<?php echo $item->contentDetails->videoId ?>'>
		<div class="sp-ytube-video-image"><?php echo $this->video_image( $item );?></div>
		<!--div class="sp-ytube-video-title"><?php echo $this->video_title( $item );?></div-->
	</div>
	<?php endif;?>
<?php endforeach;?>
</div>
