<?php
/**
 * Sidebar principal
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package nikocrowtheme2025
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area sidebar">
    <?php dynamic_sidebar('sidebar-1'); ?>
</aside><!-- #secondary -->