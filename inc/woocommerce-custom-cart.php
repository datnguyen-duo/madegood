<?php function render_shopping_cart() {
    $woocommerce_cart = WC()->cart->get_cart();
    $checkout_url = wc_get_checkout_url();
    $currency_symbol = get_woocommerce_currency_symbol();
    $cart_price = WC()->cart->get_cart_contents_total();
    $cart_shipping = WC()->cart->get_cart_shipping_total();
    $checkout_page = get_post(wc_get_page_id('checkout'));
    $total_items = ( WC()->cart->get_cart_contents_count() ) ? WC()->cart->get_cart_contents_count() : 0; ?>
    <div class="cart" data-action="<?= site_url().'/wp-admin/admin-ajax.php' ?>">
        <div class="cart__container">
            <div class="cart__headline">
                <h2>Cart</h2>
                <div class="cart__close link"></div>
            </div>

            <div class="cart__loader">
                <div class="spinner"></div>
            </div>

            <div class="cart__items">
                <?php if( $woocommerce_cart ): ?>
                    <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ):
                        // $item_name = $cart_item['data']->get_title();
                        $item_name = $cart_item['data']->name;
                        $product_id = $cart_item['product_id'];
                        $variation_id = $cart_item['variation_id'];
                        $price = $cart_item['data']->get_price();
                        $quantity = $cart_item['quantity'];
                        $image = get_the_post_thumbnail($product_id, 'large', array('class' => 'product-image'));

                        if( !$image ) {
                            $product = wc_get_product( $product_id );
                            $attachment_ids = $product->get_gallery_image_ids();

                            if( $attachment_ids ) {
                                $image = wp_get_attachment_image($attachment_ids[0], 'large', '', array('class' => 'product-image'));
                            }
                        } ?>
                        <div class="cart__item" id="cart_item_<?= $cart_item_key; ?>">
                            <div class="cart__item--image">
                                <?= $image ?>
                            </div>

                            <div class="cart__item--info">
                                <h4><?= $item_name; ?></h4>
                                <div class="row">
                                    <p>Quantity:</p>
                                    <input data-item-id="<?= $cart_item_key ?>" class="cart__item--quantity-input" type="number" value="<?= $quantity ?>" min="1">
                                </div>
                                <p class="price">Price: <?= $currency_symbol; ?><?= ($price * $quantity) ?></p>
                                <button class="cart__item--remove linke" data-target="<?= $cart_item_key ?>">Remove</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else:
                    echo '<p class="cart__empty-message">Your cart is empty.</p>';
                endif; ?>
            </div>

            <div class="cart__footer">
                <div class="cart__total">
                    <h5>Total</h5>
                    <h2><?= $currency_symbol.$cart_price; ?></h2>
                </div>

                <?php if( $woocommerce_cart && $checkout_page && $checkout_page->post_status == 'publish' ): ?>
                    <a href="<?= $checkout_url; ?>" class="cart__checkout btn" data-barba-prevent="self">Checkout</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php }

/**
 * Add to cart
 **/
function woo_custom_cart_add_to_cart() {
    $product_id = $_POST['productID'];
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;
    return WC()->cart->add_to_cart($product_id, $quantity);
}
add_action('wp_ajax_woo_custom_cart_add_to_cart', 'woo_custom_cart_add_to_cart');
add_action('wp_ajax_nopriv_woo_custom_cart_add_to_cart', 'woo_custom_cart_add_to_cart');

/**
 * Remove item from cart
 **/
function woo_custom_cart_remove_from_cart() {
    $cart_item_key = $_POST['cartItemKey'];
    return WC()->cart->remove_cart_item($cart_item_key);
}
add_action('wp_ajax_woo_custom_cart_remove_from_cart', 'woo_custom_cart_remove_from_cart');
add_action('wp_ajax_nopriv_woo_custom_cart_remove_from_cart', 'woo_custom_cart_remove_from_cart');

/**
 * Update/Render cart
 **/
function woo_custom_cart_update() {
    render_shopping_cart();
    die;
}
add_action('wp_ajax_woo_custom_cart_update', 'woo_custom_cart_update');
add_action('wp_ajax_nopriv_woo_custom_cart_update', 'woo_custom_cart_update');

/**
 * Update cart item
 **/
function woo_custom_cart_update_cart_item_quantity() {
    $cart_item_key = $_POST['cartItemKey'];
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;
    return WC()->cart->set_quantity($cart_item_key, $quantity);
}
add_action('wp_ajax_woo_custom_cart_update_cart_item_quantity', 'woo_custom_cart_update_cart_item_quantity');
add_action('wp_ajax_nopriv_woo_custom_cart_update_cart_item_quantity', 'woo_custom_cart_update_cart_item_quantity');