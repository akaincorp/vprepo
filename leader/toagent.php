<?php
include('koneksi/koneksi.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data yang dikirim melalui form
    $agentId = $_POST['agentid'];
    foreach ($_POST['hapus'] as $customerId) {
    $dateadded = date('Y-m-d H:i:s');
    
    $selectcustomer = "SELECT * FROM customerque WHERE id_customer = '$customerId'";
    $resultcustomer = mysqli_query($con, $selectcustomer);
     
    if ($resultcustomer) {
        $customerData = mysqli_fetch_assoc($resultcustomer);
        
        // Ambil data dari $customerData
        $orderdate = $customerData['order_date'];
        $orderid = $customerData['order_id'];
        $FirstName = $customerData['first_name'];
        $phone = $customerData['phone'];
        $idcustomer = $customerData['id_customer'];
        $promo = $customerData['promo'];

        $validasiagent = "SELECT * FROM tb_customer where id_agent = '$agentId'";
        $resultvalidasi = mysqli_query($con, $validasiagent);
        if (mysqli_num_rows($resultvalidasi) > 0) {
            // Kode untuk menampilkan alert jika validasi berhasil
            echo "<script>alert('Agent sedang menangani data customer, Silahkan pilih agent lain !'); window.location.href = 'quesort.php' </script>";   
        } else {
   // update last operator
   $updatequery = "UPDATE customerque SET last_operator = '$agentId', date_added = '$dateadded' WHERE id_customer = '$customerId'";
   mysqli_query($con,$updatequery);
   
   // Insert data ke tabel 
   $insertQuery = "INSERT INTO tb_customer (id_agent, first_name, phone, id_customer, order_date, order_id, promo) VALUES ('$agentId', '$FirstName', '$phone','$idcustomer','$orderdate','$orderid','$promo')";
   $insertResult = mysqli_query($con, $insertQuery);
   
   if ($insertResult) {
       echo "<script>alert('Data added successfully'); window.location.href = 'quesort.php'</script>";
   }
        }
}
}
}     
?>