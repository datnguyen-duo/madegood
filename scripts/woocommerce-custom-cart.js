(function ($) {
    function openSideCart() {
        $("body").addClass('init__cart')
    }

    function closeSideCart() {
        $("body").removeClass('init__cart')
    }

    /**
     * Open Cart on open cart selector click
     * **/
    $(document).on('click', '.open-cart', function () {
        openSideCart()
    })

    /**
     * Update element data-product-id with add to cart selector
     * on variation select input change
     * **/
    $(document).on('change', 'input[name="variation_id"]', function () {
        let variationID = $(this).val()
        $('.add-to-cart').data('product-id', variationID).attr('data-product-id', variationID)
    })

    /**
     * Update element data-quantity-id with add to cart selector
     * on quantity input change
     * **/
    $(document).on('change', 'input[name="quantity"]', function () {
        let quantity = $(this).val()
        $('.add-to-cart').data('quantity', quantity).attr('data-quantity', quantity)
    })

    /**
     * Close CART on close cart selector click
     * **/
    $(document).on('click', ".cart__close", function () {
        closeSideCart()
    })

    /**
     * Close CART on ESC key press
     * **/
    $(document).keyup(function(e) {
        if( e.key === "Escape" ) {
            closeSideCart()
        }
    })

    /**
     * ADD to CART on selector click
     * **/
    $(document).on('click', '.add-to-cart', function () {
        let productID = $(this).data('product-id')
        let quantity = ($(this).data('quantity')) ? $(this).data('quantity') : 1
        addToCart(productID, quantity)
    })

    /**
     * Remove PRODUCT from CART on selector click
     * **/
    $(document).on("click", ".cart__item--remove", function (event) {
        event.preventDefault()
        let cartItemKey = $(this).data("target")
        removeItemFromCart(cartItemKey)
    })

    /**
     * ADD PRODUCT to CART function
     * **/
    function addToCart(productID, quantity = 1) {
        cartIsUpdating(true)

        $.ajax({
            url: $(".cart").data("action"),
            data: {
                action: "woo_custom_cart_add_to_cart",
                productID: productID,
                quantity: quantity,
            },
            type: "POST",
            beforeSend: function (xhr) {},
            success: function (data) {
                updateShoppingCart()
            },
            complete: function (xhr, status) {
                if( $(".cart").hasClass('checkout_page') && !$(".cart").find('.items .item').length ) {
                    window.location.href = '/'
                }
            },
        })
    }

    /**
     * Remove PRODUCT from CART function
     * **/
    function removeItemFromCart(item) {
        cartIsUpdating(true)

        $.ajax({
            url: $('.cart').data('action'),
            data: {
                action: "woo_custom_cart_remove_from_cart",
                cartItemKey: item,
            },
            type: "POST", // POST
            beforeSend: function (xhr) {
                $("#cart_item_" + item).slideUp(250)
            },
            success: function (data) {
                updateShoppingCart()

                // if( checkOutPage.length ) {
                //     $('body').trigger('update_checkout')
                // }
            },
            complete: function (xhr, status) {},
        })
    }

    /**
     * Update/Rerender CART
     * **/
    function updateShoppingCart() {
        let cartResponse = document.getElementById("cart-response")

        $.ajax({
            url: $(".cart").data("action"),
            data: {
                action: "woo_custom_cart_update",
            },
            type: "POST",
            beforeSend: function (xhr) {},
            success: function (data) {
                $(cartResponse).html(data)
            },
            complete: function (xhr, status) {
                openSideCart()

                if( $(".cart").hasClass('checkout_page') && !$(".cart").find('.items .item').length ) {
                    window.location.href = '/'
                }

                setTimeout(function (){
                    cartIsUpdating(false)
                }, 200)
            },
            // error: function (err) {}
        })
    }

    $(document).on('change', '.cart__item--quantity-input', function () {
        let cartItemKey = $(this).data('item-id')
        let quantity = $(this).val()
        updateItemQuantity(cartItemKey, quantity)
    })

    /**
     * Update CART ITEM quantity function
     * **/
    function updateItemQuantity(cartItemKey, quantity) {
        cartIsUpdating(true)

        $.ajax({
            url: $('.cart').data('action'),
            data: {
                action: "woo_custom_cart_update_cart_item_quantity",
                cartItemKey: cartItemKey,
                quantity: quantity,
            },
            type: "POST", // POST
            beforeSend: function (xhr) {},
            success: function (data) {
                updateShoppingCart()
            },
            complete: function (xhr, status) {},
        })
    }

    function cartIsUpdating(flag = true) {
        if( flag ) {
            $('.cart').addClass('cart--updating')
            $(".cart input, .cart button").prop('disabled', true)
        } else {
            $('.cart').removeClass('cart--updating')
            $(".cart input, .cart button").prop('disabled', false)
        }
    }
})(jQuery)