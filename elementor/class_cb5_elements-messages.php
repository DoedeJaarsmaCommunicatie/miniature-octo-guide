<?php
/**
 * Created by PhpStorm.
 * User: mitch
 * Date: 06/08/2018
 * Time: 08:40
 */

namespace Cb5\Elementor\Widgets\Messages;

final class Cb5_elements_messages {

//	If Elementor is not installed and activated, an admin notice will be displayed and it won’t continue loading the functionality.
	public static function admin_notice_missing_main_plugin () {
		if ( isset( $_GET[ 'activate' ] ) ) unset ( $_GET[ 'activate' ] );
		
		$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'cb5_elementor' ),
			'<strong>' . esc_html__( 'CB5 Elements', 'cb5_elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'cb5_elementor' ) . '</strong>'
		);
		
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}
	
	public static function admin_notice_version_too_low () {
		
		if ( isset( $_GET[ 'activate' ] ) ) unset ( $_GET[ 'activate' ] );
		
		$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'cb5_elementor' ),
			'<strong>' . esc_html__( 'CB5 Elements', 'cb5_elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'cb5_elementor' ) . '</strong>',
			'2.1.4'
		);
		
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}
	
	public static function admin_notice_minimum_php_version () {
		
		$min_version = Cb5_elements_users::MINIMUM_PHP_VERSION;
		
		if ( isset( $_GET[ 'activate' ] ) ) unset ( $_GET[ 'activate' ] );
		
		$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'cb5_elementor' ),
			'<strong>' . esc_html__( 'CB5 Elements', 'cb5_elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'cb5_elementor' ) . '</strong>',
			'7.0'
		);
		
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}
	

}