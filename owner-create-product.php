<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login");
    exit;
}

$active_page = "product";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <?php include 'partials/header.php'; ?>
    <script src="js/jquery.slim.min.js"></script>
</head>

<body class="vertical  light">
    <div class="wrapper">
        <?php include 'partials/owner-navbar.php'; ?>
        <main role="main" class="main-content">
            <div class="container-fluid">
                <h2 class="page-title">Product - Create Product</h2>

                <?php
                $product_name = $category_name = $price = $photo = "";
                $product_name_err = $category_name_err = $price_err = $photo_err = "";
                $status = 0;

                if (isset($_POST["submit"])) {

                    if (empty(trim($_POST["product_name"]))) {
                        $product_name_err = "Please enter an product name.";
                    } else {
                        $sql = "SELECT product_id FROM product WHERE product_name = ?";

                        if ($stmt = mysqli_prepare($link, $sql)) {
                            mysqli_stmt_bind_param($stmt, "s", $param_product_name);

                            $param_product_name = trim($_POST["product_name"]);

                            if (mysqli_stmt_execute($stmt)) {
                                mysqli_stmt_store_result($stmt);

                                if (mysqli_stmt_num_rows($stmt) == 1) {
                                    $product_name_err = "This product is already exist.";
                                } else {
                                    $product_name = trim($_POST["product_name"]);
                                }
                            } else {
                                echo "<script>swal({
                                    title: 'Oops!',
                                    text: 'Something went wrong. Please try again later.',
                                    icon: 'warning',
                                    button: 'Done!',
                                });</script>";
                            }

                            mysqli_stmt_close($stmt);
                        }
                    }

                    if (empty(trim($_POST["category_name"]))) {
                        $category_name_err = "Please enter category name.";
                    } else {
                        $category_name = mysqli_real_escape_string($link, ($_POST["category_name"]));
                    }

                    if (empty(trim($_POST["price"]))) {
                        $price_err = "Please enter price.";
                    } else {
                        $price = mysqli_real_escape_string($link, ($_POST["price"]));
                    }

                    if (empty($_FILES['photo']['name'])) {
                        $photo = "default_image.png";
                        $photo_new_name = "default_image.png";
                    } else {
                        $photo = $_FILES["photo"]["name"];
                        $photo_tmp_name = $_FILES["photo"]["tmp_name"];
                        $photo_size = $_FILES["photo"]["size"];
                        $photo_new_name = rand() . "_" . $photo;
                    }

                    $product_ingredients = [];

                    // Process product ingredients
                    if (!empty($_POST['inventory_id']) && !empty($_POST['quantity'])) {
                        foreach ($_POST['inventory_id'] as $index => $inventory_id) {
                            $quantity = $_POST['quantity'][$index];
                            if (!empty($inventory_id) && !empty($quantity)) {
                                $product_ingredients[] = [
                                    'inventory_id' => $inventory_id,
                                    'quantity' => $quantity
                                ];
                            }
                        }
                    }

                    // Convert product ingredients array to JSON for storage
                    $product_ingredients_json = json_encode($product_ingredients);

                    if (empty($product_name_err) && empty($category_name_err) && empty($price_err) && empty($photo_err)) {
                        $sql = "INSERT INTO product (owner_id, product_name, category_name, price, status, photo, product_ingredients) VALUES (?, ?, ?, ?, ?, ?, ?)";

                        if ($stmt = mysqli_prepare($link, $sql)) {
                            mysqli_stmt_bind_param($stmt, "issiiss", $param_owner_id, $param_product_name, $param_category_name, $param_price, $param_status, $param_photo, $param_product_ingredients);

                            $param_owner_id = $owner_id;
                            $param_product_name = $product_name;
                            $param_category_name = $category_name;
                            $param_price = $price;
                            $param_status = $status;
                            $param_photo = $photo_new_name;
                            $param_product_ingredients = $product_ingredients_json;  // Store JSON-encoded ingredients

                            if (mysqli_stmt_execute($stmt)) {
                                if ($photo_new_name !== "default_image.png") {
                                    move_uploaded_file($photo_tmp_name, "storage/products/" . $photo_new_name);
                                }

                                // Success feedback
                                echo "<script>swal({
                                    title: 'Success!',
                                    text: 'Product Added Successfully!',
                                    icon: 'success',
                                    closeOnClickOutside: false,
                                    button: false
                                });</script>";
                ?>
                                <meta http-equiv="Refresh" content="3; url=owner-product-list">
                <?php
                            } else {
                                echo "<script>swal({
                                    title: 'Oops!',
                                    text: 'Something went wrong. Please try again later.',
                                    icon: 'warning',
                                    button: 'Done!',
                                });</script>";
                            }

                            mysqli_stmt_close($stmt);
                        }
                    }
                }

                ?>
                <form method="post" enctype="multipart/form-data">
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <strong class="card-title">Product Photo <span
                                            style="color: #6c757d;">(Optional)</span></strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <div class="text-center">
                                                    <img src="storage/products/default_image.png"
                                                        class="avatar img-thumbnail mb-2" alt="avatar" height="250px"
                                                        width="250px">
                                                </div>
                                                <br>
                                                <label for="customFile">Choose Product Photo</label>
                                                <div class="custom-file">
                                                    <input type="file" id="customFile" accept="image/*" name="photo"
                                                        class="custom-file-input form-control <?php echo (!empty($photo_err)) ? 'is-invalid' : ''; ?> file-upload mb-3"
                                                        value="<?php echo $row['photo']; ?>">
                                                    <span class="invalid-feedback"><?php echo $photo_err; ?></span>
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        file</label>
                                                </div>
                                                <script>
                                                    $(document).ready(function() {

                                                        var readURL = function(input) {
                                                            if (input.files && input.files[0]) {
                                                                var reader = new FileReader();

                                                                reader.onload = function(e) {
                                                                    $('.avatar').attr('src', e.target.result);
                                                                }

                                                                reader.readAsDataURL(input.files[0]);
                                                            }
                                                        }


                                                        $(".file-upload").on('change', function() {
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
                        <div class="col-4">
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
                                                    value="<?php echo $product_name; ?>">
                                                <span class="invalid-feedback"><?php echo $product_name_err; ?></span>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="example-select">Select Category</label>
                                                <select class="form-control" id="example-select" name="category_name">
                                                    <option value="">Select Category:</option>
                                                    <?php
                                                    $sql1 = "SELECT * FROM category";
                                                    $r = mysqli_query($link, $sql1);

                                                    if ($r->num_rows > 0) {
                                                        while ($row1 = mysqli_fetch_assoc($r)) {
                                                            echo "<option value=\"" . $row1["category_name"] . "\">" . $row1["category_name"] . "</option>";
                                                        }
                                                    } else {
                                                        echo "<option value=\"\">No categories available</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <span class="invalid-feedback"><?php echo $category_name_err; ?></span>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="example-price">Price</label>
                                                <input type="number" id="example-price" name="price"
                                                    class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>"
                                                    placeholder="Please enter price." value="<?php echo $price; ?>">
                                                <span class="invalid-feedback"><?php echo $price_err; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- / .card -->
                        </div>
                        <div class="col-4">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <strong class="card-title">Product Item Ingredients</strong>
                                </div>
                                <div class="card-body">
                                    <div id="ingredients-container">
                                        <div class="ingredient-row">
                                            <div class="row">
                                                <div class="col-7">
                                                    <div class="form-group mb-3">
                                                        <label for="inventory-item">Select Inventory Item</label>
                                                        <select class="form-control inventory-select select2" id="simple-select2" name="inventory_id[]">
                                                            <option value="">Select Inventory Item:</option>
                                                            <?php
                                                            $sql1 = "SELECT * FROM inventory";
                                                            $r = mysqli_query($link, $sql1);

                                                            if ($r->num_rows > 0) {
                                                                while ($row1 = mysqli_fetch_assoc($r)) {
                                                                    echo "<option value=\"" . $row1["inventory_id"] . "\">" . $row1["item"] . "</option>";
                                                                }
                                                            } else {
                                                                echo "<option value=\"\">No inventory available</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="form-group mb-3">
                                                        <label for="quantity">Quantity</label>
                                                        <input type="number" class="form-control" name="quantity[]" placeholder="Enter quantity">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" id="add-ingredient" class="btn btn-secondary">Add Another Ingredient</button>
                                </div>
                            </div>
                        </div>

                        <script>
                            const addedIngredients = new Set(); // Store the added ingredients

                            document.getElementById('add-ingredient').addEventListener('click', function() {
                                const selectedIngredient = document.querySelector('.ingredient-row:last-child select').value;

                                if (!selectedIngredient) {
                                    alert('Please select an inventory item before adding another ingredient.');
                                    return;
                                }

                                if (addedIngredients.has(selectedIngredient)) {
                                    alert('This ingredient has already been added.');
                                } else {
                                    addedIngredients.add(selectedIngredient); // Add the selected ingredient to the set
                                    const container = document.getElementById('ingredients-container');
                                    const newIngredient = document.querySelector('.ingredient-row').cloneNode(true);

                                    // Clear the selection and quantity in the cloned row
                                    newIngredient.querySelector('select').value = '';
                                    newIngredient.querySelector('input').value = '';

                                    container.appendChild(newIngredient);
                                }
                            });
                        </script>


                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Create</button>
                </form>
            </div>

            <?php include 'partials/owner-modals.php'; ?>

        </main>
    </div>
    <?php include 'partials/jscripts.php'; ?>
    <script>
        $('.select2').select2({
            theme: 'bootstrap4',
        });
        $('.select2-multi').select2({
            multiple: true,
            theme: 'bootstrap4',
        });
    </script>
</body>

</html>