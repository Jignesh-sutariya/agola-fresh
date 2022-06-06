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
            <span class="theme-secondary-color">Log in</span> Account
          </div>
        </div>
      </div>
      <div class="row">
        <form class="col s12" method="POST" id="validateForm">
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4">
              <input id="mobile" type="tel" class="validate number" name="mobile" maxlength="10" minlength="10">
              <label for="mobile">Mobile No.</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4">
              <input id="password" type="password" class="validate" name="password">
              <label for="password">Password</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4 center">
              <input class="waves-effect waves-light btn" value="LOG IN" type="submit"></div>
          </div>
        </form>
      </div>
      <div class="row fp-text">
        <div class="col s12">
          <div class="forgot-password-link">
            <a href="<?= app('forgot') ?>">Forgot Password</a>
          </div>
        </div>
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
           Don't have an Account ? <a href="<?= app('signup') ?>">Sign Up</a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END CONTENT-->