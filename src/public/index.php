<?php
include_once __DIR__  . "/../utils/auth.php";
include_once __DIR__  . "/../utils/admin_layout.php";

session_start();

if (!is_logged_in()) {
    header("Location: /login.php");
}

$u = $_SESSION["user"];
?>

<?php begin_layout("Home"); ?>
<h2>Home</h2>
<div class="table-responsive small">

</div>
<?php end_layout(); ?>