<?php $pg = basename($_SERVER['PHP_SELF']); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Main CSS -->
    <link rel="stylesheet" href="./dist/css/style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./dist/css/bootstrap-grid.css">
    <!-- Google Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="./dist/icons/bootstrap-icons/bootstrap-icons.css">
    <!-- Boxicons -->
    <link rel="stylesheet" href="./dist/icons/boxicons/css/boxicons.css">
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="logo me-auto">
                <h1><a href="./"><span class="text-primary">Health</span>Mate</a></h1>
            </div>
            <nav class="site-nav d-flex align-items-center justify-content-between">
                <ul class="nav-list ">
                    <li class="nav-list-item"><a href="./"
                            class="<?php echo $pg == 'index.php' ? 'active' : ''; ?>">Home</a>
                    </li>
                    <li class="nav-list-item"><a href="./signin"
                            class="<?php echo $pg == 'signin.php' ? 'active' : ''; ?>">Sign In</a></li>
                    <li class="nav-list-item"><a href="./register"
                            class="<?php echo $pg == 'register.php' ? 'active' : ''; ?>">Register</a></li>
                </ul>
                <button class="bi mobile-nav-toggle bi-list mobile-btn"></button>
            </nav>
        </div>
    </header>
    <!-- End Header -->