<?php

include 'connect.php';

$username = $_REQUEST['username'] ?? '';
$password = $_REQUEST['password'] ?? '';
$first_name = $_REQUEST['first_name'] ?? '';
$last_name = $_REQUEST['last_name'] ?? '';
$sex = $_REQUEST['sex'] ?? '';
$address = $_REQUEST['address'] ?? '';
$email = $_REQUEST['email'] ?? '';
$contact_no = $_REQUEST['contact_no'] ?? '';

$query = $connect->prepare("SELECT 1 FROM admin WHERE username = ? OR email = ?");
$query->bind_param("ss", $username, $email);;
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    echo "Account already exists.";
    echo '<meta http-equiv="refresh" content="3; url=http://localhost/cpe425/barangay_Maganda_management_system/create_account_form.html">';
    exit();
}

$stat = $connect->prepare("INSERT INTO admin (username, password, first_name, last_name, sex, address, email, contact_no) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stat->bind_param("ssssssss", $username, $password, $first_name, $last_name, $sex, $address, $email, $contact_no);
$success = $stat->execute();

if ($success) {
    echo "Account created successfully";
    echo '<meta http-equiv="refresh" content="3; url=http://localhost/cpe425/barangay_Maganda_management_system/login_page.php">';
} else {
    echo "Failed to create account.";
    if (is_object($stat)) {
        echo "Error: " . $stat->error;
    }
}

?>

