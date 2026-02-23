<script src="../../dist/sweetalert-dev.js"></script>
<link rel="stylesheet" href="../../dist/sweetalert.css">

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
  include "../../config/fungsi_hakakses.php";
  include "../../config/fungsi_log.php";

  $userid=$_SESSION['userid'];
  $module=$_GET['module'];
  $act=$_GET['act'];

  
    if ($module=='akses' AND $act=='input'){
      $insert = $db->prepare("INSERT INTO akses (
													  `userid`, 
													  `modul`, 
													  `lihat`, 
													  `buat`, 
													  `edit`,
												
													  `hapus`,
													  `dt_lastupdate`,
													  `user_id`)
												  
                                          VALUES ('$_POST[userid]', 
                                                  '$_POST[modul]', 
                                                  '$_POST[lihat]', 
                                                  '$_POST[buat]',
                                                  '$_POST[edit]',
												  '$_POST[hapus]',
                                                  NOW(),	
												  '$userid') 
                                                ");
        $insert->execute();
     
            if($insert) {
               tambahlog($userid,$module,'TAMBAH','BERHASIL');
                  echo "<script type='text/javascript'>
                      setTimeout(function () {  
                        swal('Succes!', 'Berhasil Di tambahkan', 'success')
                      },10); 
                      window.setTimeout(function(){ 
                        window.location.replace('../../media.php?module=$module');
                      } ,2000); 
                    </script>";
              } 
                          
      // header('location:../../media.php?module=akses');
      }

    // delete module akses
    elseif ($module=='akses' AND $act=='delete'){

          $id=$_GET['id'];
          $insert = $db->prepare("DELETE FROM akses WHERE id='$id' ");                   
          $insert->execute();
         
            if($insert) {
                tambahlog($userid,$module,'DELETE','BERHASIL');
                  echo "<script type='text/javascript'>
                      setTimeout(function () {  
                        swal('Deleted !', 'Kode akses ( $id ) Berhasil di Hapus', 'error')
                      },10); 
                      window.setTimeout(function(){ 
                        window.location.replace('../../media.php?module=$module');
                      } ,1500); 
                    </script>";
              } 
        //  header('location:../../media.php?module=akses');
    }
	
	// delete module kodegol
    elseif ($module=='akses' AND $act=='spesialDelete'){

          $id=$_GET['id'];	
		 			
            $insert = $db->prepare("DELETE FROM detail_akses WHERE id_detail_akses='$id' ");                   
			
            $insert->execute();
         
            if($insert) {
                tambahlog($userid,$module,'DELETE spesial modul','BERHASIL');
                  echo "<script type='text/javascript'>
                      setTimeout(function () {  
                        swal('Deleted !', 'Kode ( $id ) Berhasil di Hapus', 'error')
                      },10); 
                      window.setTimeout(function(){ 
                        window.location.replace('../../media.php?module=akses');
                      } ,1000); 
                    </script>";
              } 
        //  header('location:../../media.php?module=kodegol');
    }

    


}
?>

<!-- <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script> -->