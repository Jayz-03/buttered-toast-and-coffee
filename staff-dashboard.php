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

$sql_sales_data = "SELECT p.category_name, DATE(s.transaction_date) as sale_date, 
                   SUM(si.quantity * si.price) as total_sales 
                   FROM sales s 
                   JOIN sale_items si ON s.sale_id = si.sale_id 
                   JOIN product p ON si.product_id = p.product_id 
                   GROUP BY p.category_name, DATE(s.transaction_date)
                   ORDER BY sale_date ASC";

$result_sales_data = mysqli_query($link, $sql_sales_data);
$sales_data = [];

if ($result_sales_data && mysqli_num_rows($result_sales_data) > 0) {
    while ($row = mysqli_fetch_assoc($result_sales_data)) {
        $sales_data[] = $row;
    }
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

<style>
    div.dataTables_wrapper div.dataTables_filter input {
        width: 80px !important;
    }
</style>

<body class="vertical  light">
    <div class="wrapper">
        <?php include 'partials/staff-navbar.php'; ?>

        <main role="main" class="main-content">
            <div class="container-fluid">
                <h2 class="page-title">Dashboard</h2>
                <div class="row align-items-center my-2">
                    <div class="col-auto ml-auto">
                        <form class="form-inline">
                            <div class="form-group">
                                <div class="px-2 py-2 text-muted">
                                    <span class="small" id="filterMessage">
                                        Click the filter button to select date range and payment method.</span>
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
                                        <div class="row">
                                            <div class="col-md-12 mt-2">
                                                <strong class="card-title">Sales Data Visualization</strong>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <div id="lineChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-12 mt-2">
                                                <strong class="card-title">Inventory Data Visualization</strong>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <div id="columnChart"></div>
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
                                                $sql1 = "SELECT * FROM inventory LIMIT 11";
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
                                                                <?php if ($row1['quantity'] > $row1['low_stock']) {
                                                                    echo '<span class="badge badge-success rounded-pill d-inline px-3">In Stock</span>';
                                                                } elseif ($row1['quantity'] < $row1['low_stock']) {
                                                                    echo '<span class="badge badge-warning rounded-pill d-inline px-3">Low Stock</span>';
                                                                } elseif ($row1['quantity'] == 0) {
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
                            <div class="card-footer text-center">
                                <a href="#">View All</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include 'partials/staff-modals.php'; ?>

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

            <style>
                .swal-button {
                    color: #72C894;
                    background-color: #04210F;
                }

                .swal-button:not([disabled]):hover {
                    color: #72C894;
                    background-color: #04210F;
                }
            </style>

            <script>
                const today = new Date().toISOString().split('T')[0];
                const startDateInput = document.getElementById('startDate');
                const endDateInput = document.getElementById('endDate');

                endDateInput.max = today;
                startDateInput.max = today;

                startDateInput.addEventListener('change', function () {
                    let startDate = new Date(startDateInput.value);
                    let nextDay = new Date(startDate);
                    nextDay.setDate(startDate.getDate() + 1);
                    endDateInput.min = nextDay.toISOString().split('T')[0];

                    if (endDateInput.value <= startDateInput.value) {
                        endDateInput.value = '';
                    }
                });

                endDateInput.addEventListener('change', function () {
                    if (endDateInput.value === startDateInput.value) {
                        swal({
                            title: 'Warning!',
                            text: 'End date cannot be the same as the start date. Please select a different date.',
                            icon: 'warning',
                            closeOnClickOutside: false,
                            confirmButtonText: 'OK'
                        })
                        endDateInput.value = '';
                    }
                });
            </script>

        </main>
    </div>

    <?php include 'partials/jscripts.php'; ?>
    <script src='js/jquery.dataTables.min.js'></script>
    <script src='js/dataTables.bootstrap4.min.js'></script>
    <script src="js/apexcharts.min.js"></script>
    <script>
        $(document).ready(function () {
            var table = $('#dataTable-1').DataTable({
                autoWidth: true,
                "lengthMenu": [
                    [16, 32, 64, -1],
                    [16, 32, 64, "All"]
                ]
            });

            updateChart(<?php echo json_encode($sales_data); ?>);

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
                    messageParts.push(`with Payment Method '${paymentMethod}'`);
                }

                if (messageParts.length > 0) {
                    $('#filterMessage').text(`Filtered ${messageParts.join(' ')}`);
                } else {
                    $('#filterMessage').text('All sales data filtered.');
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

                        $('#totalIncome').text('₱' + parseFloat(data.total_income).toLocaleString('en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }));
                        $('#totalOrders').text(data.total_orders);

                        updateChart(data.sales_data);

                        $('#filterModal').modal('hide');
                    }
                });
            });

            function updateChart(salesData) {
                const categories = [...new Set(salesData.map(item => item.category_name))];

                let xAxisCategories = [];
                const startDate = $('#startDate').val();
                const endDate = $('#endDate').val();

                if (!startDate && !endDate) {
                    xAxisCategories = [...new Set(salesData.map(item => item.sale_date))];
                } else if (startDate && endDate) {
                    const start = new Date(startDate);
                    const end = new Date(endDate);
                    xAxisCategories = getDateRange(start, end);
                } else if (startDate) {
                    const start = new Date(startDate);
                    const today = new Date();
                    xAxisCategories = getDateRange(start, today);
                }

                const series = categories.map(category => {
                    return {
                        name: category,
                        data: xAxisCategories.map(date => {
                            const sale = salesData.find(item => item.category_name === category && item.sale_date === date);
                            return sale ? parseFloat(sale.total_sales) : 0;
                        })
                    };
                });

                lineChart.updateOptions({
                    xaxis: {
                        categories: xAxisCategories
                    },
                    series: series
                });
            }

            function getDateRange(startDate, endDate) {
                let dates = [];
                let currentDate = new Date(startDate);

                while (currentDate <= endDate) {
                    dates.push(formatDate(currentDate));
                    currentDate.setDate(currentDate.getDate() + 1);
                }

                return dates;
            }

            function formatDate(date) {
                const d = new Date(date);
                return d.toISOString().split('T')[0];
            }
        });

        var lineChartoptions = {
            series: [],
            chart: {
                height: 350,
                type: "line",
                background: !1,
                zoom: {
                    enabled: !1
                },
                toolbar: {
                    show: !1
                }
            },
            theme: {
                mode: colors.chartTheme
            },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "round",
                colors: chartColors,
                width: [3, 2, 3],
                dashArray: [0, 0, 0]
            },
            dataLabels: {
                enabled: !1
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: "bottom",
                        offsetX: -10,
                        offsetY: 0
                    }
                }
            }],
            markers: {
                size: 4,
                colors: base.primaryColor,
                strokeColors: colors.borderColor,
                strokeWidth: 2,
                strokeOpacity: .9,
                strokeDashArray: 0,
                fillOpacity: 1,
                discrete: [],
                shape: "circle",
                radius: 2,
                offsetX: 0,
                offsetY: 0,
                onClick: void 0,
                onDblClick: void 0,
                showNullDataPoints: !0,
                hover: {
                    size: void 0,
                    sizeOffset: 3
                }
            },
            xaxis: {
                type: "datetime",
                categories: [],
                labels: {
                    show: !0,
                    trim: !1,
                    minHeight: void 0,
                    maxHeight: 120,
                    style: {
                        colors: colors.mutedColor,
                        cssClass: "text-muted",
                        fontFamily: base.defaultFontFamily
                    }
                },
                axisBorder: {
                    show: !1
                }
            },
            yaxis: {
                labels: {
                    show: !0,
                    trim: !1,
                    offsetX: -10,
                    minHeight: void 0,
                    maxHeight: 120,
                    style: {
                        colors: colors.mutedColor,
                        cssClass: "text-muted",
                        fontFamily: base.defaultFontFamily
                    }
                }
            },
            legend: {
                position: "top",
                fontFamily: base.defaultFontFamily,
                fontWeight: 400,
                labels: {
                    colors: colors.mutedColor,
                    useSeriesColors: !1
                },
                markers: {
                    width: 10,
                    height: 10,
                    strokeWidth: 0,
                    strokeColor: colors.borderColor,
                    fillColors: chartColors,
                    radius: 6,
                    customHTML: void 0,
                    onClick: void 0,
                    offsetX: 0,
                    offsetY: 0
                },
                itemMargin: {
                    horizontal: 10,
                    vertical: 0
                },
                onItemClick: {
                    toggleDataSeries: !0
                },
                onItemHover: {
                    highlightDataSeries: !0
                }
            },
            grid: {
                show: !0,
                borderColor: colors.borderColor,
                strokeDashArray: 0,
                position: "back",
                xaxis: {
                    lines: {
                        show: !1
                    }
                },
                yaxis: {
                    lines: {
                        show: !0
                    }
                },
                row: {
                    colors: void 0,
                    opacity: .5
                },
                column: {
                    colors: void 0,
                    opacity: .5
                },
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                }
            }
        };

        lineChart = new ApexCharts(document.querySelector("#lineChart"), lineChartoptions);
        lineChart.render();

    </script>

    <script>
        $(document).ready(function () {
            $.ajax({
                url: 'fetch-inventory-data.php',
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    var items = response.items;
                    var quantities = response.quantities;

                    var inventoryColumnChart, inventoryColumnChartOptions = {
                        series: [{
                            name: "Stocks",
                            data: quantities
                        }],
                        chart: {
                            type: "bar",
                            height: 350,
                            stacked: !1,
                            columnWidth: "70%",
                            zoom: {
                                enabled: !0
                            },
                            toolbar: {
                                show: !1
                            },
                            background: "transparent"
                        },
                        dataLabels: {
                            enabled: !1
                        },
                        theme: {
                            mode: colors.chartTheme
                        },
                        responsive: [{
                            breakpoint: 480,
                            options: {
                                legend: {
                                    position: "bottom",
                                    offsetX: -10,
                                    offsetY: 0
                                }
                            }
                        }],
                        plotOptions: {
                            bar: {
                                horizontal: !1,
                                columnWidth: "40%",
                                radius: 30,
                                enableShades: !1,
                                endingShape: "rounded"
                            }
                        },
                        xaxis: {
                            categories: items,
                            labels: {
                                show: !0,
                                trim: !0,
                                minHeight: void 0,
                                maxHeight: 120,
                                style: {
                                    colors: colors.mutedColor,
                                    cssClass: "text-muted",
                                    fontFamily: base.defaultFontFamily
                                }
                            },
                            axisBorder: {
                                show: !1
                            }
                        },
                        yaxis: {
                            labels: {
                                show: !0,
                                trim: !1,
                                offsetX: -10,
                                minHeight: void 0,
                                maxHeight: 120,
                                style: {
                                    colors: colors.mutedColor,
                                    cssClass: "text-muted",
                                    fontFamily: base.defaultFontFamily
                                }
                            }
                        },
                        legend: {
                            position: "top",
                            fontFamily: base.defaultFontFamily,
                            fontWeight: 400,
                            labels: {
                                colors: colors.mutedColor,
                                useSeriesColors: !1
                            },
                            markers: {
                                width: 10,
                                height: 10,
                                strokeWidth: 0,
                                strokeColor: "#fff",
                                fillColors: [extend.primaryColor, extend.primaryColorLighter],
                                radius: 6,
                                customHTML: void 0,
                                onClick: void 0,
                                offsetX: 0,
                                offsetY: 0
                            },
                            itemMargin: {
                                horizontal: 10,
                                vertical: 0
                            },
                            onItemClick: {
                                toggleDataSeries: !0
                            },
                            onItemHover: {
                                highlightDataSeries: !0
                            }
                        },
                        fill: {
                            opacity: 1,
                            colors: [base.primaryColor, extend.primaryColorLighter]
                        },
                        grid: {
                            show: !0,
                            borderColor: colors.borderColor,
                            strokeDashArray: 0,
                            position: "back",
                            xaxis: {
                                lines: {
                                    show: !1
                                }
                            },
                            yaxis: {
                                lines: {
                                    show: !0
                                }
                            },
                            row: {
                                colors: void 0,
                                opacity: .5
                            },
                            column: {
                                colors: void 0,
                                opacity: .5
                            },
                            padding: {
                                top: 0,
                                right: 0,
                                bottom: 0,
                                left: 0
                            }
                        }
                    };

                    var inventoryColumnChartCtn = document.querySelector("#columnChart");
                    inventoryColumnChartCtn && (inventoryColumnChart = new ApexCharts(inventoryColumnChartCtn, inventoryColumnChartOptions)).render();
                },
                error: function (err) {
                    console.log("Error fetching data: ", err);
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</body>

</html>