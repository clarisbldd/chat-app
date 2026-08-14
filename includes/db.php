<?php
// Konfigurasi Database
$host = 'localhost';    // Host database (default: localhost)
$db = 'chat_app';       // Nama database
$user = 'root';         // Username database (default: root untuk XAMPP)
$pass = '';             // Password database (default kosong untuk XAMPP)

try {
    // Membuat koneksi ke database menggunakan PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Mode error: Exception
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Fetch sebagai array asosiatif
} catch (PDOException $e) {
    // Menangkap error koneksi
    die("Koneksi database gagal: " . $e->getMessage());
}

// Fungsi untuk memulai sesi jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
