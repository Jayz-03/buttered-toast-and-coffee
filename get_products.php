<?php
// get_products.php

include 'config.php';

if (isset($_POST['category_name'])) {
    $categoryName = $_POST['category_name'];

    // Prepare the SQL query to fetch products based on the category
    $productQuery = "SELECT * FROM product WHERE category_name = ? AND status = 0";
    $stmt = $link->prepare($productQuery);
    $stmt->bind_param("s", $categoryName);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display the products for the selected category
    while ($product = $result->fetch_assoc()) {
        echo '
        <div class="col-3 bg-dark p-3">
            <div class="row">
                <div class="col-12">
                    <img src="storage/products/' . $product['photo'] . '" alt="' . $product['product_name'] . '" class="img-thumbnail" width="100%">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-7">
                    <h5 class="text-white">' . $product['product_name'] . '</h5>
                    <p class="text-white">₱' . number_format($product['price'], 2) . '</p>
                </div>
                <div class="col-5">
                    <button class="btn btn-primary add-to-cart bg-white text-dark" 
                            data-id="' . $product['product_id'] . '" 
                            data-name="' . $product['product_name'] . '" 
                            data-price="' . $product['price'] . '">
                        <i class="fe fe-shopping-cart"></i>
                    </button>
                </div>
            </div>
        </div>';
    }
}
?>
