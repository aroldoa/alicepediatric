<?php

/**
* Template Name: Pages template
*/


//* Force sidebar-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_content' );

add_filter( 'excerpt_length', 'sp_excerpt_length' );
function sp_excerpt_length( $length ) {
	return 3; // pull first 50 words
}


add_action( 'get_header', 'sidebar_on_page' );

function sidebar_on_page() {
	remove_action( 'genesis_after_content', 'genesis_get_sidebar' );
if ( is_page(array ('about-us','policies','our-services','meet-the-doctors')) ) {
add_action( 'genesis_after_content_sidebar_wrap', 'get_sidebar_about' );
}
elseif ( is_page('locations') ) {
add_action( 'genesis_after_content_sidebar_wrap', 'get_sidebar_location' );
}
elseif ( is_page('helpful-links') ) {
add_action( 'genesis_after_content_sidebar_wrap', 'get_sidebar_helpful' );
}
elseif ( is_page('contact') ) {
add_action( 'genesis_after_content_sidebar_wrap', 'get_sidebar_contact' );
}
elseif ( is_page(array('patient-information','emergencies','insurance-information','patient-care','patient-forms','your-first-visit')) ) {
add_action( 'genesis_after_content_sidebar_wrap', 'get_sidebar_sub' );
}

}

function get_sidebar_about() {
echo '<div class="table-why">';
genesis_before_sidebar_widget_area();
dynamic_sidebar( 'about-sidebar' );
genesis_after_sidebar_widget_area();
echo '</div>';
}


function get_sidebar_patient() {
echo '<div class="table-why">';
genesis_before_sidebar_widget_area();
dynamic_sidebar( 'patient-sidebar' );
genesis_after_sidebar_widget_area();
echo '</div>';
}


function get_sidebar_location() {
echo '<div class="table-why">';
genesis_before_sidebar_widget_area();
dynamic_sidebar( 'locations-sidebar' );
genesis_after_sidebar_widget_area();
echo '</div>';
}


function get_sidebar_helpful() {
echo '<div class="table-why">';
genesis_before_sidebar_widget_area();
dynamic_sidebar( 'helpful-sidebar' );
genesis_after_sidebar_widget_area();
echo '</div>';
}


function get_sidebar_contact() {
echo '<div class="table-why">';
genesis_before_sidebar_widget_area();
dynamic_sidebar( 'contact-sidebar' );
genesis_after_sidebar_widget_area();
echo '</div>';
}

function get_sidebar_sub() {
echo '<div class="table-why">';
genesis_before_sidebar_widget_area();
dynamic_sidebar( 'sub-sidebar' );
genesis_after_sidebar_widget_area();
echo '</div>';
}

function get_sidebar_sub_about() {
echo '<div class="table-why">';
genesis_before_sidebar_widget_area();
dynamic_sidebar( 'sub-about-sidebar' );
genesis_after_sidebar_widget_area();
echo '</div>';
}


genesis();
?>