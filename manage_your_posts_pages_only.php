<?php
/*
Plugin Name: Manage/View Your Posts/Pages Only
Version: 0.1
Plugin URI: 
Description: Allows contributors to see and manage only their posts/pages and drafts from the manage posts/pages screen. 
Author: Brian Davidson & Cameron Eckelberry
Author URI: https://github.com/cameck/
*/

function mypo_parse_query_useronly( $wp_query ) {
    if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/edit.php' ) !== false ) {
        if ( !current_user_can( 'activate_plugins' ) )  {
			add_action( 'views_edit-post', 'child_remove_some_post_views' );
            global $current_user;
            $wp_query->set( 'author', $current_user->id );
        }
    }
}

add_filter('parse_query', 'mypo_parse_query_useronly' );

/**
 * Remove All, Published and Trashed posts views.
 *
 * Requires WP 3.1+.
 * @param array $views
 * @return array
 */
function child_remove_some_post_views( $views ) {
	unset($views['all']);
	unset($views['publish']);
	unset($views['trash']);
	unset($views['draft']);
	unset($views['pending']);
	return $views;
}

function mypo_parse_query_useronly_page( $wp_query ) {
    if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/edit.php?post_type=page' ) !== false ) {
        if ( !current_user_can( 'activate_plugins' ) )  {
			add_action( 'views_edit-post', 'child_remove_some_page_views' );
            global $current_user;
            $wp_query->set( 'author', $current_user->id );
        }
    }
}

add_filter('parse_query', 'mypo_parse_query_useronly_page' );

/**
 * Remove All, Published and Trashed pages views.
 *
 * Requires WP 3.1+.
 * @param array $views
 * @return array
 */
function child_remove_some_page_views( $views ) {
	unset($views['all']);
	unset($views['publish']);
	unset($views['trash']);
	unset($views['draft']);
	unset($views['pending']);
	return $views;
}
?>
