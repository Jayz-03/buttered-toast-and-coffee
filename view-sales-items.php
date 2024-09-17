<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true" id="view-sales-items-<?php echo $row1['sale_id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Sale ID #<?php echo $row1['sale_id']; ?> Information
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card shadow mt-2">
                    <div class="card-body">
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

                            .products .category {
                                font-size: 10px;
                                color: #000;
                            }

                            .products h5 {
                                font-size: 16px;
                                color: #000;
                            }

                            .products .d-flex h6 {
                                font-size: 14px;
                                color: #000;
                            }

                            .text h6, h4 {
                                color: #000;
                            }
                        </style>

                        <div class="row text">
                            <div class="col-md-7">
                                <h6>Sale ID: <span><?php echo $row1['sale_id']; ?></span></h6>
                                <h6>Payment Method: <span><?php echo $row1['payment_method']; ?></span></h6>
                                <h6>Transaction Date: <span><?php $formattedDate = date("l, F j Y - h:i A", strtotime($row1["transaction_date"]));
                                echo $formattedDate; ?></span></h6>
                            </div>
                            <div class="col-md-5">
                                <h6>Customer Pay: <span>₱<?php echo $row1['customer_pay']; ?></span></h6>
                                <h6>Change Amount: <span>₱<?php echo $row1['change_amount']; ?></span></h6>
                                <h6>Total Amount: <span>₱<?php echo $row1['total_amount']; ?></span></h6>
                            </div>
                        </div>

                        <h4 class="mt-3 text">Items</h4>
                        <div class="row">
                            <?php
                            $sale_id = $row1['sale_id'];
                            $sql1 = "SELECT * FROM sale_items WHERE sale_id = $sale_id";
                            $r = mysqli_query($link, $sql1);

                            if ($r->num_rows > 0) {
                                while ($row1 = mysqli_fetch_assoc($r)) {
                                    $product_id = $row1['product_id'];
                                    $sql3 = "SELECT * FROM product WHERE product_id = $product_id";
                                    $result3 = mysqli_query($link, $sql3);
                                    $row3 = mysqli_fetch_assoc($result3);

                                    echo '
                                    <div class="col-3 p-3 products">
                                        <div class="row">
                                            <div class="col-12">
                                                <img src="storage/products/' . htmlspecialchars($row3['photo']) . '" 
                                                    alt="' . htmlspecialchars($row3['product_name']) . '" 
                                                    class="img-thumbnail" width="100%">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12">
                                                <h6 class="text-white category">' . htmlspecialchars($row3['category_name']) . '</h6>
                                                <h5 class="text-white">' . htmlspecialchars($row3['product_name']) . '</h5>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between">
                                                    <h6 class="text-white text-right">₱' . htmlspecialchars($row1['price']) . '</h6>
                                                    <h6 class="text-white text-left">x' . htmlspecialchars($row1['quantity']) . '</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>