<?php
session_start();
?>
<title>Quiz Library</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="javascript/animation.js"></script>
<?php
    require ("config.php");
    if(isset($_POST['btnDelete'])) {
        $select = $_POST['selectDelete'];
        if(empty($select)){
            $warn ="Please ensure that the ID have being provided";
        }
        else{
            $process = "DELETE FROM quiz_library 
                        WHERE question_id = '$select' ";
            $run = mysqli_query($conn, $process);
        }
    }
?>
<div class="header">
    Quiz Library
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
        <form action="add-quiz.php">
           <input type="submit" value="Add Question" class="button editButton">
        </form>
        <table class="Table List">
            <tr>
                <th>Question ID</th>
                <th>Question</th>
                <th>Choice A</th>
                <th>Choice B</th>
                <th>Choice C</th>
                <th>Choice D</th>
                <th>Correct Answer</th>
                <th>Location ID</th>
            </tr>
            <?php
                require ("config.php");
                $sql = "SELECT * FROM quiz_library";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    echo "<tbody>";
                    while($row = mysqli_fetch_assoc($result)) {
                        echo"<tr>";
                        echo"<td>".$row["question_id"]."</td>";
                        echo"<td>".$row["question"]."</td>";
                        echo"<td>".$row["choice_a"]."</td>";
                        echo"<td>".$row["choice_b"]."</td>";
                        echo"<td>".$row["choice_c"]."</td>";
                        echo"<td>".$row["choice_d"]."</td>";
                        echo"<td>".$row["right_ans"]."</td>";
                        echo"<td>".$row["location_id"]."</td>";
                        echo"</tr>";
                    }
                    echo "</tbody>";
                }
                else{
                    header("location: add-quiz.php");
                }
             ?>
        </table>
        <div class="con1">
            <p>Enter the ID of the specific question that needs to be deleted:</p>
            <form action="#" method="POST">
                <div class="form-group">
                    <input type="text" name="selectDelete">
                    <p><? echo $warn ?></p>
                    <input type="submit" value="Delete Selected Content" class="button" id="quesEdit" name="btnDelete">
                </div>
            </form>
        </div>
        <div class="con2">
            <p>Enter the ID of the specific question that needs to be edited:</p>
            <form action="edit-quiz.php" method="POST">
                <div class="form-group">
                    <input type="text" name="selectEdit">
                    <p><? echo $warn ?></p>
                    <input type="submit" value="Edit Selected Content" class="button" id="quesEdit" name="btnEdit">
                </div>
            </form>
        </div>
        <br>
        <button class="button btn1">Delete Certain Question</button> <button class="button btn2">Edit Certain Question</button>
    </div>
</div>