<?php
/**
 * The template for displaying all pages.
 */
?>

<?php get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ): the_post(); ?>
<article id="content" class="span8"> 
<div class="row">
	<header class="span8">
		<h1><?php the_title(); ?></h1>
	</header>

	<div class="body span8">
	    <?php the_content(); ?>
	</div>
</div>
</article><!-- end .span8 -->
<div class="clearfix"></div> 
<?php endwhile; ?>
<?php get_footer(); ?>