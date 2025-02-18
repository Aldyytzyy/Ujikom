<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['user'])) {
    echo '<script>alert("Silahkan Login Terlebih Dahulu"); window.location.href = "../index.php";</script>';
    exit();
}

$user_id = $_SESSION['user']['id'];
$current_password = $_POST['current_password'];
$new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

// Cek kata sandi saat ini
$sql = "SELECT password FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (password_verify($current_password, $user['password'])) {
    // Ganti kata sandi
    $sql = "UPDATE users SET password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $new_password, $user_id);
    if ($stmt->execute()) {
        echo '<script>alert("Kata sandi berhasil diganti"); window.location.href = "../profile.php";</script>';
    } else {
        echo '<script>alert("Gagal Mengganti kata sandi"); window.location.href = "../profile.php";</script>';
    }
} else {
    echo '<script>alert("Password saat ini salah"); window.location.href = "../profile.php";</script>';
}

$stmt->close();
$conn->close();
?>