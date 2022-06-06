<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-lg-12">
  <div class="card card-danger card-outline">
    <div class="card-header">
      <div class="row">
        <div class="col-md-9">
          <h5 class="card-title m-0"><?= ucwords($name) ?> List</h5>
        </div>
        <div class="col-md-2">
          <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#priceModal" data-backdrop="static" data-keyboard="false" autocomplete="off">Change Price</button>
        </div>
        <div class="col-md-1">
          <a href="<?= base_url($url.'/add') ?>" class="btn btn-block btn-outline-success btn-sm">Add</a>
        </div>
      </div>
    </div>
    <div class="card-body table-responsive">
      <table class="table table-bordered table-hover datatable">
        <thead>
          <tr>
            <th class="target">Sr. No.</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Min Qty</th>
            <th>Category</th>
            <th class="target">Image</th>
            <th class="target">In Stock</th>
            <th class="target">Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="modal fade" id="priceModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Price</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form class="change-price" action="<?= base_url($url.'/change-price') ?>" methd="POST">
          <div class="row">
            <?php foreach ($products as $k => $v): ?>
              <div class="col-md-6">
              <div class="form-group">
                <label for="product_<?= e_id($v['id']) ?>">Product</label>
                <input type="text" class="form-control" id="product_<?= e_id($v['id']) ?>" required="" readonly value="<?= $v['eng_name'].' ('.$v['guj_name'].')'.' ('.ucfirst($v['qty_type']).')' ?>" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="price_<?= e_id($v['id']) ?>">Price</label>
                <input type="text" name="price[<?= e_id($v['id']) ?>]" class="form-control number" id="price_<?= e_id($v['id']) ?>" placeholder="Enter Price" required="" value="<?= $v['price'] ?>" />
              </div>
            </div>
            <?php endforeach ?>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary col-md-3">Save</button>
          <button type="button" class="btn btn-danger col-md-3" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Price</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="validateForm" class="prod-price" action="<?= base_url($url.'/add-price') ?>" methd="POST">
          <input type="hidden" name="id" id="prod-id" />
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="wholesale_id">Select Wholesaler</label>
                <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" name="wholesale_id" id="wholesale_id"  required="">
                  <option selected="selected" disabled="">Select Wholesaler</option>
                  <?php foreach ($cust_type as $k => $v): ?>
                  <option value="<?= e_id($v['id']) ?>"><?= ucwords($v['cust_type']) ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="price">Price</label>
                <input type="text" name="price" class="form-control number" id="price" placeholder="Enter Price" required="" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="qty_type">Select Quantity Type</label>
                <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" name="qty_type" id="qty_type"  required="">
                  <option value="gm">Gm</option>
                  <option value="kg">Kg</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
              <label for="min_qty">Minimum Quantity</label>
              <input type="text" name="min_qty" class="form-control number" id="min_qty" placeholder="Enter Minimum Quantity"  required="" />
            </div>
          </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary col-md-3">Save</button>
          <button type="button" class="btn btn-danger col-md-3" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
function resetForm(id) {
  document.getElementById("validateForm").reset();
  var event = new Event('change');
  var wholesale_id = document.getElementById("wholesale_id");
  wholesale_id.dispatchEvent(event);
  document.getElementById("qty_type").dispatchEvent(event);
  document.getElementById("prod-id").value = id;
}
</script>