<?php
session_start();
?>
<title>KWSH Interactive App Admin CMS Panel</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php
    if (!isset($_SESSION["user_id"]))
    {
        header("location: index.php");
    }
?>
<div class=header>
    Administration Panel
    <div class="logout">
        <a href="logout.php">Log Out</a>
    </div>
    <div class="logout">
        <a href="edit-admin.php">Change Password</a>
    </div>
</div>
<div class="border">
    <div class="homeBorder">
        <div class="admin">
            <div>
            <h2 class=title>Audio</h2>
                <br><br>
            <p>Upload and change the name of Audio Files used.</p>
             <form action="audio.php">
                 <input type="submit" value="Continue" class=button id=continue>
              </form>
            </div>
        </div>
        <div class="admin">
            <div>
            <h2 class=title>Video</h2>
                <br><br>
            <p>Upload and change the name of Video Files used.</p>
            <form action="vid.php">
                <input type="submit" value="Continue" class=button id=continue>
             </form>
            </div>
        </div>
        <div class="admin">
            <div>
            <h2 class=title>Quiz</h2>
                <br><br>
            <p>Change the questions and answers found in the Quizzes.</p>
                <form action="quiz.php">
                    <input type="submit" value="Continue" class=button id=continue>
                </form>
            </div>
            </div>
        <div class="admin">
            <div>
            <h2 class=title>QR</h2>
                <br><br>
            <p>Upload and change the QR Markers and what they link to.</p>
                <form action="qr.php">
                    <input type="submit" value="Continue" class=button id=continue>
                </form>
            </div>
        </div>
        <div class="admin">
            <div>
                <h2 class=title>Admin</h2>
                <br><br>
                <p>Add or delete the admins who can access the site</p>
                <form action="add-admin.php">
                    <input type="submit" value="Continue" class=button id=continue>
                </form>
            </div>
        </div>
        <div class="admin">
            <div>
                <h2 class=title>Story</h2>
                <br><br>
                <p>Upload and change the story and what audio track they link to.</p>
                <form action="story.php">
                    <input type="submit" value="Continue" class=button id=continue>
                </form>
            </div>
        </div>
    </div>
</div>
