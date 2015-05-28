<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis Sample Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.0-locksmith' );

//* DEFINE THE WEBSITE CONSTANTS
define( 'PHONE_NUMBER', '(702) 240-3380' );
define( 'PHONE_NUMBER_TWO', '(702) 802-9114' );

//* Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'genesis_sample_google_fonts' );

function genesis_sample_google_fonts() {
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700', array(), CHILD_THEME_VERSION );
}

add_theme_support( 'genesis-structural-wraps', array( 'header', 'nav', 'subnav', 'inner', 'footer-widgets', 'footer' ) );

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
add_action( 'genesis_header_right', 'genesis_cta_before_navigation' );

function genesis_cta_before_navigation(){
    echo '<div class="row">';
    echo '<div class="cta-one-half">';
    echo '<div class="cta-one-number"><span class="city-one">Las Vegas</span><br /><span class="phone-number contact-number-one> <a href="tel:7022403380" onmousedown="_gaq.push([\'_trackEvent\',\'Mobile\' \'Click to Call\'])">' . PHONE_NUMBER . '</a></span></div>';
    echo '</div>';
    echo '</div>';   
}

// Removes the Title From the Home Page of the Site.
if ( is_front_page () ){
    remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
}


// ADDING CUSTOM POST TYPE - SERVICE AREAS
add_action( 'init', 'vegas_locksmith_custom_post_type' );
function vegas_locksmith_custom_post_type() {
    $labels = array(
        "name" => "Service Areas",
        "singular_name" => "Service Area",
        );

    $args = array(
        "labels" => $labels,
        "description" => "Service Areas",
        "public" => true,
        "show_ui" => true,
        "has_archive" => true,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "servicearea", "with_front" => true ),
        "query_var" => true,
                        "supports" => array( "title", "editor", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "thumbnail", "author", "page-attributes", "post-formats" ), "taxonomies" => array( "category", "post_tag" ) );
    register_post_type( "service_area", $args );

   
// End of vegas_locksmith_custom_post_type()
}

add_filter( 'genesis_superfish_enabled', '__return_true' );

/* UPDATING THE CREDITS */

add_filter('genesis_footer_creds_text', 'vegas_footer_creds_filter');
function vegas_footer_creds_filter( $editthecredit ) {
$editthecredit = '&copy; 2015 <a href="http://lasvegaslocksmith365.com">Las Vegas Locksmith 365</a>&nbsp;&middot;&nbsp;All Rights Reserved.&nbsp;';
return $editthecredit ;
}
//*Please refer to the original post at my blog for full explaination of this snippet and other cheats

function service_area_custom_fields(){
    $serviceTitle = get_field('service_address_title');
    $serviceAreaImage = get_field('service_area_featured_image');
    $address = get_field('address');
    $phoneNumber = get_field('phone_number');
    $services = get_field('services');
    $daysOpen = get_field('days');
    $hoursOfOperation = get_field('hours_of_operation');
    $serviceDescription = get_field('service_area_description');

    if ( $serviceTitle || $serviceAreaImage || $address || $phoneNumber || $services || $daysOpen || $hoursOfOperation || $serviceDescription ) {
        if ($serviceTitle) {
            echo '<h1>' . $serviceTitle . '</h1>';
        }
        if ($serviceAreaImage) {
            echo '<img src="' . $serviceAreaImage . '">';
        }
        if ($address){
            echo '<address>' . $address . '</address>';
        }
        if ($phoneNumber){
            echo '<a href="tel:' . $phoneNumber . '">' . $phoneNumber . '</a>';
        }
        if ($services){
            echo '<ul>';
            echo '<li>' . $services . '</li>';
            echo '</ul>';
        }
        if ($daysOpen){
            echo '<ul>';
            echo '<li>' . $daysOpen . '</li>';
            echo '</ul>';
        }
        if ($hoursOfOperation){
            echo '<ul>';
            echo '<li>' . $daysOpen . '</li>';
            echo '</ul>';
        }
        if ($serviceDescription){
            echo '<p>';
            echo $daysOpen;
            echo '</p>';
        }
    }
}


/* 
*
*   Adding the Facebook Page Like to Thirsty
*/
// add_action('genesis_before','thirsty_facebook_like');

// function thirsty_facebook_like() {
//     echo '<div id="fb-root"></div>
//                 <script>(function(d, s, id) {
//                     var js, fjs = d.getElementsByTagName(s)[0];
//                     if (d.getElementById(id)) return;
//                     js = d.createElement(s); js.id = id;
//                     js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=250119945179409";
//                     fjs.parentNode.insertBefore(js, fjs);
//                     }(document, \'script\', \'facebook-jssdk\'));
//                 </script>';
// }

// // Inserting the FB Page Like Box after the content of each page.
// function thirsty_fb_after_content(){
//     echo '<div class="fb-page"> 
//             <span class="fb-like-text"><span>Like Thirsty on </span><span class="blue-text">Facebook</span></span><li class="fb-like">
//             <div
//             class="fb-like"
//             width="48"
//             data-href="https://www.facebook.com/thirstynyc" 
//             data-layout="button_count"
//             data-width="255" 
//             data-action="like"
//             data-show-facepile="true" 
//             data-show-posts="false"
//             data-share="false">
//             <div class="fb-xfbml-parse-ignore">
//             </div>
//             </li>
//             </ul>';
// }

// add_action('genesis_after_loop','thirsty_fb_after_content');









