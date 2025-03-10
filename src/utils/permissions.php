<?php
include __DIR__  . "/db.php";

const PAGE_ADMIN_BOOKS = "page.admin.books";
const PAGE_ADMIN_ROLES = "page.admin.roles";
const PAGE_ADMIN_USERS = "page.admin.users";
const PAGE_CLASS_ATTENDANCE = "page.class.attendance";
const PAGE_CLASS_HOME = "page.class.home";
const PAGE_USER_BOOKS = "page.user.books";
const PAGE_USER_CONTACT = "page.user.contact";
const PAGE_USER_CLASS = "page.user.class";
const PAGE_USER_HOME = "page.user.home";
const PAGE_USER_SALERY = "page.user.salery";

const ALL_PERMSSIONS = [
    PAGE_ADMIN_BOOKS,
    PAGE_ADMIN_ROLES,
    PAGE_ADMIN_USERS,
    PAGE_CLASS_ATTENDANCE,
    PAGE_CLASS_HOME,
    PAGE_USER_BOOKS,
    PAGE_USER_CONTACT,
    PAGE_USER_CLASS,
    PAGE_USER_HOME,
    PAGE_USER_SALERY
];

function get_user_permissions($uid) {
    global $conn;

    // First, get the user by id only
    $sql = "SELECT * FROM Users WHERE id=?";    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $uid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $roleID = $result["roleID"];
        // Second, get the role by id only
        $sql = "SELECT * FROM Roles WHERE id=?";    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $roleID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $permissions = $result["permissions"];
            // Third, convert the string into an array
            return explode(";", $permissions);
        }
    }
    return null;
}

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