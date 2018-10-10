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
        Data Location
        <small>Add</small>
      </h1>
  </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
            <form id="formlokasi" class="form-horizontal" method="post" action="<?php echo base_url('datakota/proses_tambah') ?>">
              <div class="box-body">
             
                <div class="form-group">
                  <label class="col-lg-2 control-label">City</label>
                  <div class="col-lg-5">
                  <input type="text" class="form-control" name="namakota" placeholder="City">
                  </div>
                </div>
              
                <div class="form-group">
                  <label class="col-lg-2 control-label">Country</label>
                  <div class="col-lg-5">
                  <input type="text" class="form-control" name="namanegara" placeholder="Country">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-2 control-label">Code</label>
                  <div class="col-lg-5">
                  <select class="form-control select2" name="kode">
                  <option value="">Select Department</option>
                    <?php 
                    foreach($kodelokasi as $row)
                    { 
                      echo '<option value="'.$row->idlokasi.'">'.$row->namalokasi.'</option>';
                    }
                    ?>
                  </select>
                  </div>
                </div>
                             
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href=<?php echo base_url();?>datalokasi>Cancel</a>
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
    $('#formlokasi').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            kode: {
                validators: {
                    notEmpty: {
                        message: 'This field cannot be empty'
                      }
                }
            },
            namakota: {
                validators: {
                    notEmpty: {
                        message: 'This field cannot be empty'
                    },
                    stringLength: {
                        min: 4,
                        max: 25,
                        message: 'Name must be more than 4 and less than 25 characters'
                    }
                }
            },
            namanegara: {
                validators: {
                    notEmpty: {
                        message: 'This field cannot be empty'
                    },
                    stringLength: {
                        min: 4,
                        max: 15,
                        message: 'Country must be more than 4 and less than 15 characters long'
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