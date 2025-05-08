<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class CSS_Carousel_Widget extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'css-carousel';
	}

	public function get_title(): string {
		return esc_html__( 'CSS Carousel', 'elementor-carousels' );
	}

	public function get_icon(): string {
		return 'eicon-nested-carousel';
	}

	public function get_categories(): array {
		return [ 'elementor-carousels' ];
	}

	public function get_keywords(): array {
		return [ 'carousel', 'slider', 'gallery' ];
	}

	public function get_custom_help_url(): string {
		return 'https://developers.elementor.com/docs/widgets/';
	}

	public function has_widget_inner_wrapper(): bool {
		return false;
	}

	protected function is_dynamic_content(): bool {
		return false;
	}

	public function get_style_depends(): array {
		return [ 'css-carousel' ];
	}

	protected function register_controls(): void {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Carousel', 'elementor-carousels' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'carousel',
			[
				'label' => esc_html__( 'Carousel slides', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'default' => [],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'scroll_buttons',
			[
				'label' => esc_html__( 'Scroll buttons', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementor-carousels' ),
				'label_off' => esc_html__( 'Hide', 'elementor-carousels' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'previous_button',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => esc_html__( 'Previous button', 'elementor-carousels' ),
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_control(
			'previous_button_label',
			[
				'label' => esc_html__( 'Label', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Previous', 'elementor-carousels' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-buttons' => '--scroll-button-start-label: "{{VALUE}}";',
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_control(
			'previous_button_image',
			[
				'label' => esc_html__( 'Image', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => plugins_url( '../assets/img/arrow-left.svg', __FILE__ ),
				],
				'dynamic' => [
					'active' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-buttons' => '--scroll-button-start-image: url("{{URL}}");',
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_control(
			'next_button',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => esc_html__( 'Next button', 'elementor-carousels' ),
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_control(
			'next_button_label',
			[
				'label' => esc_html__( 'Label', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Next', 'elementor-carousels' ),
				'dynamic' => [
					'active' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-buttons' => '--scroll-button-end-label: "{{VALUE}}";',
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_control(
			'next_button_image',
			[
				'label' => esc_html__( 'Image', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => plugins_url( '../assets/img/arrow-right.svg', __FILE__ ),
				],
				'dynamic' => [
					'active' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-buttons' => '--scroll-button-end-image: url("{{URL}}");',
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_control(
			'scroll_markers',
			[
				'label' => esc_html__( 'Scroll markers', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementor-carousels' ),
				'label_off' => esc_html__( 'Hide', 'elementor-carousels' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'scroll_markers_with_image',
			[
				'label' => esc_html__( 'Image markers', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'elementor-carousels' ),
				'label_off' => esc_html__( 'No', 'elementor-carousels' ),
				'condition' => [
					'scroll_markers' => 'yes',
				],
			]
		);

		$this->add_control(
			'focusable_slides',
			[
				'label' => esc_html__( 'Focusable slides', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_carousel_slides_section',
			[
				'label' => esc_html__( 'Carousel slides', 'elementor-carousels' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'slide_width',
			[
				'label' => esc_html__( 'Slide width', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'vw', 'custom' ],
				'default' => [
					'size' => 200,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'em' => [
						'min' => 0,
						'max' => 100,
					],
					'rem' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .carousel' => '--slide-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slide_height',
			[
				'label' => esc_html__( 'Slide height', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'vw', 'custom' ],
				'default' => [
					'size' => 200,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'em' => [
						'min' => 0,
						'max' => 100,
					],
					'rem' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .carousel' => '--slide-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slides_gap',
			[
				'label' => esc_html__( 'Slides gap', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'vw', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .carousel' => '--slides-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__( 'Border radius', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .carousel img' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_scroll_buttons_section',
			[
				'label' => esc_html__( 'Scroll buttons', 'elementor-carousels' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_control(
			'scroll_button_start_position_heading',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => esc_html__( 'Previous button', 'elementor-carousels' ),
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_button_start_position_inline',
			[
				'label' => esc_html__( 'Horizontal position', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Start', 'elementor-carousels' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor-carousels' ),
						'icon' => 'eicon-v-align-middle',
					],
					'end' => [
						'title' => esc_html__( 'End', 'elementor-carousels' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-buttons' => '--scroll-button-start-position-inline: {{VALUE}};',
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_button_start_position_block',
			[
				'label' => esc_html__( 'Vertical position', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Start', 'elementor-carousels' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor-carousels' ),
						'icon' => 'eicon-h-align-center',
					],
					'end' => [
						'title' => esc_html__( 'End', 'elementor-carousels' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'start',
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-buttons' => '--scroll-button-start-position-block: {{VALUE}};',
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_button_start_width',
			[
				'label' => esc_html__( 'Width', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'vw', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-buttons' => '--scroll-button-start-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_button_start_height',
			[
				'label' => esc_html__( 'Height', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'vw', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-buttons' => '--scroll-button-start-height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_button_start_spacing',
			[
				'label' => esc_html__( 'Spacing', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'vw', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-buttons' => '--scroll-button-start-spacing: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'scroll_button_start_border',
				'selector' => '{{WRAPPER}} .carousel.scroll-buttons::scroll-button(inline-start)',
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_button_start_border_radius',
			[
				'label' => esc_html__( 'Border radius', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-buttons::scroll-button(inline-start)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_control(
			'scroll_button_start_disable_state_opacity',
			[
				'label' => esc_html__( 'Disable state opacity', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.0,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-buttons' => '--scroll-button-start-disabled-opacity: {{SIZE}};',
				],
			]
		);

		$this->add_control(
			'scroll_button_end_position_heading',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => esc_html__( 'Next button', 'elementor-carousels' ),
				'separator' => 'before',
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_button_end_position_inline',
			[
				'label' => esc_html__( 'Horizontal position', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Start', 'elementor-carousels' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor-carousels' ),
						'icon' => 'eicon-v-align-middle',
					],
					'end' => [
						'title' => esc_html__( 'End', 'elementor-carousels' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-buttons' => '--scroll-button-end-position-inline: {{VALUE}};',
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_button_end_position_block',
			[
				'label' => esc_html__( 'Vertical position', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Start', 'elementor-carousels' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor-carousels' ),
						'icon' => 'eicon-h-align-center',
					],
					'end' => [
						'title' => esc_html__( 'End', 'elementor-carousels' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'end',
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-buttons' => '--scroll-button-end-position-block: {{VALUE}};',
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_button_end_width',
			[
				'label' => esc_html__( 'Width', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'vw', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-buttons' => '--scroll-button-end-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_button_end_height',
			[
				'label' => esc_html__( 'Height', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'vw', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-buttons' => '--scroll-button-end-height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_button_end_spacing',
			[
				'label' => esc_html__( 'Spacing', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'vw', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-buttons' => '--scroll-button-end-spacing: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'scroll_button_end_border',
				'selector' => '{{WRAPPER}} .carousel.scroll-buttons::scroll-button(inline-end)',
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_button_end_border_radius',
			[
				'label' => esc_html__( 'Border radius', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-buttons::scroll-button(inline-end)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_control(
			'scroll_button_end_disable_state_opacity',
			[
				'label' => esc_html__( 'Disable state opacity', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.0,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-buttons' => '--scroll-button-end-disabled-opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_scroll_markers_section',
			[
				'label' => esc_html__( 'Scroll markers', 'elementor-carousels' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'scroll_markers' => 'yes',
				],
			]
		);

		$this->add_control(
			'scroll_marker_group_style_heading',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => esc_html__( 'Wrapper', 'elementor-carousels' ),
				'condition' => [
					'scroll_markers' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_marker_group_position',
			[
				'label' => esc_html__( 'Position', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'block-start' => [
						'title' => esc_html__( 'Above', 'elementor-carousels' ),
						'icon' => 'eicon-v-align-top',
					],
					'block-end' => [
						'title' => esc_html__( 'Below', 'elementor-carousels' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'block-end',
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-markers' => '--scroll-marker-group-position: {{VALUE}};',
				],
				'condition' => [
					'scroll_markers' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_marker_group_spacing',
			[
				'label' => esc_html__( 'Spacing', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'vw', 'custom' ],
				'default' => [
					'size' => 10,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-markers' => '--scroll-marker-group-spacing: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'scroll_markers' => 'yes',
				],
			]
		);

		$this->add_control(
			'scroll_marker_group_background_color',
			[
				'label' => esc_html__( 'Background color', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-markers::scroll-marker-group' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'scroll_markers' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'scroll_marker_group_border',
				'selector' => '{{WRAPPER}} .carousel.scroll-markers::scroll-marker-group',
				'condition' => [
					'scroll_markers' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_marker_group_border_radius',
			[
				'label' => esc_html__( 'Border radius', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-markers::scroll-marker-group' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'scroll_markers' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_marker_group_padding',
			[
				'label' => esc_html__( 'Padding', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-markers::scroll-marker-group' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'scroll_markers' => 'yes',
				],
			]
		);

		$this->add_control(
			'scroll_marker_style_heading',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => esc_html__( 'Marker', 'elementor-carousels' ),
				'separator' => 'before',
				'condition' => [
					'scroll_markers' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_marker_group_gap',
			[
				'label' => esc_html__( 'Markers gap', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'vw', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-markers' => '--scroll-marker-group-gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'scroll_markers' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_marker_width',
			[
				'label' => esc_html__( 'Marker width', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'vw', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-markers' => '--scroll-marker-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'scroll_markers' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_marker_height',
			[
				'label' => esc_html__( 'Marker height', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'vw', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-markers' => '--scroll-marker-height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'scroll_markers' => 'yes',
				],
			]
		);

		$this->add_control(
			'scroll_marker_background_color',
			[
				'label' => esc_html__( 'Background color', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-markers >*::scroll-marker' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'scroll_markers' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'scroll_marker_border',
				'selector' => '{{WRAPPER}} .carousel.scroll-markers >*::scroll-marker',
				'condition' => [
					'scroll_markers' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_marker_border_radius',
			[
				'label' => esc_html__( 'Border radius', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-markers >*::scroll-marker' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'scroll_markers' => 'yes',
				],
			]
		);

		$this->add_control(
			'scroll_marker_style_selected_heading',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => esc_html__( 'Selected Marker', 'elementor-carousels' ),
				'separator' => 'before',
				'condition' => [
					'scroll_markers' => 'yes',
				],
			]
		);

		$this->add_control(
			'scroll_marker_selected_background_color',
			[
				'label' => esc_html__( 'Background color', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-markers >*::scroll-marker:target-current' => '--scroll-marker-current-bg: {{VALUE}};',
				],
				'condition' => [
					'scroll_markers' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'scroll_marker_selected_border',
				'selector' => '{{WRAPPER}} .carousel.scroll-markers >*::scroll-marker:target-current',
				'condition' => [
					'scroll_markers' => 'yes',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'carousel' );
		$this->add_render_attribute( 'wrapper', 'style', "--carousel-anchor-name: --{$this->get_id()}" );

		if ( $settings['scroll_buttons'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'scroll-buttons' );
		}

		if ( $settings['scroll_markers'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'scroll-markers' );
			
			if ( $settings['scroll_markers_with_image'] ) {
				$this->add_render_attribute( 'wrapper', 'class', 'scroll-markers-image' );
			}
		}

		if ( $settings['focusable_slides'] ) {
			$this->add_render_attribute( 'slides', 'tabindex', '0' );
		}
		?>
		<ul <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
		<?php
		foreach ( $settings['carousel'] as $index => $image ) {
			if ( $settings['scroll_markers'] && $settings['scroll_markers_with_image'] ) {
				$this->add_render_attribute( 'slide' . $index, 'style', '--marker-img: url(' . esc_url( $image['url'] ) . ')' );
			}
			?>
			<li <?php $this->print_render_attribute_string( 'slides' ); ?> <?php $this->print_render_attribute_string( 'slide' . $index ); ?>>
				<img src="<?php echo esc_url( $image['url'] ); ?>" width="300" height="600">
			</li>
			<?php
		}
		?>
		</ul>
		<?php
	}

	protected function content_template(): void {
		?>
		<#
		view.addRenderAttribute( 'wrapper', 'class', 'carousel' );
		view.addRenderAttribute( 'wrapper', 'style', '--carousel-anchor-name: --<?php echo esc_attr( $this->get_id() ); ?>' );

		if ( settings.scroll_buttons ) {
			view.addRenderAttribute( 'wrapper', 'class', 'scroll-buttons' );
		}

		if ( settings.scroll_markers ) {
			view.addRenderAttribute( 'wrapper', 'class', 'scroll-markers' );

			if ( settings.scroll_markers_with_image ) {
				view.addRenderAttribute( 'wrapper', 'class', 'scroll-markers-image' );
			}
		}

		if ( settings.focusable_slides ) {
			view.addRenderAttribute( 'slides', 'tabindex', '0' );
		}
		#>
		<ul {{{ view.getRenderAttributeString( 'wrapper' ) }}}>
		<#
		_.each( settings.carousel, function( image, index ) {
			if ( settings.scroll_markers && settings.scroll_markers_with_image ) {
				view.addRenderAttribute( `slide-${index}`, 'style', '--marker-img: url(' + image.url + ')' );
			}
			#>
			<li {{{ view.getRenderAttributeString( 'slides' ) }}} {{{ view.getRenderAttributeString( `slide-${index}` ) }}}>
				<img src="{{ image.url }}" width="300" height="600">
			</li>
			<#
		} );
		#>
		</ul>
		<?php
	}

}
