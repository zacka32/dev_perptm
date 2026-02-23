<?php 

include "config/koneksi.php";
error_reporting(0);
// Bagian Home
if ($_GET['page']=='home'){
  include "content/home.php";
}
elseif ($_GET['page'] == 'gallery') {
  
  include "content/gallery.php";
}
elseif ($_GET['page'] == 'login') {
  
  include "login_cus.php";
}
elseif ($_GET['page'] == 'event') {

  include "content/event.php";
}
elseif ($_GET['page'] == 'event_detail') {

  include "content/event_detail.php";
}


elseif ($_GET['page'] == 'layanan_keanggotaan') {

  include "content/layanan_keanggotaan.php";
}
elseif ($_GET['page'] == 'news') {

  include "content/news.php";
}

elseif ($_GET['page'] == 'news_detail') {

  include "content/news_detail.php";
}
elseif ($_GET['page'] == 'tentang_kami') {
  
  include "content/tentang_kami.php";
}
elseif ($_GET['page'] == 'terimakasih') {
  
  include "content/terimakasih.php";
}
elseif ($_GET['page'] == 'struktur_organisasi') {
  
  include "content/struktur_organisasi.php";
}
elseif ($_GET['page'] == 'profile') {
  
  include "content/profile.php";
}
elseif ($_GET['page'] == 'kontak') {
  
  include "content/kontak.php";
}

elseif ($_GET['page'] == 'promo') {
  
  include "content/promo.php";
}
elseif ($_GET['page'] == 'search') {
  
  include "content/cari.php";
}
// Apabila modul tidak ditemukan
else{
  include "content/home.php";
}
?>
