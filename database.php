<?php
$host = "127.0.0.1";
$port = 3308; // Change this to the correct port if it's different
$dbname = "login_db";
$username = "root";
$password = "new_password";

$mysqli = new mysqli($host, $username, $password, $dbname, $port);

if ($mysqli->connect_errno) {
    die("connection error: " . $mysqli->connect_error);
}

return $mysqli;
