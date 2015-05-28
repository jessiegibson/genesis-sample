<?php

/**
 * Template Name: single servicearea page
 * Description: Used as a page template to show page contents, followed by a loop through a CPT archive  
 */

remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop
add_action( 'genesis_loop', 'serviceAreaLoop' ); // Add custom loop

add_action ('genesis_entry_content', 'service_area_custom_fields');

$image = wp_get_attachment_image_src(get_field('service_area_featured_image'), 'thumbnail'); ?>

 <?php $loop = new WP_Query( $args ); 
	if( $loop->have_posts() ): while( $loop->have_posts() ): $loop->the_post(); ?>
                <div class="main-post-div">
                <div class="single-page-post-heading">
                <h1><?php the_title(); ?></h1>
                </div>
                <div class="content-here">
                <?php  the_content();  ?>
                </div>
              
              
                </div>

            <?php endwhile; ?>

	
}
	
/** Remove Post Info */
remove_action('genesis_before_post_content','genesis_post_info');
remove_action('genesis_after_post_content','genesis_post_meta');
 
genesis();