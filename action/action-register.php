<?php
include 'connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // sembunyikan password di database
    $email = $_POST['email'];
    $role = isset($_POST['role']) ? $_POST['role'] : 'user';
    $captcha = $_POST['captcha'];

    // Validate CAPTCHA
    if ($captcha !== $_SESSION['captcha']) {
        echo "<script>alert('Captcha salah'); window.location.href='../index.php';</script>";
        exit();
    }

    // Cek jika email sudah ada
    $checkEmailSql = "SELECT * FROM users WHERE email = ?";
    $checkEmailStmt = $conn->prepare($checkEmailSql);
    $checkEmailStmt->bind_param("s", $email);
    $checkEmailStmt->execute();
    $result = $checkEmailStmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email sudah terdaftar'); window.location.href='../index.php';</script>";
    } else {
        $sql = "INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $password, $email, $role);

        if ($stmt->execute()) {
            // Mulai sesi dan simpan informasi pengguna ke dalam sesi
            $_SESSION['user'] = [
                'id' => $stmt->insert_id,
                'username' => $username,
                'email' => $email,
                'role' => $role
            ];
            echo "<script>alert('Akun baru berhasil dibuat'); window.location.href='../index.php';</script>";
        } else {
            echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "'); window.location.href='../index.php';</script>";
        }

        $stmt->close();
    }

    $checkEmailStmt->close();
    $conn->close();
}
?>