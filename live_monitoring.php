<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login");
    exit;
}

$active_page = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blank Page</title>
    <?php include 'partials/header.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

    body {
        position: relative;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(255, 255, 255, 0.95);
        z-index: -1;
    }

    .large-text {
        font-size: 24px;
    }
</style>

<body class="vertical light"
    style="background-image: url('assets/images/bg.jpg'); background-size: cover; background-position: center;">
    <div class="overlay"></div>
    <div class="wrapper">
        <main role="main" class="main-content">
            <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="page-title">Buttered Toast & Coffee</h2>
                                <video width="100%" controls autoplay loop muted>
                                    <source src="assets/videos/buttered-video.mp4" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-6">
                                <h3>Preparing Orders</h3>
                                <ul id="preparingOrders" class="list-group">
                                    <!-- Preparing orders will be inserted here -->
                                </ul>
                            </div>
                            <div class="col-6">
                                <h3>Now Serving</h3>
                                <ul id="servingOrders" class="list-group">
                                    <!-- Serving orders will be inserted here -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        $(document).ready(function () {
            function fetchSalesStatus() {
                $.ajax({
                    url: 'get_sales_status.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        console.log('Sales data:', response);
                        updateOrderLists(response);
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching sales data:', error);
                    }
                });
            }

            function updateOrderLists(sales) {
                $('#preparingOrders').empty();
                $('#servingOrders').empty();

                if (sales && sales.length > 0) {
                    sales.forEach(function (sale) {
                        var saleItem = `
                <li class="list-group-item large-text">
    Queue No. ${sale.queue_no}
</li>

            `;
                        if (sale.status === '0') {
                            $('#preparingOrders').append(saleItem);
                        } else if (sale.status === '1') {
                            $('#servingOrders').append(saleItem);
                        }
                    });
                } else {
                    $('#preparingOrders').append('<li class="list-group-item">No orders currently preparing.</li>');
                    $('#servingOrders').append('<li class="list-group-item">No orders currently serving.</li>');
                }
            }


            fetchSalesStatus();

            setInterval(fetchSalesStatus, 3000);
        });
    </script>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <?php include 'partials/jscripts.php'; ?>
</body>



</html>