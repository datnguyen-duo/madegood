<?php
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
        <h1>Shop</h1>
        <div class="products-index__container">
            <?php print_products($products); ?>
        </div>
    </section>
<?php
get_footer(); ?>