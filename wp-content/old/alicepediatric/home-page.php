<?php

// GENESIS HOMEPAGE TEMPLATE //


// FORCE FULL WIDTH LAYOUT
add_filter ( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );


// Homepage CUSTOM LOOP
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'my_custom_loop' );
function my_custom_loop () {
?>
 <div id="slider"><?php putRevSlider("main") ?></div> 
 <div id="main_container">
 	<div id="boxes">
<img src="/images/boxes.png">
 	</div>
 <div id="single-post" class="entry-content">

  
  </div> <!-- end single post -->
 </div> <!-- end main container -->
<?php } ?>


<?php genesis(); ?>