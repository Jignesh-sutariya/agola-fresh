<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Post Office | <?= $heading ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= assets('plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= assets('dist/css/adminlte.min.css') ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  </head>
  <body class="hold-transition lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
      <div class="lockscreen-logo">
        <a href="<?= admin() ?>"><b>Post </b>Office</a>
      </div>
      
      <div class="lockscreen-name"><?= $heading ?></div>
      
      <div class="lockscreen-item"> 
      </div>
      <div class="help-block text-center">
        <?= $message ?>
      </div>
      <div class="lockscreen-footer text-center">
        Login Here <b><a href="<?= admin() ?>" class="text-black">Login</a></b><br>
        Copyright &copy; 2020 <b><a href="javascript:void(0)" class="text-black">Post Office</a></b><br>
        All rights reserved
      </div>
    </div>
  </body>
</html>