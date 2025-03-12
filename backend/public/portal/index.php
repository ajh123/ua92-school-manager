<?php
include __DIR__  . "/../../utils/auth.php";

session_start();

if (!is_logged_in()) {
    header("Location: /portal/login.php");
}

header("Location: /portal/user");
?>
