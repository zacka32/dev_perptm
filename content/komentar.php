<?php
session_start();
require '../config/koneksi.php';

// if(!isset($_SESSION['userid'])) {
//     die("Akses ditolak!");
// }
$id_auto = $_POST['id_auto'];

if(!isset($id_auto)) {
    die("Akses ditolak!");
}

$userid = "12345";

$rating = $_POST['rating'];
$pesan = htmlspecialchars($_POST['komentar']);

// Simpan komentar
$stmt = $db->prepare("
    INSERT INTO komentar (userid, id_news, rating, pesan,l_status)
    VALUES (?, ?, ?, ?, 'Y')
");
$stmt->execute([$userid, $id_auto, $rating, $pesan]);

echo "<script>alert('Komentar tersimpan!');window.location.href='../?page=news_detail&id=$id_auto';</script>";