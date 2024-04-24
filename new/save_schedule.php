<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header('location:index.php');
}

require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "<script> alert('Error: No data to save.'); location.replace('./') </script>";
    $conn->close();
    exit;
}

extract($_POST);
$allday = isset($allday);

// Set default status
$status = 'pairing';
// Check if the selected service is "consultation"
if ($service_type == 'consultation') {
    $status = 'done';
}

// Check if the user already has data
$sql_check_user = "SELECT * FROM website_economics WHERE name = '{$_SESSION['user_name']}'";
$result_check_user = $conn->query($sql_check_user);
if ($result_check_user->num_rows > 0) {
    $sql = "INSERT INTO website_economics (name, email, password, user_type, title, description, start_datetime, end_datetime, service, status) VALUES ('{$_SESSION['user_name']}', '$email', '$password', '$user_type', '$title', '$description', '$start_datetime', '$end_datetime','$service_type', '$status')";
} else {
    $sql = "UPDATE website_economics SET title = '$title', description = '$description', start_datetime = '$start_datetime', end_datetime = '$end_datetime', service = '$service_type', status = '$status' where id = '{$id}'";
}

$save = $conn->query($sql);

if ($save) {
    echo "<script>location.replace('ticket.php') </script>";
} else {
    echo "<pre>";
    echo "An Error occurred.<br>";
    echo "Error: " . $conn->error . "<br>";
    echo "SQL: " . $sql . "<br>";
    echo "</pre>";
}

$conn->close();
?>