<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Agent • VEON</title>
    <link rel="icon" href="img/iconnew.png" type="image/icon type">
    <script src="https://kit.fontawesome.com/2a43e575e3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/stylehandling.css">
    <?php
    session_start();
// Check if the user is logged in
include('koneksi.php');
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === TRUE) {
    $username = $_SESSION['username_agent'];
    $id_operator = $_SESSION['id_agent'];
    $login_time = $_SESSION['login_time'];
    $setstatus = 0;
    $session_id = $_SESSION['session_id'];

    
    // Close the database connection
    $con->close();

} else {
    echo '
    <script> window.location.href = "notlogin.php" </script>';
    exit();
}
?>
    <?php 
  include('navbar.php');
  ?>
</head>
<div class="boxhandle">
    <div class="bacper">
        <div class="persegi">
            <p style="margin-left:20px;">Handling history</p>
        </div>
    </div>

    <?php
include('koneksi.php');
$no = 1;
$id_customer_encrypted = $_GET['id_customer'];
$id_customer = base64_decode($id_customer_encrypted);
$operator = "SELECT * FROM history_agent 
    JOIN tb_agent ON history_agent.id_agent = tb_agent.id_agent
    JOIN tb_callback ON history_agent.id_status = tb_callback.id_status
    JOIN tb_notconnect ON history_agent.id_statusc = tb_notconnect.id_statusc
    JOIN tb_disclaimer ON history_agent.id_statusb = tb_disclaimer.id_statusb
    JOIN tb_spam ON history_agent.id_statusd = tb_spam.id_statusd
    WHERE history_agent.id_customer = '$id_customer' ORDER BY history_agent.date_comment DESC LIMIT 1"; // Perhatikan perubahan di sini
$datatop = mysqli_query($con, $operator);
?>


<?php if (mysqli_num_rows($datatop) == 0) { ?>
    <?php
        include ('koneksi.php');
$customer = "SELECT * FROM tb_customer WHERE id_agent = '$id_operator'";
$result = mysqli_query($con, $customer);
while ($data = mysqli_fetch_assoc($result)) { ?>
    <p class='ordertime' style='text-align:center;'>Order Time : <br><?php echo $data['order_date']; ?></p>
    <div class="containertop">
        <h5 class='handling'>Handling : </h5>
        <h5 class='groups'>Groups : <b><?php echo $data['promo'] ?></b></h5>
        <h5 style="display: inline-block;
    font-size: 13px;
    font-weight: 500;
    position: relative;
    bottom: 0px;
    left: -255px;">Order Number : <b><?php echo $data['order_id'] ?></b></h5>
        <?php }?>
        <?php } else { ?>          
    <?php while ($d1 = mysqli_fetch_array($datatop)) { ?>

        <p class='ordertime' style='text-align:center;'>Order Time : <br><?php echo $d1['order_date']; ?> </p>
    <div class="containertop">
        <h5 class='handling'>Handling : <b><?php echo $d1['status'];?> <?php echo $d1['statusb'];?>
                <?php echo $d1['statusc']; ?> </b></h5>
        <h5 class='groups'>Groups : <b><?php echo $d1['promo'] ?></b></h5>
        <h5 class='ordernumber'>Order Number : <b><?php echo $d1['order_id'] ?></b></h5>

        <?php } ?>
<?php } ?>
    </div>


    <?php
include('koneksi.php');
$no = 1;
$id_customer_encrypted = $_GET['id_customer'];
$id_customer = base64_decode($id_customer_encrypted);
$operator = "SELECT * FROM history_agent 
    JOIN tb_agent ON history_agent.id_agent = tb_agent.id_agent
    JOIN tb_callback ON history_agent.id_status = tb_callback.id_status
    JOIN tb_notconnect ON history_agent.id_statusc = tb_notconnect.id_statusc
    JOIN tb_disclaimer ON history_agent.id_statusb = tb_disclaimer.id_statusb
    JOIN tb_spam ON history_agent.id_statusd = tb_spam.id_statusd
    WHERE history_agent.id_customer = '$id_customer'"; // Perhatikan perubahan di sini
$data = mysqli_query($con, $operator);
?>

    <table class="tb1">
        <tr>
            <th>Date</th>
            <th>Not Connect</th>
            <th>Callback</th>
            <th>Disclaimer</th>
            <th>Comment</th>
        </tr>
        <?php 
        while ($d = mysqli_fetch_assoc($data)) {
            echo '<tr>'; // Mulai baris baru untuk setiap entri data
            echo '<td>' . $d['date_comment'] .'</td>';
            echo '<td>' . (!empty($d['statusc']) ? $d['statusc'] : 'N/A') . '</td>';
            echo '<td>' . (!empty($d['status']) ? $d['status'] : 'N/A') . '</td>';
            echo '<td>' . (!empty($d['statusb']) ? $d['statusb'] : 'N/A') . '</td>';
            echo '<td>' . $d['operator_comment'] . '</td>';
            echo '</tr>'; // Tutup baris setelah menambahkan data
        }
        ?>
    </table>
</div>

<body>



</body>

</html>