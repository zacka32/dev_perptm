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
$moduleAkses='struktur_organisasi';
$act=$_GET['act'];
if ($module=='struktur_organisasi' AND $act=='input'){
  if (hakakses($userid,$moduleAkses,'buat')) {
  	if($_POST['foto'] == '') {
		$_SESSION['notif'] = "Gagal Simpan (Tidak Ada yang disimpan)";
		$_SESSION['type'] = "danger";
		 header('location:../../media.php?module=struktur_organisasi&act=tambah');
	} else {
		
		  	try{
		$db->beginTransaction();

		$foto = $_POST['foto'];

		$query = $db->prepare("INSERT INTO struktur_organisasi (
		nama,
			jabatan,
			foto,
			parent_id,
			created_at
		) VALUES (
			:nama,
			:jabatan,
			:foto,
			:parent_id,
			NOW()
		)");

		$query->execute([
			':nama' => $_POST['nama'],
			':jabatan' => $_POST['jabatan'],
			':foto' => $foto,
			':parent_id' => $_POST['parent_id'],
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
elseif ($module=='struktur_organisasi' AND $act=='update'){
  if (hakakses($userid,$moduleAkses,'edit')) {  
	$foto = $_POST['foto'];
		
		if (empty($foto)){
			$update = $db->prepare("UPDATE struktur_organisasi SET
										nama = '$_POST[nama]',
										jabatan = '$_POST[jabatan]',
										parent_id = '$_POST[parent_id]',
										created_at = NOW() WHERE id = '$_POST[id]'
										");
		} else {
			$update = $db->prepare("UPDATE struktur_organisasi SET
										nama = '$_POST[nama]',
										jabatan = '$_POST[jabatan]',
										parent_id = '$_POST[parent_id]',
										foto = '$foto',
										created_at = NOW() WHERE id = '$_POST[id]'
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
						          data: 'userid=$userid&module=$module&aksi=$act&status=editstruktur_organisasi',
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
           window.location.href='../../media.php?module=$module&act=struktur_organisasi'</script>";
  }
}
elseif ($module=='struktur_organisasi' AND $act=='hapusstruktur_organisasi'){
  
	
		try {

    $db->beginTransaction();

    $id = $_POST['id'];

    // cek apakah punya bawahan
    $cek = $db->prepare("SELECT COUNT(*) FROM struktur_organisasi WHERE parent_id = ?");
    $cek->execute([$id]);
    $total = $cek->fetchColumn();

    if($total > 0){

        // masih punya anak → batal hapus
        $db->rollBack();
        echo "masih_punya_bawahan";
        exit;

    }

    // kalau aman baru delete
    $query = $db->prepare("DELETE FROM struktur_organisasi WHERE id = ?");
    $query->execute([$id]);

    $db->commit();

    $_SESSION['notif'] = "Data berhasil dihapus";
    $_SESSION['type']  = "success";

    echo "berhasil";

} catch (Exception $e) {

    $db->rollBack();
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