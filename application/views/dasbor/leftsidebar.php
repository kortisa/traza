<?php
$level = $this->session->userdata('level');
$status = $this->session->userdata('status');
if($status =='active' && $level == 'admin')
{
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo ucfirst($this->session->userdata('nik')); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
           <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Master Data</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>datajabatan"><i class="fa fa-level-up"></i>Position</a></li>
            <li><a href="<?php echo base_url() ?>datadepartemen"><i class="fa fa-level-up"></i>Department</a></li>
            <li><a href="<?php echo base_url() ?>datakaryawan"><i class="fa fa-group"></i> Employee</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="<?php echo base_url() ?>datapengguna">
            <i class="fa fa-user"></i> <span>Data Users</span>
             <span class="pull-right-container">
            </span>
          </a>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-shopping-cart"></i> <span>TA Data</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>datakodearea"><i class="fa fa-plus"></i>Area Code</a></li>
            <li><a href="<?php echo base_url() ?>datadestinasi"><i class="fa fa-plus"></i>Destination</a></li>
            <li><a href="<?php echo base_url() ?>databiayakonfigurasi"><i class="fa fa-plus"></i>Cost Configuration</a></li>
            <li><a href="<?php echo base_url() ?>datasistemwaktu"><i class="fa fa-plus"></i>Configuration</a></li>
            <li><a href="<?php echo base_url() ?>datapersetujuan"><i class="fa fa-binoculars"></i>Approval</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-tasks"></i> <span>Data Request</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../index.html"><i class="fa fa-plus"></i>Current Request</a></li>
            <li><a href="../../index2.html"><i class="fa fa-binoculars"></i>Cancel request</a></li>
            <li><a href="../../index.html"><i class="fa fa-plus"></i>Processed Request</a></li>
            <li><a href="../../index2.html"><i class="fa fa-binoculars"></i>Recently request</a></li>
          </ul>
        </li>


        <li class="treeview">
          <a href="#">
            <i class="fa fa-plane"></i> <span>Real Traveling</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../index.html"><i class="fa fa-plus"></i> Current Travels</a></li>
            <li><a href="../../index2.html"><i class="fa fa-binoculars"></i>Finished Travels</a></li>
          </ul>
        </li>
    </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

<?php
}
elseif(($status =='special' or $status =='active') && $level == 'operator')
{
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo ucfirst($this->session->userdata('nik')); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i><span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-tasks"></i> 
            <span>Request TRAZA</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>            
            </span>
          </a>
           <ul class="treeview-menu">
           <li class="active"><a href="<?php echo base_url() ?>permintaan"><i class="fa fa-file-o"></i>New Request</a></li>
            <li class="active"><a href="form.php"><i class="fa fa-file-o"></i>Current Request</a></li>
            <li class="active"><a href="#"><i class="fa fa-file"></i>History Request</a></li>
          </ul>
        </li>
          <li class="treeview">
          <a href="#">
            <i class="fa fa-plane"></i> 
            <span>Realization TRAZA</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>            
            </span>
          </a>
           <ul class="treeview-menu">
            <li class="active"><a href="#"><i class="fa fa-file-image-o"></i>Current Travel</a></li>
            <li class="active"><a href="#"><i class="fa fa-flag"></i>Finished Travel</a></li>
          </ul>
          </li>
           <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> 
            <span>Configuration</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>            
            </span>
          </a>
           <ul class="treeview-menu">
            <li class="active"><a href="#"><i class="fa fa-address-card"></i>Edit User </a></li>
            <li class="active"><a href="#"><i class="fa fa-address-card-o"></i>Edit Account</a></li>
          </ul>
          </li>
    </section>
    <!-- /.sidebar -->
  </aside>
  <?php
}
elseif($status =='active' && $level == 'manajer')
{
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo ucfirst($this->session->userdata('nik')); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i><span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-tasks"></i> 
            <span>Request TRAZA</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>            
            </span>
          </a>
           <ul class="treeview-menu">
           <li class="active"><a href="<?php echo base_url() ?>permintaan"><i class="fa fa-file-o"></i>New Request</a></li>
            <li class="active"><a href="form.php"><i class="fa fa-file-o"></i>Current Request</a></li>
            <li class="active"><a href="#"><i class="fa fa-file"></i>History Request</a></li>
          </ul>


            <li class="treeview">
            <a href="#">
              <i class="fa fa-check-square-o"></i> 
              <span>Approve TRAZA</span>
            </a>         
          </li>
       

          <li class="treeview">
          <a href="#">
            <i class="fa fa-plane"></i> 
            <span>Realization TRAZA</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>            
            </span>
          </a>
           <ul class="treeview-menu">
            <li class="active"><a href="#"><i class="fa fa-file-image-o"></i>Current Travel</a></li>
            <li class="active"><a href="#"><i class="fa fa-flag"></i>Finished Travel</a></li>
          </ul>
           <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> 
            <span>Configuration</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>            
            </span>
          </a>
           <ul class="treeview-menu">
            <li class="active"><a href="#"><i class="fa fa-address-card"></i>Edit User </a></li>
            <li class="active"><a href="#"><i class="fa fa-address-card-o"></i>Edit Account</a></li>
          </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <?php
}
elseif($status =='active' && $level == 'odgm')
{
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo ucfirst($this->session->userdata('nik')); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i><span>Dashboard</span>
          </a>
        </li>
        <ul class="treeview-menu">
            <li class="active"><a href="<?php echo base_url() ?>permintaan"><i class="fa fa-file-o"></i>New Request</a></li>
            <li class="active"><a href="form.php"><i class="fa fa-file-o"></i>Current Request</a></li>
            <li class="active"><a href="#"><i class="fa fa-file"></i>History Request</a></li>
          </ul>


            <li class="treeview">
            <a href="#">
              <i class="fa fa-check-square-o"></i> 
              <span>Approve TRAZA</span>
            </a>         
          </li>
       

          <li class="treeview">
          <a href="#">
            <i class="fa fa-plane"></i> 
            <span>Realization TRAZA</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>            
            </span>
          </a>
           <ul class="treeview-menu">
            <li class="active"><a href="#"><i class="fa fa-file-image-o"></i>Current Travel</a></li>
            <li class="active"><a href="#"><i class="fa fa-flag"></i>Finished Travel</a></li>
          </ul>
           <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> 
            <span>Configuration</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>            
            </span>
          </a>
           <ul class="treeview-menu">
            <li class="active"><a href="#"><i class="fa fa-address-card"></i>Edit User </a></li>
            <li class="active"><a href="#"><i class="fa fa-address-card-o"></i>Edit Account</a></li>
          </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <?php
}
else
{
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo ucfirst($this->session->userdata('nik')); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i><span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-check-square-o"></i><span>Approve TA</span>
          </a>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-plane"></i><span>Riwayat Approve</span>
          </a>
        </li>
    </section>
    <!-- /.sidebar -->
  </aside>
  <?php
}
?>

      