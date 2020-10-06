<?php
	/*
    Plugin Name: Sputznik Youtube Data
    Plugin URI: http://sputznik.com
    Description: Pull videos by channel or playlist id
    Author: Samuel Thomas, Sputznik
    Version: 1.0
    Author URI: http://sputznik.com
    */

	define( 'SP_YTUBE_VERSION', time() ); //1.4.7

	$inc_files = array(
		"class-sp-ytube-base.php",
		"class-sp-ytube-admin.php",
		"class-sp-ytube-shortcode.php",
		"class-sp-ytube-videos.php",
		"class-sp-ytube-video.php",
		"class-sp-ytube-playlists.php"
	);

	foreach( $inc_files as $inc_file ){
		require_once( $inc_file );
	}

	add_action( 'wp_enqueue_scripts', function(){
		wp_enqueue_script( 'sp-ytube-video', plugins_url( 'sputznik-youtube-data/assets/js/youtube-video-modal.js' ), array('jquery'), SP_YTUBE_VERSION, true );
		wp_enqueue_style( 'sp-ytube', plugins_url( 'sputznik-youtube-data/assets/css/main.css' ), array(), SP_YTUBE_VERSION );
	} );
