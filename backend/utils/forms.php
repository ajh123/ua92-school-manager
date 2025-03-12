<?php
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