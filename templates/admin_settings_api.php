<?php

	if( isset( $_POST['api_key'] ) ){
		$settings = $this->get_settings();
		$settings['api_key'] = $_POST['api_key'];
		$this->write_settings( $settings );
	}

	$settings = $this->get_settings();

?>
<form method="POST">
  <div>
    <p><label>API KEY</label></p>
		<input type="text" name="api_key" value="<?php echo isset( $settings['api_key'] ) ? $settings['api_key'] : ""; ?>" />
  </div>
  <p class='submit'><input type="submit" name="submit" class="button button-primary" value="Save Changes"><p>
</form>
