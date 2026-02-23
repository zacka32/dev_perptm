<?php
// error_reporting(E_ALL ^ E_NOTICE);
session_start();
$userid    = $_SESSION['userid'];
$module = $_GET['module'];
include "config/fungsi_encryptdecrypt.php";
if (empty($_SESSION['userid'])){
  $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  echo"
        <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=index.php?url=$url><b>LOGIN</b></a></center>
  ";
}
else{
include "config/koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="favicon.ico">
   
<!-- SELESAI -->
 <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
 <!-- <link rel="stylesheet" href="bootstrap/css/bootstrap-toggle.min.css"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  
  <link rel="stylesheet" href="dist/css/css.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css"> 
  <!-- <link rel="stylesheet" href=" https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">  -->
  <link rel="stylesheet" href="dist/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css">
  <link rel="stylesheet" href="plugins/datatables/extensions/Responsive/css/dataTables.responsive.css">
  <link rel="stylesheet" href="plugins/datatables/extensions/FixedColumns/css/dataTables.fixedColumns.min.css">
  <!-- CHat -->
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <!-- <link type="text/css" rel="stylesheet" media="all" href="css/chat.css" /> -->
    
  <script src="dist/js/jquery-1.11.0.min.js"></script> 
   <script src="plugins/select2/select2.full.min.js"></script>
   <script type="text/javascript">
    $(function(){
      $(".select2").select2({
        width: '100%',
      });
    });
</script>
<!-- <script>
    $(document).idle({
        onIdle: function(){
            window.location="/logout.php";                
        },
        idle: 10000
    });
</script> -->
  <?php  if(isset($_SESSION['notif'])){
   $notif = $_SESSION['notif'];
   $type = $_SESSION['type']; 
   echo"
  <script type='text/javascript'>
            $(document).ready(function() {
                $.bootstrapGrowl('$notif',{
                  type: '$type',
                  delay: 2000,
                  offset: {from: 'top', amount: 50},
                  align: 'center', // ('left', 'right', or 'center')
                  width: 500,
                  allow_dismiss: true,
                  ele: 'body',
                  // stackup_spacing: 10,
                });
              });
          </script> ";
  unset($_SESSION['notif']);
  unset($_SESSION['type']);
}
?>
  
</head>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
  <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">Admin</span>
      <!-- logo for regular state and mobile devices -->
      <!-- <span class="logo-lg"><b>Futsal</b> Club</span> -->
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      
      </a>
      
      
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
                      
          </li>
          <li class="dropdown messages-menu">
        
            <a href="#" class="" onClick="window.location.reload()" data-toggle="dropdown" title="Refresh Page" data-tt="tooltip" data-placement="bottom">
              <i class="fa fa-fw fa-refresh" style="color:#18d418"></i>
              <span class="label label-success" ></span>
            </a>
            
          </li>
         
    
          <li class="dropdown user user-menu">
       
            <!-- <a target="_blank" href="albumkita.com" class="dropdown-toggle">
      <img src="foto_user/logo_album.png" class="user-image" alt="User Image">
                         <span class="hidden-xs">View Website</span> -->
            </a>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img width="60" src="png/Engineer.png" border=0 class="img-circle" alt="User Image" >
        </div>
        <div class="pull-left info">
          <p><?php echo "$_SESSION[namalengkap] "; ?></p>
          <!-- <p><?php echo "$_SESSION[cekip]"; ?></p> -->
          <a href="#"><i class="fa fa-circle text-success"></i>  <SCRIPT language=JavaScript>var d = new Date();
  var h = d.getHours();
  if (h < 11) { document.write('Awali dgn Senyum,'); }
  else { if (h < 15) { document.write('Sukses Selalu,'); }
  else { if (h < 19) { document.write('Tetap Semangat,'); }
  else { if (h <= 23) { document.write('Selamat malam,'); }
  }}}</SCRIPT>
 </a>
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
           <a href="media.php?module=home" class="#">
           <i class="fa fa-home text-red"></i>
           <span>Dashboard</span>
          
          </a>
          
        </li>
        <?php include "menu.php"; ?>
        
        <li>
          <a href="logout.php">
            
          <i class="fa fa-arrow-right text-red"></i>
          <!-- <img src='png/logout-icon.png' width='20'>&nbsp;&nbsp;&nbsp; -->
            <span>Logout</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
        
        
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
  <!-- <span class="to_top">Go to top</span> -->
  <?php include "content.php"; ?>
  
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 0.1 beta
    </div>
    <strong>Copyright &copy; 2025-2026 <a href="#">IT Griya Ilmu</a>.</strong> All rights
    reserved.
  </footer>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->
        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>
              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>
              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>
              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>
              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->
      </div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>
          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>
            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>
            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>
            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->
          <h3 class="control-sidebar-heading">Chat Settings</h3>
          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<div class="ajaxloader"><!-- Place at bottom of page --></div>
<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->
 <script type="text/javascript" src="dist/js/jquery.bootstrap-growl.min.js"></script>
<script src="plugins/select2/select2.full.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- <script src="bootstrap/js/bootstrap-toggle.min.js"></script> -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script src="plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/ckeditor/ckeditor.js"></script>
<script src="plugins/datatables/dataTables.buttons.min.js"></script>
<!-- <script src="plugins/datatables/jszip.min.js"></script>
<script src="plugins/datatables/pdfmake.min.js"></script> -->
<script src="plugins/datatables/vfs_fonts.js"></script>
<script src="plugins/datatables/buttons.html5.min.js"></script>
<link rel="stylesheet" href="plugins/datatables/buttons.dataTables.min.css">
<!-- <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script> -->
<!-- Tes pdf datatables -->
<script src="dist/js/dataTables.buttons.min.js"></script>
  <!-- <script src="dist/js/buttons.flash.min.js"></script>  -->
<script src="dist/js/jszip.min.js"></script>
<script src="dist/js/buttons.html5.min.js"></script>
<!-- <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js"></script>   -->
 <!-- Tes pdf datatables -->
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- 
<script src="plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes)
<script src="dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="bower_components/moment/moment.js"></script>
<!-- <script src="bower_components/fullcalendar/dist/fullcalendar.min.js"></script> -->
<script>
    $(document).ready(function() {
     
  $('#example1').DataTable({
    "responsive":true,
     "order": [[ 0, "desc" ]],
  }); 
});
</script>
<script type="text/javascript">
$(function(){
    $('.to_top').hide().on('click', function(){
        $('body,html').animate({scrollTop : 0}, 800);
    });
    $(window).on('scroll', function(){
        if($(this).scrollTop() > 50){
            $('.to_top').show();
        }else{
            $('.to_top').hide();
        }
    });
});
</script>
<script type="text/javascript">
  $('.simpanhtml').submit(function() {
      $("#savedt").attr("disabled", true);
      $(':button').prop('disabled', true);
  });
  $(".format_rupiah").on('keyup', function(){
    var n = parseInt($(this).val().replace(/\D/g,''),10);
    $(this).val(n.toLocaleString());
  });
 </script>
<style>
    .content-wrapper {
      min-height: 700px !important;
    }
    .skin-orange .main-header .navbar {
    background-color: #222d32 !important;
    }
    .skin-blue .main-header .navbar {
    background-color: #222d32 !important;
    }
</style>
 
</body>
</html>
 <?php
  }
  ?>