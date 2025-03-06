<?php
include "../../auth.php";

session_start();

if (!is_logged_in()) {
    header("Location: /portal/login.php");
}
?>