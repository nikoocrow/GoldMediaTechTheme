<?php get_header('hero'); ?>
<main id="primary" class="site-main">
    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <div>
            <p><?php the_content();?></p>
        </div>
    <?php endwhile; ?>
<?php else : ?>
    <p>No se encontraron posts.</p>
<?php endif; ?>
</main>

<?php get_footer(); ?>