<?php
include __DIR__  . "/db.php";

function clear_errors() {
    $_SESSION["errors"] = [];
}

function push_error($key, $message) {
    if (!isset($_SESSION["errors"])) {
        clear_errors();
    }

    $_SESSION["errors"][$key] = $message;
}

function get_error($key) {
    if (!isset($_SESSION["errors"][$key])) {
        return null;
    }
    return $_SESSION["errors"][$key];
}

function clear_values() {
    $_SESSION["values"] = [];
}

function push_value($key, $message) {
    if (!isset($_SESSION["values"])) {
        clear_values();
    }

    $_SESSION["values"][$key] = $message;
}

function get_value($key) {
    if (!isset($_SESSION["values"][$key])) {
        return null;
    }
    return $_SESSION["values"][$key];
}

function echo_table($name, $editable=true) {
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
        
        echo "<div class='alert alert-success' role='alert'>MySQL qurey was successfull. $result->num_rows rows were returned. </div>";
        
        if ($editable) {
            echo "<button type='button' class='btn btn-light'>Insert into $name</button>";
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
            if ($editable) {
                echo "<td><a>Edit</a> | <a>Delete</a></td>";
            }
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<div class='alert alert-warning' role='alert'>MySQL returned an empty response.</div>";
    }
}