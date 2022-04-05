<?php
$servername = "localhost";
$username = "root";
$password = "";
$DbNmae = "payroll_db";
global $SessionBol ;
$SessionBol = false;
	
// Create connection
$conn = new mysqli($servername, $username, $password,$DbNmae);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>