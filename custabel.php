<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VEONZ | AGENT </title>
    <link rel="icon" href="img/icon.png" type="image/icon type">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
    body {
        font-family: "Gill Sans", sans-serif;
        overflow: hidden;
        background-color:#00000063;
    }

    .container {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color:black;
    }

    .boxhandle {
  position: relative;
    left: 300px;
    width: 650px;
    top: 125px;
    margin-top: 37px;
    background-color:white;
    height: 100%;
    display: flex;
    align-items: center;
    flex-direction: column;
    box-shadow: -5px 0 1px rgba(0, 0, 0, 0.822), 6px 0 1px rgba(0, 0, 0, 0.822), 0 -2px 1px rgba(0, 0, 0, 0.829), 0 2px 1px rgba(0, 0, 0, 0.829);
}

.persegi {
  height: 35px;
  width: 400px;
  color: white;
  background: linear-gradient(to right, #627fff, #1302ad);
  border-radius: 0px 20px 20px 0px;
  position: initial;
  font-weight: 700;
  align-items: center;
  text-align: left;
  display: flex;
  font-size: 13px;
  box-shadow: 3px 3px 3px black;
}

.bacper {
  background: linear-gradient(to right, #7c7c7c, #ffffff);
  position: relative;
  right: 60px;
  top: 10px;
  height: 35px;
  width: 550px;
  border-radius: 20px 0px 0px 20px;
}

.tb1 {
  color: white;
  border: 1px solid black;
  border-collapse: collapse;
  width: 95%;
  margin-top: 40px;
  font-size: 12px;
  margin-bottom: 165px;
}

.tb1 th {
  padding: 5px 10px;
  background: #c5c5c5cf;
  color: black;
  font-weight: 500;
  border: 1px solid black;
  border-collapse: collapse;
}

.tb1 tr {
  text-align: center;
  padding-left: 10px;
}

.tb1 td {
  padding: 5px 10px;
  background: white;
  color: black;
  border: 1px solid black;
  border-collapse: collapse;
  font-size: 13px;
}



    .switch {
        position: absolute;
    display: inline-block;
    width: 65px;
    height: 23px;
    z-index: 999;
    right: 17px;
    bottom: 19px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 19px;
        width: 24px;
        left: 4px;
        bottom: 2px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(34px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    .popup-container {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    .popup {
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        text-align: center;
        padding: 20px;
        width: 300px;
    }

    h2 {
        font-size: 20px;
        margin-bottom: 10px;
    }
    </style>
    <?php
    session_start();
// Check if the user is logged in
include('koneksi.php');
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === TRUE) {
    $username = $_SESSION['username_agent'];
    $id_operator = $_SESSION['id_agent'];
    $setstatus = 0;
    $session_id = $_SESSION['session_id'];

    


} else {
   echo '<script>alert("You are not logged in!"); window.location.href = "index.php" </script>';
   exit();
}
?>
</head>

<body>


<div class="boxhandle">
       <div class="bacper">
           <div class="persegi">
               <?php

$sql = "SELECT * FROM tb_agent WHERE id_agent = '$id_operator'";
$result = mysqli_query($con, $sql);

while ($d = mysqli_fetch_assoc($result)) {
?>
               <p style="margin-left:20px;">Dashboard/<?php echo $d['username'];?></p>
               <?php } ?>
           </div>
       </div>
       <?php
$operator = "SELECT * FROM stat_agent WHERE id_agent = '$id_operator'"; // Perhatikan perubahan di sini
$data = mysqli_query($con, $operator);
?>

       <table class="tb1">
           <tr>
               <th>Login IP</th>
               <th>Login Time</th>
               <th>Login Duration</th>
               <th>Submit Total</th>
               <th>Average Check</th>
               <th>Summary</th>
           </tr>
           <?php 
       while ($d = mysqli_fetch_assoc($data)) {  ?>
           <tr>
           <td>N/A</td>
           <td id='loginDuration'></td>
           <td> <?php echo $d['session_duration']; ?></td>
           <td> <?php echo $d['approved_order']; ?></td>
           <td>N/A</td>
           </tr>
      <?php } ?>
      
       </table>
       <p style="
    position: absolute;
    bottom: 5px;
    right: 94px;
">Online :</p>
       <label class="switch">
            <input type="checkbox" id="goOnlineButton" onclick="goOnline()">
            <span class="slider round"></span>
        </label>
        <p style="z-index:9999;position:absolute;font-size:22px;top: -7px;right: 35px;" id="countdown"></p>
   </div>
   
       

    
    
    <div class="popup-container" id="popup">
        <div class="popup">
            <h2>Break time is over</h2>
            <p>You will be redirected to the dashboard in 10 seconds.</p>
        </div>
    </div>




    <script>
    var timer; // Variabel untuk menyimpan timer
    var secondsRemaining; // Durasi timer dalam detik (diambil dari penyimpanan lokal)

    function updateCountdown() {
        var minutes = Math.floor(secondsRemaining / 60);
        var seconds = secondsRemaining % 60;

        var display = minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');

        var countelement = document.getElementById('countdown');
        countelement.textContent = display;

        if (secondsRemaining <= 0) {
            clearInterval(timer);

            // Tampilkan popup
            var popup = document.getElementById("popup");
            popup.style.display = "block";

            // Arahkan pengguna ke halaman dashboard.php setelah beberapa detik (opsional)
            setTimeout(function() {
                window.location.href = 'dashboard.php';
            }, 10000); // 10 detik
        }

        // Periksa jika sisa waktu kurang dari atau sama dengan 20 menit (1200 detik)
        if (secondsRemaining <= 1200) {
            countelement.style.color = 'red';
        }

        secondsRemaining--;
    }

    function sendDataToServer() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'breaktime.php?id_agent=<?php echo $id_operator; ?>&breaktime=' + secondsRemaining, true);
        xhr.send();
    }

    fetch('secondremaining.php') 
        .then(response => response.json())
        .then(data => {
            if (data.secondsRemaining) {
                secondsRemaining = parseInt(data.secondsRemaining);
                console.log(secondsRemaining);
            } else if (data.message) {
                console.log(data.message);
            }
        })
        .catch(error => {
            console.error('Terjadi kesalahan:', error);
        });

    function goOnline() {
        var xhr = new XMLHttpRequest();
        var url = "proses_go_online.php";
        var data = "id_operator=<?php echo $id_operator; ?>&id_statuse=0";
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert(xhr.responseText);
                window.location.href = 'dashboard.php';
            }
        };
        xhr.send(data);
        sendDataToServer();
    }

    // Memulai timer saat halaman dimuat
    timer = setInterval(function() {
        updateCountdown();
    }, 1000);

    // Tangani event sebelum pengguna meninggalkan halaman
    window.addEventListener('beforeunload', function(e) {
        clearInterval(timer);

    });
    </script>

    <script>

    function formatTime(seconds) {
        var hours = Math.floor(seconds / 3600);
        var minutes = Math.floor((seconds % 3600) / 60);
        var seconds = seconds % 60;

        return hours.toString().padStart(2, '0') + ':' +
            minutes.toString().padStart(2, '0') + ':' +
            seconds.toString().padStart(2, '0');
    }
    </script>
</body>

</html>