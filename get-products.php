<style>
    .products {
        border-radius: 15px;
        background-color: black;
        margin-left: 5px;
        margin-right: 5px;
    }

    .products img {
        border-radius: 30%;
    }

    .btn-add-cart {
        width: 100%;
        height: 100%;
    }

    .btn-add-cart i {
        text-align: center;
        font-size: 30px;
        margin-left: -4px;
    }
</style>


<?php

include 'config.php';

if (isset($_POST['category_name'])) {
    $categoryName = $_POST['category_name'];

    error_log("Category: " . $categoryName);

    if ($categoryName == "all") {
        $productQuery = "SELECT * FROM product WHERE status = 0 ORDER BY category_name";
        $stmt = $link->prepare($productQuery);

        if ($stmt) {
            $stmt->execute();
            $result = $stmt->get_result();

            error_log("Number of products found: " . $result->num_rows);

            if ($result->num_rows > 0) {
                $currentCategory = '';

                while ($product = $result->fetch_assoc()) {
                    if ($product['category_name'] != $currentCategory) {
                        $currentCategory = $product['category_name'];

                        echo '
                        <div class="col-12 mt-3 text-center">
                            <h3 class="text-dark">' . htmlspecialchars($currentCategory) . '</h3>
                        </div>';
                    }

                    echo '
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 p-3">
                        <div class="card h-100 text-center" style="background-color: black; border-radius: 15px;">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <img src="storage/products/' . htmlspecialchars($product['photo']) . '" 
                                     alt="' . htmlspecialchars($product['product_name']) . '" 
                                     class="img-thumbnail mb-3" style="width: 100%; max-height: 200px; object-fit: contain;">
                                <h6 class="text-white">' . htmlspecialchars($product['product_name']) . '</h6>
                                <p class="text-white">₱' . number_format($product['price'], 2) . '</p>
                                <button class="btn btn-primary btn-add-cart bg-white text-dark" style="width: 100%; max-height: 50px; object-fit: contain;" 
                                        data-id="' . htmlspecialchars($product['product_id']) . '" 
                                        data-name="' . htmlspecialchars($product['product_name']) . '" 
                                        data-price="' . htmlspecialchars($product['price']) . '">
                                    <i class="fe fe-shopping-cart"></i>
                                </button>
                            </div>
                        </div>
                    </div>';
                }

            } else {
                echo '<div class="col-12 text-center">
                        <img src="assets/images/logo.png" alt="" width="200">
                        <p class="text-dark mt-3">No products available in this category.</p>
                    </div>';
            }
        } else {
            echo '<p class="text-dark">Error fetching products. Please try again later.</p>';
        }
    } else {
        $productQuery = "SELECT * FROM product WHERE category_name = ? AND status = 0";
        $stmt = $link->prepare($productQuery);

        if ($stmt) {
            $stmt->bind_param("s", $categoryName);
            $stmt->execute();
            $result = $stmt->get_result();

            error_log("Number of products found: " . $result->num_rows);

            echo '
            <div class="col-12 mt-3 text-center">
                <h3 class="text-dark">' . htmlspecialchars($categoryName) . '</h3>
            </div>';

            if ($result->num_rows > 0) {
                while ($product = $result->fetch_assoc()) {
                    echo '
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 p-3">
                        <div class="card h-100 text-center" style="background-color: black; border-radius: 15px;">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <img src="storage/products/' . htmlspecialchars($product['photo']) . '" 
                                     alt="' . htmlspecialchars($product['product_name']) . '" 
                                     class="img-thumbnail mb-3" style="width: 100%; max-height: 200px; object-fit: contain;">
                                <h6 class="text-white">' . htmlspecialchars($product['product_name']) . '</h6>
                                <p class="text-white">₱' . number_format($product['price'], 2) . '</p>
                                <button class="btn btn-primary btn-add-cart bg-white text-dark" style="width: 100%; max-height: 50px; object-fit: contain;" 
                                        data-id="' . htmlspecialchars($product['product_id']) . '" 
                                        data-name="' . htmlspecialchars($product['product_name']) . '" 
                                        data-price="' . htmlspecialchars($product['price']) . '">
                                    <i class="fe fe-shopping-cart"></i>
                                </button>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo '<div class="col-12 text-center">
                        <img src="assets/images/logo.png" alt="" width="200">
                        <p class="text-dark mt-3">No products available in this category.</p>
                    </div>';
            }
        } else {
            echo '<p class="text-dark">Error fetching products. Please try again later.</p>';
        }
    }

    $stmt->close();
}
?>