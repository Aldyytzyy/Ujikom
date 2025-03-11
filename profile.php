<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    echo '<script>alert("Silahkan Login Terlebih Dahulu"); window.location.href = "index.php";</script>';
    exit(); 
}

$user = $_SESSION['user'];

// Ambil data tugas dari database
include 'action/connection.php';
$user_id = $user['id'];
$completed_tasks = $conn->query("SELECT COUNT(*) AS count FROM tasks WHERE user_id = '$user_id' AND completed = 1")->fetch_assoc()['count'];
$incomplete_tasks = $conn->query("SELECT COUNT(*) AS count FROM tasks WHERE user_id = '$user_id' AND completed = 0")->fetch_assoc()['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="website icon" type="css" href="image/th.jpeg">
    <link rel="stylesheet" href="style.css">
    <style>

        body.dark-mode {
            background-color: #121212;
            color: #ffffff;
        }
        .dark-mode .panel {
            background-color: #333333;
            color: #ffffff;
        }
        .dark-mode .panel-heading {
            background-color: #444444;
            color: #ffffff;
        }
        .dark-mode .panel-body {
            color: #ffffff;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">Profile Page</h1>
                </div>
                <div class="panel-body">
                    <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                    <p><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
                     <p><strong>Tugas yang telah selesai:</strong> <?php echo $completed_tasks; ?></p>
                    <p><strong>Tugas yang belum selesai:</strong> <?php echo $incomplete_tasks; ?></p>
                    <h4><a href="change-password.php">Ubah Kata Sandi</a></h4>
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Hapus akun</h2>
                </div>
                <div class="panel-body">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteAccountModal">Hapus akun saya</button>
                </div>
            </div>

            <!-- Modal -->
            <div id="deleteAccountModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Hapus Akun</h4>
                        </div>
                        <div class="modal-body">
                            <form id="deleteAccountForm" action="action/action-delete-account.php" method="post">
                                <div class="form-group">
                                    <p>Apakah Anda yakin ingin menghapus akun Anda? Senua Tugas akan ikut terhapus secara permanen!!</p>
                                    <label for="password">Masukkan Kata Sandi:</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <button type="submit" class="btn btn-danger">Hapus akun saya</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
