<?php defined('ABSPATH') or die("Error"); ?>

<div id="mcsm_general" class="wrap">
	<h2>MailChimp Popup Box Configuration</h2>

	<form method="post" action="options.php">
		<?php settings_fields( 'mcsm_settings' ); ?>
		<?php do_settings_sections( 'mcsm_settings_section' ); ?>
		<input type="submit" value="Submit" class="button-primary">
	</form>
</div>