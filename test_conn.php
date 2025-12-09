<?php
// Include file koneksi yang sudah bersih
include 'connection.php';

// Jika kode mencapai baris ini, berarti connection.php berhasil dieksekusi
// dan koneksi database $pdo sudah tersedia.
echo "Koneksi Berhasil";

// Untuk testing di tools seperti Bruno, Anda bisa menambahkan output JSON
// echo json_encode(["success" => true, "message" => "Koneksi Berhasil"]);
?>