<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login");
    exit;
}

$active_page = "pos";

include 'config.php';

$categoryQuery = "SELECT * FROM category WHERE status = 0";
$categoryResult = mysqli_query($link, $categoryQuery);

function getProductsByCategory($link, $categoryName)
{
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

<body class="vertical light">
    <div class="wrapper">
        <?php include 'partials/staff-navbar.php'; ?>

        <main role="main" class="main-content">
            <div class="container-fluid">
                <h2 class="page-title">Point of Sale (POS)</h2>
                <div id="alert-container"></div>
                <div class="row justify-content-center">
                    <div class="col-7">
                        <div class="row">
                            <div class="col-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <style>
                                            .nav-pills a {
                                                color: #fff;
                                                text-decoration: none;
                                                background-color: grey;
                                                margin-left: 5px;
                                                margin-right: 5px;
                                            }

                                            .nav-pills .nav-link.active,
                                            .nav-pills .show>.nav-link {
                                                color: #ffffff;
                                                border-radius: 5px;
                                                background-color: #000;
                                            }

                                            #alert-container {
                                                position: fixed;
                                                top: 20px;
                                                right: 20px;
                                                z-index: 9999;
                                                width: auto;
                                                max-width: 500px;
                                            }

                                            .swal-button {
                                                color: #72C894;
                                                background-color: #04210F;
                                            }

                                            .swal-button:not([disabled]):hover {
                                                color: #72C894;
                                                background-color: #04210F;
                                            }

                                            /* Add custom horizontal scrolling */
                                            .category-scroll {
                                                white-space: nowrap;
                                                overflow-x: auto;
                                                -webkit-overflow-scrolling: touch;
                                                /* smooth scrolling on iOS */
                                            }

                                            .nav-item {
                                                display: inline-block;
                                                white-space: nowrap;
                                            }

                                            /* Hide scrollbar but keep functionality */
                                            .category-scroll::-webkit-scrollbar {
                                                display: none;
                                            }

                                            .category-scroll {
                                                -ms-overflow-style: none;
                                                /* IE and Edge */
                                                scrollbar-width: none;
                                                /* Firefox */
                                            }
                                        </style>

                                        <div class="category-scroll">
                                            <ul class="nav nav-pills nav-fill mb-3" id="category-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active mb-2" id="category-all-tab"
                                                        data-toggle="pill" href="#category-all" role="tab"
                                                        aria-controls="category-all" data-category="all">
                                                        ALL
                                                    </a>
                                                </li>
                                                <?php
                                                while ($category = mysqli_fetch_assoc($categoryResult)) {
                                                    echo '
                                                    <li class="nav-item mb-2">
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
                                        </div>

                                        <div class="row" id="product-list">
                                            <!-- Products will be loaded here dynamically via AJAX -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <div class="order-summary">
                                            <h4>Order Summary</h4>
                                            <table class="table" id="cart-table">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Item</th>
                                                        <th>Qty</th>
                                                        <th>Price</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="cart-items">
                                                    <tr class="text-center">
                                                        <td colspan="4">No items added yet.</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <h6>Payment Method:</h6>
                                            <select class="form-control" id="payment-method">
                                                <option value="Cash">Cash</option>
                                                <option value="Card">Gcash</option>
                                            </select>

                                            <hr>

                                            <div class="totals">
                                                <h6>Customer Pay: <input type="number" id="customer-pay"
                                                        class="form-control" placeholder="Please enter customer pay.">
                                                </h6>
                                                <h6>Change: <span id="change-amount">₱0.00</span></h6>
                                                <h6><b>Total Amount: <span id="total-amount">₱0.00</span></b></h6>
                                            </div>

                                            <style>
                                                .btn-success {
                                                    color: #72C894;
                                                    background-color: #04210F;
                                                }

                                                .btn-danger {
                                                    color: #E37083;
                                                    background-color: #2C0F14;
                                                }

                                                .order-summary h6,
                                                h4 {
                                                    color: #000;
                                                }
                                            </style>
                                            <div class="text-center mt-3 mb-2">
                                                <button class="btn btn-success btn-confirm">CONFIRM</button>
                                            </div>
                                        </div>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function loadProducts(categoryName) {
                const productList = document.getElementById('product-list');
                productList.innerHTML = '';

                const xhr = new XMLHttpRequest();
                xhr.open("POST", "get-products.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        productList.innerHTML = xhr.responseText;
                        attachAddToCartEvents();
                    } else {
                        console.error('Error loading products');
                    }
                };
                xhr.onerror = function() {
                    console.error('Request failed');
                };
                xhr.send("category_name=" + encodeURIComponent(categoryName));
            }

            function attachAddToCartEvents() {
                document.querySelectorAll('.btn-add-cart').forEach(button => {
                    button.addEventListener('click', function() {
                        const productId = this.getAttribute('data-id');
                        const productName = this.getAttribute('data-name');
                        const productPrice = parseFloat(this.getAttribute('data-price'));
                        addToCart(productId, productName, productPrice);
                    });
                });
            }

            const customerPayInput = document.getElementById('customer-pay');
            const changeAmountDisplay = document.getElementById('change-amount');

            customerPayInput.addEventListener('input', calculateChange);

            function calculateChange() {
                const totalAmount = parseFloat(document.getElementById('total-amount').textContent.replace('₱', ''));
                const customerPay = parseFloat(customerPayInput.value);

                if (!isNaN(customerPay) && customerPay >= 0) {
                    const change = customerPay - totalAmount;
                    changeAmountDisplay.textContent = `₱${(change >= 0 ? change.toFixed(2) : '0.00')}`;
                } else {
                    changeAmountDisplay.textContent = '₱0.00';
                }
            }

            let cart = {};

            function addToCart(productId, productName, productPrice) {
                if (cart[productId]) {
                    cart[productId].quantity++;
                } else {
                    cart[productId] = {
                        name: productName,
                        price: productPrice,
                        quantity: 1
                    };
                }
                updateCartUI();
                showAlert(productName + ' added to cart!', 'success');
            }

            function showAlert(message, type) {
                const alertContainer = document.getElementById('alert-container');
                const alertHtml = `
                <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                    <span class="fe fe-layers fe-16 mr-2"></span> ${message}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            `;
                alertContainer.innerHTML = alertHtml;

                setTimeout(() => {
                    alertContainer.innerHTML = '';
                }, 5000);
            }

            function updateCartUI() {
                const cartTable = document.getElementById('cart-items');
                cartTable.innerHTML = '';
                let totalAmount = 0;

                Object.keys(cart).forEach(productId => {
                    const product = cart[productId];
                    totalAmount += product.price * product.quantity;

                    cartTable.innerHTML += `
                <tr class="text-center">
                    <td>${product.name}</td>
                    <td>
                        <button class="btn btn-sm btn-dark btn-minus" data-id="${productId}">-</button>
                        <span class="ml-2 mr-2"> ${product.quantity} </span>
                        <button class="btn btn-sm btn-dark btn-plus" data-id="${productId}">+</button>
                    </td>
                    <td>₱${(product.price * product.quantity).toFixed(2)}</td>
                    <td><button class="btn btn-sm btn-danger btn-delete" data-id="${productId}">Delete</button></td>
                </tr>
            `;
                });

                document.getElementById('total-amount').textContent = `₱${totalAmount.toFixed(2)}`;
                attachCartEvents();
                calculateChange();
            }

            function attachCartEvents() {
                document.querySelectorAll('.btn-minus').forEach(button => {
                    button.addEventListener('click', function() {
                        const productId = this.getAttribute('data-id');
                        if (cart[productId].quantity > 1) {
                            cart[productId].quantity--;
                        } else {
                            delete cart[productId];
                        }
                        updateCartUI();
                    });
                });

                document.querySelectorAll('.btn-plus').forEach(button => {
                    button.addEventListener('click', function() {
                        const productId = this.getAttribute('data-id');
                        cart[productId].quantity++;
                        updateCartUI();
                    });
                });

                document.querySelectorAll('.btn-delete').forEach(button => {
                    button.addEventListener('click', function() {
                        const productId = this.getAttribute('data-id');
                        delete cart[productId];
                        updateCartUI();
                    });
                });
            }

            loadProducts('all');

            document.querySelectorAll('.nav-link').forEach(tab => {
                tab.addEventListener('click', function() {
                    const categoryName = this.getAttribute('data-category');
                    loadProducts(categoryName);
                });
            });

            console.log("DOM fully loaded");

            document.querySelector('.btn-confirm').addEventListener('click', function () {
                console.log("Confirm button clicked");

                // Get the payment method
                const paymentMethod = document.getElementById('payment-method').value;
                console.log("Payment Method Selected:", paymentMethod);

                const totalAmount = parseFloat(document.getElementById('total-amount').textContent.replace('₱', ''));
                const customerPay = parseFloat(document.getElementById('customer-pay').value);
                const change = customerPay - totalAmount;

                console.log("Total Amount:", totalAmount);
                console.log("Customer Pay:", customerPay);
                console.log("Change:", change);

                if (totalAmount > 0 && customerPay >= totalAmount) {
                    if (paymentMethod === 'Card') {
                        console.log("Payment method is card, validating card...");

                        const xhr = new XMLHttpRequest();
                        xhr.open("POST", "validate-card.php", true);
                        xhr.setRequestHeader("Content-Type", "application/json");
                        xhr.onload = function () {
                            try {
                                const responseText = xhr.responseText.trim();
                                console.log("Raw server response:", responseText);

                                if (responseText) {
                                    const cardData = JSON.parse(responseText);
                                    console.log("Card Validation Response:", cardData);

                                    if (cardData.status === 'error') {
                                        swal({
                                            title: 'Card Error!',
                                            text: 'Card is unavailable or balance is insufficient. Please use cash as a payment method.',
                                            icon: 'warning',
                                            buttons: ['Cancel', 'Use Cash'],
                                        }).then((useCash) => {
                                            if (useCash) {
                                                document.getElementById('payment-method').value = 'Cash'; // Switch to cash
                                                proceedWithOrder('Cash');
                                            }
                                        });
                                        return;
                                    } else {
                                        console.log("Card is valid, proceeding with order.");
                                        proceedWithOrder('Card');
                                    }
                                } else {
                                    console.log("Empty response received from server.");
                                    swal({
                                        title: 'Error!',
                                        text: 'No response from card validation service. Please try again later.',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            } catch (error) {
                                console.log("Failed to parse JSON:", error);
                                swal({
                                    title: 'Error!',
                                    text: 'Invalid response from server. Please try again later.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        };
                        xhr.onerror = function () {
                            console.log("Request failed with error");
                        };
                        xhr.send(JSON.stringify({
                            payment_method: paymentMethod,
                            total_amount: totalAmount
                        }));
                    } else {
                        console.log("Payment method is cash, proceeding with order.");
                        proceedWithOrder(paymentMethod); // Proceed with cash
                    }
                } else {
                    swal({
                        title: 'Invalid!',
                        text: 'Please ensure total amount is covered by customer payment.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                }
            });

            // Function to proceed with the order (save order)
            function proceedWithOrder(paymentMethod) {
                console.log("Proceeding with the order... Payment method:", paymentMethod);

                const totalAmount = parseFloat(document.getElementById('total-amount').textContent.replace('₱', ''));
                const customerPay = parseFloat(document.getElementById('customer-pay').value);
                const change = customerPay - totalAmount;

                const xhr = new XMLHttpRequest();
                xhr.open("POST", "save-order.php", true);
                xhr.setRequestHeader("Content-Type", "application/json");
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        console.log("Order Response:", response);

                        if (response.status === 'success') {
                            swal({
                                title: 'Success!',
                                text: 'Order confirmed!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                printInvoice(paymentMethod, totalAmount, customerPay, change, { ...cart }, response.queue_no);
                                cart = {};
                                updateCartUI();
                                document.getElementById('customer-pay').value = '';
                                document.getElementById('change-amount').textContent = '₱0.00';
                                document.getElementById('total-amount').textContent = '₱0.00';
                            });
                        } else {
                            swal({
                                title: 'Oops!',
                                text: 'Something went wrong. Please try again later.',
                                icon: 'warning',
                                confirmButtonText: 'Done!'
                            });
                        }
                    }
                };
                xhr.onerror = function () {
                    console.log("Request failed to save order");
                };
                xhr.send(JSON.stringify({
                    cart: cart,
                    payment_method: paymentMethod,
                    total_amount: totalAmount,
                    customer_pay: customerPay,
                    change: change
                }));
            }




            function printInvoice(paymentMethod, totalAmount, customerPay, change, cart, queueNo) {
                let iframe = document.createElement('iframe');
                document.body.appendChild(iframe);
                iframe.style.position = 'absolute';
                iframe.style.width = '0';
                iframe.style.height = '0';
                iframe.style.border = 'none';

                let invoiceContent = `
                <html>
                <head>
                </head>
                <body>
                    <div class="container">
                        <div class="header" style='text-align: center;'>
                            <img src="assets/images/logo.png" alt="Logo" height="90">
                            <h2>INVOICE</h2>
                            <h3 style='margin-top: -10px;'>Queue Number: ${queueNo}</h3>
                        </div>
                        <div>
                            <p><strong>Payment Method:</strong> ${paymentMethod}</p>
                            <p style='margin-top: -10px;'><strong>Total Amount:</strong> ₱${totalAmount.toFixed(2)}</p>
                            <p style='margin-top: -10px;'><strong>Customer Pay:</strong> ₱${customerPay.toFixed(2)}</p>
                            <p style='margin-top: -10px;'><strong>Change:</strong> ₱${change.toFixed(2)}</p>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th class="right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                `;

                Object.keys(cart).forEach(productId => {
                    const product = cart[productId];
                    const amount = product.price * product.quantity;
                    invoiceContent += `
                                <tr>
                                    <td>${product.name}</td>
                                    <td>${product.quantity}</td>
                                    <td class="right">₱${amount.toFixed(2)}</td>
                                </tr>`;
                });

                invoiceContent += `
                            </tbody>
                        </table>
                        <br>
                        <div class="footer" style='text-align: center;'>
                            <h3>To be happy is to drink coffee.</h3>
                            <h3 style='margin-top: -10px;'>Thank you for your order!</h3>
                    </div>
                    <br>
                    <div class="footer" style='text-align: center;'>
                            <small>Note: Kindly wait until your queue number is called.</small>
                    </div>
                </body>
                </html>
                `;

                let doc = iframe.contentWindow.document;
                doc.open();
                doc.write(invoiceContent);
                doc.close();

                iframe.contentWindow.print();

                document.body.removeChild(iframe);
            }
        });
    </script>
</body>

</html>