<?php ob_start(); ?>
<?php
ini_set('display_errors','1');
include('koneksi.php');
session_start();
$id_agent = $_SESSION['id_agent'];

if(isset($_POST["reg"])){
    $id_customer = $_POST['id_customer'];
    $id_customercombo = $id_customer . "$id_agent";
    $process = '100%';
    $statusf = 18;
    $note = $_POST['note'];
    $date_comment = $_POST['date_comment'];


    $combocheck = "SELECT * FROM tb_customer WHERE id_customer = '$id_customercombo'";
    $resultcombo = mysqli_query($con, $combocheck);

    if (mysqli_num_rows($resultcombo) > 0) {   

        $selectcombo = "SELECT combo FROM stat_agent WHERE id_agent = '$id_agent'";
        $resultcombos = mysqli_query($con, $selectcombo);

        if ($resultcombos) {
            $row = mysqli_fetch_assoc($resultcombos);
            $combo = $row['combo'] + 1;
            
            $updatecombo = "UPDATE stat_agent SET combo = '$combo' WHERE id_agent = '$id_agent'";
            mysqli_query($con, $updatecombo);
        };

        while ($row = mysqli_fetch_assoc($resultcombo)) {
            $lastName = $row['last_name'] . "(Combo)";
            $insert = "INSERT INTO tb_outstanding (note,shipper,delivery_comment,operator_comment3, operator_comment4, id_customer, first_name, last_name, phone, country, timezone, addrest_list, state, city, zip, order_date, gender, email, age, height, Chronic_disease, married, children, id_status, id_statusb, id_statusc, id_statusd, id_statusf, id_agent, order_id, operator_comment, date_comment,date_comment2, date_comment3, date_comment4, promo, nama_product, description, package, shipment_type, amount, price, total, bank_payment)
             VALUES ('$note','{$row['shipper']}','{$row['delivery_comment']}','{$row['operator_comment3']}','{$row['operator_comment4']}','{$row['id_customer']}','{$row['first_name']}','$lastName','{$row['phone']}','{$row['country']}','{$row['timezone']}','{$row['addrest_list']}','{$row['state']}','{$row['city']}','{$row['zip']}','{$row['order_date']}','{$row['gender']}','{$row['email']}','{$row['age']}','{$row['height']}','{$row['Chronic_disease']}','{$row['married']}','{$row['children']}','','','','','$statusf','$id_agent','{$row['order_id']}','{$row['operator_comment']}','$date_comment','{$row['date_comment2']}','{$row['date_comment3']}','{$row['date_comment4']}','{$row['promo']}','{$row['nama_product']}','{$row['description']}','{$row['package']}','{$row['shipment_type']}','{$row['amount']}','{$row['price']}','{$row['total']}','{$row['bank_payment']}')";                
            mysqli_query($con, $insert);
        };

        $delete = "DELETE FROM tb_customer WHERE id_customer = '$id_customercombo'";
        mysqli_query($con, $delete);
    };


    $sql = "UPDATE tb_customer SET date_comment = '$date_comment', note = '$note' WHERE id_customer = $id_customer";
    mysqli_query($con, $sql);
    
    // Select data from tb_customer
    $select = "SELECT * FROM tb_customer WHERE id_customer = '$id_customer'";
    $result = mysqli_query($con, $select);

    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Insert data into tb_queue
            $insert = "INSERT INTO tb_outstanding (note,shipper,delivery_comment,operator_comment3, operator_comment4, id_customer, first_name, last_name, phone, country, timezone, addrest_list, state, city, zip, order_date, gender, email, age, height, Chronic_disease, married, children, id_status, id_statusb, id_statusc, id_statusd, id_statusf, id_agent, order_id, operator_comment, date_comment,date_comment2, date_comment3, date_comment4, promo, nama_product, description, package, shipment_type, amount, price, total, bank_payment)
             VALUES ('{$row['note']}','{$row['shipper']}','{$row['delivery_comment']}','{$row['operator_comment3']}','{$row['operator_comment4']}','{$row['id_customer']}','{$row['first_name']}','{$row['last_name']}','{$row['phone']}','{$row['country']}','{$row['timezone']}','{$row['addrest_list']}','{$row['state']}','{$row['city']}','{$row['zip']}','{$row['order_date']}','{$row['gender']}','{$row['email']}','{$row['age']}','{$row['height']}','{$row['Chronic_disease']}','{$row['married']}','{$row['children']}','','','','','$statusf','{$row['id_agent']}','{$row['order_id']}','{$row['operator_comment']}','{$row['date_comment']}','{$row['date_comment2']}','{$row['date_comment3']}','{$row['date_comment4']}','{$row['promo']}','{$row['nama_product']}','{$row['description']}','{$row['package']}','{$row['shipment_type']}','{$row['amount']}','{$row['price']}','{$row['total']}','{$row['bank_payment']}')";                
            mysqli_query($con, $insert);

            $inserthistori = "INSERT INTO history_agent (note, id_customer, first_name, last_name, phone, country, timezone, addrest_list, state, city, zip, shipper, order_date, gender, email, age, height, Chronic_disease, married, children, id_status, id_statusb, id_statusc, id_statusd, id_statusf, id_agent, order_id, operator_comment, operator_comment2, operator_comment3,operator_comment4, date_comment, date_comment2, date_comment3, date_comment4, promo, nama_product, description, package, shipment_type, amount, price, total, bank_payment)
            VALUES ('{$row['note']}','{$row['id_customer']}','{$row['first_name']}','{$row['last_name']}','{$row['phone']}','{$row['country']}','{$row['timezone']}','{$row['addrest_list']}','{$row['state']}','{$row['city']}','{$row['zip']}','{$row['shipper']}','{$row['order_date']}','{$row['gender']}','{$row['email']}','{$row['age']}','{$row['height']}','{$row['Chronic_disease']}','{$row['married']}','{$row['children']}','','','','','$statusf','{$row['id_agent']}','{$row['order_id']}','{$row['operator_comment']}','{$row['note']}','{$row['note']}','{$row['note']}','{$row['date_comment']}','{$row['date_comment']}','{$row['date_comment']}','{$row['date_comment']}','{$row['promo']}','{$row['nama_product']}','{$row['description']}','{$row['package']}','{$row['shipment_type']}','{$row['amount']}','{$row['price']}','{$row['total']}','{$row['bank_payment']}')";                
           mysqli_query($con, $inserthistori);
        };
         

        // Delete data from tb_customer
        $delete = "DELETE FROM tb_customer WHERE id_customer = '$id_customer'";
        if(mysqli_query($con, $delete)) {
            echo "<script>alert('Approved !'); window.location.href = 'dashboard.php';</script>";
        } else {
            echo "Error deleting data: " . mysqli_error($con);
        }
    } else {
        echo "No data found ";
    };                    
                    
                        $selectapprove = "SELECT approved_order FROM stat_agent WHERE id_agent = '$id_agent'";
                        $resultapprove = mysqli_query($con, $selectapprove);

                        if ($resultapprove) {
                            $row = mysqli_fetch_assoc($resultapprove);
                            $approved = $row['approved_order'] + 1;
                            $approvedamount = $row['approved_amount'] + 1;
                            
                            $updateapproved = "UPDATE stat_agent SET approved_order = '$approved', approved_amount = '$approvedamount' WHERE id_agent = '$id_agent'";
                            mysqli_query($con, $updateapproved);
                        };

                     
                        }
                        ?>