<?php
// Database connection
$host = "localhost";        // Change if needed
$user = "cgtbycom_breekwell_user";             // Database username
$pass = "^VQXXO;vHaXm";                 // Database password
$dbname = "cgtbycom_breekwell_db";   // Database name

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<script>alert('Database connection failed!'); window.location.href='../index.html';</script>");
}

// Collect form data
$name    = isset($_POST['name']) ? trim($_POST['name']) : '';
$email   = isset($_POST['email']) ? trim($_POST['email']) : '';
$subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

// Validate required fields
if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    die("<script>alert('All fields are required!'); window.location.href='../index.html';</script>");
}

// Prepare insert query
$stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $subject, $message);

// Execute and show popup
if ($stmt->execute()) {
    echo "
    <html>
    <head>
      <title>Message Stored</title>
      <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 80px; background: #f7f7f7; }
        .box { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.2); display: inline-block; }
        h2 { color: green; }
        button { margin-top: 20px; padding: 12px 25px; border: none; border-radius: 5px; background: #007BFF; color: white; font-size: 16px; cursor: pointer; }
        button:hover { background: #0056b3; }
      </style>
    </head>
    <body>
      <div class='box'>
        <h2>✅ Your message has been stored successfully!</h2>
        <button onclick=\"window.location.href='../'\">Back to Home</button>
      </div>
    </body>
    </html>
    ";
} else {
    echo "<script>alert('Error saving message. Please try again!'); window.location.href='../404.html';</script>";
}



$stmt->close();
$conn->close();
?>
