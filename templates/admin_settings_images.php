<?php

	if( isset( $_POST['list'] ) ){

		$ids = explode( PHP_EOL, $_POST['list'] );

		/*
		echo "<pre>";
		print_r( $ids );
		echo "</pre>";
		*/

		$images_list = array();
		foreach( $ids as $id ){
			$image_item = explode( '#', $id );

			if( count( $image_item ) > 1 ){
				$images_list[ $image_item[0] ] = $image_item[1];
			}

		}

		/*
		echo "<pre>";
		print_r( $images_list );
		echo "</pre>";
		*/

		$settings = $this->get_settings();
		$settings['images'] = $images_list;
		$this->write_settings( $settings );

		//print_r( $settings );

	}

	$settings = $this->get_settings();

	$image_list = isset( $settings['images'] ) ? $settings['images'] : array();
	$text = "";
	if( is_array( $image_list ) && count( $image_list ) ){
		foreach ($image_list as $key => $value) {
			$text .= $key . "#" . $value . PHP_EOL;
		}
	}


	//print_r( $image_list );

?>

<form method="POST">
  <div>
		<br>
    <textarea class="large-text" rows="10" col="50" name="list"><?php echo $text;?></textarea>
  </div>
	<p class="help">Add the ID of playlist/video which are meant to be hidden in each new line.</p>
  <p class='submit'><input type="submit" name="submit" class="button button-primary" value="Save Changes"><p>
</form>
<style>
	textarea.large-text{
		max-width: 900px;
	}
</style>
