<?php
ini_set('display_errors','1');
include('koneksi/koneksi.php');
$response = array();


if (isset($_POST['hapus'])) {

    foreach ($_POST['hapus'] as $customerId) { 
    
    $selectcustomer = "SELECT * FROM tb_trash WHERE id_customer = '$customerId'";
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
        $description =  $customerData['description'];
        $package =  $customerData['package'];
        $shipment =  $customerData['shipment_type'];
        $amount =  $customerData['amount'];
        $idagent =  $customerData['id_agent'];
        $price =  $customerData['price'];
        $total =  $customerData['total'];
        $operatorcom =  $customerData['operator_comment'];
        $operatorcom2 = $customerData['operator_comment4'];
        $operatorcom3 =  $customerData['operator_comment3'];
        $operatorcom4 =  $customerData['operator_comment4'];
        $datecom =  $customerData['date_comment'];
        $datecom2 =  $customerData['date_comment'];
        $datecom3 =  $customerData['date_comment3'];
        $datecom4 = $customerData['date_comment4'];
        $bank = $customerData['bank_payment'];
        $addrest = $customerData['addrest_list'];
        $phone = $customerData['phone'];
        $idcustomer = $customerData['id_customer'];
        $promo = $customerData['promo'];
        $product = $customerData['nama_product'];
        $deliverycom = '';

           
                $insert = "INSERT INTO tb_handling (delivery_comment,id_agent, addrest_list,date_comment, date_comment2, date_comment3, date_comment4, bank_payment,description,package,shipment_type,amount,price,total,operator_comment,operator_comment3,operator_comment4,children, id_status, id_statusb, id_statusc, id_statusd,id_statusf, note, gender, email, age, height, Chronic_disease, married, city,zip,shipper,state, timezone,country,nama_product,first_name,last_name, phone, id_customer, order_date, order_id, promo) 
                           VALUES ('$deliverycom','$idagent','$addrest','$datecom','$datecom2','$datecom3','$datecom4','$bank','$description','$package','$shipment','$amount','$price','$total','$operatorcom','$operatorcom3','$operatorcom4','$children','$idstatus','$idstatusb','$idstatusc','$idstatusd','$idstatusf','$note','$gender','$email','$age','$height','$chronic','$married','$city','$zip','$shipper','$state','$timezone','$country','$product', '$FirstName','$lastname', '$phone','$idcustomer','$orderdate','$orderid','$promo')";                
   
                
     // Delete data from tb_customer
     $delete = "DELETE FROM tb_trash WHERE id_customer = '$customerId'";
      mysqli_query($con,$delete);

     if(mysqli_query($con, $insert)) {
        $response['success'] = true;
     } else {
        $response['error'] = "Error deleting data: " . mysqli_error($con);
        }
    }
}

}  else {
    $response['error'] = "Incomplete data received";
}

echo json_encode($response);
 
?>