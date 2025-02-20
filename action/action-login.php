<?php
include 'connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $captcha = $_POST['captcha'];

    // Validate CAPTCHA
    if ($captcha !== $_SESSION['captcha']) {
        echo "<script>alert('Captcha salah'); window.location.href='../index.php';</script>";
        exit();
    }

    // Check jika email sudah ada
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // mulai session dan simpan data user
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role']
            ];
            echo "<script>alert('Login Berhasil'); window.location.href='../index.php';</script>";
        } else {
            echo "<script>alert('Kata sandi salah'); window.location.href='../index.php';</script>";
        }
    } else {
        echo "<script>alert('Email tidak ditemukan'); window.location.href='../index.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>