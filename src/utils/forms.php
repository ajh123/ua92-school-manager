<?php
include_once __DIR__  . "/db.php";
include_once __DIR__  . "/../utils/permissions.php";

/**
 * Clears any error messages from memory
 */
function clear_errors() {
    $_SESSION["errors"] = [];
}

/**
 * Updates error message memory to contain a value
 * 
 * @param string $key The id/key of the error message
 * @param string $message The value of the message
 */
function push_error($key, $message) {
    if (!isset($_SESSION["errors"])) {
        clear_errors();
    }

    $_SESSION["errors"][$key] = $message;
}

/**
 * Gets the error message by key
 * 
 * @param $key The id/key of the error message
 * @return null/string The value of the error message or 
 * null if the message does not exist
 */
function get_error($key) {
    if (!isset($_SESSION["errors"][$key])) {
        return null;
    }
    return $_SESSION["errors"][$key];
}

/**
 * Clears any form values from memory
 */
function clear_values() {
    $_SESSION["values"] = [];
}

/**
 * Updates form value memory to contain a value
 * 
 * @param string $key The id/key of the form value
 * @param any $value The value of the form
 */
function push_value($key, $value) {
    if (!isset($_SESSION["values"])) {
        clear_values();
    }

    $_SESSION["values"][$key] = $value;
}

/**
 * Gets the form value by key
 * 
 * @param $key The id/key of the form value
 * @return null/any The value of the value or 
 * null if the value does not exist
 */
function get_value($key) {
    if (!isset($_SESSION["values"][$key])) {
        return null;
    }
    return $_SESSION["values"][$key];
}

const allowed_tables = [
    "Roles",
    "ContactInformation",
    "MedicalInformation",
    "Users",
    "Groups",
    "GroupAssignments",
    "Salaries",
    "GuardianAssignments",
    "Classes",
    "ClassAssignments",
    "Attendance",
    "Books",
    "BookAssignments"
];

/**
 * Renders a database table on the page.
 * 
 * @param string $name The name of the database table
 * @param array/null $u The user object viewing the table
 */
function echo_table($name, $u=null) {
    $viewPermisson = strtolower("table.$name.view");
    $viewable = has_permission($u, $viewPermisson);

    $updatePermisson = strtolower("table.$name.update");
    $updateable = has_permission($u, $updatePermisson);

    $insertPermisson = strtolower("table.$name.insert");
    $insertable = has_permission($u, $insertPermisson);

    $deletePermisson = strtolower("table.$name.delete");
    $deleteable = has_permission($u, $deletePermisson);

    if (!in_array($name, allowed_tables) | !$viewable) {
        echo "<div class='alert alert-danger' role='alert'>You are not allowed to access that table.</div>";
        return;
    }

    global $conn;

    $sql = "SELECT * FROM $name";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $all = false;

    if ($result->num_rows > 0) {
        $all = $result->fetch_all(MYSQLI_ASSOC);
    }

    if ($all != false) {
        $keys = array_keys($all[0]);

        echo "<div class='alert alert-success' role='alert'>MySQL query was successful. $result->num_rows rows were returned. </div>";

        if ($insertable) {
            echo "<a href='/insert.php?table=$name' class='btn btn-light'>Insert into $name</a>";
        }

        echo "<table class='table table-striped table-sm'>";
        echo "<thead>";
        echo "<tr>";
        foreach ($keys as $key) {
            echo "<th scope='col'>$key</th>";
        }
        echo "<th scope='col'>Operations</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($all as $row) {
            echo "<tr>";
            foreach ($row as $row_col) {
                echo "<td>$row_col</td>";
            }
            $id = $row["id"];
            echo "<td>";
            if ($updateable) {
                echo "| <a href='/update.php?table=$name&id=$id'>Edit</a> |";
            }
            if ($deleteable) {
                echo "| <a href='/delete.php?table=$name&id=$id'>Delete</a> |";
            }
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<div class='alert alert-warning' role='alert'>MySQL returned an empty response.</div>";

        if ($insertable) {
            echo "<a href='/insert.php?table=$name' class='btn btn-light'>Insert into $name</a>";
        }
    }
}

/**
 * Renders a form based on a database table on the page.
 * 
 * @param string $name The name of the database table
 * @param int/null $id The id of a row in the table
 * @param string $page The file name of the current page
 */
function echo_form($name, $id=null, $page) {
    if (!in_array($name, allowed_tables)) {
        echo "<div class='alert alert-danger' role='alert'>You are not allowed to access that table.</div>";
        return;
    }
    global $conn;

    $existing_values = [];
    if ($id != null) {
        $sql = "SELECT * FROM $name WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $existing_values = $result->fetch_assoc();
        }
    }

    // Query to get table schema
    $result = $conn->query("DESCRIBE $name");

    if (!$result) {
        echo "<div class='alert alert-danger' role='alert'>There was an error whilst rendering the form.</div>";
        return;
    }

    // Start form rendering
    echo "<form action='$page?table=$name&id=$id' method='POST'>";

    while ($column = $result->fetch_assoc()) {
        $fieldName = htmlspecialchars($column['Field']);
        $fieldType = strtolower($column['Type']);
        $isNullable = $column['Null'] === 'YES';
        $defaultValue = $column['Default'];

        // Determine input type based on column type
        if (strpos($fieldType, 'int') !== false) { // If the field type is an int, then render the input as a number
            $inputType = 'number';
        } elseif (strpos($fieldType, 'varchar') !== false || strpos($fieldType, 'text') !== false) { // if the field type is string based, then render the input as text
            $inputType = 'text';
        } elseif (strpos($fieldType, 'date') !== false) { // if type is date render input as date
            $inputType = 'date';
        } elseif (strpos($fieldType, 'enum') !== false) { // if type is an enum then render a drop down select of the options
            preg_match("/enum\((.*)\)/", $fieldType, $matches);
            $enumValues = str_getcsv(str_replace("'", "", $matches[1]));
            $inputType = 'select';
        } else {
            $inputType = 'text';
        }

        // Render input field
        echo "<label for='$fieldName' class='form-label'>".ucwords(str_replace('_', ' ', $fieldName)).":</label>";


        if (array_key_exists($fieldName, $existing_values)) {
            $defaultValue = $existing_values[$fieldName];
        }

        if ($inputType === 'select') {
            echo "<select name='$fieldName' id='$fieldName' class='form-select'>";
            foreach ($enumValues as $value) {
                echo "<option value='$value'>$value</option>";
            }
            echo "</select>";
        } else {
            echo "<input type='$inputType' class='form-control' name='$fieldName' id='$fieldName' value='$defaultValue' " . ($isNullable ? "" : "required") . ">";
        }

        echo "<br>";
    }

    echo "<button type='submit' class='btn btn-light'>Submit</button>";
    echo "</form>";
}