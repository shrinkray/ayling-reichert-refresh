<?php
/**
 * @package WordPress
 * @subpackage workz Theme
 */
?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


    <!-- END page-heading -->

    <div class="post clearfix">

        <div class="entry clearfix">
            <?php the_content(); ?>
        </div>
        <!-- END entry -->

    </div>
    <!-- END post -->

<?php endwhile; ?>
<?php endif; ?>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>
