<?php
include __DIR__  . "/../../utils/auth.php";

session_start();

if (!is_logged_in()) {
    header("Location: /login.php");
}
?>