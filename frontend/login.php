<?php
    session_start();
    if(isset($_SESSION['user'])){
        header("Location: index.php");
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>NoteGit Login</title>
        <meta name="description" content="A repository system for notes">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/x-icon" href="./img/favicon.png" />
        <link rel="stylesheet" href="./css/nav.css">
        <link rel="stylesheet" href="./css/default.css">
        <link rel="stylesheet" href="./css/lsform.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Anta&display=swap" rel="stylesheet">
    </head>
    <body>
        <!-- navbar -->
        <nav class="navbar">
            <ul>
                <li><a href="login.php">Login</a></li>
                <li><a href="index.php">Home</a></li>
                <a href="./index.php"><img id="logo" src="./img/logo.png" alt="Logo"></a>
            </ul>
        </nav>
        <!-- login form  -->
        <div class="login">
            <h1>Login</h1>
            <?php
            if(isset($_POST["login"])){
                $uname = $_POST["uname"];
                $password = $_POST["password"];
                require_once './db.php';
                $sql = "SELECT * FROM signup WHERE uname = '$uname'";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if ($user) {
                    if (password_verify($password, $user['password'])) {
                        session_start();
                        $_SESSION['user'] = $user;
                        header("Location: home.php");
                        die();
                    }
                        else echo "<div class='error' style='color:red;> Password is incorrect</div>";
                    }
                else echo "<div class='error' style='color:red;> Username is incorrect</div>";
                }
            
            ?>
            <form action="login.php" method="post">
                <div class="input"><input type="text" name="uname" placeholder="Username"></div>
                <div class="input"><input type="password" name="password" placeholder="Password"></div>
                <div class="input"><input type="submit" value="login"></div>
            </form>
            <div class="links">
                <a href="#">Forget Password</a>
                <a href="./signup.php">New to NoteGit</a>
            </div>

        </div>
    </body>
</html>