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

    <style>
     .navtop-content {
  background: white;
  width: 350px;
  height: 30px;
  border-radius: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
  position: absolute;
  left: 7%;
  top: 7px;
  gap: 10px;
}
    </style>
  


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
    include('../header.html');
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

      <div id="myModal" class="modalorder">
        <div class="modalorder-content">
        </div>

      
      <!-- <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header">PAGES</li>
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link active">Dashboard</a>
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
                    <a class="nav-link active" href="dashboard.php"  aria-selected="true">Dashboard</a>
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

              <div class="card card-primary card-outline mt-3  ">
              <div class="card-header">
                <h3 class="card-title">Dashboard Realtime</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">


              <div class="modal fade" id="modal-default" style="top:175px;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add New Agent Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
    <form method="POST" id="agentForm">
    <div class="form-group">
            <label for="username" class="labelusername">Username :</label> 
            <input type="text" class="form-control" name="username" id="username" placeholder="Username">
</div>
<div class="form-group">
            <label for="password" class="labelpassword">Password :</label> 
            <input type="text" class="form-control" name="password" id="password" placeholder="Password">
    </form>
</div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" onclick="addAgent()" class="btn btn-primary">Add</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <div class="card-body table-responsive p-0"  id="cardBody">
      <div class="dt-buttons btn-group flex-wrap" id="topcontent" style="gap:10px;"> 
              <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-default">
                  Add New Agent
                </button>
              <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-lg">
                  User Management
                </button>
              </div>
      </div>
    </form>


    <div class="modal fade" id="modal-default2" style="top:175px;" id="editagent">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Agent Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form method="POST" >
    <div class="content-edit"></div>
    </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" onclick="editAgent()" class="btn btn-primary">Save</button>
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






              <div class="card card card-primary card-outline mt-5">
              <div class="card-header">
                <h3 class="card-title">Dashboard History </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

      <div class="card-body table-responsive p-0" >
      <div class="dt-buttons btn-group flex-wrap" id="topcontent2" style="gap:10px;"> 
              <form method="GET">
                <label for="from">Date:</label>
                <input type="date"   name="from" id="">
                <button type="submit" class="btn btn-secondary"> Sort</button>
            </form>
              </div>
              <table class="table table-hover text-nowrap text-xs" id="example2">
    <thead> <!-- Baris header -->
        <tr>
        <th>Action</th>
        <th>No</th>
            <th>Date</th>
            <th>Username</th>
            <th>Spare Time</th>
            <th>Office Name</th>
            <th>Approve Order</th>
            <th>Spam Order</th>
            <th>Bank Payment</th>
            <th>Average Check</th>
            <th>Calculation Approval</th>
            <th>Approved Amount</th>
            <th>Combo</th>
            <th>Full Login Time</th>
            <th>Status</th>
            <th>Total Attempts</th>
            <th>Status Since</th>
            <th>Work Warned</th>
        </tr>
    </thead>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET['from']) && !empty($_GET['from'])) {
            $date = $_GET['from'];
            $no = 1;

            $sqldata = "SELECT * FROM tb_stat_history WHERE DATE(tgl_login) = '$date'";
            $resultdata = $con->query($sqldata);

            if ($resultdata !== false && $resultdata->num_rows > 0) {
                while ($d = mysqli_fetch_array($resultdata)) {
                    ?>
                    <tbody>
                        <tr>
                            <td><b onclick="openModal(<?php echo $d['id_agent']; ?>)"><i class='fa fa-key' style='color:black;' aria-hidden='true'></i></b></td>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $d['tgl_login']; ?></td>
                            <td><?php echo $d['username_agent']; ?></td>
                            <td><?php echo $d['spare_time']; ?></td>
                            <td><?php echo $d['office_name']; ?></td>
                            <td><?php echo $d['approved_order']; ?></td>
                            <td><?php echo $d['spam_order']; ?></td>
                            <td><?php echo $d['bank_payment']; ?></td>
                            <td><?php echo $d['average_check']; ?></td>
                            <td><?php echo $d['callculation_approval']; ?></td>
                            <td><?php echo $d['approved_amount']; ?></td>
                            <td><?php echo $d['combo']; ?></td>
                            <td><?php echo $d['day_duration']; ?></td>
                            <td></td>
                            <td><?php echo $d['total_attempth']; ?></td>
                            <td><?php echo $d['tgl_login']; ?> </td>
                            <td>N/A</td>
                        </tr>
                    </tbody>
                    <?php
                }
            } else {
                ?>
                <tbody>
                    <tr>
                        <td colspan="18" style="text-align:center;">N/A</td>
                    </tr>
                </tbody>
                <?php
            }
        } else {
            ?>
            <tbody>
            </tbody>
            <?php
        }
    }
    ?>
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


              <div class="modal fade " id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">User Management</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <div class="container-fluid">
        <div class="row">

          
          <table style="border-collapse: collapse;width:100%;">
            <thead>
              <tr>
                <th style="font-weight:normal;width:25rem;padding: 0px 0px 20px;">Agent</th>
                <th style="font-weight:normal;padding: 0px 0px 20px;text-align:center;">Level</th>
                <th style="font-weight:normal;padding: 0px 15px 20px;text-align:center;">Data Type</th>
                <th style="font-weight:normal;padding: 0px 0px 20px;text-align:center">Label/Status</th>
              </tr>
            </thead>
            <?php
 include('koneksi/koneksi.php'); 
 $selectqueue = "SELECT * FROM stat_agent ";
 $resultqueue = mysqli_query($con, $selectqueue);
 while ( $d = mysqli_fetch_array($resultqueue)) {
?>
            <tbody>
              <tr>
                <td style="font-weight:bold;text-align:left;font-size:1.3rem;padding:10px 0px;"><?php echo $d['username_agent'];?></td>
                <td>
  <select name="" id="selectlevel_<?php echo $d['id_agent'];?>" onchange="updateLevel(<?php echo $d['id_agent'];?>)" class="form-control">
    <option value="<?php echo $d['level'];?>"><?php echo $d['level'];?></option>
    <option value="NWB">NWB</option>
    <option value="VIP">VIP</option>
    <option value="REGULER">REGULER</option>
  </select>
</td>
            <td style="padding: 10px 15px ;">
  <select name="" id="selectdata_<?php echo $d['id_agent'];?>" onchange="selectData(<?php echo $d['id_agent'];?>)" class="form-control">
    <option value="<?php echo $d['data_type'];?>"><?php echo $d['data_type'];?></option>
    <option value="PENDING">PENDING</option>
    <option value="HANDLING">HANDLING</option>
    <option value="REBILLS">REBILLS</option>
  </select>
</td>
                <td style="text-align:center; ">
            <?php if ($d['level'] === 'REGULER') {
              echo "<span class='badge bg-warning'>R</span>";
            } else if ($d['level'] === 'VIP') {
              echo "<span class='badge bg-primary'>V</span>";
            } else if ($d['level'] === 'NWB') {
              echo "<span class='badge bg-purple'>C</span>";
            }

            $allowed_status = array('0', '1', '2', '3', '4');
            if (in_array($d['id_statuse'], $allowed_status)) {
              echo "<span class='badge bg-success ml-3'>ON</span>";
            } else {
              echo "<span class='badge bg-danger ml-3'>OFF</span>";
            }
            ?>
          </td>
              </tr>
            </tbody>
            <?php } ?>
          </table>
           

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
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

<script src="JS/dashboard.js"></script>


<script>
    function addAgent() {
    const userName = document.getElementById('username').value;
    const passWord = document.querySelectorAll('#password').value;

        const formData = new FormData();
        formData.append('username', userName);
        formData.append('password', passWord);

        fetch('addagent.php', {
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
  text: "Add agent success",
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

    function editAgent() {
    const userName = document.getElementById('oldusername').value;
    const passWord = document.getElementById('newpassword').value;
    const idagent = document.getElementById('idagentnew').value;

        const formData = new FormData();
        formData.append('username', userName);
        formData.append('password', passWord);
        formData.append('idagent', idagent); 

        fetch('proseseditagent.php', {
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
  text: "Edit agent success",
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


    function updateLevel(idagentlevel) {
      const levels = document.getElementById('selectlevel_' + idagentlevel);
  const idagentlevels = idagentlevel;

  console.log(levels, idagentlevels);

  const formData = new FormData();
  formData.append('level', levels.value);
  formData.append('idagentlevel', idagentlevels);
  

        fetch('updatelevel.php', {
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
  text: "Change success",
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


    function selectData(idagentData) {
      const levels = document.getElementById('selectdata_' + idagentData);
  const idagentlevels = idagentData;


  const formData = new FormData();
  formData.append('data', levels.value);
  formData.append('idagentdata', idagentlevels);
  

        fetch('updatedata.php', {
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
  text: "Change success",
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


   
</script>



</body>
</html>






    
   



    <script>  
// Function to open the modal with content
function openModal(idparam) {
    var id_agent = idparam;

    $.ajax({
        url: 'editagent.php?id_agent=' + id_agent,
        type: 'GET',
        success: function(response) {
            $(".content-edit").html(response);
        },
        error: function() {
            // Handle errors if the AJAX request fails
            alert("Failed to load content.");
        }
    });
}
</script>

    <script>
        const popupformagent = document.querySelector('.popupformagent');
        const buttonPopup = document.getElementById('buttonpopup');

        buttonPopup.addEventListener("click", function () {
        popupformagent.style.display = 'flex';
        });

        function closeModalAdd() {
    popupformagent.style.display = "none";
}
    </script>
