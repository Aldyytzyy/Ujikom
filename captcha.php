<?php
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Generate random string
$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
$captcha_string = '';
for ($i = 0; $i < 6; $i++) {
    $captcha_string .= $characters[rand(0, strlen($characters) - 1)];
}

// Save CAPTCHA string in session variable
$_SESSION['captcha'] = $captcha_string;

// Create the image
$width = 150;
$height = 50;
$image = imagecreate($width, $height);

// Check if image creation was successful
if (!$image) {
    die('Failed to create image');
}

// Set background and text colors
$background_color = imagecolorallocate($image, 255, 255, 255); // White background
$text_color = imagecolorallocate($image, 0, 0, 0); // Black text
$line_color = imagecolorallocate($image, 64, 64, 64); // Gray lines

// Fill background with white color
imagefilledrectangle($image, 0, 0, $width, $height, $background_color);

// Add some noise (random lines)
for ($i = 0; $i < 5; $i++) {
    imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $line_color);
}

// Check if the font file exists
$font_path = './arialbd.ttf';
if (!file_exists($font_path)) {
    die('Font file not found');
}

// Add the CAPTCHA text to the image
if (!imagettftext($image, 20, rand(-10, 10), rand(30, 60), rand(30, 40), $text_color, $font_path, $captcha_string)) {
    error_log('Failed to add text to image');
    die('Failed to add text to image');
}

// Output the image as a PNG
header('Content-type: image/png');
imagepng($image);

// Destroy the image to free memory
imagedestroy($image);
?>
