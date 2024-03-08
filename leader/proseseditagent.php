<?php
include('koneksi/koneksi.php');
ini_set('display_errors','1');

$response = array();


if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['idagent']) ) {

$username = $_POST['username'];
$password = $_POST['password'];
$id_agent = $_POST['idagent'];

$hashpassword = (password_hash($password,PASSWORD_BCRYPT));

$queryupdates = "UPDATE tb_agent SET username = '$username', password = '$hashpassword' WHERE id_agent = '$id_agent'";
$results = mysqli_query($con,$queryupdates);

$queryupdates2 = "UPDATE stat_agent SET username_agent = '$username' WHERE id_agent = '$id_agent'";
mysqli_query($con,$queryupdates2);

if ($results) {
    $response['success'] = true;
} else {
    $response['error'] = "Error deleting data: " . mysqli_error($con);
}

} else {
    $response['error'] = "Incomplete data received";
}

echo json_encode($response);
?>