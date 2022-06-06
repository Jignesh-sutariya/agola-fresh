 AOS.init({
 	duration: 800,
 	easing: 'slide'
 });

(function($) {

	"use strict";

	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
			BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
			iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
			Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
			Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
			any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};


	$(window).stellar({
    responsive: true,
    parallaxBackgrounds: true,
    parallaxElements: true,
    horizontalScrolling: false,
    hideDistantElements: false,
    scrollProperty: 'scroll'
  });


	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	// loader
	var loader = function() {
		setTimeout(function() { 
			if($('#ftco-loader').length > 0) {
				$('#ftco-loader').removeClass('show');
			}
		}, 1);
	};
	loader();

	// Scrollax
   $.Scrollax();

	var carousel = function() {
		$('.home-slider').owlCarousel({
	    loop:true,
	    autoplay: true,
	    margin:0,
	    animateOut: 'fadeOut',
	    animateIn: 'fadeIn',
	    nav:false,
	    autoplayHoverPause: false,
	    items: 1,
	    navText : ["<span class='ion-md-arrow-back'></span>","<span class='ion-chevron-right'></span>"],
	    responsive:{
	      0:{
	        items:1
	      },
	      600:{
	        items:1
	      },
	      1000:{
	        items:1
	      }
	    }
		});
	
		$('.carousel-testimony').owlCarousel({
			center: true,
			loop: true,
			items:1,
			margin: 30,
			stagePadding: 0,
			nav: false,
			navText: ['<span class="ion-ios-arrow-back">', '<span class="ion-ios-arrow-forward">'],
			responsive:{
				0:{
					items: 1
				},
				600:{
					items: 3
				},
				1000:{
					items: 3
				}
			}
		});

		$('.carousel-products').owlCarousel({
			center: true,
			loop: true,
			items:1,
			margin: 30,
			stagePadding: 0,
			nav: false,
			navText: ['<span class="ion-ios-arrow-back">', '<span class="ion-ios-arrow-forward">'],
			responsive:{
				0:{
					items: 2
				},
				600:{
					items: 4
				},
				1000:{
					items: 4
				}
			}
		});

	};
	carousel();

	$('nav .dropdown').hover(function(){
		var $this = $(this);
		// 	 timer;
		// clearTimeout(timer);
		$this.addClass('show');
		$this.find('> a').attr('aria-expanded', true);
		// $this.find('.dropdown-menu').addClass('animated-fast fadeInUp show');
		$this.find('.dropdown-menu').addClass('show');
	}, function(){
		var $this = $(this);
			// timer;
		// timer = setTimeout(function(){
			$this.removeClass('show');
			$this.find('> a').attr('aria-expanded', false);
			// $this.find('.dropdown-menu').removeClass('animated-fast fadeInUp show');
			$this.find('.dropdown-menu').removeClass('show');
		// }, 100);
	});


	$('#dropdown04').on('show.bs.dropdown', function () {
	  console.log('show');
	});

	// scroll
	var scrollWindow = function() {
		$(window).scroll(function(){
			var $w = $(this),
					st = $w.scrollTop(),
					navbar = $('.ftco_navbar'),
					sd = $('.js-scroll-wrap');

			if (st > 150) {
				if ( !navbar.hasClass('scrolled') ) {
					navbar.addClass('scrolled');	
				}
			} 
			if (st < 150) {
				if ( navbar.hasClass('scrolled') ) {
					navbar.removeClass('scrolled sleep');
				}
			} 
			if ( st > 350 ) {
				if ( !navbar.hasClass('awake') ) {
					navbar.addClass('awake');	
				}
				
				if(sd.length > 0) {
					sd.addClass('sleep');
				}
			}
			if ( st < 350 ) {
				if ( navbar.hasClass('awake') ) {
					navbar.removeClass('awake');
					navbar.addClass('sleep');
				}
				if(sd.length > 0) {
					sd.removeClass('sleep');
				}
			}
		});
	};
	scrollWindow();

	
	var counter = function() {
		
		$('#section-counter').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('ftco-animated') ) {

				var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',')
				$('.number').each(function(){
					var $this = $(this),
						num = $this.data('number');
						console.log(num);
					$this.animateNumber(
					  {
					    number: num,
					    numberStep: comma_separator_number_step
					  }, 7000
					);
				});
				
			}

		} , { offset: '95%' } );

	}
	counter();

	var contentWayPoint = function() {
		var i = 0;
		$('.ftco-animate').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('ftco-animated') ) {
				
				i++;

				$(this.element).addClass('item-animate');
				setTimeout(function(){

					$('body .ftco-animate.item-animate').each(function(k){
						var el = $(this);
						setTimeout( function () {
							var effect = el.data('animate-effect');
							if ( effect === 'fadeIn') {
								el.addClass('fadeIn ftco-animated');
							} else if ( effect === 'fadeInLeft') {
								el.addClass('fadeInLeft ftco-animated');
							} else if ( effect === 'fadeInRight') {
								el.addClass('fadeInRight ftco-animated');
							} else {
								el.addClass('fadeInUp ftco-animated');
							}
							el.removeClass('item-animate');
						},  k * 50, 'easeInOutExpo' );
					});
					
				}, 100);
				
			}

		} , { offset: '95%' } );
	};
	contentWayPoint();


	// navigation
	var OnePageNav = function() {
		$(".smoothscroll[href^='#'], #ftco-nav ul li a[href^='#']").on('click', function(e) {
		 	e.preventDefault();

		 	var hash = this.hash,
		 			navToggler = $('.navbar-toggler');
		 	$('html, body').animate({
		    scrollTop: $(hash).offset().top
		  }, 700, 'easeInOutExpo', function(){
		    window.location.hash = hash;
		  });


		  if ( navToggler.is(':visible') ) {
		  	navToggler.click();
		  }
		});
		$('body').on('activate.bs.scrollspy', function () {
		  console.log('nice');
		})
	};
	OnePageNav();


	// magnific popup
	$('.image-popup').magnificPopup({
    type: 'image',
    closeOnContentClick: true,
    closeBtnInside: false,
    fixedContentPos: true,
    mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
     gallery: {
      enabled: true,
      navigateByImgClick: true,
      preload: [0,1] // Will preload 0 - before current, and 1 after the current image
    },
    image: {
      verticalFit: true
    },
    zoom: {
      enabled: true,
      duration: 300 // don't foget to change the duration also in CSS
    }
  });

  $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
    disableOn: 700,
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,

    fixedContentPos: false
  });



	var goHere = function() {

		$('.mouse-icon').on('click', function(event){
			
			event.preventDefault();

			$('html,body').animate({
				scrollTop: $('.goto-here').offset().top
			}, 500, 'easeInOutExpo');
			
			return false;
		});
	};
	goHere();


	/*function makeTimer() {

		var endTime = new Date("21 December 2019 9:56:00 GMT+01:00");			
		endTime = (Date.parse(endTime) / 1000);

		var now = new Date();
		now = (Date.parse(now) / 1000);

		var timeLeft = endTime - now;

		var days = Math.floor(timeLeft / 86400); 
		var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
		var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
		var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

		if (hours < "10") { hours = "0" + hours; }
		if (minutes < "10") { minutes = "0" + minutes; }
		if (seconds < "10") { seconds = "0" + seconds; }

		$("#days").html(days + "<span>Days</span>");
		$("#hours").html(hours + "<span>Hours</span>");
		$("#minutes").html(minutes + "<span>Minutes</span>");
		$("#seconds").html(seconds + "<span>Seconds</span>");		

}

setInterval(function() { makeTimer(); }, 1000);*/

function swal_fire($title,$message,$type)
{
	Swal.fire(
	  $title,
	  $message,
	  $type
	)
}

$('.subscribe-form, .contact-form, .signup-form, .billing-form').validate({
	rules: {
	    fullname: {
	        required: true
	    },
	    address: {
	        required: true
	    },
	    mobile: {
	        required: true,
	        minlength: 10,
	        maxlength: 10,
	        digits: true
	    },
	    password: {
	        required: true
	    },
	    c_password: {
	        required: true,
	        equalTo: "#password"
	    },
	    email: {
	        required: true,
	        email: true
	    },
	    name: {
	        required: true
	    },
	    subject: {
	        required: true
	    },
	    message: {
	        required: true
	    }
	},
	errorElement: 'span',
	errorPlacement: function(error, element) {
	error.addClass('invalid-feedback');
	},
	highlight: function(element, errorClass, validClass) {
	$(element).addClass('is-invalid');
	},
	unhighlight: function(element, errorClass, validClass) {
	$(element).removeClass('is-invalid');
	$(element).addClass('is-valid');
	}
	});

	var quantitiy=0;
	$(document).on('click', '.quantity-right-plus', function(e){
	    // Stop acting like a button
	    e.preventDefault();
	    // Get the field name
	    var quantity = parseInt($('#quantity').val());
	    // If is not undefined
	        $('#quantity').val(quantity + 1);
	        // Increment
	});
	$(document).on('click', '.quantity-left-minus', function(e){
	    // Stop acting like a button
	    e.preventDefault();
	    // Get the field name
	    var quantity = parseInt($('#quantity').val());
	    // If is not undefined
        // Increment
        if(quantity>1){
        	$('#quantity').val(quantity - 1);
        }
	});

	 $('.number').keypress(function(e){
        let keyCode = e.which;
        if ( (keyCode != 8 || keyCode ==32 ) && (keyCode < 48 || keyCode > 57) ) {
            return false;
        }
    });

	 function toast(msg){

	 	/*toastr["success"](msg)
		
		toastr.options = {
		  "closeButton": false,
		  "debug": false,
		  "newestOnTop": false,
		  "progressBar": false,
		  "positionClass": "toast-top-right",
		  "preventDuplicates": false,
		  "onclick": null,
		  "showDuration": "300",
		  "hideDuration": "1000",
		  "timeOut": "5000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
		}*/
		$('#toast-container')
		    .append('<div class="toast toast-info" aria-live="polite" style=""><button type="button" class="toast-close-button" role="button">×</button><div class="toast-message"><div class="notification"><div class="media-object-section"><h4 class="notification-product-title">'+msg+'</h4></div></div></div></div>')
		    .children(':last')
		    .hide()
		    .fadeIn("slow")
		    .fadeOut(3000);
		
	 }

	$(".subscribe-form, .contact-form, .signup-form").on("submit",function(e){  
	  e.preventDefault();
	  var form = $(this);
	  if (form.valid()) {
		  $.ajax({
		     type:"POST",  
		     url:form.attr('action'),
		     data:form.serialize(),
		     beforeSend: function(data){
		        $('#ftco-loader').addClass('show');
		     },
		     success: function (result) {
		     	$('#ftco-loader').removeClass('show');
		     	result = JSON.parse(result);
			    if (result.error == true) {
			      toast(result.message)
			    }else{
			      toast(result.message);
			      form.find("input[type=text], input[type=password], input[type=email], textarea").val("");
				  setTimeout(function(){ if (result.redirect) window.location.href = result.redirect; }, 3000);
			    }
		    }
		  });
	  }else{
	  	return false;
	  }
	});

	$(document).on("click", ".add-to-cart, .add-to-wishlist", function(e){  
	  e.preventDefault();
	  let prod = $(this);
	  let qty = $("#quantity").val() ? $("#quantity").val() : 1;
	  $.ajax({
	     type:"POST",  
	     url: prod.attr('href'),
	     data: {id : prod.data('id'), qty : qty},
	     dataType: "json",
	     beforeSend: function(data){
	        /*$('#ftco-loader').addClass('show');*/
	        prod.html(prod.data('adding'));
	     },
	     success: function (result) {
	     	$('#ftco-loader').removeClass('show');
		    if (result.error == true) {
		    	toast(result.message);
				setTimeout(function(){ if (result.redirect) window.location.href = result.redirect; }, 1000);
		    }else{
		      if (result.count >= 0) {
		      	prod.html(prod.data('added'));
		      	$('#counter').html(result.count);
		      	$('#toast-container')
			    .append('<div class="toast toast-info" aria-live="polite" style=""> <button type="button" class="toast-close-button" role="button">×</button><div class="toast-message"> '+result.message+'</div></div>')
			    .children(':last')
			    .hide()
			    .fadeIn("slow")
			    .fadeOut(3000);
		      }else{
		      	toast(result.message);
		      }
			  setTimeout(function(){ 
			  	if (result.redirect) window.location.href = result.redirect; 
			  }, 1000);
		    }
	    }
	  });
	});


	$('.quantity-buttons').click(function(){
		const prod = $(this).siblings('input[name="quantity"]');
		var qty = prod.val();
		if ($(this).hasClass('quantity-plus')) qty++;
		
		if (qty >= 2)
			if ($(this).hasClass('quantity-minus')) qty--;
		prod.val(qty);
		if (qty < 1) {
			return false;
		}else{
			$.ajax({
			    type:"POST",  
			    url: prod.data('href'),
			    data: {id : prod.data('id'), qty : qty},
			    dataType: "json",
			    beforeSend: function(data){
			       $('#ftco-loader').addClass('show');
			    },
			    success: function (result) {
			     	$('#ftco-loader').removeClass('show');
				    if (result.error == true) {
				      toast(result.message);
				    }else{
				      toast(result.message);
				      var total = prod.data("price") * qty;
				      $('.total_'+prod.data('id')).html("₹ "+total);
				      var tot = 0;
				      $(".total").each(function() {
				      	tot += parseInt($(this).html().replace("₹ ", ""));
					  });
				      $('.change-price').html("₹ "+tot);
				    }
			    }
			});
		}
	});

	$(".billing-form").submit(function(e){
	    e.preventDefault();
	    var SITEURL = $('#url').val();
	    if ($('.billing-form').valid()) {
	      var payment_type = $("input[name='payment_type']:checked"). val();
	      if (payment_type == "online") {
	      	$.ajax({
	              url: SITEURL + 'total',
	              type: 'get',
	              dataType: 'json',
	              success: function (response) {
	                var totalAmount = response.total;
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
			          "image": SITEURL + "assets/images/front-logo.png",
			          "prefill" : {
			            "name"     : $('#name').val(),
			            "contact"  : $('#mobile').val(),
			            },
			          "handler": function (response){
			                $.ajax({
			                  url: SITEURL + 'checkout',
			                  type: 'post',
			                  dataType: 'json',
			                  data: {
			                    payment_id : response.razorpay_payment_id,
			                    name       : $('#name').val(),
			                    mobile     : $('#mobile').val(),
			                    del_date   : $("input[name='delivery_date']:checked"). val(),
                				del_time   : $("input[name='delivery_time']:checked"). val(),
			                    address    : $('#address').val()
			                  }, 
			                  success: function (msg) {
			                  	if (msg.status == true) {
				                	toast(msg.message);
				                  	setTimeout(function(){ if (msg.redirect) window.location.href = msg.redirect; }, 1000);
				                }else{
				                	toast(msg.message);
				                }
			                  }
			              });
			        },
			      };

			      var rzp1 = new Razorpay(options);
			      rzp1.open();
			      e.preventDefault();
	              }
	          });
	      }else{
	        $.ajax({
	              url: SITEURL + 'checkout',
	              type: 'post',
	              dataType: 'json',
	              data: {
	                payment_id : "cash",
	                name       : $('#fullname').val(),
	                mobile     : $('#mobile').val(),
	                del_date   : $("input[name='delivery_date']:checked"). val(),
                	del_time   : $("input[name='delivery_time']:checked"). val(),
	                address    : $('#address').val()
	              }, 
	              success: function (msg) {
	                if (msg.status == true) {
	                	toast(msg.message);
	                	setTimeout(function(){ if (msg.redirect) window.location.href = msg.redirect; }, 1000);
	                }else{
	                	toast(msg.message);
	                }
	              }
	          });
	        }
	    }else{
	    	toast("Complete the Checkout Form.");
	      	return false;
	    }
  	});
	 
	$(document).on("click", ".view-order", function(e){  
	  e.preventDefault();
	  $.ajax({
	     type:"GET",  
	     url: $(this).attr('href'),
	     dataType: "json",
	     beforeSend: function(data){
	        $('#ftco-loader').addClass('show');
	     },
	     success: function (result) {
	     	$('#ftco-loader').removeClass('show');
		    if (result.error == true) {
		    	toast(result.message);
		    }else{
		      let order = '<div class="jumbotron"><div class="row"> <span class="col-md-6">Order ID</span> <span class="col-md-3 offset-3">'+result.order.id+'</span> <span class="col-md-6">Order Status</span> <span class="col-md-3 offset-3">'+result.order.status+'</span> <span class="col-md-6">Payment Type</span> <span class="col-md-3 offset-3">'+result.order.payment_type+'</span><span class="col-md-6">Payment Status</span> <span class="col-md-3 offset-3">'+result.order.payment_status+'</span> <span class="col-md-6">Order Date</span> <span class="col-md-3 offset-3">'+result.order.created_at+'</span></div><hr><div class="row"> <span class="col-md-6">Total</span> <span class="col-md-3 offset-3">₹ '+result.order.total_amount+'</span></div></div><div class="col-md-12"><div class="row">';
		      $.each( result.order.order_details, function( key, v ) {
		      	order += '<span class="col-md-4">'+v.eng_name+'<br> ('+v.guj_name+')'+'</span> <span class="col-md-6">₹ '+v.price+'* '+v.qty+' = ₹ '+(v.qty*v.price)+'<br>'+v.qty+'* '+v.min_qty+' ('+v.qty_type+')'+' = '+(v.qty*v.min_qty)+' ('+v.qty_type+')'+'</span><span class="col-md-2"><img src="'+v.image+'" alt="" height="70"></span>';
			  });
		      $('#ordersModal').modal({backdrop: 'static', keyboard: false});
		      $("#order-body").html(order);
		      $("#ordersModal").modal('show');
		    }
	    }
	  });
	});

	$(document).on('click', '.view-product', function(e){
		e.preventDefault();
		$.ajax({
	          url: $(this).attr('href'),
	          type: 'get',
	          dataType: 'json',
	          success: function (msg) {
	          	if (msg.status == true) {
	          		var prod = msg.product;
	          		$("#prod-details").html('<div class="row"><div class="col-lg-6"><img src="'+prod.image+'" class="img-fluid" alt="Agola Fresh"></div><div class="col-lg-6 product-details"><h3>'+prod.eng_name+'</h3><h3>'+prod.guj_name+'</h3><p class="price"><span>'+prod.price+'</span></p><div class="row mt-4"><div class="w-100"></div><div class="input-group col-md-6 d-flex mb-3"><span class="input-group-btn mr-2"><button type="button" class="quantity-left-minus btn" data-type="minus" data-field=""><i class="ion-ios-remove"></i></button></span><input type="text" id="quantity" name="quantity" class="form-control input-number number" value="1" min="1" max="100"><span class="input-group-btn ml-2"><button type="button" class="quantity-right-plus btn" data-type="plus" data-field=""><i class="ion-ios-add"></i></button></span></div><div class="w-100"></div><div class="col-md-12"><p style="color: #000;">Price per '+prod.min_qty+' '+prod.qty_type+'</p></div></div><p><a href="add-to-cart" class="add-to-cart btn btn-black py-3 px-5" data-id="'+prod.id+'" data-adding="Adding" data-added="Added to Cart">Add to Cart</a></p></div></div>');
	          		$("#show-prod").modal();
	            	/*console.log(msg.product);*/
	            }else{
	            	toast(msg.message);
	            }
	          }
	      });
	});

	$(document).on('click', '.toast-close-button', function(){
		$(this).parent('div').remove();
	});
})(jQuery);

