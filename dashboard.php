<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Agent • VEON</title>
    <link rel="icon" href="img/iconnew.png" type="image/icon type">
    <link rel="stylesheet" href="CSS/styledash.css">
    <script src="SIPml-api.js?svn=252" type="text/javascript"> </script>
    <script src="https://kit.fontawesome.com/2a43e575e3.js" crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <?php
    session_start();
include('koneksi.php');
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === TRUE) {
    $username = $_SESSION['username_agent'];
    $id_operator = $_SESSION['id_agent'];
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
	include("navbar.php");
	include("header.html");
	?>
</head>

<body>

<div class="container-notification" id="container">
    <div class="notification-success">
      <h1 class="title">Veon</h1>
      <span class="close-button" onclick="hideNotification()" >&times;</span>
      <div class="content-top">
        <p id="status">Success</p>
      </div>
      <div class="content-down">
        <button onclick="hideNotification()">OK</button>
      </div>
    </div>
  </div>

<!-- ---------------------------------------------Form Shipping ------------------------------------------------------------- -->
<div id="withdata">
<form method="POST" id="myForm">
       <div class="boxhandle">
        <div class="bacper">
            <div class="persegi">
                <p style="margin-left:20px;">Shipping Information</p>
            </div>
        </div>

        <p class='ordertime' id="ordertime" style='text-align:center;'> <br></p>
        <div class="formdiv">
        
                <input type="hidden" name="id" id="idcustomer" value="">
                <div class="label-container">
                    <label for="nama_guest" class="inputlabel">First name</label>
                </div>

                <div class="input-container">
                    <input type="text" class="inputmodal" id="firstname" value="" name="nama_guest">
                </div>

                <br>

                <div class="label-container">
                    <label for="nama_guest1" class="inputlabel">Last Name</label>
                </div>
                <div class="input-container">
                    <input type="text" id="lastname" class="inputmodal" value=""
                        name="nama_guest1">
                </div>

                <br>

                <div class="label-container">
                    <label for="nomor_telepon" class="inputlabel">Phone:</label>
                </div>

                <div class="input-container">
                    <input type="text" value="" class="inputmodal" name="nomor_telepon"
                        readonly id="nomorTelepon">
                    <input type="hidden" id="phone"  value="" class="inputmodal" name="phone" readonly>
                </div>

                <br>

                <div class="label-container">
                    <label for="country" class="inputlabel">Country:</label>
                </div>

                <div class="input-container">
                    <input type="text" value="" id="country" class="inputmodal" name="country"
                        id="country">
                </div>

                <br>

                <div class="label-container">
                    <label for="timezone" class="inputlabel">Timezone:</label>
                </div>

                <div class="input-container">
                    <select name="timezone" id="timezonee" class="selectform">
                        <option value="Asia/Jakarta"
                        id="timezone">
                        </option>
                        <option value="America/New_York">America/New_York</option>
                        <option value="Asia/Jakarta">Asia/Jakarta</option>
                        <option value="Europe/London">Europe/London</option>
                    </select>
                </div>

                <br>

                <div class="label-container">
                    <label for="address" class="inputlabel">Address:</label>
                </div>

                <div class="input-container">
                    <input type="text" id="address" class="inputmodalfield" value="" name="addres">
                </div>

                <br>

                <div class="label-container">
                    <label for="address" class="inputlabel">State:</label>
                </div>

                <div class="input-container">
                    <select class="inputmodalfield" name="state" id="stateSelect">
                        <option id="state"></option>

                        <option value="Aceh">Aceh</option>
                        <option value="Bali">Bali</option>
                        <option value="Bangka Belitung">Bangka Belitung</option>
                        <option value="Banten">Banten</option>
                        <option value="Bengkulu">Bengkulu</option>
                        <option value="Daerah Istimewa Yogyakarta">Daerah Istimewa Yogyakarta</option>
                        <option value="Gorontalo">Gorontalo</option>
                        <option value="Bali">Bali</option>
                        <option value="Jakarta">Jakarta</option>
                        <option value="Jawa Barat">Jawa Barat</option>
                        <option value="Jawa Tengah">Jawa Tengah</option>
                        <option value="Jawa Timur">Jawa Timur</option>
                        <option value="Jambi">Jambi</option>
                        <option value="Kalimantan Barat">Kalimantan Barat</option>
                        <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                        <option value="Kalimantan Utara">Kalimantan Utara</option>
                        <option value="Kalimantan Timur">Kalimantan Timur</option>
                        <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                        <option value="Kepulauan Riau">Kepulauan Riau</option>
                        <option value="Lampung">Lampung</option>
                        <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                        <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                        <option value="Riau">Riau</option>
                        <option value="Sumatera Barat">Sumatera Barat</option>
                        <option value="Sumatera Selatan">Sumatera Selatan</option>
                        <option value="Sumatera Utara">Sumatera Utara</option>
                        <option value="Sulawesi Barat">Sulawesi Barat</option>
                        <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                        <option value="Sulawesi Utara">Sulawesi Utara</option>
                        <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                        <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                    </select>
                </div>

                <br>

                <div class="label-container">
                    <label for="address" class="inputlabel">City :</label>
                </div>

                <div class="input-container">
                    <select class="inputmodalfield" name="city" id="citySelect">
                        <option id="city"></option>
                    </select>
                </div>


                <br>

                <div class="label-container">
                    <label for="kode_pos" class="inputlabel">Zip:</label>
                </div>

                <div class="input-container">
                    <input type="text" class="inputmodalfield" id="zip" value="" name="zip">

                </div>
        </div>
    </div>


<!-- -------------------------------------------------------------------------------------------------------------------- -->




<!-- ---------------------------------------------Form Customer Features--------------------------------------------------------------- -->
    
    <div class="boxhandle2">
        <div class="bacper">
            <div class="persegi">
                <p style="margin-left:20px;">Customer Features</p>
            </div>
        </div>
        <div class="formdiv2">

            <div class="label-container">
                <label for="gender" class="inputlabel">M/W</label>
            </div>

            <div class="input-container">
                <label for="gender" id="man" style="color: white;">M</label>
                <input type="radio" style="
    position: relative;
    right: 152px;
" name="gender" value="Man">
                <label for="gender"  id="women" style="color: white;">W</label>
                <input type="radio" style="
    position: relative;
    right: 133px;
    bottom: 0px;
" name="gender" value="women">
            </div>


            <br>


            <div class="label-container">
                <label for="email" class="inputlabel">Email :</label>
            </div>

            <div class="input-container">
                <input type="text" id="email" class="inputmodal" value="" name="email">
            </div>

            <br>

            <div class="label-container">
                <label for="age" class="inputlabel">age :</label>
            </div>

            <div class="input-container">
                <input type="number" class="inputmodal" id="age" value="" name="age">
            </div>

            <br>

            <div class="label-container">
                <label for="height" class="inputlabel">Height :</label>
            </div>

            <div class="input-container">
                <input type="number" class="inputmodal" id="height" value="" name="height">
            </div>

            <br>

            <div class="label-container">
                <label for="chronic" class="inputlabel">Chronic disease :</label>
            </div>

            <div class="input-container">
                <input type="text" class="inputmodal" id="chronic" value="" name="chronic">
            </div>

            <br>

            <div class="label-container">
                <label for="married" class="inputlabel">Married :</label>
            </div>

            <div class="input-container">
                <input type="checkbox" style="
    position: relative;
    right: 135px;
" id="married" value="yes" name="married">
            </div>

            <br>

            <div class="label-container">
                <label for="children" class="inputlabel">children :</label>
            </div>

            <div class="input-container">
                <input type="checkbox" style="
    position: relative;
    right: 135px;
" value="yes" id="children"  name="children">
            </div>

            <br>

        </div>
    </div>
    </div>

<!-- ----------------------------------------------------------------------------------------------------------------------- -->


<!-- ---------------------------------------------Button Status------------------------------------------------------------- -->


            <div class="btnContainer2" id="btnStatus">
            <input type="submit" class="selectstatussubmit" id="submitForm" name="submit" value="Update">
        </form>
        <input type="hidden" name="id" id="idcustomerstatus" value="">

        <select name="notconnect" class="selectstatus1" id="statusSelect4">
            <option id="option4"></option>
            <?php
                include('koneksi.php');
                $query = mysqli_query($con,"SELECT * FROM tb_notconnect");
                while($d = mysqli_fetch_array($query)){
                  echo "<option value=$d[statusc]> $d[statusc]</option>";
                }
                ?>
        </select>
        <select name="callback" id="statusSelect3" class="selectstatus2">
            <option id="option3"></option>
            <?php
                $query = mysqli_query($con,"SELECT * FROM tb_callback");
                while($d = mysqli_fetch_array($query)){
                  echo "<option value=$d[status]> $d[status]</option>";
                }
                ?>
        </select>
        <select name="disclaimer" class="selectstatus3" id="statusSelect2">
            <option id="option2"></option>
            <?php
                $query = mysqli_query($con,"SELECT * FROM tb_disclaimer");
                while($d = mysqli_fetch_array($query)){
                  echo "<option value=$d[statusb]> $d[statusb]</option>";
                }
                ?>
        </select>
        <select name="spam" class="selectstatus4" id="statusSelect1">
            <option id="option1"></option>
            <?php
                $query = mysqli_query($con,"SELECT * FROM tb_spam");
                while($d = mysqli_fetch_array($query)){
                  echo "<option value=$d[statusd]>$d[statusd]</option>";
                }
                ?>
        </select>
    </div>

<!-- --------------------------------------------- Call Container ------------------------------------------------------------- -->

<div style="display: none;" >
                <label style="height: 100%">Password:</label>
                <input type="password" style="width: 100%; height: 100%" id="txtPassword" value="trada123" />
                <label style="height: 100%">Realm<sup>*</sup>:</label>
                <input type="text" style="width: 100%; height: 100%" id="txtRealm" value="api.oncall.id"/>
        </div>

        <div class="callcontrol" id="divCallControl">
          <div id="divCallCtrl" >
          <button id="btnRegister"disabled onclick='sipRegister();'><i class="fa fa-sign-in" ></i> </button>
           &nbsp;
          <button id="btnSetting"><i class="fa fa-cog" aria-hidden="true"></i> </button>
           &nbsp;
          <button id="btnUnRegister" disabled onclick='sipUnRegister();'><i class="fa fa-sign-out"></i> </button>
          &nbsp;
          <label style="position: absolute;left: 225px;bottom: 54px;"id="txtCallStatus"></label>
          <label style="position: absolute;left: 151px;" id="txtRegStatus"></label>
          <button style="margin-left: 465px;margin-bottom: 10px;" id="timer">00:00</button>
                
          <input type="text" id="txtPhoneNumber" value="" placeholder="Enter phone number to call" />

                  <div id="divBtnCallGroup" >
                    <button id="btnCall" style="display: none;"></button>
                  <div >
                    <button onclick='sipCall("call-audio");' class="btndowncall"><i class="fa-solid fa-phone"></i></button>
                    <button id="btnMute" class="buttondown"  onclick='sipToggleMute();' disabled> <i class="fas fa-volume-mute"></i> </button>
                    <button id="btnKeyPad" class="buttondown" onclick='openKeyPad();' disabled><i class="fa-solid fa-keyboard"></i></button> 
                    <button id="btnHangUp" class="buttondown" onclick='sipHangUp();' disabled> <i class="fa-solid fa-phone-slash"></i></button>
                  </div>
                </div>

                <div id='divCallOptions' style='display: none;margin-top: 0px'>
                  <input type="button" class="btn" id="btnFullScreen" style="display: none;" value="FullScreen" disabled onclick='toggleFullScreen();' /> &nbsp;
                  <input type="button" class="btn" id="btnHoldResume" style="display: none;" value="Hold" onclick='sipToggleHoldResume();' /> &nbsp;
                  <input type="button" class="btn" id="btnTransfer" style="display: none;" value="Transfer" onclick='sipTransfer();' /> &nbsp;
                </div>
        </div>
      </div>


      <div class="backgroundsetting" id="backset" style="z-index:999;display: none;align-items: center;justify-content: center;flex-direction: column;width: 100%;background: rgb(0 0 0 / 54%);height: 100%;position: fixed;top: 0;left: 0;">
        <div id="expert" style="display: none;">
          <label align="center" style="position: absolute;" id="txtInfo"> </label>
          <button style="position: relative; left: 95%;" id="btnSettingClose" >X</button>
          <h2> Expert settings</h2>
          <table style='width: 100%'>
            <tr>
              <td>
                <label style="height: 100%">Disable Video:</label>
              </td>
              <td>
                <input type='checkbox' id='cbVideoDisable' onclick="return false;" />
              </td>
            </tr>
            <tr style="display: none;">
              <td>
                <label style="height: 100%">Enable RTCWeb Breaker<sup><a href="#aRTCWebBreaker">[1]</a></sup>:</label>
              </td>
              <td>
                <input type='checkbox' id='cbRTCWebBreaker' />
              </td>
            </tr>
            <tr>
              <td>
                <label style="height: 100%">Display Name:</label>
              </td>
              <td>
                <input type="text" style="width: 100%; height: 100%" id="txtDisplayName" value="8001"/>
              </td>
            </tr>
            <tr>
              <td>
                <label style="height: 100%">Private Identity<sup>*</sup>:</label>
              </td>
              <td>
                <input type="text" style="width: 100%; height: 100%" id="txtPrivateIdentity" value="8001"/>
              </td>
            </tr>
            <tr>
              <td>
                <label style="height: 100%">Public Identity<sup>*</sup>:</label>
              </td>
              <td>
                <input type="text" style="width: 100%; height: 100%" id="txtPublicIdentity" value="sip:8001@api.oncall.id" />
              </td>
            </tr>
            <tr>
              <td>
                <label style="height: 100%">WebSocket Server URL<sup><a href="#aWebSocketServerURL">[2]</a></sup>:</label>
              </td>
              <td>
                <input type="text" style="width: 100%;height: 100%;color: white;"  onmousedown='return false;' onselectstart='return false';  id="txtWebsocketServerUrl" value="wss://api.oncall.id:8089/ws" readonly/>
              </td>
            </tr>
            <tr style="display: none;">
              <td>
                <label style="height: 100%">SIP outbound Proxy URL<sup><a href="#aSIPOutboundProxyURL">[3]</a></sup>:</label>
              </td>
              <td>
                <input type="text" style="width: 100%; height: 100%" id="txtSIPOutboundProxyUrl" value="" placeholder="e.g. udp://sipml5.org:5060" />
              </td>
            </tr>
            <tr>
              <td>
                <label style="height: 100%">ICE Servers<sup><a href="#aIceServers">[4]</a></sup>:</label>
              </td>
              <td>
                <input type="text" style="width: 100%;height: 100%;color: white;" id="txtIceServers" value="[]" onmousedown='return false;' onselectstart='return false'; readonly/>
              </td>
            </tr>
            <tr style="display: none;">
              <td>
                <label style="height: 100%">Max bandwidth (kbps)<sup><a href="#aBandwidth">[5]</a></sup>:</label>
              </td>
              <td>
                <input type="text" style="width: 100%; height: 100%" id="txtBandwidth" value="" placeholder="{ audio:64, video:512 }" />
              </td>
            </tr>
            <tr style="display: none;">
              <td>
                <label style="height: 100%">Video size<sup><a href="#aSizeVideo">[6]</a></sup>:</label>
              </td>
              <td>
                <input type="text" style="width: 100%; height: 100%" id="txtSizeVideo" value="" placeholder="{ minWidth: 640, minHeight:480, maxWidth: 640, maxHeight:480 }" />
              </td>
            </tr>
            <tr>
              <td>
                <label style="height: 100%">Disable 3GPP Early IMS<sup><a href="#aEarlyIMS">[7]</a></sup>:</label>
              </td>
              <td>
                <input type='checkbox' id='cbEarlyIMS' onclick="return false;" />
              </td>
            </tr>
            <tr style="display: none;">
              <td>
                <label style="height: 100%">Disable debug messages<sup><a href="#aDebugMessages">[8]</a></sup>:</label>
              </td>
              <td>
                <input type='checkbox' id='cbDebugMessages'/>
              </td>
            </tr>
            <tr>
              <td>
                <label style="height: 100%">Cache the media stream<sup><a href="#aCacheMediaStream">[9]</a></sup>:</label>
              </td>
              <td>
                <input type='checkbox' id='cbCacheMediaStream' onclick="return false;" />
              </td>
            </tr>
            <tr style="display: none;">
              <td>
                <label style="height: 100%" >Disable Call button options<sup><a href="#aCallButtonOptions">[10]</a></sup>:</label>
              </td>
              <td>
                <input type='checkbox' id='cbCallButtonOptions' />
              </td>
            </tr>
            <tr>
              <td colspan="2" align="right">
                <button id="btnSave" onclick='settingsSave();' > Save</button>
                &nbsp;
                <button id="clearLocalStorageButton" >Delete Local Storage </button>
                &nbsp;
                <input type="button" style="display: none;" class="btn-danger" id="btnRevert" value="Revert" onclick='settingsRevert();' />
              </td>
            </tr>
          </table>
        </div>
      </div>


    <!-- Glass Panel -->
    <div id='divGlassPanel' class='glass-panel' style='visibility:hidden'></div>
    <!-- KeyPad Div -->
    <div id='divKeyPad' class='span2 well div-keypad' style="left:0px; top:0px; width:250; height:240;display:flex;justify-content:center;items-align:center; visibility:hidden">
      <table style="width: 270px; height: 100%">
        <tr><td><input type="button" style="width: 33%" class="btn" value="1" onclick="sipSendDTMF('1');" /><input type="button" style="width: 33%" class="btn" value="2" onclick="sipSendDTMF('2');" /><input type="button" style="width: 33%" class="btn" value="3" onclick="sipSendDTMF('3');" /></td></tr>
        <tr><td><input type="button" style="width: 33%" class="btn" value="4" onclick="sipSendDTMF('4');" /><input type="button" style="width: 33%" class="btn" value="5" onclick="sipSendDTMF('5');" /><input type="button" style="width: 33%" class="btn" value="6" onclick="sipSendDTMF('6');" /></td></tr>
        <tr><td><input type="button" style="width: 33%" class="btn" value="7" onclick="sipSendDTMF('7');" /><input type="button" style="width: 33%" class="btn" value="8" onclick="sipSendDTMF('8');" /><input type="button" style="width: 33%" class="btn" value="9" onclick="sipSendDTMF('9');" /></td></tr>
        <tr><td><input type="button" style="width: 33%" class="btn" value="*" onclick="sipSendDTMF('*');" /><input type="button" style="width: 33%" class="btn" value="0" onclick="sipSendDTMF('0');" /><input type="button" style="width: 33%" class="btn" value="#" onclick="sipSendDTMF('#');" /></td></tr>
        <tr><td colspan=3><input type="button" style="width: 100%" class="btn btn-medium btn-danger" value="close" onclick="closeKeyPad();" /></td></tr>
      </table>
    </div>

<!-- --------------------------------------------------------------------------PRODUCT----------------------------------------- -->
 
<div id="withdataproduct">
<div class="boxhandleproduct">
        <div class="bacperproduct">
            <div class="persegiproduct">
                <p style="margin-left:20px;">Product Information</p>
            </div>
        </div>

        <?php
include('koneksi.php');

$customer = "SELECT * FROM tb_customer WHERE id_agent = '$id_operator'";
$resultid = mysqli_query($con, $customer);

while ($row = mysqli_fetch_assoc($resultid)) {
     $id_customer = $row['id_customer'];

$operator = "SELECT * FROM history_agent 
    JOIN tb_agent ON history_agent.id_agent = tb_agent.id_agent
    JOIN tb_callback ON history_agent.id_status = tb_callback.id_status
    JOIN tb_notconnect ON history_agent.id_statusc = tb_notconnect.id_statusc
    JOIN tb_disclaimer ON history_agent.id_statusb = tb_disclaimer.id_statusb
    JOIN tb_spam ON history_agent.id_statusd = tb_spam.id_statusd
    JOIN tb_procces ON history_agent.id_statusf = tb_procces.id_statusf
    WHERE history_agent.id_customer = '$id_customer' ORDER BY history_agent.date_comment DESC LIMIT 1"; // Perhatikan perubahan di sini
$datatop = mysqli_query($con, $operator);
?>

<?php if (mysqli_num_rows($datatop) == 0) {
  $query = "SELECT * FROM tb_customer JOIN tb_procces ON tb_customer.id_statusf = tb_procces.id_statusf WHERE id_agent = '$id_operator'";
  $resultquery = mysqli_query($con, $query);
  while ($d2 = mysqli_fetch_array($resultquery)) { ?>
  <p class='ordertime' style='text-align:center;'>Order Time : <br> <?php echo $d2['order_date'] ?> </p>
    <div class="containertopproduct">
        <h5 class='handling'>Status : <b> <?php echo $d2['statusf'] ?></b> </h5>             
        <h5 class='groups'>Groups :  <b><?php echo $d2['promo'] ?></b> </h5>
<?php  }} else { ?>
    <?php while ($d1 = mysqli_fetch_array($datatop)) { ?>
      <p class='ordertime' style='text-align:center;'>Order Time : <br> <?php echo $d1['order_date'];?></p>
        <div class="containertopproduct">
            <h1 class='handling'>Status : <b><?php echo $d1['status'];?> <?php echo $d1['statusb'];?> <?php echo $d1['statusc']; ?><?php echo $d1['statusd']; ?> </b></h1>
            <h5 class='groups'>Groups : <b><?php echo $d1['promo'] ?></b></h5>
            </div>
    <?php } ?>
    
<?php }} ?>
<table border="1" class="tb1product">
            <thead>
             <tr>
                <th>Order Number</th>
                <th>Product</th>
                <th>Description</th>
                <th>Pack</th>
                <th>Shipment Type</th>
                <th>Amount</th>
                <th>Price</th>
            </tr>
            </thead>
<tbody>
</tbody>
<button id="edit" style="background:transparent;border:none;"><i id="editIcon"
class="fas fa-edit"></i></button>
<button id="addcombo" style="background:transparent;border:none;"><i id="plusIcon" class="fa-solid fa-plus"></i></button>
        </table>
        <h5 class="total" id='totals'>Total : </h5>
        <form method="post">
            <input type="hidden" id='idcusnote' name="id_customer" value="">
            <h5 class="note">Note :</h5>
            <input type="hidden" id="date" name="date_comment">
            <textarea name="note" class="txtareaproduct"></textarea>

    </div>

        <div class="btnContainer3">
        <button type="submit" formaction="approve.php" name="reg" class="selectstatusapprove">Approve</button>
        </form>
        </div>
        </div>

 <!-- edit -->
 <div class="popupedit" id="popupedit">
        <div class="popupedit-content">
            <span class=" close-btnstatus3" id="closePopupEdit">&times;</span>
            <form method="POST" id="myFormProduct" action="editproduct.php">
                <label class="label2" for="name">Nama :</label>
                <?php 
                include ('koneksi.php');
                $selectquery = "SELECT * FROM tb_customer WHERE id_agent= '$id_operator'";
                $resultselect = mysqli_query($con,$selectquery);

                while ($d = mysqli_fetch_array($resultselect)) {
                ?>
                <input type="hidden" id="id" class="numb" name="id" value="<?php echo $id_customer;?>">
                <select class="selectpopupproduct" id="namaproduct" name="nama_product">
                    <option value="">
                        <?php
    echo empty($d['nama_product']) ? '' : $d['nama_product'] . ' (Chosen)';
    ?>
                    </option>
                    <option value="EPROS">EPROS</option>
                    <option value="Obat">Obat</option>
                </select>
                <br>
                <label class="label2" for="description" id="descriptionlabel">Description :</label>
                <select name="description" id="description" id="description">
                    <option value=""><?php echo $d['description']; ?></option>
                    <option value="300mg">300mg</option>
                    <option value="400mg">400mg</option>
                    <option value="500mg">500mg</option>
                    <option value="600mg">600mg</option>
                </select>
                <br>
                <label class="label2" for="pack" id="packlabel">Pack :</label>
                <select name="package" id="pack">
                    <option value=""><?php echo $d['package']; ?></option>
                    <option value="10caps">10caps</option>
                    <option value="20caps">20caps</option>
                    <option value="30caps">30caps</option>
                    <option value="40caps">40caps</option>
                </select>
                <br>
                <label class="label2"  for="shipment">Shipment type :</label>
                <select class="selectpopupproduct" id="shipment" name="shipment_type">
                    <option value="">
                        <?php
    echo empty($d['shipment_type']) ? '' : $d['shipment_type'] . ' (Chosen)';
    ?>
                    </option>
                    <option value="1-3days">1 - 3 Days</option>
                    <option value="3-6days">3 - 6 Days</option>
                </select>
                <br>
                <label class="label2" for="amountInput">Jumlah :</label>
                <input type="number"  value="<?php echo $d['amount']; ?>" name="amount" class="numb" id="amountInput"
                    oninput="calculateTotal()">
                <br>
                <label class="label2" for="priceInput">Harga :</label>
                <input type="number" value="<?php echo $d['price']; ?>" name="price" class="numb" id="priceInput"
                    oninput="calculateTotal()">
                <br>
                <label class="label2" for="totalAmount">Total :</label>
                <input type="text" value="<?php echo $d['total']; ?>" name="total" id="totalAmount" readonly>
                <br>
                <label class="label2" for="bankpayment">bank payment :</label>
                <input type="checkbox" id="bankpayment" value="BPW" name="bank_payment">
                <br>
                <?php } ?>
                <input type="submit" name="submit" value="Update">
            </form>
        </div>
    </div>
    </div>

 <!-- edit -->
 <div class="popupedit" id="popupedit2">
        <div class="popupedit-content">
            <span class=" close-btnstatus3" id="closePopupEdit2">&times;</span>
            <h1 style="font-size: 28px;
    position: absolute;
    top: 0px;
    left: 28px;">Form Combo</h1>
            <form method="POST" id="formCombo" action="combo.php">
                <label class="label2" for="name">Nama :</label>
                <?php 
                include ('koneksi.php');
                $selectquery = "SELECT * FROM tb_customer WHERE id_agent= '$id_operator'";
                $resultselect = mysqli_query($con,$selectquery);

                while ($d = mysqli_fetch_array($resultselect)) {
                ?>
                <input type="hidden" id="id2" class="numb" name="id" value="<?php echo $id_customer;?>">
                <?php } ?>
                <input type="hidden" id="idAgent" class="numb" name="id" value="<?php echo $id_operator;?>">
                <select class="selectpopupproduct" id="namaproduct2" name="nama_product">
                    <option value=""></option>
                    <option value="EPROS">EPROS</option>
                    <option value="Obat">Obat</option>
                </select>
                <br>
                <label class="label2" for="description" id="descriptionlabel">Description :</label>
                <select name="description" id="description2" >
                    <option value=""></option>
                    <option value="300mg">300mg</option>
                    <option value="400mg">400mg</option>
                    <option value="500mg">500mg</option>
                    <option value="600mg">600mg</option>
                </select>
                <br>
                <label class="label2" for="pack" id="packlabel">Pack :</label>
                <select name="package" id="pack2">
                    <option value=""></option>
                    <option value="10caps">10caps</option>
                    <option value="20caps">20caps</option>
                    <option value="30caps">30caps</option>
                    <option value="40caps">40caps</option>
                </select>
                <br>
                <label class="label2"  for="shipment">Shipment type :</label>
                <select class="selectpopupproduct" id="shipment2" name="shipment_type">
                    <option value=""></option>
                    <option value="1-3days">1 - 3 Days</option>
                    <option value="3-6days">3 - 6 Days</option>
                </select>
                <br>
                <label class="label2" for="amountInput">Jumlah :</label>
                <input type="number"  value="" name="amount" class="numb" id="amountInput2"
                    oninput="calculateTotal2()">
                <br>
                <label class="label2" for="priceInput">Harga :</label>
                <input type="number" value="" name="price" class="numb" id="priceInput2"
                    oninput="calculateTotal2()">
                <br>
                <label class="label2" for="totalAmount">Total :</label>
                <input type="text" value="" name="total" id="totalAmount2" readonly>
                <br>
                <label class="label2" for="bankpayment">bank payment :</label>
                <input type="checkbox" id="bankpayment2" value="BPW" name="bank_payment">
                <br>
                <input type="submit" name="submit" value="Add">
            </form>
        </div>
    </div>
    </div>


<!-- --------------------------------------------- -Data Kosong------------------------------------------------------------------ -->


<div id="nodata">
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
   </div>
</div>

<div id="updateStatContent" style="display:none;"></div>
    
<!-- ---------------------------------------------HANDLING------------------------------------------------------------- -->

<div id="withdatahandling">
<div class="boxhandle">
    <div class="bacper">
        <div class="persegi">
            <p style="margin-left:20px;">Operator Comment history</p>
        </div>
    </div>

    <?php
$no = 1;
$customer = "SELECT * FROM tb_customer WHERE id_agent = '$id_operator'";
$resultid = mysqli_query($con, $customer);

while ($row = mysqli_fetch_assoc($resultid)) {
     $id_customer = $row['id_customer'];

$operator = "SELECT * FROM history_agent 
    JOIN tb_agent ON history_agent.id_agent = tb_agent.id_agent
    JOIN tb_callback ON history_agent.id_status = tb_callback.id_status
    JOIN tb_notconnect ON history_agent.id_statusc = tb_notconnect.id_statusc
    JOIN tb_disclaimer ON history_agent.id_statusb = tb_disclaimer.id_statusb
    JOIN tb_spam ON history_agent.id_statusd = tb_spam.id_statusd
    WHERE history_agent.id_customer = '$id_customer' ORDER BY history_agent.date_comment DESC LIMIT 1";

$datatop = mysqli_query($con, $operator);

if ($datatop === 0) {
  echo "<script>alert('Data Kosong')</script>";
} else {
while ($d1 = mysqli_fetch_array($datatop)) {
echo "<p class='ordertime' style='text-align:center;'>Order Time : <br>" . $d1['order_date'] . "</p>";
echo "<div class='containertophandling'>";
echo "<h5 class='handlingH'>Handling : <b>" . $d1['status'] . $d1['statusb'] . $d1['statusc'] . $d1['statusd'] . "</b></h5>";
echo "<h5 class='groupsH'>Groups : <b>" . $d1['promo'] . "</b></h5>";
echo "<h5 class='ordernumber'>Order Number : <b>" . $d1['order_id'] . "</b></h5>";
echo "</div>";
}}};
?> 

    <?php
$no = 1;
$pickcustomer = "SELECT id_customer FROM tb_customer WHERE id_agent = '$id_operator'";
$resultpick = mysqli_query($con,$pickcustomer);
while ($row = mysqli_fetch_assoc($resultpick)) {
  $id_customer = $row['id_customer'];
};
$operator = "SELECT * FROM history_agent 
    JOIN tb_agent ON history_agent.id_agent = tb_agent.id_agent
    JOIN tb_callback ON history_agent.id_status = tb_callback.id_status
    JOIN tb_notconnect ON history_agent.id_statusc = tb_notconnect.id_statusc
    JOIN tb_disclaimer ON history_agent.id_statusb = tb_disclaimer.id_statusb
    JOIN tb_spam ON history_agent.id_statusd = tb_spam.id_statusd
    WHERE history_agent.id_customer = '$id_customer'"; // Perhatikan perubahan di sini
$data = mysqli_query($con, $operator);
?>

    <table class="tb1handling">
        <tr>
            <th>Date</th>
            <th>Status</th>
            <th>Comment</th>
        </tr>
        <?php 
        while ($d = mysqli_fetch_assoc($data)) {
            echo '<tr>'; // Mulai baris baru untuk setiap entri data
            echo '<td>' . $d['date_comment'] .'</td>';
            echo '<td>' . (!empty($d['statusc']) ? $d['statusc'] : '') . (!empty($d['statusb']) ? $d['statusb'] : '') . (!empty($d['status']) ? $d['status'] : '')  . '</td>';
            echo '<td>' . $d['operator_comment'] . '</td>';
            echo '</tr>'; // Tutup baris setelah menambahkan data
        }
        ?>
    </table>
</div>
</div>


<!-- ---------------------------------------------OVERVIEW------------------------------------------------------------- -->
<div id="withdataoverview">
<div class="boxhandle">
    <div class="bacper">
        <div class="persegi">
            <p style="margin-left:20px;">Orders</p>
        </div>
    </div>
<?php
 $selectqueue = "SELECT * FROM tb_delivery
                 JOIN tb_procces ON tb_delivery.id_statusf = tb_procces.id_statusf
                 JOIN tb_callback ON tb_delivery.id_status = tb_callback.id_status
                 JOIN tb_notconnect ON tb_delivery.id_statusc = tb_notconnect.id_statusc
                 JOIN tb_disclaimer ON tb_delivery.id_statusb = tb_disclaimer.id_statusb
                 JOIN tb_spam ON tb_delivery.id_statusd = tb_spam.id_statusd
                 JOIN tb_agent ON tb_delivery.id_agent = tb_agent.id_agent  WHERE tb_procces.statusf = 'OUTSTANDING'";

$resultqueue = mysqli_query($con, $selectqueue);
?>
        <table class="tb1handling">
            <tr>
                <th>Order number</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone</th>
                <th>Summary</th>
                <th>Date</th>
            </tr>
            <?php while ( $d = mysqli_fetch_array($resultqueue)) {
            ?>
            <tr>
                <td><?php echo $d['order_id']; ?></td>
                <td><?php echo str_repeat('*', strlen($d['first_name'])); ?></td>
                <td><?php echo str_repeat('*', strlen($d['last_name'])); ?></td>
                <td><?php echo str_repeat('*', strlen($d['phone'])); ?></td>
                <td><?php echo $d['total']; ?></td>
                <td><?php echo $d['date_comment']; ?></td>

            </tr>
            <?php } ?>
        </table>
    </div>
    </div>
    </div>
</div>
<!-- ---------------------------------------------Popup Status------------------------------------------------------------- -->

    <div class="popupstatus" id="popupstatus">
        <div class="popupstatus-content">
            <span class="close-btnstatus" id="closePopupstatus">&times;</span>
            <p id="popupMessage"></p>
            <div class="formstatus">
                <?php
$customer = "SELECT * 
             FROM tb_customer WHERE id_agent = '$id_operator'";
             

$result = mysqli_query($con, $customer);
?>
                <?php
while ($d = mysqli_fetch_assoc($result)) {
?>
                <form action="statusspam.php" id="formSpam" method="POST">
                    <input type="hidden" name="idcustomer" id="idcus" value="<?php echo $d['id_customer'];?>">
                    <input type="hidden" name="setstatus" id="setStatus" value="">
                    <input type="hidden" id="date" name="datecomment">
                    <label for="statuscomment">Comment :</label>
                    <input type="text" name="statuscomment" id="statuscom" placeholder="Fill here">
                    <input type="submit" class="buttonstatus" value="Add status" name="submitstatus">
                </form>
                <?php } ?>
            </div>
        </div>
    </div>



    <div class="popupstatus1" id="popupstatus1">
        <div class="popupstatus-content1">
            <span class="close-btnstatus1" id="closePopupstatus1">&times;</span>
            <p id="popupMessage1"></p>
            <div class="formstatus1">
                <?php
$customer = "SELECT * 
             FROM tb_customer WHERE id_agent = '$id_operator'";
             

$result = mysqli_query($con, $customer);
?>
                <?php
while ($d = mysqli_fetch_assoc($result)) {
?>
                <form action="process/statusdisclaimer.php" id="formDisclaimer" method="POST">
                    <input type="hidden" id="idcus1" name="idcustomer" value="<?php echo $d['id_customer'];?>">
                    <input type="hidden" name="setstatus1" id="setStatus1" value="">
                    <input type="hidden" id="date1" name="datecomment">
                    <label for="statuscomment">Comment :</label>
                    <input type="text" name="statuscomment" id="statuscom1" placeholder="Fill here">
                    <input type="submit" class="buttonstatus" value="Add status" name="submitstatus1">
                </form>
                <?php } ?>
            </div>
        </div>
    </div>


    <div class="popupstatus2" id="popupstatus2">
        <div class="popupstatus-content2">
            <span class="close-btnstatus2" id="closePopupstatus2">&times;</span>
            <p id="popupMessage2"></p>
            <div class="formstatus2">
                <?php
$customer = "SELECT * 
             FROM tb_customer WHERE id_agent = '$id_operator'";
             

$result = mysqli_query($con, $customer);
?>
                <?php
while ($d = mysqli_fetch_assoc($result)) {
?>
                <form action="process/statuscallback.php" id="formCallback" method="POST">
                    <input type="hidden" name="idcustomer" id="idcus2" value="<?php echo $d['id_customer'];?>">
                    <input type="hidden" name="setstatus2" id="setStatus2" value="">
                    <input type="hidden" id="date2" name="datecomment">
                    <label for="statuscomment">Comment :</label>
                    <input type="text" name="statuscomment" id="statuscom2"  placeholder="Fill here">
                    <input type="submit" class="buttonstatus" value="Add status" name="submitstatus2">
                </form>
                <?php } ?>
            </div>
        </div>
    </div>


    <div class="popupstatus3" id="popupstatus3">
        <div class="popupstatus-content3">
            <span class="close-btnstatus3" id="closePopupstatus3">&times;</span>
            <p id="popupMessage3"></p>
            <div class="formstatus3">
                <?php
$customer = "SELECT * 
             FROM tb_customer WHERE id_agent = '$id_operator'";
             

$result = mysqli_query($con, $customer);
?>
                <?php
while ($d = mysqli_fetch_assoc($result)) {
?>
                <form action="process/statusnotconnect.php" id="formNotconnect" method="POST">
                    <input type="hidden" name="idcustomer" id="idcus3" value="<?php echo $d['id_customer'];?>">
                    <input type="hidden" name="setstatus3" id="setStatus3" value="">
                    <input type="hidden" id="date3" name="datecomment">
                    <label for="statuscomment" >Comment :</label>
                    <input type="text" id="statuscom3" name="statuscomment" placeholder="Fill here">
                    <input type="submit" class="buttonstatus" value="Add status" name="submitstatus3">
                </form>
                <?php } ?>
            </div>
        </div>
    </div>

<!-- ---------------------------------------------------------------------SCRIPT------------------------------------------ -->
<div id="scriptContainer">
<div class="selectscript">
    <button id="buttonscript" class="buttonscript">Script</button>
    <div class="dropscript" id="dropscript">
        <button onclick="eprosScript()">Epros</button>
        <button onclick="obatScript()">Obat </button>
    </div>


<div class="container" id="eprosscript" >
  <div class="item" style="width: 150%;"> <h1>SCRIPT EPROS NANO RING</h1>
  <img src="img/nanoring.png" style="margin-bottom:10px;" alt="">
  <h3 style="background-color:#6767f7;">SALAM PEMBUKA</h3>
  <p>Operator : Selamat Pagi/Siang/Sore/Malam, dengan Bapak/Ibu <p style="color:red;">(Nama Klien)</p>? <br>
Client      : (tunggu respon dari klien)
Operator : Perkenalkan Nama saya <p style="color:red;">(Nama Operator)</p> dari EPROS NANO RING, Alat terapi prostat dan vitalitas <b>Pria Dewasa</b> ingin mengkonfirmasi pesanan Bapak/Ibu. Bisa minta waktunya sebentar ya pak / bu <br>
Client     : Iya, silahkan (Jika tidak, tanyakan bisa di telepon jam berapa?) <br>
Customer;	jika jawabnya : tidak memerasa pesan (lihat data customer di basic informasi pada PANEL AGENT, sebutkan tanggal dan jam kapan customer menekan tombol memesan pada website).
</p><br>


<h3 style="background-color:#6767f7;">TANYAKAN DOMISILI KLIEN</h3>
<p>Operator : Boleh saya tahu Bapak/Ibu domisili di daerah mana? <br>
Client      : (tunggu respon dari klien) <br>
NOTE : Cash On Delivery - Klien membayar barang setelah barang sampai di tempat dan Bank Payment Waiting - Transfer ke rekening perusahaan setelah itu barang dikirim. Apabila Klien tidak setuju, operator berikan argumen kalau rekening yang dipakai adalah rekening perusahaan. Jika masih tidak setuju dieksekusi "NO DELIVERY"
</p> <br>


<h3 style="background-color:#6767f7;">IDENTIFIKASI KEBUTUHAN KLIEN</h3>
<p>Operator : Baik terima kasih, Sebelumnya saya ingin menanyakan beberapa pertanyaan kepada Bapak/Ibu. Agar nanti saya bisa memahami masalah serta memberikan konsultasi dan solusi terbaik terkait pengobatan atau terapi yang cocok untuk Bapak dengan menggunakan produk kami <p style="color:red;">(lalu lanjutkan tanpa jeda)</p> Untuk penggunaan produknya untuk Bapak sendiri? <br>

Client     : (tunggu respon dari klien) <br>

Operator :  Bapak/Ibu usia berapa tahun saat ini? <br>

Client      : (tunggu respon dari klien) <br>

Operator : Apakah aktivitas atau pekerjaan Bapak/Ibu saat ini terkait atau berhubungan dengan aktivitas pikiran/mental atau fisik? <br>

Client      : (tunggu respon dari klien) <br>
Operator : Apakah Bapak/Ibu memiliki kebiasaan buruk? (seperti merokok, minum alkohol, begadang, pola makan dan tidur yang tidak teratur ) <br>
Client      : (tunggu respon dari klien) <br>
Operator : Apakah ada penyakit lain yang menyertai atau diderita Pak/Bu? (seperti prostatitis, hipertensi/tekanan darah tinggi, diabetes) <br>
Client      : (tunggu respon dari klien) <br>
Operator : Masalah apa  saat ini yang mengganggu Bapak/Ibu? (Kanker prostat, pembengkakan kelenjar prostat, buang air terus emenerus, susah menahan buang air kecil? libido yang     kurang, impoten atau ereksi lemah/kurang, durasi berhubungan pendek, ejakulasi dini, ketidakmampuan untuk memulihkan keintiman kembali) <br>
Client      : (tunggu respon dari klien) <br>
Operator : Sudah berapa lama untuk keluhan yang di rasakan saat ini 
Client      : (tunggu respon dari klien)
</p> <br>


<h3 style="background-color:#9df6ff;">RESUME/PEMAHAMAN TERKAIT KEBUTUHAN KLIEN</h3>
<p>Operator : Jadi, disini sesuai dengan info serta riwayat yang Bapak/Ibu sampaikan benar bahwa Bapak/Ibu ingin mengatasi masalah berikut (Sebutkan keluhan atau masalah klien yang telah disebutkan sebelumnya).
</p><br>


<h3 style="background-color:#9df6ff;">PRESENTASI PRODUK</h3>
<p>Gejala yang dijelaskan oleh Bapak/Ibu merupakan tanda-tanda kanker prostat/disfungsi ereksi <p style="color:red;">(pilih yg mana keluhan klien)</p>. Banyak pria mengalami masalah tersebut dan mampu mengatasinya dengan cepat yaitu dengan mengambil tindakan.
</p> <br>
<p>kanker prostat/Disfungsi ereksi adalah gangguan yang terjadi karena pengaruh berbagai faktor : stress, ekologi atau lingkungan yang buruk, kebiasaan buruk (jika ada), penyakit pada sistem genitourinari (sistem reproduksi dan urin/kemih), terlalu banyak bekerja karena tekanan mental atau fisik yang konstan (sesuai kebutuhan) dan pertambahan usia/umur.
</p> <br>
<p>Semua faktor ini berdampak buruk bagi kadar testosteron. Apakah Bapak/Ibu sudah tahu apa itu Testosteron? ini adalah hormon seks utama pada pria, yang sepenuhnya bertanggung jawab atas kemampuan dan aktivitas seksual pria.
</p> <br>
<p>Alat terapi ini sepenuhnya aman untuk kesehatan. Tidak menimbulkan efek samping dan tidak menimbulkan komplikasi pada organ lain seperti pada saat konsumsi obat kuat dsb
</p> <br>
<p><p style="color:red;">EPROS ini mengandung ion negative dan teknologi infrared dari jerman</p> <b>yang</b> sangat baik untuk pemulihan kelenjar prostat, normalisasi sirkulasi darah di seputar prostatitis, mengaktifkan kembali sel yang terganggu akibat kanker prostat dan disisi lain EPROS yang  berteknologi nano dari jerman ini mampu meningkatkan gairah seksual, memperkuat ereksi, memperpanjang durasi hubungan seksual dan meningkatkan orgasme serta menambah ukuran hingga 5cm
</p> <br>


<h3 style="background-color:#9df6ff;">ATURAN PAKAI DAN CARA PAKAI</h3>
<p>DURASI PAKAI untuk gejala ringan cukup pakai 2-3 jam perhari, untuk yang berat dan ingin menambah ukuran bisa gunakan selama 3-6 jam per hari. Gunakan saat bersantai atau saat tidur
<br>
Cara pemakaian cukup dikalungkan saja pada alat vital sesuai intruksi didalam box.
</p> <br>


<h3 style="background-color:#9df6ff;">PENAWARAN PAKET DAN HARGA</h3>
<p><b>Baik, dalam kasus Bapak/Ibu</b> <p style="color:red;">(sebutkan permasalahan klien)</p>, <b> untuk pemulihan totalnya saya merekomendasikan</b> cara pakai dengan durasi pertama atau kedua dipakai rutin ya pak tanpa jeda, dan jaga pola hidup serta makan yang teratur tidak berlebihan dsb
</p>
<p><b>PENAWARAN EPROS NANO RING FULL PRICE DENGAN HARGA Rp. 1,190,000 SESUAI DENGAN PEMESANAN BAPAK/IBU PADA WEBSITE KAMI</b>
</p>
<p><p style="color:red;">Harga ini sudah dipotong diskon 40% dari harga normal kami di Rp 2,000,000 serta untuk wilayah bapak gratis ongkir.
<br>Tapi mohon maaf bapak/ibu sebelumnya, kami kehabisan stock untuk 2 hari kedepan, dikarenakan permintaan dalam jumlah besar dari salah satu rumah sakit swasta ternama di jakarta. Apa bapak ibu berkenan untuk kita proses di 3 hari dari sekarang? Jika iya sistem bayar bisa cod bayar ditempat atau transfer. Bapak/ibu berminat dengan sistem pembayaran yang mana? <br> 
Fokus untuk mohon maaf stock terbatas dan proses dihari ke 3
<br>Soal harga, fokus menawarkan harga 1,190,000 tersebut terlebih dahulu dan wajib untuk menanggapi setiap keberatan atau penolakan klien dengan keluhan serta penderitaan klien.. <br>
Setelah itu jika masih ada keberatan atau penolakan dari klien bisa diturunkan dengan penawaran potongan 200,000 (diskon khusus bulan ini) jadi bapak hanya perlu bayar 990,000 dan tetap gratis ongkir sampai ke alamat tanpa bayar apapun lagi!
<br>Jika masih terjadi penolakan kembali ke keluhan serta penderitaan klien.. <br>
Setelah itu jika masih keberatan, kasih lagi dengan potongan diskon karyawan sebesar 100,000 jadi bapak/ibu cukup membayar 890,000 untuk EPROS nya beserta box exclusive & tetap gratis ongkir ya ke alamat bapak/ibu tanpa biaya apapun lagi.
</p></p> <br>
<p>Bapak/Ibu cukup membayar sekali, dan masalah bapak akan tuntas secara permanen tanpa efek samping. Bagaimana Pak/Bu saya kirimkan <p style="color:red;">EPROS nya</p> ke alamat rumah atau kantor? (Jika masih ada keberatan/penolakan dari klien bisa di handling atau diberikan argument lagi, kalau masih tetap menolak maka tawarkan:
<br>Baik, kami paham dengan situasi Bapak/Ibu saat ini, kalau begitu kami berikan penawaran terakhir kami jika Bapak/Ibu mau coba kami lakukan <p style="color:red;">PEMBULATAN DI ANGKA 799 (ini merupakan super promo yang belum launching bapak/ibu akan tetapi saya mendengarkan keluhan situasi keuangan bapak/ibu tidak apa apa saya berikan super promo ini khusus untuk bapak/ibu </p>
<br>Bagaimana Pak/Bu saya kirimkan <p style="color:red;">EPROS dengan harga super promo nya?</p>, saya bantu kirimkan ke jalan atau perumahan apa?
<br>NOTE: JIKA DITAWAR LAGI MAKA TIDAK APPROVE!! <br>
Saat menawarkan EPROS, operator harus membuat perbandingan:
Pelanggan, Kita sudah menjual ribuan EPROS pak/bu, jika tanpa hasil tidak mungkin kita masih ada hingga saat ini.
<br>Jika berobat kerumah sakit uang yang dikeluarkan tidak sedikit bapak/ibu, serta obat2an dijual bebas bisa menganggu kerja jantung dan organ lainnya bapak/ibu bisa fatal hingga menyebabkan kematian
</p> <br>


<h3 style="background-color:#9df6ff;">KONFIRMASI ALAMAT DAN PENGIRIMAN</h3>
<li>Baik Bapak/Ibu, bisa disebutkan kembali nama dan alamat lengkapnya? <p style="color:red;">(Client Menyebutkan Nama dan Alamat)</p></li><br>
<li>Baik, saya ulangi, Atas nama Bapak/Ibu <p style="color:red;">(Nama Client)</p> dengan alamat <p style="color:red;">(Alamat Client)</p> dengan pemesanan <p style="color:red;">(Produk dan Jumlah Pemesanan Client)</p> dengan total harga Rp. <p style="color:red;">(Sebutkan Total Biaya sesuai Pesanan Client)</p> betul?</li><br>

<h3>WAJIB UNTUK MENYEBUTKAN PERJANJIAN PENAWARAN LISAN!</h3>
<p><b>Karena kami akan membayar atau menanggung biaya pengiriman untuk Bapak/Ibu, maka dalam hal ini, melalui rekaman percakapan, kami membuat “PERJANJIAN PENAWARAN LISAN” dengan Bapak/Ibu (sebutkan nama Client). menyatakan bahwa kami berjanji untuk mengirimkan barang dengan kualitas terbaik Bapak/Ibu, dan Bapak/Ibu disatu sisi berjanji/menyetujui untuk menebus/membayar barang tersebut pada saat diterima. Apakah Bapak/Ibu setuju?
</b>(Pastikan Client menjawab <b>Ya/Setuju</b>)
</p><br>


<h3 style="background-color:#9df6ff;">PENUTUP & KESAN POSITIF FINAL (KPF)</h3>
<p>Terima kasih atas pemesanannya, semoga produknya bermanfaat untuk Bapak/Ibu, sehat selalu ya Pak/Bu, selamat beraktivitas kembali, selamat pagi/siang/sore/malam Bapak/Ibu.
<br><b>Note : Jika Operator tidak menjelaskan dan menginformasikan kepada  klien sesuai update di atas maka akan di mistake oleh HANDLING dan dikenakan denda.
</b></p> <br>


<h2 style="text-align:center;background-color:#9df6ff;">SCRIPT RESUME FINALISASI AGREEMENT</h2>
<p>OP : Tanyakan mengenai Alamat lengkap (Boleh di sebutkan pak/bu untuk alamat lengkapnya, Jalan, No. Rumah, RT./RW., Desa/Kelurahan, Kecamatan) Jika sudah maka tanyakan untuk patokannya (Bisa dekat dengan Masjid/Gereja, Sekolah, Kantor Desa, dll. Jika ingin lebih spesifik tanyakan Cat Rumahnya warna apa) <br>
OP : Jika Alamat sudah lengkap pastikan menanyakan Nama Familiar di Lingkungan (Contoh untuk di lingkungan Bapak/Ibu dikenalnya dengan Nama siapa ya Pak/Bu, mungkin contoh Mama Dinda, Suwardi Tukang, Suparno Meubel, dll). Jika nama familiar sudah didapat, bisa di input di belakang nama Customer di CRM. <br>
OP : Kemudian OP wajib mengingatkan agar nomor telepon customer wajib Aktif, dan menanyakan nomor telepon customer yang lain, bisa nomor Istri, Suami, Anak atau orang yang ada di rumah (Karena jika saat COD kurir menghubungi nomor customer tidak aktif, maka kurir bisa menghubungi nomor yang 1 nya lagi) Jika dapat nomor telepon yang satu nya maka Input di Kolom Last name pada PANEL. <br>
OP : Ketika Saat Perjanjian Penawaran Lisan maka OP wajib memberikan pertanyakan tambahan ke customer tentang berapa dana yang harus dibayarkan, dengan tujuan customer ini peduli dan sadar terhadap pesanan dan jumlah yang harus di bayarkan kepada kurirnya berapa. <br>
<b>Resume Finalisasi : Disini saya ulangi ya pak, Bahwa Bapak Fulan (Bapak Fulan Tukang) pada hari Rabu tanggal 2 November 2022 melakukan pemesanan untuk produk EPROS  dengan total harga 1,190,000 , untuk pengiriman ke Alamat Jl. Kasih Sayang, Gang Cinta, No.12, RT.05 / RW.07, Kel. Maju Jaya, Kec. Maju Sukses, Kab. Maju Makmur, Prov. DKI Jakarta, 12345, Patokan 15 Meter dari Masjid At-Taqwa.
</b> <br> <b>“Disini saya berjanji untuk mengirimkan produk dengan kualitas terbaik, dan di satu sisi Bapak Fulan juga berjanji untuk membayarkan paketnya ketika sudah datang, disini Bapak setuju ya? (pastikan customer mengatakan Setuju/Iya), Baik Boleh disebutkan Pak tadi berapa yang harus dibayarkan? (<p style="color:red;">Pastikan Customer mengatakan total jumlah yang sesuai dengan yang kita jelaskan</p>).”</b>
</p>
</div>
</div>

<div class="container" id="obatscript" >
  <div class="item" style="width: 150%;"> <h1>SCRIPT OBAT</h1>
   <p>Soon</p>
</div> 
</div>


</div>
</div>
<!-- --------------------------------------------------------------------------------------------------------------- -->
 <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./assets/js/expert.js"></script>
    <script src="JS/dashboard.js"></script>
    <script type="text/javascript" src="./assets/js/jquery.js"></script>
    <script src="./assets/js/main.js"></script>

    <!-- Audios -->
    <audio id="audio_remote" autoplay="autoplay"> </audio>
    <audio id="ringtone" loop src="sounds/ringtone.wav"> </audio>
    <audio id="ringbacktone" loop src="sounds/ringbacktone.wav"> </audio>
    <audio id="dtmfTone" src="sounds/dtmf.wav"> </audio>


    <script>
const loginTime = localStorage.getItem('loginTime') || new Date();
localStorage.setItem('loginTime', loginTime);


function padWithZero(number) {
  return number < 10 ? `0${number}` : `${number}`;
}

function calculateLoginDuration() {
  const currentTime = new Date();
  const timeDifference = currentTime - new Date(loginTime);
  const hours = Math.floor(timeDifference / (1000 * 60 * 60));
  const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
  const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);
  const duration = `${padWithZero(hours)}:${padWithZero(minutes)}:${padWithZero(seconds)}`;
  localStorage.setItem('duration', duration);
  document.getElementById('loginDuration').innerText = duration;
}
                                     
    var xhr = new XMLHttpRequest();
    var date = new Date();
    var tanggal = date.getDate();
    var bulan = date.getMonth() + 1; 
    var tahun = date.getFullYear();
    var finalDate = tahun + "-" + bulan + "-" + tanggal;
        xhr.open("GET", "sessionlog.php?user_id=<?php echo $id_operator; ?>&date=" + finalDate, true);
        xhr.send();

        function logOut() {
    var xhr = new XMLHttpRequest();
    var duration = localStorage.getItem('duration');
    var durClean = duration.replace('Login Time :','');
    var timeParts = durClean.split(':');
    var hours = parseInt(timeParts[0]);
    var minutes = parseInt(timeParts[1]);
    var seconds = parseInt(timeParts[2]);
    var totalSeconds = (hours * 60 * 60) + (minutes * 60) + seconds;

        xhr.open("GET", "updatesession.php?duration=" + totalSeconds, true);
        xhr.send();
        localStorage.removeItem('duration');
        localStorage.removeItem('loginTime');
        };


calculateLoginDuration();
setInterval(calculateLoginDuration, 1000);
</script>


    <script type="text/javascript">
      try {
        var pageTracker = _gat._getTracker("UA-6868621-19");
        pageTracker._trackPageview();
      } catch (err) { }
    </script>
 <script>
  document.getElementById('clearLocalStorageButton').addEventListener('click', function() {
      localStorage.clear();
      alert('LocalStorage deleted.');
  });
</script>
<script>

</script>


<script>
  var setting = document.getElementById('expert');
  var backset = document.getElementById('backset');
  document.getElementById('btnSetting').addEventListener('click', function() {
    setting.style.display = 'block';
    backset.style.display = 'flex';
  });

  document.getElementById('btnSettingClose').addEventListener('click', function() {
    setting.style.display = 'none';
    backset.style.display = 'none';
  })
</script>


<script>
    function showNotification(type, message) {
  const container = document.getElementById('container');
  const status = document.getElementById('status');

  if (type === 'success') {
    container.style.display = 'flex';
    status.innerText = message;
  }
}

function hideNotification() {
  document.getElementById('container').style.display = 'none';
}

function calculateTotal() {
        var amount = parseInt(document.getElementById('amountInput').value);
        var price = parseInt(document.getElementById('priceInput').value);

        // Periksa apakah nilai amount dan price adalah angka yang valid
        if (!isNaN(amount) && !isNaN(price)) {
            var total = amount * price;
            document.getElementById('totalAmount').value = total;
        } else {
            document.getElementById('totalAmount').value = '';
        }
    }

    function calculateTotal2() {
        var amount = parseInt(document.getElementById('amountInput2').value);
        var price = parseInt(document.getElementById('priceInput2').value);

        // Periksa apakah nilai amount dan price adalah angka yang valid
        if (!isNaN(amount) && !isNaN(price)) {
            var total = amount * price;
            document.getElementById('totalAmount2').value = total;
        } else {
            document.getElementById('totalAmount2').value = '';
        }
    }


$(document).ready(function () {
$("#myForm").submit(function (event) {

var formData = {
id: $("#idcustomer").val(),
nama_guest: $("#firstname").val(),
nama_guest1: $("#lastname").val(),
phone: $("#phone").val(),
country: $("#country").val(),
timezone: $("#timezonee").val(),
addres: $("#address").val(),
state: $("#stateSelect").val(),
city: $("#citySelect").val(),
zip: $("#zip").val(),
gender : $("input[name='gender']:checked").val(),
email: $("#email").val(),
age: $("#age").val(),
height: $("#height").val(),
chronic: $("#chronic").val(),
married: $("#married").val(),
children: $("#children").val(),
};

$.ajax({
  type: "POST",
  url: "edit.php",
  data: formData,
  dataType: "json",
  encode: true,
}).done(function (data) {
    if (data.success) {      
showNotification('success', 'Update Success');
} else {
showNotification('error', 'Update Failed');
}
});

event.preventDefault();
});
});


$(document).ready(function () {
$("#formDisclaimer").submit(function (event) {

var popup = document.getElementById("popupstatus1");

var formData = {
idcustomer: $("#idcus1").val(),
setstatus1: $("#setStatus1").val(),
statuscomment: $("#statuscom1").val(),
datecomment: $("#date1").val(),
};

$.ajax({
  type: "POST",
  url: "statusdisclaimer.php",
  data: formData,
  dataType: "json",
  encode: true,
}).done(function (data) {
    if (data.success) {      
popup.style.display = "none";
showNotification('success', 'Success');
} else {
showNotification('error', 'Failed');
popup.style.display = "none";
}
});

event.preventDefault();
});
});



$(document).ready(function () {
$("#formCallback").submit(function (event) {

var popups = document.getElementById("popupstatus2");

var formData = {
idcustomer: $("#idcus2").val(),
setstatus2: $("#setStatus2").val(),
statuscomment: $("#statuscom2").val(),
datecomment: $("#date2").val(),
};

$.ajax({
  type: "POST",
  url: "statuscallback.php",
  data: formData,
  dataType: "json",
  encode: true,
}).done(function (data) {
    if (data.success) {      
popups.style.display = "none";
showNotification('success', 'Success');
} else {
showNotification('error', 'Failed');
popups.style.display = "none";
}
});

event.preventDefault();
});
});



$(document).ready(function () {
$("#formNotconnect").submit(function (event) {

var popups = document.getElementById("popupstatus3");

var formData = {
idcustomer: $("#idcus3").val(),
setstatus3: $("#setStatus3").val(),
statuscomment: $("#statuscom3").val(),
datecomment: $("#date3").val(),
};

$.ajax({
  type: "POST",
  url: "statusnotconnect.php",
  data: formData,
  dataType: "json",
  encode: true,
}).done(function (data) {
    if (data.success) {      
popups.style.display = "none";
showNotification('success', 'Success');
} else {
showNotification('error', 'Failed');
popups.style.display = "none";
}
});

event.preventDefault();
});
});



$(document).ready(function () {
$("#formSpam").submit(function (event) {

var popups = document.getElementById("popupstatus");

var formData = {
idcustomer: $("#idcus").val(),
setstatus: $("#setStatus").val(),
statuscomment: $("#statuscom").val(),
datecomment: $("#date").val(),
};

$.ajax({
  type: "POST",
  url: "statusspam.php",
  data: formData,
  dataType: "json",
  encode: true,
}).done(function (data) {
    if (data.success) {      
popups.style.display = "none";
showNotification('success', 'Success');
} else {
showNotification('error', 'Failed');
popups.style.display = "none";
}
});

event.preventDefault();
});
});

$(document).ready(function () {
$("#myFormProduct").submit(function (event) {

    var formData = {
  id: $("#id").val(),
  nama_product: $("#namaproduct").val(),
  description: $("#description").val(),
  package: $("#pack").val(),
  shipment_type: $("#shipment").val(),
  amount: $("#amountInput").val(),
  price: $("#priceInput").val(),
  total: $("#totalAmount").val(),
  bank_payment: $("#bankpayment").is(":checked") ? "BPW" : "", // Periksa apakah checkbox dicentang
};

    $.ajax({
      type: "POST",
      url: "editproduct.php",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (data) {
        if (data.success) {      
showNotification('success', 'Update Success');
} else {
showNotification('error', 'Update Failed');
}
});

event.preventDefault();
});
});

$(document).ready(function () {
$("#formCombo").submit(function (event) {

    var formData = {
  id: $("#id2").val(),
  id_agent: $("#idAgent").val(),
  nama_product: $("#namaproduct2").val(),
  description: $("#description2").val(),
  package: $("#pack2").val(),
  shipment_type: $("#shipment2").val(),
  amount: $("#amountInput2").val(),
  price: $("#priceInput2").val(),
  total: $("#totalAmount2").val(),
  bank_payment: $("#bankpayment2").is(":checked") ? "BPW" : "", // Periksa apakah checkbox dicentang
};

    $.ajax({
      type: "POST",
      url: "combo.php",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (data) {
        if (data.success) {      
showNotification('success', 'Add Success');
} else {
showNotification('error', 'Add Failed');
}
});

event.preventDefault();
});
});

</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Ambil elemen-elemen select
        const editpopup = document.getElementById("edit");
        const editpopup2 = document.getElementById("addcombo");
        const popupedit = document.getElementById("popupedit");
        const popupedit2 = document.getElementById("popupedit2");
        const closePopup = document.getElementById("closePopupEdit");
        const closePopup2 = document.getElementById("closePopupEdit2");


        // Tambahkan event listener untuk masing-masing elemen select
        editpopup.addEventListener("click", function() {
            popupedit.style.display = "block";
        });

        closePopup.addEventListener("click", function() {
            popupedit.style.display = "none";
        });
      
        editpopup2.addEventListener("click", function() {
            popupedit2.style.display = "block";
        });

        closePopup2.addEventListener("click", function() {
            popupedit2.style.display = "none";
        });
    });
    </script>



    
</body> 
</html>