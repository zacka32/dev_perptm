<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (empty($_SESSION['userid'])){
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
  include "../../config/fungsi_thumb.php";
//   include "../../mpdf60/mpdf.php";
// include "../../vendor/autoload.php";
date_default_timezone_set('Asia/Jakarta');
$tanggal=date('Y-m-d H:i:sa');
$tanggal2=date('Y-m-d');
$tgl_indo = tgl_indo(date('Y-m-d'));
$waktu=date('H:i:s');
$userid=$_SESSION['userid'];
$module=$_GET['module'];
$moduleAkses='ulasan_produk';
$act=$_GET['act'];
if ($module=='ulasan_produk' AND $act=='input'){
  if (hakakses($userid,$moduleAkses,'buat')) {
  	if($_POST['nama_ulasan_produk'] == '') {
		$_SESSION['notif'] = "Gagal Simpan (Tidak Ada yang disimpan)";
		$_SESSION['type'] = "danger";
		 header('location:../../media.php?module=ulasan_produk&act=tambah');
	} else {
		
		  	try{
		$db->beginTransaction();
		$lokasi_file    = $_FILES['image1']['tmp_name'];
		$tipe_file      = $_FILES['image1']['type'];
		$nama_file      = $_FILES['image1']['name'];
		$acak           = rand(1,99);
		$nama_file_unik = $acak.$nama_file; 
		Uploadulasan_produk($nama_file_unik);
		$query = $db->prepare("INSERT INTO ulasan_produk (
										nama_ulasan_produk,
										total_potongan, mulai, akhir,
										gambar,
										input_by,
										input_at
										) 
								VALUES(
									:nama_ulasan_produk, 
									'$_POST[total_potongan]', '$_POST[mulai]', '$_POST[akhir]', 
									'$nama_file_unik',
									'$userid',
									NOW()
				)");
                    
        $query->bindParam(':nama_ulasan_produk', $_POST['nama_ulasan_produk']);
			$query->execute();
			// insert detail
						
			$db->commit();
				 
			$_SESSION['notif']= "Data barhasil di tambahkan";
			$_SESSION['type'] = "success";
			echo " <script src='../../dist/js/jquery-1.11.0.min.js'></script> 
						
						<script type='text/javascript'>
							$.ajax({
	          					  url: '../../config/fungsi_log2.php',
						          type: 'POST',
						          data: 'userid=$userid&module=$module&aksi=$act&status=BERHASILtambahuser',
						     });
						     window.location.href='../../media.php?module=$module'
						</script>";
			// header('location:../../media.php?module=user&act=entrypo');
		} catch (Exception $e) {
		    $db->rollback();
		  
		    echo "$e";
	  	}
	}  // jika datang kosong
	//cek jika tidak punya akses
		 
  }else{
    echo "<script>alert(' Data Gagal Disimpan, Anda Tidak Memiliki Akses !');
           window.location.href='../../media.php?module=home'</script>";
  }
}

elseif ($module=='ulasan_produk' AND $act=='tampilkan_komentar'){
	$id 	= encrypt_decrypt('decrypt',$_GET['id']);
  
			$update = $db->prepare("UPDATE komentar SET l_status ='Y',
									
										update_user = ?,
										
										update_date = NOW() WHERE id = ?
										");
			$update->execute([$userid,$id]);
				// echo "tesr";
				 
				
			$_SESSION['notif']= "Data barhasil di update";
			$_SESSION['type'] = "success";
			echo " <script src='../../dist/js/jquery-1.11.0.min.js'></script> 
						
						<script type='text/javascript'>
							$.ajax({
	          					  url: '../../config/fungsi_log2.php',
						          type: 'POST',
						          data: 'userid=$userid&module=$module&aksi=$act&status=editulasan_produk',
						     });
						     window.location.href='../../media.php?module=$moduleAkses'
						</script>";
  
}
elseif ($module=='ulasan_produk' AND $act=='notampilkan_komentar'){
	$id 	= encrypt_decrypt('decrypt',$_GET['id']);
  
			$update = $db->prepare("UPDATE komentar SET l_status ='N',
									
										update_user = ?,
										
										update_date = NOW() WHERE id = ?
										");
			$update->execute([$userid,$id]);
				// echo "tesr";
				 
				
			$_SESSION['notif']= "Data barhasil di update";
			$_SESSION['type'] = "success";
			echo " <script src='../../dist/js/jquery-1.11.0.min.js'></script> 
						
						<script type='text/javascript'>
							$.ajax({
	          					  url: '../../config/fungsi_log2.php',
						          type: 'POST',
						          data: 'userid=$userid&module=$module&aksi=$act&status=editulasan_produk',
						     });
						     window.location.href='../../media.php?module=$moduleAkses'
						</script>";
  
}


elseif ($module=='ulasan_produk' AND $act=='hapusulasan_produk'){
	$query = $db->prepare("DELETE FROM ulasan_produk WHERE id_ulasan_produk='$_POST[id_auto]'");
	
	$query->execute();
		
} 



}  //if tidak punya akses user dan password
?>
