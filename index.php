<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <link rel="website icon" type="css" href="image/th.jpeg">
    <style>
        body.dark-mode {
            background-color: #121212;
            color: #ffffff;
        }
        .dark-mode .modal-content {
            background-color: #333333;
            color: #ffffff;
        }
        .dark-mode .modal-header, .dark-mode .modal-footer {
            border-color: #555555;
        }
        .dark-mode .btn-link {
            color: #ffffff;
        }
        .dark-mode .btn-link:hover {
            color: #cccccc;
        }
        .btn-group {
            margin-bottom: 20px; /* Menambahkan jarak antara tombol dan teks */
        }
        .btn-group p {
            margin-top: 10px; /* Menambahkan jarak antara tombol dan teks */
        }
        .btn-primary {
            border-radius: 8px; /* Menambahkan border radius pada tombol */
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <?php
    $username = isset($_SESSION['user']['username']) ? $_SESSION['user']['username'] : 'di Website';
    ?>

    <div class="container">
        <h1>Selamat Datang <?php echo htmlspecialchars($username); ?></h1>
        <p>Ini adalah halaman selamat datang.</p>

        <?php if (isset($_SESSION['user'])): ?>
            <div class="btn-group">
                <a href="mytask.php" class="btn btn-primary">My Task</a>
                <br>
                <br>
                <p>Halaman ini berisi daftar tugas Anda.</p>
            </div>
            <br>
            <div class="btn-group">
                <a href="profile.php" class="btn btn-primary">Profile</a>
                <br>
                <br>
                <p>Halaman ini berisi informasi profil Anda.</p>
            </div>
            <br>
            <div class="btn-group">
                <a href="mytask.php" class="btn btn-primary">Mytask</a>
                <br>
                <br>
                <p>Halaman ini berisi informasi daftar tugas</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>