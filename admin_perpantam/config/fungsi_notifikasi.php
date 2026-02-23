<?php
error_reporting(E_ALL ^ E_NOTICE);
function notifikasi($nik, $type, $group, $content){

    include "koneksi.php";
    $query1 = $db->prepare("INSERT INTO keluhan (`dari`, `type`, `content`, `group`, `waktu`) 
                                         VALUES ('$nik', '$type', '$content', '$group', now())");
 
  $query1->execute();

}
 

?>