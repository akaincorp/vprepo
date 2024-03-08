<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/2a43e575e3.js" crossorigin="anonymous"></script>
    <title>VEONZ | AGENT</title>
    <link rel="icon" href="img/icon.png" type="image/icon type">
    <?php
    session_start();
// Check if the user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === TRUE) {
    $username = $_SESSION['username_agent'];
    $id_operator = $_SESSION['id_agent'];
} else {
   echo '<script>alert("login terlebih dahulu !"); window.location.href = "index.php" </script>';
   exit();
}
?>
    <style>
    body {
        font-family: "Gill Sans", sans-serif;
        background-color: #adb9ff;
    }

    .tb1 {
        color: #000000cf;
        background-color: #5f78ffcf;
        border: #5f78ffcf 2px;
        width: 100%;


    }

    .tb1 th {
        padding: 15px 15px;
        background: #5f78ffcf;
        color: white;
    }

    .buttonmodalproduct {
        width: 100px;
        float: left;
        background: #5f78ffcf;
        color: white;
        padding: 6px;
        margin-right: 10px;
        border-radius: 4px;
    }

    .tb1 tr {
        text-align: center;
        padding-left: 20px;
    }

    .tb1 td {
        padding: 4px 20px;
        background: white;
        color: black;
    }

    .border1 {
        border-color: #5f78ffcf;
        border-style: ridge;
        padding: 10px;
        width: 1030px;
        margin-top: 5%;
        height: auto;
        margin-left: 300px;
    }

    .border3 {
        border-color: #5f78ffcf;
        border-style: ridge;
        padding: 10px;
        width: 1030px;
        margin-top: 10%;
        height: 65px;
        margin-left: 300px;
        margin-bottom: 90px;
    }

    .selectstatus1 {
        width: 100px;
        float: right;
        background: #5f78ffcf;
        color: white;
        padding: 6px;
        margin-right: 22px;
        border-radius: 4px;
    }

    .selectstatus1:hover {
        background-color: #5d5da2;
        margin-bottom: 10px;
        border-radius: 5px;
        transition: 0.3s ease;
    }

    .upd1 {
        width: 115px;
        float: right;
        background: #5f78ffcf;
        color: white;
        padding: 6px;
        margin-right: 10px;
        border-radius: 4px;
    }

    .upd1:hover {
        background-color: #5d5da2;
        margin-bottom: 10px;
        border-radius: 5px;
        transition: 0.3s ease;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        border-color: white;
        border: 1px saddlebrown;
        background: transparent;
    }

    .modalinput3 {
        border-radius: 5px;
        border-color: black;
        width: 185px;
        padding: 6px;
    }

    .btnmodal3 {
        margin-left: 65px;
        margin-top: 20px;
        border-color: #5f78ffcf;
        background-color: #5f78ffcf;
        border-radius: 5px;
        width: 130px;
        padding: 5px;
        color: white;
    }

    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        z-index: 1000;
    }

    /* Modal */
    .modal {
        width: 300px;
        max-width: 90%;
        background-color: #fff;
        margin: 10% auto;
        border-radius: 5px;
        padding: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-close {
        cursor: pointer;
        background: transparent;
        border: none;
        font-size: 20px;
        padding: 0;
    }

    .modal-body {
        padding: 15px;
    }
    </style>
</head>

<body>
    <?php
    include('navbar.php');
    ?>
    <?php
    include('koneksi.php');
    $sql = "SELECT * FROM tb_customer";
    $result = mysqli_query($con,$sql);

    
?>
    <div class="border1">
        <table border="1" class="tb1">
            <tr>
                <th>Date</th>
                <th>Comment</th>
                <th>action</th>
            </tr>
            <?php
    while ($d = mysqli_fetch_assoc($result)){
?>
            <tr>
                <td><?php echo $d['date_comment'];?></td>
                <td><?php echo $d['operator_comment'];?></td>
                <td><button class="copy-btn"
                        data-clipboard="<?php echo $d['date_comment'];?>, <?php echo $d['operator_comment']; ?>"><i
                            class="fas fa-copy"></i></button></td>
            </tr>
            <tr>
                <td><?php echo $d['date_comment2'];?></td>
                <td><?php echo $d['operator_comment2'];?></td>
                <td><button class="copy-btn"
                        data-clipboard="<?php echo $d['date_comment2'];?>, <?php echo $d['operator_comment2']; ?>"><i
                            class="fas fa-copy"></i></button></td>
            </tr>
            <tr>
                <td><?php echo $d['date_comment3'];?></td>
                <td><?php echo $d['operator_comment3'];?></td>
                <td><button class="copy-btn"
                        data-clipboard="<?php echo $d['date_comment3'];?>, <?php echo $d['operator_comment3']; ?>"><i
                            class="fas fa-copy"></i></button></td>
            </tr>
            <tr>
                <td><?php echo $d['date_comment4'];?></td>
                <td><?php echo $d['operator_comment4'];?></td>
                <td><button class="copy-btn"
                        data-clipboard="<?php echo $d['date_comment4'];?>, <?php echo $d['operator_comment4']; ?>"><i
                            class="fas fa-copy"></i></button></td>
            </tr>
            <?php
    }?>
        </table>
    </div>
    <?php
// Pastikan koneksi ke database sudah dilakukan
include 'koneksi.php';

// Mengambil nilai id_customer dari parameter di URL


// Buat query untuk mengambil data produk dan informasi pelanggan berdasarkan ID pelanggan
$customer = "SELECT * 
             FROM tb_customer
             JOIN tb_notconnect ON tb_customer.id_statusc = tb_notconnect.id_statusc
          JOIN tb_callback ON tb_customer.id_status = tb_callback.id_status
          JOIN tb_disclaimer ON tb_customer.id_statusb = tb_disclaimer.id_statusb
          JOIN tb_spam ON tb_customer.id_statusd = tb_spam.id_statusd
             WHERE tb_customer.id_customer";

$result = mysqli_query($con, $customer);
?>
    <?php
$lastCustomerId = null; // Initialize a variable to track the last displayed id_customer
while ($d = mysqli_fetch_assoc($result)) {
?>






    <form method="post" action="updatestatusluar.php">
        <input type="hidden" name="id" value="<?php echo $d['id_customer'];?>">
        <?php 	}?>
        <div class="border3">
            <input type="submit" class="upd1" name="update" value="update">
            <select name="spam" class="selectstatus1">
                <option id="option1"></option>
                <?php
                include('koneksi.php');
                $query = mysqli_query($con,"SELECT * FROM tb_spam");
                while($d = mysqli_fetch_array($query)){
                  echo "<option value=$d[id_statusd]> $d[statusd]</option>";
                }
                ?>
            </select>
            <select name="disclaimer" class="selectstatus1">
                <option id="option2"></option>
                <?php
                include('koneksi.php');
                $query = mysqli_query($con,"SELECT * FROM tb_disclaimer");
                while($d = mysqli_fetch_array($query)){
                  echo "<option value=$d[id_statusb]> $d[statusb]</option>";
                }
                ?>
            </select>
            <select name="callback" id="reminders" onchange="showPopup()" class="selectstatus1">
                <option id="option3"></option>
                <?php
                include('koneksi.php');
                $query = mysqli_query($con,"SELECT * FROM tb_callback");
                while($d = mysqli_fetch_array($query)){
                  echo "<option value=$d[id_status]> $d[status]</option>";
                }
                ?>
            </select>
            <select name="notconnect" class="selectstatus1">
                <option id="option4"></option>
                <?php
                include('koneksi.php');
                $query = mysqli_query($con,"SELECT * FROM tb_notconnect");
                while($d = mysqli_fetch_array($query)){
                  echo "<option value=$d[id_statusc]> $d[statusc]</option>";
                }
                ?>
            </select>

            <select name="opstatus" id="opstatus" class="selectstatus1">
                <option> Online </option>
                <?php
                include('koneksi.php');
                $query = mysqli_query($con,"SELECT * FROM tb_opstatus");
                while($d = mysqli_fetch_array($query)){
                  echo "<option value=$d[id_statuse]> $d[statuse]</option>";
                }
                ?>
            </select>
    </form>
    <?php
include 'koneksi.php';
$customer = "SELECT * 
             FROM tb_customer";
             

$result = mysqli_query($con, $customer);
?>
    <?php
$lastCustomerId = null; 
while ($d = mysqli_fetch_assoc($result)) {
?>
    <form action='approve.php' method='post' autocomplete='off'>
        <input type="hidden" name="id_customer" value=" <?php echo $d['id_customer']; ?>">
        <input type="hidden" name="id_order" value=" <?php echo $d['order_id']; ?>">
        <input type="hidden" name="order_date" value=" <?php echo $d['order_date']; ?>">
        <input type="hidden" name="operator_comment" value=" <?php echo $d['operator_comment']; ?>">
        <input type="hidden" name="date_comment" value=" <?php echo $d['date_comment']; ?>">
        <input type="hidden" name="bankpayment" value=" <?php echo $d['bank_payment']; ?>">
        <input type="hidden" name="promo" value=" <?php echo $d['promo']; ?>">
        <input type="hidden" name="nama_product" value="<?php echo $d['nama_product']; ?>">
        <input type="hidden" name="description" value="<?php echo $d['description']; ?>">
        <input type="hidden" name="package" value="<?php echo $d['package']; ?>">
        <input type="hidden" name="shipment_type" value=" <?php echo $d['shipment_type']; ?>">
        <input type="hidden" name="amount" value="<?php echo $d['amount']; ?>">
        <input type="hidden" name="price" value=" <?php echo $d['price']; ?>">
        <input type="hidden" name="total" value=" <?php echo $d['total']; ?>">
        <input type="hidden" name="first_name" value=" <?php echo $d['first_name']; ?>">
        <input type="hidden" name="last_name" value=" <?php echo $d['last_name']; ?>">
        <input type="hidden" name="phone" value=" <?php echo $d['phone']; ?>">
        <input type="hidden" name="country" value=" <?php echo $d['country']; ?>">
        <input type="hidden" name="timezone" value=" <?php echo $d['timezone']; ?>">
        <input type="hidden" name="addrest_list" value=" <?php echo $d['addrest_list']; ?>">
        <input type="hidden" name="state" value=" <?php echo $d['state']; ?>">
        <input type="hidden" name="city" value=" <?php echo $d['city']; ?>">
        <input type="hidden" name="zip" value=" <?php echo $d['zip']; ?>">
        <input type="hidden" name="shipper" value=" <?php echo $d['shipper']; ?>">
        <input type="hidden" name="date" value=" <?php echo $d['order_date']; ?>">
        <input type="hidden" name="gender" value=" <?php echo $d['gender']; ?>">
        <input type="hidden" name="email" value=" <?php echo $d['email']; ?>">
        <input type="hidden" name="age" value=" <?php echo $d['age']; ?>">
        <input type="hidden" name="height" value=" <?php echo $d['height']; ?>">
        <input type="hidden" name="Chronic_disease" value=" <?php echo $d['Chronic_disease']; ?>">
        <input type="hidden" name="married" value=" <?php echo $d['married']; ?>">
        <input type="hidden" name="Children" value=" <?php echo $d['children']; ?>">
        <input type="hidden" name="id_status" value=" <?php echo $d['id_status']; ?>">
        <input type="hidden" name="id_statusb" value=" <?php echo $d['id_statusb']; ?>">
        <input type="hidden" name="id_statusc" value=" <?php echo $d['id_statusc']; ?>">
        <input type="hidden" name="id_statusd" value=" <?php echo $d['id_statusd']; ?>">
        <?php } ?>
        <input type="hidden" name="id_statusf" value="18">
        <input type='submit' name='reg' value='approve' class='buttonmodalproduct'>
    </form>
    </div>
    <?php
// Pastikan koneksi ke database sudah dilakukan
include 'koneksi.php';

// Mengambil nilai id_customer dari parameter di URL


// Buat query untuk mengambil data produk dan informasi pelanggan berdasarkan ID pelanggan
$customer = "SELECT * 
             FROM tb_customer";
             

$result = mysqli_query($con, $customer);
?>
    <?php
$lastCustomerId = null; // Initialize a variable to track the last displayed id_customer
while ($d = mysqli_fetch_assoc($result)) {
?>
    <div class="container mt-4">
        <!-- Rest of the code remains the same -->
        <!-- Modal structure -->
        <div class="modal-overlay" id="modalOverlay">
            <div class="modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDetailsModalLabel">Add Reminder</h5>
                    <button type="button" class="close" id="modalClose">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- Modal form -->
                    <form action='addreminder.php' method='post' autocomplete='off'>
                        <div class="form-group">
                            <input type="hidden" name="id_customer" value=" <?php echo $d['id_customer']; ?>">
                            <input type="hidden" name="id_order" value=" <?php echo $d['id_order']; ?>">
                            <input type="hidden" name="order_date" value=" <?php echo $d['order_date']; ?>">
                            <input type="hidden" name="operator_comment" value=" <?php echo $d['operator_comment']; ?>">
                            <input type="hidden" name="date_comment" value=" <?php echo $d['date_comment']; ?>">
                            <input type="hidden" name="bankpayment" value=" <?php echo $d['bankpayment']; ?>">
                            <input type="hidden" name="promo" value=" <?php echo $d['promo']; ?>">
                            <input type="hidden" name="nama_product" value="<?php echo $d['nama_product']; ?>">
                            <input type="hidden" name="description" value="<?php echo $d['description']; ?>">
                            <input type="hidden" name="package" value="<?php echo $d['package']; ?>">
                            <input type="hidden" name="shipment_type" value=" <?php echo $d['shipment_type']; ?>">
                            <input type="hidden" name="amount" value="<?php echo $d['amount']; ?>">
                            <input type="hidden" name="price" value=" <?php echo $d['price']; ?>">
                            <input type="hidden" name="total" value=" <?php echo $d['total']; ?>">
                            <input type="hidden" name="first_name" value=" <?php echo $d['first_name']; ?>">
                            <input type="hidden" name="last_name" value=" <?php echo $d['last_name']; ?>">
                            <input type="hidden" name="phone" value=" <?php echo $d['phone']; ?>">
                            <input type="hidden" name="country" value=" <?php echo $d['country']; ?>">
                            <input type="hidden" name="timezone" value=" <?php echo $d['timezone']; ?>">
                            <input type="hidden" name="addrest_list" value=" <?php echo $d['addrest_list']; ?>">
                            <input type="hidden" name="state" value=" <?php echo $d['state']; ?>">
                            <input type="hidden" name="city" value=" <?php echo $d['city']; ?>">
                            <input type="hidden" name="zip" value=" <?php echo $d['zip']; ?>">
                            <input type="hidden" name="shipper" value=" <?php echo $d['shipper']; ?>">
                            <input type="hidden" name="date" value=" <?php echo $d['date']; ?>">
                            <input type="hidden" name="gender" value=" <?php echo $d['gender']; ?>">
                            <input type="hidden" name="email" value=" <?php echo $d['email']; ?>">
                            <input type="hidden" name="age" value=" <?php echo $d['age']; ?>">
                            <input type="hidden" name="height" value=" <?php echo $d['height']; ?>">
                            <input type="hidden" name="Chronic_disease" value=" <?php echo $d['Chronic_disease']; ?>">
                            <input type="hidden" name="married" value=" <?php echo $d['married']; ?>">
                            <input type="hidden" name="Children" value=" <?php echo $d['children']; ?>">
                            <input type="hidden" name="id_status" value=" <?php echo $d['id_status']; ?>">
                            <input type="hidden" name="id_statusb" value=" <?php echo $d['id_statusb']; ?>">
                            <input type="hidden" name="id_statusc" value=" <?php echo $d['id_statusc']; ?>">
                            <input type="hidden" name="id_statusd" value=" <?php echo $d['id_statusd']; ?>">

                            <input type="hidden" class="form-control" name='name'
                                value=" <?php echo $d['first_name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <input type="datetime-local" class="modalinput3" name='date_reminders' required>
                        </div>
                        <div class="form-group">
                            <input type='submit' name='reg' value='Submit' class='btnmodal3'>
                        </div>
                    </form>
                    <?php } ?>
                    <script>
                    function showPopup() {
                        var selectedValue = document.getElementById('reminders').value;
                        console.log(selectedValue); // Debug: Cetak nilai selectedValue ke konsol
                        var modalOverlay = document.getElementById('modalOverlay');
                        var modalClose = document.getElementById('modalClose');

                        if (selectedValue === '2') {
                            modalOverlay.style.display = 'block';
                            document.getElementById('reminders').value = '2'; // Setel ke opsi default
                        } else {
                            modalOverlay.style.display = 'none';
                        }

                        // Close modal when clicked on close button
                        modalClose.onclick = function() {
                            modalOverlay.style.display = 'none';
                        };
                    }
                    </script>
                    <script>
                    function closePopup() {
                        document.getElementById('reminderPopup').style.display = 'none';
                    }

                    function showPopup1() {
                        document.getElementById('reminderPopup').style.display = 'block';
                    }
                    </script>
                    <script>
                    function goToCustomer() {
                        // Redirect to the "customer.php" page when the button is clicked
                        window.location.href = "operatorcomment.php";
                    }
                    </script>
                    <script>
                    document.getElementById("option1").innerHTML = "Spam";
                    document.getElementById("option2").innerHTML = "Disclaimer";
                    document.getElementById("option3").innerHTML = "Callback";
                    document.getElementById("option4").innerHTML = "Not Connect";
                    </script>
                    <script>
                    // Ambil semua tombol dengan class 'copy-btn'
                    const copyButtons = document.querySelectorAll('.copy-btn');

                    // Tambahkan event listener untuk setiap tombol
                    copyButtons.forEach(button => {
                        button.addEventListener('click', () => {
                            // Ambil nilai komentar dari atribut data-clipboard
                            const comment = button.getAttribute('data-clipboard');

                            // Salin nilai komentar ke clipboard
                            copyToClipboard(comment);

                            // Berikan pesan bahwa komentar telah disalin
                            alert('Komentar telah disalin: ' + comment);
                        });
                    });

                    // Fungsi untuk menyalin teks ke clipboard
                    function copyToClipboard(text) {
                        const tempInput = document.createElement('textarea');
                        tempInput.value = text;
                        document.body.appendChild(tempInput);
                        tempInput.select();
                        document.execCommand('copy');
                        document.body.removeChild(tempInput);
                    }
                    </script>
                    <script>
                    function goToCustomer() {
                        // Redirect to the "customer.php" page when the button is clicked
                        window.location.href = "product.php";
                    }
                    </script>
</body>

</html>