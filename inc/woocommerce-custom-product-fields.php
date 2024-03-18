<?php
function camera_product_field(): array {
    return [
        ['label' => 'Name', 'name' => 'user_name'],
        ['label' => 'Email', 'name' => 'user_email'],

    ];
}

add_action( 'woocommerce_before_add_to_cart_button', 'add_fields_before_add_to_cart' );
function add_fields_before_add_to_cart() {
    global $product;
//    $categories = $product->get_category_ids();
//    $category = get_term($categories[0]);
    ?>
        <div class="custom_fields_container">
            <div class="input_holder">
                <input type="text" name="user_name" id="user_name" placeholder="Name">
            </div>

            <div class="input_holder">
                <input type="text" name="user_email" id="user_email" placeholder="Email">
            </div>
        </div>
<?php }

/**
 * Add data to cart item
 */
add_filter( 'woocommerce_add_cart_item_data', 'add_cart_item_data', 25, 2 );

function add_cart_item_data( $cart_item_meta, $product_id ) {
    $product = wc_get_product( $product_id );
//    $categories = $product->get_category_ids();
//    $category = get_term($categories[0]);
    $fields = camera_product_field();

    if( $fields ):
        $custom_data = array();

        foreach( $fields as $field ):
            //$custom_data[$field['name']] = isset($_POST[$field['name']]) ? sanitize_text_field($_POST[$field['name']]) : "" ;
            $custom_data[$field['name']] = $_POST[$field['name']] ? sanitize_text_field($_POST[$field['name']]) : "-" ;
        endforeach;

        $cart_item_meta['custom_data'] = $custom_data;
    endif;

    return $cart_item_meta;
}

/**
 * Display the custom data on cart and checkout page
 */
add_filter( 'woocommerce_get_item_data', 'get_item_data' , 25, 2 );

function get_item_data($other_data, $cart_item) {
    $product = wc_get_product( $cart_item['product_id'] );
//    $categories = $product->get_category_ids();
//    $category = get_term($categories[0]);
    $fields = camera_product_field();

    if( $fields )  {
        if ( isset($cart_item['custom_data']) ) {
            $custom_data = $cart_item['custom_data'];

            foreach( $fields as $field ):
                $other_data[] = array('name' => $field['label'], 'display' => $custom_data[$field['name']]);
            endforeach;
        }
    }

    return $other_data;
}

///**
// * Add order item meta
// */
add_action( 'woocommerce_add_order_item_meta', 'add_order_item_meta' , 10, 2);

function add_order_item_meta ( $item_id, $values ) {
    $product = wc_get_product( $values['product_id'] );
//    $categories = $product->get_category_ids();
//    $category = get_term($categories[0]);
    $fields = camera_product_field();

    if( $fields ):
        if ( isset($values['custom_data']) ) {
            $custom_data = $values['custom_data'];

            foreach( $fields as $field ):
                wc_add_order_item_meta( $item_id, $field['label'], $custom_data[$field['name']] );
            endforeach;
        }
    endif;
}