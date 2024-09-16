<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login");
    exit;
}

$active_page = "pos";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Point of Sale (POS)</title>
    <?php include 'partials/header.php'; ?>
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
</style>

<body class="vertical  light">
    <div class="wrapper">
        <?php include 'partials/staff-navbar.php'; ?>

        <main role="main" class="main-content">
            <div class="container-fluid">
                <h2 class="page-title">Point of Sale (POS)</h2>
                <div class="row justify-content-center">
                    <div class="col-7">
                        <div class="row">
                            <?php
                            $products = [
                                ["id" => 1, "name" => "CE", "price" => 130.00, "image" => "path_to_image_1"],
                                ["id" => 2, "name" => "SPM", "price" => 160.00, "image" => "path_to_image_2"],
                                ["id" => 3, "name" => "BFG", "price" => 165.00, "image" => "path_to_image_3"],
                                ["id" => 4, "name" => "HMC", "price" => 140.00, "image" => "path_to_image_4"]
                            ];

                            foreach ($products as $product) {
                                echo '
                                <div class="col-3">
                                    <div class="product-card">
                                        <img src="' . $product['image'] . '" alt="' . $product['name'] . '">
                                        <h5>' . $product['name'] . '</h5>
                                        <p>₱' . number_format($product['price'], 2) . '</p>
                                        <button class="btn btn-primary btn-sm add-to-cart" 
                                                data-id="' . $product['id'] . '" 
                                                data-name="' . $product['name'] . '" 
                                                data-price="' . $product['price'] . '">
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                                ';
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Order Summary Column -->
                    <div class="col-5">
                        <div class="order-summary">
                            <h4>Order Summary</h4>
                            <div id="cart-items"></div>
                            <div class="totals">
                                <p>Total Amount: <span id="total-amount">₱0.00</span></p>
                            </div>

                            <select class="form-control">
                                <option>Cash</option>
                                <option>Card</option>
                            </select>

                            <button class="btn-confirm">CONFIRM</button>
                            <button class="btn-cancel">CANCEL</button>
                        </div>
                    </div>
                </div> <!-- .row -->
            </div> <!-- .container-fluid -->

            <?php include 'partials/staff-modals.php'; ?>

        </main> <!-- main -->
    </div> <!-- .wrapper -->
    <?php include 'partials/jscripts.php'; ?>
    <script src="js/pos.js"></script> <!-- Include the new JavaScript file -->
</body>

</html>