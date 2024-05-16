<?php
include ('../includes/header.php');
// Checking if current user is admin
checkRole($userRole, ['admin']);

if (isset($_GET['view'])) {
    // Getting id
    $view = $_GET['view'];

    // Selecting user
    $row = selectUser($view);

    if (empty($row)) {
        header("location:" . dashboardIndex($userRole));
        die();
    }

    // Page header
    pageHeader("View User", [['href' => ROOT . '/admin/users', 'title' => 'Users'], ['title' => 'View User']]); ?>

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
                        <div class="card-header justify-content-between">
                            <h3 class="card-title">User Details</h3>
                            <a href="<?php echo ROOT . '/admin/manage?edit=' . $view; ?>"
                                class="btn btn-small btn-primary">Edit User</a>
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
                                                <th>Role</th>
                                                <td><?php echo $row['userRole']; ?></td>
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


<?php } else if (isset($_GET['edit'])) {
    // Getting id
    $edit = $_GET['edit'];

    // Selecting user
    $row = selectUser($edit);

    if (empty($row)) {
        header("location:" . dashboardIndex($userRole));
        die();
    }

    // Checking for update request
    $updatedrow = updateUser($row, $edit, "user");

    // Updating fields after update
    if ($updatedrow !== $row) {
        $row = $updatedrow;
    }

    // Edit page content
    pageHeader("Edit User", [['href' => ROOT . '/admin/users', 'title' => 'Users'], ['title' => 'Edit User']]); ?>
        <div class="container">
            <div class="page-box form">
                <div>
                    <div class="page-box-body">
                        <p class="page-box-msg"><?php echo ucfirst($row['fullName']); ?></p>
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
                        <form action="" method="post" enctype="multipart/form-data">
                            <label>Email</label>
                            <div class="input-group mb-4">
                                <input type="email" placeholder="Enter email" name="email" required
                                    value="<?php echo $row['userEmail']; ?>">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="bx bxs-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <label>House Address</label>
                            <div class="input-group mb-4">
                                <input type="text" placeholder="Enter house address" name="address" required
                                    value="<?php echo $row['houseAddress']; ?>">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="bi bi-house-door-fill"></span>
                                    </div>
                                </div>
                            </div>
                            <label>Phone Number</label>
                            <div class="input-group mb-4">
                                <input type="text" placeholder="Enter phone number" name="phone" required
                                    value="<?php echo $row['phoneNumber']; ?>">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="bx bxs-phone"></span>
                                    </div>
                                </div>
                            </div>
                            <label>Profile Picture</label>
                            <div class="input-group mb-2">
                                <input type="file" name="userimage" accept="image/jpg, image/jpeg, image/png"
                                    class="profile-picture" id="userimage">
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Update</button>
                        </form>
                        <div>
                            <a href="<?php echo ROOT . '/includes/changepassword?id=' . $edit; ?> " class="link">Change
                                Password</a>
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