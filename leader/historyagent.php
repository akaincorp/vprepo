



<div class="card card-secondary">
<div class="card-header">
<?php
include('koneksi/koneksi.php');
        $no = 1;
        $orderid = $_GET['order_id'];
        $operator = "SELECT * FROM history_agent 
        JOIN tb_agent ON history_agent.id_agent = tb_agent.id_agent
                 JOIN tb_callback ON history_agent.id_status = tb_callback.id_status
                 JOIN tb_notconnect ON history_agent.id_statusc = tb_notconnect.id_statusc
                 JOIN tb_disclaimer ON history_agent.id_statusb = tb_disclaimer.id_statusb
                 JOIN tb_spam ON history_agent.id_statusd = tb_spam.id_statusd
         WHERE history_agent.order_id = '$orderid'";
        $data = mysqli_query($con, $operator);
        echo  "<h3 class='card-title' style='text-align:center;' >Order Number :  $orderid</h3>";
?>                     
</div>
                      <!-- /.card-header -->
<div class="card-body">
<table class="table table-bordered text-xs">
    <thead>

        <tr>
            <th>Date</th>
            <th>Agent</th>
            <th>Status</th>
            <th>Comment</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        while ($d = mysqli_fetch_assoc($data)) {
            echo '<tr>'; // Mulai baris baru untuk setiap entri data
            echo '<td>' . $d['date_comment'] . '</td>';
            echo '<td>' . $d['username'] . '</td>';
            echo '<td>' . $d['status'] . ' ' . $d['statusb'] . ' ' . $d['statusc'] . ' ' . $d['statusd'] . '</td>';
            echo '<td>' . $d['operator_comment'] . '</td>';
            echo '</tr>'; // Tutup baris setelah menambahkan data
        }
        ?>
    </tbody>
</table>
    </div>
</div>


<?php 
                include ('koneksi/koneksi.php');
                $orderid = $_GET['order_id'];
                $selectquery = "SELECT * FROM history_agent WHERE order_id = '$orderid' ORDER BY date_comment DESC LIMIT 1";
                $resultselect = mysqli_query($con,$selectquery);

                while ($d = mysqli_fetch_array($resultselect)) {
                ?>
<input type="hidden" value="<?php echo $d['id_customer']; ?>" class="numb" name="id">

<div class="row">
    <div class="col-md-6">  
        <div class="card card-secondary">
                      <div class="card-header">
                        <h3 class="card-title">Customer Features</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                <div>
                    <strong>Full Name:</strong>
                    <span> <?php echo $d['first_name'] . ' ' . $d['last_name']; ?></span>
                </div>
                <div>
                    <strong>Gender:</strong>
                    <span><?php echo $d['gender'];?></span>
                </div>
                <div>
                    <strong>Email:</strong>
                    <span><?php echo $d['email'];?></span>
                </div>
                <div>
                    <strong>Age:</strong>
                    <span><?php echo $d['age'];?></span>
                </div>
                <div>
                    <strong>Height:</strong>
                    <span><?php echo $d['height'];?></span>
                </div>
                <div>
                    <strong>Chronic Disease:</strong>
                    <span><?php echo $d['Chronic_disease'];?></span>
                </div>
                <div>
                    <strong>Married:</strong>
                    <span><?php echo $d['married'];?></span>
                </div>
                <div>
                    <strong>Children:</strong>
                    <span><?php echo $d['children'];?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">  
        <div class="card card-secondary">
                      <div class="card-header">
                        <h3 class="card-title">Address</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                <div>
                    <strong>Address:</strong>
                    <span> <?php echo $d['addrest_list']; ?></span>
                </div>
                <div>
                    <strong>City:</strong>
                    <span><?php echo $d['city'];?></span>
                </div>
                <div>
                    <strong>Zip Code:</strong>
                    <span><?php echo $d['zip'];?></span>
                </div>
                <div>
                    <strong>Phone:</strong>
                    <span><?php echo $d['phone'];?></span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>