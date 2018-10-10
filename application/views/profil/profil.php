<?php
$level = $this->session->userdata('level');
if($level=='admin' or $level=='operator' or $level=='manajer' or $level=='odgm')
    {
?>
<?php include 'application/views/dasbor/head.php';?>
<?php include 'application/views/dasbor/header.php';?>
<?php include('application/views/dasbor/leftsidebar.php'); ?> 
<div class="content-wrapper">
<section class="content-header">
      <h1>
        Profile
      </h1>
  </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
            <form id="formkaryawan" class="form-horizontal" method="post" action="<?php echo base_url('datakaryawan/proses_ubah_profil') ?>">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-lg-2 control-label">NIK</label>
                  <div class="col-lg-5">
                  <input type="text" class="form-control" name="nik" placeholder="Nik" value="<?php echo $karyawan->nik ?>" readonly>
                  </div>
                </div>
              
                <div class="form-group">
                  <label class="col-lg-2 control-label">Name</label>
                  <div class="col-lg-5">
                  <input type="text" class="form-control" name="namakaryawan" placeholder="Name" value="<?php echo $karyawan->nama ?>">
                  </div>
                </div>
             
                <div class="form-group">
                  <label class="col-lg-2 control-label">Id Telegram</label>
                  <div class="col-lg-5">
                  <input type="text" class="form-control" name="idtelegram" placeholder="Id Telegram" value="<?php echo $karyawan->idtelegram ?>">
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
                  <option value="<?php echo $karyawan->iddepartemen ?>"><?php echo $karyawan->namadepartemen ?></option>
                    <?php 
                    foreach($departemen as $row)
                    { 
                      echo '<option value="'.$row->iddepartemen.'">'.$row->namadepartemen.'</option>';
                    }
                    ?>
                  </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-2 control-label">Position</label>
                  <div class="col-lg-5">
                  <select class="form-control" name="idjabatan">
                  <option value="<?php echo $karyawan->idjabatan ?>"><?php echo $karyawan->namajabatan ?></option>
                    <?php 
                    foreach($jabatan as $row)
                    { 
                      echo '<option value="'.$row->idjabatan.'">'.$row->namajabatan.'</option>';
                    }
                    ?>
                  </select>
                  </div>
                </div>
              
                 <div class="form-group">
                  <label class="col-lg-2 control-label">Level</label>
                  <div class="col-lg-5">
                  <select class="form-control" name="tingkat">
                    <option value="<?php echo $karyawan->tingkat ?>"><?php echo $karyawan->tingkat ?></option>
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
                <a href=<?php echo base_url();?>>Cancel</a>
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
                        message: 'The nik of employee is required and cannot be empty'
                    },
                    stringLength: {
                        min: 1,
                        max: 20,
                        message: 'The nik of employee must be more than 1 and less than 20 characters long'
                    }
                }
            },
            namakaryawan: {
                validators: {
                    notEmpty: {
                        message: 'The name of employee is required and cannot be empty'
                    },
                    stringLength: {
                        min: 1,
                        max: 40,
                        message: 'The name of employee must be more than 1 and less than 40 characters long'
                    }
                }
            },
            idtelegram: {
                validators: {
                    notEmpty: {
                        message: 'The name of potition is required and cannot be empty'
                    },
                    stringLength: {
                        min: 1,
                        max: 20,
                        message: 'The name of potition must be more than 1 and less than 20 characters long'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email is required and cannot be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            iddepartemen: {
                validators: {
                    notEmpty: {
                        message: 'The id department is required'
                    }
                }
            },
            idjabatan: {
                validators: {
                    notEmpty: {
                        message: 'The id potition is required'
                    }
                }
            },
            tingkat: {
                validators: {
                    notEmpty: {
                        message: 'The level is required'
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