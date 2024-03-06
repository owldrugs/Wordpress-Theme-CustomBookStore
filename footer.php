<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CustomBookStore
 */

?>

	<footer id="colophon" class="site-footer">

		<!--<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'custombookstore' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'custombookstore' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'custombookstore' ), 'custombookstore', '<a href="http://underscores.me/">Underscores.me</a>' );
				?>
		</div> .site-info -->
		<div class="container footer__site d-flex">
			<div class="row footer__topmenu pt-3 pb-5 gy-4">
				<div class="col-md-3 col-sm-12 mb-2 ">
					<?php the_custom_logo();?>
					<a class="fs-5 phone__link mt-2" href="tel:79999999999"><?php echo carbon_get_theme_option( 'crb_phone' ); ?></a>
					<div class="text-center fs-6">
						Бесплатно по&nbsp;России<br>с&nbsp;9&nbsp;до&nbsp;20&nbsp; по&nbsp;будням<br>с&nbsp;10&nbsp;до&nbsp;19&nbsp;— в&nbsp;выходные
					</div>
					<div class="mt-2">
						<a class="fs-5 mail__link" href="mailto:test@gmail.com" class="fs-6">
							<?php echo carbon_get_theme_option( 'crb_email' ); ?>
						</a>служба поддержки
					</div>
					
				</div>

				<div class="col-md-3 col-sm-6 footer__contacts justify-content-sm-center justify-content-md-start">
					<h4 class="mt-2 mb-2 mb-2 text-decoration-underline">Информация</h4>
					<a class="" href="<?= esc_url( get_page_link( 22 ) ); ?>">О нас</a>
					<a href="<?= esc_url( get_page_link( 62 ) ); ?>">Контакты</a>
				</div>

				<div class="col-md-3 col-sm-6 footer__main">
					<h4 class="mt-2 mb-2 mb-2 text-decoration-underline">Основное</h4>
					<?php
					// Получим ID категории
					$category_id = get_cat_ID( 'Домашние животные' );

					// Теперь, получим УРЛ категории
					$category_link = get_category_link( $category_id );
					?>

					<a class="" href="<?= esc_url( get_page_link( 15 ) ); ?>">Каталог</a>
					<a href="/product-category/nonfiction_lit/">Нехудожественная</a>
					<a href="/product-category/friction_lit/">Художественная</a>
				</div>
					

				<div class="col-md-3 col-sm-12">
					<h4 class="mt-2">Социальные сети</h4>
					<div class="row d-inline-flex flex-row flex-md-column flex-xl-row mt-1 row-gap-1 column-gap-1">
						<a href="" target="_blank" class="btn-social btn-instagram"><i class="fa fa-instagram"></i></a>
						<a href="" target="_blank" class="btn-social btn-vk "><i class="fa fa-vk"></i></a>
						<a href="" target="_blank" class="btn-social btn-youtube"><i class="fa fa-youtube"></i></a>
					</div>
				</div>
			</div>
			<div class="row footer__botmenu pt-3 pb-1 justify-content-center justify-content-md-around">
				<div class="col-sm-4 col-5 year">© 2023–<?php echo date("Y"); ?></div>
				<div class="col-2 d-none d-md-block"></div>
				<div class="col-2 d-none d-md-block"></div>
				<div class="col-sm-4 col-5"><button class="btn btn-outline" onclick="location.href='/constacts/'">Написать нам</button></div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
