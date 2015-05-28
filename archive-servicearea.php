<?php

/**
 * Template Name: Service Area Archives
 * Description: Used as a page template to show page contents, followed by a loop through a CPT archive  
 */

remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop
add_action( 'genesis_loop', 'custom_do_grid_loop' ); // Add custom loop

function custom_do_grid_loop() {  
  	
	// Intro Text (from page content)
	echo '<div class="page hentry entry">';
	echo '<h1 class="area-title">'. get_the_title() .'</h1>';
	echo '<div class="entry-content">' . get_the_excerpt()  . '</div><!-- end .entry-content -->';
	echo '<div class="service-area-wrapper">';
	echo '<section>';

	$args = array(
		'post_type' => 'service_area',
		'sort' => 'ASC',
		 // enter your custom post type
	);
	$loop = new WP_Query( $args ); if( $loop->have_posts() ): while( $loop->have_posts() ): $loop->the_post(); global $post;
			
			// ENTER THE LOOP HERE
			
			$image = wp_get_attachment_image_src(get_field('service_area_featured_image'), 'thumbnail');
            
			
			echo '<div class="one-third area-entry">';
			echo '<h1 class="service-area-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a>' . '</h1>';
			echo '<div class="sevice-area">';
			echo '<img src="' . $image[0] . '"' . 'alt="' . get_the_title(get_field('service_area_featured_image')) . '">'; 
			echo '</div>';	
			echo '<p class="service-area-more"><a href="' . get_permalink() . '">Get Service</a></p>';
			echo '</div>';

			endwhile;
				
			endif;
	
	// Outro Text (hard coded)
	echo '</section>';
	echo '</div><!-- END of the Service Wrapper';
	echo '</div><!-- end .page .hentry .entry -->';
}
	
/** Remove Post Info */
remove_action('genesis_before_post_content','genesis_post_info');
remove_action('genesis_after_post_content','genesis_post_meta');
 
genesis();