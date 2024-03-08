<?php
include('koneksi/koneksi.php');
$setpause = 'No';
// Melakukan perulangan sebanyak data yang ingin dihapus
if (isset($_POST['hapus']) && is_array($_POST['hapus'])) {
    foreach ($_POST['hapus'] as $id) {
        // Menggunakan prepared statement untuk mencegah SQL Injection
        $query = "UPDATE customerque SET onpause = '$setpause' WHERE id_customer = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $id); // "s" untuk tipe data string
        $stmt->execute();
        $stmt->close();
    }
}

// Kembali ke halaman sebelumnya
echo "<script>alert('Unpause sukses'); window.location.href = 'quesort.php'</script>";
exit();
?>