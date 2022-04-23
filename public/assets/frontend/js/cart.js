/*** Button Cart ***/
$(document).on('click', '#cart-icon, #cart-icon-mobile', function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    var box = $(document).find('#cart-box');
    $.ajax({
        async: true,
        url: url,
        type: 'GET',
    }).done(function (response) {
        box.html(response);
    });
});

/*** Increase Quantity ***/
$(document).on('click', 'button.increase', function () {
    var input = $(this).parents('.range-quantity').find('input');
    var value = parseInt(input.val(), 10);
    value = isNaN(value) ? 0 : value;
    value++;
    input.val(value);

    var cost_price = $(this).parents('.range-quantity').find('.cost-price');
    var final_price = $(this).parents('.range-quantity').find('.final-price');
    if (value >= 1) {
        var final_price_value = parseInt(value) * parseInt(cost_price.html());
        final_price.html(final_price_value);
    }
});

/*** Decrease Quantity ***/
$(document).on('click', 'button.decrease', function () {
    var input = $(this).parents('.range-quantity').find('input');
    var value = parseInt(input.val(), 10);
    value = isNaN(value) ? 0 : value;
    value--;
    if (value > 0) {
        input.val(value);
    }

    var cost_price = $(this).parents('.range-quantity').find('.cost-price');
    var final_price = $(this).parents('.range-quantity').find('.final-price');
    if (value >= 1) {
        var final_price_value = parseInt(value) * parseInt(cost_price.html());
        final_price.html(final_price_value);
    }
});


/*** Add to cart ***/
$(document).on('change', '#capacity-select', function () { /* Select Capacity */
    var parent = $(this).parents('#group-add-to-cart');
    if ($(this).val() !== "") {
        parent.find('.select2-selection--single').attr('style', 'border: solid 2px #198754 !important');
        parent.find('.select2-selection__rendered').removeClass('text-danger');
        parent.find('.select2-selection__rendered').addClass('text-success');
        parent.find('.validate-msg').remove();
    }
});

function addToCart(url) {
    $(document).on('click', '#btn-add-to-cart', function () {
        var data = $(this).attr('data-product');
        var parent = $(this).parents('#group-add-to-cart');
        var select_capacity = parent.find("#capacity-select");

        if (select_capacity.length > 0 && select_capacity.val() === "") {
            var validate_msg = ($('html').attr("lang") === "en") ? 'Please select the capacity' : '請選擇容量';
            parent.find('.select2-selection--single').attr('style', 'border: solid 2px red !important');
            parent.find('.select2-selection__rendered').addClass('text-danger');
            if (parent.find('.validate-msg').length === 0) {
                parent.find('.capacity').append('<span class="text-danger validate-msg">' + validate_msg + '</span>')
            }
        } else {
            parent.find('.select2-selection--single').removeAttr('style');
            parent.find('.select2-selection__rendered').removeClass('text-success');
            parent.find('.validate-msg').remove();
            $.ajax({
                url: url + '?data=' + data + '&capacity=' + (select_capacity.val() ?? ""),
                type: 'get'
            }).done(function (response) {
                if (response.status === 200) {
                    var quantity = $(document).find('.cart-icon').find('.quantity');
                    quantity.html(parseInt(quantity.html()) + 1);

                    $(document).find('.cart-box').removeClass('d-none'); //remove if any
                    $(document).find('.cart-box').addClass('d-none');

                    var lang = $('html').attr('lang');
                    var msg = (lang === 'en') ? 'Successfully Added!' : '添加成功！';
                    new bs5.Toast({
                        className: 'border-0 bg-success text-white',
                        header: `
                                <svg width="24" height="24" class="text-success me-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <h6 class="mb-0">Success!</h6>
                                `,
                        body: msg,
                    }).show();
                } else {
                    alert(response.message);
                }
            });
        }
    });
}

/*** Update Cart ***/
function updateCart(url) {
    $(document).on('click', '.increase, .decrease', function () {
        var parent = $(this).parents('.range-quantity');
        var cart_item = parent.find('.cart-item').html();
        var quantity = parent.find('.cart-item-quantity').val();

        $.ajax({
            url: url + '?cart_item=' + cart_item + '&quantity=' + quantity,
            type: 'get'
        }).done(function (response) {
            console.log(response);
            $('#cart-amount').html(response.price);
            $('.quantity-cart-icon').html(response.quantity);
        })
    });

    $(document).on('change', '.cart-item-quantity', function () {
        var parent = $(this).parents('.range-quantity');
        var cart_item = parent.find('.cart-item').html();
        var quantity = $(this).val();
        $.ajax({
            url: url + '?cart_item=' + cart_item + '&quantity=' + quantity,
            type: 'get'
        }).done(function (response) {
            console.log(response);
            $('#cart-amount').html(response.price);
            $('.quantity-cart-icon').html(response.quantity);
        })
    })
}

/*** Remove Cart ***/
function updateItemCart(lang, url) {
    $(document).on('click', '.remove-cart-item', function () {
        var cart_item = $(this).attr('data-key');

        $.ajax({
            url: url + '?cart_item=' + cart_item + '&remove=' + 1,
            type: 'get'
        }).done(function (response) {
            $('#cart-amount').html(response.price);
            $('.quantity-cart-icon').html(response.quantity);
            var lang = $('html').attr('lang');
            var msg = (lang === 'en') ? 'Successfully Removed!' : '成功移除！';
            new bs5.Toast({
                className: 'border-0 bg-success text-white',
                header: `
                        <svg width="24" height="24" class="text-success me-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h6 class="mb-0">Success!</h6>
                        `,
                body: msg,
            }).show();
        })
    });
}

/*** Apply Voucher ***/
function applyVoucher(lang, url) {
    $(document).on('click', '.btn-apply-voucher', function () {
        var id = $(this).attr('data-voucher');
        window.location.href =  url + '?voucher_id=' + id;
    });

    $(document).on('click', '.btn-clear-voucher', function () {
        window.location.href =  url + '?voucher_id=' + 0;
    });
}

/*** General Update **/
function updateGeneralCart(url) {
    var lang = $('html').attr('lang');
    updateCart(url);
    updateItemCart(lang, url);
    applyVoucher(lang, url)
}

/*** Paypal ***/
function paypalPayment(amount, url, message) {
    $.ajax({
        url: url,
        type: 'GET'
    }).done(function (response) {
        response = JSON.parse(response);
        var sandbox_client_id = response.client_id ?? 'AU6RTnwSf7bWQIdDE-tlWHljior2xpDNNiwJ-SuHW0VtDVJvoefJ3hHX4DOoao0XSgt5DlbwPYnQHbRd';
        var environment = response.env ?? 'sandbox';
        var paypal_lang = ($('html').attr('lang') === 'zh-TW') ? 'zh_CN' : 'en_US';
        paypal.Button.render({
            env: environment,
            client: {
                sandbox: sandbox_client_id,
                production: sandbox_client_id
            },
            locale: paypal_lang,
            style: {
                height: 55,
                shape: 'rect',
                label: 'paypal',
                tagline: false
            },
            commit: true,

            payment: function (data, actions) {
                return actions.payment.create({
                    transactions: [
                        {
                            amount: {
                                total: `${amount}`,
                                currency: 'USD'
                            }
                        }
                    ]
                });
            },
            // Execute the payment
            onAuthorize: function (data, actions) {
                return actions.payment.execute().then(function () {
                    // Show a confirmation message to the buyer
                    Swal.fire('Successfully!', message, 'success').then(function () {
                        $('#credit-card').remove();
                        $('#paypal-radio').prop('checked', true);
                        $('#payment-now').submit();
                    })
                });
            }
        }, '#paypal-button');
    });
}
