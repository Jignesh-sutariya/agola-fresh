<!-- CONTENT -->
<div id="page-content">
  <div class="cart-page">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <div class="section-title">
            <span class="theme-secondary-color">Orders</span> List
          </div>
        </div>
      </div>
      <div class="row" id="show-cart">
        <?php if (!empty($orders)): ?>
        <div class="col s12" id="check-cart">
          <div class="cart-box">
            <?php foreach ($orders as $key => $v): ?>
            <!-- item-->
            <div class="cart-item">
              <div class="ci-img">
                <div class="ci-img-product" style="background-image: url(<?= images('front-logo.png') ?>);">
                </div>
              </div>
              <div class="ci-name">
                <div class="cin-top">
                  <div class="cin-title">AF-<?= e_id($v['id']) ?></div>
                  <!-- <div class="cin-price"><?= ($v['payment_id'] == 'cash') ? 'Cash' : 'Pay ID - '.$v['payment_id'] ?></div> -->
                  <div class="cin-price"><?= date('d/m/Y', strtotime($v['created_at'])) ?> - <?= ucfirst($v['status']) ?></div>
                </div>
              </div>
              <div class="ci-price">
                <div class="qty-total-price">
                  <div class="qty-prc">
                    <a href="<?= app('dashboard/view/'.$v['id']) ?>" ><i class="far fa-file fa-2x"></i></a>
                  </div></div>
                </div>
                <div style="clear: both"></div>
              </div>
              <!-- end item-->
              <?php endforeach ?>
            </div>
            <button class="btn button-add-cart checkout-button" onclick="location.href = '<?= app() ?>';">Go Back <i class="fas fa-arrow-circle-right"></i></button>
          </div>
          <?php else: ?>
          <div class="error-page" >
            <div class="in-error-page">
              <div class="in-in-error-page">
                <h1>Oops,</h1>
                <p>
                  No Orders Yet.
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