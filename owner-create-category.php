<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login");
    exit;
}

$active_page = "category";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner - Create Category</title>
    <?php include 'partials/header.php'; ?>
    <script src="js/jquery.slim.min.js"></script>
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
</style>



<body class="vertical  light">
    <div class="wrapper">
        <?php include 'partials/owner-navbar.php'; ?>
        <main role="main" class="main-content">
            <div class="container-fluid">
                <h2 class="page-title">Category - Create Category</h2>

                <?php
                $category_name = $photo = "";
                $category_name_err = $photo_err = "";
                $status = 0;

                if (isset($_POST["submit"])) {

                    if (empty(trim($_POST["category_name"]))) {
                        $category_name_err = "Please enter an category name.";
                    } else {
                        $sql = "SELECT category_id FROM category WHERE category_name = ?";

                        if ($stmt = mysqli_prepare($link, $sql)) {
                            mysqli_stmt_bind_param($stmt, "s", $param_category_name);

                            $param_category_name = trim($_POST["category_name"]);

                            if (mysqli_stmt_execute($stmt)) {
                                mysqli_stmt_store_result($stmt);

                                if (mysqli_stmt_num_rows($stmt) == 1) {
                                    $category_name_err = "This category is already exist.";
                                } else {
                                    $category_name = trim($_POST["category_name"]);
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

                    if (empty($_FILES['photo']['name'])) {
                        $photo_err = "Please upload a photo.";
                    } else {
                        $photo = ($_FILES["photo"]["name"]);
                        $photo_tmp_name = $_FILES["photo"]["tmp_name"];
                        $photo_size = $_FILES["photo"]["size"];
                        $photo_new_name = rand() . $photo;
                    }

                    if (empty($category_name_err) && empty($photo_err)) {


                        $sql = "INSERT INTO category (owner_id, category_name, status, photo) VALUES (?, ?, ?, ?)";

                        if ($stmt = mysqli_prepare($link, $sql)) {
                            mysqli_stmt_bind_param($stmt, "isis", $param_owner_id, $param_category_name, $param_status, $param_photo);

                            $param_owner_id = $owner_id;
                            $param_category_name = $category_name;
                            $param_status = $status;
                            $param_photo = $photo_new_name;

                            if (mysqli_stmt_execute($stmt)) {
                                move_uploaded_file($photo_tmp_name, "storage/category/" . $photo_new_name);
                                // Clear all inputs
                                $category_name = $status = $photo_new_name = "";
                                echo "<script>swal({
                                    title: 'Success!',
                                    text: 'Category Added Successfully!',
                                    icon: 'success',
                                    closeOnClickOutside: false,
                                    button: false
                                });</script>";

                                ?>
                                <meta http-equiv="Refresh" content="3; url=owner-category-list">
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
                                    <strong class="card-title">Category Photo</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <div class="text-center">
                                                    <img src="storage/category/default_image.png"
                                                        class="avatar img-thumbnail mb-2" alt="avatar" height="250px"
                                                        width="250px">
                                                </div>
                                                <br>
                                                <label for="customFile">Choose Category Photo</label>
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
                                    <strong class="card-title">Category Information</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="example-category_name">Category Name</label>
                                                <input type="text" id="example-category_name" name="category_name"
                                                    class="form-control <?php echo (!empty($category_name_err)) ? 'is-invalid' : ''; ?>"
                                                    placeholder="Please enter category name." value="<?php echo $category_name; ?>">
                                                <span class="invalid-feedback"><?php echo $category_name_err; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- / .card -->
                        </div> <!-- .col-12 -->
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