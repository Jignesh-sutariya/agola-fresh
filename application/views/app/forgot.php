<!-- CONTENT -->
<div id="page-content">
  <div class="login-form">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <div class="section-title">
            <img src="<?= images('front-logo.png') ?>" alt="LOGO">
            <br>
            <br>
            <br>
            <span class="theme-secondary-color">Forgot your</span> Password
          </div>
        </div>
      </div>
      <div class="row">
        <form class="col s12" method="post" id="validateForm">
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4">
              <input id="mobile" type="tel" class="validate number" name="mobile" maxlength="10" minlength="10">
              <label for="mobile">Mobile No.</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4 center">
              <input class="waves-effect waves-light btn" value="Send Otp" type="submit"></div>
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