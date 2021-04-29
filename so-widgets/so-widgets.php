<?php

  add_filter( 'siteorigin_widgets_widget_folders', function( $folders ){
    $folders[] = plugin_dir_path( __FILE__ ).'widgets/';
    return $folders;
  } );

  
