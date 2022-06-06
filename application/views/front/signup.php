<div class="well">
  <h2>Signup</h2>
  <p><strong>Signup for new account</strong></p>
  <form id="signup">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label" for="input-fullname">Full Name</label>
          <input type="text" name="fullname" value="" placeholder="Full Name" id="input-fullname" class="form-control" />
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label" for="input-mobile">Mobile No.</label>
          <input type="text" name="mobile" value="" placeholder="Mobile No." id="input-mobile" class="form-control" maxlength="10" />
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label" for="input-password">Password</label>
          <input type="password" name="password" value="" placeholder="Password" id="input-password" class="form-control" />
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label" for="input-c_password">Confirm Password</label>
          <input type="password" name="c_password" value="" placeholder="Confirm Password" id="input-c_password" class="form-control" />
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label" for="input-pincode">Pin Code</label>
          <input type="text" name="pincode" value="" placeholder="Pin Code" id="input-pincode" class="form-control" />
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label class="control-label" for="input-address">Address</label>
          <textarea name="address" value="" placeholder="Address" id="input-address" class="form-control"></textarea>
          <br>
        OR Login <a href="<?= base_url('login') ?>"> Here</a>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <input type="button" value="Signup" onclick="shopCart.signup('signup')" class="btn btn-primary" />
        </div>
      </div>
    </div>
  </form>
</div>