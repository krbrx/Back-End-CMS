<?php
    session_start();
?>
<title>Admin Login</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php
    if (isset($_SESSION["user_id"]))
    {
        header("location: home.php");
    }
    require ("config.php");
    if(isset($_POST['btnSubmit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (empty($username) && empty($password)) {
            $warnUser = "*Please enter your username";
            $warnPass = "*Please enter your password";
        } else if (empty($username)) {
            $warnUser = "*Please enter your username";
        } else if (empty($password)) {
            $warnPass = "*Please enter your password";
        } else {
            $sql = "SELECT * FROM `admin` 
                    WHERE username = '$username' 
                    AND password = md5('$password')";
            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);
            $row = mysqli_fetch_array($result);
            if ($count > 0) {
                $_SESSION['user_id'] = $row['admin_id'];
                header("location:home.php");
            }
            else{
                $warnUser = "*Wrong username or password";
            }
        }
    }
?>
<div class="header">
    CMS Admin Login
</div>
<div id="biggerHome" class="container-fluid">
    <div id="home">
        <h3 class="AD">Administrator Login</h3>
        <p class="italic">Use a valid username and password to gain access to the administration backend.</p>
        <div id="login">
            <form name="log" action="#" method="POST">
                <div class="form-group">
                    <h4>Username</h4>
                    <input type="text" name="username" class="input" id=lUsername>
                    <p class="error"><? echo $warnUser?></p>
                    <h4>Password</h4>
                    <input type="password" name="password" class="input" id=lUsername>
                    <p class="error"><? echo $warnPass?></p>
                    <br>
                    <input type="submit" value="Login" class=button id=lButton name="btnSubmit">
                 </div>
            </form>
        </div>
    </div>
</div>