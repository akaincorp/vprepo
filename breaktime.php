<?php
include('koneksi.php');
$id_agent = $_GET['id_agent'];
$breaktime = $_GET['breaktime'];


// Perbarui waktu istirahat di database sesuai dengan data yang diterima
$query = "UPDATE session_logs SET breaktime = '$breaktime' WHERE id_agent = '$id_agent'";
$con->query($query);

$queryy = "UPDATE stat_agent SET spare_time = '$breaktime' WHERE id_agent = '$id_agent'";
$con->query($queryy);

$con->close();
?>