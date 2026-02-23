<?php
include "config/koneksi.php";
// Panggil file JWT manual
require_once 'lib/php-jwt/src/JWT.php';
require_once 'lib/php-jwt/src/ExpiredException.php';
require_once 'lib/php-jwt/src/SignatureInvalidException.php';
require_once 'lib/php-jwt/src/BeforeValidException.php';

use Firebase\JWT\JWT;


date_default_timezone_set('Asia/Jakarta');

header('Content-Type: application/json');

// Ambil input (bisa dari form atau JSON)
$input = json_decode(file_get_contents('php://input'), true);
$username = $input['userid'] ?? $_POST['userid'] ?? '';
$password = $input['password'] ?? $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'User ID dan password harus diisi']);
    exit;
}

// Ambil data user dari database
$blokir = 'N';
$stmt = $db->prepare("SELECT * FROM users WHERE userid = :username AND blokir = :blokir LIMIT 1");
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->bindParam(':blokir', $blokir, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'User tidak ditemukan atau diblokir']);
    exit;
}

// Verifikasi password
if (!password_verify($password, $user['password'])) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Password salah']);
    exit;
}

// --- LOGIN SUKSES ---
session_start();
$_SESSION['userid'] = $user['userid'];
$_SESSION['namalengkap'] = $user['nama_lengkap'];

// Buat token JWT untuk mobile app
$secret_key = "kuncirahasia_sangat_aman"; // Ganti dengan kunci unik kamu
$payload = [
    'userid' => $user['userid'],
    'nama'   => $user['nama_lengkap'],
    'iat'    => time(),
    'exp'    => time() + (60 * 60 * 24), // berlaku 24 jam
];

$token = JWT::encode($payload, $secret_key, 'HS256');

// Simpan token di session (untuk web)
$_SESSION['token'] = $token;

// Atau kirimkan sebagai response JSON (untuk mobile)
echo json_encode([
    'status' => 'success',
    'message' => 'Login berhasil',
    'token' => $token,
    'user' => [
        'userid' => $user['userid'],
        'nama' => $user['nama_lengkap']
    ]
]);
