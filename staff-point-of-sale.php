<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login");
    exit;
}

$active_page = "pos";

// Database connection (assuming you're using MySQLi)
include 'config.php';

// Fetch all categories
$categoryQuery = "SELECT * FROM category WHERE status = 0";
$categoryResult = mysqli_query($link, $categoryQuery);

// Function to fetch products for a specific category (this will be used in AJAX)
function getProductsByCategory($link, $categoryName) {
    $productQuery = "SELECT * FROM product WHERE category_name = ? AND status = 0";
    $stmt = $link->prepare($productQuery);
    $stmt->bind_param("s", $categoryName);
    $stmt->execute();
    return $stmt->get_result();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Point of Sale (POS)</title>
    <?php include 'partials/header.php'; ?>
</head>

<body class="vertical  light">
    <div class="wrapper">
        <?php include 'partials/staff-navbar.php'; ?>

        <main role="main" class="main-content">
            <div class="container-fluid">
                <h2 class="page-title">Point of Sale (POS)</h2>
                <div class="row justify-content-center">
                    <div class="col-7">
                        <div class="row">
                            <div class="col-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <!-- Dynamic Category Tabs -->
                                        <ul class="nav nav-pills nav-fill mb-3" id="category-tabs" role="tablist">
                                            <?php
                                            // Display category tabs dynamically
                                            while ($category = mysqli_fetch_assoc($categoryResult)) {
                                                echo '
                                <li class="nav-item">
                                    <a class="nav-link" id="category-' . $category['category_id'] . '-tab" data-toggle="pill"
                                       href="#category-' . $category['category_id'] . '" role="tab"
                                       aria-controls="category-' . $category['category_id'] . '"
                                       data-category="' . $category['category_name'] . '">
                                        ' . $category['category_name'] . '
                                    </a>
                                </li>';
                                            }
                                            ?>
                                        </ul>



                                        <div class="row" id="product-list">
                                            <!-- Products will be loaded here dynamically via AJAX -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary Column -->
                    <div class="col-5 p-2 bg-white">
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
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Function to load products based on category
            function loadProducts(categoryName) {
                const productList = document.getElementById('product-list');
                productList.innerHTML = ''; // Clear the current product list

                // Fetch products for the selected category using AJAX
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "get_products.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        productList.innerHTML = xhr.responseText; // Update the product list with the response
                    }
                };
                xhr.send("category_name=" + categoryName);
            }

            // Attach click event to category tabs
            document.querySelectorAll('.nav-link').forEach(tab => {
                tab.addEventListener('click', function () {
                    const categoryName = this.getAttribute('data-category');
                    loadProducts(categoryName);
                });
            });

            // Load products for the first category by default (if available)
            const firstCategoryTab = document.querySelector('.nav-link');
            if (firstCategoryTab) {
                loadProducts(firstCategoryTab.getAttribute('data-category'));
            }
        });
    </script>
    <script src="js/pos.js"></script>
</body>

</html>