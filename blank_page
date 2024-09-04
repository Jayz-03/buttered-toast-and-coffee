<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login");
    exit;
}

$active_page = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blank Page</title>
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
                <h2 class="page-title">Blank Page</h2>
                <div class="row justify-content-center">
                    <div class="col-12">
                    </div> <!-- .col-12 -->
                </div> <!-- .row -->
            </div> <!-- .container-fluid -->

            <?php include 'partials/owner-modals.php'; ?>

        </main> <!-- main -->
    </div> <!-- .wrapper -->
    <?php include 'partials/jscripts.php'; ?>
</body>

</html>