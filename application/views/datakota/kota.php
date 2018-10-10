<?php
$level = $this->session->userdata('level');
if($level=='admin')
    {
?>
<?php include 'application/views/dasbor/head.php';?>

<?php include 'application/views/dasbor/header.php';?>
  <!-- Left side column. contains the logo and sidebar -->
<?php include('application/views/dasbor/leftsidebar.php'); ?> 

  <div class="content-wrapper">
      <section class="content-header">
      <h1>
        City
      </h1>
  </section>
    <section class="content">
      <div class="row">

      <div class="col-xs-12">
          <div class="box collapsed-box">
            <div class="box-header with-border">
                <h3 class="box-title" >Custom Filter</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <form id="form-filter" class="form-horizontal">
                    <div class="form-group">
                        <label for="country" class="col-sm-2 control-label">ID</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="idkota">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="FirstName" class="col-sm-2 control-label">City</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="namakota">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="FirstName" class="col-sm-2 control-label">Country</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="namanegara">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="FirstName" class="col-sm-2 control-label">Code</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="kode">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="LastName" class="col-sm-2 control-label"></label>
                        <div class="col-sm-4">
                            <button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
                            <button type="button" id="btn-reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>
                </form>
              </div>
            </div>
          </div>

        <div class="col-xs-12">
         <div class="box">
          <div class="box-body">
            <div class="box-header">
              <a href="<?php echo base_url('datakota/tambah')?>" class="btn btn-info" role="button" title="Add"><i class="fa fa-plus" aria-hidden="true">Add</i></a>
            </div>
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>City</th>
                  <th>Country</th>
                  <th>Code</th>
                  <th class="col-xs-2"></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                </table>
               </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
  </div>
  <!-- /.content-wrapper -->
<?php include 'application/views/dasbor/footer.php';?>

<script type="text/javascript">
var table;
$(document).ready(function() {

    //datatables
    table = $('#example1').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('datakota/ajax_list')?>",
            "type": "POST",
            "data": function ( data ) {
                data.idkota = $('#idkota').val();
                data.namakota = $('#namakota').val();
                data.namanegara = $('#namanegara').val();
                data.kode = $('#kode').val();
            }
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],

    });

    $('#btn-filter').click(function(){ //button filter event click
        table.ajax.reload(null,false);  //just reload table
    });
    $('#btn-reset').click(function(){ //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload(null,false);  //just reload table
    });

});
</script>

<?php 
}
else
{
  redirect(base_url());
}
?>