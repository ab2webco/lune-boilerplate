<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] ?? '';
?>

<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="format-detection" content="telephone=no, date=no, address=no">
		<link rel="author" href="<?php echo get_template_directory_uri(); ?>/humans.txt" />
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link id="googleFonts" href="https://fonts.googleapis.com/css?family=Heebo:400,500|Montserrat:400,500,600,700&display=swap" rel="stylesheet" type="text/css">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
<?php if ( function_exists( "wp_body_open" ) ) { wp_body_open(); } ?>
