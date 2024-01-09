<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["task_id"]) && isset($_POST["new_description"])) {
    $taskId = $_POST["task_id"];
    $newDescription = $_POST["new_description"];
    $userId = $_SESSION["user_id"];

    $mysqli = require __DIR__ . "/database.php";

    // Update the task description in the tasks table
    $updateTaskQuery = "UPDATE tasks SET task_description = '$newDescription' WHERE id = $taskId AND user_id = $userId";
    $mysqli->query($updateTaskQuery);
}
?>
