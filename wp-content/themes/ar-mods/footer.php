<?php
/**
 * @package WordPress
 * @subpackage workz Theme
 */
$options = get_option( 'workz_theme_settings' );
?>
<div class="clear"></div>

</div>
<!-- END wrap --> 

    <div id="footer-wrap">
    <div id="footer">
    
        <div id="footer-widget-wrap" class="clearfix">
    
            <div id="footer-left">
            <?php dynamic_sidebar('footer-left'); ?>
            </div>
            
            <div id="footer-middle">
             <?php dynamic_sidebar('footer-middle'); ?>
            </div>
            
            <div id="footer-right">
             <?php dynamic_sidebar('footer-right'); ?>
            </div>
        
        </div>
    
        <div id="footer-bottom">
        
            <div id="copyright">
                &copy; <?php echo date('Y'); ?>  <?php bloginfo( 'name' ) ?>
            </div>
            
            <div id="back-to-top">
                <a href="#toplink"><?php _e('back up', 'workz'); ?> &uarr;</a>
            </div>
        
        </div>
    
    </div>
</div>

<!-- WP Footer -->
<?php wp_footer(); ?>
</body>
</html>