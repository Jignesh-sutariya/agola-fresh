<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if ($orders): ?>
<section class="ftco-section ftco-cart">
	<div class="container">
		<div class="row">
			<div class="col-md-12 ftco-animate">
				<div class="cart-list">
					<table class="table">
						<thead class="thead-primary">
							<tr class="text-center">
								<th>Order ID</th>
								<th>Status</th>
								<th>Date</th>
								<th>View</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($orders as $k => $v): ?>
							<tr class="text-center">
								<td class="product-name">
									<h3>AF-<?= e_id($v['id']) ?></h3>
								</td>
								<td class="product-name">
									<h3><?= ucwords($v['status']) ?></h3>
								</td>
								<td class="product-name">
									<h3><?= date('d-m-Y', strtotime($v['created_at'])) ?></h3>
								</td>
								<td class="product-remove">
									<a href="<?= base_url('view-order/'.e_id($v['id'])) ?>" class="view-order">
										<span class="ion-ios-eye"></span>
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
					<img src="<?= images('emptycart.gif') ?>" alt="">
					<div class="d-flex px-3">
						<div class="m-auto d-flex">
							<a href="<?= base_url('shop') ?>" class="btn btn-primary py-3 px-5">
								<span>Shop Now</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif ?>
<div class="modal fade" id="ordersModal" tabindex="-1" role="dialog" aria-labelledby="ordersModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ordersModalLabel">Order Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="order-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>