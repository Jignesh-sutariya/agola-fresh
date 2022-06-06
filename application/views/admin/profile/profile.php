<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-lg-12">
  <?php $this->load->view('admin/include/alert') ?>
  <div class="card card-danger card-outline">
    <div class="card-header">
      <h5 class="card-title m-0"><?= ucwords($name) ?></h5>
    </div>
    <form role="form" id="validateForm" action="<?= base_url($url."/update") ?>" method="POST" enctype="multipart/form-data">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="fname">First Name</label>
              <input type="text" name="fname" class="form-control" id="fname" placeholder="Enter First Name" value="<?= (!empty(set_value('fname'))) ? set_value('fname') : $data['fname'] ?>" />
              <?= form_error('fname') ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="lname">Last Name</label>
              <input type="text" name="lname" class="form-control" id="lname" placeholder="Enter Last Name" value="<?= (!empty(set_value('lname'))) ? set_value('lname') : $data['lname'] ?>" />
              <?= form_error('lname') ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Mobile No.</label>
              <input class="form-control" value="<?= $data['mobile'] ?>" disabled />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Email Address</label>
              <input class="form-control" value="<?= $data['email'] ?>" disabled />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="image">Recent Image</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input ignore" id="image" name="image" accept="image/jpg,image/jpeg,image/png" />
                  <input type="hidden" name="image" value="<?= $data['image'] ?>" />
                  <label class="custom-file-label" for="image">Choose image (200*200)</label>
                </div>
              </div>
              <?= $this->upload->display_errors('<span class="custom_error">* ', '</span>') ?>
            </div>
          </div>
          <div class="col-md-6">
            <img src="<?= images('users/'.$data['image']) ?>" height="100" width="100">
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control ignore" id="password" placeholder="Enter Password" />
              <?= form_error('password') ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="confirm_password">Confirm Password</label>
              <input type="password" name="confirm_password" class="form-control ignore" id="confirm_password" placeholder="Enter Confirm Password" />
              <?= form_error('confirm_password') ?>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-md-6">
            <button type="submit" class="btn btn-outline-primary">Save</button>
          </div>
          <div class="col-md-6">
            <a href="<?= admin() ?>" class="btn btn-outline-danger">Cancel</a>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>