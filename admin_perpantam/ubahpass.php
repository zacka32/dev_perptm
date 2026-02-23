<?php
// update_password.php
// Hati-hati: jalankan sekali lalu hapus file ini dari server!

// include "config/koneksi.php";

// $userid = '12345';               // userid target
// $new_plain_password = '12345';   // password baru yang akan diset

// try {
//     // Buat hash baru
//     $new_hash = password_hash($new_plain_password, PASSWORD_DEFAULT);

//     // Update ke database
//     $stmt = $db->prepare("UPDATE users SET password = :p WHERE userid = :u");
//     $stmt->execute([':p' => $new_hash, ':u' => $userid]);

//     if ($stmt->rowCount()) {
//         echo "Sukses: password untuk user '{$userid}' telah diupdate.\n";
//     } else {
//         echo "Perhatian: tidak ada row yang berubah. Periksa apakah userid '{$userid}' benar.\n";
//     }
// } catch (Exception $e) {
//     echo "Error: " . $e->getMessage() . "\n";
// } 

?>