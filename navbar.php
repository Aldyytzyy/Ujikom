<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="website icon" type="css" href="image/th.jpeg">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <title>Navbar</title>
    <script>
        // Toggle dark mode
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            document.querySelector('.navbar-inverse').classList.toggle('dark-mode');
            document.querySelectorAll('.modal-content').forEach(function(modal) {
                modal.classList.toggle('dark-mode');
            });
            if (document.body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
            } else {
                localStorage.setItem('darkMode', 'disabled');
            }
        }

        // Load dark mode preference
        document.addEventListener('DOMContentLoaded', function() {
            if (localStorage.getItem('darkMode') === 'enabled') {
                document.body.classList.add('dark-mode');
                document.querySelector('.navbar-inverse').classList.add('dark-mode');
                document.querySelectorAll('.modal-content').forEach(function(modal) {
                    modal.classList.add('dark-mode');
                });
                document.getElementById('darkModeSwitch').checked = true;
            }
        });
    </script>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Button for hamburger menu on small screens -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Uji Kompetensi</a>
        </div>
        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="profile.php">Profile</a></li>
                <li><a href="task.php">Tugas</a></li>
                <li><a href="mytask.php">Daftar Tugas</a></li>
                <li><a href="taptap.php">taptap layar</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if (isset($_SESSION['user'])): ?>
                    <li><a href="action/logout.php"><span class="glyphicon glyphicon-log-out"></span> Keluar</a></li>
                <?php else: ?>
                    <li><a href="#" data-toggle="modal" data-target="#registerModal"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#loginModal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <?php endif; ?>
                <li>
                    <label class="switch">
                        <input type="checkbox" id="darkModeSwitch" onclick="toggleDarkMode()">
                        <span class="slider round"></span>
                    </label>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="loginModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Masuk</h4>
            </div>
            <div class="modal-body">
                <form action="action/action-login.php" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Kata sandi:</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="captcha">Captcha:</label>
                        <input type="text" id="captcha" name="captcha" class="form-control" required>
                        <img src="captcha.php" alt="CAPTCHA Image">
                    </div>
                    <button type="submit" class="btn btn-primary">Masuk</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#registerModal" data-dismiss="modal">Buat akun baru</button>
            </div>
        </div>
    </div>
</div>

<div id="registerModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Daftar</h4>
            </div>
            <div class="modal-body">
                <form action="action/action-register.php" method="post">
                    <div class="form-group">
                        <label for="reg_username">Username:</label>
                        <input type="text" id="reg_username" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="reg_password">Kata sandi:</label>
                        <input type="password" id="reg_password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="reg_email">Email:</label>
                        <input type="email" id="reg_email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="reg_captcha">Captcha:</label>
                        <input type="text" id="reg_captcha" name="captcha" class="form-control" required>
                        <img src="captcha.php" alt="CAPTCHA Image">
                    </div>
                    <button type="submit" class="btn btn-primary">Buat akun baru</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Masuk</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
