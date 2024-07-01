<?php
// Database credentials
$host = 'localhost';
$db = 'test_db';
$user = 'root';
$pass = '';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input
$username = $_GET['username'];

// SQL query with vulnerability (SQL Injection)
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

// Bug: Undefined variable
echo $undefinedVariable;

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. " - Username: " . $row["username"]. "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
