<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="ftco-section ftco-no-pb ftco-no-pt bg-light">
	<div class="container">
		<div class="row">
			<div class="col-md-5 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url(<?= images('about.jpg') ?>);">
			</div>
			<div class="col-md-7 py-5 wrap-about pb-md-5 ftco-animate">
				<div class="heading-section-bold mb-4 mt-md-5">
					<div class="ml-md-0">
						<h2 class="mb-4">Welcome to Agola Fresh</h2>
					</div>
				</div>
				<div class="pb-md-5">
					<p>BUY VEGETABLES FROM OUR ON-LINE STORE. "AGOLA FRESH” GET THE VEGETABLES DELIVERED TO YOUR DOORSTEP. QUALITY ASSURED, SAME DAY DELIVERY. <br><br>
					There's a part of our lives that is fundamentally exhausting. It's the experience of going to the market, looking for the desired product, settling for its freshness & quality, and bargaining. It's called buying. We decided to make this a no sweat experience by our clean & user-friendly website with fast checkout and easy payment options.</p>
					<p><a href="<?= base_url('shop') ?>" class="btn btn-primary">Shop now</a></p>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
	<div class="container py-4">
		<div class="row d-flex justify-content-center py-5">
			<div class="col-md-6">
				<h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
				<span>Get e-mail updates about our latest shops and special offers</span>
			</div>
			<div class="col-md-6 d-flex align-items-center">
				<form action="<?= base_url('subscribe') ?>" class="subscribe-form" method="POST">
					<div class="form-group d-flex">
						<input type="text" class="form-control" name="email" placeholder="Enter email address">
						<input type="submit" value="Subscribe" class="submit px-3">
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<!-- <section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(<?= images('bg_3.jpg') ?>);">
	<div class="container">
		<div class="row justify-content-center py-5">
			<div class="col-md-10">
				<div class="row">
					<div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
						<div class="block-18 text-center">
							<div class="text">
								<strong class="number" data-number="10000">0</strong>
								<span>Happy Customers</span>
							</div>
						</div>
					</div>
					<div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
						<div class="block-18 text-center">
							<div class="text">
								<strong class="number" data-number="100">0</strong>
								<span>Branches</span>
							</div>
						</div>
					</div>
					<div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
						<div class="block-18 text-center">
							<div class="text">
								<strong class="number" data-number="1000">0</strong>
								<span>Partner</span>
							</div>
						</div>
					</div>
					<div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
						<div class="block-18 text-center">
							<div class="text">
								<strong class="number" data-number="100">0</strong>
								<span>Awards</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section> -->
<section class="ftco-section bg-light">
	<div class="container">
		<div class="row no-gutters ftco-services">
			<div class="col-lg-3 text-center d-flex align-self-stretch ftco-animate">
				<div class="media block-6 services mb-md-0 mb-4">
					<div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
						<span class="flaticon-shipped"></span>
					</div>
					<div class="media-body">
						<h3 class="heading">Free Shipping</h3>
						<span>On order over ₹ 100</span>
					</div>
				</div>
			</div>
			<div class="col-lg-3 text-center d-flex align-self-stretch ftco-animate">
				<div class="media block-6 services mb-md-0 mb-4">
					<div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
						<span class="flaticon-diet"></span>
					</div>
					<div class="media-body">
						<h3 class="heading">Always Fresh</h3>
						<span>Product well package</span>
					</div>
				</div>
			</div>
			<div class="col-lg-3 text-center d-flex align-self-stretch ftco-animate">
				<div class="media block-6 services mb-md-0 mb-4">
					<div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
						<span class="flaticon-award"></span>
					</div>
					<div class="media-body">
						<h3 class="heading">Superior Quality</h3>
						<span>Quality Products</span>
					</div>
				</div>
			</div>
			<div class="col-lg-3 text-center d-flex align-self-stretch ftco-animate">
				<div class="media block-6 services mb-md-0 mb-4">
					<div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
						<span class="flaticon-customer-service"></span>
					</div>
					<div class="media-body">
						<h3 class="heading">Support</h3>
						<span>24/7 Support</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>