<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis Sample Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.1.2' );


add_theme_support( 'genesis-structural-wraps', array( 'header', 'nav', 'subnav', 'inner','contenedor','footer-widgets', 'footer' ) );

//* Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'genesis_sample_google_fonts' );
function genesis_sample_google_fonts() {

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700', array(), CHILD_THEME_VERSION );

}
add_theme_support( 'html5' );


unregister_sidebar( 'sidebar' );
unregister_sidebar( 'sidebar-alt' );

//remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//THIRD MENU
function register_additional_menu() {
  
register_nav_menu( 'third-menu' ,__( 'Third Navigation Menu' ));
     
}
add_action( 'init', 'register_additional_menu' );

add_action( 'genesis_after_header', 'add_third_nav_genesis' ); 

function add_third_nav_genesis() {
echo'<div class="nav-third">';
wp_nav_menu( array( 'theme_location' => 'third-menu', 'container_class' => 'genesis-nav-menu' ) );
echo'</div>';
}

//* Remove the default header
remove_action( 'genesis_header', 'genesis_do_header' );

//* Add Primary Nav in custom header
add_action( 'genesis_header', 'genesis_do_nav' );

//* Add Site Title in custom header
add_action( 'genesis_header', 'sk_do_header' );
function sk_do_header() {

	do_action( 'genesis_site_title' );
	// do_action( 'genesis_site_description' );

}

//* Add Secondary Nav in custom header
add_action( 'genesis_header', 'genesis_do_subnav' );

//* Remove Primary and Secondary Nav from below header
remove_action( 'genesis_after_header', 'genesis_do_nav' );
remove_action( 'genesis_after_header', 'genesis_do_subnav' );





//Add slider to Front Page

function rev_slider() {
if(is_front_page() ) {
if (function_exists( 'rev_slider')) 
 echo putRevSlider("main");
}
}




//* Show custom menu in Footer *//
add_action( 'genesis_footer', 'menu_in_footer' );
function menu_in_footer() {

	$class = 'menu-footer';

	$args = array(
		'menu'           => 'Footer', // Enter name of your custom menu here
		'container'      => '',
		'menu_class'     => $class,
		'echo'           => 0,
		'depth'           => 1,
	);

	$nav = wp_nav_menu( $args );

	$nav_markup_open = genesis_markup( array(
		'html5'   => '<nav %s>',
		'xhtml'   => '<div id="nav">',
		'context' => 'nav-footer',
		'echo'    => false,
	) );
	$nav_markup_open .= genesis_structural_wrap( 'menu-footer', 'open', 0 );

	$nav_markup_close  = genesis_structural_wrap( 'menu-footer', 'close', 0 );
	$nav_markup_close .= genesis_html5() ? '</nav>' : '</div>';

	$nav_output = $nav_markup_open . $nav . $nav_markup_close;

	echo $nav_output;

}

remove_action( 'genesis_footer', 'genesis_do_footer' );
//* Customize the credits
add_action( 'genesis_footer', 'footer_credits_text' );
function footer_credits_text() {
	echo '<div class="copyr"><p>';
	echo '<a href="http://alicepediatric.com">Copyright &copy;2015 Alice Pediatric Clinic LLC.</a>';
	echo '</p></div>';
}


function child_conditional_actions() {
    if( is_archive() && 'post_type' == get_post_type() ) {
        //put your actions here
        remove_action( 'genesis_post_content', 'genesis_do_post_content' );
        remove_action( 'genesis_post_content', 'genesis_do_post_image' );
        add_action( 'genesis_post_content', 'the_content' );
 
    }
 
}

//custom  loop home page

//remove_action( 'genesis_loop', 'genesis_do_loop' );
//add_action( 'genesis_loop', 'custom_loop' );

//function custom_loop() {
//global $paged;
//
//	 $args = ( array(
//		
//		'category_name'  => 'news',
//		'order'          => 'asc',
//		'order_by'       => 'title',
//	 	'paged'          => $paged,
//	 	'posts_per_page' => 1
//	 
//	) );

//genesis_custom_loop( $args );


remove_action( 'genesis_after_post_content', 'genesis_post_meta' );



// Remove post date in entry header 

add_filter( 'genesis_post_info', 'post_info_filter' );
function post_info_filter($post_info) {
    $post_info = '[post_edit]';
	return $post_info;
}

add_filter( 'genesis_post_meta', 'sp_post_meta_filter' );
function sp_post_meta_filter($post_meta) {
if ( !is_page() ) {
	$post_meta = '';
	return $post_meta;
}}


// Edit the read more link text
add_filter( 'excerpt_more', 'custom_read_more_link');
add_filter('get_the_content_more_link', 'custom_read_more_link');
add_filter('the_content_more_link', 'custom_read_more_link');
function custom_read_more_link() {
return '&nbsp;<a href="' . get_permalink() . '" rel="nofollow"><br/><br/><br/><b id="more-link">Learn More &#9656;</b></a>';

}





//genesis_register_sidebar( array(
  //  'id'        => 'before-posts-sidebar',
   // 'name'      => 'Before Posts',
   // 'description'   => 'post',
//) );



//* Register before header widget area
//genesis_register_sidebar( array(
//	'id'          => 'before-header',
//	'name'        => __( 'Before Header', 'theme-name' ),
//	'description' => __( 'This is the before header widget area.', 'theme-name' ),
// ) );

//add_action( 'genesis_before_header', 'bg_before_header_widget_area' );
//function bg_before_header_widget_area() {
//	genesis_widget_area( 'before-header', array(
//		'before' => '<div class="before-header widget-area"><div class="wrap">',
//		'after'  => '</div></div>',
//	) );

//}

//EXCERPT


add_post_type_support('page', 'excerpt');
add_action ( 'genesis_entry_header', 'alice_show_excerpt' );
function alice_show_excerpt() {

	$post = get_post( get_the_ID() );
	$the_excerpt = $post->post_excerpt;
	if ( !is_page() || empty( $the_excerpt ) )
		return;
	echo $the_excerpt;

}




//////////

//* Remove 'You are here' from the front of breadcrumb trail
add_filter( 'genesis_breadcrumb_args', 'b3m_prefix_breadcrumb' );
function b3m_prefix_breadcrumb( $args ) {

  $args['labels']['prefix'] = '';
  return $args;

}


function themeprefix_scripts_styles() { 
 wp_enqueue_script ('slicknav', get_stylesheet_directory_uri() . '/js/jquery.slicknav.min.js', array( 'jquery' ),'1',false); wp_enqueue_style ('slicknavcss', get_stylesheet_directory_uri() . '/css/slicknav.css','', '1', 'all'); 
}
add_action( 'wp_enqueue_scripts', 'themeprefix_scripts_styles');


//Responsive Nav
function themeprefix_responsive_menujs() {
	echo 	"<script>
			jQuery(function($) {
			$('#menu-responsive').slicknav();
			});
			</script>";
}
add_action ('genesis_after','themeprefix_responsive_menujs');


remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_after_header', 'genesis_do_breadcrumbs' );


add_filter( 'genesis_breadcrumb_args', 'child_breadcrumb_args' );
function child_breadcrumb_args( $args ) {
global $post;
$args['home'] = 'Home';
$args['sep'] = ' > ';
$args['list_sep'] = ', ';

$args['prefix'] = '<div class="banda"><div class="site-inner"><p class="page-title">' . get_the_title($post->ID) . '<div class="breadcrumb">';
$args['suffix'] = '</div></p></div></div>';
$args['heirarchial_attachments'] = true;
$args['heirarchial_categories'] = true;
$args['display'] = true;
$args['labels']['prefix'] = ''; // Chance this to your own text
return $args;
}





// call us and appointment before header

add_action ( 'genesis_before_header', 'call_us' );
function call_us() {
	echo '<div class="callus">';
	echo '<p>CALL US: 361 - 664 - 9353</p>';
	echo '<p><a href="https://instant-scheduling.com/sch.php?kn=1394483">SCHEDULE AN APPOINTMENT &#9656;</a></p>';
	echo '</div>';
}





// Registering new sidebar
genesis_register_sidebar( array(
'id'            => 'about-sidebar',
'name'            => __( 'About Us Page Sidebar'),
'description'    => __( 'This is the about us page sidebar section.' ),
) );
genesis_register_sidebar( array(
'id'            => 'patient-sidebar',
'name'            => __( 'Patient Page Sidebar'),
'description'    => __( 'This is the patient page sidebar section.' ),
) );
genesis_register_sidebar( array(
'id'            => 'locations-sidebar',
'name'            => __( 'Locations Page Sidebar'),
'description'    => __( 'This is the locations page sidebar section.' ),
) );
genesis_register_sidebar( array(
'id'            => 'helpful-sidebar',
'name'            => __( 'Helpful Page Sidebar'),
'description'    => __( 'This is the helpful links page sidebar section.' ),
) );
genesis_register_sidebar( array(
'id'            => 'contact-sidebar',
'name'            => __( 'Contact Page Sidebar'),
'description'    => __( 'This is the contact page sidebar section.' ),
) );
genesis_register_sidebar( array(
'id'            => 'home-sidebar',
'name'            => __( 'Home Page Sidebar'),
'description'    => __( 'This is the Home page sidebar section.' ),
) );
genesis_register_sidebar( array(
'id'            => 'sub-sidebar',
'name'            => __( 'Sub Page Sidebar'),
'description'    => __( 'This is the sub page sidebar section.' ),
) );
genesis_register_sidebar( array(
'id'            => 'sub-about-sidebar',
'name'            => __( 'Sub Page 2 Sidebar'),
'description'    => __( 'This is the subs About us sidebar section.' ),
) );


