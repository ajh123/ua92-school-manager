<?php
include_once __DIR__  . "/../utils/auth.php";

session_start();

if (is_logged_in()) {
    logout();
}
header("Location: /index.php");

