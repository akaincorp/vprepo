<?php
session_start();
// Check if the user is logged in
include('koneksi.php');

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === TRUE) {
    $username = $_SESSION['username_agent'];
    $id_operator = $_SESSION['id_agent'];
    $setstatus = 0;
    $session_id = $_SESSION['session_id'];
}

header('Content-Type: application/json');

if (isset($id_operator)) {
    $query = "SELECT spare_time FROM stat_agent WHERE id_agent = '$id_operator'";
    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $secondsRemaining = $row['spare_time'];
            echo json_encode(array("secondsRemaining" => $secondsRemaining));
        } else {
            echo json_encode(array("message" => "Waktu istirahat hari ini telah habis, Silahkan lapor ke leader jika ada keperluan mendadak !"));
        }
    } else {
        echo json_encode(array("message" => "Terjadi kesalahan dalam kueri ke database."));
    }
} else {
    echo json_encode(array("message" => "ID operator tidak tersedia."));
}

mysqli_close($con);
?>