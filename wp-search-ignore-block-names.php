<?php
/**
 * Plugin Name: Ignore block name in search
 * Description: Modifies the native search to ignore block editor comments
 * Version: 1.1.0
 * Author: Torsten Landsiedel
 * License: GPL2
 */

/*
Based on "Search Ignore HTML Tags" by Pramod Sivadas
https://wordpress.org/plugins/wp-search-ignore-html-tags/
Thank you!
*/

/**
 * Modify search query to ignore the search term in HTML markup.
 *
 * @param string   $where The WHERE clause of the query.
 * @param WP_Query $query The WP_Query instance (passed by reference).
 *
 * @return string The modified WHERE clause.
 */
function wp_search_ignore_block_names_update_search_query( $where, $query ) {
	if ( ! is_search() || ! $query->is_main_query() ) {
		return $where;
	}

	global $wpdb;
	$search_query = get_search_query();
	$search_query = $wpdb->esc_like( $search_query );

	$where .= " AND REGEXP_REPLACE({$wpdb->posts}.post_content, '<.+?>', '') LIKE '%{$search_query}%'";

	return $where;
}
add_filter( 'posts_search', 'wp_search_ignore_block_names_update_search_query', 10, 2 );
