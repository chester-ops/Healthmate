<?php
include ('../includes/header.php');
// Checking if user's role is admin 
checkRole($userRole, ['admin']);

// Selecting all users except  admin
$rows = selectUsers($userRole)['result'];

// Listening for delete request
$updatedrows = deleteUser($rows);

// Page header
pageHeader("Users", [['title' => 'Users']]);

// Delete modal
deleteModal("delete-user", "delete-user", "Delete User", "Are you sure you want to delete this user ?", "Delete");

// Removing row after deletion
if ($updatedrows !== $rows) {
    $rows = $updatedrows;
}

?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <?php
            // Displaying messages
            message();
            ?>
            <div class="card">
                <div class="card-header justify-content-between">
                    <h3 class="card-title">All Users</h3>
                    <a href="<?php echo ROOT . '/admin/adduser'; ?>" class="btn btn-small btn-primary">Add User</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <?php
                            if (sizeof($rows) > 0) { ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">UserID</th>
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">View</th>
                                            <th scope="col">Edit</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rows as $row) { ?>
                                            <tr>
                                                <td><?php echo $row['userID']; ?></td>
                                                <td><?php echo $row['fullName']; ?></td>
                                                <td><?php echo $row['gender']; ?></td>
                                                <td><?php echo $row['userRole']; ?></td>
                                                <td><?php echo $row['phoneNumber']; ?></td>
                                                <td><a href="manage?view=<?php echo $row['userID']; ?>"
                                                        class="btn btn-tcell btn-view">View</a></td>
                                                <td><a href="manage?edit=<?php echo $row['userID']; ?>"
                                                        class="btn btn-tcell btn-edit">Edit</a></td>
                                                <td>
                                                    <button class="delete-btn btn btn-danger btn-tcell"
                                                        modal-target="delete-user"
                                                        delete-id="<?php echo $row['userID']; ?>">Delete</button>
                                                </td>
                                            </tr>

                                            <?php
                                        } ?>
                                    </tbody>
                                </table>
                            <?php } else { ?>
                                <div>There are no registered users.</div>
                            <?php }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include ("../includes/footer.php");