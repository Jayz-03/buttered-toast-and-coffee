<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login");
    exit;
}

$active_page = "staff";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff List</title>
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
                        <h2 class="page-title">Staff - Staff List</h2>

                        <?php
                        $firstname_err = $lastname_err = $email_err = $contact_number_err = $photo_err = $status_err = "";

                        if (isset($_POST["update"])) {
                            $staff_id = $_POST['staff_id'];

                            if (empty(trim($_POST["firstname"]))) {
                                $firstname_err = "Please enter firstname.";
                            } else {
                                $firstname = mysqli_real_escape_string($link, $_POST["firstname"]);
                            }

                            if (empty(trim($_POST["lastname"]))) {
                                $lastname_err = "Please enter lastname.";
                            } else {
                                $lastname = mysqli_real_escape_string($link, $_POST["lastname"]);
                            }

                            if (empty(trim($_POST["email"]))) {
                                $email_err = "Please enter email.";
                            } else {
                                $email = mysqli_real_escape_string($link, ($_POST["email"]));
                            }

                            if (empty(trim($_POST["contact_number"]))) {
                                $contact_number_err = "Please enter contact number.";
                            } else {
                                $contact_number = mysqli_real_escape_string($link, ($_POST["contact_number"]));
                            }

                            if (!isset($_POST["status"])) {
                                $status_err = "Please select a status.";
                            } else {
                                $status = mysqli_real_escape_string($link, trim($_POST["status"]));
                            }

                            if (empty($_FILES['photo']['name'])) {
                                $photo = $_POST['no_photo'];
                            } else {
                                $old_photo = "storage/profile/" . $_POST['no_photo'];

                                if (file_exists($old_photo)) {
                                    unlink($old_photo);
                                }
                                $photo = ($_FILES["photo"]["name"]);
                                $photo_tmp_name = $_FILES["photo"]["tmp_name"];
                                $photo_size = $_FILES["photo"]["size"];
                                $photo_new_name = rand() . $photo;
                                $photo = $photo_new_name;
                            }

                            if (empty($firstname_err) && empty($lastname_err) && empty($email_err) && empty($contact_number_err) && empty($photo_err) && empty($status_err)) {
                                $sql = "UPDATE staff SET status=?, email=?, firstname=?, lastname=?, contact_number=?, photo=? WHERE staff_id=?";
                                $stmt = mysqli_prepare($link, $sql);
                                // Bind the parameters
                                mysqli_stmt_bind_param($stmt, "isssssi", $status, $email, $firstname, $lastname, $contact_number, $photo, $staff_id);

                                // Execute the prepared statement
                                if (mysqli_stmt_execute($stmt)) {
                                    if (!empty($_FILES['photo']['name'])) {
                                        move_uploaded_file($photo_tmp_name, "storage/profile/" . $photo);
                                    }
                                    
                                    echo "<script>swal({
                                            title: 'Success!',
                                            text: 'Staff Account Updated Successfully!',
                                            icon: 'success',
                                            closeOnClickOutside: false,
                                            button: false
                                        });</script>";
                                    ?>
                                    <meta http-equiv="Refresh" content="3; url=owner-staff-list">
                                    <?php
                                } else {
                                    echo "<script>swal({
                                            title: 'Oops!',
                                            text: 'Something went wrong. Please try again later.',
                                            icon: 'warning',
                                            button: 'Done!',
                                        });</script>";
                                }

                                // Close the statement
                                mysqli_stmt_close($stmt);
                            }
                        }



                        ?>
                        <div class="row my-4">
                            <!-- Small table -->
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <!-- table -->
                                        <table class="table datatables" id="dataTable-1">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>ID</th>
                                                    <th>Profile</th>
                                                    <th>Branch</th>
                                                    <th>Phone</th>
                                                    <th>Status</th>
                                                    <th>Last Updated</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql1 = "SELECT * FROM staff";
                                                $r = mysqli_query($link, $sql1);

                                                if ($r->num_rows > 0) {
                                                    while ($row1 = mysqli_fetch_assoc($r)) {
                                                        $branch_id = $row1['branch_id'];
                                                        $sql3 = "SELECT * FROM branch WHERE branch_id = $branch_id";
                                                        $result3 = mysqli_query($link, $sql3);
                                                        $row3 = mysqli_fetch_assoc($result3);
                                                        ?>

                                                        <tr class="text-center">
                                                            <td>
                                                                <p class="fw-normal mb-1">
                                                                    <?php echo $row1['staff_id']; ?>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="storage/profile/<?php if ($row1["photo"] != "") {
                                                                        echo $row1["photo"];
                                                                    } else {
                                                                        echo 'default_image.png';
                                                                    } ?>" alt="" style="width: 45px; height: 45px"
                                                                        class="rounded-circle" />
                                                                    <div class="ms-3 text-left mx-2">
                                                                        <p class="fw-bold mb-1">
                                                                            <?php echo $row1['lastname']; ?>,
                                                                            <?php echo $row1['firstname']; ?>
                                                                        </p>
                                                                        <p class="text-muted mb-0"><?php echo $row1['email']; ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <p class="fw-normal mb-1">
                                                                    <?php echo $row3['branch_name']; ?>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p class="fw-normal mb-1">
                                                                    <?php echo $row1['contact_number']; ?>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <?php if ($row1['status'] == 0) {
                                                                    echo '<span class="badge badge-success rounded-pill d-inline px-3">Active</span>';
                                                                } elseif ($row1['status'] == 1) {
                                                                    echo '<span class="badge badge-danger rounded-pill d-inline px-3">Inactive</span>';
                                                                } ?>
                                                            </td>
                                                            <td>
                                                                <?php $formattedDate = date("l, F j Y - h:i A", strtotime($row1["last_updated"]));
                                                                echo $formattedDate; ?>
                                                            </td>
                                                            <td>
                                                                <div class="d-inline">
                                                                    <a class="ml-1 action-icon" href="#" data-toggle="modal"
                                                                        type="button"
                                                                        data-target="#view-staff-<?php echo $row1['staff_id'] ?>">
                                                                        <i class="fe fe-eye fe-16"></i>
                                                                    </a>
                                                                    <a class="ml-1 action-icon" href="#" data-toggle="modal"
                                                                        type="button"
                                                                        data-target="#edit-staff-<?php echo $row1['staff_id'] ?>">
                                                                        <i class="fe fe-edit fe-16"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>


                                                        <?php

                                                        include 'view-staff.php';
                                                        include 'edit-staff.php';

                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- simple table -->
                        </div> <!-- end section -->
                    </div> <!-- .col-12 -->
                </div> <!-- .row -->
            </div> <!-- .container-fluid -->

            <?php include 'partials/owner-modals.php'; ?>

        </main> <!-- main -->
    </div> <!-- .wrapper -->
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