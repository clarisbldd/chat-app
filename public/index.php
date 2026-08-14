<?php
session_start();

// Jika pengguna sudah login, arahkan ke halaman chat
if (isset($_SESSION['user_id'])) {
    header("Location: chat.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Aplikasi Web Chat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header class="bg-primary text-white py-3">
        <div class="container">
            <h1 class="h4 mb-0">Aplikasi Web Chat</h1>
        </div>
    </header>

    <div class="container mt-4">
        <h2>Selamat Datang di Aplikasi Web Chat</h2>
        <p>Silakan login atau registrasi untuk mulai menggunakan aplikasi.</p>

        <div class="mt-4">
            <a href="login.php" class="btn btn-primary">Login</a>
            <a href="register.php" class="btn btn-secondary">Registrasi</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
