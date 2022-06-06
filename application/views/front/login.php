<div class="well">
  <h2>Registered Customer</h2>
  <p><strong>I am a registered customer</strong></p>
  <form id="login">
    <div class="form-group">
      <label class="control-label" for="input-mobile">Mobile No.</label>
      <input type="text" name="mobile" value="" placeholder="Mobile No." id="input-mobile" class="form-control" maxlength="10" />
    </div>
    <div class="form-group">
      <label class="control-label" for="input-password">Password</label>
      <input type="password" name="password" value="" placeholder="Password" id="input-password" class="form-control" />
      <br>
      OR SignUp <a href="<?= base_url('signup') ?>"> Here</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <a href="<?= base_url('send-otp') ?>">Forgotten Password</a>
    </div>
    <input type="button" onclick="shopCart.login('login')" value="Login" class="btn btn-primary" />
  </form>
</div>