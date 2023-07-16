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
    <?php while ( have_posts() ) : the_post(); ?>
    
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope 
        itemtype="https://schema.org/Article">
        <div class="inner-content">
        <header>
        <?php the_title('<h2 class="page-title">', '</h2>'); ?>
        </header>
            <div class="page-content">
            <?php do_action( 'flexline_render_attachment' ); ?>
                <?php the_content(); ?>
            </div>
        </div>
    </article>
    <div class="comments-aside">
                
                <?php comments_template(); ?>
                    
    </div>
        
    <?php endwhile; ?>
    
    
</section>
<?php get_sidebar(); ?>

<?php get_footer(); ?> 