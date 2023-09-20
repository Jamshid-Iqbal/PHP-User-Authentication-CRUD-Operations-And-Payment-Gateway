<?php
function dbConnection(){
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "crud_and_payment_gateway";
$port = 3306;

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
  throw "Connection failed: " . mysqli_connect_error();
}
return $conn;
}
