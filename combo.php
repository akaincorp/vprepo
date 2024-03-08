<?php
include 'koneksi.php';

$errors = [];
$data = [];

    $id_customer = $_POST['id'];
    $id_agent = $_POST['id_agent'];
    $nama_product = $_POST['nama_product'];
    $description = $_POST['description'];
    $package = $_POST['package'];
    $shipment_type = $_POST['shipment_type'];
    $amount = $_POST['amount'];
    $price = $_POST['price'];
    $total = $_POST['total'];
    $bankpayment = isset($_POST['bank_payment']) ? $_POST['bank_payment'] : 'COD'; 

    $select = "SELECT * FROM tb_customer WHERE id_customer = '$id_customer'";
    $result = mysqli_query($con, $select);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $id_customerinsert = $id_customer . "$id_agent";
        $order_id = $row['order_id'] . "$id_agent";
    
        $checkcombo = "SELECT id_customer FROM tb_customer WHERE id_customer = '$id_customerinsert'";
        $resultcheck = mysqli_query($con,$checkcombo);

        if (mysqli_num_rows($resultcheck) === 0) {
            $insert = "INSERT INTO tb_customer (note, id_customer, first_name, last_name, phone, country, timezone, addrest_list, state, city, zip, shipper, order_date, gender, email, age, height, Chronic_disease, married, children, id_status, id_statusb, id_statusc, id_statusd, id_statusf, id_agent, order_id, operator_comment, date_comment, promo, nama_product, description, package, shipment_type, amount, price, total, bank_payment)
        VALUES ('{$row['note']}','$id_customerinsert','{$row['first_name']}','{$row['last_name']}','{$row['phone']}','{$row['country']}','{$row['timezone']}','{$row['addrest_list']}','{$row['state']}','{$row['city']}','{$row['zip']}','{$row['shipper']}','{$row['order_date']}','{$row['gender']}','{$row['email']}','{$row['age']}','{$row['height']}','{$row['Chronic_disease']}','{$row['married']}','{$row['children']}','','','','','','','$order_id','{$row['operator_comment']}','{$row['date_comment']}','{$row['promo']}','$nama_product','$description','$package','$shipment_type','$amount','$price','$total','$bankpayment')";
    
       
        if(mysqli_query($con, $insert)) {
            $data['success'] = true;
            $data['message'] = 'Success!';
        } else {
            $data['success'] = false;
            $data['errors'] = $errors;
        }
        } else {
            $update = "UPDATE tb_customer SET 
            nama_product = '$nama_product',
            description = '$description',
            package = '$package',
            shipment_type = '$shipment_type',
            amount = '$amount',
            price = '$price',
            total = '$total',
            bank_payment = '$bankpayment'
            WHERE id_customer = '$id_customerinsert'";
           
            if(mysqli_query($con, $update)) {
                $data['success'] = true;
                $data['message'] = 'Success!';
            } else {
                $data['success'] = false;
                $data['errors'] = $errors;
            }
        }      
    }
    
    echo json_encode($data);
    mysqli_close($con);
?>