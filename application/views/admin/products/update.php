<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-lg-12">
  <div class="card card-danger card-outline">
    <div class="card-header">
      <h5 class="card-title m-0"><?= ucwords($operation).' '.ucwords($name) ?></h5>
    </div>
    <form role="form" id="validateForm" action="<?= base_url($url.'/update/'.e_id($data['id'])) ?>" method="POST" enctype="multipart/form-data">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="category_id">Select Category</label>
              <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" name="category_id" id="category_id">
                <option selected="selected" disabled="">Select Category</option>
                <?php foreach ($category as $k => $v): ?>
                <option value="<?= $v['id'] ?>" <?= !empty(set_value('category_id')) ? set_select('category_id', $v['id'], False) : ($data['cat_id'] == $v['id'] ? 'selected' : '') ?>><?= ucwords($v['category']) ?></option>
                <?php endforeach ?>
              </select>
              <?= form_error('category_id') ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="qty_type">Select Quantity Type</label>
              <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" name="qty_type" id="qty_type">
                <option value="gm" <?= !empty(set_value('qty_type')) ? set_select('qty_type', 'gm', False) : ($data['qty_type'] == 'gm' ? 'selected' : '') ?> >Gm</option>
                <option value="kg" <?= !empty(set_value('qty_type')) ? set_select('qty_type', "kg", False) : ($data['qty_type'] == "kg" ? 'selected' : '') ?> >Kg</option>
              </select>
              <?= form_error('qty_type') ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="eng_name">Product Name (English)</label>
              <input type="text" name="eng_name" class="form-control" id="eng_name" placeholder="Enter Product Name (English)" value="<?= (!empty(set_value('eng_name'))) ? set_value('eng_name') : $data['eng_name'] ?>" />
              <?= form_error('eng_name') ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="guj_name">Product Name (Gujarati)</label>
              <input type="text" name="guj_name" class="form-control" id="guj_name" placeholder="Enter Product Name (Gujarati)" value="<?= (!empty(set_value('guj_name'))) ? set_value('guj_name') : $data['guj_name'] ?>" />
              <?= form_error('guj_name') ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="price">Price</label>
              <input type="text" name="price" class="form-control number" id="price" placeholder="Enter Price" value="<?= (!empty(set_value('price'))) ? set_value('price') : $data['price'] ?>" />
              <?= form_error('price') ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="min_qty">Minimum Quantity</label>
              <input type="text" name="min_qty" class="form-control number" id="min_qty" placeholder="Enter Minimum Quantity" value="<?= (!empty(set_value('min_qty'))) ? set_value('min_qty') : $data['min_qty'] ?>" />
              <?= form_error('min_qty') ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="image">Recent Image</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="image" name="image" accept="image/jpg,image/jpeg,image/png" />
                  <input type="hidden" name="image" value="<?= $data['image'] ?>" />
                  <label class="custom-file-label" for="image">Choose image (png, jpg or jpeg)</label>
                </div>
              </div>
              <?= $this->upload->display_errors('<span class="custom_error">* ', '</span>') ?>
            </div>
          </div>
          <div class="col-md-2">
            <img src="<?= images('products/'.$data['image']) ?>" height="100" width="100">
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-md-6">
            <button type="submit" class="btn btn-outline-primary col-md-4">Save</button>
          </div>
          <div class="col-md-6">
            <a href="<?= base_url($url) ?>" class="btn btn-outline-danger col-md-4">Cancel</a>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>