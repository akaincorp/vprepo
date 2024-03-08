<?php
include('koneksi.php');
ini_set('display_errors','1');

$errors = [];
$data = [];

session_start();
$id_agent = $_SESSION['id_agent'];

    $id_customer = $_POST['idcustomer'];
    $status = $_POST['setstatus2'];
    $statuscomment = $_POST['statuscomment'];
    $process = '20%';
    $datecom = $_POST['datecomment'];

if ($status === 'BAD_QUALITY') {
    $status = 1;
} else if ($status === 'CLIENT_BUSY') {
    $status = 2;
} else if ($status === 'CUT_THELINE') {
    $status = 3;
} else if ($status === 'RECONFIRM') {
    $status = 4;
}

    $statusprocces = 19;

    $updatestatus = "UPDATE tb_customer SET id_status = '$status',id_statusf = '$statusprocces', operator_comment = '$statuscomment', date_comment = '$datecom'  WHERE id_customer = '$id_customer'";
    mysqli_query($con, $updatestatus);

    $updateproces = "UPDATE customerque SET processing_operation = '$process' WHERE id_customer = '$id_customer'";
    mysqli_query($con, $updateproces);
    
    // Select data from tb_customer
    $select = "SELECT * FROM tb_customer WHERE id_customer = '$id_customer'";
    $result = mysqli_query($con, $select);

    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Insert data into tb_queue
            $insertOrUpdate = "INSERT INTO tb_handling (note, id_customer, first_name, last_name, phone, country, timezone, addrest_list, state, city, zip, shipper, order_date, gender, email, age, height, Chronic_disease, married, children, id_status, id_statusb, id_statusc, id_statusd, id_statusf, id_agent, order_id, operator_comment, date_comment, promo, nama_product, description, package, shipment_type, amount, price, total, bank_payment)
            VALUES ('{$row['note']}','{$row['id_customer']}','{$row['first_name']}','{$row['last_name']}','{$row['phone']}','{$row['country']}','{$row['timezone']}','{$row['addrest_list']}','{$row['state']}','{$row['city']}','{$row['zip']}','{$row['shipper']}','{$row['order_date']}','{$row['gender']}','{$row['email']}','{$row['age']}','{$row['height']}','{$row['Chronic_disease']}','{$row['married']}','{$row['children']}','{$row['id_status']}','','','','','{$row['id_agent']}','{$row['order_id']}','{$row['operator_comment']}','{$row['date_comment']}','{$row['promo']}','{$row['nama_product']}','{$row['description']}','{$row['package']}','{$row['shipment_type']}','{$row['amount']}','{$row['price']}','{$row['total']}','{$row['bank_payment']}')
            ON DUPLICATE KEY UPDATE
            first_name = VALUES(first_name),
            last_name = VALUES(last_name),
            phone = VALUES(phone),
            delivery_comment = VALUES(delivery_comment),
            country = VALUES(country),
            timezone = VALUES(timezone),
            addrest_list = VALUES(addrest_list),
            state = VALUES(state),
            city = VALUES(city),
            note = VALUES(note),
            zip = VALUES(zip),
            shipper = VALUES(shipper),
            order_date = VALUES(order_date),
            gender = VALUES(gender),
            email = VALUES(email),
            age = VALUES(age),
            height = VALUES(height),
            Chronic_disease = VALUES(Chronic_disease),
            married = VALUES(married),
            children = VALUES(children),
            id_status = VALUES(id_status),
            id_statusb = VALUES(id_statusb),
            id_statusc = VALUES(id_statusc),
            id_statusd = VALUES(id_statusd),
            id_statusf = VALUES(id_statusf),
            id_agent = VALUES(id_agent),
            order_id = VALUES(order_id),
            operator_comment = VALUES(operator_comment),
            operator_comment3 = VALUES(operator_comment3),
            operator_comment4 = VALUES(operator_comment4),
            date_comment = VALUES(date_comment),
            date_comment2 = VALUES(date_comment2),
            date_comment3 = VALUES(date_comment3),
            date_comment4 = VALUES(date_comment4),
            promo = VALUES(promo),
            nama_product = VALUES(nama_product),
            description = VALUES(description),
            package = VALUES(package),
            shipment_type = VALUES(shipment_type),
            amount = VALUES(amount),
            price = VALUES(price),
            total = VALUES(total),
            bank_payment = VALUES(bank_payment)";
            mysqli_query($con, $insertOrUpdate);
        

            $inserthistori = "INSERT INTO history_agent (note, id_customer, first_name, last_name, phone, country, timezone, addrest_list, state, city, zip, shipper, order_date, gender, email, age, height, Chronic_disease, married, children, id_status, id_statusb, id_statusc, id_statusd, id_statusf, id_agent, order_id, operator_comment, operator_comment2, operator_comment3,operator_comment4, date_comment, date_comment2, date_comment3, date_comment4, promo, nama_product, description, package, shipment_type, amount, price, total, bank_payment)
             VALUES ('{$row['note']}','{$row['id_customer']}','{$row['first_name']}','{$row['last_name']}','{$row['phone']}','{$row['country']}','{$row['timezone']}','{$row['addrest_list']}','{$row['state']}','{$row['city']}','{$row['zip']}','{$row['shipper']}','{$row['order_date']}','{$row['gender']}','{$row['email']}','{$row['age']}','{$row['height']}','{$row['Chronic_disease']}','{$row['married']}','{$row['children']}','{$row['id_status']}','','','','','{$row['id_agent']}','{$row['order_id']}','{$row['operator_comment']}','{$row['note']}','{$row['note']}','{$row['note']}','{$row['date_comment']}','{$row['date_comment']}','{$row['date_comment']}','{$row['date_comment']}','{$row['promo']}','{$row['nama_product']}','{$row['description']}','{$row['package']}','{$row['shipment_type']}','{$row['amount']}','{$row['price']}','{$row['total']}','{$row['bank_payment']}')";                
            mysqli_query($con, $inserthistori);
        }

        // Delete data from tb_customer
        $delete = "DELETE FROM tb_customer WHERE id_customer = '$id_customer'";
        if(mysqli_query($con, $delete)) {
            $data['success'] = true;
            $data['message'] = 'Success!';
        } else {
            $data['success'] = false;
            $data['errors'] = $errors;
        }
        echo json_encode($data);
    } else {
        echo "No data found ";
    };                    
     
mysqli_close($con)                      
?>