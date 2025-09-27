<?php
// Database connection settings
$host = "localhost";        // Database host
$user = "cgtbycom_breekwell_user";             // Database username
$pass = "Breekwell#2025";                 // Database password
$dbname = "cgtbycom_breekwell_db";   // Database name

// Create DB connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    header("Location: /404.html");
    exit();
}

// Collect form data securely
$name          = isset($_POST['name']) ? trim($_POST['name']) : '';
$email         = isset($_POST['email']) ? trim($_POST['email']) : '';
$zip           = isset($_POST['zip']) ? trim($_POST['zip']) : '';
$property_type = isset($_POST['property_type']) ? trim($_POST['property_type']) : '';
$price_range   = isset($_POST['price_range']) ? trim($_POST['price_range']) : '';
$bedrooms      = isset($_POST['bedrooms']) ? trim($_POST['bedrooms']) : '';

// Validate required fields
if (empty($name) || empty($email) || empty($zip) || empty($property_type) || empty($price_range)) {
    header("Location: /404.html");
    exit();
}

// Prepare & bind
$stmt = $conn->prepare("INSERT INTO leads (name, email, zip, property_type, price_range, bedrooms) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $name, $email, $zip, $property_type, $price_range, $bedrooms);

// Execute query
if ($stmt->execute()) {
    // Redirect to coreg.html on success
    header("Location: /coreg.html");
    exit();
} else {
    // Redirect to 404.html on failure
    header("Location: /404.html");
    exit();
}

// Close connections
$stmt->close();
$conn->close();
?>
