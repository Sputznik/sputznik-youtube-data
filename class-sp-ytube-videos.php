<?php

class SP_YTUBE_VIDEOS extends SP_YTUBE_SHORTCODE{

	function __construct(){
		$this->shortcode_str = 'sp_ytube_videos';
		parent::__construct();
	}

	function getDefaultAtts(){
		return array(
			'channel'	 		=> '',
			'playlist'	 	=> '',
			'maxresults' 	=> 10
		);
	}

	function getAPIURL( $atts ){
		if( isset( $atts['playlist'] ) && $atts['playlist'] ){
			return $this->getVideosFromPlaylistURL( $atts );
		}
		return $this->getVideosFromChannelURL( $atts );
	}

	function getVideosFromPlaylistURL( $atts ){
		$baseURL = $this->getBaseURL() . "playlistItems";
		$args = array(
			'part'	=> array( 'contentDetails', 'snippet', 'id' ),
			'playlistId'	=> $atts['playlist'],
			'key'	=> $this->getAPIKey(),
			'maxResults' => isset( $atts['maxresults'] )? $atts['maxresults'] : 10,
		);
		return $this->constructUrl( $baseURL, $args );
	}

	function getVideosFromChannelURL( $atts ){
		$baseURL = $this->getBaseURL() . "search";
		$args = array(
			'type'				=> 'video',
			'part'				=> array( 'id', 'snippet' ),
			'maxResults' 	=> isset( $atts['maxresults'] )? $atts['maxresults'] : 10,
			'key'					=> $this->getAPIKey(),
			'channelId'		=> $atts['channel'],
			'order'				=> 'date'
		);
		return $this->constructUrl( $baseURL, $args );
	}

	function getTemplate( $atts ){
		return plugin_dir_path(__FILE__)."templates/videos.php";
	}



}

SP_YTUBE_VIDEOS::getInstance();
