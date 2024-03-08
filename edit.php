<?php
include 'koneksi.php';

$errors = [];
$data = [];

    $id = $_POST['id'];
    $nama_guest = $_POST['nama_guest'];
    $nama_guest1 = $_POST['nama_guest1'];
    $nomor_telepon = $_POST['phone'];
    $country = $_POST['country'];
    $timezone = $_POST['timezone'];
    $addres = $_POST['addres'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
    $email = $_POST['email'];
    $age = $_POST['age'];
    $height = $_POST['height'];
    $chronic = $_POST['chronic'];
    $married = isset($_POST['married']) ? $_POST['married'] : null;
    $children = isset($_POST['children']) ? $_POST['children'] : null;
    $process = '50%';

    $updatequery = "UPDATE customerque SET processing_operation = '$process' WHERE id_customer = '$id'";
    mysqli_query($con, $updatequery);

    // Prepare the update query
    $sql = "UPDATE tb_customer SET first_name = '$nama_guest',state = '$state', last_name = '$nama_guest1', phone = '$nomor_telepon', country = '$country', timezone = '$timezone', addrest_list = '$addres',city = '$city', zip = '$zip', gender = '$gender', email = '$email', age = '$age', height = '$height', Chronic_disease = '$chronic', married = '$married', children = '$children' WHERE id_customer = $id";

    if(mysqli_query($con, $sql)) {
        $data['success'] = true;
        $data['message'] = 'Success!';
    } else {
        $data['success'] = false;
        $data['errors'] = $errors;
    }

    echo json_encode($data);

mysqli_close($con);
?>