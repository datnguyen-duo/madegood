<?php
function render_shopping_cart_items($is_item_added_to_cart = false) {
    $woocommerce_cart = WC()->cart->get_cart();

    if( $woocommerce_cart ):
        $checkout_url = wc_get_checkout_url();
        $currency_symbol = get_woocommerce_currency_symbol();
        $cart_price = WC()->cart->get_cart_contents_total();
        $cart_shipping = WC()->cart->get_cart_shipping_total();

        if( $is_item_added_to_cart ):
            $last_added_product_id = end( WC()->cart->cart_contents)['product_id'];
            $last_product_title = get_the_title($last_added_product_id); ?>
            <p class="item_added_to_cart_message"><?= $last_product_title; ?> has been added to cart.</p>
        <?php endif;

        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ):
//            var_dump($cart_item);
            // $is_bookable = ($cart_item['data']->get_type() == 'booking');
            $item_name = $cart_item['data']->get_title();
            $product_id = $cart_item['product_id'];
            $price = $cart_item['data']->get_price();
            $image = get_the_post_thumbnail($product_id);

            // $booking_duration_days = "";
            // $booking_duration_weeks = "";

            // if( $is_bookable ) {
            //     $booking_duration_days = $cart_item['booking']['_duration'];

            //     if( $booking_duration_days >= 7 ) {
            //         $booking_duration_weeks = floor($booking_duration_days / 7);
            //         $booking_duration_days = $booking_duration_days - ($booking_duration_weeks * 7);
            //     }
            // }
            ?>
            <div class="item item_<?php echo $product_id; ?>" id="cart_item_<?php echo $cart_item_key; ?>">
                <div class="item_info_col image_col">
                    <div class="item_info_col_inner_col">
                        <a href="<?= get_permalink($product_id) ?>" class="image_holder"><?= $image; ?></a>
                    </div>
                    <div class="item_info_col_inner_col">
                        <div class="item_name"><?= $item_name; ?></div>

                        <?php if( $booking_duration_weeks || $booking_duration_days ): ?>
                            <p class="item_rental_period">
                                <?php if( $booking_duration_weeks ): ?>
                                    <span><?= $booking_duration_weeks ?><?= ( $booking_duration_weeks > 1 ) ? ' Weeks' : ' Week'; ?></span>
                                <?php endif; ?>

                                <?= ( $booking_duration_weeks && $booking_duration_days ) ? ' & ' : null ?>

                                <?php if( $booking_duration_days ): ?>
                                    <span><?= $booking_duration_days ?><?= ( $booking_duration_days > 1 ) ? ' Days' : ' Day'; ?></span>
                                <?php endif; ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="item_info_col">
                    <div class="item_price"><?= $currency_symbol.$price; ?></div>
                    <p class="remove_item" data-target="<?php echo $cart_item_key ?>">Remove</p>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="cart_footer">
            <div class="cart_shipping_price">
                <h4>Shipping Costs</h4>
                <p><?= ( is_numeric($cart_shipping) ) ? $currency_symbol.$cart_shipping : $cart_shipping ?></p>
            </div>
            <div class="cart_total_price_holder">
                <h4>Total price</h4>
                <p><?= $currency_symbol.$cart_price; ?></p>
            </div>
            <div class="checkout_btn_holder">
                <a href="<?= $checkout_url; ?>">Checkout</a>
            </div>
        </div>
    <?php else:
        echo '<p class="empty_cart_message">Your cart is empty.</p>';
    endif;
}

function update_shopping_cart() {
    $is_item_added_to_cart = $_POST['addedToCart'];
    render_shopping_cart_items($is_item_added_to_cart);
    die;
}
add_action('wp_ajax_updateshoppingcart', 'update_shopping_cart'); // wp_ajax_{ACTION HERE}
add_action('wp_ajax_nopriv_updateshoppingcart', 'update_shopping_cart');

function render_shopping_cart() {
    $checkoutPage = ( is_checkout() && empty( is_wc_endpoint_url('order-received')) );
    $total_items = ( WC()->cart->get_cart_contents_count() ) ? WC()->cart->get_cart_contents_count() : 0;
    ?>
    <div class="custom_cart_overlay <?php echo ( $checkoutPage ) ? ' checkout_page' : null; ?>"></div>

    <div class="custom_side_cart <?php echo ( $checkoutPage ) ? ' checkout_page' : null; ?>" data-action="<?php echo site_url() ?>/wp-admin/admin-ajax.php">
        <div class="custom_side_cart_content">
            <div class="cart_header">
                <h2 class="title">Cart <span id="cart_total_items">(<?= ( $total_items == 0 || $total_items > 1 ) ? $total_items.' items' : $total_items.' item' ?>)</span></h2>

                <div class="close_cart">Close</div>
            </div>

            <div class="items" id="response">
                <?php render_shopping_cart_items(); ?>
            </div>
        </div>
    </div>
<?php }

function woo_custom_remove_from_cart() {
    $cart_item_key = $_POST['cartItemKey'];
    WC()->cart->remove_cart_item($cart_item_key);
}
add_action('wp_ajax_woo_custom_remove_from_cart', 'woo_custom_remove_from_cart'); // wp_ajax_{ACTION HERE}
add_action('wp_ajax_nopriv_woo_custom_remove_from_cart', 'woo_custom_remove_from_cart');