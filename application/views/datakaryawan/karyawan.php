<?php
$level = $this->session->userdata('level');
if($level=='admin')
    {
?>
<?php include 'application/views/dasbor/head.php';?>
<?php include 'application/views/dasbor/header.php';?>
<?php include('application/views/dasbor/leftsidebar.php'); ?> 

  <div class="content-wrapper">
      <section class="content-header">
      <h1>
        Employee
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
                        <label for="country" class="col-sm-2 control-label">NIK</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="nik" id="nik">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="FirstName" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="namakaryawan" id="namakaryawan">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="LastName" class="col-sm-2 control-label">ID Telegram</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="idtelegram" id="idtelegram">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="LastName" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="email" id="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Departement</label>
                        <div class="col-sm-4">
                            <select class="form-control select2" id="namadepartemen" style="width: 100%;">
                            <option value="">Select Department</option>
                              <?php 
                              foreach($departemen as $row)
                              { 
                                echo '<option value="'.$row->deptname.'">'.$row->deptname.'</option>';
                              }
                              ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="LastName" class="col-sm-2 control-label">Position</label>
                        <div class="col-sm-4">
                            <select class="form-control select2" id="namajabatan" style="width: 100%;">
                            <option value="">Select Department</option>
                              <?php 
                              foreach($jabatan as $row)
                              { 
                                echo '<option value="'.$row->postname.'">'.$row->postname.'</option>';
                              }
                              ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Level</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="level">
                              <option value="">Select Level</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                              </select>
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
              <a href="<?php echo base_url('datakaryawan/tambah')?>" class="btn btn-info" role="button" title="Add"><i class="fa fa-plus" aria-hidden="true">Add</i></a>
            </div>
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>ID Telegram</th>
                  <th>Email</th>
                  <th>Department</th>
                  <th>Position</th>
                  <th>Level</th>
                  <th>Token</th>
                  <th>Join Date</th>
                  <th></th>
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
            "url": "<?php echo site_url('datakaryawan/ajax_list')?>",
            "type": "POST",
            "data": function ( data ) {
                data.nik = $('#nik').val();
                data.name = $('#namakaryawan').val();
                data.telegramid = $('#idtelegram').val();
                data.email = $('#email').val();
                data.deptname = $('#namadepartemen').val();
                data.postname = $('#namajabatan').val();
                data.grade = $('#level').val();
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