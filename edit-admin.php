<?php
session_start();
?>
<title>Change Admin Password</title>
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
    if(isset($_POST['btnSubmit'])){
        $current = $_POST['current'];
        $new= $_POST['new'];
        $confirm= $_POST['confirm'];
        if(empty($current) && empty($new) && empty($confirm)){
            $warnCurrent = "*Please enter your current password";
            $warnNew = "*Please enter your new password";
            $warnConfirm = "*Please enter the validation password";
        }
        else if(empty($current)){
            $warnCurrent = "*Please enter your current password";
        }
        else if(empty($new)){
            $warnNew = "*Please enter your new password";
        }
        else if(empty($confirm)){
            $warnNew = "*Please enter the validation password";
        }
        else if($new !== $confirm){
            $warnConfirm = "*Validation password does not match your new password";
        }
        else if($new == $confirm){
            $sql = "SELECT password FROM `admin` WHERE admin_id = '$admin_id' AND password = md5('$current')";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $count = mysqli_num_rows($result);
            if ($count > 0) {
                $update= "UPDATE admin
                SET password = '".md5($new)."'
                WHERE admin_id = '$admin_id'";
                $result2 = mysqli_query($conn, $update);
                header("location: home.php");
            }
        }
    }
?>
<div class="header">
    Change Admin Password
    <div class="logout">
        <a href="logout.php">Log out</a>
    </div>
    <div class="logout">
        <a href="edit-admin.php">Change Password</a>
    </div>
    <div class="logout">
        <a href="home.php">Back</a>
    </div>
    <div class="logout">
        <a href="home.php">Home</a>
    </div>
</div>
<div class="border">
    <div class="inBorder">
        <div class="edit">
            <form action="#" method="POST">
                <div class="form-group">
                    <p>Current Password</p>
                    <input type="password" name="current" id="username" placeholder="Current Password">
                    <p class="error"><? echo $warnCurrent?></p>
                    <p>New Password</p>
                    <input type="password" name="new" id="password" placeholder="New Password">
                    <p class="error"><? echo $warnNew?></p>
                    <p>Confirm New Password</p>
                    <input type="password" name="confirm" id="password" placeholder="Confirm New Password">
                    <p class="error"><? echo $warnConfirm?></p>
                    <input type="submit" value="Update Password" class="button" name="btnSubmit">
                </div>
            </form>
        </div>
    </div>
</div>