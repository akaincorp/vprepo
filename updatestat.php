<?php
session_start();
include('koneksi.php');
$id_agent = $_SESSION['id_agent'];


                    // stat update

                    $currentDate = date("Y-m-d");

                    $spam = "SELECT COUNT(id_customer) AS totalspam FROM history_agent WHERE id_statusd IN ('15', '16', '17') AND id_agent = '$id_agent' AND DATE(date_comment) = '$currentDate'";
                    $resultspam = mysqli_query($con, $spam);
                    $s = $resultspam->fetch_assoc();
                    $totalspams = $s['totalspam'];
            
                    $queryspamupdate = "UPDATE stat_agent SET spam_order = '$totalspams' WHERE id_agent = '$id_agent'";
                    mysqli_query($con, $queryspamupdate);
            
                    $approvedamount = "SELECT SUM(approved_order) AS total_approved FROM tb_stat_history WHERE id_agent = '$id_agent'";
                    $resultapprovedamount = mysqli_query($con, $approvedamount);
            
                    if ($resultapprovedamount) {
                        $row = mysqli_fetch_assoc($resultapprovedamount);
                        $totalApprovedAmount = $row['total_approved'];
            
                        $updateapprovedamount = "UPDATE stat_agent SET approved_amount = '$totalApprovedAmount' WHERE id_agent = '$id_agent'";
                        mysqli_query($con, $updateapprovedamount);
            
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
                    } 
            
                    $sqlbankpayment = "SELECT COUNT(id_customer) AS totalbankpayment FROM history_agent WHERE bank_payment = 'BPW' AND id_agent = '$id_agent' AND DATE(date_comment) = '$currentDate'";
                    $resultbankpayment = mysqli_query($con, $sqlbankpayment);
                    $datab = $resultbankpayment->fetch_assoc();
                    $totalbankpayment = $datab['totalbankpayment'];
                    $queryupdate = "UPDATE stat_agent SET bank_payment = '$totalbankpayment' where id_agent = '$id_agent'";
                    mysqli_query($con,$queryupdate);
            
                    $totalattempts = "SELECT id_agent FROM history_agent WHERE id_agent = '$id_agent' AND DATE(date_comment) = '$currentDate'";
                    $resultattempts = mysqli_query($con, $totalattempts);
                    
                    if ($resultattempts) {
                      $totalrows = mysqli_num_rows($resultattempts);
                      $updateattempts = "UPDATE stat_agent SET total_attempth = '$totalrows' WHERE id_agent = '$id_agent'";
                      $result_update = mysqli_query($con, $updateattempts);
                    }
            
                    // end

?>