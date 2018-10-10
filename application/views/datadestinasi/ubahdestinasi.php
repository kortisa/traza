<?php
$level = $this->session->userdata('level');
if($level=='admin')
    {
?>
<?php include 'application/views/dasbor/head.php';?>

<?php include 'application/views/dasbor/header.php';?>
  <!-- Left side column. contains the logo and sidebar -->
<?php include('application/views/dasbor/leftsidebar.php'); ?> 
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="content-header">
      <h1>
        Destination
        <small>Update</small>
      </h1>
  </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
            <form id="formdestinasi" class="form-horizontal" method="post" action="<?php echo base_url('datadestinasi/proses_ubah') ?>">
              <div class="box-body">

                <div class="form-group hide">
                  <label class="col-lg-2 control-label">Code</label>
                  <div class="col-lg-5">
                  <input type="text" class="form-control" name="code" placeholder="Code" value="<?php echo $destinasi->code ?>" readonly>
                  </div>
                </div>
              
                <div class="form-group">
                  <label class="col-lg-2 control-label">Name</label>
                  <div class="col-lg-5">
                  <input type="text" class="form-control" name="namadestinasi" placeholder="Name" value="<?php echo $destinasi->name_destination ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-2 control-label">Area</label>
                  <div class="col-lg-5">
                  <select class="form-control" name="areakode">
                  <option value="<?php echo $destinasi->area_code ?>"><?php echo $destinasi->area_code ?></option>
                    <?php 
                    foreach($areakode as $row)
                    { 
                      echo '<option value="'.$row->area_code.'">'.$row->name.'</option>';
                    }
                    ?>
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-2 control-label">Currency</label>
                  <div class="col-lg-5">
                  <input type="text" class="form-control" name="currency" placeholder="Currency" value="<?php echo $destinasi->currency ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-2 control-label">Constant</label>
                  <div class="col-lg-5">
                  <input type="number" class="form-control" name="konstanta" placeholder="Constant" value="<?php echo $destinasi->constant ?>"  min="0"  step="0.1" data-stepper-options='{"labels":{"up":"Increase","down":"Decrease"}}'>
                  </div>
                </div>              
              </div>
              
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href=<?php echo base_url();?>datadestinasi>Cancel</a>
              </div>
            </form>
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
<?php include 'application/views/dasbor/footer.php';?>
<script type="text/javascript">
$(document).ready(function() {
    $('#formdestinasi').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            namadestinasi: {
                validators: {
                    notEmpty: {
                        message: 'The name of potition is required and cannot be empty'
                    },
                    stringLength: {
                        min: 1,
                        max: 30,
                        message: 'The name of potition must be more than 1 and less than 30 characters long'
                    }
                }
            }        
        }
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