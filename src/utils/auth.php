<?php
include __DIR__  . "/db.php";

function login($email, $password) {
    global $conn;

    // First, get the user by username only
    $sql = "SELECT * FROM Users WHERE email=?";    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password against the stored hash
        if (password_verify($password, $row['password'])) {
            return $row;
        }
    }
    return false;
}

function is_logged_in() {
    return isset($_SESSION["user"]);
}

function logout() {
    unset($_SESSION["user"]);
    session_destroy();
    header("Location: /index.php");
}