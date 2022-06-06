<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
	errorElement: 'span',
	    errorPlacement: function(error, element) {
	        error.addClass('invalid-feedback');
	        element.closest('.input-group').append(error);
	        element.closest('.form-group').append(error);
	    },
	    highlight: function(element, errorClass, validClass) {
	        $(element).addClass('is-invalid');
	    },
	    unhighlight: function(element, errorClass, validClass) {
	        $(element).removeClass('is-invalid');
	    }
	});
});
</script>
<!-- Select2 -->
<script src="<?= assets('plugins/select2/js/select2.full.min.js') ?>"></script>
<script type="text/javascript">
	$('.select2').select2();
</script>