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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST as $key => $value) {
        echo "$key:$value\n";
    }
}
?>

<?php begin_layout("Showing $table"); ?>
<h2>Insert into <?php echo $table; ?></h2>
<?php echo_form($table); ?>
<?php end_layout(); ?>