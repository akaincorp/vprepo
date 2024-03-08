<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'] . 1;
    $nama_product = $_POST['nama_product'];
    $description = $_POST['description'];
    $package = $_POST['package'];
    $shipment_type = $_POST['shipment_type'];
    $amount = $_POST['amount'];
    $price = $_POST['price'];
    $total = $_POST['total'];
    $bankpayment = isset($_POST['bank_payment']) ? $_POST['bank_payment'] : 'NO'; // Set to 0 if null
    $idagent = $_POST['idagent'];
    // Query untuk memasukkan data baru
    $sql = "INSERT INTO tb_customer (id_customer, nama_product, description, package, shipment_type, amount, price, total, bank_payment, id_agent) 
            VALUES ('$id', '$nama_product', '$description', '$package', '$shipment_type', '$amount', '$price', '$total', '$bankpayment', '$idagent')";

    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Data berhasil ditambahkan'); window.location.href = 'product.php';</script>";
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}

mysqli_close($con);
?>