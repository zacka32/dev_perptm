<script src="dist/sweetalert-dev.js"></script>
<link rel="stylesheet" href="dist/sweetalert.css">
<?php
session_start();
// Hapus semua data session
$_SESSION = [];
// Hapus cookie session di browser (kalau ada)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
// Hancurkan session di server
session_destroy();
// (Opsional) hapus token JWT kalau kamu simpan di cookie
if (isset($_COOKIE['token'])) {
    setcookie('token', '', time() - 3600, '/');
}
// Apabila setelah logout langsung menuju halaman utama website, aktifkan baris di bawah ini:
echo "<script type='text/javascript'>
            setTimeout(function () {  
              swal({
              title: 'Logout',
              text: 'Anda telah logout, terima kasih ',
              imageUrl: 'png/logout.jpg'
              });
              
            },10); 
            window.setTimeout(function(){ 
              window.location.replace('index.php');
            } ,2000); 
          </script>";
  // }
  // header('location:http://www.alamatwebsite.com');
  exit;
?>
