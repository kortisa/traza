<?php include 'application/views/dasbor/head.php';?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">


<?php $this->load->view('dasbor/header');?> <!-- header.php di includekan-->
<?php include('application/views/dasbor/leftsidebar.php'); ?> 




    <div class="content-wrapper">

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
      
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
 
      <form id="form" method="post">
        <h2>Sample - Request Traza </h2>
        <p>
        <input type="text" id="reqid" placeholder="ID Permintaan" />
        <div id="idpermintaan"></div>
        <br>
        <input type="text" id="reqnik" placeholder="NIK Requestor" />
        <div id="vname"></div>
        <br>

        </p>
        <p>
          <input type="button" class="btn btn-lg btn-primary" id="postkan" value="Postkan">
        </p>
        <p>Silakan isi pesan lalu klik tombol postkan.</p>
        </form>
        <div id="sukses"></div>
      </div>
 
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    </div> <!-- /container -->


<?php $this->load->view('dasbor/footer');?> <!-- footer.php di includekan -->
