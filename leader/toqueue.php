<?php
include('koneksi/koneksi.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $agentId = $_POST['agentid'];
    // Check if 'hapus' is empty
    if (!empty($_POST['hapus'])) {
        foreach ($_POST['hapus'] as $customerId) {
            $dateadded = date('Y-m-d H:i:s');

            $updatequery = "UPDATE tb_handling SET id_agent = $agentId WHERE id_customer = '$customerId'";
            mysqli_query($con, $updatequery);

            $selectcustomer = "SELECT * FROM tb_handling WHERE id_customer = '$customerId'";
            $resultcustomer = mysqli_query($con, $selectcustomer);

            while ($row = mysqli_fetch_assoc($resultcustomer)) {
                // Insert data into tb_queue
                $insert = "INSERT INTO tb_queue (id_customer, first_name, last_name, phone, country, timezone, addrest_list, state, city, zip, order_date, gender, email, age, height, Chronic_disease, married, children, id_status, id_statusb, id_statusc, id_statusd, id_statusf, id_agent, order_id, operator_comment, date_comment, promo, nama_product, description, package, shipment_type, amount, price, total, bank_payment)
                 VALUES ('{$row['id_customer']}','{$row['first_name']}','{$row['last_name']}','{$row['phone']}','{$row['country']}','{$row['timezone']}','{$row['addrest_list']}','{$row['state']}','{$row['city']}','{$row['zip']}','{$row['order_date']}','{$row['gender']}','{$row['email']}','{$row['age']}','{$row['height']}','{$row['Chronic_disease']}','{$row['married']}','{$row['children']}','{$row['id_status']}','{$row['id_statusb']}','{$row['id_statusc']}','{$row['id_statusd']}','{$row['id_statusf']}','{$row['id_agent']}','{$row['order_id']}','{$row['operator_comment']}','{$row['date_comment']}','{$row['promo']}','{$row['nama_product']}','{$row['description']}','{$row['package']}','{$row['shipment_type']}','{$row['amount']}','{$row['price']}','{$row['total']}','{$row['bank_payment']}')";                
                mysqli_query($con, $insert);

                // Delete data from tb_customer
                $delete = "DELETE FROM tb_handling WHERE id_customer = '$customerId'";
                if(mysqli_query($con, $delete)) {
                    echo "<script>alert('Success!'); window.location.href = 'handling.php';</script>";
                } else {
                    echo "Error deleting data: " . mysqli_error($con);
                }
            }
        }
    } else {
        echo "<script>alert('Choose Customer First!'); window.location.href = 'handling.php';</script>";
    }
} else {
    echo "<script>alert('Invalid Request!'); window.location.href = 'handling.php';</script>";
}
?>