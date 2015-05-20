<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis Sample Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.2.0-beta' );

//* Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'genesis_sample_google_fonts' );

function genesis_sample_google_fonts() {
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700', array(), CHILD_THEME_VERSION );
}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add Accessibility support
add_theme_support( 'genesis-accessibility', array( 'drop-down-menu',  'search-form', 'skip-links' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Add an additional featured image size/
add_image_size( 'featured-image', 1024, 576, TRUE );

/* Code to Display Featured Image on top of the post */
add_action( 'genesis_before_entry', 'featured_post_image', 8 );
function featured_post_image() {
  if ( ! is_singular( 'page' ) )  
      return;
	the_post_thumbnail('featured-image');
}


// Remove Genesis Blog & Archive
function genesis_remove_blog_archive( $templates ) {
	unset( $templates['page_blog.php'] );
	unset( $templates['page_archive.php'] );
	return $templates;
}
 
//* Adds the Call-to-Action Phone Numbers to the Header

add_action( 'genesis_before', 'genesis_cta_before_navigation' );
=======
add_action( 'genesis_header', 'genesis_cta_before_navigation' );

function genesis_cta_before_navigation(){
    echo '<div class="row">';
    echo '<div class="cta-one-half">';
    echo '<div class="nyc-contact-number"><span class="new-york">Five Boroughs</span><br /><span class="phone-number new-york"> <a href="tel:6467565386" onmousedown="_gaq.push([\'_trackEvent\',\'Mobile\' \'Click to Call\'])">(646) 756-5386</a></span></div>';
    echo '</div>';
    echo '<div class="cta-one-half">';
    echo '<div class="long-island-number"><span class="long-island">Long Island</span><br /><span class="phone-number long-island"><a href="tel:5162004224" onmousedown="_gaq.push([\'_trackEvent\', \'Mobile\', \'Click to Call\'])">(516) 200-4224</a></span></div>';
    echo '</div></div>';   
}
