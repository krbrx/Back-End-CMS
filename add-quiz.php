<?php
session_start();
?>
<title>Add Quiz Question</title>
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
    if(isset($_POST['btnSubmit'])){
        $search = "SELECT * FROM quiz_library";
        $result = mysqli_query($conn, $search);
        $count = mysqli_num_rows($result);
        $counting = $count+1;
        $id = "question_"."$counting";
        $q = $_POST['q'];
        $a = $_POST['a'];
        $b = $_POST['b'];
        $c = $_POST['c'];
        $d = $_POST['d'];
        $ans = $_POST['ans'];
        $locId = $_POST['locId'];
        if (empty($q)&&empty($a)&&empty($b)&&empty($c)&&empty($d)&&empty($ans)&&empty($locId)){
            $warnQ="*Please enter the question";
            $warnA="*Please enter choice A";
            $warnB="*Please enter choice B";
            $warnC="*Please enter choice C";
            $warnD="*Please enter choice D";
            $warnAns="*Please enter the right answer";
            $warnLoc="*Please enter the location's ID";
        }
        else if (empty($q)){
            $warnQ="*Please enter the question";
        }
        else if (empty($a)){
            $warnA="*Please enter choice A";
        }
        else if (empty($b)){
            $warnB="*Please enter choice B";
        }
        else if (empty($c)){
            $warnC="*Please enter choice C";
        }
        else if (empty($d)){
            $warnD="*Please enter choice D";
        }
        else if (empty($ans)){
            $warnAns="*Please enter the right answer";
        }
        else if (empty($locId)){
            $warnLoc="*Please enter the location's ID";
        }
        else{
            $sql = "INSERT INTO quiz_library(question_id,question,choice_a,choice_b,choice_c,choice_d,right_ans,location_id)
                VALUES ('$id','$q','$a','$b','$c','$d','$ans','$locId')";
            $result = mysqli_query($conn, $sql);
            header("location: quiz.php");
        }
    }
?>
<div class="header">
    Add Quiz Question
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
            <form action="#" method="POST">
                <div class="form-group">
                    Question<br>
                    <textarea name="q"></textarea>
                    <p class="error"><? echo $warnQ?></p>
                    <br>
                    Choice A<br>
                    <input type="text" name="a">
                    <p class="error"><? echo $warnA?></p>
                    <br>
                    Choice B<br>
                    <input type="text" name="b">
                    <p class="error"><? echo $warnB?></p>
                    <br>
                    Choice C<br>
                    <input type="text" name="c">
                    <p class="error"><? echo $warnC?></p>
                    <br>
                    Choice D<br>
                    <input type="text" name="d">
                    <p class="error"><? echo $warnD?></p>
                    <br>
                    Correct Answer<br>
                    <input type="text" name="ans">
                    <p class="error"><? echo $warnAns?></p>
                    <br>
                    Location ID(Which location is the question linked to)
                    <br>
                    <input type="text" name="locId">
                    <p class="error"><? echo $warnLoc?></p>
                    <input type="submit" value="Add Quiz Question" class="button Save" name="btnSubmit">
                </div>
            </form>
        </div>
    </div>
</div>
