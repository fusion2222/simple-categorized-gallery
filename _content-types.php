<?php

// The poorest reccomended security I ever saw. But let it be here.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function simple_categorized_gallery__register_simple_partner_logo_type(){
	register_post_type(SIMPLE_CATEGORIZED_GALLERY__CONTENT_TYPE_NAME, [
		'labels' => [
			'name' => __('Gallery'),
			'singular_name' => __('Gallery image'),
			'add_new_item' => __('Add new Gallery image')
		],
		'menu_icon' => 'dashicons-format-image ',
		'public' => true,
		'has_archive' => true,
		'rewrite' => ['slug' => 'galeria'],  // TODO: Make proper translations
		'menu_position' => 9,
		'show_in_rest' => true,
		'supports' => array('title', 'thumbnail'),
		'hierarchical' => false,
	]);
}

function simple_categorized_gallery__register_year_taxonomies(){

	$category_args = [
		'description' => 'Gallery image years',
		'public' => true,
		'hierarchical' => false,
		// 'show_ui' => false,
		'labels' => [
			'name' => 'Years',
			'singular_name' => 'Year',
			'search_items' => 'Search Years',
			'popular_items' => 'Popular Years',
			'all_items' => 'All Years',
			'edit_item' => 'Edit Year',
			'view_item' => 'Update Year',
			'add_new_item' => 'Add new Year',
			'new_item_name' => 'New Year Name',
			'separate_items_with_commas' => 'Separate Years with commas',
			'add_or_remove_items' => 'Add or remove Years',
			'choose_from_most_used' => 'Choose from the most used Years',
			'not_found' => 'No Years found',
			'no_terms' => 'No Years',
			'items_list_navigation' => 'Year pagination',
			'back_to_items' => 'Back to Years',
		],
        'query_var' => true,
        'rewrite' => ['slug' => 'galeria'],
		'show_admin_column' => true,
		'meta_box_cb' => function($post, $args){

			$taxonomy_name = $args['args']['taxonomy'];
			// $terms = get_the_terms($post, 'simple_partner_logos_categories');

			$terms = get_terms( array(
    			'taxonomy' => $taxonomy_name,
    			'hide_empty' => false,
			));

			$attached_terms_to_post = get_the_terms($post, $taxonomy_name);
			foreach ($terms as $key => $term){
				$is_selected = has_term($term, $taxonomy_name, $post) ? ' checked' : '';
				$term_value = $term->name;
				$term_field_id = $taxonomy_name . '_' . $key;
				echo '<input type="radio" name="tax_input[' . $taxonomy_name . ']" value="' . $term_value . '" id="' . $term_field_id . '"' . $is_selected . '><label for="' . $term_field_id . '">' . $term->name . '</label><br>';
			}
		}
		
	];

	register_taxonomy(
		SIMPLE_CATEGORIZED_GALLERY__TAXONOMY_YEARS,
		SIMPLE_CATEGORIZED_GALLERY__CONTENT_TYPE_NAME,
		$category_args
	);

	register_taxonomy_for_object_type(
		SIMPLE_CATEGORIZED_GALLERY__TAXONOMY_YEARS,
		SIMPLE_CATEGORIZED_GALLERY__CONTENT_TYPE_NAME
	);
}

function simple_categorized_gallery__register_type_taxonomies(){

	$category_args = [
		'description' => 'Gallery image types',
		'public' => true,
		'hierarchical' => false,
		'show_in_menu' => false,
		'labels' => [
			'name' => 'Image Type',
			'singular_name' => 'Image Type',
			'search_items' => 'Search Gallery Image Types',
			'popular_items' => 'Popular Gallery Image Types',
			'all_items' => 'All Gallery Image Types',
			'edit_item' => 'Edit Gallery Image Types',
			'view_item' => 'Update Gallery Image Type',
			'add_new_item' => 'Add new Gallery Image type',
			'new_item_name' => 'New Gallery Image Type name',
			'separate_items_with_commas' => 'Separate image types with commas',
			'add_or_remove_items' => 'Add or remove Gallery Image Types',
			'choose_from_most_used' => 'Choose from the most used Image types',
			'not_found' => 'No Gallery Image types found',
			'no_terms' => 'No Gallery Image types',
			'items_list_navigation' => 'Image type pagination',
			'back_to_items' => 'Back to Gallery Image types',
		],
		'show_admin_column' => true,
		'meta_box_cb' => function($post, $args){

			$taxonomy_name = $args['args']['taxonomy'];
			// $terms = get_the_terms($post, 'simple_partner_logos_categories');

			$terms = get_terms( array(
    			'taxonomy' => $taxonomy_name,
    			'hide_empty' => false,
			));

			$attached_terms_to_post = get_the_terms($post, $taxonomy_name);
			foreach ($terms as $key => $term){
				$is_selected = has_term($term, $taxonomy_name, $post) ? ' checked' : '';
				$term_value = $term->name;
				$term_field_id = $taxonomy_name . '_' . $key;
				echo '<input type="radio" name="tax_input[' . $taxonomy_name . ']" value="' . $term_value . '" id="' . $term_field_id . '"' . $is_selected . '><label for="' . $term_field_id . '">' . $term->name . '</label><br>';
			}
		}
		
	];

	// They are listed here by importance. First is the most important.
	register_taxonomy(
		SIMPLE_CATEGORIZED_GALLERY__TAXONOMY_TYPES,
		SIMPLE_CATEGORIZED_GALLERY__CONTENT_TYPE_NAME,
		$category_args
	);
	register_taxonomy_for_object_type(
		SIMPLE_CATEGORIZED_GALLERY__TAXONOMY_TYPES,
		SIMPLE_CATEGORIZED_GALLERY__CONTENT_TYPE_NAME
	);
}

add_action('init', 'simple_categorized_gallery__register_year_taxonomies');
add_action('init', 'simple_categorized_gallery__register_type_taxonomies');
add_action('init', 'simple_categorized_gallery__register_simple_partner_logo_type');
