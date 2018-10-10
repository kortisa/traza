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
        Location
        <small>Update</small>
      </h1>
  </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
            <form id="formkota" class="form-horizontal" method="post" action="<?php echo base_url('datatips/proses_ubah') ?>">
              <div class="box-body">
                
                <div class="form-group">
                  <label class="col-lg-2 control-label">ID</label>
                  <div class="col-lg-5">
                  <input type="text" class="form-control" name="idtips" placeholder="Location ID" value="<?php echo $tips->id ?>" readonly>
                  </div>
                </div>
              
                <div class="form-group">
                  <label class="col-lg-2 control-label">Category</label>
                  <div class="col-lg-5">
                  <select id="category1" class="form-control" name="category">
                  
                    <?php 
                    if($tips->category == "country")
                    {
                      echo '<option value="'.$tips->category.'" selected>'.ucfirst($tips->category).'</option>
                            <option value="general">General</option>';
                    }
                    else
                    {
                      echo '<option value="general" selected>General</option>
                            <option value="country">Country</option>';
                    }
                    
                    ?>
                  </select>
                  </div>
                </div>

<?php
if($tips->category == "country")
                    { ?>

                <div id="country1" class="form-group">
                  <label class="col-lg-2 control-label">Country</label>
                  <div class="col-lg-5">
                  <select style="width: 100%" class="form-control select2" id="country" name="country">

                  <?php
                    $query_c = $this->db->query("SELECT * FROM program.ta_country")->result();

                    foreach ($query_c as $row)
                    {
                      if($row->name == $tips->country)
                      {
                        echo '<option value="'.$row->code.'" selected>'.$row->name.'</option>';
                      }
                      else
                      {
                        echo '<option value="'.$row->code.'">'.$row->name.'</option>';
                      }
                    }
                  ?>
                  </select>
                  </div>
                </div>
              
                <div id="city1" class="form-group">
                  <label class="col-lg-2 control-label">City</label>
                  <div class="col-lg-5">
                  <select style="width: 100%" class="form-control select2" id="city" name="city">
                  <?php
                    $queryapa = $this->db->query("SELECT * FROM program.ta_country WHERE name='Indonesia'")->row();
                    $query_d = $this->db->query("SELECT * FROM program.ta_city")->result();
                    //echo '<option>'.$query_d.'</option>';

                    foreach ($query_d as $row)
                    {
                      if($row->name == $tips->city)
                      {
                        echo '<option value="'.$row->id.'" selected>'.$row->name.'</option>';
                      }
                      else
                      {
                        echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                      }
                    }
                  ?>
                  </select>

                  </div>
                </div>

<?php } else { ?>
              
                <div id="country1" class="form-group hide">
                  <label class="col-lg-2 control-label">Country</label>
                  <div class="col-lg-5">
                  <select style="width: 100%" class="form-control select2" id="country" name="country">

                  <?php
                    $query_c = $this->db->query("SELECT * FROM program.ta_country")->result();

                    foreach ($query_c as $row)
                    {
                      if($row->name == $tips->country)
                      {
                        echo '<option value="'.$row->code.'" selected>'.$row->name.'</option>';
                      }
                      else
                      {
                        echo '<option value="'.$row->code.'">'.$row->name.'</option>';
                      }
                    }
                  ?>
                  </select>
                  </div>
                </div>
              
                <div id="city1" class="form-group hide">
                  <label class="col-lg-2 control-label">City</label>
                  <div class="col-lg-5">
                  <select style="width: 100%" class="form-control select2" id="city" name="city">
                  <?php
                    $queryapa = $this->db->query("SELECT * FROM program.ta_country WHERE name='Indonesia'")->row();
                    $query_d = $this->db->query("SELECT * FROM program.ta_city")->result();
                    //echo '<option>'.$query_d.'</option>';

                    foreach ($query_d as $row)
                    {
                      if($row->name == $tips->city)
                      {
                        echo '<option value="'.$row->id.'" selected>'.$row->name.'</option>';
                      }
                      else
                      {
                        echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                      }
                    }
                  ?>
                  </select>
                  </div>
                </div>
<?php } ?>

                <div class="form-group">
                  <label class="col-lg-2 control-label">Title</label>
                  <div class="col-lg-5">
                  <input type="text" class="form-control" name="title" placeholder="Code" value="<?php echo $tips->title ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-2 control-label">Article</label>
                  <div class="col-lg-5">
                  <textarea class="form-control" name="article"><?php echo $tips->article; ?></textarea>
                  </div>
                </div>

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <a href=<?php echo base_url();?>datatips>Cancel</a>
                </div>

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
$('#category1').on('change',function(){
        if($(this).val()==="general"){
        $("#country1").addClass('hide');
        $("#city1").addClass('hide');
        }
        else{
        $("#country1").removeClass('hide');
        $("#city1").removeClass('hide');
        }
    });  
</script>

<script type="text/javascript">
$('#country').change(function(){
    var country_id = $(this).val();
    $("#city > option").remove();
    $.ajax({
        type: "POST",
        url: "<?php echo site_url('datatips/populate_city_ubah'); ?>",
        data: {id: country_id},
        dataType: 'json',
        success:function(data){
            $.each(data,function(k, v){
                var opt = $('<option />');
                opt.val(k);
                opt.text(v);
                $('#city').append(opt);
            });
            //$('#state').append('<option value="' + id + '">' + name + '</option>');
        }
    });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('#formkota').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            category: {
                validators: {
                    notEmpty: {
                        message: 'The name of place is required and cannot be empty'
                    },
                    stringLength: {
                        min: 1,
                        max: 50,
                        message: 'The name of place must be more than 6 and less than 50 characters long'
                    }
                }
            },
            country: {
                validators: {
                    notEmpty: {
                        message: 'The name of City is required and cannot be empty'
                    },
                    stringLength: {
                        min: 1,
                        max: 25,
                        message: 'The name of City must be more than 1 and less than 25 characters long'
                    }
                }
            },
            city: {
                validators: {
                    notEmpty: {
                        message: 'The name of country is required and cannot be empty'
                    },
                    stringLength: {
                        min: 1,
                        max: 15,
                        message: 'The name of country must be more than 1 and less than 15 characters long'
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