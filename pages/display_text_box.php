<?php defined('ABSPATH') or die("Error"); ?>
<textarea
	rows="8"
	cols="50"
	name="mcsm_options[<?php echo $name; ?>]">
<?php echo esc_html( $options[$name] ); ?>
</textarea>