<?php
include ("./header.php");
// Checking current user
checkRole($userRole, ['admin', 'healthstaff']);
// Edit page content
pageHeader("Edit Record", [['href' => ROOT . '/includes/patients', 'title' => 'Patients'], ['title' => 'Edit Record']]);
if (isset($_GET['lab'])) {
    // Getting id
    $id = $_GET['lab'];

    // Selecting record
    $labresult = selectRecord("labresults", "labID", $id)['result'];
    if (empty($labresult)) {
        header("location:" . dashboardIndex($userRole));
        die();
    }

    $user = selectUser($labresult['userID']);

    // Checking for update request
    $updatedlabresult = updateRecord($labresult, $id);

    // Updating fields after update
    if ($updatedlabresult !== $labresult) {
        $labresult = $updatedlabresult;
    }
    // fetching test
    $test = selectRecord('tests', 'testID', $labresult['testID'])['result'];
    ?>
    <div class="container">
        <div class="page-box form">
            <div>
                <div class="page-box-body">
                    <p class="page-box-msg">Edit lab result</p>
                    <?php
                    // Displaying messages
                    message(true);
                    ?>
                    <form action="" method="post">
                        <label>Test Name</label>
                        <div class="mb-4">
                            <input type="text" disabled value="<?php echo $test['testName']; ?>">
                        </div>
                        <label>Test Value</label>
                        <div class="mb-4">
                            <input type="number" name="testValue" required value="<?php echo $labresult['value']; ?>"
                                min="1" step="0.01">
                        </div>
                        <button class="btn btn-primary" name="testUpdate">Update Record</button>
                    </form>
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

    $user = selectUser($med['userID']);

    // Checking for update request
    $updatedmed = updateRecord($med, $id);

    // Updating fields after update
    if ($updatedmed !== $med) {
        $med = $updatedmed;
    }
    ?>
        <div class="container">
            <div class="page-box form">
                <div>
                    <div class="page-box-body">
                        <p class="page-box-msg">Edit medication</p>
                        <?php
                        // Displaying messages
                        message(true);
                        ?>
                        <form action="" method="post">
                            <label>Medication Name</label>
                            <div class="mb-4">
                                <input type="text" name="medName" value="<?php echo $med['medName']; ?>" required>
                            </div>
                            <label>Quantity</label>
                            <div class="mb-4">
                                <input type="number" name="quantity" required value="<?php echo $med['quantity']; ?>" min="1">
                            </div>
                            <label>Details</label>
                            <div class="mb-4">
                                <textarea name="details" cols="30" rows="6"><?php echo $med['details']; ?></textarea>
                            </div>
                            <button class="btn btn-primary" name="medUpdate">Update Record</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


<?php } else if (isset($_GET['vital'])) {
    // Getting id
    $id = $_GET['vital'];

    // Selecting vital
    $vitalCheck = selectRecord("vitalchecks", "checkID", $id)['result'];

    // Selecting vital info
    $vitalInfo = selectRecord("vitals", 'vitalID', $vitalCheck['vitalID'])['result'];

    if (empty($vitalCheck)) {
        header("location:" . dashboardIndex($userRole));
    }

    $user = selectUser($vitalCheck['userID']);

    // Checking for update request
    $updatedvitalcheck = updateRecord($vitalCheck, $id);

    // Updating fields after update
    if ($updatedvitalcheck !== $vitalCheck) {
        $vitalCheck = $updatedvitalcheck;
    }

    ?>

            <div class="container">
                <div class="page-box form">
                    <div>
                        <div class="page-box-body">
                            <p class="page-box-msg">Edit vital Check</p>
                        <?php
                        // Displaying messages
                        message(true);
                        ?>
                            <form action="" method="post">
                                <label>Vital Name</label>
                                <div class="mb-4">
                                    <input type="text" value="<?php echo $vitalInfo['vitalName']; ?>" disabled>
                                </div>
                                <label>Vital Value</label>
                                <div class="mb-4">
                                    <input type="number" name="vitalValue" required value="<?php echo $vitalCheck['value']; ?>"
                                        min="1" step="0.01">
                                </div>
                                <button class="btn btn-primary" name="vitalUpdate">Update Record</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

<?php } else {
    header("location:" . dashboardIndex($userRole));
    die();
}

include ("./footer.php");