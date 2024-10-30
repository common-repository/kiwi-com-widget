<?php

/**
 * @package   Kiwicom_Widget
 * @author    Kiwi.com
 * @link      https://www.kiwi.com/
 *
 * @wordpress-plugin
 * Plugin Name:       Kiwi.com Widget
 * Description:       Displays Kiwi.com cheap flights.
 * Version:           1.1.1
 * Author:            Kiwi.com
 * Author URI:        https://www.kiwi.com/
 * Text Domain:       kiwicom-widget
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 */


// Prevent direct file access.
if (!defined('ABSPATH')) {
	exit;
}

// Make sure the plugin does not expose any info if called directly.
if (!function_exists('add_action')) {
	if (!headers_sent()) {
		if (function_exists('http_response_code')) {
			http_response_code(403);
		} else {
			header('HTTP/1.1 403 Forbidden', true, 403);
		}
	}
	exit('The Kiwi.com Widget plugin requires functions included with WordPress.');
}

// Plugin requires a minimum PHP version to run.
const REQUIRED_PHP_VERSION = '5.4.0';
if (version_compare(PHP_VERSION, REQUIRED_PHP_VERSION, '<')) {
	exit('The Kiwi.com Widget plugin requires at least PHP version ' . REQUIRED_PHP_VERSION . ' to run. Please contact your web hosting service.');
}

require_once __DIR__ . '/includes/widget-settings.class.php';
// require_once __DIR__ . '/includes/widget-options.class.php';
require_once __DIR__ . '/includes/widget.class.php';

/**
 * Identify plugin as a relative path.
 * @return string
 */
function kiwicom_widget_plugin_self()
{
	static $handle;
	isset($handle) || $handle = plugin_basename(__FILE__);

	return $handle;
}

// Register the widget
add_action('widgets_init', create_function('', 'register_widget("Kiwicom_Widget");'));

// Create the other objects to register their hooks.
new Kiwicom_Widget_Settings();

/**
 * Block Initializer.
 */
require_once plugin_dir_path(__FILE__) . 'src/init.php';
