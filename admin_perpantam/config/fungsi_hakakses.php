<?php

function hakakses($userid,$modul,$aksi) {

  $idgroup    = $_SESSION['idgroup'];
  
  date_default_timezone_set('Asia/Jakarta');
  $tanggal=date('Y-m-d H:i:sa');

  include 'koneksi.php';

  $query2 = $db->prepare("SELECT count(*) as jml FROM users WHERE userid = '$userid'  AND administrator='Y' ");
  $query2->execute();
  $xx = $query2->fetch();

  if ($xx['jml']> 0 ) {
    return true;
  }else{

    try{
    $query = $db->prepare("SELECT count(*) as jml FROM akses WHERE (userid = '$userid' OR id_group='$idgroup')  AND modul= '$modul' AND $aksi = 'Y' ");
    $query->execute();
    $akses = $query->fetch();
    
      if ($akses['jml'] > 0 ){
       //mysql_query("INSERT INTO log_user (userid,modul,aksi,status,waktu) VALUES ('$userid','$modul','$aksi','SUKSES','$tanggal')");
        return true;
      }else{
       //mysql_query("INSERT INTO log_user (userid,modul,aksi,status,waktu) VALUES ('$userid','$modul','$aksi','GAGAL','$tanggal')");
        return false;

      }

    }catch (Exception $e) {

      $query3 = $db->prepare("SELECT count(*) as jml FROM akses a left join detail_akses d on a.id=d.id_akses where (a.userid = '$userid' or a.id_group='$idgroup')  AND a.modul= '$modul' AND d.action='$aksi' ");
      $query3->execute();
      $x = $query3->fetch();

      if ($x['jml'] > 0){
       //mysql_query("INSERT INTO log_user (userid,modul,aksi,status,waktu) VALUES ('$userid','$modul','$aksi','SUKSES','$tanggal')");
        return true;
      }else{
       //mysql_query("INSERT INTO log_user (userid,modul,aksi,status,waktu) VALUES ('$userid','$modul','$aksi','GAGAL','$tanggal')");
        return false;

      }

    }

    

  }

}

function notifikasi($userid, $untuk, $type, $group, $content){

    include "koneksi.php";
    $query1 = $db->prepare("INSERT INTO keluhan (`dari`, `untuk`, `type`, `content`, `group`, `waktu`) 
                                         VALUES ('$userid', '$untuk', '$type', '$content', '$group', now())");
 
  $query1->execute();

}



?>