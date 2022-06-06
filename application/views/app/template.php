<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Agola Fresh</title>
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="HandheldFriendly" content="True">
    <link rel="icon" href="<?= images('front-logo.png') ?>" type="image/x-icon">
    <!-- CSS  -->
    <link rel="stylesheet" href="<?= assets('app/lib/font-awesome/web-fonts-with-css/css/fontawesome-all.css') ?>">
    <link rel="stylesheet" href="<?= assets('app/css/materialize.min.css') ?>">
    <link rel="stylesheet" href="<?= assets('app/css/normalize.css') ?>">
    <link rel="stylesheet" href="<?= assets('app/css/style.css') ?>">
    <!-- materialize icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Owl carousel -->
    <link rel="stylesheet" href="<?= assets('app/lib/owlcarousel/assets/owl.carousel.min.css') ?>">
    <link rel="stylesheet" href="<?= assets('app/lib/owlcarousel/assets/owl.theme.default.min.css') ?>">
    <!-- Slick CSS -->
    <link rel="stylesheet" type="text/css" href="<?= assets('app/lib/slick/slick/slick.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= assets('app/lib/slick/slick/slick-theme.css') ?>">
    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="<?= assets('app/lib/Magnific-Popup-master/dist/magnific-popup.css') ?>">
    
  </head>
  <body id="homepage">
    <!-- BEGIN PRELOADING -->
    <div class="preloading">
      <div class="wrap-preload">
        <div class="cssload-loader"></div>
      </div>
    </div>
    <!-- END PRELOADING -->
    <!-- HEADER -->
    <header id="header">
      <div class="nav-wrapper container">
        <div class="header-logo">
          <a href="<?= app() ?>" class="nav-logo"> Agola Fresh</a>
        </div>
        <div class="header-menu-button">
          <a href="javascript:void(0)" data-activates="nav-mobile-category" class="button-collapse" id="button-collapse-category">
            <div class="cst-btn-menu">
              <i class="fas fa-align-right"></i>
            </div>
          </a>
        </div>
        <?php if ($this->session->userdata('cust_id')): ?>
        <div class="header-icon-menu cart-item-wrap">
          <a href="<?= app('cart') ?>">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-item cart-item-count"><?= $cart_count ?></span>
          </a>
        </div>
        <?php else: ?>
        <div class="header-icon-menu cart-item-wrap">
          <a href="<?= app('cart') ?>">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-item cart-item-count"><?= count((array) json_decode(get_cookie('cart'))) ?></span>
          </a>
        </div>
        <?php endif ?>
      </div>
    </header>
    <!-- END HEADER -->
    <!-- SIDE NAV-->
    <nav>
      <!-- SIDENAV CATEGORY-->
      <ul id="nav-mobile-category" class="side-nav">
        <li class="sidenav-logo">
          Agola Fresh
        </li>
        <li class="profile">
          <div class="li-profile-info">
            <h2><?= ($this->session->userdata('fullname')) ? ucwords($this->session->userdata('fullname')) : "Agola Fresh" ?></h2>
            <div class="emailprofile">+91 <?= ($this->session->userdata('mobile')) ? $this->session->userdata('mobile') : "6354072536" ?></div>
          </div>
        </li>
        <li>
          <a class="waves-effect waves-blue" href="<?= app() ?>"><i class="fas fa-home"></i>Home</a>
        </li>
        <li>
          <a href="<?= app('wish-list') ?>"><i class="fas fa-heart"></i>Wish list</a>
        </li>
        <li>
          <a href="<?= app('contact') ?>"><i class="fas fa-envelope"></i>Contact Us</a>
        </li>
        <li>
          <a href="<?= app('dashboard') ?>"><i class="fas fa-file"></i>Orders</a>
        </li>
        <li>
          <?php if ($this->session->userdata('cust_id')): ?>
          <a href="<?= app('logout') ?>"><i class="fas fa-sign-in-alt"></i>Sign Out</a>
          <?php else: ?>
          <a href="<?= app('login') ?>"><i class="fas fa-sign-in-alt"></i>Log In</a>
          <?php endif ?>
        </li>
      </ul>
      <!-- END SIDENAV CATEGORY-->
    </nav>
    <!-- END SIDENAV-->
    <!-- CONTENT -->
    <?= $contents ?>
    <!-- Script -->
    <script src="<?= assets('app/js/jquery.min.js') ?>" ></script>
    <script src="<?= assets('app/js/materialize.min.js') ?>" ></script>
    <!-- Owl carousel -->
    <script src="<?= assets('app/lib/owlcarousel/owl.carousel.min.js') ?>" ></script>
    <!-- Magnific Popup core JS file -->
    <script src="<?= assets('app/lib/Magnific-Popup-master/dist/jquery.magnific-popup.js') ?>" ></script>
    <!-- Slick JS -->
    <script src="<?= assets('app/lib/slick/slick/slick.min.js') ?>" ></script>
    <script src="<?= assets('plugins/jquery-validation/jquery.validate.min.js') ?>" ></script>
    <script src="<?= assets('plugins/jquery-validation/additional-methods.min.js') ?>" ></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9" ></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <!-- Custom script -->
    <script src="<?= assets('app/js/custom.js') ?>" ></script>
    <?php $this->load->view('app/alerts') ?>
  </body>
</html>