  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.11
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
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
$("#load_row").load('<?=base_url()?>notifikasi/load_row')
}, 2000); //menggunakan setinterval jumlah notifikasi akan selalu update setiap 2 detik diambil dari controller notifikasi fungsi load_row
 
setInterval(function(){
$("#load_data").load('<?=base_url()?>notifikasi/load_data_admin')
}, 2000); //yang ini untuk selalu cek isi data notifikasinya sama setiap 2 detik diambil dari controller notifikasi fungsi load_data
 
  $(document).ready(function(){
    $("#approve").click(function(){
        var vname = $("#nama").val();
        var vpesan = $("#pesan").val();
        if(vname=='' && vpesan==''){
            alert("NIK dan Pesan tidak boleh kosong");
        }else if(vname=='' && vpesan!==''){
            alert("NIK tidak boleh kosong");
        }else if(vpesan=='' && vname!==''){
            alert("Pesan tidak boleh kosong");
        }else{
            $.post("<?=base_url()?>notifikasi/postkanedit", //url untuk menangani insert data ke database
            {
                // Data variabel yang dikirim ke server
                nama:vname,
                pesan:vpesan
            },
            function(response,status){ // Required Callback Function
                $("#sukses").html('Data disimpan : '+ response +'\n\nStatus : '+ status); //pesan berhasil ketika berhasil disimpan
                $("#form")[0].reset(); //form akan direset ketika telah berhasil di kirim
            });
        }
        //location.href="http://localhost/traza_app/";
    });
});

$(document).ready(function(){
    $("#reject").click(function(){
        var vname = $("#nama").val();
        var vpesan = $("#pesan").val();
        
            $.post("<?=base_url()?>notifikasi/reject", //url untuk menangani insert data ke database
            {
                // Data variabel yang dikirim ke server
                nama:vname,
                pesan:vpesan
            },
            function(response,status){ // Required Callback Function
                $("#sukses").html('Data disimpan : '+ response +'\n\nStatus : '+ status); //pesan berhasil ketika berhasil disimpan
                $("#form")[0].reset(); //form akan direset ketika telah berhasil di kirim
            });
        

        //location.href="http://localhost/traza_app/notifikasi/";

    });
});

$(function () {
    $("#clickme").click(function () {
        //var str = $(this).text();
        alert(0);
    });
});
</script>

<script type="text/javascript">
  function clickmeh(berat) 
  {
    alert(berat);
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
 
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2({
        placeholder: 'Select an option'
    });
});
</script>
</body>
</html>
