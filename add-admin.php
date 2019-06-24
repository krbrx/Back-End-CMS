<?php
session_start();
?>
<title>Add Admin</title>
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
    $userId= $_SESSION["user_id"];
    require ("config.php");
    if(isset($_POST['btnAddAdmin'])){
        $id = $_POST['id'];
        $password = $_POST['password'];
        if (empty($username)&& empty($password)&& empty($id)){
            $warnUser= "*Please enter an username";
            $warnPass= "*Please enter a password";
            $warnId= "*Please enter your staff ID";
        }
        else if (empty($username)){
            $warnUser= "*Please enter an username";
        }
        else if (empty($password)){
            $warnPass= "*Please enter a password";
        }
        else if (empty($id)){
            $warnPass= "*Please enter your staff ID";
        }
        else if (strlen($password) > 32){
            $warnPass= "*Password too long, limit it to 32 characters";
        }
        else if (strlen($password) < 8){
            $warnPass= "*Password too short, minimum numbers of character is 8";
        }
        else{
            $sql = "INSERT INTO admin(admin_id, username, password)
                    VALUES ('$id','$username',md5('$password'))";
            $result = mysqli_query($conn, $sql);
        }
    }
    if(isset($_POST['btnDeleteAdmin'])){
        $deleteId = $_POST['deleteId'];
        $userPass = $_POST['pass'];
        if (empty($userPass)&& empty($deleteId)){
            $warnDpass= "*Please your password";
            $warnDid= "*Please a staff ID";
        }
        else if (empty($userPass)){
            $warnDpass= "*Please your password";
        }
        else if (empty($deleteId)){
            $warnDid= "*Please a staff ID";
        }
        else if ($deleteId == $userId){
            $warnDid= "*You are not allowed to delete your account under your session";
        }
        else{
            $sql = "SELECT * FROM `admin` 
                    WHERE admin_id = '$userId' 
                    AND password = md5('$userPass')";
            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);
            if($count > 0){
                $process = "DELETE FROM admin
                            WHERE admin_id = '$deleteId' ";
                $run = mysqli_query($conn, $process);
            }
            else{
                $warnDid= "*Admin not found";
            }
        }
    }
?>

<div class="header">
    Adding /Deleting Admin
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
    <div class="inborder">
        <button class="button btn3">Admin List</button> <button class="button btn2">Add New Admin</button> <button class="button btn1">Delete Admin</button>
        <br>
        <br>
        <div class="con3">
            <table class="Table List">
                <h5><u>Admin List</u></h5>
                <tr>
                    <th>Admin ID</th>
                    <th>Username</th>
                </tr>
                <?php
                require ("config.php");
                $sql = "SELECT * FROM admin";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    echo "<tbody>";
                    while($row = mysqli_fetch_assoc($result)) {
                        echo"<tr>";
                        echo"<td>".$row["admin_id"]."</td>";
                        echo"<td>".$row["username"]."</td>";
                        echo"</tr>";
                    }
                    echo "</tbody>";
                }
                ?>
            </table>
        </div>
        <div class="con1">
            <h5><u>Delete an current admin</u></h5>
            <form action="#" method="POST">
                Your Password:
                <br>
                <input type="password" name="pass">
                <br>
                <p class="error"><? echo $warnDpass?></p>
                Admin ID(id of the admin that would be deleted):
                <br>
                <input type="text" name="deleteId">
                <br>
                <p class="error"><? echo $warnDid?></p>
                <br>
                <input type="submit" value="Delete Admin" class=button id=quesSave name="btnDeleteAdmin">
            </form>
        </div>
        <div class="con2">
            <h5><u>Adding new admin</u></h5>
            <form action="#" method="POST">
                Admin ID<br>
                <input type="text" name="id">
                <p class="error"><? echo $warnId?></p>
                Username
                <br>
                <input type="text" name="username">
                <p class="error"><? echo $warnUser?></p>
                Password
                <br>
                <input type="password" name="password">
                <br>
                <p class="error"><? echo $warnPass?></p>
                <input type="submit" value="Add Admin" class=button id=quesSave name="btnAddAdmin">
            </form>
        </div>
    </div>
</div>

