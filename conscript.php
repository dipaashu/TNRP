<?php
$host = "localhost";
$user = "aashudip";
$pass = "mrproblem@04";
$db = "tnrp";


$conn = mysqli_connect($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}
echo "Connected successfully";

$conn -> close();

?>