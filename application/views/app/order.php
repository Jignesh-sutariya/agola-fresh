<!-- CONTENT -->
<div id="page-content">
  <div class="cart-page">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <div class="section-title">
            <span class="theme-secondary-color">Order</span> Detail
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <div class="cart-box">
            
          <div class="checkout-payable">
            <div class="cart-cp cart-total">
              <div class="cp-left">Order ID</div>
              <div class="cp-right">AF-<?= e_id($order['id']) ?></div>
            </div>
            <div class="cart-cp cart-total">
              <div class="cp-left">Order Status</div>
              <div class="cp-right"><?= ucfirst($order['status']) ?></div>
            </div>
            <div class="cart-cp cart-total">
              <div class="cp-left">Payment Status</div>
              <div class="cp-right"><?= ucfirst($order['payment_status']) ?></div>
            </div>
            <div class="cart-cp cart-delivery">
              <div class="cp-left">Order Date</div>
              <div class="cp-right"><?= date('d-m-Y', strtotime($order['created_at'])) ?></div>
            </div>
            <div class="cart-cp cart-total-payable">
              <div class="cp-left">Total payable</div>
              <div class="cp-right">₹ <?= $order['total_amount'] ?></div>
            </div>
          </div>
          <?php foreach ($order['prods'] as $key => $v): $total_qty = $v->min_qty * $v->qty; ?>
            <!-- item-->
            <div class="cart-item">
              <div class="ci-img">
                <div class="ci-img-product" style="background-image: url(<?= $v->image ?>);">
                </div>
              </div>
              <div class="ci-name">
                <div class="cin-top">
                  <div class="cin-title"><?= $v->eng_name ?> (<?= $v->guj_name ?>)</div>
                    <div class="cin-price">₹ <?= $v->price.' * '.$v->qty.' = ₹ '.($v->price*$v->qty) ?></div>
                    <div class="cin-price">
                      <?= $v->qty.' * '.$v->min_qty.' '.ucwords($v->qty_type) ?> = 
                      <?= ($v->qty_type == 'gm' && strlen($total_qty) > 3) ? ($total_qty / 1000).' Kg' : $total_qty.' '.ucfirst($v->qty_type) ?>
                      </div>
                </div>
              </div>
              <div style="clear: both"></div>
            </div>
            <!-- end item-->
            <?php endforeach ?>
          <button class="btn button-add-cart checkout-button" onclick="location.href = '<?= app() ?>dashboard';">Go Back <i class="fas fa-arrow-circle-left"></i></button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END CONTENT