<?php
/**
 * Created by PhpStorm.
 * User: mitch
 * Date: 06/08/2018
 * Time: 11:36
 */

namespace Cb5\Elementor\Widgets;

use Cb5\Elementor\Widgets\Messages\Cb5_elements_messages as messages;
use Cb5\Elementor\Widgets\Related\cb5_users_control;


final class Cb5_elements_related {
	
	const VERSION = '1.0.0';
	const MINIMUM_ELEMENTOR_VERSION = '2.1.4';
	const MINIMUM_PHP_VERSION = '7.0';
	
	private static $_instance = null;
	public static function instance() {
		
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		
		return self::$_instance;
	}
	
	public function __construct() {
		
		add_action( 'init', [$this, 'i18n' ] );
		add_action( 'plugins_loaded', [$this, 'init' ] );
		
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widget' ] );
		
	}
	
	public function i18n() {
		
		load_plugin_textdomain( 'cb5_elementor' );
		
	}
	
	public function init() {
		require_once 'class_cb5_elements-messages.php';
		
		//		Check if elementor is installed and active
		if( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', messages::admin_notice_missing_main_plugin() );
			
			return;
		}
		
		//		Check Elementor Version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ){
			add_action( 'admin_notices', messages::admin_notice_version_too_low() );
			return;
		}
		
		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', messages::admin_notice_minimum_php_version() );
			
			return;
		}
		
	}
	
	public function includes() {
		require_once __DIR__ . '/widget/class-cb5_elements_related-widget.php';
	}
	
	public function init_widget() {
		
		$this->includes();
		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Cb5\Elementor\Widgets\Related\cb5_users_widget() );
		
	}

	
}