<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3 col-sm-6 col-12">
			<div class="info-box">
				<span class="info-box-icon bg-info"><i class="far fa-copy"></i></span>
				<div class="info-box-content">
					<a href="<?= admin('orders') ?>" title="Orders">
						<span class="info-box-text">Orders</span>
						<span class="info-box-number"><?= $this->main->count('orders', ['status' => "pending"]) ?></span>
					</a>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 col-12">
			<div class="info-box">
				<span class="info-box-icon bg-success"><i class="far fa-user"></i></span>
				<div class="info-box-content">
					<a href="<?= admin('customers') ?>" title="Customers">
					<span class="info-box-text">Customers</span>
					<span class="info-box-number"><?= $this->main->count('customers', ['is_deleted' => 0]) ?></span>
				</a>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 col-12">
			<div class="info-box">
				<span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
				<div class="info-box-content">
					<a href="<?= admin('products') ?>" title="Products">
					<span class="info-box-text">Products</span>
					<span class="info-box-number"><?= $this->main->count('products', ['is_deleted' => 0]) ?></span>
				</a>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 col-12">
			<div class="info-box">
				<span class="info-box-icon bg-danger"><i class="far fa-user"></i></span>
				<div class="info-box-content">
					<a href="<?= admin('deliveryBoy') ?>" title="Wholesalers">
					<span class="info-box-text">Delivery Boy</span>
					<span class="info-box-number"><?= $this->main->count('delivery_boy', ['is_deleted' => 0]) ?></span>
				</a>
				</div>
			</div>
		</div>
	</div>
	<div class="card-body table-responsive">
      <table class="table table-bordered table-hover" id="sample_data">
        <thead>
          <tr>
            <th class="target">Product Name</th>
            <th class="target">Resaller</th>
            <?php foreach ($cust_type as $k => $v): ?>
            <th class="target"><?= ucfirst($v['cust_type']) ?></th>
            <?php endforeach ?>
          </tr>
        </thead>
        <tbody>
        	<?php foreach ($products as $k => $v): ?>
        	<tr>
            	<td><?= strtoupper($v['eng_name']).' ('.$v['min_qty'].' '.ucfirst($v['qty_type']).')' ?></td>
            	<td data-name="price" class="price" data-type="number" data-pk="<?= e_id($v['id']) ?>"><?= $v['price'] ?></td>
            	<?php foreach ($cust_type as $k => $va): ?>
            		<td data-name="price_<?= e_id($va['id']) ?>" class="price_<?= e_id($va['id']) ?>" data-type="number" data-pk="<?= e_id($v['id']) ?>">
            			<?= ($p = $this->main->check('product_price', ['prod_id' => $v['id'],'wholesale_id' => $va['id']], 'price')) ? $p : 0 ?>
            		</td>
            	<?php endforeach ?>
            </tr>
            <?php endforeach ?>
        </tbody>
      </table>
    </div>
</div>