<?php
include('koneksi.php');

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $callback = $_POST['callback'];
    $notconnect = $_POST['notconnect'];
    $disclaimer = $_POST['disclaimer'];
    $spam = $_POST['spam'];

    // Convert empty strings to NULL values for the columns
    $callback = empty($callback) ? '0' : "'$callback'";
    $notconnect = empty($notconnect) ? '0' : "'$notconnect'";
    $disclaimer = empty($disclaimer) ? '0' : "'$disclaimer'";
    $spam = empty($spam) ? '0' : "'$spam'";

    // Lakukan operasi UPDATE untuk mengubah nilai id_statusc, id_status, id_statusb, dan id_statusd menjadi NULL pada id_customer yang sesuai
    $query_update = "UPDATE tb_customer SET id_status = $callback, id_statusc = $notconnect, id_statusb = $disclaimer, id_statusd = $spam WHERE id_customer = $id";
    $result_update = mysqli_query($con, $query_update);

    if ($result_update) {
        echo "<script>alert('Data berhasil diupdate di tabel tb_customer berdasarkan id $id'); window.location.href = 'product.php?id_customer=$id';</script>";
    } else {
        // Handle error if the query fails
        // For example: echo mysqli_error($con);
    }
} else {
    // Handle error if the query fails
    // For example: echo mysqli_error($con);
}
?>