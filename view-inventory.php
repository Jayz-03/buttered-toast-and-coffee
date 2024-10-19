<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true" id="view-inventory-<?php echo $row1['inventory_id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Inventory ID #<?php echo $row1['inventory_id']; ?> Information
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card shadow mt-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <div class="text-center">
                                        <img src="storage/inventory/<?php echo $row1['photo']; ?>"
                                            class="avatar img-thumbnail mb-2" alt="avatar" height="250px" width="250px">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Item:</label>
                                <input type="text" class="form-control" value="<?php echo $row1['item']; ?>" disabled>
                                <label class="mt-2">Quantity:</label>
                                <input type="text" class="form-control" value="<?php echo $row1['quantity']; ?>"
                                    disabled>
                                <label class="mt-2">Last updated:</label>
                                <input type="text" class="form-control" value="<?php $formattedDate = date("l, F j Y - h:i A", strtotime($row1["last_updated"]));
                                echo $formattedDate; ?>" disabled>
                            </div>
                            <div class="col-md-6">
                                <label>Managed by:</label>
                                <div class="d-flex align-items-center">
                                    <img src="storage/profile/<?php if ($row3["photo"] != "") {
                                        echo $row3["photo"];
                                    } else {
                                        echo 'default_image.png';
                                    } ?>" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                                    <div class="ms-3 text-left mx-2">
                                        <p class="fw-bold mb-1">
                                            <?php echo $row3['lastname']; ?>,
                                            <?php echo $row3['firstname']; ?>
                                        </p>
                                        <p class="text-muted mb-0"><?php echo $row3['email']; ?>
                                        </p>
                                    </div>
                                </div>

                                <label class="mt-4">Status:</label>
                                <br>
                                <?php if ($row1['quantity'] > $row1['low_stock']) {
                                    echo '<span class="badge badge-success rounded-pill d-inline px-3">In Stock</span>';
                                } elseif ($row1['quantity'] < $row1['low_stock']) {
                                    echo '<span class="badge badge-warning rounded-pill d-inline px-3">Low Stock</span>';
                                } elseif ($row1['quantity'] == 0) {
                                    echo '<span class="badge badge-danger rounded-pill d-inline px-3">Out of Stock</span>';
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>