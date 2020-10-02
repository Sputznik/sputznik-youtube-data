<?php

	if( isset( $_POST['list_ids'] ) && is_array( $_POST['list_ids'] ) && count( $_POST['list_ids'] ) ){

		$images_list = array();

		foreach( $_POST['list_ids'] as $list_id ){
			$images_list[ $list_id['id'] ] = $list_id['url'];
		}

		//print_r( $images_list );

		$settings = $this->get_settings();
		$settings['images'] = $images_list;
		$this->write_settings( $settings );



	}

	$settings = $this->get_settings();

	$rows = array();
	if( isset( $settings['images'] ) && is_array( $settings['images'] ) && count( $settings['images'] ) ){
		foreach( $settings['images'] as $id => $url ){
			$temp = array( 'id' => $id, 'url' => $url );
			array_push( $rows, $temp );
		}
	}


	$fields = array(
		'id'	=> array(
			'type'	=> 'text',
			'text'	=> 'Enter Playlist/Video ID',
		),
		'url'	=> array(
			'type'	=> 'text',
			'text'	=> 'Enter URL of the image',
		)
	);


?>

<form method="POST">
  <div data-behaviour="ytube-repeater" data-slug="list_ids" data-rows='<?php echo json_encode( $rows );?>' data-fields='<?php echo json_encode( $fields );?>'></div>
	<p class="help">Add the ID of playlist/video which are meant to be hidden in each new line.</p>
  <p class='submit'><input type="submit" name="submit" class="button button-primary" value="Save Changes"><p>
</form>
<style>
	label{
		display: block;
		margin-bottom: 10px;
	}
	.orbit-choice-item{
		background: #fff;
		margin-bottom: 15px;
		position: relative;
		padding: 10px;
		padding-bottom: 0;
	}
	.orbit-choice-item .list-content{ padding-bottom: 10px; }
</style>
