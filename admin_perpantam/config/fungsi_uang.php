<?php
function saldo(){
    $ua=$db->prepare("SELECT IFNULL(SUM(debit)-SUM(kredit),0) AS saldo FROM riwayat_saldo WHERE userid='$userid'");
    $ua->execute();        
    $u=$ua->fetch();
    $saldo = $u['saldo'];
    return $saldo;

}

?> 
