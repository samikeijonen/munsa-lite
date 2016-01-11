<?php
/**
 * Munsa Lite functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Munsa Lite
 */
 
/**
 * The current version of the theme.
 */
define( 'MUNSA_LITE_VERSION', '1.0.1' );

/**
 * The suffix to use for scripts.
 */
if ( ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) ) {
	define( 'MUNSA_LITE_SUFFIX', '' );
} else {
	define( 'MUNSA_LITE_SUFFIX', '.min' );
}

if ( ! function_exists( 'munsa_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function munsa_lite_setup() {
	
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Munsa Lite, use a find and replace
	 * to change 'munsa-lite' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'munsa-lite', get_template_directory() . '/languages' );

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
	set_post_thumbnail_size( 1420, 9999, false );
	
	// Add custom image sizes.
	add_image_size( 'munsa-medium', 920, 9999, false );
	add_image_size( 'munsa-site-logo', 9999, 192, false );
	add_image_size( 'munsa-smaller', 125, 125, true );

	// This theme uses wp_nav_menu() in two location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'munsa-lite' ),
		'social'  => esc_html__( 'Social Links Menu', 'munsa-lite' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	
	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'audio',
		'gallery',
		'image',
		'video',
	) );
	
	// Add theme support for site logo.
	add_theme_support( 'site-logo', array(
		'size' => 'munsa-site-logo',
	) );
	
	// Add theme support for responsive videos.
	add_theme_support( 'jetpack-responsive-videos' );
	
	// Add excerpt to pages.
	add_post_type_support( 'page', 'excerpt' );
	
	// Add editor styles.
	add_editor_style( array( 'css/editor-style.css', munsa_lite_fonts_url() ) );
	
}
endif; // munsa_lite_setup
add_action( 'after_setup_theme', 'munsa_lite_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function munsa_lite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'munsa_lite_content_width', 1008 );
}
add_action( 'after_setup_theme', 'munsa_lite_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function munsa_lite_widgets_init() {

	$sidebar_primary_args = array(
		'id'            => 'primary',
		'name'          => esc_html_x( 'Primary', 'sidebar', 'munsa-lite' ),
		'description'   => esc_html__( 'The main sidebar. It is displayed on the right side of the page as off canvas sidebar.', 'munsa-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	);
	
	$sidebar_footer_args = array(
		'id'            => 'footer',
		'name'          => esc_html_x( 'Footer', 'sidebar', 'munsa-lite' ),
		'description'   => esc_html__( 'A sidebar located in the footer of the site.', 'munsa-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	);
	
	// Register sidebars.
	register_sidebar( $sidebar_primary_args );
	register_sidebar( $sidebar_footer_args );

}
add_action( 'widgets_init', 'munsa_lite_widgets_init' );

if ( ! function_exists( 'munsa_lite_fonts_url' ) ) :
/**
 * Register Google fonts for the theme.
 *
 * @since 1.0.0
 *
 * @return string Google fonts URL for the theme.
 */
function munsa_lite_fonts_url() {
	
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_attr_x( 'on', 'Merriweather font: on or off', 'munsa-lite' ) ) {
		$fonts[] = 'Merriweather:300,400,700,900,300italic,400italic,700italic,900italic';
	}

	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_attr_x( 'on', 'Montserrat font: on or off', 'munsa-lite' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since 1.0.0
 */
function munsa_lite_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'munsa_lite_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 */
function munsa_lite_scripts() {
	
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'munsa-lite-fonts', munsa_lite_fonts_url(), array(), null );
	
	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/fonts/genericons/genericons.css', array(), '3.4' );
	
	// Enqueue parent theme styles if using child theme.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'munsa-lite-parent-style', trailingslashit( get_template_directory_uri() ) . 'style' . MUNSA_LITE_SUFFIX . '.css', array(), null );
	}
	
	// Enqueue active theme styles.
	wp_enqueue_style( 'munsa-lite-style', get_stylesheet_uri() );
	
	// Enqueue smooth scroll.
	wp_enqueue_script( 'smooth-scroll', get_template_directory_uri() . '/js/smooth-scroll' . MUNSA_LITE_SUFFIX . '.js', array(), '20150906', true );
	
	// Enqueue theme scripts.
	wp_enqueue_script( 'munsa-lite-settings', get_template_directory_uri() . '/js/settings' . MUNSA_LITE_SUFFIX . '.js', array( 'jquery', 'smooth-scroll' ), '20150906', true );
	wp_localize_script( 'munsa-lite-settings', 'screenReaderText', array(
		'expandMenu'      => esc_html__( 'Menu', 'munsa-lite' ),
		'collapseMenu'    => esc_html__( 'Close', 'munsa-lite' ),
		'expandSidebar'   => esc_html__( 'Info', 'munsa-lite' ),
		'collapseSidebar' => esc_html__( 'Close', 'munsa-lite' ),
	) );
	
	// Enqueue skip link focus fix.
	wp_enqueue_script( 'munsa-lite-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix' . MUNSA_LITE_SUFFIX . '.js', array(), '20150906', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'munsa_lite_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function munsa_lite_body_classes( $classes ) {
	
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	
	// Adds a class of primary menu or sidebar is active.
	if ( has_nav_menu( 'primary' ) || is_active_sidebar( 'primary' ) ) {
		$classes[] = 'primary-menu-sidebar-active';
	}

	return $classes;
}
add_filter( 'body_class', 'munsa_lite_body_classes' );

/**
 * Change [...] to just "..." with screen reader text.
 *
 * @since  1.0.0
 * @return void
 */
function munsa_lite_excerpt_more() {

	/* Translators: The %s is the post title shown to screen readers. */
	$text = '<span class="screen-reader-text">' . sprintf( esc_attr__( 'Continue reading %s', 'munsa-lite' ), get_the_title() ) . '</span>';
	$more = sprintf( ' <a href="%s" class="more-link">&hellip; %s</a>', esc_url( get_permalink() ), $text );

	return $more;

}
add_filter( 'excerpt_more', 'munsa_lite_excerpt_more' );


/**
 * Add an HTML class to MediaElement.js container elements to aid styling.
 *
 * Extends the core _wpmejsSettings object to add a new feature via the
 * MediaElement.js plugin API.
 *
 * @author     Brady Vercher
 * @copyright  Brady Vercher
 * @link       http://www.cedaro.com/blog/customizing-mediaelement-wordpress/
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * @since  1.0.0
 * @return void
 */
function munsa_lite_mejs_add_container_class() {
	
	// Check do we have media element.
	if ( ! wp_script_is( 'mediaelement', 'done' ) ) {
		return;
	}

	?>
	<script>
	(function() {
		var settings = window._wpmejsSettings || {};
		settings.features = settings.features || mejs.MepDefaults.features;
		settings.features.push( 'MunsaLiteClass' );

		MediaElementPlayer.prototype.buildMunsaLiteClass = function( player ) {
			player.container.addClass( 'munsa-mejs-container' );
		};
	})();
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'munsa_lite_mejs_add_container_class' );

/**
 * Use a template for individual comment output.
 *
 * @param object $comment Comment to display.
 * @param int    $depth   Depth of comment.
 * @param array  $args    An array of arguments.
 *
 * @since 1.0.0
 */
function munsa_lite_comment_callback( $comment, $args, $depth ) {
	include( locate_template( 'comment.php') );
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Implement the Custom Background feature.
 */
require get_template_directory() . '/inc/custom-background.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Schema.org file.
 */
require get_template_directory() . '/inc/schema.php';

/**
 * Load archive filters file.
 */
require get_template_directory() . '/inc/archive-filters.php';
