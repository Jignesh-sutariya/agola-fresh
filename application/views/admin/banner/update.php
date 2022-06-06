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
              <label for="title">Title</label>
              <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title" value="<?= (!empty(set_value('title'))) ? set_value('title') : $data['title'] ?>" />
              <?= form_error('title') ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="sub_title">Sub Title</label>
              <input type="text" name="sub_title" class="form-control" id="sub_title" placeholder="Enter Sub Title" value="<?= (!empty(set_value('sub_title'))) ? set_value('sub_title') : $data['sub_title'] ?>" />
              <?= form_error('sub_title') ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="image">Recent Image</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="image" name="image" accept="image/jpg,image/jpeg,image/png" />
                  <input type="hidden" name="image" value="<?= $data['banner'] ?>" />
                  <label class="custom-file-label" for="image">Choose image (png, jpg or jpeg)</label>
                </div>
              </div>
              <?= $this->upload->display_errors('<span class="custom_error">* ', '</span>') ?>
            </div>
          </div>
          <div class="col-md-2">
            <img src="<?= images('banner/'.$data['banner']) ?>" height="100" width="100">
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