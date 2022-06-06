<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if ($orders): ?>
<table class="table">
	<thead>
		<tr>
			<th>Order ID</th>
			<th>Status</th>
			<th>Date</th>
			<th>View</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($orders as $k => $v): ?>
		<tr>
			<td>
				<h3>AF-<?= e_id($v['id']) ?></h3>
			</td>
			<td>
				<h3><?= ucwords($v['status']) ?></h3>
			</td>
			<td>
				<h3><?= date('d-m-Y', strtotime($v['created_at'])) ?></h3>
			</td>
			<td>
				<button type="button" class="btn btn-outline-danger" onclick="shopCart.viewOrder(<?= e_id($v['id']) ?>);"><i class="fa fa-eye"></i></button>
				</a>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
<?php else: ?>
<h1>Empty My Orders</h1>
<p>Your orders list is empty!</p>
<div class="buttons clearfix">
	<div class="pull-left"><a href="<?= base_url('shop') ?>" class="btn btn-default">Continue Shopping</a></div>
</div>
<?php endif ?>
<div class="modal fade" id="ordersModal" tabindex="-1" role="dialog" aria-labelledby="ordersModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<h3 class="modal-title" id="ordersModalLabel">Order Details</h3>
			</div>
			<div class="modal-body" id="order-body"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>