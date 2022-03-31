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
			'Members Template' => 'members_template',
			'Banners Template' => 'banners_template',
			'Products Template' => 'works_products_template',
			'Obras Template' => 'works_obras_template',
			'Banners Template About' => 'banners_template_about',
			'Customers Logos' => 'customers_template',
			'Testimonials' => 'testimonials_template',
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

function members_template( $posts, $get_posts_shortcode_atts ) {
	extract( $get_posts_shortcode_atts );
	$out = '';
	$out .= '<div class="row team-wrap">';
	foreach( $posts as $post ) {
		$position = get_post_meta( $post->ID, 'position', true );
		$facebook = get_post_meta( $post->ID, 'facebook', true );
		$twitter = get_post_meta( $post->ID, 'twitter', true );
		$instagram = get_post_meta( $post->ID, 'instagram', true );
		$pinterest = get_post_meta( $post->ID, 'pinterest', true );
		$imagen = get_post_meta( $post->ID, 'imagen', true );
		$out .= '<div class="col-lg-3 col-sm-6 padding-15 mb-4">';
		$out .= '<div class="team-item">';
		$out .= '<div class="overlay"></div>';
		if( strpos( $output_hide_elements,'featuredimage' )  === false ) {
			if( (int)$output_has_permalink ) {
				$out .= $imagen ? '<img alt="' . get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true ) . '" class="' . $output_featured_image_class . '" src="' . $imagen . '" />' : '<img alt="' . get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true ) . '" class="' . $output_featured_image_class . '" src="/wp-content/uploads/2022/03/bg-posts.jpg" data-src="' . get_the_post_thumbnail_url( $post, $output_featured_image_format ) . '" data-srcset="' . get_the_post_thumbnail_url( $post, $output_featured_image_format ) . '" />';
			} else {
				$out .= $imagen ? '<img alt="' . get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true ) . '" class="' . $output_featured_image_class . '" src="' . $imagen . '" />' : '<img alt="' . get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true ) . '" class="' . $output_featured_image_class . '" src="' . get_the_post_thumbnail_url( $post, $output_featured_image_format ) . '" />';
			}
		}
		$out .= '<div class="team-content">';
		$out .= '<h3>' . get_the_title( $post ) . '</h3>';
		$out .= '<span>' . $position . '</span>';
		$out .= '</div>';
		$out .= '<ul class="team-social">';
		$out .= $facebook ? '<li><a href="' . $facebook . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="icon-facebook-square" viewBox="0 0 24 28"><path d="M19.5 2c2.484 0 4.5 2.016 4.5 4.5v15c0 2.484-2.016 4.5-4.5 4.5h-2.938v-9.297h3.109l0.469-3.625h-3.578v-2.312c0-1.047 0.281-1.75 1.797-1.75l1.906-0.016v-3.234c-0.328-0.047-1.469-0.141-2.781-0.141-2.766 0-4.672 1.687-4.672 4.781v2.672h-3.125v3.625h3.125v9.297h-8.313c-2.484 0-4.5-2.016-4.5-4.5v-15c0-2.484 2.016-4.5 4.5-4.5h15z"></path></svg></a></li>' : '';
		$out .= $twitter ? '<li><a href="' . $twitter . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="icon-twitter" viewBox="0 0 26 28"><path d="M25.312 6.375c-0.688 1-1.547 1.891-2.531 2.609 0.016 0.219 0.016 0.438 0.016 0.656 0 6.672-5.078 14.359-14.359 14.359-2.859 0-5.516-0.828-7.75-2.266 0.406 0.047 0.797 0.063 1.219 0.063 2.359 0 4.531-0.797 6.266-2.156-2.219-0.047-4.078-1.5-4.719-3.5 0.313 0.047 0.625 0.078 0.953 0.078 0.453 0 0.906-0.063 1.328-0.172-2.312-0.469-4.047-2.5-4.047-4.953v-0.063c0.672 0.375 1.453 0.609 2.281 0.641-1.359-0.906-2.25-2.453-2.25-4.203 0-0.938 0.25-1.797 0.688-2.547 2.484 3.062 6.219 5.063 10.406 5.281-0.078-0.375-0.125-0.766-0.125-1.156 0-2.781 2.25-5.047 5.047-5.047 1.453 0 2.766 0.609 3.687 1.594 1.141-0.219 2.234-0.641 3.203-1.219-0.375 1.172-1.172 2.156-2.219 2.781 1.016-0.109 2-0.391 2.906-0.781z"></path></svg></a></li>' : '';
		$out .= $instagram ?'<li><a href="' . $instagram . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="icon-instagram" viewBox="0 0 24 28"><path d="M16 14c0-2.203-1.797-4-4-4s-4 1.797-4 4 1.797 4 4 4 4-1.797 4-4zM18.156 14c0 3.406-2.75 6.156-6.156 6.156s-6.156-2.75-6.156-6.156 2.75-6.156 6.156-6.156 6.156 2.75 6.156 6.156zM19.844 7.594c0 0.797-0.641 1.437-1.437 1.437s-1.437-0.641-1.437-1.437 0.641-1.437 1.437-1.437 1.437 0.641 1.437 1.437zM12 4.156c-1.75 0-5.5-0.141-7.078 0.484-0.547 0.219-0.953 0.484-1.375 0.906s-0.688 0.828-0.906 1.375c-0.625 1.578-0.484 5.328-0.484 7.078s-0.141 5.5 0.484 7.078c0.219 0.547 0.484 0.953 0.906 1.375s0.828 0.688 1.375 0.906c1.578 0.625 5.328 0.484 7.078 0.484s5.5 0.141 7.078-0.484c0.547-0.219 0.953-0.484 1.375-0.906s0.688-0.828 0.906-1.375c0.625-1.578 0.484-5.328 0.484-7.078s0.141-5.5-0.484-7.078c-0.219-0.547-0.484-0.953-0.906-1.375s-0.828-0.688-1.375-0.906c-1.578-0.625-5.328-0.484-7.078-0.484zM24 14c0 1.656 0.016 3.297-0.078 4.953-0.094 1.922-0.531 3.625-1.937 5.031s-3.109 1.844-5.031 1.937c-1.656 0.094-3.297 0.078-4.953 0.078s-3.297 0.016-4.953-0.078c-1.922-0.094-3.625-0.531-5.031-1.937s-1.844-3.109-1.937-5.031c-0.094-1.656-0.078-3.297-0.078-4.953s-0.016-3.297 0.078-4.953c0.094-1.922 0.531-3.625 1.937-5.031s3.109-1.844 5.031-1.937c1.656-0.094 3.297-0.078 4.953-0.078s3.297-0.016 4.953 0.078c1.922 0.094 3.625 0.531 5.031 1.937s1.844 3.109 1.937 5.031c0.094 1.656 0.078 3.297 0.078 4.953z"></path></svg></a></li>' : '';
		$out .= $pinterest ?' <li><a href="' . $pinterest . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="icon-pinterest-p" viewBox="0 0 20 28"><path d="M0 9.328c0-5.766 5.281-9.328 10.625-9.328 4.906 0 9.375 3.375 9.375 8.547 0 4.859-2.484 10.25-8.016 10.25-1.313 0-2.969-0.656-3.609-1.875-1.188 4.703-1.094 5.406-3.719 9l-0.219 0.078-0.141-0.156c-0.094-0.984-0.234-1.953-0.234-2.938 0-3.187 1.469-7.797 2.188-10.891-0.391-0.797-0.5-1.766-0.5-2.641 0-1.578 1.094-3.578 2.875-3.578 1.313 0 2.016 1 2.016 2.234 0 2.031-1.375 3.938-1.375 5.906 0 1.344 1.109 2.281 2.406 2.281 3.594 0 4.703-5.187 4.703-7.953 0-3.703-2.625-5.719-6.172-5.719-4.125 0-7.313 2.969-7.313 7.156 0 2.016 1.234 3.047 1.234 3.531 0 0.406-0.297 1.844-0.812 1.844-0.078 0-0.187-0.031-0.266-0.047-2.234-0.672-3.047-3.656-3.047-5.703z"></path></svg></a></li>' : '';
		$out .= '</ul>';
		$out .= '</div>';
		$out .= '</div>';
	}
	$out .= '</div>';
	return $out;
}


function works_template( $posts, $get_posts_shortcode_atts ) {
	extract( $get_posts_shortcode_atts );
	$out = '';
	$output_hide_elements = strtolower( $output_hide_elements );

	//default is 3 rows
	if( $output_number_of_columns == 1 ) $column_classes='col-12';
	if( $output_number_of_columns == 2 ) $column_classes='col-md-6 col-lg-6';
	if($output_number_of_columns == 3 ) $column_classes='col-md-6 col-lg-4';
	if($output_number_of_columns == 4 ) $column_classes='col-md-6 col-lg-3';
	$tax_terms = get_terms( 'service_category', 'orderby=name');
	$out .= '<div class="upper-row clearfix">';
	$out .= '<div class="filters clearfix"><ul class="filter-tabs filter-btns clearfix has-dynamic-filter-counter">';
	$out .= '<li class="active filter" data-role="button" data-filter="all">All</li>';
	foreach ( $tax_terms as $term ) {
		$out .= '<li class="filter" data-role="button" data-filter=".' . $term->slug . '">' . $term->name . '</li>';
	}
	$out .= '</ul></div></div>';
	$out .= '<div class="filter-list row">';

	foreach ( $posts as $post ) {
		$terms_string = '';
		foreach ( get_the_terms( $post->ID, 'service_category' ) as $term ) {
			$terms_string .= $term->name . ' ';
		}
		$out .= '<div class="gallery-item mix all ' . strtolower( $terms_string ) . $column_classes . '"><div class="inner-box">';
		if ( strpos( $output_hide_elements,'featuredimage' )  === false ) {
			if ( (int)$output_has_permalink ) {
				$out .= '<img alt="' . get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true ) . '" class="' . $output_featured_image_class . '" src="' . get_the_post_thumbnail_url( $post, $output_featured_image_format ) . '"><a href="' . get_the_permalink( $post ) . '" class="lightbox-image overlay-box"></a>';
			} else {
				$out .= '<img alt="' . get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true ) . '" class="' . $output_featured_image_class . '" src="' . get_the_post_thumbnail_url( $post, $output_featured_image_format ) . '">';
			}
		}
		$out .= '<div class="cap-box"><div class="cap-inner"><div class="cat"><span>' . $terms_string . '</span></div>';
		if ( strpos( $output_hide_elements,'title') === false) {
			if ( (int)$output_has_permalink ) {
				$out .= '<div class="title"><'. $output_heading_tag.'> <a href="' . get_the_permalink( $post ) . '">' . get_the_title( $post ) . '</a> </' . $output_heading_tag . '></div>';
			} else {
				$out .= '<div class="title"><'. $output_heading_tag.'>' . get_the_title( $post ) . '</'.$output_heading_tag . '></div>';
			}
		}
		$out .= '</div></div></div></div>';
	}
	return $out;
}
function banners_template( $posts, $get_posts_shortcode_atts ) {
	extract( $get_posts_shortcode_atts );
	// foreach( $posts as $post ) {
	ob_start();
	?>

	<div class="banner-carousel owl-theme owl-carousel">
	<?php
	 foreach( $posts as $post ) {
		$title = get_post_meta( $post->ID, 'title', true );
		$subtitle = get_post_meta( $post->ID, 'subtitle', true );
		$gallery = get_post_meta( $post->ID, 'gallery', true );
		$button_label = get_post_meta( $post->ID, 'button_label', true );
		$button_url = get_post_meta( $post->ID, 'button_url', true );
	?>
		<!-- Slide Item -->
			<div class="slide-item">
				<div class="image-layer" style="background-image: url(<?php echo $gallery ? $gallery[0] : ''?>);"></div>
				<div class="left-top-line"></div>
				<div class="right-bottom-curve"></div>
				<div class="right-top-curve"></div>
				<div class="auto-container">
					<div class="content-box">
						<div class="content">
							<div class="inner">
								<div class="sub-title"><?php echo $subtitle ? $subtitle : ''?></div>
								<h1 class=""><?php echo $title ? $title : ''?></h1>
								<div class="link-box">
										<a class="theme-btn btn-style-one" href="<?php echo $button_url ? $button_url : ''?>"><i class="btn-curve"></i><span class="btn-title"><?php echo $button_label ? $button_label : 'Discover MOre'?></span></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

<?php	}?>

		</div>

	<?php
	return ob_get_clean();
}
function banners_template_about( $posts, $get_posts_shortcode_atts ) {
	extract( $get_posts_shortcode_atts );
	// foreach( $posts as $post ) {
	$out  = '';
	$out .= '<div class="banner-carousel owl-theme owl-carousel">';
	foreach( $posts as $post ) {
		$title = get_post_meta( $post->ID, 'title', true );
		$subtitle = get_post_meta( $post->ID, 'subtitle', true );
		$gallery = get_post_meta( $post->ID, 'gallery', true );
		$button_label = get_post_meta( $post->ID, 'button_label', true );
		$button_url = get_post_meta( $post->ID, 'button_url', true );
			$out .= '<!-- Slide Item -->';
			$out .= '<div class="slide-item">';
			$out .= $gallery ? '<div class="bg-image" style="background-image: url(' . $gallery[0] . ');"></div>': '';
			$out .= '<div class="round-shape-1"></div>';
			$out .= '<div class="round-image">';
			$out .= '<div class="image" style="background-image: url(' . get_the_post_thumbnail_url( $post, $output_featured_image_format ) . ');"></div>';
			$out .= '</div>';
			$out .= '<div class="auto-container">';
			$out .= '<div class="content-box">';
			$out .= '<div class="content">';
			$out .= '<div class="inner">';
			$out .= $title ? '<h1>' . $title . '</h1>' : '';
			$out .= $subtitle ? '<div class="text">' . $subtitle . '</div>' : '';
			$out .= '<div class="link-box">';
			$out .= '<a class="theme-btn btn-style-two" href="' . $button_url . '"><i class="btn-curve"></i><span class="btn-title">' . $button_label . '</span></a>';
			$out .= '</div>';
			$out .= '</div>';
			$out .= '</div>';
			$out .= '</div>';
		}
			$out .= '</div>';
			$out .= '</div>';
			$out .= '</div>';
	return $out;
}
function testimonials_template( $posts, $get_posts_shortcode_atts ) {
	extract( $get_posts_shortcode_atts );
	$out  = '';
	$out  = '<div id="testimonial-carousel" class="testimonial-carousel box-shadow owl-carousel">';
	foreach ($posts as $post) {
		$pic = get_the_post_thumbnail_url( $post, $output_featured_image_format );
		$picmeta = get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true );
		$title = get_post_meta( $post->ID, 'title', true );
		$company = get_post_meta( $post->ID, 'company', true );
		$customer = get_post_meta( $post->ID, 'customer', true );
		$out .= '<div class="testi-item d-flex align-items-center">';
		$out .= ' <div class="testi-content">';
		$out .= ' <p>"' . $title . '"</p>';
		$out .= '<h3>' . $customer . '</h3>';
		$out .= ' <span>' . $company . '</span>';
		$out .= '</div>';
		$out .= '<i class="fa fa-quote-right"></i>';
		$out .= '</div>';
	}
	$out .= '</div>';

	return $out;
}
function customers_template( $posts, $get_posts_shortcode_atts ) {
	extract( $get_posts_shortcode_atts );
	// foreach( $posts as $post ) {
	ob_start();
	?>
	<div class="container">
	<div id="sponsor-carousel" class="sponsor-carousel owl-carousel">
	<?php
	foreach ( $posts as $post ) {
		$galleries = get_post_meta( $post->ID, 'galleries', true );
		foreach ( $galleries as $gallery_image_url ){
	?>
			<div class="sponsor-item">
			<img src="<?php echo $gallery_image_url ?>" alt="" width="150" height="80">
			</div>	
	<?php
		};
	};
	?>
	</div>
	</div>
	<?php
	return ob_get_clean();
}
function testimonials_template_2( $posts, $get_posts_shortcode_atts ) {
	extract( $get_posts_shortcode_atts );
	$out  = '';
	$out .= '<div class="auto-container">';
	$out .= '<div class="sec-title">';
	$out .= '<h2 class="">' . $output_wrapper_class . '<span class="dot">.</span></h2>';
	$out .= '<div class="carousel-box">';
	$out .= '<div class="testimonials-carousel owl-theme owl-carousel">';
	foreach ($posts as $post) {
		$pic = get_the_post_thumbnail_url( $post, $output_featured_image_format );
		$picmeta = get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true );
		$title = get_post_meta( $post->ID, 'title', true );
		$company = get_post_meta( $post->ID, 'company', true );
		$customer = get_post_meta( $post->ID, 'customer', true );
		$out .= '<div class="testi-block">';
		$out .= '<div class="inner">';
		$out .= '<div class="icon"><span>“</span></div>';
		$out .= '<div class="info">';
		$out .= '<div class="image"><img src="' . $pic . '" alt=""></div>';
		$out .= '<div class="name">' . $customer . '</div>';
		$out .= '<div class="designation">' . $company . '</div>';
		$out .= '</div>';
		$out .= '<div class="text">' . $title . '</div>';
		$out .= '</div>';
		$out .= '</div>';
	}

	$out .= '</div>';
	$out .= '</div>';
	$out .= '</div>';

	return $out;
}
function works_obras_template( $posts, $get_posts_shortcode_atts ) {
	extract( $get_posts_shortcode_atts );
	$out = '';
	$output_hide_elements = strtolower( $output_hide_elements );

	//default is 3 rows
	if( $output_number_of_columns == 1 ) $column_classes='col-12';
	if( $output_number_of_columns == 2 ) $column_classes='col-md-6 col-lg-6';
	if($output_number_of_columns == 3 ) $column_classes='col-md-6 col-lg-4';
	if($output_number_of_columns == 4 ) $column_classes='col-md-6 col-lg-3';
	$tax_terms = get_terms( 'service_category', 'orderby=name');
	$out .= '<div class="upper-row clearfix">';
	$out .= '<div class="filters filter-gallery clearfix"><ul class="filter-tabs filter-btns clearfix has-dynamic-filter-counter">';
	$out .= '<li class="active filter" data-role="button" data-filter="all">Todos</li>';
	foreach ( $tax_terms as $term ) {
		$out .= '<li class="filter" data-role="button" data-filter=".' . $term->slug . '">' . $term->name . '</li>';
	}
	$out .= '</ul></div></div>';
	$out .= '<div class="row filter-list blog-wrap">';
	function remove_accent_mark($string){
		
		//Reemplazamos la A y a
		$string = str_replace(
		array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
		array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
		$string
		);
		//Reemplazamos la A y a
		$string = str_replace(
		array(' '),
		array('-'),
		$string
		);
 
		//Reemplazamos la E y e
		$string = str_replace(
		array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
		array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
		$string );
 
		//Reemplazamos la I y i
		$string = str_replace(
		array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
		array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
		$string );
 
		//Reemplazamos la O y o
		$string = str_replace(
		array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
		array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
		$string );
 
		//Reemplazamos la U y u
		$string = str_replace(
		array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
		array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
		$string );
 
		//Reemplazamos la N, n, C y c
		$string = str_replace(
		array('Ñ', 'ñ', 'Ç', 'ç'),
		array('N', 'n', 'C', 'c'),
		$string
		);
		
		return $string;
	}
	foreach ( $posts as $post ) {
		$terms_string = '';
		foreach ( get_the_terms( $post->ID, 'service_category' ) as $term ) {
			$terms_string .= remove_accent_mark($term->name) . ' ';
		}
		$out .= '<div class=" gallery-item mix all ' . strtolower( $terms_string ) . $column_classes . ' sm-padding col-lg-4 col-sm-6 mt-4">';
		$out .= '<div class="blog-item product-item inner-box box-shadow ">';
		$imagen = get_the_post_thumbnail_url( $post, $output_featured_image_format ) ;
		if ( strpos( $output_hide_elements,'featuredimage' )  === false ) {
			if ( (int)$output_has_permalink ) {
				$out.= '<div class="blog-thumb bg-products" style="background-image: url(' . get_the_post_thumbnail_url( $post, $output_featured_image_format ) . ');">';
				$out.= '<a href="' . get_the_permalink( $post ) . '" class="thumb-overlay"></a>';
				// $out .= '<img class="blur-up lazy" src="/wp-content/uploads/2022/03/bg-posts.jpg" data-src="' . get_the_post_thumbnail_url( $post, $output_featured_image_format ) . '" data-srcset="' . get_the_post_thumbnail_url( $post, $output_featured_image_format ) . '" alt="post">';
			} else {
				$out.= '<div class="blog-thumb bg-products" style="background-image: url(' . get_the_post_thumbnail_url( $post, $output_featured_image_format ) . ');">';
				$out.= '<a href="' . get_the_permalink( $post ) . '" class="thumb-overlay"></a>';
				// $out .= '<img class="blur-up lazy" src="/wp-content/uploads/2022/03/bg-posts.jpg" data-src="' . get_the_post_thumbnail_url( $post, $output_featured_image_format ) . '" data-srcset="' . get_the_post_thumbnail_url( $post, $output_featured_image_format ) . '" alt="post">';
			}
		}
		$out.= '</div>';
		$out.= '<div class="blog-content">';
		if ( strpos( $output_hide_elements,'title') === false) {
			if ( (int)$output_has_permalink ) {
				$out .= '<h3 class=""> <a href="' . get_the_permalink( $post ) . '">' . get_the_title( $post ) . '</a></h3>';
			} else {
				$out .= '<h3 class="">' . get_the_title( $post ) . '</'.$output_heading_tag . '></h3>';
			}
		}
		$out .= '</div>';
		$out .= '</div>';
		$out .= '</div>';
	}
	$out .= '</div>';
	return $out;
}
function works_products_template( $posts, $get_posts_shortcode_atts ) {
	extract( $get_posts_shortcode_atts );
	$out = '';
	$output_hide_elements = strtolower( $output_hide_elements );

	//default is 3 rows
	if( $output_number_of_columns == 1 ) $column_classes='col-12';
	if( $output_number_of_columns == 2 ) $column_classes='col-md-6 col-lg-6';
	if($output_number_of_columns == 3 ) $column_classes='col-md-6 col-lg-4';
	if($output_number_of_columns == 4 ) $column_classes='col-md-6 col-lg-3';
	$tax_terms = get_terms( 'product_category', 'orderby=name');
	$out .= '<div class="upper-row clearfix">';
	$out .= '<div class="filters filter-gallery clearfix"><ul class="filter-tabs filter-btns clearfix has-dynamic-filter-counter">';
	$out .= '<li class="active filter" data-role="button" data-filter="all">Todos</li>';
	foreach ( $tax_terms as $term ) {
		$out .= '<li class="filter" data-role="button" data-filter=".' . $term->slug . '">' . $term->name . '</li>';
	}
	$out .= '</ul></div></div>';
	$out .= '<div class="row filter-list blog-wrap">';
	foreach ( $posts as $post ) {
		$terms_string = '';
		foreach ( get_the_terms( $post->ID, 'product_category' ) as $term ) {
			$terms_string .= $term->name . ' ';
		}
		$out .= '<div class=" gallery-item mix all ' . strtolower( $terms_string ) . $column_classes . ' sm-padding col-lg-4 col-sm-6 mt-4">';
		$out .= '<div class="blog-item product-item inner-box box-shadow ">';
		$imagen = get_the_post_thumbnail_url( $post, $output_featured_image_format ) ;
		if ( strpos( $output_hide_elements,'featuredimage' )  === false ) {
			if ( (int)$output_has_permalink ) {
				$out.= '<div class="blog-thumb bg-products" style="background-image: url(' . get_the_post_thumbnail_url( $post, $output_featured_image_format ) . ');">';
				$out.= '<a href="' . get_the_permalink( $post ) . '" class="thumb-overlay"></a>';
				// $out .= '<img class="blur-up lazy" src="/wp-content/uploads/2022/03/bg-posts.jpg" data-src="' . get_the_post_thumbnail_url( $post, $output_featured_image_format ) . '" data-srcset="' . get_the_post_thumbnail_url( $post, $output_featured_image_format ) . '" alt="post">';
			} else {
				$out.= '<div class="blog-thumb bg-products" style="background-image: url(' . get_the_post_thumbnail_url( $post, $output_featured_image_format ) . ');">';
				$out.= '<a href="' . get_the_permalink( $post ) . '" class="thumb-overlay"></a>';
				// $out .= '<img class="blur-up lazy" src="/wp-content/uploads/2022/03/bg-posts.jpg" data-src="' . get_the_post_thumbnail_url( $post, $output_featured_image_format ) . '" data-srcset="' . get_the_post_thumbnail_url( $post, $output_featured_image_format ) . '" alt="post">';
			}
		}
		$out.= '<span class="category"><a href="/' . $terms_string . '">' . $terms_string . '</a></span>';
		$out.= '</div>';
		$out.= '<div class="blog-content">';
		if ( strpos( $output_hide_elements,'title') === false) {
			if ( (int)$output_has_permalink ) {
				$out .= '<h3 class=""> <a href="' . get_the_permalink( $post ) . '">' . get_the_title( $post ) . '</a></h3>';
			} else {
				$out .= '<h3 class="">' . get_the_title( $post ) . '</'.$output_heading_tag . '></h3>';
			}
		}
		$out .= '</div>';
		$out .= '</div>';
		$out .= '</div>';
	}
	$out .= '</div>';
	return $out;
}
function products_template( $posts, $get_posts_shortcode_atts ) {
	extract( $get_posts_shortcode_atts );
	$out = '';
	$output_hide_elements = strtolower( $output_hide_elements );

	//default is 3 rows
	if( $output_number_of_columns == 1 ) $column_classes='col-12';
	if( $output_number_of_columns == 2 ) $column_classes='col-md-6 col-lg-6';
	if($output_number_of_columns == 3 ) $column_classes='col-md-6 col-lg-4';
	if($output_number_of_columns == 4 ) $column_classes='col-md-6 col-lg-3';
	$tax_terms = get_terms( 'product_category', 'orderby=name');
	$out .= '<div class="filter-gallery">';
	$out .= '<ul>';
	$out .= '<li class="list active" data-filter="all">Todos</li>';
	foreach ( $tax_terms as $term ) {
		$out .= '<li class="list" data-filter="' . $term->slug . '">' . $term->name . '</li>';
	}
	$out .= '</ul>';
	$out .= '<div class="product col-lg-3 col-sm-6 sm-padding mt-4">';

	foreach ( $posts as $post ) {
		$terms_string = '';
		foreach ( $tax_terms as $term ) {
			$terms_string .= $term->name . ' ';
		}
		$out .= '<div class="product ' . strtolower( $terms_string ) . $column_classes . '"><div class="inner-box">';
		$out .= '<div class="itemBox" data-item="' . strtolower( $terms_string ) . '">';
		$out .= '<div class="blog-item product-item-box box-shadow" style="min-height: 1px">';
		$out .= '<div class="blog-thumb">';
		$out .= '<a href="' . get_the_permalink( $post ) . '" alt="' . get_the_title( $post ) . '">';
		if ( strpos( $output_hide_elements,'featuredimage' )  === false ) {
			if ( (int)$output_has_permalink ) {
				$out .= ' <img width="350" height="233" src="' . get_the_post_thumbnail_url( $post, $output_featured_image_format ) . ' data-src="' . get_the_post_thumbnail_url( $post, $output_featured_image_format ) . ' data-srcset="' . get_the_post_thumbnail_url( $post, $output_featured_image_format ) . '"> </a>';
			} else {
				$out .= '<img alt="' . get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true ) . '" class="' . $output_featured_image_class . '" src="' . get_the_post_thumbnail_url( $post, $output_featured_image_format ) . '">';
			}	}
		$out.= '</div>';
		$out.= '<div class="blog-content">';
		$out.= '<h3 class="">';
		$out.= '<a href="' . get_the_permalink( $post ) . '">' . get_the_title( $post ) . '</a>';
		$out.= '</h3>';
		$out .= '</div></div></div>';
	}
	return $out;
}