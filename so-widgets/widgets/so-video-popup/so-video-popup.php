<?php
/*
Widget Name: Sputznik Video Popup
Description: Opens the video in a modal
Author: Samuel Thomas, Sputznik
Author URI: http://www.sputznik.com
Widget URI:
Video URI:
*/
class SP_SOW_VIDEO_POPUP extends SiteOrigin_Widget{

  function __construct(){

    $form_options = array(

			'video_type' => array(
        'type'    => 'select',
        'label'   => __( 'Choose video type', 'siteorigin-widgets' ),
        'options' => array(
					'youtube'		=> 'Youtube',
					'wordpress'	=> 'By URL'
				),
				'state_emitter' => array(
        	'callback' 	=> 'select',
        	'args' 			=> array( 'video_type' )
    		),
      ),
			'video_id' => array(
        'type' 		=> 'text',
        'label' 	=> __( 'Youtube Video ID', 'siteorigin-widgets' ),
				'state_handler' => array(
	        'video_type[youtube]' => array('show'),
	        'video_type[wordpress]' => array('hide'),
	    	),
      ),
			'video_url' => array(
        'type' 		=> 'text',
        'label' 	=> __( 'Video URL', 'siteorigin-widgets' ),
				'state_handler' => array(
	        'video_type[youtube]' 	=> array('hide'),
	        'video_type[wordpress]' => array('show'),
	    	),
      ),
    );

    parent::__construct(
      'so-video-popup',
      __( 'Sputznik Video Popup','siteorigin-widgets' ),
      array(
        'description' =>  __( 'Opens the video in a modal','siteorigin-widgets' ),
        'help'        =>  ''
      ),
      array(),
      $form_options,
      plugin_dir_path(__FILE__).'/widgets/so-video-popup'
    );

  } // construct function ends here

  function get_template_name($instance){
    return 'template';
  }
  function get_template_dir($instance) {
    return 'templates';
  }
  function get_style_name($instance){
  	return '';
  }
}

siteorigin_widget_register( 'so-video-popup', __FILE__, 'SP_SOW_VIDEO_POPUP' );
