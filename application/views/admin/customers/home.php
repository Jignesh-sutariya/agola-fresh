<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-lg-12">
  <div class="card card-danger card-outline">
    <div class="card-header">
      <div class="row">
        <div class="col-md-9">
          <h5 class="card-title m-0"><?= ucwords($name) ?> List</h5>
        </div>
        <div class="col-md-3">
          <select class="form-control" id="cust_type">
            <option value="0">Select Customer Type</option>
            <option>Retailer</option>
            <?php foreach ($cust_type as $k => $v): ?>
            <option value="<?= $v['id'] ?>"><?= ucwords($v['cust_type']) ?></option>
            <?php endforeach ?>
          </select>
        </div>
      </div>
    </div>
    <div class="card-body table-responsive">
      <table class="table table-bordered table-hover datatable">
        <thead>
          <tr>
            <th class="target">Sr. No.</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Type</th>
            <th class="target">Approval</th>
            <th class="target">Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>