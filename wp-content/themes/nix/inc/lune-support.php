<?php

/**
 * Add Lune Support
 *
 * @package Ab2Web
 */

if ( function_exists( 'add_lune_support' ) ) {
	add_lune_support( 'post-template', array(
		'templates' => array(
			'Posts Template' => 'posts_template',
		)
	));
}

function posts_template( $posts, $get_posts_shortcode_atts ) {
	extract( $get_posts_shortcode_atts );
	$out = '';
	$output_hide_elements = strtolower( $output_hide_elements );

	//default is 3 rows
	if( $output_number_of_columns == 1 ) $column_classes = 'col-12';
	if( $output_number_of_columns == 2 ) $column_classes = 'col-md-6 col-lg-6';
	if($output_number_of_columns == 3 ) $column_classes = 'col-md-6 col-lg-4';
	if($output_number_of_columns == 4 ) $column_classes = 'col-md-6 col-lg-3';

	$out = '<div class="row blog-wrap">';
	foreach ( $posts as $post ) {
		$categories = get_the_category( $post );
		$out .= '<div class="col-lg-4 col-sm-6 sm-padding">';
		$out .= '<div class="blog-item">';
		$out .= '<div class="blog-thumb">';
		  if ( strpos( $output_hide_elements,'featuredimage' )  === false ) {
			if ( (int)$output_has_permalink ) {
				$out .= '<img class="blur-up lazy" src="/wp-content/uploads/2022/03/bg-posts.jpg" data-src="' . get_the_post_thumbnail_url( $post, $output_featured_image_format ) . '" data-srcset="' . get_the_post_thumbnail_url( $post, $output_featured_image_format ) . '" alt="post">';
				$out .= '<span class="category"><a href="' . get_the_permalink( $post ) . '">' . $categories[0]->name . '</a></span>';
			} else {
				$out .= '<img class="lazy" alt="' . get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true ) . '" class="' . $output_featured_image_class . '" src="' . get_the_post_thumbnail_url( $post, $output_featured_image_format ) . '" />';
			}
		}
		$out .= '</div>';
		$out .= '<div class="blog-content">';
		if ( strpos( $output_hide_elements,'title') === false) {
			if ( (int)$output_has_permalink ) {
				$out .= '<h3> <a href="' . get_the_permalink( $post ) . '">' . get_the_title( $post ) . '</a> </h3>';
			} else {
				$out .= '<' . $output_heading_tag . '>' . get_the_title( $post ) . '</' . $output_heading_tag . '>';
			}
		}
		if ( strpos( $output_hide_elements,'excerpt' ) === false && $output_excerpt_length !=0 ) {
			$out .= '<p class="text">' . apply_filters( 'NOOO_the_content', wp_trim_words( wp_strip_all_tags( ( $post->post_content ) ), $output_excerpt_length, $output_excerpt_text ) ) . '</p>';
		}
		if ( (int)$output_has_permalink ) {
		$out .='<a class="read-more" href="' . get_the_permalink( $post ) . '" class="read-more" >Seguir Leyendo</a>';
		}
      	$out .= '</div>';
      	$out .= '</div>';
      	$out .= '</div>';
	}
	$out .= '</div>';
	// print_r($posts);return; //for debug
	return $out;
}
