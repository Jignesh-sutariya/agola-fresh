<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- jquery-validation -->
<script src="<?= assets('plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
<script src="<?= assets('plugins/jquery-validation/additional-methods.min.js') ?>"></script>
<script src="<?= assets('plugins/moment/moment.min.js') ?>"></script>
<script src="<?= assets('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#validateForm').validate({