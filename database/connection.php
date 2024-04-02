<?php
require('../config.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = $ENV['HOST'];
$username = $ENV['USERNAME'];
$password = $ENV['PASSWORD'];
$database = $ENV['DATABASE'];

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

#$conn->close();
