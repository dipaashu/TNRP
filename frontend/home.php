<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: home.php");
}
else {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>THis is home page after login</h1>
</body>
</html>