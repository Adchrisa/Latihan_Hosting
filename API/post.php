<?php
// Tiga baris ini sangat penting untuk debugging di hosting gratis
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 1. Sertakan file koneksi database
include 'connection.php'; 

// 2. Set Header untuk output JSON
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST');

// 3. Cek apakah request menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Metode request tidak diizinkan. Gunakan POST."]);
    exit;
}

// 4. Logika Bisnis (INSERT Data Baru)
try {
    // ---- Bagian ini yang perlu Anda sesuaikan ----
    
    // a. Ambil data dari Body Request
    // Jika Anda mengirim data via JSON:
    $data = json_decode(file_get_contents("php://input"), true);
    
    // Jika Anda mengirim data via form-data (Multipart/x-www-form-urlencoded):
    // $nama = $_POST['nama'];
    // $deskripsi = $_POST['deskripsi'];
    
    // Contoh sederhana: Cek apakah data berhasil diterima
    if (empty($data) || !isset($data['nama'])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Data tidak diterima atau tidak lengkap."]);
        exit;
    }

    $nama = $data['nama']; // Asumsi ada field 'nama'

    // b. Persiapkan Query SQL
    $sql = "INSERT INTO nama_tabel_anda (nama_kolom) VALUES (:nama)";
    $stmt = $pdo->prepare($sql);
    
    // c. Bind Parameter
    $stmt->bindParam(':nama', $nama);
    
    // d. Jalankan Query
    $stmt->execute();
    
    // ---- Akhir Bagian yang perlu disesuaikan ----
    
    // 5. Kirim Respons Sukses
    http_response_code(201); // 201 Created
    echo json_encode(["success" => true, "message" => "Data berhasil disimpan!"]);

} catch (PDOException $e) {
    // 6. Penanganan Error Database
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Error database: " . $e->getMessage()]);
    
} catch (Exception $e) {
    // 7. Penanganan Error Umum
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Terjadi kesalahan: " . $e->getMessage()]);
}

?>