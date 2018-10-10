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
        <h2>Sample Request Traza - Admin Approval</h2>
        <p>
        
        <input type="text" id="reqid" placeholder="NIK Requestor" value="<?php echo $requestor->reqid ?>" readonly/>
        <div id="reqid"></div>
        <br>
        <textarea id="reqnik" cols="50" rows="5" placeholder="Isikan Pesan" ><?php echo $requestor->reqnik ?></textarea>
        <div id="reqnik"></div>
        </p>
        <p>
          <input type="button" class="btn btn-lg btn-primary" id="approve" value="Approve">
          <input type="button" class="btn btn-lg btn-primary" id="reject" value="Reject">
        
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


