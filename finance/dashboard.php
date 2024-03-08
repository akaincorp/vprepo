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
  <link rel="stylesheet" href="app/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="app/dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="app/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="app/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="app/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="app/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

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
  


    <title> Finance • VEON</title>
    <link rel="icon" href="../img/iconnew.png" type="image/icon type">
</head>
<body class="sidebar-collapse layout-top-nav  sidebar-closed layout-navbar-fixed layout-fixed">

<?php
    session_start();
include('../leader/koneksi/koneksi.php');
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === TRUE) {
    $username_finance = $_SESSION['username_finance'];
    $id_finance = $_SESSION['id_finance'];
} else {
  echo '
    <script src="app/plugins/sweetalert2/sweetalert2.min.js"></script>
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
$sql = "SELECT * FROM tb_finance WHERE id_finance = '$id_finance'";
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

$sql = "SELECT * FROM tb_finance WHERE id_finance = '$id_finance'";
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
            <a href="app/iframe.html" class="nav-link">
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


          <?php
$outstanding = "SELECT *, SUM(total) AS totalall FROM tb_outstanding";    
$resultout = mysqli_query($con, $outstanding);

while ($d = mysqli_fetch_assoc($resultout)) {
    $totalall = number_format($d['totalall'], 3, '.', '.');
}

$delivery = "SELECT *, SUM(total) AS totalapproved FROM tb_delivery WHERE id_statusf = '24'";    
$resultdel = mysqli_query($con, $delivery);

while ($e = mysqli_fetch_assoc($resultdel)) {
    $totalapproved = number_format($e['totalapproved'], 3, '.', '.');
}

$deliveryrejected = "SELECT *, SUM(total) AS totalrejected FROM tb_delivery WHERE id_statusf IN ('23','22')";    
$resultrejected = mysqli_query($con, $deliveryrejected);

while ($f = mysqli_fetch_assoc($resultrejected)) {
    $totalrejected = number_format($f['totalrejected'], 3, '.', '.');
}

$bankpaymentwait = "SELECT *, SUM(total) AS totalbankpayment FROM tb_outstanding WHERE bank_payment = 'BPW'";    
$resultbank = mysqli_query($con, $bankpaymentwait);

while ($g = mysqli_fetch_assoc($resultbank)) {
    $totalbank = number_format($g['totalbankpayment'], 3, '.', '.');
}


?>
   


            <div class="card card-primary card-outline card-outline-tabs p-3">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" href="dashboard.php"  aria-selected="true">Dashboard</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="groupreport.php"  aria-selected="false">Group Report</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="outstanding.php" aria-selected="false">Outstanding</a>
                  </li>
                  <li class="nav-item">
                    <a href="campaign.php" class="nav-link" aria-selected="false">Campaign</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">

              
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Approved (IDR)</th>
                        <th>Rejected (IDR)</th>
                        <th>Processing (IDR)</th>
                        <th>Bank Payment (IDR) </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $totalapproved ?></td>
                        <td><?php echo $totalrejected ?></td>
                        <td><?php echo $totalall ?></td>
                        <td><?php echo $totalbank ?></td>
                    </tr>
                </tbody>
            </table>


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
<script src="app/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="app/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="app/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="app/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="app/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="app/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="app/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="app/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="app/plugins/jszip/jszip.min.js"></script>
<script src="app/plugins/pdfmake/pdfmake.min.js"></script>
<script src="app/plugins/pdfmake/vfs_fonts.js"></script>
<script src="app/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="app/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="app/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="app/dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="app/plugins/sweetalert2/sweetalert2.min.js"></script>

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

