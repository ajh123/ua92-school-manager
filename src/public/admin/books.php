<?php
include __DIR__  . "/../../utils/auth.php";
include __DIR__  . "/../../utils/admin_layout.php";
include __DIR__  . "/../../utils/forms.php";

session_start();

if (!is_logged_in()) {
    header("Location: /login.php");
}

$u = $_SESSION["user"];
?>

<?php begin_layout("All books"); ?>
<h2>All books</h2>
<div class="table-responsive small">
    <?php echo_table("Books"); ?>
</div>
<?php end_layout(); ?>