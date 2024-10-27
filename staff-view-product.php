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
</head>

<body class="vertical  light">
    <div class="wrapper">
        <?php include 'partials/staff-navbar.php'; ?>

        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <h2 class="page-title">Product List</h2>
                        <div class="row my-4">
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-body">
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
                                                                    ₱<?php echo number_format($row1['price'], 2); ?>
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
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <?php

                                                        include 'view-product.php';

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

            <?php include 'partials/staff-modals.php'; ?>

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