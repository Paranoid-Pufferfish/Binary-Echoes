
<?php
$servername = "srv1160.hstgr.io";
$username = "u209047910_echoes";
$password = "Echoes123#";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
