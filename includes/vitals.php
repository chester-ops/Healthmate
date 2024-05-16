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
    pageHeader("Vital Signs", $userRole !== "patient" ? [['href' => ROOT . "/includes/patients", 'title' => 'Patients'], ['title' => 'Vital Signs']] : [['title' => 'Vital Signs']]);

    // Delete modal
    deleteModal("delete-record", "delete-record", "Delete Record", "Are you sure you want to delete this record ?", "Delete");

    $vitals = selectRecords("vitalchecks", $id, null, "measureDate")['result'];

    // Listening for delete request
    $updatedvitals = deleteRecord($vitals, "vitalchecks", "checkID");

    // Removing row after deletion
    if ($updatedvitals !== $vitals) {
        $vitals = $updatedvitals;
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
                        <h3 class="card-title">All Vital Signs</h3>
                        <?php if ($userRole === "admin" || $userRole === "healthstaff") { ?>
                            <a href="<?php echo ROOT . '/includes/addrecord.php?vital=' . $id; ?>"
                                class="btn btn-small btn-primary">Add</a>
                        <?php } ?>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <?php
                                if (sizeof($vitals) > 0) { ?>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Vital ID</th>
                                                <th scope="col">Vital Name</th>
                                                <th scope="col">Value</th>
                                                <th scope="col">Unit</th>
                                                <th scope="col">Measure Date</th>
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
                                            <?php foreach ($vitals as $vital) {
                                                // Fetching vital details
                                                $vitalInfo = selectQuery("SELECT * FROM `vitals` WHERE `vitalID` = ?", "i", [$vital['vitalID']])['result'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $vital['checkID']; ?></td>
                                                    <td><?php echo $vitalInfo['vitalName']; ?></td>
                                                    <td><?php echo $vital['value']; ?></td>
                                                    <td><?php echo $vitalInfo['unit']; ?></td>
                                                    <td><?php echo $vital['measureDate']; ?></td>
                                                    <td><a href="viewrecord?vital=<?php echo $vital['checkID']; ?>"
                                                            class="btn btn-tcell btn-view">View</a></td>
                                                    <?php if ($userRole === "admin" || $userRole === "healthstaff") { ?>
                                                        <td><a href="editrecord?vital=<?php echo $vital['checkID']; ?>"
                                                                class="btn btn-tcell btn-edit">Edit</a></td>
                                                    <?php } ?>
                                                    <?php if ($userRole === "admin") { ?>
                                                        <td>
                                                            <button class="delete-btn btn btn-danger btn-tcell"
                                                                modal-target="delete-record"
                                                                delete-id="<?php echo $vital['checkID']; ?>">Delete</button>
                                                        </td>
                                                    <?php } ?>
                                                </tr>

                                                <?php
                                            } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <div>There are no vitals available.</div>
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