<?php


if( isset( $instance[ 'thumbnail_id' ] ) && !empty( $instance[ 'thumbnail_id' ] ) ){
	$instance[ 'thumbnail' ] = wp_get_attachment_image_src( $instance[ 'thumbnail_id' ], 'full' )[0];
}

if( !isset( $instance['thumbnail'] ) ){
	$instance[ 'thumbnail' ] = $instance[ 'thumbnail_id_fallback' ];
}

$base_shortcode = $instance['video_type'] == 'wordpress' ? "sp_wp_video" : "sp_ytube_video";

$shortcode_str = "[$base_shortcode ";

foreach( $instance as $key => $value ){
  $shortcode_str .= " ".$key."='".$value."'";
}

$shortcode_str .= "]";

//echo $shortcode_str;

echo do_shortcode( $shortcode_str );
