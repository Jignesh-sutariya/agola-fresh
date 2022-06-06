<!-- CONTENT -->
<div id="page-content">
  <div class="cart-page">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <div class="section-title">
            <span class="theme-secondary-color">Shopping</span> Cart
          </div>
        </div>
      </div>
      <div class="row" id="show-cart">
        <?php if (!empty($cart)): ?>
        <div class="col s12" id="check-cart">
          <div class="cart-box">
            <?php foreach ($cart as $key => $v): ?>
            <!-- item-->
            <div class="cart-item" id="<?= $v['prod_id'] ?>">
              <div class="ci-img">
                <div class="ci-img-product" style="background-image: url(<?= $v['image'] ?>);">
                </div>
              </div>
              <div class="ci-name">
                <div class="cin-top">
                  <div class="cin-title"><?= ucwords($v['eng_name']) ?> (<?= $v['guj_name'] ?>)</div>
                    <div class="cin-price" id="change-<?= $v['prod_id'] ?>">₹ <?= $v['price'] ?> * <?= $v['qty'] ?> = ₹ <?= $v['price'] * $v['qty'] ?></div>
                  <div class="cin-price"><?= $v['min_qty'].' '.ucfirst($v['qty_type']) ?></div>
                </div>
              </div>
              <div class="ci-price">
                <form action="<?= app('add_cart') ?>" method="get" accept-charset="utf-8" data-id="<?= $v['prod_id'] ?>" data-price="<?= $v['price'] ?>">
                  <input type="hidden" name="prod_id" value="<?= $v['prod_id'] ?>">
                  <div class="qty-total-price">
                    <div class="qty-prc">
                      <div class="quantity">
                        <input type="number" class="number" name="qty" id="qty" min="1" max="100" step="1" value="<?= $v['qty'] ?>"></div>
                      </div>
                    </div>
                  </form>
                  <a href="<?= app('dashboard/delete-product/'.$v['prod_id']) ?>" class="delete-product remove-button" data-id="<?= $v['prod_id'] ?>"><i class="far fa-times-circle fa-2x"></i></a>
                </div>
                <div style="clear: both"></div>
              </div>
              <!-- end item-->
              <?php endforeach ?>
            </div>
            <?php if ($this->session->userdata('cust_type') == 'retailer'): ?>
            <div class="checkout-payable">
              <div class="cart-cp cart-total">
                <div class="cp-left">Total</div>
                <div class="cp-right check-out-total">₹ <?= $total ?></div>
              </div>
              <div class="cart-cp cart-delivery">
                <div class="cp-left">Delivery</div>
                <div class="cp-right">₹ 0.00</div>
              </div>
              <div class="cart-cp cart-total-payable">
                <div class="cp-left">Total payable</div>
                <div class="cp-right check-out-total">₹ <?= $total ?></div>
              </div>
            </div>
            <?php endif ?>
            <button class="btn button-add-cart checkout-button" onclick="location.href = '<?= app() ?>checkout';">Checkout <i class="fas fa-arrow-circle-right"></i></button>
          </div>
          <?php else: ?>
          <div class="error-page" >
            <div class="in-error-page">
              <div class="in-in-error-page">
                <h1>Oops,</h1>
                <p>
                  Your Cart is Empty.
                </p>
                <button class="btn button-add-cart checkout-button" onclick="location.href = '<?= app() ?>shop';" >Shop Now <i class="fas fa-arrow-circle-right"></i></button>
              </div>
            </div>
          </div>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>
  <!-- END CONTENT -->