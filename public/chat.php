<?php
session_start();
include '../includes/db.php'; // Memastikan jalur yang benar ke db.php

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil data pengguna yang sedang login
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Ambil pesan yang ada dalam chat, tanpa kolom timestamp
$sqlMessages = "SELECT m.*, u1.username AS sender_username, u2.username AS receiver_username 
                FROM messages m 
                JOIN users u1 ON m.sender_id = u1.id
                JOIN users u2 ON m.receiver_id = u2.id
                WHERE m.sender_id = ? OR m.receiver_id = ?
                ORDER BY m.id ASC";  // Menggunakan m.id untuk mengurutkan pesan berdasarkan ID
$stmtMessages = $pdo->prepare($sqlMessages);
$stmtMessages->execute([$user_id, $user_id]);
$messages = $stmtMessages->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - Aplikasi Web Chat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header class="bg-primary text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">Aplikasi Web Chat</h1>
            <nav>
                <a href="index.php" class="text-white mx-2">Beranda</a>
                <a href="logout.php" class="text-white mx-2">Logout</a>
            </nav>
        </div>
    </header>
    <div class="container mt-4">
        <h2>Selamat datang, <?php echo htmlspecialchars($user['username']); ?></h2>
        <div class="chat-box">
            <?php foreach ($messages as $message): ?>
                <div class="message">
                    <div class="avatar">
                        <?php echo strtoupper(substr($message['sender_username'], 0, 1)); ?>
                    </div>
                    <div class="content">
                        <strong><?php echo htmlspecialchars($message['sender_username']); ?></strong> 
                        <span>: <?php echo htmlspecialchars($message['message']); ?></span>
                        <br>
                        <small><em>Waktu: <?php echo isset($message['timestamp']) ? $message['timestamp'] : 'Tidak diketahui'; ?></em></small>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <form action="send_message.php" method="POST" class="message-input mt-3">
            <div class="form-group">
                <textarea name="message" class="form-control" rows="3" placeholder="Tulis pesan..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Kirim Pesan</button>
        </form>
    </div>

    <!-- Memuat file JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
