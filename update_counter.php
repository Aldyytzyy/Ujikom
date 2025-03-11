<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tap_counter";

function getCurrentCount($conn) {
    $sql = "SELECT count FROM counter WHERE id = 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['count'];
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update counter
    $sql = "UPDATE counter SET count = count + 1 WHERE id = 1";
    $conn->query($sql);
}

echo getCurrentCount($conn);

$conn->close();
?>
