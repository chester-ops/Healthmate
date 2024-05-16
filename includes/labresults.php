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
    pageHeader("Lab Results", $userRole !== "patient" ? [['href' => ROOT . "/includes/patients", 'title' => 'Patients'], ['title' => 'Lab Results']] : [['title' => 'Lab Results']]);

    // Delete modal
    deleteModal("delete-record", "delete-record", "Delete Record", "Are you sure you want to delete this record ?", "Delete");

    // Fetching lab results for specific patient
    $results = selectRecords("labresults", $id, null, "testDate")['result'];

    // Listening for delete request
    $updatedresults = deleteRecord($results, "labresults", "labID");

    // Removing row after deletion
    if ($updatedresults !== $results) {
        $results = $updatedresults;
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
                        <h3 class="card-title">All Lab Results</h3>
                        <?php if ($userRole === "admin" || $userRole === "healthstaff") { ?>
                            <a href="<?php echo ROOT . '/includes/addrecord.php?lab=' . $id; ?>"
                                class="btn btn-small btn-primary">Add</a>
                        <?php } ?>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <?php
                                if (sizeof($results) > 0) { ?>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Test ID</th>
                                                <th scope="col">Test Name</th>
                                                <th scope="col">Value</th>
                                                <th scope="col">RefMin</th>
                                                <th scope="col">RefMax</th>
                                                <th scope="col">Unit</th>
                                                <th scope="col">Test Date</th>
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
                                            <?php foreach ($results as $result) {
                                                // Fetching test details
                                                $test = selectQuery("SELECT * FROM `tests` WHERE `testID` = ?", "i", [$result['testID']])['result'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $result['labID']; ?></td>
                                                    <td><?php echo $test['testName']; ?></td>
                                                    <td><?php echo $result['value']; ?></td>
                                                    <td><?php echo $test['refMin']; ?></td>
                                                    <td><?php echo $test['refMax']; ?></td>
                                                    <td><?php echo $test['unit']; ?></td>
                                                    <td><?php echo $result['testDate']; ?></td>
                                                    <td><a href="viewrecord?lab=<?php echo $result['labID']; ?>"
                                                            class="btn btn-tcell btn-view">View</a></td>
                                                    <?php if ($userRole === "admin" || $userRole === "healthstaff") { ?>
                                                        <td><a href="editrecord?lab=<?php echo $result['labID']; ?>"
                                                                class="btn btn-tcell btn-edit">Edit</a></td>
                                                    <?php } ?>
                                                    <?php if ($userRole === "admin") { ?>
                                                        <td>
                                                            <button class="delete-btn btn btn-danger btn-tcell"
                                                                modal-target="delete-record"
                                                                delete-id="<?php echo $result['labID']; ?>">Delete</button>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                                <?php
                                            } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <div>There are no lab tests.</div>
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