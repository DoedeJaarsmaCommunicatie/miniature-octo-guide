<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://doedejaarsma.nl
 * @since             1.0.0
 * @package           Cb5_elements
 *
 * @wordpress-plugin
 * Plugin Name:       CB5 Elementor Widgets
 * Plugin URI:        croonenburo5.nl
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Doede Jaarsma communicatie
 * Author URI:        https://doedejaarsma.nl
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cb5_elements
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'cb5_elements_version', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cb5_elements-activator.php
 */
function activate_cb5_elements() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cb5_elements-activator.php';
	Cb5_elements_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cb5_elements-deactivator.php
 */
function deactivate_cb5_elements() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cb5_elements-deactivator.php';
	Cb5_elements_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cb5_elements' );
register_deactivation_hook( __FILE__, 'deactivate_cb5_elements' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cb5_elements.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cb5_elements() {

	$plugin = new Cb5_elements();
	$plugin->run();

}
run_cb5_elements();
