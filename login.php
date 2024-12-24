<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "lab_5b";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$matric = $_POST['matric'];
$user_password = $_POST['password'];

// Prepare and execute SQL query
$sql = "SELECT * FROM users WHERE matric = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $matric, $user_password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Authentication successful, redirect to user table page
    header("Location: display.php"); // Replace with the actual page name
    exit;
} else {
    // Authentication failed, show alert
    echo "<script>
        alert('Invalid username or password, try login again');
        window.location.href = 'index.php'; // Replace with your login page name
    </script>";
}

// Close connection
$conn->close();
?>
