<?php
include('koneksi/koneksi.php');
ini_set('display_errors','1');
$response = array();


if (isset($_POST['hapus'])) {

        foreach ($_POST['hapus'] as $customerId) {
    
    $selectcustomer = "SELECT * FROM customerque WHERE id_customer = '$customerId'";
    $resultcustomer = mysqli_query($con, $selectcustomer);
     
    if ($resultcustomer) {
        $customerData = mysqli_fetch_assoc($resultcustomer);
        
       // Ambil data dari $customerData
       $orderdate = $customerData['order_date'];
       $orderid = $customerData['order_id'];
       $FirstName = $customerData['first_name'];
       $lastname = "";
       $country = '';
       $timezone = '';
       $addrest = '';
       $state = '';
       $city = '';
       $zip = 0;
       $shipper = '';
       $note = '';
       $gender = '';
       $email = '';
       $age = '';
       $height = '';
       $chronic = '';
       $married = '';
       $children = '';
       $idstatus = 0;
       $idstatusb = 0;
       $idstatusc = 0;
       $idstatusd = 0;
       $idstatusf = 0;
       $delivery = '';
       $description = '';
       $package = '';
       $shipment = '';
       $amount = '';
       $price = 0;
       $total = 0;
       $operatorcom = '';
       $operatorcom3 = '';
       $operatorcom4 = '';
       $datecom = '0000-00-00 00:00:00';
       $datecom2 = '0000-00-00 00:00:00';
       $datecom3 = '0000-00-00 00:00:00';
       $datecom4 = '0000-00-00 00:00:00';
       $bank = '';
       $agentId = 0;
       $phone = $customerData['phone'];
       $idcustomer = $customerData['id_customer'];
       $promo = $customerData['promo'];
       $product = $customerData['product_name'];

   
   // Insert data ke tabel 
   $insert = "INSERT INTO tb_trash (addrest_list, date_comment, date_comment2, date_comment3, date_comment4, bank_payment,delivery_comment,description,package,shipment_type,amount,price,total,operator_comment,operator_comment3,operator_comment4,children, id_status, id_statusb, id_statusc, id_statusd,id_statusf, note, gender, email, age, height, Chronic_disease, married, city,zip,shipper,state, timezone,country,nama_product, id_agent, first_name,last_name, phone, id_customer, order_date, order_id, promo) VALUES ('$addrest','$datecom','$datecom2','$datecom3','$datecom4','$bank','$delivery','$description','$package','$shipment','$amount','$price','$total','$operatorcom','$operatorcom3','$operatorcom4','$children','$idstatus','$idstatusb','$idstatusc','$idstatusd','$idstatusf','$note','$gender','$email','$age','$height','$chronic','$married','$city','$zip','$shipper','$state','$timezone','$country','$product','$agentId', '$FirstName','$lastname', '$phone','$idcustomer','$orderdate','$orderid','$promo')";                
   mysqli_query($con, $insert);
   
     // Delete data from tb_customer
     $delete = "DELETE FROM customerque WHERE id_customer = '$customerId'";
     if(mysqli_query($con, $delete)) {
        $response['success'] = true;
     } else {
        $response['error'] = "Error deleting data: " . mysqli_error($con);
     }
        } 
}

} else {
    $response['error'] = "Incomplete data received";
}

echo json_encode($response);
?>