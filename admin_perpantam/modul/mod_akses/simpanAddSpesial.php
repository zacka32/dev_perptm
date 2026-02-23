<?php
   
session_start();
if (empty($_SESSION['userid']) AND empty($_SESSION['passuser'])){
  echo "<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel='stylesheet' href='bootstrap/css/bootstrap.css'>
    <link rel='stylesheet' href='dist/css/AdminLTE.css'>
    <link rel='stylesheet' href='dist/css/skins/_all-skins.min.css'>
    <center>Untuk mengakses modul, Anda harus login <br>";
       echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
    include "../../config/koneksi.php";
     include "../../config/fungsi_log.php";
    $userid=$_SESSION['userid'];
    $module="group";
    $act=$_GET['act'];
	
//   //  include "../../config/fungsi_hakakses.php";
	  date_default_timezone_set("Asia/Jakarta");
	  $jam=date("h:i:s a");
		if(!empty($_POST['action'])) {
			$m=mysql_query("select * from sit.detail_akses where id_akses='$_POST[id]' AND `action`='$_POST[action]'");
			$zs=mysql_fetch_row($m);
			if($zs > 0) {
				 
			  
			}else {
				tambahlog($userid,$module,'tambah module spesifik','BERHASIL');  
				
				$insert = mysql_query(" insert into sit.detail_akses (id_akses,action) values ('$_POST[id]','$_POST[action]')");
				 
			}
		}
                                               
                                        
                        
}
?>