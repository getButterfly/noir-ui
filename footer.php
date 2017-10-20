    <div class="clearfix"></div>
</div>

<footer id="colophon" role="contentinfo">
    <div id="footer-content">
        <div class="footer-widget wide">
            <div class="widget-item">
                <?php if (is_active_sidebar('footer-widget-1')) dynamic_sidebar('footer-widget-1'); ?>
            </div>
        </div>
        <div class="footer-widget wide">
            <div class="widget-item">
                <?php if (is_active_sidebar('footer-widget-2')) dynamic_sidebar('footer-widget-2'); ?>
            </div>
        </div>
        <div class="footer-widget wide">
            <div class="widget-item">
                <?php if (is_active_sidebar('footer-widget-3')) dynamic_sidebar('footer-widget-3'); ?>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="attribution">
        <div class="copyright">
			<?php wp_nav_menu(array('theme_location' => 'footer-menu', 'container' => false)); ?>
            <br><small><?php _e('Powered by', 'noir-ui'); ?> <a href="https://getbutterfly.com/downloads/noir-ui/" rel="external">Noir UI</a>.</small>
            <br><small><?php echo get_theme_mod('noir_footer_copyright_text'); ?></small>
        </div>
    </div>
</footer>

</div>
</div><!-- // wrap -->
</div>
<?php wp_footer(); ?>

</body>
</html>
