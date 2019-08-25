<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/**
 * Plugin Name: WP Manual Instagram Widget
 * Plugin URI: https://github.com/NazarkinRoman/WP-Manual-Instagram-Widget
 * Description: Allows you to manually set images from your instagram account to show up on your site.
 * Version: 0.1
 * Author: Roman Nazarkin
 * Author URI: https://github.com/NazarkinRoman
 * Text Domain: nazarkinre-wpiw
 */

add_action( 'plugins_loaded', function () {
	load_plugin_textdomain( 'nazarkinre-wpiw', false, basename( dirname( __FILE__ ) ) . '/languages/' );
} );

add_action( 'widgets_init', function () {
	register_widget( 'Nazarkinre_WP_Instagram_Widget' );
} );

/**
 * Helper function that renders widget inside any place of page
 *
 * @param array $instance
 * @param array $args
 */
function nazarkinre_wpiw_render( $instance = array(), $args = array() ) {
	the_widget( 'Nazarkinre_WP_Instagram_Widget', $instance, $args );
}

/**
 * Main class of a plugin
 */
class Nazarkinre_WP_Instagram_Widget extends WP_Widget {
	/**
	 * Nazarkinre_WP_Instagram_Widget constructor.
	 */
	function __construct() {
		parent::__construct(
			'nazarkinre-wpiw',
			esc_html__( 'Instagram Manual Posts Widget', 'nazarkinre-wpiw' ),
			array(
				'customize_selective_refresh' => true,
				'description'                 => esc_html__( 'Allows you to manually set images from your instagram account to show up on your site.', 'nazarkinre-wpiw' )
			)
		);

		wp_register_script(
			'sortable',
			plugin_dir_url( __FILE__ ) . 'assets/Sortable.min.js'
		);

		wp_register_script(
			'nazarkinre-wpiw-form-scripts',
			plugin_dir_url( __FILE__ ) . 'assets/form.js',
			array(
				'jquery',
				'sortable'
			)
		);

		wp_register_style(
			'nazarkinre-wpiw-form-styles',
			plugin_dir_url( __FILE__ ) . 'assets/form.css'
		);
	}

	/**
	 * Parses widget instance variable and sets default values if they are not present
	 *
	 * @param $instance
	 *
	 * @return array
	 */
	public function parse_instance( $instance ) {
		return wp_parse_args(
			(array) $instance,
			array(
				'title'               => '',
				'companion_text'      => '',
				'companion_text_link' => '',
				'image_size'          => 'thumbnail',
				'links_target'        => '_blank',
				'images'              => array()
			)
		);
	}

	/**
	 * Renders widget front-end
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$instance                = $this->parse_instance( $instance );
		$instance['title']       = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$instance['widget_args'] = $args;

		$this->render_template( 'widget.php', $instance );
	}

	/**
	 * Render back-end settings form
	 *
	 * @param array $instance
	 */
	public function form( $instance ) {
		$instance = $this->parse_instance( $instance );

		wp_enqueue_media();
		wp_enqueue_script( 'nazarkinre-wpiw-form-scripts' );
		wp_enqueue_style( 'nazarkinre-wpiw-form-styles' );

		$this->render_template( 'form.php', $instance );
	}

	/**
	 * Handles form update
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$items_count = min(
			sizeof( (array) $new_instance['images']['id'] ),
			sizeof( (array) $new_instance['images']['description'] ),
			sizeof( (array) $new_instance['images']['link'] )
		);

		$images = array();

		// we start here from index 1 to skip template empty value
		for ( $i = 1; $i < $items_count; $i ++ ) {
			if ( ! is_numeric( $new_instance['images']['id'][ $i ] ) ) { // skip items without image specified
				continue;
			}

			$images[] = array(
				'id'          => $new_instance['images']['id'][ $i ],
				'description' => $new_instance['images']['description'][ $i ],
				'link'        => $new_instance['images']['link'][ $i ]
			);
		}

		$new_instance['images'] = $images;

		return parent::update( $new_instance, $old_instance );
	}

	/**
	 * Renders widget template
	 *
	 * @param $template_file
	 * @param $instance
	 *
	 * @return string
	 */
	public function render_template( $template_file, $instance ) {
		$instance = $this->parse_instance( $instance );

		$isolated_include = function ( $widget ) use ( $instance, $template_file ) {
			require plugin_dir_path( __FILE__ ) . '/templates/' . basename( $template_file );
		};

		return $isolated_include( $this );
	}
}
