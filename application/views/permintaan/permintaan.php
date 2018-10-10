<?php
$level = $this->session->userdata('level');
$nik = $this->session->userdata('nik');
if($level=='operator' or $level=='manajer' or $level=='odgm')
    {
?>
<?php include 'application/views/dasbor/head.php';?>

<?php include 'application/views/dasbor/header.php';?>
  <!-- Left side column. contains the logo and sidebar -->
<?php include('application/views/dasbor/leftsidebar.php'); ?> 
  <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Create FORM
        <small>Form Travel Authorization</small>
      </h1>
      </section>
      <section class="content">
        <form id="formpersetujuan" method="post"  action="<?php echo base_url('permintaan/estimasi') ?>">
                            <div class="box">
                            <div class="box-header with-border">
                              <h3 class="box-title">Identity</h3>

                              <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                            
                                  <div class="col-md-12">

                                      <div class="col-md-4">
                                      <label>Requestor</label>
                                      <input name="nikpeminta" class=" form-control" value="<?php echo $nik ?>" readonly><br>
                                      </div>
                                      <div class="col-md-2">
                                      <label>Home Base</label><br>
                                      <input type="radio" name="homebase" class="minimal form-control" value="1">Yes &emsp;
                                      <input type="radio" name="homebase" class="minimal form-control" value="0">No
                                      </div>
                             
                                      <div class="form-group"> 
                                      <div class="col-md-6">
                                      <label>Nik Traveller</label>
                                      <select class="form-control select2" name="nikpejalan[]" multiple="multiple" style="width: 100%;">
                                      <option value=""></option>
                                        <?php
                                          $iddepartemen =  $this->db->query("select * from program.ta_employee where nik='$nik'");
                                          foreach ($iddepartemen->result() as $row)
                                          {
                                            $iddepartemennya=$row->deptid;
                                          }
                                          //print_r($iddepartemennya);
                                          $karyawan = $this->db->query("select * from program.ta_employee where deptid='$iddepartemennya'");
                                          foreach($karyawan->result() as $row)
                                          { 
                                            echo '<option value="'.$row->nik.'">'.$row->nik.' , '.$row->name.'</option>';
                                          }
                                          ?>
                                        </select>

                                        </div>

                                      </div>
                                  </div>
                              </div>
                              
                          </div>
                          
                        <div class="box">
                          <div class="box-header with-border">
                              <h3 class="box-title">Depature</h3>

                              <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                              <div class="col-md-12">
                              
                                      <div class="col-md-4">
                                      <div class="form-group">
                                      <label>From</label>
                                      <select class="form-control select2" name="lokasipergi[]" id="lokasipergi0" style="width: 100%;">
                                        <option value="">Select From</option>
                                          <?php 
                                          foreach($kota as $row)
                                          { 
                                            echo '<option value="'.$row->name_destination.'">'.$row->name_destination.'</option>';
                                          }
                                          ?>
                                        </select>
                                      </div>
                                      </div>
                              
                                      <div class="col-md-4">
                                      <div class="form-group">
                                      <label>To</label>
                                      <select class="form-control select2" name="lokasipergi[]" id="lokasipergi1" style="width: 100%;" >
                                        <option value="" >Select To</option>

                                        <?php 
                                          foreach($kota as $row)
                                          { 
                                            echo '<option value="'.$row->name_destination.'">'.$row->name_destination.'</option>';
                                          }
                                          ?>
                                        </select>
                                      </div>
                                      </div>
                                      
                                      
                                      
                                      <div id="suggestion" class="hide col-md-4">
                                      <div class="form-group">
                                      <label>Suggestion</label>
                                      <select class="form-control" name="namarute" id="selectsuggestion" style="width: 100%;">
                                      
                                      </select>
                                      </div>
                                      </div>

                                      <div class="col-md-4">
                                      <div class="form-group">
                                      <label>Date</label>
                                      <input type="text" name="pergitanggal" class="form-control" id="datepicker" value="">
                                      </div>
                                      </div>                                    
                            </div>
                            </div>
                        </div>

                            <div class="box">
                            <div class="box-header with-border">
                              <h3 class="box-title">Estimation Depature</h3>
                              <div class="box-tools pull-left">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                              </div>
                              <div class="box-tools pull-right">
                              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                              </div>
                            </div>
                              <div class="box-body">

                                  <div id="rute" class="col-md-12"></div>
                                  <div class="col-md-12" id="depature">
                                  <div class="col-md-3"><a href='javascript:void(0);' id="cloneButton"><i class="fa fa-plus"></i></a></div>
                                      
                                      
                                      <div class="row" id="line_1">
                                      <div class="col-md-12">
                                      <div class="col-md-6">
                                      <div class="form-group">
                                      <label>From<br></label>
                                      <input type="text" name="lokasidaripergi[]" id="lokasidaripergi_0" value="" class="autocompletetempat form-control" class="required" placeholder="From">
                                      </div>
                                      </div>
                                      <div class="col-md-6">
                                      <div class="form-group">
                                      <label>To<br></label>
                                      <input type="text" name="lokasikepergi[]" id="lokasikepergi_0" value="" class="autocompletetempat form-control" class="required" placeholder="To">
                                      </div>
                                      </div>
                                      </div>
                                      <div class="col-md-12">
                                      <div class="col-md-3">
                                      <div class="form-group">
                                      <label>Tranportation<br></label>
                                      <select class="form-control" name="transportasipergi[]" id="transportasipergi_0">
                                        <option value="">Transportation</option>
                                        <option value="Taxi">Taxi</option>
                                        <option value="Motorcycle">Motorcycle</option>
                                        <option value="Train">Train</option>
                                        <option value="Ship">Ship</option>
                                        <option value="Plane">Plane</option>
                                      </select>
                                      </div>
                                      </div>
                                      <div class="col-md-2">
                                      <div class="form-group">
                                      <label>Hours<br></label>
                                      <input  name="jampergi[]" id="jampergipergi_0" value="0" class=" form-control" type="number" min="0" max="54" step="1" data-stepper-options='{"labels":{"up":"Increase","down":"Decrease"}}'>
                                      </div>
                                      </div>
                                      <div class="col-md-2">
                                      <div class="form-group">
                                      <label>Minutes<br></label>
                                      <input type="number" id="menitpergi_0" min="0" max="59" step="1" data-stepper-options='{"labels":{"up":"Increase","down":"Decrease"}}' name="menitpergi[]" value="0" class=" form-control">
                                      </div>
                                      </div>
                                      <div class="col-md-2">
                                      <div class="form-group">
                                      <label>Currency<br></label>
                                      <select class="form-control" name="namamatauangpergi[]" id="namamatauangpergi_0">
                                        <option value="">Currency</option>
                                        <?php 
                                          foreach($uang as $row)
                                          { 
                                            echo '<option value="'.$row->currency.'">'.$row->currency.'</option>';
                                          }
                                          ?>
                                      </select>
                                      </div>
                                      </div>
                                      <div class="col-md-2">
                                      <div class="form-group">
                                      <label>Price<br></label>
                                      <input type="number" id="hargapergi_0" min="0"  step="10" data-stepper-options='{"labels":{"up":"Increase","down":"Decrease"}}' name="hargapergi[]" value="0" class="form-control" class="required">

                                      </div>

                                      </div>
                                    </div>

                                  </div>
                              </div>
                              </div>
                              
                            </div>

                          <div class="box">
                          <div class="box-header with-border">
                              <h3 class="box-title">Arrival</h3>

                              <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                            
                              <div class="col-md-12">
                              
                                      <div class="col-md-4">
                                      <div class="form-group">
                                      <label>From</label>
                                      <select class="form-control select2" name="lokasipulang[]" style="width: 100%;" id="lokasipulang0">
                                        <option value="">Select From</option>
                                          <?php 
                                          foreach($kota as $row)
                                          { 
                                            echo '<option value="'.$row->name_destination.'">'.$row->name_destination.'</option>';
                                          }
                                          ?>
                                        </select>
                                      </div>
                                      </div>
                              
                                      <div class="col-md-4">
                                      <div class="form-group">
                                      <label>To</label>
                                      <select class="form-control select2" name="lokasipulang[]" style="width: 100%;" id="lokasipulang1">
                                        <option value="" >Select To</option>
                                          <?php 
                                          foreach($kota as $row)
                                          { 
                                            echo '<option value="'.$row->name_destination.'">'.$row->name_destination.'</option>';
                                          }
                                          ?>
                                        </select>
                                      </div>
                                      </div>

                                      <div id="suggestion1" class="hide col-md-4">
                                      <div class="form-group">
                                      <label>Suggestion</label>
                                      <select class="form-control" name="namarute" id="selectsuggestion1" style="width: 100%;">
                                      
                                      </select>
                                      </div>
                                      </div>
                              
                                      <div class="col-md-4">
                                      <div class="form-group">
                                      <label>Date</label>
                                      <input type="text" name="pulangtanggal" class="form-control" id="datepicker1" value="">
                                      </div>
                                      </div>
                              </div>
                              </div>
                            </div>

                          <div class="box">
                            <div class="box-header with-border">
                              <h3 class="box-title">Estimation Arrival</h3>

                              <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                                  <div class="box-body">                        
                                  
                                  <div id="rute1" class="col-md-12">
                                      <div class="col-md-3" ><a href='javascript:void(0);' id="cloneButton1"><i class='fa fa-plus'></i></a></div>
                                      </div>
                                      <div class="row1" id="line1_1">
                                      <div class="col-md-12">
                                      <div class="col-md-6">
                                      <div class="form-group">
                                      <label>From<br></label>
                                      <input type="text" name="lokasidaripulang[]" id="lokasidaripulang_0"  value="" class="autocompletetempat form-control" class="required" placeholder="From">
                                      </div>
                                      </div>
                                      <div class="col-md-6">
                                      <div class="form-group">
                                      <label>To<br></label>
                                      <input type="text" name="lokasikepulang[]" id="lokasikepulang_0" value="" class="autocompletetempat form-control" class="required" placeholder="To">
                                      </div>
                                      </div>
                                      </div>
                                      <div class="col-md-12">
                                      <div class="col-md-3">
                                      <div class="form-group">
                                      <label>Tranportation<br></label>
                                      <select class="form-control" name="transportasipulang[]" id="transportasipulang_0">
                                        <option value="">Transportation</option>
                                        <option value="Taxi">Taxi</option>
                                        <option value="Motorcycle">Motorcycle</option>
                                        <option value="Train">Train</option>
                                        <option value="Ship">Ship</option>
                                        <option value="Plane">Plane</option>
                                      </select>
                                      </div>
                                      </div>
                                      <div class="col-md-2">
                                      <div class="form-group">
                                      <label>Hours<br></label>
                                      <input  name="jampulang[]" id="jampulang_0" value="0" class=" form-control" type="number" min="0" max="54" step="1" data-stepper-options='{"labels":{"up":"Increase","down":"Decrease"}}'>
                                      </div>
                                      </div>
                                      <div class="col-md-2">
                                      <div class="form-group">
                                      <label>Minutes<br></label>
                                      <input type="number" id="menitpulang_0" min="0" max="59" step="1" data-stepper-options='{"labels":{"up":"Increase","down":"Decrease"}}' name="menitpulang[]" value="0" class=" form-control" class="required">
                                      </div>
                                      </div>
                                      <div class="col-md-2">
                                      <div class="form-group">
                                      <label>Currency<br></label>
                                      <select class="form-control" name="namamatauangpulang[]" id="namamatauangpulang_0">
                                        <option value="">Currency</option>
                                        <?php 
                                          foreach($uang as $row)
                                          { 
                                            echo '<option value="'.$row->currency.'">'.$row->currency.'</option>';
                                          }
                                          ?>
                                      </select>
                                      </div>
                                      </div>
                                      <div class="col-md-2">
                                      <div class="form-group">
                                      <label>Price<br></label>
                                      <input type="number" id="hargapulang_0" min="0"  step="10" data-stepper-options='{"labels":{"up":"Increase","down":"Decrease"}}' name="hargapulang[]" value="0" class="form-control" class="required">
                                      </div>
                                      </div>
                                  </div>    
                                  </div>
                                  </div>
                              </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      </section>
</div>

<?php include 'application/views/dasbor/footer.php';?>
<?php $link = base_url().'assets/'?>
<link href='<?php echo base_url().'assets/autocomplete/jquery.autocomplete.css'?>' rel='stylesheet' />
<script src="<?php echo base_url().'assets/autocomplete/jquery.autocomplete.js'?>" type="text/javascript"></script>


<script type="text/javascript">
        var site = "<?php echo site_url();?>";
        $(function(){
            $('.autocompletetempat').autocomplete({
                // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                serviceUrl: site+'/permintaan/ambil_tempat',
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
        $('#formpersetujuan').bootstrapValidator('revalidateField', 'pergitanggal');
    });
   $('#datepicker1').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayHighlight: true,
    })
   .on('changeDate show', function(e) {
        // Revalidate the date when user change it
        $('#formpersetujuan').bootstrapValidator('revalidateField', 'pulangtanggal');
    });
</script>
<script>
var template = $('#line_1').clone();
var template1 = $('#line1_1').clone();
var options = {
    fields: {
            'nikpejalan[]': {
                validators: {
                    notEmpty: {
                        message: 'Nik traveller is required and cannot be empty'
                    }
                }
            }, 
            'lokasipergi[]': {
                validators: {
                    notEmpty: {
                        message: 'Location is required and cannot be empty'
                    }
                }
            },
            pergitanggal: {
                validators: {
                    notEmpty: {
                        message: 'Date is required and cannot be empty'
                    }
                }
            },
            'lokasidaripergi[]': {
                validators: {
                    notEmpty: {
                        message: 'Location is required and cannot be empty'
                    }
                }
            }, 
            'lokasikepergi[]': {
                validators: {
                    notEmpty: {
                        message: 'Location is required and cannot be empty'
                    }
                }
            },
            'transportasipergi[]': {
                validators: {
                    notEmpty: {
                        message: 'Transportation is required and cannot be empty'
                    }
                }
            },
            'jampergi[]': {
                validators: {
                    notEmpty: {
                        message: 'Hours is required and cannot be empty'
                    }
                }
            },
            'menitpergi[]': {
                validators: {
                    notEmpty: {
                        message: 'Minutes is required and cannot be empty'
                    }
                }
            },
            'namamatauangpergi[]': {
                validators: {
                    notEmpty: {
                        message: 'Currency required and cannot be empty'
                    }
                }
            },
            'hargapergi[]': {
                validators: {
                    notEmpty: {
                        message: 'Price is required and cannot be empty'
                    }
                }
            },
            'lokasipulang[]': {
                validators: {
                    notEmpty: {
                        message: 'Location is required and cannot be empty'
                    }
                }
            },
            pulangtanggal: {
                validators: {
                    notEmpty: {
                        message: 'Date required and cannot be empty'
                    }
                }
            },
            'lokasidaripulang[]': {
                validators: {
                    notEmpty: {
                        message: 'Location is required and cannot be empty'
                    }
                }
            }, 
            'lokasikepulang[]': {
                validators: {
                    notEmpty: {
                        message: 'Location is required and cannot be empty'
                    }
                }
            },
            'transportasipulang[]': {
                validators: {
                    notEmpty: {
                        message: 'Transportation is required and cannot be empty'
                    }
                }
            },
            'jampulang[]': {
                validators: {
                    notEmpty: {
                        message: 'Hours is required and cannot be empty'
                    }
                }
            },
            'menitpulang[]': {
                validators: {
                    notEmpty: {
                        message: 'Minutes is required and cannot be empty'
                    }
                }
            },
            'namamatauangpulang[]': {
                validators: {
                    notEmpty: {
                        message: 'Currency is required and cannot be empty'
                    }
                }
            },
            'hargapulang[]': {
                validators: {
                    notEmpty: {
                        message: 'Price is required and cannot be empty'
                    }
                }
            },
            'biayatambahan': {
                validators: {
                    notEmpty: {
                        message: 'Others cash is required and cannot be empty'
                    }
                }
            },
            'biayapelatihan': {
                validators: {
                    notEmpty: {
                        message: 'Traininf cash is required and cannot be empty'
                    }
                }
            }          
    }
};
$('#formpersetujuan').bootstrapValidator(options);

$('#cloneButton').click(function () {
    var rowId = $('.row').length + 1;
    var validator = $('#formpersetujuan').data('bootstrapValidator');
    var klon = template.clone();          
    klon.attr('id', 'line_' + rowId)
        .insertAfter($('.row').last())
        .find('input,select')
        .each(function () {
            $(this).attr('id', $(this).attr('id').replace(/_(\d*)$/, "_"+rowId));
            validator.addField($(this));
            $(klon).find('input[type=text]').autocomplete({
                serviceUrl: site+'/permintaan/ambil_tempat',
            });
        })
        $("#line_" + rowId).append("<div class='col-md-12'><div class='col-md-3'><a href='javascript:void(0);' class='remove'><i class='fa fa-minus'></i></a></div></div>")                 
});

$('#cloneButton1').click(function () {
    var rowId1 = $('.row1').length + 1;
    var validator1 = $('#formpersetujuan').data('bootstrapValidator');
    var klon1 = template1.clone();          
    klon1.attr('id', 'line1_' + rowId1)
        .insertAfter($('.row1').last())
        .find('input,select')
        .each(function () {
            $(this).attr('id', $(this).attr('id').replace(/_(\d*)$/, "_"+rowId1));
            validator1.addField($(this));
            $(klon1).find('input[type=text]').autocomplete({
                serviceUrl: site+'/permintaan/ambil_tempat',
            });
        })   
        $("#line1_" + rowId1).append("<div class='col-md-12'><div class='col-md-3'><a href='javascript:void(0);' class='remove1'><i class='fa fa-minus'></i></a></div></div>")                
});

$(document).on("click", ".remove1", function() {
  $(this).closest(".row1").remove();
});

$(document).on("click", ".remove", function() {
  $(this).closest(".row").remove();
});

function aa(){
    var rowId = $('.row').length;
    var validator = $('#formpersetujuan').data('bootstrapValidator');
    var klon = template.clone();          
    klon.attr('id', 'line_' + rowId)
        .insertAfter($('.row').last())
        .find('input,select')
        .each(function () {
            $(this).attr('id', $(this).attr('id').replace(/_(\d*)$/, "_"+rowId));
            validator.addField($(this));
            $(klon).find('input[type=text]').autocomplete({
                serviceUrl: site+'/permintaan/ambil_tempat',
            });
        })
}

function bbb(){
    var rowId1 = $('.row1').length;
    var validator1 = $('#formpersetujuan').data('bootstrapValidator');
    var klon1 = template1.clone();          
    klon1.attr('id', 'line1_' + rowId1)
        .insertAfter($('.row1').last())
        .find('input,select')
        .each(function () {
            $(this).attr('id', $(this).attr('id').replace(/_(\d*)$/, "_"+rowId1));
            validator1.addField($(this));
            $(klon1).find('input[type=text]').autocomplete({
                serviceUrl: site+'/permintaan/ambil_tempat',
            });
        })
}

$('#selectsuggestion').on('change', function(){ 
    var c = $('#lokasipergi0').val();
    var b = $('#lokasipergi1').val();
    var site2 = "'{"+c+","+b+"}'";
    var a = $('#selectsuggestion').val();
    var site1 = "'"+a+"'";
    var site = "<?php echo site_url();?>";
    $.ajax({
     type: 'post',
     url: site+'/permintaan/tampil_rute_pergi',
     data: {
      get_option:site1,
      get_1:site2
    },
    datatype:'json',
     

    success: function (data) {
      var a = JSON.parse(data);
      var b = a[0].length;

      for (i = 0; i < b; i++) {
        aa();
        document.getElementById("lokasidaripergi_"+i).value = a[0][i];
        document.getElementById("lokasikepergi_"+i).value = a[1][i]; 
        //document.getElementById("transportasipergi_"+i).selectedIndex = ;

      }
      $("#line_" + i).closest(".row").remove();
      $('#suggestion').addClass('hide');
      }
    });

});

$('#selectsuggestion1').on('change', function(){ 
    var cc = $('#lokasipulang0').val();
    var bb = $('#lokasipulang1').val();
    var site22 = "'{"+cc+","+bb+"}'";
    var aa = $('#selectsuggestion1').val();
    var site11 = "'"+aa+"'";
    var site1 = "<?php echo site_url();?>";
    $.ajax({
     type: 'post',
     url: site1+'/permintaan/tampil_rute_pulang',
     data: {
      get_option:site11,
      get_1:site22
    },
    datatype:'json',
     
    success: function (data) {
      var aa = JSON.parse(data);
      var bb = aa[0].length;

      for (i = 0; i < bb; i++) {
        bbb();
        document.getElementById("lokasidaripulang_"+i).value = aa[0][i];
        document.getElementById("lokasikepulang_"+i).value = aa[1][i]; 
        //document.getElementById("transportasipergi_"+i).selectedIndex = ;

      }
      $("#line1_" + i).closest(".row1").remove();
      $('#suggestion1').addClass('hide');
      }
    });

});



</script>
<script>
  $('#lokasipergi0,#lokasipergi1').on('change', function(){  
    var a = $('#lokasipergi0').val();
    var b = $('#lokasipergi1').val();
    var site1 = "'{"+a+","+b+"}'";
    var site = "<?php echo site_url();?>";

    $.ajax({
     type: 'post',
     url: site+'/permintaan/tampil_suges_pergi',
     data: {
      get_option:site1
     },
     datatype:'json',
     success: function (data) {
      var a = JSON.parse(data);
      if (a != "") {
        $('#suggestion').removeClass('hide');
      }else{
        $('#suggestion').addClass('hide');
      }
     }
     });

    $.ajax({
     type: 'post',
     url: site+'/permintaan/tampil_rekomendasi_pergi',
     data: {
      get_option:site1
     },
     success: function (response) {
      document.getElementById("selectsuggestion").innerHTML=response; 
     }
     });

});
</script>

<script>
  $('#lokasipulang0,#lokasipulang1').on('change', function(){  
    var a = $('#lokasipulang0').val();
    var b = $('#lokasipulang1').val();
    var site1 = "'{"+a+","+b+"}'";
    var site = "<?php echo site_url();?>";

    $.ajax({
     type: 'post',
     url: site+'/permintaan/tampil_suges_pulang',
     data: {
      get_option:site1
     },
     datatype:'json',
     success: function (data) {
      var a = JSON.parse(data);
      if (a != "") {
        $('#suggestion1').removeClass('hide');
      }else{
        $('#suggestion1').addClass('hide');
      }
     }
     });

    $.ajax({
     type: 'post',
     url: site+'/permintaan/tampil_rekomendasi_pulang',
     data: {
      get_option:site1
     },
     success: function (response) {
      document.getElementById("selectsuggestion1").innerHTML=response; 
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