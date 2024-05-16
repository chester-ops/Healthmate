<?php
include ('../includes/header.php');
checkRole($userRole, ['patient']);

// Page header
pageHeader("Dashboard", [['title' => 'Dashboard']]);

// Getting Recent records
$medications = selectRecords('medications', $userID, 4, "prescDate");
$vitals = selectRecords('vitalchecks', $userID, 4, "measureDate");
$labresults = selectRecords('labresults', $userID, 4, "testDate");

?>
<div class="container">
    <div class="row">
        <div class="col-md-4 d-flex align-items-center">
            <div class="card-record-title ">
                <div class="d-flex align-items-center justify-content-center">
                    <i class="bi bi-capsule"></i>
                    <h3>Medications</h3>
                </div>
            </div>
            <a href="<?php echo ROOT . "/includes/medications.php?id=" . $_SESSION['userID']; ?>"
                class="view-button"><span>View</span>
            </a>
        </div>
        <div class="col-md-4 d-flex align-items-center">
            <div class="card-record-title ">
                <div class="d-flex align-items-center justify-content-center">
                    <i class="bi bi-file-earmark-medical-fill"></i>
                    <h3>Lab Results</h3>
                </div>
            </div>
            <a href="<?php echo ROOT . "/includes/labresults.php?id=" . $_SESSION['userID']; ?>"
                class="view-button"><span>View</span>
            </a>
        </div>
        <div class="col-md-4 d-flex align-items-center">
            <div class="card-record-title ">
                <div class="d-flex align-items-center justify-content-center">
                    <i class="bi bi-clipboard2-pulse-fill"></i>
                    <h3>Vital Signs</h3>
                </div>
            </div>
            <a href="<?php echo ROOT . "/includes/vitals.php?id=" . $_SESSION['userID']; ?>"
                class="view-button"><span>View</span>
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
                                        <th>Quantity</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($medications['num_rows'] > 0) {
                                        foreach ($medications['result'] as $med) { ?>
                                            <tr>
                                                <td><?php echo $med['medName']; ?></td>
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
                                        <th>Vital Value</th>
                                        <th>Unit</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($vitals['num_rows'] > 0) {
                                        foreach ($vitals['result'] as $vital) {
                                            // Getting vital info
                                            $vitalInfo = selectRecord("vitals", 'vitalID', $vital['vitalID'])['result'];
                                            ?>
                                            <tr>
                                                <td><?php echo $vitalInfo['vitalName']; ?></td>
                                                <td><?php echo $vital['value']; ?></td>
                                                <td><?php echo $vitalInfo['unit']; ?></td>
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
                                        <th>Value</th>
                                        <th>RefMin</th>
                                        <th>RefMax</th>
                                        <th>Unit</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($labresults['num_rows'] > 0) {
                                        foreach ($labresults['result'] as $labresult) {
                                            // Getting test
                                            $test = selectRecord("tests", "testID", $labresult['testID'])['result'];
                                            ?>
                                            <tr>
                                                <td><?php echo $test['testName']; ?></td>
                                                <td><?php echo $labresult['value']; ?></td>
                                                <td><?php echo $test['refMin']; ?></td>
                                                <td><?php echo $test['refMax']; ?></td>
                                                <td><?php echo $test['unit']; ?></td>
                                                <td><a href="<?php echo ROOT . '/includes/viewrecord?lab=' . $labresult['labID']; ?>"
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
    </div>
</div>

<?php include ("../includes/footer.php");