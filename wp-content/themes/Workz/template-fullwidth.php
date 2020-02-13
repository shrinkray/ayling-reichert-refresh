<?php
/**
 * @package WordPress
 * @subpackage workz Theme
 * Template Name:fullwidth
 */
?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div id="page-heading">
    <h1><?php the_title(); ?></h1>		
</div>
<!-- END page-heading -->


    <?php the_content(); ?>  
	
	<!-- END entry -->
    
</div>
<!-- END post -->

<?php endwhile; ?>
<?php endif; ?>	  

<?php get_footer(); ?>