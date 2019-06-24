<?php
session_start();
?>
<title>Add Story Content</title>
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
        $search = "SELECT * FROM story_library";
        $result = mysqli_query($conn, $search);
        $count = mysqli_num_rows($result);
        $counting = $count+1;
        $id = "story_"."$counting";
        $title = $_POST['title'];
        $content = $_POST['content'];
        $locId = $_POST['locId'];
        if (empty($title)&&empty($content)&&empty($locId)){
            $warnTitle="*Please enter the title";
            $warnCon="*Please enter the content";
            $warnLoc="*Please enter the location name";
        }
        else if (empty($title)){
            $warnTitle="Please enter the title";
        }
        else if (empty($content)){
            $warnCon="Please enter the content";
        }
        else if (empty($locId)){
            $warnLoc="Please enter the location name";
        }
        else{
            $sql = "INSERT INTO story_library(story_id, story_name, story_content, location_id)
                    VALUES ('$id','$title','$content','$locId')";
            $result = mysqli_query($conn, $sql);
            header("location: story.php");
        }
    }
?>
<div class="header">
    Add Story Content
    <div class="logout">
        <a href="logout.php">Log out</a>
    </div>
    <div class="logout">
        <a href="edit-admin.php">Change Password</a>
    </div>
    <div class="logout">
        <a href="story.php">Back</a>
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
                    Content Title
                    <br>
                    <input type="text" name="title">
                    <p class="error"><? echo $warnTitle?></p>
                    <br>
                    Content
                    <br>
                    <textarea name="content"></textarea>
                    <p class="error"><? echo $warnCon?></p>
                    <br>
                    Location ID(Which location is the content linked to)
                    <br>
                    <input type="text" name="locId">
                    <p class="error"><? echo $warnLoc?></p>
                    <br>
                    <input type="submit" value="Add Story Content" class="button Save" name="btnSubmit">
                </div>
            </form>
        </div>
    </div>
</div>