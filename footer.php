</div><!-- .container -->
    </main><!-- #primary -->

    <footer id="colophon" class="site-footer">
        <div class="container">
            
            <?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4')) : ?>
                <div class="footer-widgets">
                    <div class="footer-widgets-grid">
                        <?php for ($i = 1; $i <= 4; $i++) : ?>
                            <?php if (is_active_sidebar('footer-' . $i)) : ?>
                                <div class="footer-widget-<?php echo $i; ?>">
                                    <?php dynamic_sidebar('footer-' . $i); ?>
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                </div><!-- .footer-widgets -->
            <?php endif; ?>

            <div class="site-info">
                <div class="footer-navigation">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer',
                            'menu_id'        => 'footer-menu',
                            'container'      => false,
                            'menu_class'     => 'footer-menu',
                            'depth'          => 1,
                            'fallback_cb'    => false,
                        )
                    );
                    ?>
                </div>

                <div class="copyright">
                    <?php
                    $copyright_text = get_theme_mod('nikocrowtheme2025_copyright', '© 2025 Mi Sitio Web');
                    echo esc_html($copyright_text);
                    ?>
                    <span class="sep"> | </span>
                    <?php
                    /* translators: 1: Theme name, 2: Theme author. */
                    printf(esc_html__('Tema: %1$s por %2$s.', 'nikocrowtheme2025'), 'nikocrowtheme2025', '<a href="http://nikocrow.com/">NikoCrow</a>');
                    ?>
                </div><!-- .copyright -->
            </div><!-- .site-info -->
        </div><!-- .container -->
    </footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>