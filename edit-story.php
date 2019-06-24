<?php
session_start();
?>
<title>Edit Story Content</title>
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
    if(isset($_POST['btnEditStory'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $content = $_POST['content'];
        $locId = $_POST['locId'];
        if (!empty($name)){
            $update1 = "UPDATE story_library 
                        SET story_name = '$name'
                        WHERE story_id ='$id' ";
            $result1 = mysqli_query($conn, $update1);
            header("location: story.php");
        }
        if (!empty($content)){
            $update2 = "UPDATE story_library 
                        SET story_content = '$content'
                        WHERE story_id ='$id' ";
            $result2 = mysqli_query($conn, $update2);
            header("location: story.php");
        }
        if (!empty($locId)){
            $update3 = "UPDATE story_library 
                        SET location_id = '$locId'
                        WHERE story_id ='$id' ";
            $result3 = mysqli_query($conn, $update3);
            header("location: story.php");
        }
    }
?>
<div class="header">
    Edit Story Content
    <div class="logout">
        <a href="logout.php">Log out</a>
    </div>
    <div class="logout">
        <a href="edit-admin.php">Change Password</a>
    </div>
    <div class="logout">
        <a href="quiz.php">Back</a>
    </div>
    <div class="logout">
        <a href="home.php">Home</a>
    </div>
</div>
<div class="border">
    <div class="inBorder">
        <div class="edit">
            <?php
                $storyId = $_POST['selectEdit'];
                if (!isset($_SESSION["user_id"]))
                {
                    header("location: index.php");
                }
                require ("config.php");
                $sql = "SELECT * FROM story_library
                        WHERE story_id ='$storyId'";
                $result = mysqli_query($conn, $sql);
                $data = mysqli_fetch_assoc($result);
            ?>
            <form action="#" method="POST">
                <div class="form-group">
                    <input type="hidden" value="<? echo $storyId ?>" name="id">
                    Content Title<br>
                    <input type="text" name="name" placeholder="<?echo $data["story_name"]?>"><br><br>
                    Content<br>
                    <textarea name="content" placeholder="<?echo $data["story_content"]?>"></textarea><br><br>
                    Location ID(Which location is the content linked to)<br>
                    <input type="text" name="locId" placeholder="<?echo $data["location_id"]?>"><br><br>
                    <input type="submit" value="Edit Story Content" class="button" id="quesSave" name="btnEditStory">
                </div>
            </form>
        </div>
    </div>
</div>