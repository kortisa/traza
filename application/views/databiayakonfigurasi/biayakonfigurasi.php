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
      Basic Rate
      </h1>
  </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="box">
          <div class="box-body">
            <div class="box-header">
              <a href="<?php echo base_url('databiayakonfigurasi/tambah_basic_rate')?>" class="btn btn-info" role="button" title="Add"><i class="fa fa-plus" aria-hidden="true">Add</i></a>
            </div>
            <div class="table-responsive">
              <table id="myTable" class="table table-bordered table-striped" class="display" width="100%">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Frequency</th>
                  <th>Homebase</th>
                  <?php 
                  foreach($areakode as $row)
                  { ?>
                  <th><?php echo $row->name ?></th>
                  <?php
                  }
                  ?>
                  <th>Receipt</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($basicrate as $row){ ?>
                <tr>
                  <td><?php echo $row->base; ?></td>
                  <td><?php echo $row->freq; ?></td>
                  <td><?php if($row->home==1){echo "Yes";}else{echo "No";} ?></td>
                  <?php 
                  $a = count($areakode);
                  for ($i=0; $i < $a; $i++) { 
                    $val = explode(',', trim($row->val, '{}')); echo '<td>'.@$val[$i].'</td>';
                  }?>
                  <td><?php echo ucfirst($row->receipt); ?></td>
                  <td style="text-align: center;">
                    <a href="<?php echo base_url('databiayakonfigurasi/ubah_basic_rate?base='.$row->base)?>" class="btn btn-info" role="button" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
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
  <div class="content-wrapper">
      <section class="content-header">
      <h1>
      Basic Rate Hotel
      </h1>
  </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="box">
          <div class="box-body">
            <div class="box-header">
              <a href="<?php echo base_url('databiayakonfigurasi/tambah_basic_rate_hotel')?>" class="btn btn-info" role="button" title="Add"><i class="fa fa-plus" aria-hidden="true">Add</i></a>
            </div>
            <div class="table-responsive">
              <table id="myTable1" class="table table-bordered table-striped" class="display" width="100%">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Frequency</th>
                  <th>Homebase</th>
                  <?php 
                  foreach($areakode as $row)
                  { ?>
                  <th><?php echo $row->name ?></th>
                  <?php
                  }
                  ?>
                  <th>Min</th>
                  <th>Max</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($basicratehotel as $row){ ?>
                <tr>
                  <td><?php echo $row->base; ?></td>
                  <td><?php echo $row->freq; ?></td>
                  <td><?php if($row->home==1){echo "Yes";}else{echo "No";} ?></td>
                  <?php 
                  $a = count($areakode);
                  for ($i=0; $i < $a; $i++) { 
                    $val = explode(',', trim($row->val, '{}')); echo '<td>'.@$val[$i].'</td>';
                  }?>
                  <td><?php echo $row->min; ?></td>
                  <td><?php echo $row->max; ?></td>
                  <td style="text-align: center;">
                    <a href="<?php echo base_url('databiayakonfigurasi/ubah_basic_rate_hotel?base='.$row->base)?>" class="btn btn-info" role="button" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
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
      Basic Rate Pocket Allowance
      </h1>
  </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="box">
          <div class="box-body">
            <div class="box-header">
              <a href="<?php echo base_url('databiayakonfigurasi/tambah_basic_rate_pocket_allowance')?>" class="btn btn-info" role="button" title="Add"><i class="fa fa-plus" aria-hidden="true">Add</i></a>
            </div>
            <div class="table-responsive">
              <table id="myTable2" class="table table-bordered table-striped" class="display" width="100%">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Frequency</th>
                  <th>Homebase</th>
                  <?php 
                  foreach($areakode as $row)
                  { ?>
                  <th><?php echo $row->name ?></th>
                  <?php
                  }
                  ?>
                  <th>Min</th>
                  <th>Max</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($basicratepocket as $row){ ?>
                <tr>
                  <td><?php echo $row->base; ?></td>
                  <td><?php echo $row->freq; ?></td>
                  <td><?php if($row->home==1){echo "Yes";}else{echo "No";} ?></td>
                  <?php 
                  $a = count($areakode);
                  for ($i=0; $i < $a; $i++) { 
                    $val = explode(',', trim($row->val, '{}')); echo '<td>'.@$val[$i].'</td>';
                  }?>
                  <td><?php echo $row->min; ?></td>
                  <td><?php echo $row->max; ?></td>
                  <td style="text-align: center;">
                    <a href="<?php echo base_url('databiayakonfigurasi/ubah_basic_rate_pocket?base='.$row->base)?>" class="btn btn-info" role="button" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
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
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });
  $(function () {
    $('#myTable1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });
  $(function () {
    $('#myTable2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
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