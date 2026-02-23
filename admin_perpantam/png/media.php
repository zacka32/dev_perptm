<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

$nik    = $_SESSION['nik'];
$module = $_GET['module'];

if (empty($_SESSION['nik']) AND empty($_SESSION['passuser'])){
  $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  echo "<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- Bootstrap 3.3.5 -->
  <link rel='stylesheet' href='bootstrap/css/bootstrap.css'>
  <!-- Font Awesome -->
    <!-- Theme style -->
  <link rel='stylesheet' href='dist/css/AdminLTE.css'>
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
 <link rel='stylesheet' href='dist/css/skins/_all-skins.min.css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=index.php?url=$url><b>LOGIN</b></a></center>";
}
else{
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIT Immortal Group</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="shortcut icon" href="favicon2.ico">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  <!-- Font Awesome -->
    <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
 <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="js/bootstrap-datetimepicker.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
  <!-- DataTables -->
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  
  <script src="plugins/html5shiv.min.js"></script>
  <script src="js/respond.min.js"></script>
  <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="jquery-ui.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.5 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts 
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
-->
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="js/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="js/bootstrap-datetimepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>
<!-- Table -->


<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script src="plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<link rel="stylesheet" href="plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.css">
<link rel="stylesheet" href="plugins/datatables/extensions/Responsive/css/dataTables.responsive.css">
<link rel="stylesheet" href="plugins/datatables/jquery.dataTables.min.css">
<script src="plugins/datatables/dataTables.buttons.min.js"></script>
<script src="plugins/datatables/jszip.min.js"></script>
<script src="plugins/datatables/pdfmake.min.js"></script>
<script src="plugins/datatables/vfs_fonts.js"></script>
<script src="plugins/datatables/buttons.html5.min.js"></script>
<link rel="stylesheet" href="plugins/datatables/buttons.dataTables.min.css">

<script src='js/highcharts.js'></script>
<script src='js/modules/exporting.js'></script>

<script type='text/javascript' src='js/typeahead.min.js'></script>

<link rel="stylesheet" type="text/css" media="screen" href="resources/css/smoothness/jquery-ui-1.10.1.custom.css"/>
<link rel="stylesheet" type="text/css" media="screen" href="resources/css/smoothness/jquery.ui.combogrid.css"/>
<script type="text/javascript" src="resources/plugin/jquery.ui.combogrid-1.6.3.js"></script>




</head>
<script type="text/javascript">
$(window).load(function() {
	$(".loader").fadeOut("slow");
})
</script>	
<body class="hold-transition skin-blue sidebar-mini">
<div class="loader"></div>
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="media.php?module=home" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SIT</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SIT</b> Immortal Group</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="" data-toggle="offcanvas" role="button" ><img src='png/Very-Basic-Menu-icon.png' width='20'>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        <!-- Menu Header 
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i><img src='png/pngSettings-48.png.png' width='20'></a>
          </li>
        -->
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="png/Office-Customer-Male-Light-icon.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo "$_SESSION[namalengkap]"; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li><a href=?module=home><img src='png/Library-48.png' width='25'>&nbsp;&nbsp;&nbsp; <span>Home</span></a></li>
        
            <?php include"menu.php";  ?>
        
        <li><a href=logout.php?nik=<?php echo $_SESSION['nik']; ?>><img src='png/Apps-session-logout-icon.png' width='25'>&nbsp;&nbsp;&nbsp; <span>Logout</span></a></li>
      </ul>
    </section>
  </aside>

  <div class="content-wrapper" id="test1" >
  <section class="content">
    
    <?php include"content.php";  ?>

  </section>
  </div>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2015-2016 <a href="#">PT. Immortal Group </a>.</strong> All rights
    reserved.
</footer>
</div>

</body>
</html>
<script>
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#lapsales tfoot th').each( function (i) {
        var title = $('#lapsales thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="'+title+'" data-index="'+i+'" />' );
    } );
  
    // DataTable
    var table = $('#lapsales').DataTable( {
        "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "scrollX": true,
      
      "lengthMenu": [[10, 25, 50, 100, 500], [10, 25, 50, 100, 500]],
      "aaSorting": [],
      dom: 'BRfrtlip',
        buttons: [
        {
            extend: 'excel',
            text: 'Export to Excel',
            orientation: 'landscape',
            title: 'Laporan Sales',
            pageSize: 'A4',
            exportOptions: {
                modifier: {
                    page: 'current'

                }
            }
        }
        ]
      
    } );
 
    // Filter event handler
    $( table.table().container() ).on( 'keyup', 'tfoot input', function () {
        table
            .column( $(this).data('index') )
            .search( this.value )
            .draw();
    });
     
} );
</script>
<script>
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#wp tfoot th').each( function (i) {
        var title = $('#wp thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="'+title+'" data-index="'+i+'" />' );
    } );
  
    // DataTable
    var table = $('#wp').DataTable( {
        "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      
      
      "scrollX": true,
      "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
      "aaSorting": [],
      dom: 'BRfrtlip',
        buttons: [
        {
            extend: 'excel',
            text: 'Export to Excel',
            orientation: 'landscape',
            title: 'Laporan MCL',
            pageSize: 'A4',
            exportOptions: {
                modifier: {
                    page: 'current'

                }
            }
        }
        ]
      
    } );
 
    // Filter event handler
    $( table.table().container() ).on( 'keyup', 'tfoot input', function () {
        table
            .column( $(this).data('index') )
            .search( this.value )
            .draw();
    } );
} );
</script>
<script>
  $(function () {
    $('#example1').DataTable({
      "paging": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "scrollX": true,
      "aaSorting": [],
      "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
    });
    
    

  });
</script>
<script>
  $(function () {
    $('#example3').DataTable({
      "paging": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "scrollX": true,
      "aaSorting": [],
      "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
    });
    
    

  });
</script>
<script>
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#pelolosan tfoot th').each( function (i) {
        var title = $('#pelolosan thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="'+title+'" data-index="'+i+'" />' );
    } );
  
    // DataTable
    var table = $('#pelolosan').DataTable( {
        "paging": true,
      "searching": true,
      "ordering": true,
      "info": true,      
      "scrollX": true,
      "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
      "aaSorting": []
      
    } );
 
    // Filter event handler
    $( table.table().container() ).on( 'keyup', 'tfoot input', function () {
        table
            .column( $(this).data('index') )
            .search( this.value )
            .draw();
    } );
} );
</script>

<script>
jQuery.fn.dataTable.Api.register( 'sum()', function ( ) {
    return this.flatten().reduce( function ( a, b ) {
        if ( typeof a === 'string' ) {
            a = a.replace(/[^\d.-]/g, '') * 1;
        }
        if ( typeof b === 'string' ) {
            b = b.replace(/[^\d.-]/g, '') * 1;
        }
 
        return a + b;
    }, 0 );
} );
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    $(".select3").select2();
   })
</script>
<script type="text/javascript">
$(document).ready(function(){

    $( "#nama_lengkap" ).combogrid({
    url: 'search2.php',
    debug:true,
    //replaceNull: true,
    colModel: [{'columnName':'C_CUSNO','width':'20','label':'CUSNO'},{'columnName':'C_CUNAM','width':'40','label':'NAMA CUSTOMER'}],
    select: function( event, ui ) {
      $( "#nama_lengkap" ).val( ui.item.C_CUNAM );
      $( "#C_NIP" ).val( ui.item.C_CUSNO );
      return false;
    }
  });
});
</script>
<style>
    .content-wrapper {
      min-height: 0px !important;
    }
</style>
<?php
}
?>
