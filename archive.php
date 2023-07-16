<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flexline
 * @since Flexline 1.0
 */
get_header(); ?>

<section class="main central">
    <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
    
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope 
        itemtype="https://schema.org/Article">
        <div class="inner-content">
        <header>
        <h2><?php the_title(
            sprintf( '<span class="post-title"><a href="%s" rel="bookmark">', 
            esc_attr( esc_url( get_permalink() ) ) 
        ), '</a></span>' ); ?></h2>
        </header>
            <div class="page-content">
                <?php the_excerpt(); ?>
            </div>
        </div>
    </article>

    <?php endwhile; ?>
    <?php else : ?>
    
        <div class="post-content">
        
        <p><?php echo esc_url( home_url('/') ); ?>
        <?php esc_html_e('Can not find content. ', 'flexline'); ?></p>
        
        </div>

    <?php endif; ?>
</section>
<?php get_sidebar(); ?>

<?php get_footer(); ?> 