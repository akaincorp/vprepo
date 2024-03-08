<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="CSS/navstyle.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<header>

    <body>
        <div class="navtop">
            <div class="logo">
                <img src="../img/icon.png" alt="">
            </div>

            <div class="navtop-content">
                <div class="agent">
                    <img src="../img/agent.png" alt="">
                    <?php
include('koneksi/koneksi.php');

$sql = "SELECT * FROM tb_leader WHERE id_leader = '$id_leader'";
$result = mysqli_query($con, $sql);

while ($d = mysqli_fetch_assoc($result)) {
?>       
                    <h5><?php echo $d['username'];?></h5>
                    <?php } ?>
                </div>

                <div class="idr">
                    <img src="../img/idr.png" alt="">
                    <h5>IDR</h5>
                </div>

                <div class="statistic">
                    <img src="../img/statistic.png" alt="">
                    <h5>N/A</h5>
                </div>

                <div class="office">
                    <img src="../img/office.png" alt="">
                    <h5>Jakarta</h5>
                </div>
            </div>
            <div class="clock">
                <div id="clock"></div>
            </div>
            <div style="font-weight: 700; text-align: center;" class="dropdown-container">
                <div class="dropdown-toggle" onclick="toggleDropdown()">Menu <img src="../img/panahbawah.png"
                        width="10px">
                </div>
                <div class="dropdown-list" id="dropdownList">
                    <ul style="list-style-type:none;" onclick="togglesubmenu()">
                        <li>Away</li>
                    </ul>    
                </div>
                <ul style="list-style-type:none;">
                    <li><select name="opstatus" id="opstatus" class="dropdown-list1">
                        <?php
        include('koneksi/koneksi.php');
        $query = mysqli_query($con,"SELECT * FROM tb_opstatus");
        while($d = mysqli_fetch_array($query)){
            echo "<option value='$d[id_statuse]'>$d[statuse]</option>";
        }
        ?>
                    </select></li>
                </ul>
            </div>
            <div class="signal">
                <h5 class="textsignal">Signal<br>Strength</h5>
                <div id="signal-strength"></div>
            </div>

            <div class="signout">
                <a href="logout.php"><button>Sign Out</button></a>
            </div>
        </div>


        <div class="version">
            <h5>v1.02</h5>
        </div>

        <div class=" navdown  pullUp">
            <a href="dashboard.php">
            <img src="../img/home.png" width="15" style="position: relative;top: 2px;">&nbsp;  Dashboard
            </a>

            <a href="detailstatistic.php">
            <img src="../img/bar-chart.png" width="15" style="position: relative;top: 2px;">&nbsp;&nbsp;Statistic
            </a>


            <a href="queue.php">
               <img src="../img/customer-service.png" width="15" style="position: relative;top: 3px;">&nbsp; Queue
            </a>


            <a href="quesort.php">
            <img src="../img/queue.png" width="18" style="position: relative;top: 5px;">&nbsp; Queue Sort Order
            </a>


            <a href="handling.php">
            <img src="../img/business.png" width="17" style="position: relative;top: 4px;">&nbsp;  Handling
            </a>


            <a href="outstanding.php">
            <img src="../img/shipping.png" width="16" style="position: relative;top: 3px;">&nbsp;  Outstanding
            </a>


            <a href="delivery.php">
            <img src="../img/delivery.png" width="20" style="position: relative;top: 5px;">&nbsp;  Delivery
            </a>
            
            <a href="rebills.php">
            <img src="../img/validating-ticket.png" width="20" style="position: relative;top: 5px;">&nbsp;  Rebills
            </a>


            <a href="videospy.php">
            <img src="../img/video-call.png" width="18" style="position: relative;top: 3px;">&nbsp;    Video Spy
            </a>


            <a href="callcontrol.php">
            <img src="../img/call.png" width="18" style="position: relative;top: 5px;">&nbsp;    Call Control
            </a>



            <a href="trash.php" style="border-right:none;">
            <img src="../img/bin.png" width="15" style="position: relative;top: 2.5px;">&nbsp;    Trash
            </a>

        </div>
        </div>





        <script>
        // Fungsi untuk mengarahkan ke halaman custabel.php dan kirim data
        function redirectToCustabel() {
            const selectedValue = document.getElementById('opstatus').value;
            window.location.href = `prosesstatusleader.php?status=${selectedValue}`;
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
                        `<img class="imgsignal" src="../img/wifislash.png">`;
                } else {
                    document.getElementById("signal-strength").innerHTML =
                        `<img class="imgsignal" src="../img/goodwifi.png">`;
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
    let dropdownsubmenu = document.getElementById("opstatus");
    let dropdownSelect = document.getElementById("dropdownSelect");

    function toggleDropdown() {
        dropdownList.classList.toggle("show");
        
        if (dropdownsubmenu.classList.contains("show")) {
            dropdownsubmenu.classList.toggle("show");
        }
    }

    function togglesubmenu() {
        dropdownsubmenu.classList.toggle("show");
        let opstatus = document.getElementById("opstatus");
        opstatus.size = opstatus.options.length; // Mengatur size sesuai jumlah opsi
    }
</script>





    </body>

</html>