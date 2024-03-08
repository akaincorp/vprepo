<?php
include('koneksi/koneksi.php');
        $id_agent = $_GET['id_agent'];
        $query = "SELECT * FROM tb_agent WHERE id_agent = '$id_agent'";
        $result = mysqli_query($con, $query);

        while ($d = mysqli_fetch_assoc($result)) {
?>
<div class="editagent">
<div class="form-group">
    <label for="username" class="labelusername">Username :</label> 
    <input type="hidden" value="<?php echo $d['id_agent'];?>" id="idagentnew" name="idagent">
    <input type="text" class="form-control" value="<?php echo $d['username'];?>" name="username" id="oldusername" placeholder="Username">
</div>

<div class="form-group">
    <label for="password" class="labelpassword">New Password :</label> 
    <input type="text" class="form-control" name="password" id="newpassword" placeholder="New Password">
        </div>
    </div>
<?php } ?>
