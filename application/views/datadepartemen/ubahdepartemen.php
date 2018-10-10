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
        Department
        <small>Update</small>
      </h1>
  </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
            <form id="formdepartemen" class="form-horizontal" method="post" action="<?php echo base_url('datadepartemen/proses_ubah') ?>">
              <div class="box-body">

                <div class="form-group hide">
                  <label class="col-lg-2 control-label">Id</label>
                  <div class="col-lg-5">
                  <input type="text" class="form-control" name="iddepartemen" placeholder="Department Id" value="<?php echo $departemen->deptid ?>" readonly>
                  </div>
                </div>
              
                <div class="form-group">
                  <label class="col-lg-2 control-label">Name</label>
                  <div class="col-lg-5">
                  <input type="text" class="form-control" name="namadepartemen" placeholder="Password" value="<?php echo $departemen->deptname ?>">
                  </div>
                </div>
              
              
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href=<?php echo base_url();?>datadepartemen>Cancel</a>
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
    $('#formdepartemen').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            namadepartemen: {
                validators: {
                    notEmpty: {
                        message: 'This field cannot be empty'
                    },
                    stringLength: {
                        min: 4,
                        max: 15,
                        message: 'Name must be more than 4 and less than 15 characters'
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