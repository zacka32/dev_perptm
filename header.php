<?php
// default meta
$title = "Perpantam";
$deskripsi_singkat = "Persatuan Pegawai Aneka Tambang";
$canonical_url = "https://perpantam.com";
$gambar_produk = "https://perpantam.com/logo.png";

// page aktif
$page = $_GET['page'] ?? 'home';

if ($page === 'product_details') {

     
    // $sl = $db->prepare("SELECT * FROM produk WHERE id_produk='$_GET[id]' ");
    // $sl->execute();
    // $s = $sl->fetch();                              
  
    // $title = $s['nama_produk'];
    // $canonical_url = "https://griyailmu.com/produk_detail/".$s['id_produk'];
    // $deskripsi_singkat = substr(strip_tags($s['deskripsi']), 0, 160);
    // $gambar_produk = "https://griyailmu.com/image/".$s['image_cover'];
}

?>