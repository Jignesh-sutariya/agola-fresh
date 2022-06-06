<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-12 ftco-animate">
				<form action="<?= base_url('login') ?>" class="signup-form" method="POST">
					<h3 class="mb-4 billing-heading">Login</h3>
					<div class="row align-items-end">
						<div class="col-md-5">
							<div class="form-group">
								<label for="mobile">Mobile No.</label>
								<input type="text" class="form-control number" placeholder="Enter Your Mobile No." id="mobile" name="mobile" autocomplete="off" required="" pattern="[0-9]{10}" maxlength="10" />
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control" placeholder="Password" id="password" name="password" autocomplete="off" />
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<input type="submit" class="btn btn-primary py-3 px-4" value="Click To Log In">
							</div>
						</div>
					</div>
				</form>
				OR Sign Up <a href="<?= base_url('signup') ?>" title="Sign Up">Here</a>
			</div>
		</div>
	</div>
</section>