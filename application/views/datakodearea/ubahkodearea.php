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
        Area Code
        <small>Update</small>
      </h1>
  </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
            <form id="formkodearea" class="form-horizontal" method="post" action="<?php echo base_url('datakodearea/proses_ubah') ?>">
              <div class="box-body">

                <div class="form-group">
                  <label class="col-lg-2 control-label">Id</label>
                  <div class="col-lg-5">
                  <input type="text" class="form-control" name="idkodearea" placeholder="Id" value="<?php echo $kodearea->area_code ?>" readonly>
                  </div>
                </div>
              
                <div class="form-group">
                  <label class="col-lg-2 control-label">Name</label>
                  <div class="col-lg-5">
                  <input type="text" class="form-control" name="namakodearea" placeholder="Name" value="<?php echo $kodearea->name ?>">
                  </div>
                </div>              
              </div>
              
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href=<?php echo base_url();?>datakodearea>Cancel</a>
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
    $('#formkodearea').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
           idkodearea: {
                validators: {
                    notEmpty: {
                        message: 'This field cannot be empty'
                    },
                    stringLength: {
                        min: 4,
                        max: 30,
                        message: 'Id must be more than 4 and less than 30 characters'
                    }
                }
            },
            namakodearea: {
                validators: {
                    notEmpty: {
                        message: 'This field cannot be emptyy'
                    },
                    stringLength: {
                        min: 4,
                        max: 30,
                        message: 'Name must be more than 4 and less than 30 characters'
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