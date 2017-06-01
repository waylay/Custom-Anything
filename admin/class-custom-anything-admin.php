<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://webcodesigner.com/
 * @since      1.0.0
 *
 * @package    Custom_Anything
 * @subpackage Custom_Anything/admin
 */


use TypistTech\WPBetterSettings\Factories\Fields\CheckboxFactory as CheckboxFactory;
use TypistTech\WPBetterSettings\Factories\Fields\InputFactory as InputFactory;
use TypistTech\WPBetterSettings\Factories\Fields\TextareaFactory as TextareaFactory;
use TypistTech\WPBetterSettings\Factories\ViewFactory as ViewFactory;
use TypistTech\WPBetterSettings\Fields\Checkbox as Checkbox;
use TypistTech\WPBetterSettings\Fields\Email as Email;
use TypistTech\WPBetterSettings\Fields\Text as Text;
use TypistTech\WPBetterSettings\Fields\Textarea as Textarea;
use TypistTech\WPBetterSettings\Fields\Url as Url;
use TypistTech\WPBetterSettings\Pages\MenuPage as MenuPage;
use TypistTech\WPBetterSettings\Pages\SubmenuPage as SubmenuPage;
use TypistTech\WPBetterSettings\Views\View as View;


/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Custom_Anything
 * @subpackage Custom_Anything/admin
 * @author     Cristian Ionel <cristian.ionel@gmail.com>
 */
class Custom_Anything_Admin {

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
		 * defined in Custom_Anything_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custom_Anything_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/custom-anything-admin.css', array(), $this->version, 'all' );

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
		 * defined in Custom_Anything_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custom_Anything_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/custom-anything-admin.js', array( 'jquery' ), $this->version, false );

	}

}
