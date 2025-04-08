<?php
include_once __DIR__  . "/../utils/auth.php";
include_once __DIR__  . "/../utils/forms.php";

session_start();
clear_errors();
clear_values();

if (is_logged_in()) {
    header("Location: index.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $unhashed_password = $_POST["password"];

    $result = login($email, $unhashed_password);

    if ($result == false) {
        push_error("email", "Email is invalid");
        push_error("password", "Password is invalid");

        push_value("email", $email);
        push_value("password", $unhashed_password);
    } else {
        $_SESSION["user"] = $result;
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/5.3/examples/sign-in/sign-in.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
</head>
<!-- SOURCE: `view-source:https://getbootstrap.com/docs/5.3/examples/sign-in/` ACCESSED 13/03/2025 - MIT LICENSE-->
<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin w-100 m-auto">
        <form method="post">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            <div class="form-floating">
                <input name="email" type="email" class="form-control <?= get_error("email") ? "is-invalid" : "" ?>" id="floatingInput" placeholder="name@example.com" aria-describedby="validationServerEmailFeedback" required value="<?= get_value("email"); ?>">
                <label for="floatingInput">Email address</label>
                <div id="validationServerEmailFeedback" class="invalid-feedback">
                    <?= get_error("email"); ?>
                </div>
            </div>
            <div class="form-floating">
                <input name="password" type="password" class="form-control <?= get_error("password") ? "is-invalid" : "" ?>" id="floatingPassword" placeholder="Password" aria-describedby="validationServerPasswordFeedback" required value="<?= get_value("password"); ?>">
                <label for="floatingPassword">Password</label>
                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                    <?= get_error("password"); ?>
                </div>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-body-secondary">Don't have an account? Contact the school administrator.</p>
            <p class="mt-5 mb-3 text-body-secondary">&copy; 2017 - 2025</p>
        </form>
    </main>
</body>
</html>
<!-- END SOURCE -->