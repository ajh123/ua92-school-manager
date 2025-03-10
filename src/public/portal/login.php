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
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css"
    >
    <script src="/assets/js/nav.js" defer></script>
</head>
<body>
    <nav class="navbar is-link" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="/">
                St Alphonsus Primary School
            </a>
            <a role="button" class="navbar-burger has-text-white" aria-label="menu" aria-expanded="false" data-target="mainNavbar">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            </a>
        </div>
        <div id="mainNavbar" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="/index.php">
                    Home
                </a>
                <a class="navbar-item" href="/contact.php">
                    Contact Us
                </a>
            </div>
            <div class="navbar-end">
                <a class="navbar-item" href="/portal/index.php">
                    Portal
                </a>
            </div>
        </div>
    </nav>
    <main>
        <div class="section">
            <div class="container">
                <h2>Login</h2>
                <form method="post">
                    <div class="field">
                        <label class="label" for="email">Email</label>
                        <input class="input" name="email" type="email" required>
                    </div>
                    <div class="field">
                        <label class="label" for="password">Password</label>
                        <input class="input" name="password" required type="password"></textarea>
                    </div>
                    <div class="control">
                        <button class="button is-primary">Send</button>
                    </div>
                </form>
                <p>Don't have an account? Contact the school administrator.<p>
            </div>
        </div>
    </main>
</body>
</html>