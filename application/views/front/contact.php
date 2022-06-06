<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h3>Our Location</h3>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-4"><strong>Agola Fresh</strong><br />
                <address>
                    Nr rachna School, B/h Swapnil Flat, Akhbar Nagar, Nava Vadaj, Ahmedabad - 380013
                </address>
            </div>
            <div class="col-sm-4"><strong>Mobile</strong><br>
                +91 6354072536<br />
                <br />
            </div>
            <div class="col-sm-4"><strong>Email</strong>
                <br>
                agolafresh@gmail.com
            </div>
        </div>
    </div>
</div>
<form action="" method="get" class="form-horizontal">
    <fieldset>
        <legend>SEND US YOUR MESSAGE</legend>
        <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name">Your Name</label>
            <div class="col-sm-10">
                <input type="text" name="name" value="" id="input-name" class="form-control" />
            </div>
        </div>
        <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-email">E-Mail Address</label>
            <div class="col-sm-10">
                <input type="text" name="email" value="" id="input-email" class="form-control" />
            </div>
        </div><div class="form-group required">
        <label class="col-sm-2 control-label" for="input-subject">Subject</label>
        <div class="col-sm-10">
            <input type="text" name="subject" value="" id="input-subject" class="form-control" />
        </div>
    </div>
    <div class="form-group required">
        <label class="col-sm-2 control-label" for="input-message">Message</label>
        <div class="col-sm-10">
            <textarea name="message" rows="10" id="input-message" class="form-control"></textarea>
        </div>
    </div>
    
</fieldset>
<div class="buttons">
    <div class="pull-right">
        <input class="btn btn-primary" type="submit" value="Submit" />
    </div>
</div>
</form>