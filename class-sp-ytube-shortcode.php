<?php

	class SP_YTUBE_SHORTCODE extends SP_YTUBE_BASE{

		var $shortcode_str;

		function __construct(){

			add_shortcode( $this->shortcode_str, array( $this, 'shortcode' ) );

		}

		function getDefaultAtts(){
			return array();
		}

		function getShortcodeAtts( $atts ){
			return shortcode_atts( $this->getDefaultAtts(), $atts, $this->shortcode_str );
		}

		function shortcode( $atts ){
			$atts = $this->getShortcodeAtts( $atts );

			ob_start();

			do_action( $this->shortcode_str . "_prehook", $atts );

			$url = $this->getAPIURL( $atts );

			//echo $url;

			if( $url ){
				$response = $this->getAPIResponse( $url );
				$template = $this->getTemplate( $atts );
				if( file_exists( $template ) ){
					include( $template );
				}
			}

			return ob_get_clean();
		}

		function getAPIURL( $atts ){
			return "";
		}

		function getTemplate( $atts ){
			return "";
		}

		function getBaseURL(){ return 'https://www.googleapis.com/youtube/v3/'; }

		function getAPIKey(){
			$admin_settings = $this->get_admin_settings();
			return isset( $admin_settings['api_key'] ) ? $admin_settings['api_key'] : '';
		}

		function constructUrl( $baseURL, $args ){
			$url = $baseURL . "?";
			foreach( $args as $key => $val ){
				if( is_array( $val ) ){
					foreach( $val as $val_item ){
						$url .= $key."=".$val_item."&";
					}
				}
				else{
					$url .= $key."=".$val."&";
				}

			}
			return $url;
		}



		function getAPIResponse( $url, $api_key = false, $cache_expiration = 60000 ){
			$cache_key = md5( $url );

			$data = array();
			if ( ! ( $data = get_transient( $cache_key ) ) ) {
				$args = array( 'headers' => array() );
				if( $api_key ){
					$args['headers'] = array(
						'Authorization' => 'Token ' . $api_key,
					);
				}

				$request = wp_remote_get( $url, $args );
				if( ! is_wp_error( $request ) ) {
					$body = wp_remote_retrieve_body( $request );
					$data = json_decode( $body );
					set_transient( $cache_key, $data,  $cache_expiration );    // IF IT IS NEW, SET THE TRANSIENT FOR NEXT TIME
				}
				else{
					print_r($request);																// DISPLAYING THE ERROR
				}
			}
			return $data;
		}

		function image( $image ){
			return "<img src='" . $image->url . "' width='" . $image->width . "' height='" . $image->height . "' />";
		}

		function video_title( $video ){
			return $video->snippet->title;
		}

		function alternate_image( $id ){
			$admin_settings = $this->get_admin_settings();
			$images = isset( $admin_settings['images'] ) ? $admin_settings['images'] : array();
			if( isset( $images[ $id] ) ){
				return "<img src='" . $images[ $id ] . "' />";
			}
			return '';

		}

		function video_image( $video ){
			if( $this->has_video_image( $video ) ) return $this->image( $video->snippet->thumbnails->medium );
			return '';
		}

		function has_video_image( $video ){
			if( isset( $video->snippet ) && isset( $video->snippet->thumbnails ) && isset( $video->snippet->thumbnails->medium ) ) return true;
			return false;
		}

		function video_id( $item ){

			if( isset( $item->snippet->resourceId ) && isset( $item->snippet->resourceId->videoId ) ){
				return $item->snippet->resourceId->videoId;
			}

			if( isset( $item->id ) && isset( $item->id->videoId ) ){
				return $item->id->videoId;
			}

		}

		function get_admin_settings(){
			$admin = SP_YTUBE_ADMIN::getInstance();
			return $admin->get_settings();
		}

		function is_valid_item( $id ){
			$admin_settings = $this->get_admin_settings();
			$hide_items = isset( $admin_settings['hide'] ) ? $admin_settings['hide'] : array();
			$hide_items = str_replace( '\r', '', $hide_items );
			if( in_array( $id, $hide_items ) ) {
				return false;
			}
			return true;
		}

	}
