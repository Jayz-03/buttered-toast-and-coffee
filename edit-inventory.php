<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true" id="edit-inventory-<?php echo $row1['inventory_id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Update Inventory ID #<?php echo $row1['inventory_id']; ?> Information
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="row justify-content-center m-3">
                        <div class="col-5">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <strong class="card-title">Inventory Photo</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <input type="hidden" name="inventory_id"
                                                    value="<?php echo $row1['inventory_id']; ?>">
                                                <input type="hidden" name="no_photo"
                                                    value="<?php echo $row1['photo']; ?>">
                                                <div class="text-center">
                                                    <img src="storage/inventory/<?php echo $row1['photo']; ?>"
                                                        class="avatar img-thumbnail mb-2" alt="avatar" height="250px"
                                                        width="250px">
                                                </div>
                                                <br>
                                                <label for="customFile">Choose Inventory Photo</label>
                                                <div class="custom-file">
                                                    <input type="file" id="customFile" accept="image/*" name="photo"
                                                        class="custom-file-input form-control <?php echo (!empty($photo_err)) ? 'is-invalid' : ''; ?> file-upload mb-3"
                                                        value="<?php echo $row1['photo']; ?>">
                                                    <span class="invalid-feedback"><?php echo $photo_err; ?></span>
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        file</label>
                                                </div>
                                                <script>
                                                    $(document).ready(function () {

                                                        var readURL = function (input) {
                                                            if (input.files && input.files[0]) {
                                                                var reader = new FileReader();

                                                                reader.onload = function (e) {
                                                                    $('.avatar').attr('src', e.target.result);
                                                                }

                                                                reader.readAsDataURL(input.files[0]);
                                                            }
                                                        }


                                                        $(".file-upload").on('change', function () {
                                                            readURL(this);
                                                        });
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <strong class="card-title">Inventory Item Information</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="example-item">Item Name</label>
                                                <input type="text" id="example-item" name="item"
                                                    class="form-control <?php echo (!empty($item_err)) ? 'is-invalid' : ''; ?>"
                                                    placeholder="Please enter an item." value="<?php echo $row1['item']; ?>">
                                                <span class="invalid-feedback"><?php echo $item_err; ?></span>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="example-quantity">Quantity</label>
                                                <input type="number" id="example-quantity" name="quantity"
                                                    class="form-control <?php echo (!empty($quantity_err)) ? 'is-invalid' : ''; ?>"
                                                    placeholder="Please enter quantity."
                                                    value="<?php echo $row1['stocks']; ?>">
                                                <span class="invalid-feedback"><?php echo $quantity_err; ?></span>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="example-low_stock">Low Stock Quantity</label>
                                                <input type="number" id="example-low_stock" name="low_stock"
                                                    class="form-control <?php echo (!empty($low_stock_err)) ? 'is-invalid' : ''; ?>"
                                                    placeholder="Please enter low stock quantity."
                                                    value="<?php echo $row1['low_stock']; ?>">
                                                <span class="invalid-feedback"><?php echo $low_stock_err; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="update">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>