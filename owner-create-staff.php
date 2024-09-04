<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login");
    exit;
}

$active_page = "staff";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner - Create Staff</title>
    <?php include 'partials/header.php'; ?>
    <script src="js/jquery.slim.min.js"></script>
</head>

<style>
    .small-logo {
        width: 50px !important;
    }

    .page-title,
    .card-title {
        color: #000000;
    }

    .navbar-light .navbar-nav .nav-link {
        color: #000000 !important;
    }

    .btn-primary {
        background-color: #000000;
        border-color: #000000;
    }

    .btn-primary:hover {
        background-color: #171717;
        border-color: #171717;
    }
</style>


<body class="vertical  light">
    <div class="wrapper">
        <?php include 'partials/owner-navbar.php'; ?>
        <main role="main" class="main-content">
            <div class="container-fluid">
                <h2 class="page-title">Staff - Create Staff</h2>

                <?php
                $firstname = $lastname = $email = $password = $confirm_password = $username = $contact_number = $photo = "";
                $firstname_err = $lastname_err = $email_err = $password_err = $confirm_password_err = $username_err = $contact_number_err = $photo_err = "";
                $status = 0;

                if (isset($_POST["submit"])) {

                    if (empty(trim($_POST["firstname"]))) {
                        $firstname_err = "Please enter firstname.";
                    } else {
                        $firstname = mysqli_real_escape_string($link, $_POST["firstname"]);
                    }

                    if (empty(trim($_POST["lastname"]))) {
                        $lastname_err = "Please enter lastname.";
                    } else {
                        $lastname = mysqli_real_escape_string($link, $_POST["lastname"]);
                    }

                    if (empty(trim($_POST["email"]))) {
                        $email_err = "Please enter email.";
                    } else {
                        $email = mysqli_real_escape_string($link, ($_POST["email"]));
                    }

                    if (empty(trim($_POST["password"]))) {
                        $password_err = "Please enter a password.";
                    } elseif (strlen(trim($_POST["password"])) < 6) {
                        $password_err = "Password must have at least 6 characters.";
                    } else {
                        $password = trim($_POST["password"]);
                    }
                    
                    if (empty(trim($_POST["confirm_password"]))) {
                        $confirm_password_err = "Please confirm password.";
                    } else {
                        $confirm_password = trim($_POST["confirm_password"]);
                        if (empty($password_err) && ($password != $confirm_password)) {
                            $confirm_password_err = "Password did not match.";
                        }
                    }

                    if (empty(trim($_POST["username"]))) {
                        $username_err = "Please enter username.";
                    } else {
                        $sql = "SELECT username FROM staff WHERE username = ?";

                        if ($stmt = mysqli_prepare($link, $sql)) {
                            mysqli_stmt_bind_param($stmt, "s", $param_username);

                            $param_username = trim($_POST["username"]);

                            if (mysqli_stmt_execute($stmt)) {
                                mysqli_stmt_store_result($stmt);

                                if (mysqli_stmt_num_rows($stmt) == 1) {
                                    $username_err = "This username is already exist.";
                                } else {
                                    $username = trim($_POST["username"]);
                                }
                            } else {
                                echo "<script>swal({
                                    title: 'Oops!',
                                    text: 'Something went wrong. Please try again later.',
                                    icon: 'warning',
                                    button: 'Done!',
                                });</script>";
                            }

                            mysqli_stmt_close($stmt);
                        }
                    }

                    if (empty(trim($_POST["contact_number"]))) {
                        $contact_number_err = "Please enter contact number.";
                    } else {
                        $contact_number = mysqli_real_escape_string($link, ($_POST["contact_number"]));
                    }

                    if (empty($_FILES['photo']['name'])) {
                        $photo_err = "Please upload a photo.";
                    } else {
                        $photo = ($_FILES["photo"]["name"]);
                        $photo_tmp_name = $_FILES["photo"]["tmp_name"];
                        $photo_size = $_FILES["photo"]["size"];
                        $photo_new_name = rand() . $photo;
                    }

                    if (empty($firstname_err) && empty($lastname_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($username_err) && empty($contact_number_err) && empty($photo_err)) {


                        $sql = "INSERT INTO staff (status, username, password, email, firstname, lastname, contact_number, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

                        if ($stmt = mysqli_prepare($link, $sql)) {
                            mysqli_stmt_bind_param($stmt, "isssssss", $param_status, $param_username, $param_password, $param_email, $param_firstname, $param_lastname, $param_contact_number, $param_photo);

                            $param_status = $status;
                            $param_username = $username;
                            $param_password = password_hash($password, PASSWORD_DEFAULT);
                            $param_email = $email;
                            $param_firstname = $firstname;
                            $param_lastname = $lastname;
                            $param_contact_number = $contact_number;
                            $param_photo = $photo_new_name;

                            if (mysqli_stmt_execute($stmt)) {
                                move_uploaded_file($photo_tmp_name, "storage/profile/" . $photo_new_name);
                                // Clear all inputs
                                $firstname = $lastname = $email = $password = $confirm_password = $username = $contact_number = $photo = "";
                                echo "<script>swal({
                                    title: 'Success!',
                                    text: 'Staff A  cocount Created Successfully!',
                                    icon: 'success',
                                    closeOnClickOutside: false,
                                    button: false
                                });</script>";

                                ?>
                                <meta http-equiv="Refresh" content="3; url=owner-staff-list">
                                <?php


                            } else {
                                echo "<script>swal({
                                    title: 'Oops!',
                                    text: 'Something went wrong. Please try again later.',
                                    icon: 'warning',
                                    button: 'Done!',
                                });</script>";
                            }

                            // Close statement
                            mysqli_stmt_close($stmt);
                        }
                    }
                }

                ?>
                <form method="post" enctype="multipart/form-data">
                    <div class="row justify-content-center">
                        <div class="col-5">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <strong class="card-title">Staff Profile Photo</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <div class="text-center">
                                                    <img src="storage/profile/default_image.png"
                                                        class="avatar img-thumbnail mb-2" alt="avatar" height="250px"
                                                        width="250px">
                                                </div>
                                                <br>
                                                <label for="customFile">Choose Staff Profile Photo</label>
                                                <div class="custom-file">
                                                    <input type="file" id="customFile" accept="image/*" name="photo"
                                                        class="custom-file-input form-control <?php echo (!empty($photo_err)) ? 'is-invalid' : ''; ?> file-upload mb-3"
                                                        value="<?php echo $row['photo']; ?>">
                                                    <span class="invalid-feedback"><?php echo $photo_err; ?></span>
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        file</label>
                                                </div>
                                                <script>
                                                    $(document).ready(function () {

                                                        var readURL = function (input) {
                                                            if (input.files && input.files[0]) {
                                                                var reader = new FileReader();

                                                                reader.onload = function (e) {
                                                                    $('.avatar').attr('src', e.target.result);
                                                                }

                                                                reader.readAsDataURL(input.files[0]);
                                                            }
                                                        }


                                                        $(".file-upload").on('change', function () {
                                                            readURL(this);
                                                        });
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <strong class="card-title">Staff Profile Information</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mb-3">
                                                <label for="example-email">Username</label>
                                                <input type="text" id="example-username" name="username"
                                                    class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                                                    placeholder="Please enter username"
                                                    name="password" value="<?php echo $username; ?>">
                                                <span class="invalid-feedback"><?php echo $username_err; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mb-3">
                                                <label for="example-email">Firstname</label>
                                                <input type="text" id="example-firstname" name="firstname"
                                                    class="form-control <?php echo (!empty($firstname_err)) ? 'is-invalid' : ''; ?>"
                                                    placeholder="Please enter firstname"
                                                    value="<?php echo $firstname; ?>">
                                                <span class="invalid-feedback"><?php echo $firstname_err; ?></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group mb-3">
                                                <label for="example-email">Lastname</label>
                                                <input type="text" id="example-lastname" name="lastname"
                                                    class="form-control <?php echo (!empty($lastname_err)) ? 'is-invalid' : ''; ?>"
                                                    placeholder="Please enter lastname"
                                                    value="<?php echo $lastname; ?>">
                                                <span class="invalid-feedback"><?php echo $lastname_err; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-7">
                                            <div class="form-group mb-3">
                                                <label for="example-email">Email</label>
                                                <input type="email" id="example-email" name="email"
                                                    class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"
                                                    placeholder="Please enter email" value="<?php echo $email; ?>">
                                                <span class="invalid-feedback"><?php echo $email_err; ?></span>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="form-group mb-3">
                                                <label for="example-contact_number">Contact Number</label>
                                                <input type="text" id="example-contact_number" name="contact_number"
                                                    class="form-control <?php echo (!empty($contact_number_err)) ? 'is-invalid' : ''; ?>"
                                                    placeholder="Please enter contact number"
                                                    name="contact_number" value="+63<?php echo $contact_number; ?>" oninput="this.value = this.value.replace(/[^0-9\+]/g, '')" >
                                                <span class="invalid-feedback"><?php echo $contact_number_err; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mb-3">
                                                <label for="example-password">Password</label>
                                                <input type="password" id="example-password"
                                                    class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                                                    placeholder="Please enter password" name="password"
                                                    value="<?php echo $password; ?>">
                                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group mb-3">
                                                <label for="example-confirm_password">Confirm Password</label>
                                                <input type="password" id="example-confirm_password"
                                                    class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>"
                                                    placeholder="Please repeat password"
                                                    name="confirm_password" value="<?php echo $confirm_password; ?>">
                                                <span
                                                    class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-left">
                                            <div class="show-password">
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="customControlValidation1">
                                                    <label class="custom-control-label"
                                                        for="customControlValidation1">Show Password</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function () {
                                            var passwordInput = document.getElementById('example-password');
                                            var passwordInput2 = document.getElementById('example-confirm_password');
                                            var showPasswordCheckbox = document.getElementById('customControlValidation1');

                                            showPasswordCheckbox.addEventListener('change', function () {
                                                if (showPasswordCheckbox.checked) {
                                                    passwordInput.type = 'text';
                                                    passwordInput2.type = 'text';
                                                } else {
                                                    passwordInput.type = 'password';
                                                    passwordInput2.type = 'password';
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                        </div> <!-- / .card -->
                    </div> <!-- .row -->
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Create</button>
                </form>
            </div> <!-- .container-fluid -->

            <?php include 'partials/owner-modals.php'; ?>

        </main> <!-- main -->
    </div> <!-- .wrapper -->
    <?php include 'partials/jscripts.php'; ?>
</body>

</html>