<?php
include_once __DIR__  . "/../utils/auth.php";
include_once __DIR__  . "/../utils/admin_layout.php";
include_once __DIR__  . "/../utils/forms.php";
include_once __DIR__  . "/../utils/db.php";

session_start();

if (!is_logged_in()) {
    header("Location: /login.php");
}

$u = $_SESSION["user"];

$table = $_GET["table"];

$id = null;
if (array_key_exists("id", $_GET)) {
    $id = $_GET["id"];
}

$isError = false;
$message = "";

$deletePermission = strtolower("table.$table.delete");
$deleteable = has_permission($u, $deletePermission);

if (!$deleteable) {
    $isError = true;
    $message = "You are not allowed to delete from this table.";
}

// The form will send its data using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST" && $deleteable == true) {
    // We need to check if the user is allowed to operate on that table
    if (in_array($table, allowed_tables)) {
        $sql = "DELETE FROM `$table` WHERE `id` = ?";

        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // We use prepared statements and bind params to prevent SQL injection
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                $message = "Record deleted successfully.";
            } else {
                $message = "Error: " . $stmt->error;
                $isError = true;
            }

            $stmt->close();
        } else {
            $message = "Error: " . $conn->error;
            $isError = true;
        }
    } else {
        $message = "Invalid table name.";
        $isError = true;
    }
}
?>

<?php begin_layout("Delete from $table"); ?>
<h2>Delete from <?php echo $table; ?></h2>

<?php
if ($isError) { // If there is an error we want a red/danger alert
    echo "<div class='alert alert-danger' role='alert'>$message</div>";
} else { // Otherwise we want a green/success alert
    if (strlen($message) > 0) { // but only if the message is not empty
        echo "<div class='alert alert-success' role='alert'>$message</div>";
    }
    if ($_SERVER["REQUEST_METHOD"] == "GET" && $deleteable == true) {
        echo "<form action='delete.php?table=$table&id=$id' method='POST'>";
        echo "<div class='alert alert-danger' role='alert'>Are you sure you want to delete row $id from $table?</div>";
        echo "<button type='submit' class='btn btn-light'>I am sure.</button>";
        echo "</form>";
    }
}
?>

<?php end_layout(); ?>