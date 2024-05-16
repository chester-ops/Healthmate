<?php
include ("../connection.php");
include ("functions.php");
session_start();

// Getting session variables
$userID = $_SESSION['userID'];
$userRole = $_SESSION['userRole'];

// Checking if user is signed in
isUserSignedIn();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Main CSS -->
    <link rel="stylesheet" href="../dist/css/style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../dist/css/bootstrap-grid.css">
    <!-- Google Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="../dist/icons/bootstrap-icons/bootstrap-icons.css">
    <!-- Boxicons -->
    <link rel="stylesheet" href="../dist/icons/boxicons/css/boxicons.css">
</head>

<body>
    <div class="wrapper">
        <nav class="dashboard-header d-flex align-items-center justify-content-end">
            <ul class="navbar-right">
                <div class="dropdown">
                    <button class="dropdown-toggle">
                        <i class="bx bxs-user"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo ROOT . '/includes/profile'; ?>">
                                <i class="bi bi-person-circle"></i>
                                Profile</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="<?php echo ROOT . '/includes/logout'; ?>">
                                <i class="bi bi-box-arrow-right"></i>Sign
                                Out</a></li>
                    </ul>
                </div>
            </ul>
        </nav>
        <div class="content-wrapper">
            <?php
