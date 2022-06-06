<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="page-content">
  <div class="section product-item">
    <div class="container">
      <div class="row row-title">
        <div class="col s12">
          <div class="section-title">
            <span class="theme-secondary-color">OUR</span> PRODUCTS
          </div>
        </div>
      </div>
      <div class="row row-no-margin">
        <?php foreach ($products as $k => $v): ?>
        <!-- Product item-->
        <div>
          <div class="col s6 m4 l3 col-produc">
            <div class="box-product">
              <div class="bp-top">
                <div class="product-list-img">
                  <div class="pli-one">
                    <div class="pli-two">
                      <img src="<?= $v->image ?>" alt="img" />
                    </div>
                  </div>
                </div>
                <h5><a href="<?= app('single-product/'.$v->id) ?>"><?= $v->eng_name ?></a></h5>
                <div class="item-info"><?= $v->guj_name ?></div>
                <div class="price">
                  <?= $v->price ?>
                  <span> / <?= $v->min_qty ?> <?= $v->qty_type ?></span>
                </div>
                <div class="stock-item"></div>
              </div>
              <div class="bp-bottom">
                <form action="<?= app('add_cart') ?>" method="get" accept-charset="utf-8" id="add-to-cart">
                  <input type="hidden" name="prod_id" value="<?= $v->id ?>">
                  <button class="btn button-add-cart">BUY</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- End Product item-->
        <?php endforeach ?>
      </div>
    </div>
  </div>
</div>
<!-- PAGINATION -->
<div class="container">
  <div class="row">
    <div class="col s12">
      <?= $pagination_link ?>
    </div>
  </div>
</div>
<!-- END PAGINATION