<div class="row">
	<div class="col-lg-6 col-md-6 col-xs-12 sticky">
		<ul class="thumbnails">
			<li>
				<a class="thumbnail" href="<?= $product['image'] ?>" title="iPhone">
					<img data-zoom-image="<?= $product['image'] ?>" src="<?= $product['image'] ?>" class="img-responsive center-block zoom_image" alt="image" width="80%">
				</a>
			</li>
		</ul>
	</div>
	<div class="col-md-6 col-lg-6 col-xs-12 pro-content">
		<h1><?= $product['eng_name'] ?> (<?= $product['guj_name'] ?>)</h1><hr class="producthr">
		<ul class="list-unstyled">
			<li><span class="text-decor">Qty Type:</span><?= strtoupper($product['qty_type']) ?></li>
			<li><span class="text-decor">Min Qty</span><?= $product['min_qty'] ?></li>
			<li><span class="text-decor">Availability:</span> In Stock</li>
			<hr class="producthr">
		</ul>
		<ul class="list-unstyled">
			<li class="text-decor-bold">
				<h2 class="pro-price"><?= $product['price'] ?></h2>
			</li>
		</ul>
		<div id="product">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2 col-md-1 col-xs-2 op-box qtlabel">
						<label class="control-label text-decorop" for="input-quantity">Qty</label>
					</div>
					<div class="col-md-11 col-sm-10 col-xs-10 op-box qty-plus-minus">
						<button type="button" class="form-control pull-left btn-number btnminus" disabled="disabled" data-type="minus" data-field="quantity">
						<span class="glyphicon glyphicon-minus"></span>
						</button>
						<input type="text" name="quantity" value="1" size="2" id="input-quantity" class="form-control input-number pull-left" />
						<input type="hidden" name="product_id" value="40" />
						<button type="button" class="form-control pull-left btn-number btnplus" data-type="plus" data-field="quantity">
						<span class="glyphicon glyphicon-plus"></span>
						</button>
					</div>
				</div><hr class="producthr">
				<button type="button" data-loading="Adding..." data-complete="Added to Cart" class="btn add-to-cart btn-primary <?= e_id($product['id']) ?>" onclick="cart.add(<?= e_id($product['id']) ?>);" >Add to Cart</button>
			</div>
		</div>
	</div>
</div>