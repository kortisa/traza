  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1
    </div>
    <strong>Copyright &copy; 2017 CitraTubindo Tbk.</strong> All rights
    reserved.
  </footer>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url() ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>

<script src="<?php echo base_url() ?>assets/dinamis/script.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>assets/validator/dist/js/bootstrapValidator.js"></script>

<script>
setInterval(function(){
$("#load_row").load('<?=base_url()?>notification/load_row')
}, 2000); //menggunakan setinterval jumlah notifikasi akan selalu update setiap 2 detik diambil dari controller notifikasi fungsi load_row
 
setInterval(function(){
$("#load_data").load('<?=base_url()?>notification/load_data_admin')
}, 2000); //yang ini untuk selalu cek isi data notifikasinya sama setiap 2 detik diambil dari controller notifikasi fungsi load_data

$(document).ready(function(){
    $("#approve").click(function(){
        var reqid = $("#reqid").val();
        var reqnik = $("#reqnik").val();
        if(reqid=='' && reqnik==''){
            alert("ID Request dan NIK tidak boleh kosong");
        }else if(reqid=='' && reqid!==''){
            alert("Request ID tidak boleh kosong");
        }else if(reqnik=='' && reqnik!==''){
            alert("NIK requestor tidak boleh kosong");
        }else{
            $.post("<?=base_url()?>notification/postkanedit", //url untuk menangani insert data ke database
            {
                // Data variabel yang dikirim ke server
                reqid:reqid,
                reqnik:reqnik
            },
 
            function(response,status){ // Required Callback Function
                $("#sukses").html('Data disimpan : '+ response +'\n\nStatus : '+ status); //pesan berhasil ketika berhasil disimpan
                $("#form")[0].reset(); //form akan direset ketika telah berhasil di kirim
            });
        }
    });
});

$(document).ready(function(){
    $("#reject").click(function(){
        var reqid = $("#reqid").val();
        var reqnik = $("#reqnik").val();
        
            $.post("<?=base_url()?>notification/reject", //url untuk menangani insert data ke database
            {
                // Data variabel yang dikirim ke server
                reqid:reqid,
                reqnik:reqnik
            },
            function(response,status){ // Required Callback Function
                $("#sukses").html('Data disimpan : '+ response +'\n\nStatus : '+ status); //pesan berhasil ketika berhasil disimpan
                $("#form")[0].reset(); //form akan direset ketika telah berhasil di kirim
            });
        //location.href="http://localhost/traza_app/notifikasi/";
    });
});

$(document).ready(function(){
    $("#rejectodgm").click(function(){
        var reqid = $("#reqid").text();
        var reqnik = $("#reqnik").text();
        
            $.post("<?=base_url()?>notification/reject", //url untuk menangani insert data ke database
            {
                // Data variabel yang dikirim ke server
                reqid:reqid,
                reqnik:reqnik
            },
            function(response,status){ // Required Callback Function
                $("#sukses").html('Data disimpan : '+ response +'\n\nStatus : '+ status); //pesan berhasil ketika berhasil disimpan
                $("#form")[0].reset(); //form akan direset ketika telah berhasil di kirim
            });
        //location.href="http://localhost/traza_app/notifikasi/";
    });
});

$(document).ready(function(){
    $("#approval").click(function(){
        var reqid = $('#reqid').text();
        //alert(reqid);
        var reqnik = $("#reqnik").text();
        
            $.post("<?=base_url()?>notification/approval", //url untuk menangani insert data ke database
            {
                // Data variabel yang dikirim ke server
                reqid:reqid,
                reqnik:reqnik
            },
            function(response,status){ // Required Callback Function
                $("#sukses").html('Data disimpan : '+ response +'\n\nStatus : '+ status); //pesan berhasil ketika berhasil disimpan
                $("#form")[0].reset(); //form akan direset ketika telah berhasil di kirim
            });
        
        //location.href="http://localhost/traza_app/";
    });
});

$(document).ready(function(){
    $("#notcek").click(function(){
        var reqid = $("#reqid").text();
        
            $.post("<?=base_url()?>notification/deletenotcek", //url untuk menangani insert data ke database
            {
                // Data variabel yang dikirim ke server
                reqid:reqid
            },
            function(response,status){ // Required Callback Function
                $("#sukses").html('Data disimpan : '+ response +'\n\nStatus : '+ status); //pesan berhasil ketika berhasil disimpan
                $("#form")[0].reset(); //form akan direset ketika telah berhasil di kirim
            });
        //location.href="http://localhost/traza_app/notifikasi/";
    });
});


</script>

<script type="text/javascript">
  function clickmeh(berat) 
  {
    //alert(0);
    $.post("<?=base_url()?>notification/deletenotif", //url untuk menangani insert data ke database
            {
                // Data variabel yang dikirim ke server
                nama:berat
            });

  }
</script>

<script type="text/javascript">
 function notcek(reqid) 
  {
    //alert(reqid);
    $.post("<?=base_url()?>notification/deletenotcek", //url untuk menangani insert data ke database
            {
                // Data variabel yang dikirim ke server
                nama:reqid
            });
    alert(reqid);
    location.href="http://localhost/traza_app/notification/deletenotcek";
  }
</script>


<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- SlimScroll -->
<script src="<?php echo base_url() ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script>
<!-- page script -->
<script src="<?php echo base_url() ?>assets/wizard/jquery.bootstrap.wizard.js"></script>

<script src="<?php echo base_url() ?>assets/wizard/jquery.bootstrap.wizard.min.js"></script>

<script src="<?php echo base_url() ?>assets/wizard/jquery.validate.min.js"></script>

<script src="<?php echo base_url() ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url() ?>assets/plugins/select2/select2.full.min.js"></script>

<script src="<?php echo base_url() ?>assets/smartwizard/js/jquery.smartWizard.min.js"></script>

<script src="<?php echo base_url() ?>assets/smartwizard/js/validator.min.js"></script>

<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>
 
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2({
        placeholder: 'Select an option'
    });
});

  //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
</script>
</body>
</html>
