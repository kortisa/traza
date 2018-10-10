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
        <h2>Sample - Page Approval </h2>
        <p>
        <input type="text" id="nama" value="<?php echo $requestor->reqid ?>" placeholder="NIK Requestor" readonly/>
        <div id="vname"></div>
        <br>
        <textarea id="pesan" cols="50" rows="5" placeholder="Isikan Pesan" readonly><?php echo $requestor->reqnik ?></textarea>
        <div id="vpesan"></div>
        <br>
        <input type="text" id="status" value="<?php echo $requestor->statusreq ?>" placeholder="Status Request" readonly/>
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
