<?php

class SP_VIMEO_VIDEO extends SP_YTUBE_SHORTCODE{

	function __construct(){
		$this->shortcode_str = 'sp_vimeo_video';
		parent::__construct();
	}

	function getDefaultAtts(){
		return array(
			'video_id'	=> '',
			'thumbnail'	=> '',
			'play_btn'	=> ''
		);
	}

	function shortcode( $atts ){
		$atts = $this->getShortcodeAtts( $atts );

		if( !isset( $atts[ 'thumbnail' ] ) || ( empty( $atts[ 'thumbnail' ] ) ) ){
			$atts[ 'thumbnail' ] = $this->get_thumbnail( $atts['video_id'] );
		}

		//print_r( $atts );

		ob_start();

		$template = $this->getTemplate( $atts );
		if( file_exists( $template ) ){
			include( $template );
		}

		return ob_get_clean();
	}

	// RETURNS VIMEO VIDEO THUMBNAIL
	function get_thumbnail( $video_id, $resolution = 'thumbnail_large' ){
		$data = file_get_contents("http://vimeo.com/api/v2/video/$video_id.json");
    $data = json_decode($data);
		$thumbnail = $data[0]->$resolution.'.jpg';
		return $thumbnail;
	}


	function getTemplate( $atts ){
		return plugin_dir_path(__FILE__)."templates/vimeo_video.php";
	}

}


SP_VIMEO_VIDEO::getInstance();
