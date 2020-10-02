<?php

	if( isset( $_POST['list_ids'] ) && is_array( $_POST['list_ids'] ) && count( $_POST['list_ids'] ) ){
		$ids = array();

		foreach( $_POST['list_ids'] as $list_id ){
			array_push( $ids, $list_id['id'] );
		}

		$settings = $this->get_settings();
		$settings['hide'] = $ids;
		$this->write_settings( $settings );

	}

	$settings = $this->get_settings();

	$fields = array(
		'id'	=> array(
			'type'	=> 'text',
			'text'	=> 'Enter Playlist/Video ID',
		)
	);

	$rows = array();

	if( isset( $settings['hide'] ) && is_array( $settings['hide'] ) && count( $settings['hide'] ) ){
		foreach( $settings['hide'] as $id ){
			$temp = array( 'id' => $id );
			array_push( $rows, $temp );
		}
	}

?>



<form method="POST">
  <div data-behaviour="ytube-repeater" data-slug="list_ids" data-rows='<?php echo json_encode( $rows );?>' data-fields='<?php echo json_encode( $fields );?>'></div>
	<p class="help">Add the ID of playlist/video which are meant to be hidden in each new line.</p>
  <p class='submit'><input type="submit" name="submit" class="button button-primary" value="Save Changes"><p>
</form>
<style>
	textarea.large-text{
		max-width: 900px;
	}
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
