<?php
include 'koneksi/koneksi.php';

if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nama_product = $_POST['nama_product'];
    $description = $_POST['description'];
    $package = $_POST['package'];
    $shipment_type = $_POST['shipment_type'];
    $addres = $_POST ['addres'];
    $zip = $_POST ['zip'];
    $phone = $_POST ['phone'];
    $city = $_POST['myCountry'];
    $price = $_POST['price'];
    $total = $_POST['total'];
    $phone = $_POST['phone'];
    $amount = $_POST ['amount'];
    $bankpayment = isset($_POST['bank_payment']) ? $_POST['bank_payment'] : 'COD'; // Set to 0 if null

    // Query untuk memperbarui data
    $sql = "UPDATE tb_outstanding SET addrest_list ='$addres',phone = '$phone', city = '$city', zip = '$zip', bank_payment='$bankpayment', nama_product='$nama_product', description='$description', package='$package', shipment_type='$shipment_type', amount='$amount', price='$price', total='$total' WHERE id_customer='$id'";

    if(mysqli_query($con, $sql)) {
        echo "<script>alert('Succes !'); window.location.href = 'outstanding.php'</script>";
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}

mysqli_close($con);
?>