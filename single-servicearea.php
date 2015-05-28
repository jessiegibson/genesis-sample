<?php

/**
 * Template Name: single servicearea page
 * Description: Used as a page template to show page contents, followed by a loop through a CPT archive  
 */

remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop
add_action( 'genesis_loop', 'serviceAreaLoop' ); // Add custom loop

add_action ('genesis_entry_content', 'service_area_custom_fields');

$image = wp_get_attachment_image_src(get_field('service_area_featured_image'), 'thumbnail');

 function serviceAreaLoop() {
		$args = array(
		'post_type' => 'service_area',
		 // enter your custom post type
	);

	$loop = new WP_Query( $args ); 
	if( have_posts() ): while( have_posts() ): the_post(); ?>

	<h1><?php echo get_the_title(); ?></h1>
	<img src="<?php echo $image; ?>">		
			
            
			echo '<section>';
			echo '<div class="one-third area-entry">';
			echo '<h1 class="service-area-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a>' . '</h1>';
			echo '<div class="sevice-area">';
			echo '<img src="' . $image[0] . '"' . 'alt="' . get_the_title(get_field('service_area_featured_image')) . '">'; 
			echo '</div>';	
			echo '<p class="service-area-more"><a href="' . get_permalink() . '">Get Service</a></p>';
			echo '</div></section>';

			endwhile;
				
			endif;
	
	// Outro Text (hard coded)
	echo '</div><!-- END of the Service Wrapper';
	echo '</div><!-- end .page .hentry .entry -->';
}
	
/** Remove Post Info */
remove_action('genesis_before_post_content','genesis_post_info');
remove_action('genesis_after_post_content','genesis_post_meta');
 
genesis();