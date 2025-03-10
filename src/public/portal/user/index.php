<?php
include __DIR__  . "/../../../utils/auth.php";

session_start();

if (!is_logged_in()) {
    header("Location: /portal/login.php");
}

$u = $_SESSION["user"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - School Manager</title>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css"
    >
    <script src="/assets/js/nav.js" defer></script>
</head>
<body>
    <main>
        <div class="section">
            <article class="media">
                <figure class="media-left">
                    <p class="image is-64x64">
                        <img src="https://bulma.io/assets/images/placeholders/128x128.png" />
                    </p>
                </figure>
                <div class="media-content">
                    <div class="content">
                        <p>
                            <strong><?= $u["name"]; ?></strong> <small>@<?= $u["id"]; ?></small>
                        </p>
                    </div>
                </div>
            </article>
            <nav class="navbar is-info" role="navigation" aria-label="sub navigation">
                <div class="navbar-brand">
                    <a role="button" class="has-text-white navbar-burger" aria-label="menu" aria-expanded="false" data-target="mainNavbar">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    </a>
                </div>
                <div id="mainNavbar" class="navbar-menu">
                    <div class="navbar-start">
                        <a class="navbar-item" href="/portal/books.php">
                            Your details
                        </a>
                        <a class="navbar-item" href="/portal/contact.php">
                            Your contact information
                        </a>
                        <a class="navbar-item" href="/portal/classes.php">
                            Your classes
                        </a>
                        <a class="navbar-item" href="/portal/salery.php">
                            Your salery
                        </a>
                        <a class="navbar-item" href="/portal/books.php">
                            Your books
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </main>
</body>
</html>