<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login");
    exit;
}

$active_page = "dashboard";


require_once 'config.php';

$sql = "SELECT SUM(total_amount) AS total_income, COUNT(*) AS total_orders FROM sales";
$result = mysqli_query($link, $sql);

$total_income = 0;
$total_orders = 0;

if ($result && mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    $total_income = $data['total_income'] ? $data['total_income'] : 0;
    $total_orders = $data['total_orders'] ? $data['total_orders'] : 0;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php include 'partials/header.php'; ?>
    <link rel="stylesheet" href="css/dataTables.bootstrap4.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body class="vertical  light">
    <div class="wrapper">
        <?php include 'partials/owner-navbar.php'; ?>

        <main role="main" class="main-content">
            <div class="container-fluid">
                <h2 class="page-title">Dashboard</h2>
                <div class="row align-items-center my-2">
                    <div class="col-auto ml-auto">
                        <form class="form-inline">
                            <div class="form-group">
                                <div class="px-2 py-2 text-muted">
                                    <span class="small" id="filterMessage">
                                        Click the filter button to select date range or payment method.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#filterModal">
                                    <i class="fe fe-filter"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-8">
                        <div class="row">
                            <div class="col">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-3 text-center">
                                                <span class="circle circle-md bg-primary">
                                                    <i class="fe fe-16 fe-inbox text-white mb-0"></i>
                                                </span>
                                            </div>
                                            <div class="col pr-0">
                                                <p class="small text-muted mb-0">Income</p>
                                                <span id="totalIncome"
                                                    class="h3 mb-0">₱<?php echo number_format($total_income, 2); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-3 text-center">
                                                <span class="circle circle-md bg-primary">
                                                    <i class="fe fe-16 fe-shopping-cart text-white mb-0"></i>
                                                </span>
                                            </div>
                                            <div class="col pr-0">
                                                <p class="small text-muted mb-0">Orders</p>
                                                <span id="totalOrders"
                                                    class="h3 mb-0"><?php echo $total_orders; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <strong class="card-title mb-0">Sales Data Visualization</strong>
                                        <!-- Filter Dropdown -->
                                        <select id="timeFilter" class="form-control mt-2">
                                            <option value="day">Daily</option>
                                            <option value="week">Weekly</option>
                                            <option value="month">Monthly</option>
                                            <option value="year">Yearly</option>
                                        </select>
                                    </div>
                                    <div class="card-body">
                                        <div id="lineChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-4">
                        <div class="card shadow">
                            <div class="card-header">
                                <strong class="card-title mb-0">Inventory Stock Alert</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table datatables" id="dataTable-1">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>Item</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql1 = "SELECT * FROM inventory";
                                                $r = mysqli_query($link, $sql1);

                                                if ($r->num_rows > 0) {
                                                    while ($row1 = mysqli_fetch_assoc($r)) {
                                                        ?>

                                                        <tr class="text-center">
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
                                                                <?php if ($row1['status'] == 0) {
                                                                    echo '<span class="badge badge-success rounded-pill d-inline px-3">In Stock</span>';
                                                                } elseif ($row1['status'] == 1) {
                                                                    echo '<span class="badge badge-warning rounded-pill d-inline px-3">Low Stock</span>';
                                                                } elseif ($row1['status'] == 2) {
                                                                    echo '<span class="badge badge-danger rounded-pill d-inline px-3">Out of Stock</span>';
                                                                } ?>
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
                </div> <!-- .row -->
            </div> <!-- .container-fluid -->

            <?php include 'partials/owner-modals.php'; ?>

            <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="filterModalLabel">Filter by Date Range and Payment Method</h5>
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
                            <div class="form-group">
                                <label for="paymentMethod">Payment Method:</label>
                                <select id="paymentMethod" class="form-control">
                                    <option value="">All</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Card">Card</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="applyFilterBtn">Apply Filter</button>
                        </div>
                    </div>
                </div>
            </div>



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

            $('#applyFilterBtn').click(function () {
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();
                var paymentMethod = $('#paymentMethod').val();

                var messageParts = [];

                if (startDate && endDate) {
                    messageParts.push(`from ${startDate} to ${endDate}`);
                } else if (startDate) {
                    messageParts.push(`from ${startDate}`);
                } else if (endDate) {
                    messageParts.push(`until ${endDate}`);
                }

                if (paymentMethod) {
                    messageParts.push(`and Payment Method '${paymentMethod}'`);
                }

                if (messageParts.length > 0) {
                    $('#filterMessage').text(`Filtered ${messageParts.join(' ')}`);
                } else {
                    $('#filterMessage').text('Click the filter button to select date range or payment method.');
                }

                $.ajax({
                    url: 'fetch-filtered-data.php',
                    method: 'POST',
                    data: {
                        startDate: startDate,
                        endDate: endDate,
                        paymentMethod: paymentMethod
                    },
                    success: function (response) {
                        var data = JSON.parse(response);

                        $('#totalIncome').text(data.total_income.toLocaleString('en-US', { minimumFractionDigits: 2 }));
                        $('#totalOrders').text(data.total_orders);

                        $('#filterModal').modal('hide');
                    }
                });
            });
        });
    </script>

    <script>
        document.getElementById('timeFilter').addEventListener('change', updateChart);

        function updateChart() {
            const filter = document.getElementById('timeFilter').value;

            fetch(`fetch-sales-data.php?filter=${filter}`)
                .then(response => response.json())
                .then(data => {
                    const categories = [...new Set(data.map(item => item.category_name))];
                    const dates = [...new Set(data.map(item => item.sale_date))];

                    const series = categories.map(category => {
                        return {
                            name: category,
                            data: dates.map(date => {
                                const sale = data.find(item => item.category_name === category && item.sale_date === date);
                                return sale ? sale.total_sales : 0;
                            })
                        };
                    });

                    // Update the chart
                    lineChart.updateOptions({
                        xaxis: {
                            categories: dates
                        },
                        series: series
                    });
                });
        }

        // Initial chart load
        updateChart();

    </script>

    <script src="js/apexcharts.min.js"></script>
    <script src="js/linechartapex.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</body>

</html>