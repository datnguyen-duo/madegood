(function ($) {
    var customSideCart = $(".custom_side_cart");
    var customSideCartOverlay = $(".custom_cart_overlay");
    var customSideCartOpener = $(".custom_side_cart_opener");
    var bookableSingleProductPage = $('.single_booking_product_page_container');
    var checkOutPage = $('.woocommerce-checkout');

    function openSideCart() {
        customSideCart.addClass('active');
        customSideCartOverlay.fadeIn();
    }

    function closeSideCart() {
        customSideCart.removeClass('active');
        customSideCartOverlay.fadeOut();
    }

    customSideCartOpener.on("click", function () {
        openSideCart();
    });

    customSideCart.find(".close_cart").on("click", function () {
        closeSideCart();
    });

    customSideCartOverlay.on('click', function(){
        closeSideCart();
    });

    //Update items in shopping cart
    function updateShoppingCart(isItemAddedToCart) {
        var responseDiv = document.getElementById("response");

        $.ajax({
            url: customSideCart.data("action"),
            data: {
                action: "updateshoppingcart",
                addedToCart: isItemAddedToCart
            }, // form data
            type: "POST", // POST
            beforeSend: function (xhr) {},
            success: function (data) {
                responseDiv.innerHTML = data;
                //Refresh html for total items in cart
                $('#cart_total_items').load(document.URL +  ' #cart_total_items');
                //Refresh html for total items in cart END
            },
            complete: function (xhr, status) {
                openSideCart();

                if( customSideCart.hasClass('checkout_page') && !customSideCart.find('.items .item').length ) {
                    window.location.href = '/';
                }
            },
        });
    }
    //Update items in shopping cart END

    //Event after adding to cart action
    $("body").on("added_to_cart", function () {
        updateShoppingCart(true);
    });
    //Event after adding to cart action END

    //Remove item from cart function
    customSideCart.on("click", ".remove_item", function (event) {
        event.preventDefault();
        let cartItemKey = $(this).data("target");
        $.ajax({
            url: $('.custom_side_cart').data('action'),
            data: {
                action: "woo_custom_remove_from_cart",
                cartItemKey: cartItemKey,
            },
            type: "POST", // POST
            beforeSend: function (xhr) {
                $("#cart_item_" + cartItemKey).slideUp(250);
            },
            success: function (data) {
                if( bookableSingleProductPage.length ) {
                    wc_bookings_booking_form.wc_bookings_date_picker.init();
                }

                if( checkOutPage.length ) {
                    $('body').trigger('update_checkout');
                }

                setTimeout(function(){
                    updateShoppingCart();
                }, 250);
            },
            complete: function (xhr, status) {},
        });
    });
    //Remove item from cart function END
})(jQuery);