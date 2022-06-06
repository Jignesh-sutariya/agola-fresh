<!-- CONTENT -->
<div id="page-content">
  <div class="login-form">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <div class="section-title">
            <span class="theme-secondary-color">Check your</span> OTP
          </div>
        </div>
      </div>
      <div class="row">
        <form class="col s12" method="post" id="validateForm">
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4">
              <input id="otp" type="tel" class="validate number" name="otp" maxlength="6" minlength="6">
              <label for="otp">OTP</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4 center">
              <input class="waves-effect waves-light btn" value="Check Otp" type="submit"></div>
          </div>
        </form>
      </div>
      <div class="row">
        <div class="col s12">
          <div class="or-line">
            <div class="ol-or">OR</div>
            <div class="ol-line"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col s12 center">
           Remember your password ? <a href="<?= app('login') ?>">Log In</a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END CONTENT-->