<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12 mb-5 text-center">
				<ul class="product-category">
					<li><a href="javascript:void(0)" class="active category">ALL</a></li>
					<?php foreach ($categories as $k => $v): ?>
						<li><a href="javascript:void(0)" class="category" data-id="<?= e_id($v['id']) ?>"><?= strtoupper($v['category']) ?></a></li>
					<?php endforeach ?>
				</ul>
			</div>
		</div>
		<div id="products" class="row"></div>
		<div class="row mt-5">
			<div class="col text-center">
				<div class="block-27">
					<div id="pagination_link"></div>
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
						<input type="text" name="email" class="form-control" placeholder="Enter email address">
						<input type="submit" value="Subscribe" class="submit px-3">
					</div>
				</form>
			</div>
		</div>
	</div>
</section>