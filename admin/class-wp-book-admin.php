<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://profiles.wordpress.org/nileshpipaliya
 * @since      1.0.0
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/admin
 * @author     Nilesh Pipaliya <pipaliyanilesh04@gmail.com>
 */
class Wp_Book_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Book_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Book_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-book-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Book_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Book_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-book-admin.js', array( 'jquery' ), $this->version, false );

	}

	/** 
	 * Register a custom post type called "book".
	 * 
	 * @since 1.0.0
	*/
	public function codex_book_init() {

		$labels = array(
			'name'                  => _x( 'Books', 'Post type general name', 'wp-book' ),
			'singular_name'         => _x( 'Book', 'Post type singular name', 'wp-book' ),
			'menu_name'             => _x( 'Books', 'Admin Menu text', 'wp-book' ),
			'name_admin_bar'        => _x( 'Book', 'Add New on Toolbar', 'wp-book' ),
			'add_new'               => __( 'Add New', 'wp-book' ),
			'add_new_item'          => __( 'Add New Book', 'wp-book' ),
			'new_item'              => __( 'New Book', 'wp-book' ),
			'edit_item'             => __( 'Edit Book', 'wp-book' ),
			'view_item'             => __( 'View Book', 'wp-book' ),
			'all_items'             => __( 'All Books', 'wp-book' ),
			'search_items'          => __( 'Search Books', 'wp-book' ),
			'not_found'             => __( 'No books found.', 'wp-book' ),
			'not_found_in_trash'    => __( 'No books found in Trash.', 'wp-book' ),
		);
	
		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'book' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'menu_position'      => 5,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
		);
	
		register_post_type( 'book', $args );
	}

	/**
	 * Create two taxonomies, Book Category and Book Tag for the post type "book".
	 * 
	 * @since 1.0.0
	 */
	public function codex_book_taxonomies(){
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Book Categories', 'taxonomy general name', 'wp-book' ),
			'singular_name'     => _x( 'Book Category', 'taxonomy singular name', 'wp-book' ),
			'search_items'      => __( 'Search Categories', 'wp-book' ),
			'all_items'         => __( 'All Categories', 'wp-book' ),
			'parent_item'       => __( 'Parent Category', 'wp-book' ),
			'parent_item_colon' => __( 'Parent Category:', 'wp-book' ),
			'edit_item'         => __( 'Edit Category', 'wp-book' ),
			'update_item'       => __( 'Update Category', 'wp-book' ),
			'add_new_item'      => __( 'Add New Category', 'wp-book' ),
			'new_item_name'     => __( 'New Category Name', 'wp-book' ),
			'menu_name'         => __( 'Book Category', 'wp-book' ),
		);
	
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'book_category' ),
		);
	
		register_taxonomy( 'book_category', array( 'book' ), $args );

		unset( $args );
		unset( $labels );

		// Add new taxonomy, NOT hierarchical (like tags)
		$labels = array(
			'name'                       => _x( 'Book Tags', 'taxonomy general name', 'wp-book' ),
			'singular_name'              => _x( 'Book Tag', 'taxonomy singular name', 'wp-book' ),
			'search_items'               => __( 'Search Tags', 'wp-book' ),
			'popular_items'              => __( 'Popular Tags', 'wp-book' ),
			'all_items'                  => __( 'All Tags', 'wp-book' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Tag', 'wp-book' ),
			'update_item'                => __( 'Update Tag', 'wp-book' ),
			'add_new_item'               => __( 'Add New Tag', 'wp-book' ),
			'new_item_name'              => __( 'New Tag Name', 'wp-book' ),
			'separate_items_with_commas' => __( 'Separate Tags with commas', 'wp-book' ),
			'add_or_remove_items'        => __( 'Add or remove Tags', 'wp-book' ),
			'choose_from_most_used'      => __( 'Choose from the most used Tags', 'wp-book' ),
			'not_found'                  => __( 'No Tags found.', 'wp-book' ),
			'menu_name'                  => __( 'Book Tags', 'wp-book' ),
		);
	
		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'book_tag' ),
		);
	
		register_taxonomy( 'book_tag', 'book', $args );

	}
}
