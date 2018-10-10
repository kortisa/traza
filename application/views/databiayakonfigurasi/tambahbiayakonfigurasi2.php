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
        Basic Rate Pocket Allowance
        <small>Add</small>
      </h1>
  </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
            <form id="formpersetujuan" class="form-horizontal" method="post" action="<?php echo base_url('databiayakonfigurasi/proses_tambah_basic_rate_pocket_allowance') ?>">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-lg-2 control-label">Name</label>
                  <div class="col-lg-5">
                  <input type="text" class=" form-control" name="name">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-2 control-label">Frequency</label>
                  <div class="col-lg-5">
                  <input type="number"  min="0" max="" step="1" data-stepper-options='{"labels":{"up":"Increase","down":"Decrease"}}' name="frequency" value="0" class=" form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-2 control-label">Homebase</label>
                  <div class="col-lg-5">
                  <select class="form-control" name="homebase">
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
                  </div>
                </div>
                <?php 
                foreach($areakode as $row)
                { ?>
                <div class="form-group">
                  <label class="col-lg-2 control-label"><?php echo $row->name ?></label>
                  <div class="col-lg-5">
                  <input type="number"  min="0" max="" step="0.1" data-stepper-options='{"labels":{"up":"Increase","down":"Decrease"}}' name="nilai[]" value="0" class=" form-control">
                  </div>
                </div>
                <?php
                }
                ?>
                <div class="form-group">
                  <label class="col-lg-2 control-label">Min</label>
                  <div class="col-lg-5">
                  <input type="number"  min="0" max="" step="1" data-stepper-options='{"labels":{"up":"Increase","down":"Decrease"}}' name="min" value="0" class=" form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-2 control-label">Max</label>
                  <div class="col-lg-5">
                  <input type="number"  min="0" max="" step="1" data-stepper-options='{"labels":{"up":"Increase","down":"Decrease"}}' name="max" value="0" class=" form-control">
                  </div>
                </div>
                
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href=<?php echo base_url();?>databiayakonfigurasi>Cancel</a>
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
    $('#formpersetujuan').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'This field cannot be empty'
                    },
                    stringLength: {
                        min: 3,
                        max: 15,
                        message: 'Name must be more than 3 and less than 15 characters'
                    },
                    regexp: {
                        regexp: nospecial,
                        message: 'Please use only letters (a-z) and numbers'
                    }
                }
            },
            frequency: {
                validators: {
                    notEmpty: {
                        message: 'This field cannot be empty'
                    },
                    stringLength: {
                        min: 1,
                        max: 15,
                        message: 'Frequency must be more than 1 and less than 15 characters'
                    }

                }
            },

          min: {
                validators: {
                    notEmpty: {
                        message: 'This field cannot be empty'
                    },
                    
                }
            },

            max: {
                validators: {
                    notEmpty: {
                        message: 'This field cannot be empty'
                    },
                    
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