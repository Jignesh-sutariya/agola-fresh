<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-12 ftco-animate">
				<form action="<?= base_url('signup') ?>" class="signup-form" method="POST">
					<h3 class="mb-4 billing-heading">Sign Up</h3>
					<div class="row align-items-end">
						<div class="col-md-6">
							<div class="form-group">
								<label for="fullname">Full Name</label>
								<input type="text" class="form-control" placeholder="Enter Your Full Name" id="fullname" name="fullname" autocomplete="off" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="mobile">Mobile No.</label>
								<input type="text" class="form-control number" placeholder="Enter Your Mobile No." id="mobile" name="mobile" autocomplete="off" required="" pattern="[0-9]{10}" maxlength="10" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control" placeholder="Enter Password" id="password" name="password" autocomplete="off" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="c_password">Confirm Password</label>
								<input type="password" class="form-control" placeholder="Enter Confirm Password" id="c_password" name="c_password" autocomplete="off" />
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="address">Address</label>
								<textarea class="form-control" placeholder="Enter Your Full Address" autocomplete="off" rows="6" id="address" name="address"></textarea>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="submit" class="btn btn-primary py-3 px-4 col-md-3" value="Click To Sign Up">
							</div>
						</div>
					</div>
				</form>
				OR Login <a href="<?= base_url('login') ?>" title="Log In">Here</a>
			</div>
		</div>
	</div>
</section>