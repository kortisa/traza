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
        Position
        <small>Update</small>
      </h1>
  </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
            <form id="formwaktu" class="form-horizontal" method="post" action="<?php echo base_url('datasistemwaktu/proses_ubah_waktu') ?>">
              <div class="box-body">

                <div class="form-group hide">
                  <label class="col-lg-2 control-label">Id</label>
                  <div class="col-lg-5">
                  <input type="text" class="form-control" name="id" placeholder="Id" value="<?php echo $waktu->id ?>" readonly>
                  </div>
                </div>              
                <div class="form-group hide">
                  <label class="col-lg-2 control-label">Name</label>
                  <div class="col-lg-5">
                  <input type="text" class="form-control" name="nama" placeholder="Name" value="<?php echo $waktu->name ?>">
                  </div>
                </div>              
              

              <div class="form-group">
                  <label class="col-lg-2 control-label">Time</label>
                  <div class="col-lg-5">
                  <input type="number"  min="0" max="" step="1" data-stepper-options='{"labels":{"up":"Increase","down":"Decrease"}}' class="form-control" name="time" placeholder="Time" value="<?php echo $waktu->time ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-2 control-label">Value</label>
                  <div class="col-lg-5">
                  <input type="number"  min="0" max="" step="1" data-stepper-options='{"labels":{"up":"Increase","down":"Decrease"}}' class="form-control" name="value" placeholder="Value" value="<?php echo $waktu->value ?>">
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href=<?php echo base_url();?>datasistemwaktu>Cancel</a>
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
    var nospecial=/^[^*|\":<>[\]{}`\\()';@&$#!]+$/;
    $('#formwaktu').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            time: {
                validators: {
                    notEmpty: {
                        message: 'This field cannot be empty'
                    }
                }
            },
            value: {
                validators: {
                    notEmpty: {
                        message: 'This field cannot be empty'
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