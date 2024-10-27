<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login");
    exit;
}

$active_page = "category";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category List</title>
    <?php include 'partials/header.php'; ?>
    <link rel="stylesheet" href="css/dataTables.bootstrap4.css">
    <script src="js/jquery.slim.min.js"></script>
</head>

<body class="vertical  light">
    <div class="wrapper">
        <?php include 'partials/owner-navbar.php'; ?>

        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <h2 class="page-title">Category - Category List</h2>
                        <?php
                        $category_name_err = $photo_err = $status_err = "";
                        if (isset($_POST["update"])) {
                            $category_id = $_POST['category_id'];

                            if (empty(trim($_POST["category_name"]))) {
                                $category_name_err = "Please enter a category name.";
                            } else {
                                $sql = "SELECT category_id FROM category WHERE category_name = ? AND category_id != ?";

                                if ($stmt = mysqli_prepare($link, $sql)) {
                                    mysqli_stmt_bind_param($stmt, "si", $param_category_name, $category_id);

                                    $param_category_name = trim($_POST["category_name"]);

                                    if (mysqli_stmt_execute($stmt)) {
                                        mysqli_stmt_store_result($stmt);

                                        if (mysqli_stmt_num_rows($stmt) > 0) {
                                            $category_name_err = "This category already exists.";
                                        } else {
                                            $category_name = trim($_POST["category_name"]);
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

                            if (!isset($_POST["status"])) { 
                                $status_err = "Please select a status.";
                            } else {
                                $status = mysqli_real_escape_string($link, trim($_POST["status"]));
                            }

                            if (empty($_FILES['photo']['name'])) {
                                $photo = $_POST['no_photo']; 
                            } else {
                                $old_photo = "storage/category/" . $_POST['no_photo'];
                            
                                if (file_exists($old_photo)) {
                                    unlink($old_photo);
                                }
                                $photo = ($_FILES["photo"]["name"]);
                                $photo_tmp_name = $_FILES["photo"]["tmp_name"];
                                $photo_size = $_FILES["photo"]["size"];
                                $photo_new_name = rand() . $photo;
                                $photo = $photo_new_name;
                            }

                            if (empty($category_name_err) && empty($photo_err) && empty($status_err)) {
                                $sql1 = "UPDATE category SET owner_id=?, category_name=?, status=?, photo=? WHERE category_id=?";
                                $stmt = mysqli_prepare($link, $sql1);

                                mysqli_stmt_bind_param($stmt, 'isisi', $owner_id, $category_name, $status, $photo, $category_id);

                                if (mysqli_stmt_execute($stmt)) {
                                    if (!empty($_FILES['photo']['name'])) {
                                        move_uploaded_file($photo_tmp_name, "storage/category/" . $photo);
                                    }

                                    echo "<script>swal({
                                        title: 'Success!',
                                        text: 'Category Updated Successfully!',
                                        icon: 'success',
                                        button: false,
                                    });</script>";
                                    ?>
                                    <meta http-equiv="Refresh" content="3; url=owner-category-list">
                                    <?php
                                } else {
                                    echo "<script>swal({
                                        title: 'Error!',
                                        text: 'Unsuccessful!',
                                        icon: 'error',
                                        button: 'Ok!',
                                    });</script>";
                                }
                            }
                        }
                        ?>

                        <div class="row my-4">
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <table class="table datatables" id="dataTable-1">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>ID</th>
                                                    <th>Category Name</th>
                                                    <th>Status</th>
                                                    <th>Managed By</th>
                                                    <th>Last Updated</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql1 = "SELECT * FROM category";
                                                $r = mysqli_query($link, $sql1);

                                                if ($r->num_rows > 0) {
                                                    while ($row1 = mysqli_fetch_assoc($r)) {
                                                        $owner_id = $row1['owner_id'];
                                                        $sql3 = "SELECT * FROM owner WHERE owner_id = $owner_id";
                                                        $result3 = mysqli_query($link, $sql3);
                                                        $row3 = mysqli_fetch_assoc($result3);
                                                        ?>

                                                        <tr class="text-center">
                                                            <td>
                                                                <p class="fw-normal mb-1">
                                                                    <?php echo $row1['category_id']; ?>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="storage/category/<?php if ($row1["photo"] != "") {
                                                                        echo $row1["photo"];
                                                                    } else {
                                                                        echo 'default_image.png';
                                                                    } ?>" alt="" style="width: 45px; height: 45px"
                                                                        class="rounded-circle" />
                                                                    <div class="ms-3 text-left mx-2">
                                                                        <p class="fw-bold mb-1">
                                                                            <?php echo $row1['category_name']; ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <?php if ($row1['status'] == 0) {
                                                                    echo '<span class="badge badge-success rounded-pill d-inline px-3">Active</span>';
                                                                } elseif ($row1['status'] == 1) {
                                                                    echo '<span class="badge badge-danger rounded-pill d-inline px-3">Inactive</span>';
                                                                } ?>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="storage/profile/<?php if ($row3["photo"] != "") {
                                                                        echo $row3["photo"];
                                                                    } else {
                                                                        echo 'default_image.png';
                                                                    } ?>" alt="" style="width: 45px; height: 45px"
                                                                        class="rounded-circle" />
                                                                    <div class="ms-3 text-left mx-2">
                                                                        <p class="fw-bold mb-1">
                                                                            <?php echo $row3['lastname']; ?>,
                                                                            <?php echo $row3['firstname']; ?>
                                                                        </p>
                                                                        <p class="text-muted mb-0"><?php echo $row3['email']; ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <?php $formattedDate = date("l, F j Y - h:i A", strtotime($row1["last_updated"]));
                                                                echo $formattedDate; ?>
                                                            </td>
                                                            <td>
                                                                <div class="d-inline">
                                                                    <a class="ml-1 action-icon" href="#" data-toggle="modal"
                                                                        type="button"
                                                                        data-target="#view-category-<?php echo $row1['category_id'] ?>">
                                                                        <i class="fe fe-eye fe-16"></i>
                                                                    </a>
                                                                    <a class="ml-1 action-icon" href="#" data-toggle="modal"
                                                                        type="button"
                                                                        data-target="#edit-category-<?php echo $row1['category_id'] ?>">
                                                                        <i class="fe fe-edit fe-16"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <?php

                                                        include 'view-category.php';
                                                        include 'edit-category.php';

                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include 'partials/owner-modals.php'; ?>

        </main>
    </div>
    <?php include 'partials/jscripts.php'; ?>
    <script src='js/jquery.dataTables.min.js'></script>
    <script src='js/dataTables.bootstrap4.min.js'></script>
    <script>
        $('#dataTable-1').DataTable(
            {
                autoWidth: true,
                "lengthMenu": [
                    [16, 32, 64, -1],
                    [16, 32, 64, "All"]
                ]
            });
    </script>
</body>

</html>