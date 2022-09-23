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
	<div class="page-wrapper">
	<header id="header" class="site-header header-style-1 style-1">
		<div class="topbar">
			<div class="container">
				<div class="row">
					<div class="col col-sm-7">
						<div class="contact-info ">
							<ul>
							<li><i class="ti-email"></i>demo@example.com</li>
							<li><i class="ti-location-pin"></i>22 no street, Dream city </li>
							</ul>
						</div>
					</div>
					<div class="col col-sm-5">
						<div class="social-quote">
							<div class="social-links ">
							<ul>
								<li><a href="#"><i class="ti-facebook" style=""></i></a></li>
								<li><a href="#"><i class="ti-twitter-alt" style=""></i></a></li>
								<li><a href="#"><i class="ti-vimeo-alt" style=""></i></a></li>
								<li><a href="#"><i class="ti-pinterest" style=""></i></a></li>
							</ul>
							</div>
							<div class="quote"><a href="#">Free consultation</a></div>
						</div>
					</div>
				</div>
			</div> <!-- end container -->
		</div>
		<!-- end topbar -->

		<nav class="navigation navbar navbar-default original">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="open-btn">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/"><img src="<?php echo $image ?>" alt="Vertical Link Logo"></a>
				</div>
				<?php
				if (false === ($menu = get_transient('primary_menu'))){
					ob_start();
					wp_nav_menu( array(
						'theme_location'    => 'primary',
						'depth'             => 2,
						'container'         => 'div',
						'container_class'   => 'navbar-collapse collapse navbar-right navigation-holder',
						'container_id'      => 'navbar',
						'menu_class'        => 'nav navbar-nav js-menu-item',
						'menu_id'           => 'main-menu',
						'fallback_cb'       => 'Nix_Navwalker::fallback',
						'walker'            => new Nix_Navwalker(),
					) );
					$menu = ob_get_clean();
					set_transient( 'primary_menu', $menu, DAY_IN_SECONDS );
				}
				echo $menu;
				?>
			</div><!-- end of container -->
		</nav>
	</header>
