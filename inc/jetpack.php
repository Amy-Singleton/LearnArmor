<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package learnarmor
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function learnarmor_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'learnarmor_infinite_scroll_render',
		'footer'    => 'page',
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Content Options.
	add_theme_support( 'jetpack-content-options', array(
		'post-details' => array(
			'stylesheet' => 'learnarmor-style',
			'date'       => '.posted-on',
			'categories' => '.cat-links',
			'tags'       => '.tags-links',
			'author'     => '.byline',
			'comment'    => '.comments-link',
		),
	) );
}
add_action( 'after_setup_theme', 'learnarmor_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function learnarmor_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
}

function learnarmor_jetpackme_exclude_related_post( $exclude_post_ids, $post_id ) {
    // $post_id is the post we are currently getting related posts for
    $exclude_post_ids[] = 139; // Exclude post_id 1037
    //$exclude_post_ids[] = 1038; // Also exclude post_id 1038
    return $exclude_post_ids;
}
add_filter( 'jetpack_relatedposts_filter_exclude_post_ids', 'learnarmor_jetpackme_exclude_related_post', 20, 2 );
function learnarmor_jetpack_add_pages_to_related( $post_type, $post_id ) {
    if ( is_array( $post_type ) ) {
        $search_types = $post_type;
    } else {
        $search_types = array( $post_type );
    }
 
    // Add pages
    $search_types[] = 'products';
    return $search_types;
}
add_filter( 'jetpack_relatedposts_filter_post_type', 'learnarmor_jetpack_add_pages_to_related', 10, 2 );
function learnarmor_allow_learndash_post_types($allowed_post_types) {
    $allowed_post_types[] = array('sfwd-courses','post');
    return $allowed_post_types;
}
add_filter( 'rest_api_allowed_post_types', 'learnarmor_allow_learndash_post_types' );