<?php
include_once __DIR__  . "/db.php";

/**
 * Checks if the input password matches with the stored password
 * 
 * @param string $email The email address of the user
 * @param string $password The raw non-hashed input password
 * @return array/false Returns user info array if success, returns false if not sucess
 */
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

/**
 * Checks if the user is logged in with using session
 * 
 * @return boolean True if logged in, false if not
 */
function is_logged_in() {
    return isset($_SESSION["user"]);
}

/**
 * Cleans up the current session and redirect to index page
 */
function logout() {
    unset($_SESSION["user"]);
    session_destroy();
    header("Location: /index.php");
}