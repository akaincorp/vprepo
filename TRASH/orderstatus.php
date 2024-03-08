<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body {
        font-family: "Gill Sans", sans-serif;
    }

    .boxhandle {
        position: relative;
        left: 380px;
        top: 100px;
        width: 800px;
        height: 500px;
        display: flex;
        align-items: center;
        flex-direction: column;
        box-shadow: -5px 0 1px rgba(0, 0, 0, 0.822), 6px 0 1px rgba(0, 0, 0, 0.822), 0 -2px 1px rgba(0, 0, 0, 0.829), 0 2px 1px rgba(0, 0, 0, 0.829);
    }

    .persegi {
        height: 40px;
        width: 400px;
        color: white;
        background: linear-gradient(to right, #627fff, #1302ad);
        border-radius: 0px 20px 20px 0px;
        position: initial;
        font-weight: 700;
        align-items: center;
        text-align: left;
        display: flex;
        box-shadow: 3px 3px 3px black;
    }

    .bacper {
        background: linear-gradient(to right, #7c7c7c, #ffffff);
        position: relative;
        right: 60px;
        top: 10px;
        height: 50px;
        width: 700px;
        border-radius: 20px 0px 0px 20px;
    }

    .grid-container {
        display: grid;
        grid-template-columns: 150px 250px 150px 150px;
        gap: 10px;
        padding: 5px;
        position: relative;
        width: 10px;
    }

    .grid-item {
        background-color: white;
        border: 1px solid rgba(0, 0, 0, 0.8);
        padding: 7px 15px;
        font-size: 12px;
        text-align: left;
        margin-top: 5px;
        position: relative;
        right: 365px;
        top: 30px;
    }
    </style>
      <title> Agent • VEON</title>
    <link rel="icon" href="img/iconnew.png" type="image/icon type">
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

<body>

    <div class="boxhandle">
        <div class="bacper">
            <div class="persegi">
                <p style="margin-left:20px;"> Order Status</p>
            </div>
        </div>

       
</body>

</html>