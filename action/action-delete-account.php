<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['user'])) {
    echo '<script>alert("Silahkan Login Terlebih Dahulu"); window.location.href = "../index.php";</script>';
    exit();
}

$user = $_SESSION['user'];
$user_id = $user['id'];
$password = $_POST['password'];

// Verifikasi kata sandi
$result = $conn->query("SELECT password FROM users WHERE id = '$user_id'");
$row = $result->fetch_assoc();

if (password_verify($password, $row['password'])) {
    // Jika kata sandi benar, hapus akun
    $sql = "DELETE FROM tasks WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();

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
} else {
    // Jika kata sandi salah, tampilkan pesan kesalahan
    echo '<script>alert("Kata sandi salah. "); window.location.href = "../profile.php";</script>';
}

$conn->close();
?>