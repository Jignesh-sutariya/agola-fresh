<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- SweetAlert2 -->
<script src="<?= assets('plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
<!-- Toastr -->
<script src="<?= assets('plugins/toastr/toastr.min.js') ?>"></script>

<script type="text/javascript">
$(document).ready(function(){
    <?php if (!empty($this->session->userdata('error'))): ?>
		toastr.error("<?= $this->session->userdata('error') ?>");
	<?php endif ?>

	<?php if (!empty($this->session->userdata('success'))): ?>
		toastr.success("<?= $this->session->userdata('success') ?>");
	<?php endif ?>
})
</script>

<!-- DataTables -->
<script src="<?= assets('plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= assets('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= assets('plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= assets('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?= assets('plugins/datatables/dataTables.buttons.min.js') ?>"></script>

<script type="text/javascript" src="<?= assets('plugins/datatables/pdfmake.min.js') ?>"></script>
<script type="text/javascript" src="<?= assets('plugins/datatables/vfs_fonts.js') ?>"></script>
<script type="text/javascript" src="<?= assets('plugins/datatables/buttons.html5.min.js') ?>"></script>
<script type="text/javascript" src="<?= assets('plugins/datatables/buttons.print.min.js') ?>"></script>
<script type="text/javascript" src="<?= assets('plugins/datatables/buttons.colVis.min.js') ?>"></script>
<script type="text/javascript">
$(document).ready(function() {
    var table = $('.datatable').DataTable({
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, 100, -1 ],
            [ '10', '25', '50', '100', 'All' ]
        ],
        buttons: [
            'pageLength',
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ],
        /*columnDefs: [ {
            targets: -1,
            visible: false
        } ],*/
        "processing": true,
        "serverSide": true,
        'language': {
            'loadingRecords': '&nbsp;',
            'processing': 'Processing',
            'paginate': {
                'first': '|',
                'next': '<i class="fa fa-arrow-circle-right"></i>',
                'previous': '<i class="fa fa-arrow-circle-left"></i>',
                'last': '|'
            }
        },
        "order": [],
        "ajax": {
            url: "<?= base_url($url) ?>",
            type: "POST",
            data: function(data) {
                data.cust_type = $('#cust_type').val();
                data.status = $('#status').val();
            },
            complete: function(response) {
                /*var data = JSON.parse(response.responseText).token;
                $('#csrf_token_hash').val(data);*/
            },
        },
        "columnDefs": [{
            "targets": 'target',
            "orderable": false,
        }, ],
    });

    $(document).on('change', '.prod-status', function() {
        var state = $(this);
        var val = this.value;
        var id = state.attr('id');
        
        $.ajax({
             type:"POST",
             url: "<?= admin('products/change-status') ?>",
             dataType: "json",
             data: {id: id, status: val},
             beforeSend: function(){
                $(".loading").show();
             },
             success: function (result) {
                $(".loading").hide();
                if (result.error == true) {
                  toastr.error(result.message);
                }else{
                  toastr.success(result.message);
                  if (val == 0) {
                      state.val(1);
                  }
                  else if (val == 1) {
                       state.val(0);
                  }
                }
            }
        });
    });
    /*function startTime() {
      var today = new Date();
      var s = today.getSeconds();
      s = checkTime(s);
      table.ajax.reload();
      var t = setTimeout(function(){ startTime() }, 1 * 60 * 1000);
    }

    function checkTime(i) {
      return i;
    }
    
    startTime()*/

    $('#cust_type').change(() => {
        table.ajax.reload();
    });

    $('.change-status').click(function(){
        $("#status").val($(this).data('status'));
        table.ajax.reload();
    });

    $(document).on('click', '.assignDeliveryBoy', function() {
        $("#order_id").val($(this).data('id'));
        $("#del_boy").val($("#del_boy option:first").val()).trigger('change');
        var validator = $( "#validateForm" ).validate();
        validator.resetForm();
        $("#assignDeliveryBoy").modal('show');
    });

    $('.assign-del-boy').submit(function(e){
        if ($('.assign-del-boy').valid()) {
            e.preventDefault();
              $.ajax({
                 type:"POST",  
                 url: $(this).attr('action'),
                 dataType: "json",
                 data: $(this).serialize(),
                 beforeSend: function(){
                    $("#assignDeliveryBoy").modal('hide');
                    $(".loading").show();
                 },
                 success: function (result) {
                    $(".loading").hide();
                    if (result.error == true) {
                      toastr.error(result.message);
                    }else{
                      toastr.success(result.message);
                      table.ajax.reload();
                    }
                }
              });
        }
    })

    $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this!",
                icon: "error",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $(this).parents().submit();
                } else {
                    return false;
                }
            });
    });

    $(".prod-price").submit((e) => {
        e.preventDefault();
        form = $(".prod-price");
        if (form.valid()) {
            $.ajax({
                url: form.attr('action'),
                type: 'post',
                dataType: 'json',
                async:false,
                data:form.serialize(),
                success: function (response) {
                  if (response.error == false) toastr.success(response.message);
                  else toastr.error(response.message);
                  $("#myModal").modal('toggle');
                }
            });
        }else{
            return false;
        }
    });

    $(".change-price").submit((e) => {
        e.preventDefault();
        form = $(".change-price");
        if (form.valid()) {
            $.ajax({
                url: form.attr('action'),
                type: 'post',
                dataType: 'json',
                async:false,
                data:form.serialize(),
                success: function (response) {
                  if (response.error == false) toastr.success(response.message);
                  else toastr.error(response.message);
                  $("#priceModal").modal('toggle');
                  table.ajax.reload();
                }
            });
        }else{
            return false;
        }
    });
});
</script>