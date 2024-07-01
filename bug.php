<?php
// Database credentials
$host = 'localhost';
$db = 'example_db';
$user = 'root';
$pass = '';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input
$id = $_GET['id'];
$name = $_GET['name'];

// SQL query with vulnerability (SQL Injection)
$query = "SELECT * FROM products WHERE id = $id AND name = '$name'";
$result = $conn->query($query);

// Bug: Uninitialized variable
$price;

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        // Bug: Incorrect usage of variable
        echo "Product: " . $row["name"] . " - Price: " . $price . "<br>";
    }
} else {
    echo "0 results";
}

// Bug: Potential Cross-Site Scripting (XSS)
echo "User input: " . $_GET['name'];

$conn->close();
?>
