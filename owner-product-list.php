<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login");
    exit;
}

$active_page = "product";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <?php include 'partials/header.php'; ?>
    <link rel="stylesheet" href="css/dataTables.bootstrap4.css">
    <script src="js/jquery.slim.min.js"></script>
</head>

<body class="vertical  light">
    <div class="wrapper">
        <?php include 'partials/owner-navbar.php'; ?>

        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <h2 class="page-title">Product - Product List</h2>
                        <?php
                        $product_name_err = $category_name_err = $price_err = $photo_err = $status_err = "";

                        if (isset($_POST["update"])) {
                            $product_id = $_POST['product_id'];

                            if (empty(trim($_POST["product_name"]))) {
                                $product_name_err = "Please enter an product name.";
                            } else {
                                $sql = "SELECT product_id FROM product WHERE product_name = ?";

                                if ($stmt = mysqli_prepare($link, $sql)) {
                                    mysqli_stmt_bind_param($stmt, "s", $param_product_name);

                                    $param_product_name = trim($_POST["product_name"]);

                                    if (mysqli_stmt_execute($stmt)) {
                                        mysqli_stmt_store_result($stmt);

                                        if (mysqli_stmt_num_rows($stmt) == 2) {
                                            $product_name_err = "This product is already exist.";
                                        } else {
                                            $product_name = trim($_POST["product_name"]);
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

                            if (empty(trim($_POST["category_name"]))) {
                                $category_name_err = "Please enter category name.";
                            } else {
                                $category_name = mysqli_real_escape_string($link, ($_POST["category_name"]));
                            }

                            if (empty(trim($_POST["price"]))) {
                                $price_err = "Please enter price.";
                            } else {
                                $price = mysqli_real_escape_string($link, ($_POST["price"]));
                            }

                            if (!isset($_POST["status"])) {
                                $status_err = "Please select a status.";
                            } else {
                                $status = mysqli_real_escape_string($link, trim($_POST["status"]));
                            }

                            if (empty($_FILES['photo']['name'])) {
                                $photo = $_POST['no_photo'];
                            } else {
                                $old_photo = "storage/category/" . $_POST['no_photo'];

                                if (file_exists($old_photo)) {
                                    unlink($old_photo);
                                }
                                $photo = ($_FILES["photo"]["name"]);
                                $photo_tmp_name = $_FILES["photo"]["tmp_name"];
                                $photo_size = $_FILES["photo"]["size"];
                                $photo_new_name = rand() . $photo;
                                $photo = $photo_new_name;
                            }

                            if (empty($product_name_err) && empty($category_name_err) && empty($price_err) && empty($photo_err) && empty($status_err)) {
                                $sql = "UPDATE product SET owner_id=?, product_name=?, category_name=?, price=?, status=?, photo=? WHERE product_id=?";
                                $stmt = mysqli_prepare($link, $sql);

                                mysqli_stmt_bind_param($stmt, "issiisi", $owner_id, $product_name, $category_name, $price, $status, $photo, $product_id);

                                if (mysqli_stmt_execute($stmt)) {
                                    if (!empty($_FILES['photo']['name'])) {
                                        move_uploaded_file($photo_tmp_name, "storage/products/" . $photo);
                                    }

                                    echo "<script>swal({
                                            title: 'Success!',
                                            text: 'Product Updated Successfully!',
                                            icon: 'success',
                                            button: false,
                                        });</script>";
                                    ?>
                                    <meta http-equiv="Refresh" content="3; url=owner-product-list">
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



                        ?>
                        <div class="row my-4">
                            <!-- Small table -->
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <!-- table -->
                                        <table class="table datatables" id="dataTable-1">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>ID</th>
                                                    <th>Product Name</th>
                                                    <th>Category Name</th>
                                                    <th>Price</th>
                                                    <th>Status</th>
                                                    <th>Managed by</th>
                                                    <th>Last Updated</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql1 = "SELECT * FROM product";
                                                $r = mysqli_query($link, $sql1);

                                                if ($r->num_rows > 0) {
                                                    while ($row1 = mysqli_fetch_assoc($r)) {
                                                        $owner_id = $row1['owner_id'];
                                                        $sql3 = "SELECT * FROM owner WHERE owner_id = $owner_id";
                                                        $result3 = mysqli_query($link, $sql3);
                                                        $row3 = mysqli_fetch_assoc($result3);
                                                        ?>

                                                        <tr class="text-center">
                                                            <td>
                                                                <p class="fw-normal mb-1">
                                                                    <?php echo $row1['product_id']; ?>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="storage/products/<?php if ($row1["photo"] != "") {
                                                                        echo $row1["photo"];
                                                                    } else {
                                                                        echo 'default_image.png';
                                                                    } ?>" alt="" style="width: 45px; height: 45px"
                                                                        class="rounded-circle" />
                                                                    <div class="ms-3 text-left mx-2">
                                                                        <p class="fw-bold mb-1">
                                                                            <?php echo $row1['product_name']; ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <p class="fw-normal mb-1">
                                                                    <?php echo $row1['category_name']; ?>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p class="fw-normal mb-1">
                                                                    <?php echo $row1['price']; ?>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <?php if ($row1['status'] == 0) {
                                                                    echo '<span class="badge badge-success rounded-pill d-inline px-3">Available</span>';
                                                                } elseif ($row1['status'] == 1) {
                                                                    echo '<span class="badge badge-danger rounded-pill d-inline px-3">Unavailable</span>';
                                                                } ?>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="storage/profile/<?php if ($row3["photo"] != "") {
                                                                        echo $row3["photo"];
                                                                    } else {
                                                                        echo 'default_image.png';
                                                                    } ?>" alt="" style="width: 45px; height: 45px"
                                                                        class="rounded-circle" />
                                                                    <div class="ms-3 text-left mx-2">
                                                                        <p class="fw-bold mb-1">
                                                                            <?php echo $row3['lastname']; ?>,
                                                                            <?php echo $row3['firstname']; ?>
                                                                        </p>
                                                                        <p class="text-muted mb-0"><?php echo $row3['email']; ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <?php $formattedDate = date("l, F j Y - h:i A", strtotime($row1["last_updated"]));
                                                                echo $formattedDate; ?>
                                                            </td>
                                                            <td>
                                                                <div class="d-inline">
                                                                    <a class="ml-1 action-icon" href="#" data-toggle="modal"
                                                                        type="button"
                                                                        data-target="#view-product-<?php echo $row1['product_id'] ?>">
                                                                        <i class="fe fe-eye fe-16"></i>
                                                                    </a>
                                                                    <a class="ml-1 action-icon" href="#" data-toggle="modal"
                                                                        type="button"
                                                                        data-target="#edit-product-<?php echo $row1['product_id'] ?>">
                                                                        <i class="fe fe-edit fe-16"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <?php

                                                        include 'view-product.php';
                                                        include 'edit-product.php';

                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- simple table -->
                        </div> <!-- end section -->
                    </div> <!-- .col-12 -->
                </div> <!-- .row -->
            </div> <!-- .container-fluid -->

            <?php include 'partials/owner-modals.php'; ?>

        </main> <!-- main -->
    </div> <!-- .wrapper -->
    <?php include 'partials/jscripts.php'; ?>
    <script src='js/jquery.dataTables.min.js'></script>
    <script src='js/dataTables.bootstrap4.min.js'></script>
    <script>
        $('#dataTable-1').DataTable(
            {
                autoWidth: true,
                "lengthMenu": [
                    [16, 32, 64, -1],
                    [16, 32, 64, "All"]
                ]
            });
    </script>
</body>

</html>