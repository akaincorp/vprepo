<?php
include 'koneksi.php';

$errors = [];
$data = [];

    $id = $_POST['id'];
    $nama_product = $_POST['nama_product'];
    $description = $_POST['description'];
    $package = $_POST['package'];
    $shipment_type = $_POST['shipment_type'];
    $amount = $_POST['amount'];
    $price = $_POST['price'];
    $total = $_POST['total'];
    $bankpayment = isset($_POST['bank_payment']) ? $_POST['bank_payment'] : 'COD'; 

    // Query untuk memperbarui data
    $sql = "UPDATE tb_customer SET bank_payment='$bankpayment', nama_product='$nama_product', description='$description', package='$package', shipment_type='$shipment_type', amount='$amount', price='$price', total='$total' WHERE id_customer='$id'";

    if(mysqli_query($con, $sql)) {
        $data['success'] = true;
        $data['message'] = 'Success!';
    } else {
        $data['success'] = false;
        $data['errors'] = $errors;
    }

    echo json_encode($data);


mysqli_close($con)
?>