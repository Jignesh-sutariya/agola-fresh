<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="ftco-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 mb-5 ftco-animate">
				<a href="<?= $product['image'] ?>" class="image-popup"><img src="<?= $product['image'] ?>" class="img-fluid" alt="Agola Fresh"></a>
			</div>
			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
				<h3><?= $product['eng_name'] ?></h3>
				<h3><?= $product['guj_name'] ?></h3>
				<p class="price"><span><?= $product['price'] ?></span></p>
				<div class="row mt-4">
					<div class="w-100"></div>
					<div class="input-group col-md-6 d-flex mb-3">
						<span class="input-group-btn mr-2">
							<button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
							<i class="ion-ios-remove"></i>
							</button>
						</span>
						<input type="text" id="quantity" name="quantity" class="form-control input-number number" value="<?= (!empty($qty)) ? $qty : 1 ?>" min="1" max="100">
						<span class="input-group-btn ml-2">
							<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
							<i class="ion-ios-add"></i>
							</button>
						</span>
					</div>
					<div class="w-100"></div>
					<div class="col-md-12">
						<p style="color: #000;">Price per <?= $product['min_qty'].' '.$product['qty_type'] ?></p>
					</div>
				</div>
				<p><a href="<?= base_url('add-to-cart') ?>" class="add-to-cart btn btn-black py-3 px-5" data-id="<?= e_id($product['id']) ?>" data-adding="Adding" data-added="Added to Cart">Add to Cart</a></p>
			</div>
		</div>
	</div>
</section>