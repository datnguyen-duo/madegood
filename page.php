<?php get_header(); ?>
    <?php while( have_posts() ): the_post(); ?>
        <section class="default-page" id="default-page">
            <?php the_content(); ?>
        </section>
    <?php endwhile; ?>
<?php get_footer();