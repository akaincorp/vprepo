<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="navstyle.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<header>

    <body>
        <nav class="sidebar ">
            <div class="menu-bar">
                <div class="version">
                    <p>v1.02</p>
                </div>

                <div class="runningtext">
                    <marquee behavior="" direction="">
                        <?php
include('koneksi.php');
ini_set('display_errors','1');
$sql = "SELECT * FROM tb_agent WHERE id_agent = '$id_operator'";
$result = mysqli_query($con, $sql);

while ($d = mysqli_fetch_assoc($result)) {
?>
                        <input type="hidden" id="idAgent" value="<?php echo $d['id_agent'];?>">     
                        <p>Welcome <?php echo $d['username'];?></p>
                        <?php } ?>
                    </marquee>
                </div>



                <div class="navtop">
                    <div class="logo">
                        <img src="img/icon.png" alt="">
                    </div>

                    <div class="navtop-content">
                        <div class="agent">
                            <img src="img/agent.png" alt="">
                            <?php
include('koneksi.php');

$sql = "SELECT * FROM tb_agent WHERE id_agent = '$id_operator'";
$result = mysqli_query($con, $sql);

while ($d = mysqli_fetch_assoc($result)) {
?>
                            <h5><?php echo $d['username'];?></h5>
                            <?php } ?>
                        </div>

                        <div class="idr">
                            <img src="img/idr.png" alt="">
                            <h5>IDR</h5>
                        </div>

                        <div class="statistic">
                            <img src="img/statistic.png" alt="">
                            <?php
include('koneksi.php');

$sql = "SELECT * FROM stat_agent WHERE id_agent = '$id_operator'";
$result = mysqli_query($con, $sql);

while ($d = mysqli_fetch_assoc($result)) {
?>
                           <h5><?php echo $d['average_check'];?></h5>
<?php } ?>
                        </div>

                        <div class="office">
                            <img src="img/office.png" alt="">
                            <h5>Jakarta</h5>
                        </div>
                    </div>
                    <div class="clock">
                        <div id="clock"></div>
                    </div>
                    <div style="font-weight: 700; text-align: center;" class="dropdown-container">
                       <button class="dropdown-toggle" onclick="toggleDropdown()"><i class="fa-solid fa-restroom" style="color:white;"></i></button>
                        <div class="dropdown-list" id="dropdownList">
                            <select name="opstatus" id="opstatus" class="dropdown-list1">
                                <option> Away </option>
                                <?php
        include('koneksi.php');
        $query = mysqli_query($con,"SELECT * FROM tb_opstatus");
        while($d = mysqli_fetch_array($query)){
            echo "<option value='$d[id_statuse]'>$d[statuse]</option>";
        }
        ?>
                            </select>
                        </div>
                    </div>
                    <div class="signal">
                        <h5 class="textsignal">Signal<br>Strength</h5>
                        <div id="signal-strength"></div>
                    </div>

                    

                    <div class="signout">
                        <a href="logout.php"><button onclick="logOut()">Sign Out</button></a>
                    </div>
                </div>

                <div class="menu">

                    <?php
$sql = "SELECT COUNT(*) AS total FROM tb_handling WHERE id_status BETWEEN 1 AND 4";
$result = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($result);
$total = $data['total'];
?>
        <?php
  $sql = "SELECT * FROM tb_handling";
  $result = mysqli_query($con, $sql);
  
  // Inisialisasi variabel untuk menyimpan jumlah setiap nilai id_status
  $count_1 = 0;
  $count_2 = 0;
  $count_3 = 0;
  $count_4 = 0;

  while ($d = mysqli_fetch_assoc($result)) {
    // Menambahkan jumlah berdasarkan nilai id_status
    switch ($d['id_status']) {
      case 1:
        $count_1++;
        break;
      case 2:
        $count_2++;
        break;
      case 3:
        $count_3++;
        break;
      case 4:
        $count_4++;
        break;
      default:
        // Jika ada nilai id_status selain 0,1,2,3,4, maka abaikan atau lakukan sesuai kebutuhan.
        break;
    }
  }

  // Menampilkan hasil perhitungan
  ?>
        <div class="grid-container">
            <div class="grid-item" style="
    margin-top: 40px;
    height: 95px;
">
                <h3>CALLBACK (<?php echo $total;?> Items)</h3>
                <p>bad quality : <?php echo $count_1; ?></p>
                <p>client busy : <?php echo $count_2; ?></p>
                <p>cut the line : <?php echo $count_3; ?></p>
                <p>Reconfirm : <?php echo $count_4; ?></p>
            </div>










            <?php
$sql = "SELECT COUNT(*) AS total FROM tb_handling WHERE id_statusc BETWEEN 5 AND 8";
$result = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($result);
$total = $data['total'];
?>

            <?php
  $sql = "SELECT id_statusc FROM tb_handling ";
  $result = mysqli_query($con, $sql);
  
  // Inisialisasi variabel untuk menyimpan jumlah setiap nilai id_status
  $count_5 = 0;
  $count_6 = 0;
  $count_7 = 0;
  $count_8 = 0;

  while ($d = mysqli_fetch_assoc($result)) {
    // Menambahkan jumlah berdasarkan nilai id_status
    switch ($d['id_statusc']) {
      case 5:
        $count_5++;
        break;
      case 6:
        $count_6++;
        break;
      case 7:
        $count_7++;
        break;
      case 8:
        $count_8++;
        break;
      default:
        // Jika ada nilai id_status selain 0,1,2,3,4, maka abaikan atau lakukan sesuai kebutuhan.
        break;
    }
  }

  // Menampilkan hasil perhitungan
  ?>
            <div class="grid-item" style="
    height: 117px;
">
                <h3>NOT CONNECT (<?php echo $total;?> Items)</h3>
                <p>In messenger : <?php echo $count_5; ?></p>
                <p>Turned off phone : <?php echo $count_6; ?></p>
                <p>No answer : <?php echo $count_7; ?></p>
                <p>Number is busy : <?php echo $count_8; ?></p>
            </div>









            <?php
$sql = "SELECT COUNT(*) AS total FROM tb_handling WHERE id_statusb BETWEEN 9 AND 14";
$result = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($result);
$total = $data['total'];
?>
            <?php
  $sql = "SELECT id_statusb FROM tb_handling ";
  $result = mysqli_query($con, $sql);
  
  // Inisialisasi variabel untuk menyimpan jumlah setiap nilai id_status
  $count_9 = 0;
  $count_10 = 0;
  $count_11 = 0;
  $count_12 = 0;
  $count_13 = 0;
  $count_14 = 0;

  while ($d = mysqli_fetch_assoc($result)) {
    // Menambahkan jumlah berdasarkan nilai id_status
    switch ($d['id_statusb']) {
      case 9:
        $count_9++;
        break;
      case 10:
        $count_10++;
        break;
      case 11:
        $count_11++;
        break;
      case 12:
        $count_12++;
        break;
      case 13:
        $count_13++;
        break;
      case 14:
        $count_14++;
        break;
      default:
        // Jika ada nilai id_status selain 0,1,2,3,4, maka abaikan atau lakukan sesuai kebutuhan.
        break;
    }
  }

  // Menampilkan hasil perhitungan

  ?>
            <div class="grid-item" style="
    height: 130px;
">
                <h3>DISCLAIMER (<?php echo $total;?> Items)</h3>
                <p>Expensive : <?php echo $count_9; ?></p>
                <p>Want to consult : <?php echo $count_10; ?></p>
                <p>No delivery : <?php echo $count_11; ?></p>
                <p>Not 18 years old : <?php echo $count_12; ?></p>
                <p>Health issues : <?php echo $count_13; ?></p>
                <p>Can not sell : <?php echo $count_14; ?></p>
            </div>



            <?php
$sql = "SELECT COUNT(*) AS total FROM tb_handling WHERE id_statusf BETWEEN 18 AND 19";
$result = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($result);
$total = $data['total'];
?>

            <?php
  include('koneksi.php');
  $sql = "SELECT id_statusf FROM tb_handling ";
  $result = mysqli_query($con, $sql);
  
  // Inisialisasi variabel untuk menyimpan jumlah setiap nilai id_status
  $count_18 = 0;
  $count_19 = 0;

  while ($d = mysqli_fetch_assoc($result)) {
    // Menambahkan jumlah berdasarkan nilai id_status
    switch ($d['id_statusf']) {
      case 18:
        $count_18++;
        break;
      case 19:
        $count_19++;
        break;
      default:
        // Jika ada nilai id_status selain 0,1,2,3,4, maka abaikan atau lakukan sesuai kebutuhan.
        break;
    }
  }

  // Menampilkan hasil perhitungan
  ?>
            <div class="grid-item">
                <h3>Processing (<?php echo $total;?> Items)</h3>
                <p>Approved : <?php echo $count_18; ?></p>
                <p>Pending : <?php echo $count_19; ?></p>
            </div>









            <?php
$sql = "SELECT COUNT(*) AS total FROM tb_handling WHERE id_statusf BETWEEN 18 AND 19";
$result = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($result);
$total = $data['total'];
?>

            <?php
  include('koneksi.php');
  $sql = "SELECT id_statusf FROM tb_handling ";
  $result = mysqli_query($con, $sql);
  
  // Inisialisasi variabel untuk menyimpan jumlah setiap nilai id_status
  $count_18 = 0;
  $count_19 = 0;

  while ($d = mysqli_fetch_assoc($result)) {
    // Menambahkan jumlah berdasarkan nilai id_status
    switch ($d['id_statusf']) {
      case 18:
        $count_18++;
        break;
      case 19:
        $count_19++;
        break;
      default:
        // Jika ada nilai id_status selain 0,1,2,3,4, maka abaikan atau lakukan sesuai kebutuhan.
        break;
    }
  }

  // Menampilkan hasil perhitungan
  ?>
            <div class="grid-item">
                <h3>Sent &nbsp;(<?php echo $total;?> Items)</h3>
                <p>Sent : <?php echo $count_18; ?></p>
                <p>Sent after bank payment : <?php echo $count_19; ?></p>
            </div>





            <?php
$sql = "SELECT COUNT(*) AS total FROM tb_handling WHERE id_statusf BETWEEN 18 AND 19";
$result = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($result);
$total = $data['total'];
?>

            <?php
  $sql = "SELECT id_statusf FROM tb_handling ";
  $result = mysqli_query($con, $sql);
  
  // Inisialisasi variabel untuk menyimpan jumlah setiap nilai id_status
  $count_18 = 0;
  $count_19 = 0;

  while ($d = mysqli_fetch_assoc($result)) {
    // Menambahkan jumlah berdasarkan nilai id_status
    switch ($d['id_statusf']) {
      case 18:
        $count_18++;
        break;
      case 19:
        $count_19++;
        break;
      default:
        // Jika ada nilai id_status selain 0,1,2,3,4, maka abaikan atau lakukan sesuai kebutuhan.
        break;
    }
  }

  // Menampilkan hasil perhitungan
  ?>
            <div class="grid-item" style="
    height: 145px;
">
                <h3>Shipper (<?php echo $total;?> Items)</h3>
                <p>Delivered OK: <?php echo $count_18; ?></p>
                <p>Delivered Not OK : <?php echo $count_19; ?></p>
                <p>Bank payment : <?php echo $count_19; ?></p>
                <p>Declined by shipper : <?php echo $count_19; ?></p>
                <p>Delivered ok after : <?php echo $count_19; ?></p>
                <p>Paid : <?php echo $count_19; ?></p>
                <p>Return After Bank : <?php echo $count_19; ?></p>
            </div>




            <?php
$sql = "SELECT COUNT(*) AS total FROM tb_handling WHERE id_statusd BETWEEN 15 AND 17";
$result = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($result);
$total = $data['total'];
?>

            <?php
  $sql = "SELECT id_statusd FROM tb_handling ";
  $result = mysqli_query($con, $sql);
  
  // Inisialisasi variabel untuk menyimpan jumlah setiap nilai id_status
  $count_15 = 0;
  $count_16 = 0;
  $count_17 = 0;

  while ($d = mysqli_fetch_assoc($result)) {
    // Menambahkan jumlah berdasarkan nilai id_status
    switch ($d['id_statusd']) {
      case 15:
        $count_15++;
        break;
      case 16:
        $count_16++;
        break;
      case 17:
        $count_17++;
        break;
      default:
        // Jika ada nilai id_status selain 0,1,2,3,4, maka abaikan atau lakukan sesuai kebutuhan.
        break;
    }
  }

  // Menampilkan hasil perhitungan
  ?>
            <div class="grid-item" style="margin-bottom:90px;">
                <h3>SPAM (<?php echo $total;?> Items)</h3>
                <p>Not ordered : <?php echo $count_15; ?></p>
                <p>Double order : <?php echo $count_16; ?></p>
                <p>Spam : <?php echo $count_17; ?></p>
            </div>
        </div>
    </div>
                </div>
            </div>
        </nav>

        <div class="btnContainer" id="btnMenu">
        <?php
include('koneksi.php');
function encryptId($id) {
    return base64_encode($id);
}

$sql = "SELECT * FROM tb_customer JOIN tb_agent ON tb_customer.id_agent = tb_agent.id_agent WHERE tb_customer.id_agent = '$id_operator'";
$result = mysqli_query($con, $sql);

// Periksa apakah ada hasil dari query
if (mysqli_num_rows($result) > 0) {
    while ($d = mysqli_fetch_assoc($result)) {
?>

                                <button id="btnDashboardactive" onclick="displayDashboard()" ><i class="fa fa-dashboard"></i> Dashboard</button>
                                <button id="btnProduct" onclick="displayProduct()"   ><i class="fa fa-box"></i>&nbsp; Product</button>
                                <button id="btnHandling" onclick="displayHandling()" ><i class="fa fa-history"></i>&nbsp;Operator Comment</button>
                                <button id="btnOverview" onclick="displayOverview()" ><i class="fa-solid fa-file-lines"></i>&nbsp;&nbsp;Orders</button>

                    <?php
    }
} else {
?>

                                <button id="btnDashboard" onclick="displayDashboard()" disabled><i class="fa fa-dashboard"></i> Dashboard</button>
                                <button id="btnProduct" onclick="displayProduct()"   disabled><i class="fa fa-box"></i>&nbsp; Product</button>
                                <button id="btnHandling" onclick="displayHandling()"  disabled><i class="fa fa-history"></i>&nbsp;Operator Comment</button>
                                <button id="btnOverview" onclick="displayOverview()"  disabled><i class="fa-solid fa-file-lines"></i>&nbsp;&nbsp;Orders</button>
                    <?php } ?>
</div>


<?php 
    $resetquery = "SELECT * FROM stat_agent WHERE id_agent = '$id_operator'";
    $resultreset = mysqli_query($con, $resetquery);
    $d = $resultreset->fetch_assoc();
    $datedatabase = $d['tgl_login'];
    $datenow = date("Y-m-d");

    if ($datedatabase != $datenow) {

      $selectstat = "SELECT * FROM stat_agent WHERE id_agent = '$id_operator'";
      $resultselectstat = mysqli_query($con, $selectstat);

      while ($rowstat = mysqli_fetch_assoc($resultselectstat)) {
        
        $insertstat = "INSERT INTO tb_stat_history (id_agent, tgl_login, session_duration, day_duration, username_agent, office_name, approved_order, combo, total_attempth, average_check, callculation_approval, approved_amount, bank_payment, spare_time, spam_order) 
        VALUES ('{$rowstat['id_agent']}', '{$rowstat['tgl_login']}', '{$rowstat['session_duration']}', '{$rowstat['day_duration']}', '{$rowstat['username_agent']}', '{$rowstat['office_name']}', '{$rowstat['approved_order']}', '{$rowstat['combo']}', '{$rowstat['total_attempth']}', '{$rowstat['average_check']}', '{$rowstat['callculation_approval']}', '{$rowstat['approved_amount']}', '{$rowstat['bank_payment']}', '{$rowstat['spare_time']}', '{$rowstat['spam_order']}')";
        $resultinsert = mysqli_query($con, $insertstat);


      }

      $query2 = "UPDATE stat_agent SET tgl_login = '$datenow', day_duration = '00:00:00',spare_time = '4500', approved_order = '0', bank_payment = '0', combo = '0', total_attempth = '0', average_check = '0', callculation_approval = '0', spam_order = '0'  WHERE id_agent = '$id_operator'";
      $resultquery2 = mysqli_query($con, $query2);

    }

?>

        <script>
        // Fungsi untuk mengarahkan ke halaman custabel.php dan kirim data
        function redirectToCustabel() {
            const selectedValue = document.getElementById('opstatus').value;
            window.location.href = `prosesstatusop.php?status=${selectedValue}`;
        }

        // Tambahkan peristiwa onChange ke elemen select
        document.getElementById('opstatus').addEventListener('change', redirectToCustabel);
        </script>
        <script>
        function updateSignalStrength() {
            if ("connection" in navigator) {
                const connection = navigator.connection;
                const signalStrength = connection
                    .rtt; // Mendapatkan nilai ping (Round Trip Time) sebagai indikasi kekuatan sinyal

                if (signalStrength === 0 || isNaN(signalStrength)) {
                    document.getElementById("signal-strength").innerHTML =
                        `<img class="imgsignal" src="img/wifislash.png">`;
                } else {
                    document.getElementById("signal-strength").innerHTML =
                        `<img class="imgsignal" src="img/goodwifi.png">`;
                }
            } else {
                document.getElementById("signal-strength").textContent = "Kekuatan Sinyal: Tidak Dapat Diakses";
            }
        }

        // Perbarui kekuatan sinyal secara berkala (contoh: setiap 5 detik).
        setInterval(updateSignalStrength, 1000);

        // Inisialisasi awal
        updateSignalStrength();
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
        let dropdownList = document.getElementById("dropdownList");
        let dropdownSelect = document.getElementById("dropdownSelect");

        function toggleDropdown() {
            dropdownList.classList.toggle("show");
        }

        function selectOption(option) {
            if (option === "away") {
                dropdownSelect.style.display = "block";
            } else {
                dropdownSelect.style.display = "none";
            }

        }
        </script>





    </body>

</html>