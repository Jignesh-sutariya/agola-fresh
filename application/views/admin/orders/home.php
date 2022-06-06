<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-lg-12">
  <div class="card card-danger card-outline">
    <div class="card-header">
      <div class="row">
        <div class="col-md-12">
          <h5 class="card-title m-0"><?= ucwords($name) ?> List</h5>
        </div>
      </div>
    </div>
    <br>
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item col-md-3">
        <a class="nav-link active change-status text-center btn btn-outline-info" data-toggle="pill" href="" role="tab" data-status="pending">Pending</a>
      </li>
      <li class="nav-item col-md-3">
        <a class="nav-link change-status text-center btn btn-outline-primary" data-toggle="pill" href="" role="tab" data-status="in delivery">In Delivery</a>
      </li>
      <li class="nav-item col-md-3">
        <a class="nav-link change-status text-center btn btn-outline-success" data-toggle="pill" href="" role="tab" data-status="completed">Completed</a>
      </li>
      <li class="nav-item col-md-3">
        <a class="nav-link change-status text-center btn btn-outline-danger" data-toggle="pill" href="" role="tab" data-status="canceled">Canceled</a>
      </li>
    </ul>
    <div class="card-body table-responsive">
      <table class="table table-bordered table-hover datatable">
        <thead>
          <tr>
            <th class="target">Sr. No.</th>
            <th>Order ID</th>
            <th>Date</th>
            <th>Delivery</th>
            <th>Time</th>
            <th>Cust Name</th>
            <th>Cust Mob.</th>
            <th>Delivery Address</th>
            <th class="target">Delivery Boy</th>
            <th class="target">Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>
<input type="hidden" id="status" value="pending">
<!-- Modal -->
<div class="modal fade" id="assignDeliveryBoy" tabindex="-1" role="dialog" aria-labelledby="assignDeliveryBoyLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="assignDeliveryBoyLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url($url.'/assign') ?>" method="post" accept-charset="utf-8" id="validateForm" class="assign-del-boy">
          <div class="col-md-12">
            <div class="form-group">
              <input type="hidden" name="order_id" id="order_id" />
              <label for="del_boy">Select Delivery Boy</label>
              <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" name="del_boy" id="del_boy">
                <option selected="selected" disabled="">Select Delivery Boy</option>
                <?php foreach ($del_boy as $k => $v): ?>
                <option value="<?= e_id($v['id']) ?>"><?= ucwords($v['fullname']) ?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-primary">Assign</button>
          <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>