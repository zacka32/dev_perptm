<?php 
include "config/koneksi.php";
include "config/fungsi_hakakses.php";
include "config/fungsi_log.php";
include "config/fungsi_indotgl.php";
include "config/library.php";
// include "config/fungsi_week.php";
// include "config/fungsi_hitungcuti.php";
// Bagian Home
if ($_GET['module']=='home'){
  include "modul/home/home.php";
}
elseif ($_GET['module'] == 'password') {
  //$title = "Rubah Password";
  include "modul/mod_password/password.php";
}
////store
elseif ($_GET['module'] == 'gallery') {
  include "modul/gallery/gallery.php";
}
elseif ($_GET['module'] == 'event') {
  include "modul/event/event.php";
}
elseif ($_GET['module'] == 'banner') {
  include "modul/banner/banner.php";
}
elseif ($_GET['module'] == 'news') {
  include "modul/news/news.php";
}
elseif ($_GET['module'] == 'struktur_organisasi') {
  include "modul/struktur_organisasi/struktur_organisasi.php";
}
elseif ($_GET['module'] == 'ulasan_produk') {
  include "modul/ulasan_produk/ulasan_produk.php";
}
///umum
elseif ($_GET['module'] == 'user') {
  include "modul/mod_user/user.php";
}
elseif ($_GET['module'] == 'akses') {
  include "modul/mod_akses/akses.php";
}
elseif ($_GET['module'] == 'ebook') {
  include "modul/ebook/ebook.php";
}
elseif ($_GET['module'] == 'produk_tag') {
  include "modul/produk_tag/produk_tag.php";
}
elseif ($_GET['module'] == 'produk_kategori') {
  include "modul/produk_kategori/produk_kategori.php";
}
elseif ($_GET['module'] == 'order') {
  include "modul/order/order.php";
}
elseif ($_GET['module'] == 'profile') {
  include "modul/profile/profile.php";
}
elseif ($_GET['module'] == 'customer') {
  include "modul/customer/customer.php";
}
elseif ($_GET['module'] == 'promo') {
  include "modul/promo/promo.php";
}
elseif ($_GET['module'] == 'voucher') {
  include "modul/voucher/voucher.php";
}
elseif ($_GET['module'] == 'ulasan_produk') {
  include "modul/ulasan_produk/ulasan_produk.php";
}
elseif ($_GET['module'] == 'ebooks_perkategori') {
  include "modul/ebooks_perkategori/ebooks_perkategori.php";
}
elseif ($_GET['module'] == 'laporan') {
  include "modul/laporan/laporan.php";
}
// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
?>
