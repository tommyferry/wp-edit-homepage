<?php
/**
 * Defines a class that sets up the plugin.
 *
 * @package wp-edit-homepage
 */

namespace WP_Edit_Homepage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'WP_Edit_Homepage_Plugin' ) ) {
	/**
	 * The main plugin class.
	 */
	class WP_Edit_Homepage_Plugin {

		/**
		 * Runs all code needed when the plugin is loaded.
		 *
		 * @return void
		 */
		public function load() {
			// Add custom filter to global WP admin submenu.
			add_action( 'admin_head', array( $this, 'add_global_wp_admin_submenu_filter' ), 15 );

			// Add the homepage edit link.
			add_filter( 'wpedh_filter_global_wp_admin_submenu', array( $this, 'add_homepage_edit_link' ) );
		}

		/**
		 * Filters the global $submenu to add a homepage edit link to the WP admin bar.
		 *
		 * NOTE: Adding a filter to a WP global isn't ideal. However, as there's
		 * no easy way to add custom links to the (sub)menu then this approach
		 * will do for now. Some enhancements to the menu API have been suggested
		 * on trac (see links below), so could be good options in the future.
		 *
		 * @link: https://core.trac.wordpress.org/ticket/12718
		 * @link: https://core.trac.wordpress.org/ticket/39050
		 *
		 * @return void
		 */
		public function add_global_wp_admin_submenu_filter() {
			global $submenu;

			// phpcs:ignore -- WordPress.WP.GlobalVariablesOverride.Prohibited
			$submenu = apply_filters( 'wpedh_filter_global_wp_admin_submenu', $submenu );
		}

		/**
		 * Filters the global $submenu to add a homepage edit link to the WP admin bar.
		 *
		 * @param array $submenu An array of WP admin menu items.
		 */
		public function add_homepage_edit_link( $submenu ) {

			// Bail early - no 'static' homepage.
			if ( get_option( 'show_on_front' ) !== 'page' ) {
				return $submenu;
			}

			$homepage_id = get_option( 'page_on_front', 0 );

			// Bail early - homepage not set.
			if ( empty( $homepage_id ) ) {
				return $submenu;
			}

			// Get admin relative page edit URL.
			$homepage_edit_link = Utils::get_admin_relative_edit_post_link( $homepage_id );

			// Bail early - no edit link found.
			if ( empty( $homepage_edit_link ) ) {
				return $submenu;
			}

			// Create edit link array.
			$edit_homepage_menu_array = array(
				__( 'Edit Homepage', 'wp-edit-homepage' ),
				'edit_pages',
				$homepage_edit_link,
			);

			// Add edit link.
			$submenu['edit.php?post_type=page'][] = $edit_homepage_menu_array;

			return $submenu;
		}
	}
}
