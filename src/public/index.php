<?php
include_once __DIR__  . "/../utils/auth.php";
include_once __DIR__  . "/../utils/admin_layout.php";

session_start();

if (!is_logged_in()) {
    header("Location: /login.php");
}

$u = $_SESSION["user"];
?>

<?php begin_layout("Home"); ?>
<div class="container text-center">
    <h2>Manage</h2>
    <div class="row row-cols-2 row-cols-md-4 g-3">
    <?php
        foreach (allowed_tables as $table) {
            if (has_permission($u, strtolower("table.$table.view"))) {
                echo "<div class='col'><a class='btn btn-primary w-100' href='/query.php?table=$table'>Manage $table</a></div>";
            }
        }
    ?>
  </div>
</div>
<div class="container text-center">
    <h2>Your information</h2>
    <table class="table">
        <tbody>
            <tr>
                <th scope="row">Name</th>
                <td><?php echo $u["name"] ?></td>
            </tr>
            <tr>
                <th scope="row">Email</th>
                <td><?php echo $u["email"] ?></td>
            </tr>
            <tr>
                <th scope="row">Role</th>
                <td><?php echo $u["roleID"] ?></td>
            </tr>
            <tr>
                <th scope="row">Contact Information</th>
                <td><?php echo $u["contactID"] ?></td>
            </tr>
            <tr>
                <th scope="row">Medical Information</th>
                <td><?php echo $u["medicalID"] ?></td>
            </tr>
        </tbody>
    </table>
</div>
<?php end_layout(); ?>