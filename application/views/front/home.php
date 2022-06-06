<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="slideshow0" class="owl-carousel owl-theme">
	<?php foreach ($banners as $k => $v): ?>
	<div class="text-center">
		<img src="<?= $v['banner'] ?>" alt="Agola Fresh" class="img-responsive" />
	</div>
	<?php endforeach ?>
</div>
<?php foreach ($products as $k => $v): ?>
<div class="pro-bg">
	<h2 class="pull-left"><?= ucwords($v['category']) ?></h2>
	<ul class="nav nav-tabs pull-right">
		<li><a href="<?= base_url('shop?category='.$v['slug']) ?>">view all</a></li>
	</ul>
	<hr>
	<div class="tab-content pro-nepr">
		<div class="products owl-theme owl-carousel">
			<?php foreach ($v['products'] as $k => $v): ?>
			<div class="product-layout col-xs-12">
				<div class="product-thumb transition">
					<div class="image"><a href="<?= base_url('single-product/'.$v['slug'].'/'.e_id($v['id'])) ?>"><img src="<?= $v['image'] ?>" alt="<?= strtoupper($v['eng_name']) ?>" title="<?= strtoupper($v['eng_name']) ?>" class="img-responsive center-block" /></a>
					<a href="<?= base_url('single-product/'.$v['slug'].'/'.e_id($v['id'])) ?>"><img src="<?= $v['image'] ?>" class="img-responsive additional-img" alt="<?= strtoupper($v['eng_name']) ?>"/></a>
				</div>
				<div class="caption text-center">
					<h4><a href="<?= base_url('single-product/'.$v['slug'].'/'.e_id($v['id'])) ?>"><?= strtoupper($v['eng_name']) ?><br><br><?= $v['guj_name'] ?></a></h4>
					<p class="price">
						<?= $v['price'] ?> (<?= $v['min_qty'].' '.strtoupper($v['qty_type']) ?>)
					</p>
				</div>
				<div class="button-group text-center m-button">
					<button type="button" onclick="cart.add(<?= e_id($v['id']) ?>);" class="pcart">
					<span data-loading="Adding..." data-complete="Added to Cart" class="<?= e_id($v['id']) ?>">Add to Cart</span>
					</button>
					<button type="button" onclick="cart.view(<?= e_id($v['id']) ?>);" data-toggle="tooltip" title="Quick View" class="pwish"><i class="fa fa-search"></i><span class="hidden-xs"></span></button>
				</div>
			</div>
		</div>
		<?php endforeach ?>
	</div>
</div>
</div>
<?php endforeach ?>