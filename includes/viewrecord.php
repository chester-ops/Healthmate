<?php
include ('./header.php');
// Page header
pageHeader("View Record", $userRole !== "patient" ? [['href' => ROOT . "/includes/patients", 'title' => 'Patients'], ['title' => 'View Record']] : [['title' => 'View Record']]);
if (isset($_GET['lab'])) {
    // Getting id
    $id = $_GET['lab'];

    // Selecting record
    $result = selectRecord("labresults", "labID", $id)['result'];

    // Selecting test

    $test = selectRecord("tests", "testID", $result['testID'])['result'];

    if (empty($result)) {
        header("location:" . dashboardIndex($userRole));
        die();
    }

    // Getting user
    $user = selectUser($result['userID']);
    ?>

    <div class="container">
        <div class="page-box">
            <div>
                <div class="page-box-body">
                    <p class="page-box-msg">Lab result</p>
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h3 class="card-title">Lab Result</h3>
                            <?php if ($userRole === "admin" || $userRole === "healthstaff") { ?>
                                <a href="<?php echo ROOT . '/includes/editrecord?lab=' . $id; ?>"
                                    class="btn btn-small btn-primary">Edit Record</a>
                            <?php } ?>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-alt mb-4">
                                        <tbody>
                                            <?php if ($userRole !== "patient") { ?>
                                                <tr>
                                                    <th>Patient Name </th>
                                                    <td><?php echo $user['fullName']; ?></td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <th>Test Name </th>
                                                <td><?php echo $test['testName']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Value</th>
                                                <td><?php echo $result['value']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Reference Min</th>
                                                <td><?php echo $test['refMin']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Reference Max</th>
                                                <td><?php echo $test['refMax']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Unit</th>
                                                <td><?php echo $test['unit']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Test Date</th>
                                                <td><?php echo $result['testDate']; ?></td>
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
<?php } else if (isset($_GET['med'])) {
    // Getting id
    $id = $_GET['med'];

    // Selecting record
    $med = selectRecord("medications", "medID", $id)['result'];

    if (empty($med)) {
        header("location:" . dashboardIndex($userRole));
        die();
    }

    // Getting user
    $user = selectUser($med['userID']);
    ?>
        <div class="container">
            <div class="page-box">
                <div>
                    <div class="page-box-body">
                        <p class="page-box-msg">Medication</p>
                        <div class="card">
                            <div class="card-header  justify-content-between">
                                <h3 class="card-title">Medication</h3>
                            <?php if ($userRole === "admin" || $userRole === "healthstaff") { ?>
                                    <a href="<?php echo ROOT . '/includes/editrecord?med=' . $id; ?>"
                                        class="btn btn-small btn-primary">Edit Record</a>
                            <?php } ?>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-alt mb-4">
                                            <tbody>
                                            <?php if ($userRole !== "patient") { ?>
                                                    <tr>
                                                        <th>Patient Name </th>
                                                        <td><?php echo $user['fullName']; ?></td>
                                                    </tr>
                                            <?php } ?>
                                                <tr>
                                                    <th>Medication Name </th>
                                                    <td><?php echo $med['medName']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Prescription Date</th>
                                                    <td><?php echo $med['prescDate']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Quantity</th>
                                                    <td><?php echo $med['quantity']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Details</th>
                                                    <td><?php echo $med['details']; ?></td>
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
<?php } else if (isset($_GET['vital'])) {
    // Getting id
    $id = $_GET['vital'];

    // Selecting record
    $vitalCheck = selectRecord("vitalchecks", "checkID", $id)['result'];

    if (empty($vitalCheck)) {
        header("location:" . dashboardIndex($userRole));
        die();
    }

    // Getting vital info
    $vitalInfo = selectRecord("vitals", "vitalID", $vitalCheck['vitalID'])['result'];

    // Getting user
    $user = selectUser($vitalCheck['userID']);
    ?>
            <div class="container">
                <div class="page-box">
                    <div>
                        <div class="page-box-body">
                            <p class="page-box-msg">Vital sign</p>
                            <div class="card">
                                <div class="card-header  justify-content-between">
                                    <h3 class="card-title">Vital Sign</h3>
                            <?php if ($userRole === "admin" || $userRole === "healthstaff") { ?>
                                        <a href="<?php echo ROOT . '/includes/editrecord?vital=' . $id; ?>"
                                            class="btn btn-small btn-primary">Edit Record</a>
                            <?php } ?>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                            <table class="table table-alt mb-4">
                                                <tbody>
                                            <?php if ($userRole !== "patient") { ?>
                                                        <tr>
                                                            <th>Patient Name </th>
                                                            <td><?php echo $user['fullName']; ?></td>
                                                        </tr>
                                            <?php } ?>
                                                    <tr>
                                                        <th>Vital Name </th>
                                                        <td><?php echo $vitalInfo['vitalName']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Value</th>
                                                        <td><?php echo $vitalCheck['value']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Unit</th>
                                                        <td><?php echo $vitalInfo['unit']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Measure Date</th>
                                                        <td><?php echo $vitalCheck['measureDate']; ?></td>
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

include ('./footer.php');