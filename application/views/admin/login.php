<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h3 class="login-box-msg">Sign In</h3>
<p class="login-box-msg">Sign in to start your session</p>
<form action="<?= admin('login') ?>" method="post" id="loginForm">
  <div class="input-group mb-3">
    <input type="text" class="form-control number" placeholder="Mobile" maxlength="10" id="mobile" name="mobile" value="<?= set_value('mobile') ?>" />
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fa fa-phone"></span>
      </div>
    </div>
    <?= form_error('mobile'); ?>
  </div>
  <div class="input-group mb-3">
    <input type="password" class="form-control" placeholder="Password" name="password" id="password" value="<?= set_value('mobile') ?>" />
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fa fa-lock"></span>
      </div>
    </div>
    <?= form_error('password'); ?>
  </div>
  <div class="row">
    <div class="col-12">
      <button type="submit" class="btn btn-primary btn-block">Sign In</button>
    </div>
  </div>
</form>
<p class="mb-1  mt-4">
  <a href="<?= admin('forgotPassword') ?>">I forgot my password</a>
</p>