<?php
$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // CONNECTING TO THE DATABASE HERE
    $mysqli = require __DIR__ . "/database.php";

    // Use prepared statement to prevent SQL injection
    $stmt = $mysqli->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $_POST["email"]);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the user data
    $user = $result->fetch_assoc();
    // if user data was found then check the password
    if ($user) {
        if (password_verify($_POST["password"], $user["password_hash"]))
            session_start();
        session_regenerate_id();

        $_SESSION["user_id"] = $user["id"];
        header("Location: index.php");
        die("Logged in succesfully!");
        exit;
    }
    // add things with the html page
    $is_invalid = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="styles2.css">
    <script src="js/functionality.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <div id="Login">
        <h1>Login</h1>
        <?php
        if ($is_invalid) : ?>
            <em>Invalid password or invalid email</em>
        <?php endif; ?>
        <form method="post" action="">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            <button type="submit" name="login">Log in</button>
        </form>
    </div>
</body>

</html>