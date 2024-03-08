<?php
include('koneksi/koneksi.php');
ini_set('display_errors','1');

$response = array();


$username = $_POST['username'];
$password = $_POST['password'];
$idleader = $_POST['idleader'];
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];

$hashpassword = (password_hash($password,PASSWORD_BCRYPT));

$queryupdates = "UPDATE tb_leader SET username = '$username', password = '$hashpassword', name = '$name', email = '$email', address = '$address'  WHERE id_leader = '$idleader'";
$results = mysqli_query($con,$queryupdates);


if ($results) {
    $response['success'] = true;
} else {
    $response['error'] = "Error deleting data: " . mysqli_error($con);
}

echo json_encode($response);
?>