<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- CONTENT -->
<div id="page-content" class="product-page">
  <div id="product-imag" class="pg-product-image">
    <!-- image -->
    <div>
      <div class="pgp-wrap-img">
        <div class="pgp-wrap-img-in">
          <div class="pgp-img" style="background-image: url(<?= $product['image'] ?>);">
          </div>
        </div>
      </div>
    </div>
    <!-- end image -->
  </div>
  <div class="add-wish-lish">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <div class="awl-btn">
            <div class="awl-btn-icon" id="add-to-wish" data-href="<?= app('dashboard/add_wishlist/'.$product['id']) ?>">
              <i class="far fa-heart"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col s12">
        <div class="name-price">
          <div class="pg-product-name"><?= $product['eng_name'] ?> (<?= $product['guj_name'] ?>)</div>
          <div class="pg-product-price">
            <?= $product['price'] ?>
          </div>
          <div style="clear:both;"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="desciption-product">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <?= $product['prod_details'] ?>
        </div>
      </div>
    </div>
  </div>
  <div class="qty-total-price">
    <div class="container">
      <div class="row">
        <div class="col s2">
          <div class="qty-qty">Qty</div>
        </div>
        <form action="<?= app('add_cart') ?>" method="get" accept-charset="utf-8" id="add-to-cart">
          <div class="col <?= (!$qty) ? 's6' : 's10' ?>" id="add-button-page">
            <div class="qty-prc">
              <div class="quantity">
                <input type="number" min="1" max="100" class="number" step="1" value="<?= ($qty) ? $qty : 1 ?>" name="qty"></div>
              </div>
            </div>
            <?php if (!$qty): ?>
            <div class="col s4" id="remove-button-page">
              <div class="qty-buy">
                <button class="btn button-add-cart" id="add-cart">BUY</button>
              </div>
            </div>
            <?php endif ?>
            <input type="hidden" value="<?= $product['id'] ?>" name="prod_id"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- END CONTENT -->