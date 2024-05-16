<?php
include ('../includes/header.php');

// Checking for password update
$isCurrentUser = !isset($_GET['id']);
updatePassword($isCurrentUser ? $userID : $_GET['id'], $isCurrentUser);

// Page header
pageHeader("Change Password", [$isCurrentUser ? ['href' => ROOT . '/includes/profile', 'title' => 'Profile'] : ["href" => ROOT . '/admin/users', "title" => "Users"], ['title' => 'Change Password']]);
?>
<div class="container">
    <div class="page-box form">
        <div>
            <div class="page-box-body">
                <p class="page-box-msg"><?php echo $isCurrentUser ? 'Update your password' : 'Update user password'; ?>
                </p>
                <?php
                // Displaying messages
                message();
                ?>
                <form action="" method="post" class="mb-2">
                    <?php
                    if ($isCurrentUser) { ?>
                        <label>Old Password</label>
                        <div class="input-group mb-4">
                            <input type="password" placeholder="Enter old password" required name="password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="bx bxs-lock-alt"></span>
                                </div>
                            </div>
                        </div>
                    <?php }
                    ?>
                    <label>New Password</label>
                    <div class="input-group mb-4">
                        <input type="password" placeholder="Enter new password" required name="newpassword">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="bx bxs-lock-alt"></span>
                            </div>
                        </div>
                    </div>
                    <label>Confirm New Password</label>
                    <div class="input-group mb-4">
                        <input type="password" placeholder="Confirm new password" required name="confirmnewpassword">
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