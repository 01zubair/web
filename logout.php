<?php
// Anytime we use session destroy, we must use session start
session_start();
session_destroy();
?>

<html lang="en">

<head>
    <script src="js/functionality.js"></script>
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="js/validation.js" defer></script>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
</head>

<body>
    <div id="initialContent">
        <button id="signupButton" onclick="toggleVisibilityForSignupContent()">Sign up</button>
        <button id="loginButton" onclick="openLink()">Log in</button>
    </div>

    <div id="signupContent" class="hidden">
        <form method="post" action="process-signup.php" method="post" id="signupForm" novalidate>
            <h1>Sign up</h1>

            <label for="name">Name</label>
            <input type="text" id="name" name="name">

            <label for="email">Email</label>
            <input type="email" name="email" id="email">

            <label for="password">Password</label>
            <input type="password" id="password" name="password">

            <label for="password_confirmation">Repeat Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation">

            <button type="submit">Sign up</button>
        </form>
    </div>

    <script src="js/signup.js" defer></script>
</body>

</html>