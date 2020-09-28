<?php

	if( isset( $_POST['list'] ) ){

		$ids = explode( PHP_EOL, $_POST['list'] );

		$settings = $this->get_settings();
		$settings['hide'] = $ids;
		$this->write_settings( $settings );

	}

	$settings = $this->get_settings();

?>

<form method="POST">
  <div>
		<br>
    <textarea class="large-text" rows="10" col="50" name="list"><?php echo implode(PHP_EOL, isset( $settings['hide'] ) ? $settings['hide'] : array() );?></textarea>
  </div>
	<p class="help">Add the ID of playlist/video which are meant to be hidden in each new line.</p>
  <p class='submit'><input type="submit" name="submit" class="button button-primary" value="Save Changes"><p>
</form>
<style>
	textarea.large-text{
		max-width: 900px;
	}
</style>
