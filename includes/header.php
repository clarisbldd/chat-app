<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Aplikasi Web Chat'; ?></title>
    <!-- Memuat file CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Memuat file CSS kustom -->
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header class="bg-primary text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">Aplikasi Web Chat</h1>
            <nav>
                <a href="index.php" class="text-white mx-2">Beranda</a>
                <a href="login.php" class="text-white mx-2">Login</a>
                <a href="register.php" class="text-white mx-2">Registrasi</a>
            </nav>
        </div>
    </header>
    <div class="container mt-4">
