<?php
session_start();
?>
<title>Adding Audio Track</title>
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
        $search = "SELECT * FROM audio_library";
        $result = mysqli_query($conn, $search);
        $count = mysqli_num_rows($result);
        $counting = $count+1;
        $audId ="aud_"."$counting";
        $name = $_POST['name'];
        $locId = $_POST['locId'];
        $file = $_POST['aud'];
        $target = "audio-library/".$file.".mp3";
        if(empty($name) && empty($locId) && empty($file)){
            $warnName="*Please enter the title";
            $warnFile="*Please enter the audio file's name";
            $warnLocId="*Please enter the location name";
        }
        else if(empty($name)){
            $warnName="Please enter the title";
        }
        else if(empty($locId)){
            $warnLocId="Please enter the location name";
        }
        else if(empty($file)){
            $warnFile="Please enter the audio file's name";
        }
        else{
            $sql = "INSERT INTO audio_library(audio_id,audio_name,audio_dir,location_id)
                    VALUES ('$audId','$name','$target','$locId')";
            $result = mysqli_query($conn, $sql);
            header("location: audio.php");
        }
    }
?>
<div class="header">
    Adding New Audio Track
    <div class="logout">
        <a href="logout.php">Log out</a>
    </div>
    <div class="logout">
        <a href="edit-admin.php">Change Password</a>
    </div>
    <div class="logout">
        <a href="audio.php">Back</a>
    </div>
    <div class="logout">
        <a href="home.php">Home</a>
    </div>
</div>
<div class="border">
    <div class="inBorder">
        <h5>Ensure the audio track is placed before adding this list.</h5>
        <div class="edit">
            <form action="#" method="POST">
                <div class="form-group">
                    Audio Name<br>
                    <input type="text" name="name">
                    <p class="error"><? echo $warnName?></p>
                    File Name(Same name as the one on server)<br>
                    <input type="text" name="aud">
                    <p class="error"><? echo $warnFile?></p>
                    Location ID<br>
                    <input type="text" name="locId">
                    <p class="error"><? echo $warnName?></p>
                    <input type="submit" value="Add Audio Track" class="button Save" name="btnSubmit">
                </div>
            </form>
        </div>
    </div>
</div>

