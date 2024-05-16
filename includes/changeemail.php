<?php
include ('../includes/header.php');

// Checking for email update
updateEmail($userID);

// Page header
pageHeader("Change Email", [['href' => ROOT . '/includes/profile', 'title' => 'Profile'], ['title' => 'Change Email']]);
?>
<div class="container">
    <div class="page-box form">
        <div>
            <div class="page-box-body">
                <p class="page-box-msg">Update your email</p>
                <?php
                // Displaying messages
                message();
                ?>
                <form action="" method="post" class="mb-2">
                    <label>New Email</label>
                    <div class="input-group mb-4">
                        <input type="email" placeholder="Enter new email" required name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="bx bxs-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <label>Enter Password</label>
                    <div class="input-group mb-4">
                        <input type="password" placeholder="Enter password" required name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="bx bxs-lock-alt"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary" name="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include ("../includes/footer.php");