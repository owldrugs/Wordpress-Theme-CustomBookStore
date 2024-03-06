<?php
/**
 * CustomBookStore functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CustomBookStore
 */

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {
    Container::make( 'theme_options', __( 'Theme Options' ) )
        ->add_fields( array(
            Field::make( 'text', 'crb_phone', 'Номер' ),
			Field::make( 'text', 'crb_email', 'Почта' ),
			Field::make( 'text', 'crb_vk', 'Ссылка вк' ),
			Field::make( 'text', 'crb_youtube', 'Ссылка ютуб' ),
			Field::make( 'text', 'crb_instagram', 'Ссылка инстаграмм' ),
        )
	);
}

add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( 'vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}


if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function custombookstore_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on CustomBookStore, use a find and replace
		* to change 'custombookstore' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'custombookstore', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'custombookstore' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'custombookstore_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'custombookstore_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function custombookstore_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'custombookstore_content_width', 640 );
}
add_action( 'after_setup_theme', 'custombookstore_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function custombookstore_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Сайдбар', 'custombookstore' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'custombookstore' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'custombookstore_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function custombookstore_scripts() {
	wp_enqueue_style( 'custombookstore-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'custombookstore-main', get_template_directory_uri().'/css/main.min.css' );
	wp_enqueue_style( 'bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css');
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri().'/css/bootstrap/dist/js/bootstrap.bundle.min.js');
	//wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js');
	wp_enqueue_script( 'cart-js', get_template_directory_uri().'/js/cart.js');
	wp_style_add_data( 'custombookstore-style', 'rtl', 'replace' );

	wp_enqueue_script( 'custombookstore-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'custombookstore_scripts' );

/**
 * Check for any theme dependencies
 *
 * @return array
 */
function M247_check_theme_dependencies() {
    $missing = array();
    $plugins = array(
        'advanced-woo-search/advanced-woo-search.php' => 'Advanced Woo Search',
		'svg-support/svg-support.php' => 'Поддержка SVG',
    );
    foreach($plugins as $plugin => $name) {
        if(!is_plugin_active($plugin) )
            $missing[$plugin] = $name;
    }
    return $missing;
}

/**
 * Check for theme required plugins
 *
 */
function M247_theme_dependencies() {
    $plugins = M247_check_theme_dependencies();
    foreach($plugins as $plugin => $name) {
        if(!is_plugin_active($plugin) )
            echo '<div class="error"><p>' . sprintf(__( 'Warning: The M247 theme requires the plugin %s.', 'M247'), $name ) . ' <a href="'.admin_url().'plugins.php">' . sprintf(__( 'View Plugins', 'M247'), $name ) . '</a></p></div>';
    }
}
add_action( 'admin_notices', 'M247_theme_dependencies' );

/**
 * Implement the Custom Fonts feature.
 */
function enqueue_custom_fonts(){
	if(!is_admin()){
		wp_register_style( 'source_sans_pro', 'https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap' );
		wp_register_style( 'montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap' );
		
		wp_enqueue_style( 'source_sans_pro' );
		wp_enqueue_style( 'montserrat' );
	}
}
add_action('wp_enqueue_scripts','enqueue_custom_fonts' );
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);

add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> – <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php
	$fragments['a.cart-customlocation'] = ob_get_clean();
	return $fragments;
}

do_action( 'woocommerce_set_cart_cookies', TRUE );


function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 150,
        'single_image_width'    => 300,

        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 2,
            'max_rows'        => 8,
            'default_columns' => 4,
            'min_columns'     => 2,
            'max_columns'     => 5,
        ),
    ) );
}

add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

function true_breadcrumbs(){
 
	// получаем номер текущей страницы
	$page_num = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
 
	$separator = ' / '; //  разделяем обычным слэшем, но можете чем угодно другим
 
	// если главная страница сайта
	if( is_front_page() ){
 
		if( $page_num > 1 ) {
			echo '<a href="' . site_url() . '">Главная</a>' . $separator . $page_num . '-я страница';
		} else {
			echo 'Вы находитесь на главной странице';
		}
 
	} else { // не главная
 
		echo '<a href="' . site_url() . '">Главная</a>' . $separator;
 
 
		if( is_single() ){ // записи
 
			the_category( ', ' ); echo $separator; the_title();
 
		} elseif ( is_page() ){ // страницы WordPress 
 
			the_title();
 
		} elseif ( is_category() ) {
 
			single_cat_title();
 
		} elseif( is_tag() ) {
 
			single_tag_title();
 
		} elseif ( is_day() ) { // архивы (по дням)
 
			echo '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a>' . $separator;
			echo '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a>' . $separator;
			echo get_the_time('d');
 
		} elseif ( is_month() ) { // архивы (по месяцам)
 
			echo '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a>' . $separator;
			echo get_the_time('F');
 
		} elseif ( is_year() ) { // архивы (по годам)
 
			echo get_the_time( 'Y' );
 
		} elseif ( is_author() ) { // архивы по авторам
 
			global $author;
			$userdata = get_userdata( $author );
			echo 'Опубликовал(а) ' . $userdata->display_name;
 
		} elseif ( is_404() ) { // если страницы не существует
 
			echo 'Ошибка 404';
 
		}
 
		if ( $page_num > 1 ) { // номер текущей страницы
			echo ' (' . $page_num . '-я страница)';
		}
 
	}
 
}

add_action( 'woocommerce_after_cart', 'custom_after_cart' );
function custom_after_cart() {
    echo '<script>
    jQuery(document).ready(function($) {
        var upd_cart_btn = $(".update-cart-button");
        upd_cart_btn.hide();
        $(".cart-form").find(".qty").on("change", function(){
            upd_cart_btn.trigger("click");
        });
    });
    </script>';
}
add_action( 'wp_footer', 'cart_update_qty_script' );

function cart_update_qty_script() {
    if (is_cart()) :
    ?>
    <script>
        jQuery('div.woocommerce').on('change', '.qty', function(){
            jQuery("[name='update_cart']").trigger("click"); 
        });
    </script>
    <?php
    endif;
}

add_filter('woocommerce_add_message', '__return_false');

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] );   // Remove the additional information tab
    return $tabs;
}
function woocommerce_template_single_attributes() {
	wc_get_template( 'single-product/attributes.php' );
}
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 5 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_attributes', 5 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

function woocommerce_template_loop_attributes() {
	wc_get_template( 'loop/attributes.php' );
}

add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_attributes', 5 );

remove_action( 'woocommerce_cart_is_empty', 'woocommerce_output_all_notices', 5 );

function wif_woocommerce_header_add_to_cart_fragment($fragments) {

    ob_start();

    ?>
	<span class="cart_number">
		<?php echo sprintf('%d', WC()->cart->cart_contents_count); ?>
	</span>

    <?php

    $fragments['.cart_number'] = ob_get_clean();

    return $fragments;
}

add_filter('woocommerce_add_to_cart_fragments', 'wif_woocommerce_header_add_to_cart_fragment');