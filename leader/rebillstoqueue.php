<?php
ini_set('display_errors','1');
include('koneksi/koneksi.php');

$response = array();


if (isset($_POST['agentid']) && isset($_POST['hapus'])) {
    
    $agentId = $_POST['agentid'];
    foreach ($_POST['hapus'] as $customerId) {

        $updatequery = "UPDATE tb_delivery SET id_agent = $agentId WHERE id_customer = '$customerId'";
        mysqli_query($con, $updatequery);    
    
    $selectcustomer = "SELECT * FROM tb_delivery WHERE id_customer = '$customerId'";
    $resultcustomer = mysqli_query($con, $selectcustomer);
     
    if ($resultcustomer) {
        $customerData = mysqli_fetch_assoc($resultcustomer);
        
        // Ambil data dari $customerData
        $orderdate = $customerData['order_date'];
        $orderid = $customerData['order_id'];
        $FirstName = $customerData['first_name'];
        $lastname =  $customerData['last_name'];
        $country =  $customerData['country'];
        $timezone =  $customerData['timezone'];
        $state =  $customerData['state'];
        $city =  $customerData['city'];
        $zip =  $customerData['zip'];
        $shipper =  $customerData['shipper'];
        $note =  $customerData['note'];
        $gender =  $customerData['gender'];
        $email =  $customerData['email'];
        $age =  $customerData['age'];
        $height =  $customerData['height'];
        $chronic =  $customerData['Chronic_disease'];
        $married =  $customerData['married'];
        $children =  $customerData['children'];
        $idstatus =  $customerData['id_status'];
        $idstatusb =  $customerData['id_statusb'];
        $idstatusc =  $customerData['id_statusc'];
        $idstatusd =  $customerData['id_statusd'];
        $idstatusf =  $customerData['id_statusf'];
        $delivery =  $customerData['delivery_comment'];
        $description =  $customerData['description'];
        $package =  $customerData['package'];
        $shipment =  $customerData['shipment_type'];
        $amount =  $customerData['amount'];
        $idagent =  $customerData['id_agent'];
        $price =  $customerData['price'];
        $total =  $customerData['total'];
        $operatorcom =  $customerData['operator_comment'];
        $operatorcom3 =  $customerData['operator_comment3'];
        $operatorcom4 =  $customerData['operator_comment4'];
        $datecom =  $customerData['date_comment'];
        $datecom2 =  $customerData['date_comment2'];
        $datecom3 =  $customerData['date_comment3'];
        $datecom4 = $customerData['date_comment4'];
        $bank = $customerData['bank_payment'];
        $addrest = $customerData['addrest_list'];
        $phone = $customerData['phone'];
        $idcustomer = $customerData['id_customer'];
        $promo = $customerData['promo'];
        $product = $customerData['nama_product'];

           
                $insert = "INSERT INTO tb_queue (id_agent, addrest_list,date_comment, date_comment2, date_comment3, date_comment4, bank_payment,delivery_comment,description,package,shipment_type,amount,price,total,operator_comment,operator_comment3,operator_comment4,children, id_status, id_statusb, id_statusc, id_statusd,id_statusf, note, gender, email, age, height, Chronic_disease, married, city,zip,shipper,state, timezone,country,nama_product,first_name,last_name, phone, id_customer, order_date, order_id, promo) 
                           VALUES ('$idagent','$addrest','$datecom','$datecom2','$datecom3','$datecom4','$bank','$delivery','$description','$package','$shipment','$amount','$price','$total','$operatorcom','$operatorcom3','$operatorcom4','$children','$idstatus','$idstatusb','$idstatusc','$idstatusd','$idstatusf','$note','$gender','$email','$age','$height','$chronic','$married','$city','$zip','$shipper','$state','$timezone','$country','$product', '$FirstName','$lastname', '$phone','$idcustomer','$orderdate','$orderid','$promo')";                
                mysqli_query($con, $insert);
   
     // Delete data from tb_customer
     $delete = "DELETE FROM tb_delivery WHERE id_customer = '$customerId'";
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