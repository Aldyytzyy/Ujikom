<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tap Tap Counter</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="website icon" type="css" href="image/th.jpeg">
    <style>
.container {
    text-align: center;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

button {
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
}

    </style>
</head>
<body>
<?php include 'navbar.php'; ?>
    <div class="container">
        <h1>Tap Tap Counter</h1>
        <button id="tapButton">Tap</button>
        <p>Count: <span id="count">0</span></p>
    </div>
    <script src="script.js"></script>
    <script>
        // Fetch the current count on page load
        fetch('update_counter.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('count').innerText = data;
            });
    </script>
</body>
</html>
