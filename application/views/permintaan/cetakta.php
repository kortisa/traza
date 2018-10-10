<?php
$level = $this->session->userdata('level');
$nik = $this->session->userdata('nik');
if($level=='operator' or $level=='manajer' or $level=='odgm')
    {
?>
<?php include 'application/views/dasbor/head.php';?>

<?php include 'application/views/dasbor/header.php';?>
  <!-- Left side column. contains the logo and sidebar -->
<?php include('application/views/dasbor/leftsidebar.php'); ?> 
  <!-- Content Wrapper. Contains page content -->
  
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content">
      <?php //for($x=0 ; $x<$total; $x++) {?>
        <div class="row">
        <div class="col-md-6">
          
            <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title" >Identity</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                </div>
            </div>
              <div class="box-body ">
              <div class="table-responsive">
              <table id="myTable" class="table table-bordered table-striped " class="display" width="100%">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Nik</th>
                  <th>Home</th>
                  <th>Day</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                $nikpejalan = explode(',', trim($nikpejalan, '{}'));
                $a = count($nikpejalan);                
                for($i=0 ; $i<$a; $i++){
                 
                ?>
                
                <tr>
                <td><?php 
                $nama = $this->db->query("SELECT name FROM program.ta_employee WHERE nik='$nikpejalan[$i]'")->result();
                  foreach ($nama as $row) {
                      echo $row->name;
                  } ?></td>    
                <td><?php echo $nikpejalan[$i] ?></td> 
                <td><?php if($homebase==0){echo'No';}else{echo'Yes';} ?></td>
                <td><?php echo $jmlharitotal ?></td>       
                </tr>
                
                 
                <?php } ?>

                </tbody>
               </table>
               
            </div>
            </div>    
            </div>         
            
          </div>
          
      
        
        <div class="col-md-6">
          
            <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title" >Pocket Allowance</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                </div>
            </div>
              <div class="box-body ">
              <div class="table-responsive">
              <table id="myTable" class="table table-bordered table-striped " class="display" width="100%">
                <thead>
                <tr>
                  <th>Pocket Allowance</th>
                  <th>Days</th>
                  <th>Frequency</th>
                  <th>Homebase</th>
                  <th>Cost</th>
                  <th>Value</th>
                  <th>Advance</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                $a = count($basic_rate_bs_pa[0]);
                                
                for($i=0 ; $i<$a; $i++){ ?>
                
                <tr>
                <td><?php echo $basic_rate_bs_pa[0][$i] ?></td>    
                <td><?php echo $pocket_allowance[0][$i] ?></td> 
                <td><?php echo $pocket_allowance[1][$i] ?></td>
                <td><?php echo $pocket_allowance[2][$i] ?></td>
                <td><?php echo $pocket_allowance[3][$i] ?></td>
                <td><?php echo $pocket_allowance[4][$i] ?></td> 
                <td><?php echo $pocket_allowance[5][$i] ?></td>            
                </tr>
                
                 
                <?php } ?>

                </tbody>
               </table>
               
            </div>
            </div>    
            </div>         
            
          </div>
          </div>
          <div class="row">
          <div class="col-md-6">
            <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title" >Allowance System</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                </div>
            </div>
              <div class="box-body">
              <div class="table-responsive">
              <table id="myTable" class="table table-bordered table-striped" class="display" width="100%">
                <thead>
                <tr>
                  <th>Allowance System</th>
                  <th>Days</th>
                  <th>Frequency</th>
                  <th>Homebase</th>
                  <th>Cost</th>
                  <th>Value</th>
                  <th>Advance</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                $a = count($basic_rate_bs_as[0]);
                                
                for($i=0 ; $i<$a; $i++){ ?>
                
                <tr>
                <td><?php echo $basic_rate_bs_as[0][$i] ?></td>    
                <td><?php echo $basic_rate_as[0][$i] ?></td> 
                <td><?php echo $basic_rate_as[1][$i] ?></td>
                <td><?php echo $basic_rate_as[2][$i] ?></td>
                <td><?php echo $basic_rate_as[3][$i] ?></td>
                <td><?php echo $basic_rate_as[4][$i] ?></td> 
                <td><?php echo $basic_rate_as[5][$i] ?></td>            
                </tr>
                
                 
                <?php } ?>
                <?php 
                $a = count($basic_rate_bs_ha_as[0]);
                                
                for($i=0 ; $i<$a; $i++){ ?>
                
                <tr>
                <td><?php echo $basic_rate_bs_ha_as[0][$i] ?></td>    
                <td><?php echo $hotel_allowance_as[0][$i] ?></td> 
                <td><?php echo $hotel_allowance_as[1][$i] ?></td>
                <td><?php echo $hotel_allowance_as[2][$i] ?></td>
                <td><?php echo $hotel_allowance_as[3][$i] ?></td>
                <td><?php echo $hotel_allowance_as[4][$i] ?></td> 
                <td><?php echo $hotel_allowance_as[5][$i] ?></td>            
                </tr>
                
                 
                <?php } ?>

                </tbody>
               </table>
               </div>
            </div>
                      
            </div>         
            </div>
          
          <div class="col-md-6">
            <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title" >At Cost System</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                </div>
            </div>
              <div class="box-body">
              <div class="table-responsive">
              <table id="myTable" class="table table-bordered table-striped" class="display" width="100%">
                <thead>
                <tr>
                  <th>At Cost System</th>
                  <th>Days</th>
                  <th>Frequency</th>
                  <th>Homebase</th>
                  <th>Cost</th>
                  <th>Value</th>
                  <th>Advance</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                $a = count($basic_rate_bs[0]);
                                
                for($i=0 ; $i<$a; $i++){ ?>
                
                <tr>
                <td><?php echo $basic_rate_bs[0][$i] ?></td>    
                <td><?php echo $basic_rate[0][$i] ?></td> 
                <td><?php echo $basic_rate[1][$i] ?></td>
                <td><?php echo $basic_rate[2][$i] ?></td>
                <td><?php echo $basic_rate[3][$i] ?></td>
                <td><?php echo $basic_rate[4][$i] ?></td> 
                <td><?php echo $basic_rate[5][$i] ?></td>            
                </tr>
                
                 
                <?php } ?>
                <?php 
                $a = count($basic_rate_bs_ha[0]);
                                
                for($i=0 ; $i<$a; $i++){ ?>
                
                <tr>
                <td><?php echo $basic_rate_bs_ha[0][$i] ?></td>    
                <td><?php echo $hotel_allowance[0][$i] ?></td> 
                <td><?php echo $hotel_allowance[1][$i] ?></td>
                <td><?php echo $hotel_allowance[2][$i] ?></td>
                <td><?php echo $hotel_allowance[3][$i] ?></td>
                <td><?php echo $hotel_allowance[4][$i] ?></td> 
                <td><?php echo $hotel_allowance[5][$i] ?></td>            
                </tr>
                
                 
                <?php } ?>

                </tbody>
               </table>
               </div>
            </div>
                      
            </div>         
            </div>
          </div>

          <div class="row">
          <div class="col-md-6">
            <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title" >Total Allowance</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                </div>
            </div>
              <div class="box-body">
              <div class="table-responsive">
              <table id="myTable" class="table table-bordered table-striped" class="display" width="100%">
                <thead>
                <tr>
                  <th>Advance</th>
                  <th>Curency</th>
                  <th>Cost</th> 
                </tr>
                </thead>
                <tbody>
                <?php 

                $a = count($basic_rate_bs_pa[0]);
                $data = array("Pocket Allowance","Allowance System","Hotel Allowance");
                $currency = $this->db->query("SELECT currency FROM program.ta_destination WHERE name_destination='Batam'")->result();
                foreach ($currency as $row) {
                    $matauang = $row->currency;
                }

                for($i=0 ; $i<$a; $i++){ ?>
                
                <tr>
                <td><?php echo $data[$i] ?></td>    
                <td><?php echo $matauang ?></td> 
                <td><?php echo $total_allowance_system[$i] ?></td>            
                </tr>
                
                 
                <?php } ?>
                <td></td>
                <td>Total</td>
                <td><?php echo $total_total_allowance_system ?></td>
                </tbody>
               </table>
               
            </div>
            </div>
            </div>         
            </div>
          
          <div class="col-md-6">
            <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title" >Total At Cost</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                </div>
            </div>
              <div class="box-body">
              <div class="table-responsive">
              <table id="myTable" class="table table-bordered table-striped" class="display" width="100%">
                <thead>
                <tr>
                  <th>Advance</th>
                  <th>Curency</th>
                  <th>Cost</th> 
                </tr>
                </thead>
                <tbody>
                <?php 

                $a = count($basic_rate_bs_pa[0]);
                $data = array("Pocket Allowance","At Cost System","Hotel Allowance");
                $currency = $this->db->query("SELECT currency FROM program.ta_destination WHERE name_destination='Batam'")->result();
                foreach ($currency as $row) {
                    $matauang = $row->currency;
                }

                for($i=0 ; $i<$a; $i++){ ?>
                
                <tr>
                <td><?php echo $data[$i] ?></td>    
                <td><?php echo $matauang ?></td> 
                <td><?php echo $total_at_cost_system[$i] ?></td>            
                </tr>
                
                 
                <?php } ?>
                <td></td>
                <td>Total</td>
                <td><?php echo $total_total_at_cost_system ?></td>
                </tbody>
               </table>
               
            </div>
            </div>          
            </div>         
            </div>
          </div>

          <div class="row">
          <div class="col-md-6">
            <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title" >Departure</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                </div>
            </div>
              <div class="box-body">
              <div class="table-responsive">
              <table id="myTable" class="table table-bordered table-striped" class="display" width="100%">
                <thead>
                <tr>
                  <th>From</th>
                  <th>To</th>
                  <th>Time</th>
                  <th>Currency</th>
                  <th>Cost</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                $a = count($out_fromdept[0]);
                                
                for($i=0 ; $i<$a; $i++){ ?>
                
                <tr>
                <td><?php echo $out_fromdept[0][$i] ?></td>    
                <td><?php echo $out_todept[0][$i] ?></td> 
                <td><?php echo $out_time_estimasidept[0][$i]  ?> Minutes</td>
                <td><?php echo $out_estimasinamedept[0][$i] ?></td>
                <td><?php echo $out_estimasivaluedept[0][$i] ?></td>            
                </tr>
                
                 
                <?php } ?>

                </tbody>
               </table>
               
            </div>
            </div>
            </div>         
            </div>
          
          <div class="col-md-6">
            <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title" >Arrive</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                </div>
            </div>
              <div class="box-body">
              <div class="table-responsive">
              <table id="myTable" class="table table-bordered table-striped" class="display" width="100%">
                <thead>
                <tr>
                  <th>From</th>
                  <th>To</th>
                  <th>Time</th>
                  <th>Currency</th>
                  <th>Cost</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                $a = count($out_fromarive[0]);
                                
                for($i=0 ; $i<$a; $i++){ ?>
                
                <tr>
                <td><?php echo $out_fromarive[0][$i] ?></td>    
                <td><?php echo $out_toarive[0][$i] ?></td> 
                <td><?php echo $out_time_estimasiarive[0][$i]  ?> Minutes</td>
                <td><?php echo $out_estimasinamearive[0][$i] ?></td>
                <td><?php echo $out_estimasivaluearive[0][$i] ?></td>            
                </tr>
                
                 
                <?php } ?>

                </tbody>
               </table>
               
            </div>
            </div>
            </div>         
            </div>
          </div>

          <div class="row">
          <div class="col-md-12">
            <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title" >All Cost</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                </div>
            </div>
              <div class="box-body">
              <table id="myTable" class="table table-bordered table-striped" class="display" width="100%">
                <thead>
                <tr>
                  <th>Currency</th>
                  <th>Allowance</th>
                  <th>At Cost</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                $a = count($currencytotal[0]);
                                
                for($i=0 ; $i<$a; $i++){ ?>
                
                <tr>
                <td><?php echo $currencytotal[0][$i] ?></td>    
                <td><?php echo $total_all_allowance[0][$i] ?></td> 
                <td><?php echo $total_all_atcost[0][$i] ?></td>            
                </tr>
                
                 
                <?php } ?>

                </tbody>
               </table>
               
            </div>          
            </div>
            <?php $data = serialize($alldata); ?>
            <div class="box">
            <div class="box-body">
             <form method="POST" action="<?php echo base_url('permintaan/tambah') ?>">
                <textarea class="hide" type="text" class="form-control" name="data"><?php echo $data; ?></textarea>
                <div class="form-group">
                <h4>Pilih yo cuk ?????</h4>
                <label>
                  <input type="radio" name="pilih" class="minimal form-control" value="1">Allowance &emsp;
                </label>
                <label>
                  <input type="radio" name="pilih" class="minimal form-control" value="0">At Cost
                </label>
              </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
            <div>
            </div>      
<?php  //} ?>
      </section>
</div>
<?php include 'application/views/dasbor/footer.php';?>
<?php 
}
else
{
  redirect(base_url());
}
?>