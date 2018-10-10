<?php include 'application/views/dasbor/head.php';?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">


<?php $this->load->view('dasbor/header');?> <!-- header.php di includekan-->
<?php include('application/views/dasbor/leftsidebar.php'); ?> 




    <div class="content-wrapper">

    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> #ID: <?php echo $req->reqid ?>
            <p class="hide" id="reqid"><?php echo $req->reqid ?></p>
            <p class="hide" id="reqnik"><?php echo $req->reqnik ?></p>
            <small class="pull-right">Date: <?php echo $req->reqtime ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
       <div class="row">
         <div class="col-xs-6">
          
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th>Requestor </th>
                <td><?php echo $permintaansekarang->reqnik ?></td>
              </tr>
              
                <?php 
                $val = explode(',', trim($permintaansekarang->travelnik, '{}'));
                $a = count($val);                
                for($i=0 ; $i<$a; $i++){  
                ?>
              
              <tr>
                <th>Traveller: </th>
                <td>
                <?php 
                $nama = $this->db->query("SELECT name FROM program.ta_employee WHERE nik='$val[$i]'")->result();
                  foreach ($nama as $row) {
                      echo $row->name.' ('.$val[$i].')';
                  } ?></td>    
              </tr>
                <?php } ?>

              <tr>
                <th>From</th>
                <?php 
                    $loctdept = explode(',', trim($permintaansekarang->loctdept, '{}'));
                    $a = trim($loctdept[0], '""');
                    echo '<td>'.$a.'</td>';
                ?>
              </tr>

              <tr>
                <th>To</th>
                <?php 
                    $loctdept = explode(',', trim($permintaansekarang->loctdept, '{}'));
                    $a = trim($loctdept[1], '""');
                    echo '<td>'.$a.'</td>';
                ?>
              </tr>

              
            </table>
            </div>
            </div>

            <div class="col-xs-6">
          
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th>Dept</th>
                <td><?php echo $permintaansekarang->datedept ?></td>
              </tr>
              <tr>
                <th>Arrive</th>
                <td><?php echo $permintaansekarang->datearrive ?></td>
              </tr>
              <tr>
                <th>Data</th>
                <td>Null</td>
              </tr>
              <tr>
                <th>Data</th>
                <td>Null</td>
              </tr>
              
            </table>
            </div>
            </div>

            </div>

    <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
          <table class="table table-striped">
           <tr height="50">
        <td align="center" width="150" rowspan="2">State of Health</td>
        <td align="center" width="300" colspan="3">Fasting Value</td>
        <td align="center" width="150">After Eating</td>
    </tr>
    <tr height="50">
        <td align="center" width="150">Minimum</td>
        <td align="center" width="150">Maximum</td>
        <td align="center" width="150">2 hours after eating</td>
    </tr>
    <tr height="50">
        <td align="center" width="150">Healthy</td>
        <td align="center" width="150">70</td>
        <td align="center" width="150">100</td>
        <td align="center" width="150">Less than 140</td>
    </tr>
    <tr height="50">
        <td align="center" width="150">Pre-Diabetes</td>
        <td align="center" width="150">101</td>
        <td align="center" width="150">126</td>
        <td align="center" width="150">140 to 200</td>
    </tr>
    <tr height="50">
        <td align="center" width="150">Diabetes</td>
        <td align="center" width="150">More than 126</td>
        <td align="center" width="150">N/A</td>
        <td align="center" width="150">More than 200</td>
    </tr>
</table>
        </div>
        <!-- /.col -->
      </div>
            <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          
          <td class="width30">Jumlah kelebihan biaya yang harus dikembalikan ke perusahaan sebesar</td>
          </div>
        
        <div class="col-xs-3">
          
          <td class="width30">RP</td>
                  
          </div>

         
      



      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <input type="button" class="btn btn-primary" id="approval" value="Approve">
          <input type="button" class="btn btn-primary" id="rejectodgm" value="Reject">
        </div>
      </div>
    </section>
    </div> <!-- /container -->


<?php $this->load->view('dasbor/footer');?> <!-- footer.php di includekan -->
