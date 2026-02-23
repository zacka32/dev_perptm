<?php
include "config/koneksi.php";
require_once "lib/php-jwt/src/JWT.php";
use Firebase\JWT\JWT;
date_default_timezone_set('Asia/Jakarta');
$username = $_POST['userid'] ?? '';
$password = $_POST['password'] ?? '';
$blokir = 'N';
$stmt = $db->prepare("SELECT * FROM users WHERE userid=:user AND blokir=:blokir LIMIT 1");
$stmt->execute(['user' => $username, 'blokir' => $blokir]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if ($user && password_verify($password, $user['password'])) {
    // ---- LOGIN SUKSES ----
    session_start();
    session_regenerate_id(true);
    $_SESSION['userid'] = $user['userid'];
    $_SESSION['namalengkap'] = $user['nama_lengkap'];
    $_SESSION['administrator']    = $user['administrator'];
    $_SESSION['idgroup']    = $user['ID_GROUP'];
    // (opsional) buat token JWT, misalnya untuk validasi internal
    $secret_key = "kuncirahasia_sangat_aman";
    $payload = [
        'userid' => $user['userid'],
        'nama'   => $user['nama_lengkap'],
        'iat'    => time(),
        'exp'    => time() + (60 * 60 * 24),
    ];
    $token = JWT::encode($payload, $secret_key, 'HS256');
    $_SESSION['token'] = $token;
    // redirect ke halaman utama admin
    header('Location: media.php?module=home');
    exit;
} else {
    // ---- LOGIN GAGAL ----
    echo "<center>Login gagal! Username atau password salah.<br>";
    echo "<a href='index.php'><b>COBA LAGI</b></a></center>";
}
?>
