<?php
/**
 * Defines a utility class for useful functions.
 *
 * @package wp-edit-homepage
 */

namespace WP_Edit_Homepage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * A utility class for useful functions.
 */
class Utils {
	/**
	 * Generates an admin-relative link to an edit post screen.
	 *
	 * @link: https://developer.wordpress.org/reference/functions/get_edit_post_link/
	 *
	 * @param int $id The post ID.
	 * @return string An admin relative post edit link.
	 */
	public static function get_admin_relative_edit_post_link( $id = 0 ) {
		$post = get_post( $id );
		if ( ! $post ) {
			return;
		}

		if ( 'revision' === $post->post_type ) {
			$action = '';
		} else {
			$action = '&amp;action=edit';
		}

		$post_type_object = get_post_type_object( $post->post_type );
		if ( ! $post_type_object ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post->ID ) ) {
			return;
		}

		if ( $post_type_object->_edit_link ) {
			$link = sprintf( $post_type_object->_edit_link . $action, $post->ID );
		} else {
			$link = '';
		}

		return $link;
	}

}
