<?php
error_reporting(0);
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
$moduleAkses='event';
$act=$_GET['act'];
if ($module=='event' AND $act=='input'){
  if (hakakses($userid,$moduleAkses,'buat')) {
  	if($_POST['gambar'] == '') {
		$_SESSION['notif'] = "Gagal Simpan (Tidak Ada yang disimpan)";
		$_SESSION['type'] = "danger";
		 header('location:../../media.php?module=event&act=tambah');
	} else {
		
		  	try{
		$db->beginTransaction();

		$gambar = $_POST['gambar'];

		$query = $db->prepare("INSERT INTO event (
		judul,
			deskripsi,
			gambar,
			mulai,
			akhir,
			created_user,
			created_date
		) VALUES (
			:title,
			:deskripsi,
			:gambar,
			:mulai,
			:akhir,
			:user,
			NOW()
		)");

		$query->execute([
			':title' => $_POST['title'],
			':deskripsi' => $_POST['deskripsi'],
			':gambar' => $gambar,
			':mulai' => $_POST['mulai'],
			':akhir' => $_POST['akhir'],
			':user' => $userid
		]);

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
elseif ($module=='event' AND $act=='update'){
  if (hakakses($userid,$moduleAkses,'edit')) {  
	$gambar = $_POST['gambar'];
		
		if (empty($gambar)){
			$update = $db->prepare("UPDATE event SET
										judul = '$_POST[judul]',
										deskripsi = '$_POST[deskripsi]',
										mulai = '$_POST[mulai]',
										akhir = '$_POST[akhir]', 
										updated_user = '$userid',
										updated_date = NOW() WHERE id_auto = '$_POST[id_auto]'
										");
		} else {
			$update = $db->prepare("UPDATE event SET
										judul = '$_POST[judul]',
										deskripsi = '$_POST[deskripsi]',
										mulai = '$_POST[mulai]',
										akhir = '$_POST[akhir]', 
										gambar = '$gambar',
										updated_user = '$userid',
										updated_date = NOW() WHERE id_auto = '$_POST[id_auto]'
										");
		}        
     		
			$update->execute();
				// echo "tesr";
				 
				
			$_SESSION['notif']= "Data barhasil di update";
			$_SESSION['type'] = "success";
			echo " <script src='../../dist/js/jquery-1.11.0.min.js'></script> 
						
						<script type='text/javascript'>
							$.ajax({
	          					  url: '../../config/fungsi_log2.php',
						          type: 'POST',
						          data: 'userid=$userid&module=$module&aksi=$act&status=editevent',
						     });
						     window.location.href='../../media.php?module=$moduleAkses'
						</script>";
  }else{
     echo " <script src='../../dist/js/jquery-1.11.0.min.js'></script> 
						<script type='text/javascript'>
						$.ajax({
          					  url: '../../config/fungsi_log2.php',
					          type: 'POST',
					          data: 'userid=$userid&module=$module&aksi=$act&status=gagaledit',
					     })
						</script>";
    echo "<script>alert(' Data Gagal Disimpan, Anda Tidak Memiliki Akses !');
           window.location.href='../../media.php?module=$module&act=event'</script>";
  }
}
elseif ($module=='event' AND $act=='hapusevent'){
  
	  	try{
		$db->beginTransaction();	 	
						
			$query = $db->prepare("DELETE FROM event WHERE id_auto='$_POST[id_auto]'");
											
			$query->execute();
			
			$db->commit();
							 
			$_SESSION['notif']= "Data barhasil di hapus";
			$_SESSION['type'] = "success";
			echo "berhasil";
		} catch (Exception $e) {
		    $db->rollback();
		  
		   echo "gagal";
	  	}
	
 
}

    elseif ($module=='user' AND $act=='showdata'){
				  
      if (isset($_REQUEST['id'])) {
        $id   = $_POST['id'];
        
        $tampil = $db->prepare("SELECT * FROM akses WHERE userid='$id'");
        $tampil->execute();
        
        $no     = 1;
          
      
          echo "  
      
              <table id='example21' class='table table-bordered table-striped'>
              <thead>
                <th>No</th>
              <th>Modul</th>
              <th></th>
                  <th></th>
            </thead>
            <tbody>";                  
          while($s=$tampil->fetch()){
           
            echo "<tr>
                <td width=10px>$no</td>
                <td>$s[modul]</td>
                <td></td>
                <td></td>
                </tr>";
            $no++;
        }
        echo "</tbody>
            </table>
            ";
         
        }     
      }


}  //if tidak punya akses user dan password
?>