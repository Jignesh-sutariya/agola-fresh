<!-- CONTENT -->
<div id="page-content">
  <div class="wishlist-page">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <div class="section-title">
            <span class="theme-secondary-color">Wish</span> list
          </div>
        </div>
      </div>
      <?php if ($wishlist): ?>
      <div class="box-wish-list">
        <?php foreach ($wishlist as $k => $v): ?>
        <!-- item -->
        <div class="row wish-item">
          <div class="col s12">
            <div class="wish-box">
              <div class="wi-img">
                <div class="wi-img-product" style="background-image: url(<?= $v['image'] ?>);">
                </div>
              </div>
              <div class="wi-name">
                <div class="win-top">
                  <div class="win-title"><?= ucwords($v['eng_name']) ?> (<?= $v['guj_name'] ?>)</div>
                  <div class="win-price"><?= $v['price'] ?></div>
                </div>
              </div>
              <div class="wi-remove">
                <a href="<?= app('dashboard/remove-wishlist/'.$v['prod_id']) ?>"><i class="far fa-times-circle"></i></a>
              </div>
              <div style="clear: both"></div>
            </div>
          </div>
        </div>
        <!-- end item -->
        <?php endforeach ?>
      </div>
      <?php else: ?>
      <div class="error-page" >
        <div class="in-error-page">
          <div class="in-in-error-page">
            <h1>Oops,</h1>
            <p>
              Your Wish List is Empty.
            </p>
            <button class="btn button-add-cart checkout-button" onclick="location.href = '<?= app() ?>shop';" >Shop Now <i class="fas fa-arrow-circle-right"></i></button>
          </div>
        </div>
      </div>
      <?php endif ?>
    </div>
  </div>
</div>
<!-- END CONTENT -->