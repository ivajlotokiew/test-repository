<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

</div><!-- .site-content -->

<footer id="colophon" class="site-footer" role="contentinfo">
    <?php if (is_active_sidebar('footer-sidebar')) : ?>
        <div class="widget-area">
            <?php dynamic_sidebar('footer-sidebar'); ?>
        </div><!-- .widget-area -->
    <?php endif; ?>

</footer><!-- .site-footer -->
</div><!-- .site-inner -->
</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>
