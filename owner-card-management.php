<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login");
    exit;
}

$active_page = "card";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Management</title>
    <?php include 'partials/header.php'; ?>
</head>

<style>
    .small-logo {
        width: 50px !important;
    }

    .page-title {
        color: #000000;
    }

    .navbar-light .navbar-nav .nav-link {
        color: #000000 !important;
    }
</style>

<body class="vertical  light">
    <div class="wrapper">
        <?php include 'partials/owner-navbar.php'; ?>

        <main role="main" class="main-content">
            <div class="container-fluid">
                <h2 class="page-title">Card Management</h2>
                <?php
                $balance = $limits = $status = "";
                $balance_err = $limits_err = $status_err = "";
                $status = 0;

                if (isset($_POST["update"])) {

                    if (empty(trim($_POST["balance"]))) {
                        $balance_err = "Please enter balance.";
                    } else {
                        $balance = mysqli_real_escape_string($link, $_POST["balance"]);
                    }

                    if (empty(trim($_POST["limits"]))) {
                        $limits_err = "Please enter limits.";
                    } else {
                        $limits = mysqli_real_escape_string($link, $_POST["limits"]);
                    }

                    if (!isset($_POST["status"])) {
                        $status_err = "Please select a status.";
                    } else {
                        $status = mysqli_real_escape_string($link, trim($_POST["status"]));
                    }

                    if (empty($balance_err) && empty($limits_err) && empty($status_err)) {

                        $sql = "UPDATE card SET balance = ?, limits = ?, status = ? WHERE owner_id = ?";

                        if ($stmt = mysqli_prepare($link, $sql)) {
                            mysqli_stmt_bind_param($stmt, "ddii", $param_balance, $param_limits, $param_status, $param_owner_id);

                            $param_balance = $balance;
                            $param_limits = $limits;
                            $param_status = $status;
                            $param_owner_id = $owner_id;

                            if (mysqli_stmt_execute($stmt)) {
                                echo "<script>swal({
                                    title: 'Success!',
                                    text: 'Card details updated successfully!',
                                    icon: 'success',
                                    closeOnClickOutside: false,
                                    button: false
                                });</script>";
                                ?>
                                <meta http-equiv="Refresh" content="3; url=owner-card-management">
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



                $sql5 = "SELECT * FROM card";
                $result5 = mysqli_query($link, $sql5);
                $row5 = mysqli_fetch_assoc($result5);
                $owner_id5 = $row["owner_id"];

                $sql6 = "SELECT * FROM owner WHERE owner_id = $owner_id5";
                $result6 = mysqli_query($link, $sql6);
                $row6 = mysqli_fetch_assoc($result6);

                ?>
                <form method="post" enctype="multipart/form-data">
                    <div class="row justify-content-center">
                        <div class="col-5">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <strong class="card-title">Card <span
                                            style="color: #6c757d;">(Gcash)</span></strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <div class="text-center">
                                                    <img src="assets/images/gcash.png" class="avatar img-thumbnail mb-2"
                                                        alt="avatar" height="250px" width="250px">
                                                </div>
                                                <div class="text-start">
                                                    <label class="mt-4">Last updated:</label>
                                                    <input type="text" class="form-control" value="<?php $formattedDate = date("l, F j Y - h:i A", strtotime($row5["last_updated"]));
                                                    echo $formattedDate; ?>" disabled>
                                                    <br>
                                                    <label>Managed by:</label>
                                                    <div class="d-flex align-items-center">
                                                        <img src="storage/profile/<?php if ($row6["photo"] != "") {
                                                            echo $row6["photo"];
                                                        } else {
                                                            echo 'default_image.png';
                                                        } ?>" alt="" style="width: 45px; height: 45px"
                                                            class="rounded-circle" />
                                                        <div class="ms-3 text-left mx-2">
                                                            <p class="fw-bold mb-1">
                                                                <?php echo $row6['firstname']; ?>
                                                                <?php echo $row6['lastname']; ?>
                                                            </p>
                                                            <p class="text-muted mb-0"><?php echo $row6['email']; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <strong class="card-title">Update Card Balance <span
                                            style="color: #6c757d;">(Gcash)</span>
                                    </strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="example-balance">Balance</label>
                                                <input type="number" id="example-balance" name="balance"
                                                    class="form-control <?php echo (!empty($balance_err)) ? 'is-invalid' : ''; ?>"
                                                    placeholder="Please enter balance."
                                                    value="<?php echo $row5['balance']; ?>">
                                                <span class="invalid-feedback"><?php echo $balance_err; ?></span>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="example-limits">Limits</label>
                                                <input type="number" id="example-limits" name="balance"
                                                    class="form-control <?php echo (!empty($limits_err)) ? 'is-invalid' : ''; ?>"
                                                    placeholder="Please enter limits."
                                                    value="<?php echo $row5['limits']; ?>">
                                                <span class="invalid-feedback"><?php echo $limits_err; ?></span>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="example-status">Status</label>
                                                <select name="status"
                                                    class="form-control select <?php echo (!empty($status_err)) ? 'is-invalid' : ''; ?>">
                                                    <option value="">Please select a status:</option>
                                                    <optgroup label="Status:">
                                                        <option value="0" <?php if ($row5['status'] == 0)
                                                            echo 'selected'; ?>>Available</option>
                                                        <option value="1" <?php if ($row5['status'] == 1)
                                                            echo 'selected'; ?>>Unavailable</option>
                                                    </optgroup>
                                                </select>

                                                <span class="invalid-feedback"><?php echo $status_err; ?></span>
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

            <?php include 'partials/owner-modals.php'; ?>

        </main>
    </div>
    <?php include 'partials/jscripts.php'; ?>
</body>

</html>