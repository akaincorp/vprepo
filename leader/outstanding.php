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
            <a href="detailstatistic.php" class="nav-link">Statistic</a>
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
            <a href="outstanding.php" class="nav-link active">Outstanding</a>
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
        <!-- </ul>
      </nav> -->
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
                    <a class="nav-link" href="detailstatistic.php"  aria-selected="false">Statistic</a>
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
                    <a class="nav-link active" href="outstanding.php" aria-selected="true">Outstanding</a>
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


              <?php
 include('koneksi/koneksi.php'); 
 $idFilter = isset($_GET['id_agent']) ? $_GET['id_agent'] : '';
 $selectqueue = "SELECT * FROM tb_outstanding
                 JOIN tb_procces ON tb_outstanding.id_statusf = tb_procces.id_statusf
                 JOIN tb_callback ON tb_outstanding.id_status = tb_callback.id_status
                 JOIN tb_notconnect ON tb_outstanding.id_statusc = tb_notconnect.id_statusc
                 JOIN tb_disclaimer ON tb_outstanding.id_statusb = tb_disclaimer.id_statusb
                 JOIN tb_spam ON tb_outstanding.id_statusd = tb_spam.id_statusd
                 JOIN tb_agent ON tb_outstanding.id_agent = tb_agent.id_agent ORDER BY date_comment DESC";
 if (!empty($idFilter)) {
    if (is_numeric($idFilter)) {
        $selectqueue .= " WHERE tb_outstanding.order_id = '$idFilter' ";
    } else {
        $selectqueue .= " WHERE tb_agent.username = '$idFilter'";
    }
};

 $resultqueue = mysqli_query($con, $selectqueue);


 $checklastdate = "SELECT last_date FROM stat_leader WHERE id_leader = $id_leader";
 $resultlastdate = mysqli_query($con, $checklastdate);
 $row2 = mysqli_fetch_assoc($resultlastdate);
 $lastdatedb = $row2['last_date'];
 $datenow = date("Y-m-d");
 
 if ($lastdatedb === $datenow) {
 
 $selectapproved = "SELECT COUNT(id_customer) AS totalapproved, SUM(total) AS totaluang
                    FROM tb_delivery WHERE id_statusf = '24' AND id_leader = '$id_leader'";
 
 $result = mysqli_query($con, $selectapproved);
 $row = mysqli_fetch_assoc($result);
 $newapprovedamount = $row['totalapproved'];
 $totaluang = $row['totaluang'];
 
 $rateaff = 23;
 $rawaffpayout = $rateaff * $newapprovedamount;
 $affpayout = '$' . $rawaffpayout;
 
 $percentage = 0.7;
 $grosscom = ($percentage / 100) * $totaluang;
 
 $selectreject = "SELECT SUM(total) AS totalrejected 
                    FROM tb_delivery WHERE id_statusf IN  ('22','23') AND id_leader = '$id_leader'";
 
 $resultreject = mysqli_query($con, $selectreject);
 $rowreject = mysqli_fetch_assoc($resultreject);
 $rawreject = $rowreject['totalrejected'];
 $rejected =  '-' . $rawreject;
 
                   
 
 $update = "UPDATE stat_leader SET approved_amount = '$newapprovedamount', gross_com = '$grosscom', reject = '$rejected', aff_payout = '$affpayout' WHERE id_leader = '$id_leader'";                
 mysqli_query($con, $update);
 
 } else if ($lastdatedb != $datenow) {
   
 $selectstat = "SELECT * FROM stat_leader WHERE id_leader = '$id_leader'";
       $resultselectstat = mysqli_query($con, $selectstat);
 
       while ($rowstat = mysqli_fetch_assoc($resultselectstat)) {
         
         $insertstat = "INSERT INTO tb_stat_history_leader (id_leader, turn_over, approved_amount, gross_com, reject, aff_payout, last_date) 
         VALUES ('{$rowstat['id_leader']}', '{$rowstat['turn_over']}', '{$rowstat['approved_amount']}', '{$rowstat['gross_com']}', '{$rowstat['reject']}', '{$rowstat['aff_payout']}', '{$rowstat['last_date']}')";
         $resultinsert = mysqli_query($con, $insertstat);
 
 
       }
 
       $query2 = "UPDATE stat_leader SET last_date = '$datenow', approved_amount = '0'  WHERE id_leader = '$id_leader'";
       $resultquery2 = mysqli_query($con, $query2);
 
 }



?>


<div class="card mt-3 ml-3" style="width:97.5%;">
              <div class="card-header">
                <h3 class="card-title">Outstanding Page</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              <div class="card-body table-responsive p-0"  id="cardBody">
      <div class="dt-buttons btn-group flex-wrap" id="topcontent" style="gap:10px;"> 
      <button id="refreshButton" class="btn btn-secondary">Refresh</button>
                 <button type="button" onclick="toDelivery()" class="btn btn-secondary">To Delivery</button>
              </div>
              <table id="example1" class="table table-bordered table-striped mt-5 text-xs">
                  <thead>
                  <tr>
                <th> <input type="checkbox" id="checkboxall"></th>
                <th>Order</th>
                <th>Status</th>
                <th>Address</th>
                <th>Products</th>
                <th>Price</th>
            </tr>
                  </thead>
                  <tbody>
                  <?php while ( $d = mysqli_fetch_array($resultqueue)) {
            ?>
            <tr>
                <td width="20px" style="background-color:#d5ffd5;">
                    <input type="checkbox" id="checkboxtabel" name="hapus[]" value="<?php echo $d['id_customer']; ?>">
                    <button class="btn btn-secondary" style="padding: 0px 1px;font-size: 15px;background: transparent;color: black;border: none;" id="openedit" data-toggle="modal" data-target="#modal-xl" onclick=" openModal(<?php echo $d['id_customer']; ?>)"><i
                            class="fas fa-edit"></i></button>
                    <input type="hidden" value="<?php echo $id_leader ?>" id="id_leader">
                </td>



                <td style="background-color:#d5ffd5;"><?php echo $d['username']; ?><br>
                    <?php echo $d['order_date']; ?><br>
                    <b data-toggle='modal' data-target='#modal-xl2' style="cursor:pointer;" onclick="openModal(<?php echo $d['order_id']; ?>)"><?php echo $d['order_id']; ?></b>   
                </td>


                <td style="background-color:#d5ffd5;">
                    <?php echo $d['status']; ?><br><?php echo $d['statusb']; ?><br><?php echo $d['statusc']; ?><br><?php echo $d['statusd'];?><br>
                    <?php echo $d['statusf']; ?>
                </td>

                <td style="background-color:#ffd5d5;width:550px;">
                    <p style="text-align:right;">
                        Name :&nbsp; <?php echo $d['first_name'];?>&nbsp;<?php echo $d['last_name'];?><br>
                        Addres
                        :&nbsp;<?php echo $d['addrest_list'];?>&nbsp;<?php echo $d['state'];?>,<?php echo $d['city'];?>,<?php echo $d['zip'];?><br>
                        <?php echo $d['phone'];?><br>
                    <p style="color:red;text-align:right;">Note : &nbsp;<?php echo $d['note'];?></p>
                    </p>
                </td>


                <td style="background-color:#d5ffd5;"><?php echo $d['nama_product'];?><br>
                    <?php echo $d['amount'];?><br>
                    <?php echo $d['shipment_type'];?><br>
                    <?php echo $d['bank_payment'];?>
                </td>

                <td style="background-color:#d5ffd5;"><?php echo $d['total']; ?></td>

            </tr>
            <?php } ?>
                  </tbody>
                </table>
            </div>

            <div class="modal fade" id="modal-xl2">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">History Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <div class="modalorder-content"></div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

            <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form method="POST" action="editproduct.php">
            <div class="modal-contentedit"> </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="submit" value="Update" class="btn btn-primary">Update</button>
                  </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

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
<!-- SweetAlert2 -->
<script src="CSS/app/plugins/sweetalert2/sweetalert2.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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

// Function to open the modal with content
function openModal(idCustomer) {
    var order_id = idCustomer;

    $.ajax({
        url: 'historyagent.php?order_id=' + order_id,
        type: 'GET',
        success: function(response) {
            $(".modalorder-content").html(response);
        },
        error: function() {
            // Handle errors if the AJAX request fails
            alert("Failed to load content.");
        }
    });
}
</script>

    <script>
    const refreshButton = document.getElementById("refreshButton");

    refreshButton.addEventListener("click", function() {
        location.reload();
    });
    </script>
    <script>
    var CheckBoxAll = document.getElementById('checkboxall');
    CheckBoxAll.addEventListener('click', function() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');

        if (CheckBoxAll.checked) {
            // Jika checkbox "Select All" dicentang, centang semua checkbox
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = true;
            });
        } else {
            // Jika checkbox "Select All" tidak dicentang, hilangkan centangan dari semua checkbox
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        }
    });
    </script>

<script>
           // Fungsi untuk membuka modal
   function openModalQueue() {
    document.getElementById("myModalQueue").style.display = "block";
}


// Fungsi untuk menutup modal
function closeModalQueue() {
    document.getElementById("myModalQueue").style.display = "none";
}

    </script>
    <script>

    // Function to open the modal with content
    function openModal(idCustomer) {
        event.preventDefault()
        var order_id = idCustomer;

        $.ajax({
            url: 'editoutstanding.php?id_customer=' + order_id,
            type: 'GET',
            success: function(response) {
                $(".modal-contentedit").html(response);
            },
            error: function() {
                alert("Failed to load content.");
            }
        });
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


 function toDelivery() {
    const checkboxes = document.querySelectorAll('#checkboxtabel:checked');
    const idLeader = document.getElementById('id_leader').value;

        const formData = new FormData();
        checkboxes.forEach(checkbox => {
            formData.append('hapus[]', checkbox.value);
        });
        formData.append('id_leader', idLeader);

        fetch('outstandingtodelivery.php', {
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
  text: "Move success",
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





   
</script>

</body>
</html>






           



       







        



       
      
           
    

       
