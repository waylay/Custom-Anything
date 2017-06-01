<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://webcodesigner.com/
 * @since             1.0.0
 * @package           Custom_Anything
 *
 * @wordpress-plugin
 * Plugin Name:       Custom Anything
 * Plugin URI:        http://webcodesigner.com/category/code/plugins/custom-anything
 * Description:       Create Custom Post Types, Custom Fields, Custom Sidebars.
 * Version:           1.0.0
 * Author:            Cristian Ionel
 * Author URI:        http://webcodesigner.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       custom-anything
 * Domain Path:       /languages
 */

require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';



// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-custom-anything-activator.php
 */
function activate_custom_anything() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-custom-anything-activator.php';
	Custom_Anything_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-custom-anything-deactivator.php
 */
function deactivate_custom_anything() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-custom-anything-deactivator.php';
	Custom_Anything_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_custom_anything' );
register_deactivation_hook( __FILE__, 'deactivate_custom_anything' );



/**
* The settings
*/
require plugin_dir_path( __FILE__ ) . 'includes/class-custom-anything-settings.php';

(new \TypistTech\WPBetterSettings\Plugin)->init();


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-custom-anything.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_custom_anything() {

	$plugin = new Custom_Anything();
	$plugin->run();

}
run_custom_anything();


