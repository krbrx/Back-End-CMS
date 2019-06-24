<?php
session_start();
?>
<title>Information Content Library</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="javascript/animation.js"></script>
<?php
    require("config.php");
    if(isset($_POST['btnDelete'])) {
        $select = $_POST['select'];
        if(empty($select)){
            $warn ="Please ensure that the ID have being provided";
        }
        else{
            $process = "DELETE FROM story_library 
                        WHERE story_id = '$select' ";
            $run = mysqli_query($conn, $process);
        }

    }
?>
<div class="header">
    Information Content Library
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
        <form action="add-story.php">
            <input type="submit" value="Add Content" class="button editButton">
        </form>
        <table class="Table List">
            <tr>
                <th>Content ID</th>
                <th>Content Title</th>
                <th>Content</th>
                <th>Location ID</th>
            </tr>
            <?php
            require ("config.php");
            $sql = "SELECT * FROM story_library";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo "<tbody>";
                while($row = mysqli_fetch_assoc($result)) {
                    echo"<tr>";
                    echo"<td>".$row["story_id"]."</td>";
                    echo"<td>".$row["story_name"]."</td>";
                    echo"<td>".$row["story_content"]."</td>";
                    echo"<td>".$row["location_id"]."</td>";
                    echo"</tr>";
                }
                echo "</tbody>";
            }
            else{
                header("location: add-story.php");
            }
            ?>
        </table>
        <div class="con1">
            <p>Enter the ID of the specific content that needs to be deleted:</p>
            <form action="#" method="POST">
                <div class="form-group">
                    <input type="text" name="select">
                    <p><? echo $warn ?></p>
                    <input type="submit" value="Delete Selected Content" class="button" id="quesEdit" name="btnDelete">
                </div>
            </form>
        </div>
        <div class="con2">
            <p>Enter the ID of the specific question that needs to be edited:</p>
            <form action="edit-story.php" method="POST">
                <div class="form-group">
                    <input type="text" name="selectEdit">
                    <p><? echo $warn ?></p>
                    <input type="submit" value="Edit Selected Content" class="button" id="quesEdit" name="btnEdit">
                </div>
            </form>
        </div>
        <br>
        <button class="button btn1">Delete Certain Content</button> <button class="button btn2">Edit Certain Content</button>
    </div>
</div>