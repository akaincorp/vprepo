<?php 
 include('koneksi/koneksi.php'); 
 $affid = $_GET['affid'];
 $selectoutstanding = "SELECT * FROM tb_outstanding
                 JOIN tb_procces ON tb_outstanding.id_statusf = tb_procces.id_statusf
                 JOIN tb_callback ON tb_outstanding.id_status = tb_callback.id_status
                 JOIN tb_notconnect ON tb_outstanding.id_statusc = tb_notconnect.id_statusc
                 JOIN tb_disclaimer ON tb_outstanding.id_statusb = tb_disclaimer.id_statusb
                 JOIN tb_spam ON tb_outstanding.id_statusd = tb_spam.id_statusd
                 JOIN tb_agent ON tb_outstanding.id_agent = tb_agent.id_agent WHERE affid = '$affid'";

 $resultoutstanding = mysqli_query($con, $selectoutstanding);
?>

<table id="example1" class="table table-bordered table-striped mt-5 text-xs">
                  <thead>
                  <tr>
                <th>Order</th>
                <th>Status</th>
                <th>Address</th>
                <th>Products</th>
                <th>Price</th>
            </tr>
                  </thead>
                  <tbody>
                  <?php while ( $d = mysqli_fetch_array($resultoutstanding)) {
            ?>
            <tr>

                <td style="background-color:#d5ffd5;"><?php echo $d['username']; ?><br>
                    <?php echo $d['order_date']; ?><br>
                    <b data-toggle="modal" data-target="#modal-lg2" style="cursor:pointer;" onclick="openModalOutstanding(<?php echo $d['order_id']; ?>)"><?php echo $d['order_id']; ?></b>   
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