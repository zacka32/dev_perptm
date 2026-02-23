<?php


function hakakses($nik,$modul,$aksi) {

  //API user hak akses
  $method = 'POST';
  $url    = 'user/hak_akses';
  $token  = $_SESSION['token'];
  $data1  = array('nik'     => $_SESSION['nik'],
                  'idgroup' => $_SESSION['idgroup'],
                  'modul'   => $modul,
                  'aksi'    => $aksi);

  $result = CallAPI($method,$url,$token,$data1);
  $hakakses = json_decode($result, TRUE);

  if ($hakakses['status'] != 1) {
    return false;
  }else{
    return true;
  }
}

?>