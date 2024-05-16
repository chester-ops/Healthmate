<?php
include ('../includes/header.php');

// Getting user data
$row = selectUser($userID);

if (isset($_GET['edit']) && $_GET['edit'] === $userID) {

    // Page header
    pageHeader("Edit Profile", [['href' => ROOT . '/includes/profile', 'title' => 'Profile'], ['title' => 'Edit Profile']]);

    // Checking for update request
    $updatedrow = updateUser($row, $userID);

    // Updating fields after update
    if ($updatedrow !== $row) {
        $row = $updatedrow;
    }

    ?>
    <div class="container">
        <div class="page-box form">
            <div>
                <div class="page-box-body">
                    <p class="page-box-msg">Edit your profile</p>
                    <?php
                    // Displaying messages
                    message(true);
                    ?>
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="profile-img mb-4">
                            <img src="<?php echo '../uploads/' . $row['profilePicture'] . '?r=' . uniqid("i", true); ?>"
                                alt="user-image">
                        </div>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data" class="mb-2">
                        <label>Phone Number</label>
                        <div class="input-group mb-4">
                            <input type="text" name="phone" required value="<?php echo $row["phoneNumber"]; ?>">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="bx bxs-phone"></span>
                                </div>
                            </div>
                        </div>
                        <label>House Address</label>
                        <div class="input-group mb-4">
                            <input type="text" name="address" value="<?php echo $row["houseAddress"]; ?>" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="bi bi-house-door-fill"></span>
                                </div>
                            </div>
                        </div>
                        <label>Profile Picture</label>
                        <div class="input-group mb-2">
                            <input type="file" name="userimage" accept="image/jpg, image/jpeg, image/png"
                                class="profile-picture">
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary" name="submit">Update</button>
                            </div>
                        </div>
                    </form>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="<?php echo ROOT . '/includes/changepassword'; ?> " class="link">Change Password</a>
                        <a href="<?php echo ROOT . '/includes/changeemail'; ?>" class="link">Change Email</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php } else if (!isset($_GET['edit'])) {
    // Page header
    pageHeader("Profile", [['title' => 'Profile']]);
    ?>
        <div class="container">
            <div class="page-box">
                <div>
                    <div class="page-box-body">
                        <p class="page-box-msg"><?php echo ucfirst($row['fullName']); ?></p>
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="profile-img mb-4">
                                <img src="<?php echo '../uploads/' . $row['profilePicture'] . '?r=' . uniqid("i", true); ?>"
                                    alt="user-image">
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h3 class="card-title">Profile Details</h3>
                                <a href="<?php echo './profile?edit=' . $userID; ?>" class="btn btn-small btn-primary">Edit
                                    Profile</a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-alt mb-4">
                                            <tbody>
                                                <tr>
                                                    <th>Full Name</th>
                                                    <td><?php echo $row['fullName']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Email</th>
                                                    <td><?php echo $row['userEmail']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Gender</th>
                                                    <td><?php echo $row['gender']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Phone</th>
                                                    <td><?php echo $row['phoneNumber']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Date Of Birth</th>
                                                    <td><?php echo $row['dateOfBirth']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Address</th>
                                                    <td><?php echo $row['houseAddress']; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
<?php } else {
    header("location:" . dashboardIndex($userRole));
    die();
}

include ("../includes/footer.php");