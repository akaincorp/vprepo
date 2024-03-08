<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="CSS/app/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="CSS/app/dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="CSS/app/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="CSS/app/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="CSS/app/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
      <!-- SweetAlert2 -->
      <link rel="stylesheet" href="CSS/app/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">


    <title> Leader • VEON</title>
    <link rel="icon" href="../img/iconnew.png" type="image/icon type">
</head>
<body class="sidebar-collapse layout-top-nav  sidebar-closed layout-navbar-fixed layout-fixed">

<?php
    session_start();
include('../leader/koneksi/koneksi.php');
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === TRUE) {
    $username_leader = $_SESSION['username_leader'];
    $id_leader = $_SESSION['id_leader'];
} else {
  echo '
    <script src="CSS/app/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script>
        Swal.fire({
            title: "Warning!",
            text: "You are not logged in!",
            icon: "error"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "../login.php"; 
            }
        });
    </script>';
    exit();
}
?>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET['from']) && isset($_GET['to']) && !empty($_GET['from']) && !empty($_GET['to'])) {
        $from_date = $_GET['from'];
        $to_date = $_GET['to'];

        $sqltotaldata = "SELECT COUNT(total_id) AS total_customersdata FROM (
            SELECT COUNT(id_customer) AS total_id, MAX(date_comment) AS max_date
            FROM history_agent
            WHERE DATE(date_comment) BETWEEN '$from_date' AND '$to_date'
            GROUP BY id_customer
        ) AS subquery";
        $resulttotaldata = $con->query($sqltotaldata);
        $rowtotaldata = $resulttotaldata->fetch_assoc();
        $totaldatakeseluruhan = $rowtotaldata["total_customersdata"];


        $sqlnoanswer = "SELECT COUNT(total_id) AS total_customersnoanswer FROM (
            SELECT COUNT(id_customer) AS total_id, MAX(date_comment) AS max_date
            FROM history_agent
            WHERE id_statusc = '7' AND DATE(date_comment) BETWEEN '$from_date' AND '$to_date'
            GROUP BY id_customer
        ) AS subquery";
        $resultnoanswer = $con->query($sqlnoanswer);
        $row = $resultnoanswer->fetch_assoc();
        $totalnoanswer = $row["total_customersnoanswer"]; 

        $sqlcuttheline = "SELECT COUNT(total_id) AS total_customerscuttheline FROM (
            SELECT COUNT(id_customer) AS total_id, MAX(date_comment) AS max_date
            FROM history_agent
            WHERE id_status = '3' AND DATE(date_comment) BETWEEN '$from_date' AND '$to_date'
            GROUP BY id_customer
        ) AS subquery";
        $resultcuttheline = $con->query($sqlcuttheline);
        $row = $resultcuttheline->fetch_assoc();
        $totalcuttheline = $row["total_customerscuttheline"]; 
        
        $sqlexpensive = "SELECT COUNT(total_id) AS total_customersexpensive FROM (
            SELECT COUNT(id_customer) AS total_id, MAX(date_comment) AS max_date
            FROM history_agent
            WHERE id_statusb = '9' AND DATE(date_comment) BETWEEN '$from_date' AND '$to_date'
            GROUP BY id_customer
        ) AS subquery";
        $resultexpensive = $con->query($sqlexpensive);
        $row = $resultexpensive->fetch_assoc();
        $totalexpensive = $row["total_customersexpensive"]; 
        
        $sqlcannotsell = "SELECT COUNT(total_id) AS total_customerscannotsell FROM (
            SELECT COUNT(id_customer) AS total_id, MAX(date_comment) AS max_date
            FROM history_agent
            WHERE id_statusb = '14' AND DATE(date_comment) BETWEEN '$from_date' AND '$to_date'
            GROUP BY id_customer
        ) AS subquery";
        $resultcannotsell = $con->query($sqlcannotsell);
        $row = $resultcannotsell->fetch_assoc();
        $totalcannotsell = $row["total_customerscannotsell"]; 
        
        $sqlhealth = "SELECT COUNT(total_id) AS total_customershealth FROM (
            SELECT COUNT(id_customer) AS total_id, MAX(date_comment) AS max_date
            FROM history_agent
            WHERE id_statusb = '13' AND DATE(date_comment) BETWEEN '$from_date' AND '$to_date'
            GROUP BY id_customer
        ) AS subquery";
        $resulthealth = $con->query($sqlhealth);
        $row = $resulthealth->fetch_assoc();
        $totalhealth = $row["total_customershealth"]; 
        
        $sqlnot18 = "SELECT COUNT(total_id) AS total_customersnot18 FROM (
            SELECT COUNT(id_customer) AS total_id, MAX(date_comment) AS max_date
            FROM history_agent
            WHERE id_statusb = '12' AND DATE(date_comment) BETWEEN '$from_date' AND '$to_date'
            GROUP BY id_customer
        ) AS subquery";
        $resultnot18 = $con->query($sqlnot18);
        $row = $resultnot18->fetch_assoc();
        $totalnot18 = $row["total_customersnot18"]; 
        
        $sqlnodeliv = "SELECT COUNT(total_id) AS total_customersnodeliv FROM (
            SELECT COUNT(id_customer) AS total_id, MAX(date_comment) AS max_date
            FROM history_agent
            WHERE id_statusb = '11' AND DATE(date_comment) BETWEEN '$from_date' AND '$to_date'
            GROUP BY id_customer
        ) AS subquery";
        $resultnodeliv = $con->query($sqlnodeliv);
        $row = $resultnodeliv->fetch_assoc();
        $totalnodeliv = $row["total_customersnodeliv"]; 
        
        $sqlconsult = "SELECT COUNT(total_id) AS total_customersconsult FROM (
            SELECT COUNT(id_customer) AS total_id, MAX(date_comment) AS max_date
            FROM history_agent
            WHERE id_statusb = '10' AND DATE(date_comment) BETWEEN '$from_date' AND '$to_date'
            GROUP BY id_customer
        ) AS subquery";
        $resultconsult = $con->query($sqlconsult);
        $row = $resultconsult->fetch_assoc();
        $totalconsult = $row["total_customersconsult"]; 
        
        $sqlinmess = "SELECT COUNT(total_id) AS total_customersinmess FROM (
            SELECT COUNT(id_customer) AS total_id, MAX(date_comment) AS max_date
            FROM history_agent
            WHERE id_statusc = '5' AND DATE(date_comment) BETWEEN '$from_date' AND '$to_date'
            GROUP BY id_customer
        ) AS subquery";
        $resultinmess = $con->query($sqlinmess);
        $row = $resultinmess->fetch_assoc();
        $totalinmess = $row["total_customersinmess"]; 
        
        $sqlbusy = "SELECT COUNT(total_id) AS total_customersbusy FROM (
            SELECT COUNT(id_customer) AS total_id, MAX(date_comment) AS max_date
            FROM history_agent
            WHERE id_status = '2' AND DATE(date_comment) BETWEEN '$from_date' AND '$to_date'
            GROUP BY id_customer
        ) AS subquery";
        $resultbusy = $con->query($sqlbusy);
        $row = $resultbusy->fetch_assoc();
        $totalbusy = $row["total_customersbusy"]; 
        
        $sqlreconfirm = "SELECT COUNT(total_id) AS total_customersreconfirm FROM (
            SELECT COUNT(id_customer) AS total_id, MAX(date_comment) AS max_date
            FROM history_agent
            WHERE id_status = '4' AND DATE(date_comment) BETWEEN '$from_date' AND '$to_date'
            GROUP BY id_customer
        ) AS subquery";
        $resultreconfirm = $con->query($sqlreconfirm);
        $row = $resultreconfirm->fetch_assoc();
        $totalreconfirm = $row["total_customersreconfirm"]; 
        
        $sqlbank = "SELECT COUNT(total_id) AS total_customersbank FROM (
            SELECT COUNT(id_customer) AS total_id, MAX(date_comment) AS max_date
            FROM history_agent
            WHERE bank_payment = 'BPW' AND DATE(date_comment) BETWEEN '$from_date' AND '$to_date'
            GROUP BY id_customer
        ) AS subquery";
        $resultbank = $con->query($sqlbank);
        $row = $resultbank->fetch_assoc();
        $totalbank = $row["total_customersbank"]; 

    } else {

        $sqltotaldata = "SELECT COUNT(total_id) AS total_customersdata FROM (
            SELECT COUNT(id_customer) AS total_id, MAX(date_comment) AS max_date
            FROM history_agent
            GROUP BY id_customer
        ) AS subquery";
        $resulttotaldata = $con->query($sqltotaldata);
        $rowtotaldata = $resulttotaldata->fetch_assoc();
        $totaldatakeseluruhan = $rowtotaldata["total_customersdata"];

        $sqlnoanswer = "SELECT COUNT(total_id) AS total_customersnoanswer FROM (
            SELECT COUNT(id_customer) AS total_id, MAX(date_comment) AS max_date
            FROM history_agent
            WHERE id_statusc = '7'
            GROUP BY id_customer
        ) AS subquery";
        $resultnoanswer = $con->query($sqlnoanswer);
        $row = $resultnoanswer->fetch_assoc();
        $totalnoanswer = $row["total_customersnoanswer"]; 

        $sqlcuttheline = "SELECT COUNT(total_id) AS total_customerscuttheline FROM (
            SELECT COUNT(id_customer) AS total_id, MAX(date_comment) AS max_date
            FROM history_agent
            WHERE id_status = '3'
            GROUP BY id_customer
        ) AS subquery";
        $resultcuttheline = $con->query($sqlcuttheline);
        $row = $resultcuttheline->fetch_assoc();
        $totalcuttheline = $row["total_customerscuttheline"]; 
        
        $sqlexpensive = "SELECT COUNT(total_id) AS total_customersexpensive FROM (
            SELECT COUNT(id_customer) AS total_id, MAX(date_comment) AS max_date
            FROM history_agent
            WHERE id_statusb = '9'
            GROUP BY id_customer
        ) AS subquery";
        $resultexpensive = $con->query($sqlexpensive);
        $row = $resultexpensive->fetch_assoc();
        $totalexpensive = $row["total_customersexpensive"]; 
        
        $sqlcannotsell = "SELECT COUNT(total_id) AS total_customerscannotsell FROM (
            SELECT COUNT(id_customer) AS total_id, MAX(date_comment) AS max_date
            FROM history_agent
            WHERE id_statusb = '14'
            GROUP BY id_customer
        ) AS subquery";
        $resultcannotsell = $con->query($sqlcannotsell);
        $row = $resultcannotsell->fetch_assoc();
        $totalcannotsell = $row["total_customerscannotsell"]; 
        
        $sqlhealth = "SELECT COUNT(total_id) AS total_customershealth FROM (
            SELECT COUNT(id_customer) AS total_id, MAX(date_comment) AS max_date
            FROM history_agent
            WHERE id_statusb = '13'
            GROUP BY id_customer
        ) AS subquery";
        $resulthealth = $con->query($sqlhealth);
        $row = $resulthealth->fetch_assoc();
        $totalhealth = $row["total_customershealth"]; 
        
        $sqlnot18 = "SELECT COUNT(total_id) AS total_customersnot18 FROM (
            SELECT COUNT(id_customer) AS total_id, MAX(date_comment) AS max_date
            FROM history_agent
            WHERE id_statusb = '12'
            GROUP BY id_customer
        ) AS subquery";
        $resultnot18 = $con->query($sqlnot18);
        $row = $resultnot18->fetch_assoc();
        $totalnot18 = $row["total_customersnot18"]; 
        
        $sqlnodeliv = "SELECT COUNT(total_id) AS total_customersnodeliv FROM (
            SELECT COUNT(id_customer) AS total_id, MAX(date_comment) AS max_date
            FROM history_agent
            WHERE id_statusb = '11'
            GROUP BY id_customer
        ) AS subquery";
        $resultnodeliv = $con->query($sqlnodeliv);
        $row = $resultnodeliv->fetch_assoc();
        $totalnodeliv = $row["total_customersnodeliv"]; 
        
        $sqlconsult = "SELECT COUNT(total_id) AS total_customersconsult FROM (
            SELECT COUNT(id_customer) AS total_id, MAX(date_comment) AS max_date
            FROM history_agent
            WHERE id_statusb = '10'
            GROUP BY id_customer
        ) AS subquery";
        $resultconsult = $con->query($sqlconsult);
        $row = $resultconsult->fetch_assoc();
        $totalconsult = $row["total_customersconsult"]; 
        
        $sqlinmess = "SELECT COUNT(total_id) AS total_customersinmess FROM (
            SELECT COUNT(id_customer) AS total_id, MAX(date_comment) AS max_date
            FROM history_agent
            WHERE id_statusc = '5'
            GROUP BY id_customer
        ) AS subquery";
        $resultinmess = $con->query($sqlinmess);
        $row = $resultinmess->fetch_assoc();
        $totalinmess = $row["total_customersinmess"]; 
        
        $sqlbusy = "SELECT COUNT(total_id) AS total_customersbusy FROM (
            SELECT COUNT(id_customer) AS total_id, MAX(date_comment) AS max_date
            FROM history_agent
            WHERE id_status = '2'
            GROUP BY id_customer
        ) AS subquery";
        $resultbusy = $con->query($sqlbusy);
        $row = $resultbusy->fetch_assoc();
        $totalbusy = $row["total_customersbusy"]; 
        
        $sqlreconfirm = "SELECT COUNT(total_id) AS total_customersreconfirm FROM (
            SELECT COUNT(id_customer) AS total_id, MAX(date_comment) AS max_date
            FROM history_agent
            WHERE id_status = '4'
            GROUP BY id_customer
        ) AS subquery";
        $resultreconfirm = $con->query($sqlreconfirm);
        $row = $resultreconfirm->fetch_assoc();
        $totalreconfirm = $row["total_customersreconfirm"]; 
        
        $sqlbank = "SELECT COUNT(total_id) AS total_customersbank FROM (
            SELECT COUNT(id_customer) AS total_id, MAX(date_comment) AS max_date
            FROM history_agent
            WHERE bank_payment = 'BPW'
            GROUP BY id_customer
        ) AS subquery";
        $resultbank = $con->query($sqlbank);
        $row = $resultbank->fetch_assoc();
        $totalbank = $row["total_customersbank"]; 

    }};



if ($totalnoanswer > 0) {
    $percentage_no_answer = ($totalnoanswer / $totaldatakeseluruhan) * 100;
} else {
    $percentage_no_answer = 0;
}


if ($totalnot18 > 0) {
    $percentagenot18 = ($totalnot18 / $totaldatakeseluruhan) * 100;
} else {
    $percentagenot18 = 0;
}


if ($totalbank > 0) {
    $percentagebank = ($totalbank / $totaldatakeseluruhan) * 100;
} else {
    $percentagebank = 0;
}


if ($totalexpensive > 0) {
    $percentageexpensive = ($totalexpensive / $totaldatakeseluruhan) * 100;
} else {
    $percentageexpensive = 0;
}


if ($totalreconfirm > 0) {
    $percentagereconfirm = ($totalreconfirm / $totaldatakeseluruhan) * 100;
} else {
    $percentagereconfirm = 0;
}


if ($totalbusy > 0) {
    $percentagebusy = ($totalbusy / $totaldatakeseluruhan) * 100;
} else {
    $percentagebusy = 0;
}


if ($totalinmess > 0) {
    $percentageinmess = ($totalinmess / $totaldatakeseluruhan) * 100;
} else {
    $percentageinmess = 0;
}


if ($totalconsult > 0) {
    $percentageconsult = ($totalconsult / $totaldatakeseluruhan) * 100;
} else {
    $percentageconsult = 0;
}


if ($totalnodeliv > 0) {
    $percentagenodeliv = ($totalnodeliv / $totaldatakeseluruhan) * 100;
} else {
    $percentagenodeliv = 0;
}


if ($totalcannotsell > 0) {
    $percentagecannotsell = ($totalcannotsell / $totaldatakeseluruhan) * 100;
} else {
    $percentagecannotsell = 0;
}

if ($totalhealth > 0) {
    $percentagehealth = ($totalhealth / $totaldatakeseluruhan) * 100;
} else {
    $percentagehealth = 0;
}

if ($totalcuttheline > 0) {
    $percentagecuttheline = ($totalcuttheline / $totaldatakeseluruhan) * 100;
} else {
    $percentagecuttheline = 0;
}


if ($totalnoanswer > 0) {
    $total = number_format($percentagereconfirm, 0) + number_format($percentagebusy, 0) + number_format($percentagecuttheline, 0) + number_format($percentageinmess, 0) + number_format($percentage_no_answer, 0) + number_format($percentageconsult, 0) + number_format($percentagenodeliv, 0) + number_format($percentagenot18, 0) + number_format($percentagehealth, 0) + number_format($percentagecannotsell, 0) + number_format($percentageexpensive, 0);     
    $totalraw = number_format($percentagereconfirm, 2) + number_format($percentagebusy, 2) + number_format($percentagecuttheline, 2) + number_format($percentageinmess, 2) + number_format($percentage_no_answer, 2) + number_format($percentageconsult, 2) + number_format($percentagenodeliv, 2) + number_format($percentagenot18, 2) + number_format($percentagehealth, 2) + number_format($percentagecannotsell, 2) + number_format($percentageexpensive, 2);        
} else {
    $total = 0;
    $totalraw = 0;
}
?>

<div class="wrapper">

   <!-- Navbar -->
   <nav class="main-header navbar navbar-expand-md navbar-light navbar-white" style="background: linear-gradient(180deg, rgb(167 172 169),rgba(202,204,203,255));">
    <div class="container">
      <a href="dashboard.php" class="navbar-brand">
      <img src="../img/icon.png" alt="VEON logo" class="brand-image" style="position:absolute;left:2rem;margin-top: -0.1rem;height: 34px;width: 45px;">
    <div class="p-1 d-flex justify-content-center" style="background-color: #ffffff; border-radius: 35px;">
    <div class="d-inline-flex align-items-center ml-3 mr-3">
        <img src="../img/agent.png" alt="" style="max-width: 20px;">
        <?php
$sql = "SELECT * FROM tb_leader WHERE id_leader = '$id_leader'";
$result = mysqli_query($con, $sql);

while ($d = mysqli_fetch_assoc($result)) {
?>       
        <h6 class="ml-2 mb-0"><b><?php echo $d['username'];?></b></h6>
                    <?php } ?>
    </div>
    <div class="d-inline-flex align-items-center mr-3">
        <img src="../img/idr.png" alt="" style="max-width: 20px;">
        <h6 class="ml-2 mb-0"><b>IDR</b></h6>
    </div>
    <div class="d-inline-flex align-items-center mr-3">
        <img src="../img/statistic.png" alt="" style="max-width: 20px;">
        <h6 class="ml-2 mb-0"><b>0</b></h6>
    </div>
    <div class="d-inline-flex align-items-center mr-3">
        <img src="../img/office.png" alt="" style="max-width: 13px;">
        <h6 class="ml-2 mb-0"><b>Jakarta</b></h6>
    </div>
</div>

      </a>

   


      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link text-white" href="#" id="clock" ></a>
          </li>
        </ul>



          <ul class='order-1 order-md-3 navbar-nav navbar-no-expand ml-auto mr-3'>
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color:white;"></i></a>
          </li>


          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-white">Menu</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <!-- <li><a href="#" class="dropdown-item">Some action </a></li>
              <li><a href="#" class="dropdown-item">Some other action</a></li>

              <li class="dropdown-divider"></li> -->

              <!-- Level two dropdown-->
              <li class="dropdown-submenu dropdown-hover">
                <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Away</a>
                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">

                  <!-- Level three dropdown-->
                  <!-- <li class="dropdown-submenu">
                    <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                    <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                      <li><a href="#" class="dropdown-item">3rd level</a></li>
                      <li><a href="#" class="dropdown-item">3rd level</a></li>
                    </ul>
                  </li> -->
                  <!-- End Level three -->

                  <?php
$query = mysqli_query($con, "SELECT * FROM tb_opstatus WHERE statuse NOT IN ('offline', 'online')");

while ($d = mysqli_fetch_array($query)) {
    echo "<li><a href='#' class='dropdown-item' onclick='awayFunction($d[id_statuse])'>$d[statuse]</a></li>";
}
?>
                </ul>
              </li>
              <!-- End Level two -->
            </ul>
          </li>

          <li class="nav-item">
            <button class="btn btn-default font-weight-bolder p-1 mt-1" onclick="logOut()" style="color:red;background-color: rgb(204, 199, 199);box-shadow: 0px 2px 2px -1px;border:none;border-radius:0px;">Log Out</button>
          </li>
          </ul>
         

      </div>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="../img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8;background:white;">
      <span class="brand-text font-weight-light"><strong>VEON</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../img/leader.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <?php
include('koneksi/koneksi.php');

$sql = "SELECT * FROM tb_leader WHERE id_leader = '$id_leader'";
$result = mysqli_query($con, $sql);

while ($d = mysqli_fetch_assoc($result)) {
?>       
          <a href="#" data-toggle='modal' data-target='#modal-profile' class="d-block"><?php echo $d['username'];?></a>
          <?php } ?>
        </div>
        <a href="#" onclick="logOut()" class="d-block mt-2 ml-3" >
            <i class="fas fa-sign-out-alt" style="color: blue;position: absolute;right: 10px;"></i>
          </a>
      </div>

     

      <!-- Sidebar Menu -->
      <!-- <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"> -->
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- <li class="nav-header">PAGES</li>
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link">Dashboard</a>
          </li>
          <li class="nav-item">
            <a href="detailstatistic.php" class="nav-link active">Statistic</a>
          </li>
          <li class="nav-item">
            <a href="queue.php" class="nav-link">Queue</a>
          </li>
          <li class="nav-item">
            <a href="quesort.php" class="nav-link">Queue Sort Order</a>
          </li>
          <li class="nav-item">
            <a href="handling.php" class="nav-link">Handling</a>
          </li>
          <li class="nav-item">
            <a href="outstanding.php" class="nav-link">Outstanding</a>
          </li>
          <li class="nav-item">
            <a href="delivery.php" class="nav-link">Delivery</a>
          </li>
          <li class="nav-item">
            <a href="rebills.php" class="nav-link">Rebills</a>
          </li>
          <li class="nav-item">
            <a href="videospy.php" class="nav-link">Video Spy</a>
          </li>
          <li class="nav-item">
            <a href="callcontrol.php" class="nav-link">Call Control</a>
          </li>
          <li class="nav-item">
            <a href="trash.php" class="nav-link">Trash</a>
          </li> -->
          <!-- <li class="nav-header">MISCELLANEOUS</li>
          <li class="nav-item">
            <a href="CSS/app/iframe.html" class="nav-link">
              <i class="nav-icon fas fa-ellipsis-h"></i>
              <p>Tabbed IFrame Plugin</p>
            </a>
          </li> -->
        <!-- </ul> -->
      <!-- </nav> -->
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 mt-3">


          <div class="card card-primary card-outline card-outline-tabs p-3">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link" href="dashboard.php"  aria-selected="false">Dashboard</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="detailstatistic.php"  aria-selected="true">Statistic</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="queue.php" aria-selected="false">Queue</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link"  href="quesort.php"  aria-selected="false">Queue Sort Order</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link"  href="handling.php" aria-selected="false">Handling</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="outstanding.php" aria-selected="false">Outstanding</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link"  href="delivery.php" aria-selected="false">Delivery</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link"  href="rebills.php" aria-selected="false">Rebills</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link"  href="videospy.php" aria-selected="false">Video Spy</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link"  href="callcontrol.php" aria-selected="false">Call Control</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link"  href="trash.php" aria-selected="false">Trash</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
              <div class="card mt-3">
              <div class="card-header">
                <h3 class="card-title">Statistic Page</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

     <div class="modal fade" id="modal-default" style="top:140px;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pick Date Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form method="GET">
                  <div class="form-group">
                  <label for="from">From date:</label>
                  <input type="date" class="form-control" name="from" id=""> <br>
                  </div>
                  <div class="form-group">
              <label for="to">To date:</label>
                <input type="date" class="form-control" name="to" id="">
                  </div>
              </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Sort</button>
              </form>
            </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
              

      <div class="card-body table-responsive p-3" >
      <div class="dt-buttons btn-group flex-wrap" id="topcontent" style="gap:10px;"> 
                
              </div>
              <div class="dt-buttons btn-group flex-wrap"style="gap:10px;"> 
              <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-default">
                  Pick Date
                </button>
</div>
              <table  class="table table-bordered table-striped text-xs" id="example1" style="margin-top:50px;">
              <thead>
    <!-- Baris header -->
    <tr>
    <th rowspan="2" style="background: #babaff63;">Date</th>
        <th style="background: #ffff0029;" rowspan="2">Total</th>
        <th style="background-color:#bcfb5157;" colspan="7">Approved</th>
        <th style="background-color: #f1f164a8;" colspan="5">Processing</th>
        <th style="background-color: #ff000036;" colspan="6">Rejected</th>
    </tr>
    <tr>
        <th style="background-color: #ebeb776e;">Approved (%)</th>
        <th style="background-color: #ebeb776e;">Sent (%)</th>
        <th style="background-color: #ebeb776e;">Sent After <br> Bank Payment (%)</th> 
        <th style="background-color: #ebeb776e;">Bank <br> Payment (%) </th> 
        <th style="background-color: #ebeb776e;">Total (%)</th> 
        <th style="background-color: #ebeb776e;">Raw <br> Total (%)</th> 
        <th style="border-right: 1px solid #00000059;background-color: #ebeb776e;">Real <br> Total (%)</th> 

        <th style="background-color: #ebeb776e;">Reconfirm (%)</th> 
        <th style="background-color: #ebeb776e;">Client Busy (%)</th> 
        <th style="background-color: #ebeb776e;">CutTheLine (%)</th> 
        <th style="background-color: #ebeb776e;">InMessenger (%)</th> 
        <th style="border-right: 1px solid #00000059;background-color: #ebeb776e;">NoAnswer (%)</th> 

        <th style="background-color: #ebeb776e;">WantTo <br> Consult (%)</th> 
        <th style="background-color: #ebeb776e;">NoDelivery (%)</th> 
        <th style="background-color: #ebeb776e;">Not18 <br> YearsOld (%)</th> 
        <th style="background-color: #ebeb776e;">Health <br> Issues (%)</th> 
        <th style="background-color: #ebeb776e;">CanNot <br> Sell (%)</th> 
        <th style="background-color: #ebeb776e;">Expensive (%)</th> 
    </tr>
</thead>
<tbody>
        <tr>
        <td style="border:none;background:transparent;"></td>
        </tr>
        <tr>
        <td  style="border:none;background:transparent;"></td>
        </tr>
        <tr>
       <td colspan="20" style="text-align:left;background:transparent;font-size: 12px;color: #28289b;">EPROS NANO RING</td>
        </tr>
        <?php if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET['from']) && isset($_GET['to']) && !empty($_GET['from']) && !empty($_GET['to'])) {
        $from_date = $_GET['from'];
        $to_date = $_GET['to']; 
        ?>    
        <td ><?php echo $from_date ?> - <?php echo $to_date ?></td>
        <?php } else { ?>
            <td>All time</td>
            <?php }} ?>
        <td><?php echo $totaldatakeseluruhan ?></td>
        <td>N/A</td>
        <td>N/A</td>
        <td>N/A</td>
        <td><?php echo number_format($percentagebank, 0); ?>(<?php echo number_format($percentagebank, 2); ?>%)</td>
        <td><?php echo $total; ?></td>
        <td><?php echo $totalraw; ?>%</td>
        <td><?php  echo $totalraw; ?>%</td>
        <td><?php echo number_format($percentagereconfirm, 0); ?>(<?php echo number_format($percentagereconfirm, 2); ?>%)</td>
        <td><?php echo number_format($percentagebusy, 0); ?>(<?php echo number_format($percentagebusy, 2); ?>%)</td>
        <td><?php echo number_format($percentagecuttheline, 0); ?>(<?php echo number_format($percentagecuttheline, 2); ?>%)</td>
        <td><?php echo number_format($percentageinmess, 0); ?>(<?php echo number_format($percentageinmess, 2); ?>%)</td>
        <td><?php echo number_format($percentage_no_answer, 0); ?>(<?php echo number_format($percentage_no_answer, 2); ?>%)</td>
        <td><?php echo number_format($percentageconsult, 0); ?>(<?php echo number_format($percentageconsult, 2); ?>%)</td>
        <td><?php echo number_format($percentagenodeliv, 0); ?>(<?php echo number_format($percentagenodeliv, 2); ?>%)</td>
        <td><?php echo number_format($percentagenot18, 0); ?>(<?php echo number_format($percentagenot18, 2); ?>%)</td>
        <td><?php echo number_format($percentagehealth, 0); ?>(<?php echo number_format($percentagehealth, 2); ?>%)</td>
        <td><?php echo number_format($percentagecannotsell, 0); ?>(<?php echo number_format($percentagecannotsell, 2); ?>%)</td>
        <td><?php echo number_format($percentageexpensive, 0); ?>(<?php echo number_format($percentageexpensive, 2); ?>%)</td>
        <tr>
        <?php if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET['from']) && isset($_GET['to']) && !empty($_GET['from']) && !empty($_GET['to'])) {
        $from_date = $_GET['from'];
        $to_date = $_GET['to']; 
        $datediff = strtotime($to_date) - strtotime($from_date);
        $rentangtanggal = round($datediff / (60 * 60 * 24)); 
        ?>    
        <td style="background:#2cd42c5e;font-weight:bold;"><?php echo $rentangtanggal ?>&nbsp;Days</td>
        <?php } else { ?>
            <td style="background:#2cd42c5e;font-weight:bold;">All time</td>
            <?php }} ?>
        <td style="background:#2cd42c5e;font-weight:bold;"><?php echo $totaldatakeseluruhan ?></td>
        <td style="background:#2cd42c5e;font-weight:bold;">N/A</td>
        <td style="background:#2cd42c5e;font-weight:bold;">N/A</td>
        <td style="background:#2cd42c5e;font-weight:bold;">N/A</td>
        <td style="background:#2cd42c5e;font-weight:bold;"><?php echo number_format($percentagebank, 0); ?></td>
        <td style="background:#2cd42c5e;font-weight:bold;"><?php echo $total; ?></td>
        <td style="background:#2cd42c5e;font-weight:bold;"><?php  echo $totalraw; ?>%</td>
        <td style="background:#2cd42c5e;font-weight:bold;"><?php  echo $totalraw; ?>%</td>
        <td style="background:#2cd42c5e;font-weight:bold;"><?php echo number_format($percentagereconfirm, 0); ?></td>
        <td style="background:#2cd42c5e;font-weight:bold;"><?php echo number_format($percentagebusy, 0); ?></td>
        <td style="background:#2cd42c5e;font-weight:bold;"><?php echo number_format($percentagecuttheline, 0); ?></td>
        <td style="background:#2cd42c5e;font-weight:bold;"><?php echo number_format($percentageinmess, 0); ?></td>
        <td style="background:#2cd42c5e;font-weight:bold;"><?php echo number_format($percentage_no_answer, 0); ?></td>
        <td style="background:#2cd42c5e;font-weight:bold;"><?php echo number_format($percentageconsult, 0); ?></td>
        <td style="background:#2cd42c5e;font-weight:bold;"><?php echo number_format($percentagenodeliv, 0); ?></td>
        <td style="background:#2cd42c5e;font-weight:bold;"><?php echo number_format($percentagenot18, 0); ?></td>
        <td style="background:#2cd42c5e;font-weight:bold;"><?php echo number_format($percentagehealth, 0); ?></td>
        <td style="background:#2cd42c5e;font-weight:bold;"><?php echo number_format($percentagecannotsell, 0); ?></td>
        <td style="background:#2cd42c5e;font-weight:bold;"><?php echo number_format($percentageexpensive, 0); ?></td>
        </tr>
    </tbody>
                </table>
        </div>
             
      </div>
              </div>
              <!-- /.card -->
       


              <div class="modal fade" id="modal-profile">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Profile</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="../img/leader.png"
                       alt="User profile picture">
                </div>

                <?php
include('koneksi/koneksi.php');

$sql = "SELECT * FROM tb_leader WHERE id_leader = '$id_leader'";
$result = mysqli_query($con, $sql);

while ($d = mysqli_fetch_assoc($result)) {
?>       
  <h3 class="profile-username text-center"><?php echo $d['username'];?></h3>
              

                <p class="text-muted text-center">Leader</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Name</b> <a class="float-right"><?php echo $d['name'];?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Address</b> <a class="float-right"><?php echo $d['address'];?></a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item">Settings</li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">

                  <div class="active tab-pane">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                          <input type="hidden" value="<?php echo $d['id_leader'];?>" id="idleader" >
                          <input type="text" class="form-control" value="<?php echo $d['username'];?>" id="usernamee" placeholder="Usermame">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="passwordleader" placeholder="Password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="<?php echo $d['name'];?>" id="name" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php echo $d['email'];?>" id="email" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" value="<?php echo $d['address'];?>" id="address" placeholder="Address"><?php echo $d['address'];?></textarea>
                        </div>
                        <?php } ?>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" onclick="updateProfile()" class="btn btn-primary">Save Change</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->






              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
         </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="CSS/app/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="CSS/app/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="CSS/app/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="CSS/app/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="CSS/app/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="CSS/app/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="CSS/app/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="CSS/app/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="CSS/app/plugins/jszip/jszip.min.js"></script>
<script src="CSS/app/plugins/pdfmake/pdfmake.min.js"></script>
<script src="CSS/app/plugins/pdfmake/vfs_fonts.js"></script>
<script src="CSS/app/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="CSS/app/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="CSS/app/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="CSS/app/dist/js/adminlte.min.js"></script>
<script src="CSS/app/plugins/sweetalert2/sweetalert2.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#topcontent');
  });
</script>

<script>
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0'); // Pad the day with leading zero if needed
            const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are zero-based
            const year = now.getFullYear();

            const timeString = `${hours}:${minutes}:${seconds}`;
            const dateString = `${month}  ${day}, ${year}`;

            document.getElementById('clock').textContent = timeString + " AM " + dateString + " GMT +7";
        }

        updateClock(); // Update the clock immediately
        setInterval(updateClock, 1000); // Update the clock every second
        </script>

<script>
        // Fungsi untuk mengarahkan ke halaman custabel.php dan kirim data
        function awayFunction(val) {
            const selectedValue = val;
            window.location.href = `prosesstatusleader.php?status=${selectedValue}`;
        }
        </script>

<script>

function updateProfile() {
    const username = document.getElementById('usernamee').value;
    const password = document.getElementById('passwordleader').value;
    const idleader = document.getElementById('idleader').value;
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const address = document.getElementById('address').value;


        const formData = new FormData();
        formData.append('username', username);
        formData.append('password', password);
        formData.append('idleader', idleader); 
        formData.append('name', name); 
        formData.append('email', email); 
        formData.append('address', address); 

        fetch('updateprofile.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Network response was not ok.');
            }
        })
        .then(data => {
            if (data.success) {
                Swal.fire({
  title: "Succes!",
  text: "Save success",
  icon: "success"
});
            } else if (data.error) {
                Swal.fire({
  title: "Warning !",
  text: data.error,
  icon: "error"
});
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                     text: "Something went wrong!, Please contact developer"
});
            }
        })
        .catch(error => {
            Swal.fire({
                    icon: "error",
                    title: "Oops...",
                     text: "Something went wrong!, Please contact developer"
});
        });
   }


      function logOut() {

fetch('logout.php', {
    method: 'POST'
})
.then(response => {
    if (response.ok) {
      var Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 5000
});

Toast.fire({
icon: 'success',
title: 'Logout Success! Redirect in 5 seconds'
})

setTimeout(function() {
window.location.href = '../login.php'; 
}, 5000);

    } else {
      var Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000
});

Toast.fire({
icon: 'error',
title: 'Something Wrong'
})
    }
})
}
</script>

</body>
</html>

