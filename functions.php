<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis Sample Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.0-locksmith' );

//* DEFINE THE WEBSITE CONSTANTS
define( 'PHONE_NUMBER', '(702) 240-3380' );
define( 'PHONE_NUMBER', '(702) 802-9114' );

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
add_action( 'genesis_header', 'genesis_cta_before_navigation' );

function genesis_cta_before_navigation(){
    echo '<div class="row">';
    echo '<div class="cta-one-half">';
    echo '<div class="cta-one-number"><span class="city-one">Las Vegas</span><br /><span class="phone-number contact-number-one> <a href="tel:7022403380" onmousedown="_gaq.push([\'_trackEvent\',\'Mobile\' \'Click to Call\'])">' . PHONE_NUMBER . '</a></span></div>';
    echo '</div>';
    echo '<div class="cta-one-half">';
    echo '<div class="cta-two-number"><span class="city-two">Henderson</span><br /><span class="phone-number contact-number-two"><a href="tel:5162004224" onmousedown="_gaq.push([\'_trackEvent\', \'Mobile\', \'Click to Call\'])">(702) xxx-xxxx</a></span></div>';
    echo '</div></div>';   
}

// Removes the Title From the Home Page of the Site.
add_action( 'get_header', 'remove_titles_home_page' );
function remove_titles_home_page() {
    if ( is_home() ) {
        remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
    }
}