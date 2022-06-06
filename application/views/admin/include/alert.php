<?php if (!empty($this->session->userdata('success'))): ?>
<div class="alert alert-success" id="error-show">
	<?= $this->session->userdata('success') ?>
</div>
<?php endif ?>
<?php if (!empty($this->session->userdata('error'))): ?>
<div class="alert alert-danger" id="error-show">
	<?= $this->session->userdata('error') ?>
</div>
<?php endif ?>

<?php if (!empty($success)): ?>
<div class="alert alert-success" id="error-show">
	<?= $success ?>
</div>
<?php endif ?>
<?php if (!empty($error)): ?>
<div class="alert alert-danger" id="error-show">
	<?= $error ?>
</div>
<?php endif ?>

<script type="text/javascript">
	let alert = document.getElementById("error-show");
	setTimeout(function(){ if (alert) alert.remove() }, 3000);
</script>