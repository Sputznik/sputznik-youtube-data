<?php

class SP_YTUBE_PLAYLISTS extends SP_YTUBE_SHORTCODE{

	function __construct(){
		$this->shortcode_str = 'sp_ytube_playlists';

		add_action( 'wp_ajax_nopriv_sp_ytube_playlist', array( $this, 'ajaxPlaylist' ) );
		add_action( 'wp_ajax_sp_ytube_playlist', array( $this, 'ajaxPlaylist' ) );

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

	function ajaxPlaylist(){
		if( isset( $_GET['playlist'] ) ){
			echo do_shortcode( "[sp_ytube_videos playlist='" . $_GET['playlist'] . "']" );
		}
		wp_die();
	}

	function getDefaultAtts(){
		return array(
			'channel'	 		=> '',
			'maxresults' 	=> 10
		);
	}

	function getAPIURL( $atts ){
		$baseURL = $this->getBaseURL() . "playlists";
		$args = array(
			'part'	=> array( 'contentDetails', 'snippet', 'id' ),
			'maxResults' => isset( $atts['maxresults'] )? $atts['maxresults'] : 10,
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
