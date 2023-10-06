<?php
/**
 * Plugin Name: Ignore HTML and shortcodes in search
 * Description: Modifies the native search to ignore markup and shortcodes
 * Version: 1.2.0
 * Author: Torsten Landsiedel
 * Author URI: https://torstenlandsiedel.de
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Plugin URI: https://github.com/Zodiac1978/wp-search-ignore-block-names
 * Text Domain: ignore-block-name-in-search
 * Domain Path: /languages
 *
 * @package WordPress\ignore-block-name-in-search
 */

/**
 * Ignore block name in search class
 */
class IgnoreBlockNameInSearch {

	/**
	 * Is the database MariaDB or not?
	 *
	 * @var bool
	 */
	public $is_mariadb = false;

	/**
	 * Does the database support REGEXP_REPLACE?
	 *
	 * @var bool
	 */
	private $is_supporting_regexp_replace;

	/**
	 * Variable for storing the actual database version number
	 *
	 * @var string
	 */
	private $mysql_server_version = '';

	/**
	 * Required MySQL version
	 *
	 * @var string
	 */
	private $mysql_required_version = '8.0.4';

	/**
	 * Required Maria DB version
	 *
	 * @var string
	 */
	private $mariadb_required_version = '10.0.5';

	/**
	 * Constructor function for IgnoreBlockNameInSearch.
	 */
	public function __construct() {
		add_action( 'admin_init', array( $this, 'check_version' ) );

		// Don't run anything else in the plugin, if we're on an incompatible database.
		if ( ! $this->compatible_version() ) {
			return;
		}

		add_action( 'init', array( $this, 'init' ), 0 );

		// Adding function to all posts_search filter (fires less often than posts_where).
		add_filter( 'posts_search', array( $this, 'wp_search_ignore_block_names_update_search_query' ), 10, 2 );

	}

	/**
	 * Init when WordPress Initialises.
	 *
	 * @since  1.1.0
	 */
	public function init() {
		// Set up localisation.
		$this->load_plugin_textdomain();
	}

	/**
	 * Load plugin textdomain.
	 *
	 * @since 1.1.0
	 */
	private function load_plugin_textdomain() {
		if ( is_admin() ) {
			load_plugin_textdomain( 'ignore-block-name-in-search', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		}
	}

	/**
	 * The primary sanity check, automatically disable the plugin on activation if it doesn't meet minimum requirements.
	 *
	 * @return void
	 */
	public function activation_check() {
		if ( ! $this->compatible_version() ) {
			deactivate_plugins( plugin_basename( __FILE__ ) );
			wp_die(
				esc_html__( 'The version of your database software does not support REGEXP_REPLACE. Please upgrade to MySQL 8.0.4+ or MariaDB 10.0.5+.', 'ignore-block-name-in-search' ),
				'',
				array(
					'back_link' => true,
				)
			);
		}
	}

	/**
	 * The backup sanity check, in case the plugin is activated in a weird way, or the versions change after activation.
	 *
	 * @return void
	 */
	public function check_version() {
		if ( ! $this->compatible_version() ) {
			if ( is_plugin_active( plugin_basename( __FILE__ ) ) ) {
				deactivate_plugins( plugin_basename( __FILE__ ) );
				add_action( 'admin_notices', array( $this, 'disabled_notice' ) );
				if ( isset( $_GET['activate'] ) ) { // phpcs:ignore warning
					unset( $_GET['activate'] ); // phpcs:ignore warning
				}
			}
		}
	}

	/**
	 * Show error message.
	 *
	 * @return void
	 */
	public function disabled_notice() {
		$error_message  = '<div class="notice notice-error is-dismissible">';
		$error_message .= '<p><strong>' . esc_html__( 'Plugin deactivated!', 'ignore-block-name-in-search' ) . '</strong> ';
		$error_message .= esc_html__( 'The version of your database software does not support REGEXP_REPLACE. Please upgrade to MySQL 8.0.4+ or MariaDB 10.0.5+.', 'ignore-block-name-in-search' );
		$error_message .= '</p></div>';
		echo $error_message; // phpcs:ignore error
	}

	/**
	 * Runs the SQL version checks.
	 *
	 * @global wpdb $wpdb WordPress database abstraction object.
	 */
	private function prepare_sql_data() {
		global $wpdb;

		$mysql_server_type = $wpdb->db_server_info();

		$this->mysql_server_version = $wpdb->get_var( 'SELECT VERSION()' ); // phpcs:ignore warning

		if ( stristr( $mysql_server_type, 'mariadb' ) !== false ) {
			$this->is_mariadb             = true;
			$this->mysql_required_version = $this->mariadb_required_version;
		}

		$this->is_supporting_regexp_replace = version_compare( $this->mysql_required_version, $this->mysql_server_version, '<=' );
	}

	/**
	 * Compatible version check: Tests if the SQL server is supporting REGEXP_REPLACE.
	 *
	 * @return bool
	 */
	private function compatible_version() {

		// Get data.
		if ( ! $this->mysql_server_version ) {
			$this->prepare_sql_data();
		}

		// Return result.
		return $this->is_supporting_regexp_replace;

	}


	/**
	 * Modify search query to ignore the search term in HTML comments.
	 *
	 * @param string   $where The WHERE clause of the query.
	 * @param WP_Query $query The WP_Query instance (passed by reference).
	 *
	 * @return string The modified WHERE clause.
	 */
	public function wp_search_ignore_block_names_update_search_query( $where, $query ) {
		if ( ! is_search() || ! $query->is_main_query() ) {
			return $where;
		}

		global $wpdb;
		$search_query = get_search_query();
		$search_query = $wpdb->esc_like( $search_query );

		$where .= " AND (REGEXP_REPLACE(REGEXP_REPLACE({$wpdb->posts}.post_content, '\\\\[.+?\\]', ''), '<.+?>', '') LIKE '%{$search_query}%' OR {$wpdb->posts}.post_title LIKE '%{$search_query}%' OR {$wpdb->posts}.post_excerpt LIKE '%{$search_query}%')";

		return $where;
	}


}

global $ignore_block_name_in_search;
$ignore_block_name_in_search = new IgnoreBlockNameInSearch();

register_activation_hook( __FILE__, array( $ignore_block_name_in_search, 'activation_check' ) );
