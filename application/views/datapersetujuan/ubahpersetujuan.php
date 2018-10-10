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
         Approval
        <small>Update</small>
      </h1>
  </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
            <form id="formpersetujuan" class="form-horizontal" method="post" action="<?php echo base_url('datapersetujuan/proses_ubah') ?>" role="form">
              <div class="box-body">
              <div class="form-group">
                  <label class="col-lg-2 control-label">Requestor</label>
                  <div class="col-lg-5">
                  <input type="text" name="nikpeminta" id="nikpeminta" class="autocomplete form-control" value="<?php echo $persetujuan->reqnik ?>" readonly>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-lg-2 control-label">Level 1</label>
                  <div class="col-lg-5">
                  <select class="form-control select2" name="nikpenerima1">
                    <option value="<?php echo $persetujuan->approval1 ?>"><?php echo $persetujuan->approval1 ?> - <?php echo $persetujuan->name1?></option>
                    <?php 
                    foreach($karyawan as $row)
                    { 
                      echo '<option value="'.$row->nik.'">'.$row->nik.' - '.$row->name.'</option>';
                    }
                    ?>
                  </select>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-lg-2 control-label">Level 2</label>
                  <div class="col-lg-5">
                  <select class="form-control select2" name="nikpenerima2">
                    <option value="<?php echo $persetujuan->approval2 ?>"><?php echo $persetujuan->approval2 ?> - <?php echo $persetujuan->name2?></option>
                    <?php 
                    foreach($karyawan as $row)
                    { 
                      echo '<option value="'.$row->nik.'">'.$row->nik.' - '.$row->name.'</option>';
                    }
                    ?>
                  </select>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-lg-2 control-label">Level 3</label>
                  <div class="col-lg-5">
                  <select class="form-control select2" name="nikpenerima3">
                    <option value="<?php echo $persetujuan->approval3 ?>"><?php echo $persetujuan->approval3 ?> - <?php echo $persetujuan->name3?></option>
                    <?php 
                    foreach($karyawan as $row)
                    { 
                      echo '<option value="'.$row->nik.'">'.$row->nik.' - '.$row->name.'</option>';
                    }
                    ?>
                  </select>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-lg-2 control-label">Level 4</label>
                  <div class="col-lg-5">
                  <select class="form-control select2" name="nikpenerima4">
                    <option value="<?php echo $persetujuan->approval4 ?>"><?php echo $persetujuan->approval4 ?> - <?php echo $persetujuan->name4?></option>
                    <?php 
                    foreach($karyawan as $row)
                    { 
                      echo '<option value="'.$row->nik.'">'.$row->nik.' - '.$row->name.'</option>';
                    }
                    ?>
                  </select>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-lg-2 control-label">Status</label>
                  <div class="col-lg-5">
                  <select class="form-control" name="statuspersetujuan">
                    <option value="<?php echo $persetujuan->requeststatus ?>"><?php echo ucfirst($persetujuan->requeststatus) ?></option>
                    <option value="active">Active</option>
                    <option value="nonactive">Nonactive</option>
                  </select>
                  </div>
              </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href=<?php echo base_url();?>datapersetujuan>Cancel</a>
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
<?php $link = base_url().'assets/'?>
<link href='<?php echo base_url().'assets/autocomplete/jquery.autocomplete.css'?>' rel='stylesheet' />
<script src="<?php echo base_url().'assets/autocomplete/jquery.autocomplete.js'?>" type="text/javascript"></script>
<script type="text/javascript">
        var site = "<?php echo site_url();?>";
        $(function(){
            $('.autocomplete').autocomplete({
                // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                serviceUrl: site+'/datapersetujuan/ambil_karyawan',
            });
        });
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#formpersetujuan').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            nikpeminta: {
                validators: {
                    notEmpty: {
                        message: 'This field cannot be empty'
                    },
                    stringLength: {
                        min: 4,
                        max: 20,
                        message: 'The nik of employee must be more than 1 and less than 20 characters long'
                    }
                }
            },
            nikpenerima1: {
                validators: {
                    stringLength: {
                        min: 4,
                        max: 20,
                        message: 'The nik of employee must be more than 1 and less than 20 characters long'
                    }
                }
            },
            nikpenerima2: {
                validators: {
                    stringLength: {
                        min: 4,
                        max: 20,
                        message: 'The nik of employee must be more than 1 and less than 20 characters long'
                    }
                }
            },
            nikpenerima3: {
                validators: {
                    stringLength: {
                        min: 4,
                        max: 20,
                        message: 'The nik of employee must be more than 1 and less than 20 characters long'
                    }
                }
            },
            nikpenerima4: {
                validators: {
                    stringLength: {
                        min: 4,
                        max: 20,
                        message: 'The nik of employee must be more than 1 and less than 20 characters long'
                    }
                }
            },
            statuspersetujuan: {
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