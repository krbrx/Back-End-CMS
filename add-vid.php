<?php
session_start();
?>
<title>Adding Video</title>
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
    require ("config.php");
    if(isset($_POST['btnSubmit'])) {
        $search = "SELECT * FROM vid_library";
        $result = mysqli_query($conn, $search);
        $count = mysqli_num_rows($result);
        $counting = $count+1;
        $vidId ="vid_"."$counting";
        $name = $_POST['name'];
        $locId = $_POST['locId'];
        $file = $_POST['vid'];
        $target = "video-library/".$file.".mp4";
        if(empty($name) && empty($locId) && empty($file)){
            $warnName="*Please enter the title";
            $warnFile="*Please enter the video file's name";
            $warnLocId="*Please enter the location name";
        }
        else if(empty($name)){
            $warnName="Please enter the title";
        }
        else if(empty($file)){
            $warnFile="Please enter the video file's name";
        }
        else if(empty($locId)){
            $warnLocId="Please enter the location name";
        }
        else{
            $sql = "INSERT INTO vid_library(vid_id,vid_name,location_id,vid_dir)
                    VALUES ('$vidId','$name','$locId','$target')";
            $result = mysqli_query($conn, $sql);
            header("location: vid.php");
        }
    }
?>
<div class="header">
    Adding New Video
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
        <h5>Ensure that the video is place in the server before adding this list.</h5>
        <div class="edit">
            <form action="#" method="POST">
                <div class="form-group">
                    Video Name<br>
                    <input type="text" name="name"><br><br>
                    File Name(Same name as the one on server)<br>
                    <input type="text" name="vid"><br><br>
                    Location ID(Which location is the video linked to)<br><br>
                    <input type="text" name="locId">
                    <br>
                    <input type="submit" value="Add Video To Library" class="button Save" name="btnSubmit">
                </div>
            </form>
        </div>
    </div>
</div>
