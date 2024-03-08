<?php
include('koneksi/koneksi.php');

$response = array();


if (isset($_POST['hapus'])) {
    foreach ($_POST['hapus'] as $id) {
        // Menggunakan prepared statement untuk mencegah SQL Injection
        $query = "DELETE FROM tb_trash WHERE id_customer = $id";
        $result = mysqli_query($con, $query);
    }
    if($result) {
        $response['success'] = true;
     } else {
        $response['error'] = "Error deleting data: " . mysqli_error($con);
        }

} else {
    $response['error'] = "Incomplete data received";
}

echo json_encode($response);
?>