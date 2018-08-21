<?php
/**
 * Created by PhpStorm.
 * User: mitch
 * Date: 06/08/2018
 * Time: 10:04
 */
namespace Cb5\Elementor\Widgets\Users;

class cb5_users_widget extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'users_shown';
	}
	
	public function get_title() {
		return __( 'Gebruikers contact', 'cb5_elementor' );
	}
	
	public function get_icon() {
		return 'fa fa-user';
	}
	
	public function get_categories() {
		return [ 'general', 'CroonenBuro' ];
	}
	
	protected function _register_controls() {
		
		$args = [
			'post_type'     => 'gebruikers'
		];
		
		$users = [];
		
		$the_query = new \WP_Query($args);
		
		if( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				
				$users [get_the_ID()]   =   get_the_title();
			}
			wp_reset_postdata();
		}
		
		
		$this->start_controls_section(
			'content_section',
			[
				'label'         =>  __( 'Content', 'cb5_elementor' ),
				'tab'           =>  \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control( 'titel',
			[
				'label'         =>  __( 'Titel', 'cb5_elementor'),
				'type'          =>  \Elementor\Controls_Manager::TEXT,
				'input_type'    =>  'text',
				'placeholder'   =>  'Meer informatie over {{  }}'
			]
		);
		
		$this->add_control( 'subtitel',
			[
				'label'         =>  __( 'Sub titel', 'cb5_elementor'),
				'type'          =>  \Elementor\Controls_Manager::TEXT,
				'input_type'    =>  'text',
				'placeholder'   =>  'Neem contact op met onze experts.'
			]
		);
		
		$this->add_control( 'user_1',
			[
				'label'         =>  __( 'Contactpersoon #1', 'cb5_elementor'),
				'type'          =>  \Elementor\Controls_Manager::SELECT,
				'input_type'    =>  'User',
				'options'       =>  $users,
			]
		);
		
		$this->end_controls_section();
	}
	
	protected function render() {
		
		$settings = $this->get_settings_for_display();
		
		$title      = ( $settings[ 'titel' ] ) ? $settings[ 'titel' ]: 'Meer informatie?';
		$subtitle   = ( $settings[ 'subtitel' ]) ? $settings[ 'subtitel'] : 'Neem contact op met onze expert.';
		$user1      = $settings[ 'user_1' ];
		
		$args = [
			'post_type'     => 'gebruikers',
			'p'             => $user1,
		];
		
		$the_query = new \WP_Query($args);
		
		if( $the_query->have_posts()){
			$the_query->the_post();
			
			$output  = "<div class='cb5-widget user-widget-contact'>";
			
			$output .= "<h2 class='title'>$title</h2>";
			$output .= "<h4 class='subtitle'>$subtitle</h4>";
			$output .= "<div class='row justify-content-md-center'>";
			$output .= "<div class='col-md-3'>";
			$output .= get_the_title();
			$output .= "</div>";
			$output .= "</div>";
			
			$output .= "</div>";
			
			print $output;
			
		}

		
	}
	
	protected function _content_template() {}
	
}