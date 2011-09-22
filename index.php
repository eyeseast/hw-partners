<?php
/**
 * Template Name: Home
 */
?>

<?php get_header(); ?>
<article id="content" class="span16"> 
    <?php wp_nav_menu(array(
        'theme-location' => 'hero',
        'menu' => 'hero',
        'depth' => 1,
        'container' => false,
        'items_wrap' => '%3$s', 
        'walker' => new Hero_Walker
    )); ?>

    <?php wp_nav_menu(array(
        'theme-location' => 'sidekicks',
        'menu' => 'sidekicks',
        'depth' => 1,
        'container' => 'div',
        'container_class' => 'row',
        'items_wrap' => '%3$s', 
        'walker' => new Sidekick_Walker
    ))?>
</article><!-- end .span16 -->
<?php // just exhause the loop
if ( have_posts() ) while ( have_posts() ): the_post(); endwhile; 
?>
<?php get_footer(); ?>