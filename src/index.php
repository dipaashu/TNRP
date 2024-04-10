<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: home.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>NoteGit</title>
        <meta name="description" content="A repository system for notes">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/x-icon" href="./img/favicon.png" />
        <link rel="stylesheet" href="./css/nav.css">
        <link rel="stylesheet" href="./css/default.css">
        <link rel="stylesheet" href="./css/index.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Anta&display=swap" rel="stylesheet">
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar">
            <ul>
                <li><a href="login.php">Login</a></li>
                <li><a href="index.php">Home</a></li>
                <a href="./index.php"><img id="logo" src="./img/logo.png" alt="Logo"></a>
            </ul>
        </nav>
        <!-- headline -->
        <div id="info">
            <h1>NoteGit</h1>
            <br>
            <p>A simple web based repository system for your notes. 
            <p>Now create, save and access your notes anytime , anywhere fron the globe.</p>
            <p>Not just that, you can do collaborations, with your friends ,  colleagues, students and so on...</p>
            <br>
            <p>Join us today <a href="./signup.php">Sign up</a> or <a href="./login.php">Login</a>.</p>
        </div>
        <div class="features">
            <h2>Features</h2>
        </div>
    </body>
</html>