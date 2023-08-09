<?php
/**
 * Flexline functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in ClassicPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Flexline
 * @since 1.0.0
 */

// FAST LOADER References ( find @id in DocBlocks )
// ------------------------- Actions ---------------------------
// A1
add_action( 'after_setup_theme',       'flexline_theme_setup' );
// A2
add_action( 'after_setup_theme',       'flexline_theme_content_width', 0 );
// A3
add_action( 'wp_enqueue_scripts',      'flexline_theme_enqueue_styles' );
// A4
add_action( 'widgets_init',            'flexline_theme_widgets_init' );
// A5
add_action( 'flexline_adjustable_excerpts', 'flexline_adjustable_excerpts_length' );
// A6
add_action( 'flexline_render_attachment', 'flexline_render_attachment_link' );
// A7
add_action( 'flexline_description_header', 'flexline_description_header_text' );
// A8 
add_action( 'flexline_single_meta_footer', 'flexline_single_meta_footer_render' );
// A9
add_action( 'flexline_check_pagination', 'flexline_check_pagination_pre' );
// A10
add_action( 'flexline_header_img',       'flexline_header_background_img' );
// A11
add_action( 'flexline_archive_title',    'flexline_archive_title_render' );
// A12
add_action( 'flexline_post_title',       'flexline_post_title_render' );

if ( ! function_exists( 'wp_body_open' ) ) {
    /**
    * Add backwards compatibility support for wp_body_open function.
    */
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}


/** #A1
 * Sets up theme defaults and registers support for various ClassicPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own flexline_setup() function to override in a child theme.
 *
 * @since flexline 1.0
 */
if ( ! function_exists( 'flexline_theme_setup' ) ) :

	function flexline_theme_setup() {
		/*
		* Make theme available for translation.
		* Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentysixteen
		* If you're building a theme based on flexline, use a find and replace
		* to change 'flexline' to the name of your theme in all the template files
		*/
		load_theme_textdomain( 'flexline', get_template_directory_uri() . '/languages' );

		/* a.
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
		
		// a.
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));
		/* b.
		* Let ClassicPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded "title" tag in the document head, and expect ClassicPress to provide it for us.
		*
		* Enable support for Post Thumbnails on posts and pages.
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
		// b.
		add_theme_support( 'title-tag' );
    	add_theme_support( 'automatic-feed-links' ); // rss feederz 
        /*
		 * Enable support for custom logo.
		 * page background image and color support
		 */
		add_theme_support( 'post-thumbnails', array( 'post', 'page') );
		// register new phone-landscape featured image size. @width, @height, and @crop
		add_image_size( 'flexline-featured', 520, 300, false);   

		add_theme_support( 'custom-background', 
			array( 
		   'default-color'      => '#fcfcfc',
		   'default-image'       => '',
		   'wp-head-callback'     => '_custom_background_cb',
		   'admin-head-callback'   => '',
		   'admin-preview-callback' => ''
		) );
		add_theme_support( 'custom-logo' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary-menu' => __( 'Primary Main Menu', 'flexline' ),
				'secondary-menu'  => __( 'Top - No stacking', 'flexline' ),
			)
		);
	}
endif;


/** #A2
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Classic Sixteen 1.0
 */
function flexline_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'flexline_content_width', 766 );
}

/** #A3
 * Enqueues scripts and styles.
 *
 * @since Classic Sixteen 1.0
 */
function flexline_theme_enqueue_styles() {
	$ver = time();
	wp_enqueue_style( 
		'flexline-style', 
		get_stylesheet_uri() 
	);
    
    if ( is_singular() && comments_open() ) {
		wp_enqueue_script( 
			'comment-reply' 
		);
	}
}

/** 
 * Registers an editor stylesheet for the theme.
 *
 * @since 1.0.0
 */
function flexline_theme_add_editor_styles() {

    add_editor_style( 'editor-style.css' );
}

/**
 * Support for logo upload, output. 
 *
 * @since 1.0.1 
 */
function flexline_theme_custom_logo() {
    $output = '';

    if ( function_exists( 'the_custom_logo' ) ) {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $logo           = wp_get_attachment_image_src( $custom_logo_id , 'full' );

        if ( has_custom_logo() ) {
            $output = '<span class="header-logo"><img src="'. esc_url( $logo[0] ) .'" 
            alt="'. get_bloginfo( 'name' ) .'"></span>'; 
        } else { 
            $output = ''; 
        }
    }

        // Output sanitized in header to assure all html displays.
        return $output;
} 
/** #A4
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Classic Sixteen 1.0
 */
function flexline_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar One', 'flexline' ),
			'id'            => 'sidebar',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'flexline' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Sidebar Two', 'flexline' ),
			'id'            => 'sidebar-second',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'flexline' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Section One', 'flexline' ),
			'id'            => 'footer-one',
			'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'flexline' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

/** #A6
 * Attachment link for featured images
 *
 * @since 1.0.2
 * @return HTML
 */
function flexline_render_attachment_link(){
?>  
	<figure class="linked-attachment-container">
		<div class="flexline-attachment">
	<a class="imgwrap-link"
		href ="<?php echo esc_url( get_attachment_link( get_post_thumbnail_id() ) ); ?>" 
		title="<?php the_title_attribute( 'before=Permalink to: &after=' ); ?>">
	<?php 
	the_post_thumbnail( 'flexline-featured', array( 
			'itemprop' => 'image', 
			'class'  => 'flexline-featured',
			'alt'  => get_attachment_link( get_post_thumbnail_id() )
		) 
	); ?></a>
		</div><div class="flexline-additional">
			<?php 
			if ( ! has_excerpt() ) { 
			    echo esc_attr('');	
			} else {
				the_excerpt(); 
			} 
			?>
		</div>
	</figure>
<?php 
}
	
/** 
 * Customizer
 * suport footer background & text color
 * header background & color
 * page background & color
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/options-output.php';


/** @A7
 * Render text above description in header.
 * @since 1.0.0 
 * @return HTML
 */
function flexline_description_header_text(){
	
    $desctext = ( empty( get_theme_mod( 'flexline_desctext' ) ) ) 
	              ? '' : get_theme_mod( 'flexline_desctext' );
    echo '<div class="descript-text">' . wp_kses_post( $desctext ) . '</div>';
}

/** #A5
 * Sets number of words for an exceprt
 * @since 1.0.0
 * @uses theme_mod     `flexline_excerpt_leng`
 * @param $leng string Number of words per excerpt
 * @return HTML 
 */
function flexline_adjustable_excerpts_length() {
	// flexline_excerpt_leng
	$leng = ( empty( get_theme_mod( 'flexline_excerpt_leng' ) ) ) ? '65' 
		   : absint( get_theme_mod( 'flexline_excerpt_leng' ) );

	echo wp_kses_post( wp_trim_words( get_the_content(), absint( $leng ),
	    '&nbsp;<a class="readon" href="' . get_the_permalink() . '" 
	   	title="'. esc_attr__( 'Read Full Article', 'flexline' ) . '">
		<span class="read-on"> &hellip; </span></a>' ) 
	); 
} 

/** #A8
 * Meta data for single posts
 *
 * @since 1.0
 * @return HTML
 */
function flexline_single_meta_footer_render(){
    ob_start();
	?>
    <aside class="after-content">
		<p class="after-cats"><span><small><?php esc_html_e('By: ', 'flexline'); ?></span> <em><?php the_author(); ?></em></small>
		| <span><small><?php esc_html_e('Categorized as: ', 'flexline'); ?></span> <em><?php the_category( ' &bull; ' ); ?></em></small>
		| <span><small><?php esc_html_e('Keys: ', 'flexline'); ?></span> <em><?php the_tags( ' ' ); ?></em></small>
		| <span><small><?php esc_html_e('Date: ', 'flexline'); ?></span> <em><?php the_date(); ?></em></small></p>
		

	</aside>
	<?php 
	echo wp_kses_post( force_balance_tags( ob_get_clean() ) );
} 

/** #A9
 * Show prenav text if pagination
 * 
 * @since 1.0
 * @param string $prev_link Boolean
 * @param string $next_link Boolean
 */
function flexline_check_pagination_pre()
{
    $prev_link = get_previous_posts_link();
	$next_link = get_next_posts_link();
	
	if ( $next_link ) { 

	echo '<span class="prenav">' . esc_html__( 'More Pages', 'flexline' ) . '</span>';
	} 
	    elseif( $prev_link ) { 

	echo '<span class="prenav">' . esc_html__( 'No more entries for this page.', 'flexline' ) . '</span>';
	} 
	else {
		echo '';
	}
} 

/** #A10
 * Render background style to heading of excerpt with featured image.
 *
 * @since 1.0.0
 * @return HTML
 */
function flexline_header_background_img()
{
	$thumb = get_the_post_thumbnail_url( absint( $post->ID ), 'thumbnail' );
	echo 'style="background-image: url( ' . esc_url($thumb) . ' ); "'; 
}

/** #A10
 * Render style to heading of archive excerpt.
 *
 * @since 1.0.0
 * @return HTML
 */
function flexline_archive_title_render()
{

	$title = the_title('','',false);
	if (empty($title)) { 
    	echo '<h4><a href="'. esc_url( get_permalink() )  .'" rel="bookmark"># ' 
    	. esc_html( get_the_ID() . ' ' . get_the_date() ) . '</a></h4>'; 
	} else { 
    	the_title( sprintf( '<h4><span class="post-title"><a href="%s" rel="bookmark">', 
            esc_url( get_permalink() ) 
		    ), 
            '</a></span></h4>' 
		);
	}
	
} 

/** #A10
 * Render style to heading of blog posts.
 *
 * @since 1.0.0
 * @return HTML
 */
function flexline_post_title_render()
{

	$title = the_title('','',false);
	if (empty($title)) { 
    	echo '<h2><a href="'. esc_url( get_permalink() )  .'" rel="bookmark"># ' 
    	. esc_html( get_the_ID() ) . '</a></h2>'; 
	} else { 
    	echo '<h2 class="post-title"><a href="'. esc_url( get_permalink() ) .'" 
		          title="'. esc_attr( get_the_title() ) .'"><span>'. esc_html( get_the_title() ) .'</span></a>
                <sub><small class="h2date">' . esc_html( get_the_date() ) . '</small></sub></h2>';
	}
	
}  