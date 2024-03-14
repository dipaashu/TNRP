<?php
// session_start();
// if (!isset($_SESSION["user"])) {
//     header("Location: index.php");
// }
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
            <?php
        if (isset($_POST["login"])) {
            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);
            //    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = $user["id"];
                    header("Location: home.php");
                    die();
                }else{
                    echo "<div style='color:red;'>Password does not match</div>";
                }
            }else{
                echo "<div style='color:red;'>Email does not match</div>";
            }
        }
        ?>
    <form action="login.php" class="login" method="post">
            <h1>Login</h1>
            <div class="input"><input type="email" name="email" placeholder="Email"></div>
            <div class="input"><input type="password" name="password" placeholder="Password"></div>
            <div class="input"><input type="submit" name="login" value="login"></div>
            <div class="links">
                <a href="#">Forget Password</a>
                <a href="./signup.php">New to NoteGit</a>
            </div>
            
        </div>
    </form>
    </body>
</html>