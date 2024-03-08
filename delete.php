<?php
// Mendapatkan id data yang ingin dihapus
$id = $_GET['id_customer'];
include('koneksi.php');

// Menghapus baris berdasarkan ID
$sql = "DELETE FROM tb_customer WHERE id_customer = $id";

if ($con->query($sql) === TRUE) {
    echo "<script>alert('Data berhasil dihapus'); window.location.href = 'custabel.php';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}
?>