<?php
// Konfigurasi Database
define('DB_HOST', 'localhost');      // Host database (default: localhost)
define('DB_USER', 'root');          // Username database (default: root untuk XAMPP)
define('DB_PASS', '');              // Password database (default: kosong untuk XAMPP)
define('DB_NAME', 'chat_app');      // Nama database yang akan digunakan

// Koneksi ke Database
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Mode error: exception
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Fetch sebagai array asosiatif
} catch (PDOException $e) {
    die("Koneksi ke database gagal: " . $e->getMessage());
}

// Fungsi untuk memulai sesi jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Pengaturan Umum Aplikasi
define('APP_NAME', 'Aplikasi Web Chat');
define('APP_URL', 'http://localhost/chat_app'); // Ganti sesuai URL aplikasi Anda
?>
