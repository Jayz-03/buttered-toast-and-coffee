<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true" id="edit-product-<?php echo $row1['product_id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Update Product ID #<?php echo $row1['product_id']; ?> Information
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="row justify-content-center mt-3">
                        <div class="col-5">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <strong class="card-title">Product Photo</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <input type="hidden" name="product_id"
                                                    value="<?php echo $row1['product_id']; ?>">
                                                <input type="hidden" name="no_photo"
                                                    value="<?php echo $row1['photo']; ?>">
                                                <div class="text-center">
                                                    <img src="storage/products/<?php echo $row1['photo']; ?>"
                                                        class="avatar img-thumbnail mb-2" alt="avatar" height="250px"
                                                        width="250px">
                                                </div>
                                                <br>
                                                <label for="customFile">Choose Product Photo</label>
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
                                    <strong class="card-title">Product Information</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="example-product_name">Product Name</label>
                                                <input type="text" id="example-product_name" name="product_name"
                                                    class="form-control <?php echo (!empty($product_name_err)) ? 'is-invalid' : ''; ?>"
                                                    placeholder="Please enter product name."
                                                    value="<?php echo $row1['product_name']; ?>">
                                                <span class="invalid-feedback"><?php echo $product_name_err; ?></span>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="example-select">Select Category</label>
                                                <select name="category_name"
                                                    class="form-control select <?php echo (!empty($category_name_err)) ? 'is-invalid' : ''; ?>">
                                                    <option value="">Select Category:</option>
                                                    <optgroup label="Categories">
                                                        <?php
                                                        $sql3 = "SELECT * FROM category";
                                                        $r3 = mysqli_query($link, $sql3);

                                                        if ($r3->num_rows > 0) {
                                                            while ($row3 = mysqli_fetch_assoc($r3)) {
                                                                $selected = ($row3["category_name"] == $row1["category_name"]) ? 'selected' : '';
                                                                echo "<option value=\"" . $row3["category_name"] . "\" $selected>" . $row3["category_name"] . "</option>";
                                                            }
                                                        } else {
                                                            echo "<option value=\"\">No categories available</option>";
                                                        }
                                                        ?>
                                                    </optgroup>
                                                </select>


                                                <span class="invalid-feedback"><?php echo $category_name_err; ?></span>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="example-price">Price</label>
                                                <input type="number" id="example-price" name="price"
                                                    class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>"
                                                    placeholder="Please enter price."
                                                    value="<?php echo $row1['price']; ?>">
                                                <span class="invalid-feedback"><?php echo $price_err; ?></span>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="example-status">Status</label>
                                                <select name="status"
                                                    class="form-control select <?php echo (!empty($status_err)) ? 'is-invalid' : ''; ?>">
                                                    <option value="">Please select a status:</option>
                                                    <optgroup label="Status:">
                                                        <option value="0" <?php if ($row1['status'] == 0)
                                                            echo 'selected'; ?>>Available</option>
                                                        <option value="1" <?php if ($row1['status'] == 1)
                                                            echo 'selected'; ?>>Unavailable</option>
                                                    </optgroup>
                                                </select>

                                                <span class="invalid-feedback"><?php echo $status_err; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- / .card -->
                        </div> <!-- .col-12 -->
                    </div> <!-- .row -->
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="update">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>