<?php
/**
 * The Blog template file
 *
 * It is used to display the blog page when the blog page is set as home.
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

        <header class="excerpt-heading" <?php do_action('flexline_header_img'); ?>>
            <?php do_action( 'flexline_post_title' ); ?>
        </header>
            <div class="page-content with-excerpt">

                <div class="inner-content">
                
                    <?php do_action( 'flexline_adjustable_excerpts' ); ?> 

                </div>
            </div>
        </div>
       
    </article>

    <?php endwhile; ?>

        <nav class="pagination-nav">
            <p><span class="nav-previous alignleft">
            <?php previous_posts_link( '<span class="prevpst-nav"> < </span>' ); ?>
            </span>
            <span class="algn-cntr">
                <?php do_action( 'flexline_check_pagination' ); ?>
            </span>
            <span class="nav-next alignright">
                <?php next_posts_link( '<span class="nextpst-nav"> > </span>' ); ?>
            </span></p>
        </nav>

    <?php else : ?>
    
        <div class="post-content">
        
        <p><?php echo esc_url( home_url('/') ); ?>
        <?php esc_html_e('Can not find content. ', 'flexline'); ?></p>
        
        </div>

    <?php endif; ?>
</section>
<?php get_sidebar(); ?>

<?php get_footer(); ?> 