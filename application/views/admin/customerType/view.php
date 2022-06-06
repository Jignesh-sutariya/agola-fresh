<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-lg-12">
  <div class="card card-danger card-outline">
    <div class="card-header">
      <h5 class="card-title m-0"><?= ucwords($operation).' '.ucwords($name) ?></h5>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Customer Type</label>
            <input class="form-control" value="<?= ucwords($data['cust_type']) ?>" disabled />
          </div>
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