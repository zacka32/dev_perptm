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
$moduleAkses='profile';
$act=$_GET['act'];
if ($module=='profile' AND $act=='input'){
  
}
elseif ($module=='profile' AND $act=='update'){
  if (hakakses($userid,$moduleAkses,'edit')) {  
			// $C_GOLCODE=$_POST['C_GOLCODE'];
		$gambar = $_POST['gambar'];
		if (empty($gambar)){
			$update = $db->prepare("UPDATE `profile` SET
										judul = '$_POST[judul]',
										deskripsi = '$_POST[deskripsi]', 
										deskripsi2 = '$_POST[deskripsi2]', 
										tujuan = '$_POST[tujuan]',
										fungsi = '$_POST[fungsi]',
										harmonis = '$_POST[harmonis]',
										kesejahteraan = '$_POST[kesejahteraan]',
										kolaborasi = '$_POST[kolaborasi]',
										advokasi = '$_POST[advokasi]',
										lokasi_google = '$_POST[url]', 
										no_telp = '$_POST[no_telp]', 
										email = '$_POST[email]', 
										alamat = '$_POST[alamat]', 
										updated_user = '$userid',
										updated_date = NOW() WHERE id_profile = '$_POST[id_profile]'
										");
		} else {
			$update = $db->prepare("UPDATE `profile` SET
										gambar='$gambar',
										judul = '$_POST[judul]',
										deskripsi = '$_POST[deskripsi]', 
										deskripsi2 = '$_POST[deskripsi2]', 
										tujuan = '$_POST[tujuan]',
										fungsi = '$_POST[fungsi]',
										harmonis = '$_POST[harmonis]',
										kesejahteraan = '$_POST[kesejahteraan]',
										kolaborasi = '$_POST[kolaborasi]',
										advokasi = '$_POST[advokasi]',
										lokasi_google = '$_POST[url]', 
										no_telp = '$_POST[no_telp]', 
										email = '$_POST[email]', 
										alamat = '$_POST[alamat]', 
										updated_user = '$userid',
										updated_date = NOW() WHERE id_profile = '$_POST[id_profile]'
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
						          data: 'userid=$userid&module=$module&aksi=$act&status=editprofile',
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
           window.location.href='../../media.php?module=$module&act=profile'</script>";
  }
}
elseif ($module=='profile' AND $act=='update_sosmed'){
  if (hakakses($userid,$moduleAkses,'edit')) {  
		
			$update = $db->prepare("UPDATE `profile` SET
										no_wa = '$_POST[no_wa]',
										link_youtube = '$_POST[link_youtube]', 
										link_facebook = '$_POST[link_facebook]', 
										link_ig = '$_POST[link_ig]', 
										link_twitter = '$_POST[link_twitter]', 
										link_tiktok = '$_POST[link_tiktok]', 
										updated_user = '$userid',
										updated_date = NOW() WHERE id_profile = '$_POST[id_profile]'
										");
		   
     		
			$update->execute();
				// echo "tesr";
				 
				
			$_SESSION['notif']= "Data barhasil di update";
			$_SESSION['type'] = "success";
			echo " <script src='../../dist/js/jquery-1.11.0.min.js'></script> 
						
						<script type='text/javascript'>
							$.ajax({
	          					  url: '../../config/fungsi_log2.php',
						          type: 'POST',
						          data: 'userid=$userid&module=$module&aksi=$act&status=editprofile',
						     });
						     window.location.href='../../media.php?module=$moduleAkses&act=edit_sosmed'
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
           window.location.href='../../media.php?module=$module&act=profile'</script>";
  }
}
elseif ($module=='user' AND $act=='hapususer'){
  if (hakakses($userid,'user','hapus')) {
  	if($_POST['user_id'] == '' ) {
		$_SESSION['notif'] = "Data tidak berhasil di hapus";
		$_SESSION['type'] = "danger";
		 header('location:../../media.php?module=user');
	}else{
	  	try{
		$db->beginTransaction();	 	
			$user_id=$_POST['user_id'];
			
			$query = $db->prepare("UPDATE user_header SET 
											l_status = 'D',
											update_user = '$userid',
											update_date = NOW() 
											WHERE user_id='$_POST[user_id]'");
						
			$query->execute();
			
			$db->commit();
				
				 
				
			$_SESSION['notif']= "Data barhasil di update";
			$_SESSION['type'] = "success";
			echo " <script src='../../dist/js/jquery-1.11.0.min.js'></script> 
						
						<script type='text/javascript'>
							$.ajax({
	          					  url: '../../config/fungsi_log2.php',
						          type: 'POST',
						          data: 'userid=$userid&module=$module&aksi=$act&status=edituser',
						     });
						     window.location.href='../../media.php?module=user'
						</script>";
		} catch (Exception $e) {
		    $db->rollback();
		  
		    echo " <script src='../../dist/js/jquery-1.11.0.min.js'></script> 
						<script type='text/javascript'>
						$.ajax({
          					  url: '../../config/fungsi_log2.php',
					          type: 'POST',
					          data: 'userid=$userid&module=$module&aksi=$act&status=gagaledit',
					     })
						</script>";
		    echo "$e";
	  	}
	} // if validasi
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
           window.location.href='../../media.php?module=$module'</script>";
  }
}
elseif ($module=='user' AND $act=='tambahtemp'){
	if($_POST['bahan_id'] == '' || $_POST['qty'] == '' ) {
			echo "data tidak bisa di simpan gagal";
	} else {
	  	try{
			
		$db->beginTransaction();
		
			$query = $db->prepare("INSERT INTO user_temp(
											  bahan_id,
											  onhand_stok,
											  qty,
											  entry_user,
											  entry_date
											  ) 
									  VALUES(
									         '$_POST[bahan_id]',
											 '$_POST[onhand_stok]',
											 '$_POST[qty]',
											 '$userid',
											  NOW()
											  )");
			
			$query->execute();
			
			$db->commit();
			echo "berhasil";
		} catch (Exception $e) {
		    $db->rollback();
		    echo "$e";
	  	}
	}  // jika datang kosong
	//cek jika tidak punya akses
}
elseif ($module=='user' AND $act=='hapustemp'){
	$query = $db->prepare("DELETE FROM user_temp WHERE id_auto='$_POST[id_auto]'");
	
	$query->execute();
		
} 
elseif ($module=='user' AND $act=='approvalpo'){
	$no_po = encrypt_decrypt('decrypt',$_GET['id']);
	  	try{
		$db->beginTransaction();
		
			$query = $db->prepare("UPDATE user_header SET 
											  l_status   =  'C',
											  update_user = '$userid',
											  update_date = NOW() WHERE user_id='$no_po'");	
			$query->execute();
			$_SESSION['notif']= "Data barhasil di Approval";
			$_SESSION['type'] = "success";	
			$db->commit();
				echo " <script src='../../dist/js/jquery-1.11.0.min.js'></script> 	
						<script type='text/javascript'>
							$.ajax({
	          					  url: '../../config/fungsi_log2.php',
						          type: 'POST',
						          data: 'userid=$userid&module=$module&aksi=$act&status=approvalpo',
						     });
						     window.location.href='../../media.php?module=user&act=approval'
						</script>";
				 
				
		} catch (Exception $e) {
		    $db->rollback();
		  
		    echo " <script src='../../dist/js/jquery-1.11.0.min.js'></script> 
						<script type='text/javascript'>
						  $(document).ready(function() {
						$.ajax({
          					  url: '../../config/fungsi_log2.php',
					          type: 'POST',
					          data: 'userid=$userid&module=$module&aksi=$act&status=Gagalapprovalpo',
					     })
						});
						</script>";
		    echo "$e";
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
