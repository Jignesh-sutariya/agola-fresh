<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Agola Fresh <?= (!empty($name)) ? '| '.ucwords($name) : '' ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="icon" href="<?= images('favicon.png') ?>" type="image/x-icon" />
		<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="<?= front_assets('css/open-iconic-bootstrap.min.css') ?>">
		<link rel="stylesheet" href="<?= front_assets('css/animate.css') ?>">
		
		<link rel="stylesheet" href="<?= front_assets('css/owl.carousel.min.css') ?>">
		<link rel="stylesheet" href="<?= front_assets('css/owl.theme.default.min.css') ?>">
		<link rel="stylesheet" href="<?= front_assets('css/magnific-popup.css') ?>">
		<link rel="stylesheet" href="<?= front_assets('css/aos.css') ?>">
		<link rel="stylesheet" href="<?= front_assets('css/ionicons.min.css') ?>">
		<link rel="stylesheet" href="<?= front_assets('css/bootstrap-datepicker.css') ?>">
		<link rel="stylesheet" href="<?= front_assets('css/jquery.timepicker.css') ?>">
		<link rel="stylesheet" href="<?= front_assets('css/flaticon.css') ?>">
		<link rel="stylesheet" href="<?= front_assets('css/icomoon.css') ?>">
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
		<link rel="stylesheet" href="<?= front_assets('css/style.css') ?>">
		<!-- <style type="text/css" media="screen">
			.float {
			    position: fixed;
			    width: 60px;
			    height: 60px;
			    bottom: 40px;
			    right: 40px;
			    background-color: #25d366;
			    color: #FFF;
			    border-radius: 50px;
			    text-align: center;
			    font-size: 30px;
			    box-shadow: 2px 2px 3px #999;
			    z-index: 100;
			}
			.my-float {
			    margin-top: 16px;
			}
		</style> -->
	</head>
	<body class="goto-here">
		<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
			<div class="container">
				<a class="navbar-brand" href="<?= base_url() ?>">
					<img src="<?= images('front-logo.png') ?>" alt="logo" height="75">
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span> Menu
				</button>
				<div class="collapse navbar-collapse" id="ftco-nav">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active"><a href="<?= base_url() ?>" class="nav-link">Home</a></li>
						<li class="nav-item"><a href="<?= base_url('about') ?>" class="nav-link">About</a></li>
						<li class="nav-item"><a href="<?= base_url('shop') ?>" class="nav-link">Shop</a></li>
						<li class="nav-item"><a href="<?= base_url('contact') ?>" class="nav-link">Contact</a></li>
						<?php if (!empty($this->session->userdata('user_id'))): ?>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account</a>
							<div class="dropdown-menu" aria-labelledby="dropdown04">
								<a class="dropdown-item" href="<?= base_url('wishlist') ?>">Wishlist</a>
								<a class="dropdown-item" href="<?= base_url('checkout') ?>">Checkout</a>
								<a class="dropdown-item" href="<?= base_url('my-orders') ?>">My Orders</a>
								<a class="dropdown-item" href="<?= base_url('logout') ?>">LogOut</a>
							</div>
						</li>
						<?php else: ?>
						<li class="nav-item"><a href="<?= base_url('login') ?>" class="nav-link">Login</a></li>
						<?php endif ?>
						<li class="nav-item cta cta-colored"><a href="<?= base_url() ?>cart" class="nav-link"><span class="icon-shopping_cart"></span>[
							<span id="counter">
								<?php 
									if (!empty($this->session->userdata('user_id'))): 
										echo $this->main->count('cart', [ 'cust_id' => $this->session->userdata('user_id') ]);
									else: 
										echo count((array) json_decode(get_cookie('cart')));
									endif ?>
							</span>]</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<?php if (isset($title)): ?>
		<div class="hero-wrap hero-bread" style="background-image: url(<?= images('bg_1.jpg') ?>);">
			<div class="container">
				<div class="row no-gutters slider-text align-items-center justify-content-center">
					<div class="col-md-9 ftco-animate text-center">
						<p class="breadcrumbs"><span class="mr-2"><a href="<?= base_url() ?>">Home</a></span> <span><?= $title ?></span></p>
						<h1 class="mb-0 bread"><?= $title ?></h1>
					</div>
				</div>
			</div>
		</div>
		<?php endif ?>
		<?= $contents ?>
		<footer class="ftco-footer ftco-section">
			<div class="container">
				<div class="row">
					<div class="mouse">
						<a href="javascript:void(0)" class="mouse-icon">
							<div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
						</a>
					</div>
				</div>
				<div class="row mb-5">
					<div class="col-md">
						<div class="ftco-footer-widget mb-4">
							<h2 class="ftco-heading-2">Agola Fresh</h2>
							<p>BUY VEGETABLES FROM OUR ON-LINE STORE. "AGOLA FRESH” GET THE VEGETABLES DELIVERED TO YOUR DOORSTEP. QUALITY ASSURED, SAME DAY DELIVERY.</p>
							<ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
								<li class="ftco-animate"><a href="https://www.facebook.com/Agola-fresh-658782488067619/" target="_blank"><span class="icon-facebook"></span></a></li>
								<li class="ftco-animate"><a href="https://www.instagram.com/agolafresh_official/?igshid=1tn2deut9ptqy" target="_blank"><span class="icon-instagram"></span></a></li>
							</ul>
						</div>
					</div>
					<div class="col-md">
						<div class="ftco-footer-widget mb-4 ml-md-5">
							<h2 class="ftco-heading-2">Menu</h2>
							<ul class="list-unstyled">
								<li><a href="<?= base_url('shop') ?>" class="py-2 d-block">Shop</a></li>
								<li><a href="<?= base_url('about') ?>" class="py-2 d-block">About</a></li>
								<li><a href="<?= base_url('contact') ?>" class="py-2 d-block">Contact Us</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-4">
						<div class="ftco-footer-widget mb-4">
							<h2 class="ftco-heading-2">Help</h2>
							<div class="d-flex">
								<ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
									<li><a href="<?= base_url('terms') ?>" class="py-2 d-block">Terms &amp; Conditions</a></li>
									<li><a href="<?= base_url('disclaimer') ?>" class="py-2 d-block">Disclaimer</a></li>
									<li><a href="<?= base_url('privacy-policy') ?>" class="py-2 d-block">Privacy Policy</a></li>
									<li><a href="<?= base_url('cancellation-return-policy') ?>" class="py-2 d-block">Cancellation & Return Policy</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md">
						<div class="ftco-footer-widget mb-4">
							<h2 class="ftco-heading-2">Have a Questions?</h2>
							<div class="block-23 mb-3">
								<ul>
									<li><span class="icon icon-map-marker"></span><span class="text">Agola Fresh, Nr rachna School, B/h Swapnil Flat, Akhbar Nagar, Nava Vadaj, Ahmedabad - 380013</span></li>
									<li><a href="javascript:void(0)"><span class="icon icon-phone"></span><span class="text">+91 6354072536</span></a></li>
									<li><a href="javascript:void(0)"><span class="icon icon-envelope"></span><span class="text">agolafresh@gmail.com</span></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 text-center">
						<p>
							Copyright &copy;2020 All rights reserved By agolafresh.com | Developed by <a href="https://densetek.com" target="_blank">Densetek</a>
						</p>
					</div>
				</div>
			</div>
		</footer>
		<!-- loader -->
		<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
		<!-- loader end -->
		<!-- <a href="https://wa.me/917227837620" class="float" target="_blank">
		<i class="fa fa-whatsapp my-float"></i>
		</a> -->
		<input type="hidden" id="">
		<script src="<?= front_assets('js/jquery.min.js') ?>"></script>
		<script src="<?= front_assets('js/jquery-migrate-3.0.1.min.js') ?>"></script>
		<script src="<?= front_assets('js/popper.min.js') ?>"></script>
		<script src="<?= front_assets('js/bootstrap.min.js') ?>"></script>
		<script src="<?= front_assets('js/jquery.easing.1.3.js') ?>"></script>
		<script src="<?= front_assets('js/jquery.waypoints.min.js') ?>"></script>
		<script src="<?= front_assets('js/jquery.stellar.min.js') ?>"></script>
		<script src="<?= front_assets('js/owl.carousel.min.js') ?>"></script>
		<script src="<?= front_assets('js/jquery.magnific-popup.min.js') ?>"></script>
		<script src="<?= front_assets('js/aos.js') ?>"></script>
		<script src="<?= front_assets('js/jquery.animateNumber.min.js') ?>"></script>
		<script src="<?= front_assets('js/bootstrap-datepicker.js') ?>"></script>
		<script src="<?= front_assets('js/scrollax.min.js') ?>"></script>
		<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9" type="text/javascript" charset="utf-8" async defer></script> -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" type="text/javascript"></script>
		<script src="<?= assets('plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
		<script src="<?= assets('plugins/jquery-validation/additional-methods.min.js') ?>"></script>
		<script src="<?= assets('plugins/moment/moment.min.js') ?>"></script>
		<script src="<?= assets('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
		<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
		<script src="<?= front_assets('js/main.js') ?>"></script>
		<?php if (!empty($shop)): ?>
		<script>
			$(document).ready(function(){
			 function load_products(page, category="")
			 {
			  $.ajax({
			   url:"<?= base_url('shop/products/') ?>"+page+"/"+category,
			   method:"GET",
			   dataType:"json",
			   beforeSend: function(data){  
		          $('#ftco-loader').addClass('show');
		       },
			   success:function(data)
			   {
			   	var products = '';
			    $.each(data.products, function (index, prod) {
			    	products += '<div class="col-md-6 col-lg-3"><div class="product"> <a href="<?= base_url() ?>single-product/'+prod.slug+'/'+prod.id+'" class="img-prod"> <img class="img-fluid" src="'+prod.image+'" alt="Product Image"><div class="overlay"></div> </a><div class="text py-3 pb-4 px-3 text-center"><h3><a href="<?= base_url() ?>single-product/'+prod.slug+'/'+prod.id+'">'+prod.eng_name+' ('+prod.guj_name+')</a></h3><h3><a href="<?= base_url() ?>single-product/'+prod.slug+'/'+prod.id+'">per '+prod.min_qty+' '+prod.qty_type+'</a></h3> <div class="d-flex"><div class="pricing"><p class="price"><span class="price-sale">'+prod.price+'</span></p></div></div><div class="bottom-area d-flex px-3"><div class="m-auto d-flex"><a href="<?= base_url() ?>view-product/'+prod.id+'" class="d-flex justify-content-center align-items-center text-center view-product"><span><i class="ion-ios-eye"></i></span></a><a href="<?= base_url('add-to-cart') ?>" data-id="'+prod.id+'" class="add-to-cart d-flex justify-content-center align-items-center mx-1"><span><i class="ion-ios-cart"></i></span></a><a href="<?= base_url('add-to-wishlist') ?>" data-id="'+prod.id+'" class="add-to-wishlist d-flex justify-content-center align-items-center "><span><i class="ion-ios-heart"></i></span></a></div></div></div></div></div>';
			    })
			    $('#products').html(products);
			    $('#pagination_link').html(data.pagination_link);
			   }
			  })
			  .done(function( data ) {
			    $('#ftco-loader').removeClass('show');
			  });
			 }
			 
			 load_products(1);

			 $(document).on("click", "#pagination_link li a", function(event){
			  if ($(this).parents().attr("class") == 'active') return false;
			  event.preventDefault();
			  var page = $(this).data("ci-pagination-page");
			  var category = $(this).data("id");
			  load_products(page, category);
			 });

			 $(document).on("click", ".category", function(){
			 	if ($(this).hasClass("active")) return false;
				var category = $(this).data("id");
				$('.category').removeClass('active');
				$(this).addClass('active');
				load_products(1, category);
			 });
			});
		</script>
		<?php endif ?>
		<div class="modal fade" id="show-prod" role="dialog">
		    <div class="modal-dialog modal-lg">
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		        </div>
		        <div class="modal-body" id="prod-details">
		        </div>
		      </div>
		    </div>
		</div>
		<div id="toast-container" class="toast-top-right"></div>
	</body>
</html>