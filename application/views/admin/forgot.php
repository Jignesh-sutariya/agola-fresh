<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h3 class="login-box-msg">Forgot Password</h3>
<p class="login-box-msg">Enter you Mobile No. to recover password</p>
<form action="<?= admin('forgotPassword') ?>" method="post" id="loginForm">
  <div class="input-group mb-3">
    <input type="text" class="form-control number" placeholder="Mobile" maxlength="10" id="mobile" name="mobile" value="<?= (!empty($this->session->userdata('mobile'))) ? $this->session->userdata('mobile') : "" ?>" />
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fa fa-phone"></span>
      </div>
    </div>
    <?= form_error('mobile'); ?>
  </div>
  <div class="row">
    <div class="col-12">
      <button type="submit" class="btn btn-primary btn-block">Reset My Password</button>
    </div>
  </div>
</form>
<p class="mb-1 mt-4">
  Back To<a href="<?= admin('login') ?>"> Login</a>
</p>