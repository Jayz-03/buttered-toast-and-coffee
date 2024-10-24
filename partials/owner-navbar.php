<?php 

require_once "config.php";

$sql = "SELECT * FROM owner WHERE owner_id = '".$_SESSION['id']."'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$owner_id = $row["owner_id"];

?>

<nav class="topnav navbar navbar-light">
    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link text-muted" href="./#">
                <span class="avatar avatar-sm">
                    <img src="storage/profile/<?php if ($row["photo"] != "" ) { echo $row["photo"]; } else { echo 'default_image.png'; } ?>" alt="..." class="avatar-img rounded-circle">
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-muted my-2" href="#" data-toggle="modal" data-target="#defaultModal">
                <i class="fe fe-arrow-right fe-16"></i>
            </a>
        </li>
    </ul>
</nav>

<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Confirm Sign Out</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">Are you sure you want to sign out?</div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                <a href="signout" class="btn mb-2 btn-primary">Yes</a>
            </div>
        </div>
    </div>
</div>

<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
                <div class="text-center mb-4">
                    <img src="assets/images/logo.png" alt="" width="150">
                </div>
            </a>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                const menuButton = document.querySelector('.navbar-toggler');
                const logo = document.querySelector('.navbar-brand img');

                menuButton.addEventListener('click', () => {
                    logo.classList.toggle('small-logo');
                });
            });
        </script>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100 <?php if ($active_page == "dashboard") { echo "active"; } ?>">
                <a class="nav-link" href="owner-dashboard">
                    <i class="fe fe-grid fe-16"></i>
                    <span class="ml-3 item-text">Dashboard</span>
                </a>
            </li>
        </ul>
        <p class="text-muted nav-heading mt-3 mb-1">
            <span>Management</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item <?php if ($active_page == "staff") { echo "active"; } ?> dropdown">
                <a href="#owner-staff" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-user fe-16"></i>
                    <span class="ml-3 item-text">Staff</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100 <?php if ($active_page == "staff") { echo "show"; } ?>" id="owner-staff">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="owner-staff-list">
                            <i class="fe fe-list fe-16"></i>
                            <span class="ml-2 item-text">Staff List</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="owner-create-staff">
                            <i class="fe fe-plus fe-16"></i><span class="ml-2 item-text">Create
                                Staff Account</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?php if ($active_page == "inventory") { echo "active"; } ?> dropdown">
                <a href="#owner-inventory" data-toggle="collapse" aria-expanded="false"
                    class="dropdown-toggle nav-link">
                    <i class="fe fe-inbox fe-16"></i>
                    <span class="ml-3 item-text">Inventory</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100 <?php if ($active_page == "inventory") { echo "show"; } ?>" id="owner-inventory">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="owner-inventory-list">
                            <i class="fe fe-list fe-16"></i><span class="ml-2 item-text">Inventory List</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="owner-create-inventory">
                            <i class="fe fe-plus fe-16"></i><span class="ml-2 item-text">Add
                                Inventory Item</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?php if ($active_page == "category") { echo "active"; } ?> dropdown">
                <a href="#owner-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-box fe-16"></i>
                    <span class="ml-3 item-text">Category</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100 <?php if ($active_page == "category") { echo "show"; } ?>" id="owner-category">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="owner-category-list">
                            <i class="fe fe-list fe-16"></i><span class="ml-2 item-text">Category List</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="owner-create-category">
                            <i class="fe fe-plus fe-16"></i><span class="ml-2 item-text">Add
                                Category</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?php if ($active_page == "product") { echo "active"; } ?> dropdown">
                <a href="#owner-product" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-layers fe-16"></i>
                    <span class="ml-3 item-text">Product</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100 <?php if ($active_page == "product") { echo "show"; } ?>" id="owner-product">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="owner-product-list">
                            <i class="fe fe-list fe-16"></i><span class="ml-2 item-text">Product
                                List</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="owner-create-product">
                            <i class="fe fe-plus fe-16"></i><span class="ml-2 item-text">Add
                                Product</span></a>
                    </li>
                </ul>
            </li>
        </ul>
        <p class="text-muted nav-heading mt-3 mb-1">
            <span>Analytics</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100 <?php if ($active_page == "sales") { echo "active"; } ?>">
                <a class="nav-link" href="owner-sales">
                    <i class="fe fe-trending-up fe-16"></i>
                    <span class="ml-3 item-text">Sales</span>
                </a>
            </li>
            <li class="nav-item w-100 <?php if ($active_page == "reports") { echo "active"; } ?>">
                <a class="nav-link" href="owner-reports">
                    <i class="fe fe-file-text fe-16"></i>
                    <span class="ml-3 item-text">Reports</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>