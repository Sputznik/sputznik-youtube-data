<?php

class SP_WP_VIDEO extends SP_YTUBE_SHORTCODE{

	function __construct(){
		$this->shortcode_str = 'sp_wp_video';
		parent::__construct();
	}

	function getDefaultAtts(){
		return array(
			'video_url'	 		=> '',
			'thumbnail'			=> '',
			'play_btn'			=> ''
		);
	}

	function shortcode( $atts ){
		$atts = $this->getShortcodeAtts( $atts );

		//print_r( $atts );

		ob_start();

		$template = $this->getTemplate( $atts );
		if( file_exists( $template ) ){
			include( $template );
		}

		return ob_get_clean();
	}


	function getTemplate( $atts ){
		return plugin_dir_path(__FILE__)."templates/wp_video.php";
	}

}


SP_WP_VIDEO::getInstance();
