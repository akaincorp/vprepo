<?php
// Pastikan metode request adalah POST
include('koneksi.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_customer = $_POST["id"];
        $note = $_POST["note"];
        $date_comment = $_POST['date_comment'];

        // Ambil nilai dari database untuk kolom operator_comment, operator_comment2, operator_comment3, dan operator_comment4
        $sql_select = "UPDATE tb_customer SET date_comment = '$date_comment', note = '$note' WHERE id_customer = $id_customer";
        mysqli_query($con, $sql_select);
        echo "<script>alert('Succes'); window.location.href = 'product.php'</script>";

mysqli_close($con);
}
?>