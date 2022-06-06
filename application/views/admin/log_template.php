<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Agola Fresh <?= (!empty($name)) ? '| '.ucwords($name) : '' ?></title>
    <link rel="icon" href="<?= images('favicon.png') ?>" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= assets('plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= assets('plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= assets('plugins/toastr/toastr.min.css') ?>">
    <link rel="stylesheet" href="<?= assets('dist/css/adminlte.min.css') ?>">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <img src="<?= images('front-logo.png') ?>" alt="Logo">
      </div>
      <div class="card">
        <div class="card-body login-card-body">
            <?= $contents ?>
        </div>
      </div>
    </div>
    <script src="<?= assets('plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= assets('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= assets('plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
    
    <script src="<?= assets('plugins/toastr/toastr.min.js') ?>"></script>
    <script type="text/javascript">
    $(document).ready(function(){
    $('.number').keypress(function(e){
    let keyCode = e.which;
    /*
    8 - (backspace)
    32 - (space)
    48-57 - (0-9)Numbers
    */
    if ( (keyCode != 8 || keyCode ==32 ) && (keyCode < 48 || keyCode > 57)) {
    return false;
    }
    });
    <?php if (!empty($this->session->userdata('error'))): ?>
        toastr.error("<?= $this->session->userdata('error') ?>");
    <?php endif ?>
    <?php if (!empty($this->session->userdata('success'))): ?>
        toastr.success("<?= $this->session->userdata('success') ?>");
    <?php endif ?>
    });
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#loginForm').validate({
            rules: {
                mobile: {
                    required: true,
                    digits: true,
                },
                password: {
                    required: true,
                    minlength: 6
                },
                confirm_password: {
                    equalTo: "#password"
                }
            },
            messages: {
                mobile: {
                    required: "* Please enter a Mobile Number"
                },
                password: {
                    required: "* Please provide a password",
                    minlength: "* Your password must be at least 6 characters long"
                },
                confirm_password: {
                    equalTo: "* confirm password should be same as password"
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.input-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
    </script>
  </body>
</html>