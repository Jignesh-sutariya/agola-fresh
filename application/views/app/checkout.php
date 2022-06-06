<!-- CONTENT -->
<div id="page-content" class="shipping-checkout-page">
  <div class="cart-page">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <div class="section-title">
            <span class="theme-secondary-color">Check</span> Out</div>
          </div>
        </div>
        <?php if ($cart): ?>
        <div class="row">
          <div class="col s12">
            <div class="checkout-payable">
              <div class="cart-cp cart-total">
                <div class="cp-left">Total</div>
                <div class="cp-right">₹ <?= $total ?></div>
              </div>
              <div class="cart-cp cart-delivery">
                <div class="cp-left">Delivery</div>
                <div class="cp-right">₹ 0.00</div>
              </div>
              <div class="cart-cp cart-total-payable">
                <div class="cp-left">Total payable</div>
                <div class="cp-right">₹ <?= $total ?></div>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <form class="col s12" method="POST" action="<?= app('checkout') ?>" id="validateForm"  name="checkout">
            <div class="payment-method-wrap ck-box">
              <div class="row">
                <div class="input-field col s12 m12 l12 ">
                  <div class="payment-method-text">
                    <i class="far fa-credit-card"></i> Payment method
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col s12">
                  <div style="margin: 0px 0px 10px">Choose your payment method :</div>
                </div>
              </div>
              <div class="row">
                <div class="col s12 m12 l12 ">
                  <p>
                    <input class="with-gap" name="payment_type" type="radio" id="online" value="online" />
                    <label for="online">Online</label>
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="col s12 m12 l12 ">
                  <p>
                    <input class="with-gap" name="payment_type" type="radio" id="cash" checked="" value="cash" />
                    <label for="cash">Cash</label>
                  </p>
                </div>
              </div>
            </div>
            <br>
            <br>
            <div class="payment-method-wrap ck-box">
              <div class="row">
                <div class="input-field col s12 m12 l12 ">
                  <div class="payment-method-text">
                    <i class="far fa-clock"></i> Delivery Date
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col s12">
                  <div style="margin: 0px 0px 10px">Choose your Delivery Date :</div>
                </div>
                <?php $d = strtotime("+1 day") ?>
                <?php if (date('H') < '14'): ?>
                <div class="col s12 m12 l12 ">
                  <p>
                    <input class="with-gap" name="delivery_date" type="radio" id="today" value="today" checked="checked" required="" />
                    <label for="today"><?= date('d-m-Y') ?></label>
                  </p>
                </div>
                <?php endif ?>
                <div class="col s12 m12 l12 ">
                  <p>
                    <input class="with-gap" name="delivery_date" type="radio" id="tomorrow" value="tomorrow" <?= (date('H') >= '14') ? 'checked="checked"' : '' ?> />
                    <label for="tomorrow"><?= date("d-m-Y", $d) ?></label>
                  </p>
                </div>
              </div>
            </div>
            <br>
            <br>
            <div class="payment-method-wrap ck-box">
              <div class="row">
                <div class="input-field col s12 m12 l12 ">
                  <div class="payment-method-text">
                    <i class="far fa-clock"></i> Delivery Time
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col s12">
                  <div style="margin: 0px 0px 10px">Choose your Delivery Time :</div>
                </div>
                <div id="time-slots-today">
                  <?php if (date('H') < '8'): ?>
                  <div class="col s12 m12 l12 ">
                    <p>
                      <input class="with-gap" name="delivery_time" type="radio" id="08_AM_TO_10_AM" value="08_AM_TO_10_AM" />
                      <label for="08_AM_TO_10_AM">08 AM TO 10 AM</label>
                    </p>
                  </div>
                  <?php endif ?>
                  <?php if (date('H') < '10'): ?>
                  <div class="col s12 m12 l12 ">
                    <p>
                      <input class="with-gap" name="delivery_time" type="radio" id="10_AM_TO_12_PM" value="10_AM_TO_12_PM" />
                      <label for="10_AM_TO_12_PM">10 AM TO 12 PM</label>
                    </p>
                  </div>
                  <?php endif ?>
                  <?php if (date('H') < '12'): ?>
                  <div class="col s12 m12 l12 ">
                    <p>
                      <input class="with-gap" name="delivery_time" type="radio" id="12_PM_TO_02_PM" value="12_PM_TO_02_PM" />
                      <label for="12_PM_TO_02_PM">12 PM TO 02 PM</label>
                    </p>
                  </div>
                  <?php endif ?>
                  <?php if (date('H') < '14'): ?>
                  <div class="col s12 m12 l12 ">
                    <p>
                      <input class="with-gap" name="delivery_time" type="radio" id="02_PM_TO_04_PM" value="02_PM_TO_04_PM" checked="" />
                      <label for="02_PM_TO_04_PM">02 PM TO 04 PM</label>
                    </p>
                  </div>
                  <?php endif ?>
                  <?php if (date('H') >= '14'): ?>
                  <div class="col s12 m12 l12 ">
                    <p>
                      <input class="with-gap" name="delivery_time" type="radio" id="08_AM_TO_10_AM" value="08_AM_TO_10_AM" />
                      <label for="08_AM_TO_10_AM">08 AM TO 10 AM</label>
                    </p>
                  </div>
                  <div class="col s12 m12 l12 ">
                    <p>
                      <input class="with-gap" name="delivery_time" type="radio" id="10_AM_TO_12_PM" value="10_AM_TO_12_PM" />
                      <label for="10_AM_TO_12_PM">10 AM TO 12 PM</label>
                    </p>
                  </div>
                  <div class="col s12 m12 l12 ">
                    <p>
                      <input class="with-gap" name="delivery_time" type="radio" id="12_PM_TO_02_PM" value="12_PM_TO_02_PM" />
                      <label for="12_PM_TO_02_PM">12 PM TO 02 PM</label>
                    </p>
                  </div>
                  <div class="col s12 m12 l12 ">
                    <p>
                      <input class="with-gap" name="delivery_time" type="radio" id="02_PM_TO_04_PM" value="02_PM_TO_04_PM" checked="" />
                      <label for="02_PM_TO_04_PM">02 PM TO 04 PM</label>
                    </p>
                  </div>
                  <?php endif ?>
                </div>
              </div>
            </div>
            <br><br>
            <div class="billing-detail-wrap ck-box">
              <div class="row">
                <div class="input-field col s12 m12 l12 ">
                  <div class="payment-method-text">
                    <i class="far fa-id-card"></i> Shipping & Billing Detail
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col s12">
                  <div style="margin: 0px 0px 10px">Fill in the form your shipping & billing detail :</div>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12 m12 l12 ">
                  <input id="billing-firstname" type="text" class="validate" value="<?= $this->session->userdata('fullname') ?>" name="fullname">
                  <label for="billing-firstname">Full Name</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12 m12 l12 ">
                  <input id="mobile" type="tel" class="validate number" name="mobile" maxlength="10" minlength="10" value="<?= $this->session->userdata('mobile') ?>">
                  <label for="billing-phone">Mobile No.</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12 m12 l12 ">
                  <textarea name="address" id="billing-address" class="materialize-textarea"><?= $this->session->userdata('address') ?></textarea>
                  <label for="billing-address">Address</label>
                </div>
              </div>
            </div>
            <br>
            <br>
            <div class="row">
              <div class="col s12">
                <br>
                <p>
                  <input type="checkbox" class="filled-in" id="filled-in-box" checked="checked" name="terms" />
                  <label class="label-checkbox" for="filled-in-box"> I agree that i have read and accepted the <a href="#">terms & conditions</a></label>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12 center">
                <button class="btn theme-btn-rounded" id="final-checkout">Submit</button>
              </div>
            </div>
          </form>
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
  <!-- END CONTENT -->
  <input type="hidden" id="url" value="<?= base_url() ?>">
  <input type="hidden" id="total" value="<?= $total ?>">
  <input type="hidden" id="name" value="<?= $this->session->userdata('fullname') ?>">
  <input type="hidden" id="contact" value="<?= $this->session->userdata('mobile') ?>">
  <script type="text/javascript">
  var rad = document.checkout.delivery_date; 
  const slot = document.getElementById('time-slots-today').innerHTML;
  
  for (var i = 0; i < rad.length; i++) {
  rad[i].addEventListener('change', function() {
  if (this.value === 'today') {
  document.getElementById('time-slots-today').innerHTML = slot;
  }else{
  document.getElementById('time-slots-today').innerHTML = '<div class="col s12 m12 l12"> <p> <input class="with-gap" name="delivery_time" type="radio" id="08_AM_TO_10_AM" value="08_AM_TO_10_AM"/> <label for="08_AM_TO_10_AM">08 AM TO 10 AM</label> </p></div><div class="col s12 m12 l12"> <p> <input class="with-gap" name="delivery_time" type="radio" id="10_AM_TO_12_PM" value="10_AM_TO_12_PM"/> <label for="10_AM_TO_12_PM">10 AM TO 12 PM</label> </p></div><div class="col s12 m12 l12 "> <p> <input class="with-gap" name="delivery_time" type="radio" id="12_PM_TO_02_PM" value="12_PM_TO_02_PM"/> <label for="12_PM_TO_02_PM">12 PM TO 02 PM</label> </p></div><div class="col s12 m12 l12 "> <p> <input class="with-gap" name="delivery_time" type="radio" id="02_PM_TO_04_PM" value="02_PM_TO_04_PM" checked="" /> <label for="02_PM_TO_04_PM">02 PM TO 04 PM</label> </p></div>';
  }
  });
  }
  </script>