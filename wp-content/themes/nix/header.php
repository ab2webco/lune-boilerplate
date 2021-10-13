<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
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
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<header>
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
				<div class="container">
					<a class="navbar-brand" href="/">
						Nix
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<?php
					if (false === ($menu = get_transient('primary_menu'))){
						ob_start();
						wp_nav_menu( array(
							'theme_location'    => 'primary',
							'depth'             => 2,
							'container'         => 'div',
							'container_class'   => 'collapse navbar-collapse',
							'container_id'      => 'navbarNavDropdown',
							'menu_class'        => 'navbar-nav ml-auto js-menu-item',
							'menu_id'           => 'main-menu',
						    'fallback_cb'       => 'Nix_Navwalker::fallback',
						    'walker'            => new Nix_Navwalker(),
						) );
						$menu = ob_get_clean();
						set_transient( 'primary_menu', $menu, DAY_IN_SECONDS );
					}
					echo $menu;
					?>
				</div>
			</nav>
		</header>
		<main class="main">
