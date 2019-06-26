<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://codeable.io/developers/bishal
 * @since      1.0.0
 *
 * @package    Social_Share
 * @subpackage Social_Share/admin/partials
 */

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<form action='options.php' method='post'>

<h2>Social Share</h2>

	<?php
		settings_fields( 'social-share' );
		do_settings_sections( 'social-share' );
		submit_button();
	?>

</form>
