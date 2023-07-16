<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package fastbreak
 * @since   1.0
 */

?><!DOCTYPE html>
<html>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?><a class="skip-link screen-reader-text" href="#sitecontent"><?php _e( 'Skip to content', 'classicsixteen' ); ?></a> 
<div class="wrapper">
    <header class="header">
        <div class="header-wrap">
            <div class="insdhdr header-logo">
            
            <?php if( has_custom_logo() ) : ?>
            
                <div class="site-logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="bookmark">

                    <?php echo wp_kses_post( force_balance_tags( flexline_theme_custom_logo() ) ); ?>
                    </a>

                </div>

            <?php endif; ?>

            </div>    
                <div class="insdhdr header-1">
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                </div>
                    <div class="insdhdr header-2">
                        <div class="descr-wrap">
                    
                            <?php if( get_theme_mods() ) : ?>
                        
                            <?php do_action( 'flexline_description_header' ); ?>

                            <?php endif; ?>
        
                            <div class="site-description">
                                <?php echo get_bloginfo( 'description', 'display' ); ?>
                            </div>
                        </div>
                    </div>
        </div>
    </header>

        <nav class="nav">
					
            <div id="togmenu" class="nav-list" style="display: flex">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary-menu',
                    'menu_class' => 'page-nav',
                    //'walker' => new Fastbreak_Wrap(),
                )
            );
            ?>
            </div>
        </nav>