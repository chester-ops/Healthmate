<?php

/****** COMPONENTS ******/
// PageHeader component
function pageHeader($pageTitle, $links)
{ ?>
    <div class="content-header d-flex align-items-center justify-content-between">
        <h1 class="page-title"><?php echo $pageTitle; ?></h1>
        <ul class="page-breadcrumb d-flex align-items-center justify-content-between">
            <?php
            $links = array_merge([['href' => dashboardIndex($_SESSION['userRole']), 'title' => 'Home']], $links);
            foreach ($links as $key => $link) {
                if ($key + 1 != sizeof($links)) { ?>
                    <li class="breadcrumb-item">
                        <a href=<?php echo $link['href'] ?>><?php echo $link['title']; ?></a>
                    </li>
                    <li class="breadcrumb-separator">/</li>
                <?php } else { ?>
                    <li class="breadcrumb-item active"><?php echo $link['title']; ?></li>
                <?php }
            } ?>
        </ul>
    </div>
<?php }

// Delete modal component
function deleteModal($class, $id, $title, $content, $btnText)
{ ?>
    <div class="<?php echo $class; ?> delete-modal" id="<?php echo $id; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between">
                    <h5 class="modal-title"><?php echo $title; ?></h5>
                    <button class="bi-x modal-close" id="<?php echo $id; ?>-close"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="delete" id="<?php echo $id; ?>-input" value="">
                        <?php echo $content; ?>
                    </div>
                    <div class="modal-footer d-flex align-items-center justify-content-end">
                        <button type="button" class="btn btn-grey btn-small btn-cancel">Cancel</button>
                        <button type="submit" class="btn btn-danger btn-small"
                            name="submit"><?php echo $btnText; ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php }

// Message 
function message($open = false)
{
    if (isset($_SESSION['message']) && $_SESSION['message'] !== []) {
        $message = $_SESSION['message'];
        ?>
        <div class="d-flex align-items-center justify-content-center message-body">
            <div class="message d-flex align-items-center mb-4 <?php echo $message[1]; ?>">
                <span><?php echo $message[0]; ?></span> <button class="bi-x close-message"></button>
            </div>
        </div>
        <script type="text/javascript">
            /**
        *  Message close functionality
        * 
        */
            // Remember php is executing before javascript
            function closeMessage() {
                document.querySelector(".message-body").remove();
                <?php $_SESSION['message'] = []; ?>
            }

            <?php if ($open === false) { ?>
                const messageTimeout = setTimeout(closeMessage, 5000);
            <?php } ?>
            document.querySelector(".close-message").addEventListener("click", function () {
                <?php if ($open === false) { ?>
                    clearTimeout(messageTimeout);
                <?php } ?>
                closeMessage();
            });
        </script>
    <?php }
}

// // Result with pages
// function queryWithPages($perPage, $query, $params, $bind)
// {
//     $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
//     $startAt = $perPage * ($page - 1);
//     $query = $query . " LIMIT " . $startAt . "," . $perPage;
//     $rows = selectQuery($query, $params, $bind, "multiple");
//     $result = $rows['result'];
//     $resultCount = $rows['num_rows'];
//     $totalPages = ceil($resultCount / $perPage);

//     return ["result" => $result, "total" => $totalPages];
// }

// Pagination
function pagination($totalPages)
{
    if ($totalPages > 0) { ?>
        <a href="?page">Previous</a>
    <?php }
}

// Sidebar
function getSidebar($role, $currentPage)
{ ?>

    <aside class="dashboard-sidebar">
        <div class="dashboard-logo">
            <h1><a href="<?php echo dashboardIndex($role) ?>" class="d-flex align-items-center justify-content-center"><span
                        class="text-primary">Health</span>Mate</a></h1>
        </div>
        <div class="sidebar-inner">
            <div class="user-panel d-flex align-items-center justify-content-start mb-4 mt-4 pb-3">
                <div class="image-circle">
                    <img src="<?php echo '../uploads/' . $_SESSION['profilePicture'] . '?r=' . uniqid("i", true); ?>"
                        class="user-image " alt="user-image">
                </div>
                <div class="username">
                    <span>
                        <?php echo ucwords($_SESSION['fullName']); ?>
                    </span>
                </div>
            </div>
            <nav>
                <ul class="nav-menu">
                    <li>
                        <a href="<?php echo dashboardIndex($role) ?>"
                            class="<?php echo in_array($currentPage, ['index']) ? 'active' : ''; ?> d-flex align-items-center">
                            <p class="d-flex align-items-center">
                                <i class='bx bxs-palette'></i>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <?php
                    if ($role === 'admin') { ?>
                        <li class="<?php echo in_array($currentPage, ['users', 'adduser']) ? 'open' : ''; ?> dropdown-item">
                            <a
                                class="<?php echo in_array($currentPage, ['users', 'adduser', 'manage']) ? 'active' : ''; ?>  <?php echo $currentPage === 'changepassword' && isset($_GET['id']) ? 'active' : ''; ?> d-flex align-items-center justify-content-between dropdown-link">
                                <p class="d-flex align-items-center">
                                    <i class='bi bi-people-fill'></i>
                                    Users
                                </p>
                                <i class='bx bxs-chevron-left'></i>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="<?php echo ROOT . '/admin/users'; ?>"
                                        class="<?php echo in_array($currentPage, ['users']) ? 'active' : '' ?> d-flex align-items-center justify-content-between">
                                        <p class="d-flex align-items-center">
                                            <i class='bx bx-circle'></i>
                                            All Users
                                        </p>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo ROOT . '/admin/adduser'; ?>"
                                        class="<?php echo in_array($currentPage, ['adduser']) ? 'active' : '' ?> d-flex align-items-center justify-content-between">
                                        <p class=" d-flex align-items-center">
                                            <i class='bx bx-circle'></i>
                                            Add User
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php }
                    if ($role === "patient") { ?>
                        <li
                            class="<?php echo in_array($currentPage, ['labresults', 'medications', 'vitals']) ? 'open' : ''; ?> dropdown-item">
                            <a
                                class="<?php echo in_array($currentPage, ['labresults', 'medications', 'vitals', 'viewrecord']) ? 'active' : ''; ?>  d-flex align-items-center justify-content-between dropdown-link">
                                <p class="d-flex align-items-center">
                                    <i class="bi bi-alarm-fill"></i>
                                    History
                                </p>
                                <i class='bx bxs-chevron-left'></i>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="<?php echo ROOT . '/includes/medications.php?id=' . $_SESSION['userID']; ?>"
                                        class="<?php echo in_array($currentPage, ['medications']) && isset($_GET['id']) ? 'active' : '' ?> d-flex align-items-center justify-content-between">
                                        <p class="d-flex align-items-center">
                                            <i class='bx bx-circle'></i>
                                            Medications
                                        </p>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo ROOT . '/includes/labresults.php?id=' . $_SESSION['userID']; ?>"
                                        class="<?php echo in_array($currentPage, ['labresults']) && isset($_GET['id']) ? 'active' : '' ?> d-flex align-items-center justify-content-between">
                                        <p class=" d-flex align-items-center">
                                            <i class='bx bx-circle'></i>
                                            Lab Results
                                        </p>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo ROOT . '/includes/vitals.php?id=' . $_SESSION['userID']; ?>"
                                        class="<?php echo in_array($currentPage, ['vitals']) && isset($_GET['id']) ? 'active' : '' ?> d-flex align-items-center justify-content-between">
                                        <p class=" d-flex align-items-center">
                                            <i class='bx bx-circle'></i>
                                            Vital Signs
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo ROOT . '/patient/recordshistory'; ?>"
                                class="<?php echo in_array($currentPage, ['recordshistory']) ? 'active' : ''; ?>  d-flex align-items-center justify-content-between">
                                <p class="d-flex align-items-center">
                                    <i class="bi bi-file-earmark-text-fill"></i>
                                    Print Records
                                </p>
                            </a>
                        </li>
                    <?php }
                    if ($role === "admin" || $role === 'healthstaff') { ?>
                        <li>
                            <a href="<?php echo ROOT . '/includes/patients'; ?>"
                                class="<?php echo in_array($currentPage, ['patients', 'addrecord', 'viewrecord', 'editrecord', 'records', 'labresults', 'medications', 'vitals']) ? 'active' : ''; ?> d-flex align-items-center justify-content-between">
                                <p class="d-flex align-items-center">
                                    <i class='bi bi-bandaid-fill'></i>
                                    Patients
                                </p>
                            </a>
                        </li>
                    <?php } ?>
                    <li>
                        <a href="<?php echo ROOT . '/includes/profile'; ?>"
                            class="<?php echo in_array($currentPage, ['profile', 'changeemail']) ? 'active' : ''; ?> <?php echo $currentPage === 'changepassword' && !isset($_GET['id']) ? 'active' : ''; ?> d-flex align-items-center justify-content-between">
                            <p class="d-flex align-items-center">
                                <i class='bi bi-person-circle'></i>
                                Profile
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <p class="d-flex align-items-center">

    <?php }

/****** END OF COMPONENTS ******/


/****** METHODS ******/
// Get current page
function getCurrentPage()
{
    $page = basename($_SERVER['PHP_SELF']);
    $page = str_replace(".php", "", $page);
    return $page;
}

// Get dashboard link based on role
function dashboardIndex($role)
{
    $link = ROOT;
    switch ($role) {
        case "admin":
            $link = $link . '/admin';
            break;
        case "healthstaff":
            $link = $link . '/healthstaff';
            break;
        case 'patient':
            $link = $link . '/patient';
            break;
        default:
    }
    return $link;
}

// Check if user is signed in
function isUserSignedIn()
{
    if (!isset($_SESSION['userID'])) {
        header("location:" . ROOT . "/signin");
        die();
    }
}

// Check user role
function checkRole($role, $requiredRole)
{
    if (!in_array($role, $requiredRole)) {
        header("location:" . dashboardIndex($role));
        die();
    }
}

// Set message
function setMessage($message)
{
    $_SESSION['message'] = $message;
}

// Image path
function imagePath($userimage, $id, $page = null)
{
    $image = $_FILES[$userimage]['name'];
    $image = $id . "." . pathinfo($image, PATHINFO_EXTENSION);
    $image_size = $_FILES[$userimage]['size'];
    $image_tmp_name = $_FILES[$userimage]['tmp_name'];
    $page === 'register' ? $image_folder = "./uploads/" . $image : $image_folder = "../uploads/" . $image;
    return [
        "image" => $image,
        "image_size" => $image_size,
        "image_tmp_name" => $image_tmp_name,
        "image_folder" => $image_folder,
    ];
}

// User login
function userLogin()
{
    global $conn;
    if (isset($_POST['submit'])) {
        // Getting values from form
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        // Checking if user exists and signing in
        $getuser = selectQuery("SELECT * FROM `users` WHERE userEmail = ? ", "s", [$email]);
        $row = $getuser['result'];
        $num_rows = $getuser['num_rows'];
        if ($num_rows === 1 && password_verify($password, $row['userPassword'])) {
            // Assigning session variables
            $_SESSION['userID'] = $row['userID'];
            $_SESSION['fullName'] = $row['fullName'];
            $_SESSION['userRole'] = $row['userRole'];
            $_SESSION['profilePicture'] = $row['profilePicture'];
            $_SESSION['message'] = [];
            // Redirecting user based on role
            if ($row['userRole'] === "admin") {
                header('location: ./admin');
            } else if ($row['userRole'] === "healthstaff") {
                header('location: ./healthstaff');
            } else {
                header('location: ./patient');
            }
        } else {
            $_SESSION['message'] = ['Email or password is incorrect', 'error'];
        }
    }
}

// Add user
function insertUser($isAdmin = false)
{
    global $conn;
    if (isset($_POST['submit'])) {
        // Getting values from form
        $id = uniqid("u", true);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirmpassword = mysqli_real_escape_string($conn, $_POST['confirmpassword']);
        $fullname = strtolower(mysqli_real_escape_string($conn, $_POST['fullname']));
        $isAdmin ? $role = mysqli_real_escape_string($conn, $_POST['role']) : $role = "patient";
        $dateofbirth = mysqli_real_escape_string($conn, $_POST['dateofbirth']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $image = imagePath('userimage', $id, $isAdmin ? '' : 'register');

        // Checking if user exists
        $num_rows = selectQuery("SELECT * FROM `users` WHERE userEmail = ? OR phoneNumber = ? OR fullName = ?", "sss", [$email, $phone, $fullname])['num_rows'];

        // Validating form values
        if ($num_rows > 0) {
            setMessage(['Account already exists', 'error']);
        } else if ($password !== $confirmpassword) {
            setMessage(['Passwords do not match', 'error']);
        } else if (strlen($phone) !== 11) {
            setMessage(['Phone number must be 11 digits', 'error']);
        } else if ($image['image_size'] > 2000000) {
            setMessage(['Image size is too large', 'error']);
        } else {

            // Inserting user into database if no error occurs
            $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 11]);
            $insertuser = query("INSERT INTO `users`(`userID`, `userPassword`, `userEmail`, `userRole`, `fullName`, `dateOfBirth`, `gender`, `houseAddress`, `phoneNumber`, `profilePicture`) VALUES (?,?,?,?,?,?,?,?,?,?)", "ssssssssss", [$id, $password, $email, $role, $fullname, $dateofbirth, $gender, $address, $phone, $image['image']])['result'];
            if ($insertuser) {
                move_uploaded_file($image['image_tmp_name'], $image['image_folder']);
                setMessage([$isAdmin ? 'User registration successful. <a href="./manage?view=' . $id . '" class="message-link">View User</a>' : 'User registration successful. <a href="./signin" class="message-link">Login</a>', 'success']);
            } else {
                setMessage(['Something went wrong. ' . mysqli_error($conn), 'error']);
            }
        }
    }
}

// Select users
function selectUsers($userRole)
{
    global $conn;
    $rows = selectQuery("SELECT `userID`, `userRole`, `fullName`, `gender`, `phoneNumber` FROM `users` WHERE userRole != ?", "s", [$userRole], 'multiple');
    return $rows;
}

// Select user
function selectUser($id)
{
    global $conn;
    $row = selectQuery("SELECT `userEmail` ,`gender`, `fullName`, `profilePicture`, `phoneNumber`, `houseAddress`,`dateOfBirth`, `userRole` FROM `users` WHERE `userID` = ?", 's', [$id])['result'];
    return $row;
}

// Delete user
function deleteUser($rows)
{
    global $conn;
    if (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        // Getting user image
        $user = selectQuery("SELECT `profilePicture` , `userRole` FROM `users` WHERE userID = ?", "s", [$id])['result'];
        $image = $user['profilePicture'];
        $role = $user['userRole'];

        // Deleting user
        $deleteuser = query("DELETE FROM `users` WHERE `userID` = ?", "s", [$id])['result'];
        if ($deleteuser) {
            // Checking if user is a patient and deleting records
            if ($role === "patient") {
                query("DELETE FROM `medications` WHERE `userID` = ?", "s", [$id]);
                query("DELETE FROM `vitalchecks` WHERE `userID` = ?", "s", [$id]);
                query("DELETE FROM `labresults` WHERE `userID` = ?", "s", [$id]);
            }
            // Refreshing user list
            foreach ($rows as $key => $row) {
                if ($row['userID'] === $id) {
                    array_splice($rows, $key, 1);
                }
            }
            // Delete user image
            $imageUrl = "../uploads/" . $image;
            if (file_exists($imageUrl)) {
                unlink($imageUrl);
            }
            setMessage(["User account deleted successfully", "success"]);

        } else {
            setMessage(["Something went wrong. " . mysqli_error($conn), "error"]);
        }
    }
    return $rows;
}

// Update user
function updateUser($row, $userID, $type = null)
{
    global $conn;
    if (isset($_POST['submit'])) {
        // Getting form values
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        if ($type === "user")
            $email = mysqli_real_escape_string($conn, $_POST['email']);
        if (empty($_FILES['userimage']['name'])) {
            $image = $row['profilePicture'];
        } else {
            $imagePath = imagePath('userimage', $userID);
            $image = $imagePath['image'];
        }
        // Checking if user exists
        $type === "user" ? $num_rows = selectQuery("SELECT * FROM `users` WHERE userID != ? AND userEmail = ?  OR phoneNumber = ? ", "sss", [$email, $phone, $userID])['num_rows'] : $num_rows = selectQuery("SELECT * FROM `users` WHERE  phoneNumber = ? AND `userID` != ? ", "ss", [$phone, $userID])['num_rows'];

        // Validating form values
        if ($num_rows > 0) {
            $type === "user" ? setMessage(['Email or phone number already exists', 'error']) : setMessage(['Phone number already exists']);
        } else if (strlen($phone) !== 11) {
            setMessage(['Phone number cannot be less than 11 digits', 'error']);
        } else if (!empty($_FILES['userimage']['name']) && $imagePath['image_size'] > 2000000) {
            setMessage(["Image size is too large", 'error']);
        } else if ($address !== $row['houseAddress'] || $phone !== $row['phoneNumber'] || !empty($_FILES['userimage']['name']) || $type === "user" && $email !== $row['userEmail']) {
            // Updating user
            $type === "user" ? $updateuser = query("UPDATE users SET `houseAddress`= ?, `userEmail`=?, `phoneNumber`= ?, `profilePicture`=? WHERE userID = ?", "sssss", [$address, $email, $phone, $image, $userID])['result'] : $updateuser = query("UPDATE users SET `houseAddress`= ?, `phoneNumber`= ?, `profilePicture`=? WHERE userID = ?", "ssss", [$address, $phone, $image, $userID])['result'];
            // Checking if update was successful
            if ($updateuser) {
                if (!empty($_FILES['userimage']['name'])) {
                    // Deleting old image
                    $imageUrl = "../uploads/" . $row['profilePicture'];
                    if (file_exists($imageUrl)) {
                        unlink($imageUrl);
                    }
                    // Moving new image to uploads folder
                    move_uploaded_file($imagePath['image_tmp_name'], $imagePath['image_folder']);
                }
                // Updating form fields and session
                $row['phoneNumber'] = $phone;
                $row['houseAddress'] = $address;
                if ($type === "user") {
                    $row['userEmail'] = $email;
                    $row['profilePicture'] = $image;
                } else {
                    $_SESSION['profilePicture'] = $row['profilePicture'] = $image;
                }
                $type === "user" ? setMessage(['User updated successfully. <a href="./manage?view=' . $userID . '" class="message-link">View User</a>', 'success']) : setMessage(['Profile updated successfully. <a href="./profile" class="message-link">View Profile</a>', 'success']);

            } else {
                setMessage(['Something went wrong. ' . mysqli_error($conn), 'error']);
            }
        }
    }
    return $row;
}

// Select patients
function selectPatients()
{
    global $conn;
    $rows = selectQuery("SELECT `userID`, `fullName`, `gender`,`dateOfBirth`, `phoneNumber`, `userEmail`, `houseAddress` FROM `users` WHERE userRole = ?", "s", ['patient'], 'multiple');
    return $rows;
}

// Select records
function selectRecords($records, $id, $limit = null, $order)
{
    global $conn;
    if ($limit !== null) {
        $rows = selectQuery("SELECT * FROM `$records` WHERE `userID` = ? ORDER BY $order DESC LIMIT $limit ", "s", [$id], 'multiple');
    } else {
        $rows = selectQuery("SELECT * FROM `$records` WHERE `userID` = ? ORDER BY $order DESC", "s", [$id], 'multiple');
    }
    return $rows;
}

// Select record
function selectRecord($records, $recordid, $id)
{
    global $conn;
    $row = selectQuery("SELECT * FROM `$records` WHERE `$recordid` = ?", "s", [$id]);
    return $row;
}


// Delete record
function deleteRecord($rows, $type, $typeid)
{
    global $conn;
    if (isset($_POST['delete'])) {
        $id = $_POST['delete'];

        // Deleting record
        $deleteuser = query("DELETE FROM `$type` WHERE `$typeid` = ?", "s", [$id])['result'];
        if ($deleteuser) {
            // Refreshing user list
            foreach ($rows as $key => $row) {
                if ($row[$typeid] === $id) {
                    array_splice($rows, $key, 1);
                }
            }
            setMessage(["Record deleted successfully", "success"]);

        } else {
            setMessage(["Something went wrong. " . mysqli_error($conn), "error"]);
        }
    }
    return $rows;
}

// Add record
function addRecord()
{
    global $conn;
    if (isset($_POST['medSubmit'])) {
        // Getting values
        $medname = mysqli_real_escape_string($conn, $_POST['medName']);
        $quantity = mysqli_real_escape_string($conn, $_POST['medQty']);
        $userid = $_GET['med'];
        $medid = uniqid("m", true);
        $prescdate = $_POST['prescDate'];
        $details = mysqli_real_escape_string($conn, $_POST['details']);
        // Executing query

        $insert = query("INSERT INTO `medications`(`medID`, `userID`, `medName`, `quantity`, `prescDate`, `details`) VALUES (?,?,?,?,?,?)", "sssiss", [$medid, $userid, $medname, $quantity, $prescdate, $details])['result'];
        if ($insert) {
            setMessage(['Medication added successfully', 'success']);
        } else {
            setMessage(["Something went wrong " . mysqli_error($conn), "error"]);
        }
    }

    if (isset($_POST['testSubmit'])) {
        // Getting values
        $testid = mysqli_real_escape_string($conn, $_POST['testID']);
        $testvalue = mysqli_real_escape_string($conn, $_POST['testValue']);
        $userid = $_GET['lab'];
        $labid = uniqid("t", true);
        $testdate = $_POST['testDate'];

        $insert = query("INSERT INTO `labresults`(`labID`, `userID`, `value` ,`testDate`, `testID`) VALUES (?,?,?,?,?)", "ssdsi", [$labid, $userid, $testvalue, $testdate, $testid])['result'];
        if ($insert) {
            setMessage(['Lab result added successfully', 'success']);
        } else {
            setMessage(["Something went wrong " . mysqli_error($conn), "error"]);
        }
    }

    if (isset($_POST['vitalSubmit'])) {
        // Getting values
        $vitalid = mysqli_real_escape_string($conn, $_POST['vitalID']);
        $vitalvalue = mysqli_real_escape_string($conn, $_POST['vitalValue']);
        $userid = $_GET['vital'];
        $checkid = uniqid("v", true);
        $measuredate = $_POST['measureDate'];


        $insert = query("INSERT INTO `vitalchecks`(`checkID`, `userID`, `value` ,`measureDate`, `vitalID`) VALUES (?,?,?,?,?)", "ssdsi", [$checkid, $userid, $vitalvalue, $measuredate, $vitalid])['result'];
        if ($insert) {
            setMessage(['Vital result added successfully', 'success']);
        } else {
            setMessage(["Something went wrong " . mysqli_error($conn), "error"]);
        }
    }
}

function getTests()
{
    global $conn;
    // Getting tests
    $query = mysqli_query($conn, "SELECT * FROM `tests`");
    $tests = mysqli_fetch_all($query, MYSQLI_ASSOC);
    return $tests;
}

function getVitals()
{
    global $conn;
    // Getting vitals
    $query = mysqli_query($conn, "SELECT * FROM `vitals`");
    $vitals = mysqli_fetch_all($query, MYSQLI_ASSOC);
    return $vitals;
}

// Update record
function updateRecord($row, $id)
{
    global $conn;
    if (isset($_POST['testUpdate'])) {
        $value = mysqli_real_escape_string($conn, $_POST['testValue']);
        $update = query("UPDATE `labresults` SET `value` = ? WHERE labID = ?", "ds", [$value, $id])['affected_rows'];
        if ($update === 1) {
            setMessage(['Lab test updated successfully', 'success']);
            $row['value'] = $value;
        } else {
            setMessage(["Something went wrong " . mysqli_error($conn), "error"]);
        }
    }

    if (isset($_POST['medUpdate'])) {

        $medName = mysqli_real_escape_string($conn, $_POST['medName']);
        $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
        $details = mysqli_real_escape_string($conn, $_POST['details']);
        $update = query("UPDATE `medications` SET `medName` = ?, `quantity` = ? , `details` = ? WHERE medID = ?", "siss", [$medName, $quantity, $details, $id])['affected_rows'];
        if ($update === 1) {
            setMessage(['Medication updated successfully', 'success']);
            $row['medName'] = $medName;
            $row['$quantity'] = $quantity;
            $row['details'] = $details;
        } else {
            setMessage(["Something went wrong " . mysqli_error($conn), "error"]);
        }
    }

    if (isset($_POST['vitalUpdate'])) {
        $value = mysqli_real_escape_string($conn, $_POST['vitalValue']);
        $update = query("UPDATE `vitalchecks` SET `value` = ? WHERE `checkID` = ?", "ds", [$value, $id])['affected_rows'];
        if ($update === 1) {
            setMessage(['Vital updated successfully', 'success']);
            $row['value'] = $value;
        } else {
            setMessage(["Something went wrong " . mysqli_error($conn), "error"]);
        }
    }
    return $row;
}

// Update password
function updatePassword($userID, $isCurrentUser)
{
    global $conn;
    if ($isCurrentUser) {
        $select = selectQuery("SELECT `userPassword` FROM `users` WHERE userID = ?", "s", [$userID])['result'];
        $oldpassword = $select['userPassword'];
    }
    if (isset($_POST['submit'])) {
        // Getting form values
        if ($isCurrentUser) {
            $password = mysqli_real_escape_string($conn, $_POST['password']);
        }
        $newpassword = mysqli_real_escape_string($conn, $_POST['newpassword']);
        $confirmnewpassword = mysqli_real_escape_string($conn, $_POST['confirmnewpassword']);
        // Validating form values
        if (!isset($_GET['id']) && !password_verify($password, $oldpassword)) {
            setMessage(['Old password is incorrect', 'error']);
        } else if ($newpassword !== $confirmnewpassword) {
            setMessage([$isCurrentUser ? 'New passwords do not match' : 'Passwords do not match', 'error']);
        } else if ($isCurrentUser && $password === $newpassword) {
            setMessage(['New password cannot be the same with old password', 'error']);
        } else {

            // Updating password
            $password = password_hash($newpassword, PASSWORD_BCRYPT, ['cost' => 11]);
            $updatepassword = query("UPDATE users SET `userPassword` = ? WHERE userID = ?", "ss", [$password, $userID]);
            // Checking if query was successful
            if ($updatepassword['result'] && $updatepassword['affected_rows'] === 1) {
                setMessage(['Password updated successfully', 'success']);
            } else {
                setMessage(["Something went wrong " . mysqli_error($conn), "error"]);
            }
        }
    }
}


// Update email
function updateEmail($userID)
{
    global $conn;
    if (isset($_POST['submit'])) {
        // Getting form values
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        // Getting user's hashed password and email
        $user = selectQuery("SELECT `userPassword`, `userEmail` FROM `users` WHERE userID = ?", "s", [$userID])['result'];
        $userpassword = $user['userPassword'];
        $oldemail = $user['userEmail'];
        // Checking if email exists
        $num_rows = selectQuery("SELECT * FROM `users` WHERE `userEmail` = ? AND userID !=  ?", "ss", [$email, $userID])['num_rows'];
        // Validating form values
        if ($num_rows > 0) {
            setMessage(['Email already exists', 'error']);
        } else if ($oldemail === $email) {
            setMessage(['New email is the same as old one', 'error']);
        } else if (!password_verify($password, $userpassword)) {
            setMessage(['Password is incorrect', 'error']);
        } else {
            // Updating email
            $updateemail = query("UPDATE `users` SET `userEmail` = ? WHERE userID = ?", 'ss', [$email, $userID])['result'];
            // Checking if query was successful
            if ($updateemail) {
                setMessage(['Email updated successfully', 'success']);
            } else {
                setMessage(["Something went wrong " . mysqli_error($conn), "error"]);
            }
        }
    }
}

// Select query
function selectQuery($query, $params, $bind, $type = null)
{
    global $conn;
    $select = $conn->prepare($query);
    $select->bind_param($params, ...$bind);
    $select->execute();
    $result = $select->get_result();
    $num_rows = $result->num_rows;
    if ($type === 'multiple') {
        $result = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $result = $result->fetch_assoc();
    }
    $select->close();
    return [
        "num_rows" => $num_rows,
        "result" => $result
    ];
}

// Query
function query($query, $params, $bind)
{
    global $conn;
    $query = $conn->prepare($query);
    $query->bind_param($params, ...$bind);
    $result = $query->execute();
    $affected_rows = $query->affected_rows;
    $query->close();
    return ['result' => $result, 'affected_rows' => $affected_rows];
}























/****** END OF METHODS ******/

