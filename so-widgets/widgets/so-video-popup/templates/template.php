<?php

$base_shortcode = $instance['video_type'] == 'wordpress' ? "sp_wp_video" : "sp_ytube_video";

$shortcode_str = "[$base_shortcode ";

foreach( $instance as $key => $value ){
  $shortcode_str .= " ".$key."='".$value."'";
}

$shortcode_str .= "]";

//echo $shortcode_str;

echo do_shortcode( $shortcode_str );
