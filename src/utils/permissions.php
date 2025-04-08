<?php
include_once __DIR__  . "/db.php";

/**
 * For a given user, teturns an array of string where each
 * string represents a permission.
 * 
 * @param int $uid The user ID
 * @return string[] The array of permissions
 */
function get_user_permissions($uid) {
    global $conn;

    // First, get the user by id only
    $sql = "SELECT * FROM Users WHERE id=?";    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $uid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();

        $roleID = $data["roleID"];
        // Second, get the role by id only
        $sql = "SELECT * FROM Roles WHERE id=?";    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $roleID);
        $stmt->execute();
        $roleResult = $stmt->get_result();

        if ($roleResult->num_rows > 0) {
            $data = $roleResult->fetch_assoc();
            $permissions = $data["permissions"];
            // Third, convert the string into an array
            return explode(";", $permissions);
        }
    }
    return null;
}

/**
 * Returns a bolean if the user has the given permission.
 * 
 * @param int $uid The user ID
 * @param string $ppermission The permission name to check for
 */
function has_permission($uid, $permission) {
    $permissions = get_user_permissions($uid);
    if ($permissions == null) {
        return false; // Return false
    }

    foreach ($permissions as $perm) {
        // Convert wildcard '*' into a regex pattern
        $pattern = str_replace(['.', '*'], ['\.', '.*'], $perm);

        // Check if the permission matches
        if (preg_match('/^' . $pattern . '$/', $permission)) {
            return true;
        }
    }
    return false;
}