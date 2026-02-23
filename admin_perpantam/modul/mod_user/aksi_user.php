<?php
error_reporting(0);
session_start();
if (empty($_SESSION['userid']) ){
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
// include "../../vendor/autoload.php";
date_default_timezone_set('Asia/Jakarta');
$tanggal=date('Y-m-d H:i:sa');
$tanggal2=date('Y-m-d');
$tgl_indo = tgl_indo(date('Y-m-d'));
$waktu=date('H:i:s');
$userid=$_SESSION['userid'];
$module=$_GET['module'];
$moduleAkses='user';
$act=$_GET['act'];
if ($module=='user' AND $act=='input'){
  if (hakakses($userid,'user','buat')) {
  	if($_POST['userid'] == '' || $_POST['password'] == '' ) {
		$_SESSION['notif'] = "Gagal Simpan (Tidak Ada yang disimpan)";
		$_SESSION['type'] = "danger";
		 header('location:../../media.php?module=user&act=tambah');
	} else {

		// $lokasi_file    = $_FILES['image1']['tmp_name'];
		// $tipe_file      = $_FILES['image1']['type'];
		// $nama_file      = $_FILES['image1']['name'];
		// $acak           = rand(1,99);
		// $nama_file_unik = $acak.$nama_file; 
		// UploadBanner($nama_file_unik);
		
	        // $hashed_password = password_hash($password);
			$password=password_hash($_POST['password'], PASSWORD_DEFAULT);

			$query = $db->prepare("INSERT INTO users (userid,
											`password`,
											nama_lengkap,
											nama_panggilan,
											no_hp,
											tgl_lahir,
											administrator,
											email,
											entry_user,
											entry_date
											) 
									VALUES('$_POST[userid]',
										'$password',
										:nama_lengkap,
										'$_POST[nama_panggilan]',
										'$_POST[no_hp]',
										'$_POST[tgl_lahir]',
									    'Y',
										'$_POST[email]',
										'$userid',
										NOW()
                    )");
                    
      		$query->bindParam(':nama_lengkap', $_POST['nama_lengkap']);
			$query->execute();
			// insert detail
						
			if($query) {
				echo  "tersimpan";
			} else {
				echo "<script>alert(' Data Gagal Disimpan, Anda Tidak Memiliki Akses !');
				window.location.href='../../media.php?module=home'</script>";
			}
			// header('location:../../media.php?module=user&act=entrypo');
		
	}  // jika datang kosong
	//cek jika tidak punya akses
		 
  }else{
    echo "<script>alert(' Data Gagal Disimpan, Anda Tidak Memiliki Akses !');
           window.location.href='../../media.php?module=home'</script>";
  }
}
elseif ($module=='user' AND $act=='update'){
  if (hakakses($userid,'user','edit')) {
	  	try{
    $db->beginTransaction();	
    
			$new_pass = $_POST['new_password'] ?? '';

$nama_lengkap = $_POST['nama_lengkap'];
$no_hp = $_POST['no_hp'];
$email = $_POST['email'];
$nama_panggilan = $_POST['nama_panggilan'];
$l_status = $_POST['l_status'];
$tgl_lahir = $_POST['tgl_lahir'];
$userupdate = $_POST['userid'];

if (!empty($new_pass)) {
    // ---- UPDATE DENGAN PASSWORD ----
    $hashed_password = password_hash($new_pass, PASSWORD_DEFAULT);

					$query = $db->prepare("
						UPDATE users SET 
							nama_lengkap = ?,
							password = ?,
							no_hp = ?,
							email = ?,
							nama_panggilan = ?,
							l_status = ?,
							tgl_lahir = ?,
							update_user = ?,
							update_date = NOW()
						WHERE userid = ?
					");

					$params = [
						$nama_lengkap,
						$hashed_password,
						$no_hp,
						$email,
						$nama_panggilan,
						$l_status,
						$tgl_lahir,
						$userupdate,
						$userupdate
					];

				} else {
					// ---- UPDATE TANPA PASSWORD ----
					$query = $db->prepare("
						UPDATE users SET 
							nama_lengkap = ?,
							no_hp = ?,
							email = ?,
							nama_panggilan = ?,
							l_status = ?,
							tgl_lahir = ?,
							update_user = ?,
							update_date = NOW()
						WHERE userid = ?
					");

					$params = [
						$nama_lengkap,
						$no_hp,
						$email,
						$nama_panggilan,
						$l_status,
						$tgl_lahir,
						$userupdate,
						$userupdate
					];
				}

				$query->execute($params);
				$db->commit();

				
				 
				
			$_SESSION['notif']= "Data barhasil di update";
			$_SESSION['type'] = "success";
			echo " <script src='../../dist/js/jquery-1.11.0.min.js'></script> 
						
						<script type='text/javascript'>
							$.ajax({
	          					  url: '../../config/fungsi_log2.php',
						          type: 'POST',
						          data: 'userid=$userid&module=$module',
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
           window.location.href='../../media.php?module=$module&act=editproduksi'</script>";
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
           window.location.href='../../media.php?module=$module&act=editproduksi'</script>";
  }
}
elseif ($module=='user' AND $act=='cek_user'){

	header('Content-Type: application/json'); // Pastikan respons adalah JSON

		$id     = $_POST['userid'];
		$no_hp  = $_POST['no_hp'];
		$email  = $_POST['email'];

		$z  = $db->prepare("SELECT count(*) as jml FROM users WHERE userid=:id");
		$z->bindParam(':id', $id);
		$z->execute();
		$c  = $z->fetch();

		$z1 = $db->prepare("SELECT count(*) as jml FROM users WHERE no_hp=:no_hp");
		$z1->bindParam(':no_hp', $no_hp);
		$z1->execute();
		$c1 = $z1->fetch();

		$z2 = $db->prepare("SELECT count(*) as jml FROM users WHERE email=:email");
		$z2->bindParam(':email', $email);
		$z2->execute();
		$c2 = $z2->fetch();

		$response = [];

		if ($c['jml'] > 0) {
			$response['status'] = "exists";
			$response['field']  = "userid";
		} elseif ($c1['jml'] > 0) {
			$response['status'] = "exists";
			$response['field']  = "no_hp";
		} elseif ($c2['jml'] > 0) {
			$response['status'] = "exists";
			$response['field']  = "email";
		} else {
			$response['status'] = "ok";
		}

		// Kirimkan hasil dalam format JSON
		echo json_encode($response);
		exit;
		}
elseif ($module=='user' AND $act=='kamar'){ 
	echo "<option value=''>Pilih Kamar</option>";
	$t=$db->prepare("SELECT * FROM master_kamar WHERE id_gedung='$_POST[id_gedung]' AND pemilik=' '");
	$t->execute();
	while ($row = $t->fetch()) {
		echo "<option value='" . $row['id_kamar'] . "'>" . $row['nama_kamar'] . "</option>";
	}
}
elseif ($module=='user' AND $act=='tambahkamar'){ 
	$query = $db->prepare("UPDATE master_kamar SET 
	pemilik = '$_POST[userid]',
	updated_user = '$userid',
	updated_date = NOW() 
	WHERE id_kamar='$_POST[kamar]'");
	$query->execute();
	$_SESSION['notif']= "Data barhasil di update";
			$_SESSION['type'] = "success";
}
elseif ($module=='user' AND $act=='hapustemp'){
	$query = $db->prepare("DELETE FROM user_temp WHERE id_auto='$_POST[id_auto]'");
	
	$query->execute();
		
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