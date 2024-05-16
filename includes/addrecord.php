<?php
include ('../includes/header.php');
// Checking current user
checkRole($userRole, ['admin', 'healthstaff']);


// Checking for record insertion
addRecord();

// Add Medication
if (isset($_GET['med'])) {
    pageHeader("Add Medication", [['href' => ROOT . "/includes/patients", 'title' => 'Patients'], ['title' => 'Add Medication']]);

    $user = selectUser($_GET['med']);
    if (empty($user)) {
        header("location:" . dashboardIndex($userRole));
        die();
    }
    ?>

    <div class="container">
        <div class="page-box form">
            <div>
                <div class="page-box-body">
                    <p class="page-box-msg">Add medication</p>
                    <?php
                    // Displaying messages
                    message(true);
                    ?>
                    <form action="" method="post">
                        <label>Medication Name</label>
                        <div class="mb-4">
                            <input type="text" placeholder="Enter name" name="medName" required>
                        </div>
                        <label>Prescription Date</label>
                        <div class="input-group date mb-4">
                            <input type="date" required name="prescDate">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="bx bxs-calendar"></span>
                                </div>
                            </div>
                        </div>
                        <label>Quantity</label>
                        <div class="mb-4">
                            <input type="number" placeholder="Enter quantity" required name="medQty" min="1">
                        </div>
                        <label>Details</label>
                        <textarea name="details" cols="30" rows="6" placeholder="Enter details"></textarea>
                        <button type="submit" class="btn btn-primary" name="medSubmit">Add Record</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php }
// Add Lab Test
else if (isset($_GET['lab'])) {
    pageHeader("Add Lab Result", [['href' => ROOT . "/includes/patients", 'title' => 'Patients'], ['title' => 'Add Lab Result']]);
    $user = selectUser($_GET['lab']);
    if (empty($user)) {
        header("location:" . dashboardIndex($userRole));
        die();
    }
    $tests = getTests();

    ?>
        <div class="container">
            <div class="page-box form">
                <div>
                    <div class="page-box-body">
                        <p class="page-box-msg">Add lab result</p>
                        <?php
                        // Displaying messages
                        message(true);
                        ?>
                        <form action="" method="post">
                            <label>Test Name</label>
                            <div class="input-group mb-4">
                                <select name="testID">
                                <?php foreach ($tests as $test) { ?>
                                        <option value="<?php echo $test['testID']; ?>"><?php echo $test['testName']; ?></option>
                                <?php } ?>
                                </select>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="bx bxs-chevron-down"></span>
                                    </div>
                                </div>
                            </div>
                            <label>Test Date</label>
                            <div class="input-group date mb-4">
                                <input type="date" required name="testDate">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="bx bxs-calendar"></span>
                                    </div>
                                </div>
                            </div>
                            <label>Value</label>
                            <div class="mb-4">
                                <input type="number" placeholder="Enter Value" required name="testValue" min="1" step="0.01">
                            </div>
                            <button type="submit" class="btn btn-primary" name="testSubmit">Add Record</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php } else if (isset($_GET['vital'])) {
    pageHeader("Add Vital Sign", [['href' => ROOT . "/includes/patients", 'title' => 'Patients'], ['title' => 'Add Vital Sign']]);
    $user = selectUser($_GET['vital']);
    if (empty($user)) {
        header("location:" . dashboardIndex($userRole));
        die();
    }
    // Getting vitals
    $vitals = getVitals();
    ?>
            <div class="container">
                <div class="page-box form">
                    <div>
                        <div class="page-box-body">
                            <p class="page-box-msg">Add vital sign</p>
                        <?php
                        // Displaying messages
                        message(true);
                        ?>
                            <form action="" method="post">
                                <label>Vital Name</label>
                                <div class="input-group mb-4">
                                    <select name="vitalID">
                                <?php foreach ($vitals as $vital) { ?>
                                            <option value="<?php echo $vital['vitalID']; ?>">
                                        <?php echo $vital['vitalName'] . " (" . $vital['unit'] . ")"; ?>
                                            </option>
                                <?php } ?>
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="bx bxs-chevron-down"></span>
                                        </div>
                                    </div>
                                </div>
                                <label>Measure Date</label>
                                <div class="input-group date mb-4">
                                    <input type="date" required name="measureDate">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="bx bxs-calendar"></span>
                                        </div>
                                    </div>
                                </div>
                                <label>Value</label>
                                <div class="input-group full mb-4">
                                    <input type="number" placeholder="Enter Value" required name="vitalValue" min="1" step="0.01">
                                </div>
                                <button type="submit" class="btn btn-primary" name="vitalSubmit">Add Record</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

<?php } else {
    header("location:" . dashboardIndex($userRole));
    die();
} ?>

<?php include ("../includes/footer.php");