<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
<?php
// proses_go_online.php

// Include file koneksi.php
include('koneksi.php');

// Pastikan permintaan menggunakan metode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ambil data dari permintaan POST
    $id_operator = $_SESSION['id_agent']; 
    $id_statuse = $_POST['id_statuse'];

    // Lakukan query untuk mengubah kolom id_statuse berdasarkan id_operator
    $sql = "UPDATE stat_agent SET id_statuse = '$id_statuse' WHERE id_agent = '$id_operator'";

    if (mysqli_query($con, $sql)) {
        // Jika query berhasil dijalankan, kirim pesan berhasil ke pemanggil AJAX
        echo "You're back";
    } else {
        // Jika query gagal, kirim pesan kesalahan ke pemanggil AJAX
        echo "Error: " . mysqli_error($con);
    }

    // Tutup koneksi setelah selesai menggunakan database
    mysqli_close($con);
}
?>