<?php
include('koneksi.php');
$user_id = $_GET['user_id'];
$tgl_login = $_GET['date'];
$duration = $_GET['duration'];
$setonline = 0;

$durationFinal = strtotime($duration) - ('00:00:00');

// Check if the user_id already exists in the session_logs table
$checkQuery = "SELECT id_agent FROM session_logs WHERE id_agent = '$user_id'";
$result = $con->query($checkQuery);

if ($result->num_rows == 0) {
    $insertQuery = "INSERT INTO session_logs (id_agent,id_statuse,breaktime,session_durationlog,tgl_login) VALUES ('$user_id','0','01:15:00','$durationFinal','$tgl_login')";
    $con->query($insertQuery);
};

$updatequery = "UPDATE stat_agent SET id_statuse = '$setonline' WHERE id_agent = '$user_id'";
$con->query($updatequery);


$con->close();
?> 