<?php
include ("includes/functions.php");
include ("header.php");
include ("connection.php");
// Checking for user account creation
insertUser();
?>
<!-- ======= Register ======= -->
<div class="breadcrumbs">
    <div class="container">
        <h2>Register</h2>
    </div>
</div>
<section>
    <div class="container">
        <div class="page-box form">
            <div>
                <div class="page-box-body">
                    <p class="page-box-msg">Register a new account</p>
                    <?php
                    // Displaying messages
                    message(true);
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <label>Email</label>
                        <div class="input-group mb-4">
                            <input type="email" placeholder="Enter email" name="email" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="bx bxs-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <label>Password</label>
                        <div class="input-group mb-4">
                            <input type="password" placeholder="Enter password" required name="password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="bx bxs-lock-alt"></span>
                                </div>
                            </div>
                        </div>
                        <label>Confirm Password</label>
                        <div class="input-group mb-4">
                            <input type="password" placeholder="Confirm password" required name="confirmpassword">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="bx bxs-lock-alt"></span>
                                </div>
                            </div>
                        </div>
                        <label>Full Name</label>
                        <div class="input-group mb-4">
                            <input type="text" placeholder="Enter full name" name="fullname" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="bx bxs-user"></span>
                                </div>
                            </div>
                        </div>
                        <label>Date Of Birth</label>
                        <div class="input-group date mb-4">
                            <input type="date" name="dateofbirth" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="bx bxs-calendar"></span>
                                </div>
                            </div>
                        </div>
                        <label>Gender</label>
                        <div class="input-group mb-4">
                            <select name="gender" required name="gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="bx bxs-chevron-down"></span>
                                </div>
                            </div>
                        </div>
                        <label>House Address</label>
                        <div class="input-group mb-4">
                            <input type="text" placeholder="Enter house address" name="address" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="bi bi-house-door-fill"></span>
                                </div>
                            </div>
                        </div>
                        <label>Phone Number</label>
                        <div class="input-group mb-4">
                            <input type="text" placeholder="Enter phone number" name="phone" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="bx bxs-phone"></span>
                                </div>
                            </div>
                        </div>
                        <label>Profile Picture</label>
                        <div class="input-group mb-2">
                            <input type="file" name="userimage" accept="image/jpg, image/jpeg, image/png" required
                                class="profile-picture" id="userimage">

                        </div>
                        <div class="row">
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary" name="submit">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include ("./footer.php");