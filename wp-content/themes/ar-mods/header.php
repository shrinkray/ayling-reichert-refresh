<?php
/**
 * @package WordPress
 * @subpackage workz Theme
 */
$options = get_option( 'workz_theme_settings' );
?>
<!DOCTYPE html>

<!-- BEGIN html -->
<html <?php language_attributes(); ?>>
<!-- Design by AJ Clarke (http://www.wpexplorer.com) - Powered by WordPress (http://wordpress.org) -->

<!-- BEGIN head -->
<head>

<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' |'; } ?> <?php bloginfo('name'); ?></title>
    
<!-- Stylesheet & Favicon -->
<?php if($options['favicon'] !='') { ?>
<link rel="icon" type="image/png" href="<?php echo $options['favicon']; ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />

<!-- WP Head -->
<?php if ( is_single() || is_page() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-68041797-1', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body <?php body_class(); ?>>

<div id="header" class="clearfix">
        <div id="logo">
        	<?php
            	if($options['upload_mainlogo'] !='') { ?>
					<a href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>"><img src="<?php echo $options['upload_mainlogo']; ?>" alt="<?php bloginfo( 'name' ) ?>" /></a>
			 	<?php } else { ?>
            	<a href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>"><?php bloginfo( 'name' ) ?></a>
            <?php } ?>
            
        </div>
        <!-- END logo -->
        
        <div id="navigation" class="clearfix">
            <?php
            //define main navigation
            wp_nav_menu( array(
                'theme_location' => 'menu',
                'sort_column' => 'menu_order',
                'menu_class' => 'sf-menu',
                'fallback_cb' => 'default_menu'
            )); ?>
        </div>
        <!-- END navigation -->   
</div><!-- END header -->

<div id="wrap" class="clearfix">