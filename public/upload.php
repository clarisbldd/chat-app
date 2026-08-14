<?php
session_start();
include 'includes/db.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Validasi apakah ada file yang diunggah
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $user_id = $_SESSION['user_id'];
    $target_dir = "uploads/"; // Direktori tempat file akan disimpan
    $target_file = $target_dir . basename($file["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Cek apakah file yang diunggah merupakan gambar atau file lain yang diizinkan
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
    
    // Cek ukuran file (maksimal 5MB)
    if ($file["size"] > 5000000) {
        $error = "File terlalu besar.";
        $uploadOk = 0;
    }

    // Cek apakah format file diperbolehkan
    if (!in_array($fileType, $allowedTypes)) {
        $error = "Hanya file JPG, JPEG, PNG, GIF, dan PDF yang diperbolehkan.";
        $uploadOk = 0;
    }

    // Cek apakah ada kesalahan dalam unggahan
    if ($uploadOk == 0) {
        $error = "File tidak dapat diunggah.";
    } else {
        // Jika file valid, coba unggah ke server
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            // Simpan informasi file ke database
            $sql = "INSERT INTO files (user_id, file_path) VALUES (?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$user_id, $target_file]);
            $message = "File berhasil diunggah!";
        } else {
            $error = "Terjadi kesalahan saat mengunggah file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File - Aplikasi Web Chat</title>
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
        <h2>Unggah File</h2>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (isset($message)): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>

        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Pilih File untuk Diunggah:</label>
                <input type="file" name="file" id="file" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Unggah</button>
        </form>

        <p class="mt-3"><a href="chat.php">Kembali ke Chat</a></p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
