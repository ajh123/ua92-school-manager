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

$updatePermisson = strtolower("table.$table.update");
$updatable = has_permission($u, $updatePermisson);

if (!$updatable) {
    $isError = true;
    $message = "You are not allowed to update this table.";
}

// The form will send its data using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST" && $updatable == true) {
    // We need to check if the user is allowed to operate on that table
    if (in_array($table, allowed_tables)) {
        $columns = array_keys($_POST);
        $values = array_values($_POST);

        // Determine data types for binding
        $types = "";
        foreach ($values as $value) {
            if (is_int($value)) {
                $types .= "i"; // Integer
            } elseif (is_float($value)) {
                $types .= "d"; // Double
            } else {
                $types .= "s"; // String
            }
        }

        // Replace empty strings with null.
        foreach ($values as $i => $value) {
            if ($value === "") $values[$i] = null;
        }


        // Dynamically create the update command
        $setPlaceholders = implode(", ", array_map(fn($col) => "`$col` = ?", $columns));
        $sql = "UPDATE `$table` SET $setPlaceholders WHERE `id` = ?";

        // Add the ID to the values array for the WHERE clause
        $values[] = $id;
        $types .= is_int($id) ? "i" : "s"; // Adjust type binding for `id`

        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // We use prepared statements and bind params to prevent SQL injection
            $stmt->bind_param($types, ...$values);

            if ($stmt->execute()) {
                $message = "Record updated successfully.";
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

<?php begin_layout("Update $table"); ?>
<h2>Update <?php echo $table; ?></h2>

<?php
if ($isError) { // If there is an error we want a red/danger alert
    echo "<div class='alert alert-danger' role='alert'>$message</div>";
} else { // Otherwise we want a green/success alert
    if (strlen($message) > 0) { // but only if the message is not empty
        echo "<div class='alert alert-success' role='alert'>$message</div>";
    }
    echo_form($table, $id, "update.php");
}
?>

<?php end_layout(); ?>