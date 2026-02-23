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
$moduleAkses='banner';
$act=$_GET['act'];
if ($module=='banner' AND $act=='input'){
  if (hakakses($userid,$moduleAkses,'buat')) {
  	if($_POST['nama_banner'] == '') {
		$_SESSION['notif'] = "Gagal Simpan (Tidak Ada yang disimpan)";
		$_SESSION['type'] = "danger";
		 header('location:../../media.php?module=banner&act=tambah');
	} else {
		
		  	try{
		$db->beginTransaction();
		$gambar = $_POST['gambar'];
		$query = $db->prepare("INSERT INTO banner (
										nama_banner,
										posisi,
										teks1, teks2, teks3,
										gambar,
										created_user,
										created_date
										) 
								VALUES(
									:nama_banner, 
									:posisi,
									:txt1, :txt2, :txt3,
									:gambar,
									:created_user,
									NOW()
				)");
                    
      $query->bindParam(':nama_banner', $_POST['nama_banner']);
			$query->bindParam(':posisi', $_POST['posisi']);
			$query->bindParam(':txt1', $_POST['font_atas']);
			$query->bindParam(':txt2', $_POST['font_tengah']);
			$query->bindParam(':txt3', $_POST['font_bawah']);
			$query->bindParam(':gambar', $gambar);
			$query->bindParam(':created_user', $userid);
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
elseif ($module=='banner' AND $act=='update'){
  if (hakakses($userid,$moduleAkses,'edit')) {  
			$gambar = $_POST['gambar'];
		if (empty($gambar)){
			$update = $db->prepare("UPDATE banner SET
										nama_banner = '$_POST[nama_banner]',
										l_status = '$_POST[l_status]',
										teks1 = '$_POST[font_atas]',
										teks2 = '$_POST[font_tengah]',	
										teks3 = '$_POST[font_bawah]',
										posisi='$_POST[posisi]',
										updated_user = '$userid',
										updated_date = NOW() WHERE id_banner = '$_POST[id_banner]'
										");
		} else {
			$update = $db->prepare("UPDATE banner SET
										nama_banner = '$_POST[nama_banner]',
										l_status = '$_POST[l_status]',
										teks1 = '$_POST[font_atas]',
										teks2 = '$_POST[font_tengah]',	
										teks3 = '$_POST[font_bawah]',
										gambar='$gambar',
										posisi='$_POST[posisi]',
										updated_user = '$userid',
										updated_date = NOW() WHERE id_banner = '$_POST[id_banner]'
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
						          data: 'userid=$userid&module=$module&aksi=$act&status=editbanner',
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
           window.location.href='../../media.php?module=$module&act=banner'</script>";
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
