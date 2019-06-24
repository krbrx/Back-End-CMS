<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "asg2";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}