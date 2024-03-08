<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();


?>
<?php
include('koneksi/koneksi.php');

if (isset($_GET['status'])) {
    $status = $_GET['status'];
    $id_operator = $_SESSION['id_leader']; 

    // Lakukan query untuk memasukkan nilai status ke dalam tabel tb_operator
    $sql = "UPDATE stat_agent SET id_statuse = '$status' WHERE id_agent = '$id_operator'";

    if (mysqli_query($con, $sql)) {
        // Redirect kembali ke halaman awal atau halaman lain sesuai dengan kebutuhan Anda.
        header("Location: custabel.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}

mysqli_close($con);
?>