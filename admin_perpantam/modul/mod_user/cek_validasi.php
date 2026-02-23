<?php
session_start();
if (empty($_SESSION['userid']) AND empty($_SESSION['passuser'])){
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
  include "../../config/fungsi_rupiah.php";


	$id   = $_POST['userid'];
	$no_hp   = $_POST['no_hp'];
	$email   = $_POST['email'];
        
	$z = $db->prepare("SELECT count(*) jml FROM users WHERE userid='$id' ");
	$z->execute();
	$c = $z->fetch();

	$z1 = $db->prepare("SELECT count(*) jml FROM users WHERE no_hp='$no_hp' ");
	$z1->execute();
	$c1 = $z1->fetch();

	$z2 = $db->prepare("SELECT count(*) jml FROM users WHERE email='$email' ");
	$z2->execute();
	$c2 = $z2->fetch();


	if($c['jml'] > 0 ){
		echo "userid";		
	}elseif($c1['jml'] > 0 ){
		echo "nohp";		
	}
	elseif($c2['jml'] > 0 ){
		echo "email";		
	}else 
	 {
		echo "ok";
	}

}



}  //if tidak punya akses user dan password
?>
