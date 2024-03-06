<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CustomBookStore
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text"
            href="#primary"><?php esc_html_e( 'Skip to content', 'custombookstore' ); ?></a>
		
        <header id="masthead" class="site-header">
			<div class="header__main">
				<div class="container">
					<div class="row">
						<div class="col-md-3 telephone justify-content-md-start d-none d-sm-none d-md-flex">
							<a href="tel:79999999999"><i class="bi bi-telephone me-3"></i></a>
							<a href="tel:79999999999"><?php echo carbon_get_theme_option( 'crb_phone' ); ?></a>
						</div>

						<div class="col-md-6 logo">
							<?php the_custom_logo();?>
						</div>

						<div class="col-md-3 buttons justify-content-md-end justify-content-center">
								<button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="bi bi-search-heart"></i></button>
								<button class="btn" type="button" onclick="location.href='<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>'"><i class="bi bi-person"></i></button>
								<button id="minicart" class="btn" type="button" title="<?php _e( 'Показать корзину' ); ?>" onclick="location.href='<?php echo WC()->cart->get_cart_url(); ?>'">
								<span class="cart_number"><?php echo sprintf('%d', WC()->cart->cart_contents_count); ?></span>
								<i class="bi bi-cart"></i></button>
								<!-- <?php woocommerce_mini_cart() ?> -->
							</div>
					</div>
					<div class="row">
						<div class="col-md-1">

						</div>
							<?php
								wp_nav_menu(
									array(
										'theme_location' => '',
										'menu_id'        => 'headerheader-menu',
										'menu_class'=> 'nav',
										'container_class' => 'col-md-10 custom_menu',
									)
								);
							?>
						
						<div class="col-md-1">
							
						</div>
					</div>
				</div>
				<!-- Modal -->
				<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModal" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-body">
								<?php aws_get_search_form( true ); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
        </header>