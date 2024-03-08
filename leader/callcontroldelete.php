<?php
ini_set('display_errors','1');

$DATABASE_HOST = '202.159.60.201';
$DATABASE_USER = 'root';
$DATABASE_PASS = '!@#trada2012';
$DATABASE_NAME = 'db_ast';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

$response = array();


if (isset($_POST['hapus'])) {

        foreach ($_POST['uniqueid'] as $id) {
    

     $delete = "DELETE FROM cdr WHERE uniqueid = '$id'";
     if(mysqli_query($con, $delete)) {
        $response['success'] = true;
     } else {
        $response['error'] = "Error deleting data: " . mysqli_error($con);
        }
    }

} else {
    $response['error'] = "Incomplete data received";
}

echo json_encode($response);

?>