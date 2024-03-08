<?php
include('koneksi/koneksi.php');
ini_set('display_errors','1');

$response = array();


if (isset($_POST['level'])) {

$levels = $_POST['level'];
$id_agent = $_POST['idagentlevel'];

$queryupdates = "UPDATE tb_agent SET level = '$levels' WHERE id_agent = '$id_agent'";
$results = mysqli_query($con,$queryupdates);

$queryupdates2 = "UPDATE stat_agent SET level = '$levels' WHERE id_agent = '$id_agent'";
$results2 = mysqli_query($con,$queryupdates2);

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