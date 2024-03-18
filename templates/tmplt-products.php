<?php
/* Template Name: Products Listing */
get_header();
$products = new WP_Query(array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'date', 
    'order' => 'asc',
));

?>
   <section class="products-index">
        <?php the_title('<h1>', '</h1>'); ?>
        <div class="products-index__container">
            <?php print_products($products); ?>
        </div>
    </section>
<?php
get_footer(); ?>