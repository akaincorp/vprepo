<?php
include('koneksi/koneksi.php');
ini_set('display_errors','1');
$response = array();


if (isset($_POST['username']) && isset($_POST['password'])) {

$username = $_POST['username'];
$password = $_POST['password'];
$level = 3;
$idstatuse = 9;
$sessiondur = "00:00:00";
$tgl = "0000-00-00";
$appr = 0;
$office = "Jakarta";
$nama = "";
$email = "";
$alamat = "";
$phone = 0;

$hashpassword = (password_hash($password,PASSWORD_BCRYPT));

$queryinserts = "INSERT INTO tb_agent (username,password,id_level,id_statuse,nama_op,email_op,alamat_op,phone_op) VALUES ('$username','$hashpassword','$level','$idstatuse','$nama','$email','$alamat','$phone')";
mysqli_query($con,$queryinserts);

$select = "SELECT * FROM tb_agent WHERE username = '$username'";
$result = mysqli_query($con, $select);

if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Insert data into tb_queue
        $insert = "INSERT INTO stat_agent (id_agent,username_agent,id_statuse,session_duration,tgl_login,approved_order,office_name)
         VALUES ('{$row['id_agent']}','{$row['username']}','{$row['id_statuse']}','$sessiondur','$tgl','$appr','$office')";                
         $results = mysqli_query($con, $insert);
    }
}



if ($results) {
    $response['success'] = true;
} else {
    $response['error'] = "Error deleting data: " . mysqli_error($con);
}

} else {
    $response['error'] = "Incomplete data received";
}

echo json_encode($response);


?>