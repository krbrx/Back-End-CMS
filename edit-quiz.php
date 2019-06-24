<?php
session_start();
?>
<title>Edit Quiz Question</title>
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
    if(isset($_POST['btnEditQuiz'])){
        $id = $_POST['id'];
        $q = $_POST['q'];
        $a = $_POST['a'];
        $b = $_POST['b'];
        $c = $_POST['c'];
        $d = $_POST['d'];
        $ans = $_POST['ans'];
        $locId = $_POST['locId'];
        if (!empty($q)){
            $update1 = "UPDATE quiz_library 
                        SET question = '$q'
                        WHERE question_id ='$id'";
            $result1 = mysqli_query($conn, $update1);
            header("location: quiz.php");
        }
        if (!empty($a)){
            $update2 = "UPDATE quiz_library 
                        SET choice_a = '$a'
                        WHERE question_id ='$id' ";
            $result2 = mysqli_query($conn, $update2);
            header("location: quiz.php");
        }
        if (!empty($b)){
            $update3 = "UPDATE quiz_library 
                        SET choice_b = '$b'
                        WHERE question_id ='$id'";
            $result3 = mysqli_query($conn, $update3);
            header("location: quiz.php");
        }
        if (!empty($c)){
            $update4 = "UPDATE quiz_library 
                        SET choice_c = '$c'
                        WHERE question_id ='$id'";
            $result4 = mysqli_query($conn, $update4);
            header("location: quiz.php");
        }
        if (!empty($d)){
            $update5 = "UPDATE quiz_library 
                        SET choice_d = '$d' 
                        WHERE question_id ='$id'";
            $result5 = mysqli_query($conn, $update5);
            header("location: quiz.php");
        }
        if (!empty($ans)){
            $update6 = "UPDATE quiz_library 
                        SET right_ans = '$ans' 
                        WHERE question_id ='$id'";
            $result6 = mysqli_query($conn, $update6);
            header("location: quiz.php");
        }
        if (!empty($locId)){
            $update7 = "UPDATE quiz_library 
                        SET location_id = '$locId'
                        WHERE question_id ='$id'";
            $result7 = mysqli_query($conn, $update7);
            header("location: quiz.php");
        }
    }
?>
<div class="header">
    Edit Quiz Question
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
            $quizId = $_POST['selectEdit'];
            if (!isset($_SESSION["user_id"]))
            {
                header("location: index.php");
            }
            require ("config.php");
            $sql = "SELECT * FROM quiz_library
                    WHERE question_id ='$quizId '";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($result);
            ?>
            <form action="#" method="POST">
                <div class="form-group">
                    <input type="hidden" value="<? echo $quizId ?>" name="id">
                    Question<br>
                    <textarea name="q" placeholder="<? echo $data["question"]?>"></textarea><br><br>
                    Choice A<br>
                    <input type="text" name="a" placeholder="<? echo $data["choice_a"]?>"><br><br>
                    Choice B<br>
                    <input type="text" name="b" placeholder="<? echo $data["choice_b"]?>"><br><br>
                    Choice C<br>
                    <input type="text" name="c" placeholder="<? echo $data["choice_c"]?>"><br><br>
                    Choice D<br>
                    <input type="text" name="d" placeholder="<? echo $data["choice_d"]?>"><br><br>
                    Correct Answer<br>
                    <input type="text" name="ans" placeholder="<? echo $data["right_ans"]?>"><br><br>
                    Location ID(Which location is the question linked to)<br>
                    <input type="text" name="locId" placeholder="<? echo $data["location_id"]?>"><br><br>
                    <input type="submit" value="Update Quiz Question" class=button id=quesSave name="btnEditQuiz">
                </div>
            </form>
        </div>
    </div>
</div>
