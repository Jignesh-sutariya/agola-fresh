var url = $('#url').val();

function getURLVar(key) {
    var value = [];

    var query = String(document.location).split('?');

    if (query[1]) {
        var part = query[1].split('&');

        for (i = 0; i < part.length; i++) {
            var data = part[i].split('=');

            if (data[0] && data[1]) {
                value[data[0]] = data[1];
            }
        }

        if (value[key]) {
            return value[key];
        } else {
            return '';
        }
    }
}

$(document).ready(function() {
    // Highlight any found errors
    $('.text-danger').each(function() {
        var element = $(this).parent().parent();

        if (element.hasClass('form-group')) {
            element.addClass('has-error');
        }
    });

    // Currency
    $('#form-currency .currency-select').on('click', function(e) {
        e.preventDefault();

        $('#form-currency input[name=\'code\']').val($(this).attr('name'));

        $('#form-currency').submit();
    });

    // Language
    $('#form-language .language-select').on('click', function(e) {
        e.preventDefault();

        $('#form-language input[name=\'code\']').val($(this).attr('name'));

        $('#form-language').submit();
    });

    /* Search */
    /*$('#search input[name=\'search\']').parent().find('button').on('click', function() {
    	var url = $('base').attr('href') + 'index.php?route=product/search';

    	var value = $('header #search input[name=\'search\']').val();

    	if (value) {
    		url += '&search=' + encodeURIComponent(value);
    	}

    	location = url;
    });

    $('#search input[name=\'search\']').on('keydown', function(e) {
    	if (e.keyCode == 13) {
    		$('header #search input[name=\'search\']').parent().find('button').trigger('click');
    	}
    });*/

    // Menu
    $('#menu .dropdown-menu').each(function() {
        var menu = $('#menu').offset();
        var dropdown = $(this).parent().offset();

        var i = (dropdown.left + $(this).outerWidth()) - (menu.left + $('#menu').outerWidth());

        if (i > 0) {
            $(this).css('margin-left', '-' + (i + 10) + 'px');
        }
    });

    // Product List
    $('#list-view').click(function() {
        $('#content .product-grid > .clearfix').remove();

        $('#content .row > .product-grid').attr('class', 'product-layout product-list col-xs-12');
        $('#grid-view').removeClass('active');
        $('#list-view').addClass('active');

        localStorage.setItem('display', 'list');
    });

    // Product Grid
    $('#grid-view').click(function() {
        // What a shame bootstrap does not take into account dynamically loaded columns
        var cols = $('#column-right, #column-left').length;

        if (cols == 2) {
            $('#content .product-list').attr('class', 'product-layout product-grid col-lg-3 col-md-4 col-sm-6 col-xs-12');
        } else if (cols == 1) {
            $('#content .product-list').attr('class', 'product-layout product-grid col-lg-3 col-md-4 col-sm-6 col-xs-12');
        } else {
            $('#content .product-list').attr('class', 'product-layout product-grid col-lg-3 col-md-4 col-sm-6 col-xs-12');
        }

        $('#list-view').removeClass('active');
        $('#grid-view').addClass('active');

        localStorage.setItem('display', 'grid');
    });

    if (localStorage.getItem('display') == 'list') {
        $('#list-view').trigger('click');
        $('#list-view').addClass('active');
    } else {
        $('#grid-view').trigger('click');
        $('#grid-view').addClass('active');
    }

    // Checkout
    $(document).on('keydown', '#collapse-checkout-option input[name=\'email\'], #collapse-checkout-option input[name=\'password\']', function(e) {
        if (e.keyCode == 13) {
            $('#collapse-checkout-option #button-login').trigger('click');
        }
    });

    // tooltips on hover
    $('[data-toggle=\'tooltip\']').tooltip({ container: 'body' });

    // Makes tooltips work on ajax generated content
    $(document).ajaxStop(function() {
        $('[data-toggle=\'tooltip\']').tooltip({ container: 'body' });
    });
});

var ajaxReq = 'ToCancelPrevReq';

// Cart add remove functions
var cart = {
    'add': function(product_id) {
        var quantity = $("#input-quantity").val();
        $.ajax({
            url: url + 'add-to-cart',
            type: 'post',
            data: { id: product_id, qty: (typeof(quantity) != 'undefined' ? quantity : 1) },
            dataType: 'json',
            beforeSend: function() {
                $('.' + product_id).html($('.' + product_id).data('loading'));
            },
            complete: function() {
                $('.' + product_id).html($('.' + product_id).data('complete'));
            },
            success: function(result) {
                $('#toast-container')
                    .append('<div class="toast toast-info" aria-live="polite" style=""> <button type="button" class="toast-close-button" role="button">×</button><div class="toast-message"> ' + result.message + '</div></div>')
                    .children(':last')
                    .hide()
                    .fadeIn("slow")
                    .fadeOut(3000);
                shopCart.show();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    },
    'update': function(product_id, operation) {
        var quantity = parseInt($("#" + product_id).val());
        if (operation === 'plus') quantity++;
        else quantity--;
        if (quantity > 0) {
            $('#' + product_id).val(quantity);
            var price = $('#total_' + product_id).siblings('td:last').html();
            $('#total_' + product_id).html(price * quantity);
            let total = 0;
            $('.total-count').each(function(index, prod) {
                total += parseInt(prod.textContent);
            });
            $('#cart-total').html("₹ " + total);
            $('.total').html("₹ " + total);
            ajaxReq = $.ajax({
                url: url + 'add-to-cart',
                type: 'post',
                data: { id: product_id, qty: (typeof(quantity) != 'undefined' ? quantity : 1) },
                dataType: 'json',
                beforeSend: function() {
                    if (ajaxReq != 'ToCancelPrevReq' && ajaxReq.readyState < 4) {
                        ajaxReq.abort();
                    }
                    /*$('#'+product_id).html($('#'+product_id).data('loading'));*/
                },
                complete: function() {
                    /*$('#'+product_id).html($('#'+product_id).data('complete'));*/
                },
                success: function(result) {
                    /*$('#toast-container')
                    	    .append('<div class="toast toast-info" aria-live="polite" style=""> <button type="button" class="toast-close-button" role="button">×</button><div class="toast-message"> Cart Item Updated</div></div>')
                    	    .children(':last')
                    	    .hide()
                    	    .fadeIn("slow")
                    	    .fadeOut(3000);*/
                    shopCart.show();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        } else {
            return false;
        }
    },
    'remove': function(product_id) {
        $.ajax({
            url: url + 'remove-product',
            type: 'post',
            data: { id: product_id },
            dataType: 'json',
            success: function(result) {
                $('#toast-container')
                    .append('<div class="toast toast-info" aria-live="polite" style=""> <button type="button" class="toast-close-button" role="button">×</button><div class="toast-message"> ' + result.message + '</div></div>')
                    .children(':last')
                    .hide()
                    .fadeIn("slow")
                    .fadeOut(3000);
                shopCart.show('show');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    },
    'view': function(product_id) {
        $.ajax({
            url: url + 'view-product/' + product_id,
            type: 'get',
            dataType: 'json',
            success: function(result) {
                if (result.status == true) {
                    var prod = result.product;
                    $("#prod-img").html('<a class="thumbnail" href="' + prod.image + '" title="' + result.eng_name + '"><img data-zoom-image="' + prod.image + '" src="' + prod.image + '" class="img-responsive center-block zoom_image" alt="image" width="80%"></a>');
                    $("#prod-name").html(prod.eng_name.toUpperCase() + ' (' + prod.guj_name + ')');
                    $("#prod-price").html(prod.price);
                    $("#addtocat-btn").html('<button type="button" data-loading="Adding..." data-complete="Added to Cart" class="btn add-to-cart btn-primary ' + prod.id + '"  onclick="cart.add(' + prod.id + ');">Add to Cart</button>');
                    $("#input-quantity").val("1");
                    $("#prod-detail").html('<li><span class="text-decor">Qty Type:</span>' + prod.qty_type.toUpperCase() + '</li><li><span class="text-decor">Min Qty</span>' + prod.min_qty + '</li><li><span class="text-decor">Availability:</span> In Stock</li><hr class="producthr">');
                    $("#show-prod").modal();
                } else {
                    $('#toast-container')
                        .append('<div class="toast toast-info" aria-live="polite" style=""> <button type="button" class="toast-close-button" role="button">×</button><div class="toast-message"> ' + result.message + '</div></div>')
                        .children(':last')
                        .hide()
                        .fadeIn("slow")
                        .fadeOut(3000);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
}

var shopCart = {
    'show': function(show = null) {
        $.ajax({
            url: url + 'shop-cart',
            type: 'get',
            dataType: 'json',
            success: function(result) {
                if (result.length > 0) {
                    var cart = '<li> <table class="table table-striped"> <tbody>';
                    var total = 0;
                    var urlNew = $(location).attr("href");
                    var urlsplit = urlNew.split("/");
                    var lastpart = urlsplit[urlsplit.length - 1];

                    if (lastpart === '') {
                        lastpart = urlsplit[urlsplit.length - 2];
                    }

                    if (lastpart === 'cart' && show != null)
                        var cartList = '<div class="table-responsive"><table class="table table-bordered"><thead><tr><td class="text-center">Image</td><td class="text-left">Product Name</td><td class="text-left">Weight</td><td class="text-left">Quantity</td><td class="text-right">Unit Price</td><td class="text-right">Total</td></tr></thead><tbody>';

                    $(result).each(function(index, prod) {
                        cart += '<tr> <td class="text-center"> <a href="' + prod.slug + '"><img style="height: 50px;" src="' + prod.image + '" alt="' + prod.eng_name + '" title="' + prod.eng_name + '" class="img-thumbnail"></a> </td><td class="text-left"><a href="' + prod.slug + '">' + prod.eng_name + '<br>' + prod.guj_name + '</a> </td><td class="text-right">₹ ' + prod.price + ' x ' + prod.qty + '<br>₹ ' + (prod.price * prod.qty) + '</td><td class="text-right"></td><td class="text-center"><a href="javascript:void(0);" onclick="cart.remove(' + prod.id + ');" title="Remove Product"><i class="fa fa-times"></i></a></td></tr>';
                        total += (prod.price * prod.qty);
                        if (lastpart === 'cart' && show != null)
                            cartList += '<tr><td class="text-center"> <a href="' + prod.slug + '"><img src="' + prod.image + '" style="height: 50px;" title="' + prod.eng_name + '" class="img-thumbnail"/></a></td><td class="text-left"><a href="' + prod.slug + '">' + prod.eng_name + '<br>' + prod.guj_name + '</a></td><td class="text-left">' + prod.min_qty + ' ' + prod.qty_type.toUpperCase() + '</td><td class="text-left"><div class="input-group btn-block" style="max-width: 200px;"><input type="text" name="quantity" id="' + prod.id + '" value="' + prod.qty + '" readonly="" size="1" class="form-control"/><span class="input-group-btn"> <button type="submit" class="btn btn-primary" onclick="cart.update(' + prod.id + ', \'minus\');"><i class="fa fa-angle-down "></i></button> <button type="submit" class="btn btn-primary" onclick="cart.update(' + prod.id + ', \'plus\');"><i class="fa fa-angle-up"></i></button> <button type="button" class="btn btn-danger" onclick="cart.remove(' + prod.id + ');"><i class="fa fa-times-circle"></i></button></span></div></td><td class="text-right">' + prod.price + '</td><td class="text-right total-count" id="total_' + prod.id + '">' + (prod.price * prod.qty) + '</td></tr>';
                    });
                    if (lastpart === 'cart' && show != null) {
                        cartList += '</tbody></table></div><div class="row"><div class="col-sm-4 col-sm-offset-8"><table class="table table-bordered"><tr><td class="text-right"><strong>Total:</strong></td><td class="text-right total">₹ ' + total + '</td></tr></table></div></div>';
                        $('.cart-details').html(cartList);
                    }
                    cart += '</tbody></table> </li><li> <div> <table class="table table-bordered"> <tbody> <tr> <td class="text-right"><strong>Total</strong></td><td class="text-right">₹ ' + total + '</td></tr></tbody></table> <p class="text-right"><a class="btn btn-primary" href="' + url + 'cart"><i class="fa fa-shopping-cart"></i> View Cart </a>&nbsp;&nbsp;&nbsp;<a class="btn btn-primary" href="' + url + 'checkout"><i class="fa fa-share"></i> Checkout</a></p></div></li>';
                    $('#cart-details').html(cart);
                    $('#cart-total').html("₹ " + total);
                    $('.total').html("₹ " + total);
                } else {
                    $('.total').html("₹ 0.00");
                    $('#cart-total').html("₹ 0.00");
                    $('.cart-details').html('<h1>Empty Shopping Cart</h1><p>Your shopping cart is empty!</p>');
                    $('#cart-details').html('<li><p class="text-center">Your shopping cart is empty!</p></li>');
                }
            }
        });
    },

    'signup': function(form) {
        var form = $("#" + form);
        form.find('input[type=button]').prop('disabled', true);
        $.ajax({
            url: url + 'signup',
            type: 'post',
            data: form.serialize(),
            dataType: 'json',
            success: function(result) {
                alert(result.message);
                form.find('input[type=button]').prop('disabled', false);
                if (result.redirect) window.location.href = result.redirect;
            }
        });
    },

    'checkout': function(form) {
        var form = $("#" + form);
        var payment_type = $("input[name='payment_type']:checked").val();
        form.find('input[type=button]').prop('disabled', true);
        var data = form.serialize();
        $.ajax({
            url: url + 'total',
            type: 'post',
            dataType: 'json',
            data: data,
            success: function(response) {
                if (response.error == true) {
                    alert(response.message);
                    form.find('input[type=button]').prop('disabled', false);
                    return false;
                } else {
                    var totalAmount = response.total;
                    if (payment_type == "cash") {
                        data += "&payment_id=cash";
                        $.ajax({
                            url: url + 'checkout',
                            type: 'post',
                            dataType: 'json',
                            data: data,
                            success: function(msg) {
                                alert(msg.message);
                                form.find('input[type=button]').prop('disabled', false);
                                if (msg.redirect) window.location.href = msg.redirect;
                            }
                        });
                    } else {
                        var options = {
                            /*live api key*/
                            "key": "rzp_live_JpwbFjnsutjkI9",
                            "secret": "aRFsOOHP1U82HouaOdAKaLic",
                            /*testing api key*/
                            /*"key": "rzp_test_pudmlEBdoe9JXe",
                            "secret": "kwHrHeLkkPfycO3FKx4Q679Y",*/
                            "amount": (totalAmount * 100), // 2000 paise = INR 20
                            "name": "Agola Fresh",
                            "description": "Payment",
                            "image": url + "assets/images/front-logo.png",
                            "prefill": {
                                "name": $('#name').val(),
                                "contact": $('#mobile').val(),
                            },
                            "handler": function(response) {
                                data += "&payment_id=" + response.razorpay_payment_id;

                                $.ajax({
                                    url: url + 'checkout',
                                    type: 'post',
                                    dataType: 'json',
                                    data: data,
                                    success: function(msg) {
                                        alert(msg.message);
                                        form.find('input[type=button]').prop('disabled', false);
                                        if (msg.redirect) window.location.href = msg.redirect;
                                    }
                                });
                            },
                        };
                        var rzp1 = new Razorpay(options);
                        rzp1.open();
                        return false;
                    }
                }
            }
        });
    },

    'login': function(form) {
        var form = $("#" + form);
        form.find('input[type=button]').prop('disabled', true);
        $.ajax({
            url: url + 'login',
            type: 'post',
            data: form.serialize(),
            dataType: 'json',
            success: function(result) {
                alert(result.message);
                form.find('input[type=button]').prop('disabled', false);
                if (result.redirect) window.location.href = result.redirect;
            }
        });
    },

    'send_otp': function(form) {
        var form = $("#" + form);
        form.find('input[type=button]').prop('disabled', true);
        $.ajax({
            url: url + 'send-otp',
            type: 'post',
            data: form.serialize(),
            dataType: 'json',
            success: function(result) {
                alert(result.message);
                form.find('input[type=button]').prop('disabled', false);
                if (result.redirect) window.location.href = result.redirect;
            }
        });
    },

    'check_otp': function(form) {
        var form = $("#" + form);
        form.find('input[type=button]').prop('disabled', true);
        $.ajax({
            url: url + 'check-otp',
            type: 'post',
            data: form.serialize(),
            dataType: 'json',
            success: function(result) {
                alert(result.message);
                form.find('input[type=button]').prop('disabled', false);
                if (result.redirect) window.location.href = result.redirect;
            }
        });
    },

    'change_password': function(form) {
        var form = $("#" + form);
        form.find('input[type=button]').prop('disabled', true);
        $.ajax({
            url: url + 'change-password',
            type: 'post',
            data: form.serialize(),
            dataType: 'json',
            success: function(result) {
                alert(result.message);
                form.find('input[type=button]').prop('disabled', false);
                if (result.redirect) window.location.href = result.redirect;
            }
        });
    },

    'viewOrder': function(order_id) {
        $.ajax({
            type: "GET",
            url: url + 'view-order/' + order_id,
            dataType: "json",
            success: function(result) {
                if (result.error == true) {
                    alert(result.message);
                } else {
                    var order = '<div class="table-responsive"><table class="table table-striped"><caption><b>Address</b> : ' + result.order.address + '</caption><tbody><tr><td>Order ID</td><td>' + result.order.id + '</td></tr><tr><td>Order Status</td><td>' + result.order.status + '</td></tr><tr><td>Payment Type</td><td>' + result.order.payment_type + '</td></tr><tr><td>Payment Status</td><td>' + result.order.payment_status + '</td></tr><tr><td>Order Date</td><td>' + result.order.created_at + '</td></tr></tbody></table><hr><span class="col-md-6">Total:</span><span class="col-md-6">' + result.order.total_amount + '</span><br><hr>';
                    $.each(result.order.order_details, function(key, v) {
                        order += '<span class="col-xs-4">' + v.eng_name + '<br> (' + v.guj_name + ')' + '</span> <span class="col-xs-4">₹ ' + v.price + '* ' + v.qty + ' = ₹ ' + (v.qty * v.price) + '<br>' + v.qty + '* ' + v.min_qty + ' (' + v.qty_type + ')' + ' = ' + (v.qty * v.min_qty) + ' (' + v.qty_type + ')' + '</span><span class="col-xs-4"><img src="' + v.image + '" alt="" height="70"></span>';
                    });
                    order += '</div>';
                    $('#ordersModal').modal({ backdrop: 'static', keyboard: false });
                    $("#order-body").html(order);
                    $("#ordersModal").modal('show');
                }
            }
        });
    }
}

/* Agree to Terms */
$(document).delegate('.agree', 'click', function(e) {
    e.preventDefault();

    $('#modal-agree').remove();

    var element = this;

    $.ajax({
        url: $(element).attr('href'),
        type: 'get',
        dataType: 'html',
        success: function(data) {
            html = '<div id="modal-agree" class="modal">';
            html += '  <div class="modal-dialog">';
            html += '    <div class="modal-content">';
            html += '      <div class="modal-header">';
            html += '        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            html += '        <h4 class="modal-title">' + $(element).text() + '</h4>';
            html += '      </div>';
            html += '      <div class="modal-body">' + data + '</div>';
            html += '    </div>';
            html += '  </div>';
            html += '</div>';

            $('body').append(html);

            $('#modal-agree').modal('show');
        }
    });
});

// Autocomplete */
(function($) {
    /*$.fn.autocomplete = function(option) {
    	return this.each(function() {
    		this.timer = null;
    		this.items = new Array();

    		$.extend(this, option);

    		$(this).attr('autocomplete', 'off');

    		// Focus
    		$(this).on('focus', function() {
    			this.request();
    		});

    		// Blur
    		$(this).on('blur', function() {
    			setTimeout(function(object) {
    				object.hide();
    			}, 200, this);
    		});

    		// Keydown
    		$(this).on('keydown', function(event) {
    			switch(event.keyCode) {
    				case 27: // escape
    					this.hide();
    					break;
    				default:
    					this.request();
    					break;
    			}
    		});

    		// Click
    		this.click = function(event) {
    			event.preventDefault();

    			value = $(event.target).parent().attr('data-value');

    			if (value && this.items[value]) {
    				this.select(this.items[value]);
    			}
    		}

    		// Show
    		this.show = function() {
    			var pos = $(this).position();

    			$(this).siblings('ul.dropdown-menu').css({
    				top: pos.top + $(this).outerHeight(),
    				left: pos.left
    			});

    			$(this).siblings('ul.dropdown-menu').show();
    		}

    		// Hide
    		this.hide = function() {
    			$(this).siblings('ul.dropdown-menu').hide();
    		}

    		// Request
    		this.request = function() {
    			clearTimeout(this.timer);

    			this.timer = setTimeout(function(object) {
    				object.source($(object).val(), $.proxy(object.response, object));
    			}, 200, this);
    		}

    		// Response
    		this.response = function(json) {
    			html = '';

    			if (json.length) {
    				for (i = 0; i < json.length; i++) {
    					this.items[json[i]['value']] = json[i];
    				}

    				for (i = 0; i < json.length; i++) {
    					if (!json[i]['category']) {
    						html += '<li data-value="' + json[i]['value'] + '"><a href="#">' + json[i]['label'] + '</a></li>';
    					}
    				}

    				// Get all the ones with a categories
    				var category = new Array();

    				for (i = 0; i < json.length; i++) {
    					if (json[i]['category']) {
    						if (!category[json[i]['category']]) {
    							category[json[i]['category']] = new Array();
    							category[json[i]['category']]['name'] = json[i]['category'];
    							category[json[i]['category']]['item'] = new Array();
    						}

    						category[json[i]['category']]['item'].push(json[i]);
    					}
    				}

    				for (i in category) {
    					html += '<li class="dropdown-header">' + category[i]['name'] + '</li>';

    					for (j = 0; j < category[i]['item'].length; j++) {
    						html += '<li data-value="' + category[i]['item'][j]['value'] + '"><a href="#">&nbsp;&nbsp;&nbsp;' + category[i]['item'][j]['label'] + '</a></li>';
    					}
    				}
    			}

    			if (html) {
    				this.show();
    			} else {
    				this.hide();
    			}

    			$(this).siblings('ul.dropdown-menu').html(html);
    		}

    		$(this).after('<ul class="dropdown-menu"></ul>');
    		$(this).siblings('ul.dropdown-menu').delegate('a', 'click', $.proxy(this.click, this));

    	});
    }*/

    function headermenu() {
        if (jQuery(window).width() < 992) {
            jQuery('ul.nav li.dropdown a.header-menu').attr("data-toggle", "dropdown");
        } else {
            jQuery('ul.nav li.dropdown a.header-menu').attr("data-toggle", "");
        }
    }
    headermenu();
    jQuery(window).resize(function() { headermenu(); });
    jQuery(window).scroll(function() { headermenu(); });

    /*function headermenu() {
    if (jQuery(window).width() < 992)
    {
    jQuery('ul.nav li.dropdown a.header-menu').attr("data-toggle","dropdown");
    }
    else
    {
    jQuery('ul.nav li.dropdown a.header-menu').attr("data-toggle","");
    }
    }
    $(document).ready(function(){headermenu();});
    jQuery(window).resize(function() {headermenu();});
    jQuery(window).scroll(function() {headermenu();});*/

    function carousel() {
        $("#slideshow0").owlCarousel({
            itemsCustom: [
                [0, 1]
            ],
            autoPlay: true,
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            loop: true,
            navigationText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
            navigation: false,
            pagination: true
        });

        $(".products").owlCarousel({
            itemsCustom: [
                [0, 2],
                [375, 2],
                [600, 3],
                [768, 3],
                [992, 3],
                [1200, 4]
            ],
            autoPlay: true,
            loop: true,
            navigationText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
            navigation: true,
            pagination: false
        });
    }

    carousel();


    $(document).on('click', '.toast-close-button', function() {
        $(this).parent('div').remove();
    });
    $('.thumbnails').magnificPopup({
        type: 'image',
        delegate: 'a',
        gallery: {
            enabled: true
        }
    });

    if (jQuery(window).width() > 991) {
        //initiate the plugin and pass the id of the div containing gallery images
        $(".zoom_image").elevateZoom({ gallery: 'gallery_01', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon: '' });
        //pass the images to Fancybox
        /*$(".zoom_image").bind("click", function (e) {
        var ez = $('.zoom_image').data('elevateZoom');
        $.fancybox(ez.getGalleryList());
        return false;
        });*/
    }

    $('.btn-number').click(function(e) {
        e.preventDefault();
        var fieldName = $(this).attr('data-field');
        var type = $(this).attr('data-type');
        var input = $("input[name='" + fieldName + "']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if (type == 'minus') {
                var minValue = parseInt(input.attr('min'));
                if (!minValue) minValue = 1;
                if (currentVal > minValue) {
                    input.val(currentVal - 1).change();
                }
                if (parseInt(input.val()) == minValue) {
                    $(this).attr('disabled', true);
                }
            } else if (type == 'plus') {
                var maxValue = parseInt(input.attr('max'));
                if (!maxValue) maxValue = 999;
                if (currentVal < maxValue) {
                    input.val(currentVal + 1).change();
                }
                if (parseInt(input.val()) == maxValue) {
                    $(this).attr('disabled', true);
                }
            }
        } else {
            input.val(0);
        }
    });
    $('.input-number').focusin(function() {
        $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function() {
        var minValue = parseInt($(this).attr('min'));
        var maxValue = parseInt($(this).attr('max'));
        if (!minValue) minValue = 1;
        if (!maxValue) maxValue = 999;
        var valueCurrent = parseInt($(this).val());
        var name = $(this).attr('name');
        if (valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if (valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }
    });
    $(".input-number").keydown(function(e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    const slot = $("#time-slots-today").html();

    $('input[type=radio][name=delivery_date]').change(function() {
        if (this.value == 'today') {
            $("#time-slots-today").html(slot);
        } else {
            $("#time-slots-today").html('<label><input name="delivery_time" type="radio" id="08_AM_TO_10_AM" value="08_AM_TO_10_AM"/>08 AM TO 10 AM</label><label><input name="delivery_time" type="radio" id="10_AM_TO_12_PM" value="10_AM_TO_12_PM"/>10 AM TO 12 PM</label><label><input name="delivery_time" type="radio" id="12_PM_TO_02_PM" value="12_PM_TO_02_PM"/>12 PM TO 02 PM</label><label><input name="delivery_time" type="radio" id="02_PM_TO_04_PM" value="02_PM_TO_04_PM" checked=""/>02 PM TO 04 PM</label>');
        }
    });

    $('input[type=radio][name=delivery_date]').trigger('change');

    shopCart.show('show');

    $('#search-prod').keyup(function() {
        var search = $(this).val();

        if (search == undefined || search == '') {
            $('.search').hide();
            $('.search').html('');
            return false;
        }

        $.ajax({
            type: "GET",
            url: url + 'search',
            dataType: "json",
            data: { search: search },
            success: function(result) {
                var prod = '<div class="row">';
                if (result.length < 1) {
                    prod += '<div class="col-md-12">No result fuond.</div>';
                } else {
                    $.each(result, function(key, v) {
                        prod += '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6"> <div class="product-thumb transition"> <div class="image"> <a href="' + v.slug + '"> <img src="' + v.image + '" alt="' + v.eng_name.toUpperCase() + '" title="' + v.eng_name.toUpperCase() + '" class="img-responsive center-block"> </a> <a href="' + v.slug + '"> <img src="' + v.image + '" class="img-responsive additional-img" alt="' + v.eng_name.toUpperCase() + '"> </a> <button type="button" onclick="cart.view(' + v.id + ');" data-toggle="tooltip" title="" class="pwish" data-original-title="Quick View"><i class="fa fa-search"></i><span class="hidden-xs"></span></button> </div><div class="caption text-center"> <h4><a href="' + v.slug + '">' + v.eng_name.toUpperCase() + '</a></h4> <h4><a href="' + v.slug + '">' + v.guj_name + '</a></h4> <p class="price"> <span class="price-new">' + v.price + ' </span><span>(' + v.min_qty + ' ' + v.qty_type.toUpperCase() + ')</span> </p></div><div class="button-group text-center"> <button type="button" onclick="cart.add(' + v.id + ');" class="pcart"> <span data-loading="Adding..." data-complete="Added to Cart" class="' + v.id + '">Add to Cart</span> </button> </div></div></div>';
                    });
                }
                prod += '</div>';
                $('.search').html(prod);
                $('.search').show();
                // console.log(prod)
            }
        });
    });

    $('.search').hide();
})(window.jQuery);