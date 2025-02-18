<?php
session_start();

if (isset($_POST['confirm_logout'])) {
    session_unset();
    session_destroy();
    echo "<script>alert('Anda Telah Logout!!'); window.location.href='../index.php';</script>";
} else {
    echo "<script>
        if (confirm('Yakin ingin keluar?')) {
            document.write('<form method=\"post\" id=\"logoutForm\"><input type=\"hidden\" name=\"confirm_logout\" value=\"1\"></form>');
            document.getElementById('logoutForm').submit();
        } else {
            window.location.href='../index.php';
        }
    </script>";
}
?>
