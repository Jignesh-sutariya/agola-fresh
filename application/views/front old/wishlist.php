<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if ($wishlist): ?>
<section class="ftco-section ftco-cart">
	<div class="container">
		<div class="row">
			<div class="col-md-12 ftco-animate">
				<div class="cart-list">
					<table class="table">
						<thead class="thead-primary">
							<tr class="text-center">
								<th>Product List</th>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($wishlist as $k => $v): ?>
							<tr class="text-center">
								<td class="product-name">
									<h3><?= ucfirst($v->eng_name)."<br>(".$v->guj_name.")" ?></h3>
								</td>
								<td class="image-prod">
									<div class="img" style="background-image:url(<?= $v->image ?>);"></div>
								</td>
								<td class="product-remove">
									<a href="<?= base_url('remove-wishlist') ?>" class="add-to-wishlist" data-id="<?= e_id($v->id) ?>">
										<span class="ion-ios-close"></span>
									</a>
								</td>
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
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
	                    <h2 class="mb-4">Your Wishlist</h2>
	                </div>
	                <div class="ml-md-0">
	                    <p class="mb-4">Your wishlist is currently empty.</p>
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