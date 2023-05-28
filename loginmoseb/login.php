<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Login form
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];
  
  $sql = "SELECT * users WHERE username='$username' AND password='$password'";
  $result = $conn->query($sql);
  
  if ($result->num_rows == 1) {
    $_SESSION["username"] = $username;
    header("Location: dashboard.php");
  } else {
    echo "Invalid username or password";
  }
}

// Signup form
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signup"])) {
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  
  $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
  
  if ($conn->query($sql) === TRUE) {
    $_SESSION["username"] = $username;
    header("Location: dashboard.php");
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
?>
