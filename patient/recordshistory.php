<?php
include ("../connection.php");
include ("../includes/functions.php");
session_start();

// Getting session variables
$userID = $_SESSION['userID'];
$userRole = $_SESSION['userRole'];

// Checking if user is signed in
isUserSignedIn();

checkRole($userRole, ['patient']);

// Getting all user records
$medications = selectRecords("medications", $userID, null, "prescDate")['result'];
$labresults = selectRecords("labresults", $userID, null, "testDate")['result'];
$vitals = selectRecords("vitalChecks", $userID, null, "measureDate")['result'];
$user = selectUser($userID);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Main CSS -->
    <link rel="stylesheet" href="../dist/css/style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../dist/css/bootstrap-grid.css">
    <!-- Google Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
</head>

<body class="history">
    <div class="historyHeader d-flex align-items-center">
        <div class="print-container">
            <div class="credibility d-flex align-items-center justify-content-between">
                <h1><span class="text-primary">Health</span>Mate</h1>
                <div class="return-home">
                    <button id="printButton" class="btn btn-small btn-view">Print</button>
                    <a href="<?php echo dashboardIndex($userRole); ?>" class="btn btn-primary btn-small">Return to
                        Dashboard</a>
                </div>
            </div>
        </div>
    </div>
    <div class="historyContent">
        <div class="print-box">
            <div class="print-container">
                <div class="print-image">
                    <img src="<?php echo "../uploads/" . $user['profilePicture'] . '?r=' . uniqid("i", true); ?>"
                        alt="user-image">
                </div>
                <div class="print-info d-flex align-items-center">
                    <h1 class="card-title">
                        User Information
                    </h1>
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>
                                Name
                            </th>
                            <td>
                                <?php echo $user['fullName']; ?>
                            </td>
                            <th>Email</th>
                            <td><?php echo $user['userEmail']; ?></td>
                        </tr>
                        <tr>
                            <th>
                                Phone </th>
                            <td>
                                <?php echo $user['phoneNumber']; ?>
                            </td>
                            <th>Gender</th>
                            <td><?php echo $user['gender']; ?></td>
                        </tr>
                        <tr>
                            <th>
                                Address
                            </th>
                            <td>
                                <?php echo $user['houseAddress']; ?>
                            </td>
                            <th>dateOfBirth</th>
                            <td><?php echo $user['dateOfBirth']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="print-box">
            <div class="print-container">
                <div class="print-info d-flex align-items-center">
                    <h1 class="card-title">
                        Medications History
                    </h1>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Details</th>
                            <th>Presc Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($medications as $med) { ?>
                            <tr>
                                <td><?php echo $med['medName']; ?></td>
                                <td><?php echo $med['quantity']; ?></td>
                                <td><?php echo $med['details']; ?></td>
                                <td><?php echo $med['prescDate']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="print-box">
            <div class="print-container">
                <div class="print-info d-flex align-items-center">
                    <h1 class="card-title">
                        Vital Signs History
                    </h1>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Value</th>
                            <th>Unit</th>
                            <th>Measure Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($vitals as $vital) {
                            // Selecting Vital Info
                            $vitalInfo = selectRecord("vitals", "vitalID", $vital['vitalID'])['result'];
                            ?>
                            <tr>
                                <td><?php echo $vitalInfo['vitalName']; ?></td>
                                <td><?php echo $vital['value']; ?></td>
                                <td><?php echo $vitalInfo['unit']; ?></td>
                                <td><?php echo $vital['measureDate']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="print-box">
            <div class="print-container">
                <div class="print-info d-flex align-items-center">
                    <h1 class="card-title">
                        Lab Results History
                    </h1>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Value</th>
                            <th>RefMin</th>
                            <th>RefMax</th>
                            <th>Unit</th>
                            <th>Test Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($labresults as $labresult) {
                            // Selecting Vital Info
                            $test = selectRecord("tests", "testID", $labresult['testID'])['result'];
                            ?>
                            <tr>
                                <td><?php echo $test['testName']; ?></td>
                                <td><?php echo $labresult['value']; ?></td>
                                <td><?php echo $test['refMin']; ?></td>
                                <td><?php echo $test['refMax']; ?></td>
                                <td><?php echo $test['unit']; ?></td>
                                <td><?php echo $labresult['testDate']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Jquery File -->
    <script src="../dist/js/jquery.min.js"></script>
    <!-- Site JS File -->
    <script src="../dist/js/main.js"></script>
</body>

</html>