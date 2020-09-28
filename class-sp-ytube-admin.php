<?php

	class SP_YTUBE_ADMIN extends SP_YTUBE_BASE{

		var $settings;

		function __construct(){

			$this->read_settings();

			add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		}

		function admin_menu() {
    	add_options_page(
        __( 'Settings', 'textdomain' ),
        __( 'Sputznik Youtube Settings', 'textdomain' ),
        'manage_options',
        'options.php',
        array( $this, 'settings_page' )
    	);
		}

		function get_settings(){ return $this->settings; }
		function set_settings( $settings ){ $this->settings = $settings; }

		function read_settings(){
			$value = get_option( 'sp_ytube_settings' );
			if( !$value || !is_array( $value ) ) return array();
			$this->set_settings( $value );
		}

		function write_settings( $settings ){
			update_option( 'sp_ytube_settings', $settings );
			$this->set_settings( $settings );
		}

		function settings_page(){
			include( "templates/admin_settings.php" );
		}

		function tabs( $screens, $base_url = 'options-general.php?page=options.php', $disable_tab = false ){

			$common_url = admin_url( $base_url );

			$active_tab = '';

			_e('<h2 class="nav-tab-wrapper">');

			foreach ( $screens as $slug => $screen ) {
				$url = $common_url;
				if (isset($screen['action'])) {
					$url = esc_url( add_query_arg( array('action' => $screen['action']), $common_url ) );
				}

				$nav_class = "nav-tab";

				if ( isset( $screen['action'] ) && isset( $_GET['action'] ) && $screen['action'] == $_GET['action'] ) {
					$nav_class .= " nav-tab-active";
					$active_tab = $slug;
				}

				if ( !isset( $screen['action'] ) && !isset( $_GET['action'] ) ) {
					$nav_class .= " nav-tab-active";
					$active_tab = $slug;
				}

				echo "<a";
				if( !$disable_tab){ echo " href='$url'"; }
				echo " class='$nav_class'>" . $screen['label'] . "</a>";

			}

			_e('</h2>');

			if (file_exists($screens[$active_tab]['tab'])) {
				include $screens[$active_tab]['tab'];
			}

		}

	}

	SP_YTUBE_ADMIN::getInstance();
