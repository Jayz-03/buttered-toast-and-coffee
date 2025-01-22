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
    <title>Create Inventory</title>
    <?php include 'partials/header.php'; ?>
    <script src="js/jquery.slim.min.js"></script>
</head>

<body class="vertical  light">
    <div class="wrapper">
        <?php include 'partials/owner-navbar.php'; ?>
        <main role="main" class="main-content">
            <div class="container-fluid">
                <h2 class="page-title">Inventory - Add Inventory</h2>

                <?php
                $item = $branch = $measurement = $fullfilment = $quantity = $low_stock = $photo = "";
                $item_err = $branch_err = $measurement = $fullfilment_err = $quantity_err = $low_stock_err = $photo_err = "";


                if (isset($_POST["submit"])) {

                    if (empty(trim($_POST["branch"]))) {
                        $branch_err = "Please enter branch.";
                    } else {
                        $branch = mysqli_real_escape_string($link, ($_POST["branch"]));
                    }

                    if (empty(trim($_POST["measurement"]))) {
                        $measurement_err = "Please enter a measurement.";
                    } else {
                        $measurement = mysqli_real_escape_string($link, ($_POST["measurement"]));
                    }

                    if (empty(trim($_POST["item"]))) {
                        $item_err = "Please enter an item.";
                    } else {
                        $sql = "SELECT inventory_id FROM inventory WHERE item = ? AND branch_id = ?";

                        if ($stmt = mysqli_prepare($link, $sql)) {
                            mysqli_stmt_bind_param($stmt, "si", $param_item, $param_branch);

                            $param_item = trim($_POST["item"]);
                            $param_branch = $branch;

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

                    if (empty(trim($_POST["fullfilment"]))) {
                        $fullfilment_err = "Please enter fullfilment.";
                    } else {
                        $fullfilment = mysqli_real_escape_string($link, $_POST["fullfilment"]);
                    }

                    if (empty(trim($_POST["quantity"]))) {
                        $quantity_err = "Please enter quantity.";
                    } else {
                        $quantity = mysqli_real_escape_string($link, $_POST["quantity"]);
                    }

                    if (empty(trim($_POST["low_stock"]))) {
                        $low_stock_err = "Please enter low stock quantity.";
                    } else {
                        $low_stock = mysqli_real_escape_string($link, $_POST["low_stock"]);
                        if ($low_stock >= $quantity) {
                            $low_stock_err = "Low stock quantity should not be equal or greater than to quantity.";
                        } else {
                            $low_stock = mysqli_real_escape_string($link, $_POST["low_stock"]);
                        }
                    }

                    if (empty($_FILES['photo']['name'])) {
                        $photo = "";
                        $photo_new_name = "";
                    } else {
                        $photo = $_FILES["photo"]["name"];
                        $photo_tmp_name = $_FILES["photo"]["tmp_name"];
                        $photo_size = $_FILES["photo"]["size"];
                        $photo_new_name = rand() . "_" . $photo;
                    }

                    if (empty($item_err) && empty($fullfilment_err) && empty($quantity_err) && empty($low_stock_err) && empty($photo_err)) {

                        $sql = "INSERT INTO inventory (owner_id, branch_id, item, stocks, measurement, fulfillment, low_stock, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

                        if ($stmt = mysqli_prepare($link, $sql)) {
                            mysqli_stmt_bind_param($stmt, "iisisiis", $param_owner_id, $param_branch_id, $param_item, $param_quantity, $param_measurement, $param_fullfilment, $param_low_stock, $param_photo);

                            $param_owner_id = $owner_id;
                            $param_branch_id = $branch;
                            $param_fullfilment = $fullfilment;
                            $param_measurement = $measurement;
                            $param_item = $item;
                            $param_quantity = $quantity;
                            $param_low_stock = $low_stock;
                            $param_photo = $photo_new_name;

                            if (mysqli_stmt_execute($stmt)) {
                                if ($photo_new_name !== "") {
                                    move_uploaded_file($photo_tmp_name, "storage/inventory/" . $photo_new_name);
                                }

                                $item = $quantity = $low_stock = "";
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
                                    <strong class="card-title">Inventory Item Photo <span style="color: #6c757d;">(Optional)</span></strong>
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
                                                <label for="customFile">Choose Inventory Item Photo</label>
                                                <div class="custom-file">
                                                    <input type="file" id="customFile" accept="image/*" name="photo"
                                                        class="custom-file-input form-control <?php echo (!empty($photo_err)) ? 'is-invalid' : ''; ?> file-upload mb-3">
                                                    <span class="invalid-feedback"><?php echo $photo_err; ?></span>
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        file</label>
                                                </div>
                                                <script>
                                                    $(document).ready(function() {

                                                        var readURL = function(input) {
                                                            if (input.files && input.files[0]) {
                                                                var reader = new FileReader();

                                                                reader.onload = function(e) {
                                                                    $('.avatar').attr('src', e.target.result);
                                                                }

                                                                reader.readAsDataURL(input.files[0]);
                                                            }
                                                        }


                                                        $(".file-upload").on('change', function() {
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
                                        <div class="col">
                                            <div class="form-group mb-3">
                                                <label for="example-item">Item Name</label>
                                                <input type="text" id="example-item" name="item"
                                                    class="form-control <?php echo (!empty($item_err)) ? 'is-invalid' : ''; ?>"
                                                    placeholder="Please enter an item." value="<?php echo $item; ?>">
                                                <span class="invalid-feedback"><?php echo $item_err; ?></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group mb-3">
                                                <label for="example-select">Select Branch</label>
                                                <select class="form-control" id="example-select" name="branch">
                                                    <option value="">Select Branch:</option>
                                                    <?php
                                                    $sql1 = "SELECT * FROM branch";
                                                    $r = mysqli_query($link, $sql1);

                                                    if ($r->num_rows > 0) {
                                                        while ($row1 = mysqli_fetch_assoc($r)) {
                                                            echo "<option value=\"" . $row1["branch_name"] . "\">" . $row1["branch_name"] . "</option>";
                                                        }
                                                    } else {
                                                        echo "<option value=\"\">No branch available</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <span class="invalid-feedback"><?php echo $category_name_err; ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mb-3">
                                                <label for="example-quantity">Stocks</label>
                                                <input type="number" id="example-quantity" name="quantity"
                                                    class="form-control <?php echo (!empty($quantity_err)) ? 'is-invalid' : ''; ?>"
                                                    placeholder="Please enter stocks."
                                                    value="<?php echo $quantity; ?>">
                                                <span class="invalid-feedback"><?php echo $quantity_err; ?></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group mb-3">
                                                <label for="example-low_stock">Low Stock Quantity</label>
                                                <input type="number" id="example-low_stock" name="low_stock"
                                                    class="form-control <?php echo (!empty($low_stock_err)) ? 'is-invalid' : ''; ?>"
                                                    placeholder="Please enter low stock quantity."
                                                    value="<?php echo $low_stock; ?>">
                                                <span class="invalid-feedback"><?php echo $low_stock_err; ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mb-3">
                                                <label for="example-measurement">Measurement</label>
                                                <input type="text" id="example-measurement" name="measurement"
                                                    class="form-control <?php echo (!empty($measurement_err)) ? 'is-invalid' : ''; ?>"
                                                    placeholder="Please enter a measurement." value="<?php echo $measurement; ?>">
                                                <span class="invalid-feedback"><?php echo $measurement_err; ?></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group mb-3">
                                                <label for="example-fullfilment">Fulfillment</label>
                                                <input type="number" id="example-fullfilment" name="fullfilment"
                                                    class="form-control <?php echo (!empty($fullfilment_err)) ? 'is-invalid' : ''; ?>"
                                                    placeholder="Please enter a fullfilment."
                                                    value="<?php echo $fullfilment; ?>">
                                                <span class="invalid-feedback"><?php echo $fullfilment_err; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Create</button>
            </form>
    </div>

    <?php include 'partials/owner-modals.php'; ?>

    </main>
    </div>
    <?php include 'partials/jscripts.php'; ?>
</body>

</html>