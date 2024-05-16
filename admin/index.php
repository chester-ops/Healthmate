<?php
include ('../includes/header.php');
// Checking if current user is admin
checkRole($userRole, ['admin']);
// Page header
pageHeader("Dashboard", [['title' => 'Dashboard']]);

$medications = mysqli_query($conn, "SELECT * FROM `medications` ORDER BY `prescDate` LIMIT 4");
$vitals = mysqli_query($conn, "SELECT * FROM `vitalchecks` ORDER BY `measureDate` LIMIT 4");
$labresults = mysqli_query($conn, "SELECT * FROM `labresults` ORDER BY `testDate` LIMIT 4");

$medications = mysqli_fetch_all($medications, MYSQLI_ASSOC);
$vitals = mysqli_fetch_all($vitals, MYSQLI_ASSOC);
$labresults = mysqli_fetch_all($labresults, MYSQLI_ASSOC);
?>
<div class="container">
    <div class="row">
        <div class="col-md-4 d-flex align-items-center">
            <div class="card-record-title ">
                <div class="d-flex align-items-center justify-content-center">
                    <i class="bi bi-people-fill"></i>
                    <h3>Users</h3>
                </div>
            </div>
            <a href="<?php echo ROOT . "/admin/users"; ?>" class="view-button"><span>View</span>
            </a>
        </div>
        <div class="col-md-4 d-flex align-items-center">
            <div class="card-record-title ">
                <div class="d-flex align-items-center justify-content-center">
                    <i class="bi bi-bandaid-fill"></i>
                    <h3>Patients</h3>
                </div>
            </div>
            <a href="<?php echo ROOT . "/includes/patients"; ?>" class="view-button"><span>View</span>
            </a>
        </div>
        <div class="col-md-4 d-flex align-items-center">
            <div class="card-record-title ">
                <div class="d-flex align-items-center justify-content-center">
                    <i class="bi bi-person-fill-add"></i>
                    <h3>Add User</h3>
                </div>
            </div>
            <a href="<?php echo ROOT . "/admin/adduser" ?>" class="view-button"><span>Add</span>
            </a>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Medications</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Med Name</th>
                                        <th>Patient Name</th>
                                        <th>Quantity</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (sizeof($medications) > 0) {
                                        foreach ($medications as $med) {
                                            $user = selectUser($med['userID']);
                                            ?>
                                            <tr>
                                                <td><?php echo $med['medName']; ?></td>
                                                <td><?php echo $user['fullName']; ?></td>
                                                <td><?php echo $med['quantity']; ?></td>
                                                <td><a href="<?php echo ROOT . '/includes/viewrecord?med=' . $med['medID']; ?>"
                                                        class="btn btn-tcell btn-view">View</a></td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <div>No medications available.</div>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Vital Signs</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Vital Name</th>
                                        <th>Patient Name</th>
                                        <th>Vital Value</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (sizeof($vitals) > 0) {
                                        foreach ($vitals as $vital) {
                                            // Getting vital info
                                            $vitalInfo = selectRecord("vitals", 'vitalID', $vital['vitalID'])['result'];
                                            $user = selectUser($vital['userID']);
                                            ?>
                                            <tr>
                                                <td><?php echo $vitalInfo['vitalName']; ?></td>
                                                <td><?php echo $user['fullName']; ?></td>
                                                <td><?php echo $vital['value']; ?></td>
                                                <td><a href="<?php echo ROOT . '/includes/viewrecord?vital=' . $vital['checkID']; ?>"
                                                        class="btn btn-tcell btn-view">View</a></td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <div>No vitals available.</div>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Lab Results</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>TestName</th>
                                        <th>Patient Name</th>
                                        <th>Value</th>
                                        <th>RefMin</th>
                                        <th>RefMax</th>
                                        <th>Unit</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (sizeof($labresults) > 0) {
                                        foreach ($labresults as $labresult) {
                                            // Getting test
                                            $test = selectRecord("tests", "testID", $labresult['testID'])['result'];
                                            $user = selectUser($labresult['userID']);
                                            ?>
                                            <tr>
                                                <td><?php echo $test['testName']; ?></td>
                                                <td><?php echo $user['fullName']; ?></td>
                                                <td><?php echo $labresult['value']; ?></td>
                                                <td><?php echo $test['refMin']; ?></td>
                                                <td><?php echo $test['refMax']; ?></td>
                                                <td><?php echo $test['unit']; ?></td>
                                                <td><a href="<?php echo ROOT . '/includes/viewrecord?lab=' . $labresult['labID']; ?>"
                                                        class="btn btn-tcell btn-view">View</a></td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <div>No labresults available.</div>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include ("../includes/footer.php");





