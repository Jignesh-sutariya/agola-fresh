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
            <label>Title</label>
            <input class="form-control" value="<?= ucwords($data['title']) ?>" disabled />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Sub Title</label>
            <input class="form-control" value="<?= ucwords($data['sub_title']) ?>" disabled />
          </div>
        </div>
        <div class="col-md-6">
          <img src="<?= images('banner/'.$data['banner']) ?>" height="100" width="100">
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