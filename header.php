<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hikaru
 */
if ( !defined( 'ABSPATH' ) ) { exit; }
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="menu-wrapper">

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
	<div class="search-button"></div>
	<div class="search-entry">
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'hikaru' ); ?></span>
		<input type="search" class="search-field" placeholder="Search" value="" name="s" title="Search for:" autocomplete="off"/> 
	</div> 
</form>
	<nav id="site-navigation" class="main-navigation">
			<?php
			if ( has_nav_menu( 'menu-1' ) ) :
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) );
			else:?>
			<ul>
				<?php 
					wp_list_pages( array(
						'container' => '',
						'title_li' 	=> __('Pages','hikaru'),
					) );
				?>
			</ul>
			<?php endif; ?>
	</nav><!-- #site-navigation -->
			
</div>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'hikaru' ); ?></a>

	<header id="masthead" class="site-header">
		
	<?php

		if ( has_nav_menu( 'menu-main' ) && get_theme_mod( 'hikaru_sticky_menu',false )) :?>
			<nav class="sticky-navigation">
				<?php wp_nav_menu( array(
					'theme_location' => 'menu-main',
					'menu_id'        => 'primary-menu',
				) );?>
				<?php get_search_form();?>
			</nav><!-- #main menu -->

		<?php endif; 
		
		/* social menu */
		do_action( 'hikaru_action_social_menu')?>
		
		<div class="site-branding">
			<?php the_custom_logo(); ?>
			<div class="wrapper">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
					$hikaru_description = get_bloginfo( 'description', 'display' );
					if ( $hikaru_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo $hikaru_description; /* WPCS: xss ok. */ ?></p>
					<?php endif; ?>
			</div>
			
		</div><!-- .site-branding -->

		<div class="hamburger hamburger--spring">
			<div class="hamburger-box">
				<div class="hamburger-inner"></div>
			</div>
		</div>
		
	</header><!-- #masthead -->

	<div id="content" class="site-content">
