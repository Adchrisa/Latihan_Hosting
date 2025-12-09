<?php
// Konfigurasi Database Hosting InfinityFree (Berdasarkan data Anda)
$DB_HOST = "sql100.infinityfree.com";        
$DB_NAME = "if0_40585064_motorworks";        
$DB_USER = "if0_40585064";                   
$DB_PASS = "101101038Ab";         // GANTI DENGAN PASSWORD DATABASE ANDA

try {
    $pdo = new PDO(
        "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4",
        $DB_USER,
        $DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );

    // TIDAK ADA OUTPUT DI SINI JIKA KONEKSI BERHASIL

} catch (PDOException $e) {
    // KONEKSI GAGAL: Mengembalikan HTTP 500 dan respons JSON
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Database Connection Failed: " . $e->getMessage()
    ]);
    exit;
}
?>