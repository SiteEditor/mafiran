<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>> 


<div class="preloader">
	<div class="loader-container arc-rotate">
		<div class="loader">
			<div class="arc"></div>
		</div>
	</div>
</div>

<?php 

$locale = get_locale();

if( is_front_page() && !site_editor_app_on() ) {
	?>
	<div class="intro-wrap">
		<div class="intro-wrap-inner">
			<div class="intro-logo-wrap">
				<img src="http://localhost/mafir/wp-content/uploads/2017/07/logo-intru.png" class="intro-logo">
			</div>
			<div class="intro-language">
				<?php
				if( $locale == 'fa_IR' ) {

					$english_site_url = get_theme_mod( 'mafiran_english_site_url' , 'http://eng.mafiran.com' );

					$english_site_url = esc_url( $english_site_url );

					?>
					<a class="active-language">FA</a>|<a href="<?php echo esc_attr( $english_site_url );?>">EN</a>
					<?php
				}else{

					$main_site_url = 'http://www.mafiran.com';

					?>
					<a class="active-language">EN</a>|<a href="<?php echo esc_attr( $main_site_url );?>">FA</a>
					<?php

				}
				?>
			</div>
		</div>
	</div>
	<?php
}

?>


<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentyseventeen' ); ?></a>

	<?php

	$disable_header = (bool)get_theme_mod( 'sed_disable_header' );

	$header_content_width = get_theme_mod( 'sed_header_content_width' , 'wrap-layout-fixed-width' );

	if( $disable_header === false || site_editor_app_on() ) {

		$hide_class = ( $disable_header !== false ) ? "hide" : "";

		?>

		<header id="masthead" class="site-header <?php echo esc_attr( $header_content_width );?> <?php echo esc_attr( $hide_class );?>" role="banner">

			<?php get_template_part('template-parts/header/header', 'image'); ?>


			<?php if ( site_editor_app_on() ) : ?>
				<div class="twse-navigation-top">
			<?php endif; ?>

				<?php if (has_nav_menu('top')) : ?>
					<div class="navigation-top">
						<div class="wrap">
							<?php get_template_part('template-parts/navigation/navigation', 'top'); ?>
						</div><!-- .wrap -->
					</div><!-- .navigation-top -->
				<?php endif; ?>

			<?php if ( site_editor_app_on() ) : ?>
				</div>
			<?php endif; ?>

		</header><!-- #masthead -->

		<?php
	}

	if( has_post_thumbnail() && ( is_single() || ( is_page() && ! twentyseventeen_is_frontpage() ) ) ) {

		$setting_id = is_page() ? 'sed_disable_page_featured_image_header' : 'sed_disable_single_featured_image_header';

		$disable_featured_image_header = (bool)get_theme_mod( $setting_id , '0');

		$show_featured_image_header = $disable_featured_image_header === false || site_editor_app_on();

		// If a regular post or page, and not the front page, show the featured image.
		if ( $show_featured_image_header ) {

			$hide_class = ( $disable_featured_image_header !== false ) ? "hide" : "";

			echo '<div class="single-featured-image-header ' . esc_attr($hide_class) . '">';

			the_post_thumbnail('twentyseventeen-featured-image');

			echo '</div><!-- .single-featured-image-header -->';

		}

	}

	?>

	<div class="site-content-contain">
		<div id="content" class="site-content">
