<?php
// Include the navbar
include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .contact-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            margin-bottom: 40px;
            border-radius: 8px;
            background-color: #f9f9f9;
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            gap: 20px;
        }
        .contact-details {
            flex: 2;
        }
        .logo-container {
            flex: 1;
            text-align: center;
        }
        .logo-container img {
            max-width: 225px;
            height: auto;
            border-radius: 8px;
            margin-top: 100px;
        }
        .contact-item {
            margin-bottom: 15px;
        }
        .contact-item strong {
            display: block;
            margin-bottom: 5px;
        }
        iframe {
            width: 100%;
            height: 300px;
            border: 0;
            border-radius: 8px;
        }
        body.dark-mode {
            background-color: #121212;
            color: #ffffff;
        }
        .dark-mode .contact-container {
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
    <div class="contact-container">
        <div class="contact-details">
            <h1 style="text-align: center;">Contact Us</h1>
            <div class="contact-item">
                <strong>Nama:</strong>
                <p>Aldiyansah</p>
            </div>
            <div class="contact-item">
                <strong>WhatsApp:</strong>
                <a href="https://wa.me/6281546705329" target="_blank">+6281546705329</a>
            </div>
            <div class="contact-item">
                <strong>Instagram:</strong>
                <a href="https://instagram.com/aldyy085712" target="_blank">@aldyy085712</a>
            </div>
            <div class="contact-item">
                <strong>Phone Number:</strong>
                <p>+62851-7958-2386</p>
            </div>
            <div class="contact-item">
                <strong>Facebook:</strong>
                <a href="https://facebook.com/shzeeqaa" target="_blank">Aldyy</a>
            </div>
            <div class="contact-item">
                <strong>Address:</strong>
                <p>Jalan Pramuka No.10 Gegerbitung 43197</p>
            </div>
            <div class="contact-item">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63361.43202301869!2d107.05049522264403!3d-6.998741191335165!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6845c8be5e24e1%3A0xa9f926e531637542!2sSMK%20YASPIM!5e0!3m2!1sen!2sid!4v1744608860847!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <div class="logo-container">
            <img src="image/message.png" alt="Logo">
        </div>
    </div>
</body>
</html>