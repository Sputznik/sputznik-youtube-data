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
			'thumbnail_id' => array(
				'type' 			=> 'media',
				'label' 		=> __( 'Choose Thumbnail', 'siteorigin-widgets' ),
				'choose' 		=> __( 'Choose image', 'siteorigin-widgets' ),
				'update' 		=> __( 'Set image', 'siteorigin-widgets' ),
				'library' 	=> 'image',
				'fallback' 	=> true
			),
      'play_btn_img' => array(
				'type' 			=> 'media',
				'label' 		=> __( 'Choose Play Button', 'siteorigin-widgets' ),
				'choose' 		=> __( 'Choose image', 'siteorigin-widgets' ),
				'update' 		=> __( 'Set image', 'siteorigin-widgets' ),
				'library' 	=> 'image',
				'fallback' 	=> false,
        'description' => 'If no image is selected the default play button image will be used.',
			),
			'video_type' => array(
        'type'    => 'select',
        'label'   => __( 'Choose video type', 'siteorigin-widgets' ),
        'options' => array(
					'youtube'		=> 'Youtube',
					'wordpress'	=> 'Self Hosted',
          'vimeo'     =>  'Vimeo'
				),
				'state_emitter' => array(
        	'callback' 	=> 'select',
        	'args' 			=> array( 'video_type' )
    		),
      ),
			'video_id' => array(
        'type' 		=> 'text',
        'label' 	=> __( 'Video ID', 'siteorigin-widgets' ),
				'state_handler' => array(
	        'video_type[youtube]' => array('show'),
	        'video_type[wordpress]' => array('hide'),
          'video_type[vimeo]' => array('show')
	    	),
      ),
			'video_url' => array(
        'type' 		=> 'link',
        'label' 	=> __( 'Video URL', 'siteorigin-widgets' ),
				'state_handler' => array(
	        'video_type[youtube]' 	=> array('hide'),
	        'video_type[wordpress]' => array('show'),
          'video_type[vimeo]' 	=> array('hide')
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
