<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['user'])) {
    echo '<script>alert("Silahkan Login Terlebih Dahulu"); window.location.href = "../index.php";</script>';
    exit();
}

$user_id = $_SESSION['user']['id'];

// hapus task yang dimiliki user
$sql = "DELETE FROM tasks WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->close();

// hapus akun
$sql = "DELETE FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
if ($stmt->execute()) {
    // hapus session dan kembali logout
    session_destroy();
    echo '<script>alert("Akun berhasil dihapus"); window.location.href = "../index.php";</script>';
} else {
    echo '<script>alert("Gagal menghapus akun"); window.location.href = "../profile.php";</script>';
}

$stmt->close();
$conn->close();
?>