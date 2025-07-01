<?php get_header('hero'); ?> 

<div class="content-area">
    <div class="main-content">
        
        <?php if (have_posts()) : ?>
            
            <?php while (have_posts()) : the_post(); ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    
                    <div class="post-meta">
                        <?php echo get_the_date(); ?> - <?php the_author(); ?>
                    </div>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-image">
                            <?php the_post_thumbnail(); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="post-content">
                        <?php the_excerpt(); ?>
                    </div>
                    
                </article>
                
            <?php endwhile; ?>
            
            <div class="pagination">
                <?php previous_posts_link('« Anterior'); ?>
                <?php next_posts_link('Siguiente »'); ?>
            </div>
            
        <?php else : ?>
            
            <p>No hay posts para mostrar.</p>
            
        <?php endif; ?>
        
    </div>

    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>