<?php

class SP_YTUBE_PLAYLISTS extends SP_YTUBE_SHORTCODE{

	function __construct(){
		$this->shortcode_str = 'sp_ytube_playlists';

		add_action( $this->shortcode_str . "_prehook", function( $atts ){

			if( isset( $_GET['playlistId'] ) && isset( $_GET['channelId'] ) && $_GET['channelId'] == $atts['channel'] ){
				echo "<div class='sp-inner-section arrow_box'>";
				echo "<button class='sp-close-btn'>&times;</button>";
				if( isset( $_GET['title'] ) && $_GET['title'] ){
					echo "<div class='sp-playlist-title'>" . $_GET['title'] . "</div>";
				}
				echo do_shortcode( "[sp_ytube_videos playlist='" . $_GET['playlistId'] . "']" );
				echo "</div>";
			}


		} );

		parent::__construct();
	}

	function getDefaultAtts(){
		return array(
			'channel'	 		=> '',
			'maxResults' 	=> 10
		);
	}

	function getAPIURL( $atts ){
		$baseURL = $this->getBaseURL() . "playlists";
		$args = array(
			'part'	=> array( 'contentDetails', 'snippet', 'id' ),
			'maxResults' => isset( $atts['maxResults'] )? $atts['maxResults'] : 10,
			'key'	=> $this->getAPIKey(),
			'channelId'	=> $atts['channel']
		);
		return $this->constructUrl( $baseURL, $args );
	}

	function getTemplate( $atts ){
		return plugin_dir_path(__FILE__)."templates/playlists.php";
	}

}

SP_YTUBE_PLAYLISTS::getInstance();
