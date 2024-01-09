<?php
session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}

// Process task addition only when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["taskDescription"])) {
    $taskDescription = $_POST["taskDescription"];

    if (!empty($taskDescription) && isset($_SESSION["user_id"])) {
        $userId = $_SESSION["user_id"];

        // Insert the task into the tasks table
        $insertTaskQuery = "INSERT INTO tasks (user_id, task_description, completed) VALUES ($userId, '$taskDescription', 0)";
        $mysqli->query($insertTaskQuery);

        // Redirect to prevent form resubmission on page reload
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>




<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>


    <link rel="stylesheet" href="styles3.css">
    <script src="js/functionality.js"></script>


</head>

<body>

    <?php
    if (isset($user)) :  ?>
        <button id="logoutLink1" onclick="openLink2();">Log Out</button>
        <h1>Maximize Productivity Today, <?= htmlspecialchars($user["name"])  ?>!
        </h1>

        <!-- todo_list.html content -->
        <h2>Your To-Do List</h2>


        <ol id="taskList">
            <?php
            // Retrieve tasks for the current user
            $tasksQuery = "SELECT * FROM tasks WHERE user_id = {$_SESSION["user_id"]}";
            $tasksResult = $mysqli->query($tasksQuery);

            while ($task = $tasksResult->fetch_assoc()) {
                echo '<li><input type="checkbox" data-task-id="' . $task["id"] . '">' . htmlspecialchars($task["task_description"]) . '</li>';
            }
            ?>
        </ol>

        <form method="post" id="taskForm">
            <input type="text" name="taskDescription" id="taskInput" placeholder="Add a new task" required>
            <button id="" type="submit">Add Task</button>
        </form>

        <!-- todo_list.html content -->
        <script>
            document.getElementById("taskList").addEventListener("change", function(event) {
                // Check if the clicked element is a checkbox
                if (event.target.tagName === "INPUT" && event.target.type === "checkbox") {
                    // Get the task ID from the data-task-id attribute
                    var taskId = event.target.getAttribute("data-task-id");

                    // Send an AJAX request to mark the task as completed
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "mark_completed.php", true);
                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhr.send("task_id=" + taskId);

                    // Remove the task from the list
                    event.target.parentNode.remove();
                }
            });

            document.getElementById("taskList").addEventListener("click", function(event) {
                // Check if the clicked element is an "Edit" button
                if (event.target.tagName === "BUTTON" && event.target.classList.contains("edit-btn")) {
                    var listItem = event.target.parentNode;
                    var taskDescription = listItem.querySelector("span").textContent.trim();

                    // Replace the task text with an input field for editing
                    listItem.innerHTML = '<input type="text" class="edit-input" value="' + taskDescription + '">' +
                        '<button class="save-btn">Save</button>';

                    // Add an event listener to the "Save" button
                    listItem.querySelector(".save-btn").addEventListener("click", function() {
                        var newTaskDescription = listItem.querySelector(".edit-input").value;
                        var taskId = listItem.querySelector("input[type='checkbox']").getAttribute("data-task-id");

                        // Send an AJAX request to edit the task
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "edit_task.php", true);
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                                // Update the task description on the client side
                                listItem.innerHTML = '<input type="checkbox" data-task-id="' + taskId + '">' +
                                    '<span>' + newTaskDescription + '</span>' +
                                    '<button class="edit-btn">Edit</button>';
                            }
                        };
                        xhr.send("newTaskDescription=" + encodeURIComponent(newTaskDescription) + "&task_id=" + taskId);
                    });
                }


            });
        </script>


    <?php else : ?>
        <p><a href="login.php">Log in</a> or <a href="signup.html">Sign up</a></p>
    <?php endif; ?>



    <div class="container1">
        <h2 class="pomo">
            Try Pomodoro!
        </h2>
        <div class="timer-display">
            24 : 59
        </div>
        <div class="buttons1">
            <button id="start-timer">Start</button>
            <button id="pause-timer">Pause</button>
            <button id="reset-timer">Reset</button>
        </div>
    </div>




    <script src="js/script.js"></script>

</body>

</html>