<?php
session_start();
?>
<title>Edit Video Information</title>
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
    if(isset($_POST['btnEditVid'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $locId = $_POST['locId'];
        $file = $_POST['vid'];
        $target = "video-library/".$file.".mp4";
        if(!empty($name)){
            $update1 = "UPDATE vid_library 
                        SET vid_name = '$name'
                        WHERE vid_id ='$id' ";
            $result1 = mysqli_query($conn, $update1);
            header("location: vid.php");
        }
        if(!empty($locId)){
            $update2 = "UPDATE vid_library 
                        SET location_id = '$locId'
                        WHERE vid_id ='$id' ";
            $result2 = mysqli_query($conn, $update2);
            header("location: vid.php");
        }
        if(!empty($file)){
            $id = $_POST['selectEdit'];
            $update3 = "UPDATE vid_library 
                        SET vid_dir = '$target'
                        WHERE vid_id ='$id' ";
            $result3 = mysqli_query($conn, $update3);
            header("location: vid.php");
        }
    }
?>
<div class="header">
    Edit Video Information
    <div class="logout">
        <a href="logout.php">Log out</a>
    </div>
    <div class="logout">
        <a href="edit-admin.php">Change Password</a>
    </div>
    <div class="logout">
        <a href="vid.php">Back</a>
    </div>
    <div class="logout">
        <a href="home.php">Home</a>
    </div>
</div>
<div class="border">
    <div class="inBorder">
        <h5>Ensure that the video is modified in the server before editing.</h5>
        <div class="edit">
            <?php
                $vidId = $_POST['selectEdit'];
                if(empty($vidId)){
                    header("location: vid.php");
                }
                if (!isset($_SESSION["user_id"]))
                {
                    header("location: index.php");
                }
                require ("config.php");
                $sql = "SELECT * FROM vid_library
                        WHERE vid_id ='$vidId'";
                $result = mysqli_query($conn, $sql);
                $data = mysqli_fetch_assoc($result);
                if($data <= 0){
                    header("location: vid.php");
                }
            ?>
            <form action="#" method="POST">
                <input type="hidden" value="<? echo $vidId ?>" name="id">
                Video Name<br>
                <input type="text" name="name" placeholder="<? echo $data["vid_name"]?>"><br><br>
                File Name(Same name as the one on server)<br>
                <input type="text" name="vid" placeholder="<? echo $data["vid_dir"]?>"><br><br>
                Location(Which location is the video linked to)<br><br>
                <input type="text" name="locId" placeholder="<? echo $data["location_id"]?>">
                <br>
                <input type="submit" value="Update" class="button" id="quesSave" name="btnEditVid">
            </form>
        </div>
    </div>
</div>
