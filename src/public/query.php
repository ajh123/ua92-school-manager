<?php
include_once __DIR__  . "/../utils/auth.php";
include_once __DIR__  . "/../utils/admin_layout.php";
include_once __DIR__  . "/../utils/forms.php";

session_start();

if (!is_logged_in()) {
    header("Location: /login.php");
}

$u = $_SESSION["user"];

$table = $_GET["table"];
?>

<?php begin_layout("Showing $table", $u["id"]); ?>
<h2>Showing <?php echo $table; ?></h2>
<div class="table-responsive small">
    <?php echo_table($table, $u["id"]); ?>
</div>
<?php end_layout(); ?>