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
              <label for="fullname">Fullname</label>
              <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Enter Fullname" value="<?= (!empty(set_value('fullname'))) ? set_value('fullname') : $data['fullname'] ?>" />
              <?= form_error('fullname') ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="mobile">Mobile No.</label>
              <input type="text" name="mobile" class="form-control number" id="mobile" placeholder="Enter Mobile No." value="<?= (!empty(set_value('mobile'))) ? set_value('mobile') : $data['mobile'] ?>" maxlength="10" />
              <?= form_error('mobile') ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password" />
              <?= form_error('password') ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="c_password">Confirm Password</label>
              <input type="password" name="c_password" class="form-control" id="c_password" placeholder="Enter Confirm Password" />
              <?= form_error('c_password') ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="address">Address</label>
              <textarea name="address" class="form-control" id="address" placeholder="Enter Address"><?= (!empty(set_value('address'))) ? set_value('address') : $data['address'] ?></textarea>
              <?= form_error('address') ?>
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