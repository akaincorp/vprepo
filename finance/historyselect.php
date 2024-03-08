<?php
include('koneksi/koneksi.php');
$selectedDate = $_GET['date'];
$selectQuery = "SELECT * FROM tb_stat_history_leader JOIN tb_leader ON tb_stat_history_leader.id_leader = tb_leader.id_leader WHERE last_date = '$selectedDate'";
    $result = mysqli_query($con, $selectQuery);

    if ($result) {
        // Fetch the data into an array
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        // Send the data back as JSON
        echo json_encode($data);
    } else {
        echo 'Error executing query: ' . mysqli_error($con);
    }
?>