<?php
include ('./header.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = selectUser($_GET['id']);
    if (($userRole === 'patient' && $_SESSION['userID'] !== $id) || empty($user)) {
        header("location:" . dashboardIndex($userRole));
        die();
    }

    // Page header
    pageHeader("Medications", $userRole !== "patient" ? [['href' => ROOT . "/includes/patients", 'title' => 'Patients'], ['title' => 'Medications']] : [['title' => 'Medications']]);

    // Delete modal
    deleteModal("delete-record", "delete-record", "Delete Record", "Are you sure you want to delete this record ?", "Delete");

    $rows = selectRecords("medications", $id, null, "prescDate")['result'];

    // Listening for delete request
    $updatedrows = deleteRecord($rows, "medications", "medID");

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
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h3 class="card-title">All Medications</h3>
                        <?php if ($userRole === "admin" || $userRole === "healthstaff") { ?>
                            <a href="<?php echo ROOT . '/includes/addrecord.php?med=' . $id; ?>"
                                class="btn btn-small btn-primary">Add</a>
                        <?php } ?>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <?php
                                if (sizeof($rows) > 0) { ?>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Medication ID</th>
                                                <th scope="col">Medication Name</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Prescription Date</th>
                                                <th scope="col">View</th>
                                                <?php if ($userRole === "admin" || $userRole === "healthstaff") { ?>
                                                    <th scope="col">Edit</th>
                                                <?php } ?>
                                                <?php if ($userRole === "admin") { ?>
                                                    <th scope="col">Delete</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($rows as $row) { ?>
                                                <tr>
                                                    <td><?php echo $row['medID']; ?></td>
                                                    <td><?php echo $row['medName']; ?></td>
                                                    <td><?php echo $row['quantity']; ?></td>
                                                    <td><?php echo $row['prescDate']; ?></td>
                                                    <td><a href="viewrecord?med=<?php echo $row['medID']; ?>"
                                                            class="btn btn-tcell btn-view">View</a></td>
                                                    <?php if ($userRole === "admin" || $userRole === "healthstaff") { ?>
                                                        <td><a href="editrecord?med=<?php echo $row['medID']; ?>"
                                                                class="btn btn-tcell btn-edit">Edit</a></td>
                                                    <?php } ?>
                                                    <?php if ($userRole === "admin") { ?>
                                                        <td>
                                                            <button class="delete-btn btn btn-danger btn-tcell"
                                                                modal-target="delete-record"
                                                                delete-id="<?php echo $row['medID']; ?>">Delete</button>
                                                        </td>
                                                    <?php } ?>
                                                </tr>

                                                <?php
                                            } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <div>There are no medications available.</div>
                                <?php }
                                ?>
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
include ("./footer.php");