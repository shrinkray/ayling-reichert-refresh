<?php
/**
 * @package WordPress
 * @subpackage workz Theme
 * Template Name:Contact
 */
?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!-- END page-heading -->


    <?php the_content(); ?>  
	
	<!-- END entry -->
    
</div>
<!-- END post -->

<?php endwhile; ?>
<?php endif; ?>	  

<?php get_footer(); ?>