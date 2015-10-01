<?php

/**
* Template Name: Homepage pediatric ok
*/


add_action( 'genesis_before_content_sidebar_wrap', 'rev_slider' );
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );

//add_action( 'genesis_before', 'child_conditional_actions' );




//genesis_markup( array(
//	'html5'   => '<aside %s>',
//	'xhtml'   => '<div id="sidebar" class="sidebar widget-area">',
//	'context' => 'sidebar-primary',
//) );

//do_action( 'genesis_before_sidebar_widget_area' );
//do_action( 'genesis_sidebar' );
//do_action( 'genesis_after_sidebar_widget_area' );

//remove_action( 'genesis_after_content', 'genesis_sidebar' );
//add_action( 'genesis_after_content', 'genesis_sidebar' );



//genesis_markup( array(
//	'html5' => '</aside>', //* end .sidebar-primary
//	'xhtml' => '</div>', //* end #sidebar
//) );




//add_action( 'genesis_before_loop', 'child_before_posts_sidebar' );
/** Loads a new sidebar before the posts in the #content */
//function child_before_posts_sidebar() {
 
  //  echo '<div class="table-why one-half">';
    //    dynamic_sidebar( 'before-posts-sidebar' );
    //echo '</div>';
    
 
//}


?>



<? add_action( 'genesis_before_content', 'homepge_content' );
function homepge_content() { ?>
<div class="contenedor">
<div id="bpr" class="box col-md-3 purple">
<h3>Meet the Doctors</h3>
<a href="http://www.alicepediatric.com/about-us/meet-the-doctors/"><p>Our physicians are board certified in Pediatrics and our Nurse Practitioners holds a Masters Degree in Nursing. </p></a>
</div>

<div id="bgr" class="box col-md-3 green">
<h3>New Patient Info.</h3>
<a href="http://www.alicepediatric.com/patient-information/">
<p>Anything you would need regarding your child’s care we are able to quickly and efficiently access those for you and print what you need, usually while you wait. </p></a>
</div>

<div id="byl" class="box col-md-3 yellow">
<h3>Helpful Links</h3>
<a href="http://www.alicepediatric.com/helpful-links/"><p>Click here for a listing of helpful links</p></a>
</div>

<div id="bpk" class="box col-md-3 pink">
<h3>Our Location</h3>
<a href="http://www.alicepediatric.com/locations/">
<p>305 E 3rd St. Alice, TX<br>
Mon through Fri from 8:00 am to 5:00 pm and Sat from 8:30 am to 11:30 am</p></a>
</div>
</div>
<?}?>





<?
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'custom_loop' );

function custom_loop() {

	 $args = ( array(
		'category_name'  => 'news',
		'order'          => 'asc',
		'order_by'       => 'post_date',
	 	'posts_per_page' => 1
	) );

$loop = new WP_Query( $args );
	
	if( $loop->have_posts() ) {

		// loop through posts
		while( $loop->have_posts() ): $loop->the_post();
        echo '<h1 id="entry-title">' . get_the_title() . '</h1>';
        echo the_excerpt();
        endwhile;
    }


}




// Remove entry meta
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );


remove_action( 'genesis_after_content', 'genesis_get_sidebar' );
add_action( 'genesis_after_content_sidebar_wrap', 'get_sidebar_home' );
function get_sidebar_home() {
echo '<div class="table-why">';
genesis_before_sidebar_widget_area();
dynamic_sidebar( 'home-sidebar' );
genesis_after_sidebar_widget_area();
echo '</div>';
}





?>



<?
genesis();