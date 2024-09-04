<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    switch ($_SESSION["user_role"]) {
        case 'owner':
            header("location: owner-dashboard");
            break;
        case 'staff':
            header("location: staff-dashboard");
            break;
    }
    exit;
}

require_once "config.php";

$username = $password = $username_err = $password_err = $login_err = $user_roles = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter password.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($username_err) && empty($password_err)) {
        $user_roles = ['owner', 'staff'];

        foreach ($user_roles as $role) {
            if ($role == "owner") {
                $role_id = "owner_id";
            } elseif ($role == "staff") {
                $role_id = "staff_id";
            }
            $sql = "SELECT $role_id, username, password FROM $role WHERE username = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                $param_username = $username;

                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                        if (mysqli_stmt_fetch($stmt)) {
                            if (password_verify($password, $hashed_password)) {
                                session_start();

                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;
                                $_SESSION["user_role"] = $role;

                                switch ($role) {
                                    case 'owner':
                                        header("location: owner-dashboard");
                                        break;
                                    case 'staff':
                                        header("location: staff-dashboard");
                                        break;
                                }
                            } else {
                                $login_err = "Invalid email or password.";
                            }
                        }
                    } else {
                        $login_err = "Invalid email or password.";
                    }
                }
            } else {
                $login_err = "Invalid email or password.";
            }
        }

    }

    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php include 'partials/header.php'; ?>
</head>

<style>
    .btn-primary {
        background-color: #000000;
        border-color: #000000;
    }

    .btn-primary:hover {
        background-color: #171717;
        border-color: #171717;
    }

    .btn-primary:before {
        background-color: #171717;
        border-color: #171717;
    }

    .label-style {
        font-size: 16px;
        color: #000000;
        margin-left: 4px;
        margin-bottom: -4px;
    }
</style>

<body class="light">
    <div class="wrapper vh-100">
        <div class="row align-items-center h-100">
            <form class="col-lg-3 col-md-4 col-10 mx-auto"
                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="text-center mb-4">
                    <img src="assets/images/logo.png" alt="" width="260">
                </div>
                <?php
                if (!empty($login_err)) {
                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                }
                ?>
                <div class="form-group">
                    <label for="inputUsername" class="label-style">Username</label>
                    <input type="text" id="inputUsername"
                        class="form-control form-control-lg <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                        placeholder="Enter your username" name="username" value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="label-style">Password</label>
                    <input type="password" id="inputPassword"
                        class="form-control form-control-lg <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                        placeholder="Enter your password" name="password" value="<?php echo $password; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <div class="row mb-3">
                    <div class="col text-left">
                        <div class="show-password">
                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="customControlValidation1">
                                <label class="custom-control-label" for="customControlValidation1">Show Password</label>
                            </div>
                        </div>
                    </div>
                    <div class="col text-right">
                        <div class="forgot-password">
                            <a href="#" style="color: #000000;">Forgot Password?</a>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        var passwordInput = document.getElementById('inputPassword');
                        var showPasswordCheckbox = document.getElementById('customControlValidation1');

                        showPasswordCheckbox.addEventListener('change', function () {
                            if (showPasswordCheckbox.checked) {
                                passwordInput.type = 'text';
                            } else {
                                passwordInput.type = 'password';
                            }
                        });
                    });
                </script>

                <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign In</button>
                <p class="mt-5 mb-3 text-muted text-center">© 2024</p>
            </form>
        </div>
    </div>
    <?php include 'partials/jscripts.php'; ?>
</body>

</html>