<?php
session_start();
?>
<title>Edit QR Code Image Target</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="javascript/animation.js"></script>
<?php
    if (!isset($_SESSION["user_id"]))
    {
        header("location: index.php");
    }
    else{
        $admin_id = $_SESSION["user_id"];
    }
    require ("config.php");
    if(isset($_POST['btnEditQR'])) {
        $id = $_POST['id'];
        $locName = $_POST['locName'];
        $locId = $_POST['locId'];
        $file = $_POST['qr'];
        $target = "qr-library/".$file.".jpg";
        if(!empty($locId)){
            $update1 = "UPDATE qr_library 
                        SET location_id = '$locId'
                        WHERE qr_id ='$id'";
            $result1 = mysqli_query($conn, $update1);
            header("location: qr.php");
        }
        if(!empty($locName)){
            $update2 = "UPDATE qr_library 
                        SET location_name = '$locName'
                        WHERE qr_id ='$id'";
            $result2 = mysqli_query($conn, $update2);
            header("location: qr.php");
        }
        if(!empty($file)){
            $update3 = "UPDATE qr_library 
                        SET qr_dir = '$target'
                        WHERE qr_id ='$id'";
            $result3 = mysqli_query($conn, $update3);
            header("location: qr.php");
        }
    }
?>
<div class="header">
    Edit QR Code Image Target
    <div class="logout">
        <a href="logout.php">Log out</a>
    </div>
    <div class="logout">
        <a href="edit-admin.php">Change Password</a>
    </div>
    <div class="logout">
        <a href="qr.php">Back</a>
    </div>
    <div class="logout">
        <a href="home.php">Home</a>
    </div>
</div>
<div class="border">
    <div class="inBorder">
        <h5>Ensure the QR code image target is in the server before editing.</h5>
        <div class="edit">
            <?php
            $qrId = $_POST['selectEdit'];
            if(empty($qrId)){
                header("location: qr.php");
            }
            if (!isset($_SESSION["user_id"]))
            {
                header("location: index.php");
            }
            require ("config.php");
            $sql = "SELECT * FROM qr_library
                    WHERE qr_id ='$qrId'";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($result);
            if($data <= 0){
                header("location: qr.php");
            }
            ?>
            <form action="#" method="POST">
                <div class="form-group">
                    <input type="hidden" value="<? echo $qrId ?>" name="id">
                    File Name(Same name as the one on server)<br>
                    <input type="text" name="qr" placeholder="<? echo $data["qr_dir"]?>"><br><br>
                    Location Name(Which location is the QR linked to)<br>
                    <input type="text" name="locName" placeholder="<? echo $data["location_name"]?>"><br><br>
                    Location ID(Which location is the QR linked to)<br><br>
                    <input type="text" name="locId" placeholder="<? echo $data["location_id"]?>"><br><br>
                    <input type="submit" value="Edit QR Code Image Target" class=button id=quesSave name="btnEditQR"><br>
                </div>
            </form>

        </div>
    </div>
</div>

