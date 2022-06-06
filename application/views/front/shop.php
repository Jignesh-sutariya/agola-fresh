<div class="row cate-border">
  <div class="col-lg-4 col-md-5 col-xs-6 col-sm-5 catesort">
    <div class="input-group input-group-sm">
      <label class="input-group-addon" for="input-sort">Category:</label>
      <select id="input-sort" class="form-control">
        <option <?= (!isset($cat)) ? 'selected=""' : '' ?> value="">All Products</option>
        <?php foreach ($categories as $k => $v): ?>
        <option value="<?= e_id($v['id']) ?>" <?= ($v['slug'] == $cat) ? 'selected=""' : '' ?>><?= ucwords($v['category']) ?></option>
        <?php endforeach ?>
      </select>
    </div>
  </div>
  <div class="col-lg-3 col-md-5 col-xs-6 col-sm-4 catesort">
    <div class="input-group input-group-sm">
      <label class="input-group-addon" for="input-limit">Show:</label>
      <select id="input-limit" class="form-control">
        <option value="20" selected="selected">20</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="75">75</option>
        <option value="100">100</option>
      </select>
    </div>
  </div>
</div>
<div class="row" id="products"></div>
<div class="row pagi">
  <div class="col-sm-6 col-xs-12 text-left" id="showing">Showing 1 to 7 of 7 (1 Pages)</div>
  <div class="col-sm-6 col-xs-12 text-right tot" id="pagination_link"></div>
</div>