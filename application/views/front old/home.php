<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section id="home-section" class="hero">
	<div class="home-slider owl-carousel">
		<?php foreach ($banners as $key => $v): ?>
		<div class="slider-item" style="background-image: url(<?= $v['banner'] ?>);">
			<!-- <div class="overlay"></div>
			<div class="container">
				<div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
					<div class="col-md-12 ftco-animate text-center">
						<h1 class="mb-2"><?= ucwords($v['title']) ?></h1>
						<h2 class="subheading mb-4"><?= ucwords($v['sub_title']) ?></h2>
					</div>
				</div>
			</div> -->
		</div>
		<?php endforeach ?>
	</div>
</section>
<section class="ftco-section">
	<div class="container">
		<div class="row no-gutters ftco-services">
			<div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
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
			<div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
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
			<div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
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
			<div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
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

<?php foreach ($products as $key => $v): ?>
<section>
	<div class="container">
		<div class="row justify-content-center mb-3 pb-3">
			<div class="col-md-12 heading-section text-center ftco-animate">
				<h2 class="mb-4"><?= ucwords($v['category']) ?></h2>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row  carousel-products owl-carousel">
			<?php foreach ($v['products'] as $k => $v): ?>
			<div class="col-md-12 col-lg-12 ftco-animate">
				<div class="product">
					<a href="<?= base_url('single-product/'.$v['slug'].'/'.e_id($v['id'])) ?>" class="img-prod"><img class="img-fluid" src="<?= $v['image'] ?>" alt="Agola Fresh">
						<div class="overlay"></div>
					</a>
					<div class="text py-3 pb-4 px-3 text-center">
						<h3><a href="<?= base_url('single-product/'.$v['slug'].'/'.e_id($v['id'])) ?>"><?= strtoupper($v['eng_name']) ?></a></h3>
						<h3><a href="<?= base_url('single-product/'.$v['slug'].'/'.e_id($v['id'])) ?>"><?= $v['guj_name'] ?></a></h3>
						<div class="d-flex">
							<div class="pricing">
								<p class="price"><span class="price-sale"><?= $v['price'] ?></span></p>
							</div>
						</div>
						<div class="bottom-area d-flex px-3">
							<div class="m-auto d-flex">
								<a href="<?= base_url('view-product/'.e_id($v['id'])) ?>" class="d-flex justify-content-center align-items-center text-center view-product">
									<span><i class="ion-ios-eye"></i></span>
								</a>
								<a href="<?= base_url('add-to-cart') ?>" class="add-to-cart d-flex justify-content-center align-items-center mx-1" data-id="<?= e_id($v['id']) ?>">
									<span><i class="ion-ios-cart"></i></span>
								</a>
								<a href="<?= base_url('add-to-wishlist') ?>" class="add-to-wishlist d-flex justify-content-center align-items-center " data-id="<?= e_id($v['id']) ?>">
									<span><i class="ion-ios-heart"></i></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php endforeach ?>
		</div>
	</div>
</section>
<?php endforeach ?>

<section class="ftco-section img" style="background-image: url(<?= images('bg_3.jpg') ?>);">
	<div class="container">
		<div class="row justify-content-end">
			<div class="col-md-6 heading-section ftco-animate deal-of-the-day ftco-animate">
				<span class="subheading">Make your Phone more useful!</span>
				<h2 class="mb-4">Download Our APP</h2>
				<p>Download the best in class ordering app made for you! It's the fastest app you have ever used.</p>
				<h3><a href="https://play.google.com/store/apps/details?id=com.densetek.agolafresh" target="_blank"><img src="<?= images('play-store.png') ?>" alt=""></a></h3>
				<div id="timer" class="d-flex mt-5">
					<p>
						BUY VEGETABLES FROM OUR ON-LINE STORE. "AGOLA FRESH” GET THE VEGETABLES DELIVERED TO YOUR DOORSTEP. QUALITY ASSURED, SAME DAY DELIVERY.
					</p>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="ftco-section testimony-section">
	<div class="container">
		<div class="row justify-content-center mb-5 pb-3">
			<div class="col-md-7 heading-section ftco-animate text-center">
				<span class="subheading">Testimony</span>
				<h2 class="mb-4">Our satisfied customer says</h2>
				<p>Far far away, behind the word mountains, there live the blind texts. Separated they live in</p>
			</div>
		</div>
		<div class="row ftco-animate">
			<div class="col-md-12">
				<div class="carousel-testimony owl-carousel">
					<div class="item">
						<div class="testimony-wrap p-4 pb-5">
							<div class="user-img mb-5" style="background-image: url(<?= images('front-logo.png') ?>)">
								<span class="quote d-flex align-items-center justify-content-center">
									<i class="icon-quote-left"></i>
								</span>
							</div>
							<div class="text text-center">
								<p class="mb-5 pl-4 line">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
								<p class="name">Garreth Smith</p>
								<span class="position">Marketing Manager</span>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="testimony-wrap p-4 pb-5">
							<div class="user-img mb-5" style="background-image: url(<?= images('front-logo.png') ?>)">
								<span class="quote d-flex align-items-center justify-content-center">
									<i class="icon-quote-left"></i>
								</span>
							</div>
							<div class="text text-center">
								<p class="mb-5 pl-4 line">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
								<p class="name">Garreth Smith</p>
								<span class="position">Interface Designer</span>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="testimony-wrap p-4 pb-5">
							<div class="user-img mb-5" style="background-image: url(<?= images('front-logo.png') ?>)">
								<span class="quote d-flex align-items-center justify-content-center">
									<i class="icon-quote-left"></i>
								</span>
							</div>
							<div class="text text-center">
								<p class="mb-5 pl-4 line">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
								<p class="name">Garreth Smith</p>
								<span class="position">UI Designer</span>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="testimony-wrap p-4 pb-5">
							<div class="user-img mb-5" style="background-image: url(<?= images('front-logo.png') ?>)">
								<span class="quote d-flex align-items-center justify-content-center">
									<i class="icon-quote-left"></i>
								</span>
							</div>
							<div class="text text-center">
								<p class="mb-5 pl-4 line">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
								<p class="name">Garreth Smith</p>
								<span class="position">Web Developer</span>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="testimony-wrap p-4 pb-5">
							<div class="user-img mb-5" style="background-image: url(<?= images('front-logo.png') ?>)">
								<span class="quote d-flex align-items-center justify-content-center">
									<i class="icon-quote-left"></i>
								</span>
							</div>
							<div class="text text-center">
								<p class="mb-5 pl-4 line">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
								<p class="name">Garreth Smith</p>
								<span class="position">System Analyst</span>
							</div>
						</div>
					</div>
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