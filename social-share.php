<?php
/**
 * Plugin Main file
 *
 * @link              https://codeable.io/developers/bishal
 * @since             1.0.0
 * @package           Social_Share
 *
 * @wordpress-plugin
 * Plugin Name:       Social Share
 * Plugin URI:        https://codeable.io/developers/bishal
 * Description:      Adds simple yet attractive responsive social sharing buttons of Facebook, Twitter, Linkedin, Pinterest, WhatsApp( Mobile Devices only ) and Google+ to wordpress posts, pages, media or other registered custom post types.
 * Version:           1.0.0
 * Author:            Bishal Basnet
 * Author URI:        https://codeable.io/developers/bishal
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       social-share
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-social-share-activator.php
 */
function activate_social_share() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-social-share-activator.php';
	Social_Share_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-social-share-deactivator.php
 */
function deactivate_social_share() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-social-share-deactivator.php';
	Social_Share_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_social_share' );
register_deactivation_hook( __FILE__, 'deactivate_social_share' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-social-share.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_social_share() {

	$plugin = new Social_Share();
	$plugin->run();

}
run_social_share();
