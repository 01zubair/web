<?php
$host = "127.0.0.1";
$port = 3308; // Change this to the correct port if it's different
$dbname = "login_db";
$username = "root";
$password = "new_password";

$mysqli = new mysqli($host, $username, $password, $dbname, $port);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

echo "Connected successfully"; // You can remove this line once the connection is successful

// Note: Avoid using 'return' unless you are in a function
