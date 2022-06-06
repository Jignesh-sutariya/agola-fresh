<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h3 class="login-box-msg">Reset Password</h3>
<p class="login-box-msg">Reset new password</p>
<form action="<?= admin('forgotPassword/change') ?>" method="post" id="loginForm">
  <div class="input-group mb-3">
    <input type="hidden" name="email" value="<?= $valid['email'] ?>">
    <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fa fa-lock"></span>
      </div>
    </div>
    <?= form_error('password'); ?>
  </div>
  <div class="input-group mb-3">
    <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" id="confirm_password" />
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fa fa-lock"></span>
      </div>
    </div>
    <?= form_error('confirm_password'); ?>
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