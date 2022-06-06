<?php defined('BASEPATH') OR exit('No direct script access allowed');
$category = $this->main->getall('category', "id,category,slug", ['is_deleted' => 0], '','category ASC'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Agola Fresh <?= (!empty($name)) ? '| '.ucwords($name) : '' ?></title>
    <link rel="icon" href="<?= images('favicon.png') ?>" type="image/x-icon" />
    <link href="<?= front_assets() ?>javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
    <!-- <link href="<?= front_assets() ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?= $_SERVER['REQUEST_SCHEME'] ?>://fonts.googleapis.com/css?family=Open+Sans:400,400i,300,700" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
    <link href="<?= front_assets() ?>css/stylesheet.css" rel="stylesheet">
    <link href="<?= front_assets() ?>javascript/jquery/swiper/css/owl.carousel.css" type="text/css" rel="stylesheet" media="screen" />
    <link href="<?= front_assets() ?>javascript/jquery/swiper/css/owl.theme.css" type="text/css" rel="stylesheet" media="screen" />
    <link href="<?= front_assets() ?>javascript/jquery/magnific/magnific-popup.css" type="text/css" rel="stylesheet" media="screen" />
    <link href="<?= front_assets() ?>css/inspirenewsletter.css" type="text/css" rel="stylesheet" media="screen" />
    <link href="<?= front_assets() ?>javascript/jquery/swiper/css/swiper.min.css" type="text/css" rel="stylesheet" media="screen" />
    <link href="<?= front_assets() ?>javascript/jquery/swiper/css/opencart.css" type="text/css" rel="stylesheet" media="screen" />
    
    <script src="<?= front_assets() ?>javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src=""></script>
    <script src="<?= front_assets() ?>javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?= front_assets() ?>javascript/inspire/product-slider-zoom/jquery.elevatezoom.js" type="text/javascript"></script>
    <script src="<?= front_assets() ?>javascript/inspire/custom.js" type="text/javascript"></script>
    <script src="<?= front_assets() ?>javascript/jquery/swiper/js/owl.carousel.min.js" type="text/javascript"></script>
    <script src="<?= front_assets() ?>javascript/jquery/magnific/jquery.magnific-popup.min.js" type="text/javascript"></script>
    <script src="<?= front_assets() ?>javascript/jquery/inspirenewsletter.js" type="text/javascript"></script>
    <script src="<?= front_assets() ?>javascript/jquery/swiper/js/swiper.jquery.js" type="text/javascript"></script>
  </head>
  <body>
    <nav id="top">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-4 hidden-xs">
            <ul class="list-inline list-unstyled head-social">
              <li class="hidden-sm"><a><i class="fa fa-envelope"></i> agolafresh@gmail.com</a></li>
              <li class="hidden-sm"><a><i class="fa fa-phone"></i>  +91 6354072536</a></li>
              <li><a> Min Order ₹ 150</a></li>
            </ul>
          </div>
          <div id="top-links" class="nav text-right col-md-6 col-sm-8 col-xs-center">
            <ul class="list-inline">
              <li class="dropdown inspire-account"><a href="indexe223.html?route=account/account" title="My Account" class="dropdown-toggle" data-toggle="dropdown"><span class="hidden-xs">My Account</span><i class="fa fa-user hidden-sm hidden-lg hidden-md"></i> <i class="fa fa-angle-down"></i></a>
              <ul class="dropdown-menu dropdown-menu-right">
                <?php if (!empty($this->session->userdata('user_id'))): ?>
                <li><a href="<?= base_url('my-orders') ?>"><i class="fa fa-address-book-o"></i>My Orders</a></li>
                <li><a href="<?= base_url('logout') ?>"><i class="fa fa-sign-in"></i>LogOut</a></li>
                <?php else: ?>
                <li><a href="<?= base_url('signup') ?>"><i class="fa fa-address-book-o"></i>Signup</a></li>
                <li><a href="<?= base_url('login') ?>"><i class="fa fa-sign-in"></i>Login</a></li>
                <?php endif ?>
              </ul>
            </li>
            <li><a href="<?= base_url('checkout') ?>" title="Checkout"><span class="hidden-xs">Checkout</span><i class="fa fa-share hidden-sm hidden-lg hidden-md"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <header>
    <div class="container">
      <div class="row">
        <div class="col-sm-3 col-xs-6">
          <div id="logo">
            <a href="<?= base_url() ?>"><img src="<?= images('front-logo.png') ?>" title="Agola Fresh" alt="Agola Fresh" class="img-responsive" /></a>
          </div>
        </div>
        <div class="col-md-7 col-sm-6 col-xs-12">
          <div id="search" class="input-group">
            <input type="text" name="search" id="search-prod" value="" placeholder="Search" class="form-control input-lg" />
            <span class="input-group-btn">
              <button type="button" onclick="return false;" class="btn btn-default btn-lg"><i class="fa fa-search"></i></button>
            </span>
          </div>
        <div class="search"></div>
        </div>
        <div class="col-md-2 col-sm-3 text-right mcart"><div id="cart" class="">
          <button type="button" data-toggle="dropdown" data-loading-text="Loading..." class="dropdown-toggle"><i class="fa fa-shopping-cart cart-icon"></i> <div class="ct"><span class="tot">total</span><br><span id="cart-total"> ₹ 0.00</span></div></button>
          <ul class="dropdown-menu pull-right" id="cart-details">
          </ul>
        </div>
      </div>
    </div>
  </div>
</header>
<div class="stmenu">
  <div class="container hidden-xs">
    <div class="row">
      <div class="col-md-3 col-sm-4">
        <h3><i class="fa fa-list"></i>categories</h3>
      </div>
      <div  id="menu1" class="col-md-9 col-sm-8">
        <div class="manun">
          <ul class="list-inline">
            <li><a href="<?= base_url() ?>">Home</a></li>
            <li><a href="<?= base_url('about') ?>">about</a></li>
            <li><a href="<?= base_url('contact') ?>">contact</a></li>
            <li><a href="<?= base_url('shop') ?>">shop</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="hidden-md hidden-lg hidden-sm">
  <div class="container horizontal-menu">
    <nav id="menu" class="navbar">
      <div class="navbar-header">
        <button type="button" class="btn btn-navbar navbar-toggle" onclick="openNav()" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
      </div>
      <div id="mySidenav" class="sidenav">
        <div class="close-nav">
          <span class="categories"><?= ($this->session->fullname) ? $this->session->fullname : 'Agola Fresh' ?></span>
          <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fa fa-close"></i></a>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?= base_url() ?>">Home</a></li>
            <li><a href="<?= base_url('about') ?>">about</a></li>
            <li><a href="<?= base_url('contact') ?>">contact</a></li>
            <li><a href="<?= base_url('shop') ?>">shop</a></li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
</div>
<div id="common-home" class="container">
  <div class="row">
    <aside id="column-left" class="col-md-3 col-sm-4 col-xs-12 hidden-xs">
      <div class="hidden-xs">
        <div class="left-heading"></div>
        <div class="cate-menu ">
          <nav id="menu" class="navbar">
            <div class="navbar-header"><span id="category" class="visible-xs"></span>
            <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
          </div>
          <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav">
              <?php foreach ($category as $k => $v): ?>
              <li><a href="<?= base_url('shop?category='.$v['slug']) ?>">
              <img src="<?= images('favicon.png') ?>" height="30" /> <?= ucwords($v['category']) ?></a></li>
              <?php endforeach ?>
            </ul>
          </div>
        </nav>
      </div>
    </div>
    <div class="sellbanner col-xs-12">
      <div class="row">
        <div class="col-xs-12 b-effect-p">
          <div class="img-effect-p">
            <a href="<?= base_url('shop') ?>">
              <img src="<?= images('left-baner.jpg') ?>" alt="Agola Fresh" class="img-responsive center-block" />
            </a>
          </div>
        </div>
      </div>
    </div>
  </aside>
  <div id="content" class="col-xs-12 col-sm-8 col-lg-9 col-md-9">
    <?php if (isset($title)): ?>
    <ul class="breadcrumb">
      <li><a href="<?= base_url() ?>"><i class="fa fa-home"></i></a></li>
      <li><?= ucwords($title) ?></li>
    </ul>
    <?php endif ?>
    <?= $contents ?>
  </div>
</div>
</div>
<div class="home-foot" style="margin-top: 30px;">
<footer>
  <div>
  </div>
  <div class="container">
    <div class="row">
      <div class="middle-footer">
        <div class="col-sm-3">
          <div class="xs-fab">
            <h5 class="">Agola Fresh<button type="button" class="btn btn-primary toggle collapsed" data-toggle="collapse" data-target="#aboutf"></button></h5>
            <div id="aboutf" class="collapse footer-collapse col-sm-12">
              <div>  <p>BUY VEGETABLES FROM OUR ON-LINE STORE. "AGOLA FRESH” GET THE VEGETABLES DELIVERED TO YOUR DOORSTEP. QUALITY ASSURED, SAME DAY DELIVERY.</p></div>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <h5>Menu
          <button type="button" class="btn btn-primary toggle collapsed" data-toggle="collapse" data-target="#info"></button>
          </h5>
          <div id="info" class="collapse footer-collapse">
            <ul class="list-unstyled">
              <li><a href="<?= base_url('shop') ?>" >Shop</a></li>
              <li><a href="<?= base_url('about') ?>" >About</a></li>
              <li><a href="<?= base_url('contact') ?>" >Contact Us</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-3">
          <h5>Help
          <button type="button" class="btn btn-primary toggle collapsed" data-toggle="collapse" data-target="#account"></button>
          </h5>
          <div id="account" class="collapse footer-collapse">
            <ul class="list-unstyled lastb">
              <li><a href="<?= base_url('terms') ?>">Terms &amp; Conditions</a></li>
              <li><a href="<?= base_url('disclaimer') ?>">Disclaimer</a></li>
              <li><a href="<?= base_url('privacy-policy') ?>">Privacy Policy</a></li>
              <li><a href="<?= base_url('cancellation-return-policy') ?>">Cancellation & Return Policy</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="xs-fab">
            <aside id="column-right">
              <div>  <h5 class=""><span>Have a Questions?</span>
              <button type="button" class="btn btn-primary toggle collapsed" data-toggle="collapse" data-target="#contact"></button>
              </h5>
              <div id="contact" class="collapse footer-collapse footcontact">
                <ul class="list-unstyled f-left">
                  <li><i class="fa fa-map-marker"></i>  Agola Fresh, Nr rachna School, B/h Swapnil Flat, Akhbar Nagar, Nava Vadaj, Ahmedabad - 380013 </li>
                  <li><i class="fa fa-envelope"></i>  agolafresh@gmail.com </li>
                  <li><i class="fa fa-phone"></i> +91 6354072536</li>
                  <li><i class="fa fa-paper-plane"></i>Ahmedabad, Gujarat</li>
                </ul>
              </div></div>
            </aside>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-3 f-social">
        <ul class="list-inline list-unstyled foot-social">
          <li><a href="#"><i class="fa fa-facebook"></i></a></li>
          <li><a href="#"><i class="fa fa-instagram"></i></a></li>
          <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
        </ul>
      </div>
    </div>
    <div class="foot-bottom"><div>  <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 f-social">
        <div class="foot-app">
          <div class="title-footer hidden-md hidden-sm hidden-xs">Download Our App</div>
          <ul class="list-unstyled inline-block">
            <li><a title="PlayStore" href="https://play.google.com/store/apps/details?id=com.densetek.agolafresh" target="_blank"><img class="img-responsive" src="<?= images('play-store.png') ?>" alt="Play Store"></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<div class="foot-power">
<div class="container">
  <div class="copy">Powered By <a href="https://www.densetek.com/">Densetek Infoteck</a> &copy; 2020
</div>
</div>
</div>
</footer>
<a href="#" id="scroll" title="Scroll to Top" style="display: block;">
<i class="fa fa-caret-up"></i>
</a>
<input type="hidden" id="url" value="<?= base_url() ?>">
<div class="modal fade" id="show-prod" role="dialog" style="margin-top: 5%;">
<div class="modal-dialog modal-lg">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h3 class="modal-title">Product Details</h3>
</div>
<div class="modal-body" id="prod-details">
  <div class="row">
    <div class="col-lg-6 col-md-6 col-xs-12 sticky">
      <ul class="thumbnails">
        <li id="prod-img">
        </li>
      </ul>
    </div>
    <div class="col-md-6 col-lg-6 col-xs-12 pro-content">
      <h1 id="prod-name"></h1>
      <hr class="producthr">
      <ul class="list-unstyled" id="prod-detail">
      </ul>
      <ul class="list-unstyled">
        <li class="text-decor-bold">
          <h2 class="pro-price" id="prod-price"></h2>
        </li>
      </ul>
      <div id="product">
        <div class="form-group">
          <div class="row">
            <div class="col-sm-2 col-md-1 col-xs-2 op-box qtlabel"><label class="control-label text-decorop" for="input-quantity1">Qty</label></div>
            <div class="col-md-11 col-sm-10 col-xs-10 op-box qty-plus-minus"><button type="button" class="form-control pull-left btn-number btnminus" disabled="disabled" data-type="minus" data-field="quantity"><span class="glyphicon glyphicon-minus"></span></button><input type="text" name="quantity" value="1" size="2" id="input-quantity1" class="form-control input-number pull-left"><button type="button" class="form-control pull-left btn-number btnplus" data-type="plus" data-field="quantity"><span class="glyphicon glyphicon-plus"></span></button></div>
          </div>
          <hr class="producthr">
          <span id="addtocat-btn">
          </span>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<!-- <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<script src="<?= front_assets() ?>javascript/common.js" type="text/javascript"></script>
<div id="toast-container" class="toast-top-right"></div>
</div>
<?php if (!empty($shop)): ?>
<script>
$(document).ready(function(){
function load_products(page)
{
var show = $("#input-limit option:selected").val();
var category = $("#input-sort option:selected").val();
$.ajax({
url:"<?= base_url('shop/products/') ?>"+page+"/"+show+"/"+category,
method:"GET",
dataType:"json",
success:function(data)
{
var products = '';
$.each(data.products, function (index, prod) {
products += '<div class="product-layout product-grid col-lg-3 col-md-4 col-sm-6 col-xs-6"> <div class="product-thumb transition"> <div class="image"> <a href="<?= base_url() ?>/single-product/'+prod.slug+'/'+prod.id+'"> <img src="'+prod.image+'" alt="'+prod.eng_name+' ('+prod.guj_name+')" title="'+prod.eng_name+'" class="img-responsive center-block"> </a> <a href="<?= base_url() ?>/single-product/'+prod.slug+'/'+prod.id+'"> <img src="'+prod.image+'" class="img-responsive additional-img" alt="'+prod.eng_name+' ('+prod.guj_name+')"> </a> <button type="button" onclick="cart.view('+prod.id+');" data-toggle="tooltip" title="" class="pwish" data-original-title="Quick View"><i class="fa fa-search"></i><span class="hidden-xs"></span></button> </div><div class="caption text-center"> <h4><a href="<?= base_url() ?>/single-product/'+prod.slug+'/'+prod.id+'">'+prod.eng_name+'</a></h4> <h4><a href="<?= base_url() ?>/single-product/'+prod.slug+'/'+prod.id+'">'+prod.guj_name+'</a></h4> <p class="price"> <span class="price-new">'+prod.price+' </span><span>('+prod.min_qty+' '+prod.qty_type.toUpperCase()+')</span> </p></div><div class="button-group text-center"> <button type="button" onclick="cart.add('+prod.id+');" class="pcart"> <span data-loading="Adding..." data-complete="Added to Cart" class="'+prod.id+'">Add to Cart</span> </button> </div></div></div>';
});
$('#products').html(products);
$('#pagination_link').html(data.pagination_link);
$('#showing').html(data.showing);
}
});
}

load_products(1);
$(document).on("click", "#pagination_link li a", function(event){
if ($(this).parents().attr("class") == 'active') return false;
event.preventDefault();
var page = $(this).data("ci-pagination-page");
load_products(page);
});
$('#input-limit, #input-sort').change(function(){
load_products(1);
});
});
</script>
<?php endif ?>
</body>
</html>