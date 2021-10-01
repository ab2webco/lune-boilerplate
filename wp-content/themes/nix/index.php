<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		the_content();
	endwhile;
else :
	_e( 'Sorry, no posts matched your criteria.', 'nix' );
endif;

get_footer();
