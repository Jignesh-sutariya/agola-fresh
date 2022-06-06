<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- BANNER -->
<div class="main-slider" data-indicators="true">
	<div class="carousel carousel-slider " data-indicators="true">
		<?php foreach ($banners as $key => $v): ?>
		<a class="carousel-item"><img src="<?= $v['banner'] ?>" alt="slider"></a>
		<?php endforeach ?>
	</div>
</div>
<!-- END BANNER -->
<!-- CATEGORY -->
<div class="section home-category">
	<div class="container">
		<div class="row">
			<div class="col s12">
				<div class="section-title">
					<span class="theme-secondary-color">FIND</span> PRODUCTS
				</div>
			</div>
		</div>
		<div class="row icon-service">
			<?php foreach ($categories as $k => $v): ?>
			<?php if ($k <= 2): ?>
			<a href="<?= app('shop?category='.$v['id']) ?>" title="Product Image">
				<div class="col s4 m4 l2">
					<div class="content">
						<div class="in-content">
							<div class="in-in-content">
								<img src="<?= $v['image'] ?>" alt="category">
								<h5><?= ucwords($v['category']) ?></h5>
							</div>
						</div>
					</div>
				</div>
			</a>
			<?php endif ?>
			<?php endforeach ?>
		</div>
	</div>
</div>
<!-- END CATEGORY -->
<!-- POPULER SEARCH -->
<div class="section populer-search">
	<div class="container">
		<div class="row row-title">
			<div class="col s12">
				<div class="section-title">
					<span class="theme-secondary-color">POPULER</span> SEARCH
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col s12">
				<div class="list-tag-word">
					<?php foreach ($products as $k => $v): ?>
					<?php if ($k <= 6): ?>
					<a class="tag-word" href="<?= app('single-product/'.$v['id']) ?>" title="<?= $v['eng_name'] ?>"><?= $v['eng_name'] ?></a>
					<?php endif ?>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END POPULER SEARCH -->
<!-- PROMO -->
<div class="section promo">
	<div class="container">
		<div class="col s12">
			<img src="<?= assets('app/img/promo.png') ?>" alt="promo">
		</div>
	</div>
</div>
<!-- END PROMO -->
<!-- FEATURED PRODUCT -->
<div class="section product-item si-featured">
	<div class="container">
		<div class="row row-title">
			<div class="col s12">
				<div class="section-title">
					<span class="theme-secondary-color">FEATURED</span> PRODUCTS
				</div>
			</div>
		</div>
		<div class="row slick-product">
			<div class="col s12">
				<div id="featured-product" class="featured-product">
					<?php foreach ($products as $k => $v): ?>
					<!-- Product item-->
					<div>
						<div class="col-slick-product">
							<div class="box-product">
								<div class="bp-top">
									<div class="product-list-img">
										<div class="pli-one">
											<div class="pli-two">
												<img src="<?= $v['image'] ?>" alt="img">
											</div>
										</div>
									</div>
									<h5><a href="<?= app('single-product/'.$v['id']) ?>">Broccoli</a></h5>
									<div class="item-info"><?= $v['guj_name'] ?></div>
									<div class="price">
										<?= $v['price'] ?> <span>/ <?= $v['min_qty'].' '.$v['qty_type'] ?> </span>
									</div>
									<div class="stock-item"></div>
								</div>
								<div class="bp-bottom">
									<form action="<?= app('add_cart') ?>" method="get" accept-charset="utf-8" id="add-to-cart">
										<input type="hidden" name="prod_id" value="<?= $v['id'] ?>">
										<button class="btn button-add-cart">BUY</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- End Product item-->
					<?php endforeach ?>
				</div>
				<div class="more-product-list">
					<a class="more-btn" href="<?= app('shop') ?>">See More ></a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END FEATURED PRODUCT -->
<!-- SUBSCRIBE -->
<div class="section subscribe">
	<div class="container">
		<div class="row">
			<div class="col s12">
				<div class="section-title">SUBSCRIBE</div>
				<p class="center">Get Your Groceries delivered from local stores</p>
				<form action="<?= base_url('subscribe') ?>" method="post" accept-charset="utf-8" id="validateForm">
					<div class="mail-subscribe-box">
						<input class="form-control" name="email" placeholder="Enter email address" value="" type="email">
						<i class="fa fa-angle-right" id="subscribe-form"></i>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="bg-subscribe" style="background-image: url(<?= images('bg-profile.jpg') ?>);">
	</div>
</div>
<!-- END SUBSCRIBE -->