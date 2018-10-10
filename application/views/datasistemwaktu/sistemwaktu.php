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
      Configuration
      </h1>
  </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="box">
          <div class="box-body">
            <div>
              <table id="myTable" class="table table-bordered table-striped" class="display" width="100%">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Value</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($konfig as $row){ ?>
                <tr>
                  <td><?php echo $row->name; ?></td>
                  <td><?php echo $row->value; ?></td>
                  <td style="text-align: center;">
                    <a href="<?php echo base_url('datasistemwaktu/ubah_konfig?id='.$row->id)?>" class="btn btn-info" role="button" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                </tr>
                <?php } ?>
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
    <section class="content-header">
      <h1>
      Time
      </h1>
  </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="box">
          <div class="box-body">
            <div>
              <table id="myTable1" class="table table-bordered table-striped" class="display" width="100%">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Time</th>
                  <th>Value</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($waktu as $row){ ?>
                <tr>
                  <td><?php echo $row->name; ?></td>
                  <td><?php echo $row->time; ?></td>
                  <td><?php echo $row->value; ?></td>
                  <td style="text-align: center;">
                    <a href="<?php echo base_url('datasistemwaktu/ubah_waktu?id='.$row->id)?>" class="btn btn-info" role="button" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                </tr>
                <?php } ?>
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
<script>
  $(function () {
    $('#myTable').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": false,
      "autoWidth": true
    });
  });
  $(function () {
    $('#myTable1').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": false,
      "autoWidth": true
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