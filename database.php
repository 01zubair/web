<?php
// Assuming $mysqli is already established and connected

// Your SQL query (replace this with your actual query)
$sql = "SELECT * FROM your_table WHERE username = ?";

// Example using prepared statement
$stmt = $mysqli->prepare($sql);

if ($stmt === false) {
    die("Error in preparing statement: " . $mysqli->error);
}

// Example binding parameters (replace with your actual parameters)
$username = "example_user";
$stmt->bind_param("s", $username);

// Execute the statement
$stmt->execute();

// Do something with the results...

// Close the statement
$stmt->close();

// Close the connection if you're done
$mysqli->close();
?>
