<?php
function products_filter(){
    $filtered_category = $_POST['filteredCategory'];

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'tax_query' => array(),
        'orderby' => 'date', 
        'order' => 'asc',
    );

    if( $filtered_category ) {
        array_push($args['tax_query'],array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $filtered_category
        ));
    }

    $products = new WP_Query($args);
    print_products($products);
    die;
}
add_action('wp_ajax_products_filter', 'products_filter');
add_action('wp_ajax_nopriv_products_filter', 'products_filter');

function print_products($query){
    while ( $query->have_posts() ): $query->the_post();
        $product_id = get_the_ID();
        $product = wc_get_product( $product_id );
        $product_price = $product->get_price();
        $product_terms = get_the_terms( $product_id, 'product_cat' );
        $product_gallery = $product->get_gallery_image_ids();
        $product_featured_image = '';
        $product_featured_image_on_hover = '';
        if( $product_gallery ) {
            $product_featured_image = wp_get_attachment_image($product_gallery[0],'large','', array('class'=>'featured_image'));

            if( sizeof($product_gallery) > 1 ) {
                $product_featured_image_on_hover = wp_get_attachment_image($product_gallery[1],'large','',array('class'=>'featured_image_on_hover'));
            }
        } else {
            $product_featured_image = get_the_post_thumbnail($product_id,'large');
        }
        ?>
        <a href="<?php the_permalink(); ?>" class="product__card--item" data-barba-prevent="self">
            <?php if( $product_featured_image ): ?>
                <div class="product__card--image">
                    <?= $product_featured_image; ?>
                    <?= $product_featured_image_on_hover; ?>
                </div>
            <?php endif; ?>

            <p class="product__card--title"><?php the_title(); ?></p>
            <p class="product__card--price"><?= get_woocommerce_currency_symbol().$product_price; ?></p>

        </a>
    <?php endwhile; wp_reset_postdata();
}