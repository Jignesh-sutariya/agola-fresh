/**
* Template Name: GroMart - Web App E-Commerce Shop and Store Mobile Template
* Version: 1.0
* Author: HidraTheme 
* Developed By: HidraTheme  
* Author URL: https://themeforest.net/user/hidratheme

NOTE: This is the custom js file for the template
**/

(function ($) {

  "use strict"; 

  /*=================== PRELOADER ===================*/
  $(window).on('load',function() { 
      $(".preloading").fadeOut("slow"); 
  });

  /*=================== SIDENAV CATEGORY ===================*/
  $('#button-collapse-category').sideNav({
      menuWidth: 250, 
      edge: 'left',
      closeOnClick: true, 
      draggable: true, 
      onOpen: function(el) {}, 
      onClose: function(el) {}, 
    }
  );
  /*=================== SIDENAV ACCOUNT ===================*/
  $('#button-collapse-account').sideNav({
      menuWidth: 250, 
      edge: 'right',
      closeOnClick: true, 
      draggable: true, 
      onOpen: function(el) {}, 
      onClose: function(el) {}, 
    }
  );

  /*=================== FOOTER ===================*/ 
  $('#page-content').css('min-height',$(document).height() - ($('#header').height() + $('#footer').height() )  );

  /*=================== CAROUSEL SLIDER  ===================*/
  $('.carousel.carousel-slider').carousel({fullWidth: true},setTimeout(autoplay, 4500));
    function autoplay() {
      $('.carousel').carousel('next');
      setTimeout(autoplay, 4500);
  }

  /*=================== QTY INPUT ===================*/
    $('<div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div>').insertAfter('.quantity input');
    $('.quantity').each(function() {
      var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');

      btnUp.on("click", function() {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

      btnDown.on("click", function() {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

    });

  /*=================== GALLERY FILTERING FUCTION  ===================*/
  $(".filter-button").on("click", function() {
      var value = $(this).attr('data-filter');
      
      if(value == "gallery-no-filter")
      {
          $('.gallery-img-box').removeClass("gallery-hidden");
      }
      else
      { 
          $(".gallery-img-box").not('.'+value).addClass("gallery-hidden");   
          $('.gallery-img-box').filter('.'+value).removeClass("gallery-hidden");
          
      }
  });

  $('.filter-gallery .filter-button').on("click", function() {
      $('.filter-gallery').find('.filter-button.active').removeClass('active');  
      $(this).addClass('active');
  });

  /*=================== MAGNIFICPOPUP GALLERY  ===================*/
  $(".gallery-list").magnificPopup({
          type: "image",
          removalDelay: 300 
      });

  /*======================= PROMO  =======================*/ 
   if($('#promo-item').length > 0){
      $("#promo-item").owlCarousel({
        dots: false,
        loop: true,
        autoplay: true,
        slideSpeed : 2000,
        margin: 0,
        responsiveClass: true,
        nav: false, 
           navText: ["<i class=\"fa fa-angle-left\" aria-hidden=\"true\"></i>", "<i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>"], 
        responsive: {
          0: {
            items: 1,
            nav: false
          },
          480: {
            items: 1,
            nav: false
          },
          600: {
            items: 1,
           nav: false
          },
          1000: {
            items: 1,
            nav: false, 
            margin: 0
          }
        }
         
      });
    }

  // ======================= TESTIMONIAL  ======================= // 
   if($('#testimonial-item').length > 0){
      $("#testimonial-item").owlCarousel({
        dots: true,
        loop: true,
        autoplay: true,
        slideSpeed : 2000,
        margin: 0,
        responsiveClass: true,
        nav: false, 
           navText: ["<i class=\"fa fa-angle-left\" aria-hidden=\"true\"></i>", "<i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>"], 
        responsive: {
          0: {
            items: 1,
            nav: false
          },
          480: {
            items: 1,
            nav: false
          },
          600: {
            items: 1,
           nav: false
          },
          1000: {
            items: 1,
            nav: false, 
            margin: 0
          }
        }
         
      });
    }

  /*=================== SLICK CAROUSEL FEATURED PRODUCT ===================*/
      $("#featured-product").slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 2
      });

  /*=================== SLICK CAROUSEL POPULER PRODUCT ===================*/
      $("#populer-product").slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 2
      });

  /*=================== SLICK CAROUSEL PRODUCT IMAGE ===================*/
      $("#product-image").slick({
      arrows: false,
      dots: true 
      });
      $('.number').keypress(function(e){
          let keyCode = e.which;
          if ( (keyCode != 8 || keyCode ==32 ) && (keyCode < 48 || keyCode > 57) ) {
              return false;
          }
      });

$('#validateForm').validate({
  rules: {
      mobile: {
          required: true
      },
      fullname: {
          required: true
      },
      name: {
          required: true
      },
      password: {
          required: true
      },
      repassword: {
          equalTo: "#password"
      },
      address: {
          required: true
      },
      otp: {
          required: true
      },
      terms: {
          required: true
      },
      payment_type: {
          required: true
      },
      email: {
          required: true,
          email: true
      }
  },
  errorElement: 'span',
  errorPlacement: function(error, element) {
  error.addClass('invalid-feedback');
  element.closest('.input-group').append(error);
  element.closest('.form-group').append(error);
  },
  highlight: function(element, errorClass, validClass) {
  $(element).addClass('is-invalid');
  },
  unhighlight: function(element, errorClass, validClass) {
  $(element).removeClass('is-invalid');
  }
});

const transitionLength = 700;

  let toastContain = document.createElement('div');
  toastContain.classList.add('toastContain');
  document.body.appendChild(toastContain);

  function toast(str, time, addClass = 'default') {
  if (!time || time === 'default') {
    time = 2000;
  }
  let toastEl = document.createElement('p');
  toastEl.classList.add('toast', addClass);
  toastEl.innerText = str;
  toastContain.prepend(toastEl);
  setTimeout(() => toastEl.classList.add('open'));
  setTimeout(
    () => toastEl.classList.remove('open'),
    time
  );
  setTimeout(
    () => toastContain.removeChild(toastEl),
    time + transitionLength
  );
  }


    $(document).on('click','.quantity-button', function(){
      if ($("#add-cart").length <= 0) {
        let qty = $(this).siblings("input").val();
        let form = $(this).parents("form");
        let price =  form.data('price');
        if (qty > 0) {
          $.ajax({  
             type:"GET",
             url:form.attr('action'),
             async:false,
             data:form.serialize(),  
             /*beforeSend: function(data){  
                $(".preloading").fadeIn("slow");
             },*/
             success: function (result) {
              $(".preloading").fadeOut("slow", function(){
                result = JSON.parse(result);
                toast(result.message, 'default', 'critical');
                $('.check-out-total').html(result.total);
                $("#change-"+form.data('id')).html('₹ '+price+' * '+qty+' = ₹ '+price * qty);
              });
            }
          });
        }else{
          return false;
        }
      }
   });
  
  $(document).on('submit','#add-to-cart', function(e){
      e.preventDefault();
      var form = $(this);
      $.ajax({  
         type:"GET",
         url:form.attr('action'),
         async:false,
         data:form.serialize(),  
         beforeSend: function(data){  
            $(".preloading").fadeIn("slow");
         },
         success: function (result) {
          $(".preloading").fadeOut("slow", function(){
            result = JSON.parse(result);
            toast(result.message, 'default', 'critical');
            $('.cart-item-count').html(result.count);
            if (window.location.href.indexOf('/single-product/') != -1) {
              if (result.message != 'Please Login First') {
                $("#remove-button-page").remove();
                $("#add-button-page").removeClass('s6');
                $("#add-button-page").addClass('s10');
              }
            }
          });
        }
      });
   });

  $(document).on('click','.delete-product', function(e){
      e.preventDefault();
      var id = $(this).data('id');
      $.ajax({  
         type:"GET",
         url:$(this).attr('href'),
         async:false,
         data:{id:id},
         beforeSend: function(data){  
            $(".preloading").fadeIn("slow");
         },
         success: function (result) {
          $(".preloading").fadeOut("slow", function(){
            result = JSON.parse(result);
            $('.cart-item-count').html(result.count);
            toast(result.message, 'default', 'critical');
            if (result.count < 1) {
              $('#check-cart').remove();
              $('#show-cart').html('<div class="error-page" > <div class="in-error-page"> <div class="in-in-error-page"> <h1>Oops,</h1> <p> Your Cart is Empty. </p><button class="btn button-add-cart checkout-button" onclick="location.href=\'shop\';" >Shop Now <i class="fas fa-arrow-circle-right"></i></button> </div></div></div>');
            }else{
              $('#'+id).remove();
              $('.check-out-total').html(result.total);
            }
          });
        }
      });
   });

  $('#add-to-wish').click(function(e){
    e.preventDefault();
    $.ajax({  
         type:"GET",
         url:$(this).data('href'),
         async:false,
         beforeSend: function(){  
            $(".preloading").fadeIn("slow");
         },
         success: function (result) {
          $(".preloading").fadeOut("slow", function(){
            result = JSON.parse(result);
            toast(result.message, 'default', 'critical');
          });
        }
      });
  })

  $("#final-checkout").click(function(e){
    e.preventDefault();
    var SITEURL = $('#url').val();
    if ($('#validateForm').valid()) {
      var payment_type = $("input[name='payment_type']:checked"). val();
      if (payment_type == "online") {
        var totalAmount = $('#total').val();
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
            "contact"  : $('#contact').val(),
            },
          "handler": function (response){
                $.ajax({
                  url: SITEURL + 'app/checkout/razorPaySuccess',
                  type: 'post',
                  dataType: 'json',
                  data: {
                    payment_id : response.razorpay_payment_id,
                    name       : $('#name').val(),
                    mobile     : $('#contact').val(),
                    del_date   : $("input[name='delivery_date']:checked"). val(),
                    del_time   : $("input[name='delivery_time']:checked"). val(),
                    address    : $('#billing-address').val()
                  }, 
                  success: function (msg) {
                    if (msg.status == true) {
                      toast(msg.msg, 'default', 'critical');
                      setTimeout( function(){ window.location.href = SITEURL + 'app/checkout/RazorThankYou'; }, 3000 );
                    }else{
                      toast(msg.msg, 'default', 'critical');
                    }
                  }
              });
        },
      };

      var rzp1 = new Razorpay(options);
      rzp1.open();
      e.preventDefault();
        
      }else{
        $.ajax({
              url: SITEURL + 'app/checkout/razorPaySuccess',
              type: 'post',
              dataType: 'json',
              data: {
                payment_id : "cash",
                name       : $('#name').val(),
                mobile     : $('#contact').val(),
                del_date   : $("input[name='delivery_date']:checked"). val(),
                del_time   : $("input[name='delivery_time']:checked"). val(),
                address    : $('#billing-address').val()
              }, 
              success: function (msg) {
                if (msg.status == true) {
                  toast(msg.msg, 'default', 'critical');
                  setTimeout( function(){ window.location.href = SITEURL + 'app/checkout/RazorThankYou'; }, 3000 );
                }else{
                  toast(msg.msg, 'default', 'critical');
                }
              }
          });
        }
    }else{
      toast("Complete the Checkout Form.", 'default', 'critical');
      return false;
    }
  });

  $('#subscribe-form').click(function(e){
    var form = $(this).parents('form');
    if (form.valid()) {
      e.preventDefault();
      $.ajax({
        url: form.attr('action'),
        type: 'post',
        async:false,
        data:form.serialize(),
        success: function (response) {
          response = JSON.parse(response);
          form.find("input[type=email], input[type=text], textarea").val("");
          toast(response.message, 'default', 'critical');
        }
    });
    }else{
      return false;
    }
  })
})(jQuery);
