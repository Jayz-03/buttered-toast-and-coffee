<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login");
    exit;
}

$active_page = "sales";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales</title>
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
                        <h2 class="page-title">Sales</h2>
                        <div class="row align-items-center my-2">
                            <div class="col-auto ml-auto">
                                <form class="form-inline">
                                    <div class="form-group">
                                        <div class="px-2 py-2 text-muted">
                                            <span class="small" id="filterMessage">
                                                Click the filter button to select date range.</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-sm" data-toggle="modal"
                                            data-target="#filterModal">
                                            <i class="fe fe-filter"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row my-4">
                            <!-- Small table -->
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <!-- table -->
                                        <table class="table datatables" id="dataTable-1">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>Sale ID</th>
                                                    <th>Payment Method</th>
                                                    <th>Customer Pay</th>
                                                    <th>Change Amount</th>
                                                    <th>Total Amount</th>
                                                    <th>Transaction Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql1 = "SELECT * FROM sales";
                                                $r = mysqli_query($link, $sql1);

                                                if ($r->num_rows > 0) {
                                                    while ($row1 = mysqli_fetch_assoc($r)) {
                                                        ?>

                                                        <tr class="text-center">
                                                            <td>
                                                                <p class="fw-normal mb-1">
                                                                    <?php echo $row1['sale_id']; ?>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p class="fw-normal mb-1">
                                                                    <?php echo $row1['payment_method']; ?>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p class="fw-normal mb-1">
                                                                    ₱<?php echo $row1['customer_pay']; ?>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p class="fw-normal mb-1">
                                                                    ₱<?php echo $row1['change_amount']; ?>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p class="fw-normal mb-1">
                                                                    ₱<?php echo $row1['total_amount']; ?>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                // Display the human-readable date
                                                                $formattedDate = date("l, F j Y - h:i A", strtotime($row1["transaction_date"]));
                                                                // Create a hidden date with Y-m-d format for JavaScript comparison
                                                                $hiddenDate = date("Y-m-d", strtotime($row1["transaction_date"]));
                                                                ?>
                                                                <span
                                                                    class="formatted-date"><?php echo $formattedDate; ?></span>
                                                                <span class="hidden-date"
                                                                    style="display:none;"><?php echo $hiddenDate; ?></span>
                                                            </td>

                                                            <td>
                                                                <div class="d-inline">
                                                                    <a class="ml-1 action-icon" href="#" data-toggle="modal"
                                                                        type="button"
                                                                        data-target="#view-sales-items-<?php echo $row1['sale_id'] ?>">
                                                                        <i class="fe fe-eye fe-16"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <?php

                                                        include 'view-sales-items.php';
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

            <!-- Modal for Date Range Filter -->
            <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="filterModalLabel">Filter by Date Range</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="startDate">Start Date:</label>
                                <input type="date" id="startDate" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="endDate">End Date:</label>
                                <input type="date" id="endDate" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="applyFilterBtn">Apply Filter</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php include 'partials/staff-modals.php'; ?>

        </main> <!-- main -->
    </div> <!-- .wrapper -->
    <?php include 'partials/jscripts.php'; ?>
    <script src='js/jquery.dataTables.min.js'></script>
    <script src='js/dataTables.bootstrap4.min.js'></script>
    <script>
        $(document).ready(function () {
            var table = $('#dataTable-1').DataTable({
                autoWidth: true,
                "lengthMenu": [
                    [16, 32, 64, -1],
                    [16, 32, 64, "All"]
                ]
            });

            $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();

                var hiddenDate = $(table.row(dataIndex).node()).find('.hidden-date').text();

                if (startDate === "" && endDate === "") {
                    return true;
                }

                if (hiddenDate) {
                    var formattedTransactionDate = new Date(hiddenDate);

                    if (startDate !== "" && formattedTransactionDate < new Date(startDate)) {
                        return false;
                    }

                    if (endDate !== "" && formattedTransactionDate > new Date(endDate)) {
                        return false;
                    }
                }

                return true;
            });

            $('#applyFilterBtn').click(function () {
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();
                var filterMessage = $('#filterMessage');

                if (startDate && endDate) {
                    filterMessage.text(`Filtered from ${startDate} to ${endDate}`);
                } else if (startDate) {
                    filterMessage.text(`Filtered from ${startDate}`);
                } else if (endDate) {
                    filterMessage.text(`Filtered until ${endDate}`);
                } else {
                    filterMessage.text('You can filter dates here');
                }

                $('#filterModal').modal('hide');
                table.draw();
            });

            $('#filterModal').on('hidden.bs.modal', function () {
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();
                var filterMessage = $('#filterMessage');

                if (!startDate && !endDate) {
                    filterMessage.text('Click the filter button to select date range.');
                }
            });
        });

    </script>
</body>

</html>