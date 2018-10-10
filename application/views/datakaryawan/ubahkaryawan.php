<?php
$level = $this->session->userdata('level');
if($level=='admin')
    {
?>
<?php include 'application/views/dasbor/head.php';?>
<?php include 'application/views/dasbor/header.php';?>
<?php include('application/views/dasbor/leftsidebar.php'); ?> 
<div class="content-wrapper">
<section class="content-header">
      <h1>
        Employee
        <small>Update</small>
      </h1>
  </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
            <form id="formkaryawan" class="form-horizontal" method="post" action="<?php echo base_url('datakaryawan/proses_ubah') ?>">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-lg-2 control-label">NIK</label>
                  <div class="col-lg-5">
                  <input type="text" class="form-control" name="nik" placeholder="Nik" value="<?php echo $karyawan->nik ?>" readonly>
                  </div>
                </div>
              
                <div class="form-group">
                  <label class="col-lg-2 control-label"> Name</label>
                  <div class="col-lg-5">
                  <input type="text" class="form-control" name="namakaryawan" placeholder="Name" value="<?php echo $karyawan->name ?>">
                  </div>
                </div>
             
                <div class="form-group">
                  <label class="col-lg-2 control-label">Id Telegram</label>
                  <div class="col-lg-5">
                  <input type="text" class="form-control" name="idtelegram" placeholder="Id Telegram" value="<?php echo $karyawan->telegramid ?>">
                  </div>
                </div>
              
                <div class="form-group">
                  <label class="col-lg-2 control-label">Email</label>
                  <div class="col-lg-5">
                  <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $karyawan->email ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-2 control-label">Department</label>
                  <div class="col-lg-5">
                  <select class="form-control" name="iddepartemen">
                  <option value="<?php echo $karyawan->deptid ?>"><?php echo $karyawan->deptname ?></option>
                    <?php 
                    foreach($departemen as $row)
                    { 
                      echo '<option value="'.$row->deptid.'">'.$row->deptname.'</option>';
                    }
                    ?>
                  </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-2 control-label">Position</label>
                  <div class="col-lg-5">
                  <select class="form-control" name="idjabatan">
                  <option value="<?php echo $karyawan->postid ?>"><?php echo $karyawan->postname ?></option>
                    <?php 
                    foreach($jabatan as $row)
                    { 
                      echo '<option value="'.$row->postid.'">'.$row->postname.'</option>';
                    }
                    ?>
                  </select>
                  </div>
                </div>
              
                 <div class="form-group">
                  <label class="col-lg-2 control-label">Level</label>
                  <div class="col-lg-5">
                  <select class="form-control" name="tingkat">
                    <option value="<?php echo $karyawan->grade ?>"><?php echo $karyawan->grade ?></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                  </select>
                </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href=<?php echo base_url();?>datakaryawan>Cancel</a>
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
    $('#formkaryawan').bootstrapValidator({
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
                        message: 'NIK must be more than 4 and less than 20 characters  '
                    }
                }
            },
            namakaryawan: {
                validators: {
                    notEmpty: {
                        message: 'This field cannot be empty'
                    },
                    stringLength: {
                        min: 4,
                        max: 40,
                        message: 'Name must be more than 4 and less than 40 characters  '
                    }
                }
            },
            idtelegram: {
                validators: {
                    notEmpty: {
                        message: 'This field cannot be empty'
                    },
                    stringLength: {
                        min: 4,
                        max: 20,
                        message: 'TTelegram ID must be more than 4 and less than 20 characters  '
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'This field cannot be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            iddepartemen: {
                validators: {
                    notEmpty: {
                        message: 'This field cannot be empty'
                    }
                }
            },
            idjabatan: {
                validators: {
                    notEmpty: {
                        message: 'This field cannot be empty'
                    }
                }
            },
            tingkat: {
                validators: {
                    notEmpty: {
                        message: 'This field cannot be empty'
                    }
                }
            },
            tanggal: {
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
<script>
   $('#datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayHighlight: true,
    })
    .on('changeDate show', function(e) {
        // Revalidate the date when user change it
        $('#formkaryawan').bootstrapValidator('revalidateField', 'tanggal');
    });
</script>

<?php 
}
else
{
  redirect(base_url());
}
?>