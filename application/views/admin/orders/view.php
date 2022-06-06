<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content col-md-12" id="print-section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="invoice p-3 mb-3">
          <div class="row mb-3">
            <div class="col-12">
              <h4>
              <img src="<?= images('front-logo.png') ?>" alt="logo" width="100">
              <small class="float-right">Date: <?= date('d/m/Y') ?></small>
              </h4>
            </div>
          </div>
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              From
              <address>
                <strong>Agola Fresh,</strong><br>
                Shop No 7-8,<br>Home town 3, <br>Sardar chowk cross road,<br> Nr Union Bank of india ,<br> New ranip, Pin : 382470
              </address>
            </div>
            <div class="col-sm-4 invoice-col">
              To
              <address>
                <strong><?= ucwords($data['fullname']) ?></strong>
                <br>
                <div class="row">
                  <span class="col-sm-2">Phone</span>
                  <span class="col-sm-1">:</span>
                  <span class="col-sm-9"><?= $data['mobile'] ?></span>
                  <span class="col-sm-2">Address</span>
                  <span class="col-sm-1">:</span>
                  <span class="col-sm-9"><?= ucfirst($data['delivery_address']) ?></span>
                </div>
              </address>
            </div>
            <div class="col-sm-4 invoice-col">
              <b>Invoice : # <?php for ($i=0; $i < (6 - strlen($data['id'])) ; $i++) { echo 0; } echo $data['id']; ?></b><br>
              <b>Order ID : AF-<?= e_id($data['id']) ?></b><br>
              
              <b>Payment Status:</b> <?= ucfirst($data['payment_status']) ?><br>
              <b>Payment Type:</b> <?= ($data['payment_id'] == 'cash') ? "Cash" : "Online" ?><br>
              <b>Delivery Status :</b> <?= ucfirst($data['status']) ?><br>
              <b>Delivery Date :</b> <?= date('d-m-Y', strtotime($data['del_date'])) ?><br>
              <b>Delivery Time :</b> <?= str_replace("_", " ", $data['del_time']) ?>
            </div>
          </div>
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Serial #</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Quantity Type</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach (json_decode($data['order_details']) as $k => $v): ?>
                  <tr>
                    <td><?= $k + 1 ?></td>
                    <td><?= ucwords($v->eng_name).' ('.$v->guj_name.')' ?></td>
                    <td>₹ <?= $v->price ?></td>
                    <td><?= $v->qty ?></td>
                    <td><?= $v->min_qty.' ('.ucfirst($v->qty_type).')' ?></td>
                    <td>₹ <?= $v->price * $v->qty ?></td>
                  </tr>
                  <?php endforeach ?>
                  <tr>
                    <td colspan="4"></td>
                    <td><b>Total</b></td>
                    <td>₹ <?= $data['total_amount'] ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <br>
          <div class="col-12">
            Thank You,<br>
            Agola Fresh
          </div>
          <div class="row no-print">
            <div class="col-12">
              <a href="<?= base_url($url) ?>" class="btn btn-outline-danger float-right col-sm-2"> Go Back
              </a>
              <button type="button" onclick="window.print()" class="btn btn-default col-sm-2 float-right" style="margin-right: 5px;">
              <i class="fas fa-print"></i> Print
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>