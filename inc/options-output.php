<?php 
/**
 * Page options settings
 */

// A1
add_action( 'wp_enqueue_scripts', 'flexline_theme_customizer_css', 15 );  
// A2
add_action( 'admin_menu',         'flexline_theme_options_help_page' );

/**
 * Text sanitizer for numeric values
 * @since 1.0
 * @see https://themefoundation.com/wordpress-theme-customizer/
 * @return string $input
 */
function flexline_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
} 

/** @A2
 * Add theme menu
 *
 * @since 1.0.1
 * @uses add_theme_page()
 * $page_title, $menu_title, $capability, $menu_slug, $function
 */
function flexline_theme_options_help_page() {

    add_theme_page(
        __( 'Theme Information', 'flexline' ),
        __( 'flexline Help', 'flexline' ),
        'edit_theme_options',
        'flexline-theme-help',
        'flexline_siteinfo_admin_render'
    );
}
/** A1
 * CUSTOM FONT OUTPUT, CSS
 * The @font-face rule should be added to the stylesheet before any styles. (priority 2)
 * @uses background-image as linear gradient meerly remove any input background image.
 * @since 1.0.0
*/
function flexline_theme_customizer_css() 
{   
    $fnt = $css = $font = ''; 
    $ankr_colr  = '#5d7900'; $bkgs_colr = '#fafafa'; $gent_colr = '#474849';
    $uria  = get_stylesheet_directory_uri() . '/rels/abel-latin-400-normal.woff2';
    $urib  = get_stylesheet_directory_uri() . '/rels/bruno-ace-latin-400-normal.woff';
    $uric  = get_stylesheet_directory_uri() . '/rels/bruno-ace-latin-400-normal.woff2';
    
    if( get_theme_mods() ) : 
    $gent_colr  = ( empty( get_theme_mod( 'flexline_gentext_color' ) ) ) ? '#474849' 
                         : get_theme_mod( 'flexline_gentext_color' );
    $ankr_colr  = ( empty( get_theme_mod( 'flexline_anchor_color' ) ) ) ? '#5d7900' 
                         : get_theme_mod( 'flexline_anchor_color' );
    $bkgs_colr  = ( empty( get_theme_mod( 'flexline_bkgrnds_color' ) ) ) ? '#fafafa' 
                         : get_theme_mod( 'flexline_bkgrnds_color' );
    $fnt        = ( empty( get_theme_mod( 'flexline_fontfamily' ) ) ) ? 'abel' 
                         : get_theme_mod( 'flexline_fontfamily' );
    $logo       = ( empty( get_theme_mod( 'flexline_logosize' ) ) ) ? '100' 
                         : get_theme_mod( 'flexline_logosize' );        
    endif;

    if( $fnt == 'abel' ) {
        $font .= '@font-face { font-family: "Abel"; font-style: normal; font-weight: 400;
        src: url( ' . esc_url($uria) . ' ) format("woff2");unicode-range: U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+0300-0301,U+0303-0304,U+0308-0309,U+0323,U+0329,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}';
        $font .= 'body, button, input, select, textarea{font-family: "Abel", sans-serif;}';
    } 
    if( $fnt == 'bruno' ) { 
        $font .= '@font-face {font-family: "Bruno Ace"; font-style: normal; font-weight: 400;
        src: url('. $uric . ' format("woff2"), url(' . $urib . ') format("woff"); unicode-range: U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+0300-0301,U+0303-0304,U+0308-0309,U+0323,U+0329,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}';
        $font .= 'body, button, input, select, textarea{font-family: "Bruno Ace", sans-serif;font-size:14px;color: #606060;}@media only screen and (min-width: 768px){.nav ul.sub-menu{margin-top: 1em;}}';
    } 
    if( $fnt == 'default' ) { 
        $font .= 'body, button, input, select, textarea, .h1{font-family: Arial, Helvetica, Verdana, "Segoe UI", sans-serif; font-size:16px;}
            @media only screen and (min-width: 768px){.nav ul.sub-menu{margin-top: 1.168em;}}';
    }
    if( $fnt == 'roman' ) { 
        $font .= 'body, button, input, select, textarea, .h1{font-family: "Times-Roman", "Times New Roman", Times, serif, Georgia, Roman;font-size: 15px;}';
    } 

    /* use above set values into inline styles */
    $css .= $font . 'body, button, input, select, textarea, p{color: '. esc_attr( $gent_colr ) .';}a:not(.nav a),.current_page_item a,.current_page_ancestor a, h2:not(.widget-title){color: '. sanitize_hex_color($ankr_colr) . '}.nav li.menu-item-has-children,.nav li.menu-item-has-children:after{border-color: '. sanitize_hex_color($ankr_colr) . '}
    .header-logo img{height: ' . flexline_sanitize_integer( $logo ) . 'px;}.header,.footer,.nav a{background: ' . sanitize_hex_color( $bkgs_colr ) . '}.current_page_item a, .current_page_ancestor a{background: rgba(252,252,252, .8);}';
    
    wp_register_style( 'flexline-inline-customizer', true );
	wp_enqueue_style( 'flexline-inline-customizer' );
	wp_add_inline_style( 'flexline-inline-customizer', $css );
        
} 


/**
 * information about website
 * @since 1.0.1
 * @return HTML string
 */

 function flexline_siteinfo_admin_render(){
    if ( !is_admin() ) return;
    ?>
    <div class="wrap">
        <div id="icon-themes" class="icon32"></div>
        <h2><?php esc_html_e( 'flexline Theme Help', 'flexline' ); ?></h2>
        <?php settings_errors(); ?>
       
    <section>
    <div>
        <p><a class="button" href="<?php echo esc_url( admin_url( '/customize.php?autofocus[section]=flexline_header' ) ); ?>" 
           title="Customizer"><?php esc_html_e('Customize Theme Settings', 'flexline'); ?></a></p>
    </div>
    </section>
    
    <section><h2><?php esc_html_e( 'Theme Help', 'flexline' ); ?></h2>
    <p><?php esc_html_e( 'For support issues please use the Issues panel on our Github account for this theme.', 'flexline'); ?>
    <a href="<?php echo esc_url('https://github.com/tradesouthwest/flexline/issues'); ?>" 
       title="<?php esc_attr_e('theme support', 'flexline'); ?>" target="_blank">
       <?php esc_html_e('Open Issue for Support', 'flexline'); ?></a>
       <small><?php esc_html_e('[opens in new window]', 'flexline'); ?></small></p>
        <h3><?php esc_html_e('Tips', 'flexline'); ?></h3>
        <ul>
            <li>&#9733; <?php esc_html_e('Advert box in header can be used for more than advertising. Try adding player of the month or deal for the day.', 'flexline'); ?></li>
            <li>&#9733; <?php esc_html_e('For cusomtizations you can reach out to the theme author on Github Issues tracker, linked above.', 'flexline'); ?></li>
            <li>&#9733; <?php esc_html_e('Mobile menus should be well adjusted on all devices. If you find a particular browser/device that is looking odd, please open a new issue so we can update the theme.', 'flexline'); ?></li>
            <li>&#9733; <?php esc_html_e('Base background color for top bars and footer has white text. Be sure to compensate by using darker backgrounds.', 'flexline'); ?></li>
            <li>&#9733; <?php esc_html_e('Title on Front Page template is hidden. To show title edit out line 1148 in the stylesheet.', 'flexline'); ?>
            <code>.home .page-title{ display: flex; }</code></li>
            <li>&#9733; <?php esc_html_e('Theme by TradeSouthWest https://tradesouthwest.com', 'flexline'); ?></li>
            <li>&#9733; <?php esc_html_e('ver 1.0.0', 'flexline'); ?></li>
        </ul>
    </section>
    
    </div>
<?php 
}
