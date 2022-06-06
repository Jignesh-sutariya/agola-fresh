<!-- CONTENT -->
<div id="page-content">
  <div class="contact-wrap theme-form">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <div class="section-title">
            <img src="<?= images('front-logo.png') ?>" alt="LOGO">
            <br>
            <br>
            <br>
             Contact <span class="theme-secondary-color">Us</span>
          </div>
        </div>
        <div class="col s12">
          <p class="center">Agola fresh ,Shop No. 7 & 8,<br> Home Town 3 , Sardar Chowk,<br> Opp. Shiv Ganga Bunglows,<br>  New Ranip, Ahmedabad,<br> Gujarat 382470</p>
        </div>
      </div>
      <div class="section-title">
             Message <span class="theme-secondary-color">Us</span>
          </div>
      <div class="row">
        <form class="col s12" method="POST" id="validateForm">
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4">
              <input id="name" type="text" class="validate" name="name" required="">
              <label for="name">Your Name</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4">
              <input id="email" type="email" class="validate" name="email" required="">
              <label for="email">Your Email</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4">
              <input id="subject" type="text" class="validate" name="subject" required="">
              <label for="subject">Subject</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4">
              <textarea id="message" class="materialize-textarea" name="message" required=""></textarea>
              <label for="message">Message</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4 center">
              <input class="waves-effect waves-light btn" id="subscribe-form" value="Send" type="submit"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- END CONTENT -->