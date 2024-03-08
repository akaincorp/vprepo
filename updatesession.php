<?php
session_start();
include('koneksi.php');

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === TRUE) {
    $username = $_SESSION['username_agent'];
    $id_agent = $_SESSION['id_agent'];
    $duration = $_GET['duration'];

    $selectdayduration = "SELECT day_duration FROM stat_agent WHERE id_agent = '$id_agent'";
    $resultday = mysqli_query($con, $selectdayduration);
    $dayduration = $resultday->fetch_assoc();

    if ($dayduration['day_duration'] === null || $dayduration['day_duration'] === '0' || $dayduration['day_duration'] === '00:00:00') {
        $durationformat = gmdate('H:i:s', $duration);
        $query = "UPDATE stat_agent SET day_duration = '$durationformat' WHERE id_agent = '$id_agent'";
        mysqli_query($con, $query);
    } else {
        $query2 = "SELECT day_duration FROM stat_agent WHERE id_agent = '$id_agent'";
        $result2 = mysqli_query($con, $query2);
    
        $row2 = $result2->fetch_assoc();
        $daydurationstat = $row2['day_duration'];
    
        $daydurationseconds = strtotime($daydurationstat) - strtotime('00:00:00');
        $totaldayduration = $duration + $daydurationseconds;
        $totaldayformat = gmdate('H:i:s', $totaldayduration);
    
        $query = "UPDATE stat_agent SET day_duration = '$totaldayformat' WHERE id_agent = '$id_agent'";
        mysqli_query($con, $query);
    };

      // Lakukan query untuk menghitung total approved_order
$approvedamount = "SELECT SUM(approved_order) AS total_approved FROM tb_stat_history WHERE id_agent = '$id_agent'";
$resultapprovedamount = mysqli_query($con, $approvedamount);

if ($resultapprovedamount) {
    // Ambil hasil penghitungan
    $row = mysqli_fetch_assoc($resultapprovedamount);
    $totalApprovedAmount = $row['total_approved'];

    $updateapprovedamount = "UPDATE stat_agent SET approved_amount = '$totalApprovedAmount' WHERE id_agent = '$id_agent'";
    mysqli_query($con, $updateapprovedamount);

} else {
    echo "Gagal melakukan penghitungan total approved order: " . mysqli_error($con);
}

    $currentDate = date("Y-m-d");

    $spam = "SELECT COUNT(id_customer) AS totalspam FROM history_agent WHERE id_statusd IN ('15', '16', '17') AND id_agent = '$id_agent' AND(date_comment) = '$currentDate'";
    $resultspam = mysqli_query($con, $spam);
    $s = $resultspam->fetch_assoc();
    $totalspams = $s['totalspam'];

    $queryspamupdate = "UPDATE stat_agent SET spam_order = '$totalspams' WHERE id_agent = '$id_agent'";
    mysqli_query($con, $queryspamupdate);

    $totalattempts = "SELECT id_agent FROM history_agent WHERE id_agent = '$id_agent' AND DATE(date_comment) = '$currentDate'";
    $resultattempts = mysqli_query($con, $totalattempts);
    
    if ($resultattempts) {
      $totalrows = mysqli_num_rows($resultattempts);
      $updateattempts = "UPDATE stat_agent SET total_attempth = '$totalrows' WHERE id_agent = '$id_agent'";
      $result_update = mysqli_query($con, $updateattempts);
  
      if ($result_update) {
          echo "<script>console.log('Total attempth updated successfully')</script>";
      } else {
          echo "<script>console.log('Failed to update total attempth')</script>";
      }
  } else {
      echo "<script>console.log('Query to retrieve total attempth failed')</script>";
  }

  $average = "SELECT SUM(total) AS total_sum FROM history_agent WHERE id_statusf IN ('18','24') AND DATE(date_comment) = '$currentDate' AND id_agent = '$id_agent'";
  $resultaverage = mysqli_query($con, $average);
  
  if ($resultaverage) {
      $d = $resultaverage->fetch_assoc();
      $totalSum = $d['total_sum'];
  
      $selectapproved = "SELECT approved_order FROM stat_agent WHERE id_agent = '$id_agent'";
      $resultapp = mysqli_query($con, $selectapproved);
      $a = $resultapp->fetch_assoc();
      $totalapproved = $a['approved_order'];
  
      // Check if $totalapproved is not zero to prevent division by zero
      if ($totalapproved != 0) {
          $totalall = $totalSum / $totalapproved;
          $formattedTotal = number_format($totalall, 0);
  
          $updateaverage = "UPDATE stat_agent SET average_check = '$formattedTotal' WHERE id_agent = '$id_agent'";
          mysqli_query($con, $updateaverage);
      } 
  }


  $delok = "SELECT COUNT(id_agent) AS totalok FROM tb_delivery WHERE id_statusf = '24' AND id_agent = '$id_agent' AND(date_comment) = '$currentDate'";
  $resultok = mysqli_query($con, $delok);
  $a = $resultok->fetch_assoc();
  $successOrders = $a['totalok']; 
  
  $closing = "SELECT COUNT(id_agent) AS totalout FROM history_agent WHERE  id_statusf = '18' AND  id_agent = '$id_agent' AND DATE(date_comment) = '$currentDate'";
  $resultclosing = mysqli_query($con, $closing);
  $b = $resultclosing->fetch_assoc();
  $totalclosing = $b['totalout'];

  $totalOrders = $successOrders + $totalclosing;
  
  if ($totalOrders > 0) {
      $successPercentage = ($successOrders / $totalOrders) * 100;
      $successPercentageFormatted = number_format($successPercentage, 2) . "%";
      $queryupt = "UPDATE stat_agent SET callculation_approval = '$successPercentageFormatted' where id_agent = '$id_agent'";
      mysqli_query($con,$queryupt);
  } else {
      echo '<script>';
      echo "console.log('Tidak ada data order yang tersedia.');";
      echo '</script>';
  }
    
  $sqlbankpayment = "SELECT COUNT(id_customer) AS totalbankpayment FROM history_agent WHERE bank_payment = 'BPW' AND id_agent = '$id_agent' AND DATE(date_comment) = '$currentDate'";
  $resultbankpayment = mysqli_query($con, $sqlbankpayment);
  $datab = $resultbankpayment->fetch_assoc();
  $totalbankpayment = $datab['totalbankpayment'];
  $queryupdate = "UPDATE stat_agent SET bank_payment = '$totalbankpayment' where id_agent = '$id_agent'";
  mysqli_query($con,$queryupdate);


    // Ambil data dari tabel session_logs berdasarkan user_id
    $query1 = "SELECT * FROM session_logs WHERE id_agent = '$id_agent'";
    $result1 = $con->query($query1);

    $query2 = "SELECT session_duration FROM stat_agent WHERE id_agent = '$id_agent'";
    $result2 = $con->query($query2);
    
    if ($result1->num_rows > 0 && $result2->num_rows > 0) {
        $row1 = $result1->fetch_assoc();
        $row2 = $result2->fetch_assoc();
    
        $login_time = $row1['tgl_login'];
        $session_durationstat = $row2['session_duration'];
    
        // Convert time duration strings to seconds
        $session_durationstat_seconds = strtotime($session_durationstat) - strtotime('00:00:00');

        $total_duration = $duration + $session_durationstat_seconds;
        $total_format = gmdate('H:i:s',$total_duration);
    
        $status = 9;

        $update = "UPDATE stat_agent SET tgl_login = '$login_time', session_duration = '$total_format', id_statuse = '$status' WHERE id_agent = '$id_agent'";
        $con->query($update);

        // Hapus data dari tabel session_logs
        $delete = "DELETE FROM session_logs WHERE id_agent = '$id_agent'";
        $con->query($delete);
    }
    session_unset();
    session_destroy();
}

$con->close();
?>