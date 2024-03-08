<?php
include('koneksi/koneksi.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data yang dikirim melalui form
    foreach ($_POST['hapus'] as $customerId) {
        $statusf = 20;

    
    $selectcustomer = "SELECT * FROM tb_outstanding WHERE id_customer = '$customerId'";
    $resultcustomer = mysqli_query($con, $selectcustomer);
     
    if(mysqli_num_rows($resultcustomer) > 0) {
        while ($row = mysqli_fetch_assoc($resultcustomer)) {
            // Insert data into tb_queue
            $insert = "INSERT INTO tb_delivery (id_customer, first_name, last_name, phone, country, timezone, addrest_list, state, city, zip,order_date, gender, email, age, height, Chronic_disease, married, children, id_status, id_statusb, id_statusc, id_statusd, id_statusf, id_agent, order_id, operator_comment, date_comment, promo, nama_product, description, package, shipment_type, amount, price, total, bank_payment)
             VALUES ('{$row['id_customer']}','{$row['first_name']}','{$row['last_name']}','{$row['phone']}','{$row['country']}','{$row['timezone']}','{$row['addrest_list']}','{$row['state']}','{$row['city']}','{$row['zip']}','{$row['order_date']}','{$row['gender']}','{$row['email']}','{$row['age']}','{$row['height']}','{$row['Chronic_disease']}','{$row['married']}','{$row['children']}','{$row['id_status']}','{$row['id_statusb']}','{$row['id_statusc']}','{$row['id_statusd']}','$statusf','{$row['id_agent']}','{$row['order_id']}','{$row['operator_comment']}','{$row['date_comment']}','{$row['promo']}','{$row['nama_product']}','{$row['description']}','{$row['package']}','{$row['shipment_type']}','{$row['amount']}','{$row['price']}','{$row['total']}','{$row['bank_payment']}')";                
            mysqli_query($con, $insert);
        }  
    // Delete data from tb_customer
    $delete = "DELETE FROM tb_outstanding WHERE id_customer = '$customerId'";
    if(mysqli_query($con, $delete)) {
        echo "<script>alert('Succes !'); window.location.href = 'outstanding.php'</script>";
    } else {
        echo "Error deleting data: " . mysqli_error($con);
    }
} else {
    echo "No data found ";
};            
    }
}
?>