<?php if ($total): ?>
<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-7 ftco-animate">
				<form action="<?= base_url('checkout') ?>" method="post" class="billing-form">
					<h3 class="mb-4 billing-heading">Checkout Details</h3>
					<div class="row align-items-end">
						<div class="col-md-6">
							<div class="form-group">
								<label for="fullname">Full Name</label>
								<input type="text" id="fullname" name="fullname" class="form-control" placeholder="Full Name" value="<?= $this->session->userdata('fullname') ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="mobile">Mobile No.</label>
								<input type="text" id="mobile" name="mobile" class="form-control number" placeholder="Mobile No." maxlength="10" value="<?= $this->session->userdata('mobile') ?>">
							</div>
						</div>
						<div class="w-100"></div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="address">Address</label>
								<textarea name="address" id="address" class="form-control" placeholder="Address"><?= $this->session->userdata('address') ?></textarea>
							</div>
						</div>
						<div class="w-100"></div>
						<div class="col-md-12">
							<h6>Payment Type</h6>
							<div class="form-group mt-4">
								<div class="radio">
									<label class="mr-3"><input type="radio" name="payment_type" value="online" checked=""> Online </label>
									<label><input type="radio" name="payment_type" value="cash"> Cash </label>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<h6>Delivery Date</h6>
							<div class="form-group mt-4">
								<div class="radio">
									<?php $d = strtotime("+1 day") ?>
									<?php if (date('H') < '14'): ?>
									<label class="mr-3"><input type="radio" id="today" value="today" checked="checked" required=""> <?= date('d-m-Y') ?> </label>
									<?php endif ?>
									<label><input type="radio" name="delivery_date" type="radio" id="tomorrow" value="tomorrow" <?= (date('H') >= '14') ? 'checked="checked"' : '' ?> /> <?= date("d-m-Y", $d) ?> </label>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<h6>Delivery Time</h6>
							<div class="form-group mt-4">
								<div class="radio" id="time-slots-today">
									<?php if (date('H') < '8'): ?>
									<label class="mr-3">
										<input name="delivery_time" type="radio" id="08_AM_TO_10_AM" value="08_AM_TO_10_AM" />08 AM TO 10 AM
									</label>
									<?php endif ?>
									<?php if (date('H') < '10'): ?>
									<label class="mr-3">
										<input name="delivery_time" type="radio" id="10_AM_TO_12_PM" value="10_AM_TO_12_PM" />10 AM TO 12 PM
									</label>
									<?php endif ?>
									<?php if (date('H') < '12'): ?>
									<label class="mr-3">
										<input name="delivery_time" type="radio" id="12_PM_TO_02_PM" value="12_PM_TO_02_PM" />12 PM TO 02 PM
									</label>
									<?php endif ?>
									<?php if (date('H') < '14'): ?>
									<label class="mr-3">
										<input name="delivery_time" type="radio" id="02_PM_TO_04_PM" value="02_PM_TO_04_PM" checked="" />02 PM TO 04 PM
									</label>
									<?php endif ?>
									<?php if (date('H') >= '14'): ?>
									<label class="mr-3">
										<input name="delivery_time" type="radio" id="08_AM_TO_10_AM" value="08_AM_TO_10_AM" />08 AM TO 10 AM
									</label>
									<label class="mr-3">
										<input name="delivery_time" type="radio" id="10_AM_TO_12_PM" value="10_AM_TO_12_PM" />10 AM TO 12 PM
									</label>
									<label class="mr-3">
										<input name="delivery_time" type="radio" id="12_PM_TO_02_PM" value="12_PM_TO_02_PM" />12 PM TO 02 PM
									</label>
									<label class="mr-3">
										<input name="delivery_time" type="radio" id="02_PM_TO_04_PM" value="02_PM_TO_04_PM" checked="" />02 PM TO 04 PM
									</label>
									<?php endif ?>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group mt-6">
								<button type="submit" class="btn btn-primary py-3 px-4 col-md-6">
								Place an order
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="col-xl-5">
				<div class="row mt-5 pt-3">
					<div class="col-md-12 d-flex mb-5">
						<div class="cart-detail cart-total p-3 p-md-4">
							<h3 class="billing-heading mb-4">Cart Total</h3>
							<p class="d-flex">
								<span>Subtotal</span>
								<span>₹ <?= $total ?></span>
							</p>
							<p class="d-flex">
								<span>Delivery</span>
								<span>₹ 0</span>
							</p>
							<hr>
							<p class="d-flex total-price">
								<span>Total</span>
								<span>₹ <?= $total ?></span>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<input type="hidden" id="url" value="<?= base_url() ?>">
<?php else: ?>
<section class="ftco-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12 ftco-animate">
				<div class="text py-3 pb-4 px-3 text-center">
					<img src="<?= images('emptycart.gif') ?>" alt="">
					<div class="d-flex px-3">
						<div class="m-auto d-flex">
							<a href="<?= base_url('shop') ?>" class="btn btn-primary py-3 px-5">
								<span>Shop More</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif ?>

<script type="text/javascript">
  var rad = document.checkout.delivery_date; 
  const slot = document.getElementById('time-slots-today').innerHTML;
  
  for (var i = 0; i < rad.length; i++) {
  rad[i].addEventListener('change', function() {
  if (this.value === 'today') {
  document.getElementById('time-slots-today').innerHTML = slot;
  }else{
  document.getElementById('time-slots-today').innerHTML = '<label class="mr-3"><input name="delivery_time" type="radio" id="08_AM_TO_10_AM" value="08_AM_TO_10_AM"/>08 AM TO 10 AM</label><label class="mr-3"><input name="delivery_time" type="radio" id="10_AM_TO_12_PM" value="10_AM_TO_12_PM"/>10 AM TO 12 PM</label><label class="mr-3"><input name="delivery_time" type="radio" id="12_PM_TO_02_PM" value="12_PM_TO_02_PM"/>12 PM TO 02 PM</label><label class="mr-3"><input name="delivery_time" type="radio" id="02_PM_TO_04_PM" value="02_PM_TO_04_PM" checked=""/>02 PM TO 04 PM</label>';
  }
  });
  }
  </script>