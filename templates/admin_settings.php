<?php

$screens = array(
	'api' => array(
		'label' => 'Google API Key',
		'tab' => plugin_dir_path(__FILE__) . 'admin_settings_api.php',
	),
	'hide' => array(
		'label' => 'Hide Playlists/Videos',
		'tab' => plugin_dir_path(__FILE__) . 'admin_settings_hide.php',
		'action' => 'hide',
	),
	'images' => array(
		'label' => 'Images of Playlists/Videos',
		'tab' => plugin_dir_path(__FILE__) . 'admin_settings_images.php',
		'action' => 'images',
	),

);

$screens = apply_filters('sp_ytube_admin_settings_screens', $screens);


?>
<div class="wrap">
	<h1>Sputznik Youtube Settings</h1>
	<?php $this->tabs( $screens );?>
</div>
