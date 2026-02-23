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
    $module="kodegol";
    $act=$_GET['act'];
//   //  include "../../config/fungsi_hakakses.php";
  date_default_timezone_set("Asia/Jakarta");
  $jam=date("h:i:s a");
	
				$lihat = $_POST['lihat'];
				$buat = $_POST['buat'];
				$edit = $_POST['edit'];
				
				$hapus = $_POST['hapus'];
				
				$ID_AKSES=$_POST['ID_AKSES'];
				$count=count($_POST['ID_AKSES']);
			
				$insert = $db->prepare("UPDATE akses SET 
														  
														  `lihat` = '$lihat',
														  `buat` = '$buat', 
														  `edit` = '$edit',
														 
														  `hapus` = '$hapus',
														  `dt_lastupdate` = NOW(),
														  `user_id` = '$userid'
													WHERE `id` = '$_POST[id]'");   

$insert->execute();
        //   tambahlog($userid,$module,'Edit Akses','BERHASIL');                                                    
                                        
                        
}
?>