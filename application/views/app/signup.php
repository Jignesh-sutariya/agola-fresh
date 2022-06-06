<!-- CONTENT -->
<div id="page-content">
  <div class="register-form">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <div class="section-title">
            <img src="<?= images('front-logo.png') ?>" alt="LOGO">
            <br>
            <br>
            <br>
            <span class="theme-secondary-color">Sign</span> Up
          </div>
        </div>
      </div>
      <div class="row">
        <form class="col s12" id="validateForm" method="POST">
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4">
              <input id="fullname" type="text" class="validate" name="fullname">
              <label for="fullname">Enter Your Full Name</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4">
              <input id="mobile" type="tel" class="validate number" name="mobile" maxlength="10" minlength="10">
              <label for="mobile">Your Mobile No.</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4">
              <input id="password" type="password" class="validate" name="password">
              <label for="password">Enter a Password</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4">
              <input id="repassword" type="password" class="validate" name="repassword">
              <label for="repassword">Confirm Password</label>
            </div>
          </div>
           <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4">
              <textarea id="address" class="materialize-textarea" name="address"></textarea>
              <label for="address" class="">Address</label>
            </div>
          </div>
          <div class="row row-forgot">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4 center">
              <a class="forgotr" href="<?= app('login') ?>">Already registered? Sign in here</a>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4 center">
              <input class="waves-effect waves-light btn" value="SIGN UP NOW" type="submit">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- END CONTENT-->