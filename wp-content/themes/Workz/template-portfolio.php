<?php
/**
 * @package WordPress
 * @subpackage workz Theme
 * Template Name: Portfolio
 */
?>

<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div id="page-heading">
	<h1><?php the_title(); ?></h1>
    
    
    
    <?php 
		//get portfolio categories
		$cats = get_terms('portfolio_cats');
		//show filter if categories exist
		if($cats[1] !='') { ?>
        
        <!-- Portfolio Filter -->
        <ul class="filter clearfix">
        	<li class="sort"><?php _e('Sort Items','workz'); ?>:</li>
            <li class="cat-item active"><a href="#all" class="all-cats"><span><?php _e('All', 'workz'); ?></span></a></li>
            <?php
            foreach ($cats as $cat ) : ?>
            <li class="cat-item"><a href="#<?php echo $cat->slug; ?>" class="<?php echo $cat->slug; ?>"><span><?php echo $cat->name; ?></span></a></li>
            <?php endforeach; ?>
        </ul>
        
	<?php } ?>
    
</div>
    
	<div class="post full-width clearfix">
    
<?php endwhile; ?>
<?php endif; ?>
        
    
    <div id="portfolio-wrap" class="clearfix">
    
    	<?php
		//get post type ==> portfolio
		query_posts(array(
			'post_type'=>'portfolio',
			'posts_per_page' => -1,
			'paged'=>$paged
		));
		?>
    
        <?php
        while (have_posts()) : the_post();
        //get portfolio thumbnail
        $thumbail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'portfolio-thumb');
		//get terms
		$terms = get_the_terms( get_the_ID(), 'portfolio_cats' );
        ?>
        
        <?php if ( has_post_thumbnail() ) {  ?>
 		<div class="portfolio-item <?php if($terms) { foreach ($terms as $term) { echo $term->slug . ' ';}}?>">
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $thumbail[0]; ?>" height="<?php echo $thumbail[2]; ?>" width="<?php echo $thumbail[1]; ?>" alt="<?php echo the_title(); ?>" /></a>
		<div class="portfolio-item-details">
	   		<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo the_title(); ?></a></h2>
       	</div>
    </div>
        <?php } ?>
        
        <?php endwhile; ?>
          
    </div>
    
	<?php if (function_exists("pagination")) { pagination(); } wp_reset_query(); ?>


</div>
<?php the_content(); ?>
<?php get_footer(); ?>