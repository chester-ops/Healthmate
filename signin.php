<?php
include ("includes/functions.php");
include ("header.php");
include ("connection.php");
session_start();

// Checking for login
userLogin();
?>
<!-- ======= Sign In ======= -->
<div class="breadcrumbs">
    <div class="container">
        <h2>Sign In</h2>
    </div>
</div>
<section id="signin">
    <div class="container">
        <div class="page-box form">
            <div>
                <div class="page-box-body">
                    <p class="page-box-msg">Sign in to start a new session</p>
                    <?php
                    message();
                    ?>
                    <form action="" method="post">
                        <div class="input-group mb-4">
                            <input type="email" placeholder="Email" name="email" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="bx bxs-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-4">
                            <input type="password" placeholder="Password" name="password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="bx bxs-lock-alt"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-primary" name="submit">Sign In</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</section>
<!-- End Sign In -->
<?php include ("footer.php"); ?>