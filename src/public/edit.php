<?php
include __DIR__  . "/../utils/auth.php";
include __DIR__  . "/../utils/admin_layout.php";
include __DIR__  . "/../utils/forms.php";

session_start();

if (!is_logged_in()) {
    header("Location: /login.php");
}

$u = $_SESSION["user"];

$table = $_GET["table"];
?>

<?php begin_layout("Showing $table"); ?>
<h2>Insert into <?php echo $table; ?></h2>
<?php echo_form($table); ?>
<?php end_layout(); ?>