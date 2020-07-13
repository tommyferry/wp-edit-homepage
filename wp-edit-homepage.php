<?php
/**
 * WP Edit Homepage
 *
 * @package wp-edit-homepage
 *
 * @wordpress-plugin
 * Plugin Name: WP Edit Homepage
 * Description: A simple WordPress plugin that adds a homepage edit link to the admin sidebar
 * Version: 1.0
 * Author: Tommy Ferry
 * License:
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: wp-edit-homepage
 *
 * WP Edit Homepage is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * WP Edit Homepage is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with WP Edit Homepage. If not, see {URI to Plugin License}.
 */

namespace WP_Edit_Homepage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

require_once 'includes/class-utils.php';
require_once 'includes/class-wp-edit-homepage-plugin.php';

/**
 * Load the plugin.
 *
 * @return void
 */
function load_plugin() {
	$plugin = new WP_Edit_Homepage_Plugin();
	$plugin->load();
}
add_action( 'plugins_loaded', __NAMESPACE__ . '\load_plugin' );
