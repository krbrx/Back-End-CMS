<?php
session_start();
?>
<title>Edit Audio Track Information</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="javascript/animation.js"></script>
<?php
    require ("config.php");
    if(isset($_POST['btnEditAud'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $locId = $_POST['locId'];
        $file = $_POST['aud'];
        $target = "audio-library/".$file.".mp3";
        if(!empty($name)){
            $update1 = "UPDATE audio_library 
                        SET audio_name = '$name'
                        WHERE audio_id ='$id' ";
            $result1 = mysqli_query($conn, $update1);
            header("location: audio.php");
        }
        if(!empty($locId)){
            $update2 = "UPDATE audio_library
                        SET location_id = '$locId'
                        WHERE audio_id ='$id'";
            $result2 = mysqli_query($conn, $update2);
            header("location: audio.php");
        }
        if(!empty($file)){
            $update3 = "UPDATE audio_library
                      SET audio_dir = '$target'
                      WHERE audio_id ='$id'";
            $result3 = mysqli_query($conn, $update3);
            header("location: audio.php");
        }
    }
?>
<div class="header">
    Edit Audio Track
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
        <h5>Ensure that audio track is modified in the server before editing.</h5>
            <?php
                $audId = $_POST['selectEdit'];
                if(empty($audId)){
                    header("location: audio.php");
                }
                if (!isset($_SESSION["user_id"]))
                {
                    header("location: index.php");
                }
                require ("config.php");
                $sql = "SELECT * FROM audio_library
                        WHERE audio_id ='$audId'";
                $result = mysqli_query($conn, $sql);
                $data = mysqli_fetch_assoc($result);
                if($data <= 0){
                    header("location: audio.php");
                }
            ?>
        <div class="edit">
            <form action="#" method="POST">
                <div class="form-group">
                    <input type="hidden" value="<? echo $audId ?>" name="id">
                    Audio Name<br>
                    <input type="text" name="name" placeholder="<? echo $data["audio_name"]?>"><br><br>
                    File Name(Same name as the one on server)<br>
                    <input type="text" name="aud" placeholder="<? echo $data["audio_dir"]?>"><br><br>
                    Location ID<br>
                    <input type="text" name="locId" placeholder="<? echo $data["location_id"]?>"><br><br>
                    <input type="submit" value="Update Audio Track" class="button" id="quesSave" name="btnEditAud">
                </div>
            </form>
        </div>
    </div>
</div>


