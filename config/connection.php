<?php
// Database connection
$severname = "localhost";
$username = "root";
$password = "1234";
$dbname = "student_management";

// Create connection
$conn = new mysqli($severname, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} else {
  // echo "Connected successfully";
}
