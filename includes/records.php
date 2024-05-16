<?php
include ('./header.php');
// Checking current user
checkRole($userRole, ['admin', 'healthstaff']);
// Page header
pageHeader("Records", [['href' => ROOT . "/includes/patients", 'title' => 'Patients'], ['title' => 'Records']]);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = selectUser($id);
    if (empty($user)) {
        header("location:" . dashboardIndex($userRole));
    }
    ?>

    <div class="container">
        <div class="page-box">
            <div>
                <div class="page-box-body">
                    <p class="page-box-msg">View records</p>
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h3 class="card-title">All Records</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-alt mb-4">
                                        <tbody>
                                            <tr>
                                                <th>
                                                    Patient Name
                                                </th>
                                                <td>
                                                    <?php echo $user['fullName']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Lab Results</th>
                                                <td><a href="labresults?id=<?php echo $id ?>"
                                                        class="btn btn-tcell btn-view">View</a></td>
                                            </tr>
                                            <tr>
                                                <th>Medications</th>
                                                <td><a href="medications?id=<?php echo $id; ?>"
                                                        class="btn btn-tcell btn-view">View</a></td>
                                            </tr>
                                            <tr>
                                                <th>Vital Signs</th>
                                                <td><a href="vitals?id=<?php echo $id; ?>"
                                                        class="btn btn-tcell btn-view">View</a></td>
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

} ?>

<?php include ("./footer.php");
