<?php

// Memanggil pemindahan data sebelum logout
include('updatesession.php');

// Menghapus variabel-variabel sesi yang terkait dengan customer
unset($_SESSION['id_agent']);
unset($_SESSION['username_agent']);
unset($_SESSION['login_time']);
unset($_SESSION['session_id']);
unset($_SESSION['loggedin']);
unset($_SESSION['id_level']);


// Redirect ke halaman index.php setelah logout
header("location: login.php");
exit;
?>