<?php
include('koneksi.php');
// Pastikan metode request adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah tombol submit ditekan
    if (isset($_POST["submit"])) {
        // Lakukan sanitasi data jika diperlukan (misalnya: mysqli_real_escape_string)
        // Ambil nilai dari form
        $id = $_POST["id"];
        $nama_product = $_POST["nama_product"];
        $description = $_POST["description"];
        $package = $_POST["package"];
        $shipment_type = $_POST["shipment_type"];
        $amount = $_POST["amount"];
        $price = $_POST["price"];
        $total = $_POST["total"];

        // Siapkan dan eksekusi kueri untuk menyimpan data ke database
        $sql = "INSERT INTO tb_product (id_customer, promo, description, package, shipment_type, amount, price, total)
                VALUES ('$id', '$nama_product', '$description', '$package', '$shipment_type', '$amount', '$price', '$total')";

        if (mysqli_query($con, $sql)) {
            // Jika berhasil disimpan, Anda bisa melakukan tindakan lanjutan atau memberikan pesan sukses.
            echo "Data berhasil disimpan.";
        } else {
            // Jika gagal disimpan, Anda bisa menangani kesalahan atau memberikan pesan error.
            echo "Error: " . mysqli_error($con);
        }

        // Tutup koneksi database setelah selesai menggunakan
        mysqli_close($con);
    }
}
?>