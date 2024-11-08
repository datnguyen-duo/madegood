<?php get_header(); ?>
    
    <?php while( have_posts() ): the_post(); ?>
        <section class="default-page" id="default-page">
            <h1 class="default-page__heading headline__split-text"><?php the_title(); ?></h1> 
            <div class="default-page__content st__fade">
                <?php the_content(); ?>
            </div>
        </section>
    <?php endwhile; ?>
<?php get_footer();