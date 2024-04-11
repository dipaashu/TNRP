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
            <p id="qoute">" From Inspiration to Implementation: Your Notes, Your Journey. "</p>
            <p>A simple web based repository system for your notes. 
            <p>Now create, save and access your notes anytime , anywhere fron the globe.</p>
            <br>
            <p>Join us today <a href="./signup.php">Sign up</a> or <a href="./login.php">Login</a>.</p>
        </div>
        <div class="features">
            <img src="./img/signup.png" alt="signup">
            <h1>One click signup</h1>
        </div>
        <div class="features">
            <div>
                <h1>Simple and intuitive <br>interface to create <br>your notes.</h1>
                <img src="./img/create.png" alt="create note">
            </div>
        </div>
        <div class="features">
            <img src="./img/edit.png" alt="edit">
            <h1>Edit your notes <br>whenever you want.</h1>
        </div>
        <div class="features">
            <h1>Organize notes with <br>simple and interactive table</h1>
            <img src="./img/table.png" alt="table">
        </div>
        <footer>
            <h2>Made by <a href="https://github.com/dipaashu">Dipak</a></h2>
            <h3><a href="https://github.com/dipaashu/TNRP"> Git repo</a></h3>
        </footer>
    </body>
</html>