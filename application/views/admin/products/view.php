<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-lg-12">
  <div class="card card-danger card-outline">
    <div class="card-header">
      <h5 class="card-title m-0"><?= ucwords($operation).' '.ucwords($name) ?></h5>
    </div>
    <div class="card-body">
      <div class="row">
        <?php if ($prices): ?>
        <div class="col-md-12">
          <table class="table table-striped">
            <thead>
              <th>Wholesaler Type</th>
              <th>Min Quantity</th>
              <th>Price</th>
            </thead>
            <tbody>
              <?php foreach ($prices as $k => $v): ?>
              <tr>
                <td><?= ucwords($v->cust_type) ?></td>
                <td><?= $v->min_qty ?> (<?= ucfirst($v->qty_type) ?>)</td>
                <td><?= $v->price ?></td>
              </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
        <?php endif ?>
        <div class="col-md-6">
          <div class="form-group">
            <label>Category</label>
            <input class="form-control" value="<?= ucwords($data['category']) ?>" disabled />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Quantity Type</label>
            <input class="form-control" value="<?= ucwords($data['qty_type']) ?>" disabled />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Product Name (English)</label>
            <input class="form-control" value="<?= ucwords($data['eng_name']) ?>" disabled />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Product Name (Gujarati)</label>
            <input class="form-control" value="<?= $data['guj_name'] ?>" disabled />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Price</label>
            <input class="form-control" value="<?= $data['price'] ?>" disabled />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Minimum Quantity</label>
            <input class="form-control" value="<?= $data['min_qty'] ?>" disabled />
          </div>
        </div>
        <div class="col-md-6">
          <img src="<?= images('products/'.$data['image']) ?>" height="100" width="100">
        </div>
      </div>
    </div>
    <div class="card-footer">
      <div class="row">
        <div class="col-md-6">
          <a href="<?= base_url($url) ?>" class="btn btn-outline-primary col-md-4">Back</a>
        </div>
      </div>
    </div>
  </div>
</div>