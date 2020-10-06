<?php

class SP_YTUBE_VIDEO extends SP_YTUBE_SHORTCODE{

	function __construct(){
		$this->shortcode_str = 'sp_ytube_video';
		parent::__construct();
	}

	function getDefaultAtts(){
		return array(
			'video_id'	 		=> '',
		);
	}

	function shortcode( $atts ){
		$atts = $this->getShortcodeAtts( $atts );

		ob_start();

		$template = $this->getTemplate( $atts );
		if( file_exists( $template ) ){
			include( $template );
		}

		return ob_get_clean();
	}

	// RETURNS YOUTUBE VIDEO THUMB UI
	function get_thumbnail( $video_id, $resolution = 'sddefault' ){
		$thumbnail = "http://img.youtube.com/vi/$video_id/$resolution.jpg";
		return $thumbnail;
	}

	function getTemplate( $atts ){
		return plugin_dir_path(__FILE__)."templates/video.php";
	}

}


SP_YTUBE_VIDEO::getInstance();
