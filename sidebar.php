<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package flexline
 * @since flexline 1.0
 */
?>
<aside class="aside aside-1">
<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
	<div id="secondary" class="sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar' ); ?>
    </div><!-- .sidebar .widget-area -->
<?php endif; ?>
</aside>
  <aside class="aside aside-2">
  <?php if ( is_active_sidebar( 'sidebar-second' ) ) : ?>
	<div id="secondary" class="sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-second' ); ?>
    </div><!-- .sidebar .widget-area -->
<?php endif; ?>
</aside> 
