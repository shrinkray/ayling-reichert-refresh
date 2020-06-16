<?php
/**
 * @package WordPress
 * @subpackage workz Theme
 */
$options = get_option( 'workz_theme_settings' );
?>
<?php get_header(' '); ?>

<div class="home-wrap clearfix">

<!-- Homepage tagline -->
<?php if(!empty($options['home_tagline'])) { ?>
<div id="home-tagline">
	<?php echo $options['home_tagline'] ?>
</div>
<?php } ?>

<!-- Homepage Slider -->
<?php //get_template_part( 'includes/nivo' ) ?>
<?php echo do_shortcode('[crellyslider alias="ar_home"]') ?>

<!-- Homepage Highlights -->
<?php
//get post type ==> hp highlights

	global $post;
	$args = array(
		'post_type' =>'hp_highlights',
		'numberposts' => '-1'
	);
	$portfolio_posts = get_posts($args);
?>
<?php if($portfolio_posts) { ?>        


<div id="home-highlights" class="clearfix">
	<h4 style="text-align: center;">At Ayling & Reichert, we feel that operator safety should be the number one priority in the workplace. Especially in those working environments where flammable liquids are in daily use. We offer a line of affordable hand-operated Safety Pumps that can help you protect both you employees and your company assets. 
</h4><hr>
	<h2>Our Products <img src="http://aylingreichert.com/wp-content/uploads/2013/08/fm_smaller.png" height="40px" width="60px"></h2>

	<?php
	$count=0;
	foreach($portfolio_posts as $post) : setup_postdata($post);
	$count++;
	?>
    
    <div class="hp-highlight <?php if($count == '3') { echo 'highlight-last'; } ?>">
    <h2><?php the_title(); ?></h2>
	<?php the_content(); ?>
    </div>
    
    <?php
	if($count == '3') { echo '<div class="clear"></div>'; $count=0; }
    endforeach; ?>

</div>
<!-- END #home-projects -->      	
<?php } ?>





</div>
<!-- END home-wrap -->   
<?php get_footer(' '); ?>