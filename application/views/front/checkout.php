<?php if ($total): ?>
<div class="well">
  <h2>Checkout Details</h2>
  <p><strong>Checkout Details</strong></p>
  <div class="row">
    <div class="col-md-8">
      <form id="checkout">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label" for="input-fullname">Full Name</label>
              <input type="text" name="fullname" value="<?= $this->session->fullname ?>" placeholder="Full Name" id="input-fullname" class="form-control" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label" for="input-mobile">Mobile No.</label>
              <input type="text" name="mobile" value="<?= $this->session->mobile ?>" placeholder="Mobile No." id="input-mobile" class="form-control" />
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="control-label" for="input-address">Address</label>
              <textarea name="address" value="" placeholder="Address" id="input-address" class="form-control"><?= $this->session->address ?></textarea>
            </div>
          </div>
          <div class="col-md-6">
        <div class="form-group">
          <label class="control-label" for="input-pincode">Pin Code</label>
          <input type="text" name="pincode" value="<?= $this->session->pincode ?>" placeholder="Pin Code" id="input-pincode" class="form-control" />
        </div>
        </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label" for="input-payment_type">Payment Type</label>
              <div class="form-group">
                <label><input type="radio" name="payment_type" value="online" checked=""> Online </label>&nbsp;&nbsp;
                <label><input type="radio" name="payment_type" value="cash"> Cash </label>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <label class="control-label">Delivery Date</label>
            <div class="form-group">
              <?php $d = strtotime("+1 day") ?>
              <!-- <?php if (date('H') < '14'): ?>
              <label><input type="radio" id="today" value="today" checked="checked" required="" name="delivery_date"> <?= date('d-m-Y') ?> </label>
              <?php endif ?> -->
              <label><input type="radio" name="delivery_date" type="radio" id="tomorrow" value="tomorrow" checked="checked" /> <?= date("d-m-Y", $d) ?> </label>
            </div>
          </div>
          <div class="col-md-12">
            <label>Delivery Time</label>
            <div class="form-group">
              <div id="time-slots-today">
                <?php if (date('H') < '8'): ?>
                <label>
                  <input name="delivery_time" type="radio" id="08_AM_TO_10_AM" value="08_AM_TO_10_AM" />08 AM TO 10 AM
                </label>
                <?php endif ?>
                <?php if (date('H') < '10'): ?>
                <label>
                  <input name="delivery_time" type="radio" id="10_AM_TO_12_PM" value="10_AM_TO_12_PM" />10 AM TO 12 PM
                </label>
                <?php endif ?>
                <?php if (date('H') < '12'): ?>
                <label>
                  <input name="delivery_time" type="radio" id="12_PM_TO_02_PM" value="12_PM_TO_02_PM" />12 PM TO 02 PM
                </label>
                <?php endif ?>
                <?php if (date('H') < '14'): ?>
                <label>
                  <input name="delivery_time" type="radio" id="02_PM_TO_04_PM" value="02_PM_TO_04_PM" checked="" />02 PM TO 04 PM
                </label>
                <?php endif ?>
                <?php if (date('H') >= '14'): ?>
                <label>
                  <input name="delivery_time" type="radio" id="08_AM_TO_10_AM" value="08_AM_TO_10_AM" />08 AM TO 10 AM
                </label>
                <label>
                  <input name="delivery_time" type="radio" id="10_AM_TO_12_PM" value="10_AM_TO_12_PM" />10 AM TO 12 PM
                </label>
                <label>
                  <input name="delivery_time" type="radio" id="12_PM_TO_02_PM" value="12_PM_TO_02_PM" />12 PM TO 02 PM
                </label>
                <label>
                  <input name="delivery_time" type="radio" id="02_PM_TO_04_PM" value="02_PM_TO_04_PM" checked="" />02 PM TO 04 PM
                </label>
                <?php endif ?>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <input type="button" value="Place an order" onclick="shopCart.checkout('checkout')" class="btn btn-primary" />
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-4">
      <div class="list-group account-column">
        <h4><img src="<?= images('cart.png') ?>">Cart Totals</h4>
        <br>
        <br>
        <table class="table table-responsive">
          <tbody>
            <tr>
              <td>Subtotal</td>
              <td class="total"></td>
            </tr>
            <tr>
              <td>Delivery</td>
              <td>₹ 0</td>
            </tr>
            <tr>
              <td>Total</td>
              <td class="total"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php else: ?>
  <h1>Empty Shopping Cart</h1>
  <p>Your shopping cart is empty!</p>
  <div class="buttons clearfix">
  <div class="pull-left"><a href="<?= base_url('shop') ?>" class="btn btn-default">Continue Shopping</a>
  </div>
</div>
<?php endif ?>