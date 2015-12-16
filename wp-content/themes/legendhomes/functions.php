<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (function_exists( 'add_theme_support' ) ) {
    // Add Menu Support
    add_theme_support( 'menus' );

    // Add Thumbnail Theme Support
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'large', 700, '', true); // Large Thumbnail
    add_image_size( 'medium', 250, '', true); // Medium Thumbnail
    add_image_size( 'small', 120, '', true); // Small Thumbnail

    // Localisation Support
    load_theme_textdomain( 'html5blank', get_template_directory() . '/languages' );
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// Main Navigation
function edgemm_main_nav() {
	wp_nav_menu(
		array(
			'theme_location'  => 'header-menu',
			'menu'            => '',
			'container'       => 'div',
			'container_class' => 'menu-{menu slug}-container',
			'container_id'    => '',
			'menu_class'      => 'menu',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul class="menu">%3$s</ul>',
			'depth'           => 0,
			'walker'          => ''
		)
	);
}

// Load site scripts (header)
function edgemm_scripts() {
    if ( $GLOBALS['pagenow'] != 'wp-login.php' && !is_admin() ) {

        wp_register_script( 'edgemm-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '1.0.0' );
        wp_enqueue_script( 'edgemm-scripts' );
    }
}

// Load site styles
function edgemm_styles() {

    wp_register_style( 'edgemm-styles', get_template_directory_uri() . '/style.css', array(), '1.0', 'all' );
    wp_enqueue_style( 'edgemm-styles' );

}

// Load site admin styles
function edgemm_admin_styles() {

    wp_register_style( 'edgemm-admin-styles', get_template_directory_uri() . '/css/admin/admin-styles.css', array(), '1.0', 'all' );
    wp_enqueue_style( 'edgemm-admin-styles' );

}

// load scripts for home listings admin pages
function edgemm_scripts_homes() {

	global $post_type;

	if ( $_GET[ 'post_type' ] == 'homes' || $post_type == 'homes' ) :

		wp_register_script( 'admin-homes', get_template_directory_uri() . '/js/admin/admin-homes.js', array( 'jquery' ), '1.0', true );
        wp_enqueue_script( 'admin-homes' ); // Enqueue it!

	endif;

}

// Register HTML5 Blank Navigation
function edgemm_register_menu() {
    register_nav_menus( array( // Using array to specify more menus if needed
        'header-menu' => __( 'Header Menu', 'html5blank' ), // Main Navigation
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args( $args = '' ) {
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter( $var ) {
    return is_array( $var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list( $thelist ) {
    return str_replace( 'rel="category tag"', 'rel="tag"', $thelist );
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class( $classes ) {
    global $post;
    if (is_home() ) {
        $key = array_search( 'blog', $classes );
        if ( $key > -1) {
            unset( $classes[$key] );
        }
    } elseif (is_page() ) {
        $classes[] = sanitize_html_class( $post->post_name );
    } elseif (is_singular() ) {
        $classes[] = sanitize_html_class( $post->post_name );
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if ( function_exists( 'register_sidebar' ) )
{
    // Define Main Sidebar Widget Area
    register_sidebar( array(
        'name' => __( 'Main Sidebar', 'html5blank' ),
        'description' => __( '', 'html5blank' ),
        'id' => 'widget-main-sidebar',
        'before_widget' => '<div id="%1$s" class="%2$s text-center">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="sidebar-widgit-header">',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action( 'wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination() {
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace( $big, '%#%', get_pagenum_link( $big) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var( 'paged' ) ),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function edgemm_index( $length ) { // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt( 'html5wp_index' );
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt( 'html5wp_custom_post' );
function edgemm_custom_post( $length ) {

    return 40;
}

// Create the Custom Excerpts callback
function edgemm_excerpt( $length_callback = '', $more_callback = '' ) {
    global $post;
    if (function_exists( $length_callback) ) {
        add_filter( 'excerpt_length', $length_callback );
    }
    if (function_exists( $more_callback) ) {
        add_filter( 'excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters( 'wptexturize', $output );
    $output = apply_filters( 'convert_chars', $output );
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function edgemm_view_article( $more ) {
    global $post;
    return '... <a class="view-article" href="' . get_permalink( $post->ID) . '">' . __( 'View Article', 'html5blank' ) . '</a>';
}

// Remove Admin bar
function remove_admin_bar() {
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function edgemm_style_remove( $tag ) {
    return preg_replace( '~\s+type=["\'][^"\']++["\']~', '', $tag );
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

// Custom Gravatar in Settings > Discussion
function blankgravatar ( $avatar_defaults ) {
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action( 'init', 'edgemm_scripts' ); // Add Custom Scripts to wp_head
add_action( 'wp_enqueue_scripts', 'edgemm_styles' ); // Add Theme Stylesheet
add_action( 'admin_enqueue_scripts', 'edgemm_admin_styles' ); // Add admin stylesheet
add_action( 'admin_enqueue_scripts', 'edgemm_scripts_homes' ); // Add scripts for admin view of custom post type 'homes'
add_action( 'init', 'edgemm_register_menu' ); // Add HTML5 Blank Menu
add_action( 'init', 'create_post_types' ); // Add Custom Post Types
add_action( 'init', 'create_taxonomies' ); // Add Custom Taxonomy
add_action( 'add_meta_boxes_homes', 'add_events_metaboxes' ); // add meta boxes for custom post type 'homes'
add_action( 'neighborhood_add_form_fields', 'add_neighborhood_meta' ); // add meta boxes for neighborhood taxonomy
add_action( 'created_neighborhood', 'save_neighborhood_meta' ); // save term meta for neighborhood taxonomy
add_action( 'neighborhood_edit_form_fields', 'edit_neighborhood_meta' ); // edit term meta for neighborhood taxonomy
add_action( 'edited_neighborhood', 'update_neighborhood_meta' ); // update term meta for neighborhood taxonomy
add_action( 'restrict_manage_posts', 'cpt_filter_plans_homes' ); // add custom taxonomy filters to custom post types 'plans' and 'homes'
add_action('wp_ajax_pull_plan_data', 'pull_plan_data'); // pull plan data for home listings
add_action('wp_ajax_nopriv_pull_plan_data', 'pull_plan_data'); // pull plan data for home listings
add_action( 'widgets_init', 'my_remove_recent_comments_style' ); // Remove inline Recent Comment Styles from wp_head()
add_action( 'init', 'html5wp_pagination' ); // Add our HTML5 Pagination

// Remove Actions
remove_action( 'wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // Index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter( 'avatar_defaults', 'html5blankgravatar' ); // Custom Gravatar in Settings > Discussion
add_filter( 'body_class', 'add_slug_to_body_class' ); // Add slug to body class (Starkers build)
add_filter( 'widget_text', 'do_shortcode' ); // Allow shortcodes in Dynamic Sidebar
add_filter( 'widget_text', 'shortcode_unautop' ); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' ); // Remove surrounding <div> from WP Navigation
add_filter( 'nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
add_filter( 'nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
add_filter( 'page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter( 'the_category', 'remove_category_rel_from_category_list' ); // Remove invalid rel attribute
add_filter( 'the_excerpt', 'shortcode_unautop' ); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter( 'the_excerpt', 'do_shortcode' ); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter( 'excerpt_more', 'edgemm_view_article' ); // Add 'View Article' button instead of [...] for Excerpts
//add_filter( 'show_admin_bar', 'remove_admin_bar' ); // Remove Admin bar
add_filter( 'style_loader_tag', 'edgemm_style_remove' ); // Remove 'text/css' from enqueued stylesheet
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter( 'the_excerpt', 'wpautop' ); // Remove <p> tags from Excerpt altogether


/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

function create_post_types() {

	// home listings
	$labels_homes = array(
		'name'                  => 'Home Listings',
		'singular_name'         => 'Home Listing',
		'menu_name'             => 'Home Listings',
		'name_admin_bar'        => 'Home Listing',
		'archives'              => 'Home Listing Archives',
		'all_items'             => 'All Home Listings',
		'add_new_item'          => 'Add New Home Listing',
		'add_new'               => 'Add New Home Listing',
		'new_item'              => 'New Home Listing',
		'edit_item'             => 'Edit Home Listing',
		'update_item'           => 'Update Home Listing',
		'view_item'             => 'View Home Listing',
		'search_items'          => 'Search Home Listings',
		'not_found'             => 'Not found',
		'not_found_in_trash'    => 'Not found in Trash',
		'featured_image'        => 'Listing Image',
		'set_featured_image'    => 'Set listing image',
		'remove_featured_image' => 'Remove listing image',
		'use_featured_image'    => 'Use as listing image',
		'insert_into_item'      => 'Insert into listing',
		'uploaded_to_this_item' => 'Uploaded to this listing',
		'items_list'            => 'Home Listings list',
		'items_list_navigation' => 'Home Listings list navigation',
		'filter_items_list'     => 'Filter Home Listings list',
	);
	$args_homes = array(
		'label'                 => 'Home Listings',
		'description'           => 'Home Listings',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-hammer',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'exclude_from_search'   => false,
		'capability_type'       => 'post',
	);	
	register_post_type( 'homes', $args_homes );

	// home listings
	$labels_plans = array(
		'name'                  => 'Home Plans',
		'singular_name'         => 'Home Plan',
		'menu_name'             => 'Home Plans',
		'name_admin_bar'        => 'Home Plan',
		'archives'              => 'Home Plan Archives',
		'all_items'             => 'All Home Plans',
		'add_new_item'          => 'Add New Home Plan',
		'add_new'               => 'Add New Home Plan',
		'new_item'              => 'New Home Plan',
		'edit_item'             => 'Edit Home Plan',
		'update_item'           => 'Update Home Plan',
		'view_item'             => 'View Home Plan',
		'search_items'          => 'Search Home Plans',
		'not_found'             => 'Not found',
		'not_found_in_trash'    => 'Not found in Trash',
		'items_list'            => 'Home Plans list',
		'items_list_navigation' => 'Home Plans list navigation',
		'filter_items_list'     => 'Filter Home Plans list',
	);
	$args_plans = array(
		'label'                 => 'Home Plans',
		'description'           => 'Home Plans',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
		'taxonomies'			=> array( 'neighborhood' ),
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-admin-home',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'exclude_from_search'   => false,
		'capability_type'       => 'post',
	);	
	register_post_type( 'plans', $args_plans );

}


/*------------------------------------*\
	Custom Post Meta Boxes
\*------------------------------------*/

// add homes meta boxes
function add_events_metaboxes() {

	add_meta_box(
		'meta_pull_plan_data',
		'Pull Home Plan Data',
		'add_meta_homes_pull_plan_data',
		'homes',
		'side',
		'low'
	);

}

// button to update home meta with plan data
function add_meta_homes_pull_plan_data(){

	echo '<p>Update the details of this listing based on the floorplan selected on the left. Will overwrite current values.</p>';
	echo '<button id="edgemm_pull_plan_data" class="btn-edgemm" type="button">Pull Plan Data</button>';

}



/*------------------------------------*\
	Custom Post Type Column Sorting
\*------------------------------------*/

// sort by taxonomy
// http://wpdreamer.com/2014/04/how-to-make-your-wordpress-admin-columns-sortable/
// http://justintadlock.com/archives/2011/06/27/custom-columns-for-custom-post-types#comment-2279117)
//function cpt_sort_plans( $columns ) {
//
//	$columns[ '']
//
//}

// filter custom post type by taxonomy
// https://pippinsplugins.com/post-list-filters-for-custom-taxonomies-in-manage-posts/
function cpt_filter_plans_homes() {

	global $typenow;
 
	// an array of all the taxonomies (by slug) you want to display.
	$taxonomies = array( 'neighborhood', 'collection' );
 
	// must set this to the post type you want the filter(s) displayed on
	if( $typenow == 'plans' || $typenow == 'homes' ) :

		foreach ($taxonomies as $tax_slug) :

			$tax_obj = get_taxonomy( $tax_slug );
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms( $tax_slug );
			
			if ( count( $terms ) > 0 ) :

				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>Show All $tax_name</option>";

				foreach ($terms as $term) :

					echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';

				endforeach;

				echo "</select>";

			endif;

		endforeach;

	endif;
}


/*------------------------------------*\
	Custom Taxonomies
\*------------------------------------*/

function create_taxonomies() {

	// neighborhoods
	$labels_neighborhoods = array(
		'name'							=> _x( 'Neighborhoods', 'Taxonomy General Name' ),
		'singular_name'					=> _x( 'Neighborhood', 'Taxonomy Singular Name' ),
		'menu_name' 					=> __( 'Neighborhoods' ),
		'all_items'						=> __( 'All Neighborhoods' ),
		'parent_item'					=> __( 'Parent Neighborhood' ),
		'parent_item_colon'				=> __( 'Parent Neighborhood:' ),
		'new_item_name'					=> __( 'New Neighborhood' ),
		'add_new_item'					=> __( 'Add New Neighborhood' ),
		'edit_item'						=> __( 'Edit Neighborhood' ),
		'update_item'					=> __( 'Update Neighborhood' ),
		'view_item'						=> __( 'View Neighborhood' ),
		'separate_items_with_commas'	=> __( 'Separate neighborhoods with commas' ),
		'add_or_remove_items'			=> __( 'Add or remove neighborhoods' ),
		'choose_from_most_used'			=> __( 'Choose from the most used' ),
		'popular_items'					=> __( 'Popular Neighborhoods' ),
		'search_items'					=> __( 'Search Neighborhoods' ),
		'not_found'						=> __( 'Not Found' ),
		'no_terms'						=> __( 'No items' ),
		'items_list'					=> __( 'Neighborhoods list' ),
		'items_list_navigation'			=> __( 'Neighborhoods list navigation' ),
	);
	$args_neighborhoods = array(
		'labels'					=> $labels_neighborhoods,
		'public'					=> false,
		'hierarchical'				=> true,
		'show_ui'					=> true,
		'show_admin_column'			=> true,
		'show_in_nav_menus'			=> true,
		'show_tagcloud'				=> false
	);
	register_taxonomy( 'neighborhood', array( 'plans' ), $args_neighborhoods );

	// home plan collections
	$labels_collections = array(
		'name'							=> _x( 'Collections', 'Taxonomy General Name' ),
		'singular_name'					=> _x( 'Collection', 'Taxonomy Singular Name' ),
		'menu_name'						=> __( 'Collections' ),
		'all_items'						=> __( 'All Collections' ),
		'parent_item'					=> __( 'Parent Collection' ),
		'parent_item_colon'				=> __( 'Parent Collection:' ),
		'new_item_name'					=> __( 'New Collection' ),
		'add_new_item'					=> __( 'Add New Collection' ),
		'edit_item'						=> __( 'Edit Collection' ),
		'update_item'					=> __( 'Update Collection' ),
		'view_item'						=> __( 'View Collection' ),
		'separate_items_with_commas'	=> __( 'Separate collections with commas' ),
		'add_or_remove_items'			=> __( 'Add or remove collections' ),
		'choose_from_most_used'			=> __( 'Choose from the most used' ),
		'popular_items'					=> __( 'Popular Collections' ),
		'search_items'					=> __( 'Search Collections' ),
		'not_found'						=> __( 'Not Found' ),
		'no_terms'						=> __( 'No items' ),
		'items_list'					=> __( 'Collections list' ),
		'items_list_navigation'			=> __( 'Collections list navigation' ),
	);
	$args_collections = array(
		'labels'					=> $labels_collections,
		'public'					=> false,
		'hierarchical'				=> true,
		'show_ui'					=> true,
		'show_admin_column'			=> true,
		'show_in_nav_menus'			=> true,
		'show_tagcloud'				=> false
	);
	register_taxonomy( 'collection', array( 'plans' ), $args_collections );

}

// term metadata to add to neighborhood taxonomy
$neighborhood_terms = array(
	'city',
	'zip',
	'agent-email'
);

// neighborhood metadata - add
function add_neighborhood_meta( $taxonomy ){ // city, zip, agent email

    ?>
	<div class="form-field term-city-wrap">
		<label for="tag-city"><?php _e( 'City' ); ?></label>
		<input name="tag-city" id="tag-city" type="text" value="" size="40" aria-required="true">
	</div>
	<div class="form-field term-zip-wrap">
		<label for="tag-zip"><?php _e( 'Zip' ); ?></label>
		<input name="tag-zip" id="tag-zip" type="text" value="" size="40" aria-required="true">
	</div>
	<div class="form-field term-agent-email-wrap">
		<label for="tag-agent-email"><?php _e( 'Agent Email' ); ?></label>
		<input name="tag-agent-email" id="tag-agent-email" type="text" value="" size="40" aria-required="true">
	</div>
	<?php
	
}

// neighborhood metadata - save
function save_neighborhood_meta( $term_id ) {

	global $neighborhood_terms;

	foreach( $neighborhood_terms as $t ) :

		if( isset( $_POST[ 'tag-' . $t ] ) && '' !== $_POST[ 'tag-' . $t ] ) :
	
			$group = ( $t == 'agent-email' ) ? sanitize_email( $_POST[ 'tag-' . $t ] ) : sanitize_title( $_POST[ 'tag-' . $t ] );
			add_term_meta( $term_id, 'neighborhood-' . $t, $group, true );
	
		endif;

	endforeach;

}

// neighborhood metadata - edit
function edit_neighborhood_meta( $term ) {

	global $neighborhood_terms;

	foreach( $neighborhood_terms as $t ) :
	?>
	<tr class="form-field term-<?php echo $t; ?>-wrap">
        <th scope="row">
			<label for="tag-<?php echo $t; ?>"><?php _e( ucwords( $t ) ); ?></label>
		</th>
        <td>
			<input name="tag-<?php echo $t; ?>" id="tag-<?php echo $t; ?>" type="text" value="<?php echo get_term_meta( $term->term_id, 'neighborhood-' . $t, true ); ?>" size="40" aria-required="true">
        </td>
    </tr>
	<?php
	endforeach;

}

// neighborhood metadata - update
function update_neighborhood_meta( $term_id ) {

	global $neighborhood_terms;

	foreach( $neighborhood_terms as $t ) :

		if( isset( $_POST[ 'tag-' . $t ] ) && '' !== $_POST[ 'tag-' . $t ] ) :

			$group = ( $t == 'agent-email' ) ? sanitize_email( $_POST[ 'tag-' . $t ] ) : sanitize_title( $_POST[ 'tag-' . $t ] );
			update_term_meta( $term_id, 'neighborhood-' . $t, $group, true );
	
		endif;

	endforeach;

}

/*------------------------------------*\
	AJAX
\*------------------------------------*/

// update home listing details with selected floorplan data
function pull_plan_data() {

	$id = $_POST[ 'plan_id' ];

	$custom_fields = get_post_custom( $id );
	$custom_fields[ 'plan_content' ] = apply_filters( 'the_content', get_post_field( 'post_content', $id ) );
	
	echo json_encode( $custom_fields );
	
	exit;

}


?>
