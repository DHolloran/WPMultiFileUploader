<?php
/**
 *	@package WPMFU_Plugin
 *	@version 1.1.0
 *	@author Dan Holloran
 *	@copyright GPLv2 (or later)
 */
class WPMFU_Plugin
{

	protected $inputName = 'qqfile';
	public $version = '1.1.0';
	/*
	* Constructor
	*/
	public function __construct( $config = array() ) {
		$this->init_hooks();
	} // __construct()


	/*
	* Init Hooks
	*/
	public function init_hooks()
	{
		// Front End Styles & Scripts
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_scripts_styles' ) );

		// Admin Styles & Scripts
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_admin_scripts_styles' ) );
	} // init_hooks()


	/**
	* Build the uploader form
	*/
	function build_form( $attrs = array() )
	{
		$form = '<ul id="wp_multi_file_uploader" class="unstyled" data-filecount="1" data-ajaxurl="' . site_url( 'wp-admin/admin-ajax.php' ) . '"></ul>';
		return $form;
	}


	/*
	* Enqueue Scripts & Styles
	*/
	public function enqueue_scripts_styles()
	{
		global $wpmfu_plugin;
		wp_register_script( 'wpmfu_script', plugins_url( 'assets/js/fineuploader.min.js' , dirname(__FILE__) ), array( 'jquery' ), $wpmfu_plugin->version, true );
		wp_enqueue_script( 'wpmfu_script' );
		wp_register_style( 'wpmfu_style', plugins_url( 'assets/css/wpmfu-plugin.css' , dirname(__FILE__) ), null, $wpmfu_plugin->version );
		wp_enqueue_style( 'wpmfu_style' );
	} // enqueue_scripts_styles()


	/*
	* Enqueue Administrator Scripts & Styles
	*/
	public function enqueue_admin_scripts_styles()
	{
		global $wpmfu_plugin;
		global $post;

		// Make sure we are on the correct page
		if ( $post->post_type != 'wpmfu_forms_type') return false;

		// Enqueue scripts and styles
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-widget' );
		wp_enqueue_script( 'jquery-ui-mouse' );
		wp_enqueue_script( 'jquery-ui-draggable' );
		wp_enqueue_script( 'jquery-ui-droppable' );
	} // enqueue_admin_scripts_styles()

} // class WPMFU_Plugin

$wpmfu_plugin = new WPMFU_Plugin();