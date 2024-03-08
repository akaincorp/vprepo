<?php
ini_set('display_errors','1');
include('koneksi/koneksi.php');
$response = array();


if (isset($_POST['rebillsSelect']) && isset($_POST['hapus'])) {


    $status = $_POST['rebillsSelect'];

    if ($status === 'DELIVERY_OK') {
        $status = 24;
    } else if ($status === 'DELIVERY_NOT_OK') {
        $status = 23;
    } elseif ($status === 'CANCEL') {
        $status = 22;
    }
    
    foreach ($_POST['hapus'] as $customerId) {

        $updatequery = "UPDATE tb_delivery SET id_statusf = $status WHERE id_customer = '$customerId'";
        mysqli_query($con, $updatequery); 
       
        $updatehistory = "UPDATE history_agent SET id_statusf = $status WHERE id_statusf = '18' AND id_customer = '$customerId'";
        $resultupdate = mysqli_query($con, $updatehistory); 
        
        }
        
        if($resultupdate) {
            $response['success'] = true;
         } else {
            $response['error'] = "Error deleting data: " . mysqli_error($con);
         }

}  else {
    $response['error'] = "Incomplete data received";
}

echo json_encode($response);
?>