<?php
function format_rupiah($angka){
  $rupiah=number_format($angka,0,',','.');
  return $rupiah;
}

function format_rupiah_3($angka){
  $rupiah=number_format($angka,3,',','.');
  return $rupiah;
}
?> 
