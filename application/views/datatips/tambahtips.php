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
        Data Tips & Trick
        <small>Add</small>
      </h1>
  </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
           
            <form id="formlokasi" name="form1" class="form-horizontal" method="post" action="<?php echo base_url('datatips/proses_tambah') ?>">
              <div class="box-body">
             
                <div class="form-group">
                  <label class="col-lg-2 control-label">Category</label>
                  <div class="col-lg-5">
                  <select id="category1" class="form-control select" name="category">
                    <option value="general" selected="">General</option>
                    <option value="country">Country</option>                 
                  </select>
                  </div>
                </div>
              
                
                <div id="country1" class="form-group hide">
                  <label class="col-lg-2 control-label">Country</label>
                  <div class="col-lg-5">
                  <?php $attributes = 'id="country" class="form-control select" style="width: 100%;"';
                echo form_dropdown('country', $country, set_value('country'), $attributes); ?>
                  </div>
                </div>
                

                
                <div id="city1" class="form-group hide">
                  <label class="col-lg-2 control-label">City</label>
                  <div class="col-lg-5">
                    <?php $attributes = 'id="city" class="form-control select" style="width: 100%;"';
                echo form_dropdown('city', $city, set_value('city'), $attributes); ?>
                  </div>
                </div>
                

                <div class="form-group">
                  <label class="col-lg-2 control-label">Title</label>
                  <div class="col-lg-5">
                    <input type="text" class="form-control" name="title" placeholder="The title of article">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-2 control-label">Article</label>
                  <div class="col-lg-5">
                    <textarea class="form-control" name="article" placeholder="Write here.."></textarea>
                  </div>
                </div>
                             
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href=<?php echo base_url();?>datatips>Cancel</a>
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
        url: "<?php echo site_url('datatips/populate_city'); ?>",
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
    $('#formlokasi').bootstrapValidator({
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
                        message: 'The code is required and cannot be empty'
                      }
                }
            },
            country: {
                validators: {
                    notEmpty: {
                        message: 'The name of city is required and cannot be empty'
                    },
                    
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