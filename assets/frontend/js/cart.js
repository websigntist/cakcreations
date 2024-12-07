/*==== UPDATE CART QTY AJAX SCRITP ====*/
function updateCart(obj, rowid) {
    $.get(site_url + "cart/update_item_qty",
        {rowid: rowid, qty: obj.value}, function (resp) {
            if (resp == 'OK') {
                location.reload();
                var jQueryj = jQuery.noConflict();
                $.notify('Quantity updated.', {type: 'success'})
            } else {
                $.notify('Cart udpate failed please try again.', {type: 'danger'})
            }
        })
}

/*==== PRODUCT WISHLIST ====*/
function wishlist(obj, id) {
    $.get(site_url + "wishlist/add",
        {product_id: id}, function (response) {
            let json = $.parseJSON(response);
            if (!json.status) {
                let url = site_url + "login";
                window.location.assign(url);
            } else {
                location.reload();
                /*let url = site_url + "wishlist";
                window.location.assign(url);*/
                var jQueryj = jQuery.noConflict();
                $.notify('One item has been added in your wishlist.', {type: 'success'})
            }
        })
}

/*==== CURRENCY CONVERTER ====*/
function changeCurrency(obj) {
    let currency = $(obj).data('currency');
    $.get(site_url + "currency/index/" + currency,
        {}, function (response) {
            location.reload();
        })
}


/*==== PRODUCT COMPARE ====*/
function comparelist(obj, id) {
    $.ajax(site_url + "compare/add",
        {product_id: id}, function (response) {
            location.reload();
            var jQueryj = jQuery.noConflict();
            $.notify('One item has been added in your compare list.', {type: 'success'})
        })
}

$(document).ready(function () {

    /*==== MAIL SUBSCRIPTION AJAX SCRIPT ====*/
    jQuery(document).on('click', 'button#subscribe', function () {
        let email = jQuery('[name=email]').val();

        jQuery.ajax({
            url: site_url + 'page/subscribe',
            type: 'POST',
            data: {
                email: email
            },
            dataType: 'json',
            beforeSend: function () {
                jQuery('#overlay').show();
            },
            complete: function () {
                jQuery('#overlay').hide();
            },
            success: function (json) {
                if (json.status == 1) {
                    jQuery('#subForm').find('.clerField').val('');
                    jQuery("#add-alert").show();
                    jQuery(".cart_over").fadeIn("slow");
                    var jQueryj = jQuery.noConflict();
                    $.notify('Your subscription has been received.', {type: 'success'})
                } else {
                    $.notify('Subscription failed.', {type: 'danger'})
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });

    /*==== CONTACT US AJAX SCRIPT ====*/
    jQuery(document).on('click', 'button#customer_inquiries', function () {
        let first_name = jQuery('[name=first_name]').val();
        let last_name = jQuery('[name=last_name]').val();
        let contact = jQuery('[name=contact]').val();
        let email = jQuery('[name=email]').val();
        let message = jQuery('[name=message]').val();

        jQuery.ajax({
            url: site_url + 'page/do_contact',
            type: 'POST',
            data: {
                first_name: first_name,
                last_name: last_name,
                contact: contact,
                email: email,
                message: message
            },
            dataType: 'json',
            beforeSend: function () {
                jQuery('#overlay').show();
            },
            complete: function () {
                jQuery('#overlay').hide();
            },
            success: function (json) {
                if (json.status == 1) {
                    jQuery('.contFrom').find('.clerField').val('');
                    jQuery("#add-alert").show();
                    jQuery(".cart_over").fadeIn("slow");
                    var jQueryj = jQuery.noConflict();
                    //alert('Your message has been submmited, we will reply you soon..');
                    $.notify('Your message has been submmited, we will reply you soon..', {type: 'success'})
                } else {
                    //alert('Message sending failed.');
                    $.notify('Message sending failed.', {type: 'danger'})
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });

    /*==== REVIEW SUBMIT AJAX SCRIPT ====*/
    jQuery(document).on('click', 'button#review_submit', function () {
        let product_id = jQuery('[name=product_id]').val();
        let full_name = jQuery('[name=full_name]').val();
        let reviews = jQuery('[name=reviews]').val();
        let star_rating = jQuery('[name=star_rating]').val();
        let email = jQuery('[name=email]').val();

        jQuery.ajax({
            url: site_url + '/reviews',
            type: 'POST',
            data: {
                product_id: product_id,
                full_name: full_name,
                reviews: reviews,
                star_rating: star_rating,
                email: email
            },
            dataType: 'json',
            beforeSend: function () {
                jQuery('#overlay').show();
            },
            complete: function () {
                jQuery('#overlay').hide();
            },
            success: function (json) {
                if (json.status == 1) {
                    jQuery('.reform').find('.clerField').val('');

                    jQuery("#add-alert").show();
                    jQuery(".cart_over").fadeIn("slow");

                    /*jQuery('.reform').html(json.message).fadeIn('slow');
                    setTimeout(function () {
                        jQuery('.reform').fadeOut('slow')
                    }, 6000);*/
                    var jQueryj = jQuery.noConflict();
                    $.notify('Your review has been submitted, waiting for approval.', {type: 'success'})
                } else {
                    $.notify('Review submit failed.', {type: 'danger'})
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });

    /*==== ADD TO CART AJAX SCRIPT ====*/
    jQuery(document).on('click', '.item-add-to-cart', function () {
        //return true;
        var product_id = jQuery(this).data('productid');
        var size_id = jQuery('[name=size_id]:checked').val();
        var color_id = jQuery('[name=color_id]:checked').val();

        var qty = jQuery('#add-cart-qty').val();
        if (qty) {
            qty = qty;
        } else {
            qty = 1;
        }
        jQuery.ajax({
            url: site_url + 'cart/addToCart',
            type: 'POST',
            data: {product_id: product_id, qty: qty, color_id: color_id, size_id: size_id},
            dataType: 'json',
            beforeSend: function () {
                jQuery('#overlay').show();
            },
            complete: function () {
                jQuery('#overlay').hide();
            },
            success: function (json) {
                if (json.status == 1) {
                    jQuery(".total_qty_badge").html(json.counter);
                    jQuery(".total_qty").html(json.counter + ' In Your Cart');
                    jQuery(".delivery_charges").html(json.delivery_charges);
                    jQuery(".total_amount").html(json.total_amount);
                    jQuery('.sub_total').html(json.sub_total);
                    jQuery("#add-alert").show();
                    jQuery(".cart_over").fadeIn("slow");
                    jQuery("#cart_slide").addClass("overlay");
                    var jQueryj = jQuery.noConflict();
                    $.notify('One item has been added in your cart.', {type: 'success'})
                } else {
                    $.notify('Select select one color and size option.', {type: 'danger'})
                }

                jQuery('.sidecart').html(json.cart_items);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });

    /*==== REMOVE CART ITEM AJAX SCRIPT ====*/
    jQuery(document).on('click', 'button.remove-cart', function () {
        let _this = jQuery(this);
        let product_id = _this.data('productid');
        jQuery.ajax({
            url: site_url + 'cart/removeItem',
            type: 'POST',
            data: {product_id: product_id},
            dataType: 'json',
            beforeSend: function () {
                $('#overlay').show();
            },
            complete: function () {
                $('#overlay').hide();
            },
            success: function (json) {
                jQuery('.total_items').html(json.total_items);
                jQuery('.sub_total').html(json.sub_total);
                //console.log(json.sub_total, jQuery('tr.discount td'));
                if (json.sub_total_n < json.min_order_value) {
                    jQuery('tr.discount td:eq(0)').html('0');
                    jQuery('tr.discount').hide();
                }
                jQuery('.render_total').html(json.total);
                if (json.total_items <= 0) {
                    jQuery('.delivery_charges').html(json.delivery_charges);
                }
                jQuery('.total_count_badge').html(json.count);
                jQuery('.total_count').html(json.count + ' In Your Cart');
                jQuery('.render-qty').html(json.total_quantity);
                if (json.total_items <= 0) {
                    jQuery('.cart-area-full').html('');
                    jQuery('.emptycart').show();
                } else {
                    _this.closest('tr').remove();
                }
                var jQueryj = jQuery.noConflict();
                $.notify('One item has been removed in your cart.', {type: 'danger'})

            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });

    /*==== REMOVE COMPARE AJAX SCRIPT ====*/
    jQuery(document).on('click', 'button.remove_compare', function () {
        let _this = jQuery(this);
        let compare_id = _this.data('compareid');
        jQuery.ajax({
            url: site_url + 'compare/delete',
            type: 'POST',
            data: {compare_id: compare_id},
            dataType: 'json',
            beforeSend: function () {
                jQuery('#overlay').show();
            },
            complete: function () {
                jQuery('#overlay').hide();
            },
            success: function (json) {
                jQuery('.total_compare').html(json.count);
                if (json.total_quantity <= 0) {
                    jQuery('.cart-area-full').html('');
                    jQuery('.emptycart').show();
                } else {
                    jQuery('td.' + _this.data('td_id')).remove();
                }
                var jQueryj = jQuery.noConflict();
                $.notify('One item has been removed from your compare list.', {type: 'danger'})
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });

    /*==== REMOVE WISHLIST AJAX SCRIPT ====*/
    jQuery(document).on('click', 'button.remove_wishlist', function () {
        let _this = jQuery(this);
        let wishlist_id = _this.data('wishid');
        jQuery.ajax({
            url: site_url + 'wishlist/delete',
            type: 'POST',
            data: {wishlist_id: wishlist_id},
            dataType: 'json',
            beforeSend: function () {
                jQuery('#overlay').show();
            },
            complete: function () {
                jQuery('#overlay').hide();
            },
            success: function (json) {
                jQuery('.total_wish').html(json.count);
                if (json.total_quantity <= 0) {
                    jQuery('.cart-area-full').html('');
                    jQuery('.emptycart').show();
                } else {
                    _this.closest('tr').remove();
                }
                var jQueryj = jQuery.noConflict();
                $.notify('One item has been removed from your wishlist.', {type: 'danger'});
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });

});