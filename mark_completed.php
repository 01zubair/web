<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["task_id"])) {
    $taskId = $_POST["task_id"];
    $userId = $_SESSION["user_id"];

    $mysqli = require __DIR__ . "/database.php";

    // Delete the task from the tasks table
    $deleteTaskQuery = "DELETE FROM tasks WHERE id = $taskId AND user_id = $userId";
    $mysqli->query($deleteTaskQuery);
}
