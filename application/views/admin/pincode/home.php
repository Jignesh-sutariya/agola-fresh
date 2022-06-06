<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-lg-12">
  <div class="card card-danger card-outline">
    <div class="card-header">
      <div class="row">
        <div class="col-md-11">
          <h5 class="card-title m-0"><?= ucwords($name) ?> List</h5>
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
            <th>Pincode</th>
            <th class="target">Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>