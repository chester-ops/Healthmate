<?php
include ('../includes/header.php');
// Checking current user
checkRole($userRole, ['admin', 'healthstaff']);
// Page header
pageHeader("Patients", [['title' => 'Patients']]);
// Select patients
$rows = selectPatients();
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
                    <h3 class="card-title">All Patients</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <?php if ($rows['num_rows'] > 0) { ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Patient ID</th>
                                            <th scope="col">Patient Name</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Lab Result</th>
                                            <th scope="col">Vital Sign</th>
                                            <th scope="col">Medication</th>
                                            <th scope="col">Records</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rows['result'] as $row) { ?>
                                            <tr>
                                                <td><?php echo $row['userID']; ?></td>
                                                <td><?php echo $row['fullName']; ?></td>
                                                <td><?php echo $row['gender']; ?></td>
                                                <td><?php echo $row['phoneNumber']; ?></td>
                                                <td> <a href="addrecord.php?lab=<?php echo $row['userID']; ?>"
                                                        class="btn btn-tcell btn-primary">Add</a></td>
                                                <td> <a href="addrecord.php?vital=<?php echo $row['userID']; ?>"
                                                        class="btn btn-tcell btn-primary">Add</a></td>
                                                <td><a href="addrecord.php?med=<?php echo $row['userID']; ?>"
                                                        class="btn btn-tcell btn-primary">Add</a></td>
                                                <td><a href="records?id=<?php echo $row['userID']; ?>"
                                                        class="btn btn-tcell btn-view">View</a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            <?php } else { ?>
                                <div>There are no registered patients.</div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include ("../includes/footer.php");
