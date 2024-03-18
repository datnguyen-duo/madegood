<div class="form_checkout_page_container">
    <div class="checkout_fields">
        <?php
        /**
         * Checkout Form
         *
         * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
         *
         * HOWEVER, on occasion WooCommerce will need to update template files and you
         * (the theme developer) will need to copy the new files to your theme to
         * maintain compatibility. We try to do this as little as possible, but it does
         * happen. When this occurs the version of the template file will be bumped and
         * the readme will list any important changes.
         *
         * @see https://docs.woocommerce.com/document/template-structure/
         * @package WooCommerce\Templates
         * @version 3.5.0
         */

        if ( ! defined( 'ABSPATH' ) ) {
            exit;
        }

        do_action( 'woocommerce_before_checkout_form', $checkout );

        // If checkout registration is disabled and not logged in, the user cannot checkout.
        if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
            echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
            return;
        }

        ?>

        <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

            <?php if ( $checkout->get_checkout_fields() ) : ?>

                <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                <div class="accordion_holder details_accordion active_by_default" id="customer_details">
                    <h2 class="accordion_title" data-target=".details_accordion">Details</h2>

                    <div class="accordion_hidden_content">
                        <?php do_action( 'woocommerce_checkout_billing' ); ?>

                        <p class="open_next_accordion" data-target=".shipping_accordion">Continue To Shipping</p>
                    </div>
                </div>

                <div class="accordion_holder shipping_accordion">
                    <h2 class="accordion_title" data-target=".shipping_accordion">Shipping</h2>

                    <div class="accordion_hidden_content">
                        <?php do_action( 'woocommerce_checkout_shipping' ); ?>

                        <p class="open_next_accordion" data-target=".payment_accordion">Continue To Payment</p>
                    </div>
                </div>

                <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

            <?php endif; ?>

<!--            --><?php //do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

<!--            <h3 id="order_review_heading">--><?php //esc_html_e( 'Your order', 'woocommerce' ); ?><!--</h3>-->

<!--            --><?php //do_action( 'woocommerce_checkout_before_order_review' ); ?>

            <div class="accordion_holder payment_accordion woocommerce-checkout-review-order" id="order_review">
                <h2 class="accordion_title" data-target=".payment_accordion">Payment</h2>
                <div class="accordion_hidden_content">
                    <?php do_action( 'woocommerce_checkout_order_review' ); ?>

                    <p class="open_next_accordion" data-target=".rental_info_accordion">Continue To Rental Info</p>
                </div>
            </div>

            <div class="accordion_holder rental_info_accordion woocommerce-checkout-review-order">
                <h2 class="accordion_title" data-target=".rental_info_accordion">Rental Info</h2>
                <div class="accordion_hidden_content">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
            </div>

<!--            --><?php //do_action( 'woocommerce_checkout_after_order_review' ); ?>

        </form>

        <?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
    </div>
    <div class="checkout_cart">
        <?php render_shopping_cart(); ?>
    </div>
</div>