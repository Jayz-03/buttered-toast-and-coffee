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
    <title>Inventory List</title>
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
                        <h2 class="page-title">Inventory - Inventory List</h2>
                        <?php
                        $item_err = $quantity_err = $photo_err = $low_stock_err = "";
                        if (isset($_POST["update"])) {
                            $inventory_id = $_POST['inventory_id'];

                            if (empty(trim($_POST["item"]))) {
                                $item_err = "Please enter an item.";
                            } else {
                                $sql = "SELECT inventory_id FROM inventory WHERE item = ?";

                                if ($stmt = mysqli_prepare($link, $sql)) {
                                    mysqli_stmt_bind_param($stmt, "s", $param_item);

                                    $param_item = trim($_POST["item"]);

                                    if (mysqli_stmt_execute($stmt)) {
                                        mysqli_stmt_store_result($stmt);

                                        if (mysqli_stmt_num_rows($stmt) == 2) {
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
                                $photo = $_POST['no_photo'];
                            } else {
                                $old_photo = "storage/inventory/" . $_POST['no_photo'];

                                if (file_exists($old_photo)) {
                                    unlink($old_photo);
                                }
                                $photo = ($_FILES["photo"]["name"]);
                                $photo_tmp_name = $_FILES["photo"]["tmp_name"];
                                $photo_size = $_FILES["photo"]["size"];
                                $photo_new_name = rand() . $photo;
                                $photo = $photo_new_name;
                            }

                            if (empty($item_err) && empty($quantity_err) && empty($photo_err) && empty($low_stock_err)) {
                                $sql = "UPDATE inventory SET owner_id=?, item=?, quantity=?, low_stock=?, photo=? WHERE inventory_id=?";
                                $stmt = mysqli_prepare($link, $sql);

                                mysqli_stmt_bind_param($stmt, "isiisi", $owner_id, $item, $quantity, $low_stock, $photo, $inventory_id);

                                if (mysqli_stmt_execute($stmt)) {
                                    if (!empty($_FILES['photo']['name'])) {
                                        move_uploaded_file($photo_tmp_name, "storage/inventory/" . $photo);
                                    }

                                    echo "<script>swal({
                                            title: 'Success!',
                                            text: 'Inventory Item Updated Successfully!',
                                            icon: 'success',
                                            button: false,
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
                        ?>
                        <div class="row my-4">
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <table class="table datatables" id="dataTable-1">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>ID</th>
                                                    <th>Item</th>
                                                    <th>Quantity</th>
                                                    <th>Status</th>
                                                    <th>Managed By</th>
                                                    <th>Last Updated</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql1 = "SELECT * FROM inventory";
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
                                                                    <?php echo $row1['inventory_id']; ?>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="storage/inventory/<?php if ($row1["photo"] != "") {
                                                                        echo $row1["photo"];
                                                                    } else {
                                                                        echo 'default_image.png';
                                                                    } ?>" alt="" style="width: 45px; height: 45px"
                                                                        class="rounded-circle" />
                                                                    <div class="ms-3 text-left mx-2">
                                                                        <p class="fw-bold mb-1">
                                                                            <?php echo $row1['item']; ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <p class="fw-normal mb-1">
                                                                    <?php echo number_format($row1['quantity']); ?>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <?php if ($row1['quantity'] > $row1['low_stock']) {
                                                                    echo '<span class="badge badge-success rounded-pill d-inline px-3">In Stock</span>';
                                                                } elseif ($row1['quantity'] < $row1['low_stock']) {
                                                                    echo '<span class="badge badge-warning rounded-pill d-inline px-3">Low Stock</span>';
                                                                } elseif ($row1['quantity'] == 0) {
                                                                    echo '<span class="badge badge-danger rounded-pill d-inline px-3">Out of Stock</span>';
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
                                                                        data-target="#view-inventory-<?php echo $row1['inventory_id'] ?>">
                                                                        <i class="fe fe-eye fe-16"></i>
                                                                    </a>
                                                                    <a class="ml-1 action-icon" href="#" data-toggle="modal"
                                                                        type="button"
                                                                        data-target="#edit-inventory-<?php echo $row1['inventory_id'] ?>">
                                                                        <i class="fe fe-edit fe-16"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>


                                                        <?php

                                                        include 'view-inventory.php';
                                                        include 'edit-inventory.php';

                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include 'partials/owner-modals.php'; ?>

        </main>
    </div>
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