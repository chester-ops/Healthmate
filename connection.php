<?php

// Connection
$servername = "localhost";
$username = "root";
$password = "";
$db = "healthmate";

// Global path variable
define('ROOT', 'http://' . $servername . '/' . $db);

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset('utf8');