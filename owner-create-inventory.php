<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login");
    exit;
}

$active_page = "inventory";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner - Create Inventory</title>
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
                <h2 class="page-title">Inventory - Add Inventory</h2>

                <?php
                $item = $quantity = $photo = "";
                $item_err = $quantity_err = $photo_err = "";
                $status = 0;

                if (isset($_POST["submit"])) {

                    if (empty(trim($_POST["item"]))) {
                        $item_err = "Please enter an item.";
                    } else {
                        $sql = "SELECT inventory_id FROM inventory WHERE item = ?";

                        if ($stmt = mysqli_prepare($link, $sql)) {
                            mysqli_stmt_bind_param($stmt, "s", $param_item);

                            $param_item = trim($_POST["item"]);

                            if (mysqli_stmt_execute($stmt)) {
                                mysqli_stmt_store_result($stmt);

                                if (mysqli_stmt_num_rows($stmt) == 1) {
                                    $item_err = "This item is already exist.";
                                } else {
                                    $item = trim($_POST["item"]);
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

                    if (empty(trim($_POST["quantity"]))) {
                        $quantity_err = "Please enter quantity.";
                    } else {
                        $quantity = mysqli_real_escape_string($link, $_POST["quantity"]);
                    }

                    if (empty($_FILES['photo']['name'])) {
                        $photo_err = "Please upload a photo.";
                    } else {
                        $photo = ($_FILES["photo"]["name"]);
                        $photo_tmp_name = $_FILES["photo"]["tmp_name"];
                        $photo_size = $_FILES["photo"]["size"];
                        $photo_new_name = rand() . $photo;
                    }

                    if (empty($item_err) && empty($quantity_err) && empty($photo_err)) {


                        $sql = "INSERT INTO inventory (owner_id, item, quantity, status, photo) VALUES (?, ?, ?, ?, ?)";

                        if ($stmt = mysqli_prepare($link, $sql)) {
                            mysqli_stmt_bind_param($stmt, "isiis", $param_owner_id, $param_item, $param_quantity, $param_status, $param_photo);

                            $param_owner_id = $owner_id;
                            $param_item = $item;
                            $param_quantity = $quantity;
                            $param_status = $status;
                            $param_photo = $photo_new_name;

                            if (mysqli_stmt_execute($stmt)) {
                                move_uploaded_file($photo_tmp_name, "storage/inventory/" . $photo_new_name);
                                // Clear all inputs
                                $item = $quantity = $status = $photo_new_name = "";
                                echo "<script>swal({
                                    title: 'Success!',
                                    text: 'Inventory Item Added Successfully!',
                                    icon: 'success',
                                    closeOnClickOutside: false,
                                    button: false
                                });</script>";

                                ?>
                                <meta http-equiv="Refresh" content="3; url=owner-inventory-list">
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
                                    <strong class="card-title">Inventory Photo</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <div class="text-center">
                                                    <img src="storage/inventory/default_image.png"
                                                        class="avatar img-thumbnail mb-2" alt="avatar" height="250px"
                                                        width="250px">
                                                </div>
                                                <br>
                                                <label for="customFile">Choose Inventory Photo</label>
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
                                    <strong class="card-title">Inventory Item Information</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="example-item">Item Name</label>
                                                <input type="text" id="example-item" name="item"
                                                    class="form-control <?php echo (!empty($item_err)) ? 'is-invalid' : ''; ?>"
                                                    placeholder="Please enter an item." value="<?php echo $item; ?>">
                                                <span class="invalid-feedback"><?php echo $item_err; ?></span>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="example-quantity">Quantity</label>
                                                <input type="number" id="example-quantity" name="quantity"
                                                    class="form-control <?php echo (!empty($quantity_err)) ? 'is-invalid' : ''; ?>"
                                                    placeholder="Please enter quantity."
                                                    value="<?php echo $quantity; ?>">
                                                <span class="invalid-feedback"><?php echo $quantity_err; ?></span>
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