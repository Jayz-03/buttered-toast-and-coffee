<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login");
    exit;
}

$active_page = "kitchen";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitchen Process</title>
    <?php include 'partials/header.php'; ?>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="vertical  light">
    <div class="wrapper">
        <?php include 'partials/staff-navbar.php'; ?>

        <main role="main" class="main-content">
            <div class="container-fluid">
                <h2 class="page-title">Kitchen Process</h2>
                <div class="row justify-content-center">
                    <div class="col-6">
                        <div class="row my-4">
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <h2 class="card-title">Preparing Orders</h2>
                                        <table class="table datatables" id="dataTable-1">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>Queue No.</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql1 = "SELECT * FROM sales WHERE status = 0";
                                                $r = mysqli_query($link, $sql1);

                                                if ($r->num_rows > 0) {
                                                    while ($row1 = mysqli_fetch_assoc($r)) {
                                                        ?>
                                                        <tr class="text-center">
                                                            <td>
                                                                <p class="fw-normal mb-1">
                                                                    <?php echo $row1['queue_no']; ?>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="badge badge-warning rounded-pill d-inline px-3">Preparing</span>
                                                            </td>
                                                            <td>
                                                                <div class="d-inline">
                                                                    <a class="ml-1 action-icon" href="javascript:void(0);"
                                                                        onclick="confirmStatusUpdate('<?php echo $row1['queue_no']; ?>', <?php echo $row1['status']; ?>)">
                                                                        <i class="fe fe-fast-forward fe-16"></i>
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
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row my-4">
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <h2 class="card-title">Serving Now</h2>
                                        <table class="table datatables" id="dataTable-1">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>Queue No.</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql1 = "SELECT * FROM sales WHERE status = 1";
                                                $r = mysqli_query($link, $sql1);

                                                if ($r->num_rows > 0) {
                                                    while ($row1 = mysqli_fetch_assoc($r)) {
                                                        ?>
                                                        <tr class="text-center">
                                                            <td>
                                                                <p class="fw-normal mb-1">
                                                                    <?php echo $row1['queue_no']; ?>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="badge badge-success rounded-pill d-inline px-3">Serving</span>
                                                            </td>
                                                            <td>
                                                                <div class="d-inline">
                                                                    <a class="ml-1 action-icon" href="javascript:void(0);"
                                                                        onclick="confirmStatusUpdate('<?php echo $row1['queue_no']; ?>', <?php echo $row1['status']; ?>)">
                                                                        <i class="fe fe-fast-forward fe-16"></i>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include 'partials/staff-modals.php'; ?>

        </main>
    </div>
    <?php include 'partials/jscripts.php'; ?>

    <!-- SweetAlert JS for confirmation -->
    <script>
        function confirmStatusUpdate(queue_no, current_status) {
            let newStatus = (current_status == 0) ? 1 : 2;  // if 0 -> 1 (Preparing -> Serving), if 1 -> 2 (Serving -> Completed)
            let statusText = (newStatus == 1) ? 'Serving' : 'Completed';
            let actionUrl = `update_status.php?queue_no=${queue_no}&status=${newStatus}`;

            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to mark this order as ${statusText}.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Yes, mark as ${statusText}`
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = actionUrl; 
                }
            });
        }
    </script>
</body>

</html>