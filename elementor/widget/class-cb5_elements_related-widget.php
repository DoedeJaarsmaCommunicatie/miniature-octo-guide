<?php
/**
 * Created by PhpStorm.
 * User: mitch
 * Date: 06/08/2018
 * Time: 10:04
 */

namespace Cb5\Elementor\Widgets\Related;


class cb5_users_widget extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'projecten_shown';
	}
	
	public function get_title() {
		return __( 'Projecten', 'cb5_elementor' );
	}
	
	public function get_icon() {
		return 'fa fa-folder-open';
	}
	
	public function get_categories() {
		return [ 'general', 'CroonenBuro' ];
	}
	
	
	protected function _register_controls() {
		
		if(  get_field('is_pagina_activiteit') === "true" ){
			$terms [] = get_field('soort_activiteit');
		} else {
			$terms = get_the_terms( get_queried_object_id(), 'activiteiten_taxonomy' );
		}
		
		$termArr = [];
		
		foreach ($terms as $term){
			$termArr [] = $term->term_id;
		}
		
		$args = [
			'post_type'     => 'project',
			'posts_per_page' => -1,
			'tax_query'     => [
				'relation'      => 'OR',
				'taxonomy'      => 'activiteiten_taxonomy',
				'field'         => 'term_id',
				'terms'         => $termArr,
			]
		];
		
		$the_query = new \WP_Query( $args );
		
		$posts = [];
		
		if ( $the_query->have_posts() ){
			while ( $the_query->have_posts() ){
				$the_query->the_post();
				$posts [get_the_ID()] = get_the_title();
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
		
		$this->add_control( 'posttitle', [
				'label'         =>  __( 'titel', 'cb5_elementor'),
				'type'          =>  \Elementor\Controls_Manager::TEXT,
				'input_type'    =>  'text',
			]
		);
		
		$this->add_control( 'stickypost', [
				'label'         =>  __( 'Uitgelicht', 'cb5_elementor'),
				'type'          =>  \Elementor\Controls_Manager::SELECT,
				'input_type'    =>  'select',
				'options'       => $posts,
			]
		);
		
		$this->end_controls_section();
	}
	
	protected function render() {
		
		$settings = $this->get_settings_for_display();
		
		$sticky = ( $settings['stickypost'] ) ? $settings[ 'stickypost' ] : false;
		$title = ( $settings['posttitle' ] ) ? $settings[ 'posttitle' ] : __( 'Gerelateerde projecten', 'cb5_elements');
		
		if(  get_field('is_pagina_activiteit') === "true" ){
			$terms [] = get_field('soort_activiteit');
		} else {
			$terms = get_the_terms( get_queried_object_id(), 'activiteiten_taxonomy' );
		}
		$termArr = [];
		
		foreach ($terms as $term){
			$termArr [] = $term->term_id;
		}
		if( $sticky ){
			$stick = get_post( $sticky );
		}
		
		$args = [
			'post_type'     => 'project',
			'posts_per_page'=> ( $sticky ) ? 2 : 3,
			'orderby'       => 'date',
			'order'         => 'ASC',
			'tax_query'     => [
				'relation'      => 'OR',
				'taxonomy'      => 'activiteiten_taxonomy',
				'field'         => 'term_id',
				'terms'         => $termArr,
			]
		];
		
		$the_query = new \WP_Query( $args );
		
		$output  = "<div class='cb5-widget cb5-related'>";
		
		$output .= "<div class='row justify-content-md-center'>";
		
		if ( $sticky ){
			$output .= "<div class='col-md-3'>";
			
			$output .= get_the_title();
			
			$output .= "</div>";
		}
		
		if ( $the_query->have_posts() ) {
			
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				
				$output .= "<div class='col-md-3'>";
				
				$output .= get_the_title();
				
				$output .= "</div>";
			}
			wp_reset_postdata();
		}
		
		$output .= "</div>";
		
		$output .= "<div class='row justify-content-md-center'>";
		
		$output .= "<a href='/projecten/' class='btn btn-primary text-white'>" . __( 'Bekijk alle projecten' , 'cb5_elements' ) . "</a>";
		
		$output .= "</div>";
		
		$output .= "</div>";
		
		print $output;
	}
	
	protected function _content_template() {}
	
}