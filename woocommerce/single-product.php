<?php
get_header();
global $item;
$product_id = get_the_ID();
$product = wc_get_product( $product_id );
$gallery = $product->get_gallery_image_ids();
// $booking = new WC_Product_Booking(get_the_ID());
$product_terms = get_the_terms( $product_id, 'product_cat' );

//var_dump($booking);

// add_filter( 'wc_bookings_calendar_default_to_current_date', 'your_prefix_wc_bookings_calendar_default_to_current_date', 99 );
// function your_prefix_wc_bookings_calendar_default_to_current_date(){return false;}

// if( is_wc_booking_product($product) ):
$rental_period = get_field('rental_period');
$specs = get_field('specs');
$features = get_field('features');
$work_examples = get_field('work_examples');
$work_examples_desc = get_field('work_examples_description');
?>
    <section class="product">
        <div class="product__banner">
            <div class="product__gallery">
                <?php if( $gallery ): ?>
                    <div class="product-gallery--images">
                        <?php foreach ( $gallery as $image ): ?>
                            <div class="product-gallery--image"> 
                                <?php echo wp_get_attachment_image($image, 'full', '', array('loading' => 'lazy') ); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php elseif( get_the_post_thumbnail(get_the_ID()) ): ?>
                    <div class="product-gallery--featured-image">
                        <?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="product__info">
                <h2 class="product__title"><?php the_title(); ?></h2>
                <h3 class="product__price"><?= get_woocommerce_currency_symbol().$product->get_price() ?></h3>
                <div class="row">
                    <label for="">
                        Select Size:
                    </label>
                    <?php
                    $variations = $product->get_available_variations();
                    foreach ($variations as $key => $variation) {
                        $variation_id = $variation['variation_id'];
                        $variation_attributes = $variation['attributes'];
                        $variation_price = $variation['display_price'];
                        $variation_is_in_stock = $variation['is_in_stock'];
                        $variation_label = implode(', ', $variation_attributes);
                        $variation_disabled = $variation_is_in_stock ? '' : 'disabled';
                        echo '<input type="radio" id="variation_' . $variation_id . '" name="variation_id" value="' . $variation_id . '" ' . $variation_disabled . ($key === 0 ? " checked" : "") . '>';
                        echo '<label class="size" for="variation_' . $variation_id . '">' . $variation_label . '</label>';
                    }
                    ?>
                </div>
                <div class="row">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1">
                    <button class="add-to-cart link btn" data-product-id="<?= get_the_ID(); ?>">Add To Cart</button>
                </div>
                <div class="product__description">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>

        <?php
        $args = array(
            'posts_per_page' => 4,
            'columns'        => 4,
            'orderby'        => 'rand',
            'order'          => 'desc',
        );
        $args['related_products'] = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), $args['posts_per_page'], $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );

        $args['related_products'] = array_filter($args['related_products'], function($related_product) use ($product) {
            return $related_product->get_id() !== $product->get_id();
        });
        
        $args['related_products'] = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] );

        if( $args['related_products'] ): ?>
            <div class="product__related">
                <h2>More Products</h2>
                <a href="/shop/" data-barba-prevent="self" class="btn">See All</a>
                <div class="product__related--items">
                    <?php foreach ( $args['related_products'] as $related ):
                        $related_data = $related->get_data();
                        $related_gallery = $related->get_gallery_image_ids();
                        $related_featured_image = '';
                        $related_featured_image_on_hover = '';
                        if( $related_gallery ) {
                            $related_featured_image = wp_get_attachment_image($related_gallery[0],'large','', array('loading' => 'lazy'));
                            if( sizeof($related_gallery) > 1 ) {
                                $related_featured_image_on_hover = wp_get_attachment_image($related_gallery[1],'large','',array('loading' => 'lazy'));
                            }
                        } else {
                            $related_featured_image = get_the_post_thumbnail($related->id,'large');
                        }
                        ?>
                        <a class="product__card--item" href="/madegood/product/<?php echo $related_data['slug'] ?>" data-barba-prevent="self">
                            <?php if( $related_featured_image ): ?>
                                <div class="product__card--image">
                                    <?= $related_featured_image; ?>
                                    <?= $related_featured_image_on_hover; ?>
                                </div>
                            <?php endif; ?>
                            <p class="product__card--title"><?= $related_data['name']; ?></h3>
                            <h4 class="product__card--price"><?= get_woocommerce_currency_symbol().$related->get_price(); ?></h4>
                        </a>
                    <?php endforeach; ?>
                </div>

            </div>
        <?php endif; ?>
    </section>
 <?php get_footer(); ?>