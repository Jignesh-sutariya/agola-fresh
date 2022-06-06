<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="error-page">
  <div class="col-lg-12">
    <h2 class="headline text-danger"> 401</h2>
    <div class="error-content">
      <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Access denied.</h3>
      <p>
        Access Denied, You don’t have permission to access <a href="javascript:void(0)"><?= current_url() ?></a> return to<a href="<?= admin() ?>"> Dashboard</a>.
      </p>
    </div>
  </div>
</div>