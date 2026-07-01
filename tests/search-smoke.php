<?php
/**
 * Smoke tests for native search filtering.
 *
 * @package WordPress\ignore-block-name-in-search
 */

$regexp_replace_result = $GLOBALS['wpdb']->get_var( "SELECT REGEXP_REPLACE('abc', 'b', '')" );

if ( 'ac' !== $regexp_replace_result ) {
	throw new RuntimeException( 'The test database must support REGEXP_REPLACE().' );
}

$post_id = wp_insert_post(
	array(
		'post_status'  => 'publish',
		'post_title'   => 'Search smoke test',
		'post_content' => '<!-- wp:syntaxhighlighting/code --><pre class="wp-block-syntaxhighlighting-code">VisibleNeedle [testshortcode]</pre><!-- /wp:syntaxhighlighting/code -->',
	)
);

if ( is_wp_error( $post_id ) || ! $post_id ) {
	throw new RuntimeException( 'Failed to create the search smoke test post.' );
}

/**
 * Run a search as the main query so the plugin filter applies.
 *
 * @param string $search_term Search term.
 * @return int[] Matching post IDs.
 */
function ignore_block_name_search_test_ids( $search_term ) {
	global $wp_query, $wp_the_query;

	$query        = new WP_Query();
	$wp_query     = $query;
	$wp_the_query = $query;

	$query->query(
		array(
			's'           => $search_term,
			'post_type'   => 'post',
			'post_status' => 'publish',
			'fields'      => 'ids',
		)
	);

	return array_map( 'intval', $query->posts );
}

$block_name_matches = ignore_block_name_search_test_ids( 'syntaxhighlighting' );

if ( in_array( (int) $post_id, $block_name_matches, true ) ) {
	throw new RuntimeException( 'Block names from comments or generated wp-block-* classes must not match search results.' );
}

$visible_content_matches = ignore_block_name_search_test_ids( 'VisibleNeedle' );

if ( ! in_array( (int) $post_id, $visible_content_matches, true ) ) {
	throw new RuntimeException( 'Visible post content must remain searchable.' );
}

$shortcode_matches = ignore_block_name_search_test_ids( 'testshortcode' );

if ( ! in_array( (int) $post_id, $shortcode_matches, true ) ) {
	throw new RuntimeException( 'Shortcodes must remain searchable.' );
}

wp_delete_post( $post_id, true );

echo 'Search smoke tests passed.' . PHP_EOL;
