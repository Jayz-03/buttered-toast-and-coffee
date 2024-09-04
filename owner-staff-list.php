<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner - Staff List</title>
    <?php include 'partials/partials/header.php'; ?>
    <link rel="stylesheet" href="css/dataTables.bootstrap4.css">
</head>

<style>
    .small-logo {
        width: 50px !important;
    }

    .page-title {
        color: #000000;
    }

    .navbar-light .navbar-nav .nav-link {
        color: #000000 !important;
    }

    .badge {
        font-size: 14px;
    }

    .badge-success {
        color: #72C894;
        background-color: #04210F;
    }

    .badge-warning {
        color: #EFC776;
        background-color: #2E2005;
    }

    .badge-danger {
        color: #E37083;
        background-color: #2C0F14;
    }

    .action-icon {
        color: #000000;
    }

    .action-icon:hover {
        color: #000000;
        text-decoration: none;
    }

    .page-item.active .page-link {
        background-color: #000000 !important;
        border-color: #000000 !important;
    }
</style>

<body class="vertical  light">
    <div class="wrapper">
        <?php include 'partials/owner-navbar.php'; ?>

        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <h2 class="page-title">Staff - Staff List</h2>
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
                                                    <th>Profile</th>
                                                    <th>Phone</th>
                                                    <th>Status</th>
                                                    <th>Last Updated</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql1 = "SELECT * FROM staff";
                                                $r = mysqli_query($link, $sql1);

                                                if ($r->num_rows > 0) {
                                                    while ($row1 = mysqli_fetch_assoc($r)) {
                                                        ?>

                                                        <tr class="text-center">
                                                            <td>
                                                                <p class="fw-normal mb-1">
                                                                    <?php echo $row1['staff_id']; ?>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="storage/profile/<?php if ($row1["photo"] != "") {
                                                                        echo $row1["photo"];
                                                                    } else {
                                                                        echo 'default_image.png';
                                                                    } ?>" alt="" style="width: 45px; height: 45px"
                                                                        class="rounded-circle" />
                                                                    <div class="ms-3 text-left mx-2">
                                                                        <p class="fw-bold mb-1">
                                                                            <?php echo $row1['lastname']; ?>,
                                                                            <?php echo $row1['firstname']; ?>
                                                                        </p>
                                                                        <p class="text-muted mb-0"><?php echo $row1['email']; ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <p class="fw-normal mb-1">
                                                                    <?php echo $row1['contact_number']; ?>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <?php if ($row1['status'] == 0) {
                                                                    echo '<span class="badge badge-success rounded-pill d-inline px-3">Active</span>';
                                                                } elseif ($row1['status'] == 1) {
                                                                    echo '<span class="badge badge-danger rounded-pill d-inline px-3">Inactive</span>';
                                                                } ?>
                                                            </td>
                                                            <td>
                                                                <?php $formattedDate = date("l, F j Y - h:i A", strtotime($row1["last_updated"]));
                                                                echo $formattedDate; ?>
                                                            </td>
                                                            <td>
                                                                <div class="d-inline">
                                                                    <a class="ml-1 action-icon" href="#">
                                                                        <i class="fe fe-eye fe-16"></i>
                                                                    </a>
                                                                    <a class="ml-1 action-icon" href="#">
                                                                        <i class="fe fe-edit fe-16"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>


                                                        <?php

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