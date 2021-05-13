<?php
/*
    @package Growup
	===========================
	   Shortcode Options
	===========================
*/

// Tooltip Shortcode

function growup_tooltip( $atts, $content = null ){
	
	//[tooltip placement="top" title="This is the title"]This is the content[/tooltip]
	
	//get the attributes
	$atts = shortcode_atts(
		array(
			'placement' => 'top',
			'title' => '',
		),
		$atts,
		'tooltip'
	);
	
	$title = ( $atts['title'] == '' ? $content : $atts['title'] );
	
	//return HTML
	return '<span class="growup-tooltip" data-toggle="tooltip" data-placement="' . $atts['placement'] . '" title="' . $title . '">' . $content . '</span>';
	
}

add_shortcode( 'tooltip', 'growup_tooltip' );

// Popover Shortcode

function growup_popover( $atts, $content = null ){
	
	//[popover placement="top" title="This is Popover Title" trigger="click" content="This is Popover Content"]This is clickable Content[/popover]
	
	//get the attributes
	$atts = shortcode_atts(
		array(
			'placement' => 'top',
            'title' => '',
            'trigger' => 'click',
            'content' => '',
		),
		$atts,
		'popover'
	);
	
	//return HTML
    return '<span class="growup-popover" data-toggle="popover" data-placement="' . $atts['placement'] . '" 
    title="' . $atts['title'] . '" data-trigger="' . $atts['trigger'] . '" data-content="' . $atts['content'] . '">' . $content . '</span>';
}

add_shortcode( 'popover', 'growup_popover' );

// Contact Form Shortcode

function growup_contact_form( $atts, $content = null ) {
	
	//[contact_form]
	
	//get the attributes
	$atts = shortcode_atts(
		array(),
		$atts,
		'contact_form'
	);
	
	//return HTML
	ob_start();
	include 'templates/contact-form.php';
	return ob_get_clean();
	
}
add_shortcode( 'contact_form', 'growup_contact_form' );