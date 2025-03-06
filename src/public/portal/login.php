<?php
include "../../auth.php";

session_start();

if (is_logged_in()) {
    header("Location: index.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $unhashed_password = $_POST["password"];
 
    $result = login($email, $unhashed_password);

    if ($result == false) {
        echo "Invalid email or password";
    } else {
        $_SESSION["user"] = $result;
        header("Location: /portal/index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/assets/css/base.css">
    <link rel="stylesheet" href="/assets/css/containers.css">
    <link rel="stylesheet" href="/assets/css/nav.css">
</head>
<body>
    <main>
        <form method="post">
            <h1>Login</h1>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Login</button>
            <p>Don't have an account? Contact the school administrator.<p>
        </form>
    </main>
</body>
</html>