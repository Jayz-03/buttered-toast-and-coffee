<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login");
    exit;
}

$active_page = "branch";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Branch</title>
    <?php include 'partials/header.php'; ?>
    <script src="js/jquery.slim.min.js"></script>
</head>

<body class="vertical  light">
    <div class="wrapper">
        <?php include 'partials/owner-navbar.php'; ?>
        <main role="main" class="main-content">
            <div class="container-fluid">
                <h2 class="page-title">Branch - Create Branch</h2>

                <?php
                $branch = $photo = "";
                $branch_err = $photo_err = "";
                $status = 0;

                if (isset($_POST["submit"])) {

                    if (empty(trim($_POST["branch_name"]))) {
                        $branch_err = "Please enter an branch name.";
                    } else {
                        $sql = "SELECT branch_id FROM branch WHERE branch_name = ?";

                        if ($stmt = mysqli_prepare($link, $sql)) {
                            mysqli_stmt_bind_param($stmt, "s", $param_branch_name);

                            $param_branch_name = trim($_POST["branch_name"]);

                            if (mysqli_stmt_execute($stmt)) {
                                mysqli_stmt_store_result($stmt);

                                if (mysqli_stmt_num_rows($stmt) == 1) {
                                    $branch_err = "This branch is already exist.";
                                } else {
                                    $branch = trim($_POST["branch_name"]);
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

                    if (empty($branch_err) && empty($photo_err)) {


                        $sql = "INSERT INTO branch (owner_id, branch_name) VALUES (?, ?)";

                        if ($stmt = mysqli_prepare($link, $sql)) {
                            mysqli_stmt_bind_param($stmt, "is", $param_owner_id, $param_branch_name);

                            $param_owner_id = $owner_id;
                            $param_branch_name = $branch;

                            if (mysqli_stmt_execute($stmt)) {
                                echo "<script>swal({
                                    title: 'Success!',
                                    text: 'Branch Added Successfully!',
                                    icon: 'success',
                                    closeOnClickOutside: false,
                                    button: false
                                });</script>";

                                ?>
                                <meta http-equiv="Refresh" content="3; url=owner-branch-list">
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
                        <div class="col">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <strong class="card-title">Branch Information</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="example-branch_name">Branch Name</label>
                                                <input type="text" id="example-branch_name" name="branch_name"
                                                    class="form-control <?php echo (!empty($branch_err)) ? 'is-invalid' : ''; ?>"
                                                    placeholder="Please enter branch name."
                                                    value="<?php echo $branch; ?>">
                                                <span class="invalid-feedback"><?php echo $branch_err; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Create</button>
                </form>
            </div>

            <?php include 'partials/owner-modals.php'; ?>

        </main>
    </div>
    <?php include 'partials/jscripts.php'; ?>
</body>

</html>