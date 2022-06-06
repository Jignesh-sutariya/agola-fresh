<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-lg-12">
  <div class="card card-danger card-outline">
    <div class="card-header">
      <h5 class="card-title m-0"><?= ucwords($operation).' '.ucwords($name) ?></h5>
    </div>
    <form role="form" id="validateForm" action="<?= base_url($url.'/add') ?>" method="POST" enctype="multipart/form-data">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="category">Category</label>
              <input type="text" name="category" class="form-control" id="category" placeholder="Enter Category" value="<?= set_value('category') ?>" />
              <?= form_error('category') ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="image">Image</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input ignore" id="image" name="image" accept="image/jpg,image/jpeg,image/png" />
                  <label class="custom-file-label" for="image">Choose image (png, jpg or jpeg)</label>
                </div>
              </div>
              <?= $this->upload->display_errors('<span class="custom_error">* ', '</span>') ?>
            </div>
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