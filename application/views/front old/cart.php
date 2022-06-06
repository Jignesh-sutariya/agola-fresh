<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if ($cart): ?>
<section class="ftco-section ftco-cart">
	<div class="container">
		<div class="row">
			<div class="col-md-12 ftco-animate">
				<div class="cart-list">
					<table class="table">
						<thead class="thead-primary">
							<tr class="text-center">
								<th>Product name</th>
								<th>&nbsp;</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php $total = 0; foreach ($cart as $k => $v): $total += $v->price * $v->qty;?>
							<tr class="text-center" id="remove_<?= e_id($v->id) ?>">
								<td class="product-name">
									<h3><?= ucwords($v->eng_name) ?></h3>
									<p>( <?= $v->guj_name ?> )</p>
								</td>
								<td class="image-prod">
									<div class="img" style="background-image:url(<?= $v->image ?>);"></div>
								</td>
								<td class="price">₹ <?= $v->price ?></td>
								<td class="quantity">
									<div class="input-group mb-3">
										<span class="quantity-buttons quantity-minus">-</span>
										<input type="text" name="quantity" class="quantity form-control input-number number" value="<?= $v->qty ?>" min="1" max="100"  data-id="<?= e_id($v->id) ?>" data-href="<?= base_url('add-to-cart') ?>" readonly data-price="<?= $v->price ?>">
										<span class="quantity-buttons quantity-plus">+</span>
									</div>
								</td>
								<td class="total total_<?= e_id($v->id) ?>">₹ <?= $v->price * $v->qty ?></td>
								<td class="product-remove"><a href="<?= base_url('remove-product') ?>" class="add-to-cart" data-id="<?= e_id($v->id) ?>"><span class="ion-ios-close"></span></a></td>
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="row justify-content-end">
			<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
				<div class="cart-total mb-3">
					<h3>Cart Totals</h3>
					<p class="d-flex">
						<span>Subtotal</span>
						<span class="change-price">₹ <?= $total ?></span>
					</p>
					<p class="d-flex">
						<span>Delivery</span>
						<span>₹ 0</span>
					</p>
					<hr>
					<p class="d-flex total-price">
						<span>Total</span>
						<span class="change-price">₹ <?= $total ?></span>
					</p>
				</div>
				<p><a href="<?= base_url('checkout') ?>" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
			</div>
		</div>
	</div>
</section>
<?php else: ?>
	<section class="ftco-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12 ftco-animate">
				<div class="text py-3 pb-4 px-3 text-center">
					<div class="ml-md-0">
	                    <h2 class="mb-4">Your cart</h2>
	                </div>
	                <div class="ml-md-0">
	                    <p class="mb-4">Your cart is currently empty.</p>
	                </div>
					<!-- <img src="<?= images('emptycart.gif') ?>" alt="" width="100%"> -->
					<div class="d-flex px-3">
						<div class="m-auto d-flex">
							<a href="<?= base_url('shop') ?>" class="btn btn-primary py-3 px-5">
								<span>Shop More</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif ?>