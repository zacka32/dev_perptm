<?php
error_reporting(0);
session_start();
if (empty($_SESSION['nik']) AND empty($_SESSION['passuser'])){
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
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/koneksi.php";
include "../../config/fungsi_hakakses.php";
include "../../config/fungsi_log.php";
include "../../config/fungsi_encryptdecrypt.php";
include "../../config/fungsi_indotgl.php";


date_default_timezone_set('Asia/Jakarta');
$tanggal=date('Y-m-d H:i:sa');
$tanggal2=date('Y-m-d');
$waktu=date('H:i:s');
$nik=$_SESSION['nik'];
$module=$_GET['module'];
$moduleAkses='home';
$act=$_GET['act'];

if ($module=='home' AND $act=='chat'){

		$query = $db->prepare("INSERT INTO keluhan(
											  dari,
											  dari_nama,
											  untuk,
											  untuk_nama,
											  content,
											  waktu,
											  `type`
											  ) 
									  VALUES(
									  		'$_POST[dari]',
									  		 :namalengkap,
									  		'$_POST[untuk]',
									  		 'Administrator',
											 '$_POST[content]',
											 NOW(),
											 '$_POST[type]'
											)");
			
		
		$query->bindParam(':namalengkap', $_SESSION['namalengkap']);
		$query->execute();
		echo " <script src='../../dist/js/jquery-1.11.0.min.js'></script> 
				<script type='text/javascript'>
				  document.location.href = '../../media.php?module=home'; 
				</script>";


		$_SESSION['notif']= "Berhasil dikirim";
		$_SESSION['type'] = "success";
		header('location:../../media.php?module=home');
		 
}


elseif ($module=='home' AND $act=='tambahtemp'){

	}
	
}  //if tidak punya akses user dan password
?>
