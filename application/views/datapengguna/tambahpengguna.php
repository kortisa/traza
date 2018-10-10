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
        Users
        <small>Add</small>
      </h1>
  </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
            <form id="formpengguna" class="form-horizontal" method="post" action="<?php echo base_url('datapengguna/proses_tambah') ?>">
              <div class="box-body">
              
                <div class="form-group">
                  <label class="col-lg-2 control-label">Username</label>
                  <div class="col-lg-5">
                  <select class="form-control select2" name="nik">
                    <option value="">Select Employee</option>
                    <?php 
                    foreach($karyawan as $row)
                    { 
                      echo '<option value="'.$row->nik.'">'.$row->nik.' - '.$row->name.'</option>';
                    }
                    ?>
                  </select>
                  <?php $msg = $this->session->flashdata('ada'); if((isset($msg)) && (!empty($msg))) { ?>
                  <p style = "color:red;">
                  <?php print_r($msg); ?>
                  </p>
                  <?php } ?>
                  </div>
                </div>
              
                <div class="form-group">
                  <label class="col-lg-2 control-label">Password</label>
                  <div class="col-lg-5">
                  <input type="password" class="form-control" name="katasandi" placeholder="Password">
                  </div>
                </div>
              
                <div class="form-group">
                  <label class="col-lg-2 control-label">Level</label>
                  <div class="col-lg-5">
                  <select class="form-control" name="level">
                  <option value="">Select Level</option>
                    <option value="admin">Admin</option>
                    <option value="operator">Operator</option>
                    <option value="manajer">Manager</option>
                    <option value="odgm">OD or GM</option>
                    <option value="hrm">HRM</option>
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-2 control-label">Status</label>
                  <div class="col-lg-5">
                  <select class="form-control" name="status">
                  <option value="">Select Status</option>
                    <option value="active">Active</option>
                    <option value="block">Block</option>
                    <option value="special">Spesial</option>
                  </select>
                  </div>
                </div>
                
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href=<?php echo base_url();?>datapengguna>Cancel</a>
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
    $('#formpengguna').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            nik: {
                validators: {
                    notEmpty: {
                        message: 'This field cannot be empty'
                    },
                    stringLength: {
                        min: 4,
                        max: 20,
                        message: 'NIK must be more than 4 and less than 20 characters'
                    }
                }
            }, 
            katasandi: {
                validators: {
                    notEmpty: {
                        message: 'This field cannot be empty'
                    },
                    stringLength: {
                        min: 4,
                        max: 20,
                        message: 'Password must be more than 4 and less than 20 characters'
                    }
                }
            },
            level: {
                validators: {
                    notEmpty: {
                        message: 'This field cannot be empty'
                    }
                }
            },
            status: {
                validators: {
                    notEmpty: {
                        message: 'Status is required and cannot be empty'
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